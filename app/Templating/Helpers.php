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
	
	/** @var \dflydev\markdown\MarkdownParser */
	private static $markdownParser;

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

	/**
	 * @param $text
	 * @return mixed
	 */
	public static function md($text)
	{
		$parser = static::getMakrdownParser();
		return $parser->transformMarkdown($text);
	}

	/**
	 * @return mixed
	 */
	private static function getMakrdownParser()
	{
		if(static::$markdownParser === null){
			static::$markdownParser = new \dflydev\markdown\MarkdownParser;
		}
		
		return static::$markdownParser;
	}

}
