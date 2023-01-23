<?php

class Landingpages
{
	public function __construct()
	{
	}

	public function index()
	{
		echo "<a href=" . URLROOT . "/lessen/>Lessen</a>";
		echo "<br><a href=" . URLROOT . "/countries/>Countries</a>";
		echo "<br><a href=" . URLROOT . "/instructeurs/>Instructeurs</a>";
	}
}
