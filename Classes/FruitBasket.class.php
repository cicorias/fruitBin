<?

/*Fruit Basket - object that will function as container for holding the fruits && exchange of fruits*/

class FruitBasket {

	private $_input_File_Path,//@_inputFile_Path: path to input file on server
			$_output_File_Path,//@_output_File_path: path to output file if needed - we may allow direct downlaod when complete
			$_tempVar,//@_tempVar: temp value to be switched - unknown if yet needed
			$_tempFruit,//@_tempFruit: temp fruit to be used in switch - unknown if yet needed
			//@_replacements: associative array to hold metrics of the conversion for late ruse in a database insert to permantly store metrics of the fruitify application syntax for array is as follows:
			// array = ( 'strings' => 2, 'array' => 5, 'integers' => 6); This array will be contingent on the ability to find the data type using php for now and then storing how many of each data type was found- to be added later on as a feature
			$_replacements = array(),
			$_isDone = false;//@_isDone: boolean to know if file is done yet

	private function __construct() {
	 	//get input file name and set the output file name ot be the same name
	}

	public static function setOutput_File_Path($filePath) {
		$this->_output_File_Path = $filePath;
	}

	public static function getOutput_File_Path($filePath) {
		return $this->_output_File_Path;
	}	
	
	public function addReplacements($type) {
		//check if data type exists
		if (!array_key_exists($type, $this->_replacements)) {
			//if not exists in array set new index for holding # of this data type and set count = 1
			$this->_replacements[$type] = 1;
		}
		//if data type allready exists just incriment ++
		else if (array_key_exists($type, $this->_replacements)) {
			$this->_replacements[$type] += 1;
		}
	}

	public static function getReplacements() {
		return $this->_replacements;
	}	

}

?>
