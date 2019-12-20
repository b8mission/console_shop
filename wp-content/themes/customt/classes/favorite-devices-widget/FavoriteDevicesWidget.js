function favorite_devices_widget(ob) {
    var act = 'remove';
    if (ob.checked) act = 'adding';
    alert(act);
}

jQuery("#favorite_devices_widget_form").submit(function (e) {

    e.preventDefault();

    var form = jQuery(this);
  //  var url = form.attr('action');

    jQuery.ajax({
        type: "POST",
        url: url,
        data: form.serialize(),
        dataType: "json",

        success: function (data) {
            alert('ok');
            console.log(data);
        },
        error: function (response) {
            alert('error');
            console.log(response);
        }
    });


});


function favorite_devices_widget_rm() {

}