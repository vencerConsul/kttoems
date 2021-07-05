$(document).ready(function() {
    var table = $("#evaluationList").DataTable({
        lengthChange: false,
        pageLength: 10,
        responsive: true,
        buttons: ["excel", "pdf", "print"]
    });

    table
        .buttons()
        .container()
        .appendTo(".table-buttons .col-md-6:eq(0)");
});
