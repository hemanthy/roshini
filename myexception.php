<?php
/**
 * Define a custom exception class
*/

include_once 'dbconnect.php';

$conn;

class MyException extends Exception
{
	
	public $connection = $conn;
	
	// Redefine the exception so message isn't optional
	public function __construct($message, $code = 0, Exception $previous = null,$conn) {
		// some code
		// make sure everything is assigned properly
		parent::__construct($message, $code, $previous);
	}

	// custom string representation of object
	public function __toString() {
		$this->logerrorintodb($this->message, $conn);
		return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
	}

	public function customFunction() {
		echo "A custom function for this type of exception\n";
	}
	
	public function logerrorintodb($msg,$conn){
		$stmt = $conn->prepare('INSERT INTO error (logmsg) VALUES (:logmsg)');
		$stmt->execute(array(
				':logmsg' => $msg
		));
		echo $msg;
	}
}

?>