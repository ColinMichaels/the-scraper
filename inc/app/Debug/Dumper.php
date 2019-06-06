<?php
/**
 * Created by PhpStorm.
 * User: colin
 * Date: 2019-02-16
 * Time: 12:24
 * adopted from  Illuminate\Support\Debug;
 */
namespace OGK\Debug;
use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\CliDumper;

class Dumper {
	/**
	 * Dump a value with elegance.
	 *
	 * @param  mixed  $value
	 * @return void
	 */
	public function dump($value)
	{
		if (class_exists(CliDumper::class)) {
			$dumper = in_array(PHP_SAPI, ['cli', 'phpdbg']) ? new CliDumper : new HtmlDumper;

			$dumper->dump((new VarCloner)->cloneVar($value));
		} else {
			var_dump($value);
		}
	}
}