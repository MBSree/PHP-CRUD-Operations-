<?php
class Validation
{

	public const ALLOWED_DOMAINS = ['gmail.com', 'outlook.com', 'evalan.com'];

	//try to use in_array function instead of using explode
	public function isAllowedDomain($email)
	{

		$emailParts = explode('@', $email);
		$domain = end($emailParts);
		return in_array($domain, self::ALLOWED_DOMAINS);
	}

	public function isUniqueEmail($email, $id, $conn)
	{
		$stmt = $conn->prepare("SELECT id FROM employee WHERE email = ? AND id != ?");
		$stmt->bind_param("si", $email, $id);
		$stmt->execute();
		$stmt->store_result();
		$count = $stmt->num_rows;
		$stmt->close();

		return $count === 0;
	}

	public function isValidPassword($password)
	{
		$minLength = 6;
		$maxLength = 20;
		if (strlen($password) < $minLength || strlen($password) > $maxLength) {
			return false;
		}
		if (!preg_match('/[a-z]/', $password)) {
			return false;
		}
		if (!preg_match('/[A-Z]/', $password)) {
			return false;
		}
		if (!preg_match('/[0-9]/', $password)) {
			return false;
		}
		if (!preg_match('/[^a-zA-Z0-9]/', $password)) {
			return false;
		}
		return true;
	}

	public function isValidPhoneNumber($phoneNumber)
	{
		$pattern = '/^\d{10}$/';
		return preg_match($pattern, $phoneNumber);
	}
}

//step 1
//this class will include all your validation rules
//investigate the differences between public, protected, private -> access modifiers 
// investigate constants in php
//investigate what static keyword is and how to use this keyword with functions






//step 2
//interfaces in php
//abstract classes
// inheritance
