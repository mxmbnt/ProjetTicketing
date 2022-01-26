<?php

// Renvoie la liste des billets du blog
function getTickets() {
    $bdd = getBdd();
    $tickets = $bdd->query('select TIC_ID as id, TIC_DATE as date,'
            . ' TIC_LIB as titre, TIC_DESC as contenu from T_TICKET'
            . ' order by TIC_ID desc');
    return $tickets;
}

// Renvoie les informations sur un billet
function getTicket($idTicket) {
    $bdd = getBdd();
    $ticket = $bdd->prepare('select TIC_ID as id, TIC_DATE as date,'
            . ' TIC_LIB as titre, TIC_DESC as contenu, ET_LIB as etlib from T_TICKET join ETAT on ETAT.ET_ID=T_TICKET.ET_ID'
            . ' where TIC_ID=?');
    $ticket->execute(array($idTicket));
    if ($ticket->rowCount() == 1)
        return $ticket->fetch();  // Accès à la première ligne de résultat
    else
        throw new Exception("Aucun billet ne correspond à l'identifiant '$idTicket'");
}

// Renvoie la liste des commentaires associés à un billet
function getCommentaires($idTicket) {
    $bdd = getBdd();
    $commentaires = $bdd->prepare('select COM_ID as id, COM_DATE as date,'
            . ' COM_AUTEUR as auteur, COM_CONTENU as contenu from T_COM'
            . ' where TIC_ID=?');
    $commentaires->execute(array($idTicket));
    return $commentaires;
}

// Effectue la connexion à la BDD
// Instancie et renvoie l'objet PDO associé
function getBdd() {
    $bdd = new PDO('mysql:host=localhost;dbname=monticketing;charset=utf8', 'root',
            'password', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    return $bdd;
}