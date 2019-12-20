jQuery("#regForm").submit(function(e) {

    e.preventDefault();

    var form = jQuery(this);
    var url = form.attr('action');

    jQuery.ajax({
        type: "POST",
        url: url,
        data: form.serialize(),
        dataType: "json",

        success: function(data)
        {
            document.location.reload(true);
            console.log(data);
        },
        error: function (response){
            alert(response.responseJSON.message);

            console.log(response);
        }
    });


});