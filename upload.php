<?php
	
	require 'change.php';
	require 'simpleimg.php';

	try{
		switch ($_FILES['upfile']['error']) {
			case UPLOAD_ERR_OK:
				break;
			case UPLOAD_ERR_NO_FILE:
				throw new RuntimeException('No file sent.');
			case UPLOAD_ERR_INI_SIZE:
			case UPLOAD_ERR_FORM_SIZE:
				throw new RuntimeException('Exceeded filesize limit.');
			default:
				throw new RuntimeException('Unknown errors.');
		}

		// You should also check filesize here. 
		if ($_FILES['upfile']['size'] > 10000000) { //25MB
			throw new RuntimeException('Exceeded filesize limit.');
		}

		// DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
		// Check MIME Type by yourself.

		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		
		if(finfo_file($finfo, $_FILES['upfile']['tmp_name']) != 'image/jpeg'){
			throw new RuntimeException('Invalid file format.' . finfo_file($finfo, $_FILES['upfile']['tmp_name']));
		}

		// You should name it uniquely.
		// DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
		// On this example, obtain safe unique name from its binary data.
		
		$fn = sha1_file($_FILES['upfile']['tmp_name']);
		$uploadpath = sprintf('photos/%s.%s',
				$fn,
				'jpg'
			);

		if (!move_uploaded_file(
			$_FILES['upfile']['tmp_name'],
			$uploadpath
		)) {
			throw new RuntimeException('Failed to move uploaded file.');
		}

		$image = new SimpleImage();
        $image->load($uploadpath);
        $image->resizeToWidth(800);
        $image->save($uploadpath);

        $caption = $_POST['caption'];

        $c = new changeJSON("portfolio.json");
        $c->addPhoto($fn . ".jpg",$caption);

        header("Location: index.php");

	} catch (RuntimeException $e){
		echo $e->getMessage();
	}

?>