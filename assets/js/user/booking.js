/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
postcode = $("#postcodeSearch").data('val');
function ajaxCall(url, data, successCallback, failureCallback) {
    console.log("AJAx Call Params: "); console.log(data);
    $.ajax({
        type: "POST",
        url: base_url+url,
        data: data,
        cache: false,
        success: function (res) {
console.log('Json Response' +res);
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
        
        
        
    };
    
})();

var ServiceResponseHandler = {
    
    ServiceSuccessHandler: function(data){
        var dataObj = ServiceData.service(data);
        console.log(dataObj.getAllServices());
        ServiceObjects.ServiceObject = dataObj;
        var serviceIds = dataObj.getServiceIds();
        //get Service Packages
        ServiceResponseHandler.TriggerServicePackageCall(serviceIds, postcode);
        
    },
    
    ServiceFailureHandler: function(data){
        console.log("Service Call failure..!!!");
    },
    
    TriggerServicePackageCall: function(serviceIds, postcode){
        var jsonData = ServiceJSON.getServicePackageJson({'serviceId':serviceIds,'postcode':postcode}); console.log(jsonData);
        var servicePackage = ServiceFactory.getServicesCommand(jsonData, 'getServicePackages.html',ServiceResponseHandler.ServicePackageSuccessHandler, ServiceResponseHandler.ServicePackageFailureHandler);
        ServiceFactory.executeTask(servicePackage);
    },
    
    ServicePackageSuccessHandler: function(data){
        var dataObj = ServiceData.servicePackage(data);
        ServiceObjects.ServicePackageObject = dataObj;
        var packages = dataObj.getAllServicePackages();

        console.log(packages); 
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
        console.log("Package Call failure..!!!");
    },
    
    TriggerServiceFrequencycall: function(serviceIds, postcode){
        console.log("Frequency Ajax Call..!!!");
        var jsonData = ServiceJSON.getServiceFrequencyJson({'serviceId':serviceIds,'postcode':postcode}); console.log(jsonData);
        var serviceFrequency = ServiceFactory.getServicesCommand(jsonData, 'getServiceFrequencies.html',ServiceResponseHandler.ServiceFrequencySuccessHandler, ServiceResponseHandler.ServiceFrequencyFailureHandler);
        ServiceFactory.executeTask(serviceFrequency);
    },
    
    ServiceFrequencySuccessHandler: function(data){
        var dataObj = ServiceData.serviceFrequency(data);
        ServiceObjects.ServiceFrequencyObject = dataObj;
        console.log("Frequency Call Success...");
        console.log(ServiceObjects.ServiceFrequencyObject.getAllServiceFrequency());
        RenderView.renderFrequencyPrices();
    },
    
    ServiceFrequencyFailureHandler: function(data){
        console.log("Frequency Call failure..!!!");
    },
    
    TriggerServiceAddoncall: function(serviceIds, postcode){
        console.log("Addon Ajax Call..!!!");
        var jsonData = ServiceJSON.getServiceAddonsJson({'serviceId':serviceIds,'postcode':postcode}); console.log(jsonData);
        var serviceAddon = ServiceFactory.getServicesCommand(jsonData, 'getServiceAddons.html',ServiceResponseHandler.ServiceAddonSuccessHandler, ServiceResponseHandler.ServiceAddonFailureHandler);
        ServiceFactory.executeTask(serviceAddon);
    },
    
    ServiceAddonSuccessHandler: function(data){
        var dataObj = ServiceData.serviceAddon(data);
        ServiceObjects.ServiceAddonsObject = dataObj;
        console.log("Service Addons Call Success..");
        console.log(ServiceObjects.ServiceAddonsObject.getAllServiceAddons());
        
        RenderView.renderServiceAddons();
    },
    
    ServiceAddonFailureHandler: function(data){
        console.log("Addon Call failure..!!!");
    },
    
    TriggerServiceSplRequestcall: function(serviceIds, postcode){
        console.log("Spl Request Ajax Call..!!!");
        var jsonData = ServiceJSON.getServiceSplRequestJson({'serviceId':serviceIds,'postcode':postcode}); console.log(jsonData);
        var serviceSplRequest = ServiceFactory.getServicesCommand(jsonData, 'getServiceSplRequests.html',ServiceResponseHandler.ServiceSplRequestSuccessHandler, ServiceResponseHandler.ServiceSplRequestFailureHandler);
        ServiceFactory.executeTask(serviceSplRequest);
    },
    
    ServiceSplRequestSuccessHandler: function(data){
        var dataObj = ServiceData.serviceSplRequest(data);
        ServiceObjects.ServiceSplRequestObject = dataObj;
        console.log("Spl Request Call Success..!!!");
        console.log(ServiceObjects.ServiceSplRequestObject.getAllServiceSplRequest());
        RenderView.renderSplRequest();
    },
    
    ServiceSplRequestFailureHandler: function(data){
        console.log("Spl Request Call failure..!!!");
    },
    
    ServiceBookingSuccessHandler: function(data){
        if(data.status){
            notifyMessage('success', data.message);
        }else{
            notifyMessage('error', data.message);
        }
    },
    
    ServiceBookingFailureHandler: function(data){
        notifyMessage('error', "Some issue with system/internet. Please try again after some time.");
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
            for(var i=0; i<services.length; i++ ){
                var id = services[i].service_id;
                if(packages[id] !== undefined){
                    
                    $("#service_temp_html").html($("#service_html").html());

                    $("#service_temp_html li").attr('data-servicetitle', services[i].service_name);
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
                        html_str += "<li class='ct-sm-6 ct-md-4 ct-lg-3 ct-xs-12 mb-15 add_addon_class_selected'><input type='checkbox' name='addon-checkbox' class='addon-checkbox addons_servicess_2' data-id='"+ addons[id][addonId].service_addon_price_id +"' id='ct-addon-"+ addons[id][addonId].service_addon_price_id +"' data-mnamee='ad_unit1' value='"+ addons[id][addonId].service_addon_price_id +"' >";
                        html_str += "<label class='ct-addon-ser border-c' for='ct-addon-"+ addons[id][addonId].service_addon_price_id +"'><span></span>";
                        html_str += "   <div class='addon-price'>RM "+ addons[id][addonId].service_addon_price_price +"</div>";
                        html_str += "    <div class='ct-addon-img'><img src='http://skymoonlabs.com/cleanto/demo//assets/images/addons-images/ct-icon-fridge.png'></div></label>";               
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
                            <input type='radio' name='frequently_discount_radio' checked='' data-id='"+ frequency[id][freqId].service_frequency_offer_id +"' class='cart_frequently_discount' id='discount-often-"+ frequency[id][freqId].service_frequency_offer_id +"' data-name='Monthly' value='"+ frequency[id][freqId].service_frequency_offer_id +"' >\n\
                            <label class='ct-btn-discount border-c' for='discount-often-"+ frequency[id][freqId].service_frequency_offer_id +"'>\n\
                            <span class='float-left'>"+ frequency[id][freqId].service_frequency_name +"</span>\n\
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
                            <span class='float-left'>Once</span>\n\
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
                            <input type='checkbox' name='spl-request-checkbox' class='addon-checkbox addons_servicess_2' data-id='"+ splReq[id][splReqId].service_spl_request_id +"' id='ct-spl-req-"+ splReq[id][splReqId].service_spl_request_id +"' data-mnamee='ad_unit4'>\n\
                            <label class='ct-addon-ser border-c' for='ct-spl-req-"+ splReq[id][splReqId].service_spl_request_id +"'><span></span>";
                        
                        if(splReq[id][splReqId].service_spl_request_price !== null &&  splReq[id][splReqId].service_spl_request_price !== ""){
                             freq += "<div class='addon-price' >RM "+ splReq[id][splReqId].service_spl_request_price +"</div>";
                        }else{
                          freq += "<div class='addon-price'></div>";  
                        }
                               
                        freq += "<div class='ct-addon-img'><img src='http://skymoonlabs.com/cleanto/demo//assets/images/services/default.png'>\n\
                                </div>\n\
                            </label>\n\
                            <div class='addon-name fl ta-c'>"+ splReq[id][splReqId].spl_request_name +"</div>\n\
                        </li>";
            
                        $("#service_spl_request_temp_html div ul").append(freq);
                    }
                        
                    $("#service_spl_request_div").append($("#service_spl_request_temp_html").html());
                    $("#service_spl_request_temp_html").html("");
                }
                
            }
            
        }
    }
    
};




$(function () {
    
    var data = ServiceJSON.getServicesJson({'postcode':postcode});
    var service = ServiceFactory.getServicesCommand(data, 'getServices.html',ServiceResponseHandler.ServiceSuccessHandler, ServiceResponseHandler.ServiceFailureHandler);
    ServiceFactory.executeTask(service);


    setTimeout(function(){ 
        $(document).on("click", ".services-list .ser_details .service-radio", function(e){

            console.log("Service Selected: "+ $(this).val());
            
            var serviceId = $(this).val();
            
            Booking.reset();
            Booking.setService(serviceId); 
            
            var services = ServiceObjects.ServiceObject.getAllServices();
            for(var i=0; i<services.length; i++ ){
                if( services[i].service_id == serviceId){
                    $(".ct_service_spl_request_"+services[i].service_id).show();
                    $(".ct_service_frequency_"+services[i].service_id).show();
                    $(".ct_service_addons_"+services[i].service_id).show();
                    $(".ct_service_package_"+services[i].service_id).show();
                }else{
                    $(".ct_service_spl_request_"+services[i].service_id).hide();
                    $(".ct_service_frequency_"+services[i].service_id).hide();
                    $(".ct_service_addons_"+services[i].service_id).hide();
                    $(".ct_service_package_"+services[i].service_id).hide();
                }
            }
            
            var service = ServiceObjects.ServiceObject.getServiceById(serviceId);
            $("#ct-price-scroll-new .service_name p.sel-service").html(service.service_name);
        });
        
        //Service package Selection Event Handling
        $(document).on("click", ".packageDiv .services-list .package-radio", function(e){           
            Booking.setPackage($(this).val());
            console.log(Booking.getPackage());
            var package = ServiceObjects.ServicePackageObject.getPackage(Booking.getService(), Booking.getPackage());
            console.log(package);
            var price = parseFloat( (package.spl_price !== null) ? package.spl_price : package.package.service_package_onetime_price );
            
            $("#ct-price-scroll-new .service_name label.package_detail").html(package.package.building_name+", "+package.package.service_package_bedroom+" Bedroom with "+package.package.service_package_bathroom+" Bathroom");
            $("#ct-price-scroll-new .datetime_value p.sel-datetime .cart_session").html(package.package.service_package_min_hours+" Hour Session");
            //reset the price before adding the new price
            Booking.resetPrice();
            price = Booking.addPrice(price);
            $("#ct-price-scroll-new .cart_sub_total").html(price);           
            //Booking.calculateTotalPrice();
            price = Booking.calculateTotalPrice();
            $("#ct-price-scroll-new .cart_total").html(price);
            console.log(Booking.getPrice());
        });
        
        //Service Addons Selection Event Handling
        $(document).on("click", "#service_addons_div .add_on_lists .addon-service-list .addon-checkbox", function(){
            var addons = {};
           console.log("Addon Is Checked: " +$(this).is(":checked"));
           if($(this).is(":checked")){
               addons[$(this).val()] = $("#addon_qty_"+$(this).val()).val();
               console.log("Addon Count: "+addons[$(this).val()]);
           }
            
        });
        
        

    }, 2000);
    
    $("#paymentForm").submit( function(e){
        e.preventDefault();
        var data = Booking.getBookingDetail();
        var json = ServiceJSON.getServiceBookingJson(data);
        var booking = ServiceFactory.getServiceBookingCommand(json, 'booking_info.html',ServiceResponseHandler.ServiceBookingSuccessHandler, ServiceResponseHandler.ServiceBookingFailureHandler);
            ServiceFactory.executeTask(booking);
    });
    
});

var Booking = (function() {
    var service = null;
    var package = null;
    var addon = {};
    var addonPrice = 0;
    var extraService = null;
    var frequency = null;
    var price   = 0;
    
    return{
        reset : function(){
            this.package = null;
            this.addon = {};
            this.extraService = null;
            this.frequency = null;
            this.price = 0;
            this.addonPrice = 0;

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
        
        calculateTotalPrice: function(){
            var price = this.price + this.addonPrice;
            return (parseFloat(price * 0.12) + parseFloat(price));
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
        
        getBookingDetail: function(){
            var data = new Object();
                data.service = this.service;
                data.package = this.package;
                data.addon  = this.addon;
                data.extraService = this.extraService;
                data.frequency = this.frequency;
                data.price = this.price;
                data.totalPrice = this.calculateTotalPrice();
                data.servicePostcode = $("#postcodeSearch").attr('data-val');
                data.userRegStatus = $(".user-selection").val();
                
                var info = new Object();
                    info.serviceDate = $("#select-date").val();
                    info.email = $("#ct-email").val();
                    info.pass = $("#ct-preffered-pass").val();
                    info.firstName = $("#ct-first-name").val();
                    info.lastName = $("#ct-last-name").val();
                    info.phone = $("#ct_user_phone").val();
                    info.address = $("#ct-street-address").val();
                    info.pincode = $("#ct-zip-code").val();
                    info.city =  $("#ct-city").val();
                    info.state = $("#ct-state").val();
                    info.note = $("#ct-notes").val();
                    info.vacuumCln = $(".vc_status").val();
                    info.parking = $(".p_status").val();
                    info.contactStatus = $("#contact_status").val();
                
                data.userInfo = info;
                return data;
                
        }
    };
    
})();


