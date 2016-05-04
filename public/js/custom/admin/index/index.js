/**
 * Created by rpsimao on 04/05/16.
 */

$(function() {
   
    $("#admin-create-new-user").click(function(){

        var username = '<td><input type="text" name="new-username" id="new-username"></td>';
        var passwd = '<td><input type="text" name="new-password" id="new-password"></td>';
        var role = '<td><select class="form-control" name="new-role" id="new-role"><option value=""></option><option value="admin">Admin</option><option value="user">User</option></select></td>';
        var clinic = '<td><input type="text" name="new-clinic" id="new-clinic"></td>';
        var newuser = '<td><button class="btn btn-add" onclick="insertNewUser()"><i class="fa fa-user-plus"></i></button></td>';



        $("#admin-table-users > tbody").prepend("<tr>"+username+passwd+role+clinic+newuser+"</tr>");
        
    });
    
    
});



function insertNewUser()
{
    var username = $("#new-username");
    var passwd = $("#new-password");
    var role = $("#new-role");
    var clinic = $("#new-clinic");

    
    
    





}