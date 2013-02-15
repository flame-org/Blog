<?php
/**
 * Test.php
 *
 * @testCase
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date    03.01.13
 */

namespace Tests\TestCase;

require __DIR__ . '/../bootstrap.php';

use \Tester\Assert;

class Test extends \Flame\Tests\TestCase
{
	
	public function testTest()
	{
		Assert::true(true);
	}

}

run(new Test);
