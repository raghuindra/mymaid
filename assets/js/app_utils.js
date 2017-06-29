/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    function maxLengthCheck(object) {
        if (object.value.length > object.maxLength)
            object.value = object.value.slice(0, object.maxLength)
    }
// Function to check numbers
    function isNumeric(evt) {
        var theEvent = evt || window.event;
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
        var regex = /[0-9]/;
        if (!regex.test(key)) {
            theEvent.returnValue = false;
            if (theEvent.preventDefault)
                theEvent.preventDefault();
        }
    }

    // Function to check letters and numbers  
    function isAlphaNumeric(evt)
    {
        var theEvent = evt || window.event;
        var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
        var regex = /^[0-9a-zA-Z]+$/;
        if (!regex.test(key)) {
            theEvent.returnValue = false;
            if (theEvent.preventDefault)
                theEvent.preventDefault();
        }
    }

    function resetForm($form) {
        $form.find('input:text, input:password, input:file, select, textarea').val('');
        $form.find(':input[type=number]').val('');
        $form.find(".select2").val(null).trigger("change");
        $form.find('input:radio, input:checkbox').removeAttr('checked').removeAttr('selected');
    }

    function getPersonWalletBalance(){ 
        $.ajax({
            type: "POST",
            url: window.location.origin +'/person_wallet_balance.html',
            data: {},
            cache: false,
            success: function (res) {
                var result = JSON.parse(res);

                if (result.status === true) {
                    //notifyMessage('success', result.message);

                    $(".wallet_balance").html(result.data[0].person_wallet_amount);
                } else {                       
                }

            },
            error: function (jqXHR, textStatus, errorThrown) {
                //notifyMessage('error', errorThrown);
            }
        });
    }
    
    /* AJAX call to get the user Walet balance on interval. */
    getPersonWalletBalance();
    setInterval(function () {
        getPersonWalletBalance();
    }, 30000);
