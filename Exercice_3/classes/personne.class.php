<?php
// Classe de base Personne
class Personne {
    protected $prenom;
    protected $age;

    public function __construct($prenom, $age) {
        $this->prenom = $prenom;
        $this->age = $age;
    }
}
?>