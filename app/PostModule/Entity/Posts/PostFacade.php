<?php
/**
 * PostFacade.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date    15.02.13
 */

namespace Flame\Blog\Entity\Posts;

class PostFacade extends \Flame\Doctrine\Model\Facade
{

	protected $repositoryName = '\Flame\Blog\Entity\Posts\Post';

	/**
	 * @return array
	 */
	public function getLast()
	{
		return $this->repository->findBy(array(), array('id' => 'DESC'));
	}

	/**
	 * @param $limit
	 * @return array
	 */
	public function getLastPublic($limit = null)
	{
		return $this->repository->findBy(array('public' => true), array('id' => 'DESC'), $limit);
	}

	/**
	 * @param Post $post
	 * @return mixed
	 */
	public function increaseViews(Post $post)
	{
		$post->setViews($post->getViews() + 1);
		return $this->save($post);
	}

	/**
	 * @param $id
	 * @return Post
	 */
	public function getOnePublic($id)
	{
		return $this->repository->findOneBy(array('id' => $id, 'public' => 1));
	}
}
