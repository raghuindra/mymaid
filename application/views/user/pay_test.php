<form id="paymentForm" name="frmPayment" method="post" action="https://test2pay.ghl.com/IPGSG/Payment.aspx">

    <input type="hidden" name="TransactionType" value="SALE">
<input type="hidden" name="PymtMethod" value="ANY">
<input type="hidden" name="ServiceID" value="ADV">
<input type="hidden" name="PaymentID" value="<?php echo $payId = md5(uniqid("booking12345674238472984MyMaidz", true));?>">
<input type="hidden" name="OrderNumber" value="abcgfchg">
<input type="hidden" name="PaymentDesc" value="Booking No: IJKLMN, Sector:
KUL-BKI, First Flight Date: 26 Sep 2012">
<input type="hidden" name="MerchantName" value="Advance Dreams Venture Sdn Bhd">
<input type="hidden" name="MerchantReturnURL"
value="http://mymaidz.com/pay_response.html">
<input type="hidden" name="MerchantCallbackURL"
value="http://mymaidz.com/pay_callback.html">
<input type="hidden" name="Amount" value="1.00">
<input type="hidden" name="CurrencyCode" value="MYR">
<input type="hidden" name="CustIP" value="106.51.25.94">
<input type="hidden" name="CustName" value="Jason">
<input type="hidden" name="CustEmail" value="Jasonabc@gmail.com">
<input type="hidden" name="CustPhone" value="60121235678">
<input type="hidden" name="HashValue" value='<?php echo hash("sha256", "adv12345ADV".$payId."http://mymaidz.com/pay_response.htmlhttp://mymaidz.com/pay_callback.html1.00MYR106.51.25.94780"); ?>'>
<input type="hidden" name="MerchantTermsURL"
value="http://mymaidz.com/termsCondition.html">
<input type="hidden" name="LanguageCode" value="en">
<input type="hidden" name="PageTimeout" value="780">
<input type="submit" name="Payment Gateway" value="Pay">
</form>
