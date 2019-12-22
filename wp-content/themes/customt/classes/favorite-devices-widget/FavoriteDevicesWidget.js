//jQuery("#favorite_devices_widget_form").submit(function (e) {

jQuery("form[name=\"favorite_devices_widget_form\"]").submit(function (e) {
    e.preventDefault();

    favorite_devices_ajaxQuery(this);
});



function favorite_devices_ajaxQuery(form)
{
    var jform = jQuery(form);

    jQuery.ajax({
        type: "POST",
        url: url,

        data: jform.serialize(),
        dataType: "json",

        beforeSend: function ( xhr ) {
            xhr.setRequestHeader( 'X-WP-Nonce', wpApiSettings.nonce );
        },

        success: function (data) {
            console.log(data);

            //hide the post
            if (form.children['device_id']) {
                postId = form.children['device_id'].value;
                document.getElementById('post' + postId).hidden = true;
            }
        },
        error: function (response) {
            alert('error');
            console.log(response);
        }
    });
}