<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>About - Business Casual - Start Bootstrap Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url("assets/css/bootstrap.min.css");?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url("assets/css/business-casual.css");?>" rel="stylesheet">

    <!-- Fonts -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<div class="row">
    <div class="box">
        <div class="col-lg-12">
            <hr>
            <h2 class="intro-text text-center">Welcome
                <strong>back</strong>
            </h2>
            <hr>
<?php echo form_open('Users/login',[ 'role' => 'form', 'id' => 'myform']); ?>

            <div class="row">
                <div class="form-group col-lg-4">
                    <?php echo form_error('email','<div class="alert alert-danger">', '</div>'); ?>
                    <label>Email</label>
                    <input type="email" name ="email" value="<?php echo set_value('email'); ?>"   class="form-control">
                            </div>
                            <div class="form-group col-lg-4">
                                <label>Password</label>
                                <?php echo form_error('password','<div class="alert alert-danger">', '</div>'); ?>
                                <input type="password"   name = "password" class="form-control">
                            </div>

                            <div class="form-group col-lg-12">
                                <input type="hidden" name="save" value="contact">
                                <button type="submit" class="btn btn-default">Submit</button>

                            </div>
                <div class="form-group col-lg-12">
                <?php echo anchor("Users/create_user", "Create a account?");?>
                </div>
                        </div>
                    </form>
        </div>
    </div>

</body>

</html>
    <!-- /.container -->