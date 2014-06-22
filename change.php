<?php

	// add/remove/edit

	require 'photo.php';

	class changeJSON {

		private $json;
		private $jfn;

		function __construct($j){
			$this->jfn = $j;
		}

		function addPhoto($pfn,$c){

			$f = file_get_contents($this->jfn);
			$this->json = json_decode($f);

			$p = new Photo($pfn,$c);
			array_push($this->json,$p);

			file_put_contents($this->jfn, json_encode($this->json));

		}

		function removePhoto($pfn){

			$f = file_get_contents($this->jfn);
			$this->json = json_decode($f);

			// iterate over array finding matching filenames and unset()

			// foreach

			// unset($this->json[$id]);

			// file_put_contents($this->jfn, json_encode($this->json));

		}
	}

	

?>