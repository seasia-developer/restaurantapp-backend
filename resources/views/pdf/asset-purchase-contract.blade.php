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

    footer {
        position: fixed; 
        bottom: -60px; 
        left: 0px; 
        right: 0px;
        height: 50px; 
    }

    .pagenum:before {
        content: "Page - " counter(page);
    }
    </style>
</head>
<body>
    
  <footer>
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr>
      
      <td width="33%" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:15px; color:#000; font-weight:bold;">Buyer\'s Initial __________</td>
      
      <td width="33%" style="font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify; color:#000; text-align:center;">
        
        <span class="pagenum"></span>
        
      
      </td>
      
      <td width="33%" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:15px; color:#000; font-weight:bold;"> Seller\'s Initial __________</td></tr></table>

</footer>   

<!-- Page #1 -->

<table width="100%" align="center" cellpadding="5" cellspacing="5">
    <tr>
      <td width=""><img src="{{ public_path('assets/images/print_pdf/new-wsrlogo.png') }}" alt="Wesellrestaurants" style="width:150px; height:95px" /></td>
      <td width="" style="text-align:center; font-size:22px; font-family:Arial, Helvetica, sans-serif"><strong>ASSET PURCHASE CONTRACT </strong><br />
        (for the sale and purchase of business assets)<br /></td>
    </tr>
  </table>
  <table width="100%" align="center" cellpadding="5" cellspacing="5">
    <tr>
      <td height="38" align="left" valign="middle" style=" font-family:Arial, Helvetica, sans-serif; font-size:15px;"><strong> THIS ASSET PURCHASE CONTRACT AND RECEIPT </strong> (hereinafter, this "Contract") is entered into on <span style="">
        <u>{{ $data['apa_date'] ?? 'N/A' }}</u>
    </span>  
        <span class="" >
            <u>{{ $data['apa_date_year'] ?? 'N/A' }}</u>
        </span> by and between:</td>
    </tr>
    <tr>
      <td style=" font-family:Arial, Helvetica, sans-serif; font-size:15px; text-decoration:underline">BUYER:</td>
    </tr>
    <tr>
      <td style="font-size:16px; font-family:Arial, Helvetica, sans-serif">Legal Name of Buyer:<span class="pdf_color" style="background-color:#ffff00">
        
        <u>{{ $data['buyer_legel_name'] ?? 'N/A' }}</u>
    
    </span>(collectively referred to hereinafter with Buyer's assignees as "Buyer")</td>
    </tr>
    <tr>
      <td style="font-size:16px; font-family:Arial, Helvetica, sans-serif">Organizational Structure: A/An <span class="pdf_color">
        <u>{{ $data['buyer_organization_struct_state'] ?? 'N/A' }}</u>
    </span><span class="pdf_color"> 
        <u>{{ $data['buyer_organization_struct_business_type'] ?? 'N/A' }}</u>
    </span></td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:16px;">Address of Buyer: <span class="pdf_color">
        <u>{{ $data['buyer_address'] ?? 'N/A' }}</u>
    </span></td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">who hereby offers and agrees to purchase upon the terms and conditions hereinafter set forth, the business assets of:</td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:15px; text-decoration:underline">SELLER:</td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:16px;">Legal Name of Seller: <span class="pdf_color">
        
        <u>{{ $data['seller_name'] ?? 'N/A' }}</u>

        
        (hereinafter "Seller")
    </span>
    
    </td>
    </tr>
    <tr>
      <td style="font-size:16px; font-family:Arial, Helvetica, sans-serif">Organizational Structure: A/An <span class="pdf_color">
        
        <u>{{ $data['seller_organization_struct_state'] ?? 'N/A' }}</u>
    
    </span>
    
    <span class="pdf_color">
        <u>{{ $data['seller_organization_struct_business_type'] ?? 'N/A' }}</u>
    </span></td>
    </tr>
  
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:16px;">Name of the Business: <span class="pdf_color">
        <u>{{ $data['seller_trade_name'] ?? 'N/A' }}</u>
        (hereinafter, "the Business")</span></td>
    </tr>
   
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:16px;">Address of the Business: <span class="pdf_color">
        <u>{{ $data['seller_business_address'] ?? 'N/A' }}</u>
    </span></td>
    </tr>
  </table>
  <table width="100%" align="center" cellpadding="5" cellspacing="5">
    <tr>
      <td colspan="2"  style="font-weight:bold; font-size:16px; font-family:Arial, Helvetica, sans-serif; padding: 10px 0 0 30px;">THE TOTAL PURCHASE PRICE FOR THE ASSETS OF THE BUSINESS SHALL BE:</td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:16px;">a.$ <span class="pdf_color">
        
        <u>{{ $data['total_purchase_price_a'] ?? 'N/A' }}</u>
    
        </span></td>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:16px; font-weight:bold">PURCHASE PRICE PAYABLE AS FOLLOWS:</td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:16px;">b.$ <span class="pdf_color">
        <u>{{ $data['total_purchase_price_b'] ?? 'N/A' }}</u>
    
    </span></td>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:15px;">By Earnest Money upon acceptance of offer by Seller pursuant to Section 4.</td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">&nbsp;</td>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:15px;">All Deposits to be held by: <span class="pdf_color">
        @if(!is_numeric($data['total_purchase_price_c_deposits']))
            <u>{{ $data['total_purchase_price_c_deposits'] ?? 'N/A' }}</u>
        @else
            <u>{{ $data['vendor']->vendor_name }}</u>
        @endif
    </span></td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">&nbsp;</td>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:15px;">Address: <span class="pdf_color">
        <u>{{ $data['total_purchase_price_c_address'] ?? 'N/A' }} </u>
    </span></td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">&nbsp;</td>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:15px;">Phone: <span class="pdf_color">
        <u>{{ $data['total_purchase_price_c_phone'] ?? 'N/A' }} </u>
    </span></td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">&nbsp;</td>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:15px;">Email: <span class="pdf_color">
        <u>{{ $data['total_purchase_price_c_email'] ?? 'N/A' }} </u>
    </span></td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">&nbsp;</td>
      <td style=" font-family:Arial, Helvetica, sans-serif; font-size:15px;">("Transaction Closing Attorney or Escrow Agent").</td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">&nbsp;</td>
      <td style=" font-family:Arial, Helvetica, sans-serif; font-size:15px;"><div style="width:550px; text-align:justify;">Seller and Buyer acknowledge that all checks accepted by the Escrow Agent are subject to collection.</div></td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">&nbsp;</td>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:15px;">Escrowed funds shall not be disbursed until the bank has cleared them.</td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">&nbsp;</td>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:15px; font-weight:bold">The named <span style="text-decoration:underline"> Buyer </span> on the contract must be the remitter of any deposit.</td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">c.$ <span class="pdf_color">

        <u>{{ $data['total_purchase_price_c'] ?? 'N/A' }}</u>
    
    </span></td>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:15px;">By duly executed Purchase Money Promissory Note.</td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">&nbsp;</td>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:15px; text-align:justify;word-wrap: break-word;"><div style="width:550px; text-align:justify;">The Note made in favor of, and delivered to, Seller at Closing payable in <span class="pdf_color"> 
        <u>{{ $data['total_purchase_price_d_payable_in'] ?? 'N/A' }}</u>
        </span> 
        equal consecutive monthly payments of $ <span class="pdf_color">   
            <u>{{ $data['total_purchase_price_d_monthly_payments'] ?? 'N/A' }}</u>
            </span>

            which includes interest at the rate of <span class="pdf_color">
                <u>{{ $data['total_purchase_price_d_monthly_payments_percent'] ?? 'N/A' }}</u>
            </span> % per annum"</div></td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">&nbsp;</td>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:15px;">The first note payment shall be due and payable on:<span class="pdf_color"> 
        <u>{{ $data['total_purchase_price_d_payable_on'] ?? 'N/A' }}</u>
    </span></td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:15px;">d.$ <span class="pdf_color">
        <u>{{ $data['total_purchase_price_d'] ?? 'N/A' }}</u>
    </span></td>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:15px;">By Assumption of existing Promissory Note/Liability.</td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">&nbsp;</td>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:15px; text-align:justify;"><div style="width:550px; text-align:justify;">The unpaid balance of any promissory note or other deferred indebtedness to be assumed by Buyer and mentioned above is approximate. Any adjustments thereto shall be made to the cash portion provided at Closing.</div></td>
    </tr>
    <tr>
       <td style="font-family:Arial, Helvetica, sans-serif; font-size:15px;">e.$ <span class="pdf_color">
        <u>{{ $data['total_purchase_price_e'] ?? 'N/A' }}</u>
    </span></td>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:15px; width:550px">By wire transfer from Purchaser on or before the Closing Date.</td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:15px;">f.$ <span class="pdf_color">
        
        <u>{{ $data['total_purchase_price_f'] ?? 'N/A' }}</u>
    
    </span></td>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:15px;">Third Party Financing:</td>
    </tr>
    <tr>
      <!--Additional add on -->
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px">g.$ <span class="pdf_color">
            
            <u>{{ $data['total_purchase_price_g'] ?? 'N/A' }}</u>
        
        </span>
        </td>

        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px" name="total_purchase_price_others">Other: <span class="pdf_color"> 
            
            <u>{{ $data['total_purchase_price_h_other'] ?? '_______________' }}</u>
        
        </span></td>
        <td>&nbsp;</td>
      </tr>
      <!---End -->
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">h.$<span class="pdf_color">
        
        <u>{{ $data['total_purchase_price_h'] ?? 'N/A' }}</u>
    
    </span></td>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:15px; font-weight:bold">TOTAL PURCHASE PRICE</td>
    </tr>
  </table>

  <div class="page-break"></div>

  <!-- Page #2 --> 

  <table width="100%" align="center" cellpadding="5" cellspacing="5">
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:15px; font-weight:bold">PRELIMINARY CONTRACT PROVISIONS</td>
    </tr>
    <tr>
      <td height="38" align="left" valign="middle" style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify; font-weight:bold"> 1.	OFFER/ACCEPTANCE/COUNTEROFFER </td>
    </tr>
    <tr>
      <td style=" font-family:Arial, Helvetica, sans-serif; font-size:14px;">1.1.	OFFER.</td>
    </tr>
    <tr>
      <td style="font-size:15px; font-family:Arial, Helvetica, sans-serif">This contract shall be open for Party's written acceptance until: 
        <span class="pdf_color">
            <u>{{ $data['fld_1_1_a'] ?? 'N/A' }}</u>
        </span> o'clock 
        
        <span class="pdf_color">
            <u>{{ $data['fld_1_1_b'] ?? 'N/A' }}</u>
        </span>on 
        
        <span class="pdf_color">
            <u>{{ $data['fld_1_1_c'] ?? 'N/A' }}</u>
        </span>
    </td>
    </tr>
    <tr>
      <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify;">1.2.	ACCEPTANCE.</td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">Acceptance of this Contract made at: ___________________________________</td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">1.3.	COUNTEROFFER.</td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">Counteroffer  of this Contract made at: ___________________________________</td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">with change(s) found on the Contract or delineated more fully on the Counter Offer Page of this Contract, and said Counter Offer </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:16px;">shall be open for Buyer's acceptance until: ____________ o'clock ____________ M on ____________ 20____________</td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold">2.	EFFECTIVE DATE: </td>
    </tr>
    <tr>
      <td style=" font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify;">The "Effective Date" of this Contract shall be the date on which the last of the parties signs and accepts the final offer thereby making the Contract bi-lateral on all items and conditions.</td>
    </tr>
    
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold">3. PURCHASE OF SELLER’S ASSETS USED FOR THE BUSINESS: </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">Buyer hereby offers to purchase for the total Purchase Price and Seller hereby agrees to sell for the total Purchase Price all of Seller's assets used in the Business including, but not limited to, all furniture, fixtures and equipment, whether tangible or intangible used in the Business (hereinafter, "the Assets").</td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold">4.	PAYMENT OF EARNEST MONEY AND ESCROW AGREEMENT: </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">

        {!! $data['fld_4'] == "1" ? "<img src=".public_path('assets/images/print_pdf/check.png')." />" : "<img src=".public_path('assets/images/print_pdf/not-check.png')." />" !!}
        
        The Buyer tenders payment of the Earnest Money Deposit with this offer, said deposit shall be made payable to the Escrow Agent. </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">

        
        {!! $data['fld_4'] == "2" ? "<img src=".public_path('assets/images/print_pdf/check.png')." />" : "<img src=".public_path('assets/images/print_pdf/not-check.png')." />" !!}
        
        
        The Buyer does NOT tender payment of the Earnest Money Deposit with this offer.</td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">

        {!! $data['fld_4'] == "3" ? "<img src=".public_path('assets/images/print_pdf/check.png')." />" : "<img src=".public_path('assets/images/print_pdf/not-check.png')." />" !!}
        
        The Buyer shall deposit the Earnest Money Deposit with the Escrow Agent within <span class="pdf_color">
            <u>{{ $data['fld_4_d'] ?? 'N/A' }}</u>
        </span>hours of the Effective Date.</td>
    </tr>
    <tr>
        <td colspan="3" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">
         Buyer and Seller each agree to promptly execute Escrow Agent’s standard Escrow Agreement ("the Escrow Agreement") within 
         <u>{{ $data['fld_4_e'] ?? 'N/A' }}</u>
         days of the Effective Date. Failure by Buyer to execute the Escrow Agreement as required in this Section 4 shall be deemed a breach of this Contract. Failure of Escrow Money Deposit to clear Escrow Agent's account shall be a breach of this contract. Failure by Buyer to deposit escrow as required in this Section 4 shall be deemed a breach of this Contract.</td>
      </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold">5.	CLOSING: </td>
    </tr>
    <tr>
      <td style=" font-family:Arial, Helvetica, sans-serif; font-size:15px;">5.1	Buyer and Seller hereby mutually agree to execute any and all documents necessary to close this transaction on or before the Closing Date. </td>
    </tr>
    <tr>
      <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify;">5.2	The Closing Date shall be on or before <span class="pdf_color">
        <u>{{ $data['fld_5_2'] ?? 'N/A' }}</u>
    </span></td>
    </tr>
    <tr>
      <td style="; font-family:Arial, Helvetica, sans-serif; font-size:14px;">5.3	The Closing Date may be extended in a writing signed by both Buyer and Seller. </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold">6.	TIME: </td>
    </tr>
    <tr>
      <td style="font-size:14px;"><strong> TIME IS OF THE ESSENCE </strong> with respect to the all aspects of this Contract.</td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold">7.	AUTHORITY: </td>
    </tr>
    <tr>
      <td  style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">7.1	The Buyer and Seller each represent that they have full authority to enter into this Contract and to conclude the transaction described herein. </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">7.2	Neither Buyer nor Seller is a party to any agreement that shall prevent either Buyer or Seller from consummating this transaction; nor is any consent required from any third party with the exception of franchise approval, see special stipulations, Item 56. </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">7.3	The execution, delivery and performance of this Contract shall not constitute a violation of Seller's Articles of Incorporation if a corporation or Seller's Articles of Organization if a Limited Liability Company or the entity's by-laws. </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold">8.	SELLER'S REPRESENTATION: </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">8.1	Seller represents to Buyer that all outstanding liabilities of the Business, except as specifically set forth herein, shall be paid in full by Seller on or before the Closing, and that Buyer shall receive possession of the Assets free and clear of any encumbrances other than any security interest that may be created pursuant to this Contract. </td>
    </tr>
  </table>

  <div class="page-break"></div>

 
  <!-- Page #3 --> 
 
  <table width="100%" align="center" cellpadding="5" cellspacing="5">
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;"> 8.2	Seller represents to Buyer that there is no current or pending legal action, lawsuit or legal proceeding against or relating to the Business, the Assets or business activity which have not been disclosed to Buyer, nor does the Seller know or have reasonable grounds to know the basis of any potential legal action relative to the Business, its properties or business activity. </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;"> 8.3	Seller represents to Buyer that all of Seller's statements or representations regarding the prior operation of the Business and
  all other material facts disclosed to Buyer are true and that Seller knows said statements and representations have been relied upon by Buyer in Buyer's decision to enter into this Contract. </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;"> 8.4	Seller represents that the financial information supplied to Buyer by Seller is true and correct and is an accurate presentation of the financial condition and operating results of the Business. </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:15px; font-weight:bold">9.	BUYER MAY FORM NEW ENTITY: </td>
    </tr>
    <tr>
      <td align="left" valign="middle" style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;"> 9.1	Buyer may elect to form a corporation or a Limited Liability Company after this Contract has been executed. In such event, the new entity shall become the Buyer, and original Buyer shall cause the corporation to ratify all of the terms and conditions of this Contract. </td>
    </tr>
    <tr>
      <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify;">9.2	Buyer shall continue to be personally liable for the performance of the terms, covenants and conditions herein. </td>
    </tr>
    <tr>
      <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify;">9.3	If the Buyer becomes an entity, the individual signatory(ies) to this Contract shall be personally liable for the performance of the terms, conditions and covenants contained herein. </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">9.4	Is it the Buyer's intention to form an entity prior to closing 

        {!! $data['fld_9_4_c'] == "1" ? "<img src=".public_path('assets/images/print_pdf/check.png')." />" : "<img src=".public_path('assets/images/print_pdf/not-check.png')." />" !!}
        
        Yes /
        
        {!! $data['fld_9_4_c'] == "2" ? "<img src=".public_path('assets/images/print_pdf/check.png')." />" : "<img src=".public_path('assets/images/print_pdf/not-check.png')." />" !!}
        
        No / 

        {!! $data['fld_9_4_c'] == "3" ? "<img src=".public_path('assets/images/print_pdf/check.png')." />" : "<img src=".public_path('assets/images/print_pdf/not-check.png')." />" !!}
        
        To Be Decided. </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold">10.	BUYER'S DUE DILIGENCE: </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">10.1	Buyer, at Buyer's expense, shall be responsible for the initiation of any formal Due Diligence examination of the Seller's operation of
  the Business generally and such examination shall be conducted by the Buyer and/or by an appropriate professional or professionals. </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">10.2	This Contract shall be contingent upon the Buyer's satisfactory Due Diligence of the Business's complete operations including,
  but not limited to, financial records, corporate and other records of the Business, operational procedures, condition of equipment, any and all leases, and any contractual relationships ("the Due Diligence Materials"). </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">10.3	Buyer shall have <span class="pdf_color">
        
        <u>{{ $data['fld_10_3_a'] ?? 'N/A' }}</u>
    
    </span> ( <span class="pdf_color">

        <u>{{ $data['fld_10_3_b'] ?? 'N/A' }}</u>
    
    </span>) days inclusive of weekends or holidays to complete the said Due Diligence (the "Due Diligence Period"). </td>
    </tr>

    <tr>
      <td style=" font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify;">10.4	Buyer's Due Diligence Period shall commence on the date that Buyer’s earnest money is deposited with Escrow Agent as required by
  Section 4. Buyer shall not receive access, and Seller shall not be required to grant access, to any of the Due Diligence Materials prior to commencement of the Due Diligence Period. </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">10.5	Buyer's discovery, during the Due Diligence Period, of any item or items not to the Buyer's sole, complete and personal satisfaction shall cause this Contract to be cancelled in every respect and particular. </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">10.6	Buyer and Seller agree that if this Contract shall become cancelled because of the failure of Due Diligence, the Escrow Agent shall be vested with the authority to immediately refund any and all deposits held for this Contract upon the terms set forth in the Escrow
  Agreement. </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold">11.	DEFAULT BY BUYER/SELLER: </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">11.1	DEFAULT BY BUYER: </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">If Buyer (a) fails to pay the balance of any cash necessary to close this transaction; (b) fails to perform any of the covenants and
  conditions of this Contract; or (c) breaches Buyer's obligations or representations or warranties contained herein, the Seller shall have the following sole remedies: (y) the right to enforce this Contract pursuant to the Contract terms; or (z) direct that the Escrow Agent pay the Earnest Money to Seller and Broker, in accordance with the Broker’s Listing Agreement, as liquidated damages in full settlement of all claims Seller may have against Buyer. Buyer and Seller agree that such liquidated damages are not a penalty and are a good faith estimate of Seller's actual damages, which damages are difficult to ascertain. </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">11.2	DEFAULT BY SELLER: </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">11.2.1 If Seller breaches Seller's obligations or representations or warranties herein, Buyer shall have the right to demand, payment of
  an amount to Buyer equal to the Earnest Money Deposit in lieu of action for damages or specific performance. Such amount, if accepted and deposited by Buyer shall constitute liquidated damages in full settlement of all claims that Buyer may have against any person or entity and which relate to the transactions contemplated by this Contract. The parties agree that such liquidated damages are not a penalty and are a good faith estimate of Buyer's actual damages, which damages are difficult to ascertain.</td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">11.2.2 If Seller breaches Seller's obligations or representations or warranties herein, Broker shall be entitled to seek its full commission against Seller as set forth in the Seller's Broker Listing Agreement with Broker. </td>
    </tr>
  </table>

  <div class="page-break"></div>

  <!-- Page #4 --> 
  <table width="100%" align="center" cellpadding="5" cellspacing="5">
    <tr>
      <td style=" font-family:Arial, Helvetica, sans-serif; font-size:15px; font-weight:bold">CONTRACT PURCHASE PROVISIONS </td>
    </tr>
    <tr>
      <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold">12.	BILL OF SALE:</td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">Seller shall deliver to Buyer, at Closing, a Bill of Sale for (the "Assets"), as per the attached Schedule "1", which, by this reference, is incorporated herein, for which Seller warrants that it has good and marketable title, free and clear of all liens and encumbrances,except any liens or encumbrances disclosed herein.</td>
    </tr>
    <tr>
      <td style="font-size:14px; font-weight:bold">13. CONDITION OF ASSETS: </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">13.1 The Assets included in this sale, as per attached Schedule "1," are being purchased on an "as is" basis without warranties of merchantability or fitness for any particular purpose. </td>
    </tr>
    <tr>
      <td  style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">13.2	Buyer shall be responsible for inspecting said equipment in order to determine that, as of the date of Closing, said equipment is in good working condition acceptable to the Buyer. </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold">14.	SELLER FINANCING; PURCHASE MONEY PROMISSORY NOTE: </td>
    </tr>
    <tr>
      <td align="left" valign="middle" style=" font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;"> If applicable, Buyer shall execute a Purchase Money Promissory Note (the "Note") in favor of Seller as more specifically set forth on the first page of this Contract. </td>
    </tr>
    <tr>
      <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold">15.	THIRD PARTY FINANCING; LOAN COMMITMENT: </td>
    </tr>
    <tr>
      <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify;">

        {!! $data['fld_15'] == "1" ? "<img src=".public_path('assets/images/print_pdf/check.png')." />" : "<img src=".public_path('assets/images/print_pdf/not-check.png')." />" !!}
        
        This Contract IS <span style="text-decoration:underline"> NOT </span> CONTINGENT upon any third party financing. </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">

        {!! $data['fld_15'] == "2" ? "<img src=".public_path('assets/images/print_pdf/check.png')." />" : "<img src=".public_path('assets/images/print_pdf/not-check.png')." />" !!}
        
        This Contract IS CONTINGENT upon third party financing, consequently: </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">15.1	Buyer shall make written application to lender within <span class="pdf_color">
        
        <u>{{ $data['fld_15_1_a'] ?? 'N/A' }}</u>
        
    </span>(<span class="pdf_color">

        <u>{{ $data['fld_15_1_b'] ?? 'N/A' }}</u>
    
    </span>) calendar days of the Effective Date of this Contract. </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">15.2	Buyer shall have <span class="pdf_color"> 
        
        <u>{{ $data['fld_15_2_a'] ?? 'N/A' }}</u>
        
    
    </span>(<span class="pdf_color">
        <u>{{ $data['fld_15_2_b'] ?? 'N/A' }}</u>

        
    
    </span>) calendar days from the Effective Date of this Contract to receive a written loan commitment on terms acceptable to Buyer and to Buyer's sole discretion. </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">15.3	Buyer shall provide written notification to Seller of Buyer's intention to close this transaction if lender's terms are acceptable to Buyer within the timeline of section 15.2.</td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">15.4	Buyer may cancel this Contract by written notice to Seller and Broker within the loan commitment period; failure of Buyer to so notice the Seller and Broker shall constitute Buyer's absolute waiver of this provision. </td>
    </tr>
    <tr>
      <td style=" font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify;">15.5	Buyer's cancellation of this Contract for the failure of a loan commitment shall cause this Contract to be a nullity in all respectsand particulars and vest the Escrow Agent with the authority to immediately refund any and all deposits held for this Contract upon the terms set forth in the Escrow Agreement </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold">16.	SECURITY AGREEMENT </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">16.1	If Buyer executes a Note in favor of the Seller, and Buyer has assigned this Contract to its new entity, the Buyer shall make the Note in the entity's name and, along with all fiduciaries of the entity, shall personally guaranty the Note. </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">16.2	The Buyer shall also execute a Security Agreement in accordance with Section 16.5 securing Buyer's interest in the Assets. </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">16.3	The Security Agreement shall continue until the Note is satisfied or until the Seller regains ownership and/or control of the Business. </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">16.4	Buyer shall further execute a Financing Statement (UCC-l), which shall be recorded in the appropriate County and filed with the State of <span class="pdf_color">
        <u>{{ $data['fld_16_4'] ?? 'N/A' }}</u>
    
    </span> as per the requirements of the Uniform Commercial Code or such other applicable law. </td>
    </tr>
  </table>

  <div class="page-break"></div>

  <!-- Page #4-1 --> 
  <table width="100%" align="center" cellpadding="5" cellspacing="5">
    <tr>
      <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify;">16.5	Nothing in this Contract to the contrary withstanding, the collateral for the Security Agreement and Note shall be the following: </td>
    </tr>
    <tr>
      <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify;">The properties, assets and rights of the Debtor, wherever located, whether now owned or hereafter acquired or arising, and all proceeds and products thereof (all of the same being hereinafter called the "Collateral") hereinafter described: </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">1.	All personal and fixture property of every kind and nature including, without limitation, all goods (including inventory, equipment and any accessions thereto), instruments (including promissory notes), documents, accounts, contracts and contract rights, chattel paper (whether tangible or electronic), deposit accounts, letter-of-credit rights (whether or not the letter of credit is evidenced by a writing), commercial tort claims, securities and all other investment property, supporting obligations, any other contract rights or rights to the payment of money, insurance claims and proceeds, and all general intangibles (including all payment intangibles); </td>
    </tr>
    <tr>
      <td style=" font-family:Arial, Helvetica, sans-serif; font-size:14px;">2.	All trademarks (including common law), service marks and trade names, the entire goodwill of or associated with the businesses now or hereafter conducted by Debtor connected with and symbolized by any of the aforementioned properties and assets; </td>
    </tr>
    <tr>
      <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify;">3.	All general intangibles and all intangible intellectual or other similar property of Debtor of any kind or nature, associated with or arising out of any of the aforementioned properties and assets and not otherwise described above; and </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">4.	All proceeds of any and all of the foregoing collateral and, to the extent not otherwise included, all payments under insurance (whether or not Seller is the loss payee thereof) or any indemnity, warranty or guaranty payable by reason of loss or damage to or otherwise with respect to the foregoing collateral. </td>
    </tr>
    <tr>
      <td style="font-size:14px; font-weight:bold">17.	INVENTORY OF TRADE GOODS: </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">17.1	It is agreed that Seller's usable, unexpired inventory held for use at Seller's cost (the "Inventory") shall have theapproximate value of $ <span class="pdf_color">
        
        <u>{{ $data['fld_17_1'] ?? 'N/A' }}</u>
    
    </span></td>
    </tr>
    <tr>
      <td  style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">17.2	Buyer and Seller, prior to the Closing, shall: </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">

        {!! $data['fld_17_2'] == "1" ? "<img src=".public_path('assets/images/print_pdf/check.png')." />" : "<img src=".public_path('assets/images/print_pdf/not-check.png')." />" !!}
  
        Take an itemized physical count of the Inventory. </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">

        {!! $data['fld_17_2'] == "2" ? "<img src=".public_path('assets/images/print_pdf/check.png')." />" : "<img src=".public_path('assets/images/print_pdf/not-check.png')." />" !!}
        
        Not take an itemized physical count of the Inventory. </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;"> 17.3	The difference between the approximate value listed above and the actual Inventory value shall: </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;"> Be reflected as an adjustment, more or less to the total price, in particular, as an increase in the Purchase Price if the actual Inventory is more than the value listed in <strong style="text-decoration:underline">17.1 </strong>, or a reduction to the Purchase Price if less than the value listed in 17.1. </td>
    </tr>
  </table>
  
  <table width="100%" align="center" cellpadding="5" cellspacing="5">
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold">18.	ACCOUNTS RECEIVABLE </td>
    </tr>
    <tr>
      <td align="left" valign="middle" style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;">Check which is appropriate: </td>
    </tr>
    <tr>
      <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify;">18.1 

        {!! $data['fld_18'] == "1" ? "<img src=".public_path('assets/images/print_pdf/check.png')." />" : "<img src=".public_path('assets/images/print_pdf/not-check.png')." />" !!}
        
        
        
        It is mutually agreed that Seller's accounts receivable, having the approximate value of $<span class="pdf_color"> 
            
            <u>{{ $data['fld_18_1_b'] ?? 'N/A' }}</u>
        
        </span>shall be included in the purchase price.</td>
    </tr>
    <tr>
      <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify;">18.1.1  Seller shall provide Buyer with account details including the name on the account, the account number, amount owing and aging, and this information shall be delivered to Buyer prior to Closing. </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">18.1.2  The difference between the approximate value listed above and the actual value of accounts receivable at Closing shall be reflected as an adjustment to the total purchase price. </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">18.1.3  $ <span class="pdf_color">
        <u>{{ $data['fld_18_1_3_a'] ?? 'N/A' }}</u>
        
    
    </span> of accounts receivables transferred at Closing shall be guaranteed by Seller, and if not fully collected within <span class="pdf_color">
        <u>{{ $data['fld_18_1_3_b'] ?? 'N/A' }}</u>
       
    
    </span>(<span class="pdf_color">
        <u>{{ $data['fld_18_1_3_c'] ?? 'N/A' }}</u>
        
    
    </span>) days of Closing, Buyer may set-off the difference against the Note, provided that Buyer shall assign Seller the right to collect said receivables. </td>
    </tr>
  
  
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold">ALTERNATIVELY </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">18.2 

        {!! $data['fld_18'] == "2" ? "<img src=".public_path('assets/images/print_pdf/check.png')." />" : "<img src=".public_path('assets/images/print_pdf/not-check.png')." />" !!}
        
        It is mutually agreed that Seller's accounts receivable shall NOT be included in the purchase price. </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">18.2.1	Buyer shall forward to Seller any and all accounts receivable payments received by Buyer for a period of <span class="pdf_color">
        
        <u>{{ $data['fld_18_2_2_a'] ?? 'N/A' }}</u>

        
    
    </span>(<span class="pdf_color">
        <u>{{ $data['fld_18_2_2_b'] ?? 'N/A' }}</u>
    
    </span>) days post Closing, and shall cooperate with Seller in providing any and all correspondence or other documents received by Buyer with respect to Seller's accounts receivable, and will otherwise cooperate with Seller in the collection of Seller's accounts receivable. </td>
    </tr>
    </table>

    <div class="page-break"></div>


  <!-- Page #5 --> 

  <table width="100%" align="center" cellpadding="5" cellspacing="5">
    <tr>
      <td style=" font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold">19.	ACCOUNTS PAYABLE: </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">19.1	All accounts payable accruing to the date of the Closing shall remain the responsibility of Seller and are not included in this sale. </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">19.2	Immediately from and after the Closing, all subsequent accounts payable shall be the sole responsibility of Buyer. </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold"> 20.	BUSINESS TRADE NAME (check all that apply): </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">[
        
        {!! $data['fld_20_1'] == "1" ? "<img src=".public_path('assets/images/print_pdf/check.png')." />" : "<img src=".public_path('assets/images/print_pdf/not-check.png')." />" !!}

       
        
        ]  It is not the Buyer's intention to use a trade name. </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">[
        
        {!! $data['fld_20_2'] == "2" ? "<img src=".public_path('assets/images/print_pdf/check.png')." />" : "<img src=".public_path('assets/images/print_pdf/not-check.png')." />" !!}
        
        ]  It is the Buyer's intention to use a trade name. [

          {!! $data['fld_20_c'] == "1" ? "<img src=".public_path('assets/images/print_pdf/check.png')." />" : "<img src=".public_path('assets/images/print_pdf/not-check.png')." />" !!}
        
        ] Current Trade name; [

          {!! $data['fld_20_d'] == "1" ? "<img src=".public_path('assets/images/print_pdf/check.png')." />" : "<img src=".public_path('assets/images/print_pdf/not-check.png')." />" !!}
        
        ] New Name: <span class="pdf_color">"
          <u>{{ $data['fld_20_e'] ?? 'N/A' }}</u>
          "</span>. </td>
    </tr>
    <tr>
      <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify;">[
        {!! $data['fld_20_3'] == "3" ? "<img src=".public_path('assets/images/print_pdf/check.png')." />" : "<img src=".public_path('assets/images/print_pdf/not-check.png')." />" !!}
        ] 
        
        Seller's rights to a trade name for a particular franchise location are being transferred pursuant to a Franchise Agreement in connection with this transaction</td>
    </tr>
    <tr>
      <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify;">[
        
        {!! $data['fld_20_4'] == "4" ? "<img src=".public_path('assets/images/print_pdf/check.png')." />" : "<img src=".public_path('assets/images/print_pdf/not-check.png')." />" !!}
        
        ]  Seller's current trade name is not subject to any Franchise Agreement and therefore,Seller hereby grants Buyer, effective at Closing, any and all rights held by Seller in the trade name, " <span class="pdf_color">

          <u>{{ $data['fld_20_h'] ?? 'N/A' }}</u>
        
        </span>" and any derivations thereof, and Seller hereby waives any rights thereto, and shall not, after Closing, make use of such name, directly or indirectly. </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold">21.	SELLER'S INDEMNIFICATION AND BUYER'S RIGHT OF SET-OFF: </td>
    </tr>
    <tr>
      <td style=" font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">21.1	Seller indemnifies Buyer and shall hold Buyer harmless from all debts, claims, actions, losses, damages andattorney's fees, existing or that may arise from or be related to Seller's past operation and ownership of the Business, except for any liabilities specifically assumed by Buyer here under ("Seller's Obligations"). </td>
    </tr>
    <tr>
      <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify;">21.2	In the event Buyer should become aware of any Seller’s Obligations, Buyer shall promptly notify Seller in writing of such claim. In the event Seller does not satisfy said claim or said claim is not disputed within ten (10) days from the receipt of such notice: </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">           21.2.1	In the event of an owner financed transaction, Buyer may, at its sole option, pay such claim and receive full credit against any Promissory Note payment owed to Seller under this Contract; or </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">           21.2.2	In the event of a cash transaction in which Seller’s Obligations are disclosed prior to Closing, the parties agree that the Closing Attorney shall retain $ <span class="pdf_color">
        <u>{{ $data['fld_21_2_2_a'] ?? 'N/A' }}</u>
      </span> from the Seller's closing proceeds for a period of	(<span class="pdf_color">
        <u>{{ $data['fld_21_2_2_b'] ?? 'N/A' }}</u>
      </span>) days after closing to secure the Seller's indemnification as provided for in this Section 21 or </td>
    </tr>
    <tr>
        <td colspan="3" style="font-family:Arial, Helvetica, sans-serif;font-size:14px;">           21.2.3 In the event of a cash transaction in which Seller’s Obligations are not disclosed prior to Closing, Buyer reserves all rights available to Buyer under applicable law. </td>
      </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold">22.	LOSS/DAMAGE: </td>
    </tr>
    <tr>
      <td  style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">22.1	In the event there is any loss or damage to the Business premises, or any of the improvements, systems, equipment or the Assets included in this sale at any time prior to the Closing, the risk of loss shall be upon Seller. </td>
    </tr>
    <tr>
      <td  style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;"> 22.2	Immediately from and after the Close of this sale, all risk of loss or damage shall be upon Buyer. </td>
    </tr>
  
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold">23.	SELLER'S OPERATION OF THE BUSINESS PRIOR TO CLOSING: </td>
    </tr>
    <tr>
      <td style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;">Seller hereby represents to Buyer that from the date of execution of this Contract to the date of Closing, Seller shall (a) carry on the business activities and operations of the Business diligently and in substantially the same manner as has been customary in the past; (b) not remove any item with the exception of the Inventory sold in the normal course of business and (c) not undertake, bind or otherwise obligate the Business to any contractual obligation without the prior consent of Buyer, including but not limited to, any advertising or other promotional campaigns which would obligate the Buyer to provide services or products to customers at less than the ordinary and customary retail cost. </td>
    </tr>
    <tr>
      <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold">24.	BUSINESS DEPOSITS: </td>
    </tr>
    <tr>
      <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify;">24.1	Any and all amounts currently on deposit for the benefit of the Business for utility services, leases, insurance, etc., are and shall remain the sole property of Seller and are not included as part of this transaction. </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">24.2	Buyer shall, effective with the Closing, deposit such amounts as are necessary to continue the operation of the Business. </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold">25.	BUSINESS TELEPHONE/WEBSITE/EMAIL/PASSWORDS: </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">Seller agrees to transfer to Buyer at Closing, and Buyer agrees to accept all of Seller's right, title, interest and responsibility for the Business telephone number(s), and yellow pages, Website(s), social media, third party delivery websites, email address, passwords. Buyer may continue, terminate, or obtain new third party accounts.</td>
    </tr>
    </table>
   
    <div class="page-break"></div>


  <!-- Page #5 --> 
  
  <table width="100%" align="center" cellpadding="5" cellspacing="5">
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold">26.	BUSINESS MAIL:</td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">Seller agrees that all mail relating to the Business shall be routed to Buyer, and Buyer agrees to promptly forward to Seller any mail personalized to Seller. </td>
    </tr>
    <tr>
      <td style=" font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold">27.	BUSINESS PREMISES: </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">Until possession is transferred to the Buyer at Closing, Seller agrees to maintain the Business premises, including heating, cooling, plumbing and electrical systems, built-in fixtures, together with all other equipment and the Assets, in good working order, and to maintain and leave the premises in a clean, orderly condition. </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold">28.	PRORATIONS: </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; "> All pro-ratable items shall be prorated as of the Closing Date. </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold">29.	LICENSES, PERMITS, AND AUTHORIZATIONS: </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">29.1	Unless otherwise specified herein, Seller agrees to cooperate with Buyer in obtaining, at Buyer's expense, any licenses, permits, approvals or certificates necessary for the continued operation of the Business. </td>
    </tr>
    <tr>
      <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify;">29.2	Seller represents that to the best of Seller's knowledge the Business and premises meet, at the time of Closing, all government regulations as to health, fire, zoning and other licensing laws. </td>
    </tr>
    <tr>
      <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify;">29.3	Seller shall bear the cost of repairs and/or alterations that are required to allow Buyer to operate the Business in a lawful manner. </td>
    </tr>
    <tr>
        <td colspan="3" style="font-size:14px; font-family:Arial, Helvetica, sans-serif">29.4 Buyer agrees to provide all reasonable financial disclosures and other information required to transfer any Franchise Agreements associated with, and required to operate, the Business including, but not limited to, Buyer’s tax returns and personal financial statements, within [<span class="pdf_color">
          <u>{{ $data['fld_29_4'] ?? 'N/A' }}</u>
        </span>] days of written request from any applicable Franchise. Failure to comply with this Section 29.4 shall be a breach of this Contract by Buyer. </td>
      </tr> 
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold">30.	FAMILIARIZATION: </td>
    </tr>
    <tr>
      <td style=" font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">Seller and/or 
        
        <u>{{ $data['fld_30_a'] ?? 'N/A' }}</u>
        
        agrees to spend, at no cost to Buyer, a period of [<span class="pdf_color">
          
          <u>{{ $data['fld_30_b'] ?? 'N/A' }}</u>
        
        </span>] days [<span class="pdf_color">
          
          <u>{{ $data['fld_30_c'] ?? 'N/A' }}</u>
        
        </span>] weeks [<span class="pdf_color">
          
          <u>{{ $data['fld_30_d'] ?? 'N/A' }}</u>
        
        </span>] month(s) during normal business hours, of approximately <span class="pdf_color">

          <u>{{ $data['fld_30_e'] ?? 'N/A' }}</u>
        
        </span> hours per day, exclusive of holidays and Sundays, after the Closing Date, to assist Buyer and employees in the orderly transfer of the Business.</td>
    </tr>
  
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold">31.	RESTRICTIVE COVENANT: </td>
    </tr>
    <tr>
      <td align="left" valign="middle" style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;">Check which is appropriate: </td>
    </tr>
    <tr>
      <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify;">31.1	[ 
        
        {!! $data['fld_31'] == "1" ? "<img src=".public_path('assets/images/print_pdf/check.png')." />" : "<img src=".public_path('assets/images/print_pdf/not-check.png')." />" !!}
        
        ] The Buyer and Seller shall enter into a written valid restraint of trade or commerce protecting the legitimate business interests associated with or conveyed in this transaction.  The party seeking enforcement of a restrictive covenant shall state, with particularity and specificity, the legitimate business interests to be protected and the reasonable time, place and manner restrictions necessary to protect the enumerated legitimate business interests. The Parties agree that the restrictive covenant shall have a term of <span class="pdf_color">
          
          <u>{{ $data['fld_31_1_b'] ?? 'N/A' }}</u>
        
        </span> (<span class="pdf_color">
          
          <u>{{ $data['fld_31_1_c'] ?? 'N/A' }}</u>
        
        </span>) years and shall be enforced within the following geographic area: <span class="pdf_color">
          <u>{{ $data['fld_31_1_d'] ?? 'N/A' }}</u>
        </span> miles.  Unless otherwise agreed upon by Buyer and Seller, Buyer shall incur the initial cost of preparing a restrictive covenant agreement, as an additional closing document, in accordance with this Section.  To the extent that Seller wishes to have such restrictive covenant agreement reviewed by independent counsel, the cost of such review shall be borne by Seller. Broker shall not have any responsibility to prepare, oversee or otherwise coordinate the preparation of any separate restrictive covenant agreement and Buyer and Seller hereby release and hold Broker harmless from any such responsibility.  Broker hereby advises Buyer and Seller to seek their own separate, independent legal counsel in regards to the preparation of any such restrictive covenant agreement.</td>
    </tr>
    <tr>
      <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold">ALTERNATIVELY </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">31.2	[
        
        {!! $data['fld_31'] == "2" ? "<img src=".public_path('assets/images/print_pdf/check.png')." />" : "<img src=".public_path('assets/images/print_pdf/not-check.png')." />" !!}
        
        ] The Buyer and Seller shall NOT enter into any restraint of trade or commerce. </td>
    </tr>
    </table>

    <div class="page-break"></div>

  <!-- Page #5 --> 

  <table width="100%" align="center" cellpadding="5" cellspacing="5">
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold">32.	ALLOCATION OF PURCHASE PRICE: </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">32.1	Buyer and Seller acknowledge that certain Federal Income Tax laws may be applicable to this transaction. </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">32.2	Buyer and Seller acknowledge that each party may be required to report this transaction to the Internal Revenue Service (IRS) and allocate the Purchase Price among the applicable asset classifications found on IRS Rev. Form 8594. </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">32.3	Buyer and Seller agree to cooperate fully with each other to determine the appropriate asset allocation for this transaction and that the IRS Rev. Form 8594 shall be prepared by Buyer's accountant at Buyer's expense </td>
    </tr>
    <tr>
      <td style=" font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; ">32.4	Buyer and Seller agree to complete, sign and submit the appropriate IRS Rev. Form 8594 for this transaction. </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">32.5	Buyer and Seller [
        
        {!! $data['fld_32_5_a'] == "1" ? "<img src=".public_path('assets/images/print_pdf/check.png')." />" : "<img src=".public_path('assets/images/print_pdf/not-check.png')." />" !!}
        
        ] agree to have the asset allocation completed at Closing, [
          
          {!! $data['fld_32_5_a'] == "2" ? "<img src=".public_path('assets/images/print_pdf/check.png')." />" : "<img src=".public_path('assets/images/print_pdf/not-check.png')." />" !!}
        
        ] do not agree to have the asset allocation completed at Closing. </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold">33.	PREMISES LEASE: </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; "> 33.1	[
        
        {!! $data['fld_33_1'] == "1" ? "<img src=".public_path('assets/images/print_pdf/check.png')." />" : "<img src=".public_path('assets/images/print_pdf/not-check.png')." />" !!}
        
        ] At Closing, Seller shall assign and Buyer shall assume Seller’s current lease on the Business premises ("the Lease") with Lessor's written consent, and this Contract shall be subject to such consent where consent is required. </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">33.2	[
        
        {!! $data['fld_33_2'] == "1" ? "<img src=".public_path('assets/images/print_pdf/check.png')." />" : "<img src=".public_path('assets/images/print_pdf/not-check.png')." />" !!}
        
        ] Alternately, at Buyer's option, Seller shall cooperate with Buyer in obtaining a new premises lease from Lessor, on substantially the same terms and conditions as the Lease, to be effective as of the Closing Date.</td>
    </tr>
    
        <!-- New Add on -->
  
    <tr>
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">33.3
          Buyer and Seller agree that the lease assignment fee or fees related to a new lease, if any, shall be paid as follows: <u><span class="pdf_color">
            
            <u>{{ $data['fld_33_3_seller'] ?? 'N/A' }}</u>
          
          </span></u>
          Seller <u><span class="pdf_color">
            
            <u>{{ $data['fld_33_3_buyer'] ?? 'N/A' }}</u>
          
          </span></u> Buyer.</td>
       
    </tr>
  
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">33.4	Buyer agrees to provide all reasonable financial disclosures requested by Lessor including, but not limited to, Buyer’s tax returns
  and personal financial statements, within <span class="pdf_color">
    
    <u>{{ $data['fld_33_4'] ?? 'N/A' }}</u>
  
  </span> days of Lessor’s request. Failure to comply with this Section 33.4 shall be a breach of
  this Contract by Buyer.<br><br>
  33.5 Buyer shall fully cooperate to obtain Seller’s release from the Lease. In any event where Buyer shall be unsuccessful in obtaining Seller's release from its obligations under the Lease, Buyer agrees to indemnify Seller and hold Seller harmless from all debts, claims, actions, losses, damages and attorney's fees, existing or that may arise from or be related to Buyer's obligations under the Lease.
          </td>
    </tr>
    <tr>
    <td  style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">33.6 Other: [ 
      
      <u>{{ $data['fld_33_6'] ?? 'N/A' }}</u>
      
      ]</td>
    </tr>
    <tr>
      <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold">34.	CLOSING ATTORNEY/ESCROW AGENT: </td>
    </tr>
    <tr>
      <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify;">34.1	The parties hereby appoint <span class="pdf_color">
        
        <u>{{ $data['fld_34_1_a'] ?? 'N/A' }}</u>
      
      </span> at <span class="pdf_color">
        
        <u>{{ $data['fld_34_1_b'] ?? 'N/A' }}</u>
      
      </span>Phone:<span class="pdf_color">
        
        <u>{{ $data['fld_34_1_c'] ?? 'N/A' }}</u>
      
      </span><br> Email: <span class="pdf_color">
        
        <u>{{ $data['fld_34_1_d'] ?? 'N/A' }}</u>
      
      </span> as the Transaction Closing Attorney and Escrow Agent to receive, deposit and distribute funds for the parties pursuant to the terms of the Escrow Agreement. </td>
    </tr>
     <tr>
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; ">34.2 Buyer and Seller acknowledge that the Transaction Closing Attorney shall prepare any escrow instructions, closing documents
  and other instruments evidencing the terms and conditions of this transaction as are reasonably required for the closing ("the Closing Documents").<br>
  Buyer and Seller agree that Escrow Agent shall obtain signatures and oversee any required recording of the Closing Documents.
  Buyer and Seller agree to reasonably cooperate in the execution of the Closing Documents and obtain their own independent legal
  counsel to review the Closing Documents in their sole discretion. </td>
      </tr>
      <tr>
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; ">34.3 To the extent that any terms of the Escrow Agreement shall conflict with the terms of this Contract, the terms of the Escrow Agreement shall control. </td>
      </tr>
    <tr>
      <td style=" font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold">35.	CLOSING COSTS/FILING AND RECORDING FEES: </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;"> 35.1	Buyer and Seller agree that, unless otherwise specified herein or the Escrow Agreement, Buyer shall pay all of Escrow Agent and Transaction Closing Attorney's fees at the Closing, including but not limited to, all postage, wire fees, lien, judgment and utility searches. </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">35.2	If the Contract contains a Note in favor of Seller, Buyer shall pay all of the Filing/Recording fees associated with the State and County UCC filings, Documentary Stamps and any other fees associated with the Note. </td>
    </tr>
   
     <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold"> 36. PRE-CLOSING COVENANTS: </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;"> 36.1 If necessary, Buyer and Seller agree not to divulge any information about this transaction prior to Closing. </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;"> 36.2 Buyer agrees not to visit the premises of the Business prior to Closing without Seller's approval, which approval shall not beunreasonably withheld. </td>
    </tr>
  
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold">37.	BULK SALES TRANSFERS: </td>
    </tr>
    <tr>
      <td align="left" valign="middle" style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;">Seller shall cooperate with Buyer in accomplishing any requirements related to bulk transfers under applicable State law. Seller agrees to retain independent legal counsel to prepare, or otherwise provide, any schedules of property, lists of creditors or affidavits necessary to comply with applicable State law related to bulk transfers. </td>
    </tr>
    <tr>
      <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold">38.	GOVERNING LAW AND FORUM SELECTION</td>
    </tr>
    <tr>
      <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify;">38.1	CHOICE OF LAW. The laws of the State of <span class="pdf_color"> 
        
        <u>{{ $data['fld_38_1'] ?? 'N/A' }}</u>
      
      </span>(without giving effect to its conflicts of law principles) govern all matters arising out of or relating to this Contract, including, without limitation, its validity, interpretation, construction, performance, and enforcement. </td>
    </tr>
    </table>

      
<div class="page-break"></div>

  <!-- Page #11 --> 
  
   <table width="100%" align="center" cellpadding="5" cellspacing="5">
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">38.2	DESIGNATION OF FORUM. Any Party bringing a legal action or proceeding against any other Party arising out of or relating to this Contract shall bring the legal action or proceeding in the County of <span class="pdf_color">
        
        <u>{{ $data['fld_38_2_a'] ?? 'N/A' }}</u>
      
      </span>, State of <span class="pdf_color">
        
        <u>{{ $data['fld_38_2_b'] ?? 'N/A' }}</u>
      
      </span>.</td>
    </tr>
  
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold">39.	ATTORNEYS' FEES AND COURT COSTS </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">39.1	If any legal action or other proceeding is brought for the enforcement of this Contract, or because of an alleged dispute, breach, default or misrepresentation in connection with any provision of this Contract, the successful or prevailing party or parties shall be entitled to recover reasonable attorneys' fees, court costs, and all expenses even if not taxable court costs (including, without limitation, all such fees, costs, and expenses incident to arbitration, appellate, bankruptcy, and post-judgment proceedings), incurred in that action or proceeding or any appeal, in addition to any other relief to which the party or parties may be entitled. </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">39.2	For purposes of this Contract, "Attorneys' fees" include legal assistant fees, expert witness fees, investigative fees, administrative costs, and all other charges billed by the attorney. </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold">40.	WAIVER: </td>
    </tr>
    <tr>
      <td style=" font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; ">No waiver of any provisions of this Contract shall be effective unless it is in writing, signed by the party against whom it is asserted and any such waiver shall only be applicable to the specific instance to which it relates and shall not be deemed to be a continuing waiver. </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold">41.	 PARAGRAPH HEADLINES:</td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">Captions and paragraph headlines in this Contract are for convenience and reference only and do not define, describe, extend or limit the scope or intent of this Contract or any provision herein. </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold ">42.  SURVIVABILITY OF REPRESENTATIONS AND WARRANTIES: </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">The parties hereto acknowledge that the representations and warranties contained in this Contract shall survive the Closing of this transaction for a period of <span class="pdf_color">
        <u>{{ $data['fld_42'] ?? 'N/A' }}</u>
      
      </span> years.</td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold">43.	BINDING EFFECT: </td>
    </tr>
    <tr>
      <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify;">43.1	This Contract shall bind and inure to the benefit of the successors, assigns, personal representatives, heirs and legatees of the parties hereto. </td>
    </tr>
    <tr>
      <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify;">43.2	The parties hereto acknowledge that this Contract, including all covenants, representations, warranties and agreements, shall survive the Closing of this transaction. </td>
    </tr>
    <tr>
      <td style=" font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold">44.	ENTIRE AGREEMENT: </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;"> This Contract constitutes the entire agreement and understanding of the parties and cannot be modified except in writing executed by all parties. All representations made herein shall survive the closing. </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold">45.	SEVERABILITY: </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;"> In the event that any of the terms, conditions or covenants of this Contract are held to be unenforceable or invalid by any court of competent jurisdiction, the validity and enforceability or the remaining provisions, or portions thereof, shall not be affected but shall remain in full force and effect. </td>
    </tr>
    <tr>
      <td  style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:14px;"> 46.	TYPEWRITTEN OR HANDWRITTEN PROVISIONS: </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">Typewritten or handwritten provisions inserted in this form and acknowledged by the parties as evidenced by their initials shall control all printed provisions in conflict therewith. </td>
    </tr>
  
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold">47.	ENVIRONMENTAL:</td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">The parties acknowledge having been advised by the Broker that there may be health, liability and economic impact of environmental matters relative to real estate transactions, which may include the sale of the Business or the lease of the premises where the Business is conducted. The Broker specifically affirms that it does not conduct, advise and/or have any knowledge of environmental matters, nor does it undertake or conduct analyses thereof. The parties are advised to retain qualified environmental professionals to determine if any hazardous toxic wastes, substances or other undesirable materials or conditions exist on the property and if so, whether any health danger or other liability exists and whether such substances may have been used during the construction or operation of the business or buildings, or may be present as a result of previous activities on property. Various laws and regulations have been enacted at the federal, state and local level dealing with the use, storage, handling, removal, transportation and disposal of toxic or hazardous wastes and substances. Depending upon past, current and proposed uses of this property, the parties acknowledge that it is prudent to retain an environmental expert to conduct a site investigation and/or building inspection. If hazardous or toxic substances exist or are contemplated to be used at the property, special governmental approvals or permits may be required. Further, the cost of removal and disposal of such materials may be substantial. Consequently, the assistance of legal and technical experts should be obtained where these substances are or may be present.</td>
    </tr>
  </table>


  <div class="page-break"></div>
  <!-- Page #5 --> 


  <table width="100%" align="center" cellpadding="5" cellspacing="5">
  
    <tr>
      <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold">48.	TAX AND LEGAL DISCLOSURE:</td>
    </tr>
    <tr>
      <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify;">Broker discloses the existence of possible sales tax liability for the parties involved as a result of the sale or exchange of the Assets. Tax on sales, use and other taxes, may be due as a result of the closing of this Contract. Broker discloses the existence of such possible tax liability as well as the potential transferee liability purported to be created therein. However, Broker specifically disclaims any responsibility as to whether and/or to what extent liability is applicable to this transaction. Broker advises that the parties hereto seek the assistance of tax and legal independent counsel. The parties acknowledge that they have been advised by the Broker to seek tax and legal advice as to the allocation of the purchase price, as is required by law. Buyer and Seller acknowledge that certain Federal and State Income Tax laws and other laws may be applicable to this transaction.</td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold">49.	REAL PROPERTY; CROSS TERMINATION: </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">[

        {!! $data['fld_49'] == "1" ? "<img src=".public_path('assets/images/print_pdf/check.png')." />" : "<img src=".public_path('assets/images/print_pdf/not-check.png')." />" !!}
        
        ] This Contract DOES NOT include real estate property. </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">[
        
        {!! $data['fld_49'] == "2" ? "<img src=".public_path('assets/images/print_pdf/check.png')." />" : "<img src=".public_path('assets/images/print_pdf/not-check.png')." />" !!}
        
        ] This Contract DOES include real estate property, consequently: </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">49.1	The terms and conditions of the real estate sale shall be found on a separate commercial real estate contract. </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">49.2	If this Contract shall terminate according to its terms any contingent commercial real estate contract shall also terminate. </td>
    </tr>
    <tr>
      <td style=" font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold ">50.	BROKERAGE: </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">The parties herby acknowledge that <span class="pdf_color">
        
        <u>{{ $data['fld_50_a'] ?? 'N/A' }}</u>
      
      </span>is the Broker for this transaction and is herein referred to as such "Broker."  Broker(s) identified herein have performed valuable brokerage services and are to be paid a commission pursuant to a separate agreement or agreements. Unless otherwise provided for herein, the Listing Broker will be paid a commission by Seller, and the Selling Broker will receive a portion of the Listing Broker's commission pursuant to a cooperative brokerage agreement. The closing attorney is directed to pay the commission of the Broker(s) at closing out of the proceeds of the sale. If the sale proceeds are insufficient to pay the full commission, the party owing the commission will pay any shortfall at closing. If more than one Broker is involved in the transaction, the closing attorney is directed to pay each Broker its respective portion of said commission. In the event the sale is not closed because of Buyer's failure or refusal to perform any of Buyer's obligations herein, Escrow Agent shall pay in equal shares and to the extent that a commission is owed, all Earnest Money to the Listing Broker and the Selling Broker.  If such Escrow Money is insufficient to satisfy the commission obligation(s), then Buyer shall immediately pay to the Broker(s) the balance of the full commission the Broker(s) would have received had the sale closed, and the Selling Broker and Listing Broker may jointly or independently pursue Buyer for their portion of the commission.  In the event the sale is not closed because of Seller's failure or refusal to perform any of Seller's obligations herein, then Seller shall immediately pay to the Broker(s) the full commission the Broker(s) would have received had the sale closed, and the Selling Broker and Listing Broker may jointly or independently pursue Seller for their portion of the unpaid commission.</td>
    </tr>

    @if (isset($data['check_state_hid']) && $data['check_state_hid'] == 'GA')
    
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; text-decoration:underline;">Agency and Brokerage. </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;"><strong>A.	Agency Disclosure: </strong> In this Agreement, the term <strong>"Broker"</strong> shall mean a licensed Georgia real estate broker or brokerage firm and, where the context would indicate, the broker's affiliated licensees. No Broker in this transaction shall owe any duty to Buyer or Seller greater than what is set forth in their brokerage engagements and the Brokerage Relationships in Real Estate Transactions Act, O.C.G.A. § 10-6A-1 et. seq.; </td>
    </tr>

    @endif


  </table>
  
  @if (isset($data['check_state_hid']) && $data['check_state_hid'] == 'GA')

  <table width="900" align="center" cellpadding="5" cellspacing="5">
    <tr>
      <td colspan="2" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">(i) <strong> No Agency Relationship:</strong> Buyer and Seller acknowledge that, if they are not represented by a Broker as indicated on the first page of this Agreement, they are each solely responsible for protecting their own interests, and that Broker's role is limited to performing ministerial acts for that party.</td>
    </tr>
    <tr>
      <td colspan="2" style=" font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">(ii) Dual Agency or Designated Agency. If Buyer and Seller are both being represented by the same Broker as indicated on the first page of this agreement, a relationship of either designated agency [
        
        {!! $data['fld_50_2_a'] == "dual" ? "<img src=".public_path('assets/images/print_pdf/check.png')." />" : "<img src=".public_path('assets/images/print_pdf/not-check.png')." />" !!}
        
        ] , OR, dual agency, [

        {!! $data['fld_50_2_a'] == "shall_exist" ? "<img src=".public_path('assets/images/print_pdf/check.png')." />" : "<img src=".public_path('assets/images/print_pdf/not-check.png')." />" !!}
        
        ] shall exist. </td>
      </tr>
    <tr>
      <td colspan="2" style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify;">(a) Dual Agency Disclosure. [Applicable only if dual agency has been selected above].  Buyer and Seller are aware that Broker is acting as a dual agent in this transaction and consent to the same. Buyer and Seller have been advised that:</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify;">In serving as a dual agent, Broker is representing two clients whose interests are or at times could be different or even adverse;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">(2) Broker will disclose all adverse, material facts relevant to the transaction and actually known to the dual agent to all parties in the transaction except for information made confidential by request or instructions from each client which is not otherwise required to be disclosed by law;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">(3) Buyer and Seller do not have to consent to dual agency and, the consent of Buyer and Seller to dual agency has been given voluntarily and the parties have read and understand their brokerage engagement agreements. </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">(4) Notwithstanding any provision to the contrary contained herein, Buyer and Seller each hereby direct Broker, while acting as a dual agent, to keep confidential and not reveal to the other party any information which could materially and adversely affect their negotiating position. </td>
    </tr>
     <tr>
       <td>&nbsp;</td>
      <td  style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">(b) <strong> Designated Agency Assignment. </strong>[Applicable only if the designated agency has been selected above].  Broker has assigned <span class="pdf_color">
        
        <u>{{ $data['fld_50_b_a'] ?? 'N/A' }}</u>
      
      </span> to work exclusively with Buyer as Buyer's designated agent and <span class="pdf_color">

        <u>{{ $data['fld_50_b_b'] ?? 'N/A' }}</u>
      
      </span>to work exclusively with Seller as Seller's designated agent. Each designated agent shall exclusively represent the party to whom each has been assigned as a client and shall not represent in this transaction the client assigned to the other designated agent. </td>
    </tr>
    </table>
  
    <div class="page-break"></div>

  <!-- Page #9 --> 
  
  @endif

  <table width="100%" align="center" cellpadding="5" cellspacing="5">
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold">51.	BUYER'S ACKNOWLEDGMENT: </td>
    </tr>
    <tr>
      <td style=" font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify;  ">Buyer, its owners and Guarantors hereby acknowledge that they have not relied upon any advice, promises, inducements,
  representations, commitments, guarantees, or opinions of any kind, either verbally or in writing, of Broker or its’ owners,
  associates, agents, employees, or representatives in connection with any aspect of the transaction contemplated by this
  Contract. It is further understood by Buyer that the Broker relies entirely upon the representations made by Buyer and Seller.
  Broker does not warrant any information in regards to obtaining any licenses, any management agreements, any employee issues,
  leases, previous history, payables/liabilities, payroll and payroll tax data, liens/lien checks, UCCs, facility/equipment condition, franchise issues, profits or losses, personal and/or business financial data, building codes, or sales figures, will not be held responsible for any errors and/or omissions, and has recommended that Buyer retain its own independent, separate legal counsel. Buyer hereby acknowledges that Buyer is relying solely on Buyer's own inspection of the Business and the representations of Seller regarding the prior Business operating history, the value of the Assets and all other material facts. Broker(s) neither represented nor warranted the accuracy of any facts, figures, books, records, memoranda, financial information or data, of any kind, concerning the operations of Seller. Broker has not conducted any independent investigation whatsoever of the Business and the information provided by Seller to Broker. Moreover, Buyer acknowledges that Broker has not verified any of the representations made by Seller. Buyer indemnifies Broker and its’ owners, associates, agents, employees and representatives from any liability involved in the transaction contemplated by this Contract. If the transaction contemplated by this Contract is closed in escrow, with or without an attorney's presence or involvement, Broker and its’ owners, associates, agents, employees and representatives will not be responsible for any errors or omissions and do not warrant any of the closing documents. </td>
    </tr>

@if (isset($data['check_state_hid']) && $data['check_state_hid'] != 'GA')

</table>

<div class="page-break"></div>

<!-- Page #10 -->

<table width="100%" align="center" cellpadding="5" cellspacing="5">
  
@endif

    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold">52.	SELLER'S ACKNOWLEDGMENT:</td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">Seller, its owners and Guarantors hereby acknowledge that they have not relied upon any advice, promises, inducements,
  representations, commitments, guarantees, or opinions of any kind, either verbally or in writing, of Broker or its’ owners,
  associates, agents, employees, or representatives in connection with any aspect of the transaction contemplated by this
  Contract. It is further understood by Seller that the Broker relies entirely upon the representations made by Buyer and Seller,
  will not be held responsible for any errors and/or omissions, and has recommended that Seller retain its own independent,
  separate legal counsel. Seller acknowledges that Broker made no representations concerning the creditworthiness, integrity or
  ability of Buyer to complete this transaction or satisfy any promissory note issued in connection with this Contract. Seller has
  relied solely on Buyer's representations with respect thereto. Seller acknowledges that the Broker has performed all its duties
  pursuant to the listing agreement and has earned its compensation as set forth therein. Seller indemnifies Broker and its’ owners,
  associates, agents, employees and representatives from any liability involved in the transaction contemplated by this Contract. If
  the transaction contemplated by this Contract is closed in escrow, with or without an attorney's presence or involvement,
  Broker and its’ owners, associates, agents, employees and representatives will not be responsible for any errors or omissions and
  do not warrant any of the closing documents.</td>
    </tr>
    <tr>
      <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold">53.	INDEPENDENT COUNSEL:</td>
    </tr>
    <tr>
      <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify;">By signing this Contract, Buyer and Seller each acknowledge (a) that this Contract is a standard form which was not prepared by either
  party; (b) that they have been advised to retain their own separate legal counsel to review and modify this form prior to its
  execution; (c) is a legally binding document with important legal implications; and (d) to the extent that Buyer or Seller choose not
  to retain their own independent legal, that such party has waived such opportunity to obtain independent counsel despite
  being advised to do so.</td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold">54.	BUYERS DEPOSIT INSTRUCTIONS TO BROKER / AGENT: </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">In the event that Buyer tenders payment of the Earnest Money Deposit with this offer (see Section 4): (a) Buyer hereby orders Broker to accept and deliver Buyer’s Deposit Check(s) to the Escrow Agent; (b) Broker shall acknowledge acceptance and receipt of Buyer’s deposit in a writing that shall be placed in Buyer’s file; and (c) Broker’s acceptance and delivery of Buyer’s Deposit Check(s), as found in part (a), is mutually agreeable by and between Buyer and Seller.</td>
    </tr>
  </table>
  
  <div class="page-break"></div>

  <!-- Page #9 --> 

  
  <table width="100%" align="center" cellpadding="5" cellspacing="5">
  
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold">55. SCHEDULES, EXHIBITS, AND ADDENDA</td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">All Schedules, Exhibits, and/or Addenda hereto, listed below, or referenced herein are made a part of this contract. If any such Schedule, Exhibit, or Addendum conflicts with any preceding paragraph, said Schedule, Exhibit, or Addendum shall control: </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold">A.	Schedules: </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">i) <strong> Schedule 1 – </strong> Assets of the Business</td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold">B.	Exhibits: </td>
    </tr>
    <tr>
      <td style=" font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold ">[

        {!! $data['fld_55_b'] == "1" ? "<img src=".public_path('assets/images/print_pdf/check.png')." />" : "<img src=".public_path('assets/images/print_pdf/not-check.png')." />" !!}
        
        ] No Exhibits apply to this Contract </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold"> [

        {!! $data['fld_55_b'] == "2" ? "<img src=".public_path('assets/images/print_pdf/check.png')." />" : "<img src=".public_path('assets/images/print_pdf/not-check.png')." />" !!}
        
        ] 	Alternatively, the following Exhibits are incorporated herein: </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; padding:0 56px;"><div style="width:600px; text-align:justify;"><span class="pdf_color">
        
        <u>{{ $data['fld_55_b_c'] ?? 'N/A' }}</u>
      
      </span></div></td>
    </tr>
    <tr>
      <td  style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:14px;"> C. Addenda: </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:14px;"> [
        
        {!! $data['fld_55_c'] == "1" ? "<img src=".public_path('assets/images/print_pdf/check.png')." />" : "<img src=".public_path('assets/images/print_pdf/not-check.png')." />" !!}
        
        ] No Addenda apply to this Contract </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:14px;"> [
        
        {!! $data['fld_55_c'] == "2" ? "<img src=".public_path('assets/images/print_pdf/check.png')." />" : "<img src=".public_path('assets/images/print_pdf/not-check.png')." />" !!}
        
        ] Alternatively, the following Addenda are incorporated herein: </td>
    </tr>
     <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold"> [
        
        {!! $data['fld_55_c'] == "3" ? "<img src=".public_path('assets/images/print_pdf/check.png')." />" : "<img src=".public_path('assets/images/print_pdf/not-check.png')." />" !!}
        
        ] 	Which Wich Standard Addendum : </td>
    </tr>
    <tr>
      <td style=" padding:0 56px;"><div style="width:600px; text-align:justify;"><span class="pdf_color">
        
        <u>{{ $data['fld_55_c_c'] ?? 'N/A' }}</u>
      
      </span></div></td>
    </tr>
  </table>

  <div class="page-break"></div> 


  <!-- Page #11-1 --> 

  <table width="100%" align="center" cellpadding="5" cellspacing="5">
    <tr>
      <td style="font-weight:bold; font-size:14px;"> 56.	SPECIAL STIPULATIONS </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;"> The following Special Stipulations, if conflicting with any exhibit or preceding paragraph, shall control: </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify; padding-left:15px;"><div style="width:600px; text-align:justify;">
          <ol>

            @if(isset($data['fld_56_a']) && $data['fld_56_a'] == '1')
              <li>  Any requirement to refresh or upgrade the store will be the responsibility of the [
                
                {!! $data['fld_56_buyer'] == "1" ? "<img src=".public_path('assets/images/print_pdf/check.png')." />" : "<img src=".public_path('assets/images/print_pdf/not-check.png')." />" !!}
                
                ]  Buyer or [

                  {!! $data['fld_56_buyer'] == "2" ? "<img src=".public_path('assets/images/print_pdf/check.png')." />" : "<img src=".public_path('assets/images/print_pdf/not-check.png')." />" !!}
        
                  ] Seller however that party’s financial obligation shall be capped at a maximum of 

                  <u>{{ $data['fld_56_text'] ?? '_____________________' }}</u>

              </li>

            @endif 

            @if(isset($data['fld_56_b']) && $data['fld_56_b'] == '1')
              <li>Buyer's requirement to perform its obligations hereunder is contingent upon Seller executing a management agreement in a form reasonably acceptable to Buyer so that Buyer may operate under Seller's state and local alcohol licenses until the earlier of (a) Buyer being issued a local and state license for the sale of liquor, beer & wine for on-premises consumption or (b) three months from the Closing Date.</li>
            @endif 

            @if(isset($data['fld_56_c']) && $data['fld_56_c'] == '1')
              <li>Buyer and Seller agree that the franchise training and transfer fee shall be paid as follows: <span class="pdf_color">
              
                <u>{{ $data['fld_56_c_a'] ?? 'N/A' }}</u>
          
              </span> Buyer <span class="pdf_color">
                
                <u>{{ $data['fld_56_c_b'] ?? 'N/A' }}</u>
            
              </span> Seller. Buyer is responsible for any costs associated with travel and room and board for his training.</li>
            @endif 

            @if(isset($data['fld_56_c1']) && $data['fld_56_c1'] == '1')
              <li>Buyer's requirement to perform its obligations hereunder are contingent upon approval by the Franchise of the Buyer as a franchisee and Buyer's acceptance of the franchise agreement</li>
            @endif 

            @if(isset($data['fld_56_d']) && !empty($data['fld_56_d']))
              <li style="font-size:18px;"><span class="pdf_color">
                <u>{{ $data['fld_56_d'] ?? '' }}</u>
                </span>
              </li>
            @endif 
            
            @if(isset($data['fld_56_e']) && !empty($data['fld_56_e']))
              <li style="font-size:18px;"><span class="pdf_color">
                <u>{{ $data['fld_56_e'] ?? '' }}</u>
              </span>
              </li>
            @endif 

            @if(isset($data['fld_56_f']) && !empty($data['fld_56_f']))
              <li style="font-size:18px;"><span class="pdf_color">
                <u>{{ $data['fld_56_f'] ?? '' }}</u>              
              </span></li>
            @endif 

            @if(isset($data['fld_56_g']) && !empty($data['fld_56_g']))
              <li style="font-size:18px;"><span class="pdf_color">
                <u>{{ $data['fld_56_g'] ?? '' }}</u>  
                </span>
              </li>
            @endif 

            @if(isset($data['fld_56_h']) && !empty($data['fld_56_h']))

              <li style="font-size:18px;"><span class="pdf_color">
                <u>{{ $data['fld_56_h'] ?? '' }}</u>  
              </span></li>

            @endif 

            @if(isset($data['fld_56_i']) && !empty($data['fld_56_i']))
              <li style="font-size:18px;"><span class="pdf_color">
                <u>{{ $data['fld_56_i'] ?? '' }}</u> 
              </span></li>
            @endif 
          </ol>
        </div></td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;"></td>
    </tr>
  </table>

  <div class="page-break"></div>

  <!-- Page #12 --> 


  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="5">
      
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold">57.	BUSINESS BROKERS:</td>
      <td width="34" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; padding:10px;">&nbsp;</td>
    </tr>
    <tr>
      <td width="337" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; padding:10px;">LISTING BROKER:</td>
      <td width="329" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; padding:10px;">SELLING BROKER:</td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;"><span class="pdf_color">
        
        <u>{{ $data['fld_57_d'] ?? 'N/A' }}</u>
      
      </span><br />
        <span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; padding-left:15px;">Print Name of Agent</span></td>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">
        
        <span class="pdf_color">
          
          <u>{{ $data['fld_57_i'] ?? 'N/A' }}</u>
        
        </span><br />
        <span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; padding-left:15px;">Print Name of Agent</span></td>
    </tr>

    @if(isset($data['check_state_hid']) && $data['check_state_hid'] == 'GA')
      <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;"><span class="pdf_color">
        
        <u>{{ $data['georgiaRealestateagentnum'] ?? 'N/A' }}</u>
      
      </span><br />
          <span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; padding-left:15px;">Georgia Real Estate License Number</span></td>
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;"><span class="pdf_color">

          <u>{{ $data['georgiaRealestateagentnum'] ?? 'N/A' }}</u>
        
        </span><br />
          <span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; padding-left:15px;">Georgia Real Estate License Number</span></td>
      </tr>
    @endif

     <tr>
         <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">By: __________________________________________<br />
             <span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; padding-left:15px;">  Signature</span></td>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">By: __________________________________________<br />
          <span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; padding-left:15px;">  Signature</span>
      </td>
      </tr>
    
    
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;"><span class="pdf_color">
        
        <u>{{ $data['fld_57_a'] ?? 'N/A' }}</u>
      
      </span><br />

        <span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; padding-left:15px;">Business Broker's Name</span></td>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;"><span class="pdf_color">
        
        <u>{{ $data['fld_57_f'] ?? 'N/A' }}</u>
      
      </span><br />
        <span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; padding-left:15px;">Business Broker's Name</span></td>
    </tr>

    @if(isset($data['check_state_hid']) && $data['check_state_hid'] == 'GA')
      
      <tr>
    <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;"><span class="pdf_color">
      <u>{{ $data['georgiaRealestateOfcnum'] ?? 'N/A' }}</u>
    </span><br />
        <span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; padding-left:15px;">Georgia Real Estate License Number</span></td>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;"><span class="pdf_color">
        <u>{{ $data['georgiaRealestateOfcnum'] ?? 'N/A' }}</u>
        
      </span><br />
        <span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; padding-left:15px;">Georgia Real Estate License Number</span></td>
    </tr>

    @endif 

    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;"><span class="pdf_color">
        <u>{{ $data['fld_57_b'] ?? 'N/A' }}</u>
        
      
      </span><br />
        <span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; padding-left:15px;">Business Broker's Street Address</span></td>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;"><span class="pdf_color">
        <u>{{ $data['fld_57_g'] ?? 'N/A' }}</u>
      </span><br />
        <span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; padding-left:15px;">Business Broker's Street Address</span></td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;"><span class="pdf_color">
        <u>{{ $data['fld_57_c'] ?? 'N/A' }}</u>
      </span><br />
        <span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; padding-left:15px;">Business Broker's City, State, Zip</span></td>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;"><span class="pdf_color">
        
        <u>{{ $data['fld_57_h'] ?? 'N/A' }}</u>
      
      </span><br />
        <span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; padding-left:15px;">Business Broker's City, State, Zip</span></td>
    </tr>
    
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;"><span class="pdf_color">
        <u>{{ $data['fld_57_e'] ?? 'N/A' }}</u>
      
      </span><br />
        <span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; padding-left:15px;">Agent's Phone Number</span></td>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;"><span class="pdf_color">
        <u>{{ $data['fld_57_j'] ?? 'N/A' }}</u>
        
      
      </span><br />
        <span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; padding-left:15px;">Agent's Phone Number</span></td>
    </tr>
  </table>

  <div class="page-break"></div> 

  <!-- Page #13 --> 

  <table width="100%" align="center" cellpadding="5" cellspacing="5">
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold">THIS IS A LEGALLY BINDING AND FULLY ENFORCEABLE CONTRACT</td>
    </tr>
    <tr>
      <td align="left" valign="middle" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">The Buyer and Seller acknowledge reading, understanding and receiving a true copy of this Contract. If either Party does not understand the Contract, or has any questions concerning the Contract, they should immediately consult a professional before signing. A facsimile copy of this document and any signatures thereon shall be considered as an original. </td>
    </tr>
    <tr>
      <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold">BUYER'S BINDING OFFER:</td>
    </tr>
    <tr>
      <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; ">OFFERED and DATED THIS <span style="text-decoration:underline;border-bottom: 1px solid #888;"><span class="pdf_color">
        
        <u>{{ $data['buyer_binding_a'] ?? '_________________' }}</u>      
      
      </span> </span></td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">The Buyer makes the foregoing offer and agrees to purchase the above-described business assets on the terms and conditions according to the foregoing Contract. Seller acknowledges receipt of a true copy of this document.</td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold ;">BUYER: </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; ">Organizational Structure: A/An<span class="pdf_color"> 
        
        <u>{{ $data['buyer_binding_d'] ?? '' }}</u>
      
      </span><span class="pdf_color"> 
        
        <u>{{ $data['buyer_binding_dd'] ?? '' }}</u>
        
        </span></td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;"></td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; "><table width="100%" border="0" cellspacing="5" cellpadding="5">
          <tr>
            <td width="50%" style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">By:<span class="pdf_color"> 
              <u>{{ $data['buyer_binding_e'] ?? 'N/A' }}</u>
            </span><br />
              
            <span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; padding-left:15px;">(Print Full Name of Buyer)</span></td>
            <td width="50%" style="font-family:Arial, Helvetica, sans-serif; font-size:14px;"><span class="pdf_color">
              
              <u>{{ $data['buyer_binding_f'] ?? 'N/A' }}</u>
            
            </span><br />
              <span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; padding-left:15px;">(Street Address of Buyer)</span></td>
          </tr>
          <tr>
            <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">By: __________________________________________<br />
              <span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; padding-left:15px;">(Signature of Authorized Person) (Date) (Print Name)</span></td>
            <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;"><span class="pdf_color">
              
              <u>{{ $data['buyer_binding_h'] ?? 'N/A' }}</u>
            
            </span><br />
              <span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; padding-left:15px;">(City, State, Zip of Buyer)</span></td>
          </tr>
          <tr>
            <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">By: __________________________________________<br />
              <span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; padding-left:15px;">(Signature  of Partner if a partnership) (Date) (Print Name)</span></td>
            <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;"><span class="pdf_color">
              
              <u>{{ $data['buyer_binding_j'] ?? 'N/A' }}</u>

            </span><br />
              <span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; padding-left:15px;">(Business Phone) -(Cell Phone)</span></td>
          </tr>
          <tr>
            <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">By: __________________________________________<br />
              <span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; padding-left:15px;">(Signature of Guarantor) (Date) (Print Name)</span></td>
            <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">who personally guarantees Buyer's performance herein.</td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;"> Unless otherwise provided by law, an electronic signature may be used to sign as writing and shall have the same force and effect as a written signature. </td>
    </tr>
    <tr>
      <td style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:14px;"> SELLER'S ACCEPTANCE OF OFFER: </td>
    </tr>
    <tr>
      <td style=" font-family:Arial, Helvetica, sans-serif; font-size:14px;"> ACCEPTED and DATED THIS	day of __________<!--, 20 __________ at the hour of __________ : __________	o'clock __________. M. --></td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;"> The Seller accepts the foregoing offer and agrees to sell the business assets on the terms and conditions according to the foregoing contract. Seller acknowledges receipt of a true copy of this document. </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold ;"><span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold">SELLER</span>: </td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; ">Organizational Structure: A/An <span class="pdf_color">
        
        <u>{{ $data['seller_acceptance_f'] ?? 'N/A' }}</u>
      
      </span><span class="pdf_color"> 
        
        <u>{{ $data['seller_acceptance_ff'] ?? 'N/A' }}</u>
      
      </span></td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;"></td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; "><table width="100%" border="0" cellspacing="5" cellpadding="5">
          <tr>
            <td width="50%">By:<span class="pdf_color">
              
              <u>{{ $data['seller_acceptance_g'] ?? 'N/A' }}</u>
            
            </span><br />
              <span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; padding-left:15px;">(Print Full Name of Seller)</span></td>
            <td width="50%"><span class="pdf_color">
              
              <u>{{ $data['seller_acceptance_h'] ?? 'N/A' }}</u>
            
            </span><br />
              <span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; padding-left:15px;">(Street Address of Seller)</span></td>
          </tr>
          <tr>
            <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">By: __________________________________________<br />
              <span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; padding-left:15px;">(Signature of Authorized Person) (Date) (Print Name)</span></td>
            <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;"><span class="pdf_color">
              
              <u>{{ $data['seller_acceptance_j'] ?? 'N/A' }}</u>
            
            </span><br />
              <span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; padding-left:15px;">(City, State, Zip of Seller)</span></td>
          </tr>
          <tr>
            <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">By: __________________________________________<br />
              <span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; padding-left:15px;">(Signature  of Partner if a partnership) (Date) (Print Name)</span></td>
            <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;"><span class="pdf_color">
              
              <u>{{ $data['seller_acceptance_l'] ?? 'N/A' }}</u>
            
            </span><br />
              <span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; padding-left:15px;">(Business Phone) -(Cell Phone)</span></td>
          </tr>
          <tr>
            <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">By: __________________________________________<br />
              <span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; padding-left:15px;">(Signature of Guarantor) (Date) (Print Name)</span></td>
            <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">who  personally guarantees Seller's performance herein.</td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;"> (Unless otherwise provided by law, an electronic signature may be used to sign as writing and shall have the same force and effect as a written signature.) </td>
    </tr>
  </table>

  <div class="page-break"></div> 
  <!-- Page #14 --> 
  
  <table width="100%" align="center" cellpadding="5" cellspacing="5">
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold">SELLER'S REJECTION OF BUYER'S OFFER:</td>
    </tr>
    <tr>
      <td align="left" valign="top" style=" font-family:Arial, Helvetica, sans-serif; font-size:14px;"><table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td colspan="2" style=" font-family:Arial, Helvetica, sans-serif; font-size:14px;">REJECTED and DATED THIS day of ____________________________</td>
          </tr>
          <tr>
            <td colspan="2" style=" font-family:Arial, Helvetica, sans-serif; font-size:14px;">&nbsp;</td>
          </tr>
          <tr>
            <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; padding-left:5px;"> The Seller rejects the foregoing offer on the terms and conditions set out in the contract. Seller acknowledges receipt of a true copy of this document. </td>
          </tr>
          <tr>
            <td colspan="2" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold ;">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold ;"><span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold">SELLER</span>: </td>
          </tr>
          <tr>
            <td colspan="2" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; ">&nbsp;</td>
          </tr>
          <tr>
            <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;"></td>
          </tr>
          <tr>
            <td colspan="2" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; "><table width="100%" border="0" cellspacing="5" cellpadding="5">
                <tr>
                  <td width="45%">By: <span class="pdf_color">
                    
                    <u>{{ $data['seller_rejection_g'] ?? 'N/A' }}</u>

                    
                  
                  </span><br />
                    <span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; padding-left:15px;">(Print Full Name of Seller)</span></td>
                  <td width="55%"><span class="pdf_color">
                    
                    <u>{{ $data['seller_rejection_h'] ?? 'N/A' }}</u>
                  
                  </span><br />
                    <span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; padding-left:15px;">(Street Address of Seller)</span></td>
                </tr>
                <tr>
                  <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">By: __________________________________________<br />
                    <span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; padding-left:15px;">(Signature of Authorized Person) (Date) (Print Name)</span></td>
                  <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;"><span class="pdf_color">
                    
                    <u>{{ $data['seller_rejection_j'] ?? 'N/A' }}</u>

                  </span><br />
                    <span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; padding-left:15px;">(City, State, Zip of Seller)</span></td>
                </tr>
                <tr>
                  <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">By: __________________________________________<br />
                    <span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; padding-left:15px;">(Signature  of Partner if a partnership) (Date) (Print Name)</span></td>
                  <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;"><span class="pdf_color">
                    
                    <u>{{ $data['seller_rejection_l'] ?? 'N/A' }}</u>
                  
                  </span><br />
                    <span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; padding-left:15px;">(Business Phone) -(Cell Phone)</span></td>
                </tr>
                 <tr>
                  <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">By: __________________________________________	<br />
                      <span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; padding-left:15px;">(Signature of Guarantor) (Date) (Print Name)</span></td>
                      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">who  personally guarantees Seller's performance herein.</td>
                  </tr>
              </table></td>
          </tr>
          <tr>
            <td colspan="2" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;"> (Unless otherwise provided by law, an electronic signature may be used to sign as writing and shall have the same force and effect as a written signature.)</td>
          </tr>
        </table></td>
    </tr>
  </table>
  <table width="100%" align="center" cellpadding="5" cellspacing="5">
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold">&nbsp;</td>
    </tr>
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold">SELLER'S COUNTER OFFER:</td>
    </tr>
    <tr>
      <td align="left" valign="top" style=" font-family:Arial, Helvetica, sans-serif; font-size:14px;"><table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td colspan="2" style=" font-family:Arial, Helvetica, sans-serif; font-size:14px;"><span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; padding-left:5px; text-align:justify;">COUNTER OFFERED and DATED THIS</span> day of ____________________________
            </td>
          </tr>
          <tr>
            <td colspan="2" style=" font-family:Arial, Helvetica, sans-serif; font-size:14px;">&nbsp;</td>
          </tr>
          <tr>
            <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; padding-left:5px;"><span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; padding-left:5px; text-align:justify;">The Seller counters the foregoing offer on the terms and conditions set out in the contract per his hand written changes incorporated herein. Seller acknowledges receipt of a true copy of this document.</span></td>
          </tr>
          <tr>
            <td colspan="2" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold ;">&nbsp;</td>
          </tr> 
          <tr>
              <td width="45%">Selling Price: $ __________________________ <br /></td>
          </tr>
          <tr>
              <td width="45%">Special Stipulations as follows:</td>
          </tr>
          <tr><td style="width:150px;height:200px;border: 1px solid #57595A;"></td>
          </tr>
          <tr>
            <td colspan="2" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold ;">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold ;"><span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold">SELLER</span>: </td>
          </tr>
          <tr>
            <td colspan="2" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; ">&nbsp;</td>
          </tr>
          <tr>
            <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;"></td>
          </tr>
          <tr>
            <td colspan="2" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; "><table width="100%" border="0" cellspacing="5" cellpadding="5">
                <tr>
                  <td width="45%">By: <span class="pdf_color">
                    
                    <u>{{ $data['seller_counter_offer_g'] ?? 'N/A' }}</u>
                  
                  </span><br />
                    <span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; padding-left:15px;">(Print Full Name of Seller)</span></td>
                  <td width="55%"><span class="pdf_color">
                    
                    <u>{{ $data['seller_counter_offer_h'] ?? 'N/A' }}</u>

                  </span><br />
                    <span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; padding-left:15px;">(Street Address of Seller)</span></td>
                </tr>
                <tr>
                  <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">By: __________________________________________<br />
                    <span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; padding-left:15px;">(Signature of Authorized Person) (Date) (Print Name)</span></td>
                  <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;"><span class="pdf_color">
                    
                    <u>{{ $data['seller_counter_offer_j'] ?? 'N/A' }}</u>

                  </span><br />
                    <span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; padding-left:15px;">(City, State, Zip of Seller)</span></td>
                </tr>
                <tr>
                  <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">By: __________________________________________<br />
                    <span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; padding-left:15px;">(Signature  of Partner if a partnership) (Date) (Print Name)</span></td>
                  <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;"><span class="pdf_color">
                    
                    <u>{{ $data['seller_counter_offer_l'] ?? 'N/A' }}</u>

                   
                  
                  </span><br />
                    <span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; padding-left:15px;">(Business Phone) -(Cell Phone)</span></td>
                </tr>
                  <tr>
                    <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">By: __________________________________________<br />
                      <span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; padding-left:15px;">(Signature of Guarantor) (Date) (Print Name)</span></td>
                    <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">who  personally guarantees Seller's performance herein.</td>
                  </tr>
              </table></td>
          </tr>
          <tr>
            <td colspan="2" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;"> (Unless otherwise provided by law, an electronic signature may be used to sign as writing and shall have the same force and effect as a written signature.)</td>
          </tr>
        </table></td>
    </tr>
  </table>

<div class="page-break"></div>

  <!-- Page #15 Equipment list --> 

  <table width="100%" align="center" cellpadding="5" cellspacing="5"><tr>
    <td colspan="3" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; text-align:center">SCHEDULE "1"
      LIST OF ASSETS</td>
  </tr>
  <tr>
    <td width="33%" align="center" valign="middle" style=" font-family:Arial, Helvetica, sans-serif; font-size:14px;">[
      {!! $data['list_assets'] == "Attached" ? "<img src=".public_path('assets/images/print_pdf/check.png')." />" : "<img src=".public_path('assets/images/print_pdf/not-check.png')." />" !!}
      ]	Attached </td>
    <td width="33%" align="center" valign="middle" style=" font-family:Arial, Helvetica, sans-serif; font-size:14px;"> [
      
      {!! $data['list_assets'] == "Below" ? "<img src=".public_path('assets/images/print_pdf/check.png')." />" : "<img src=".public_path('assets/images/print_pdf/not-check.png')." />" !!}
      
      ] Below</td>
    <td width="33%" align="center" valign="middle" style=" font-family:Arial, Helvetica, sans-serif; font-size:14px;"> [
      
      {!! $data['list_assets'] == "None" ? "<img src=".public_path('assets/images/print_pdf/check.png')." />" : "<img src=".public_path('assets/images/print_pdf/not-check.png')." />" !!}
      
      ] None</td>
  </tr>
 </table>

<table width="100%" align="center" cellpadding="5" cellspacing="5"><tr><td><div style="width:100%; text-align:justify;">
  @php
    $equipment_list = nl2br($data['equipment_list']);
    $equipment_list = preg_replace("/\r|\n/", "", $equipment_list);
  @endphp
  
<ul>

@foreach(explode('<br />', $equipment_list) as $equipment) 

<li>{{$equipment}}</li>

@endforeach

</ul></div></td></tr></table>

@if(isset($data['fld_55_c']) && $data['fld_55_c'] == '3')

  <table width="100%" align="center" cellpadding="5" cellspacing="5">
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold">Addendum to Agreement</td>
    </tr>
    <tr>
      <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify;"><div style="width:600px; text-align:justify;">This addendum ("Addendum") to that certain purchase agreement ("APA") between <span class="pdf_color">
        
        <u>{{ $data['ad_getsellerlegalname1_a'] ?? 'N/A' }}</u>
      
      </span>, ("Seller") and <span class="pdf_color">
        
        <u>{{ $data['ad_getbuyerlegalname1_a'] ?? 'N/A' }}</u>
      
      </span> ("Buyer"), pursuant to which Buyer is buying certain of Seller’s assets with the intention of becoming a Which Wich Franchise, Inc. ("WWFI") franchisee is hereby made an integral part of such APA. Further, Seller and WWFI are parties to that certain franchise agreement which is the subject of the APA ("Franchise Agreement").</div></td>
    </tr>
    <tr>
      <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify;"><div style="width:600px; text-align:justify;">All defined terms used in this Addendum that are also defined in the APA have the same meanings given to them in the APA, unless otherwise defined herein. In the event any provisions or terms used in the APA or any attachments, exhibits, or addenda thereto are contradictory to the provisions or terms of this Addendum, the provisions and terms in this Addendum will control.<br>
      Buyer and Seller hereby agree as follows:</div></td>
    </tr>
  </table>

  <table width="100%" align="center" cellpadding="5" cellspacing="5">
    <tr>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px;"><div style="width:600px; text-align:justify;">
          <ol>
            <li style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;"><u>WWFI Transfer Procedures; Payment</u>. Buyer and Seller both acknowledge that each of them has received and reviewed WWFI’s transfer questionnaires, which set forth certain of WWFI’s transfer procedures and requirements, and which are subject to change from time to time, in WWFI’s discretion and in compliance with the Franchise Agreement. Buyer and Seller acknowledge that WWFI will not consent to the bartering of such responsibilities and further acknowledge and agree that if any provision set forth in the APA which is contrary to any provision of the Franchise Agreement or any of WWFI’s transfer procedures, then the Franchise Agreement and WWFI’s procedures will control, not the APA. Seller further acknowledges that Seller is bound by the transfer provisions set forth in the Franchise Agreement.</li>
            <li style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;"><u>Payments</u>. Notwithstanding anything to the contrary set forth in the APA, Seller is responsible for payment to WWFI of the transfer fee and other costs related to the transfer, as set forth in the Franchise Agreement. Any agreement between Buyer and Seller relating to the payment of fees and costs incurred by either party in relation to the transfer is between Buyer and Seller and will have no effect on Seller’s contractual obligations to WWFI or on WWFI’s requirements for consent.</li>
            <li style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;"><u>Closing Date</u>. Buyer and Seller acknowledge and agree that the Closing Date is subject to WWFI’s consent, and WWFI is under no obligation to comply with the Closing Date agreed to by Buyer and Seller. If Buyer and Seller close on the transaction contemplated by the APA without WWFI’s consent, such transaction will be a default of Seller’s Franchise Agreement, which will make the Franchise Agreement subject to termination. If such were to occur, then Seller’s rights in and to the Franchise Agreement would no longer be an asset subject to the transaction contemplated by the APA.</li>
            <li style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;"><u>Transfer of Franchise Agreement</u>. Notwithstanding anything to the contrary set forth in the APA, the Franchise Agreement is not an asset or contract that can be or will be assigned. Seller’s rights in and to the Franchise Agreement may be sold as an asset, but the Franchise Agreement between Seller and WWFI will be terminated, not assigned, and Buyer will be required to enter into a new, then-current franchise agreement with WWFI.</li>
            <li style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;"><u>Documents Required by WWFI</u>. If WWFI consents to the transfer, Buyer and Seller acknowledge that they and their owners will be required to sign a consent to transfer in the form required by WWFI and that Buyer will be required to enter into a new, then-current franchise agreement with WWFI. Buyer and Seller hereby agree that they will sign all other documents relating to the transfer as required by WWFI.</li>
            <li style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;"><u>Rights in and to the Marks</u>. Notwithstanding anything to the contrary set forth in the APA, Seller has no rights in or to the Marks (as defined in the Franchise Agreement), therefore, Seller has no authority to assign, sell, or license any rights in or to the Marks.</li>
            <li style="font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;"><u>WWFI Not a Party</u>. Notwithstanding anything to the contrary set forth in the APA, WWFI is not a party to the APA. Therefore, any statements made in the APA relating to WWFI’s rights or obligations  are void from the beginning and are of no force or effect.</li>
          </ol>
        </div></td>
    </tr>
  </table>
  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="5">
          <tr>
            <td width="413" align="left" valign="bottom">Buyer:  
              
              <u>{{ $data['ad_getbuyerlegalname1_b'] ?? '' }}</u>
            
            </td>
            <td width="432" align="left" valign="bottom">Seller: 
              
              <u>{{ $data['ad_getsellerlegalname1_a'] ?? '' }}</u>

              
            </td>
          </tr>
          <tr>
            <td align="left" valign="bottom" style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">By: ___________________________________</td>
            <td align="left" valign="bottom" style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">By: ___________________________________</td>
          </tr>
          <tr>
            <td align="left" valign="bottom" style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">Date: ___________________________________</td>
            <td align="left" valign="bottom" style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">Date: ___________________________________</td>
          </tr>
      </table> 

      @endif
</body>
</html>