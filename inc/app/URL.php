<?php
/**
 * Created for OGK Creative.
 * Project: the-scraper
 * Developer: Colin Michaels
 * Date: 2019-06-03
 * Time: 18:30
 */

namespace CM;

class URL {

	public $url, $scheme, $host, $port, $user, $pass, $path, $query, $fragment;
	protected $attr, $is_secure;


	public function __construct( $url ) {

		$this->url      = $url;
		$this->attr     = parse_url( $this->url );
		$this->scheme   = $this->attr['scheme'] ?? null;
		$this->host     = $this->attr['host'] ??  $_SERVER['REMOTE_HOST'] ?? null;
		$this->port     = $this->attr['port'] ?? $_SERVER['REMOTE_PORT'] ?? null;
		$this->user     = $this->attr['user'] ?? $_SERVER['REMOTE_USER'] ?? null;
		$this->path     = $this->attr['path'] ?? null;
		$this->query    = $this->attr['query'] ?? null;
		$this->fragment = $this->attr['fragment'] ?? null;
		$this->is_secure = ($this->scheme == 'https') ?? false;

	}

	public function toArray(){
		return $this->attr;
	}

	public function unparse( $url ) {

		$scheme   = isset( $url['scheme'] ) ? $url['scheme'] . '://' : '';
		$host     = isset( $url['host'] ) ? $url['host'] : '';
		$port     = isset( $url['port'] ) ? ':' . $url['port'] : '';
		$user     = isset( $url['user'] ) ? $url['user'] : '';
		$pass     = isset( $url['pass'] ) ? ':' . $url['pass'] : '';
		$pass     = ( $user || $pass ) ? "$pass@" : '';
		$path     = isset( $url['path'] ) ? $url['path'] : '';
		$query    = isset( $url['query'] ) ? '?' . $url['query'] : '';
		$fragment = isset( $url['fragment'] ) ? '#' . $url['fragment'] : '';

		return "$scheme$user$pass$host$port$path$query$fragment";

	}

}
