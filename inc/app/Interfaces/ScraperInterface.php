<?php
/**
 * Created for OGK Creative.
 * Project: the-scraper
 * Developer: Colin Michaels
 * Date: 2019-06-04
 * Time: 23:11
 */

namespace CM;

interface ScraperInterface {
	public function scrape( &$limit );

	public function getFilesFromFolder();

	public function getFiltered();

	public function getAllFolders( $path );
}
