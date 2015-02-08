<table class="table table-bordered table-striped">
<tr>
	<th>File</th>
	<th>Created</th>
	<th>UserId</th>
	<th>Currencyfrom</th>
	<th>CurrencyTo</th>
	<th>AmountBuy</th>
	<th>AmountSell</th>
	<th>Rate</th>
	<th>TimePlaced</th>
	<th>OriginatingCountry</th>
</tr>
<?php
foreach($files as $file){
	echo '<tr>';
	foreach($file as $var){
		echo '<td>'.$var.'</td>';
	}
	echo '</tr>';
}
?>
</table>