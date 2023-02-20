<?php

class Landingpages extends Controller
{
	public function __construct()
	{
	}

	public function index()
	{
		$sumText = "45 + 6 = " . $this->add(45, 6);
		echo "<a href=" . URLROOT . "/lessen/>Lessen</a>";
		echo "<br><a href=" . URLROOT . "/countries/>Countries</a>";
		echo "<br><a href=" . URLROOT . "/instructeurs/>Instructeurs</a>";
		$data = ['sumText' => $sumText];

		$this->view('landingpages/index', $data);
	}

	public function add($number1, $number2)
	{
		$sum = $number1 + $number2;
		return $sum;
	}
}
