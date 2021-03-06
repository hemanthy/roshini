<?php
session_start();


?>
<script>

var config = (function() {
var private = {
    'INCORRECT_EMAIL_OR_PASSWORD' : 'Incorrect Email or Password!!!',
    'REGISTRATION_SUCCESSFUL' : 'CONGRATULATION REGISTRATION SUCCESSFUL',
    'PASSWORD_CONFIRM_PASSWORD_DOESNOT_MATCH' : "Password and Confirm Password doesn't match",
    'LOGIN_SUCCESS' : 'LOGIN SUCCESS',
    'EMAIL_ALREADY_EXISTS' : 'Email ID already exists'
};

return {
get: function(name) { return private[name]; }
};
})();
</script>

<style>

    .hover-item:hover {
        background-color: #FFFFFF;
    }
	
	#loginModal .sidebar .widget {
		margin-bottom : 0px;
	}
	
	.navbar-toggle {
	    float: left;
	}
	
</style>


<link href="css/login-register.css" rel="stylesheet" />
<!--<link rel="stylesheet" href="css/font-awesome.min.css">-->
<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
<script src="js/login-register.js" type="text/javascript"></script>
<!--<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js" type="text/javascript"></script>-->
<!--<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>-->
<script src="js/js-validate.js"></script>


<div id="hide-for-large-devices">
                <div class="navbar navbar-default" role="navigation">
                    <div class="navbar-header">
                        <button type="button" id="navbartopleft" class="navbar-toggle collapsed" data-toggle="collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
							<span class="icon-bar"></span>
                        </button>
						<button type="button" id="backarrowhide">
							<span class="glyphicon glyphicon-arrow-left" style="font-size: 28px"></span>
						</button>
                    </div>
					<div id="navbartopleftfade" class="navbar" style="position: absolute;z-index: 10000; background-color: #FFF !important;">
                        <ul class="nav navbar-nav">
                            <li><a id="homenav" class="" href="/" title="">Home</a></li>
                            <li><a  id="flipkartnav" href="store/flipkart" title="">Flipkart Store</a></li>
                            <li><a id="howitworks" href="how-it-works" title="">How It Works</a></li>
						</ul>
                        <ul class="nav navbar-nav navbar-right">
                            <?php if (!isset($_SESSION['usr_id'])) { ?>
                                <li><a data-toggle="modal" href="javascript:void(0)" onclick="openLoginModal();">Login</a></li>
                                <li><a class="" title="" data-toggle="modal" href="javascript:void(0)" onclick="openRegisterModal();">Sign Up</a></li>
                                <input type="hidden" value="headerpage" id="loginSource"/>
                            <?php } else { ?>
                                <li style="font-size: 16px;margin-top: 6px;">Hi <?php echo $_SESSION['usr_name']; ?></li>
                                <li><a href="logout.php">Log Out</a></li>
                                <li class="dropdown hasmenu userpanel">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?php if (isset($_SESSION['user_img'])) echo $_SESSION['user_img']; ?>" alt="" class="img-circle"> <span class="fa fa-angle-down"></span></a>
                                    <ul class="dropdown-menu start-right" role="menu">
                                        <li><a href="user-dashboard.php?view=Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                                        <li><a href="user-dashboard.php?view=My Wallet"><i class="fa fa-heart-o"></i> My Wallet</a></li>
                                        <li><a href="user-dashboard.php?view=Bank Details"><i class="fa fa-dashboard"></i> Bank Details</a></li>
                                        <li><a href="user-dashboard.php?view=Withdraw"><i class="fa fa-heart-o"></i> Withdraw</a></li>
                                    </ul>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
				</div>
          
</div>

<div class="header">
    <div class="logo-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-2 col-sm-6">
                    <a class="navbar-brand" href="/">YourCoupon <small>Discount Coupon Codes</small></a>
                </div>
                <!-- end col -->
                <div class="col-md-6 col-sm-6">
                    <form class="well">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                <input id="typeahead" type="text" class="form-control" placeholder="Search for stores..." autocomplete="off" data-provide="typeahead">
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
                                <label>Search : <a href="#">Flipkart</a><!-- , <a href="#">Amazon</a>, <a href="#">Snapdeal</a> etc. --></label>
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
    <div id="hide-for-small-devices" class="menu-wrapper">
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
                    <div id="navhighlight" class="navbar">
                        <ul class="nav navbar-nav">
                            <li><a id="homenav" class="" href="/" title="">Home</a></li>
                            <li><a  id="flipkartnav" href="store/flipkart" title="">Flipkart Store</a></li>
                            <li><a id="howitworks" href="how-it-works" title="">How It Works</a></li>
                            <!--<li><a class="" href="Stores.php" title="">Stores</a></li>-->
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <?php if (!isset($_SESSION['usr_id'])) { ?>
                                <li><a data-toggle="modal" href="javascript:void(0)" onclick="openLoginModal();">Login</a></li>
                                <li><a class="" title="" data-toggle="modal" href="javascript:void(0)" onclick="openRegisterModal();">Sign Up</a></li>
                                <input type="hidden" value="headerpage" id="loginSource"/>
                            <?php } else { ?>
                                <li style="font-size: 16px;margin-top: 6px;">Hi <?php echo $_SESSION['usr_name']; ?></li>
                                <li><a href="logout.php">Log Out</a></li>
                                <li class="dropdown hasmenu userpanel">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?php if (isset($_SESSION['user_img'])) echo $_SESSION['user_img']; ?>" alt="" class="img-circle"> <span class="fa fa-angle-down"></span></a>
                                    <ul class="dropdown-menu start-right" role="menu">
                                        <li><a href="user-dashboard.php?view=Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                                        <li><a href="user-dashboard.php?view=My Wallet"><i class="fa fa-heart-o"></i> My Wallet</a></li>
                                        <li><a href="user-dashboard.php?view=Bank Details"><i class="fa fa-dashboard"></i> Bank Details</a></li>
                                        <li><a href="user-dashboard.php?view=Withdraw"><i class="fa fa-heart-o"></i> Withdraw</a></li>
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
        <div class="modal-content" id="modal-content-id">
			 <div class="row">
                                <div class="col-md-6 col-sm-12 col-xs-12" id="hide-for-small-devices">
								 <hr class="invis3">
										<div class="sidebar">
											<div class="widget clearfix">
												<div>
													<h4>Guidelines To Earn Cashback</h4>
												</div>

												<div class="best-coupons">
													<ul class="customlist">
														<li>Get Cashback when you shop via usS</li>
														<li>Login & Browse Retailers & Products</li>
														<li>Choose the Store</li>
														<li>Cashback gets added</li>
														<li>Once gets Confirmed, Transfer to your Bank Account</li>
													</ul>
												</div>
											</div>
										</div>             
								</div>
								<div class="col-md-6 col-sm-12 col-xs-12">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" id="closebtn" aria-hidden="true">&times;</button>
									<h4 class="modal-title">Login with</h4>
								</div>
								<div class="modal-body">
									<div class="box">
										<div class="content">
											<div class="social">
												<a id="facebook_login" href="#"><img src="images/login-button-png-18039-2.png"></img></a>
												<!-- <a class="circle github" href="#">
													<i class="fa fa-github fa-fw"></i>
												</a>
												<a id="google_login" class="circle google" href="#">
													<i class="fa fa-google-plus fa-fw"></i>
												</a>
												<a id="facebook_login" class="circle facebook" href="#">
													<i class="fa fa-facebook fa-fw"></i>
												</a> -->
											</div>
											<div class="division">
												<div class="line l"></div>
												<span>or</span>
												<div class="line r"></div>
											</div>
											<div class="error"></div>
											<div class="form loginBox">
												<form method="POST" action="" accept-charset="UTF-8" id="login-form">
													<input type="email" class="form-control" placeholder="Email address" name="email" id="email"  />
													<input id="password" class="form-control" type="password" placeholder="Password" name="password">
													<input class="form-control" type="hidden" id="browserinfo" name="browserinfo" value="">
													<input class="btn btn-info btn-login" type="submit" name="login" value="login" id="btn-login">
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
													
													<input class="form-control" type="hidden" id="browserinfosignup" name="browserinfosignup" value="">

													<input class="btn btn-info btn-register" type="submit" value="Create account" name="signup">
												</form>
												<span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
												<span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
											</div>
										</div>
									</div>
									<div class="box">
										<div class="content forgotpassworBox" style="display:none;">
											<div class="col-md-12 text-center">
							                        <div class="white-well">
							                            <h2>Forgot your password?</h2>
							                            <p>Please insert your email in the input below and we will send an email with the link to reset your password.</p>
							                            <form class="form-inline" action="" accept-charset="UTF-8" method="post" id="resetpasswordform">
							                                <input type="email" name="email" id="email" class="form-control" placeholder="Email">
							                                <input type="hidden" name="passwordreset"  class="form-control">
							                                <input type="submit" name="commit" value="Reset" id="resetpasswordbtn" class="btn btn-fill btn-info">
														</form>                      
														  </div>
							                    </div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<div class="forgot login-footer">
												<span>Looking to
													 <a href="javascript: showRegisterForm();"><b>create an account</b></a>
												?</span>
												<span>Looking to
													 <a href="javascript: forgotpassword();"><b>forgot password</b></a>
												?</span>
									</div>
									<div class="forgot register-footer" style="display:none">
										<span>Already have an account?</span>
										<a href="javascript: showLoginForm();"><b>Login</b></a>
									</div>
								</div>
			</div>
			</div>
			
				 <div class="row" id="withoutcb">
					 <div class="col-md-12 col-sm-12">
					 <div class="col-md-2 col-sm-2">
					 &nbsp;
					 </div>
						 <div class="col-md-8 col-sm-8">
								<a target="_blank" class="btn btn-default btn-block" href="javascript:void(0)" 
								onclick="withoutcb();">Else Continue Without Cashback</a>
						 </div>
					 </div>
				 </div>
			 <hr class="invis3">
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
                    $("#btn-login").html('<img src="btn-ajax-loader.gif" /> &nbsp; Signing In ...');
                    //$("#btn-login").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...');
                },
                success :  function(response)
                {
                     console.log(response);

                    if(response == "LOGIN_SUCCESS"){
                        // setTimeout(' window.location.href = "/index.php"; ',4000);
                         hideModal();
                         var userRef = $( "#usrRef" ).val();
                         if(userRef =='storePage'){
                             location.href = 'gotostore.php?ref=1';
                         }else {
                             location.href = window.location.href;
                         }
                    }
                    else {
                            shakeModal(config.get(response));
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
                        required: "please enter your confirm password"
                    },
                    email: "Please enter a valid email address",
                },
            submitHandler: loginForm
        });

        /* login submit */
        function loginForm()
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
                    if(response == 'INCORRECT_EMAIL_OR_PASSWORD' || response == 'PASSWORD_CONFIRM_PASSWORD_DOESNOT_MATCH' || response =='INCORRECT_EMAIL_OR_PASSWORD' ||
                    response == 'EMAIL_ALREADY_EXISTS'){
                        shakeModal(config.get(response));
                    }else if(response == 'REGISTRATION_SUCCESSFUL' || response == 'LOGIN_SUCCESS'){
                        var userRef = $( "#usrRef" ).val();
                        if(userRef =='storePage'){
                            location.href = 'gotostore.php?ref=1';
                        }else {
                            location.href = window.location.href;
                        }
                    }

                }
            });
            return false;
        }

         $( "#resetpasswordbtn").click(function() {
                    var data = $("#resetpasswordform").serialize();
                    $.ajax({
                        type : 'POST',
                        url  : 'login_process.php',
                        data : data,
                        dataType:"text",
                        beforeSend: function()
                        {
                            $("#error").fadeOut();
                            $("#btn-login").html('<img src="btn-ajax-loader.gif" /> &nbsp; Signing In ...');
							$('.error').removeClass('alert alert-danger').html('');
                            //$("#btn-login").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...');
                        },
                        success :  function(response)
                        {
							var res =	JSON.parse(response);
							if(res.success!=null){
								var data = res;
									if(data.success){
										$('.error').removeClass('alert alert-danger').html('');
										$('.error').addClass('alert alert-danger').html(data.message);
									}else{
										$('.error').removeClass('alert alert-danger').html('');
										$('.error').addClass('alert alert-danger').html(data.message);
									}
							}
							
							
                           console.log(response);
                        }
                    });
                    return false;
                });

       /*  $( "#facebook_login").click(function() {
        	//facebook_login
        	debugger;
        	$.ajax({

                type : 'get',
                url  : 'fb.php',
                beforeSend: function()
                {
                    $("#error").fadeOut();
                    //$("#btn-login").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...');
                },
                success :  function(response)
                {
                	debugger;
                	if(response!=null && response.includes('url-')){
                		var url = response.split('url-');
                		console.log(url[1]);
                		//location.href = url[1];
                		window.open(url[1]);
                	}else{
						alert(response);
                		}
                }
            });
        });
 */

    });
</script>

<script type="text/javascript">
(function (jQuery) {
    jQuery.oauthpopup = function (options) {
        options.windowName = options.windowName || 'ConnectWithOAuth';
        options.windowOptions = options.windowOptions || 'location=0,status=0,width='+options.width+',height='+options.height+',scrollbars=1';
        options.callback = options.callback || function () {
            window.location.reload();
        };
        var that = this;
        that._oauthWindow = window.open(options.path, options.windowName, options.windowOptions);
        that._oauthInterval = window.setInterval(function () {
            if (that._oauthWindow.closed) {
                window.clearInterval(that._oauthInterval);
                options.callback();
            }
        }, 1000);
    };
})(jQuery);
$(document).ready(function(){
    $('#facebook_login').click(function(e){
        $.oauthpopup({
            path: 'fb.php',
			width:600,
			height:300,
            callback: function(){
                window.location.reload();
                window.close();
            }
        });
		e.preventDefault();
    });
});
</script>
<script>
    $(document).ready(function(){

        $( ".close" ).click(function() {
            hideModal();
        });
        $( ".modal-title" ).click(function() {
            hideModal();
        });
		
		$("#backarrowhide").hide();
		
		$("#navbartopleftfade").animate({left:-200, opacity:"show"}, 0);
		
		$("#navbartopleft").click(function(){
			$("#navbartopleftfade").animate({left:-2, opacity:"show"}, 1500);
			$("#backarrowhide").show();
			$("#navbartopleft").hide();
		});
		
		$("#backarrowhide").click(function(){
			$("#navbartopleftfade").animate({left:-200, opacity:"show"}, 1500);
			$("#backarrowhide").hide();
			$("#navbartopleft").show();
		});

		$("#flipkartnav").each(function() {
			debugger;
			var url = window.location.href;
		    if (url.includes("flipkart")) {
		        $("#navhighlight #flipkartnav").addClass("active");
		        $("#navbartopleftfade #flipkartnav").addClass("active");
		        
		    }else  if (url.includes("how-it-works")) {
		    	 $("#navhighlight #howitworks").addClass("active");
		    	 $("#navbartopleftfade #howitworks").addClass("active");
		    }else if (!(url.includes("user-dashboard"))) {
		    	$("#navhighlight #homenav").addClass("active");
		    	$("#navbartopleftfade #homenav").addClass("active");
		    }
		});

		var txt = "";
	    txt = "<p>Browser CodeName: " + navigator.appCodeName + "</p>";
	    txt+= "<p>Browser Name: " + navigator.appName + "</p>";
	    txt+= "<p>Browser Version: " + navigator.appVersion + "</p>";
	    txt+= "<p>Cookies Enabled: " + navigator.cookieEnabled + "</p>";
	    txt+= "<p>Platform: " + navigator.platform + "</p>";
	    txt+= "<p>User-agent header: " + navigator.userAgent + "</p>";

		$( "#browserinfosignup" ).val (txt);
		$( "#browserinfo" ).val (txt);
		
    });

</script>
