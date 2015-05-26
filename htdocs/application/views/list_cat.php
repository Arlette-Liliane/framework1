<div class="container">
    <div class="row">
        <div class="box">
            <div class="col-lg-12">

        <table class="table table-bordered">
            <tr>
                <th>Category</th>
                <th>Last Topics</th>
            </tr>


                <?php
                if (isset($info))
                    foreach ($info as $inf)
                    {
                        echo '  <tr>';
                    echo '<td>'.anchor("Forum/list_topic/".$inf["cat_id"], $inf["cat_name"]).'<br>'.$inf["cat_description"].'</td>';
                        echo "<td>NO</td>";
                        echo '   </tr>';
                    }
                ?>


        </table>
    </div>

</div>
<!-- /.container -->