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

