$(document).ready(function() {
    $('#addModal').on("hide.bs.modal", function() {
        location.reload();
    });
    // $(".selectpicker").change(function() {
    //     var val = $(this).val();
    //     $('#id').val(val);
    // });
    $('form#add-admin').submit(function(e) {
        e.preventDefault();
        var data = $(this).serialize();
        var url = $(this).attr('action');
        $.ajax({
            method: "POST",
            dataType: "JSON",
            data: data,
            url: url,
            beforeSend: function() {
                $("button#add").text("ADDING...").
                attr("disabled", true);
                $("select#user").attr("disabled", true);
                $("input").attr("disabled", true);
                $('#username_error').text("");
                $('#user_error').text("");
            },
            success: function(response) {
                $("button#add").text("ADD").
                attr("disabled", true);
                $("select#user").attr("disabled", false);
                if (response.hasOwnProperty("success")) {
                    $("#status_text").text(response.success);
                    $('#status_style').removeClass("bg-danger fa-check")
                        .addClass("bg-success fa-check");
                    $("#addModal").modal("show");
                    $("button#add").text("ADD").
                    attr("disabled", false);
                    $("select#user").attr("disabled", false);
                    $("input").attr("disabled", false);
                }
                if (response.hasOwnProperty("fail")) {
                    $("#status_text").text(response.fail);
                    $('#status_style').removeClass("bg-success fa-check")
                        .addClass("bg-success fa-square-xmark");
                    $("#addModal").modal("show");
                    $("button#add").text("ADD").
                    attr("disabled", false);
                    $("select#user").attr("disabled", false);
                    $("input").attr("disabled", false);
                }
                if (response.hasOwnProperty("username_error")) {
                    $('#username_error').text(response.username_error);
                    $("button#add").text("ADD").
                    attr("disabled", false);
                    $("select#user").attr("disabled", false);
                    $("input").attr("disabled", false);
                }
                if (response.hasOwnProperty("user_error")) {
                    $('#user_error').text(response.user_error);
                    $("button#add").text("ADD").
                    attr("disabled", false);
                    $("select#user").attr("disabled", false);
                    $("input").attr("disabled", false);
                }
            },
            error: function() {
                $("#status_text").text("Error Occured!");
                $('#status_style').removeClass("bg-success fa-check")
                    .addClass("bg-danger fa-times");
                $("#addModal").modal("show");
                $("button#add").text("ADD").
                attr("disabled", false);
                $("select#user").attr("disabled", false);
                $("input").attr("disabled", false);
            },
            fail: function() {
                $("#status_text").text("Request Failed!");
                $('#status_style').removeClass("bg-success fa-check")
                    .addClass("bg-danger fa-times");
                $("#addModal").modal("show");
                $("button#add").text("ADD").
                attr("disabled", false);
                $("select#user").attr("disabled", false);
                $("input").attr("disabled", false);
            }
        });
    });

});