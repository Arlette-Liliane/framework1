<div class="container">
    <div class="row">
        <div class="box">

            <ol class="breadcrumb">
                <li><a href="<?php echo site_url("Forum/list_cat")?>">Category</a></li>
                <li class="active">Topic</li>
            </ol>
            <div class="col-lg-12">
                <a href="<?php echo site_url("Forum/create_topic"); ?>" class="btn  btn-lg btn-primary btn-xl wow tada">create Topic</a>
                </br>
                <table class="table table-bordered table-condensed table-body-center" >

                    <tr><td class="alert-danger" colspan=3>
                            <?php echo $info['cat'][0]['cat_name'];
                            echo '</td></tr>'; ?>
                    <tr>
                        <th>Topic</th>
                        <th>Created at</th>
                        <th>Command</th>
                    </tr>

                    <tr>
                        <?php  $this->CI = & get_instance(); print_r($this->session->userdata);
                        if (isset($info))
                            foreach ($info['topic'] as $inf)
                            {
                                echo "<tr>";
                                $name_user = $this->CI->aauth->get_user($inf['topic_by']);
                                echo '<td>'.anchor("Forum/post_topic/".$inf["topic_id"], $inf["topic_subject"]).'</td>';
                                echo '<td>'.$inf["topic_date"].'  by  '. $name_user->name.'</td>';

                                if ($inf['topic_by'] === $this->session->userdata('id') || $this->aauth->is_admin($this->session->userdata('id')))
                                echo '<td><a href="'.site_url("Forum/modify_topic/".$inf['topic_id']).'" class="btn btn-lg btn-primary"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                                <a href="'.site_url("Forum/delete_topic/".$inf['topic_id']).'" class="btn btn-lg btn-primary"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>

                                </td>';
                                echo "</tr>";

                            }
                        ?>

                    </tr>
                </table>
            </div>

        </div>
        <!-- /.container -->