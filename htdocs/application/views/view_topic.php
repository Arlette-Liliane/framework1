<div class="container">
    <div class="row">
        <div class="box">
            <div class="col-lg-12">



<?php


echo '<table class="table table-bordered table-condensed table-body-center" >';

echo '<tr><td class="alert-danger" colspan=2>'; //print_r($info['tab']);
echo $info['topic']->topic_subject;
echo '</td></tr>';



                       //var_dump($info["name"]);

                        foreach ($info['tab'] as $inf) {
                            echo ' <tr>';
                            echo '<td>' . $inf["name"] . ' <br>'.$inf["post_date"] . '</td>';
                            echo '<td>' . $inf["post_content"] . '</td>';
                            echo '  </tr>';
                        }


echo '</table>';
                 echo form_open('Forum/post_topic/'.$info['topic']->topic_id,[ 'role' => 'form', 'id' => 'myform']);
                echo (isset($info)) ?  '<label>Post in : </label>' : '<label>Reply to : </label>';
                echo form_error('message','<div class="alert alert-danger">', '</div>');?>
                <textarea class="form-control"  name="message" rows="3"></textarea>
                <input type="submit" value="Submit reply" />
                </form>

            </div>

        </div>

        </div>
    </div>

        <!-- /.container -->