<?php

(int) $bulan_nomer = substr(date("Y-m-d"), 5, 2);
$a = strtotime(date("Y-m-d"));
if ($bulan_nomer == 1){
				if(date('W', $a)-52==0){
					$pekan = 1;
					$bulan_nomer = 1;
				}
				else{
					$pekan = date('W', $a);
				}
			}
			else if ($bulan_nomer == 2){
				if(date('W', $a)-5==0){
					$pekan = 5;
					$bulan_nomer = 1;
				}
				else{
					$pekan = date('W', $a)-5;
				}
			}
			else if ($bulan_nomer == 3){
				if(date('W', $a)-9==0){
					$pekan = 4;
					$bulan_nomer = 2;
				}
				else{
					$pekan = date('W', $a)-9;
				}
			}
			else if ($bulan_nomer == 4){
				if(date('W', $a)-13==0){
					$pekan = 4;
					$bulan_nomer = 3;
				}
				else{
					$pekan = date('W', $a)-13;
				}
			}
			else if ($bulan_nomer == 5){
				if(date('W', $a)-18==0){
					$pekan = 5;
					$bulan_nomer = 4;
				}
				else{
					$pekan = date('W', $a)-18;
				}
			}
			else if ($bulan_nomer == 6){
				if(date('W', $a)-22==0){
					$pekan = 4;
					$bulan_nomer = 5;
				}
				else{
					$pekan = date('W', $a)-22;
				}
			}
			else if ($bulan_nomer == 7){
				if(date('W', $a)-26==0){
					$pekan = 4;
					$bulan_nomer = 6;
				}
				else{
					$pekan = date('W', $a)-26;
				}
			}
			else if ($bulan_nomer == 8){
				if(date('W', $a)-31==0){
					$pekan = 5;
					$bulan_nomer = 7;
				}
				else{
					$pekan = date('W', $a)-31;
				}
			}
			else if ($bulan_nomer == 9){
				if(date('W', $a)-35==0){
					$pekan = 4;
					$bulan_nomer = 8;
				}
				else{
					$pekan = date('W', $a)-35;
				}
			}
			else if ($bulan_nomer == 10){
				if(date('W', $a)-39==0){
					$pekan = 4;
					$bulan_nomer = 9;
				}
				else{
					$pekan = date('W', $a)-39;
				}
			}
			else if ($bulan_nomer == 11){
				if(date('W', $a)-44==0){
					$pekan = 5;
					$bulan_nomer = 10;
				}
				else{
					$pekan = date('W', $a)-44;
				}
			}
			else if ($bulan_nomer == 12){
				if(date('W', $a)-48==0){
					$pekan = 4;
					$bulan_nomer = 11;
				}
				else{
					$pekan = date('W', $a)-48;
				}
			}
if($pekan == "01"){
	$pekan = "1";
}
else if($pekan == "02"){
	$pekan = "2";
}
else if($pekan == "03"){
	$pekan = "3";
}
else if($pekan == "04"){
	$pekan = "4";
}
else if($pekan == "05"){
	$pekan = "5";
}

echo $pekan;

?>