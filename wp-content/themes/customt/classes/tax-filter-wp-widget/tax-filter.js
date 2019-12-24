function handleChange(checkbox) {
    var boxes = document.getElementsByClassName('vendorBox');

    var str = '';
    var count = 0;
    var vendors = [];
    for (var i = 0; i < boxes.length; i++) {
        if (boxes[i].checked == true) {
            str += boxes[i].value;
            count++;
            vendors.push(boxes[i].value);
        }
    }
    //alert (str);
    vendors = vendors.join(';');
    //  alert('sending: ' + count+ ', '+vendors);
    callAjax(count,vendors);
}

function callAjax(count, vendors) {


    var data = {
        'action': 'my_action',
        'whatever': count,
        'vendors': vendors,
    };

    jQuery.post(ajaxurl, data, function (response) {
        //   alert('Got this from the server: ' + response);

        if (response.length < 3)
            response = "<hr><hr>Sorry. Can't find anything";

        document.getElementById('devices').innerHTML = response;
    });
}