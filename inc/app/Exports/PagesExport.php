<?php

namespace CM\Exports;

use CM\Page;

use SimpleExcel\SimpleExcel;

class PagesExport extends Page{

	public static function export() {

		$csv = new SimpleExcel('csv');

		//$all_pages = new Page::all();


		$csv->writer->setData(
				array(
					array('ID', 'Title','Content','Slug','Keywords','Description','Videos','Path')
				)
		);

		$csv->writer->saveFile('pages-'.date('ddmmyyhi'));

	}

}
