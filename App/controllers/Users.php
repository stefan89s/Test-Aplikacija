<?php

class Users extends Controller {

    # Login page
    public function index() {
        $this->view('users/login');
    }

    # Login user
    public function loginUser() {
        # Checking if the login-button is submited
        if(isset($_POST['login-button'])) {
            # Storing the user's values from the input
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            # Creating new object for the user model
            $usersModel = $this->model('User');
            
            # Checking for the user
            $usersModel->loginUser($email, $password);
        }
    }

    # Log out user
    public function logout() {
        if(isset($_POST['user-logout'])) {
            session_destroy();
            header('Location: ' . ROOT_PATH);
        }
    }

}


























