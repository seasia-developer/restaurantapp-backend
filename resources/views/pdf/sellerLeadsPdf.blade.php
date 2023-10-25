<?php
$img = url('public/assets/images/print_pdf/logo.jpg');
$logo = '<img src="'. $img .'" width="130"/>';
$page_start = '<page backtop="5mm" backbottom="5mm" backleft="10mm" backright="10mm">';
$page_header = '<page_header></page_header>';
$page_footer = '
<page_footer>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td  style="font-family:Arial, Helvetica, sans-serif; font-size:12px;color:#ccc;padding-left:638px;">v2_7_2015</td>
</tr>
</table>
</page_footer>
<page_footer>
<div style="font-family:Arial, Helvetica, sans-serif; font-size:12px;color:#ccc;" class="page_footer">[[page_cu]]/[[page_nb]]</div>
</page_footer>';
$gap_after_header = '';
$tbl_wrapper = '';
$tbl_wrapper_close = '';
$page_end = '</page>';
/******************************************************************/
// function print_val($array, $fld_name, $underline = true) {
//     $ret = '<u> n/a </u>';
//     if (isset($array[$fld_name]) && !empty($array[$fld_name])) {
//         $ret = ($underline) ? '<u>' . $array[$fld_name] . '</u>' : $array[$fld_name];
//     }
//     return $ret;
// }
?>
<!-- Page #1 -->
<!-- {{ $page_header . $gap_after_header . $tbl_wrapper }} -->
<table width="800" align="center" cellpadding="2" cellspacing="2">
  <tr>
    <td style="text-align:center"><a href="http://www.wesellrestaurants.com/"><img src="{{ url('/assets/images/print_pdf/logo.jpg') }}" width="130"/></a></td>
  </tr>
  <tr>
    <td height="38" align="center" valign="middle" style=" font-family:Arial, Helvetica, sans-serif; font-size:16px; text-decoration:underline;"><strong>EXCLUSIVE LISTING AGREEMENT </strong></td>
  </tr>
</table>
<table width="800" align="center" cellpadding="2" cellspacing="2">
  <tr>
    <td colspan="3" style=" font-family:Arial, Helvetica, sans-serif; font-size:16px; text-decoration:underline; font-weight:bold;">Seller</td>
  </tr>
  <tr>
    <td width="40" style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;">-</td>
    <td colspan="2">Legal name of selling business <strong>("Seller"):</strong> cool</td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;" valign="top"  nowrap="nowrap">-</td>
    <td colspan="2">Trade name of selling business <strong>("Trade Name"):</strong> cool</td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;" valign="top"  nowrap="nowrap">-</td>
    <td width="322" valign="top"  nowrap="nowrap">All owners of Seller <strong>("Principal" or "Principals"):</strong></td>
    <td width="424" align="left"><table border="0" cellspacing="2" cellpadding="2" align="left">
        <tr>
          <td>(1) cool</td>
          <td>(2) cool</td>
        </tr>
        <tr>
          <td>(3) cool</td>
          <td>(4) cool</td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;" valign="top"  nowrap="nowrap">-</td>
    <td colspan="2">Address for Notice to Seller and Principal(s): (street) cool</td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;" valign="top"  nowrap="nowrap">-</td>
    <td colspan="2" style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;">(City, State, Zip) cool (Telephone) cool (E-mail) cool</td>
  </tr>
</table>

<table width="800" align="center" cellpadding="2" cellspacing="2">
  <tr>
    <td colspan="2" style=" font-family:Arial, Helvetica, sans-serif; font-size:16px; text-decoration:underline; font-weight:bold;">Listing Broker:</td>
  </tr>
  <tr>
    <td width="40" style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;">-</td>
    <td width="743" style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;">Seller's broker representative <strong> ("Listing Broker"): </strong> cool</td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;" valign="top"  nowrap="nowrap">-</td>
    <td style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;"> listing Broker's affiliated licensee <strong>('Agent'): </strong> cool</td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;" valign="top"  nowrap="nowrap">-</td>
    <td style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;"> Address for notice to listing broker<strong>('Street'): </strong> cool</td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;" valign="top"  nowrap="nowrap">-</td>
    <td style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;">(City, State, Zip) cool (Fax) cool <br>(E-mail) cool</td>
  </tr>
</table>
<table width="800" align="center" cellpadding="2" cellspacing="2">
  <tr>
    <td colspan="2" style=" font-family:Arial, Helvetica, sans-serif; font-size:16px; text-decoration:underline; font-weight:bold;">Listing Information :</td>
  </tr>
  <tr>
    <td width="40" style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;">-</td>
    <td style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;"> Description of Seller's business (the <strong>'Business'</strong> or the <strong>'Property' </strong>) cool</td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;" valign="top"  nowrap="nowrap">-</td>
    <td style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;"> Address of Business <strong>("Premises"): </strong> cool</td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;" valign="top"  nowrap="nowrap">-</td>
    <td style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;"> Term of Agreement <strong>("Listing Period"): From </strong> cool To : cool</td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;" valign="top"  nowrap="nowrap">-</td>
    <td style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;"> Initial offering price <strong>("Listing Price"): $ </strong> cool</td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;" valign="top"  nowrap="nowrap">-</td>
    <td style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;"> Commission due Listing Broker <strong>("Commission")</strong>: the greater of cool %  of the Sales Price or $ cool .</td>
  </tr>
</table>
   
   <table width="800"  align="center" cellpadding="2" cellspacing="2">
    <tr>
        <td>
            <table  width="400"  cellpadding="2" cellspacing="2">
                <tr>
                    <td style=" font-family:Arial, Helvetica, sans-serif; font-size:16px; text-decoration:underline; font-weight:bold;">Listing Broker :</td>
                </tr>
                <tr>
                    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;">
                       cool
                    </td>
                </tr>
                <tr>
                 <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif"> Name Listing Broker</td>
                </tr>
                   
                 <tr>
                    <td>Georgia Real Estate License Number</td>
                </tr>
                <tr>
                    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;">
                      cool
                    </td>
                </tr>
            
                <tr>
                    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:left;">By : ______________________________________</td>
                </tr>
                <tr>
                    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif">Signature of Broker or Agent</td>  
                </tr>       
                <tr>
                    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;">
                       cool
                    </td>
                </tr>
                <tr>
                     <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif"> Print or Type Name</td>
                </tr>
                 <tr>
                    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:left;">_________________________________________</td>
                </tr>
                <tr>
                    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif;" valign="top" nowrap="nowrap"> Listing Agent </td>
                </tr>
                <tr>
                        <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:left;">_________________________________________</td>
                </tr>
               
                <tr>
                    <td>Georgia Real Estate License Number</td>
                </tr>
                <tr>
                    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;">
                       cool
                    </td>
                </tr>
            </table>
        </td>
        <td>
            <table  width="400" cellpadding="2" cellspacing="2">
                <tr>
                    <td colspan="2" style=" font-family:Arial, Helvetica, sans-serif; font-size:16px; text-decoration:underline; font-weight:bold;">SELLER: </td>   
                </tr>
                 <tr>
                    <td style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;">
                        cool
                    </td>
                </tr>
                <tr>    
                    <td style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;">Print Name and Title</td>
                </tr>
                <tr>
                    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:left;">By : ____________________________________</td>
                </tr>
                <tr>    
                    <td style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;">Signature of Authorized Agent of Seller </td>
                </tr>
                 <tr>
                    <td style="font-weight:bold; text-decoration:underline;">Principal</td>
                </tr>
                <tr>
                    <td>
                        <table width="100%" border="0" cellpadding="2" cellspacing="2">
                            <tr>
                                <td nowrap="nowrap">
                                   cool
                                </td>
                                <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:left;">_______________</td>
                            </tr>
                            <tr>
                                <td nowrap="nowrap">Print Name </td>
                                <td>Signature</td>
                            </tr>
                            <tr>
                                <td nowrap="nowrap">
                                  cool
                                </td>
                                <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:left;">_______________</td>
                            </tr>
                            <tr>
                                <td nowrap="nowrap">Print Name </td>
                                <td>Signature</td>
                            </tr>
                            <tr>
                                <td nowrap="nowrap">
                                   cool
                                </td>
                                <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:left;">_______________</td>
                            </tr>
                            <tr>
                                <td nowrap="nowrap">Print Name </td>
                                <td>Signature</td>
                            </tr>
                            <tr>
                                <td nowrap="nowrap">
                                   cool
                                </td>
                                <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:left;">_______________</td>
                            </tr>
                            <tr>
                                <td nowrap="nowrap">Print Name </td>
                                <td>Signature</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>   
    </tr>
</table>    

<table width="800" align="center"  cellpadding="2" cellspacing="2">
  <tr>
    <td style=" font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;">IT IS HEREBY AGREED THAT:</td>
  </tr>
  <tr>
    <td  style=" font-family:Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;">1. <span style="text-decoration:underline; font-weight:bold;">Exclusive Listing Agreement: </span>Seller hereby grants to Broker the exclusive right and privilege to show and offer for sale the Business</td>
  </tr>
  <tr>
    <td  style=" font-family:Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;">2. <span style="text-decoration:underline; font-weight:bold;">Independent Contractor Relationship. </span>This Agreement shall create an independent contractor relationship between Broker and Seller. Broker shall at no time be considered an employee of Seller. Seller acknowledges that the Agent affiliated with Broker is an independent contractor of Broker, and is not Broker's employee.</td>
  </tr>
  <tr>
    <td  style=" font-family:Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;">3. <span style="text-decoration:underline; font-weight:bold;">Broker's Duties to Seller </span> Broker's sole duties to Seller shall be to:</td>
  </tr>
  <tr>
    <td  style=" font-family:Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;"><span style="font-weight:bold;"> A.</span> Use Broker's best efforts to procure a buyer ready, willing, and able to purchase Property at a sales price of at least the Listing Price (which amount includes the commission) or any other price acceptable to Seller;</td>
  </tr>

</table>
{{ $tbl_wrapper_close . $page_footer . $page_end }} 

<!-- Page #2 --> 
{{  $page_start . $page_header . $gap_after_header . $tbl_wrapper }}
<table width="800" align="center" cellpadding="2" cellspacing="2">
  <tr>
    <td  colspan="2" style=" font-family:Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;"><span style="font-weight:bold;"> B.</span> Assist to the extent requested by Seller, in negotiating the terms of and filling out a pre-printed business sale agreement; and</td>
  </tr>
  <tr>
    <td  colspan="2" style=" font-family:Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;"><span style="font-weight:bold;"> C.</span> Comply with all applicable cool ?> state laws in the performance of its duties hereunder 
    <span>including the Brokerage Relationships in Real Estate Transaction Act, 
        O.C.G.A. § 10-6A-1 et. seq. </span>
  </td>
  </tr>
 
  <tr>
    <td colspan="2" style=" font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;"><strong> 4.</strong> <span style="font-weight:bold; text-decoration:underline;">Seller's Duties.</span> Seller represents that Seller:</td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;" valign="top"  nowrap="nowrap">A.</td>
    <td  style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;">presently owns the Business or has full authority to enter into this Agreement;  </td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;" valign="top"  nowrap="nowrap">B.</td>
    <td  style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;"> will cooperate with Broker to sell Property to prospective buyers and will refer all inquiries concerning the sale of Property to the Broker during the term of this agreement;</td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;" valign="top"  nowrap="nowrap">C.</td>
    <td  style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;"> will make Property available for showing at reasonable times as requested by Broker;</td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;" valign="top"  nowrap="nowrap">D.</td>
    <td  style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;"> will provide Broker with accurate information regarding the Business (including information concerning all adverse material facts pertaining to the Business);</td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;" valign="top"  nowrap="nowrap">E.</td>
    <td  style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;"> will fully comply with all state and federal laws; and</td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;" valign="top"  nowrap="nowrap">F.</td>
    <td  style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;"> will promptly provide Broker with the Due Diligence materials upon request </td>
  </tr>
</table>
<br />

<table width="800" align="center" cellpadding="2" cellspacing="2">
  <tr>
    <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;"><strong>5 .</strong> <span style="font-weight:bold; text-decoration:underline;">Marketing.</span> Broker may advertise Business for sale in all media without specifically identifiable information.  Seller agrees not to place any advertisements on the Premises or to advertise Business or Premises for lease in any media except with the prior written consent of Broker.  Broker is authorized to procure buyers to purchase Property in cooperation with other business brokers and intermediaries.  Broker may distribute listing and sales information (including the sales price) to them, and said cooperating brokers and may with permission of Broker (which permission may be granted or denied in the sole discretion of Broker) republish such information on their Internet web sites.  Broker and other business brokers and intermediaries may only show Property with the prior approval of Seller.</td>
  </tr>
</table>
<table width="800" align="center" cellpadding="2" cellspacing="2">
<tr>
    <td colspan="2" style=" font-family:Arial, Helvetica, sans-serif; font-size:14px;"><strong>6 .</strong> <span style="font-weight:bold; text-decoration:underline;">Commission. </span></td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;" valign="top"  nowrap="nowrap">A.</td>
    <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;"><strong> Sales Price </strong> The sales price of the Business (<span  style="font-weight:bold">"Sales Price"</span>) is equal to (i) the total price to be paid by any buyer or purchaser at the closing of the sale, lease, trade, merger, share exchange, asset purchase, consolidation, re-organization, consummation of a management agreement, or other transfer of control or disposition of the Business or its assets (generally, any <span  style="font-weight:bold">"Sale"</span>), whether in the form of cash, seller financing or other consideration, plus (+) (ii) the present value of all future, contingent or undetermined amounts, such as an earn-out periodic payment. </td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;" valign="top"  nowrap="nowrap">B.</td>
    <td  style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;"><strong> Payment of Commission. </strong> Seller agrees that: </td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify;" valign="top"  nowrap="nowrap">(i)</td>
    <td  style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;"> Upon any Sale to any buyer or third party during the Listing Period (whether introduced to Seller by Broker or through the efforts of Seller or a third party), Seller shall pay at closing to Broker the full Commission based on the Sales Price; </td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify;" valign="top"  nowrap="nowrap">(ii)</td>
    <td  style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;">During the one (1) year period after the end of the Listing Period, Seller shall pay to Broker a Commission at closing based on the Sales Price upon any Sale to any buyer or third party who became aware of the Business during the Listing Period or otherwise through the efforts of Broker (such person or entity referred to herein as a <span style="font-weight:blod">"Buyer Obtained During Listing Period"</span>); </td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify;" valign="top"  nowrap="nowrap">(iii)</td>
    <td  style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;">    If, during the Listing Period, Seller rejects any offer from a ready willing and able buyer at full listing price;</td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify;" valign="top"  nowrap="nowrap">(iv)</td>
    <td  style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;">    If, during the Listing Period, Seller provides false or materially incorrect financial information to the Broker commission is due based on the Listing Price;</td>
  </tr>
  <tr>
      <td width="127" style="font-size:15px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold">(v)</td>
      <td colspan="2" style=" font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">If, during the Listing Period, Seller enters into an employment agreement, management agreement, consulting agreement, contract, subcontract, joint venture, partnership or shareholder arrangement with any Buyer Obtained During Listing Period, the Seller shall pay immediately to Broker a Commission based on the Listing Price; and</td>
    </tr>
    <tr>
      <td width="127" style="font-size:15px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold">(vi)</td>
      <td colspan="2" style=" font-family:Arial, Helvetica, sans-serif; font-size:14px; text-align:justify;">If Seller enters into an agreement for the Sale of the Business, and breaches such Sale agreement, then Seller shall pay Broker the commission based on the Listing Price.</td>
    </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;" valign="top"  nowrap="nowrap">C.</td>
    <td  style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;"><strong> Payment of Commission to Cooperating Broker. </strong> During the term of the Listing Agreement, Broker shall share Commission with a cooperating broker, if any, who procures the buyer of Business by paying such cooperating broker a share of the Commission. Cooperating brokers are expressly intended to be third-party beneficiaries under this Agreement.</td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;" valign="top"  nowrap="nowrap">D.</td>
    <td  style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;"><strong>Survival.</strong> The obligation to pay Commissions set forth herein shall survive the termination of this Agreement </td>
  </tr>

</table>
{{ $tbl_wrapper_close . $page_footer . $page_end }}

<?php echo $page_start . $page_header . $gap_after_header . $tbl_wrapper; ?>
<table width="800" align="center" cellpadding="2" cellspacing="2">  
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;" valign="top"  nowrap="nowrap">7.</td>
    <td  style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;"><strong >Collection.</strong> In the event that Seller defaults, or otherwise fails to pay any Commission to Broker, when due under this Agreement, Broker shall reserve the right to file a lawsuit, pursue collections or any other resource to recover the unpaid amounts. Any fees or expenses associated with collecting any unpaid amounts, including but not limited to, any and all attorney’s fees shall be the responsibility of the Seller. </td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;" valign="top"  nowrap="nowrap">8.</td>
    <td  style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;"><strong style="text-decoration:underline;">Limits on Broker’s Authority and Responsibility</strong> Seller acknowledges and agrees that Broker: </td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;" valign="top"  nowrap="nowrap">A.</td>
    <td  style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;">may show other businesses to prospective buyers who are interested in the Business;</td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;" valign="top"  nowrap="nowrap">B.</td>
    <td  style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;">B.  shall not be responsible to advise Seller on any matter including but not limited to the following:  any matter which could have been revealed through a survey, title search or inspection of the Business or Premises; the condition of Property, any portion thereof, or any item therein; building products and construction techniques; the necessity or cost of any repairs to the Premises; mold; hazardous or toxic materials or substances; termites and other wood destroying organisms; the tax or legal consequences of this transaction; the availability and cost of utilities or community amenities; the appraised or future value of Premises or Business; any legal or accounting issues; any condition(s) existing off Premises which may affect the Business or Premises; the terms, conditions and availability of financing; and the uses and zoning of Property whether permitted or proposed. Seller acknowledges that Broker is not an expert with respect to the above matters and that, if any of these matters or any other matters are of concern to them, they should seek independent expert advice relative thereto.  Seller acknowledges that Broker shall not be responsible to monitor or supervise any portion of any construction or repairs to Premises or fixtures and that such tasks clearly fall outside the scope of business brokerage services;</td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;" valign="top"  nowrap="nowrap">C.</td>
    <td  style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;">shall owe no duties to Seller nor have any authority to act on behalf of Seller other than what is set forth in this Agreement; </td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;" valign="top"  nowrap="nowrap">D.</td>
    <td  style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;">may make all disclosures required by law; </td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;" valign="top"  nowrap="nowrap">E.</td>
    <td  style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;">may disclose all information about the Business to any other party who properly signs a confidentiality agreement. If the Business is a franchise then the Broker may disclose all information to the Franchisor and/or Franchisee;</td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;" valign="top"  nowrap="nowrap">F.</td>
    <td  style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;">shall, under no circumstances, have any liability greater than the amount of the commission paid hereunder to Broker (excluding any commission amount paid to a cooperating broker, if any);</td>
  </tr>  
</table>
<table width="800" align="center" cellpadding="2" cellspacing="2">
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;" valign="top"  nowrap="nowrap">G.</td>
    <td  style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;">and shall be held harmless from any and all claims, causes of action, or damages arising out of or relating to:</td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify;" valign="top"  nowrap="nowrap">(i)</td>
    <td  style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;"> inaccurate and/or incomplete information provided by Broker to a prospective buyer; </td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify;" valign="top"  nowrap="nowrap">(ii)</td>
    <td  style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;"> earnest money handled by anyone other than Broker; </td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify;" valign="top"  nowrap="nowrap">(iii)</td>
    <td  style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;"> any injury to persons on Premises and/or loss of or damage to Premises or anything contained therein; or </td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify;" valign="top"  nowrap="nowrap">(iv)</td>
    <td  style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;">any damage to Premises or to any business operated on Premises arising out or related to prospective buyers or their agents coming onto Premises for any purpose.</td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;" valign="top"  nowrap="nowrap">9.</td>
    <td  style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;"><strong style="text-decoration:underline;">Security Interest.</strong> For valued consideration, Seller hereby grants to Broker a security interest in all of Seller’s personal property to secure payment of Broker’s Commission and any early termination fee due under this Listing Agreement. Seller’s personal property includes, but is not limited to: (a) all of the assets, of any type, owned by Seller, (b) all materials, equipment, and furniture of every description or useful in the conduct of Seller’s Business, now or hereafter existing or acquired, and all parts, accessories now or hereafter affixed thereto if used in connection therewith, and all inventory of Seller of every description, whether now or hereafter existing or acquired (said materials, equipment, furniture and inventory hereinafter referred to as "Goods"); (iii) all accounts receivable and contract rights of Seller, whether now or hereafter existing or acquired, evidencing any obligation to Seller for the payment of Goods sold or leased or services rendered and all interest of Seller in any Goods the sale or lease of which shall have given or shall give rise to any of the foregoing (said accounts receivable and contract rights hereinafter collectively referred to as "Accounts"); (iv) intangibles of any nature, now or hereafter owned or acquired by Seller; (vi) together with all substitutions, replacements, additions and accessions thereto, and any proceeds of the foregoing (hereinafter referred to as "Collateral"). Seller hereby authorizes Broker to publicly record such UCC or other applicable financing statements as shall be required to publicly evidence the security interest created hereunder. In addition, Seller agrees from time to time, on request of Broker,to execute such financing statement and other documents and do such other acts and things, all as the Broker may request in order to establish and maintain a valid security title and interest in the Seller’s personal property</td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;" valign="top"  nowrap="nowrap">10.</td>
    <td style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;"><strong style="text-decoration:underline;">Extension. </strong> If during the term of this Agreement, Seller and a prospective buyer enter into an agreement which is not consummated for any reason whatsoever, then the original expiration date of this Agreement shall be extended for the number of days that Premises was under contract.</td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;" valign="top"  nowrap="nowrap">11.</td>
    <td style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;"><strong style="text-decoration:underline;">Disclosures.</strong></td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;" valign="top"  nowrap="nowrap">A.</td>
    <td style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;">Broker agrees to keep confidential all information that Seller asks to be kept confidential by express request or instruction unless the Seller permits such disclosure by subsequent word or conduct or such disclosure is required by law. </td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;" valign="top"  nowrap="nowrap">B.</td>
    <td style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;"> Broker may not knowingly give customers false information.</td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;" valign="top"  nowrap="nowrap">C.</td>
    <td style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;"> In the event of a conflict between Broker’s duty not to give customers false information and the duty to keep the confidences of Seller, the duty not to give customers false information shall prevail.</td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;" valign="top"  nowrap="nowrap">D.</td>
    <td style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;"> Unless specified below, Broker has no other known agency relationships with other parties that would conflict with any interests of Seller (except that Broker may represent other buyers, sellers, landlords, and tenants in buying, selling or leasing property). </td>
  </tr>
</table>
{{ $tbl_wrapper_close . $page_footer . $page_end }}

{{ $page_start . $page_header . $gap_after_header . $tbl_wrapper }}
<table width="800" align="center" cellpadding="2" cellspacing="2">  
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;" valign="top"  nowrap="nowrap">12 .</td>
    <td style="text-decoration:underline; font-weight:bold;">Disclosure of Potentially Fraudulent Activities. </td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;" valign="top"  nowrap="nowrap">A.</td>
    <td style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;">To help prevent fraud in real estate transactions, Seller does hereby give Broker permission to report any suspicious, unusual and/or potentially illegal or fraudulent activity (including but not limited to mortgage fraud) to: </td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify;" valign="top">(i)</td>
    <td style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;">Governmental officials, agencies and/or authorities; and/or </td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify;" valign="top">(ii)</td>
    <td style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;">Any lender, mortgage insurer, mortgage investor and/or title insurance company which could potentially be harmed if the activity was in fact fraudulent or illegal.</td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;" valign="top"  nowrap="nowrap">B.</td>
    <td style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;">Seller acknowledges that Broker does not have special expertise with respect to detecting fraud in real estate transactions. Therefore, Seller acknowledges that: </td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify;" valign="top">(i)</td>
    <td style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;">Activities which are fraudulent or illegal may be undetected by Broker and </td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify;" valign="top">(ii)</td>
    <td style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;">Activities which are lawful and/or routine may be reported by Broker as being suspicious, unusual or potentially illegal or fraudulent </td>
  </tr>
</table>
<table width="800" align="center" cellpadding="2" cellspacing="2">
 
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;" valign="top"  nowrap="nowrap">13.</td>
    <td style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;"><strong>Georgia Broker’s Policy on Agency. </strong> It is the Broker’s Policy to act as a "Dual Agent" when Broker represents both Seller and a prospective Buyer. As such, Seller is aware that Broker may act as a dual agent in its representation of Seller, and Seller consents to the same. Seller has been advised that:</td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify;">(i)</td>
    <td style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;">In serving as a dual agent, Broker is representing two clients whose interests are or at times could be different or even adverse;</td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify;">(ii)</td>
    <td style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;">Broker will disclose all adverse, material facts relevant to the transaction and actually known to the dual agent to all parties in the transaction except for information made confidential by request or instructions from either client which is not otherwise required to be disclosed by law; </td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify;">(iii)</td>
    <td style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;">Seller does not have to consent to dual agency and, the consent of Seller to dual agency has been given voluntarily and Seller has read and understands the brokerage engagement agreement. </td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify;">(iv)</td>
    <td style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;">Notwithstanding any provision to the contrary contained herein, Seller hereby directs Broker, while acting as a dual agent, to keep confidential and not reveal to the other party any information which could materially and adversely affect their negotiating position. </td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify;">(v)</td>
    <td style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;">Broker or Broker’s affiliated licensees will timely disclose to each client the nature of any material relationship with other clients other than that incidental to the transaction. A material relationship shall mean any actually known personal, familial, or business relationship between Broker and a client which would impair the ability of Broker to exercise fair and independent judgment relative to another client. The other party whom Broker may represent in the event of dual agency may or may not be identified at the time Seller enters into this Agreement. If any party is identified after the Agreement and has a material relationship with Broker, then Broker shall timely provide to Seller a disclosure of the nature of such relationship. </td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;" valign="top"  nowrap="nowrap">14</td>
    <td style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;"><strong style="text-decoration:underline;">Earnest Money. </strong>Broker shall be entitled on 50% of all earnest money or other amounts deposited in escrow by a prospective buyer (or the full amount of the Commission, if less than such amount) if such is surrendered to Seller because such prospective buyer failed to close on the purchase of the Business or otherwise breached any agreement with Seller. </td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;" valign="top"  nowrap="nowrap">15</td>
    <td style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;"><strong style="text-decoration:underline;">Early Termination. </strong>Broker or Seller shall have the right to terminate this Agreement at any time by giving the other party written notice; how-ever, such a termination shall not limit Broker’s right to collect any Commission earned or owing as of the date of termination or to which Broker is entitled to collect herein after the termination of this Agreement.  It is expressly agreed that such rights shall survive the termination of this Agreement.  Additionally, if Seller completes any Sale during the Listing Period, shall close, dissolve or otherwise cease to operate the Business or otherwise take any action to terminate this Agreement for any reason other than uncured material breach of its provisions by Broker, then Seller shall pay to Broker $1000.00 for each month or partial month this Agreement was in effect.  This fee is intended to provide a reasonable compensation to Broker for the time, effort and cost Broker has expended in performing under this Agreement (which cost and effort is difficult to determine) and is not intended nor shall be construed as a penalty.</td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;" valign="top"  nowrap="nowrap">15</td>
    <td style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;"><strong style="text-decoration:underline;">Indemnification. </strong> Seller hereby acknowledges that the Listing Broker, We Sell Restaurants, Inc., Eric Gagnon, Robin Gagnon, their representatives, employees , agents and affiliates ("the Broker Indemnified Parties") shall not provide any advice, promises, inducements, representations, commitments, guarantees, or opinions of any kind, either verbally or in writing, in regards to any aspect of the transaction contemplated by this Agreement. Seller further understands that the Broker Indemnified Parties shall, at all times, during the course of this Agreement, rely entirely upon the representations and accuracy of the information provided to them by Seller. The Broker Indemnified Parties highly recommend that Seller hire its own attorney. Seller indemnifies, releases and holds the Broker Indemnified Parties harmless against any liability involved in the transaction and listing contemplated by this Agreement.  In the event that Seller makes any false representations to the Broker Indemnified Parties, provides the Broker Indemnified Parties with any inaccurate or falsified information or makes any other similar misrepresentation to the Broker Indemnified Parties, Seller will indemnify the Broker Indemnified Parties against damages, claims, suits or liability arising to the Broker Indemnified Parties as a result of such misrepresentation, including but not limited to, the reasonable cost of defense in any such claim or suit and for any attorney’s fees that arise as a result of such defense.  The Broker Indemnified Parties’ role in the transaction contemplated by this Agreement is to obtain a meeting of the minds between Seller and a potential buyer based on information provided to the Broker Indemnified Parties by the Seller. </td>
  </tr>
  <tr>
    <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;" valign="top"  nowrap="nowrap">16</td>
    <td style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;"><strong style="text-decoration:underline;">Severability. </strong> The invalidity or unenforceability of a provision herein shall not affect the remaining provisions of the Agreement. If a provision is deemed invalid or unenforceable then the remaining provisions of the Agreement are to remain in full force and effect and it is the intent of the parties that the Agreement be construed in all respects as if such invalid or unenforceable provision was omitted.</td>
  </tr>
 
</table>
{{ $tbl_wrapper_close . $page_footer . $page_end }}

{{ $page_start . $page_header . $gap_after_header . $tbl_wrapper }}
<table width="800" align="center" cellpadding="2" cellspacing="2">  
  <tr>
  <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;" valign="top"  nowrap="nowrap">18</td>
      <td style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify"><strong>    <span style="text-decoration:underline; font-weight:bold">Guaranty.</span> </strong>The undersigned Principal(s) guarantee all obligations of Seller under this Agreement, including the payment of commissions or termination fees, when due and at the place specified therefore.  Upon any default by Seller of this Agreement or of any payment due hereunder, the undersigned Principal(s) will promptly pay or cause to be paid to Broker, the amount to which Seller is then-obligated.  The obligations of the un-dersigned Principal(s) are independent of the obligations of the Seller, and a separate action or actions may be brought and prosecuted against the undersigned Principal(s), whether or not action is brought against the Seller.</td>
  </tr>
  <tr>
      <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;" valign="top"  nowrap="nowrap">19</td>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify"><strong> <span style="text-decoration:underline; font-weight:bold">Counterparts. </span></strong>.  This Agreement may be executed by electronic transmission of signature pages and in one or more counterparts, each of which shall be deemed an original, but all of which together shall constitute one and the same instrument.</td>
    </tr>
    <tr>
      <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;" valign="top"  nowrap="nowrap">22</td>
      <td style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify"><strong>    <span style="text-decoration:underline; font-weight:bold">Attorneys Fees.</span> </strong>The prevailing Party in any action, claim or law suit brought pursuant to this Agreement is entitled to payment of all reasonable attorney fees and costs expended by such prevailing Party in association with such action, claim or law suit.</td>
    </tr>
    <tr>
      <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;" valign="top"  nowrap="nowrap">22</td>
      <td style=" font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify"><strong>    <span style="text-decoration:underline; font-weight:bold">Arbitration </span></strong>The parties shall settle any controversy arising out of this Agreement by arbitration in accordance with the Commercial Arbitration Rules of the American Arbitration Association or similar rules of any other arbitration provider agreed to by the parties. A single arbitrator shall be agreed upon by the parties or, if the parties cannot agree upon an arbitrator within twenty (20) days within the filing and service of the demand for arbitration, then the parties agree that a single arbitrator shall be appointed by the American Arbitration Association or the arbitration provider agreed to by the parties. The arbitration shall occur within 50 miles of the Listing Agent office location. The non-prevailing party shall pay all costs of arbitration and the attorneys’ fees of the prevailing party, and the parties shall request the arbitrator to include such provisions in the award. The award of the arbitrator shall be binding and may be entered as a judgment in any court of competent jurisdiction.</td>
    </tr>
    <tr>
      <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;" valign="top"  nowrap="nowrap">22</td>
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify"><strong> <span style="text-decoration:underline; font-weight:bold">Governing Law, Jurisdiction and Venue. </span></strong> This Agreement shall be interpreted and governed by the laws of the State of  cool.  The parties hereby consent to the exclusive jurisdiction of the Courts located in cool. County, In the event an action is brought by any party under this Agreement to enforce any of its terms, it is agreed that the prevailing party shall be entitled to recover its reasonable attorneys' fees and costs, in addition to any compensatory damages award.</td>
    </tr>
    <tr>
      <td style="font-size:14px; font-family:Arial, Helvetica, sans-serif; text-align:justify; font-weight:bold;" valign="top"  nowrap="nowrap">22</td>
      <td  style="font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify"><strong>    <span style="text-decoration:underline; font-weight:bold">Merger.</span> </strong> This Agreement sets forth all the premises, covenants, agreements and conditions between the parties with respect to the subject matter hereof and this Agreement shall supersede all prior and contemporaneous agreements and understandings, inducements or conditions, express or implied, oral, written or otherwise, except as set forth in this Agreement. </td>
    </tr>
 </table> 
{{ $tbl_wrapper_close . $page_footer . $page_end }}