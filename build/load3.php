<?php 
	//Собирает эту шнягу в базу в текстовом файле
	set_time_limit(1200);
	mysql_connect('localhost','root','');
	mysql_select_db('HContext');
	$Lines=file('SFBase02.txt');
	echo count($Lines);
	//exit();
	$c=0;
	$Rows=Array();
	foreach($Lines as $Line0)
	{
		if(trim($Line0))
		{	
			$c++;
			$Line=explode('%', $Line0);
			$CS=crc32($Line[0]);
			$Group=$Line[1];
			$Rows[]="($CS,$Group)";
		}
		if(count($Rows)>10000)
		{
			mysql_query("INSERT INTO morf VALUES ".join(',',$Rows));
			$Rows=Array();
		}
	}		
	if(count($Rows))
		mysql_query("INSERT INTO morf VALUES ".join(',',$Rows));
	echo ' suc'.$c;
?>