<?php
/**
 * Helpers.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date    15.02.13
 */

namespace Flame\Blog\Templating;

class Helpers extends \Nette\Object
{

	/**
	 * @param $helper
	 * @return \Nette\Callback
	 */
	public static function loader($helper)
	{
		if (method_exists(__CLASS__, $helper)) {
			return new \Nette\Callback(__CLASS__, $helper);
		}
	}

}
