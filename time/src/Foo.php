<?php
	namespace Acme;

	use Monolog\Logger;
	use Monolog\Handler\StreamHandler;

	class Foo
	{
		function __construct()
		{
			echo "hello";

		    $log = new Logger('FooLogger1');
			$log->pushHandler(
			    new StreamHandler('app.log', Logger::WARNING)
			);
			 
			$log->addWarning('New foo Logger 1'); 
		}
	}