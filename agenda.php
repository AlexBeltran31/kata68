<?php
include 'contact.php';

class Agenda {
    private array $contacts;
    private string $file; 
    
    public function __construct(string $file = 'contacts.json') {
        $this->file = $file;
        $this->contacts = [];
    }

    private function load() {
        $data = file_get_contents($this->file);
            return json_decode($data, true)??[];
    }

    private function save($data) {
        file_put_contents($this->file, json_encode($data, JSON_PRETTY_PRINT));
    }

    public function getAll() {
        $contacts = $this->load();

        usort($contacts, function($a, $b) {
            return strcmp($a['name'], $b['name']);
        });
        
        return array_map(function($contact) {
            return(object)$contact;
        }, $contacts); 
    }

    public function getById($id) {
        $contacts = $this->load();

        foreach ($contacts as $contact) {
            if($contact['id'] == $id) {
                return (object)$contact;
            }
        }
        return null;
    }

    public function getByName($name) {
        $contacts = $this->load();

        foreach ($contacts as $contact) {
            if(strtolower($contact['name']) === strtolower($name)) {
                return(object)$contact;
            }
        }
        return null;
    }

    public function insertContact($name, $surname, $phone, $email) {
        $contacts = $this->load();

        $id = empty($contacts) ? 1 : max(array_column($contacts, 'id')) +1;

        $newContact = [
            'id'=>$id,
            'name'=>$name,
            'surname'=>$surname,
            'phone'=>$phone,
            'email'=>$email
        ];

        $contacts[] = $newContact;
        $this->save($contacts);

        return $id;
    }

    public function deleteContact($id) {
        $contacts = $this->load();

        $contacts = array_filter($contacts, function($contact) use ($id) {
            return $contact['id'] != $id;
        });

        $contacts = array_values($contacts);
        $this->save($contacts);

        return true;
    }
}