
$(document).ready( function() {

    $('#archives').click( function( el ) {
        var menu = $('#archive-menu');
        if( menu.is(":visible") ) {
            menu.hide();
        } else {
            $('.archive-mois').hide();
            menu.show();
            menu.find(".archive-mois").hide();
        }

        return false;

    });

    $('.annee').click( function( el ) {
        el = $(el.target);
        var list = $(el).parent().find(".archive-mois");
        if( list.is(":visible") ) {
            list.hide();
        } else {
            $('.archive-mois').hide();
            list.show();
        }
        return false;
    });

});
