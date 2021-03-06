<?php
/**
 * BlogMacros.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date    15.02.13
 */

namespace Flame\Blog\PostBundle\Latte\Macros;

class MarkdownMacros extends \Nette\Latte\Macros\MacroSet
{

	/** @var \Michelf\MarkdownExtra */
	private static $markdownParser;

	/**
	 * @param \Nette\Latte\Compiler $compiler
	 * @return \Nette\Latte\Macros\MacroSet|void
	 */
	public static function install(\Nette\Latte\Compiler $compiler)
	{
		$me = new static($compiler);
		$me->addMacro('md', array($me, 'markdownParser'));
		return $me;
	}

	/**
	 * @param \Nette\Latte\MacroNode $node
	 * @param \Nette\Latte\PhpWriter $writer
	 * @return string
	 */
	public static function markdownParser(\Nette\Latte\MacroNode $node, \Nette\Latte\PhpWriter $writer)
	{
		$cmd = "echo " . __CLASS__ . "::getMakrdownParser()->transform(%node.word)";
		return $writer->write($cmd);
	}

	/**
	 * @return mixed
	 */
	public static function getMakrdownParser()
	{
		if(static::$markdownParser === null){
			static::$markdownParser = new \Michelf\MarkdownExtra;
		}

		return static::$markdownParser;
	}

}
