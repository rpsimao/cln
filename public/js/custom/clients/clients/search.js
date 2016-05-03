/**
 * Created by rpsimao on 20/01/16.
 */

$(function(){
    $("#rps_text_search_client").focus();

    if (!$("input[name='optionsRadios']:checked").val()) {

        $('#rps_submit_search_client_button').prop('disabled', true);
    }


    $("input[name='optionsRadios']").click(

        function(){

            $('#rps_submit_search_client_button').prop('disabled', false);
        }
    )

});