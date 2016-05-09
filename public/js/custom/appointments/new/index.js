$(function() {


    var select = $("#select2-disabled-inputs-single");


    select.on('change', function() {



        populateTreatmentSelect(select.val());



    });

    
});

function populateTreatmentSelect(values)

{

    var select = $("#typeOfTreatmentSelect");

    sendData = $.post( "/appointments/new/lookfortreatments", { treat: values} );

    sendData.done(function(data){

        select.html(data);


    });

}