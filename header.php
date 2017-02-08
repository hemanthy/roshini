<?php
session_start();
?>

<link href="css/login-register.css" rel="stylesheet" />
<link rel="stylesheet" href="../netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
<script src="js/login-register.js" type="text/javascript"></script>
<!--<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js" type="text/javascript"></script>-->
<!--<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>-->
<script src="js/js-validate.js"></script>

<div class="header">
    <div class="logo-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-2 col-sm-6">
                    <a class="navbar-brand" href="index.php">YourCoupon <small>Discount Coupon Codes</small></a>
                </div>
                <!-- end col -->
                <div class="col-md-6 col-sm-6">
                    <form class="well">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                <input id="typeahead" type="text" class="form-control" placeholder="Search for coupons..." autocomplete="off" data-provide="typeahead">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                        <div class="clearfix">
                            <!--div class="pull-left text-left hidden-xs">
                               <div class="checkbox checkbox-success checkbox-inline">
                                  <input type="checkbox" class="styled" id="inlineCheckbox1" value="option1" checked>
                                  <label for="inlineCheckbox1"> Coupons </label>
                               </div>
                               <div class="checkbox checkbox-success checkbox-inline">
                                  <input type="checkbox" class="styled" id="inlineCheckbox2" value="option1" checked>
                                  <label for="inlineCheckbox2"> Printable </label>
                               </div>
                               <div class="checkbox checkbox-success checkbox-inline">
                                  <input type="checkbox" class="styled" id="inlineCheckbox3" value="option1">
                                  <label for="inlineCheckbox3"> Deals </label>
                               </div>
                               <div class="checkbox checkbox-success checkbox-inline">
                                  <input type="checkbox" class="styled" id="inlineCheckbox4" value="option1">
                                  <label for="inlineCheckbox4"> Stores </label>
                               </div>
                            </div-->
                            <div class="pull-right text-right hidden-xs">
                                <label>Search : <a href="#">Flipkart</a>, <a href="#">Amazon</a>, <a href="#">Snapdeal</a> etc.</label>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- end col -->
                <!--div class="col-md-2 col-sm-3 demo-1 hidden-xs">
                   <div id="dl-menu" class="dl-menuwrapper">
                      <button class="dl-trigger"><i class="fa fa-tags"></i></button>
                      <p>Browse Deal</p>
                      <ul class="dl-menu">
                         <li><a href="#">Coupon Codes</a></li>
                         <li><a href="#">Printable Coupons</a></li>
                         <li><a href="#">Product Deals</a></li>
                         <li><a href="#">Gift Card Deals</a></li>
                         <li><a href="#">Free Shipping</a></li>
                         <li><a href="#">Top 30 Coupons</a></li>
                         <li><a href="#">Black Friday</a></li>
                         <li><a href="#">Back to School</a></li>
                      </ul>
                   </div>
                </div-->
                <!-- end col -->
                <div class="col-md-2 col-sm-3 demo-1 hidden-xs">
                    <div id="dl-menu2" class="dl-menuwrapper">
                        <button class="dl-trigger"><i class="fa fa-share-alt"></i></button>
                        <p>Follow us</p>
                        <ul class="dl-menu">
                            <li><a href="#"><i class="fa fa-facebook-square"></i> Facebook</a></li>
                            <li><a href="#"><i class="fa fa-twitter-square"></i> Twitter</a></li>
                            <li><a href="#"><i class="fa fa-youtube-square"></i> Youtube</a></li>
                            <li><a href="#"><i class="fa fa-linkedin-square"></i> Linkedin</a></li>
                            <li><a href="#"><i class="fa fa-google-plus-square"></i> Google+</a></li>
                        </ul>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end rpw -->
        </div>
        <!-- end container -->
    </div>
    <div class="menu-wrapper">
        <div class="container">
            <div class="hovermenu ttmenu menu-color">
                <div class="navbar navbar-default" role="navigation">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <!-- end navbar-header -->
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li><a class="" href="index.php" title="">Home</a></li>
                            <li><a class="active" href="store-single.php" title="">Flipkart</a></li>
                            <li><a class="" href="Stores.php" title="">Stores</a></li>
                            <li><a class="" title="">Login</a></li>
                            <li><a class="" title="" data-toggle="modal" href="javascript:void(0)" onclick="openRegisterModal();">Register</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <?php if (!isset($_SESSION['usr_id'])) { ?>

                                <li><a data-toggle="modal" href="javascript:void(0)" onclick="openLoginModal();">Login</a></li>
                                <li><a class="" title="" data-toggle="modal" href="javascript:void(0)" onclick="openRegisterModal();">Sign Up</a></li>
                            <?php } else { ?>
                                <li><p class="navbar-text">Signed in as <?php echo $_SESSION['usr_name']; ?></p></li>
                                <li><a href="logout.php">Log Out</a></li>
                                <li class="dropdown hasmenu userpanel">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="uploads/testi_03.png" alt="" class="img-circle"> <span class="fa fa-angle-down"></span></a>
                                    <ul class="dropdown-menu start-right" role="menu">
                                        <li><a href="user-dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                                        <li><a href="user-favorites.php"><i class="fa fa-star"></i> Favorite Stores</a></li>
                                        <li><a href="user-saved.php"><i class="fa fa-heart-o"></i> Saved Coupons</a></li>
                                        <li><a href="user-submit.php"><i class="fa fa-bullhorn"></i> Submit Coupon</a></li>
                                        <li><a href="#"><i class="fa fa-lock"></i> Sign Out</a></li>
                                    </ul>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
                <!-- end navbar navbar-default clearfix -->
            </div>
            <!-- end menu 1 -->
        </div>
        <!-- end container -->
    </div>
    <!-- / menu-wrapper -->
</div>
<!-- end header -->


<div class="modal fade login" id="loginModal">
    <div class="modal-dialog login animated">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Login with</h4>
            </div>
            <div class="modal-body">
                <div class="box">
                    <div class="content">
                        <div class="social">
                            <a class="circle github" href="#">
                                <i class="fa fa-github fa-fw"></i>
                            </a>
                            <a id="google_login" class="circle google" href="#">
                                <i class="fa fa-google-plus fa-fw"></i>
                            </a>
                            <a id="facebook_login" class="circle facebook" href="#">
                                <i class="fa fa-facebook fa-fw"></i>
                            </a>
                        </div>
                        <div class="division">
                            <div class="line l"></div>
                            <span>or</span>
                            <div class="line r"></div>
                        </div>
                        <div class="error"></div>
                        <div class="form loginBox">
                            <form method="POST" action="" accept-charset="UTF-8" id="login-form">
                                <!-- <input id="email" class="form-control" type="text" placeholder="Email" name="email" value="<?php if($error) echo $email; ?>"> -->
                                <input type="email" class="form-control" placeholder="Email address" name="email" id="email"  />
                                <input id="password" class="form-control" type="password" placeholder="Password" name="password">
                                <input class="btn btn-default btn-login" type="submit" name="login" value="login" id="btn-login">
                            </form>
                            <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="content registerBox" style="display:none;">
                        <div class="form">
                            <form method="post" html="{:multipart=>true}" data-remote="true" action="" accept-charset="UTF-8" id="sign-form">

                                <input type="text" name="email" placeholder="Email" required class="form-control" />
                                <span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>

                                <input type="text" name="name" placeholder="Enter Full Name" required class="form-control" />
                                <span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span>

                                <input type="password" name="password" placeholder="Password" required class="form-control" />
                                <span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>

                                <input type="password" name="cpassword" placeholder="Confirm Password" required class="form-control" />
                                <span class="text-danger"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>

                                <input class="btn btn-default btn-register" type="submit" value="Create account" name="signup">
                            </form>
                            <span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
                            <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="forgot login-footer">
                            <span>Looking to
                                 <a href="javascript: showRegisterForm();">create an account</a>
                            ?</span>
                </div>
                <div class="forgot register-footer" style="display:none">
                    <span>Already have an account?</span>
                    <a href="javascript: showLoginForm();">Login</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('document').ready(function()
    {
        /* validation */
        $("#login-form").validate({
            rules:
                {
                    password: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true
                    },
                },
            messages:
                {
                    password:{
                        required: "please enter your password"
                    },
                    email: "please enter valid email address",
                },
            submitHandler: submitForm
        });
        /* validation */

        /* login submit */
        function submitForm()
        {
            var data = $("#login-form").serialize();
            $.ajax({
                type : 'POST',
                url  : 'login_process.php',
                data : data,
                dataType:"text",
                beforeSend: function()
                {
                    $("#error").fadeOut();
                    //$("#btn-login").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...');
                },
                success :  function(response)
                {
                     console.log(response);

                    if(response=="ok"){
                        $("#btn-login").html('<img src="btn-ajax-loader.gif" /> &nbsp; Signing In ...');
                        // setTimeout(' window.location.href = "/index.php"; ',4000);
                         hideModal();
                    }
                    else if(response = "Incorrect Email or Password!!!"){
                            shakeModal();
                        /*$("#error").fadeIn(1000, function(){
                            $("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
                            // $("#btn-login").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In');
                        });*/
                    }
                }
            });
            return false;
        }



       /*  Signup submit*/
        $("#sign-form").validate({
            rules:
                {
                    password: {
                        required: true,
                        minlength: 1
                    },
                    cpassword: {
                        required: true,
                        minlength: 1
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    name: {
                        required: true,
                    },
                },
            messages:
                {
                    password:{
                        required: "please enter your password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                    name:{
                        required: "please enter your name"
                    },
                    cpassword:{
                        required: "please enter your password"
                    },
                    email: "Please enter a valid email address",
                },
            submitHandler: signupForm
        });

        /* login submit */
        function signupForm()
        {
            var data = $("#sign-form").serialize();
            $.ajax({

                type : 'POST',
                url  : 'login_process.php',
                data : data,
                beforeSend: function()
                {
                    $("#error").fadeOut();
                    //$("#btn-login").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...');
                },
                success :  function(response)
                {
                    if(response=="Successfully Registered"){
                        alert(response);
                        /*$("#btn-login").html('<img src="btn-ajax-loader.gif" /> &nbsp; Signing In ...');
                        setTimeout(' window.location.href = "/index.php"; ',4000);*/

                    }
                    else{
                        $("#error").fadeIn(1000, function(){
                            $("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
                            // $("#btn-login").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In');
                        });
                    }
                }
            });
            return false;
        }


    });

</script>