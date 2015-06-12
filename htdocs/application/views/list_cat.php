<div class="container">
    <div class="row">
        <div class="box">
            <div class="col-lg-12">
                <a href="<?php echo site_url("Forum/create_cat"); ?>" class="btn  btn-lg btn-primary btn-xl wow tada">create Topic</a>
                </br>
        <table class="table table-bordered">
            <tr>
                <th>Category</th>
                <th>Last Topics</th>
            </tr>


                <?php var_dump($info);
                if (isset($info))
                    foreach ($info as $inf)
                    {
                        echo '  <tr>';
                    echo '<td>'.anchor("Forum/list_topic/".$inf["cat_id"], $inf["cat_name"]).'<br>'.$inf["cat_description"].'</td>';
                        echo "<td>NO</td>";
                        if ($this->aauth->is_admin($this->session->userdata('id')))
                            echo '<td><a href="'.site_url("Forum/modify_cat/".$inf['cat_id']).'" class="btn btn-lg btn-primary"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                                <a href="'.site_url("Forum/delete_cat/".$inf['cat_id']).'" class="btn btn-lg btn-primary"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>

                                </td>';
                        echo '   </tr>';
                    }
                ?>


        </table>
    </div>

</div>
<!-- /.container -->