$(function () {
    $('.js-basic-example').DataTable();

    //Exportable table
    var table = $('.js-exportable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
});