<?php
//please add comments >:O

	$file = $argv[1];
	$total_variables = array();

	$contents = file_get_contents($file);
	$lines = split("\n", $contents);

	foreach ($lines as &$line) {	
		$line = preg_replace('/^\s+/', '', $line);
		$line = preg_replace('/\s+$/', '', $line);

		if(preg_match('/\$\w+/', $line)) {
			$line = preg_replace('/^.+?\$/', '\$', $line);
			$line = preg_replace('/=.+?;/',',', $line);
			$line = preg_replace('/;/', ',', $line);
			$line = preg_replace('/{/', '', $line);
			$line = preg_replace('/}/', '', $line);
			$line = preg_replace('/\[\d+\]/', ',', $line);
	
			$line = preg_replace('/^,/', '', $line);
			$line = preg_replace('/,$/', '', $line);
			$line = preg_replace('/\)$/', '', $line);
			$line = preg_replace('/\($/', '', $line);

			$variables = preg_split('/,/', $line);
	
			if(count($variables) > 0) {
				foreach($variables as &$variable) {
					if(preg_match('/\(\)$/', $variable)) {
						continue;
					} else {
						$variable = preg_replace('/^\s+/', '', $variable);
						array_push($total_variables, $variable);
					}
				}
			}
		}
	}

	foreach ($total_variables as &$var) {
		print "$var\n";
	}
?>
