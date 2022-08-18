$(document).ready(function () {



    $('#home-tab').click(function () {

        $('form#seb-local')[0].reset();

        $('#to-acc-name, form#seb-local .help-block').text('');

    });

    $('#other-tab').click(function () {

        $('form#other-bank')[0].reset();

        $('#to-acc-name, form#other-bank .help-block').text('');

    });

    var isFetching = false;

    $('#recipient-acc').on("keypress paste", function () {

        var input = $('#recipient-acc');

        var len = input.val().length;

        from_acc = $('#acc').val();

        var len2 = from_acc.length;

        if (len2 != '') {

            $('#acc-error').text("");

            if (len < 9) {

                if (isFetching == false) {

                    isFetching = true;

                    $.ajax({

                        url: $('#seb').attr('action'),

                        method: "POST",

                        dataType: "json",

                        data: {

                            account_number: input.val(),

                            from_acc: from_acc,

                            get_acc_name: true,



                        },

                        beforeSend: function () {

                            $('#to-acc-name').html('<span class="spinner spinner-grow text-primary"></span>');

                        },

                        success: function (response) {

                            if (response == false) {

                                $('#to-acc-name').text("Invalid Account").addClass("text-danger ml-1").removeClass('text-primary');

                            }

                            if (typeof (response) == 'object') {

                                $('#to-acc-name').text(response.firstname + " " + response.middlename + " " +

                                    response.lastname).addClass("text-primary").removeClass('text-danger');

                            }

                            isFetching = false;

                        },

                        error: function () {

                            $('#to-acc-name').text("Something went wrong").addClass("text-danger ml-1");



                        }





                    });

                }





            }

        } else {

            $('#acc-error').text("Select Account!");

        }





    });

    // $('button[name="local"]').click(function(e) {

    //     var from_acc = $('#acc').val().length;

    //     var to_acc = $('#recipient-acc').val().length;

    //     var amount = $('#amount').val().length;

    //     var narration = $('#narration').val().length;

    //     var error = "";

    //     if (from_acc == "") {

    //         $('#acc-error').text("Field is required!");

    //         error = "set";

    //     } else {

    //         $('#acc-error').text("");

    //     }

    //     if (to_acc == "") {

    //         $('#to-acc-error').text("Field is required!");

    //         error = "set";

    //     } else {

    //         $('#to-acc-error').text("");

    //     }

    //     if (amount == "") {

    //         $('#amount-error').text("Field is required!");

    //         error = "set";

    //     } else {

    //         $('#amount-error').text("");

    //     }

    //     if (narration == "") {

    //         $('#narration-error').text("Field is required!");

    //         error = "set";

    //     } else {

    //         $('#narration-error').text("");

    //     }



    //     if (error == "") {

    //         $('#authModal').modal('show');

    //     }

    // });

    // $('button#local_transfer').click(function() {

    //     var from_acc = $('#acc').val().length;

    //     var to_acc = $('#recipient-acc').val().length;

    //     var amount = $('#amount').val().length;

    //     var narration = $('#narration').val().length;

    //     if (from_acc == "" || to_acc == "" || amount == "" || narration == "") {

    //         $('#authModal').modal('hide');

    //     } else {

    //         $('form#seb-local').submit();

    //     }



    // });

});