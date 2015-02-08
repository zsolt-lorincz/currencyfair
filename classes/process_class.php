<?php
class process{
	private $logBaseDir = 'messages/';
	
	function __construct(){
		
	}
	
	private function getFilesData($dirType = 'ok'){
		$filesData = array();
		$files = scandir($this->logBaseDir.$dirType);
		foreach($files as $fileName){
			if ($fileName != '.' && $fileName != '..'){
				$file  = $this->logBaseDir.$dirType.'/'.$fileName;
				$fileContent = file_get_contents($file);
				$jsonString = json_decode($fileContent,true);
				$message = new Message($jsonString);

				$fileData = array(
					'filename' 		=> $fileName,
					'mtime'			=> date('Y-m-d H:i:s',filemtime($file)),
					'userId'		=> $message->getUserId(),
					'currencyFrom'	=> $message->getCurrencyFrom(),
					'currencyTo'	=> $message->getCurrencyTo(),
					'amountBuy'		=> $message->getAmountBuy(),
					'amountSell'	=> $message->getAmountSell(),
					'rate'			=> $message->getRate(),
					'timePlaced'	=> $message->getTimePlaced(),
					'originatingCountry'	=> $message->getOriginatingCountry(),
				);
				$filesData[] = $fileData;
			}
		}
		$filesData = array_reverse($filesData);
		//print_r($filesData);exit;
		return $filesData;
	}
	
	function getFiles($messageType){
		$files = $this->getFilesData($messageType);
		return $files;
	}
}
?>