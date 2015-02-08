<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Currencyfair</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="templates/style.css">
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
<div id="wrapper" class="container">
<header>
<h1>Currencyfair</h1>
<?php if (isset($this)){?>
<ul class="nav nav-pills nav-justified">
	<li role="presentation" <?php if ($this->messageType == 'ok') echo 'class="active';?>">
		<a id="messagesOk" href="?messageType=ok">Messages with success(Latest <?php echo $this->outputRowsMax;?>)</a>
	</li>
	<li role="presentation" <?php if ($this->messageType == 'fail') echo 'class="active';?>">
		<a id="messagesFail" href="?messageType=fail">Messages with fail(Latest <?php echo $this->outputRowsMax;?>)</a>
	</li>
</ul>
<?php }?>
</header>
<div class="row">
	<div class="col-xs-12">
		<div id="myContent">