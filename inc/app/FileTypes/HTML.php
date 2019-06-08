<?php
/**
 * Created for OGK Creative.
 * Project: the-scraper
 * Developer: Colin Michaels
 * Date: 2019-06-05
 * Time: 20:37
 */

namespace CM\FileTypes;

use PHPHtmlParser\Dom;

class HTML extends Dom {

	public $dom;

	 public function __construct() {

	 	  $this->dom = new Dom;
	 	  $this->dom->setOptions([
		      'preserveLineBreaks' => true
	      ]);
	 }

}
