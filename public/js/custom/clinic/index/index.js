/**
 * Created by rpsimao on 19/01/16.
 */

$(function(){
    $("#rps_new_client").click(
        function(){
            window.location = "/clients/clients";
        }
    );

    $("#rps_search-client").click(
        function(){
            window.location = "/clients/clients/search";
        }
    );

    $("#switch_client").click(
        function(){
            window.location = "/clients/clients/switch";
        }
    );

    $("#new_appointment").click(
        function(){
            window.location = "/appointments/new";
        }
    );

    $("#search_appointments_button").click(
        function(){
            window.location = "/appointments/search";
        }
    );



    if (!$("#hidden_client_id").val())
    {

        $("button[id='new_appointment']").attr("disabled", "disabled").addClass("rps-button-disabled-red").button('refresh');
        $("button[id='search_appointments_button']").attr("disabled", "disabled").addClass("rps-button-disabled-green").button('refresh');

    }


});



function goToNewApp(id)
{

    /**
     *
     */


}
