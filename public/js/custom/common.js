/**
 * Created by rpsimao on 03/05/16
 */

function openModal(id) {
    $("#"+id).addClass("md-show");
}

function closeModal(id) {
    $("#"+id).addClass("md-hide");
}


function toggleModal(id1, id2){

    if($("#"+id1).is(":checked")) {

        openModal(id2);

    }
}

function setOriginAlert(title, txt){


    var newDiv = '<div class="col-sm-9 hr6" id="new-alert"></div>';
    $("#form-inner-id-5").append(newDiv);

    var alertCli = $.post( "/clients/clients/newclientalert", { id: $("#origin").val()  } );


    alertCli.done(function(data){


        if( data == 1 ) {

            $("#new-alert").html('<div class="bs-callout bs-callout-danger"> <h4><i class="fa fa-exclamation-triangle"></i> ' + title + '</h4><p>' + txt + '</p><input id="check-rep" type="hidden" value="1"></div>');

       } else {

            $("#new-alert").html("");
        }
    });






    


}