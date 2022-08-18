$(document).ready(function() {
    $('form#std').submit(function(e) {
        e.preventDefault();
        $.ajax({
            dataType: "JSON",
            method: "POST",
            url: $(this).attr("action"),
            data: {
                daily_limit: $("#daily").val(),
                transaction_limit: $("#transaction").val(),
                std: ""
            },
            beforeSend: function() {
                $('button[name="std"]').attr('disabled', true).text('Upgrading...');
            },
            success: function(response) {
                $('button[name="std"]').text("Upgrade");
                $('#confirmModal').modal("show");
            },
            fail: function(response) {
                $('button[name="std"]').attr('disabled', false).text('Upgrade');
                alert("Failed");
            },
            error: function() {
                $('button[name="std"]').attr('disabled', false).text('Upgrade');
                alert('error state');
            }
        });
    });
    $('#confirmModal').on("hide.bs.modal", function() {
        location.reload();
    });
    $("button[name='max']").click(function() {
        $('#maxModal').modal('show');
    });
});