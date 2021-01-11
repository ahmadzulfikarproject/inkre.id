$(document).ready(function () {

    $(document).ajaxSend(function () {
        $("#loader").show();
    }).ajaxComplete(function () {
        $("#loader").hide();
    })

    if ($(".sortable").length > 0) {

        $('.navigation ol.sortable').nestedSortable({
            disableNesting: 'no-nest',
            forcePlaceholderSize: true,
            handle: '.icon-move',
            helper: 'clone',
            items: 'li',
            maxLevels: LIST_MAX_LEVELS,
            opacity: .6,
            placeholder: 'placeholder',
            revert: 250,
            tabSize: 25,
            tolerance: 'pointer',
            toleranceElement: '> div',
            update: function () {
                $.ajax({
                    type: 'post',
                    url: BASE_URL + 'navigation/reorder',
                    data: {
                        order: $(this).nestedSortable('serialize'),
                        csrf_test_name: $.cookie('csrf_cookie_name')
                    }
                });
            }
        });

        $('.categories ol.sortable').nestedSortable({
            disableNesting: 'no-nest',
            forcePlaceholderSize: true,
            handle: '.icon-move',
            helper: 'clone',
            items: 'li',
            maxLevels: LIST_MAX_LEVELS,
            opacity: .6,
            placeholder: 'placeholder',
            revert: 250,
            tabSize: 25,
            tolerance: 'pointer',
            toleranceElement: '> div',
            update: function () {
                $.ajax({
                    type: 'post',
                    url: BASE_URL + 'categories/reorder',
                    data: {
                        order: $(this).nestedSortable('serialize'),
                        csrf_test_name: $.cookie('csrf_cookie_name')
                    }
                });
            }
        });

        $('.slide ol.sortable').nestedSortable({
            disableNesting: 'no-nest',
            forcePlaceholderSize: true,
            handle: '.icon-move',
            helper: 'clone',
            items: 'li',
            maxLevels: LIST_MAX_LEVELS,
            opacity: .6,
            placeholder: 'placeholder',
            revert: 250,
            tabSize: 25,
            tolerance: 'pointer',
            toleranceElement: '> div',
            update: function () {
                // alert('testtt');
                $.ajax({
                    type: 'post',
                    url: BASE_URL + 'slide/reorder_slide',
                    data: {
                        order: $(this).nestedSortable('serialize'),
                        csrf_test_name: $.cookie('csrf_cookie_name')
                    },
                    beforeSend: function () {
                        $('.loading').show();
                    },
                    success: function (data, textStatus, jqXHR) {
                        if (data.error == true) {
                            $('.loading').fadeOut("slow", function () {

                                $("#results").text('Terjadi keslahan, silahkan coba lagi...');
                                //$('#results').show();
                                $("#results").fadeIn('slow').delay(5000).fadeOut('slow');
                            });
                        } else {
                            $('.loading').fadeOut("slow", function () {

                                $("#results").text('Data Terkirim...');
                                $("#results").fadeIn('slow').delay(5000).fadeOut('slow');
                            });


                        }
                        //$('#result').html(data);
                        //alert('Load was performed. Look at the console (F12 or Ctrl+Shift+I, Console tab) for more information! ');
                        console.log('jqXHR:');
                        console.log(jqXHR);
                        console.log('textStatus:');
                        console.log(textStatus);
                        console.log('data:');
                        console.log(data);



                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        //alert('An error occurred... Look at the console (F12 or Ctrl+Shift+I, Console tab) for more information!');

                        $('#result').html('<p>status code: ' + jqXHR.status + '</p><p>errorThrown: ' + errorThrown + '</p><p>jqXHR.responseText:</p><div>' + jqXHR.responseText + '</div>');
                        console.log('jqXHR:');
                        console.log(jqXHR);
                        console.log('textStatus:');
                        console.log(textStatus);
                        console.log('errorThrown:');
                        console.log(errorThrown);
                    }
                });
            }
        });
        $('.promo ol.sortable').nestedSortable({
            disableNesting: 'no-nest',
            forcePlaceholderSize: true,
            handle: '.icon-move',
            helper: 'clone',
            items: 'li',
            maxLevels: LIST_MAX_LEVELS,
            opacity: .6,
            placeholder: 'placeholder',
            revert: 250,
            tabSize: 25,
            tolerance: 'pointer',
            toleranceElement: '> div',
            update: function () {
                // alert('testtt');
                $.ajax({
                    type: 'post',
                    url: BASE_URL + 'promo/reorder_promo',
                    data: {
                        order: $(this).nestedSortable('serialize'),
                        csrf_test_name: $.cookie('csrf_cookie_name')
                    },
                    beforeSend: function () {
                        $('.loading').show();
                    },
                    success: function (data, textStatus, jqXHR) {
                        if (data.error == true) {
                            $('.loading').fadeOut("slow", function () {

                                $("#results").text('Terjadi keslahan, silahkan coba lagi...');
                                //$('#results').show();
                                $("#results").fadeIn('slow').delay(5000).fadeOut('slow');
                            });
                        } else {
                            $('.loading').fadeOut("slow", function () {

                                $("#results").text('Data Terkirim...');
                                $("#results").fadeIn('slow').delay(5000).fadeOut('slow');
                            });


                        }
                        //$('#result').html(data);
                        //alert('Load was performed. Look at the console (F12 or Ctrl+Shift+I, Console tab) for more information! ');
                        console.log('jqXHR:');
                        console.log(jqXHR);
                        console.log('textStatus:');
                        console.log(textStatus);
                        console.log('data:');
                        console.log(data);



                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        //alert('An error occurred... Look at the console (F12 or Ctrl+Shift+I, Console tab) for more information!');

                        $('#result').html('<p>status code: ' + jqXHR.status + '</p><p>errorThrown: ' + errorThrown + '</p><p>jqXHR.responseText:</p><div>' + jqXHR.responseText + '</div>');
                        console.log('jqXHR:');
                        console.log(jqXHR);
                        console.log('textStatus:');
                        console.log(textStatus);
                        console.log('errorThrown:');
                        console.log(errorThrown);
                    }
                });
            }
        });

        $(".delete").click(function () {
            // alert('testtt !!!!!!!!');
            var data_href = $(this).data('href');
            var data_name = $(this).data('name');
            var data_type = $(this).data('type');
            if (data_type == 'group') {
                $('.modal-body').html('<p>Do you really want to delete group: ' + data_name + '?</p>');
            } else {
                $('.modal-body').html('<p>Do you really want to delete item: ' + data_name + '?</p>');
            }
            $('.modal-footer').html('<a href="#" class="btn" data-dismiss="modal">Cancel</a><a href="' + data_href + '" class="btn btn-danger"><i class="icon-trash icon-white"></i> Delete</a>');
            $('#confirm-modal').modal('show');

            return false;
        });

        $('.sortable li div').on('mouseenter', function () {
            // $('span', this).fadeIn(100);
        }).on('mouseleave', function () {
            // $('span', this).fadeOut(100);
        });
    }



});