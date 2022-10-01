require([
    "jquery",
    "mage/mage"
], function($) {
    $(document).ready(function() {

        $('#commentForm').mage(
            'validation', {
                submitHandler: function(form) {
                    var saveCommentUrl = "<?php echo $saveCommentUrl ?>";
                    var data = $('#commentForm').serialize();
                    $.ajax({
                        url: saveCommentUrl,
                        data: data,
                        type: 'POST',
                        dataType: 'json',
                        showLoader: true,
                        cache: false,
                        success: function(data, status, xhr) {
                            $('#comments').prepend("<div class='comment'> <b>" + data.firstname +' ' + data.middlename + ' ' + data.lastname + " </b>" +
                            "<span>" + data.email + "</span>" +
                            "<br>" +
                            "<span>"+ data.created_at +"</span>" +
                            "<p>" + data.content + "</p>" +
                            "<br>" +
                            "</div>");

                            $("#commentForm").trigger('reset');
                        },
                        error: function(xhr, status, errorThrown) {
                            console.log('Error happens. Try again.');
                            console.log(errorThrown);
                        }
                    });
                }
            }
        );
    });
});
