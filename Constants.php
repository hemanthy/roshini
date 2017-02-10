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

    // LOGIN SUCCESS,
    const LOGIN_SUCCESS = 'LOGIN_SUCCESS';

    // Email ID already exists
    const EMAIL_ALREADY_EXISTS = 'EMAIL_ALREADY_EXISTS';

    function showConstant() {
        echo  self::CONSTANT . "\n";
    }

}
