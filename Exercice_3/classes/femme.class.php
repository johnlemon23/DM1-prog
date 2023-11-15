<?php
// Classe Femme héritant de Personne et implémentant IPresentation
class Femme extends Personne implements IPresentation {
    public function sePresenter() {
        echo "Je suis une Femme de $this->age ans et je m'appelle $this->prenom";
    }
}
?>