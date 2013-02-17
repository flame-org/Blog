<?php
/**
 * IWpImportFormFactory.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date    17.02.13
 */

namespace Flame\Blog\Components\Imports\WordPress\Forms;

interface IWpImportFormFactory
{

	/**
	 * @return WpImportForm
	 */
	public function create();

}
