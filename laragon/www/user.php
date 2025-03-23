<?php

include("databaseConnection.php");

class user {
	//https://www.w3schools.com/php/php_oop_classes_objects.asp
	$userID;
	$username;
	
	//https://www.w3schools.com/php/php_oop_constructor.asp
	public function __construct($userID, $username){
		this->userID = $userID;
		this->username = $username;
	}
	
	//https://www.w3schools.com/php/php_oop_static_methods.asp
	// Create a new User tuple in the database
	public static function createUser($username, $password){
		$lastUserID;
		try
		$sql="INSERT INTO user (%s) VALUES (%s)";
	}
	
	
	
	
	public static function login($username, $password){
		// Get a user from the database with the specified username and password
		
	}
}