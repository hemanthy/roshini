<?php
/**
 * Created by PhpStorm.
 * User: heman
 * Date: 2/15/2017
 * Time: 4:57 PM
 */

include_once ('proxy.php');

$res = getJsonData();

$res1 = json_decode($res,true);

if($res!=null && !empty($res) && isset( $res['first'])){
echo 'hi';
}

?>