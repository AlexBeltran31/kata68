<?php
include 'contact.php';

class Agenda {
    private array $contacts; 
    
    public function __construct() {
        $this->contacts = [];
    }

    public function addContact() {
        $this->contacts[] = new Contact();
    }
}