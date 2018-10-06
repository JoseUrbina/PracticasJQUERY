<?php 
	// Reverse a chain
	// 
	function reverseChain($chain)
	{
		$newChain = join('',array_reverse(str_split($chain)));

		return $newChain;
	}

	$chain = "Pull over all";
	$rChain = reverseChain($chain);

	echo "Reverse chain: {$rChain}";
