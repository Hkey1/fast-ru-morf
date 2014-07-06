<?php 
	$Lines=file('morphs.mrd');
	set_time_limit(600);
	
	$pos1=1 + (int) $Lines[0];
	$pos2=1 + $pos1 + (int)($Lines[$pos1]);
	$pos3=1 + $pos2 + (int)($Lines[$pos2]);
	$pos4=1 + $pos3 + (int)($Lines[$pos3]);
	//0 ОКОНЧАНИЯ 1 УДАРЕНИЯ 2 ПРАВКИ 3 ПРИСТАВКИ 4 СЛОВА
	$c=0;
	$Words=Array();
	//Создаем слова
	for($i=0;$i<10000500;$i++)
	{	
		if(!isset($Lines[$pos4+$i]))
			break;
		$Word=explode(' ',$Lines[$pos4+$i]);
		unset($Lines[$pos4+$i]);
		if(!isset($Word[1]))
			continue;
		if(isset($Word[0][0]) && $Word[0][0]=='-')
			continue;
		if($Word[0]==='#')
			$Word[0]='';
		$Prist='';
		if(isset($Word[5]) && ((int)($Word[5])!==0||$Word[5]==='0'))
			$Prist=$Lines[$pos3+(int)($Word[5]) + 1];
		$Okon0=Explode('%',trim(trim($Lines[(int)($Word[1])+1]),'%'));
		$Okon=Array();
		foreach($Okon0 as $Cur)
		{
			$Cur=explode('*',$Cur);
			$Prist2='';
			if(isset($Cur[2]))
				$Prist2=$Cur[2];
			$Okon[]=$Cur[0].'*'.$Prist2;
		}
		$Okon=join('%',$Okon);
		$сWord=Array('Base'=>trim($Word[0]),'Okon'=>trim($Okon),'Prist'=>trim($Prist),'Word'=>$i,'Group'=>$i,'Word'=>$i);
		$Words[]=$сWord;
		$c++;
		//if($c===40000)
		//	break;
	}
	unset($Lines);
	//print_r($Words);
	
	//Группируем слова
	for($t=0;$t<10;$t++)//Циклов 3-4 будет
	{
		$Forms=Array();
		$continue=false;
		$c=0;
		foreach($Words as $i=> &$Word)
		{
			$cForms=Array();
			$Okons=explode('%',$Word['Okon']);
			foreach($Okons as $Okon)
			{
				$Okon=explode('*',$Okon);
				$cForms[]=str_replace('Ё','Е',$Word['Prist'].$Okon[1].$Word['Base'].$Okon[0]);
			}
			foreach($cForms as $Form)
				if(!isset($Forms[$Form])||$Forms[$Form]>$Word['Group'])
					$Forms[$Form]=$Word['Group'];
		}
		foreach($Words as $i=> &$Word)
		{
			$cForms=Array();
			$Okons=explode('%',$Word['Okon']);
			foreach($Okons as $Okon)
			{
				$Okon=explode('*',$Okon);
				$cForms[]=str_replace('Ё','Е',$Word['Prist'].$Okon[1].$Word['Base'].$Okon[0]);
			}
			$Group=$Word['Group'];
			foreach($cForms as $Form)
			{
				if(isset($Forms[$Form]) && $Forms[$Form]<$Group)
					$Group=$Forms[$Form];
			}
			if($Group!=$Word['Group'])
			{
				$Word['Group']=$Group;
				$continue=true;
				$c++;
			}
		}
		echo ' '.$c.'<br />';
		if(!$continue)
			break;
	}
	echo $Forms['ДЕТЬ'].' '.
		 $Forms['ДЕЛ'].' '.
		 $Forms['ДЕЛА'].' '.
		 $Forms['ДЕЛО'].' '.
		 $Forms['ДЕЛОМ'].' '.
		 $Forms['ДЕНУ'].' '.
		 $Forms['ДЕНЬ'].' '.
		 $Forms['ДЕЛИ'].' ';
	$Forms=Array();
	foreach($Words as $i=> &$Word)
	{
		//$cForms=Array();
		$Okons=explode('%',$Word['Okon']);
		foreach($Okons as $Okon)
		{
			$Okon=explode('*',$Okon);
			$cForm=str_replace('Ё','Е',$Word['Prist'].$Okon[1].$Word['Base'].$Okon[0]);
			if(!isset($Forms[$cForm]))
				$Forms[$cForm]=$cForm.'%'.$Word['Group'].'%'.$Word['Word'];
		}
	}
	file_put_contents('SFBase0.txt',join("\n",$Forms));
?>