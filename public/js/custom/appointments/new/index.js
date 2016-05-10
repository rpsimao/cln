$(function() {


    var select = $("#type_treatment");
    var futureSelect = $("#future-body-zone");
    var typeSkin = $("#type_of_skin");


    select.on('change', function() {populateTreatmentSelect(select.val(), "typeOfTreatmentSelect");});

    futureSelect.on('change', function() {populateTreatmentSelect(futureSelect.val(), "typeOfTreatmentFutureSelect");});

    typeSkin.on('change', function() {alertTypeOfSkin("type_of_skin")});
    
    

    
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


    if (typeSkin.val() == "Black" || typeSkin.val() == "Mate"){

        openModal("modal-2");

    }
    
}

