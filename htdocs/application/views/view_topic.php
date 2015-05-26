<div class="container">
    <div class="row">
        <div class="box">
            <div class="col-lg-12">


                <table class="table table-bordered">
                    <tr>
                        <!-- avoir le nom du topic pour les reponse mis dans name  -->
                        <th class="alert-danger"><?php echo $info['name']->topic_subject; ?></th>
                    </tr>

                        <?php //var_dump($info["name"]);
                            if (!isset($info)) {
                                foreach ($info as $inf) {
                                    echo ' <tr>';
                                    echo '<td>' . $inf["post_date"] . 'by</td>';
                                    echo '<td>' . $inf["post_content"] . '</td>';

                                    echo '  </tr>';

                                }
                            }
                        else {
                            echo '<h2 class="intro-text text-center"> <p class="text-warning">Forbidden <strong>You dont have enough right :( </strong></p></h2>';
                        }
                            ?>

                </table>
                <?php echo form_open('Forum/post_topic',[ 'role' => 'form', 'id' => 'myform']);
                echo (isset($info)) ?  '<label>Post in : </label>' : '<label>Reply to : </label>';?>
                <textarea class="form-control" rows="3"></textarea>
                <input type="submit" value="Submit reply" />
                </form>

            </div>

        </div>

        </div>
    </div>

        <!-- /.container -->