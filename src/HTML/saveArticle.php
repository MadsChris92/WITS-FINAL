<?php
/**
 * Created by PhpStorm.
 * User: martin
 * Date: 11/15/16
 * Time: 4:18 PM
 */

if(isset($_POST['link'])){
	$article = $_POST['link'];
	if(isset($_POST['content'])){
		$content = $_POST['content'];
		$title = $article;
		if(isset($_POST['title'])){
			$title = $_POST['title'];
		}
		file_put_contents("../ARTICLES/".$article, $title."|".$content);
	}
}

?>