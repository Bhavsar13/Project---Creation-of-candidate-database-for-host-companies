<?php
require_once(LIB_PATH.DS.'database.php');
class Applicants {
	protected static  $tblname = "tblapplicants";

    
	function dbfields () {
		global $mydb;
		return $mydb->getfieldsononetable(self::$tblname);

	}
    
    
function generateRandomToken($length = 32) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $token = '';

    for ($i = 0; $i < $length; $i++) {
        $token .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $token;
}
    // Inside your Applicants class, add the findByVerificationToken function:

public static function findByVerificationToken($verificationToken) {
    global $mydb;

    // Sanitize the token to prevent SQL injection
    $verificationToken = $mydb->escape_value($verificationToken);

    $query = "SELECT * FROM " . self::$tblname . " WHERE EMAIL_VERIFICATION_TOKEN = '$verificationToken' LIMIT 1";
    $mydb->setQuery($query);
    $cur = $mydb->executeQuery();

    if ($cur === false) {
        // An error occurred while executing the query
        return null;
    }

    $row = $mydb->fetch_array($cur);

    if ($row) {
        // User with the verification token found, create an instance and return it
        return self::instantiate($row);
    } else {
        // No user found with the given token
        return null;
    }
}

    
    public static function usernameExists($username) {
        global $mydb;
        $username = $mydb->escape_value($username); // Sanitize the username

        $query = "SELECT * FROM " . self::$tblname . " WHERE USERNAME = '$username'";
        $mydb->setQuery($query); // Set the query string
        $cur = $mydb->executeQuery(); // Execute the query

        if ($cur === false) {
            // An error occurred while executing the query
            return false;
        }

        $row_count = $mydb->num_rows($cur); // Get the number of rows

        return $row_count > 0; // Return true if rows exist, indicating that the username already exists
    }

    public static function emailExists($email) {
        global $mydb;
        $email = $mydb->escape_value($email); // Sanitize the email

        $query = "SELECT * FROM " . self::$tblname . " WHERE EMAILADDRESS = '$email'";
        $mydb->setQuery($query); // Set the query string
        $cur = $mydb->executeQuery(); // Execute the query

        if ($cur === false) {
            // An error occurred while executing the query
            return false;
        }

        $row_count = $mydb->num_rows($cur); // Get the number of rows

        return $row_count > 0; // Return true if rows exist, indicating that the email already exists
    }
    
	function listofapplicant(){
		global $mydb;
		$mydb->setQuery("SELECT * FROM ".self::$tblname);
		return $cur;
	}
	function find_applicant($id="",$name=""){
		global $mydb;
		$mydb->setQuery("SELECT * FROM ".self::$tblname." 
			WHERE APPLICANTID = {$id} OR Lastname = '{$name}'");
		$cur = $mydb->executeQuery();
		$row_count = $mydb->num_rows($cur);
		return $row_count;
	}

	function find_all_applicant($lname="",$Firstname="",$mname=""){
		global $mydb;
		$mydb->setQuery("SELECT * FROM ".self::$tblname." 
			WHERE LNAME = '{$lname}' AND FNAME= '{$Firstname}' AND MNAME='{$mname}'");
		$cur = $mydb->executeQuery();
		$row_count = $mydb->num_rows($cur);
		return $row_count;
	}
	 
    
	function single_applicant($id=""){
			global $mydb;
			$mydb->setQuery("SELECT * FROM ".self::$tblname." 
				Where APPLICANTID= '{$id}' LIMIT 1");
			$cur = $mydb->loadSingleResult();
			return $cur;
	}
	function select_applicant($id=""){
			global $mydb;
			$mydb->setQuery("SELECT * FROM ".self::$tblname." 
				Where APPLICANTID= '{$id}' LIMIT 1");
			$cur = $mydb->loadSingleResult();
			return $cur;
	}
	function applicantAuthentication($U_USERNAME,$h_pass){
	global $mydb;
	$mydb->setQuery("SELECT * FROM `tblapplicants` WHERE `USERNAME`='".$U_USERNAME."' AND `PASS`='".$h_pass."'");
	$cur = $mydb->executeQuery();
	if($cur==false){
	die(mysql_error());
	}
	$row_count = $mydb->num_rows($cur);//get the number of count
	if ($row_count == 1){
	$emp_found = $mydb->loadSingleResult();
	$_SESSION['APPLICANTID'] = $emp_found->APPLICANTID;
	$_SESSION['USERNAME'] = $emp_found->USERNAME;
	return true;
	}else{
	return false;
	}
	}

	 
	/*---Instantiation of Object dynamically---*/
	static function instantiate($record) {
		$object = new self;

		foreach($record as $attribute=>$value){
		  if($object->has_attribute($attribute)) {
		    $object->$attribute = $value;
		  }
		} 
		return $object;
	}
	
	
	/*--Cleaning the raw data before submitting to Database--*/
	private function has_attribute($attribute) {
	  // We don't care about the value, we just want to know if the key exists
	  // Will return true or false
	  return array_key_exists($attribute, $this->attributes());
	}

	protected function attributes() { 
		// return an array of attribute names and their values
	  global $mydb;
	  $attributes = array();
	  foreach($this->dbfields() as $field) {
	    if(property_exists($this, $field)) {
			$attributes[$field] = $this->$field;
		}
	  }
	  return $attributes;
	}
	
	protected function sanitized_attributes() {
	  global $mydb;
	  $clean_attributes = array();
	  // sanitize the values before submitting
	  // Note: does not alter the actual value of each attribute
	  foreach($this->attributes() as $key => $value){
	    $clean_attributes[$key] = $mydb->escape_value($value);
	  }
	  return $clean_attributes;
	}
	
	
	/*--Create,Update and Delete methods--*/
	public function save() {
	  // A new record won't have an id yet.
	  return isset($this->id) ? $this->update() : $this->create();
	}
	
	public function create() {
		global $mydb;
		// Don't forget your SQL syntax and good habits:
		// - INSERT INTO table (key, key) VALUES ('value', 'value')
		// - single-quotes around all values
		// - escape all values to prevent SQL injection
		$attributes = $this->sanitized_attributes();
		$sql = "INSERT INTO ".self::$tblname." (";
		$sql .= join(", ", array_keys($attributes));
		$sql .= ") VALUES ('";
		$sql .= join("', '", array_values($attributes));
		$sql .= "')";
	echo $mydb->setQuery($sql);
	
	 if($mydb->executeQuery()) {
	    $this->id = $mydb->insert_id();
	    return true;
	  } else {
	    return false;
	  }
	}
    
    

	public function update($id='') {
	  global $mydb;
		$attributes = $this->sanitized_attributes();
		$attribute_pairs = array();
		foreach($attributes as $key => $value) {
		  $attribute_pairs[] = "{$key}='{$value}'";
		}
		$sql = "UPDATE ".self::$tblname." SET ";
		$sql .= join(", ", $attribute_pairs);
		$sql .= " WHERE APPLICANTID='". $id."'";
	  $mydb->setQuery($sql);
	 	if(!$mydb->executeQuery()) return false; 	
		
	}

   public function APLupdate($id=0) {
	  global $mydb;
		$attributes = $this->sanitized_attributes();
		$attribute_pairs = array();
		foreach($attributes as $key => $value) {
		  $attribute_pairs[] = "{$key}='{$value}'";
		}
		$sql = "UPDATE ".self::$tblname." SET ";
		$sql .= join(", ", $attribute_pairs);
		$sql .= " WHERE APPLICANTID=". $id;
	  $mydb->setQuery($sql);
	 	if(!$mydb->executeQuery()) return false; 	
		
	}

	public function delete($id='') {
		global $mydb;
		  $sql = "DELETE FROM ".self::$tblname;
		  $sql .= " WHERE APPLICANTID='". $id."'";
		  $sql .= " LIMIT 1 ";
		  $mydb->setQuery($sql);
		  
			if(!$mydb->executeQuery()) return false; 	
	
	}	


}
?>
