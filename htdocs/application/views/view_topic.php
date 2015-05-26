<div class="container">
    <div class="row">
        <div class="box">
            <div class="col-lg-12">
                <?php echo form_open('Forum/post_topic',[ 'role' => 'form', 'id' => 'myform']);
                echo (isset($info)) ?  '<label>Reply to : </label>' : '<label>Post in : </label>';?>
                <textarea class="form-control" rows="3"></textarea>
                <input type="submit" value="Submit reply" />
                </form>

                <table class="table table-bordered">
                    <tr>
                        <!-- avoir le nom du topic pour les reponse mis dans name  -->
                        <th class="alert-danger"><?php echo $info['name']->topic_subject; ?></th>
                    </tr>
                    <tr>
                        <?php //var_dump($info["name"]);

                            foreach ($info as $inf)
                            {
                                echo '<th>'.$inf["post_date"].'by</th>';
                                echo '<th>'.$inf["post_content"].'</th>';


                            }
                            echo '<h2 class="intro-text text-center"> <p class="text-warning">Forbidden <strong>You dont have enough right :( </strong></p></h2>';
                        ?>
                    </tr>
                </table>
            </div>

        </div>

        </div>
    </div>

        <!-- /.container -->