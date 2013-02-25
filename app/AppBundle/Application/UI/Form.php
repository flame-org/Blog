<?php
/**
 * Form.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date    15.02.13
 */

namespace Flame\Blog\AppBundle\Application\UI;

class Form extends \Flame\Application\UI\Form
{

	public function __construct()
	{
		parent::__construct();

		$this->setRenderer(new \Kdyby\BootstrapFormRenderer\BootstrapRenderer);
	}

}
