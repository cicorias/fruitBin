<?php

class ParseVariables {
	private $file;

	function __construct($file) {
		$this->file = $file;
	}

	function get_lines() {
		$file = $this->get_file();
		$contents = file_get_contents($file);
		$lines = split("\n", $contents);
		return $lines;
	}

	function get_file() {
		return $this->file;
	}

	function get_variables() {
		//Getting array of lines from a file
		//Extracting only variables starting with a '$'
		//Storing them to a list
		//Removing Duplicates from the list
		$lines = $this->get_lines();
		$total_variables = array();

		foreach ($lines as &$line) {
			//Get rid spaces from beginning and end of line
			$line = preg_replace('/^\s+/', '', $line);
			$line = preg_replace('/\s+$/', '', $line);

			//Getting lines that start with '$' and have alphanumeric combination
			if(preg_match('/\$[a-zA-Z_][a-zA-Z0-9_]/', $line)) {
				//Determining how many alphanumeric variables are around
				$num_vars_found = preg_match_all('/\$[a-zA-Z_][a-zA-Z0-9_]/', $line);

				if($num_vars_found < 1) {
					continue;
				} else {
					//Removing beginning characters up to $
					$line = preg_replace('/^.+?\$/', '\$', $line);
					//Substituting 1+ spaces for a single comma
					$line = preg_replace('/\s+/', ',', $line);
					//Substituting 2+ commas for single comma
					$line = preg_replace('/[,]{2,}/', ',', $line);
					//Substituting comma at end line of line for nothing
					$line = preg_replace('/,$/', '', $line);

					//Array created to split sections by comma
					$line_array = split(",", $line);
				
					//Need to refactor the following code as there
					//is a duplication. See below!	
					if(count($line_array) == 1) {
						$variable = null;
						$char_array = str_split($line);
						$dollar_found = 0;
						foreach ($char_array as &$char) {
							if(preg_match('/[\$a-zA-Z0-9_]/', $char)) {
								if(!isset($variable)) {
									if(preg_match('/\$/', $char)) {
										$dollar_found = 1;
										$variable = $char;
									}
								} else {
									if($dollar_found == 1) {
										$variable .= $char;
									}
								}
							} else {
								if(isset($variable)) {
									if($dollar_found == 1) {
										if($variable != '$') {
											array_push($total_variables, $variable);
										}
										$dollar_found = 0;
										$variable = null;
									}
								}
							}
						}
					} else {
						$variable = null;
						$char_array = str_split($line);
						$dollar_found = 0;
						foreach ($char_array as &$char) {
							if(preg_match('/[\$a-zA-Z0-9_]/', $char)) {
								if(!isset($variable)) {
									if(preg_match('/\$/', $char)) {
										$dollar_found = 1;
										$variable = $char;
									}
								} else {
									if($dollar_found == 1) {
										$variable .= $char;
									}
								}
							} else {
								if(isset($variable)) {
									if($dollar_found == 1) {
										if($variable != '$') {
											array_push($total_variables, $variable);
										}
										$dollar_found = 0;
										$variable = null;
									}
								}
							}
						}
					}
				}
			}
		}
		$unique = array_unique($total_variables);
		foreach ($unique as &$var) {
			print "$var\n";
		}
	}
}
?>