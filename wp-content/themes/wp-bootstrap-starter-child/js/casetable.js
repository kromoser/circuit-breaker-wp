$ = jQuery;
$(document).ready(function() {

    $('table#case-list').dataTable({
        "processing": true,
        "serverSide": true,
        "ordering": true,
        "order": [[ 2, 'desc' ]],
        "ajax": ajax_url
    } );

} );
