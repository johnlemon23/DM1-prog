<?php
spl_autoload_register(function($classe){
    require 'classes/' .$classe. '.class.php';
});
// Programme

// Interface définissant la méthode sePresenter
interface IPresentation {
    public function sePresenter();
}

// TEST
$homme = new Homme("John", 30);
$femme = new Femme("Jane", 25);

$homme->sePresenter(); // Affiche "Je suis un Homme de 30 ans et je m'appelle John"
echo "<br>";
$femme->sePresenter(); // Affiche "Je suis une Femme de 25 ans et je m'appelle Jane"
?>