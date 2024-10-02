<?php

class User implements NotifyAble{
    public $name;
    public $email;

    public function __construct(string $name, string $email) {
        $this->name = $name;
        $this->email = $email;
    }

    public function save() {
        // Saving to a database (simulated)
        echo "Saving user: " . $this->name . " with email: " . $this->email . "\n";
    }

    public function notify(string $subject, string $message) {
        $emailSender = new EmailSender();
        $emailSender->send($this->email, $subject, $message);
    }
}

class EmailSender {
    public function send(string $email ,string $subject, string $message) {
        // Sending email (simulated)
        echo "Sending email to " . $email . " with subject: " . $subject . "\n" . " with message: " . $message . "\n";
    }
}

class UserManager {
    public function createUser(string $name, string $email) {
        $user = new User($name, $email);
        $user->save();
        return $user;
    }
}

interface NotifyAble {
    public function notify(string $subject, string $message);
}

// Usage
$userManager = new UserManager();
$user = $userManager->createUser("John Doe", "john@example.com");
$user->notify("Welcome!", "Thank you for registering!");

?>