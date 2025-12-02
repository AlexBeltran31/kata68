<?php
include 'agenda.php';

class Menu {
    const OPTIONS = [
        1 => 'Add Contact',
        2 => 'Show Contacts',
        3 => 'Delete Contact',
        4 => 'Search Contact',
        0 => 'Exit'
    ];

    private Agenda $agenda;

    public function __construct() {
        $this->agenda = new Agenda();
    }

    public function showOptions(): void {
        echo "****************************\n";
        echo "        CONTACT MENU\n";
        echo "****************************\n";

        foreach (self::OPTIONS as $index => $option) {
            echo "$index - $option\n";
        }
        echo "*****************************\n";
        echo "Select an option: ";
    }

    public function doAction(int $option): void {
        match ($option) {
            1 => $this->addContact(),
            2 => $this->listContacts(),
            3 => $this->deleteContact(),
            4 => $this->searchContact(),
            0 => $this->exitProgram(),

            default => print("Invalid option.\n")
        };
    }
    private function addContact(): void {
        echo "Enter name: ";
        $name = trim(fgets(STDIN));

        echo "Enter surname: ";
        $surname = trim(fgets(STDIN));

        echo "Enter phone number: ";
        $phone = trim(fgets(STDIN));

        echo "Enter email: ";
        $email = trim(fgets(STDIN));

        $id = $this->agenda->insertContact($name, $surname, $phone, $email);

        echo "Contact saved with ID: $id.\n";
    }

    private function listContacts(): void {
        $contacts = $this->agenda->getAll();

        if(empty($contacts)) {
            echo "No contacts found.\n";
            return;
        }

        echo "\n--- CONTACTS LIST ---\n";
        foreach($contacts as $contact) {
            echo "ID: $contact->id |";
            echo "$contact->name $contact->surname | ";
            echo "Phone number: $contact->phone |";
            echo "Email: $contact->email |\n";
        }
    }

    private function deleteContact(): void {
        echo "Enter ID to delete: ";
        $id = intval(trim(fgets(STDIN)));

        if ($this->agenda->deleteContact($id)) {
            echo "Contact deleted.\n";
        } else {
            echo "Error deleting contact\n";
        }
    }

    private function searchContact(): void {
        echo "Enter name to search: ";
        $name = trim(fgets(STDIN));

        $contact = $this->agenda->getByName($name);

        if($contact) {
            echo "\n--- CONTACT INFO ---\n";
            echo "ID: $contact->id\n";
            echo "Name: $contact->name\n";
            echo "Surname: $contact->surname\n";
            echo "Phone number: $contact->phone\n";
            echo "Email: $contact->email\n";
        } else {
            echo "Contact not found.\n";
        }
    }

    private function exitProgram(): void {
        echo "Goodbye!\n";
        exit;
    }
}