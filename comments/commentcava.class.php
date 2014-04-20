<?php

Class commentcava
{

	//Constants
	const default_db = '/comments/commentcava.sqlite';

	//commentcava.php path for generating comment form
	const post_uri   = '';

	//allow html in comments or not?
	const allow_html = 1;
	
	//PDO variable
	protected $db;

	/*
	 * Instanciate db and create it if not exists
	 */
	function __construct($db = null)
	{
		session_start();

		//Create DB if not exists
		if (empty($db)) $db = self::default_db;
		$this->db = new PDO("sqlite:".$db);
		$query = $this->db->prepare('CREATE TABLE IF NOT EXISTS "comments" ("id" INTEGER PRIMARY KEY  AUTOINCREMENT  NOT NULL , "post" VARCHAR NOT NULL , "author" VARCHAR NOT NULL , "date" TIMESTAMP DEFAULT (datetime(\'now\',\'localtime\')), "message" TEXT NOT NULL )');
		$query->execute();	
	}

	/*
	 * Get comments for a specific page 
	 */
	function getComments($url)
	{
        $query = $this->db->prepare('SELECT * FROM comments WHERE post = :url ORDER BY id');
        $query->bindValue(':url', $url, PDO::PARAM_STR);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
	}

	function generateForm($fromurl, $url = null)
	{
		if (empty($url)) $url = self::post_uri;

		return '<form method="post" action="'.$url.'?a=p" id="comment_form" class="comment_form" style="display: block;"><input value="'.$fromurl.'" name="url" type="hidden"><div class="comment_inputuser">New comment from <input value="" placeholder="your nickname" size="20" name="name" type="text"></div><div class="comment_inputmessage"><textarea placeholder="Your comment…" value="" name="comment" cols="32" rows="2"></textarea></div><div class="comment_recaptcha"><input placeholder="Copy the code" name="captcha" class="captcha" type="text"><a title="Reload Image" href="javascript:reloadCaptcha()"><img id="captcha" alt="Enter code" src="'.$url.'?a=c"></a></div><div class="comment_submit"><input value="Send" name="submit" type="submit"></div></form>';
	}
	function addComment($url, $name, $comment, $captcha)
	{
		//Check if username or message are not empty && captcha is okay
		if (!empty($name) && !empty($comment) && !empty($captcha) && strtoupper($captcha) == $_SESSION['captcha']) {

	        $query = $this->db->prepare('INSERT INTO comments (post, author, message)  VALUES (:post, :author, :message);');
	        $query->bindValue(':post', $url, PDO::PARAM_STR);
	        $query->bindValue(':author', $name, PDO::PARAM_STR);
	        if (!empty($this->allow_html)) {
	        	$query->bindValue(':message', $comment, PDO::PARAM_STR);
	        }
	        else {
	        	$query->bindValue(':message', htmlentities($comment, ENT_QUOTES, "UTF-8"), PDO::PARAM_STR);
	        }
	        return $query->execute();
		}
		return false;
	}

	function generateCaptcha()
	{
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
		return $img;
	}

}

?>
