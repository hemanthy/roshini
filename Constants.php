<?php

/**
 * Created by PhpStorm.
 * User: heman
 * Date: 2/9/2017
 * Time: 6:49 PM
 */
class Constants
{

    // Incorrect Email or Password!!!
    const INCORRECT_EMAIL_OR_PASSWORD  = 'INCORRECT_EMAIL_OR_PASSWORD';

    // CONGRATULATION REGISTRATION SUCCESSFUL
    const REGISTRATION_SUCCESSFUL  = 'REGISTRATION_SUCCESSFUL';

    // Password and Confirm Password doesn't match
    const PASSWORD_CONFIRM_PASSWORD_DOESNOT_MATCH = 'PASSWORD_CONFIRM_PASSWORD_DOESNOT_MATCH';

    // Password Changed Successfully
    const PASSWORD_CHANGED_SUCCESSFULLY = 'PASSWORD_CHANGED_SUCCESSFULLY';

    // LOGIN SUCCESS,
    const LOGIN_SUCCESS = 'LOGIN_SUCCESS';

    // Email ID already exists
    const EMAIL_ALREADY_EXISTS = 'EMAIL_ALREADY_EXISTS';
    
    // Email ID Not Found
    const EMAIL_NOT_FOUND = 'EMAIL_NOT_FOUND';
    
    const ERROR_LOG_PATH = 'C:\xampp\php\logs\error.logs';
    
    

    function showConstant() {
        echo  self::CONSTANT . "\n";
    }

}

define('DIR','http://specialcashback.000webhostapp.com/');
define('SITEEMAIL','noreply@specialcashback.000webhostapp.com');
define ('ERROR_LOG_PATH', 'C:\xampp\php\logs\error.logs');