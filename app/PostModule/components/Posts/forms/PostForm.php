<?php
/**
 * PostForm.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date    15.02.13
 */

namespace Flame\Blog\Components\Posts\Forms;

class PostForm extends \Flame\Blog\Application\UI\TemplateForm
{

	/** @var bool */
	private $update = false;

	/** @var array */
	private $default = array(
		'public' => true
	);

	/** @var \Flame\Blog\Model\Posts\PostManager */
	private $postManager;

	/**
	 * @param \Flame\Blog\Model\Posts\PostManager $postManager
	 */
	public function injectPostManager(\Flame\Blog\Model\Posts\PostManager $postManager)
	{
		$this->postManager = $postManager;
	}

	/**
	 * @param array $default
	 */
	public function __construct(array $default = array())
	{
		parent::__construct();

		$this->update = (bool) count($default);
		$this->default = array_merge($this->default, $default);

		$this->configure();
		if($this->update){
			$this->edit();
		}else{
			$this->add();
		}

		$this->setDefaults($this->default);
		$this->onSuccess[] = $this->formSubmitted;
	}

	/**
	 * @param PostForm $form
	 */
	public function formSubmitted(PostForm $form)
	{
		try {
			if($this->update){
				$this->postManager->update($this->default['id'], $form->getValues());
			}else{
				$this->postManager->create($form->getValues());
			}

			$this->presenter->flashMessage('Done', 'success');
		}catch (\Nette\InvalidArgumentException $ex) {
			$form->addError($ex->getMessage());
		}
	}

	private function edit()
	{
		$this->addSubmit('send', 'Edit post')
			->setAttribute('class', 'btn-primary');
	}

	private function add()
	{
		$this->addSubmit('send', 'Create post')
			->setAttribute('class', 'btn-primary');
	}

	private function configure()
	{
		$this->addText('title', 'Title', 80, 250)
			->setRequired();
		$this->addTextArea('content', 'Content', 62, 20)
			->setRequired();
		$this->addCheckbox('public', 'Make the post public?');
	}

}
