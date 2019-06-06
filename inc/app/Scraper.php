<?php
/**
 * Project: the-scraper
 * Developer: Colin Michaels
 * Date: 2019-06-03
 * Time: 14:08
 * Musical Inspiration: https://music.apple.com/us/album/re-member/1390704147
 */

namespace CM;

//use CM\ScraperInterface;

use CM\FileTypes\HTML;

class Scraper {

	public $path, $extensions, $limit;

	private $options = array();

	public $files = array();

	public function __construct($path, $exts) { // todo: Add $options array or create an options class that would handle presetting defaults if not options passed so it can be used to manipulate how the scrapper scrapes!

		$this->path = new Path($path);

		$this->extensions = (is_array($exts))? $exts : array($exts);

		$this->options = array(); //  todo: Make options CLASS

		$this->limit = $options->limit ?? -1;

		$this->files = $this->getFilesFromFolder($this->path);

	}

	public function __destruct() {
		// TODO: Implement __destruct() method.
		echo "Destroying ". __CLASS__ . "\n";
	}

	public function scrape(? int $limit = -1){

		// return $this->inExtensionsArray();  // shows files with null values for files not in list

		$this->files = ($limit)? array_slice($this->files,0 , $limit) : $this->files;   // Limit and set files to limit

		$filtered = $this->getFilteredNullFiles($limit);

		dd($filtered);

		$html = new HTML;

		$file = 0;
		return $html->load($filtered[$file]);


		return $this->getFilteredNullFiles($limit);  // gets the filters list with nulls popped from the array

	}

	public function getHtml($file){
		return file_get_contents($file);
	}

	/**
	 * @return int
	 */
	public function getLimit(): int {
		return $this->limit;
	}

	/**
	 * @param int $limit
	 */
	public function setLimit( int $limit ): void {
		$this->limit = $limit;
	}


	public function getFilesFromFolder(){
		try{
			return
				array_diff(
						scandir($this->path->path),
						['..','.', '.DS_Store']
					);

		}catch(Exception $exception){

			dd($exception);

		}
	}

	public function getFiltered(){
		return $this->getFilteredNullFiles();
	}

	private function getFilteredNullFiles(){

		return array_filter($this->inExtensionsArray());
	}

	private function inExtensionsArray(){

		   return array_map(function($file){
			 if(in_array($this->getFileExtension($file), $this->extensions)){
			 	return new Path($file);
			 }
		   }, $this->files);
	}

	private function getFileExtension($file){

		return ($file)? (pathinfo($file)['extension']?? null) : null;
	}

	/*private function filterArray($arr,$filter){  // This is more compare and remove from array (pop)

		return array_filter($arr,function($item) use($filter){
			return $item != $filter;
		});

	}*/

	public function getAllFolders($path){

		return $this->path->full_path;

	}


}
