<div class="container">
    <div class="row">
        <div class="box">

            <ol class="breadcrumb">

                <!-- id de categorie en fonction du topic de la category dans laquell on creer une nouveau topic-->
                <li><a href="<?php echo site_url("Forum/list_cat")?>">Category</a></li>
                <li class="active">Create Categorie</li>
            </ol>
            <div class="col-lg-12">
                <hr>
                <h2 class="intro-text text-center">Create a
                    <strong>Category</strong>
                </h2>
                <hr>

                <?php echo form_open('Forum/create_cat',[ 'role' => 'form', 'id' => 'myform']);?>
                <div class="row">
                    <div class="form-group">
                        <?php echo form_error('name','<div class="alert alert-danger">', '</div>'); ?>
                        <label>Name Categorie</label>
                        <input type="text" name="name" value="<?php echo set_value('subject'); ?>"  class="form-control">
                    </div>

                </div>




                <div class="form-group">
                    <?php echo form_error('description','<div class="alert alert-danger">', '</div>'); ?>
                    <label>Description</label><P>
                        <TEXTAREA name="description" rows=10 COLS=40></TEXTAREA><P>

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