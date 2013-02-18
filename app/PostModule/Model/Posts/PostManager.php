<?php
/**
 * PostManager.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date    15.02.13
 */

namespace Flame\Blog\Model\Posts;

class PostManager extends \Flame\Model\Manager
{

	/** @var \Flame\Blog\Entity\Posts\PostFacade */
	private $postFacade;

	/**
	 * @param \Flame\Blog\Entity\Posts\PostFacade $postFacade
	 */
	public function injectPostFacade(\Flame\Blog\Entity\Posts\PostFacade $postFacade)
	{
		$this->postFacade = $postFacade;
	}

	/**
	 * @param $data
	 * @return \Flame\Blog\Entity\Posts\Post
	 */
	public function create($data)
	{
		$data = $this->validateInput($data, array('public', 'content', 'title'));

		$post = $this->createPost($data->title, $data->content);
		$post->setPublic($data->public);

		if(isset($data['date']))
			$post->setDate($data['date']);

		$this->postFacade->save($post);
		return $post;
	}

	/**
	 * @param $id
	 * @param $data
	 * @return \Flame\Blog\Entity\Posts\Post
	 * @throws \Nette\InvalidArgumentException
	 */
	public function update($id, $data)
	{
		/** @var $post \Flame\Blog\Entity\Posts\Post */
		if($post = $this->postFacade->getOne($id)){
			$data = $this->validateInput($data, array('public', 'content', 'title'));
			$post->setPublic($data->public)
				->setTitle($data->title)
				->setContent($data->content);
			$this->postFacade->save($post);
			return $post;
		}else{
			throw new \Nette\InvalidArgumentException('Post with ID ' . $id . ' does not exist');
		}
	}

	/**
	 * @param $title
	 * @param $content
	 * @return \Flame\Blog\Entity\Posts\Post
	 */
	protected function createPost($title, $content)
	{
		return new \Flame\Blog\Entity\Posts\Post($title, $content);
	}

}
