<?php
include 'contact.php';

class Menu {
    private array $contacts; 
    
    public function __construct() {
        $this->contacts = [];
    }
}