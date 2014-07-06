<?php
	
	include('morf.php');
	var_dump(MorfFindGroup('ФЫВФЫВФЫВ'));
	var_dump(MorfFindGroup('ПЕТЬ'));
	var_dump(MorfFindGroup('СЕКС'));
	var_dump(MorfFindGroup('СЕЗОН'));
	var_dump(MorfFindGroup('СКОРОСТЬ'));
	var_dump(MorfFindGroup('ВРЕМЯ'));
	var_dump(MorfFindGroup('ВРЕМЕНА'));
	var_dump(MorfFindGroup('АВАНГАРД'));
	var_dump(MorfFindGroup('ДЕТЬ'));
	var_dump(MorfFindGroup('ДЕЛ'));
	var_dump(MorfFindGroup('ДЕЛА'));
	var_dump(MorfFindGroup('ДЕЛО'));
	var_dump(MorfFindGroup('ДЕЛОМ'));
	var_dump(MorfFindGroup('ДЕНЬ'));
	var_dump(MorfFindGroup('ДЕНУ'));
	var_dump(MorfFindGroup('ДЕЛИ'));
	
	

	include('HStem.php');
	$st=microtime(true);
	for($i=0;$i<10000;$i++)
	{
		(MorfFindHash('СОЛЬ'));
		(MorfFindHash('СОЛИ'));
		(MorfFindHash('ДЕЛИ'));
		(MorfFindHash('ДЕЛИТЬ'));
		(MorfFindHash('asdsadsds'));
	}
	echo '<br />MorfFindHash: '.(microtime(true) - $st).' ';
	echo 5*10000/(microtime(true) - $st);
	echo '<br />';

	$st=microtime(true);
	for($i=0;$i<10000;$i++)
	{
		(MorfFindGroup('СОЛЬ'));
		(MorfFindGroup('СОЛИ'));
		(MorfFindGroup('ДЕЛИ'));
		(MorfFindGroup('ДЕЛИТЬ'));
		(MorfFindGroup('asdsadsds'));
	}
	echo '<br />MorfFindGroup: '.(microtime(true) - $st).' ';
	echo 5*10000/(microtime(true) - $st);
	echo '<br />';



	exit();

?>