<?php
	require "vendor/autoload.php";
	
	use Acme\Foo;

	$foo = new Foo();

	/* use Monolog\Logger;
	use App\product as Product;

	$log = new Logger('newName');
	$log->pushHandler(
	    new Monolog\Handler\StreamHandler('app.log', Monolog\Logger::WARNING)
	);
	 
	$log->addWarning('New foo');

	$prod = new Product; */