require([
    "jquery",
    "mage/mage"
], function($) {
    $(document).ready(function() {

        $('#commentForm').mage(
            'validation', {
                submitHandler: function(form) {
                    var saveCommentUrl = "http://magento2.test:81/blog/comment/save";
                    var isLogged = "<?= $isLogged ?>";
                    // console.log(isLogged);
                    if (isLogged == 'false') {
                        window.location.href = "<?= $loginUrl ?>";
                    } else {
                        var data = $('#commentForm').serialize();
                        $.ajax({
                            url: saveCommentUrl,
                            data: data,
                            type: 'POST',
                            dataType: 'json',
                            showLoader: true,
                            // cache: false,
                            success: function(data, status, xhr) {
                                $('#comments').empty();

                                for (var key in data) {

                                    let middlename = data[key].middlename ? data[key].middlename : "";
                                    let createdAt = new Date(data[key].created_at);
                                    let createdAtFormat = createdAt.getDate() + '/' + (createdAt.getMonth() + 1) + '/' + createdAt.getFullYear() +
                                        " " + createdAt.getHours() + ':' + createdAt.getMinutes();

                                    console.log(middlename);
                                    $('#comments').append(
                                        "<div class='comment'> <b>" + data[key].firstname + ' ' + middlename + ' ' + data[key].lastname + " </b>" +
                                        "<span>" + data[key].email + "</span>" +
                                        "<br>" +
                                        "<span>" + createdAtFormat + "</span>" +
                                        "<p>" + data[key].content + "</p>" +
                                        "<br>" +
                                        "</div>"

                                    );

                                }

                                $("#commentForm").trigger('reset');
                            },
                            error: function(xhr, status, errorThrown) {

                            }
                        });
                    }

                }

            }
        );
    });
});
