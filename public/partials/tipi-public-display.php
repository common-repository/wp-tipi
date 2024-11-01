<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://www.patricelaurent.net
 * @since      1.0.0
 *
 * @package    Tipi
 * @subpackage Tipi/public/partials
 */
global $post;
if(!isset($this->tipi_gateway_settings_options['input_mode_1'])) $this->tipi_gateway_settings_options['input_mode_1']='T';
?>
<div id="tipi-gateway">

<div class="stepwizard">
    <div class="stepwizard-row setup-panel">
        <div class="stepwizard-step">
            <a href="#step-1" class="btn btn-primary btn-circle">1</a>
            <p>Documents</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-2" class="btn btn-default btn-circle" disabled="disabled">2</a>
            <p>Informations</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-3" class="btn btn-default btn-circle" disabled="disabled">3</a>
            <p>Paiement</p>
        </div>
    </div>
</div>
<?php
$disabled='';
$exer_val='';
$refdet_val='';
$montant_val='';
$montant_cts_val='';
$usermail = '';
$usermailcheck = '';
if(is_user_logged_in()){
	$current_user = wp_get_current_user();
    $usermail = $current_user->user_email;
    $usermailcheck = $usermail;
}

if($this->tipi_gateway_settings_options['input_mode_1']=='T'){
	echo '<div class="alert alert-danger  fade in">ATTENTION, le système de paiement est actuellement en mode TEST. Certains champs seront donc désactivés et remplis automatiquement</div>';
	$disabled=' disabled';
	$exer_val=' value="9999"';
	$refdet_val=' value="999999990000000000000"';
	$montant_val=' value="1111"';
	$montant_cts_val=' value="11"';
}elseif($this->tipi_gateway_settings_options['input_mode_1']=='X'){
	echo '<div class="alert alert-warning  fade in">ATTENTION, le système de paiement est actuellement en mode Activation. Certains champs seront donc désactivés et remplis automatiquement</div>';
	$disabled=' disabled';
}
?>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="setup-content" id="step-1">
    <?php if (!$this->empty_content($post->post_content)) {
        echo apply_filters('wpautop', get_the_content($post->ID));
    }else{ ?>
        <h3>Munissez-vous de votre avis des sommes à payer dont vous souhaitez effectuer le paiement.</h3>
        <p>Disponible 24h/24h et 7j/7, ce mode de paiement, proposé par la Direction générale des finances publiques, est simple et sécurisé.</p>
        <div class="well">
            <h4>Vous aurez besoin de:</h4>
            <ol class="needed">
                <li>Votre facture afin de récupérer l'année, le montant exact et le Numéro de Titre</li>
                <li>Une carte bancaire</li>
            </ol>
        </div>
        <div class="well">
            <ul class="list-unstyled infotipi">
                <li><span class="glyphicon glyphicon-lock text-primary pull-left"></span>&nbsp;Aucune information personnelle ne vous sera demandée et aucune des informations que vous aurez à saisir dans le cadre de ces paiements en ligne ne fera l’objet d’enregistrement.</li>
                <li><span class="glyphicon glyphicon-envelope text-primary pull-left"></span>&nbsp;Un mail de confirmation de la transaction vous sera envoyé à l’adresse e-mail que vous aurez saisie dans le formulaire.</li>
                <li><span class="glyphicon glyphicon-ok text-primary pull-left"></span>&nbsp;Dans certains cas, vous devrez paramétrer votre navigateur pour qu’il autorise les fenêtres pop-up. Voir les procédures pour votre navigateur</li>
            </ul>
        </div>
    <?php } ?>
        <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Suivant <span class="glyphicon glyphicon-chevron-right"></span></button>
</div>
    <form role="form" method="post" class="form-horizontal"  data-toggle="validator" id="tipi_calipsu">

    <div class="setup-content" id="step-2">
    <h3 class="text-center"> Informations</h3>

		<?php include_once 'objet-type.php' ?>

        <div class="form-group">
            <label class="control-label col-sm-2">N° de Titre</label>
            <div class="col-sm-4">
                <input<?php echo $refdet_val ?> data-validate="true" type="text" required="required" class="form-control" placeholder="TP-XXX-XXX-XXXX" name="refdet" id="refdet"<?php echo $disabled ?> />
            </div>
            <label class="control-label col-sm-2">Année</label>
            <div class="col-sm-4">
                <input<?php echo $exer_val ?> required="required" class="form-control" placeholder="2016" name="exer" id="exer" type="number"<?php echo $disabled ?>  />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2">Montant</label>
            <div class="col-sm-10">
                <div class="input-group">
                    <input<?php echo $montant_val ?> data-validate="true" required="required" class="form-control" placeholder="montant sans les centimes" name="montant" id="montant" type="number"<?php echo $disabled ?>  />
                    <span class="input-group-addon">€</span>
                    <input<?php echo $montant_cts_val ?> data-validate="true" required="required" class="form-control" placeholder="uniquement les centimes" name="montantcents" id="montantcents" type="number"<?php echo $disabled ?>  />
                    <span class="input-group-addon">cents</span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="mailtipi">Votre email</label>
            <div class="col-sm-10">
                <div class="input-group">
                    <span class="input-group-addon">@</span>
                    <input value="<?php echo $usermail ?>"  type="email" data-validate="true" class="form-control" id="mailtipi"  name="mailtipi" required="required" />
                </div>
                <div class="help-block with-errors"></div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="confirmemail">Confirmation email</label>
            <div class="col-sm-10">
                <div class="input-group">
                    <span class="input-group-addon">@</span>
                    <input value="<?php echo $usermailcheck ?>" class="form-control" data-validate="true" id="confirmemail" type="email" data-match="#mailtipi" data-match-error="Les deux emails ne sont pas identiques. Merci de vérifier votre saisie"  required="required" />
                </div>
                <div class="help-block with-errors"></div>
            </div>
        </div>

        <input type="hidden" value="<?php echo $this->tipi_gateway_settings_options['tipi_client_number']; ?>" name="numcli" id="numcli" />
        <input type="hidden" value="<?php echo $this->tipi_plugin_url; ?>" name="homesite" id="homesite" />
        <input type="hidden" value="<?php echo $this->tipi_gateway_settings_options['input_mode_1'];?>" name="saisie" id="saisie" />


        <button class="btn btn-primary prevBtn btn-lg pull-left" type="button" ><span class="glyphicon glyphicon-chevron-left"></span> Précédent</button>
        <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Suivant <span class="glyphicon glyphicon-chevron-right"></span></button>
</div>
    </form>

<div class="setup-content" id="step-3">
    <div class="well">
        <h3> Paiement en ligne</h3>
        <p>Une nouvelle fenêtre va s'ouvrir</p>
        <p>Vous arriverez sur une demande de saisie de vos coordonnées bancaires</p>
        <p>Cette fenêtre est sécurisée</p>
        <button class="btn btn-primary prevBtn btn-lg pull-left" type="button" ><span class="glyphicon glyphicon-chevron-left"></span> Précédent</button>
        <button id="openBtn" class="btn btn-success btn-lg center-block" type="button"><span class="glyphicon glyphicon-credit-card"></span> Paiement en ligne</button>
    </div>
</div>
<?php
$templateFaqFile = apply_filters('tipi_gateway_faq_template','faq.php');
include_once $templateFaqFile;
?>
</div>