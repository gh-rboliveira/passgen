<?php

require_once 'vendor/autoload.php';

use ZxcvbnPhp\Zxcvbn;

$args = $_REQUEST;

header('Content-Type: application/json');

try {
	//Generate
	$password = generatePassword($args);
	//Check strength
	$zxcvbn = new Zxcvbn();
	$strength =($zxcvbn->passwordStrength($password))['score'];

	//Start building positive response
	http_response_code(200);
	$response_arr = [
		"password" => $password,
		"strength" => $strength,
	];
} catch (Exception $e) {
	//Start building negative response
	http_response_code(400);
	$response_arr = [
		"error_msg" => $e->getMessage()
	];
}

//Send response
echo json_encode($response_arr);
exit();


/**
 * Function to generate a password based on array of arguments
 *
 * @param array $args - array of arguments
 * @return string $password - string representing the password
 * 
 * @throws Exception - if length is smaller than 
 */
function generatePassword($args) {

	$length		= $args['length'];
	$uppercase 	= $args['uppercase'] == 'true' ? true : false;
	$lowercase 	= $args['lowercase'] == 'true' ? true : false;
	$numbers 	= $args['numbers'] == 'true' ? true : false;
	$symbols 	= $args['symbols'] == 'true' ? true : false;
	$num_specifications = (+$uppercase + +$lowercase + +$numbers + +$symbols);
	$password = "";

	/* Validation length agains specifications */
	if ($length < $num_specifications) {
		throw new Exception('Length (' . $length . ') too small to satisfy specifications (' . $num_specifications . ').');
	}

	/**
	 * Make sure that we meet all specifications
	 */
	if ($uppercase) {
		$password .= rdmLetter(true);
	}

	if ($lowercase) {
		$password .= rdmLetter();
	}                                                               

	if ($numbers) {
		$password .= rdmNumber();
	}

	if ($symbols) {
		$password .= rdmSymbol();
	}
	
	/**
	 * Complete the password
	 */
	for ($i=strlen($password); $i<$length;$i++) {
		// Let's play with probabilities
		// 0,1,2,3 - Uppercase (40%)
		// 4,5,6,7 - Lowercase (40%)
		// 8 - Number (10%)
		// 9 - Symbol (10%)
		$rdmType = rand(0,9);
		switch ($rdmType) {
			case 0:
			case 1:
			case 2:
			case 3:
				$password .= rdmLetter(true);
				break;
			case 4:
			case 5:
			case 6:
			case 7:
				$password .= rdmLetter();
				break;
			case 8:
				$password .= rdmNumber();
				break;  
			default:
				$password .= rdmSymbol();
				break;
		}
	}


	//Shuffle one last time and return it
	return str_shuffle($password);
}

/**
 * rdmLetter - Generates and returns a random letter
 *
 * @param boolean $uppercase - if true returned letter will be uppercase, otherwise lowercase
 * @return char $letter - random letter
 */
function rdmLetter($uppercase = false) {
	$letter = chr(rand(97,122));
	return $uppercase ? strtoupper($letter) : $letter;
}

/**
 * rdmNumber - Generates and returns a random number
 *
 * @return int - random number
 */
function rdmNumber() {
	return rand(0,9);
}

/**
 * rdmSymbol - Generates and returns a random symbol
 *
 * @return char - random symbol
 */
function rdmSymbol() {
	return chr(rand(33,47));
}

?>