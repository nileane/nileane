<?php

session_start();

$db = './commentcava.sqlite';

//Get comments
if (isset($_GET['a']) && $_GET['a'] == 'g') {
	if (isset($_GET['url'])) {

		try {
			$pdo = new PDO("sqlite:".$db);

			header('Cache-Control: no-cache, must-revalidate');
			header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
			header('Content-type: application/json');
			header("HTTP/1.1 200 OK");

	        $query = $pdo->prepare('SELECT * FROM comments WHERE post = :url ORDER BY id');
	        $query->bindValue(':url', $_GET['url'], PDO::PARAM_STR);
	        $query->execute();
	        $result = $query->fetchAll(PDO::FETCH_OBJ);

			if ($result !== false) {
				echo json_encode($result);
	        }
	        else {
	        	//output an empty JSON array
	        	echo json_encode(array());
	        }
		}
		catch(PDOException $e) {
			//output an empty JSON array
			echo json_encode(array());
		}
	}
}

//Captcha
if (isset($_GET['a']) && $_GET['a'] == 'c') {

	//Generate random code
	$chars = '23456789ABCDEFGHJKLMNPQRSTUVWXYZ';
	$code = '';
	$lenght = 5;

	for ($i=0; $i<$lenght; $i++) {
		$code .= $chars{ mt_rand( 0, strlen($chars) - 1 ) };
	}
	//Save is in session
	$_SESSION['captcha'] = $code;

	$char1 = substr($code,0,1);
	$char2 = substr($code,1,1);
	$char3 = substr($code,2,1);
	$char4 = substr($code,3,1);
	$char5 = substr($code,4,1);

	$fonts = glob('./captcha/fonts/*.ttf');

	$img = imagecreatefrompng('./captcha/captcha.png');

	$colors = array ( imagecolorallocate($img, 131, 154, 255),
					  imagecolorallocate($img,  89, 186, 255),
					  imagecolorallocate($img, 155, 190, 214),
					  imagecolorallocate($img, 255, 128, 234),
					  imagecolorallocate($img, 255, 123, 123) );

	imagettftext($img, 28, -10, 0, 37, $colors[array_rand($colors)], $fonts[array_rand($fonts)], $char1);
	imagettftext($img, 28, 20, 37, 37, $colors[array_rand($colors)], $fonts[array_rand($fonts)], $char2);
	imagettftext($img, 28, -35, 55, 37, $colors[array_rand($colors)], $fonts[array_rand($fonts)], $char3);
	imagettftext($img, 28, 25, 100, 37, $colors[array_rand($colors)], $fonts[array_rand($fonts)], $char4);
	imagettftext($img, 28, -15, 120, 37, $colors[array_rand($colors)], $fonts[array_rand($fonts)], $char5);

	header('Content-Type: image/png');
	imagepng($img);
	imagedestroy($img);
}

//POST a comment
if (isset($_GET['a']) && $_GET['a'] == 'p') {

	$pdo = new PDO("sqlite:".$db);

	//Check if username or message are not empty && captcha is okay
	if (isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['comment']) && !empty($_POST['comment']) && isset($_POST['captcha']) && $_POST['captcha'] == $_SESSION['captcha']) {

        $query = $pdo->prepare('INSERT INTO comments (post, author, message)  VALUES (:post, :author, :message);');
        $query->bindValue(':post', $_POST['url'], PDO::PARAM_STR);
        $query->bindValue(':author', $_POST['name'], PDO::PARAM_STR);
        $query->bindValue(':message', htmlentities($_POST['comment'], ENT_QUOTES, "UTF-8"), PDO::PARAM_STR);
        $query->execute();
	}
	//redirect to the url
	header('Location: '.$_POST['url']);
}

?>