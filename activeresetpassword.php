<?php
//require('includes/config.php');
require('dbconnect.php');
require('Constants.php');
include_once 'writemysqllog.php';

//collect values from the url

$error = '';

if (isset($_GET['a']) && isset($_GET['b'])) {
	
	$resetToken = trim($_GET['a']);
	$email = trim($_GET['b']);
	
	//if id is number and the active token is not empty carry on
	if(!empty($resetToken) && !empty($email)){
	
	
		$stmt = $conn->prepare("select * from user WHERE email =:email and resetComplete = 'Yes' and resetToken is null");
		$stmt->execute(array(
				':email' => $email
		));
	
	
		if($stmt->rowCount() == 1){
			$error = false;
			echo "You have already reset your password";
			exit;
	
		}
		
		$stmt = $conn->prepare("select * from user WHERE email =:email and resetComplete = 'No' and resetToken =:resetToken ");
		$stmt->execute(array(
				':email' => $email,
				':resetToken' => $resetToken
		));
		
		
		if($stmt->rowCount() == 0){
			$error = false;
			echo "You have not authorized to reset the password. Please reset your password once again !!!";
			exit;
		}
		
	}
}

try{

	$msg = '';

	if (isset($_POST['cpassword'])) {

		$password = mysqli_real_escape_string($con, $_POST['password']);
		$cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);

		if($password != $cpassword) {
			$msg = Constants::PASSWORD_CONFIRM_PASSWORD_DOESNOT_MATCH;
		}else{
				
			
			
			//update users record set the active column to Yes where the memberID and active value match the ones provided in the array
			$stmt = $conn->prepare("UPDATE user SET resetComplete = 'Yes', resetToken = null WHERE resetToken =:resetToken");
			$stmt->execute(array(
					':resetToken' => $resetToken
			));

			//if the row was updated redirect the user
			if($stmt->rowCount() == 1){
				echo "success";

				//$email = $_SESSION['email_id'];
				$stmt1 = $conn->prepare("update user set password =:password where email =:email;");
				$stmt1->bindParam(':password',md5($password) , PDO::PARAM_STR);
				$stmt1->bindParam(':email',$email , PDO::PARAM_STR);
				$result = $stmt1->execute();
				if($result){
					$msg = Constants::PASSWORD_CHANGED_SUCCESSFULLY;
				}

				exit;
					
			} else {
				echo "Your reset password not successful.";
				exit;
			}
				
				
		}


		echo $msg;
	}
}
catch(PDOException $e)
{
	write_mysql_log($e->getMessage(),$conn);
}


?>


 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
    	.separator {
    border-right: 1px solid #dfdfe0; 
}
.icon-btn-save {
    padding-top: 0;
    padding-bottom: 0;
}
.input-group {
    margin-bottom:10px; 
}
.btn-save-label {
    position: relative;
    left: -12px;
    display: inline-block;
    padding: 6px 12px;
    background: rgba(0,0,0,0.15);
    border-radius: 3px 0 0 3px;
}
    </style>
</head>
<body>

<div class="container bootstrap snippet">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-2">
            <div class="panel panel-info">
            <form class="form-inline" action="" accept-charset="UTF-8" method="post" name="resetpassword" id="resetpassword">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="glyphicon glyphicon-th"></span>
                        Change password   
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6 separator social-login-box"> <br>
                           <img alt="" class="img-thumbnail" src="http://bootdey.com/img/Content/avatar/avatar1.png">                        
                        </div>
                        <div style="margin-top:80px;" class="col-xs-6 col-sm-6 col-md-6 login-box">
                         <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                              <input class="form-control" type="password"  name = "password" placeholder="New Password">
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                              <input class="form-control" type="password" name = "cpassword" placeholder="Re-enter Password">
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6"></div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <button class="btn icon-btn-save btn-success" type="submit">
                            <span class="btn-save-label"><i class="glyphicon glyphicon-floppy-disk"></i></span>save</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script type="text/javascript">
	
</script>
</body>
</html>