<?php
namespace App\Controller;

class UserController extends \App\Controller\AbstractController
{
	public function showForm(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$error = $this->verify($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['password'] );
			if (empty($error)) {
				addUser($pdo, $lastname, $firstname, $email, $password);
			}
		}
		
		return $this->twig->render('signup.html.twig');
	}
	
	
	/*vérification des champs d'inscription*/
	
	/**
	 * @param $firstname
	 * @param $lastname
	 * @param $email
	 * @param $password
	 * @return array
	 */
	private function verify($firstname, $lastname, $email, $password)
	{
		$error = [];
		
		/*firstname = vérification champs vide et correctement rempli*/
		if (empty($firstname)) {
			$error['firstname'] = "firstname is required";
		}
		
		if (!preg_match("/^[a-z A-Z]*$/", $firstname)) {
			$error['firstname'] = 'only letters please';
		}
		
		/*lastname = vérification champs vide et correctement rempli*/
		if (empty($lastname)) {
			$error['lastname'] = "lastname is required";
		}
		if (!preg_match("/^[a-z A-Z]*$/", $lastname)) {
			$error['lastname'] = 'only letters please';
		}
		
		/*email = vérification champs vide et correctement rempli*/
		if (empty($email)) {
			$error['email'] = "email is required";
		}
		if (!preg_match(" /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/ ", $email)) {
			$error['email'] = 'email address invalid';
		}
		
		/*password = vérification champs vide et correctement rempli*/
		if (empty($password)) {
			$error['password'] = 'A password is required';
		}
		if (strlen($password) < 8) {
			$error['password'] = 'at least 8 characters';
		}
		
		return $error;
		
	}
	
}
