<?php

include_once ('dbconnect.php');

//$url ='https://affiliate-api.flipkart.net/affiliate/api/allgadget.json';
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


// Execute
$result=curl_exec($ch);

// Check HTTP status code
if (!curl_errno($ch)) {
    switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
        case 200:  # OK
            break;
        case 410:  # Gone
            echo 'URL expired';
            break;
        case 401:  # Unauthorized
            echo 'API Token or Affiliate Tracking ID invalid';
            break;
        case 403:  # Forbidden
            echo 'Tampered URL - The URL contents are modified from the originally returned value';
            break;
        case 400:  # Bad Request
            echo 'The request could not be understood by the server due to malformed syntax';
            break;
        case 404:  # Not Found
            echo 'The webpage you were trying to reach could not be found on the server';
            break;
        default:
            echo 'Unexpected HTTP code: ', $http_code, "\n";
    }
}
// Closing
curl_close($ch);
return $result;
//echo $result;
// Will dump a beauty json :3
//$resJson = var_dump(json_decode($result, false));
//echo var_dump($result -> orderList);
?>