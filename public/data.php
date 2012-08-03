<?php 
try{
	$user="root";
	$pass="";
	$db = new PDO('mysql:host=localhost;dbname=reader', $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	if(isset($_GET['id'])):
		$query = $db->prepare('SELECT * FROM f_reader WHERE id = :id ORDER BY id ASC');
		$query->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
		$query->execute();

		$row = $query->fetch(PDO::FETCH_OBJ);
		$explo=explode("\n", $row->content);
		$text="";
		foreach ($explo as $paragraph) {
			$text.="<p>".$paragraph."</p>";
		}
		$data['title']=$row->title;
		$data['content']=$text;
		echo json_encode($data);
	else:
		$query = $db->prepare('SELECT id FROM f_reader ORDER BY id ASC');
		$query->execute();
		$ids=array();
		while($row = $query->fetch(PDO::FETCH_OBJ)){
			array_push($ids, $row->id);
		}
		;
		echo json_encode($ids);
	endif;

}
catch(PDOException $e) {  
    echo $e->getMessage();  
}  
?>