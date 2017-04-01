<?php

include ('dbconnect.php');
// require_once __DIR__ . '/mylogger.php';

// status: Order status. Possible values - tentative, approved, cancelled, disapproved
//$url ='https://affiliate-api.flipkart.net/affiliate/api/allgadget.json'; //tentative // approved
$url ='https://affiliate-api.flipkart.net/affiliate/report/orders/detail/json?startDate=2015-10-22&endDate=2017-11-22&status=approved&offset=0';
//  Initiate curl
$ch = curl_init();
// Disable SSL verification
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Will return the response, if false it print the response
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Set the url
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('fk-affiliate-token: f941e35543c94288b0e26ccd98e135cf','fk-affiliate-id: allgadget'));

error_log("url : " .$url);
//$cronlog -> info("url :".$url);

syslog(0, "...........");

// Execute
$result=curl_exec($ch);

// Check HTTP status code
if (!curl_errno($ch)) {
    switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
        case 200:  # OK
        	//$cronlog -> info("status code : 200");
        	error_log("status code : 200");
            break;
        case 410:  # Gone
        	//$cronlog -> error("status code : 410 - URL Expired");
        	error_log("status code : 410 - URL Expired");
            echo 'URL expired';
            break;
        case 401:  # Unauthorized
        //	$cronlog -> error("status code : 401 - Unauthorized OR API Token or Affiliate Tracking ID invalid");
        	error_log("status code : 401 - Unauthorized OR API Token or Affiliate Tracking ID invalid");
            echo 'API Token or Affiliate Tracking ID invalid';
            break;
        case 403:  # Forbidden
      //  	$cronlog -> error("status code : 403 - Forbidden OR Tampered URL - The URL contents are modified from the originally returned value");
        	error_log("status code : 403 - Forbidden OR Tampered URL - The URL contents are modified from the originally returned value");
            echo 'Tampered URL - The URL contents are modified from the originally returned value';
            break;
        case 400:  # Bad Request
        //	$cronlog -> error("status code : 400 - Bad Request OR The request could not be understood by the server due to malformed syntax");
        	error_log("status code : 400 - Bad Request OR The request could not be understood by the server due to malformed syntax");
            echo 'The request could not be understood by the server due to malformed syntax';
            break;
        case 404:  # Not Found
        //	$cronlog -> error("status code : 404 - Not Found OR The url you were trying to reach could not be found on the server");
        	error_log("status code : 404 - Not Found OR The url you were trying to reach could not be found on the server");
            echo 'The url you were trying to reach could not be found on the server';
            break;
        default:
        //	$cronlog -> error("Unexpected HTTP code: ".$http_code);
        	error_log("Unexpected HTTP code: ".$http_code);
            echo 'Unexpected HTTP code: ', $http_code, "\n";
    }
}
// Closing
curl_close($ch);
//$cronlog -> info($result);
error_log("result json : ".$result);
return $result;
//echo $result;
// Will dump a beauty json :3
//$resJson = var_dump(json_decode($result, false));
//echo var_dump($result -> orderList);
?>