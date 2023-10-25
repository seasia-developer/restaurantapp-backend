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
<table width="100%" cellpadding="0" cellspacing="0" border="0" align="center">
  <tr>
    <td width="" align="center">
    <img src="{{ public_path('assets/images/print_pdf/new-wsrlogo.png') }}" alt="Wesellrestaurants" style="width:150px;" />
  </td>
  </tr>
  
  <tr>
    <td height="50" align="center"><p style="font-weight:bold; font-size:20px;padding-bottom:5px;">AMENDMENT TO OFFER AND AGREEMENT TO<br />
  PURCHASE ASSETS OF A BUSINESS</p></td></tr>
  
  <tr>
  <td align="center">
    <div style="margin:0; padding:0;font-size:16px;padding-bottom:8px;">
        <b>Amendment # </b>
        <u>{{ $data['amendment'] ?? '_______________________' }}</u>
      </div>
  </td>
  </tr>
</table>



<table width="100%" cellpadding="0" cellspacing="0" border="0" align="center">
<tr>
<td style="width:70px;" align="left"><p style="margin:0; padding: 10px 0 0;"><b>Business:</b></p></td>

<td style="border-bottom:1px solid #000;" align="left" ><p style="font-size:14px; margin:0; padding: 10px 5px 0;">
  
  <u>{{ $data['business_name'] ?? '' }}</u>

</p></td>

</tr>
<tr>
  <td style="width:70px;" align="left"><p style="margin:0; padding: 5px 0 0;"><b>Address:</b></p></td>

  <td style="width:600px; border-bottom:1px solid #000;" align="left" >
    <p style="font-size:14px; margin:0px; padding: 5px 5px 0;"><u>{{ $data['address'] ?? '' }}</u></p>
  </td>

</tr>


<tr>

<td colspan="2" ><p style="font-size:14px; margin:0; padding: 10px 0 0; word-wrap:break-word;"><b>Seller and Buyer Agree to Change the Asset Purchase and Sale Agreement as indicated below:</b></p></td>
</tr>

</table>


<table width="100%" cellpadding="0" cellspacing="0" border="0" align="center">

<tr>
  <td style="width:670px;">
    <p style="word-wrap:break-word; margin:0; padding: 10px 0 0 0;">[
      
      {!! $data['checkbox1'] == "1" ? "<img src=".public_path('assets/images/print_pdf/check.png')." />" : "<img src=".public_path('assets/images/print_pdf/not-check.png')." />" !!}

      
      ] Extend the Time Limit of the Offer for acceptance until: 
      
      <u>{{ $data['extend_time'] ?? '__________' }}</u>
      
      o'clock 
      
      <u>{{ $data['clock'] ?? '____' }}</u>
      
      .m on the 

      <u>{{ $data['time'] ?? '_____' }}</u>
      
      day of 
      
      <u>{{ $data['day'] ?? '______________' }}</u>
      
      , 20

      <u>{{ $data['year'] ?? '______________' }}</u>
    
    </p></td>
</tr>



<tr>
<td style="width:670px;"><p style="word-wrap:break-word; margin:0; padding: 10px 0 0 0; font-weight:10px;">[

  {!! $data['checkbox2'] == "2" ? "<img src=".public_path('assets/images/print_pdf/check.png')." />" : "<img src=".public_path('assets/images/print_pdf/not-check.png')." />" !!}
    
  ] Change the Closing Date to: 

  <u>{{ $data['closingdate'] ?? '_________________________________' }}</u>

</p></td>
</tr>

<tr>

<td style="width:670px;">
  
  <p style="word-wrap:break-word; margin:0; padding: 10px 0 0 0;font-weight:10px;">[

    {!! $data['checkbox3'] == "3" ? "<img src=".public_path('assets/images/print_pdf/check.png')." />" : "<img src=".public_path('assets/images/print_pdf/not-check.png')." />" !!}
    
    ] Change the Due Diligence Period to terminate on 
    
    <u>{{ $data['terminate'] ?? '______________' }}</u>
    
    at 
    
    <u>{{ $data['terminate_time'] ?? '_____________' }}</u>
    
    o'clock  

    <u>{{ $data['terminate_month'] ?? '____' }}</u>
    
    . m.</p></td>
</tr>


<tr>

<td style="width:670px;"><p style="word-wrap:break-word; margin:0; padding: 10px 0 0 0; font-weight:10px;">[

  {!! $data['checkbox4'] == "4" ? "<img src=".public_path('assets/images/print_pdf/check.png')." />" : "<img src=".public_path('assets/images/print_pdf/not-check.png')." />" !!}
  
  ] Change the Purchase Price of the Business to as follows:</p></td>


</tr>

</table>


<table width="100%" cellpadding="0" cellspacing="0" border="0" align="center">

<tr>
  
<td style="width:20px;margin:0px;padding:0px;">$ </td>

<td style="width:150px;border-bottom:1px solid #000;">
  <p style="font-weight:10px; padding-right:10px;">
    
    <u>{{ $data['earnest_money'] ?? '' }}</u>
  
  </p></td>

<td style="width:480px;"><p style="font-weight:10px;padding-left:10px;"> Earnest money, due upon signing this Agreement <b>(Earnest Money)</b></p></td>

</tr>

<tr>
<td style="width:20px;margin:0px;padding:0px;">$ </td>

<td style="width:150px;border-bottom:1px solid #000;">
  
  <p style="font-weight:10px; padding-right:10px;">
    
    <u>{{ $data['cash'] ?? '' }}</u>
  
  </p></td>

<td style="width:480px;"><p style="font-weight:10px;padding-left:10px;"> Cash amount due at Closing <b>(Cash)</b></p></td>
</tr>


<tr>
<td style="width:20px;margin:0px;padding:0px;">$ </td>
<td style="width:150px;border-bottom:1px solid #000;"><p style="font-weight:10px; padding-right:10px;">
  
  <u>{{ $data['seller_financing'] ?? '' }}</u>

</p></td>

<td style="width:480px;"><p style="font-weight:10px;padding-left:10px;"> Seller Financing amount <b>(Seller Financing)</b></p></td>
</tr>
<tr>
<td style="width:20px; margin:0px;padding:0px;">$ </td>
<td style="width:150px;border-bottom:1px solid #000;"><p style="font-weight:10px; padding-right:10px;">
  
  <u>{{ $data['third_party'] ?? '' }}</u>

</p></td>
<td style="width:480px;"><p style="font-weight:10px;padding-left:10px;"> Third party financing <b>(Third-Party Financing)</b></p></td>
</tr>
<tr>
<td style="width:20px;margin:0px;padding:0px;">$ </td>
<td style="width:150px;border-bottom:1px solid #000;"><p style="font-weight:10px; padding-right:10px;">
  
  <u>{{ $data['other1'] ?? '' }}</u>

</p></td>
<td style="width:480px;"><p style="font-weight:10px;padding-left:10px;"> Other:
  
  <u>{{ $data['other2'] ?? '________________________________' }}</u>

  

</p></td>
</tr>
<tr>
<td style="width:20px;margin:0px;padding:0px;">$ </td>
<td style="width:150px;border-bottom:1px solid #000;"><p style="font-weight:10px; padding-right:10px;">
  
  <u>{{ $data['purchase_price'] ?? '' }}</u>

</p></td>
<td style="width:480px;"><p style="font-weight:10px;padding-left:10px;"> TOTAL PURCHASE PRICE  <b>(Purchase Price)</b></p></td>
</tr>
</table>

<table width="100%" cellpadding="0" cellspacing="0" border="0" align="center">
<tr>
<td style="width:650px;"><p style="font-weight:15px;padding: 10px 0 0;"><b>Other Changes, Definitions, or Clarifications</b></p></td>
</tr>
<tr>
<td style="height:20px; width:650px; border-bottom:1px solid #000;"><p style="font-weight:10px;">
  
  <u>{{ $data['chnage_deif1'] ?? '' }}</u>

</p></td>
</tr>
<tr>
<td style="height:20px; width:650px; border-bottom:1px solid #000;"><p style="font-weight:10px;">

  <u>{{ $data['chnage_deif2'] ?? '' }}</u>

</p></td>
</tr>
</table>

<table width="100%" cellpadding="0" cellspacing="0" border="0" align="center">
<tr>
	<th style="font-size:15px;color:#000;width:330px;padding: 25px 0 0;margin:0px">BUYER</th>
	<th style="width:20px;padding: 25px 0 0;"></th>
	<th style="width:330px;padding: 25px 10px 0;font-size:15px;color:#000;">SELLER</th>
</tr>
<tr>
	<td style="border-bottom:1px solid #000;width:330px;height:20px;"><p style="font-family:sans-serif; font-size:13px; color:#000;margin:0;padding:0">
    
    <u>{{ $data['buyerlegalname'] ?? '' }}</u>
  
  </p></td>
	<td style="width:20px"></td>
	<td style="width:330px;border-bottom:1px solid #000;margin-left:10px;height:20px;"><p style="font-family:sans-serif; font-size:13px; color:#000;margin:0; padding:0;padding-left:10px;">
    
    <u>{{ $data['sellerlegalname'] ?? '' }}</u>
  
  </p></td>
</tr>
<tr>

	<td style="width:330px;"><p style="font-family:sans-serif; font-size:9px; color:#000;margin:0; padding:0;">Company Name, if Applicable</p></td>
	<td style="width:20px"></td>
	<td style="width:330px;margin-left:10px;"><p style="font-family:sans-serif; font-size:9px; color:#000;margin:0; padding:0;padding-left:10px;">Company Name, if Applicable</p></td>

</tr>
<tr>
	<td style="border-bottom:1px solid #000;width:330px;height:20px;"><p style="font-family:sans-serif; font-size:13px; color:#000;margin:0; padding:0;"><b>By:</b> </p></td>
	<td style="width:20px"></td>
	<td style="width:330px;border-bottom:1px solid #000;margin-left:10px;height:20px;"><p style="font-family:sans-serif; font-size:13px; color:#000;margin:0; padding:0;padding-left:10px;"><b>By:</b>
     </p></td>
</tr>
<tr>

	<td style="width:330px;"><p style="font-family:sans-serif; font-size:9px; color:#000;margin:0; padding:0;">Signature of Buyer or of Authorized Agent of Buyer  </p></td>
	<td style="width:20px"></td>
	<td style="width:330px;margin-left:10px;"><p style="font-family:sans-serif; font-size:9px; color:#000;margin:0; padding:0;padding-left:10px;">Signature of Seller or of Authorized Agent of Seller  </p></td>

</tr>
<tr>
	<td style="border-bottom:1px solid #000;width:330px;height:20px;"><p style="font-family:sans-serif; font-size:13px; color:#000;margin:0; padding:0;">
    <u>{{ $data['buyername'] ?? '' }}</u>
  </p></td>
	<td style="width:20px"></td>
	<td style="width:330px;border-bottom:1px solid #000;margin-left:10px;height:20px;"><p style="font-family:sans-serif; font-size:13px; color:#000;margin:0; padding:0;padding-left:10px;">
    
    <u>{{ $data['sellername'] ?? '' }}</u>
  
  </p></td>
</tr>

<tr>
	<td style="width:330px;"><p style="font-family:sans-serif; font-size:9px; color:#000;margin:0; padding:0;">Print Name and Title</p></td>
	<td style="width:20px"></td>
	<td style="width:330px;margin-left:10px;"><p style="font-family:sans-serif; font-size:9px; color:#000;margin:0; padding:0;padding-left:10px;">Print Name and Title</p></td>
</tr>

<tr>
	<td style="border-bottom:1px solid #000;width:330px;height:20px;"><p style="font-family:sans-serif; font-size:13px; color:#000;margin:0; padding:0;"> </p></td>
	<td style="width:20px"></td>
	<td style="width:330px;border-bottom:1px solid #000;margin-left:10px;height:20px;"><p style="font-family:sans-serif; font-size:13px; color:#000;margin:0; padding:0;padding-left:10px;"> </p></td>
</tr>
<tr>
	<td style="width:330px;"><p style="font-family:sans-serif; font-size:9px; color:#000;margin:0; padding:0;padding-bottom:20px;">Date Signed</p></td>
	<td style="width:20px"></td>
	<td style="width:330px;margin-left:10px;"><p style="font-family:sans-serif; font-size:9px; color:#000;margin:0; padding:0;padding-bottom:20px;padding-left:10px;">Date Signed</p></td>
</tr>

<tr>
	<td style="border-bottom:1px solid #000;width:330px;height:20px;"><p style="font-family:sans-serif; font-size:13px; color:#000;margin:0; padding:0;"> </p></td>
	<td style="width:20px"></td>
	<td style="width:330px;border-bottom:1px solid #000;margin-left:10px;height:20px;"><p style="font-family:sans-serif; font-size:13px; color:#000;margin:0; padding:0;padding-left:10px;"> </p></td>
</tr>

<tr>
	<td style="width:330px;"><p style="font-family:sans-serif; font-size:9px; color:#000;margin:0; padding:0;">Print Name and Title</p></td>
	<td style="width:20px"></td>
	<td style="width:330px;margin-left:10px;"><p style="font-family:sans-serif; font-size:9px; color:#000;margin:0; padding:0;padding-left:10px;">Print Name and Title</p></td>
</tr>

<tr>
	<td style="border-bottom:1px solid #000;width:330px;height:20px;"><p style="font-family:sans-serif; font-size:13px; color:#000;margin:0; padding:0;"> </p></td>
	<td style="width:20px"></td>
	<td style="width:330px;border-bottom:1px solid #000;margin-left:10px;height:20px;"><p style="font-family:sans-serif; font-size:13px; color:#000;margin:0; padding:0;padding-left:10px;"> </p></td>
</tr>

<tr>
	<td style="width:330px;"><p style="font-family:sans-serif; font-size:9px; color:#000;margin:0; padding:0;">Date Signed</p></td>
	<td style="width:20px"></td>
	<td style="width:330px;margin-left:10px;"><p style="font-family:sans-serif; font-size:9px; color:#000;margin:0; padding:0;padding-left:10px;">Date Signed</p></td>
</tr>

<tr>
	<td style="border-bottom:1px solid #000;width:330px;height:20px;"><p style="font-family:sans-serif; font-size:13px; color:#000;margin:0; padding:0;"> </p></td>
	<td style="width:20px"></td>
	<td style="width:330px;border-bottom:1px solid #000;margin-left:10px;height:20px;"><p style="font-family:sans-serif; font-size:13px; color:#000;margin:0; padding:0;padding-left:10px;"> </p></td>
</tr>

<tr>
	<td style="width:330px;"><p style="font-family:sans-serif; font-size:9px; color:#000;margin:0; padding:0;">Print Name and Title</p></td>
	<td style="width:20px"></td>
	<td style="width:330px;margin-left:10px;"><p style="font-family:sans-serif; font-size:9px; color:#000;margin:0; padding:0;padding-left:10px;">Print Name and Title</p></td>
</tr>

<tr>
	<td style="border-bottom:1px solid #000;width:330px;height:20px;"><p style="font-family:sans-serif; font-size:13px; color:#000;margin:0; padding:0;"> </p></td>
	<td style="width:20px"></td>
	<td style="width:330px;border-bottom:1px solid #000;margin-left:10px;height:20px;"><p style="font-family:sans-serif; font-size:13px; color:#000;margin:0; padding:0;padding-left:10px;"> </p></td>
</tr>

<tr>
	<td style="width:330px;"><p style="font-family:sans-serif; font-size:9px; color:#000;margin:0; padding:0;">Date Signed</p></td>
	<td style="width:20px"></td>
	<td style="width:330px;margin-left:10px;"><p style="font-family:sans-serif; font-size:9px; color:#000;margin:0; padding:0;padding-left:10px;">Date Signed</p></td>
</tr>
</table>
<table width="100%" cellpadding="0" cellspacing="0" border="0" align="center">

<tr>
	<th style="font-size:15px;color:#000;width:340px;padding: 20px 0 0;margin:0px">SELLING BROKER</th>
	<th style="width:20px;padding: 20px 0 0;"></th>
	<th style="padding: 20px 10px 0;font-size:15px;color:#000;width:340px;">LISTING BROKER</th>
</tr>

<tr>
	<td style="border-bottom:1px solid #000;width:340px;height:20px;word-wrap:break-word"><p style="font-family:sans-serif; font-size:10px; color:#000;margin:0; padding:0;">
    <u>{{ $data['selling_broker'] ?? '' }}</u>
  </p></td>
	<td style="width:20px"></td>
	<td style="border-bottom:1px solid #000;height:20px;word-wrap:break-word"><p style="font-family:sans-serif; font-size:10px; color:#000;margin:0; padding:0;padding-left:10px;">
    
    <u>{{ $data['officelegalname'] ?? '' }}</u>
  
  </p></td>
</tr>

<tr>
	<td style="width:340px;"><p style="font-family:sans-serif; font-size:9px; color:#000; margin:0; padding:0;">Brokerage Firm's Name</p></td>
	<td style="width:20px"></td>
	<td style=""><p style="font-family:sans-serif; font-size:9px; color:#000; margin:0; padding:0;padding-left:10px;">Brokerage Firm's Name</p></td>
</tr>



@if (isset($data['check_state_hid']) && $data['check_state_hid'] == 'GA')

<tr>
	<td style="border-bottom:1px solid #000;width:340px;height:20px;word-wrap:break-word"><p style="font-family:sans-serif; font-size:10px; color:#000;margin:0; padding:0;">
    
    <u>{{ $data['georgiaRealestateOfcnum'] ?? '' }}</u>
  
  </p></td>
	<td style="width:20px"></td>
	<td style="border-bottom:1px solid #000;height:20px;word-wrap:break-word"><p style="font-family:sans-serif; font-size:10px; color:#000;margin:0; padding:0;padding-left:10px;">
    
    <u>{{ $data['georgiaRealestateOfcnum'] ?? '' }}</u>
  
  </p></td>
</tr> 
<tr>
	<td style="width:340px;"><p style="font-family:sans-serif; font-size:9px; color:#000; margin:0; padding:0;">Georgia Real Estate License Number</p></td>
	<td style="width:20px"></td>
	<td style=""><p style="font-family:sans-serif; font-size:9px; color:#000; margin:0; padding:0;padding-left:10px;">Georgia Real Estate License Number</p></td>
</tr>

@endif

<tr>
	<td style="border-bottom:1px solid #000;width:340px;height:20px;"><p style="font-family:sans-serif; font-size:13px; color:#000;margin:0; padding:0;"><b>By:</b> </p></td>
	<td style="width:20px"></td>
	<td style="border-bottom:1px solid #000;height:20px;"><p style="font-family:sans-serif; font-size:13px; color:#000;margin:0; padding:0;padding-left:10px;"><b>By:</b>  </p></td>
</tr>

<tr>
	<td style="width:340px;"><p style="font-family:sans-serif; font-size:9px; color:#000; margin:0; padding:0;">Signature of Selling Agent</p></td>
	<td style="width:20px"></td>
	<td style=""><p style="font-family:sans-serif; font-size:9px; color:#000; margin:0; padding:0;padding-left:10px;">Signature of Listing Agent</p></td>
</tr>

@if(isset($data['check_state_hid']) && $data['check_state_hid'] == 'GA')

  <tr>
    <td style="border-bottom:1px solid #000;width:340px;height:20px;word-wrap:break-word"><p style="font-family:sans-serif; font-size:10px; color:#000;margin:0; padding:0;">
      
      <u>{{ $data['georgiaRealestateagentnum'] ?? '' }}</u>
    
    </p></td>
    <td style="width:20px"></td>
    <td style="border-bottom:1px solid #000;height:20px;word-wrap:break-word"><p style="font-family:sans-serif; font-size:10px; color:#000;margin:0; padding:0;padding-left:10px;">
      
      <u>{{ $data['georgiaRealestateagentnum'] ?? '' }}</u>
    
    </p></td>
  </tr>
  <tr>
    <td style="width:340px;"><p style="font-family:sans-serif; font-size:9px; color:#000; margin:0; padding:0;">Georgia Real Estate License Number</p></td>
    <td style="width:20px"></td>
    <td style=""><p style="font-family:sans-serif; font-size:9px; color:#000; margin:0; padding:0;padding-left:10px;">Georgia Real Estate License Number</p></td>
  </tr>

@endif 


<tr>
	<td style="border-bottom:1px solid #000;width:340px;height:20px;"><p style="font-family:sans-serif; font-size:13px; color:#000;margin:0; padding:0;"> </p></td>
	<td style="width:20px"></td>
	<td style="border-bottom:1px solid #000;height:20px;"><p style="font-family:sans-serif; font-size:13px; color:#000;margin:0; padding:0;padding-left:10px;"> </p></td>
</tr>
</table>

<table width="100%" cellpadding="0" cellspacing="0" border="0" align="center">
<tr>
<td width='auto'>
<p style="font-family:sans-serif; font-size:13px;word-wrap:break-word; padding: 0 20px 0 0;"><b>Note:</b> The Amendment Number is a convenience item. In the event of a discrepancy between the Amendment Number in the title and the date of signing the amendment, the last date of signing the amendment shall take precedence for establishing the proper order of the amendments.</p></td>
</tr>
</table>

</body>
</html>