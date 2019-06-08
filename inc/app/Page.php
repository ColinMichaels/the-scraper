<?php
/**
 * Created for OGK Creative.
 * Project: the-scraper
 * Developer: Colin Michaels
 * Date: 2019-06-07
 * Time: 01:33
 */

namespace CM;

class Page extends Scraper {

	public $id, $title, $description, $content, $links, $videos, $slugify, $keywords, $robots, $old_path;

	public function __construct( $path, ?string $exts = null ) {
		parent::__construct( $path, $exts );
	}

	public function all() {

		return $this->parent->allPages();
	}

	public function __toArray() {

		return array(
			$this->id,
			$this->title,
			$this->content,
			$this->slugify,
			$this->keywords,
			$this->description,
			$this->videos,
			$this->old_path
		);

	}

	/**
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param mixed $id
	 */
	public function setId( $id ): void {
		$this->id = $id;
	}

	/**
	 * @return mixed
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @param mixed $title
	 */
	public function setTitle( $title ): void {
		$this->title = $title;
	}

	/**
	 * @return mixed
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * @param mixed $description
	 */
	public function setDescription( $description ): void {
		$this->description = $description;
	}

	/**
	 * @return mixed
	 */
	public function getContent() {
		return $this->content;
	}

	/**
	 * @param mixed $content
	 */
	public function setContent( $content ): void {
		$this->content = $content;
	}

	/**
	 * @return mixed
	 */
	public function getLinks() {
		return $this->links;
	}

	/**
	 * @param mixed $links
	 */
	public function setLinks( $links ): void {
		$this->links = $links;
	}

	/**
	 * @return mixed
	 */
	public function getVideos() {
		return $this->videos;
	}

	/**
	 * @param mixed $videos
	 */
	public function setVideos( $videos ): void {
		$this->videos = $videos;
	}

	/**
	 * @return mixed
	 */
	public function getSlugify() {
		return $this->slugify;
	}

	/**
	 * @param mixed $slugify
	 */
	public function setSlugify( $slugify ): void {
		$this->slugify = $slugify;
	}

	/**
	 * @return mixed
	 */
	public function getKeywords() {
		return $this->keywords;
	}

	/**
	 * @param mixed $keywords
	 */
	public function setKeywords( $keywords ): void {
		$this->keywords = $keywords;
	}

	/**
	 * @return mixed
	 */
	public function getRobots() {
		return $this->robots;
	}

	/**
	 * @param mixed $robots
	 */
	public function setRobots( $robots ): void {
		$this->robots = $robots;
	}

	/**
	 * @return mixed
	 */
	public function getOldPath() {
		return $this->old_path;
	}

	/**
	 * @param mixed $old_path
	 */
	public function setOldPath( $old_path ): void {
		$this->old_path = $old_path;
	}

}
