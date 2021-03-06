<?php
/**
 * IPostFormFactory.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date    15.02.13
 */

namespace Flame\Blog\PostBundle\Components\Posts\Forms;

interface IPostFormFactory
{

	/**
	 * @param array $defauls
	 * @return PostForm
	 */
	public function create(array $defauls = array());

}
