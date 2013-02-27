<?php
/**
 * Test: Flame\Blog\Tests\PostBundle\Entity\Posts\PostFacade
 *
 * @testCase Flame\Blog\Tests\PostBundle\Entity\Posts\PostFacadeTest
 * @author Jiří Šifalda <sifalda.jiri@gmail.com>
 * @package Flame\Blog\Tests\PostBundle\Entity\Posts
 */
namespace Flame\Blog\Tests\PostBundle\Entity\Posts;

use Tester\Assert;

$container = require_once __DIR__ . '/../../../bootstrap.php';

class PostFacadeTest extends \Flame\Tests\DoctrineTestCase
{

	public function testGetLast()
	{
		$repositoryMock = $this->getRepositoryMock();
		$repositoryMock->expects('findBy')
			->with(array(), array('id' => 'DESC'))
			->once()
			->andReturn(array());

		$postFacade = $this->getPostFacade($repositoryMock);

		Assert::same(array(), $postFacade->getLast());
	}

	public function testGetLastPublic()
	{
		$limit = 12;
		$repositoryMock = $this->getRepositoryMock();
		$repositoryMock->expects('findBy')
			->with(array('public' => true), array('id' => 'DESC'), $limit)
			->once()
			->andReturn(array());

		$postFacade = $this->getPostFacade($repositoryMock);

		Assert::same(array(), $postFacade->getLastPublic($limit));
	}

	public function testIncreaseViews()
	{
//		$postMock = $this->mockista->create('\Flame\Blog\PostBundle\Entity\Posts\Post');
//		$postMock->expects('getViews')
//			->once()
//			->andReturn(2);
//		$postMock->expects('setViews')
//			->once()
//			->with(3);
//
//		$postFacade = $this->getPostFacade();
//
//		Assert::null($postFacade->increaseViews($postMock));
	}
	/**
	 * @param string $method
	 * @param null $returnVal
	 * @return \Mockista\MockInterface
	 */
	protected function getRepositoryMock($method = '', $returnVal = null)
	{
		return $this->mockista->create('\Flame\Doctrine\Model\Repository');
	}

	/**
	 * @param null $repository
	 * @return \Flame\Blog\PostBundle\Entity\Posts\PostFacade
	 */
	protected function getPostFacade($repository = null)
	{
		$emMock = $this->getEmMock($repository);
		return new \Flame\Blog\PostBundle\Entity\Posts\PostFacade($emMock);
	}
}

run(new PostFacadeTest($container));