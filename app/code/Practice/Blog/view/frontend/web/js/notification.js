require([
    "jquery",
    "mage/mage"
], function($) {
    $(document).ready(function() {

        $('#notificationForm').mage(
            'validation', {
                submitHandler: function(form) {
                    var markAsReadUrl = "http://magento2.test:81/blog/notification/markasread";
                    var isLogged = "<?= $isLogged ?>";
                    console.log(isLogged);
                    if (isLogged == 'false') {
                        window.location.href = "<?= $loginUrl ?>";
                    } else {
                        var data = $('#notificationForm').serialize();
                        $.ajax({
                            url: markAsReadUrl,
                            data: data,
                            type: 'POST',
                            dataType: 'json',
                            showLoader: true,
                            cache: false,
                            success: function(data, status, xhr) {
                               $('#notificationForm').remove();
                               $('.message').remove();
                               $('#maincontent').prepend(`<div class="message success empty"><span><?php echo __('Successfully!!'); ?></span></div>`);
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
