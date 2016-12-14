/**
 * Created by arkadiy on 14.12.16.
 */

jQuery(document).ready(function(){
    loadNewCource();
});

function loadNewCource()
{
    jQuery.ajax({
        url: "index.php?option=com_ajax&module=jlcurrency&format=raw",
        type: "GET",
        success: function (data) {}
    });
}