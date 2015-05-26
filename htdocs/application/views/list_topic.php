<div class="container">
    <div class="row">
        <div class="box">
            <div class="col-lg-12">

                <table class="table table-bordered">
                    <tr>
                        <th>Topic</th>
                        <th>Created at</th>
                    </tr>

                    <tr>
                        <?php
                        if (isset($info))
                            foreach ($info as $inf)
                            {
                                echo '<th>'.anchor("Forum/post_topic/".$inf["topic_id"], $inf["topic_subject"]).'</th>';
                               echo '<th>'.$inf["topic_date"].'by</th>';

                            }
                        ?>

                    </tr>
                </table>
            </div>

        </div>
        <!-- /.container -->