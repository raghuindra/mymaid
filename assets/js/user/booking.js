/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var self;
var selectedDates = Array();

postcode = $("#postcodeSearch").data('val');
function ajaxCall(url, data, successCallback, failureCallback) {
    //console.log("AJAx Call Params: "); console.log(data);
    $.ajax({
        type: "POST",
        url: base_url+url,
        data: data,
        cache: false,
        success: function (res) {
    //console.log('Json Response' +res);
            var result = JSON.parse(res);

            if (result.status === true) {
                successCallback(result);
            } else {
                failureCallback(result);
            }
        }
    });
}

var ServiceObjects = {
    ServiceObject : null,
    ServicePackageObject : null,
    ServiceFrequencyObject: null,
    ServiceAddonsObject: null,
    ServiceSplRequestObject: null    
};


var ServiceFactory = (function () {

    var Service = function(data, url, successCallBack, failureCallBack){
        this.data = data;
        this.successCallBack = successCallBack;
        this.failureCallBack = failureCallBack;
        this.url        = url;
    };
    
    Service.prototype.execute = function(){

        ajaxCall(this.url, this.data, this.successCallBack, this.failureCallBack);
    };
    
    var ServicePackage = function(data, url, successCallBack, failureCallBack){
        this.data = data;
        this.successCallBack = successCallBack;
        this.failureCallBack = failureCallBack;
        this.url        = url;
    }; 
    
    ServicePackage.prototype.execute = function(){
        ajaxCall(this.url, this.data, this.successCallBack, this.failureCallBack);
    };
    
    var ServiceFrequency = function(data, url, successCallBack, failureCallBack){
        this.data = data;
        this.successCallBack = successCallBack;
        this.failureCallBack = failureCallBack;
        this.url        = url;
    };
    
    ServiceFrequency.prototype.execute = function(){
        ajaxCall(this.url, this.data, this.successCallBack, this.failureCallBack);
    };
    
    var ServiceAddons = function(data, url, successCallBack, failureCallBack){
        this.data = data;
        this.successCallBack = successCallBack;
        this.failureCallBack = failureCallBack;
        this.url        = url;
    };
    
    ServiceAddons.prototype.execute = function(){
        ajaxCall(this.url, this.data, this.successCallBack, this.failureCallBack);
    };
    
    var ServiceSplRequests = function(data, url, successCallBack, failureCallBack){
        this.data = data;
        this.successCallBack = successCallBack;
        this.failureCallBack = failureCallBack;
        this.url        = url;
    };
    
    ServiceSplRequests.prototype.execute = function(){
        ajaxCall(this.url, this.data, this.successCallBack, this.failureCallBack);
    };
    
    var ServiceSplPrice = function(data, url, successCallBack, failureCallBack){
        this.data = data;
        this.successCallBack = successCallBack;
        this.failureCallBack = failureCallBack;
        this.url        = url;
    };
    
    ServiceSplPrice.prototype.execute = function(){
        ajaxCall(this.url, this.data, this.successCallBack, this.failureCallBack);
    };
    
    var ServiceBooking = function(data, url, successCallBack, failureCallBack){
        this.data = data;
        this.successCallBack = successCallBack;
        this.failureCallBack = failureCallBack;
        this.url        = url;
    };
    
    ServiceBooking.prototype.execute = function(){

        ajaxCall(this.url, this.data, this.successCallBack, this.failureCallBack);
    };
    
    return {
        
        getServicesCommand: function(data, url, successCallBack, failureCallBack){
            return new Service(data, url, successCallBack, failureCallBack);
        },
        
        getServicePackagesCommand: function(data, url, successCallBack, failureCallBack){
            return new ServicePackage(data, url, successCallBack, failureCallBack);
        },
        
        getServiceFrequencyCommand: function(data, url, successCallBack, failureCallBack){
            return new ServiceFrequency(data, url, successCallBack, failureCallBack);
        },
        
        getServiceAddonsCommand: function(data, url, successCallBack, failureCallBack){
            return new ServiceAddons(data, url, successCallBack, failureCallBack);
        },
        
        getServiceSplRequestCommand: function(data, url, successCallBack, failureCallBack){
            return new ServiceSplRequests(data, url, successCallBack, failureCallBack);
        },
        
        getServiceSplPriceCommand: function(data, url, successCallBack, failureCallBack){
            return new ServiceSplPrice(data, url, successCallBack, failureCallBack);
        },
        
        getServiceBookingCommand: function(data, url, successCallBack, failureCallBack){
            return new ServiceBooking(data, url, successCallBack, failureCallBack);
        },
        
        executeTask : function(command){
            command.execute();
        }
    };

})();

var ServiceJSON = (function(){
    
    return {
        
        getServicesJson: function(data){
            var json = JSON.stringify({
					   
                "data": {
                  "postcode": data.postcode
                },
                "header": {
                    "active": true
                }

            });
            return json;
            
        },
        
        getServicePackageJson: function(data){
            var json = JSON.stringify({
					   
                "data": {
                  "postcode": data.postcode,
                  "serviceId": data.serviceId
                },
                "header": {
                    "active": true
                }

            });
            return json;
            
        },
        
        getServiceFrequencyJson: function(data){
            var json = JSON.stringify({
					   
                "data": {
                  "postcode": data.postcode,
                  "serviceId": data.serviceId
                },
                "header": {
                    "active": true
                }

            });
            return json;
            
        },
        
        getServiceAddonsJson: function(data){
            var json = JSON.stringify({
					   
                "data": {
                  "postcode": data.postcode,
                  "serviceId": data.serviceId
                },
                "header": {
                    "active": true
                }

            });
            return json;
            
        },
        
        getServiceSplRequestJson: function(data){
            var json = JSON.stringify({
					   
                "data": {
                  "postcode": data.postcode,
                  "serviceId": data.serviceId
                },
                "header": {
                    "active": true
                }

            });
            return json;
            
        },
        
        getServiceSplPriceJson: function(data){
            var json = JSON.stringify({
					   
                "data": {
                  "postcode": data.postcode,
                  "serviceId": data.serviceId
                },
                "header": {
                    "active": true
                }

            });
            return json;
            
        },
        
        getServiceBookingJson: function(data){
            var json = JSON.stringify({
                "data":data,
                "header":{
                    "active":true
                }
            });
            return json;
            
        },
        
        getEmployeeAvailabilityJson: function(data){
               
            var json = JSON.stringify({
                "data":data,
                "header":{
                    "active":true
                }
            });
            return json;
        }
        
        
        
    };
    
})();

var ServiceResponseHandler = {
    
    ServiceSuccessHandler: function(data){
        var dataObj = ServiceData.service(data);
        //console.log(dataObj.getAllServices());
        ServiceObjects.ServiceObject = dataObj;
        var serviceIds = dataObj.getServiceIds();
        //get Service Packages
        ServiceResponseHandler.TriggerServicePackageCall(serviceIds, postcode);
        
    },
    
    ServiceFailureHandler: function(data){
        //console.log("Service Call failure..!!!");
    },
    
    TriggerServicePackageCall: function(serviceIds, postcode){
        var jsonData = ServiceJSON.getServicePackageJson({'serviceId':serviceIds,'postcode':postcode}); //console.log(jsonData);
        var servicePackage = ServiceFactory.getServicesCommand(jsonData, 'getServicePackages.html',ServiceResponseHandler.ServicePackageSuccessHandler, ServiceResponseHandler.ServicePackageFailureHandler);
        ServiceFactory.executeTask(servicePackage);
    },
    
    ServicePackageSuccessHandler: function(data){
        var dataObj = ServiceData.servicePackage(data);
        ServiceObjects.ServicePackageObject = dataObj;
        var packages = dataObj.getAllServicePackages();

        //console.log(packages); 
        RenderView.renderServices();
        //RenderView.renderServicePackage(id);
        if(ServiceObjects.ServiceObject !== null){
            var serviceIds = ServiceObjects.ServiceObject.getServiceIds(); //console.log("ServiceIds: "+serviceIds);
            ServiceResponseHandler.TriggerServiceFrequencycall(serviceIds, postcode);
            ServiceResponseHandler.TriggerServiceAddoncall(serviceIds, postcode);
            ServiceResponseHandler.TriggerServiceSplRequestcall(serviceIds, postcode);
            
        }
        
        
        
    },
    
    ServicePackageFailureHandler: function(data){
        //console.log("Package Call failure..!!!");
    },
    
    TriggerServiceFrequencycall: function(serviceIds, postcode){
        //console.log("Frequency Ajax Call..!!!");
        var jsonData = ServiceJSON.getServiceFrequencyJson({'serviceId':serviceIds,'postcode':postcode}); //console.log(jsonData);
        var serviceFrequency = ServiceFactory.getServicesCommand(jsonData, 'getServiceFrequencies.html',ServiceResponseHandler.ServiceFrequencySuccessHandler, ServiceResponseHandler.ServiceFrequencyFailureHandler);
        ServiceFactory.executeTask(serviceFrequency);
    },
    
    ServiceFrequencySuccessHandler: function(data){
        var dataObj = ServiceData.serviceFrequency(data);
        ServiceObjects.ServiceFrequencyObject = dataObj;
        //console.log("Frequency Call Success...");
        //console.log(ServiceObjects.ServiceFrequencyObject.getAllServiceFrequency());
        RenderView.renderFrequencyPrices();
    },
    
    ServiceFrequencyFailureHandler: function(data){
        //console.log("Frequency Call failure..!!!");
    },
    
    TriggerServiceAddoncall: function(serviceIds, postcode){
       // console.log("Addon Ajax Call..!!!");
        var jsonData = ServiceJSON.getServiceAddonsJson({'serviceId':serviceIds,'postcode':postcode}); //console.log(jsonData);
        var serviceAddon = ServiceFactory.getServicesCommand(jsonData, 'getServiceAddons.html',ServiceResponseHandler.ServiceAddonSuccessHandler, ServiceResponseHandler.ServiceAddonFailureHandler);
        ServiceFactory.executeTask(serviceAddon);
    },
    
    ServiceAddonSuccessHandler: function(data){
        var dataObj = ServiceData.serviceAddon(data);
        ServiceObjects.ServiceAddonsObject = dataObj;
        //console.log("Service Addons Call Success..");
        //console.log(ServiceObjects.ServiceAddonsObject.getAllServiceAddons());
        
        RenderView.renderServiceAddons();
    },
    
    ServiceAddonFailureHandler: function(data){
        //console.log("Addon Call failure..!!!");
    },
    
    TriggerServiceSplRequestcall: function(serviceIds, postcode){
        //console.log("Spl Request Ajax Call..!!!");
        var jsonData = ServiceJSON.getServiceSplRequestJson({'serviceId':serviceIds,'postcode':postcode}); //console.log(jsonData);
        var serviceSplRequest = ServiceFactory.getServicesCommand(jsonData, 'getServiceSplRequests.html',ServiceResponseHandler.ServiceSplRequestSuccessHandler, ServiceResponseHandler.ServiceSplRequestFailureHandler);
        ServiceFactory.executeTask(serviceSplRequest);
    },
    
    ServiceSplRequestSuccessHandler: function(data){
        var dataObj = ServiceData.serviceSplRequest(data);
        ServiceObjects.ServiceSplRequestObject = dataObj;
        //console.log("Spl Request Call Success..!!!");
        //console.log(ServiceObjects.ServiceSplRequestObject.getAllServiceSplRequest());
        RenderView.renderSplRequest();
    },
    
    ServiceSplRequestFailureHandler: function(data){
        //console.log("Spl Request Call failure..!!!");
    },
    
    ServiceBookingSuccessHandler: function(data){
        if(data.status){
            var pay_data = data.data;
            $("#TransactionType").val(pay_data.payment_transaction_type);
            $("#PymtMethod").val(pay_data.payment_method);
            $("#ServiceID").val(pay_data.payment_service_id);
            $("#PaymentID").val(pay_data.payment_id);
            $("#OrderNumber").val(pay_data.payment_order_id);
            $("#PaymentDesc").val(pay_data.payment_desc);
            $("#MerchantName").val(pay_data.payment_merchant_name);
            $("#MerchantReturnURL").val(pay_data.payment_return_url);
            $("#MerchantCallbackURL").val(pay_data.payment_callback_url);
            $("#Amount").val(pay_data.payment_amount);
            $("#CurrencyCode").val(pay_data.payment_currency_code);
            $("#CustIP").val(pay_data.payment_customer_ip);
            $("#CustName").val(pay_data.payment_customer_name);
            $("#CustEmail").val(pay_data.payment_customer_email);
            $("#CustPhone").val(pay_data.payment_customer_phone);
            $("#HashValue").val(pay_data.payment_hash_value);
            $("#MerchantTermsURL").val(pay_data.payment_terms_url);
            $("#LanguageCode").val(pay_data.payment_language_code);
            $("#PageTimeout").val(pay_data.payment_page_timeout);
            $("#paymentGatewayForm").attr('action',pay_data.payment_url);
            $("#paymentGatewayForm").submit();
                     
            
        }else{
            notifyMessage('error', data.message);
        }
    },
    
    ServiceBookingFailureHandler: function(data){
        notifyMessage('error', data.message);
    }
    
};

var ServiceData = (function(){
    
    var serviceDataFun = function(data){
        this.services = data.data;
    };
    
    serviceDataFun.prototype.getAllServices = function(){       
        
        return this.services;
    };
    
    serviceDataFun.prototype.getServiceByIndex = function(index){       
        
        return this.services[index];
    };
    
    serviceDataFun.prototype.getServiceById = function(id){       
        
        for(var i=0; i< this.services.length; i++){
           if(this.services[i].service_id === id){
               return this.services[i];
           }
        } 
        
    };
    
    serviceDataFun.prototype.getServiceIds = function(){       

       var serviceIds = new Array();
        
       for(var i=0; i< this.services.length; i++){
           serviceIds[i] = this.services[i].service_id;
       }
       return serviceIds;
    };
    
    var servicePackageDataFun = function(data){
        this.package = data.data;
    };
    
    servicePackageDataFun.prototype.getAllServicePackages = function(){       
        
        return this.package;
    };
    
    servicePackageDataFun.prototype.getServicePackages = function(serviceId){       
        if ( this.package[serviceId] !== undefined ) {
            return this.package[serviceId];
        }else{ 
            return [];
        }
    };
    
    servicePackageDataFun.prototype.getPackage = function(serviceId, packageId){       
        if ( this.package[serviceId] !== undefined) {
            return this.package[serviceId][packageId];
        }else{ 
            return [];
        }
    };
    
    var serviceFrequencyDataFun = function(data){
        this.frequency = data.data;
    };
    
    serviceFrequencyDataFun.prototype.getAllServiceFrequency = function(){       
        
        return this.frequency;
    };
    
    serviceFrequencyDataFun.prototype.getFrequencyOfService = function(serviceId){       
        if ( this.frequency[serviceId] !== undefined ) {
            return this.frequency[serviceId];
        }else{
            return [];
        }
    };
    serviceFrequencyDataFun.prototype.getFrequencyName = function(serviceId, frequencyId){       
        if ( this.frequency[serviceId] !== undefined ) {
            return this.frequency[serviceId][frequencyId].service_frequency_name;
        }else{
            return null;
        }
    };
    serviceFrequencyDataFun.prototype.getFrequencyDiscount = function(serviceId, frequencyId){       
        if ( this.frequency[serviceId] !== undefined ) {
            return this.frequency[serviceId][frequencyId].service_frequency_offer_value;
        }else{
            return null;
        }
    };
    
    
    var serviceAddonDataFun = function(data){
        this.addon = data.data;
    };
    
    serviceAddonDataFun.prototype.getAllServiceAddons = function(){       
        
        return this.addon;
    };
    
    serviceAddonDataFun.prototype.getServiceAddons = function(serviceId){       
        if ( this.addon[serviceId] !== undefined ) {
            return this.addon[serviceId];
        }else{
            return [];
        }
    };
    
    serviceAddonDataFun.prototype.getServiceAddon = function(serviceId, addonId){       
        if ( this.addon[serviceId] !== undefined ) {
             return this.addon[serviceId][addonId];
        }else{
            return [];
        }
    };
    
    var serviceSplRequestDataFun = function(data){
        this.splRequest = data.data;
    };
    
    serviceSplRequestDataFun.prototype.getAllServiceSplRequest = function(){       
        
        return this.splRequest;
    };
    
    serviceSplRequestDataFun.prototype.getServiceSplRequest = function(serviceId){       
        if ( this.addon[serviceId] !== undefined ) {
            return this.splRequest[serviceId];
        }else{
            return [];
        }
    };
    
    return {
        
        service : function(data){
            return new serviceDataFun(data); 
        },
        servicePackage : function(data){
            return new servicePackageDataFun(data); 
        },
        serviceFrequency : function(data){
            return new serviceFrequencyDataFun(data); 
        },
        serviceAddon : function(data){
            return new serviceAddonDataFun(data); 
        },
        serviceSplRequest : function(data){
            return new serviceSplRequestDataFun(data); 
        }
        
    };
    
    
    
})();

var RenderView = {
    
    renderServices : function(){ 
        var servicesObj = ServiceObjects.ServiceObject;
        var packagesObj = ServiceObjects.ServicePackageObject;
        if( (servicesObj !== null) && (packagesObj !== null)){  
            var services = servicesObj.getAllServices();
            var packages = packagesObj.getAllServicePackages();
            //console.log(packages);
            for(var i=0; i<services.length; i++ ){
                var id = services[i].service_id;
                if(packages[id] !== undefined){
                    
                    $("#service_temp_html").html($("#service_html").html());

                    $("#service_temp_html li").attr('data-servicetitle', services[i].service_name);                    
                    $("#service_temp_html li .ct-image").attr('src', services[i].service_image_url);
                    $("#service_temp_html li").attr('data-id', i+1);
                    $("#service_temp_html li input[type=radio]").attr('id', "ct-service-"+i);
                    $("#service_temp_html li input[type=radio]").addClass('service-radio');

                    $("#service_temp_html li input[type=radio]").val(id);
                    $("#service_temp_html li label").attr('for', "ct-service-"+i);
                    $("#service_temp_html li .service-name").text(services[i].service_name);

                    $("#booking_service_list").append($("#service_temp_html").html());

                    $("#service_temp_html").html('');
                    RenderView.renderServicePackage(id);
                }
            }
        }
    },
    
    renderServicePackage: function(serviceId){
        var packagesObj = ServiceObjects.ServicePackageObject;
        var packages = packagesObj.getAllServicePackages();
        
        
        //$("#package_temp_html ul").addClass('service_'+serviceId+'_package');
        var str = "<ul class='services-list ct_service_package_"+serviceId+"' style='display:block'>";
        if(packages[serviceId] !== undefined){
            var packs = packages[serviceId];
            for(var packId in packs){
                var package = packs[packId].package;
                $("#package_temp_html").html($("#service_package_html").html());
                $("#package_temp_html li input[type=radio]").attr('id', "ct_service_pk_"+packId);
                $("#package_temp_html li input[type=radio]").addClass('package-radio');
                
                $("#package_temp_html li input[type=radio]").val(package.service_package_id);
                $("#package_temp_html li label").attr('for', "ct_service_pk_"+packId);               
                $("#package_temp_html li .spring-body .p-header").html(package.building_name);
                
                $("#package_temp_html li .spring-body .p-header").after("<p class='p-content'>"+package.service_package_min_crew_member+" cleaning Crew </p>");
                $("#package_temp_html li .spring-body .p-header").after("<p class='p-content'>"+package.service_package_bedroom+" Bedrooms and "+package.service_package_bathroom+" Bathrooms </p>");
                if(package.area_size !== null && package.area_size !== ''){
                    $("#package_temp_html li .spring-body .p-header").after("<p class='p-content'>"+package.area_size+" /"+package.area_measurement+"</p>");
                }
                str += $("#package_temp_html").html();
                
                $("#package_temp_html").html('');
            
            }
            str += "</ul>"; 
            $(".packageDiv").append(str);
            
        }
            
    },
    
    renderServiceAddons: function(){
        var servicesObj = ServiceObjects.ServiceObject;
        var addonsObj   = ServiceObjects.ServiceAddonsObject;
        if( (servicesObj !== null) && (addonsObj !== null)){ 
            var services = servicesObj.getAllServices();
            var addons = addonsObj.getAllServiceAddons();
            
            for(var i=0; i<services.length; i++ ){
                var id = services[i].service_id;
                if(addons[id] !== undefined){
                    
                    
                    var html_str = "\
                    <div class='ct-extra-services-list  ct-common-box add_on_lists ct_service_addons_"+id+"'' id='service_addons_"+id+"'>\n\
                        <div class='ct-list-header'>\n\
                        <h3 class='header3'>Service Addons</h3>\n\
                    </div>\n\
                    <ul class='addon-service-list fl '>";
                    
                    for(var addonId in addons[id]){
                        html_str += "<li class='ct-sm-6 ct-md-4 ct-lg-3 ct-xs-12 mb-15 add_addon_class_selected'><input type='checkbox' name='addon-checkbox' class='addon-checkbox addons_servicess' data-id='"+ addons[id][addonId].service_addon_price_id +"' id='ct-addon-"+ addons[id][addonId].service_addon_price_id +"' data-mnamee='ad_unit1' value='"+ addons[id][addonId].service_addon_price_id +"' >";
                        html_str += "<label class='ct-addon-ser border-c' for='ct-addon-"+ addons[id][addonId].service_addon_price_id +"'><span></span>";
                        html_str += "   <div class='addon-price'>RM "+ addons[id][addonId].service_addon_price_price +"</div>";
                        let name = addons[id][addonId].service_addon_name;
                        if(name.toLowerCase() == 'bedroom' || name.toLowerCase() == 'bedrooms'){
                            html_str += "   <div class='ct-addon-img'><img src='"+base_url+"/assets/images/bedroom.png'></div></label>";               

                        }else if(name.toLowerCase() == 'bathroom' || name.toLowerCase() == 'bathrooms'){
                          html_str += "   <div class='ct-addon-img'><img src='"+base_url+"/assets/images/bathroom.png'></div></label>";

                        }else if(name.toLowerCase() == 'cupboard' || name.toLowerCase() == 'cupboards'){
                          html_str += "   <div class='ct-addon-img'><img src='"+base_url+"/assets/images/cupboard.png'></div></label>";

                        }else if(name.toLowerCase() == 'wardrobe' || name.toLowerCase() == 'wardrobes'){
                          html_str += "   <div class='ct-addon-img'><img src='"+base_url+"/assets/images/cupboard.png'></div></label>";

                        }else if(name.toLowerCase() == 'oven' || name.toLowerCase() == 'ovens'){
                          html_str += "   <div class='ct-addon-img'><img src='"+base_url+"/assets/images/oven.png'></div></label>";

                        }else if(name.toLowerCase() == 'fridge' || name.toLowerCase() == 'fridges'){
                          html_str += "   <div class='ct-addon-img'><img src='"+base_url+"/assets/images/fridge.png'></div></label>";

                        }else if(name.toLowerCase() == 'car' || name.toLowerCase() == 'cars'){
                          html_str += "   <div class='ct-addon-img'><img src='"+base_url+"/assets/images/car.png'></div></label>";

                        }else if(name.toLowerCase() == 'window' || name.toLowerCase() == 'windows'){
                          html_str += "   <div class='ct-addon-img'><img src='"+base_url+"/assets/images/window.png'></div></label>";

                        }else if(name.toLowerCase() == 'kitchen' || name.toLowerCase() == 'kitchens'){
                          html_str += "   <div class='ct-addon-img'><img src='"+base_url+"/assets/images/kitchen.png'></div></label>";

                        }else if(name.toLowerCase() == 'ironing' || name.toLowerCase() == 'ironing'){
                          html_str += "   <div class='ct-addon-img'><img src='"+base_url+"/assets/images/ironing.png'></div></label>";

                        }else{
                           html_str += "   <div class='ct-addon-img'><img src='"+base_url+"/assets/images/other_addon.png'></div></label>";
 
                        }
                        html_str += "<div class='ct-addon-count border-c  add_minus_button add_minus_buttonid1' style='display: none;'>";

                        html_str += "<div class='ct-btn-group'><button data-ids='"+ addons[id][addonId].service_addon_price_id +"' id='minus_"+ addons[id][addonId].service_addon_price_id +"' class='minus ct-btn-left ct-small-btn' type='button' data-units_id='"+ addons[id][addonId].service_addon_price_id +"' data-duration_value='' data-mnamee='ad_unit"+ addons[id][addonId].service_addon_price_id +"' data-method_name='"+ addons[id][addonId].service_addon_name +"' data-service_id='"+ id +"' data-rate='' data-method_id='0' data-type='addon'>-</button>";

                        html_str += "<input type='text' value='0' class='ct-btn-text addon_qty data_addon_qtyrate qtyyy_ad_unit1' data-rate='5' name='addon-service-count' id='addon_qty_"+id+"'>";

                        html_str += "<button data-ids='"+ addons[id][addonId].service_addon_price_id +"' id='add_"+ addons[id][addonId].service_addon_price_id +"' data-db-qty='5' data-mnamee='ad_unit"+ addons[id][addonId].service_addon_price_id +"' class='add ct-btn-right float-right ct-small-btn' type='button' data-units_id='"+ addons[id][addonId].service_addon_price_id +"' data-service_id='"+ id +"' data-method_id='0' data-duration_value='' data-method_name='"+ addons[id][addonId].service_addon_name + "' data-rate=''";
                        html_str += " data-type='addon'>+</button>";
                        html_str += "</div></div><div class='addon-name fl ta-c'>"+ addons[id][addonId].service_addon_name +"</div></li>";                                       
                                              
                    }
                    html_str += "</ul></div>";    
                 
                    $("#service_addons_div").append(html_str);
                }
                
            }
            
            
        }
        
    },
    
    renderFrequencyPrices: function(){
        
        var servicesObj = ServiceObjects.ServiceObject;
        var freqObj     = ServiceObjects.ServiceFrequencyObject;
        
        if( (servicesObj !== null) && (freqObj !== null)){ 
            var services = servicesObj.getAllServices();
            var frequency = freqObj.getAllServiceFrequency();
            
            for(var i=0; i<services.length; i++ ){
                var id = services[i].service_id;
                if(frequency[id] !== undefined){
                    $("#frequency_temp_html").html($("#service_frequency_price_html").html());
                    
                    $("#frequency_temp_html div").addClass('ct_service_frequency_'+id);
                    $("#frequency_temp_html div").css('display','block');
                    //$("#frequency_temp_html div ul").addClass();
                    for(var freqId in frequency[id]){
                        var freq = "<li class='ct-sm-6 ct-md-3 ct-xs-12 mb-10'>\n\
                            <div class='discount-text f-l'><span class='discount-price'> -Save "+ frequency[id][freqId].service_frequency_offer_value +"%- </span>\n\
                            </div>\n\
                            <input type='radio' name='frequently_discount_radio' checked='' data-id='"+ frequency[id][freqId].service_frequency_offer_id +"' class='cart_frequently_discount' id='discount-often-"+ frequency[id][freqId].service_frequency_offer_id +"' data-name='"+ frequency[id][freqId].service_frequency_name +"' value='"+ frequency[id][freqId].service_frequency_offer_value +"' >\n\
                            <label class='ct-btn-discount border-c' for='discount-often-"+ frequency[id][freqId].service_frequency_offer_id +"'>\n\
                            <span class='float-left freq_disc_name'>"+ frequency[id][freqId].service_frequency_name +"</span>\n\
                            <span class='ct-discount-check float-right'></span>\n\
                            </label></li>";
                        $("#frequency_temp_html div ul").append(freq);
                    }
                    
                    //One Time Pay......
                    var freq = "<li class='ct-sm-6 ct-md-3 ct-xs-12 mb-10'>\n\
                            <div class='discount-text f-l'><span class='discount-price'> -Save Zero%- </span>\n\
                            </div>\n\
                            <input type='radio' name='frequently_discount_radio' checked='' data-id='0' class='cart_frequently_discount' id='discount-often-"+id+"-0' data-name='Monthly' value='0' >\n\
                            <label class='ct-btn-discount border-c' for='discount-often-"+id+"-0'>\n\
                            <span class='float-left freq_disc_name'>Once</span>\n\
                            <span class='ct-discount-check float-right'></span>\n\
                            </label></li>";
                        $("#frequency_temp_html div ul").append(freq);
                        
                    $("#service_frequency_price_div").append($("#frequency_temp_html").html());
                    $("#frequency_temp_html").html("");
                }
                
            }
            
        }
        
    },
    
    renderSplRequest: function(){
                
        var servicesObj = ServiceObjects.ServiceObject;
        var splReqObj     = ServiceObjects.ServiceSplRequestObject;
        
        if( (servicesObj !== null) && (splReqObj !== null)){ 
            var services = servicesObj.getAllServices();
            var splReq = splReqObj.getAllServiceSplRequest();
            
            for(var i=0; i<services.length; i++ ){
                var id = services[i].service_id;
                if(splReq[id] !== undefined){
                    $("#service_spl_request_temp_html").html($("#service_spl_request_html").html());
                    
                    $("#service_spl_request_temp_html div").addClass('ct_service_spl_request_'+id);
                    $("#service_spl_request_temp_html div").css('display','block');
                    //$("#frequency_temp_html div ul").addClass();
                    for(var splReqId in splReq[id]){
                        var freq = "<li class='ct-sm-6 ct-md-4 ct-lg-3 ct-xs-12 mb-15 add_addon_class_selected'>\n\
                            <input type='checkbox' name='spl-request-checkbox' class='addon-checkbox addons_servicess' data-serviceId='"+id+"' data-id='"+ splReq[id][splReqId].service_spl_request_id +"' id='ct-spl-req-"+ splReq[id][splReqId].service_spl_request_id +"' data-mnamee='"+splReq[id][splReqId].spl_request_name+"'>\n\
                            <label class='ct-addon-ser border-c' for='ct-spl-req-"+ splReq[id][splReqId].service_spl_request_id +"'><span></span>";
                        
                        if(splReq[id][splReqId].service_spl_request_price !== null &&  splReq[id][splReqId].service_spl_request_price !== ""){
                             freq += "<div class='addon-price' >RM "+ splReq[id][splReqId].service_spl_request_price +"</div>";
                        }else{
                          freq += "<div class='addon-price'></div>";  
                        }

                        let name = splReq[id][splReqId].spl_request_name;
                        if(name.toLowerCase() == 'bedroom' || name.toLowerCase() == 'bedrooms'){
                            freq += "   <div class='ct-addon-img'><img src='"+base_url+"/assets/images/bedroom.png'></div>";               

                        }else if(name.toLowerCase() == 'bathroom' || name.toLowerCase() == 'bathrooms'){
                          freq += "   <div class='ct-addon-img'><img src='"+base_url+"/assets/images/bathroom.png'></div>";

                        }else if(name.toLowerCase() == 'cupboard' || name.toLowerCase() == 'cupboards'){
                          freq += "   <div class='ct-addon-img'><img src='"+base_url+"/assets/images/cupboard.png'></div>";

                        }else if(name.toLowerCase() == 'wardrobe' || name.toLowerCase() == 'wardrobes'){
                          freq += "   <div class='ct-addon-img'><img src='"+base_url+"/assets/images/cupboard.png'></div>";

                        }else if(name.toLowerCase() == 'oven' || name.toLowerCase() == 'ovens'){
                          freq += "   <div class='ct-addon-img'><img src='"+base_url+"/assets/images/oven.png'></div>";

                        }else if(name.toLowerCase() == 'fridge' || name.toLowerCase() == 'fridges'){
                          freq += "   <div class='ct-addon-img'><img src='"+base_url+"/assets/images/fridge.png'></div>";

                        }else if(name.toLowerCase() == 'car' || name.toLowerCase() == 'cars'){
                          freq += "   <div class='ct-addon-img'><img src='"+base_url+"/assets/images/car.png'></div>";

                        }else if(name.toLowerCase() == 'window' || name.toLowerCase() == 'windows'){
                          freq += "   <div class='ct-addon-img'><img src='"+base_url+"/assets/images/window.png'></div>";

                        }else if(name.toLowerCase() == 'kitchen' || name.toLowerCase() == 'kitchens'){
                          freq += "   <div class='ct-addon-img'><img src='"+base_url+"/assets/images/kitchen.png'></div>";

                        }else if(name.toLowerCase() == 'ironing' || name.toLowerCase() == 'ironing'){
                          freq += "   <div class='ct-addon-img'><img src='"+base_url+"/assets/images/ironing.png'></div>";

                        }else{
                           freq += "   <div class='ct-addon-img'><img src='"+base_url+"/assets/images/other_addon.png'></div>";
 
                        }

                        freq +="</label>\n\
                            <div class='addon-name fl ta-c'>"+ splReq[id][splReqId].spl_request_name +"</div>\n\
                        </li>";
            
                        $("#service_spl_request_temp_html div ul").append(freq);
                    }
                        
                    $("#service_spl_request_div").append($("#service_spl_request_temp_html").html());
                    $("#service_spl_request_temp_html").html("");
                }
                
            }
            
        }
    },
    
    renderSessionCalender: function(count){
        var calSession = "";
        var servId = Booking.getService();
        var service = ServiceObjects.ServiceObject.getServiceById(servId);
        for(var i=0; i< count; i++){

            var string='<div class="row"><div class="ct-md-6 ct-sm-6 ct-xs-12 ct-form-row"><label for="ct-first-name">Service Date</label><div class="input-group date"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input type="text" class="form-control pull-right add_show_error_class error date_selection" id="service_date_'+i+'" readonly required></div></div>';
                string += '<div class="ct-md-4 ct-sm-4 ct-xs-12 ct-form-row"><label for="ct-session">Session</label> <div class="input-group date"><div class="input-group-addon"><i class="fa fa-clock-o"></i></div>';
                
            if(service.service_name == 'Basic Home Cleaning'){
                string += '<select placeholder="Select session" name="ct_session" id="service_session_'+i+'" class="add_show_error_class error session_selection" required ><option value="1" selected>Full-day (9am - 6pm)</option><option value="2" >4 hours - Morning</option><option value="3">4 hours - Afternoon</option></select>';
            }else{
                string += '<select placeholder="Select session" name="ct_session" id="service_session_'+i+'" class="add_show_error_class error session_selection" required disabled><option value="1" selected>Full-day (9am - 6pm)</option><option value="2" >4 hours - Morning</option><option value="3">4 hours - Afternoon</option></select>';
            }
                
                string += '</div></div><div class="text-red error_message" style="clear:both;"> </div></div>';
            calSession += string;
        }
        
        $("#date_session_div").html();
        $("#date_session_div").html(calSession);
    },
    
    showAddonNames: function(){
        var addonNames = Booking.getAddonNames();
        var Splnames = Booking.getExtraServiceNames();
        var string ="";
        if(Object.keys(addonNames).length >0){
            $('.ct-addons-list-main').show();
            $('.ct-addons-list-main .addons').show();
            for(var name in addonNames){
                string += name +"; ";
            }
            $('.ct-addons-list-main .addons .addons_names').html(string);
            $('.ct-addons-list-main').show();
        }else{
            $('.ct-addons-list-main .addons .addons_names').html('');
            $('.ct-addons-list-main .addons').hide();
            if(Object.keys(Splnames).length <=0){
                $('.ct-addons-list-main').hide();
            }
        }
        
    },
    
    showExtraServiceNames: function(){
        var names = Booking.getExtraServiceNames();
        var addonNames = Booking.getAddonNames();
        var string = "";
        if(Object.keys(names).length >0){
            $('.ct-addons-list-main').show();
            $('.ct-addons-list-main .spl_req').show();
            for(var i in names){
                string += names[i] +"; ";
            }
            $('.ct-addons-list-main .spl_req .spl_req_names').html(string);
            $('.ct-addons-list-main, .spl_req').show();
        }else{
            $('.ct-addons-list-main .spl_req .spl_req_names').html('');
            $('.ct-addons-list-main .spl_req').hide();
            if(Object.keys(addonNames).length <=0){
                $('.ct-addons-list-main').hide();
            }
        }
    },
    renderSelectedDateSession: function(){
        var i=0;
        var string = "";
        this.serviceDateSession = [];
        $("#date_session_div .date_selection").each(function() {
            if($("#service_date_"+i).val() != ''){
                string += '<p>'+ $("#service_date_"+i).val() +' @ '+ $('#service_session_'+i+' :selected').text() +'</p>';
            }
            i++;
        });
        $("#ct-price-scroll-new .datetime_value p.sel-datetime .cart_session").html(string);
    }
    
};




$(function () {
    
    var data = ServiceJSON.getServicesJson({'postcode':postcode});
    var service = ServiceFactory.getServicesCommand(data, 'getServices.html',ServiceResponseHandler.ServiceSuccessHandler, ServiceResponseHandler.ServiceFailureHandler);
    ServiceFactory.executeTask(service);

    //display the tax price
    $(".cart_tax").html(gst+"%");
    
    setTimeout(function(){ 
        
        //$('.service-radio').each(function(){
             
            //$(this).attr('checked', true);
        //});
        
        $(document).on("click", ".services-list .ser_details .service-radio", function(e){

            //console.log("Service Selected: "+ $(this).val());
            //Reset the date selected array
            selectedDates = Array();
            
            var serviceId = $(this).val();
            
            Booking.reset();
            Booking.setService(serviceId); 
            
            //Reset the addons/spl service/packge related info from floating bar
            //$('.cart-items-main f-l').hide();
            RenderView.showExtraServiceNames();
            Booking.removeAddonNames();
            RenderView.showAddonNames();
            RenderView.renderSessionCalender(1);                
                $('.date_selection').datepicker({
                    autoclose: true,
                    dateFormat: "dd-mm-yy", 
                      minDate:2,
                      onSelect: function(){
                        var selectedDate = $(this).val();
                        var sessionId =  $(this).closest('.ct-form-row').next().children().find('.session_selection').val();
                         self = this;  
                        checkEmployeeAvailability(selectedDate, sessionId);
                      }
                });
            //Reset the addon quantity of all services to zero
            $('.addon_qty').val(0);

            //reset the Package Details
           $("#ct-price-scroll-new .service_name label.package_detail").html('');
           $("#ct-price-scroll-new .datetime_value p.sel-datetime .cart_session").html('');

           var services = ServiceObjects.ServiceObject.getAllServices();
            for(var i=0; i<services.length; i++ ){                
                if( services[i].service_id == serviceId){
                    if(services[i].service_name == 'Basic Home Cleaning'){
                        $(".ct_service_package_"+services[i].service_id+" li:first .package-radio").trigger('click');
                        //$(".ct_service_frequency_"+services[i].service_id+" .ct-discount-often li .cart_frequently_discount").trigger('click');
                        $(".ct_service_frequency_"+services[i].service_id).hide();
                        $(".tax_display, .total_price_display, .sub_total_display").show();
                        $(".ct_service_addons_"+services[i].service_id).hide();
                        $('.session_selection').val('1');
                        $('.session_selection').trigger('change');

                        $('.service_package_list_div').hide();
                       // $('.cart-items-main f-l').show();
                        $('.building_type_div').show(); // Show the Building type selection div
                    }else{
                        $(".ct_service_frequency_"+services[i].service_id).show();
                        $(".ct_service_package_"+services[i].service_id).show();
                        $(".ct_service_addons_"+services[i].service_id).show();
                        $(".ct_service_package_"+services[i].service_id+" .package-radio").prop('checked', false);
                        $(".tax_display, .total_price_display, .sub_total_display").hide();
                        $('.service_package_list_div').show();
                        $('.building_type_div').hide(); // Hide the Building type selection div
                    }
                    $(".ct_service_spl_request_"+services[i].service_id).show();                    
                    
                }else{
                    $(".ct_service_spl_request_"+services[i].service_id).hide();
                    $(".ct_service_frequency_"+services[i].service_id).hide();
                    $(".ct_service_addons_"+services[i].service_id).hide();
                    $(".ct_service_package_"+services[i].service_id).hide();

                }

            }
            $('.session_selection').val('1');
            var service = ServiceObjects.ServiceObject.getServiceById(serviceId);
            $("#ct-price-scroll-new .service_name p.sel-service").html(service.service_name);
            
            
            $(".cart_frequently_discount").prop('checked', false);
            //$(".ct_service_package_"+services[0].service_id+" .package-radio").trigger('click');
        });
        
        
        //Service package Selection Event Handling
        $(document).on("click", ".packageDiv .services-list .package-radio", function(e){           
            Booking.setPackage($(this).val());
            //console.log(Booking.getPackage());
            var package = ServiceObjects.ServicePackageObject.getPackage(Booking.getService(), Booking.getPackage());
            //console.log(package);
            var price = parseFloat( (package.spl_price !== null) ? package.spl_price : package.package.service_package_onetime_price );
            
            var servId = Booking.getService();
            var service = ServiceObjects.ServiceObject.getServiceById(servId);
            if(service.service_name == 'Basic Home Cleaning'){
                $("#ct-price-scroll-new .service_name label.package_detail").html('');
            }else{
                $("#ct-price-scroll-new .service_name label.package_detail").html(package.package.building_name+", "+package.package.service_package_bedroom+" Bedroom with "+package.package.service_package_bathroom+" Bathroom");
            }

            
            //$("#ct-price-scroll-new .datetime_value p.sel-datetime .cart_session").html(package.package.service_package_min_hours+" Hour Session");
            //reset the price before adding the new price
            Booking.resetPrice();
            price = Booking.addPrice(price);
            $("#ct-price-scroll-new .cart_sub_total").html(price);           
            //Booking.calculateTotalPrice();
            price = Booking.calculateTotalPrice();
            $("#ct-price-scroll-new .cart_total").html(price);
            $(".tax_display, .total_price_display, .sub_total_display").show();
            //console.log(Booking.getPrice());
        });
        
        //Service Addons Selection Event Handling
        $(document).on("click", "#service_addons_div .add_on_lists .addon-service-list .addon-checkbox", function(){
            var addons = {};
          // console.log("Addon Is Checked: " +$(this).is(":checked"));
           if($(this).is(":checked")){
               addons[$(this).val()] = $("#addon_qty_"+$(this).val()).val();
             //  console.log("Addon Count: "+addons[$(this).val()]);
           }
            
        });
        
        //Special Service Request Selection Event Handling
        $(document).on("click", "#service_spl_request_div .ct-extra-services-list .addon-service-list .addon-checkbox", function(){
            var splRequest = new Array();
            //console.log("Spl request Is Checked: "+ $(this).is(":checked"));
            var serviceId = $(this).attr('data-serviceid');
            var splService = Booking.getExtraService();
            
            if($(this).is(":checked")){               

                splService.push($(this).attr('data-id'));
               
                Booking.setExtraServiceName($(this).attr('data-mnamee'));
                
            }else{
                
                if(splService.length > 0){
                    var splId = $(this).attr('data-id');
                    var index = splService.indexOf(splId);
                    if (index >= 0) {
                      splService.splice( index, 1 );
                    }
                    
                }
                Booking.removeExtraServiceName($(this).attr('data-mnamee'));
            }
            RenderView.showExtraServiceNames();
            
            //console.log(splService);

        });
        
        //Frequency Selection Event Handling
        $(document).on('click', '#service_frequency_price_div .ct-discount-often li .cart_frequently_discount', function(){
            //console.log('Freq Discount ID:');
            
            //Reset the date selected array
            selectedDates = Array();
            var freqId = $(this).data('id');
            var servId = Booking.getService();
            var freqName = "Once";
            var freqDisc = 0;
            if(freqId != 0){
                freqDisc = ServiceObjects.ServiceFrequencyObject.getFrequencyDiscount(servId, freqId);
                freqName = ServiceObjects.ServiceFrequencyObject.getFrequencyName(servId, freqId);
            }
                //console.log(freqDisc+" - "+freqName);
                Booking.setFrequencyDisc(freqDisc);
                Booking.setFrequencyName(freqName);
                
                $("#ct-price-scroll-new .cart_sub_total").html(Booking.getPrice());           
                $("#ct-price-scroll-new .cart_total").html(Booking.calculateTotalPrice());
                $('.coupon_display .cart_discount').html(Booking.getDiscount());
                $('.f_discount_name').html(freqName);
                $('.coupon_display').show();
                
                if( freqName.toLowerCase() === 'weekly'){
                    RenderView.renderSessionCalender(4);
                }else if( freqName.toLowerCase() === 'biweekly'){
                    RenderView.renderSessionCalender(2);
                }else{
                    RenderView.renderSessionCalender(1);
                }
                $('.date_selection').datepicker({
                    autoclose: true,
                    dateFormat: "dd-mm-yy", 
                      minDate:2,
                      onSelect: function(){
                        var selectedDate = $(this).val();
                        var sessionId =  $(this).closest('.ct-form-row').next().children().find('.session_selection').val();
                          self = this;
                         checkEmployeeAvailability(selectedDate, sessionId);
                      }
                });
                
            Booking.setFrequency(freqId);
            
        });


        $(document).on('change', ".session_selection", function(){

            var selectedService = Booking.getService(); 
            var sessionId = $(this).val();
            var service = ServiceObjects.ServiceObject.getServiceById(selectedService);
            var serviceName = service.service_name;

            var package = ServiceObjects.ServicePackageObject.getPackage(Booking.getService(), Booking.getPackage());
            var calBy = package.package.service_package_price_cal_by;
            var minHours = package.package.service_package_min_hours;
            var price = 0;
                if(package.spl_price !== null){
                    price = package.spl_price;
                }else{
                    price = package.package.service_package_onetime_price;
                }

            if(serviceName == 'Basic Home Cleaning' && calBy == 'hour'){
                Booking.resetPrice();
                var hours = getHoursFromSession(sessionId);
                var price = price * (hours/minHours);
                Booking.addPrice(price)
                $("#ct-price-scroll-new .cart_sub_total").html(price);           
                
                price = Booking.calculateTotalPrice();
                $("#ct-price-scroll-new .cart_total").html(price);
                $(".tax_display, .total_price_display, .sub_total_display").show();
            }
            
            self = $(this).parentsUntil('.row').prev().children().find('.date_selection');
            var selectedDate = $(this).parentsUntil('.row').prev().children().find('.date_selection').val();
            if(selectedDate != ''){
                checkEmployeeAvailability(selectedDate, sessionId);
            }
        });
       
       
       $('.house_type').on('click', function(){
            var hType = $(this).val();
           $("#ct-price-scroll-new .service_name label.package_detail").html(hType);
 
       });

       //Initial Selection
        $("#booking_service_list li:first .service-radio").trigger('click');
        $(".packageDiv ul:first li:first .package-radio").trigger('click');
        $('.session_selection').val('1');$('.session_selection').trigger('change');
        

    }, 1500);
    
    $("#paymentForm").submit( function(e){
        e.preventDefault();
        if( $("#accept-conditions").is(":checked") ){
            var data = Booking.getBookingDetail();
            var json = ServiceJSON.getServiceBookingJson(data);
            var booking = ServiceFactory.getServiceBookingCommand(json, 'booking_info.html',ServiceResponseHandler.ServiceBookingSuccessHandler, ServiceResponseHandler.ServiceBookingFailureHandler);
            //console.log(booking);  
            ServiceFactory.executeTask(booking);
        }else{
            notifyMessage('error', "Please read Terms & Conditions and accept it by checking checkbox to proceed further with booking service.");
        }
    });
                           

});

function checkEmployeeAvailability(serviceDate, sessionId){
    
//    if( $.inArray(serviceDate, selectedDates) < 0){
//        selectedDates.push(serviceDate);
//      
    let now = new Date();
    let date = new Date(serviceDate);
    let hour = getSessionHour(sessionId);
    now.setDate(now.getDate() +2);
    if(now.getDate() === date.getDate()){
        
        if( now.getHours() >= hour){
            $(self).val('');
            $(self).parentsUntil('row').next().next('.error_message').html('');
            $(self).parentsUntil('row').next().next('.error_message').html("For today's service, selected session need to be booked 2 hour(s) prior.");
            return;
        }
    }


        var data = ServiceJSON.getEmployeeAvailabilityJson({'serviceDate':serviceDate, 'sessionId':sessionId, 'postcode':postcode, 'package': Booking.getPackage()});
        ajaxCall('checkEmployeeAvailability.html', 
            data,  
        (result)=>{
            $(self).parentsUntil('row').next().next('.error_message').html('');
            //$.inArray()
            RenderView.renderSelectedDateSession();
        },  
        (result)=>{
            $(self).val('');
            $(self).parentsUntil('row').next().next('.error_message').html('');
            $(self).parentsUntil('row').next().next('.error_message').html(result.message);
            RenderView.renderSelectedDateSession();
        });
        
//    }else{
//        $(self).val('');
//        $(self).parentsUntil('row').next().next('.error_message').html('Service Date:'+serviceDate+' already selected.');
//    }   
    
}

var Booking = (function() {
    var service = null;
    var package = null;
    var addon = {};
    var addonPrice = 0;
    var addonNames = {};
    var extraService = [];
    var extraServiceNames = [];
    var frequency = 0;
    var frequencyDisc = 0;
    var frequencyName = 'Once';
    var discount = '';
    var price   = 0;
    var gstax   = gst * 0.01;
    var serviceDateSession = [];
    var gstStatus = gst_status;

    return{
        reset : function(){
            this.package = null;
            this.addon = {};
            this.addonNames = {};
            this.extraService = [];
            this.extraServiceNames = [];
            this.frequency = 0;
            this.frequencyDisc = 0;
            this.discount = 0;
            this.price = 0;
            this.addonPrice = 0;
            this.serviceDateSession = [];
            this.frequencyName = 'Once';
        },

        setService : function(val){
            if(val !==''){
                this.service = val;
            }
        },

        getService : function(){
            return this.service;
        },

        setPackage : function(val){
            if(val !==''){
                this.package = val;
            }
        },

        getPackage : function(){
            return this.package;
        },

        setAddon : function(id, obj){
            if(id !==''){
                this.addon[id] = obj;
            }
        },

        getAddon : function(){
            return this.addon;
        },
        
        setAddonName: function(name, count){
            if(count <= 0){               
                delete this.addonNames[name];
                
            }else{
                this.addonNames[name] = count;
            }
        },
        
        getAddonNames: function(){
            return this.addonNames;
        },

        removeAddonNames: function(){
            this.addonNames = {};
        },
        
        setExtraServiceName: function(name){
            this.extraServiceNames.push(name);
        },
        
        removeExtraServiceName: function(name){
            var index = this.extraServiceNames.indexOf(name);
            if (index >= 0) {
              this.extraServiceNames.splice( index, 1 );
            }
        },
        
        getExtraServiceNames: function(){
            return this.extraServiceNames;
        },
        
        addAddonPrice: function(price){
            
            return this.addonPrice = this.addonPrice + parseFloat(price);
        },
        
        deductAddonPrice: function(price){
            
            return this.addonPrice = this.addonPrice - parseFloat(price);
        },
        
        getAddonPrice: function(){
            return this.addonPrice;
        },

        setExtraService : function(val){
            if(val !==''){
                this.extraService = val;
            }
        },

        getExtraService : function(){
            return this.extraService;
        },

        setFrequency : function(val){
            if(val !==''){
                this.frequency = val;
            }
        },

        getFrequency : function(){
            return this.frequency;
        },
        
        setFrequencyDisc: function(price){
            this.frequencyDisc = price;
        },
        
        getFrequencyDisc: function(){
            return this.frequencyDisc;
        },
        
        setFrequencyName: function(name){
            this.frequencyName = name;
        },
        
        getFrequencyName: function(){
            return this.frequencyName;
        },
        
        getDiscount: function(){
            return this.discount;
        },
        
        calculatePriceWithFrequency: function(price){
            var freqDisc = this.frequencyDisc;
            var freqName = this.frequencyName;
            if( freqName.toLowerCase() === 'weekly'){
                price = parseFloat( price * 4 );                
                this.discount = parseFloat(price * (freqDisc/100));
            }else if( freqName.toLowerCase() === 'biweekly'){
                price = parseFloat( price * 2 );
                this.discount = parseFloat(price * (freqDisc/100));
            }else{
                this.discount = 0;
            }           
            price = parseFloat( price - this.discount );
            this.discount.toFixed(2);
           return price;
            
        },
        
        calculateTotalPrice: function(){
            var price = this.price + this.addonPrice;
            price = Booking.calculatePriceWithFrequency(price);
            if(gst_status == 1){
                return parseFloat( (price * gstax) + price).toFixed(2);
            }else{
                return parseFloat(price).toFixed(2);
            }
        },
        
        addPrice: function(price){
            return this.price = parseFloat(this.price) + parseFloat(price);
        },
        
        resetPrice: function(){
            this.price = 0; 
        },
        
        getPrice : function(){
            return this.price;
        },

        getGstStatus: function(){
           return this.gstStatus;
        },
        
        getServiceDateSession : function(){
            var i=0;
            var self = this;
            this.serviceDateSession = [];
            $("#date_session_div .date_selection").each(function() {
               self.serviceDateSession.push({'date': $("#service_date_"+i).val(), 'session': $('#service_session_'+i).val()});
                i++;
            });
            return this.serviceDateSession;
        },
        
        getBookingDetail: function(){
            var data = new Object();
                data.service = this.service;
                data.package = this.package;
                data.addon  = this.addon;
                data.extraService = this.extraService;
                data.frequency = this.frequency;
                data.frequencyValue = this.frequencyDisc;
                data.price = this.price;
                data.totalPrice = this.calculateTotalPrice();
                data.servicePostcode = $("#postcodeSearch").attr('data-val');
                data.userRegStatus = $(".user-selection").val();
                data.serviceDateSession = this.getServiceDateSession();
                data.gstStatus  = this.gstStatus;
                data.gst        = this.gstax;
                var info = new Object();
                    info.email = $("#ct-email").val();
                    info.reEmail = $("#ct-re-email").val();
                    info.pass = $("#ct-preffered-pass").val();
                    info.firstName = $("#ct-first-name").val();
                    info.lastName = $("#ct-last-name").val();
                    info.phone = $("#ct-user-phone").val();
                    info.address = $("#ct-street-address").val();
                    info.pincode = $("#ct-zip-code").val();
                    info.city =  $("#ct-city").val();
                    info.state = $("#ct-state").val();
                    info.note = $("#ct-notes").val();
                    //info.vacuumCln = $(".vc_status").val();
                    //info.parking = $(".p_status").val();
                    //info.contactStatus = $("#contact_status").val();
                
                data.userInfo = info;
                return data;
                
        }
    };
    
})();

function getHoursFromSession(sessionId){
    var hours = 0;
    switch(sessionId){
        case '1': hours = 8; break;
        case '2': hours = 4; break;
        case '3': hours = 4; break;
        case '4': hours = 2; break;
    }
    return hours;
}

function getSessionHour(sessionId){
    var hour = 0;
    switch(sessionId){
        case '1': hour = 9; break;
        case '2': hour = 9; break;
        case '3': hour = 14; break;
        case '4': hour = 20; break;
    }
    return hour;
}


