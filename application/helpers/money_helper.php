<?php
function idr($number){
	$result = "Rp ". number_format($number,0,',','.');
	return $result;
}
