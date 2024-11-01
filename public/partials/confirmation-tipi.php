<?php
/*
* TIPI transmettra dans l’URL retour pour les parametres ($_POST)
* NUMCLI
* EXER
* REFDET
* MONTANT
* MEL
* OBJET
* SAISIE
*
* RESULTRANS (1) : « P » payée ; « R » refusée ; « A » annulée
* NUMAUTO (7) : Numéro d’autorisation délivré par le serveur d’autorisation et routé par le gestionnaire de télépaiement à TIPI
* DATTRANS : JJMMSSAA : Date de la transaction du paiement CB
*/
do_action('tipi_gateway_data_return');

?>
