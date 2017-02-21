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

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @param mixed $productId
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return mixed
     */
    public function getSalesAmount()
    {
        return $this->salesAmount;
    }

    /**
     * @param mixed $salesAmount
     */
    public function setSalesAmount($salesAmount)
    {
        $this->salesAmount = $salesAmount;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getAffiliateOrderItemId()
    {
        return $this->affiliateOrderItemId;
    }

    /**
     * @param mixed $affiliateOrderItemId
     */
    public function setAffiliateOrderItemId($affiliateOrderItemId)
    {
        $this->affiliateOrderItemId = $affiliateOrderItemId;
    }

    /**
     * @return mixed
     */
    public function getOrderDate()
    {
        return $this->orderDate;
    }

    /**
     * @param mixed $orderDate
     */
    public function setOrderDate($orderDate)
    {
        $this->orderDate = $orderDate;
    }

    /**
     * @return mixed
     */
    public function getCommissionRate()
    {
        return $this->commissionRate;
    }

    /**
     * @param mixed $commissionRate
     */
    public function setCommissionRate($commissionRate)
    {
        $this->commissionRate = $commissionRate;
    }

    /**
     * @return mixed
     */
    public function getTentativeCommission()
    {
        return $this->tentativeCommission;
    }

    /**
     * @param mixed $tentativeCommission
     */
    public function setTentativeCommission($tentativeCommission)
    {
        $this->tentativeCommission = $tentativeCommission;
    }

    /**
     * @return mixed
     */
    public function getAffExtParam1()
    {
        return $this->affExtParam1;
    }

    /**
     * @param mixed $affExtParam1
     */
    public function setAffExtParam1($affExtParam1)
    {
        $this->affExtParam1 = $affExtParam1;
    }

    /**
     * @return mixed
     */
    public function getAffExtParam2()
    {
        return $this->affExtParam2;
    }

    /**
     * @param mixed $affExtParam2
     */
    public function setAffExtParam2($affExtParam2)
    {
        $this->affExtParam2 = $affExtParam2;
    }

    /**
     * @return mixed
     */
    public function getSalesChannel()
    {
        return $this->salesChannel;
    }

    /**
     * @param mixed $salesChannel
     */
    public function setSalesChannel($salesChannel)
    {
        $this->salesChannel = $salesChannel;
    }

    /**
     * @return mixed
     */
    public function getCustomerType()
    {
        return $this->customerType;
    }

    /**
     * @param mixed $customerType
     */
    public function setCustomerType($customerType)
    {
        $this->customerType = $customerType;
    }



}