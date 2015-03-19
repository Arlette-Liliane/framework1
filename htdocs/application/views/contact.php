<!--<div class="container">

       <div class="row">
           <div class="box">
               <div class="col-lg-12">
                   <hr>
                   <h2 class="intro-text text-center">Contact
                       <strong>business casual</strong>
                   </h2>
                   <hr>
               </div>
               <div class="col-md-8">
                   <!-- Embedded Google Map using an iframe - to select your location find it on Google maps and paste the link as the iframe src. If you want to use the Google Maps API instead then have at it! -->
                    <!-- <iframe width="100%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?hl=en&amp;ie=UTF8&amp;ll=37.0625,-95.677068&amp;spn=56.506174,79.013672&amp;t=m&amp;z=4&amp;output=embed"></iframe>
                    </div>
                    <div class="col-md-4">
                    <p>Phone:
                        <strong>123.456.7890</strong>
                    </p>
                    <p>Email:
                        <strong><a href="mailto:name@example.com">name@example.com</a></strong>
                    </p>
                    <p>Address:
                        <strong>3481 Melrose Place
                            <br>Beverly Hills, CA 90210</strong>
                    </p>
                    </div>
                    <div class="clearfix"></div>
                    </div>
                    </div>-->

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Contact
                        <strong>form</strong>
                    </h2>
                    <hr>
                    <?php echo form_open('Contact/send_mail',[ 'role' => 'form', 'id' => 'myform']); ?>
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <?php echo form_error('name','<div class="alert alert-danger">', '</div>'); ?>
                                <label>Name</label>

                                <input type="text" name="name" value="<?php echo set_value('name'); ?>" class="form-control">
                            </div>
                            <div class="form-group col-lg-4">
                                <?php echo form_error('email','<div class="alert alert-danger">', '</div>'); ?>
                                <label>Email Address</label>
                                <input type="email" name="email" value="<?php echo set_value('email'); ?>" class="form-control">
                            </div>
                            <div class="form-group col-lg-4">
                                <?php echo form_error('tel','<div class="alert alert-danger">', '</div>'); ?>
                                <label>Phone Number</label>
                                <input type="tel" name="tel" value="<?php echo set_value('tel'); ?>" class="form-control">
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group col-lg-12">
                                <?php echo form_error('message','<div class="alert alert-danger">', '</div>'); ?>
                                <label>Message</label>
                                <textarea class="form-control" value="<?php echo set_value('message'); ?>" name="message" rows="6"></textarea>
                            </div>
                            <div class="form-group col-lg-12">
                                <input type="hidden" name="save" value="contact">
                                <button type="submit" class="btn btn-default">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container -->