<?php
/**
 * SettingFacade.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date    16.02.13
 */

namespace Flame\Blog\Entity\Settings;

class SettingFacade extends \Flame\Doctrine\Model\Facade
{

	/** @var string */
	protected $repositoryName = '\Flame\Blog\Entity\Settings\Setting';

	/** @var array */
	private $settings = array(
		'projectName' => Setting::STRING,
		'projectDesc' => Setting::STRING,
		'seoKeywords' => Setting::STRING,
		'seoDescription' => Setting::STRING,
		'defaultTitle' => Setting::STRING,
		'alllowComments' => Setting::BOOL,
		'alllowSharing' => Setting::BOOL,
		'disqusKey' => Setting::STRING,
		'itemsPerPage' => Setting::STRING,
	);

	/**
	 * @return array
	 */
	public function getAvailableSetting()
	{
		return $this->settings;
	}

	/**
	 * @param $name
	 * @return null
	 */
	public function getAvailableSettingByName($name)
	{
		return (isset($this->settings[$name])) ? $this->settings[$name] : null;
	}

	/**
	 * @param $name
	 * @return Setting
	 */
	public function getOneByName($name)
	{
		return $this->repository->findOneBy(array('name' => $name));
	}

	/**
	 * @return array
	 */
	public function getLast()
	{
		return $this->repository->findBy(array(), array('id' => 'DESC'));
	}

	/**
	 * @param $name
	 * @return string
	 */
	public function getSettingValue($name)
	{
		if($setting = $this->getOneByName($name)){
			return $setting->getValue();
		}
	}
}
