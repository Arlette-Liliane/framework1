<div class="container">
        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">registered
                        <strong>form</strong>
                    </h2>
                    <hr>

                    <?php echo form_open('Users/create_user',[ 'role' => 'form', 'id' => 'myform']); ?>
                        <div class="row">
                            <div class="form-group">
                                <?php echo form_error('name','<div class="alert alert-danger">', '</div>'); ?>
                                <label>Name</label>
                                <input type="text" name="name" value="<?php echo set_value('name'); ?>"  class="form-control">
                            </div>
                            <div class="form-group">
                                <?php echo form_error('surname','<div class="alert alert-danger">', '</div>'); ?>
                                <label>Surname</label>

                                <input type="text" name="surname"  value="<?php echo set_value('surname'); ?>"  class="form-control">
                            </div>

                            <div class="form-group">
                                <?php echo form_error('email','<div class="alert alert-danger">', '</div>'); ?>
                                <label>Email Address</label>
                                <input type="email" name ="email" value="<?php echo set_value('email'); ?>"   class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Login</label>
                                <?php echo form_error('login','<div class="alert alert-danger">', '</div>'); ?>
                                <input type="text" name="login" value="<?php echo set_value('login'); ?>"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <?php echo form_error('password','<div class="alert alert-danger">', '</div>'); ?>
                                <input type="password"   name = "password" value="<?php echo set_value('password'); ?>"   class="form-control">
                            </div>

                            <div class="form-group col-lg-12">
                                <input type="hidden" name="save" value="newuser">
                                <button type="submit" class="btn btn-default">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container -->