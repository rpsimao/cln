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


    $("#form-inner-id-6").append('<div class="bs-callout bs-callout-danger"> <h4><i class="fa fa-exclamation-triangle"></i> '+title+'</h4><p>'+txt+'</p></div>');



}