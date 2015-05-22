<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Framework0</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url("assets/css/bootstrap.min.css");?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url("assets/css/business-casual.css");?>" rel="stylesheet">

    <!-- Fonts -->
    <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.2.min.js"></script>



    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="<?php echo base_url("assets/js/profile.js");?>"></script>
    <script src="<?php echo base_url("assets/js/list_user.js");?>"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.2.min.js"></script>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>

<div class="brand">My FRame</div>
<div class="address-bar">3481 Melrose Place | Beverly Hills, CA 90210 | 123.456.7890</div>

<!-- Navigation -->
<nav class="navbar navbar-default" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- navbar-brand is hidden on larger screens, but visible when the menu is collapsed -->
            <a class="navbar-brand" href="index.html">Business Casual</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="<?php echo site_url("Home");?>">Home</a>
                </li>
               
                <li>
                    <a href="<?php echo site_url("Contact");?>">Contact</a>
                </li>
                <li class="dropdown">
                    <a href="<?php echo site_url("Users/profile");?>" class="dropdown-toggle" data-toggle="dropdown" class="alert-success"> <?php  echo ($this->session->userdata('name')) ? 'Welcome '.$this->session->userdata('name') : 'Invité';?><b class="caret"></b></a>
                    <ul class="dropdown-menu">

                        <li>
                            <?php  echo ($this->session->userdata('name')) ?  '<a href="'.site_url('Users/logout').'"><i class="fa fa-fw fa-power-off"></i> Log Out</a>' : '<a href="'.site_url('Users/login').'"><i class="fa fa-fw fa-sign-in"></i> Sign In</a>';?>
                        </li>

                        <?php
                            echo ($this->session->userdata('name')) ?
                                    '<li>
                                        <a href="'.site_url("Users/profile").'"> Profile</a>
                                    </li>' : ''?>

                    </ul>
                </li>
                <?php
                echo ($this->aauth->is_admin($this->session->userdata('id'))) ?
                    '<li>
                                        <a href="'.site_url("Users/list_users").'"> <i class="fa fa-fw fa-power-off"></i> Users List</a>
                                    </li>' : '';


                    echo ($this->session->userdata('name')) ?
                    '<li>
                                        <a href="'.site_url("Forum").'"> <i class="fa fa-fw fa-power-off"></i> Forum</a>
                                    </li>' : ''
 ?>

            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>