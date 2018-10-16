<?php
	require "vendor/autoload.php";

	use Carbon\Carbon;

	// Show up current date
	printf("Now: %s", Carbon::now());