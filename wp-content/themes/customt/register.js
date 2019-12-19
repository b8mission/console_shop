jQuery("#regForm").submit(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.

    var form = jQuery(this);
    var url = form.attr('action');

    jQuery.ajax({
        type: "POST",
        url: url,
        data: form.serialize(), // serializes the form's elements.
        dataType: "json",

        success: function(data)
        {
            alert(data); // show response from the php script.
            console.log(data);
        },
        error: function (response){//jqXHR, textStatus, errorThrown) {
            alert(response.responseJSON.message);
            console.log(response);
        }
    });


});