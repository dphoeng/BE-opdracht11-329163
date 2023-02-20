<?php

require 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class LandingpagesTest extends TestCase
{
	/**
	 * @dataProvider addProvider
	 */
	public static function testAdd($number1, $number2, $expected)
	{
		$landingpages = new Landingpages();

		$output = $landingpages->add($number1, $number2);

		$this->assertEquals($expected, $output);
	}

	public static function addProvider()
	{
		return [
			[1, 5, 6],
			[-1, 3, 2]
		];
	}
}
