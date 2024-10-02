<?php

class User {
    public $name;
    public $email;

    public function __construct($name, $email) {
        $this->name = $name;
        $this->email = $email;
    }

    public function save() {
        // Saving to a database (simulated)
        echo "Saving user: " . $this->name . " with email: " . $this->email . "\n";
    }

    public function sendEmail($subject, $message) {
        // Sending email (simulated)
        echo "Sending email to " . $this->email . " with subject: " . $subject . "\n";
    }
}

class UserManager {
    public function createUser($name, $email) {
        $user = new User($name, $email);
        $user->save();
        return $user;
    }

    public function notifyUser($user, $subject, $message) {
        if ($user instanceof User) {
            $user->sendEmail($subject, $message);
        } else {
            echo "Invalid user\n";
        }
    }
}

// Usage
$userManager = new UserManager();
$user = $userManager->createUser("John Doe", "john@example.com");
$userManager->notifyUser($user, "Welcome!", "Thank you for registering!");

?>