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
        
        executeTask : function(command){
            command.execute();
        }
    };

})();

var ServiceJSON = (function(){
    
    return {
        
        getServicesJson: function(data){
            data = JSON.stringify({
					   
                "data": {
                  "postcode": data.postcode
                },
                "header": {
                    "active": true
                }

            });
            return data;
            
        },
        
        getServicePackageJson: function(data){
            data = JSON.stringify({
					   
                "data": {
                  "postcode": data.postcode,
                  "serviceId": data.serviceId
                },
                "header": {
                    "active": true
                }

            });
            return data;
            
        },
        
        getServiceFrequencyJson: function(data){
            data = JSON.stringify({
					   
                "data": {
                  "postcode": data.postcode,
                  "serviceId": data.serviceId
                },
                "header": {
                    "active": true
                }

            });
            return data;
            
        },
        
        getServiceAddonsJson: function(data){
            data = JSON.stringify({
					   
                "data": {
                  "postcode": data.postcode,
                  "serviceId": data.serviceId
                },
                "header": {
                    "active": true
                }

            });
            return data;
            
        },
        
        getServiceSplRequestJson: function(data){
            data = JSON.stringify({
					   
                "data": {
                  "postcode": data.postcode,
                  "serviceId": data.serviceId
                },
                "header": {
                    "active": true
                }

            });
            return data;
            
        },
        
        getServiceSplPriceJson: function(data){
            data = JSON.stringify({
					   
                "data": {
                  "postcode": data.postcode,
                  "serviceId": data.serviceId
                },
                "header": {
                    "active": true
                }

            });
            return data;
            
        }
        
        
        
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
        console.log(ServiceObjects.ServiceFrequencyObject.getServiceAllFrequencyData());
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
        ServiceObjects.ServiceaAddonObject = dataObj;
        console.log("Service Addons..");
        console.log(ServiceObjects.ServiceaAddonObject.getServiceAllAddonData());
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
        ServiceObjects.ServiceaSplRequestObject = dataObj;
        console.log("Spl Request Call Success..!!!");
    },
    
    ServiceSplRequestFailureHandler: function(data){
        console.log("Spl Request Call failure..!!!");
    }
    
    
};

var ServiceData = (function(){
    
    var serviceDataFun = function(data){
        this.services = data.data;
    };
    
    serviceDataFun.prototype.getAllServices = function(){       
        
        return this.services;
    };
    
    serviceDataFun.prototype.getService = function(index){       
        
        return this.services[index];
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
    
    servicePackageDataFun.prototype.getServicePackage = function(serviceId){       
        if ( this.package[serviceId] !== undefined ) {
            return this.package[serviceId];
        }else{ 
            return [];
        }
    };
    
    var serviceFrequencyDataFun = function(data){
        this.frequency = data.data;
    };
    
    serviceFrequencyDataFun.prototype.getServiceAllFrequencyData = function(){       
        
        return this.frequency;
    };
    
    serviceFrequencyDataFun.prototype.getServiceFrequencyOfService = function(serviceId){       
        if ( this.frequency[serviceId] !== undefined ) {
            return this.frequency[serviceId];
        }else{
            return [];
        }
    };
    
    
    var serviceAddonDataFun = function(data){
        this.addon = data.data;
    };
    
    serviceAddonDataFun.prototype.getServiceAllAddonData = function(){       
        
        return this.addon;
    };
    
    serviceAddonDataFun.prototype.getServiceAddon = function(serviceId){       
        if ( this.addon[serviceId] !== undefined ) {
            return this.addon[serviceId];
        }else{
            return [];
        }
    };
    
    var serviceSplRequestDataFun = function(data){
        this.splRequest = data.data;
    };
    
    serviceSplRequestDataFun.prototype.getServiceAllSplRequestData = function(){       
        
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
                $("#package_temp_html li input[type=radio]").addClass('service-radio');
                
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
        
    },
    
};




$(function () {
    
    var data = ServiceJSON.getServicesJson({'postcode':postcode});
    var service = ServiceFactory.getServicesCommand(data, 'getServices.html',ServiceResponseHandler.ServiceSuccessHandler, ServiceResponseHandler.ServiceFailureHandler);
    ServiceFactory.executeTask(service);


    setTimeout(function(){ 
        $(document).on("click", ".services-list .ser_details .service-radio", function(e){

            console.log("Service Selected: "+ $(this).val());
            
            var serviceId = $(this).val();
            
        });

    }, 2000);
    
});




