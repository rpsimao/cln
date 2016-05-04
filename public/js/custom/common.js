/**
 * Created by rpsimao on 03/05/16.
 */

function openModal(id)
{
    $("#"+id).addClass("md-show");
}

function closeModal(id) {
    $("#"+id).addClass("md-hide");
}


function toggleModal(id1, id2){

    if($("#"+id1).prop('checked',true))

        openModal(id2);

    else

        closeModal(id2);

}