<?php
	session_start();

	require '../includes/checklogin.php';
	
	if(!$_FILES['upfile']){
		header("Location: ../dashboard.php");
	}

	require '../change.php';
	require '../simpleimg.php';

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

		if ($_FILES['upfile']['size'] > 10000000) { //10MB
			throw new RuntimeException('Exceeded filesize limit.');
		}

		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		
		if(finfo_file($finfo, $_FILES['upfile']['tmp_name']) != 'image/jpeg'){
			throw new RuntimeException('Invalid file format: ' . finfo_file($finfo, $_FILES['upfile']['tmp_name']) . '. Must be a jpg image.');
		}
		
		$fn = sha1_file($_FILES['upfile']['tmp_name']);
		$uploadpath = sprintf('../photos/%s.%s',
				$fn,
				'jpg'
			);
		$thumb_uploadpath = sprintf('../photos/%s-%s.%s',
				'thumb',
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

        $thumb = new SimpleImage();
        $thumb->load($uploadpath);

        if ($thumb->getWidth() > $thumb->getHeight()){
        	$thumb->resizeToHeight(200);
        	$thumb->resize_crop(250,200);
        }else{
        	$thumb->resizeToWidth(250);
        	$thumb->resize_crop(250,200);
        }

        $thumb->save($thumb_uploadpath);

        $caption = $_POST['caption'];

        try{

	        $c = new changePortfolio("../json/portfolio.json");
	        $c->addPhoto($fn . ".jpg",$caption);

	    } catch (RuntimeException $e){
			throw $e;
		}

        header("Location: ../dashboard.php");

	} catch (RuntimeException $e){
		flashMessage('danger', $e->getMessage());
		header("Location: ../dashboard.php");
	}

?>