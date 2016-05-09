/**
 * Created by rpsimao on 04/05/16.
 */

$(function() {
   
    $("#admin-create-new-user").click(function(){

        var username = '<td><input type="text" name="new-username" id="new-username" class="form-control"></td>';
        var passwd = '<td><input type="text" name="new-password" id="new-password" class="form-control"></td>';
        var role = '<td><select class="form-control" name="new-role" id="new-role"><option value=""></option><option value="admin">Admin</option><option value="user">User</option></select></td>';
        var clinic = '<td><input type="text" name="new-clinic" id="new-clinic" class="form-control"></td>';
        var newuser = '<td><button class="btn btn-primary btn-xs" onclick="insertNewUser()"><i class="fa fa-user-plus"></i></button>';
        var cancelnew = '<button class="btn btn-clinik btn-xs" onclick="removeNewField()"><i class="fa fa-remove"></i>&nbsp;</button></td>';



        $("#admin-table-users > tbody").prepend("<tr id='new-user-tr'>"+username+passwd+role+clinic+newuser+cancelnew+"</tr>");

        $("#new-username").focus();
        
    });
    
    
});



function insertNewUser()
{
    var u = $("#new-username");
    var p = $("#new-password");
    var r = $("#new-role");
    var c = $("#new-clinic");


    if (u.val() =="") {

        u.wrap('<div class="form-group has-error"></div>');
        u.focus();
        return false;

    } else if (p.val() =="")
    {
        p.wrap('<div class="form-group has-error"></div>');
        p.focus();
        return false;

    } else if (r.val() =="")
    {
        r.wrap('<div class="form-group has-error"></div>');
        return false;

    } else if (c.val() =="")
    {
        c.wrap('<div class="form-group has-error"></div>');
        c.focus();
        return false;
    }


    var sendForm = $.post( "/admin/index/insert", { username: u.val(), passwd: p.val(), roles: r.val(), clinic: c.val()  } );


    sendForm.done(function (data){
        
        $("#new-user-tr").remove();

        var trS = '<tr id="row-'+data+'">';
        var td1 = '<td id="username-'+data+'">'+u.val()+'</td>';
        var td2 = '<td id="passwd-'+data+'">'+p.val()+'</td>';
        var td3 = '<td id="roles-'+data+'">'+r.val()+'</td>';
        var td4 = '<td id="clinic-'+data+'">'+c.val()+'</td>';
        var td5 = '<td><button class="btn btn-danger" id="trash-'+data+'" onclick="removeUser('+data+')"><i class="fa fa-trash"></i></button></td>';
        var trE = '</tr>';


        $("#admin-table-users > tbody").append(trS+td1+td2+td3+td4+td5+trE);
        
        
    });


}

function removeNewField() {

    $("#new-user-tr").remove();
}


function removeUser(id) {

    var sendData = $.post( "/admin/index/remove", { id: id} );

    sendData.done(function(){

        $("#row-"+id).fadeOut().remove();


    });
}


function sendTreatmentDB(lang) {

    var type = $("#type");
    var desc_fr = $("#description_fr");
    var desc_en = $("#description_en");
    var desc_de = $("#description_de");
    var table = $("#admin-table-treatments");


    var sendData = $.post( "/admin/index/treatment", { type: type.val(), desc_fr: desc_fr.val(), desc_en: desc_en.val(), desc_de: desc_de.val()} );

    sendData.done(function(data){

        var typeVal = type.val();

        var zone = typeVal.split(";");

        var zonesLang = {fr:zone[0], en:zone[1], de:zone[2]};

        if (lang == "fr"){

            var bodyZone = zonesLang.fr;

        } else if (lang == "en"){

            var bodyZone = zonesLang.en;

        } else if (lang == "de"){

            var bodyZone = zonesLang.de;
        }

        var html = '<tr id="treatment-id-for-record-'+data+'"><td>'+bodyZone+'</td><td id="treatment-desc-fr-'+data+'">'+desc_fr .val()+'</td><td id="treatment-desc-en-'+data+'">'+desc_en.val()+'</td><td id="treatment-desc-de-'+data+'">'+desc_de.val()+'</td><td id="traetment-edit-btn-'+data+'"><button class="btn btn-success" onclick="EditTreatmentBoard('+data+')"><i class="fa fa-edit"></i></button><button class="btn btn-danger" onclick="DelTreatmentBoard('+data+')"><i class="fa fa-trash"></i></button></td>';

        table.append(html);

        type.val($(type).prop('defaultSelected'));
        desc_de.val("");
        desc_en.val("");
        desc_fr.val("");


    });



}

function EditTreatmentBoard(id){

    var tableTR = $("#treatment-id-for-record-"+id);
    var lang = $("#treatment-lang-"+id);
    var desc_fr =  $("#treatment-desc-fr-"+id);
    var desc_en = $("#treatment-desc-en-"+id);
    var desc_de = $("#treatment-desc-de-"+id);
    var buttonsTD = $("#traetment-edit-btn-"+id);
    var oldTR = tableTR.html();

    var langeditFR = '<input type="text" name="new-description-fr" id="new-description-fr" class="form-control" value="'+desc_fr.text()+'">';
    var langeditEN = '<input type="text" name="new-description-en" id="new-description-en" class="form-control" value="'+desc_en.text()+'">';
    var langeditDE = '<input type="text" name="new-description-de" id="new-description-de" class="form-control" value="'+desc_de.text()+'">';

    var buttonInsert = '<button class="btn btn-success" onclick="sendNewTreatmentRecord('+id+')"><i class="fa fa-check"></i></button>';
    var buttonCancel = '<button class="btn btn-primary" id="cancel-new-treatment-edit"><i class="fa fa-times"></i></button>';

    
    desc_fr.html(langeditFR);
    desc_en.html(langeditEN);
    desc_de.html(langeditDE);
    buttonsTD.html(buttonInsert+buttonCancel);

    $("#cancel-new-treatment-edit").on("click", function(){

        tableTR.html(oldTR);
        //console.re.log(oldTR);
    });

}

function DelTreatmentBoard(id)
{

    var sendData = $.post("/admin/index/treatmentdelete", { id: id} );

    var trID = $("#treatment-id-for-record-"+id);

    sendData.done(function(){

        trID.remove();
    });
}

function sendNewTreatmentRecord(id)
{

    
    
    var fr = $("#new-description-fr");
    var en = $("#new-description-en");
    var de = $("#new-description-de");


    var sendData = $.post("/admin/index/treatmentedit", { id: id, fr: fr.val(), en: en.val(), de: de.val()} );
    
    
    sendData.done(function(data){

        var desc_fr =  $("#treatment-desc-fr-"+id);
        var desc_en = $("#treatment-desc-en-"+id);
        var desc_de = $("#treatment-desc-de-"+id);
        var buttonsTD = $("#traetment-edit-btn-"+id);
        var buttons ='<button class="btn btn-success" onclick="EditTreatmentBoard('+id+')"><i class="fa fa-edit"></i></button> <button class="btn btn-danger" onclick="DelTreatmentBoard('+id+')"><i class="fa fa-trash"></i></button>';

        desc_fr.text(fr.val());
        desc_en.text(en.val());
        desc_de.text(de.val());
        buttonsTD.html(buttons);




    });

}



function editBodyZone(id) {

    var zoneTR = $("#body-zone-"+id);
    var zoneEN = $("#zone-en-"+id);
    var zoneFR = $("#zone-fr-"+id);
    var zoneDE = $("#zone-de-"+id);
    var zoneButtons =$("#zone-buttons-"+id);
    var oldTR = zoneTR.html();


    var zoneEditFR = '<input type="text" name="new-zone-fr" id="new-zone-fr" class="form-control" value="'+zoneFR.text().trim()+'">';
    var zoneEditEN = '<input type="text" name="new-zone-en" id="new-zone-en" class="form-control" value="'+zoneEN.text().trim()+'">';
    var zoneEditDE = '<input type="text" name="new-zone-de" id="new-zone-de" class="form-control" value="'+zoneDE.text().trim()+'">';

    var buttonInsert = '<button class="btn btn-success" onclick="sendNewBodyZone('+id+')"><i class="fa fa-check"></i></button>';
    var buttonCancel = '<button class="btn btn-primary" id="cancel-new-body-zone-edit"><i class="fa fa-times"></i></button>';



    zoneFR.html(zoneEditFR);
    zoneEN.html(zoneEditEN);
    zoneDE.html(zoneEditDE);
    zoneButtons.html(buttonInsert+buttonCancel);


    $("#cancel-new-body-zone-edit").on("click", function(){

        zoneTR.html(oldTR);

    });



}


function delBodyZone(id) {


    var zoneTR = $("#body-zone-"+id);


    var sendData = $.post("/admin/index/bodyzonedelete", { id: id} );

    var trID = $("#treatment-id-for-record-"+id);

    sendData.done(function(){

        trID.remove();
    });



}


function sendNewBodyZone(id) {


    var zoneEN = $("#new-zone-en");
    var zoneFR = $("#new-zone-fr");
    var zoneDE = $("#new-zone-de");


    var sendData = $.post("/admin/index/bodyzoneedit", { id: id, fr: zoneFR.val(), en: zoneEN.val(), de: zoneDE.val()} );

    sendData.done(function(){


        var desc_fr =  $("#zone-fr-"+id);
        var desc_en = $("#zone-en-"+id);
        var desc_de = $("#zone-de-"+id);
        var buttonsTD = $("#zone-buttons-"+id);
        var buttons ='<button class="btn btn-success" onclick="editBodyZone('+id+')"><i class="fa fa-edit"></i></button> <button class="btn btn-danger" onclick="delBodyZone('+id+')"><i class="fa fa-trash"></i></button>';

        desc_fr.text(zoneFR.val());
        desc_en.text(zoneEN.val());
        desc_de.text(zoneDE.val());
        buttonsTD.html(buttons);


    });
    
    

}





























