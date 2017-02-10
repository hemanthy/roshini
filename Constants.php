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
    const INCORRECT_EMAIL_OR_PASSWORD  = '1';

    // CONGRATULATION REGISTRATION SUCCESSFUL
    const REGISTRATION_SUCCESSFUL  = '2';

    // Password and Confirm Password doesn't match
    const PASSWORD_CONFIRM_PASSWORD_DOESNOT_MATCH = '3';

    // LOGIN SUCCESS,
    const LOGIN_SUCCESS = '4';

    // Email ID already exists
    const EMAIL_ALREADY_EXISTS = '5';

    function showConstant() {
        echo  self::CONSTANT . "\n";
    }

}

