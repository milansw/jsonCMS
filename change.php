<?php
	session_start();
	// add/remove/edit

	require 'photo.php';

	function flashMessage($type, $message){
		
		$_SESSION['flash'] = array('type' => $type, 'message' => $message);
	}

	// cleanInput function from http://css-tricks.com/snippets/php/sanitize-database-inputs/
	function cleanInput($input) {
 
		$search = array(
			'@<script[^>]*?>.*?</script>@si',   // Strip out javascript
			'@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
			'@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
			'@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
		);
	 
		$output = preg_replace($search, '', $input);
		return $output;

	}

	class changeJSON {

		private $json;
		private $jfn;

		function __construct($j){
			$this->jfn = $j;
		}

		function addPhoto($pfn,$c){

			if(strlen($c) > 140){
				throw new RuntimeException("Caption must be 140 characters or less.");
			}

			$f = file_get_contents($this->jfn);
			$this->json = json_decode($f);

			$c = cleanInput($c);

			$p = new Photo($pfn,$c);
			$this->json[] = $p;

			file_put_contents($this->jfn, json_encode($this->json));

		}

		function removePhoto($pfn){

			$f = file_get_contents($this->jfn);
			$this->json = json_decode($f);

			foreach($this->json as $key => $p){
				if($p->filename == $pfn){
					unset($this->json[$key]);
					//unset($this->json[array_search($p,$this->json)]);
				}
			}

			$this->json = array_values($this->json); // important to reset the values of the array to start at 0

			$path = realpath('photos/'.$pfn);
			$path_thumb = realpath('photos/thumb-'.$pfn);
			if(is_readable($path)){
				unlink($path);
			}
			if(is_readable($path_thumb)){
				unlink($path_thumb);
			}

			file_put_contents($this->jfn, json_encode($this->json));

		}

		function editCaption($pfn,$nc){

			if(strlen($nc) > 140){
				throw new RuntimeException("Caption must be 140 characters or less.");
			}

			$f = file_get_contents($this->jfn);
			$this->json = json_decode($f);

			$nc = cleanInput($nc);

			foreach($this->json as $p){
				if($p->filename == $pfn){
					$p->caption = $nc;
					break;
				}
			}

			file_put_contents($this->jfn, json_encode($this->json));

		}
	}

	class changeContent {

		private $json;
		private $jfn;

		function __construct($j){
			$this->jfn = $j;
		}

		function addGroup($n){

			if(strlen($c) > 20){
				throw new RuntimeException("Group name must be 20 characters or less.");
			}

			$f = file_get_contents($this->jfn);
			$this->json = json_decode($f,true);

			$groupname = cleanInput($n);

			$this->json[$groupname] = (object)array('' => '');

			file_put_contents($this->jfn, json_encode($this->json));

		}
	}

	

?>