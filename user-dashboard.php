<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from psdconverthtml.com/live/yourcoupon/coupon-v2/user-dashboard.php by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 09 Jan 2017 19:25:52 GMT -->
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


    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.16/angular.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.16/angular-touch.js"></script>
    <!--   <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.16/angular-animate.js"></script>
    <script src="http://ui-grid.info/docs/grunt-scripts/pdfmake.js"></script>
     <script src="http://ui-grid.info/docs/grunt-scripts/vfs_fonts.js"></script>  -->
    <script src="http://ui-grid.info/release/ui-grid-unstable.js"></script>
    <link rel="stylesheet" href="http://ui-grid.info/release/ui-grid-unstable.css" type="text/css">



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
<body ng-app="app"  ng-controller="MainCtrl">

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
                <p>This is an subtitle for dashboard page..</p>
                <h3>Dashboard</h3>
            </div><!-- end title -->
            <div class="pull-right hidden-xs">
                <div class="bread">
                    <ol class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li class="active">{{selectedtabname}}</li>
                    </ol>
                </div><!-- end bread -->
            </div><!-- /.pull-right -->
        </div>
    </section><!-- end section -->

    <div class="section" ng-init="initTabValue()">
        <div class="container">
            <div class="row">
                <div class="sidebar col-md-4">
                    <div class="widget clearfix">
                        <ul class="nav nav-pills nav-stacked">
                            <li ng-class="tabs.selectedTab == 1 ? 'active' : ''">
                                <a  href="#" ng-click="tabChanged(1);"><span class="glyphicon glyphicon-off"></span>  Dashboard</a>
                            </li>
                            <li ng-class="tabs.selectedTab == 2 ? 'active' : ''">
                                <a  href="#" ng-click="tabChanged(2);"><span class="fa fa-heart-o"></span>  My Wallet</a>
                            </li>
                            <li ng-class="tabs.selectedTab == 3 ? 'active' : ''">
                                <a  href="#" ng-click="tabChanged(3);"><span class="fa fa-heart-o"></span>  Bank Details</a>
                            </li>
                            <li ng-class="tabs.selectedTab == 4 ? 'active' : ''">
                                <a  href="#" ng-click="tabChanged(4);"><span class="fa fa-heart-o"></span>  Withdraw</a>
                            </li>
                            <!-- <li ng-class="tabs.selectedTab === 4 ? 'active' : ''">
                                 <a  href="#" ng-click="tabChanged(4);"><span class="fa fa-heart-o"></span>  Missing Cashback</a>
                             </li>
                             <li><a href="user-favorites.php"><span class="fa fa-star"></span>  Favorite Stores</a></li>
                             <li><a href="user-submit.php"><span class="fa fa-bullhorn"></span>  Submit a Coupon</a></li>-->
                            <li><a href="logout.php"><span class="fa fa-lock"></span>  Logout</a></li>
                        </ul>
                    </div><!-- end widget -->
                </div><!-- end col -->

                <div class="sidebar col-md-8" ng-show="tabs.selectedTab == 1">
                    <div class="widget clearfix">

                        <form id="uploadimage" class="contact-form newsletter" action="" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <label class="control-label">Your Photo <small>Please add a photo. (200x200)</small></label>
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-preview thumbnail"><img src="uploads/testi_03.png" alt=""></div>
                                        <br>
                                        <span class="btn btn-default btn-file">
                                            <span class="fileupload-new">Select Avatar</span>
                                            <span class="fileupload-exists">Change Avatar</span>
											<input type="file" name="fileToUpload" id="fileToUpload">
											</span>
                                        <input class="btn btn-primary" type="submit" class="fileupload-new fileupload-exists" value="Upload Image" name="submit"/>
                                        <!--<a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload"><i class="fa fa-close"></i></a>-->
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->

                            <hr class="invis3">

                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label class="control-label">Your Name</label>
                                    <input type="text" class="form-control" value="<?php if (isset($_SESSION['usr_name'])) echo $_SESSION['usr_name']; ?>" disabled>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <label class="control-label">Your Email Id</label>
                                    <input type="email" class="form-control" value="<?php if (isset($_SESSION['email_id'])) echo $_SESSION['email_id']; ?>" disabled>
                                </div>

                                <!-- <div class="col-md-6 col-sm-12">
                                     <label class="control-label">Facebook URL <small>Enter your Facebook url</small></label>
                                     <input type="text" class="form-control" placeholder="http://facebook.com/psdconverthtml">
                                 </div>

                                 <div class="col-md-6 col-sm-12">
                                     <label class="control-label">Twitter URL <small>Enter your Twitter url</small></label>
                                     <input type="email" class="form-control" placeholder="http://twitter.com/psdconverthtml">
                                 </div>

                                 <div class="col-md-6 col-sm-12">
                                     <label class="control-label">Google+ URL <small>Enter your Google+ url</small></label>
                                     <input type="text" class="form-control" placeholder="http://plus.google.com/+psdconverthtml">
                                 </div>

                                 <div class="col-md-6 col-sm-12">
                                     <label class="control-label">Linkedin URL <small>Enter your Linkedin url</small></label>
                                     <input type="email" class="form-control" placeholder="http://linkedin.com/u/psdconverthtml">
                                 </div>
                                 <div class="col-md-12 col-sm-12">
                                     <button class="btn btn-primary">Update Profile</button>
                                 </div> -->
                            </div>
                        </form>

                        <hr class="invis3">
                        <form  method="POST" method="post" html="{:multipart=>true}" data-remote="true" action="" accept-charset="UTF-8" id="changepasswordform" class="contact-form newsletter">
                            <div class="row">
                                <div class="passwordchange"></div>
                                <div class="col-md-6 col-sm-12">
                                    <label class="control-label">New Password <small>Enter new password</small></label>
                                    <input type="password" class="form-control" placeholder="" name="password">
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label class="control-label">Re-New Password <small>Re-Enter new password</small></label>
                                    <input class="form-control" type="password" placeholder="" name="cpassword">
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <button class="btn btn-primary" type="submit" name="changepassword">Change Password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- end content -->
                <div class="sidebar col-md-8" ng-show="tabs.selectedTab == 2">
                    <div class="coupon-list list-wrapper">
                        <div class="coupon-wrapper">
                            <div class="row tile_count">
                                <div class="col-md-3 col-sm-3 col-xs-12 tile_stats_count no_left_border">
                                    <span class="count_top"><i class="fa fa-user"></i> Available Balance</span>
                                    <div class="count green">{{availableamount}}</div>
                                    <!--<span class="count_bottom"><i class="green">4% </i> From last Week</span>-->
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12 tile_stats_count">
                                    <span class="count_top"><i class="fa fa-user"></i> Pending Balance</span><!-- (availableamount > 100) -->
                                    <div class="count blue">{{pendingBal}}</div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12 tile_stats_count">
                                    <span class="count_top"><i class="fa fa-user"></i> Redemption Made</span>
                                    <div class="count light_green">{{redemptionMade}}</div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12 tile_stats_count">
                                    <span class="count_top"><i class="fa fa-user"></i> Redemption Applied</span>
                                    <div class="count">{{paymentRequestedAmount}}</div>
                                </div>
                            </div><!-- end row -->
                        </div><!-- end coupon-wrapper -->
                    </div><!-- end coupon list -->
                    <div class="coupon-tab post-wrapper nopadtop clearfix">
                        <div ui-grid="gridOptions" ui-grid-edit ui-grid-cellnav  class="grid"></div>
                    </div>
                </div>
                <div class="sidebar col-md-8" ng-show="tabs.selectedTab == 3">
                    <div class="coupon-tab post-wrapper nopadtop clearfix">
                    <hr class="invis3">
	                    <h3>Please Select your Payment Method</h3>
	                    <input type="radio" ng-model="paymentdetails.ispaytmactive" value="0"> Bank
	  					<input type="radio" ng-model="paymentdetails.ispaytmactive" value="1"> Paytm
                    </div>
                    
                     <hr class="invis3">
                    <div class="sidebar col-md-12">
                        <div class="widget clearfix">
                         <div class="bankdetailsinfo"></div>
                           <form id="submit" class="contact-form newsletter" ng-submit="savePaymentDetails()">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12"  ng-show="paymentdetails.ispaytmactive == 0">
                                        <label class="control-label">Account Name</label>
                                        <input type="text" class="form-control" ng-model="paymentdetails.accountname" placeholder="Enter your account name">

                                        <hr class="invis3">

                                        <label class="control-label">Bank Name</label>
                                        <input type="text" class="form-control"  ng-model="paymentdetails.bankname" placeholder="Enter your bank name">

                                        <hr class="invis3">

                                        <label class="control-label">Bank Account Number</label>
                                        <input type="text" class="form-control"  ng-model="paymentdetails.banknumber" placeholder="Enter your account number">

                                        <hr class="invis3">

                                        <label class="control-label">IFSC Code</label>
                                        <input type="text" class="form-control"  ng-model="paymentdetails.ifsccode" placeholder="Enter IFSC code">

                                        <hr class="invis3">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                     <div class="col-md-12 col-sm-12" ng-show="paymentdetails.ispaytmactive == 1">
                                      	<label class="control-label">Paytm Number</label>
                                        <input type="text" class="form-control"  ng-model="paymentdetails.paytmnumber" placeholder="Enter Paytm Number">
                                        
                                          <hr class="invis3">
                                          <button type="submit" class="btn btn-primary">Submit</button>
                                     </div>
                                </div>
                            </form>
                        </div><!-- end post-wrapper -->
                </div>

                </div>

                <div class="sidebar col-md-8" ng-show="tabs.selectedTab == 4">
                    <div class="sidebar col-md-12">
                        <div class="withdrawinfo"></div>
                        <div class="widget clearfix">
                            <div class="alert alert-success">
                                <strong>Total Available Amount : INR {{availableamount}} /- </strong> as of {{ today | date  : "dd.MM.y"}}
                            </div>
                            <form id="submit" class="contact-form newsletter" ng-submit="saveWithdrawRequest()">
                                <div class="row" ng-show="(availableamount > 100)">
                                    <div class="col-md-6 col-sm-6">
                                        <label class="control-label">Withdraw Amount</label>
                                        <input type="number" ng-model="withdrawAmount" class="form-control" placeholder="Enter Withdraw Amount">
                                    </div>

                                    <div class="col-md-6 col-sm-6">
                                        <label class="control-label">Bank Details</label>
                                        <input type="text"  class="form-control" value = "{{accountname}} - {{banknumber}}" disabled="disabled" ng-show="(ispaytmactive==0)">
                                        <input type="text"  class="form-control" value = "paytm - {{paytmnumber}}" disabled="disabled" ng-show="(ispaytmactive==1)">
                                    </div>
                                    <hr class="invis3">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                                <div class="row" ng-show="!(availableamount > 100)">
                                    <h4>You must earn at least Rs.100.00 before you can request a payment.</h4>
                                </div>
                            </form>
                        </div>

                       <div class="widget clearfix" ng-show="userHistory" id="userHistory">
                            <div class="coupon-tab nopadtop clearfix">
							<table id="showcashbacktableid" class="table table-sm table-striped table-bordered table-hover table-responsive">
								<thead class="thead-inverse">
								<tr>
									<th>Payment Request Amount</th>
									<th>Status</th>
									<th>Payment Request Date</th>
									<!-- <th>Payment Reference</th> -->
									<th>Payment Mode</th>
								</tr>
								</thead>
								<tbody>
									<tr ng-repeat="x in userHistory">
										<td>{{x.paymentRequestedAmount}}</td>
										<td>{{x.paymentReqStatus}}</td>
										<td>{{x.paymentReqDate}}</td>
										<!-- <td>{{x.paymentMode}}</td> -->
										<td>{{x.paymentMode}}</td>
									</tr>
								</tbody>
							</table>
						
                               <!-- <div ui-grid="userTransactionHistoryGridOptions" ui-grid-edit ui-grid-cellnav  class="grid"></div> -->
                            </div>
                        </div>

                        </div>
                    <!--<div class="coupon-tab post-wrapper nopadtop clearfix">
                        <div ui-grid="userTransactionHistoryGridOptions" ui-grid-edit ui-grid-cellnav  class="grid"></div>
                    </div>-->
                </div>
                <!-- end content -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end section -->

    <div id="footerId"></div>
</div><!-- end wrapper -->

<!-- ******************************************
/END SITE
********************************************** -->

<!-- ******************************************
DEFAULT JAVASCRIPT FILES
********************************************** -->
<script src="js/all.js"></script>
<script src="js/js-validate.js"></script>
<script src="js/custom.js"></script>

<script src="switcher/switcher.js"></script>
<script src="js/app.js"></script>
<script>
    $(function(){
        $("#headerId").load("header.php");
        $("#footerId").load("footer.php");
    });
</script>

<script>
    $('document').ready(function()
    {
        /*  change password submit*/
        $("#changepasswordform").validate({
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
                },
            messages:
                {
                    password:{
                        required: "please enter your password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                    cpassword:{
                        required: "please enter your confirm password"
                    },

                },
            submitHandler: passwordChangeForm
        });

        /* change password submit */
        function passwordChangeForm()
        {
            var data = $("#changepasswordform").serialize();
            $.ajax({

                type : 'POST',
                url  : 'changepassword.php',
                data : data,
                beforeSend: function()
                {
                    $("#error").fadeOut();
                    //$("#btn-login").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...');
                },
                success :  function(response)
                {
                    if(response=='PASSWORD_CHANGED_SUCCESSFULLY'){
                        $('.passwordchange').addClass('alert alert-success').html('Password Changed Successfully');
                        // alert('PASSWORD_CHANGED_SUCCESSFULLY');
                    }else if(response=='PASSWORD_CONFIRM_PASSWORD_DOESNOT_MATCH'){
                        $('.passwordchange').addClass('alert alert-danger').html('Password and Confirm Password Does not Match');
                    }
                    setTimeout( function(){
                        $('.passwordchange').addClass('alert alert-success').html('');
                        $('.passwordchange').addClass('alert alert-danger').html('');
                        $('.passwordchange').removeClass('alert alert-success');
                        $('.passwordchange').removeClass('alert alert-danger');
                    }, 5000 );
                    //shakeModal(config.get(response));
                }
            });
            return false;
        }


        $("#uploadimage").on('submit',(function(e) {
            e.preventDefault();
            //		$("#message").empty();
            //		$('#loading').show();
            $.ajax({
                url: "uploadimage.php", // Url to which the request is send
                type: "POST",             // Type of request to be send, called as method
                data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                contentType: false,       // The content type used when sending data to the server.
                cache: false,             // To unable request pages to be cached
                processData:false,        // To send DOMDocument or non processed data file it is set to false
                success: function(data)   // A function to be called if request succeeds
                {
                    alert("success::"+data);
                    //	$('#loading').hide();
                    //	$("#message").html(data);
                }
            });
        }));


    });
</script>



<style>
    .grid {
        height: auto;
    }

    .fileupload-preview img {
        width: 200px;
        height: 200px;
    }

    .tabs div{
        background-color:rgb(0,188,212);padding:5px 10px 5px 10px;
        cursor: pointer;

        overflow: hidden;    font-size: 14px;
        text-align: center;display:inline;
    }
    .error {
        color : red;
    }
	
	#userHistory #showcashbacktableid td{
	  font-weight: normal;
	}
	
	#showcashbacktableid {
		
	}


</style>
</body>
</html>