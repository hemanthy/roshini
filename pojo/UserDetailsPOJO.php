<?php

class UserDetailsPOJO {

    var $accountname;
    var $bankname;
    var $banknumber;
    var $ifsccode;
    var $availableamount;
    var $paytmnumber;
    var $ispaytmactive;
    var $paymentRequestedAmount;
    var $paymentReqStatus;
    var $paymentReqDate;
    

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
	
	
    
	
	

    
}
?>