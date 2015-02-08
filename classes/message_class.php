<?php

class Message{
	private $messageData;
	private $userId;
	private $currencyFrom;
	private $currencyTo;
	private $amountSell;
	private $amountBuy;
	private $rate;
	private $timePlaced;
	private $originatingCountry;
	private $errors;
	
	function __construct($messageData=array()){
		$this->errors = array();
		$this->setMessageData($messageData);
		$this->validatePostData();
	}
	
	function validatePostData(){
		$this->validateUserId();
		$this->validateCurrencyFrom();
		$this->validateCurrencyTo();
		$this->validateAmountSell();
		$this->validateAmountBuy();
		$this->validateRate();
		$this->validateTimePlaced();
		$this->validateOriginatingCountry();
	}
	
	private function validateUserId(){
		if (isset($this->messageData['userId'])){
			if (preg_match("/^\d/",$this->messageData['userId'])){
				$this->setUserId($this->messageData['userId']);
			}else{
				$this->setErrors("userId not numeric");
			}
		}else{
			$this->setErrors("userId required");
		}		
	}

	private function validateCurrencyFrom(){
		if (isset($this->messageData['currencyFrom'])){
			if (preg_match("/^(EUR|GBP)$/i",$this->messageData['currencyFrom'])){
				$this->setCurrencyFrom($this->messageData['currencyFrom']);
			}else{
				$this->setErrors("currencyFrom not valid");
			}
		}else{
			$this->setErrors("currencyFrom required");
		}	
	}

	private function validateCurrencyTo(){
		if (isset($this->messageData['currencyTo'])){
			if (preg_match("/^(EUR|GBP)$/i",$this->messageData['currencyTo'])){
				$this->setCurrencyTo($this->messageData['currencyTo']);
			}else{
				$this->setErrors("currencyTo not valid");
			}
		}else{
			$this->setErrors("currencyTo required");
		}	
	}
	
	private function validateAmountSell(){
		if (isset($this->messageData['amountSell'])){
			if (preg_match("/^[0-9]{1,3}(?:,?[0-9]{3})*(?:\.[0-9]{2})?$/",$this->messageData['amountSell'])){
				$this->setAmountSell($this->messageData['amountSell']);
			}else{
				$this->setErrors("amountSell not numeric");
			}
		}else{
			$this->setErrors("amountSell required");
		}		
	}
	
	private function validateAmountBuy(){
		if (isset($this->messageData['amountBuy'])){
			if (preg_match("/^[0-9]{1,3}(?:,?[0-9]{3})*(?:\.[0-9]{2})?$/",$this->messageData['amountBuy'])){
				$this->setAmountBuy($this->messageData['amountBuy']);
			}else{
				$this->setErrors("amountBuy not numeric");
			}
		}else{
			$this->setErrors("amountBuy required");
		}		
	}
	
	private function validateRate(){
		if (isset($this->messageData['rate'])){
			if (preg_match("/^[0-9]{1,3}(?:,?[0-9]{3})*(?:\.[0-9]{1,5})?$/",$this->messageData['rate'])){
				$this->setRate($this->messageData['rate']);
			}else{
				$this->setErrors("rate not valid");
			}
		}else{
			$this->setErrors("rate required");
		}	
	}
	
	private function validateTimePlaced(){
		if (isset($this->messageData['timePlaced'])){
			if (preg_match("/^[0-9]{2}-[a-zA-Z]{3}-[0-9]{2}\s[0-9]{2}:[0-9]{2}:[0-9]{2}$/",$this->messageData['timePlaced'])){
				$this->setTimePlaced($this->messageData['timePlaced']);
			}else{
				$this->setErrors("timePlaced not valid");
			}
		}else{
			$this->setErrors("timePlaced required");
		}	
	}
	
	private function validateOriginatingCountry(){
		if (isset($this->messageData['originatingCountry'])){
			if (preg_match("/^[a-zA-Z]{2}$/",$this->messageData['originatingCountry'])){
				$this->setOriginatingCountry($this->messageData['originatingCountry']);
			}else{
				$this->setErrors("originatingCountry not valid");
			}
		}else{
			$this->setErrors("originatingCountry required");
		}	
	}
	
	public function setMessageData($messageData=array()){
		$this->messageData = $messageData;
	}

	private function setUserId($userId=''){
		$this->userId = $userId;
	}

	private function setCurrencyFrom($currencyFrom=''){
		$this->currencyFrom = $currencyFrom;
	}

	private function setCurrencyTo($currencyTo=''){
		$this->currencyTo = $currencyTo;
	}
	
	private function setAmountSell($amountSell=''){
		$this->amountSell = $amountSell;
	}
	
	private function setAmountBuy($amountBuy=''){
		$this->amountBuy = $amountBuy;
	}
	
	private function setRate($rate=''){
		$this->rate = $rate;
	}
	
	private function setTimePlaced($timePlaced=''){
		$this->timePlaced = $timePlaced;
	}
	
	private function setOriginatingCountry($originatingCountry=''){
		$this->originatingCountry = $originatingCountry;
	}
	
	private function setErrors($error){
		$this->errors[] = $error;
	}
	
	public function getUserId(){
		return $this->userId;
	}
	
	public function getCurrencyFrom(){
		return $this->currencyFrom;
	}
	
	public function getCurrencyTo(){
		return $this->currencyTo;
	}
	
	public function getAmountSell(){
		return $this->amountSell;
	}
	
	public function getAmountBuy(){
		return $this->amountBuy;
	}
	
	public function getRate(){
		return $this->rate;
	}
	
	public function getTimePlaced(){
		return $this->timePlaced;
	}
	
	public function getOriginatingCountry(){
		return $this->originatingCountry;
	}
	
	public function getAllData(){
		return array(
			'userId' 				=> $this->userId,
			'currencyFrom' 			=> $this->currencyFrom,
			'currencyTo' 			=> $this->currencyTo,
			'amountSell' 			=> $this->amountSell,
			'amountBuy' 			=> $this->amountBuy,
			'rate' 					=> $this->rate,
			'timePlaced' 			=> $this->timePlaced,
			'originatingCountry' 	=> $this->originatingCountry,
		);
	}
	
	public function getErrors(){
		return $this->errors;
	}
}
?>