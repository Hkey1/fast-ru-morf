<?php 
	//Ищет патч к crc32, чтобы не было колизий
	$Lines=file('SFBase0.txt');
	set_time_limit(300);
	echo count($Lines);
	function CS($Str,$i)
	{
		return crc32($Str);
	}
	$count=0;
	//for($i=8;$i<20;$i++)
	//{
		$i=0;
		$collisions=0;
		$CA=Array();
		$CSA=Array();
		foreach($Lines as $Line0)
		{
			if(!trim($Line0))
				continue;
			$Line=explode('%', $Line0);
			$CS=CS($Line[0],$i);
			if(isset($CSA[$CS]))// && $CSA[$CS]!==$Line[0]
			{
				$CA[$Line[0]]=$Line[1];
				$collisions++;
			}
			else
				$CSA[$CS]=$Line0;
			//echo $CSA[$CS];
			$count++;
			//if($count===100)
			//	break;
		}
		echo //$i.'::'.
			' '.$collisions.'<br /><pre>';
		$res='';
		foreach($CA as $Name=>$Val)
			$res.= "'{$Name}'=>{$Val}, ";
		echo $res;
		file_put_contents('SFBase02.txt',join("\n",$CSA));
		file_put_contents('SFBasePatch.php',"<?php \$GLOBALS['MorfPatch']=Array($res); ?>");
		//print_r($CA);
		
	//}
	
?>