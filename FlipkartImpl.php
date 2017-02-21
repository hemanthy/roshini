<?php
/**
 * Created by PhpStorm.
 * User: heman
 * Date: 2/15/2017
 * Time: 4:57 PM
 */

include_once ('proxy.php');


$jsonObj = json_decode($result);
// access first element of $ar array
$ar = json_decode($result,true);
$flipkartDetailArray = array();

//array_push($flipkartDetailArray,$flipkartPojo);

if($ar!=null && !empty($ar) && count($ar) > 0 && count($ar['orderList']) > 0){

    foreach($jsonObj -> orderList as $mydata){
        echo $mydata->sales -> amount . "\n\r";
        $flipkartPojo = new FlipkartOrderDetailsPOJO();
        $flipkartPojo -> setPrice($mydata->price);
        $flipkartPojo -> setCategory($mydata->category);
        $flipkartPojo -> setTitle($mydata->title);
        $flipkartPojo -> setProductId($mydata->productId);
        $flipkartPojo -> setQuantity($mydata->quantity);
        $flipkartPojo -> setSalesAmount($mydata->sales -> amount);
        $flipkartPojo -> setStatus($mydata->status);
        $flipkartPojo -> setAffiliateOrderItemId($mydata->affiliateOrderItemId);
        $flipkartPojo -> setOrderDate($mydata->orderDate);
        $flipkartPojo -> setCommissionRate($mydata->commissionRate);
        $flipkartPojo -> setTentativeCommission($mydata->tentativeCommission -> amount);
        $flipkartPojo -> setAffExtParam1($mydata->affExtParam1);
        $flipkartPojo -> setAffExtParam2($mydata->affExtParam2);
        $flipkartPojo -> setSalesChannel($mydata->salesChannel);
        $flipkartPojo -> setCustomerType($mydata->customerType);
        array_push($flipkartDetailArray,$flipkartPojo);
    }
}

foreach ($flipkartDetailArray as $obj) {
    echo ".......".$obj-> salesAmount;
}

?>