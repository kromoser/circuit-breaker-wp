
$ = jQuery;
$(document).ready(function() {

    let casesTable = $('table#case-list').DataTable({
        "processing": true,
        "serverSide": true,
        "ordering": true,
        "order": [[ 2, 'desc' ]],
        "pageLength" : 30,
        "ajax": ajax_url
    });



} );
