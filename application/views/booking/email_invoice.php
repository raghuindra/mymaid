<?php 

$user = $response['other'][0];
//print_r($user); exit;
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>A simple, clean, and responsive HTML invoice template</title>
    
    <style>
    .invoice-box{
        max-width:800px;
        margin:auto;
        padding:30px;
        border:1px solid #eee;
        box-shadow:0 0 10px rgba(0, 0, 0, .15);
        font-size:16px;
        line-height:24px;
        font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color:#555;
    }
    
    .invoice-box table{
        width:100%;
        line-height:inherit;
        text-align:left;
    }
    
    .invoice-box table td{
        padding:5px;
        vertical-align:top;
    }
    
    .invoice-box table tr td:nth-child(2){
        text-align:right;
    }
    
    .invoice-box table tr.top table td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.top table td.title{
        font-size:45px;
        line-height:45px;
        color:#333;
    }
    
    .invoice-box table tr.information table td{
        padding-bottom:40px;
    }
    
    .invoice-box table tr.heading td{
        background:#eee;
        border-bottom:1px solid #ddd;
        font-weight:bold;
    }
    
    .invoice-box table tr.details td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom:1px solid #eee;
    }
    
    .invoice-box table tr.item.last td{
        border-bottom:none;
    }
    
    .invoice-box table tr.total td:nth-child(2){
        border-top:2px solid #eee;
        font-weight:bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td{
            width:100%;
            display:block;
            text-align:center;
        }
        
        .invoice-box table tr.information table td{
            width:100%;
            display:block;
            text-align:center;
        }
    }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="https://www.mymaidz.com/assets/images/YellowMM_240.png" style="width:85%; max-width:200px;">
                            </td>
                            
                            <td>
                                Invoice #: <?php echo $response['invoiceId']; ?><br>
                                Booked On: <?php 
                                            $dateObj = date_create($response['other'][0]->booking_booked_on);
                                            $date = date_format($dateObj, 'd-m-Y');
                                echo $date; ?>
                                <br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                ADVANCE DREAMS VENTURE SDN. BHD 160<br>
                                Jln. Kilang Lama, Pusat Perniagaan Putra,<br>
                                Kulim, Kedah 09000
                            </td>
                            
                            <td>
                                <?php echo $user->booking_user_detail_address;?>.<br>
                                <?php echo $user->booking_user_detail_city." ". $user->state_name; ?><br>
                                <?php echo $user->booking_user_detail_pincode; ?><br>
                                <?php echo $user->booking_user_detail_email; ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="heading">
                <td>
                    Payment Method
                </td>
                
                <td>
                    Online #
                </td>
            </tr>
            
            <tr class="details">
                <td>
                    
                </td>
                
                <td>
                    
                </td>
            </tr>
            
            <tr class="heading">
                <td>
                    Service Details
                </td>
                
                <td>
                    
                </td>
            </tr>
            
            <tr class="item">
                <td>
                    Service Name
                </td>
                
                <td>
                    <?php echo  $name = ($response['other'])? $response['other'][0]->service_name: ''; ?>              
                </td>
            </tr>

            <?php if(($response['other']) && $response['other'][0]->service_name != 'Basic Home Cleaning'){ ?>
            <tr class="item">
                <td>
                    Package
                </td>
                
                <td>
                    <?php                     
                        echo $package =  ($response['other'])? $response['other'][0]->building_name.", ".$response['other'][0]->service_package_bedroom." Bedroom(s), ".$response['other'][0]->service_package_bathroom." Bathroom(s), ".$response['other'][0]->area_size." ".$response['other'][0]->area_measurement: '';
                    ?> 
                </td>
            </tr>
            <?php } ?>

            <tr class="item last">
                <td>
                    Frequency
                </td>
                
                <td>
                    <?php 
                        if($response['other'][0]->booking_frequency_frequency_offer_id == 0){
                            $frequnecy_name = 'Once';
                        }else{
                            $frequnecy_name = $response['other'][0]->service_frequency_name;
                        }
                        echo $frequnecy_name;
                    ?>
                </td>
            </tr>
            <tr class="item last">
                <td>
                    Service Date(s)
                </td>
                
                <td>
                    <table cellpadding="0" cellspacing="0">
                    <?php 
                    $sessions = $response['session'];
                        $i=1;
                        foreach($sessions as $session){
                            $dateObj = date_create($session->booking_sessions_service_date);
                            $date = date_format($dateObj, 'd-m-Y');
                        
                            echo $string = "<tr>
                                <td>".$i."</td>
                                <td>".$date."</td>
                                <td>".$session->session_name."</td>
                            </tr>";
                            $i++;
                        }

                    ?>
                    </table>
                </td>
            </tr>
            <tr class="item last">
                <td>
                    Addon(s)
                </td>
                
                <td>
                   <table cellpadding="0" cellspacing="0">
                        <?php 
                            $addons = $response['addons'];
                                foreach($addons as $addon){
                            
                                echo $string =" <tr>
                                    <td>".$addon->service_addon_name."</td>
                                    <td>".$addon->booking_addons_count."</td>
                                </tr>";
                            
                            }
                        ?>
                    </table>
                </td>
            </tr>
            <tr class="item last">
                <td>
                    Special Request(s)
                </td>
                
                <td>
                    <table cellpadding="0" cellspacing="0">
                        <?php 
                            $spl_requests = $response['spl_request'];
                            foreach($spl_requests as $spl_request){                                                                                       
                                echo $string ="<tr><th> ". $spl_request->spl_request_name." </th></tr>";
                            
                            }
                        ?>
                    </table>
                </td>
            </tr>
            <?php 
                if( $response['other'][0]->booking_gst_status == 1 ){
            ?>
                <tr class="total">
                    <td></td>
                    
                    <td>
                       <b>GST: <?php echo $response['other'][0]->booking_gst."%";?></b>
                    </td>
                </tr>
            <?php } ?>
            <tr class="total">
                <td></td>
                
                <td>
                   <b>Total: <?php echo "MYR ".$response['other'][0]->booking_amount; ?></b>
                </td>
            </tr>
        </table>        
    </div>

    <br/></br><p><b>Thanks</b></p>
    <p><b>Admin Mymaidz.com</b></p><br/>
    <p>For more info kindly browse our website <a href='https://www.mymaidz.com'>www.mymaidz.com</a></p>
    <p>Like our page at <a href='https://www.facebook.com/mymaidz/'>https://www.facebook.com/mymaidz/</a></p>    

</body>
</html>
