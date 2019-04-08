<?php

 class User extends Model {

    # Login user
    public function loginUser($email, $password) {
        # Query for selecting the user from the input
        $query = "SELECT * FROM users WHERE email = :email";
        $this->query($query);
        $this->bind(':email', $email);

        # Returning the user's info if the values matches
        $user = $this->fetchSingle();

        /**
         * 
         * !!! VAŽNO !!! 
         * Pošto je potrebno napraviti samo log in page, 
         * u mojoj bazi trenutno ne postoje korisnici sa hašovanom šifrom
         * koja bi bila uneta preko registracije.
         * Pošto je za hašovanje šifre potreban PHP skript prilikom registracije, 
         * šifre u mojoj bazi trenutno nisu hašovane, tako da nema potrebe
         * da se šifra verifikuje. Inače, posle provere korisnikovog inputa
         * ovde bi hašovanu šifru valjalo verifikovati, te bismo umesto sirove šifre
         * uporedili verifikovanu šifru sa korisnikom čiji je e-mail unesen
         * $passwordVerified = password_verify($password, $user['password']);
         * 
         */
        
        # If user exist in the database
        if($user && $user['password'] == $password) {
            # Setting the session
            $_SESSION['user-info'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'log-in' => true
            ];
            
            header('Location: ' . ROOT_PATH);
        } else {
            # If user's input doesn't match, back the user on the login page with the error
            header('Location: ' . ROOT_PATH . "users/index?error=invalid-input");
        }
    }

 }


























