<?php
/**
 * Project: the-scraper
 * Developer: Colin Michaels
 * Date: 2019-06-03
 * Time: 14:08
 * Musical Inspiration: https://music.apple.com/us/album/re-member/1390704147
 */

namespace CM;

use CM\FileTypes\HTML;
use Cocur\Slugify\Slugify;
use CM\Exports\PagesExport;

interface ScraperInterface {

	public function scrape( &$limit );
}

class Scraper {

	public $path, $extensions;

	private $limit, $offset;

	private $options = array();

	public $files = array();

	private $filtered = array();

	public $pages = array();

	public function __construct( $path, ? string $exts = null ) { // todo: Add $options array or create an options class that would handle presetting defaults if not options passed so it can be used to manipulate how the scrapper scrapes!

		$this->path = new Path( $path );

		$this->extensions = new Extension($exts);

		$this->options = array(); //  todo: Make options CLASS

		$this->limit = $options->limit ?? - 1;

		$this->offset = $options->offset ?? - 1;

		$this->files = $this->getFilesFromFolder( $this->path );

		$this->filtered = array_values( $this->getFilteredNullFiles( $this->limit ) );

		//$this->pages = new Page($this->path->path,implode(",",$this->extensions->extensions));

	}

	public function scrape( ? int $limit = - 1, ? int $offset = - 1 ) {

		$this->setOffset(( $offset ) ?? 0);

		$this->setLimit(($limit)?? -1);

		$this->files = ( $limit ) ? array_slice( $this->files, $offset, $limit ) : $this->files;   // Limit and set files to limit

		$this->filtered = array_values( $this->getFilteredNullFiles( $limit ) );

		$this->allPages();

//		$this->createCsv();

		return "done";
	}

	public function allPages(){
		$pages = array();
		$i = 0;
		foreach ( $this->filtered as $file ) {
			$dom       = new HTML;
			$file_path = $this->path->path . '/' . $file;
			$dom->load( $file_path );

			$meta_tags = get_meta_tags( $file_path );

			$page              = new Page($this->path->path, $this->extensions);
			$page->id          = $i;
			$page->title       = $dom->find( 'title' )->innerHtml;
			$page->content     = $dom->find( '.bodyText' )->innerHtml;
			$page->slugify     = (new Slugify())->slugify($page->title);
			$page->description = $meta_tags['description'] ?? null;
			$page->keywords    = $meta_tags['keywords'] ?? null;
			$page->robots      = $meta_tags['robots'] ?? null;
			$page->links       = $dom->find( 'a' )->outerHtml;
			$page->videos      = (count($dom->find( 'iframe' ))) ? $dom->find( 'iframe' )->innerHtml : null;
			$page->old_path    = current($this->filtered);

			array_push($pages, $page);

			$i++;
		}
		
		 $this->setPages($pages);
	}


	/**
	 * @param int $offset
	 */
	public function setOffset( int $offset ): void {
		$this->offset = $offset;
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

	/**
	 * @return array
	 */
	public function getPages(): array {
		return $this->pages;
	}

	/**
	 * @param array $pages
	 */
	public function setPages( array $pages ): void {
		$this->pages = $pages;
	}

	public function createCsv(){

		(new PagesExport)->export();

	}

	public function getFilesFromFolder() {
		try {
			return
				array_diff(
					scandir( $this->path->path ),
					[ '..', '.', '.DS_Store' ]
				);

		} catch ( Exception $exception ) {

			dd( $exception );

		}
	}

	/**
	 * @return array
	 */

	public function getFiltered() {
		return $this->getFilteredNullFiles();
	}

	/**
	 * @return array
	 *
	 * gets the filters list with nulls popped from the array
	 *
	 */

	private function getFilteredNullFiles() {

		return
			array_filter( $this->inExtensionsArray() );
	}

	/**
	 * @return array
	 *
	 *  shows files with null values for files not in list
	 */

	private function inExtensionsArray() {

		return array_map( function ( $file ) {
			if ( in_array( $this->getFileExtension( $file ), $this->extensions->extensions ) ) {
				return  $file;
			}
		}, $this->files );
	}

	private function getFileExtension( $file ) {

		return ( $file ) ? ( pathinfo( $file )['extension'] ?? null ) : null;
	}

	public function getAllFolders( $path ) {

		return $this->path->full_path;

	}

	public function __destruct() {
		// TODO: Implement __destruct() method.
		echo "Destroying " . __CLASS__ . "\n";
	}

}

class Extension {

	public $extensions;

	public function __construct( $exts ) {
		$this->extensions = ( is_array( $exts ) ) ? $exts : array( $exts );
	}

	public function __toString() {
		return implode(",",$this->extensions);
	}

}
