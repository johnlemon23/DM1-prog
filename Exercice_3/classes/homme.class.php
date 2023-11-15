<?php
// Classe Homme héritant de Personne et implémentant IPresentation
class Homme extends Personne implements IPresentation {
    public function sePresenter() {
        echo "Je suis un Homme de $this->age ans et je m'appelle $this->prenom";
    }
}
?>