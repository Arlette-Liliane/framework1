<div class="container">
    <div class="row">
        <div class="box">

            <ol class="breadcrumb">

                <!-- id de categorie en fonction du topic de la category dans laquell on creer une nouveau topic-->
                <li><a href="<?php echo site_url("Forum/list_cat")?>">Category</a></li>
                <li><a href="<?php echo site_url("Forum/list_topic/".$info[0]['cat_id']);?>">Topic</a></li>
                <li class="active">Create Topic</li>
            </ol>
            <div class="col-lg-12">
                <hr>
                <h2 class="intro-text text-center">Create a
                    <strong>Category</strong>
                </h2>
                <hr>

                <?php echo form_open('Forum/create_topic',[ 'role' => 'form', 'id' => 'myform']); print_r($info);?>
                <div class="row">
                    <div class="form-group">
                        <?php echo form_error('subject','<div class="alert alert-danger">', '</div>'); ?>
                        <label>Subject</label>
                        <input type="text" name="subject" value="<?php echo set_value('subject'); ?>"  class="form-control">
                    </div>

                 </div>
                <div class="form-group">
                    <label>Category</label>
                    <select name="mycatgorie" class="form-control" id="mycategorie">
                       <?php
                        foreach($info as $g)
                        {

                            echo '<option>'.$g['cat_name'].'</option>';

                        }?>
                   </select>
                </div>



                    <div class="form-group">
                        <?php echo form_error('message','<div class="alert alert-danger">', '</div>'); ?>
                        <label>Message</label><P>
                            <TEXTAREA name="message" rows=10 COLS=40></TEXTAREA><P>

                    </div>

                    <div class="form-group col-lg-12">
                        <input type="hidden" name="save" value="newuser">
                        <button type="submit" class="btn btn-default">Add category</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

</div>