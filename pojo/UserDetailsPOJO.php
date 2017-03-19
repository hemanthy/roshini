<?php

class UserDetailsPOJO {

	var $usrId;
    var $accountname;
    var $bankname;
    var $banknumber;
    var $ifsccode;
    var $availableamount;
    var $paytmnumber;
    var $ispaytmactive;
    var $paymentRequestedAmount;
    var $pendingBal;
    var $redemptionMade;
    var $paymentReqStatus;
    var $paymentReqDate;
    var $orderDate;
    var $storeName;
    var $cashback;
    var $status;
    var $userReferenceCode;
    var $paymentMode;
    
    /**
     *
     * @return the unknown_type
     */
    public function getUsrId() {
    	return $this->usrId;
    }
    
    /**
     *
     * @param unknown_type $usrId
     */
    public function setUsrId($usrId) {
    	$this->usrId = $usrId;
    	return $this;
    }
    
    

    /**
     * @return mixed
     */
    public function getAccountname()
    {
        return $this->accountname;
    }

    /**
     * @param mixed $accountname
     */
    public function setAccountname($accountname)
    {
        $this->accountname = $accountname;
    }

    /**
     * @return mixed
     */
    public function getBankname()
    {
        return $this->bankname;
    }

    /**
     * @param mixed $bankname
     */
    public function setBankname($bankname)
    {
        $this->bankname = $bankname;
    }

    /**
     * @return mixed
     */
    public function getBanknumber()
    {
        return $this->banknumber;
    }

    /**
     * @param mixed $banknumber
     */
    public function setBanknumber($banknumber)
    {
        $this->banknumber = $banknumber;
    }

    /**
     * @return mixed
     */
    public function getIfsccode()
    {
        return $this->ifsccode;
    }

    /**
     * @param mixed $ifsccode
     */
    public function setIfsccode($ifsccode)
    {
        $this->ifsccode = $ifsccode;
    }

    /**
     * @return mixed
     */
    public function getAvailableamount()
    {
        return $this->availableamount;
    }

    /**
     * @param mixed $availableamount
     */
    public function setAvailableamount($availableamount)
    {
        $this->availableamount = $availableamount;
    }
	
	/**
	 *
	 * @return the unknown_type
	 */
	public function getPaytmnumber() {
		return $this->paytmnumber;
	}
	
	/**
	 *
	 * @param unknown_type $paytmnumber        	
	 */
	public function setPaytmnumber($paytmnumber) {
		$this->paytmnumber = $paytmnumber;
		return $this;
	}
	
	/**
	 *
	 * @return the unknown_type
	 */
	public function getIspaytmactive() {
		return $this->ispaytmactive;
	}
	
	/**
	 *
	 * @param unknown_type $ispaytmactive        	
	 */
	public function setIspaytmactive($ispaytmactive) {
		$this->ispaytmactive = $ispaytmactive;
		return $this;
	}
	
	/**
	 *
	 * @return the unknown_type
	 */
	public function getPaymentRequestedAmount() {
		return $this->paymentRequestedAmount;
	}
	
	/**
	 *
	 * @param unknown_type $paymentRequestedAmount        	
	 */
	public function setPaymentRequestedAmount($paymentRequestedAmount) {
		$this->paymentRequestedAmount = $paymentRequestedAmount;
		return $this;
	}
	
	/**
	 *
	 * @return the unknown_type
	 */
	public function getPaymentReqStatus() {
		return $this->paymentReqStatus;
	}
	
	/**
	 *
	 * @param unknown_type $paymentReqStatus        	
	 */
	public function setPaymentReqStatus($paymentReqStatus) {
		$this->paymentReqStatus = $paymentReqStatus;
		return $this;
	}
	
	/**
	 *
	 * @return the unknown_type
	 */
	public function getPaymentReqDate() {
		return $this->paymentReqDate;
	}
	
	/**
	 *
	 * @param unknown_type $paymentReqDate        	
	 */
	public function setPaymentReqDate($paymentReqDate) {
		$this->paymentReqDate = $paymentReqDate;
		return $this;
	}
	
	/**
	 *
	 * @return the unknown_type
	 */
	public function getOrderDate() {
		return $this->orderDate;
	}
	
	/**
	 *
	 * @param unknown_type $orderDate        	
	 */
	public function setOrderDate($orderDate) {
		$this->orderDate = $orderDate;
		return $this;
	}
	
	/**
	 *
	 * @return the unknown_type
	 */
	public function getStoreName() {
		return $this->storeName;
	}
	
	/**
	 *
	 * @param unknown_type $storeName        	
	 */
	public function setStoreName($storeName) {
		$this->storeName = $storeName;
		return $this;
	}
	
	/**
	 *
	 * @return the unknown_type
	 */
	public function getCashback() {
		return $this->cashback;
	}
	
	/**
	 *
	 * @param unknown_type $cashback        	
	 */
	public function setCashback($cashback) {
		$this->cashback = $cashback;
		return $this;
	}
	
	/**
	 *
	 * @return the unknown_type
	 */
	public function getStatus() {
		return $this->status;
	}
	
	/**
	 *
	 * @param unknown_type $status        	
	 */
	public function setStatus($status) {
		$this->status = $status;
		return $this;
	}
	
	/**
	 *
	 * @return the unknown_type
	 */
	public function getUserReferenceCode() {
		return $this->userReferenceCode;
	}
	
	/**
	 *
	 * @param unknown_type $userReferenceCode        	
	 */
	public function setUserReferenceCode($userReferenceCode) {
		$this->userReferenceCode = $userReferenceCode;
		return $this;
	}
	
	/**
	 *
	 * @return the unknown_type
	 */
	public function getPendingBal() {
		return $this->pendingBal;
	}
	
	/**
	 *
	 * @param unknown_type $pendingBal        	
	 */
	public function setPendingBal($pendingBal) {
		$this->pendingBal = $pendingBal;
		return $this;
	}
	
	/**
	 *
	 * @return the unknown_type
	 */
	public function getRedemptionMade() {
		return $this->redemptionMade;
	}
	
	/**
	 *
	 * @param unknown_type $redemptionMade        	
	 */
	public function setRedemptionMade($redemptionMade) {
		$this->redemptionMade = $redemptionMade;
		return $this;
	}
	
	/**
	 *
	 * @return the unknown_type
	 */
	public function getPaymentMode() {
		return $this->paymentMode;
	}
	
	/**
	 *
	 * @param unknown_type $paymentMode        	
	 */
	public function setPaymentMode($paymentMode) {
		$this->paymentMode = $paymentMode;
		return $this;
	}
    
}
?>