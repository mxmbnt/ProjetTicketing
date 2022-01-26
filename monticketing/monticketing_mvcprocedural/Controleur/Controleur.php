<?php

require 'Modele/Modele.php';

// Affiche la liste de tous les billets du blog
function accueil() {
    $tickets = getTickets();
    require 'Vue/vueAccueil.php';
}

// Affiche les détails sur un billet
function ticket($idTicket) {
    $ticket = getTicket($idTicket);
    $commentaires = getCommentaires($idTicket);
    require 'Vue/vueBillet.php';
}

// Affiche une erreur
function erreur($msgErreur) {
    require 'Vue/vueErreur.php';
}

