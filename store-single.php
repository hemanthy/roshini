<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include_once ('dbconnect.php');

$stmt = $conn->prepare("select * from store s, category c where s.id=:storeId and c.store_id =:storeId;");
$stmt->execute(array(':storeId' => 1));
$storeResult = $stmt->fetchAll();


?>

<!-- Mirrored from psdconverthtml.com/live/yourcoupon/coupon-v2/store-single.php by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 09 Jan 2017 19:23:32 GMT -->
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- SITE META -->
    <title>YourCoupon | Responsive Coupon Code Site Templates</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">

    <!-- FAVICONS -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="57x57" href="images/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="images/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="images/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="images/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="images/apple-touch-icon-152x152.png">

    <!-- BOOTSTRAP STYLES -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <!-- TEMPLATE STYLES -->
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- RESPONSIVE STYLES -->
    <link rel="stylesheet" type="text/css" href="css/responsive.css">
    <!-- COLORS -->
    <link rel="stylesheet" type="text/css" href="css/colors.css">
    <!-- CUSTOM STYLES -->
    <link rel="stylesheet" type="text/css" href="css/custom.css">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Skin Examples -->
    <link rel="alternate stylesheet" type="text/css" href="css/skins/skin1.css" title="skin1" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="css/skins/skin2.css" title="skin2" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="css/skins/skin3.css" title="skin3" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="css/skins/skin4.css" title="skin4" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="css/skins/skin5.css" title="skin5" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="css/skins/skin6.css" title="skin6" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="css/skins/skin7.css" title="skin7" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="css/skins/skin8.css" title="skin8" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="css/skins/skin9.css" title="skin9" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="css/skins/skin10.css" title="skin10" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="css/skins/skin11.css" title="skin11" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="css/skins/skin12.css" title="skin12" media="all" />
    <!-- END Skin Examples -->

    <!-- Style switcher -->
    <link href="switcher/switcher.css" rel="stylesheet">

</head>
<body>

<!-- ADD Switcher -->
<div class="demo_changer">
    <div class="demo-icon">
        <i class="fa fa-gear fa-spin"></i>
    </div>
    <div class="form_holder">
        <div class="row">
            <div class="col-md-12">
                <h4>BOXED OR FULLWIDTH</h4>
                <div class="img-normal">
                    <a data-placement="bottom" data-toggle="tooltip" title="Fullwidth" href="#" class="layoutselectfullwidth"><img src="switcher/images/fullwidth.jpg" alt=""></a>
                    <a href="#" data-placement="bottom" data-toggle="tooltip" title="Boxed" class="layoutselectboxed"><img src="switcher/images/boxed.jpg" alt=""></a>
                </div>
            </div>
        </div>

        <hr class="invis2">

        <div class="row">
            <div class="col-md-12">
                <h4>PATTERNS LIGHT (ONLY BOXED)</h4>
                <div class="PatternChanger">
                    <a href="switcher/images/patterns/light_01.png" class="bg_t"><img src="switcher/images/patterns/light_01.png" alt=""></a>
                    <a href="switcher/images/patterns/light_02.png" class="bg_t"><img src="switcher/images/patterns/light_02.png" alt=""></a>
                    <a href="switcher/images/patterns/light_03.png" class="bg_t"><img src="switcher/images/patterns/light_03.png" alt=""></a>
                    <a href="switcher/images/patterns/light_04.png" class="bg_t"><img src="switcher/images/patterns/light_04.png" alt=""></a>
                    <a href="switcher/images/patterns/light_05.png" class="bg_t"><img src="switcher/images/patterns/light_05.png" alt=""></a>
                    <a href="switcher/images/patterns/light_06.png" class="bg_t"><img src="switcher/images/patterns/light_06.png" alt=""></a>
                    <a href="switcher/images/patterns/light_07.png" class="bg_t"><img src="switcher/images/patterns/light_07.png" alt=""></a>
                    <a href="switcher/images/patterns/light_08.png" class="bg_t"><img src="switcher/images/patterns/light_08.png" alt=""></a>
                    <a href="switcher/images/patterns/light_09.png" class="bg_t"><img src="switcher/images/patterns/light_09.png" alt=""></a>
                    <a href="switcher/images/patterns/light_10.png" class="bg_t"><img src="switcher/images/patterns/light_10.png" alt=""></a>
                    <a href="switcher/images/patterns/light_11.png" class="bg_t"><img src="switcher/images/patterns/light_11.png" alt=""></a>
                    <a href="switcher/images/patterns/light_12.png" class="bg_t"><img src="switcher/images/patterns/light_12.png" alt=""></a>
                </div>
            </div>
        </div>

        <hr class="invis2">

        <div class="row">
            <div class="col-md-12">
                <h4>PATTERNS DARK (ONLY BOXED)</h4>
                <div class="PatternChanger">
                    <a href="switcher/images/patterns/dark_01.png" class="bg_t"><img src="switcher/images/patterns/dark_01.png" alt=""></a>
                    <a href="switcher/images/patterns/dark_02.png" class="bg_t"><img src="switcher/images/patterns/dark_02.png" alt=""></a>
                    <a href="switcher/images/patterns/dark_03.png" class="bg_t"><img src="switcher/images/patterns/dark_03.png" alt=""></a>
                    <a href="switcher/images/patterns/dark_04.png" class="bg_t"><img src="switcher/images/patterns/dark_04.png" alt=""></a>
                    <a href="switcher/images/patterns/dark_05.png" class="bg_t"><img src="switcher/images/patterns/dark_05.png" alt=""></a>
                    <a href="switcher/images/patterns/dark_06.png" class="bg_t"><img src="switcher/images/patterns/dark_06.png" alt=""></a>
                    <a href="switcher/images/patterns/dark_07.png" class="bg_t"><img src="switcher/images/patterns/dark_07.png" alt=""></a>
                    <a href="switcher/images/patterns/dark_08.png" class="bg_t"><img src="switcher/images/patterns/dark_08.png" alt=""></a>
                    <a href="switcher/images/patterns/dark_09.png" class="bg_t"><img src="switcher/images/patterns/dark_09.png" alt=""></a>
                    <a href="switcher/images/patterns/dark_10.png" class="bg_t"><img src="switcher/images/patterns/dark_10.png" alt=""></a>
                    <a href="switcher/images/patterns/dark_11.png" class="bg_t"><img src="switcher/images/patterns/dark_11.png" alt=""></a>
                    <a href="switcher/images/patterns/dark_12.png" class="bg_t"><img src="switcher/images/patterns/dark_12.png" alt=""></a>
                </div>
            </div>
        </div>

        <hr class="invis2">

        <div class="row">
            <div class="col-md-12">
                <h4>COLOR EXAMPLES</h4>
                <div class="colorskin">
                    <span rel="skin1" class="styleswitch"><img src="switcher/images/color_01.jpg" alt=""></span>
                    <span rel="skin2" class="styleswitch"><img src="switcher/images/color_02.jpg" alt=""></span>
                    <span rel="skin3" class="styleswitch"><img src="switcher/images/color_03.jpg" alt=""></span>
                    <span rel="skin4" class="styleswitch"><img src="switcher/images/color_04.jpg" alt=""></span>
                    <span rel="skin5" class="styleswitch"><img src="switcher/images/color_05.jpg" alt=""></span>
                    <span rel="skin6" class="styleswitch"><img src="switcher/images/color_06.jpg" alt=""></span>
                    <span rel="skin7" class="styleswitch"><img src="switcher/images/color_07.jpg" alt=""></span>
                    <span rel="skin8" class="styleswitch"><img src="switcher/images/color_08.jpg" alt=""></span>
                    <span rel="skin9" class="styleswitch"><img src="switcher/images/color_09.jpg" alt=""></span>
                    <span rel="skin10" class="styleswitch"><img src="switcher/images/color_10.jpg" alt=""></span>
                    <span rel="skin11" class="styleswitch"><img src="switcher/images/color_11.jpg" alt=""></span>
                    <span rel="skin12" class="styleswitch"><img src="switcher/images/color_12.jpg" alt=""></span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Switcher -->

<!-- ******************************************
START SITE HERE
********************************************** -->

<div id="wrapper">

    <div id="headerId"></div>


    <section class="section page-title-wrapper wb">
        <div class="container">
            <div class="page-title pull-left">
                <p>This is an example subtitle for the single store.</p>
                <h3>Flipkart Cashback</h3>
            </div><!-- end title -->
            <div class="pull-right hidden-xs">
                <div class="bread">
                    <ol class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li class="active">Categories</li>
                    </ol>
                </div><!-- end bread -->
            </div><!-- /.pull-right -->
        </div>
    </section><!-- end section -->

    <div class="section">
        <div class="container">
            <div class="row">
                <div class="content col-md-8">
                    <div class="post-wrapper single-store">
                        <div class="featured hidden-xs"><a data-placement="top" data-toggle="tooltip" title="Favorite Store" href="#"><i class="fa fa-heart-o"></i></a></div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="post-media text-center">
                                    <a href="coupon-single.php"><img src="http://www.afaqs.com/all/news/images/news_story_grfx/2015/05/44375/Flipkart's-brand-new-mobile-friendly-logo.jpg" alt="" class="img-responsive"></a>
                                    <small><a href="#">Flipkart.com</a></small>
                                </div>
                                <!-- end media -->
                            </div>
                            <!-- end col -->

                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <div class="coupon-meta">
                                    <div class="col-md-6 col-sm-4 col-xs-12">
                                        <h3>Flipkart.com</h3>
                                    </div>
                                    <div class="col-md-6 col-sm-4 col-xs-12">
                                        <div class="showcode">
                                            <a href="#" class="code-link">OK<!--
                                                <span class="coupon-code">2016TATILRA50</span>
                                                <span class="show-code">Show Code</span>-->
                                            </a>
                                        </div><!-- end showcode -->
                                        <!--href="gotostore.php?ref=1"-->
                                        <!--<a data-toggle="modal" href="javascript:void(0)" onclick="showLoginForm();">Get Cashback</a>-->
                                        <a  class="gp-button btn btn-primary btn1">Get Cashback</a>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <p><?php  print_r($storeResult[0]['description']); ?></p>
                                </div>
                                <!-- end meta -->
                                <!-- end coupon-top -->
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->
                    </div>
                    <!-- end post-wrapper -->

                    <hr class="invishalf">

                    <div class="coupon-tab post-wrapper nopadtop clearfix">
                        <!-- Nav tabs -->
                        <!--  <ul class="nav nav-tabs custom-tab-nav" role="tablist">
                              <li role="presentation" class="active"><a href="#activecoupons" aria-controls="activecoupons" role="tab" data-toggle="tab">Active Coupons</a></li>
                              <li role="presentation"><a href="#unreliablecoupons" aria-controls="unreliablecoupons" role="tab" data-toggle="tab">Unreliable Coupons</a></li>
                              <li role="presentation"><a href="#printablecoupons" aria-controls="printablecoupons" role="tab" data-toggle="tab">Printable Coupons</a></li>
                          </ul> -->



                        <table id="showcashbacktableid" class="table table-sm table-striped table-bordered table-hover table-responsive">
                            <thead class="thead-inverse">
                            <tr>
                                <th>Flipkart Offers</th>
                                <th>Cashback</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            try{
                                foreach($storeResult as $row){
                                    $categoryName = $row['category_name'];
                                    $percent = $row['cashback_percent'];
                                    ?>
                                    <tr>
                                        <td><?php echo $categoryName;?></td>
                                        <td><?php echo $percent;?>%</td>
                                        <td><a href="gotostore.php?ref=1" target="_blank" class="btn btn-default btn-block">Get Cashback</a></td>
                                    </tr>
                                    <?php
                                }
                            }catch(PDOException $e)
                            {
                                echo "Error: " . $e->getMessage();
                            }
                            ?>
                            </tbody>
                        </table>
                        <!-- Tab panes -->
                    </div>
                    <hr class="invishalf">
                    <div class="post-wrapper mb20 clearfix">
                        <div class="widget-title">
                            <h4><span>Leave a Feedback</span></h4>
                        </div>

                        <div class="comment-form newsletter">
                            <p>Your email is safe with us and we hate spam as much as you do.</p>
                            <form method="POST" name="feedbackform" accept-charset="UTF-8" class="row" id="feedbackform">
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" value="<?php if (isset($_SESSION['usr_name'])) echo $_SESSION['usr_name']; ?>" placeholder="Enter your name..">
                                </div>
                                <div class="col-sm-6">
                                    <input type="email" class="form-control" name="email_id" value="<?php if (isset($_SESSION['email_id'])) echo $_SESSION['email_id']; ?>" placeholder="Enter your email..">
                                    <input type="hidden" value="1" name="store_id"/>
                                </div>

                                <div class="col-md-12">
                                    <textarea class="form-control" name="feedback" placeholder="Give us more details..."></textarea>
                                    <button type="submit" name="feedbacksubmit"  id="submitFeedbackButton" class="btn btn-primary">Submit Feedback</button>
                                </div>
                            </form>
                        </div>
                    </div><!-- end widget -->
                </div>
                <!-- end content -->



                <div class="sidebar col-md-4 col-sm-12">
                    <div class="widget custom-widget clearfix">
                        <a href="user-submit.php">
                            <i class="fa fa-bullhorn alignleft fa-3x"></i>
                            <h4>Go to Flipkart store</h4>
                            <p>Get cashback</p>
                        </a>
                    </div><!-- end widget -->

                    <div class="widget clearfix">
                        <div class="widget-title">
                            <h4><span>Guidelines To Earn reward Points from Flipkart</span></h4>
                        </div>

                        <div class="best-coupons">
                            <ul class="customlist">
                                <li>For shopping with Flipkart, access its online Flipkart using your cashback account (can be made free after signing up at cashback.in)</li>
                                <li><a href="#">44$ off CompanieNamis Discount</a></li>
                                <li><a href="#">10% Discount Coupon from KnowLogoDesign</a></li>
                                <li><a href="#">Free Shipping for All Orders</a></li>
                                <li><a href="#">$5 for for your next logo design</a></li>
                            </ul>
                        </div>
                    </div><!-- end widget -->

                    <!-- <div class="widget clearfix">
                         <div class="featured hidden-xs"><i class="fa fa-star-o"></i></div>
                         <div class="widget-title">
                             <h4><span>Best Stores</span></h4>
                         </div>

                         <div class="text-center store-list row">
                             <div class="col-md-6 col-xs-6">
                                 <div class="post-media">
                                     <a href="coupon-single.php"><img src="uploads/store_01.jpg" alt="" class="img-responsive"></a>
                                     <small>Takifest.com</small>
                                 </div>

                             </div>
                             <div class="col-md-6 col-xs-6">
                                 <div class="post-media">
                                     <a href="coupon-single.php"><img src="uploads/store_02.jpg" alt="" class="img-responsive"></a>
                                     <small>WPServis.com</small>
                                 </div>

                             </div>

                             <div class="col-md-6 col-xs-6">
                                 <div class="post-media">
                                     <a href="coupon-single.php"><img src="uploads/store_03.jpg" alt="" class="img-responsive"></a>
                                     <small>PurplebyBanu.com</small>
                                 </div>

                             </div>

                             <div class="col-md-6 col-xs-6">
                                 <div class="post-media">
                                     <a href="coupon-single.php"><img src="uploads/store_04.jpg" alt="" class="img-responsive"></a>
                                     <small>Tutsplus.com</small>
                                 </div>

                             </div>

                             <div class="col-md-6 col-xs-6">
                                 <div class="post-media">
                                     <a href="coupon-single.php"><img src="uploads/store_05.jpg" alt="" class="img-responsive"></a>
                                     <small>Showwp.com</small>
                                 </div>

                             </div>

                             <div class="col-md-6 col-xs-6">
                                 <div class="post-media">
                                     <a href="coupon-single.php"><img src="uploads/store_06.jpg" alt="" class="img-responsive"></a>
                                     <small>PSDConvertHTML.com</small>
                                 </div>

                             </div>
                         </div>
                     </div>--><!-- end widget -->
                </div><!-- end sidebar -->
            </div><!-- end row -->
            <!-- end ttmenu-content -->
        </div><!-- end container -->
    </div><!-- end section -->
    <div id="footerId"></div>
</div><!-- end wrapper -->

<div class="modal fade login" id="loginModalPlus">
    <div class="modal-dialog login animated" style="width: 600px;">
        <div class="container">
            <div class="row">
                <div class="modal-content">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" id="closebtn" aria-hidden="true">&times;</button>
                            <h4 class="modal-titlePlus">Login with</h4>
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
                                    <div class="alert"></div>
                                    <div class="form loginBoxPlus">
                                        <form method="POST" action="" accept-charset="UTF-8" id="login-form">
                                            <input type="email" class="form-control" placeholder="Email address" name="email" id="email" />
                                            <input id="password" class="form-control" type="password" placeholder="Password" name="password">
                                            <input class="btn btn-default btn-login" type="submit" name="login" value="login" id="btn-login">
                                        </form>
                                        <span class="text-danger"><?php /*if (isset($errormsg)) { echo $errormsg; } */?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="box">
                                <div class="content registerBoxPlus" style="display:none;">
                                    <div class="form">
                                        <form method="post" html="{:multipart=>true}" data-remote="true" action="" accept-charset="UTF-8" id="sign-form">

                                            <input type="text" name="email" placeholder="Email" required class="form-control" />
                                            <span class="text-danger"><?php /*if (isset($email_error)) echo $email_error; */?></span>

                                            <input type="text" name="name" placeholder="Enter Full Name" required class="form-control" />
                                            <span class="text-danger"><?php /*if (isset($name_error)) echo $name_error; */?></span>

                                            <input type="password" name="password" placeholder="Password" required class="form-control" />
                                            <span class="text-danger"><?php /*if (isset($password_error)) echo $password_error; */?></span>

                                            <input type="password" name="cpassword" placeholder="Confirm Password" required class="form-control" />
                                            <span class="text-danger"><?php /*if (isset($cpassword_error)) echo $cpassword_error; */?></span>

                                            <input class="btn btn-default btn-register" type="submit" value="Create account" name="signup">
                                        </form>
                                        <span class="text-success"><?php /*if (isset($successmsg)) { echo $successmsg; } */?></span>
                                        <span class="text-danger"><?php /*if (isset($errormsg)) { echo $errormsg; } */?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="forgot login-footerPlus">
                                <span>Looking to
                                 <a href="javascript: showRegisterForm();">create an account</a>
                            ?</span>
                            </div>
                            <div class="forgot register-footerPlus" style="display:none">
                                <span>Already have an account?</span>
                                <a href="javascript: showLoginForm();">Login</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- ******************************************
/END SITE
********************************************** -->

<!-- ******************************************
DEFAULT JAVASCRIPT FILES
********************************************** -->
<script src="js/all.js"></script>
<script src="js/login-register.js"></script>
<script src="js/custom.js"></script>
<script src="switcher/switcher.js"></script>
<script>
    $(function(){
        $("#headerId").load("header.php");
        $("#footerId").load("footer.php");
    });

    $('document').ready(function() {
        $('#submitFeedbackButton').click( function() {
            alert("ok");
            var data = $('#feedbackform').serialize();
            $.ajax({
                url: 'userfeedback.php',
                type: 'post',
                dataType: 'json',
                data: data,
                success: function(data) {
                    alert("success");
                },
                error: function (error) {
                    alert(error);
                    error.preventDefault();
                },
            });
        });
    });
</script>

</body>

<!-- Mirrored from psdconverthtml.com/live/yourcoupon/coupon-v2/store-single.php by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 09 Jan 2017 19:23:44 GMT -->
</html>
