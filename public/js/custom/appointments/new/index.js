$(function() {

    var select       = $("#type_treatment");
    var futureSelect = $("#future-body-zone");
    var typeSkin     = $("#type_of_skin");
    var allergies    = $("#allergies");
    

    select.on('change', function() {populateTreatmentSelect(select.val(), "typeOfTreatmentSelect");});

    futureSelect.on('change', function() {populateTreatmentSelect(futureSelect.val(), "typeOfTreatmentFutureSelect");});

    typeSkin.on('change', function() {alertTypeOfSkin("type_of_skin")});

    allergies.on('focusout', function(){openModal("modal-13");});

});

function populateTreatmentSelect(values, id)
{
    var select = $("#"+id);

    sendData = $.post("/appointments/new/lookfortreatments", {treat: values});

    sendData.done(function(data){
        select.html(data);
    });

}

function alertTypeOfSkin(id) {

    var typeSkin = $("#"+id);

    var tval = typeSkin.val();


    if (tval == "Fototype 4" ){

        openModal("modal-2");

    } else if (tval == "Fototype 5") {

        openModal('modal-foto5');

    }  else if (tval == "Fototype 6") {

        openModal('modal-foto6')
}
    
}

