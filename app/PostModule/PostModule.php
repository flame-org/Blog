<?php
/**
 * PostModule.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date    20.02.13
 */

namespace Flame\Blog\PostModule;

class PostModule extends \Flame\Config\Extensions\ModuleExtension
{

	public function loadConfiguration()
	{
		parent::loadConfiguration();

		$this->registerLatteMacro('\Flame\Blog\PostModule\Latte\Macros\MarkdownMacros');
	}

}
