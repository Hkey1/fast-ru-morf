<?php 
	set_time_limit(6000);
	include('morf.php');

		
	$Lines=file('SFBase02.txt');

	//$fp1=fopen('hmb1.bin','r+b');//Основной файл
	//$fp2=fopen('hmb2.bin','r+b');//В этом файле храняться коллизии хешей
	$str1=str_repeat(_N0,4999999);
	$str2=str_repeat(_N0,4999999);
	

	$c=0;
	$col=0;
	$st=microtime(true);
	
	foreach($Lines as $Line0)
	{
		if(trim($Line0))
		{//Записываем в Файл	
			$c++;
			//if($c===1000)
			//	break;
			$Line=explode('%', $Line0);
			$CS=crc32_Stable($Line[0]);
			$Hash=abs($CS)%4999999;
			$Group=(int) $Line[1];
			
			$line1 = pack('N',$CS);
			$line2 = pack('N',$Group);
			while(true)
			{
				$s=4*$Hash;
				$CS2=substr($str1,$s,4);
				if($CS2===_N0)
				{
					for($i=0;$i<strlen($line1);$i++)
						$str1{$s+$i}=$line1{$i};
					for($i=0;$i<strlen($line2);$i++)
						$str2{$s+$i}=$line2{$i};	
					break;
				}
				$col++;
				$Hash=($Hash+1)%4999999;
			}
		}
	}
	file_put_contents('hmboh_ind.bin',$str1);
	file_put_contents('hmboh_val.bin',$str2);

	echo 'col '.$col.'<br />';
	echo 'suc '.(1*(microtime(true)-$st));
	exit();
	//	include('file_array.php');
//	
//	
//	$Arr=new FileArray('amb.bin');
	//$Arr->Delete();
	//$Arr=new FileArray('amb.bin',false,4000000);
	
	$st=microtime(true);
	foreach($Lines as $Line0)
	{
		if(trim($Line0))
		{	
			$c++;
			$Line=explode('%', $Line0);
			$CS=crc32($Line[0]);
			$Group=$Line[1];
			//$Arr[$CS]=$Group;
			if($c%10000===0)
			{
				//echo '<br /> '.$c.' '.round(10000/(microtime(true)-$st));
				
				$st=microtime(true);
			}
		}
	}		
	echo $c;
	
	exit();
	set_time_limit(1200);
	mysql_connect('localhost','root','');
	mysql_select_db('HContext');
	$Lines=file('SFBase02.txt');
	$Arr=Array();
	$c=0;
	foreach($Lines as $Line0)
	{
		if(trim($Line0))
		{	
			$c++;
			$Line=explode('%', $Line0);
			$CS=crc32($Line[0]);
			$Group=$Line[1];
			$Arr[$CS]=$Group;
			//if($c==100)
			//	break;
		}
	}		
	ksort($Arr);
	$Res='';
	foreach($Arr as $CS => $Group)
	{
		$Res.=pack('l',$CS);
		$Res.=pack('l',$Group);
	}
	file_put_contents('binMorf.bin',$Res);
	//echo '<pre>';
	//print_r($Arr);
	echo $c;//3025731
?>