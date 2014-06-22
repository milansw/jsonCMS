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
			$this->json[] = $p;

			file_put_contents($this->jfn, json_encode($this->json));

		}

		function removePhoto($pfn){

			$f = file_get_contents($this->jfn);
			$this->json = json_decode($f);

			foreach($this->json as $p){
				if($p->filename == $pfn){
					unset($this->json[array_search($p,$this->json)]);
				}
			}

			file_put_contents($this->jfn, json_encode($this->json));

		}

		function editCaption($pfn,$nc){

			$f = file_get_contents($this->jfn);
			$this->json = json_decode($f);

			foreach($this->json as $p){
				if($p->filename == $pfn){
					$p->caption = $nc;
					break;
				}
			}

			file_put_contents($this->jfn, json_encode($this->json));

		}
	}

	

?>