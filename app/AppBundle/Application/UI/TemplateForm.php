<?php
/**
 * TemplateForm.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date    15.02.13
 */

namespace Flame\Blog\AppBundle\Application\UI;

class TemplateForm extends \Flame\Application\UI\TemplateForm
{

	public function __construct()
	{
		parent::__construct();

		$this->setRenderer(new \Kdyby\BootstrapFormRenderer\BootstrapRenderer);
	}

}
