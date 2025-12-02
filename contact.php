<?php
class Contact {
    private string $name;
    private string $surname;
    private string $phone;
    private string $email;

    public function __construct(string $name, string $surname, string $phone, string $email) {
        $this->name = $name;
        $this->surname = $surname;
        $this->phone = $phone;
        $this->email = $email;
    }
}