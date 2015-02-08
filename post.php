<?php

$postUrl = 'http://'.$_SERVER['HTTP_HOST'].'/currencyfair/endpoint.php';
//echo "postUrl: $postUrl<br>";

$postData = array();
for($i=1;$i<=10;$i++){
	$post = array();
	$post['userId'] = $i;
	$post['currencyFrom'] = ($i%2)?'GBP':'EUR';
	$post['currencyTo'] = ($i%2)?'EUR':'GBP';
	$post['amountBuy'] = $i*10+1;
	$post['amountSell'] = $i*10+5;
	$post['rate'] = ($i%2)?'1.2':'0.7471';
	$post['timePlaced'] = date('d-M-y H:i:s');
	$post['originatingCountry'] = ($i%2)?'ie':'gb';
	$post['response'] = postToEndpoint($post);

	$postData[] = $post;
}
echo '<pre>';print_r($postData);echo '</pre>';


function postToEndpoint($postData = array()){
	global $postUrl;
	
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL, $postUrl);
	curl_setopt($ch,CURLOPT_POST, count($postData));
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
	$result = curl_exec($ch);
	curl_close($ch);
	
	return $result;
}