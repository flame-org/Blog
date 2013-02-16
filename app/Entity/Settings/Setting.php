<?php
/**
 * Setting.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date    16.02.13
 */

namespace Flame\Blog\Entity\Settings;

/**
 * @Entity(repositoryClass="\Flame\Doctrine\Model\Repository")
 */
class Setting extends \Flame\Doctrine\Entity
{

	const STRING = 1;

	const TEXT = 2;

	const BOOL = 3;

	/**
	 * @Column(type="integer", length=1)
	 */
	protected $type;

	/**
	 * @Column(type="string", length=255)
	 */
	protected $name;

	/**
	 * @Column(type="string", length=500)
	 */
	protected $value;

	public function __construct($name, $value)
	{
		$this->name = (string) $name;
		$this->value = (string) $value;

		$this->type = self::STRING;
	}

	public function getType()
	{
		return $this->type;
	}

	public function setType($type)
	{
		$this->type = (int) $type;
		return $this;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setName($name)
	{
		$this->name = (string) $name;
		return $this;
	}

	public function getValue()
	{
		return $this->value;
	}

	public function setValue($value)
	{
		$this->value = (string) $value;
		return $this;
	}
}
