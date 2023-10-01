document.getElementById('rzp-button1').onclick = function(e){
    jQuery.ajax({
        url:'function/razorpay-checkout.php',
        type:'post',
        data:{name:$('#order_first_name').val()+ ' ' +$('#order_last_name').val(),
        email: $('#order_email').val(), contact: $('#order_phone').val(), p_token: $('#pass_c_token').val() },
        success:function(return_res){
        //console.log(return_res);
        var json_data = JSON.parse(return_res);

        if (json_data.status==true) {
            // add razorpay checkout configure
            var options = {
    "key": json_data.key_id, // Enter the Key ID generated from the Dashboard
    "amount": json_data.amount, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
    "currency": "INR",
    "name": json_data.name,
    "description": "Test Transaction",
    "image": "http://localhost/ca_ecomm/assets/logo.png",
    "order_id": json_data.raz_order_id, //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
    "handler": function (response){

        // if success, then checkout form query run
                jQuery.ajax({
                url:'function/order-checkout.php',
                type:'post',
                data:jQuery('#checkout_form').serialize()+'&pay_id='+json_data.pay+'&payment_id='+
                response.razorpay_payment_id+'&razorpay_order_id='+response.razorpay_order_id,
                success:function(result){
                    console.log(result);
                    $('.checkout-form-content').addClass('d-none');
                    $('.order-loading').removeClass('d-none').addClass('d-flex');
                    setTimeout(function(){
                        $('#loading_img').hide();
                        //$('.checkout-msg').html(result)
                        $('.checkout-msg').html('<p>Your order is placed successfully.<br><br><a href="account.php">Go to My Account</a></p>');
                    },1700)
                }
            });
        /*alert(response.razorpay_payment_id);
        alert(response.razorpay_order_id);
        alert(response.razorpay_signature)*/
    },
    "prefill": {
        "name": json_data.name,
        "email": json_data.email,
        "contact": json_data.contact
    },
    /*"notes": {
        "address": "Razorpay Corporate Office"
    },*/
    "theme": {
        "color": "#13439a"
    }

};
var rzp1 = new Razorpay(options);
rzp1.on('payment.failed', function (response){
        alert(response.error.code);
        alert(response.error.description);
        alert(response.error.source);
        alert(response.error.step);
        alert(response.error.reason);
        alert(response.error.metadata.order_id);
        alert(response.error.metadata.payment_id);
});
rzp1.open();
        }

        }
    });
    e.preventDefault();
}



/*document.getElementById('rzp-button1').onclick = function(e){
    rzp1.open();
    e.preventDefault();
}*/