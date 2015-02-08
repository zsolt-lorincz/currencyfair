<?php

class EndPoint{
	private $statusCode;
	private $statusMessage;
	private $response;
	private $logBaseDir = 'messages/';
	
	function __construct(){
		$messageData = (isset($_POST))?$_POST:array();
		$message = new Message($messageData);
		//$this->validatePostData();
		if ($message->getErrors()){
			$this->setStatusCode(403);
			$this->setStatusMessage('Required credintial missing');
			$this->setResponse($message->getErrors());
		}else{
			$this->setStatusCode(200);
			$this->setStatusMessage('Ok');
			$this->setResponse('Processing data started');			
		}
		$this->logMessage($message);
		$this->writeOutput();
	}
	
	private function logMessage($message){
		$logSubDir = ($this->statusCode == 200)?'ok':'fail';		
		$logFile = $this->logBaseDir.$logSubDir.'/'.date('Ymd_His_').uniqid().'.txt';
		$logText = json_encode($message->getAllData());
		
		$fp = fopen($logFile,'w');
		fwrite($fp,$logText);
		fclose($fp);
	}
	
	private function setStatusCode($statusCode=''){
		$this->statusCode = $statusCode;
	}
	
	private function setStatusMessage($statusMessage=''){
		$this->statusMessage = $statusMessage;
	}
	
	private function setResponse($response=''){
		$this->response = $response;
	}
	
	private function writeOutput(){
		http_response_code($this->statusCode);
		header('Content-Type: application/json');
		$response = new stdClass();
		$response->statusCode = $this->statusCode;
		$response->statusMessage = $this->statusMessage;
		$response->data = $this->response;		
		echo json_encode($response);
	}
}
?>