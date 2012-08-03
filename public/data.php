<?php 
$db = mysql_connect("localhost", "root", "");
mysql_select_db("reader", $db);
if(isset($_GET['id'])):
	mysql_query('SET CHARACTER SET utf8');
	$query = "SELECT * FROM f_reader WHERE id=".$_GET['id']." ORDER BY id ASC";
	$results = mysql_query($query, $db) or die(mysql_error());
	$contents = mysql_fetch_assoc($results);
	$data=array();
	$explo=explode("\n", $contents['content']);
	$text="";
	foreach ($explo as $paragraph) {
		$text.="<p>".$paragraph."</p>";
	}
	$data['title']=$contents['title'];
	$data['content']=$text;
	echo json_encode($data);
else:
$query = "SELECT id FROM f_reader ORDER BY id ASC";
	$results = mysql_query($query, $db) or die(mysql_error());
	$idt=array();
	while ($ids = mysql_fetch_assoc($results)){
		array_push($idt, $ids['id']);
	}
	echo json_encode($idt);
endif;
?>