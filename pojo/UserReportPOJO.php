<?php

/**
 * Created by PhpStorm.
 * User: heman
 * Date: 2/24/2017
 * Time: 10:31 PM
 */
class UserReportPOJO
{

    var $orderDate;
    var $storeName;
    var $cashback;
    var $status;
    var $userReferenceCode;

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
    public function getStoreName()
    {
        return $this->storeName;
    }

    /**
     * @param mixed $storeName
     */
    public function setStoreName($storeName)
    {
        $this->storeName = $storeName;
    }

    /**
     * @return mixed
     */
    public function getCashback()
    {
        return $this->cashback;
    }

    /**
     * @param mixed $cashback
     */
    public function setCashback($cashback)
    {
        $this->cashback = $cashback;
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
    public function getUserReferenceCode()
    {
        return $this->userReferenceCode;
    }

    /**
     * @param mixed $userReferenceCode
     */
    public function setUserReferenceCode($userReferenceCode)
    {
        $this->userReferenceCode = $userReferenceCode;
    }

}