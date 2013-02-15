<?php
/**
 * IPostControlFactory.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date    15.02.13
 */

namespace Flame\Blog\Components\Posts;

interface IPostControlFactory
{

	/**
	 * @param \Flame\Blog\Entity\Posts\Post $post
	 * @return PostControl
	 */
	public function create(\Flame\Blog\Entity\Posts\Post $post = null);

}
