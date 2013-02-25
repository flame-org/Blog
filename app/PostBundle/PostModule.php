<?php
/**
 * PostModule.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date    20.02.13
 */

namespace Flame\Blog\PostBundle;

class PostModule extends \Flame\Bundles\BundleExtension
{

	public function loadConfiguration()
	{
		parent::loadConfiguration();

		$this->registerLatteMacro('\Flame\Blog\PostBundle\Latte\Macros\MarkdownMacros');
	}

}
