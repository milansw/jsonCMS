<?php
	class Photo {
		public $filename;
		public $caption;
		public $date_uploaded;

		function __construct($f,$c){
			$this->filename = $f;
			$this->caption = $c;
			$this->date_uploaded = time();
		}
	}
?>