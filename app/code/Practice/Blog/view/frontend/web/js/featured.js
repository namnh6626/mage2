require([
    "jquery",
    "mage/mage"
], function($) {
    $(document).ready(function() {
        let url = 'http://magento2.test:81/blog/post/featured';
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            // showLoader: true,
            cache: false,
            success: function(data, _status) {
                for (key in data) {
                    $('#list-featured-post').append(
                        `<div class="featured-blog">
                          <a href="${data[key].blog_entity_id}">${data[key].title}</a>
                      </div>`
                    )
                }
            },
            error: function(_xhr, _status, errorThrown) {

            }
        });
    });
});
