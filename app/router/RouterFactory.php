<?php

use Nette\Application\Routers\RouteList,
	Nette\Application\Routers\Route,
	Nette\Application\Routers\SimpleRouter;


/**
 * Router factory.
 */
class RouterFactory
{

	/**
	 * @return Nette\Application\IRouter
	 */
	public function createRouter()
	{
		$router = new RouteList();
		$router[] = new Route('index.php', ':Front:Homepage:default', Route::ONE_WAY);
		$router[] = new Route('<presenter>/<action>[/<id>]', array(
			'module' => 'Front',
			'presenter' => 'Homepage',
			'action' => 'default',
			'id' => null
		));
		return $router;
	}

}
