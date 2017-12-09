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

// Function to check numbers
    $(".isPhoneNumeric").keydown(function(event) {
        // Allow only backspace and delete
        if ( event.keyCode == 46 || event.keyCode == 8) {
            // let it happen, don't do anything
           
        }
        else {
            // Ensure that it is a number and stop the keypress
            if ((event.keyCode !==9) && (event.keyCode < 48 || event.keyCode > 57 )) {
                event.preventDefault(); 
            }   
                else{
                 
              if($.trim($(this).val()) =='')
            {
                if(event.keyCode == 48){
                event.preventDefault(); 
                }
            }
                    
            }
        }
    });

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

    function setTwoNumberDecimal(event) {
        return event.value = parseFloat(event.value).toFixed(2);
    }

    function resetForm($form) {
        $form.find('input:text, input:password, input:file, select, textarea').val('');
        $form.find(':input[type=number]').val('');
        $form.find(':input[type=email]').val('');
        $form.find(".select2").val(null).trigger("change");
        $form.find('input:radio, input:checkbox').removeAttr('checked').removeAttr('selected');
    }

// base_url declared in template.php file to get available in all pages
    function getPersonWalletBalance(){ 
        $.ajax({
            type: "POST",
            url: base_url +'/person_wallet_balance.html',
            data: {},
            cache: false,
            success: function (res) {
                var result = JSON.parse(res);

                if (result.status === true) {
                    //notifyMessage('success', result.message);

                    $(".wallet_balance").html(result.data);
                } else {                       
                }

            },
            error: function (jqXHR, textStatus, errorThrown) {
                //notifyMessage('error', errorThrown);
            }
        });
    }
    
    
    // function getWidgetsdata(){
        
    //     $.ajax({
    //         type: "POST",
    //         url: window.location.origin +'/widgets_updates.html',
    //         data: {},
    //         cache: false,
    //         success: function (res) {
    //             var result = JSON.parse(res);

    //             if (result.status === true) {
    //                 //notifyMessage('success', result.message);

    //                 $(".wallet_balance").html(result.data.wallet_balance);
    //                 $(".w_wallet_balance").html(result.data.wallet_balance);
    //                 $(".w_new_orders").html(result.data.new_orders);
    //                 $(".w_processing_orders").html(result.data.processing_orders);
    //                 $(".w_completed_orders").html(result.data.completed_orders);
    //             } else {                       
    //             }

    //         },
    //         error: function (jqXHR, textStatus, errorThrown) {
    //             //notifyMessage('error', errorThrown);
    //         }
    //     });
    // }
    
//    /* AJAX call to get the user Walet balance on interval. */
//    getPersonWalletBalance();
//    setInterval(function () {
//        getPersonWalletBalance();
//    }, 30000);
    
    /* AJAX call to get the Dashboard widgets. */
    //getWidgetsdata();
    // setInterval(function () {
    //     getWidgetsdata();
    // }, 30000);
