<?php
class Frontend{
	private $templateDir = 'templates/';
	private $outputFormat;
	private $messageType;
	private $response;
	private $outputRowsMax = 100;

	function __construct(){
		$this->setOutputFormat();
		$this->setMessageType();
		$process = new Process;
		$this->response = $process->getFiles($this->messageType);
	}
	
	private function getFilesListHtml($filesinput = array()){
		if (count($filesinput)>$this->outputRowsMax){
			$files = array_slice($filesinput, 0, $this->outputRowsMax);
		}else{
			$files = $filesinput;
		}
		ob_start();
		include $this->templateDir.'filesList.php';
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}
	
	private function setOutputFormat(){
		$this->outputFormat = (isset($_GET['outputFormat']) && $_GET['outputFormat'] == 'json')?'json':'html';
	}
	
	private function setMessageType(){
		$this->messageType = (isset($_GET['messageType']) && $_GET['messageType'] == 'fail')?'fail':'ok';
	}
	
	private function writeOutputHtml(){
		include $this->templateDir.'header.php';
		echo $this->getFilesListHtml($this->response);
		include $this->templateDir.'footer.php';
	}
	
	private function writeOutputJson(){
		echo json_encode($this->response);
	}
	
	public function writeOutput(){
		if ($this->outputFormat == 'html'){
			$this->writeOutputHtml();
		}elseif ($this->outputFormat == 'json'){
			$this->writeOutputJson();
		}
	}
}
?>