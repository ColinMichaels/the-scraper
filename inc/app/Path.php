<?php
/**
 * Created for OGK Creative.
 * Project: the-scraper
 * Developer: Colin Michaels
 * Date: 2019-06-03
 * Time: 14:28
 */

namespace CM;

use \Directory;

/** Idea here is to have a interface to build all the path files and types  */

class Path extends Directory {

	public $base, $path, $local_path, $public_path ,$full_path, $is_url, $root;

	public function __construct($path){

		$parsed_url = new URL($path);

		$this->root = getenv('HTTP_HOST');

		$this->is_url = (!$parsed_url->path) ?? true;

		$this->path = $parsed_url->path ?? $path ??  null;

		$this->public_path = CM_PUBLIC_PATH;

		$this->base = CM_BASE_PATH;

		$this->local_path = $this->base.$this->path;

		$this->full_path = new URL($this->root.$this->path);

	}

	public function  getFullPath(){

		return $this->base.$this->path;

	}

	public function setFullPath($full_path){

		return $this->full_path = $full_path;

	}

	public function setRecursive(bool $recursive){

		return $this->recursive = $recursive;

	}

	public function setPath($path){

		$this->path = $path;

	}

	public function getPath(){

		return $this->path;

	}

}
