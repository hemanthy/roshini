<?php

/**
 * Created by PhpStorm.
 * User: heman
 * Date: 2/16/2017
 * Time: 10:54 AM
 */
class FlipkartOrderDetailsPOJO
{
 var $price;
 var $category;
 var $title;
 var $productId;
 var $quantity;
 var $salesAmount;
 var $status;
 var $affiliateOrderItemId;
 var $orderDate;
 var $commissionRate;
 var $tentativeCommission;
 var $affExtParam1;
 var $affExtParam2;
 var $salesChannel;
 var $customerType;

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }


}