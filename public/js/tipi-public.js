(function( $ ) {
	'use strict';
	const tipiForm = $('#tipi_calipsu');
  tipiForm.validator();

  const navListItems = $('#tipi-gateway div.setup-panel div a');
	const allWells = $('#tipi-gateway .setup-content');
   const allNextBtn = $('#tipi-gateway .nextBtn');
  const allPrevBtn = $('#tipi-gateway .prevBtn');

  navListItems.click(function (e) {
    var $target = $($(this).attr('href')),
      $item = $(this);
    if ($(this).is("[disabled]")) {
      event.preventDefault();
      return false;
    }
    if (!$item.hasClass('disabled')) {
      navListItems.removeClass('btn-primary').addClass('btn-default');
      $item.removeClass('btn-default').addClass('btn-primary');
      allWells.hide();
      $target.show();
      $target.find('input:eq(0)').focus();
    }
  });

  allNextBtn.on('click',function(e){
  	e.preventDefault();
    var curStep = $(this).closest(".setup-content"),
      curStepBtn = curStep.attr("id"),
      nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
      curInputs = curStep.find("input[type='text'],input[type='email'],input[type='url'],select"),
      isValid = true;
    $(".form-group").removeClass("has-error");
    for(var i=0; i<curInputs.length; i++){
      if (!curInputs[i].validity.valid){
        isValid = false;
        $(curInputs[i]).closest(".form-group").addClass("has-error");
      }
    }

    if (isValid) {
      if(curStepBtn == 'step-2') {
        var validator = tipiForm.data("bs.validator");
        validator.validate();
        if (validator.hasErrors()) {
          e.preventDefault();
          return false;
        }
      }
        nextStepWizard.removeAttr('disabled').trigger('click');
    }
  });

  allPrevBtn.on('click',function(e){
    e.preventDefault();
    var curStep = $(this).closest(".setup-content"),
      curStepBtn = curStep.attr("id"),
      prevStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().prev().children("a");
    prevStepWizard.removeAttr('disabled').trigger('click');
  });
  $('div.setup-panel div a.btn-primary').trigger('click');

  $('#openBtn').click(function () {

		/*
		 Popup Paiement
		 montant exprimé en centimes, pas de virgule
		 */
		var widthPop = 900;
		var heightPop = 800;
    var homesite= $( "#homesite" ).val();
    var numcli = $( "#numcli" ).val();
    var mailperso = $("#mailtipi").val();
    var objet = $( "#objet").val();
    var urlcl = homesite+'public/partials/confirmation-tipi.php';
    var exer = $( "#exer" ).val();
    var refdet = $( "#refdet" ).val();
    var montant = $( "#montant" ).val();
    var montantcents = $( "#montantcents" ).val();
    var somme= montant+montantcents;
    var saisie = $( "#saisie" ).val();
    var leftPosition = (window.screen.width / 2) - ((widthPop / 2) + 10);
		var topPosition = (window.screen.height / 2) - ((heightPop / 2) + 50);
    var frameurl = 'https://www.tipi.budget.gouv.fr/tpa/paiement.web?numcli='+numcli+'&exer='+exer+'&refdet='+refdet+'&objet='+objet+'&montant='+somme+'&mel='+mailperso+'&saisie='+saisie+'&urlcl='+urlcl+'';

    window.open(frameurl, '_blank','height=' + heightPop +', width=' + widthPop +', toolbar=no, menubar=no, scrollbars=no, resizable=yes, location=no, directories=no, status=no,left='
      + leftPosition + ',top=' + topPosition + ',screenX=' + leftPosition + ',screenY=' + topPosition +'');
  });
})( jQuery );
