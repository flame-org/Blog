<?php
/**
 * BlogMacros.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date    16.02.13
 */

namespace Flame\Blog\Latte\Macros;

class BlogMacros extends \Nette\Latte\Macros\MacroSet
{

	/**
	 * @param \Nette\Latte\Compiler $compiler
	 * @return BlogMacros|\Nette\Latte\Macros\MacroSet
	 */
	public static function install(\Nette\Latte\Compiler $compiler)
	{
		$me = new static($compiler);
		return $me;
	}

}
