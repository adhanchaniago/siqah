<?php
$getmonth = date('m');

if ($getmonth == 2){
	if(date('W')-5==0){
		echo "5";
	}
	else{
		echo date('W')-5;
	}
}
else if ($getmonth == 3){
	if(date('W')-9==0){
		echo "4";
	}
	else{
		echo date('W')-9;
	}
}
else if ($getmonth == 4){
	if(date('W')-13==0){
		echo "4";
	}
	else{
		echo date('W')-13;
	}
}
else if ($getmonth == 5){
	echo date('W')-17;
}
else if ($getmonth == 6){
	if(date('W')-22==0){
		echo "5";
	}
	else{
		echo date('W')-22;
	}
}
else if ($getmonth == 7){
	if(date('W')-26==0){
		echo "4";
	}
	else{
		echo date('W')-26;
	}
}
else if ($getmonth == 8){
	if(date('W')-31==0){
		echo "5";
	}
	else{
		echo date('W')-31;
	}
}
else if ($getmonth == 9){
	if(date('W')-35==0){
		echo "4";
	}
	else{
		echo date('W')-35;
	}
}
else if ($getmonth == 10){
	if(date('W')-39==0){
		echo "4";
	}
	else{
		echo date('W')-39;
	}
}
else if ($getmonth == 11){
	if(date('W')-44==0){
		echo "5";
	}
	else{
		echo date('W')-44;
	}
}
else if ($getmonth == 12){
	if(date('W')-48==0){
		echo "4";
	}
	else{
		echo date('W')-48;
	}
}
else{
	echo date('W');
}
?>