<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Wesellrestaurants.com</title>
    <style>
    .page-break {
        page-break-after: always;
    }

    small { 
        font-size: smaller;
    }
    </style>
</head>
<body>

<!-- Page #1 -->

<table width="100%"  align="center" cellpadding="0" cellspacing="0" > 
<tr><td width="" align="center">
  
  <img src="{{ public_path('assets/images/print_pdf/new-wsrlogo.png') }}" alt="Wesellrestaurants" style="width:150px; height:95px" />

</td></tr>

<tr>
  <td height="50" align="center"><p style="font-family:sans-serif;font-weight:normal; font-size:20px">RELEASE OF ESCROW DEPOSIT(S) with INSTRUCTIONS</p></td></tr>
</table>

<table width="100%"  align="center" cellpadding="0" cellspacing="0">
<tr>
<td style="text-align:justify;"> <p style="margin:0; padding:0 18px 0 0;font-family:sans-serif;font-weight:normal; text-align:left; font-size:12px">THIS RELEASE is entered into between the undersigned Seller(s), Buyer(s) and Brokers, who were parties to a certain "Asset Purchase Contract" as follows: <br> <br>
Amount: $ <u>{{ $data['amount_of'] ?? '__________________________' }}</u>
    <br>
Date Executed: <u>{{ $data['dated'] ?? '___________________________' }}</u>

  <br>
Property: <u style="font-weight:normal; text-align:center; font-size:12px">{{ $data['information'] ?? '' }}</u>
  <br>
 </p></td>
</tr>
<tr>
<td align="center"><p style="margin:0; padding: 5px 30px 0 0; text-indent: 40px; font-family:sans-serif; font-weight:normal; text-align:left; font-size:12px"> THE SELLER AND BUYER hereby release each other and the brokerage firms mentioned below, together with their affiliates and respective officers, directors, agents, employees, successors and assigns from any and all claims and actions whatsoever arising from or related to said Contract or pre-Contract issues existing as of the date of this release.</p> </td>
</tr>

<tr>
<td align="center"><p style="margin:0; padding: 5px 30px 0 0;  text-indent: 40px; font-family:sans-serif; font-weight:normal; text-align:left; font-size:12px"> IT IS THE INTENTION of this Agreement that any responsibilities, obligations or rights arising by virtue of said Contract and Deposit Receipt are by this release declared null and void and of no further effect when signed by all of the below named parties. A facsimile copy of this document and any signatures, shall be considered for all purposes as original.</p> </td>
</tr>

<tr>
<td align="center"><p style="margin:0; padding: 5px 30px 0 0;  text-indent: 40px; font-family:sans-serif; font-weight:normal; text-align:left; font-size:12px"> THE ESCROW AGENT holding the deposit under the terms of said Deposit Receipt, is hereby directed and instructed forthwith to disperse said deposit(s) held in escrow in the following manner:</p> </td>
</tr>

<tr>
<td align="center"><p style="margin:0; padding: 10px 0 0px 0; font-family:sans-serif; font-weight:normal; text-align:center; font-size:12px">$ 
  
  <u>{{ $data['deposit_receipt'] ?? '________________' }}</u>

 <b style="margin-left:8px;">To:</b>

  <u style="width:120px;">{{ $data['deposit_to'] ?? '________________' }}</u>

 </p> </td>
</tr>

<tr>
<td align="left"><p style="margin:0; padding: 5px 0px 20px 0; font-weight:normal; font-family:sans-serif; text-align:left; font-size:12px">IN WITNESS THEREOF the parties have hereunto set their hands and seals on the day and year below.</p> </td>
</tr>
</table>

<table width="100%" cellpadding="0" cellspacing="2" border="0" align="center">
<tr>
<td style="width:130px;height:20px;padding: 10px 0 0 0;">Executed by Buyer:</td>
<td style="width:180px;height:20px;padding: 10px 0 0 0;border-bottom:1px solid #000;"> </td>
<td style="width:40px;height:20px;padding: 10px 0 0 0;">(Date)</td>
<td style="width:5px;height:20px;padding: 10px 0 0 0;"></td>
<td style="width:130px;height:20px;padding: 10px 0 0 0;">Executed by Seller</td>
<td style="width:180px;height:20px;padding: 10px 0 0 0;border-bottom:1px solid #000;"> </td>
<td style="width:40px;height:20px;padding: 10px 0 0 0;">(Date)</td>
</tr>
<tr>
<td colspan="2" style="width:310px;height:20px;border-bottom:1px solid #000;"> </td>
<td style="width:40px;height:20px;"></td>
<td style="width:5px;height:20px;"></td>
<td colspan="2" style="width:310px;height:20px;border-bottom:1px solid #000;"> </td>
<td style="width:40px;height:20px;"></td>
</tr>
<tr>
<td colspan="2" style="width:310px;height:20px;border-bottom:1px solid #000;">
  <u>{{ $data['buyername'] ?? '________________' }}</u>
</td>
<td style="width:40px;height:20px;"></td>
<td style="width:5px;height:20px;"></td>
<td colspan="2" style="width:310px;height:20px;border-bottom:1px solid #000;">
  
  <u>{{ $data['sellername'] ?? '________________' }}</u>

</td>
<td style="width:40px;height:20px;"></td>
</tr>
<tr>
<td colspan="3" style="width:350px;"><span>Buyer(s)</span></td>
<td style="width:5px;height:20px;"></td>
<td colspan="3" style="width:350px;"><span>Seller(s)</span></td>
</tr>
</table>
<table width="100%" cellpadding="0" cellspacing="2" border="0" align="center">
<tr>
<td style="width:170px;height:20px;padding: 10px 0 0 0;">Executed by Selling Broker:</td>
<td style="width:140px;height:20px;padding: 10px 0 0 0;border-bottom:1px solid #000;"> </td>
<td style="width:40px;height:20px;padding: 10px 0 0 0;">(Date)</td>
<td style="width:5px;height:20px;padding: 10px 0 0 0;"></td>
<td style="width:170px;height:20px;padding: 10px 0 0 0;">Executed by Listing Broker:</td>
<td style="width:140px;height:20px;padding: 10px 0 0 0;border-bottom:1px solid #000;"> </td>
<td style="width:40px;height:20px;padding: 10px 0 0 0;">(Date)</td>
</tr>
<tr>
<td colspan="2" style="width:310px;height:20px;border-bottom:1px solid #000;"></td>
<td style="width:40px;height:20px;"></td>
<td style="width:5px;height:20px;"></td>
<td colspan="2" style="width:310px;height:20px;border-bottom:1px solid #000;"></td>
<td style="width:40px;height:20px;"></td>
</tr>
<tr>
<td colspan="2" style="width:310px;height:20px;border-bottom:1px solid #000;margin:0;padding:0;"><p style="margin:0; padding: 0;">
  
  <u>{{ $data['seller_broker'] ?? '________________________________' }}</u>

</p></td>
<td style="width:40px;height:20px;"></td>
<td style="width:5px;height:20px;"></td>
<td colspan="2" style="width:310px;height:20px;border-bottom:1px solid #000;margin:0;padding:0;"><p style="margin:0; padding: 0;">
  
  <u>{{ $data['listing_broker'] ?? '________________________________' }}</u>

</p></td>
<td style="width:40px;height:20px;"></td>
</tr>
<tr>
<td colspan="3" style="width:350px;"><span>Selling Broker</span></td>
<td style="width:5px;height:20px;"></td>
<td colspan="3" style="width:350px;"><span>Listing Broker</span></td>
</tr>

@if(isset($data['check_state_hid']) && $data['check_state_hid'] == 'GA')
<tr>
	<td colspan="2" style="width:310px;height:20px;border-bottom:1px solid #000;margin:0;padding:0;"><p style="margin:0; padding: 0;">
    
    <u>{{ $data['georgiaRealestateOfcnum'] ?? '________________________________' }}</u>
  
  </p></td>
	<td style="width:40px;height:20px;"></td>
	<td style="width:5px;height:20px;"></td>
	<td colspan="2" style="width:310px;height:20px;border-bottom:1px solid #000;margin:0;padding:0;"><p style="margin:0; padding: 0;">
    
    <u>{{ $data['georgiaRealestateOfcnum'] ?? '________________________________' }}</u>
  
  </p></td>
	<td style="width:40px;height:20px;"></td>
</tr>
<tr>
	<td colspan="3" style="width:350px;"><span>Georgia Real Estate License Numb</span></td>
	<td style="width:5px;height:20px;"></td>
	<td colspan="3" style="width:350px;"><span>Georgia Real Estate License Numb</span></td>
</tr>

@endif 

</table>

</body>
</html>