<?php

require_once('RLConnectVars.php');

class RLUser
{
	public static function createUser($userName)
	{
		return new RLUser($userName, -1);
	}

	public function __construct($userName, $userID)
	{
		$this->mUserID = $userID;
		if($userID != -1)
			$this->mIsValid = true;
		else
			$this->mIsValid = false;

		$this->mUserName = $userName;
		$this->mUserGroup = "employee";
	}

	public function login($userPassword)
	{
		$dbh = $this->connect();

		$sql = "SELECT * from users WHERE user_name=:userName and password=SHA(:userPassword)";
		$stmt = $dbh->prepare($sql);
		$stmt->bindParam(':userName', $this->mUserName, PDO::PARAM_STR);
		$stmt->bindParam(':userPassword', $userPassword, PDO::PARAM_STR);
		$stmt->execute();

		$successful = false;
		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$successful = true;
			$this->mIsValid = true;
			$this->mUserID = $row['user_id'];
			$this->mGroup = $row['user_group'];
		}

		return $successful;
	}

	public function initialize()
	{
		$dbh = $this->connect();

		$sql = "SELECT * from users WHERE user_name=:userName and user_id=:userID";
		$stmt = $dbh->prepare($sql);
		$stmt->bindParam(':userName', $this->mUserName, PDO::PARAM_STR);
		$stmt->bindParam(':userID', $this->mUserID, PDO::PARAM_STR);

		$stmt->execute();

		if($stmt->rowCount()==0)
		{
			$this->mIsValid = false;
			return false;
		}

		$successful = false;
		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$successful = true;
			$this->mIsValid = true;
			$this->mUserGroup = $row['user_group'];
		}

		return $successful;
	}

	public function userID()
	{
		return $this->mUserID;
	}

	public function userName()
	{
		return $this->mUserName;
	}

	public function isValidUser()
	{
		return $this->mIsValid;
	}
	public function isAdministrator()
	{
		return $this->mUserGroup=="admin";
	}

	protected function connect()
	{
		$dbh = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
		return $dbh;
	}

	protected $mUserName;
	protected $mUserID;
	protected $mIsValid;
	protected $mUserGroup;
}

?>
