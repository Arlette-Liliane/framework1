<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: aemebiku
 * Date: 24/02/15
 * Time: 17:33
 */


class Contact extends CI_Controller
{
    public function index()
    {
        $this->send_mail();
    }
    public function send_mail()
    {
        $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('tel', 'Tel', 'trim|required|min_length[9]|max_length[15]|xss_clean');
        $this->form_validation->set_rules('message', 'Message', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run()) { echo "run";
            $mail = new Phpmailer();
            $mail->IsSMTP();
            // we are going to use SMTP
            $mail->SMTPAuth = true; // enabled SMTP authentication
            //$mail->SMTPDebug = 2;
            $mail->SMTPSecure = "ssl";  // prefix for secure protocol to connect to the server// SMTP port to connect to GMail
            $mail->Host = "smtp.gmail.com";      // setting GMail as our SMTP server
            $mail->Port = 465;
            $mail->Username = "lbealye@gmail.com";  // user email address
            $mail->Password = "missbeali";            // password in GMail
            $mail->SetFrom( 'noreply', 'Admin');  //Who is sending the email
            $mail->AddReplyTo(htmlentities($this->input->post("email")),htmlentities($this->input->post("name")));  //email address that receives the response
            $mail->Subject = 'Contact ' .  htmlentities($this->input->post("name"));
            $mail->Body =  htmlentities($this->input->post("message")) . "  Tel : " .  htmlentities($this->input->post("tel"));
            $mail->AltBody = "Plain text message";
            $destino = "lbealye@gmail.com"; // Who is addressed the email to
            $mail->AddAddress($destino, "Admin");

           // $mail->AddAddress(htmlentities($this->input->post("email")), htmlentities($this->input->post("name")));
            /*$mail->AddAttachment("images/phpmailer.gif");      // some attached files
            $mail->AddAttachment("images/phpmailer_mini.gif"); // as many as you want*/
            if (!$mail->Send()) {
                echo "no";
                var_dump($mail->ErrorInfo);
                $data["message"] = "Error: " . $mail->ErrorInfo;
                print "<script type=\"text/javascript\">alert('Error: '+$mail->ErrorInfo);</script>";
            } else {
                echo "oui";
                print "<script type=\"text/javascript\">alert('Message sent correctly');</script>";
                $data['contents'] = 'contact';
                $this->load->view('templates/template', $data);

            }

        }
        else
        {
            $data['contents'] = 'contact';
            $this->load->view('templates/template', $data);
        }
    }

}