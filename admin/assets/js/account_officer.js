$(document).ready(function() {
    var username = $('form#addNewOfficer #username');
    var firstname = $('form#addNewOfficer #firstname');
    var lastname = $('form#addNewOfficer #lastname');
    $(firstname, lastname).keypress(function(e) {
        if (e.ctrlKey || e.altKey) {
            e.preventDefault();
        }
        var charCode = window.event.keyCode;
        if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123))
            return true;
        else {
            return false;
        }
    });

    username.focus(function() {
        if (firstname.val() != "" && lastname.val() != "") {
            username.val(firstname.val() + "." + lastname.val());
        }
    });


    $('form#addNewOfficer').submit(function(e) {
        e.preventDefault();
        var data = $(this).serialize();
        $.ajax({
            method: "POST",
            url: $(this).attr("action"),
            dataType: "JSON",
            data: data,
            beforeSend: function() {
                $("button[name='add']").text("Submitting").attr("disabled", true);
                $('input').attr("disabled", true);
                $('form#addNewOfficer #status').text("").removeClass("alert alert-danger alert-success");
            },
            success: function(response) {
                if (response.hasOwnProperty("success")) {
                    $('form#addNewOfficer #status').text(response.success).removeClass("alert alert-danger")
                        .addClass("alert alert-success");
                    $("button[name='add']").text("Submit").attr("disabled", false);
                    $('input').attr("disabled", false);
                }
                if (response.hasOwnProperty('error')) {
                    $('form#addNewOfficer #status').text(response.error)
                        .removeClass("alert alert-success").addClass("alert alert-danger");
                    $("button[name='add']").text("Submit").attr("disabled", false);
                    $('input').attr("disabled", false);
                }
                if (response.hasOwnProperty("duplicate")) {
                    $('form#addNewOfficer #status').text(response.duplicate)
                        .removeClass("alert alert-success").addClass("alert alert-danger");
                    $("button[name='add']").text("Submit").attr("disabled", false);
                    $('input').attr("disabled", false);
                }
                if (response.hasOwnProperty('fields')) {
                    $('form#addNewOfficer #status').text(response.fields)
                        .removeClass("alert alert-success").addClass("alert alert-danger");
                    $("button[name='add']").text("Submit").attr("disabled", false);
                    $('input').attr("disabled", false);
                }
                if (response.hasOwnProperty('invalid_email')) {
                    $('form#addNewOfficer #status').text(response.invalid_email)
                        .removeClass("alert alert-success").addClass("alert alert-danger");
                    $("button[name='add']").text("Submit").attr("disabled", false);
                    $('input').attr("disabled", false);
                }
            },
            fail: function() {
                $('form#addNewOfficer #status').text("Request Failed!")
                    .removeClass("alert alert-success").addClass("alert alert-danger");
                $("button[name='add']").text("Submit").attr("disabled", false);
                $('input').attr("disabled", false);
            },
            error: function() {
                $('form#addNewOfficer #status').text("Error: Request Failed!")
                    .removeClass("alert alert-success").addClass("alert alert alert-danger");
                $("button[name='add']").text("Submit").attr("disabled", false);
                $('input').attr("disabled", false);
            }
        });
    });

    $('form#deleteOfficer').submit(function(e) {
        e.preventDefault();
        var data = $(this).serialize();
        $.ajax({
            method: "POST",
            dataType: "JSON",
            data: data,
            url: $(this).attr("action"),
            beforeSend: function() {
                $("button[name='del_officer']").text("Deleting...").attr("disabled", true);
                $('input').attr("disabled", true);
                $('form#deleteOfficer #del_status').text("").removeClass("alert alert-danger alert-success");
            },
            success: function(response) {
                if (response.hasOwnProperty('success')) {
                    $('form#deleteOfficer #del_status').text(response.success)
                        .removeClass("alert alert-danger").addClass("alert alert-success");
                    $("button[name='del_officer']").text("Delete").attr("disabled", false);
                    $('input').attr("disabled", false);
                }
                if (response.hasOwnProperty('failed')) {
                    $('form#deleteOfficer #del_status').text(response.failed)
                        .removeClass("alert alert-success").addClass("alert alert-danger");
                    $("button[name='del_officer']").text("Delete").attr("disabled", false);
                    $('input').attr("disabled", false);
                }

            },
            error: function() {
                $('form#deleteOfficer #del_status').text("Error State!")
                    .removeClass("alert alert-success").addClass("alert alert-danger");
                $("button[name='del_officer']").text("Delete").attr("disabled", false);
                $('input').attr("disabled", false);
            },
            fail: function() {
                $('form#deleteOfficer #del_status').text("Request Failed!")
                    .removeClass("alert alert-success").addClass("alert alert-danger");
                $("button[name='del_officer']").text("Delete").attr("disabled", false);
                $('input').attr("disabled", false);
            }
        });
    });

});