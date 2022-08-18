jQuery(document).ready(function($) {

    bsMain = $('.bs-offset-main'),
        bsOverlay = $('.bs-canvas-overlay');

    $('[data-toggle="canvas"][aria-expanded="false"]').on('click', function() {
        // BS Defaults
        if (window.matchMedia('(max-width: 567px)').matches) {
            var dev_width = "100%";
        } else {
            var dev_width = "400px";
        }
        var bsDefaults = {
            offset: false,
            overlay: true,
            width: dev_width
        };
        // Get Details/Narative
        var details = $(this).find("#details").text();
        $("#trans-details").text(details);

        // Get Transaction Date
        var date = $(this).find("#date").text();
        $("#trans-date").text(date);

        // Get Tansaction Reference
        var reference = $(this).find("#reference").text();
        $("#trans-reference").text(reference);

        // Get Transaction Currency
        var currency = $(this).find("#currency").text();
        $("#trans-currency").text(currency);

        // Get Transaction Amount
        var amount = $(this).find("#amount").text();
        $("#trans-amount").text(amount);

        // Get Transaction Type
        var type = $(this).find("#type").text();
        type = type[0].toUpperCase() + type.substring(1);
        $("#trans-type").text(type);

        var canvas = $(this).data('target'),
            opts = $.extend({}, bsDefaults, $(canvas).data()),
            prop = $(canvas).hasClass('bs-canvas-right') ? 'margin-right' : 'margin-left';

        if (opts.width === '100%')
            opts.offset = false;

        $(canvas).css('width', opts.width);
        if (opts.offset && bsMain.length)
            bsMain.css(prop, opts.width);

        $(canvas + ' .bs-canvas-close').attr('aria-expanded', "true");
        $('[data-toggle="canvas"][data-target="' + canvas + '"]').attr('aria-expanded', "true");
        if (opts.overlay && bsOverlay.length)
            bsOverlay.addClass('show');
        return false;
    });

    $('.bs-canvas-close, .bs-canvas-overlay').on('click', function() {
        var canvas, aria;
        if ($(this).hasClass('bs-canvas-close')) {
            canvas = $(this).closest('.bs-canvas');
            aria = $(this).add($('[data-toggle="canvas"][data-target="#' + canvas.attr('id') + '"]'));
            if (bsMain.length)
                bsMain.css(($(canvas).hasClass('bs-canvas-right') ? 'margin-right' : 'margin-left'), '');
        } else {
            canvas = $('.bs-canvas');
            aria = $('.bs-canvas-close, [data-toggle="canvas"]');
            if (bsMain.length)
                bsMain.css({
                    'margin-left': '',
                    'margin-right': ''
                });
        }
        canvas.css('width', '');
        aria.attr('aria-expanded', "false");
        if (bsOverlay.length)
            bsOverlay.removeClass('show');
        return false;
    });
});