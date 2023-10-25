<style>
.footer {
    position: fixed;
    bottom: 30px;
    left: 0px;
    right: 0px;
    min-height: 50px;
    padding: 0px 40px;
}

html {
    padding: 0;
    margin: 0;
}

body {
    background-image: url('assets/images/print_pdf/wsr-body.png');
    background-repeat: no-repeat;
    background-size: cover;
    padding: 40px;
    position: relative;
}

@import url('https://fonts.googleapis.com/css2?family=Arimo:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap');

* {
    font-family: 'Arimo', sans-serif !important;
}
</style>
<?php
use App\Http\Controllers\Api\Listing\ListingBatController;
use App\Http\Controllers\Api\Listing\ListingController;
    $listMap = new ListingController();
    $batMap = new ListingBatController();
    $grossSales = 0;
    $totalCOGS = 0;
    $grossMargin = 0;
    $totalExpenses = 0;
    $netIncome = 0;
    $totalAddBacks = 0;
    $ownerBenefit = 0;
    $totalCOGS1 = 0;
    $grossMargin1 = 0;
    $netIncome1 = 0;
    $totalExpenses1 = 0;
    $totalAddBacks1 = 0;
    $ownerBenefit1 = 0;
    
    $foodCosts = 0;
    $alcohalCosts = 0;
    $otherCogs = 0;
    $advertising = 0;
    $auto = 0;
    $bankCharges = 0;
    $advertising = 0;
    $creditCardFees = 0;
    $depreciation = 0;
    $duesSubscriptions = 0;
    $insurance = 0;
    $interestExpense = 0;
    $legal = 0;
    $licensesFees = 0;
    $miscellaneous = 0;
    $payrollTaxes = 0;
    $postageDelivery = 0;
    $ownerPersonalExpenses = 0;
    $rent = 0;
    $repairsMaintenance = 0;
    $restaurantSupplies = 0;
    $royalties = 0;
    $salariesWages = 0;
    $telephone = 0;
    $utilities = 0;
    $uniforms = 0;
    $otherUncategorized = 0;
    $officeSupplies = 0;
    $janitorial = 0;
    $equipmentlease = 0;
    $donations = 0;
    $filledfieldvalue = 0;

    $gross_sales = 0;
    $grossSales_2 = 0;
    
    foreach ($result as $val) {
    }
    
    if (isset($agentDetails)) {
        foreach ($agentDetails as $agent) {
        }
    }
    
    if (isset($sub_img)) {
        foreach ($sub_img as $val_sub_img) {
        }
    }
    
    if (isset($val->foodCosts)) {
        $foodCosts = $val->foodCosts;
    }
    if (isset($val->alcohalCosts)) {
        $alcohalCosts = $val->alcohalCosts;
    }
    if (isset($val->otherCogs)) {
        $otherCogs = $val->otherCogs;
    }
    
    if (isset($val->advertising)) {
        $advertising = $val->advertising;
    }
    if (isset($val->auto)) {
        $auto = $val->auto;
    }
    if (isset($val->bankCharges)) {
        $bankCharges = $val->bankCharges;
    }
    if (isset($val->depreciation)) {
        $depreciation = $val->depreciation;
    }
    if (isset($val->duesSubscriptions)) {
        $duesSubscriptions = $val->duesSubscriptions;
    }
    if (isset($val->insurance)) {
        $insurance = $val->insurance;
    }
    if (isset($val->interestExpense)) {
        $interestExpense = $val->interestExpense;
    }
    if (isset($val->legal)) {
        $legal = $val->legal;
    }
    if (isset($val->licensesFees)) {
        $licensesFees = $val->licensesFees;
    }
    if (isset($val->miscellaneous)) {
        $miscellaneous = $val->miscellaneous;
    }
    if (isset($val->payrollTaxes)) {
        $payrollTaxes = $val->payrollTaxes;
    }
    if (isset($val->postageDelivery)) {
        $postageDelivery = $val->postageDelivery;
    }
    if (isset($val->ownerPersonalExpenses)) {
        $ownerPersonalExpenses = $val->ownerPersonalExpenses;
    }
    if (isset($val->rent)) {
        $rent = $val->rent;
    }
    if (isset($val->repairsMaintenance)) {
        $repairsMaintenance = $val->repairsMaintenance;
    }
    if (isset($val->restaurantSupplies)) {
        $restaurantSupplies = $val->restaurantSupplies;
    }
    if (isset($val->royalties)) {
        $royalties = $val->royalties;
    }
    if (isset($val->salariesWages)) {
        $salariesWages = $val->salariesWages;
    }
    if (isset($val->telephone)) {
        $telephone = $val->telephone;
    }
    if (isset($val->utilities)) {
        $utilities = $val->utilities;
    }
    if (isset($val->uniforms)) {
        $uniforms = $val->uniforms;
    }
    if (isset($val->otherUncategorized)) {
        $otherUncategorized = $val->otherUncategorized;
    }
    if (isset($val->officeSupplies)) {
        $officeSupplies = $val->officeSupplies;
    }
    if (isset($val->janitorial)) {
        $janitorial = $val->janitorial;
    }
    if (isset($val->equipmentlease)) {
        $equipmentlease = $val->equipmentlease;
    }
    if (isset($val->donations)) {
        $donations = $val->donations;
    }
    if (isset($val->filledfieldvalue)) {
        $filledfieldvalue = $val->filledfieldvalue;
    }
    
    if (isset($val->grossSales)) {
        if ((int)$val->grossSales > 0) {
    
            $totalCOGS = $batMap->getTotalCOGS($foodCosts, $alcohalCosts, $otherCogs);
    
            $grossMargin = $batMap->getGrossMargin($val->grossSales, $totalCOGS);
    
            $totalExpenses = $batMap->getTotalExpenses($advertising, $auto, $bankCharges, $creditCardFees, $depreciation, $duesSubscriptions, $insurance, $interestExpense, $legal, $licensesFees, $miscellaneous, $payrollTaxes, $postageDelivery, $ownerPersonalExpenses, $rent, $repairsMaintenance, $restaurantSupplies, $royalties, $salariesWages, $telephone, $utilities, $uniforms, $otherUncategorized, $officeSupplies, $janitorial, $equipmentlease, $donations, $filledfieldvalue);
    
            $netIncome = $batMap->getNetIncome($grossMargin, $totalExpenses);
    
            $totalAddBacks = $batMap->getTotalAddBacks($val->ownerSalary, $val->benefits, $val->interestExpense, $val->depreciation, $val->ownerPersonalExpenses, $val->other);
    
            $ownerBenefit = $batMap->getOwnerBenefit($netIncome, $totalAddBacks);
    
            $gross_sales = $val->grossSales;
        }
    } else {
        $gross_sales = 0;
    }
    if (isset($val->grossSales_2)) {
        if ((int)$val->grossSales_2 > 0) {
            $grossSales1 = $val->grossSales_2;
    
            $totalCOGS1 = $batMap->getTotalCOGS($val->foodCosts_2, $val->alcohalCosts_2, $val->otherCogs_2);
    
            $grossMargin1 = $batMap->getGrossMargin($grossSales1, $totalCOGS1);
    
            $totalExpenses1 = $batMap->getTotalExpenses($val->advertising_2, $val->auto_2, $val->bankCharges_2, $val->creditCardFees_2, $val->depreciation_3, $val->duesSubscriptions_2, $val->insurance_2, $val->interestExpense_3, $val->legal_2, $val->licensesFees_2, $val->miscellaneous_2, $val->payrollTaxes_2, $val->postageDelivery_2, $val->interestExpense_3, $val->rent_2, $val->repairsMaintenance_2, $val->restaurantSupplies_2, $val->royalties_2, $val->salariesWages_2, $val->telephone_2, $val->utilities_2, $val->uniforms_2, $val->otherUncategorized_2, $val->officeSupplies_2, $val->janitorial_2, $val->equipmentlease_2, $val->donations_2, $val->filledfieldvalue_2);
    
            $netIncome1 = $batMap->getNetIncome($grossMargin1, $totalExpenses1);
    
            $totalAddBacks1 = $batMap->getTotalAddBacks($val->ownerSalary_2, $val->benefits_2, $val->interestExpense_4, $val->depreciation_4, $val->ownerPersonalExpenses_4, $val->other_2);
    
            $ownerBenefit1 = $batMap->getOwnerBenefit($netIncome1, $totalAddBacks1);
    
            $gross_sales1 = $val->grossSales_2;
        }
    } else {
        $grossSales_2 = 0;
    }

    $equipmentlist = '';
    $equi_text1 = '';
    $equi_text2 = '';
    
    if($val->equiptext != ''){
        $equiptext = $val->equiptext;
        $equipment_arr = explode("\\n", $equiptext);
        $total_eqp = count($equipment_arr);
        if($total_eqp > 75){
            $text1 = array_slice($equipment_arr,0,75); // break array into 0 to 31 chunks
            $text_half = array_chunk($text1, ceil(count($text1)/2));
            $text_half[1] = [];
            $equi_text1 = implode("\n",$text_half[0]);
	        $equi_text2 = implode("\n",$text_half[1]);
            $equipmentlist = '<table width="100%" border="0" cellspacing="0" cellpadding="0" nobr="true">
                <tr>
                    <td height="8"></td>
                </tr>
                <tr>
                    <td style="width: 49%" bgcolor="white">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" nobr="true">
                            <tr>
                                <td colpan="3" height="8"></td>
                            </tr>
                            <tr>
                                <td style="width: 2%"></td>
                                <td style="width: 48%; font-size: 13px; line-height: 17px; color: #000;">'.nl2br($equi_text1).'</td>
                                <td style="width: 2%"></td>
                            </tr>
                        </table>
                    </td>
                    <td style="width: 2%"> </td>
                    <td style="width: 49%" bgcolor="white">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" nobr="true">
                            <tr>
                                <td colpan="3" height="8"></td>
                            </tr>
                            <tr>
                                <td style="width: 2%"></td>
                                <td style="width: 48%; font-size: 13px; line-height: 17px; color: #000;">'.nl2br($equi_text2).'</td>
                                <td style="width: 2%"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="width: 49%; height: 8px;" bgcolor="white"></td>
                    <td style="width: 2%; height: 8px;"></td>
                    <td style="width: 49%; height: 8px;" bgcolor="white"></td>
                </tr>
            </table>';
        }
        if($total_eqp <= 75){
            $text1 = array_slice($equipment_arr,0,75); // break array into 0 to 31 chunks
            $text_half = array_chunk($text1, ceil(count($text1)/2));
            $text_half[1] = [];
            $equi_text1 = implode("\n",$text_half[0]);
            $equi_text2 = implode("\n",$text_half[1]);
            $equipmentlist = '
            <table width="100%" border="0" cellspacing="0" cellpadding="0" nobr="true">
                <tr>
                    <td colspan="3" height="8"></td>
                </tr>
                <tr>
                    <td style="width: 49%" bgcolor="white">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" nobr="true">
                            <tr>
                                <td colpan="3" height="8">
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 2%"></td>
                                <td style="width: 48%; font-size: 13px; line-height: 17px; color: #000;">'.nl2br($equi_text1).'</td>
                                <td style="width: 2%"></td>
                            </tr>
                        </table>
                    </td>
                    <td style="width: 2%"></td>
                    <td style="width: 49%" bgcolor="white">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" nobr="true">
                            <tr>
                                <td colpan="3" height="8">
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 2%"></td>
                                <td style="width: 48%; font-size: 13px; line-height: 17px; color: #000;">'.nl2br($equi_text2).'</td>
                                <td style="width: 2%"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="width: 49%; height: 8px;" bgcolor="white"></td>
                    <td style="width: 2%; height: 8px;"></td>
                    <td style="width: 49%; height: 8px;" bgcolor="white"></td>
                </tr>
            </table>';
        }
        if($total_eqp > 150){
            $text1 = array_slice($equipment_arr,150,75);
            $equi_text1 = implode("\n",$text1);
            $equipmentlist = '
                <table width="100%" border="0" cellspacing="0" cellpadding="0" nobr="true">
                    <tr>
                        <td style="width: 49%" bgcolor="white">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" nobr="true">
                                <tr>
                                    <td colpan="3" height="8"></td>
                                </tr>
                                <tr>
                                    <td style="width: 2%"></td>
                                    <td style="width: 48%; font-size: 13px; line-height: 17px; color: #000;">'.nl2br($equi_text1).'</td>
                                    <td style="width: 2%"></td>
                                </tr>
                            </table>
                        </td>
                        <td style="width: 2%"></td>
                        <td style="width: 49%" bgcolor="white">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" nobr="true">
                                <tr>
                                    <td colpan="3" height="8"></td>
                                </tr>
                                <tr>
                                    <td style="width: 2%"></td>
                                    <td style="width: 48%; font-size: 13px; line-height: 17px; color: #000;">'.nl2br($equi_text1).'</td>
                                    <td style="width: 2%"></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 49%; height: 8px;" bgcolor="white"></td>
                        <td style="width: 2%; height: 8px;"></td>
                        <td style="width: 49%; height: 8px;" bgcolor="white"></td>
                    </tr>
                </table>
            ';
        }
        if($total_eqp > 225){
            $text1 = array_slice($equipment_arr,225,75);
            $text_half = array_chunk($text1, ceil(count($text1)/2));
            $text_half[1] = [];
            $equi_text1 = implode("\n",$text_half[0]);
            $equi_text2 = implode("\n",$text_half[1]);
            $equipmentlist = '<table width="100%" border="0" cellspacing="0" cellpadding="0" nobr="true">
                <tr>
                    <td style="width: 49%" bgcolor="white">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" nobr="true">
                            <tr>
                                <td colpan="3" height="8"></td>
                            </tr>
                            <tr>
                                <td style="width: 2%"></td>
                                <td style="width: 48%; text-align:justify;color: #000000;padding:0px;margin:0px;font-family: "Arimo", sans-serif;font-size:16px;">'.nl2br($equi_text1).'</td>
                                <td style="width: 2%"></td>
                            </tr>
                        </table>
                    </td>
                    <td style="width: 2%"></td>
                    <td style="width: 49%" bgcolor="white">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" nobr="true">
                            <tr>
                                <td colpan="3" height="8"></td>
                            </tr>
                            <tr>
                                <td style="width: 2%"></td>
                                <td style="width: 48%;  text-align:justify;color: #000000;padding:0px;margin:0px;font-family: "Arimo", sans-serif;font-size:16px;
                                line-height:22px; font-weight:400;">'.nl2br($equi_text1).'</td>
                                <td style="width: 2%"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                   <td style="width: 49%; height: 8px;" bgcolor="white"></td>
                   <td style="width: 2%; height: 8px;"></td>
                   <td style="width: 49%; height: 8px;" bgcolor="white"></td>
                </tr>
            </table>'; 
        }
    }

    if(isset($val->ltotalmonthrent)){
        $dataArr = $val->ltotalmonthrent;
    } else {
        $dataArr = '';
    }
    if($dataArr != ''){
        $dataArr = json_decode($dataArr, true);
        $dataArr = is_array($dataArr) ? $dataArr : array($dataArr);
        $totalmonthlyrent =  array_sum($dataArr);
    } else {
        $totalmonthlyrent = 0;
    }

    if(isset($val->linsidesqt)){
        $sqtArr = $val->linsidesqt;
    } else {
        $sqtArr = '';
    }
    if($sqtArr != ''){
        $sqtArr = json_decode($sqtArr, true);
        $sqtArr = is_array($sqtArr) ? $sqtArr : array($sqtArr);
        $totalSqtArr=  array_sum($sqtArr);
    } else {
        $totalSqtArr = 0;
    }
?>
<!DOCTYPE html>
<html>

<head>
    <title>listing_art_ {!! $id !!}</title>
</head>

<body>

    <div class="footer">
        <table cellspacing="0" cellpadding="0" border="0" style="width: 100%;">
            <tr>
                <td>
                    <img src="{{ public_path('assets/images/print_pdf/new-wsrlogo.png') }}" alt="logo"
                        style="max-width:120px; height: auto;" />
                </td>
                <td width="30%">
                    <table cellspacing="0" cellpadding="0" border="0"
                        style="width: 100%; border-collapse: separate; border-spacing: 0px 30px;">
                        <tr>
                            <td
                                style="font-size: 20px; color: #000; text-transform: uppercase; padding-top: 0; line-height: 12px; text-align: center; font-family: 'Arimo', sans-serif;">
                                CONFIDENTIAL</td>
                        </tr>
                    </table>
                </td>
                <td width="60%">
                    <table cellspacing="0" cellpadding="0" border="0" style="width: 100%;">
                        <tr>
                            <td style="height: 35px"></td>
                        </tr>
                    </table>
                    <table cellspacing="0" cellpadding="0" border="0"
                        style="width: 100%; height: 1px; background-color: #e70033;">
                    </table>
                </td>
            </tr>
        </table>
    </div>
    <main>
        <!-- First Page  -->
        <div id="first-page">
            <div class="wsr-main-pdf-page">
                <table style="width: 100%; box-sizing: border-box;">
                    <tr>
                        <td colspan="2">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td colspan="2"
                                        style="font-family: 'Arimo', sans-serif; margin:0; color: #000000; font-size:18px; line-height: 24px; font-weight:bold;">
                                        Listing # {!! $id !!}</td>
                                </tr>
                                <tr>
                                    <td
                                        style="width: 400px; font-family: 'Arimo', sans-serif; font-size: 34px; line-height: 36px; color: #333; font-weight: bold;">
                                        CONFIDENTIAL<br><span
                                            style="font-size: 44px; line-height: 44px;">ASSET</span><br>REPORTING TOOL
                                    </td>
                                    <td align="center">
                                        <img src="{{ public_path('assets/images/print_pdf/logo-pdfs.png') }}" alt="logo"
                                            style="width: 180px; height: 180px; border-radius: 50%;" />
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="height: 4px;"></td>
                    </tr>
                    <tr>
                        <td colspan="2"
                            style="font-family: 'Arimo', sans-serif; font-size:24px; line-height: 48px; padding: 15px 0 5px; margin:0; color: #e70033; font-weight:bold;">
                            &nbsp;Listing:</td>
                    </tr>
                    <tr>
                        <td colspan="2"
                            style="font-family: 'Arimo', sans-serif; color: #000000; margin:0; padding:0 0 5px;line-height:20px; font-weight:normal; font-size:16px;">
                            &nbsp; @if(isset($val->bname)) {!! $val->bname !!} @endif</td>
                    </tr>
                    <tr>
                        <td colspan="2"
                            style="font-family: 'Arimo', sans-serif; color: #000000; margin:0; padding:0 0 5px;line-height:20px; font-weight:normal; font-size:16px;">
                            &nbsp; @if(isset($val->baddress)) {!! $val->baddress !!} @endif</td>
                    </tr>
                    <tr>
                        <td colspan="2"
                            style="font-family: 'Arimo', sans-serif; color: #000000; margin:0; padding:0 0 5px;line-height:20px; font-weight:normal; font-size:16px;">
                            &nbsp;
                            @if(isset($val->bcity)) {{ $val->bcity }} @endif,
                            @if(isset($val->bstate)) {{ $val->bstate }} @endif
                            @if(isset($val->bzip)) {{ $val->bzip }} @endif
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="height: 2px;"></td>
                    </tr>
                    <tr>
                        <td colspan="2"
                            style="font-family: 'Arimo', sans-serif; padding: 0px 0 5px; margin:0; color: #e70033; font-size:24px; line-height: 48px; font-weight:bold;">
                            &nbsp;Asking Price:</td>
                    </tr>
                    <tr>
                        <td colspan="2"
                            style="font-family: 'Arimo', sans-serif; color: #000000; margin:0; padding:0 0 5px;line-height:20px; font-weight:normal; font-size:16px;">
                            &nbsp;@if(isset($val->bsaleprice)) $ {!! $val->bsaleprice !!} @else $0 @endif</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="height: 2px;"></td>
                    </tr>
                    <tr>
                        <td colspan="2"
                            style="font-family: 'Arimo', sans-serif; padding: 0px 0 5px; margin:0; color: #e70033; font-size:24px; line-height: 48px; font-weight:bold;">
                            &nbsp;Contact:</td>
                    </tr>
                    <tr>
                        <td colspan="2"
                            style="font-family: 'Arimo', sans-serif; color: #000000; margin:0; padding:0 0 5px;line-height:20px; font-weight:normal; font-size:16px;">
                            &nbsp;@if(isset($agent->firstname)) {{ $agent->firstname }} @endif
                            &nbsp; @if(isset($agent->lastname)) {{ $agent->lastname }} @endif
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"
                            style="font-family: 'Arimo', sans-serif; color: #000000; margin:0; padding:0 0 5px;line-height:20px; font-weight:normal; font-size:16px;">
                            &nbsp;@if(isset($agent->email)) {{ $agent->email }} @endif
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"
                            style="font-family: 'Arimo', sans-serif; color: #000000; margin:0; padding:0 0 5px;line-height:20px; font-weight:normal; font-size:16px;">
                            &nbsp;@if(isset($agent->cellphone)) {{ $agent->cellphone }} @endif
                            &nbsp; www.wesellrestaurants.com
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"
                            style="font-family: 'Arimo', sans-serif; color: #000000; margin:0; padding:0 0 5px;line-height:20px; font-weight:normal; font-size:16px;">
                            &nbsp;
                            @if(isset($val->officeaddress)) {{ $val->officeaddress }} @endif
                            @if(isset($val->officecity)) {{ $val->officecity }} @endif,
                            @if(isset($val->officestate)) {{ $val->officestate }} @endif
                            @if(isset($val->officezip)) {{ $val->officezip }} @endif
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="height: 4px;"></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="vertical-align: middle;">
                            @if(isset($val->img_file))
                            <img align="middle"
                                src="{{ url('storage/images/list/main_images/'.$val->img_file) }}" alt="logo"
                                style="width: 260px; height: 260px; vertical-align: middle;" />
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- second page -->
        <div id="page2" style="page-break-before: always;">
            <table width="100%" cellpadding="0" cellspacing="0"
                style="border-collapse: separate; border-spacing: 0px 15px;">
                <tbody>
                    <tr>
                        <td
                            style="font-family: 'Arimo', sans-serif; padding-left: 10px; margin:0;color:#fff;font-size:30px; font-weight:bold; background-color: #333333;height: 60px; vertical-align: middle;">
                            &nbsp; CONTENTS</td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>

                    <tr>
                        <td style="padding-left: 10px;">
                            <a href="#page3"
                                style="font-family: 'Arimo', sans-serif; font-size: 18px; line-height: 25px; color: #333333; text-decoration: none;">Confidentiality</a>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding-left: 10px;">
                            <a href="#page4"
                                style="font-family: 'Arimo', sans-serif; font-size: 18px; line-height: 25px; color: #333333; text-decoration: none;">Meet
                                the Broker</a>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding-left: 10px;">
                            <a href="#page5"
                                style="font-family: 'Arimo', sans-serif; font-size: 18px; line-height: 25px; color: #333333; text-decoration: none;">The
                                Listing</a>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding-left: 10px;">
                            <a href="#page6"
                                style="font-family: 'Arimo', sans-serif; font-size: 18px; line-height: 25px; color: #333333; text-decoration: none;">Restaurant
                                Overview</a>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding-left: 10px;">
                            <a href="#page7"
                                style="font-family: 'Arimo', sans-serif; font-size: 18px; line-height: 25px; color: #333333; text-decoration: none;">Equipment
                                List</a>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding-left: 10px;">
                            <a href="#page8"
                                style="font-family: 'Arimo', sans-serif; font-size: 18px; line-height: 25px; color: #333333; text-decoration: none;">Lease
                                Overview</a>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding-left: 10px;">
                            <a href="#page9"
                                style="font-family: 'Arimo', sans-serif; font-size: 18px; line-height: 25px; color: #333333; text-decoration: none;">Business
                                & Transfer Structure</a>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding-left: 10px;">
                            <a href="#page18"
                                style="font-family: 'Arimo', sans-serif; font-size: 18px; line-height: 25px; color: #333333; text-decoration: none;">Industry
                                Comparisons</a>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding-left: 10px;">
                            <a href="#page14"
                                style="font-family: 'Arimo', sans-serif; font-size: 18px; line-height: 25px; color: #333333; text-decoration: none;">Restaurant
                                Photos</a>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding-left: 10px;">
                            <a href="#page15"
                                style="font-family: 'Arimo', sans-serif; font-size: 18px; line-height: 25px; color: #333333; text-decoration: none;">Next
                                Steps</a>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding-left: 10px;">
                            <a href="#page16"
                                style="font-family: 'Arimo', sans-serif; font-size: 18px; line-height: 25px; color: #333333; text-decoration: none;">About
                                We Sell Restaurants</a>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding-left: 10px;">
                            <a href="#page17"
                                style="font-family: 'Arimo', sans-serif; font-size: 18px; line-height: 25px; color: #333333; text-decoration: none;">More
                                Resources</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- third page -->
        <div id="page3" style="page-break-before: always;">
            <table width="100%" cellpadding="0" cellspacing="0"
                style="border-collapse: separate; border-spacing: 0px 10px;">
                <tbody>
                    <tr>
                        <td colspan="2"
                            style="font-family: 'Arimo', sans-serif; padding-left: 10px; margin:0;color:#fff;font-size:30px; font-weight:bold; background-color: #333333;height: 60px; vertical-align: middle;">
                            &nbsp; CONFIDENTIALITY</td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td width="3%"></td>
                        <td width="94%"
                            style="font-size: 15px; line-height: 26px; font-family: 'Arimo', sans-serif; color: #333333;">
                            This Business Analysis Tool is a Confidential Document containing information about a
                            business for sale that is represented by We Sell Restaurants. This data is provided to
                            familiarize prospective buyers with confidential information about the business and is
                            specifically covered by the confidentiality agreement you have signed.</td>
                    </tr>

                    <tr>
                        <td width="3%"></td>
                        <td width="94%"
                            style="font-size: 15px; line-height: 26px; font-family: 'Arimo', sans-serif; color: #333333;">
                            All of the information presented in the Business Analysis Tool is highly sensitive and
                            confidential. It is only intended for individuals or companies who have signed a
                            Confidentiality or Non-Disclosure Agreement or are bound to confidentiality by their
                            professional ethics. DO NOT PROCEED FURTHER UNLESS YOU ARE BOUND BY ONE OF THESE AGREEMENTS.
                            If you have electronically acknowledged this confidentiality agreement online through our
                            website www.wesellrestaurants.com you are fully bound by the terms of that confidentiality
                            agreement under United States law for all information released to you herein.</td>
                    </tr>

                    <tr>
                        <td width="3%"></td>
                        <td width="94%"
                            style="font-size: 15px; line-height: 26px; font-family: 'Arimo', sans-serif; color: #333333;">
                            The definition of an electronic signature is set out in the Uniform Electronic Transactions
                            Act ("UETA") released by the National Conference of Commissioners on Uniform State Laws
                            (NCCUSL) in 1999. Under UETA, the term "electronic signature" means "an electronic sound,
                            symbol, or process, attached to or logically associated with a record and executed or
                            adopted by a person with the intent to sign the record." In other words, your electronic
                            intent, demonstrated by a signature initiated on your computer, traceable by your IP
                            address, confirmed by the data you provide about your physical address, name and phone
                            number is fully enforceable in a court of law.</td>
                    </tr>

                    <tr>
                        <td width="3%"></td>
                        <td width="94%"
                            style="font-size: 15px; line-height: 26px; font-family: 'Arimo', sans-serif; color: #333333;">
                            All the information contained in this Business Analysis Tool has been provided by the
                            business offered for sale. We Sell Restaurants® has not confirmed this information and makes
                            no representations or warranties as to its accuracy or completeness. Any and all
                            representations shall be made solely by the business offered for sale as set forth in a
                            signed asset purchase agreement.</td>
                    </tr>

                    <tr>
                        <td width="3%"></td>
                        <td width="94%"
                            style="font-size: 15px; line-height: 26px; font-family: 'Arimo', sans-serif; color: #333333;">
                            By accepting this Business Analysis Tool, the recipient acknowledges their responsibility to
                            perform a thorough due diligence review and to make their own evaluation prior to any
                            acquisition of the business for sale.
                        </td>
                    </tr>

                    <tr>
                        <td width="3%"></td>
                        <td width="94%"
                            style="font-size: 15px; line-height: 26px; font-family: 'Arimo', sans-serif; color: #333333;">
                            The business employees, customers, suppliers and competitors are not aware that the business
                            is for sale. Contact with any party of the business, stakeholder, landlord, vendor and
                            employee or otherwise is strictly prohibited except in an "undercover" manner while acting
                            normally as a customer.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- fourth page  -->
        <div id="page4" style="page-break-before: always;">
            <table width="100%" cellspacing="0" cellpadding="0" align="center" style="max-width:700px;">
                <tr>
                    <td colspan="2"
                        style="font-family: 'Arimo', sans-serif; padding-left: 10px; margin:0;color:#fff;font-size:30px; font-weight:bold; background-color: #333333;height: 60px; vertical-align: middle; text-align: left;">
                        &nbsp; MEET BROKER</td>
                </tr>
                <tr>
                    <td height="20"></td>
                </tr>
                <tr>
                    <td width="3%"></td>';
                    @if(isset($agent->agentdes))
                    @if(strlen($agent->agentdes) > 360)
                    <td width="94%"
                        style="font-size: 15px; line-height: 26px; font-family: 'Arimo', sans-serif; color: #333333;">
                        &nbsp; {!! $agent->agentdes !!}</td>
                    @else
                    <td width="94%"
                        style="font-size: 15px; line-height: 26px; font-family: 'Arimo', sans-serif; color: #333333;">
                        &nbsp; {!! $agent->agentdes !!}</td>
                    @endif
                    @endif
                </tr>
            </table>
        </div>
        <!-- page 4.1 -->
        <div style="page-break-before: always;">
            <table width="100%" border="0" cellspacing="3px" cellpadding="0">
                <tr>
                    <td style="width: 60%;">
                        <table width="100%" border="0" cellspacing="3px" cellpadding="0" style="border-collapse: separate;
                            border-spacing: 0px 30px;">
                            <tr>
                                <td width="100%"
                                    style="font-size: 20px; line-height: 22px; font-family: 'Arimo', sans-serif; color: #e70033; text-align: left; font-weight: bold;">
                                    @if(isset($agent->firstname)) {!! $agent->firstname !!}@endif
                                    &nbsp; @if(isset($agent->lastname)) {!! $agent->lastname !!}@endif
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                            </tr>

                            <tr>
                                <td>
                                    <a href="https://www.wesellrestaurants.com/"
                                        style="text-decoration: none;  width: 400px; height: 80px; font-size: 22px; color: #ffffff; background-color: #e70033; font-family: 'Arimo', sans-serif; padding: 20px 0;">&nbsp;
                                        &nbsp; WeSellRestaurants.com &nbsp; &nbsp; &nbsp; &nbsp;</a>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                            </tr>

                            <tr>
                                <td>
                                    <a href="mailto:" @if(isset($agent->email)) {!! $agent->email !!} @endif
                                        style="text-decoration: none; width: 400px; height: 80px; font-size: 22px;
                                        color: #ffffff; background-color: #e70033; font-family: 'Arimo', sans-serif;
                                        padding: 20px 0;">&nbsp; &nbsp; &nbsp;
                                        @if(isset($agent->email)) {!! $agent->email !!}@endif
                                        &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="tel:" @if(isset($agent->cellphone)) {!! $agent->cellphone !!} @endif
                                        style="text-decoration: none; width: 400px; height: 80px; font-size: 22px;
                                        color: #ffffff; background-color: #e70033; font-family: 'Arimo', sans-serif;
                                        padding: 20px 0;">&nbsp; &nbsp; &nbsp;
                                        @if(isset($agent->cellphone)) {!! $agent->cellphone !!} @endif
                                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                        &nbsp; &nbsp;
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td style="width: 40%;">
                        @if(isset($agent->img))
                        <img src="{{ public_path('assets/images/agent/'.$agent->img) }}"
                            style="width:200px; height:200px;" alt="image">
                        @endif
                    </td>
                </tr>
                <tr>
                    <td style="width: 100%; height: 40px;"></td>
                </tr>
            </table>
        </div>
        <!-- fifth page -->
        <div id="page5" style="page-break-before: always;">
            <table id="page10" width="100%" border="0" cellspacing="0" cellpadding="0" nobr="true">
                <tr>
                    <td colspan="2"
                        style="font-family: 'Arimo', sans-serif; padding-left: 10px; margin:0;color:#fff;font-size:30px; font-weight:bold; background-color: #333333;height: 60px; vertical-align: middle;">
                        &nbsp; THE LISTING</td>
                </tr>
                <tr>
                    <td colspan="2" height="20"></td>
                </tr>
                <tr>
                    <td colspan="2" height="10" bgcolor="white"></td>
                </tr>
                <tr>
                    <td width="3%" bgcolor="white"></td>
                    <td width="94%" bgcolor="white"
                        style="font-size: 24px; line-height: 32px; font-family: 'Arimo', sans-serif; color: #e70033; text-align: left; font-weight: bold;">
                        @if(isset($val->bheadlinead)) {!! $val->bheadlinead !!} @endif</td>
                </tr>
                <tr>
                    <td colspan="2" height="10" bgcolor="white"></td>
                </tr>
                <tr>
                    <td width="3%" bgcolor="white"></td>
                    <td width="94%" bgcolor="white"
                        style="font-size: 16px; line-height: 22px; font-family: 'Arimo', sans-serif; color: #333333; text-align: left;">
                        @if(isset($val->bdetailedad)) {!! $val->bdetailedad !!} @endif </td>
                </tr>
                <tr>
                    <td colspan="2" height="10" bgcolor="white"></td>
                </tr>
            </table>
        </div>
        <!-- 5.1 -->
        <div style="page-break-before: always;">
            <table cellpadding="0" cellspacing="0" width="100%" bgcolor="white">
                <tr>
                    <td height="20"></td>
                </tr>
                <tr>
                    <td width="3%"></td>
                    <td width="97%"
                        style="font-size: 20px; line-height: 38px; font-family: 'Arimo', sans-serif; color: #e70033; text-align: left; font-weight: bold;">
                        This business is offered at @if(isset($val->bsaleprice)) $ {!! $val->bsaleprice !!} @else $0
                        @endif</td>
                </tr>
                <tr>
                    <td height="10" bgcolor="white"></td>
                </tr>
                <tr>
                    <td width="3%"></td>
                    <td width="97%">
                        @if(isset($val->img_file))
                        <img src="{{ url('storage/images/list/main_images/'.$val->img_file) }}" alt="blog"
                            style="width: 550px; height: 310px;" />
                        @endif
                    </td>
                </tr>
                <tr>
                    <td height="5"></td>
                </tr>
                <tr>
                    <td width="3%"></td>
                    <td width="97%"
                        style="font-size: 18px; line-height: 30px; font-family: 'Arimo', sans-serif; color: #000; text-align: left; font-weight: bold;">
                        @if(isset($val->bname)) {!! $val->bname !!} @endif
                    </td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td width="3%"></td>
                    <td width="97%"
                        style="font-size: 18px; line-height: 30px; font-family: 'Arimo', sans-serif; color: #000; text-align: left; font-weight: bold;">
                        @if(isset($val->baddress)) {!! $val->baddress !!} @endif
                    </td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td width="3%"></td>
                    <td width="97%"
                        style="font-size: 18px; line-height: 30px; font-family: 'Arimo', sans-serif; color: #000; text-align: left; font-weight: bold;">
                        @if(isset($val->bcity)) {!! $val->bcity !!} @endif
                        @if(isset($val->bstate)) {!! $val->bstate !!} @endif
                        @if(isset($val->bstate)) {!! $val->bstate !!} @endif
                        @if(isset($val->bzip)) {!! $val->bzip !!} @endif
                    </td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td width="3%"></td>
                    <td width="97%"
                        style="font-size: 18px; line-height: 30px; font-family: 'Arimo', sans-serif; color: #000; text-align: left; font-weight: bold;">
                        @if(isset($val->add_more_details)) {!! $val->add_more_details !!} @endif
                    </td>
                </tr>
            </table>
        </div>
        <!-- sixth page -->
        <div id="page6" style="page-break-before: always;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" nobr="true">
                <tr>
                    <td colspan="2"
                        style="font-family: 'Arimo', sans-serif;  padding-left: 15px; margin:0; color: #333; font-size:26px; line-height: 32px;  font-weight:bold;">
                        Restaurant Overview</td>
                </tr>
                <tr>
                    <td colspan="2" height="20"></td>
                </tr>
                <tr>
                    <td colspan="2" height="8" bgcolor="white"></td>
                </tr>
                <tr>
                    <td style="width: 2%" bgcolor="white"></td>
                    <td style="width: 58%;" align="middle" bgcolor="white">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" nobr="true">
                            <tr>
                                <td width="100%"
                                    style="font-size: 18px; line-height: 30px; font-family: 'Arimo', sans-serif; color: #000; text-align: left; font-weight: bold;">
                                    @if(isset($val->bname)) {!! $val->bname !!} @endif </td>
                            </tr>
                            <tr>
                                <td width="100%"
                                    style="font-size: 18px; line-height: 30px; font-family: 'Arimo', sans-serif; color: #000; text-align: left;">
                                    @if(isset($val->baddress)) {!! $val->baddress !!} @endif</td>
                            </tr>
                            <tr>
                                <td width="100%"
                                    style="font-size: 18px; line-height: 30px; font-family: 'Arimo', sans-serif; color: #000; text-align: left;">
                                    Established: @if(isset($val->yearestablish )) {!! $val->yearestablish !!} @endif
                                </td>
                            </tr>
                            <tr>
                                <td width="100%"
                                    style="font-size: 18px; line-height: 30px; font-family: 'Arimo', sans-serif; color: #000; text-align: left;">
                                    Years Owned by Current Owner: @if(isset($val->currentowner)) {!! $val->currentowner
                                    !!} @endif </td>
                            </tr>
                            <tr>
                                <td width="100%"
                                    style="font-size: 18px; line-height: 30px; font-family: 'Arimo', sans-serif; color: #000; text-align: left;">
                                    Reason for Selling: @if(isset($val->reasonForSelling)) {!! $val->reasonForSelling
                                    !!} @endif</td>
                            </tr>
                        </table>
                    </td>
                    <td style="width: 38%;" align="middle" bgcolor="white">
                        @if(isset($val->img_file))
                        <img align="middle" src="{{ url('storage/images/list/main_images/'.$val->img_file) }}"
                            alt="business" style="width: 400px; height: 280px; vertical-align: middle;" />
                        @endif
                    </td>
                    <td style="width: 2%"></td>
                </tr>
                <tr>
                    <td colspan="4" height="20" bgcolor="white"></td>
                </tr>
                <tr>
                    <td style="width: 2%" bgcolor="white"></td>
                    <td colspan="2" style="width: 96%;" align="middle" bgcolor="white">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" nobr="true">
                            <tr>
                                <td width="100%"
                                    style="font-size: 18px; line-height: 30px; font-family: 'Arimo', sans-serif; color: #000; text-align: left; font-weight: bold;">
                                    Franchise Information</td>
                            </tr>
                            <tr>
                                <td width="100%"
                                    style="font-size: 18px; line-height: 30px; font-family: 'Arimo', sans-serif; color: #000; text-align: left;">
                                    Franchise: @if(isset($val->batFranchise)) {!! $val->batFranchise !!} @endif</td>
                            </tr>
                            <tr>
                                <td width="100%"
                                    style="font-size: 18px; line-height: 30px; font-family: 'Arimo', sans-serif; color: #000; text-align: left;">
                                    Franchise Transfer Fee: @if(isset($val->franchiseTransferFee )) $ {!!
                                    $val->franchiseTransferFee !!} @else $0 @endif</td>
                            </tr>
                            <tr>
                                <td width="100%"
                                    style="font-size: 18px; line-height: 30px; font-family: 'Arimo', sans-serif; color: #000; text-align: left;">
                                    Marketing Fee: @if(isset($val->marketingFees)) {!! $val->marketingFees !!}% @else 0%
                                    @endif</td>
                            </tr>
                            <tr>
                                <td width="100%"
                                    style="font-size: 18px; line-height: 30px; font-family: 'Arimo', sans-serif; color: #000; text-align: left;">
                                    Royalty Fee: @if(isset($val->royaltyFees)) {!! $val->royaltyFees !!}% @else 0%
                                    @endif</td>
                            </tr>
                        </table>
                    </td>
                    <td style="width: 2%" bgcolor="white"></td>
                </tr>
                <tr>
                    <td colspan="4" height="20" bgcolor="white"></td>
                </tr>
                <tr>
                    <td style="width: 2%" bgcolor="white"></td>
                    <td style="width: 48%;" align="middle" bgcolor="white">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" nobr="true">
                            <tr>
                                <td width="100%"
                                    style="font-size: 18px; line-height: 30px; font-family: 'Arimo', sans-serif; color: #000; text-align: left; font-weight: bold;">
                                    Additional Info</td>
                            </tr>
                            <tr>
                                <td width="100%"
                                    style="font-size: 18px; line-height: 30px; font-family: 'Arimo', sans-serif; color: #000; text-align: left;">
                                    Non-Compete (Years): @if(isset($val->nonCompeteAgreementYears)) {!!
                                    $val->nonCompeteAgreementYears !!} @endif</td>
                            </tr>
                            <tr>
                                <td width="100%"
                                    style="font-size: 18px; line-height: 30px; font-family: 'Arimo', sans-serif; color: #000; text-align: left;">
                                    Non-Compete (Miles): @if(isset($val->nonCompeteAgreementMiles)) {!!
                                    $val->nonCompeteAgreementMiles !!} @endif</td>
                            </tr>
                        </table>
                    </td>
                    <td style="width: 48%;" align="middle" bgcolor="white">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" nobr="true">
                            <tr>
                                <td width="100%"
                                    style="font-size: 18px; line-height: 30px; font-family: 'Arimo', sans-serif; color: #000; text-align: left; font-weight: bold;">
                                    Financing Opt ions</td>
                            </tr>
                            <tr>
                                <td width="100%"
                                    style="font-size: 18px; line-height: 30px; font-family: 'Arimo', sans-serif; color: #000; text-align: left;">
                                    Unsecured Lending Opportunities for Buyers with Strong Credit</td>
                            </tr>
                        </table>
                    </td>
                    <td style="width: 2%" bgcolor="white"></td>
                </tr>
                <tr>
                    <td colspan="4" height="20" bgcolor="white"></td>
                </tr>
            </table>
        </div>
        <!-- page 6.1 -->
        <div style="page-break-before: always;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" nobr="true">
                <tr>
                    <td colspan="2" width="100%"
                        style="font-size: 20px; line-height: 38px; font-family: 'Arimo', sans-serif; color: #e70033; text-align: left; font-weight: bold;">
                        Listing Price: @if(isset($val->bsaleprice)) $ {!! $val->bsaleprice !!} @else $0 @endif</td>
                </tr>
                <tr>
                    <td colspan="2" height="40"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" nobr="true">
                            <tr>
                                <td style="width: 150px;  text-align: center;">
                                    <table style="text-align: center" width="100%" border="0" cellspacing="0"
                                        cellpadding="0" nobr="true">
                                        <tr>
                                            <td>
                                                <img src="{{ public_path('assets/images/print_pdf/business6.png') }}"
                                                    alt="business" style="width: 150px; height: 150px;" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="2"></td>
                                        </tr>
                                        <tr>
                                            <td width="100%"
                                                style="font-size: 22px; line-height: 28px; font-family: 'Arimo', sans-serif; color: #000; text-align: center; font-weight: bold;">
                                                @if(isset($val->opTraining)) {!! $val->opTraining !!} @endif</td>
                                        </tr>
                                        <tr>
                                            <td width="100%"
                                                style="font-size: 16px; line-height: 18px; font-family: 'Arimo', sans-serif; color: #000; text-align: center; font-style: italic;">
                                                Training</td>
                                        </tr>
                                    </table>
                                </td>
                                <td style="width: 28px;"></td>
                                <td style="width: 150px;  text-align: center;">
                                    <table style="text-align: center" width="100%" border="0" cellspacing="0"
                                        cellpadding="0" nobr="true">
                                        <tr>
                                            <td>
                                                <img src="{{ public_path('assets/images/print_pdf/businesshome.png') }}"
                                                    alt="business" style="width: 150px; height: 150px;" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="2"></td>
                                        </tr>
                                        <tr>
                                            <td width="100%"
                                                style="font-size: 22px; line-height: 28px; font-family: 'Arimo', sans-serif; color: #000; text-align: center; font-weight: bold;">
                                                {!! $totalSqtArr !!} </td>
                                        </tr>
                                        <tr>
                                            <td width="100%"
                                                style="font-size: 16px; line-height: 18px; font-family: 'Arimo', sans-serif; color: #000; text-align: center; font-style: italic;">
                                                Lease sq. ft.</td>
                                        </tr>
                                    </table>
                                </td>
                                <td style="width: 28px;"></td>
                                <td style="width: 150px;  text-align: center;">
                                    <table style="text-align: center" width="100%" border="0" cellspacing="0"
                                        cellpadding="0" nobr="true">
                                        <tr>
                                            <td>
                                                <img src="{{ public_path('assets/images/print_pdf/business-5.png') }}"
                                                    alt="business" style="width: 150px; height: 150px;" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="2"></td>
                                        </tr>
                                        <tr>
                                            <td width="100%"
                                                style="font-size: 22px; line-height: 28px; font-family: 'Arimo', sans-serif; color: #000; text-align: center; font-weight: bold;">
                                                ${!! $totalmonthlyrent!!}</td>
                                        </tr>
                                        <tr>
                                            <td width="100%"
                                                style="font-size: 16px; line-height: 18px; font-family: 'Arimo', sans-serif; color: #000; text-align: center; font-style: italic;">
                                                Monthly Rent</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" height="2"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" nobr="true">
                            <tr>
                                <td style="width: 150px;  text-align: center;">
                                    <table style="text-align: center" width="100%" border="0" cellspacing="0"
                                        cellpadding="0" nobr="true">
                                        <tr>
                                            <td>
                                                <img src="{{ public_path('assets/images/print_pdf/business-7.png') }}"
                                                    alt="business" style="width: 150px; height: 150px;" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="2"></td>
                                        </tr>
                                        <tr>
                                            <td width="100%"
                                                style="font-size: 22px; line-height: 28px; font-family: 'Arimo', sans-serif; color: #000; text-align: center; font-weight: bold;">
                                                @if(isset($val->nofulltimeemp)) {!! $val->nofulltimeemp !!} @endif,
                                                @if(isset($val->noparttimeemp)) {!! $val->noparttimeemp !!} @endif</td>
                                        </tr>
                                        <tr>
                                            <td width="100%"
                                                style="font-size: 16px; line-height: 18px; font-family: 'Arimo', sans-serif; color: #000; text-align: center; font-style: italic;">
                                                Employees</td>
                                        </tr>
                                        <tr>
                                            <td width="100%"
                                                style="font-size: 16px; line-height: 18px; font-family: 'Arimo', sans-serif; color: #000; text-align: center; font-style: italic;">
                                                PT, FT</td>
                                        </tr>
                                    </table>
                                </td>
                                <td style="width: 28px;"></td>
                                <td style="width: 150px;  text-align: center;">
                                    <table style="text-align: center" width="100%" border="0" cellspacing="0"
                                        cellpadding="0" nobr="true">
                                        <tr>
                                            <td>
                                                <img src="{{ public_path('assets/images/print_pdf/business-8.png') }}"
                                                    alt="business" style="width: 150px; height: 150px;" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="2"></td>
                                        </tr>
                                        <tr>
                                            <td width="100%"
                                                style="font-size: 22px; line-height: 28px; font-family: 'Arimo', sans-serif; color: #000; text-align: center; font-weight: bold;">
                                                @if(isset($val->operatinghours)) {!! $val->operatinghours !!} @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="100%"
                                                style="font-size: 16px; line-height: 18px; font-family: 'Arimo', sans-serif; color: #000; text-align: center; font-style: italic;">
                                                Hours</td>
                                        </tr>
                                    </table>
                                </td>
                                <td style="width: 28px;"></td>
                                <td style="width: 150px;  text-align: center;">
                                    <table style="text-align: center" width="100%" border="0" cellspacing="0"
                                        cellpadding="0" nobr="true">
                                        <tr>
                                            <td>
                                                <img src="{{ public_path('assets/images/print_pdf/business-9.png') }}"
                                                    alt="business" style="width: 150px; height: 150px;" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="2"></td>
                                        </tr>
                                        <tr>
                                            <td width="100%"
                                                style="font-size: 22px; line-height: 28px; font-family: 'Arimo', sans-serif; color: #000; text-align: center; font-weight: bold;">
                                                @if(isset($val->noinsideseats)) {!! $val->noinsideseats !!} @endif,
                                                @if(isset($val->nooutsideeats)) {!! $val->nooutsideeats !!} @endif</td>
                                        </tr>
                                        <tr>
                                            <td width="100%"
                                                style="font-size: 16px; line-height: 18px; font-family: 'Arimo', sans-serif; color: #000; text-align: center; font-style: italic;">
                                                Seats</td>
                                        </tr>
                                        <tr>
                                            <td width="100%"
                                                style="font-size: 16px; line-height: 18px; font-family: 'Arimo', sans-serif; color: #000; text-align: center; font-style: italic;">
                                                Inside , Outside</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" height="2"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" nobr="true">
                            <tr>
                                <td style="width: 150px;  text-align: center;">
                                    <table style="text-align: center" width="100%" border="0" cellspacing="0"
                                        cellpadding="0" nobr="true">
                                        <tr>
                                            <td>
                                                <img src="{{ public_path('assets/images/print_pdf/business-10.png') }}"
                                                    alt="business" style="width: 150px; height: 150px;" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="2"></td>
                                        </tr>
                                        <tr>
                                            <td width="100%"
                                                style="font-size: 22px; line-height: 28px; font-family: 'Arimo', sans-serif; color: #000; text-align: center; font-weight: bold;">
                                                @if(isset($val->greasetrap)) {!! $val->greasetrap !!} @endif</td>
                                        </tr>
                                        <tr>
                                            <td width="100%"
                                                style="font-size: 16px; line-height: 18px; font-family: 'Arimo', sans-serif; color: #000; text-align: center; font-style: italic;">
                                                Grease Trap</td>
                                        </tr>
                                    </table>
                                </td>
                                <td style="width: 28px;"></td>
                                <td style="width: 150px;  text-align: center;">
                                    <table style="text-align: center" width="100%" border="0" cellspacing="0"
                                        cellpadding="0" nobr="true">
                                        <tr>
                                            <td>
                                                <img src="{{ public_path('assets/images/print_pdf/business-11.png') }}"
                                                    alt="business" style="width: 150px; height: 150px;" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="2"></td>
                                        </tr>
                                        <tr>
                                            <td width="100%"
                                                style="font-size: 22px; line-height: 28px; font-family: 'Arimo', sans-serif; color: #000; text-align: center; font-weight: bold;">
                                                @if(isset($val->liquorlicensetyp)) {!! $val->liquorlicensetype !!}
                                                @endif</td>
                                        </tr>
                                        <tr>
                                            <td width="100%"
                                                style="font-size: 16px; line-height: 18px; font-family: 'Arimo', sans-serif; color: #000; text-align: center; font-style: italic;">
                                                Liquor License</td>
                                        </tr>
                                    </table>
                                </td>
                                <td style="width: 28px;"></td>
                                <td style="width: 150px;  text-align: center;">
                                    <table style="text-align: center" width="100%" border="0" cellspacing="0"
                                        cellpadding="0" nobr="true">
                                        <tr>
                                            <td>
                                                <img src="{{ public_path('assets/images/print_pdf/business-12.png') }}"
                                                    alt="business" style="width: 150px; height: 150px;" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="2"></td>
                                        </tr>
                                        <tr>
                                            <td width="100%"
                                                style="font-size: 22px; line-height: 28px; font-family: 'Arimo', sans-serif; color: #000; text-align: center; font-weight: bold;">
                                                @if(isset($val->hoodsystem)) {!! $val->hoodsystem !!} @endif</td>
                                        </tr>
                                        <tr>
                                            <td width="100%"
                                                style="font-size: 16px; line-height: 18px; font-family: 'Arimo', sans-serif; color: #000; text-align: center; font-style: italic;">
                                                Hood System</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
        <!--  -->
        <div id="page7" style="page-break-before: always;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" nobr="true">
                <tr>
                    <td align="left" valign="left"
                        style="font-family:sans-serif;font-size:32px;font-weight:bold; color:#ff0000;">
                        Equipment List
                    </td>
                </tr>
                <tr>
                    <td height="8"></td>
                </tr>
                <tr>
                    <td width="100%" bgcolor="white"
                        style="font-size: 24px; line-height: 32px; font-family: 'Arimo', sans-serif; color: #e70033; text-align: left;">
                        {!! $equipmentlist !!}</td>
                </tr>
            </table>
        </div>

        <!-- seventh page  -->
        <div id="page8" style="page-break-before: always;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td align="left" valign="left"
                        style="font-family: 'Arimo', sans-serif;font-size:32px;font-weight:bold; color:#ff0000;">
                        Lease Overview
                    </td>
                </tr>
                <tr>
                    <td height="8"></td>
                </tr>
                <tr>
                    <td>
                        <table style="background-color: #333333; padding-bottom:10px;" width="100%" border="0" cellspacing="0"
                            cellpadding="0">
                            <tr>
                                <td style="width: 2%;"></td>
                                <td style="width: 96%;">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td style="height: 15px;"></td>
                                        </tr>
                                        <tr>
                                            <td
                                                style="color: #ffffff; font-family: 'Arimo', sans-serif; font-size: 20px; line-height: 32px; font-weight: bold;">
                                                Address:</td>
                                        </tr>
                                        <tr>
                                            <td
                                                style="color: #ffffff; font-size: 16px; font-family: 'Arimo', sans-serif; line-height: 24px;">
                                                @if(isset($val->bname)) {!! $val->bname !!} @endif</td>
                                        </tr>
                                        <tr>
                                            <td
                                                style="color: #ffffff; font-size: 16px; font-family: 'Arimo', sans-serif; line-height: 24px;">
                                                @if(isset($val->baddress)) {!! $val->baddress !!} @endif</td>
                                        </tr>
                                        <tr>
                                            <td
                                                style="color: #ffffff; font-size: 16px; font-family: 'Arimo', sans-serif; line-height: 24px;">
                                                @if(isset($val->bcity)) {!! $val->bcity !!} @endif
                                                @if(isset($val->bstate)) {!! $val->bstate !!} @endif
                                                @if(isset($val->bzip)) {!! $val->bzip !!} @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="height: 4px;"></td>
                                        </tr>
                                        <tr>
                                            <td
                                                style="color: #ffffff; font-size: 20px; line-height: 32px; font-family: 'Arimo', sans-serif; font-weight: bold;">
                                                Details:</td>
                                        </tr>
                                        <tr>
                                            <td
                                                style="color: #ffffff; font-size: 16px; font-family: 'Arimo', sans-serif; line-height: 24px;">
                                                The current
                                                lease agreement, in most cases, will be assumed by the buyer and
                                                transferred. Your Certified Restaurant Broker negotiates terms for
                                                additional lease or option years, if necessary .</td>
                                        </tr>
                                        <tr>
                                            <td style="height: 8px;"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td style="width: 30%; text-align: center">
                                                            <table width="100%" border="0" cellspacing="0"
                                                                cellpadding="0">
                                                                <tr>
                                                                    <td style="text-align: center;">
                                                                        <img src="{{ public_path('assets/images/print_pdf/lease-1.png') }}"
                                                                            alt="lease"
                                                                            style="width: 80px; height: 60px;" />
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="height: 1px;"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td
                                                                        style="color: #fff; font-size: 16px; line-height: 16px; font-family: 'Arimo', sans-serif; text-align: center; font-weight: bold;">
                                                                        Rent
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="height: 1px;"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td
                                                                        style="color: #fff; font-size: 13px; line-height: 13px; font-family: 'Arimo', sans-serif; text-align: center;">
                                                                        ${!! $totalmonthlyrent !!}
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td style="width: 3%;"></td>
                                                        <td style="width: 30%; text-align: center">
                                                            <table width="100%" border="0" cellspacing="0"
                                                                cellpadding="0">
                                                                <tr>
                                                                    <td style="text-align: center;">
                                                                        <img src="{{ public_path('assets/images/print_pdf/lease-3.png') }}"
                                                                            alt="lease"
                                                                            style="width: 60px; height: 57px;" />
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="height: 1px;"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td
                                                                        style="color: #fff; font-size: 16px; line-height: 16px; font-family: 'Arimo', sans-serif; text-align: center; font-weight: bold;">
                                                                        Expiration
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="height: 1px;"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td
                                                                        style="color: #fff; font-size: 13px; line-height: 13px; font-family: 'Arimo', sans-serif; text-align: center;">
                                                                        @if(isset($val->lterm)) {!! $val->lterm !!}
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td style="width: 3%;"></td>
                                                        <td style="width: 30%; text-align: center">
                                                            <table width="100%" border="0" cellspacing="0"
                                                                cellpadding="0">
                                                                <tr>
                                                                    <td style="text-align: center;">
                                                                        <img src="{{ public_path('assets/images/print_pdf/lease-2.png') }}"
                                                                            alt="lease"
                                                                            style="width: 51px; height: 57px;" />
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="height: 1px;"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td
                                                                        style="color: #fff; font-size: 16px; line-height: 16px; font-family: 'Arimo', sans-serif; text-align: center; font-weight: bold;">
                                                                        Renewal Options
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="height: 1px;"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td
                                                                        style="color: #fff; font-size: 13px; line-height: 13px; font-family: 'Arimo', sans-serif; text-align: center;">
                                                                        @if(isset($val->lterm)) {!! $val->lterm !!}
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td style="width: 3%;"></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td style="width: 2%;"></td>
                            </tr>
                            <tr>
                                <td style="height: 8px;"></td>
                            </tr>
                            <tr>
                                <td><iframe
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3469.481634490851!2d-81.19361818529777!3d29.589682146867183!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88e6c1ff47bddf5b%3A0x8ece5f6d5dc7b844!2sWe%20Sell%20Restaurants!5e0!3m2!1sen!2sin!4v1677669377332!5m2!1sen!2sin"
                                        width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade"></iframe></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
        <!-- page 10 -->
        <div id="page9" style="page-break-before: always;">
            <table width="100%" cellpadding="0" cellspacing="0px">
                <tr>
                    <td colspan="2"
                        style="font-family: 'Arimo', sans-serif; padding-left: 10px; margin:0;color:#fff;font-size:30px; font-weight:bold; background-color: #333333;height: 60px; vertical-align: middle;">
                        &nbsp; BUSINESS STRUCTURE</td>
                </tr>
                <tr>
                    <td colspan="2" height="20"></td>
                </tr>
                <tr>
                    <td style="width: 50%;" bgcolor="white" style="padding: 15px;">
                        <table width="100%" cellpadding="0" cellspacing="0px">
                            <tr>
                                <td style="width: 2%;"></td>
                            </tr>
                            <tr>
                                <td style="width: 98%;">
                                    <table width="100%" cellpadding="0" cellspacing="0px">
                                        <tr>
                                            <td
                                                style="font-family: 'Arimo', sans-serif; font-size: 24px; color: #000; font-weight: bold; line-height: 32px;">
                                                Current Owner Role</td>
                                        </tr>
                                        <tr>
                                            <td style="height: 4px"></td>
                                        </tr>
                                        <tr>
                                            <td
                                                style="font-family: 'Arimo', sans-serif; font-size: 16px; color: #000; line-height: 13px;">
                                                @if(isset($val->currentowner)) {!! $val->currentowner !!} @endif</td>
                                        </tr>
                                        <tr>
                                            <td style="height: 40px;"></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td style="width: 50%;">
                        <img src="{{ public_path('assets/images/print_pdf/owners.png') }}" alt="owner"
                            style="max-width: 100%; height: auto;" />
                    </td>
                </tr>

                <tr>
                    <td colspan="2" style="height: 20px;"></td>
                </tr>

                <tr>
                    <td style="width: 50%;" bgcolor="white" style="padding: 15px;">
                        <table width="100%" cellpadding="0" cellspacing="0px">
                            <tr>
                                <td style="width: 2%;"></td>
                            </tr>
                            <tr>
                                <td style="width: 98%;">
                                    <table width="100%" cellpadding="0" cellspacing="0px">
                                        <tr>
                                            <td
                                                style="font-family: 'Arimo', sans-serif; font-size: 24px; color: #000; font-weight: bold; line-height: 32px;">
                                                Current Owner Hours</td>
                                        </tr>
                                        <tr>
                                            <td style="height: 4px"></td>
                                        </tr>
                                        <tr>
                                            <td
                                                style="font-family: 'Arimo', sans-serif; font-size: 16px; color: #000; line-height: 13px;">
                                                @if(isset($val->hoursWorkedByOwner)) {!! $val->hoursWorkedByOwner !!}
                                                @endif</td>
                                        </tr>
                                        <tr>
                                            <td style="height: 40px;"></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td style="width: 50%;">
                        <img src="{{ public_path('assets/images/print_pdf/hour.png') }}" alt="owner"
                            style="max-width: 100%; height: auto;" />
                    </td>
                </tr>

                <tr>
                    <td colspan="2" style="height: 20px;"></td>
                </tr>

                <tr>
                    <td style="width: 50%;" bgcolor="white" style="padding: 15px;">
                        <table width="100%" cellpadding="0" cellspacing="0px">
                            <tr>
                                <td style="width: 2%;"></td>
                            </tr>
                            <tr>
                                <td style="width: 98%;">
                                    <table width="100%" cellpadding="0" cellspacing="0px">
                                        <tr>
                                            <td
                                                style="font-family: 'Arimo', sans-serif; font-size: 24px; color: #000; font-weight: bold; line-height: 32px;">
                                                Ideal Buyer</td>
                                        </tr>
                                        <tr>
                                            <td style="height: 4px"></td>
                                        </tr>
                                        <tr>
                                            <td
                                                style="font-family: 'Arimo', sans-serif; font-size: 16px; color: #000; line-height: 13px;">
                                                @if(isset($val->buyer_id)) {!! $val->buyer_id !!} @endif</td>
                                        </tr>
                                        <tr>
                                            <td style="height: 40px;"></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td style="width: 50%;">
                        <img src="{{ public_path('assets/images/print_pdf/buyers.png') }}" alt="owner"
                            style="max-width: 100%; height: auto;" />
                    </td>
                </tr>
            </table>
        </div>
        <!-- page 11 -->
        <div style="page-break-before: always;">
            <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td colspan="2"
                        style="font-family: 'Arimo', sans-serif; padding-left: 10px; margin:0;color:#fff;font-size:30px; font-weight:bold; background-color: #333333;height: 60px; vertical-align: middle;">
                        &nbsp; TRANSFER STRUCTURE</td>
                </tr>
                <tr>
                    <td colspan="2" height="20"></td>
                </tr>
                <tr>
                    <td style="width: 100%;" bgcolor="white">
                        <table width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="width: 2%"></td>
                                <td style="width: 98%; height: 20px;"></td>
                            </tr>
                            <tr>
                                <td style="width: 2%"></td>
                                <td style="width: 98%;">
                                    <table width="100%" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td
                                                style="font-family: 'Arimo', sans-serif; font-size: 26px; line-height: 32px; font-weight: bold; color: #e70033">
                                                Asking Price: @if(isset($val->bsaleprice)) $ {!! $val->bsaleprice !!}
                                                @else $0 @endif</td>
                                        </tr>
                                        <tr>
                                            <td style="height: 2px;"></td>
                                        </tr>
                                        <tr>
                                            <td
                                                style="font-family: 'Arimo', sans-serif; font-size: 16px; line-height: 22px; color: #000000">
                                                This asking
                                                price includes the following:</td>
                                        </tr>
                                        <tr>
                                            <td style="height: 20px;"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <ul style="margin: 0; padding: 0 0 0 30px;">
                                                    <li
                                                        style="font-family: 'Arimo', sans-serif; font-size: 14px; line-height: 20px; color: #000000;">
                                                        Furniture, fixtures, and equipment</li>
                                                    <li
                                                        style="font-family: 'Arimo', sans-serif; font-size: 14px; line-height: 20px; color: #000000;">
                                                        All
                                                        customer/client lists</li>
                                                    <li
                                                        style="font-family: 'Arimo', sans-serif; font-size: 14px; line-height: 20px; color: #000000;">
                                                        Lease
                                                    </li>
                                                    <li
                                                        style="font-family: 'Arimo', sans-serif; font-size: 14px; line-height: 20px; color: #000000;">
                                                        Business phone number</li>
                                                    <li
                                                        style="font-family: 'Arimo', sans-serif; font-size: 14px; line-height: 20px; color: #000000;">
                                                        Social Media Accounts</li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="height: 20px;"></td>
                                        </tr>
                                        <tr>
                                            <td
                                                style="font-family: 'Arimo', sans-serif; font-size: 16px; line-height: 22px; color: #000000">
                                                It does not
                                                include:</td>
                                        </tr>
                                        <tr>
                                            <td style="height: 4px;"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <ul style="margin: 0; padding: 0 0 0 30px;">
                                                    <li
                                                        style="font-family: 'Arimo', sans-serif; font-size: 14px; line-height: 20px; color: #000000;">
                                                        Cash
                                                        on hand</li>
                                                    <li
                                                        style="font-family: 'Arimo', sans-serif; font-size: 14px; line-height: 20px; color: #000000;">
                                                        Cash
                                                        in the bank</li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="height: 20px;"></td>
                                        </tr>
                                        <tr>
                                            <td
                                                style="font-family: 'Arimo', sans-serif; font-size: 16px; line-height: 22px; color: #000000">
                                                Any offer
                                                drafted on your behalf would be subject to a number of contingencies
                                                including:</td>
                                        </tr>
                                        <tr>
                                            <td style="height: 4px;"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <ul style="margin: 0; padding: 0 0 0 30px;">
                                                    <li
                                                        style="font-family: 'Arimo', sans-serif; font-size: 14px; line-height: 20px; color: #000000;">
                                                        Due
                                                        Diligence Period</li>
                                                    <li
                                                        style="font-family: 'Arimo', sans-serif; font-size: 14px; line-height: 20px; color: #000000;">
                                                        Approval of the landlord</li>
                                                    <li
                                                        style="font-family: 'Arimo', sans-serif; font-size: 14px; line-height: 20px; color: #000000;">
                                                        Approval of the lender (if applicable)</li>
                                                    <li
                                                        style="font-family: 'Arimo', sans-serif; font-size: 14px; line-height: 20px; color: #000000;">
                                                        Approval of the franchise (if applicable)</li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="height: 20px;"></td>
                                        </tr>
                                        <tr>
                                            <td
                                                style="font-family: 'Arimo', sans-serif; font-size: 16px; line-height: 24px; color: #000000;">
                                                Your
                                                Certified Restaurant Broker can assist you with all offers and
                                                negotiations in drafting an offer to purchase.</td>
                                        </tr>
                                        <tr>
                                            <td style="height: 40px;"></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>

        <!-- page 12 -->
        <div id="page12" style="page-break-before: always;">
            <table width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td>
                        <table cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td colspan="2"
                                    style="text-align:left;color: #e70033; font-family: 'Arimo', sans-serif; font-size: 48px; line-height: 60px; padding-bottom: 20px;">
                                    The Restaurant Industry</td>
                            </tr>
                            <tr>
                                <td height="4px"></td>
                            </tr>
                            <tr>
                                <td colspan="2"
                                    style="text-align:justify;padding:0px;margin:0px;color: #000;font-family: 'Arimo', sans-serif;font-size:16px; line-height:22px; font-weight:400;font-style:italic;">
                                    Source: National Restaurant Association</td>
                            </tr>
                            <tr>
                                <td colspan="2" height="10px"></td>
                            </tr>
                            <tr>
                                <td colspan="2"
                                    style="text-align:left;color: #000000;font-weight:bold;padding:0px;margin:0px; font-family: 'Arimo', sans-serif;font-size: 18px; line-height: 30px;">
                                    Overview </td>
                            </tr>
                            <tr>
                                <td colspan="2"
                                    style="text-align:justify;color: #000000;padding:0px;margin:0px;font-family: 'Arimo', sans-serif;font-size:16px; line-height:22px; font-weight:400; ">
                                    Food and beverage sales in the restaurant and foodservice industry are projected to
                                    total $789
                                    Billion dollars in 2021, up 19.7% from 2020. Sales in 2020 were negatively affected
                                    by the virus but the National Restaurant Association reports that consumer spending
                                    in restaurants trended sharply higher during the first half of 2021, driven by
                                    rising vaccination numbers, additional stimulus payments and healthy household
                                    balance sheets. <br /> <br /> Looking to the future, the National Restaurant
                                    Association projects 2030 restaurant sales to be $1.2 trillion dollars and provide
                                    employment opportunities for more than 17 million individuals.</td>
                            </tr>
                            <tr>
                                <td colspan="2" height="10px"></td>
                            </tr>
                            <tr>
                                <td colspan="2"
                                    style="text-align:left;color: #000000;font-weight:bold;padding:0px;margin:0px; font-family: 'Arimo', sans-serif;font-size: 18px; line-height: 30px;">
                                    Growth </td>
                            </tr>
                            <tr>
                                <td colspan="2"
                                    style="text-align:justify;color: #000000;padding:0px;margin:0px;font-family: 'Arimo', sans-serif;font-size:16px; line-height:22px; font-weight:400;">
                                    Growth in the restaurant industry for the past several decades has been driven by
                                    consumers desire for convenience, socialization, and high-quality food and service.
                                    <br /> <br /> These same drivers will be the catalysts for expansion well into the
                                    future, as the restaurant industry continues to innovate and adapt to the
                                    ever-changing tastes and preferences of consumers. <br /> <br /> Nearly 8 in 10
                                    adults say their favorite restaurant foods deliver flavor and taste sensations that
                                    just can\'t be duplicated in the home kitchen. <br /> <br /> Restaurants are an
                                    integral part of our social fabric; 6 in 10 adults say restaurants are an
                                    essential part of their lifestyle.
                                </td>
                            </tr>
                            <tr>
                                <td height="20px"></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align: center; width: 100%;"><img
                                        src="{{ public_path('assets/images/print_pdf/sale.png') }}" alt="owner"
                                        style="width: 220px; height: 220px;" /></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
        <!-- page 18 -->
        <div id="page18" style="page-break-before: always;">
            <table width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td>
                        <table cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td colspan="2"
                                    style="text-align:left;color: #e70033; font-family: 'Arimo', sans-serif; font-size: 48px; line-height: 60px; padding-bottom: 20px;">
                                    Turnaround Opportunities</td>
                            </tr>
                            <tr>
                                <td height="4px"></td>
                            </tr>
                            <tr>
                                <td colspan="2"
                                    style="text-align:justify;color: #000000;padding:0px;margin:0px;font-family: 'Arimo', sans-serif;font-size:16px; line-height:22px; font-weight:400; ">
                                    There are several reasons why someone might consider buying a turnaround restaurant
                                    business like this one. </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" height="1"></td>
                </tr>
                <tr>
                    <td colspan="2"
                        style="text-align:justify;color: #000000;padding:0px;margin:0px;font-family: 'Arimo', sans-serif;font-size:16px; line-height:22px; font-weight:400;">
                        <b>Opportunity for growth:</b> A business may have untapped potential that can be unlocked with
                        the right leadership and strategies.
                    </td>
                </tr>
                <tr>
                    <td colspan="2" height="1"></td>
                </tr>
                <tr>
                    <td colspan="2"
                        style="text-align:justify;color: #000000;padding:0px;margin:0px;font-family: 'Arimo', sans-serif;font-size:16px; line-height:22px; font-weight:400;">
                        <b>Potential for high return on investment:</b> If a business is in financial trouble but has a
                        solid foundation and a good market, turning it around and making it profitable again can be a
                        lucrative opportunity.
                    </td>
                </tr>
                <tr>
                    <td colspan="2" height="2"></td>
                </tr>
                <tr>
                    <td colspan="2"
                        style="text-align:justify;color: #000000;padding:0px;margin:0px;font-family: 'Arimo', sans-serif;font-size:16px; line-height:22px; font-weight:400;">
                        <b>Lower purchase price:</b> Turnaround businesses may be available at a lower price than
                        businesses that are already successful. This can make them more affordable for buyers,
                        especially if the business has a strong foundation and just needs some restructuring to be
                        successful.
                    </td>
                </tr>
                <tr>
                    <td colspan="2" height="1"></td>
                </tr>
                <tr>
                    <td colspan="2"
                        style="text-align:justify;color: #000000;padding:0px;margin:0px;font-family: 'Arimo', sans-serif;font-size:16px; line-height:22px; font-weight:400;">
                        <b>Shorter time to market:</b> A turnaround restaurant that is fully equipped can be easily
                        converted to a new concept with just a signage and decor change
                    </td>
                </tr>
                <tr>
                    <td colspan="2" height="1"></td>
                </tr>
                <tr>
                    <td colspan="2"
                        style="text-align:justify;color: #000000;padding:0px;margin:0px;font-family: 'Arimo', sans-serif;font-size:16px; line-height:22px; font-weight:400;">
                        <b>Personal fulfillment:</b> Some people may find personal fulfillment in taking on the
                        challenge of turning around a struggling business. They may enjoy the process of identifying
                        problems and implementing solutions, and the sense of accomplishment that comes with
                        successfully turning the business around.
                    </td>
                </tr>
                <tr>
                    <td colspan="2" height="1"></td>
                </tr>
                <tr>
                    <td colspan="2"
                        style="text-align:justify;color: #000000;padding:0px;margin:0px;font-family: 'Arimo', sans-serif;font-size:16px; line-height:22px; font-weight:400;">
                        It\'s important to carefully evaluate the risks and potential rewards of buying a turnaround
                        restaurant business opportunity before making a decision. It can be a risky and challenging
                        process, but it can also be a rewarding one if you are successful.</td>
                </tr>
                <tr>
                    <td height="20px"></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center; width: 100%;"><img
                            src="{{ public_path('assets/images/print_pdf/industry.jfif') }}" alt="owner"
                            style="width: 280px; height: 220px;" /></td>
                </tr>
            </table>
        </div>
        <!-- page 18.1 -->
        <div style="page-break-before: always;">
            <table width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="background-color: #ddd; padding: 10px 0px;">
                        <table width="100%" cellspacing="0" cellpadding="0">
                            <tr>
                                <td style="width: 2%" height="1"></td>
                                <td style="width: 96%" height="1"></td>
                                <td style="width: 2%" height="1"></td>
                            </tr>
                            <tr>
                                <td style="width: 2%"></td>
                                <td style="width: 96%"
                                    style="text-align:justify;color: #000000;padding:0px;margin:0px;font-family: 'Arimo', sans-serif;font-size:18px; line-height:32px; font-weight:700;">
                                    Pricing for Asset Sales</td>
                                <td style="width: 2%"></td>
                            </tr>
                            <tr>
                                <td style="width: 2%" height="0.6"></td>
                                <td style="width: 96%" height="0.6"></td>
                                <td style="width: 2%" height="0.6"></td>
                            </tr>
                            <tr>
                                <td style="width: 2%"></td>
                                <td style="width: 96%"
                                    style="text-align:justify;color: #000000;padding:0px;margin:0px;font-family: 'Arimo', sans-serif;font-size:16px; line-height:22px; font-weight:400;">
                                    Asset Sales are priced using the Replacement Value Method. The replacement value
                                    method assumes a buyer pays the seller some amount based on the opportunity to
                                    benefit from the existing investment in the restaurant facility, leasehold
                                    improvements, equipment, lease, and location of the restaurant.</td>
                                <td style="width: 2%"></td>
                            </tr>
                            <tr>
                                <td style="width: 2%" height="0.5"></td>
                                <td style="width: 96%" height="0.5"></td>
                                <td style="width: 2%" height="0.5"></td>
                            </tr>
                            <tr>
                                <td style="width: 2%"></td>
                                <td style="width: 96%"
                                    style="text-align:justify;color: #000000;padding:0px;margin:0px;font-family: 'Arimo', sans-serif;font-size:16px; line-height:22px; font-weight:400;">
                                    In other words, the buyer will pay for the right to avoid spending time and money to
                                    build and comply with city regulations, impact fees, and delays in building a new
                                    restaurant. </td>
                                <td style="width: 2%"></td>
                            </tr>
                            <tr>
                                <td style="width: 2%" height="0.4"></td>
                                <td style="width: 96%" height="0.4"></td>
                                <td style="width: 2%" height="0.4"></td>
                            </tr>
                            <tr>
                                <td style="width: 2%"></td>
                                <td style="width: 96%"
                                    style="text-align:justify;color: #000000;padding:0px;margin:0px;font-family: 'Arimo', sans-serif;font-size:16px; line-height:22px; font-weight:400;">
                                    There are very rare cases, depending on market conditions whereby someone gets a
                                    premium for a location.</td>
                                <td style="width: 2%"></td>
                            </tr>
                            <tr>
                                <td style="width: 2%" height="0.4"></td>
                                <td style="width: 96%" height="0.4"></td>
                                <td style="width: 2%" height="0.4"></td>
                            </tr>
                            <tr>
                                <td style="width: 2%"></td>
                                <td style="width: 96%"
                                    style="text-align:justify;color: #000000;padding:0px;margin:0px;font-family: 'Arimo', sans-serif;font-size:16px; line-height:22px; font-weight:400;">
                                    When a second generation restaurant space goes on the market because a concept is
                                    failing, it becomes an asset sale. The seller ends up selling for pennies on the
                                    dollar based on the cost of his or her original build-out.</td>
                                <td style="width: 2%"></td>
                            </tr>
                            <tr>
                                <td style="width: 2%" height="0.4"></td>
                                <td style="width: 96%" height="0.4"></td>
                                <td style="width: 2%" height="0.4"></td>
                            </tr>
                            <tr>
                                <td style="width: 2%"></td>
                                <td style="width: 96%"
                                    style="text-align:justify;color: #000000;padding:0px;margin:0px;font-family: 'Arimo', sans-serif;font-size:16px; line-height:22px; font-weight:400;">
                                    Asset sales are valued using the replacement value method and only when the assets
                                    are available for sale without demonstrated earnings. The advertising on this type
                                    listing should state it is an asset sale only and that no books and records are
                                    available. </td>
                                <td style="width: 2%"></td>
                            </tr>
                            <tr>
                                <td style="width: 2%" height="0.4"></td>
                                <td style="width: 96%" height="0.4"></td>
                                <td style="width: 2%" height="0.4"></td>
                            </tr>
                            <tr>
                                <td style="width: 2%"></td>
                                <td style="width: 96%"
                                    style="text-align:justify;color: #000000;padding:0px;margin:0px;font-family: 'Arimo', sans-serif;font-size:16px; line-height:22px; font-weight:400;">
                                    You are purchasing a business for the furniture, fixtures, equipment, and location.
                                </td>
                                <td style="width: 2%"></td>
                            </tr>
                            <tr>
                                <td style="width: 2%" height="0.4"></td>
                                <td style="width: 96%" height="0.4"></td>
                                <td style="width: 2%" height="0.4"></td>
                            </tr>
                            <tr>
                                <td style="width: 2%"></td>
                                <td style="width: 96%"
                                    style="text-align:justify;color: #000000;padding:0px;margin:0px;font-family: 'Arimo', sans-serif;font-size:18px; line-height:32px; font-weight:700;">
                                    Frequently Asked Questions</td>
                                <td style="width: 2%"></td>
                            </tr>
                            <tr>
                                <td style="width: 2%"></td>
                                <td style="width: 96%"
                                    style="text-align:justify;color: #000000;padding:0px;margin:0px;font-family: 'Arimo', sans-serif;font-size:18px; line-height:32px; font-weight:700;">
                                    What is the value of an asset sale?</td>
                                <td style="width: 2%"></td>
                            </tr>
                            <tr>
                                <td style="width: 2%"></td>
                                <td style="width: 96%"
                                    style="text-align:justify;color: #000000;padding:0px;margin:0px;font-family: 'Arimo', sans-serif;font-size:16px; line-height:22px; font-weight:400;">
                                    The value varies based on the location but under normal market conditions, a buyer
                                    can expect to pay between 20 and 30 cents on the dollar of the original build out.
                                    For example, if someone spent $250,000 to build out a restaurant, it may go on the
                                    market for around $50,000.</td>
                                <td style="width: 2%"></td>
                            </tr>
                            <tr>
                                <td style="width: 2%" height="0.4"></td>
                                <td style="width: 96%" height="0.4"></td>
                                <td style="width: 2%" height="0.4"></td>
                            </tr>
                            <tr>
                                <td style="width: 2%"></td>
                                <td style="width: 96%"
                                    style="text-align:justify;color: #000000;padding:0px;margin:0px;font-family: 'Arimo', sans-serif;font-size:18px; line-height:32px; font-weight:700;">
                                    Why can\'t I see the books and records?</td>
                                <td style="width: 2%"></td>
                            </tr>
                            <tr>
                                <td style="width: 2%"></td>
                                <td style="width: 96%"
                                    style="text-align:justify;color: #000000;padding:0px;margin:0px;font-family: 'Arimo', sans-serif;font-size:16px; line-height:22px; font-weight:400;">
                                    An asset sale is not priced as a "going concern" since the new owner will be
                                    bringing their own menu, staff, brand and promotion. The only thing remaining from
                                    the old restaurant will be the bones of the kitchen and decor. Since your restaurant
                                    will bear very little resemblance to the former restaurant, the sales and expenses
                                    will be meaningless to you. Obviously, if they were highly profitable, they would be
                                    priced much higher. </td>
                                <td style="width: 2%"></td>
                            </tr>
                            <tr>
                                <td style="width: 2%" height="0.4"></td>
                                <td style="width: 96%" height="0.4"></td>
                                <td style="width: 2%" height="0.4"></td>
                            </tr>
                            <tr>
                                <td style="width: 2%"></td>
                                <td style="width: 96%"
                                    style="text-align:justify;color: #000000;padding:0px;margin:0px;font-family: 'Arimo', sans-serif;font-size:18px; line-height:32px; font-weight:700;">
                                    Why shouldn\'t I just get a space that used to be a restaurant and start from
                                    scratch?</td>
                                <td style="width: 2%"></td>
                            </tr>
                            <tr>
                                <td style="width: 2%"></td>
                                <td style="width: 96%"
                                    style="text-align:justify;color: #000000;padding:0px;margin:0px;font-family: 'Arimo', sans-serif;font-size:16px; line-height:22px; font-weight:400;">
                                    A closed restaurant space is often referred to as a "second generation" space. There
                                    are pros and cons to doing a startup in a second generation space versus buying an
                                    open and operating location.</td>
                                <td style="width: 2%"></td>
                            </tr>
                            <tr>
                                <td style="width: 2%" height="0.4"></td>
                                <td style="width: 96%" height="0.4"></td>
                                <td style="width: 2%" height="0.4"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
        <!-- page 13 -->
        <div id="page13" style="page-break-before: always;">
            <table width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="background-color: #ddd; padding: 10px 0px;">
                        <table width="100%" cellspacing="0" cellpadding="0">
                            <tr>
                                <td style="width: 2%" height="1"></td>
                                <td style="width: 96%" height="1"></td>
                                <td style="width: 2%" height="1"></td>
                            </tr>
                            <tr>
                                <td style="width: 2%"></td>
                                <td style="width: 96%"
                                    style="text-align:justify;color: #000000;padding:0px;margin:0px;font-family: 'Arimo', sans-serif;font-size:18px; line-height:32px; font-weight:700;">
                                    Advantages of Acquiring a Turnaround Opportunity</td>
                                <td style="width: 2%"></td>
                            </tr>
                            <tr>
                                <td style="width: 2%" height="0.4"></td>
                                <td style="width: 96%" height="0.4"></td>
                                <td style="width: 2%" height="0.4"></td>
                            </tr>
                            <tr>
                                <td style="width: 2%"></td>
                                <td style="width: 96%"
                                    style="text-align:justify;color: #000000;padding:0px;margin:0px;font-family: 'Arimo', sans-serif;font-size:18px; line-height:32px; font-weight:700;">
                                    Time to Market</td>
                                <td style="width: 2%"></td>
                            </tr>
                            <tr>
                                <td style="width: 2%"></td>
                                <td style="width: 96%"
                                    style="text-align:justify;color: #000000;padding:0px;margin:0px;font-family: 'Arimo', sans-serif;font-size:16px;line-height:22px; font-weight:400;">
                                    An open and operating restaurant is permitted, has an existing base of business and
                                    may only require better operations or marketing to be more successful. A second
                                    generation space is closed and generally does not include any equipment outside of
                                    basic infrastructure like a hood and grease trap. A new operator will need to
                                    permit, equip, market and open a closed restaurant space which will add considerably
                                    to the timeline to be open for business.</td>
                                <td style="width: 2%"></td>
                            </tr>
                            <tr>
                                <td style="width: 2%" height="0.4"></td>
                                <td style="width: 96%" height="0.4"></td>
                                <td style="width: 2%" height="0.4"></td>
                            </tr>
                            <tr>
                                <td style="width: 2%"></td>
                                <td style="width: 96%"
                                    style="text-align:justify;color: #000000;padding:0px;margin:0px;font-family: 'Arimo', sans-serif;font-size:18px;line-height:32px; font-weight:700;">
                                    Cost to Open the Restaurant</td>
                                <td style="width: 2%"></td>
                            </tr>
                            <tr>
                                <td style="width: 2%"></td>
                                <td style="width: 96%"
                                    style="text-align:justify;color: #000000;padding:0px;margin:0px;font-family: 'Arimo', sans-serif;font-size:16px;line-height:22px; font-weight:400;">
                                    We Sell Restaurants has a number of asset sales or turnaround locations priced very
                                    competitively that are turnkey and ready to go. These are often priced far below the
                                    cost to equip and open a restaurant even in a closed down location. An existing
                                    asset sale is fully equipped from the back of the house to the front of the house.
                                    Everything is included down to smallwares. A quick coat of paint or minor decor
                                    changes can have you ready to go at minimal expense. </td>
                                <td style="width: 2%"></td>
                            </tr>
                            <tr>
                                <td style="width: 2%" height="0.4"></td>
                                <td style="width: 96%" height="0.4"></td>
                                <td style="width: 2%" height="0.4"></td>
                            </tr>
                            <tr>
                                <td style="width: 2%"></td>
                                <td style="width: 96%"
                                    style="text-align:justify;color: #000000;padding:0px;margin:0px;font-family: 'Arimo', sans-serif;font-size:18px;">
                                    Ready to Go</td>
                                <td style="width: 2%"></td>
                            </tr>
                            <tr>
                                <td style="width: 2%"></td>
                                <td style="width: 96%"
                                    style="text-align:justify;color: #000000;padding:0px;margin:0px;font-family: 'Arimo', sans-serif;font-size:16px;">
                                    Time is your enemy. Your great idea may be opening around the corner while you\'re
                                    trying to find that last piece of equipment and juggle the installation, painting,
                                    and inspections for what is essentially a new restaurant launch. <br /> <br /> With
                                    the purchase of an asset sale, you avoid the pitfalls and can do a menu change,
                                    marketing re-launch and you\'re ready to go. </td>
                                <td style="width: 2%"></td>
                            </tr>
                            <tr>
                                <td style="width: 2%" height="0.6"></td>
                                <td style="width: 96%" height="0.4"></td>
                                <td style="width: 2%" height="0.4"></td>
                            </tr>
                            <tr>
                                <td style="width: 2%"></td>
                                <td style="width: 96%"
                                    style="text-align:justify;color: #000000;padding:0px;margin:0px;font-family: 'Arimo', sans-serif;font-size:18px;line-height:32px; font-weight:700;">
                                    Lease Assumption </td>
                                <td style="width: 2%"></td>
                            </tr>
                            <tr>
                                <td style="width: 2%"></td>
                                <td style="width: 96%"
                                    style="text-align:justify;color: #000000;padding:0px;margin:0px;font-family: 'Arimo', sans-serif;font-size:16px;line-height:22px; font-weight:400;">
                                    Physical location is very important to the restaurant owner. The length and value of
                                    the lease and its cost as a percent of total sales is a key financial determination
                                    of success. In most large markets, rising rent costs in the past decade have made
                                    this variable even more important. <br /> Competition to be in the most desirable
                                    parts of the dining scene has driven rents to all-time highs with no end in sight.
                                    For these reasons, acquisition of a existing business may be the only way to gain a
                                    space in these highly competitive markets. <br /> <br /> A restaurant buyer is often
                                    assigned the existing rights of the current tenant along with options to renew the
                                    lease. This is called an assignment and assumption of the lease. This can be more
                                    advantageous to a buyer than getting a new lease in a closed restaurant location
                                    subject to current market rates. <br /> <br /> <i>When speaking to anyone about
                                        lease rates be sure that the Annual Rent Expense you are quoted includes CAMS or
                                        Common Area Maintenance Charges, Taxes, and Insurance. These "additional" items
                                        substantially increase the rental rates.</i> </td>
                                <td style="width: 2%"></td>
                            </tr>
                            <tr>
                                <td style="width: 2%" height="0.4"></td>
                                <td style="width: 96%" height="0.4"></td>
                                <td style="width: 2%" height="0.4"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
        <!-- page 13.1  -->
        <div id="page14" style="page-break-before: always;">
            <table width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td>
                        <table cellpadding="0" cellspacing="0" width="100%" bgcolor="white">
                            <tr>
                                <td colspan="2" style="height: 8px"></td>
                            </tr>
                            <tr>
                                <td style="width: 4%"></td>
                                <td
                                    style="width: 92%;text-align:left;color: #ff0606;font-family: 'Arimo', sans-serif; font-size: 48px; line-height: 60px; padding-bottom: 20px;">
                                    Restaurant Photos</td>
                            </tr>
                            <tr>
                                <td colspan="2" height="40px"></td>
                            </tr>
                            <tr>
                                <td style="width: 4%"></td>
                                <td style="width: 92%;text-align: center;">
                                    @if(isset($val->img_file))
                                    <img src="{{ url('storage/images/list/main_images/'.$val->img_file) }}"
                                        alt="product" style="max-height: 300px; max-width: 100%;" />
                                    @else
                                    <img src="" alt="product" style="max-height: 300px; max-width: 100%;" />
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" height="15px"></td>
                            </tr>
                            <tr>
                                <td style="width: 4%"></td>
                                <td style="width: 92%;text-align: center;">
                                    @if(isset($val->sub_img_file))
                                    <img src="{{ url('storage/images/list/sub_images/'.$val->sub_img_file) }}"
                                        alt="product" style="max-height: 300px; max-width: 100%;" />
                                    @else
                                    <img src="" alt="product" style="max-height: 300px; max-width: 100%;" />
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" height="15px"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
        <!-- page 13.2 -->
        <div style="page-break-before: always;">
            <table width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td>
                        <table cellpadding="0" cellspacing="0" width="100%"
                            style="background-color: #fff; border-collapse: separate; border-spacing: 0px 15px;">

                            <tr>
                                @php
                                $counter=0
                                @endphp
                                @if(isset($sub_img))
                                @if(count($sub_img)>0)
                                @foreach($sub_img as $k=>$v)
                                <td style="padding: 0px 10px;">
                                    <img src="{{ url('storage/images/list/sub_images/'.$v->sub_img_file) }}"
                                        alt="product" style="height: 200px; width: 100%;" />
                                </td>
                                @php
                                $counter++
                                @endphp
                                @if ($counter >= 2)
                            </tr>
                            <tr>
                                @php
                                $counter=0
                                @endphp
                                @endif


                                @endforeach
                                @endif
                                @endif
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
        <!-- page 13.3 -->
        <div id="page15" style="page-break-before: always;">
            <table width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td>
                        <table cellpadding="0" cellspacing="0" width="100%"
                            style="border-collapse: separate; border-spacing: 0px 15px;">
                            <tr>
                                <td colspan="3"
                                    style="font-family: 'Arimo', sans-serif; padding-left: 10px; margin:0;color:#fff;font-size:30px; font-weight:bold; background-color: #333333;height: 60px; vertical-align: middle;">
                                    &nbsp; NEXT STEPS</td>
                            </tr>
                            <tr>
                                <td colspan="3" height="20"></td>
                            </tr>
                            <tr>
                                <td style="width: 88px; vertical-align: middle">
                                    <img src="{{ public_path('assets/images/print_pdf/step-1pdfs.png') }}" alt="step"
                                        style="max-width: 100px; height: auto; vertical-align: middle" />
                                </td>
                                <td style="width: 20px">
                                </td>
                                <td
                                    style="width: 390px; font-family: 'Arimo', sans-serif; font-size:18px; line-height:26px; color: #000; vertical-align: middle">
                                    Review the listing package and visit the restaurant undercover
                                    as a secret shopper.
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" height="4"></td>
                            </tr>
                            <tr>
                                <td style="width: 88px; vertical-align: middle">
                                    <img src="{{ public_path('assets/images/print_pdf/step-2pdfs.png') }}" alt="step"
                                        style="max-width: 100px; height: auto; vertical-align: middle" />
                                </td>
                                <td style="width: 20px">
                                </td>
                                <td
                                    style="width: 390px; font-family: 'Arimo', sans-serif; font-size:18px; line-height:26px; color: #000; vertical-align: middle">
                                    Contact the listing agent and schedule a meeting with the seller
                                    through your Certified Restaurant Broker&reg;.
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" height="4"></td>
                            </tr>
                            <tr>
                                <td style="width: 88px; vertical-align: middle">
                                    <img src="{{ public_path('assets/images/print_pdf/step-3pdfs.png') }}" alt="step"
                                        style="max-width: 100px; height: auto; vertical-align: middle" />
                                </td>
                                <td style="width: 20px"></td>
                                <td
                                    style="width: 390px; font-family: 'Arimo', sans-serif; font-size:18px; line-height:26px; color: #000; vertical-align: middle">
                                    Submit an offer contingent on due diligence, landlord approval,
                                    lending approval and franchise consent.
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" height="4"></td>
                            </tr>
                            <tr>
                                <td style="width: 88px; vertical-align: middle">
                                    <img src="{{ public_path('assets/images/print_pdf/step-4pdfs.png') }}" alt="step"
                                        style="max-width: 100px; height: auto; vertical-align: middle" />
                                </td>
                                <td style="width: 20px"></td>
                                <td
                                    style="width: 390px; font-family: 'Arimo', sans-serif; font-size:18px; line-height:26px; color: #000; vertical-align: middle">
                                    Once offer is accepted, deposit earnest money and start Due Diligence.
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" height="4"></td>
                            </tr>
                            <tr>
                                <td style="width: 88px; vertical-align: middle">
                                    <img src="{{ public_path('assets/images/print_pdf/step-5pdfs.png') }}" alt="step"
                                        style="max-width: 100px; height: auto; vertical-align: middle" />
                                </td>
                                <td style="width: 20px"></td>
                                <td
                                    style="width: 390px; font-family: 'Arimo', sans-serif; font-size:18px; line-height:26px; color: #000; vertical-align: middle">
                                    Schedule the closing and complete all documents and escrow.
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" height="4"></td>
                            </tr>
                            <tr>
                                <td style="width: 88px; vertical-align: middle">
                                    <img src="{{ public_path('assets/images/print_pdf/step-6pdfs.png') }}" alt="step"
                                        style="max-width: 100px; height: auto; vertical-align: middle" />
                                </td>
                                <td style="width: 20px"></td>
                                <td
                                    style="width: 390px; font-family: 'Arimo', sans-serif; font-size:18px; line-height:26px; color: #000; vertical-align: middle">
                                    Congratulations! You have achieved your goal of restaurant
                                    ownership.
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
        <!-- page 13.4 -->
        <div style="page-break-before: always;">
            <table width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td colspan="3"
                        style="font-family: 'Arimo', sans-serif; padding-left: 10px; margin:0;color:#fff;font-size:30px; font-weight:bold; background-color: #333333;height: 60px; vertical-align: middle;">
                        &nbsp; VISIT THE RESTAURANT</td>
                </tr>
                <tr>
                    <td colspan="3" height="20"></td>
                </tr>
                <tr>
                    <td colspan="3" bgcolor="white">
                        <table cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td colspan="2" height="4"></td>
                            </tr>
                            <tr>
                                <td style="width: 2%;"></td>
                                <td
                                    style="width: 96%; font-family: 'Arimo', sans-serif; font-size: 24px; line-height:36px; color: #000; font-weight: bold;">
                                    Get the Most Out of Your Visit:</td>
                            </tr>
                            <tr>
                                <td colspan="2" height="1"></td>
                            </tr>
                            <tr>
                                <td style="width: 2%;"></td>
                                <td
                                    style="width: 96%; font-family: 'Arimo', sans-serif; font-size:16px; line-height:22px; color: #000;">
                                    As a restaurant
                                    buyer, one of the most important things you can do is visit as a secret shopper or
                                    go "undercover" to learn about a business. This is a critical step. Visit without
                                    alerting anyone about your interest in the restaurant. By doing so, youll be able to
                                    get an unbiased view of what\'s going on in the location. We recommend observing
                                    details such as,</td>
                            </tr>
                            <tr>
                                <td colspan="2" height="1"></td>
                            </tr>
                            <tr>
                                <td style="width: 2%;"></td>
                                <td style="width: 96%;">
                                    <ul style="margin: 0; padding: 0 0 0 30px;">
                                        <li style="font-family: 'Arimo', sans-serif; font-size:16px; line-height:22px; color: #000000"">the overall
                                            location</li>
                                        <li style=" font-family: 'Arimo' , sans-serif; font-size:16px;
                                            line-height:22px; color: #000000"">the parking
                                            situation</li>
                                        <li style="font-family: 'Arimo', sans-serif; font-size:16px; line-height:22px; color: #000000"">the signage</li>
                                        <li style=" font-family: 'Arimo' , sans-serif; font-size:16px;
                                            line-height:22px; color: #000000"">the staff</li>
                                        <li style="font-family: 'Arimo', sans-serif; font-size:16px; line-height:22px; color: #000000"">the cleanliness
                                        </li>
                                        <li style=" font-family: 'Arimo' , sans-serif; font-size:16px;
                                            line-height:22px; color: #000000"">the menu</li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" height="1"></td>
                            </tr>
                            <tr>
                                <td style="width: 2%;"></td>
                                <td
                                    style="width: 96%; font-family: 'Arimo', sans-serif; font-size:16px; line-height:22px; color: #000;">
                                    Remember that
                                    the restaurant for sale is not public knowledge, so it is best to avoid taking
                                    pictures or making notes while inside the restaurant. Additionally, wait until after
                                    you have left the restaurant before you talk about the business or ask questions
                                    about its operations. You will have an opportunity to discuss these items at the
                                    next step, the Buyer and Seller meeting! </td>
                            </tr>
                            <tr>
                                <td colspan="2" height="4"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" height="8"></td>
                </tr>
                <tr>
                    <td style="width: 310px;" bgcolor="white">
                        <table cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td colspan="4" height="40"></td>
                            </tr>
                            <tr>
                                <td width="2%"></td>
                                <td style="width: 57px;">
                                    <img src="{{ public_path('assets/images/print_pdf/spoons.png') }}" alt="spoon"
                                        style="width: 57px; height: 128px;" />
                                </td>
                                <td style="width: 15px"></td>
                                <td style="width: 55%">
                                    <table cellpadding="0" cellspacing="0" width="100%">
                                        <tr>
                                            <td
                                                style="font-family: 'Arimo', sans-serif; font-size: 22px; line-height: 32px; font-weight:bold; color: #000">
                                                SEE MORE</td>
                                        </tr>
                                        <tr>
                                            <td style="height: 20px;"></td>
                                        </tr>
                                        <tr>
                                            <td
                                                style="font-family: 'Arimo', sans-serif; font-size:16px; line-height:22px; font-weight:bold; color: #000; line-height: 25px;">
                                                <a href="https://blog.wesellrestaurants.com/topic/buying-a-restaurant"
                                                    style="color: #000; text-decoration: none; font-weight:bold;">Buyer
                                                    Tips</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td
                                                style="font-family: 'Arimo', sans-serif; font-size:16px; line-height:22px; font-weight:bold; color: #000; line-height: 25px;">
                                                <a href="https://www.wesellrestaurants.com/testimonial.php"
                                                    style="color: #000; text-decoration: none; font-weight:bold;">Buyer
                                                    Reviews</a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" height="4"></td>
                            </tr>
                        </table>
                    </td>
                    <td style="width: 15px;"></td>
                    <td style="width: 200px;">
                        <img src="{{ public_path('assets/images/print_pdf/buy-image.png') }}" alt="buys"
                            style="width: 200px; height: 204px;" />
                    </td>
                </tr>
            </table>
        </div>
        <!-- page 14 -->
        <div id="page16" style="page-break-before: always;">
            <table width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td>
                        <table cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td
                                    style="text-align:left;color: #ff0606;font-family: 'Arimo', sans-serif; font-size: 48px; line-height: 60px; padding-bottom: 20px;">
                                    We Sell Restaurants</td>
                            </tr>
                            <tr>
                                <td height="4px"></td>
                            </tr>
                            <tr>
                                <td
                                    style="text-align:justify;color: #000000;padding:0px;margin:0px;font-family: 'Arimo', sans-serif;font-size:16px; line-height:22px; font-weight:400; ">
                                    We Sell Restaurants&reg; is the industry leader in restaurants for sale. Our mission
                                    is to sell more restaurants than anyone else - PERIOD and our name says it all. We
                                    Sell Restaurants! We are specialists in selling restaurants, restaurant space for
                                    lease and we lead the nation in franchise restaurants for sale that are open and
                                    operating - franchise resales. <br /> <br /> The We Sell Restaurants brand is known
                                    nationwide for professionalism, industry knowledge and unmatched service. Whether
                                    you are in the market to buy a restaurant, find a restaurant for lease, resell a
                                    restaurant franchise or sell an independent restaurant or bar, the We Sell
                                    Restaurantss&reg; brand is unmatched in experience and knowledge. <br /> <br /> Our
                                    website is an invaluable resource where we focus on sharing knowledge, information
                                    and of course, restaurants for sale listings. We train and certify the best in the
                                    industry with the only Certified Restaurant Broker&reg; program in the nation.</td>
                            </tr>
                            <tr>
                                <td height="30px"></td>
                            </tr>
                            <tr>
                                <td style="text-align: center; width: 100%;"><img
                                        src="{{ public_path('assets/images/print_pdf/kitchens.png') }}" alt="owner"
                                        style="width: 309px; height: 194px;" /></td>
                            </tr>
                            <tr>
                                <td height="30px"></td>
                            </tr>
                            <tr>
                                <td style="background-color: #333">
                                    <table cellpadding="0" cellspacing="0" width="100%">
                                        <tr>
                                            <td style="width: 20px"></td>
                                            <td style="width: 310px;">
                                                <table cellpadding="0" cellspacing="0" width="100%">
                                                    <tr>
                                                        <td style="height: 40px"></td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            style="color: #fff; font-family: 'Arimo', sans-serif; font-size:24px; line-height:36px; font-weight: bold; color: #fff;">
                                                            Join Our Franchise</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="height: 6px;"></td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            style="color: #fff; font-family: 'Arimo', sans-serif; font-size:18px; line-height:34px; color: #fff;">
                                                            Learn more about our Specialized Business Broker Franchise
                                                            for Restaurants. Select markets now available! <br> <br>
                                                            Visit <a href="https://www.wesellrestaurants.com/franchise"
                                                                style="color: #fff; text-decoration: none;">wesellrestaurants.com/franchise</a>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td style="width: 20px"></td>
                                            <td style="Width: 150px;">
                                                <img align="middle"
                                                    src="{{ public_path('assets/images/print_pdf/logo-pdfs.png') }}"
                                                    alt="logo"
                                                    style="width: 150px; height: 150px; vertical-align: middle;" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="height: 20px;"></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
        <!-- page 15 -->
        <div id="page17" style="page-break-before: always;">
            <table width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="height: 190px"></td>
                </tr>
                <tr>
                    <td style="text-align: center;">
                        <img align="middle" src="{{ public_path('assets/images/print_pdf/logo-pdfs.png') }}" alt="logo"
                            style="width: 200px; height: 200px; vertical-align: middle;" />
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="height: 20px"></td>
                </tr>
                <tr>
                    <td style="text-align: center;">
                        <a href="https://www.wesellrestaurants.com/restaurant-for-sale-near-me"
                            style="font-family: 'Arimo', sans-serif; font-size:24px; line-height:36px; color: #333333; font-weight: bold; text-decoration: none;">SEE
                            ALL OUR LISTINGS</a>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="height: 80px"></td>
                </tr>
                <tr>
                    <td>
                        <table width="100%" cellspacing="0" cellpadding="0">
                            <tr>
                                <td style="width: 20px;"></td>
                                <td
                                    style="width: 200px; font-family: 'Arimo', sans-serif; font-size:24px; line-height:36px; color: #333; font-weight: bold;">
                                    MORE RESOURCES</td>
                                <td style="width: 20px;"></td>
                                <td
                                    style="width: 310px; font-family: 'Arimo', sans-serif; font-size:24px; line-height:36px; color: #333; font-weight: bold;">
                                    CONTACT US</td>
                            </tr>
                            <tr>
                                <td style="width: 20px; background-color: #333;"></td>
                                <td style="width: 200px; background-color: #333;">
                                    <table width="100%" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td style="height: 20px;"></td>
                                        </tr>
                                        <tr>
                                            <td><a href="https://blog.wesellrestaurants.com/how-to-be-a-secret-shopper-when-buying-a-restaurant"
                                                    style="color: #fff; font-family: 'Arimo', sans-serif; font-size:16px; line-height: 36px; text-decoration: none;">Secret
                                                    Shopper Tips</a></td>
                                        </tr>
                                        <tr>
                                            <td style="height: 2px;"></td>
                                        </tr>
                                        <tr>
                                            <td><a href="https://blog.wesellrestaurants.com/whats-it-making-understand-sellers-discretionary-earnings-when-buying-a-restaurant"
                                                    style="color: #fff; font-family: 'Arimo', sans-serif; font-size:16px; line-height: 36px; text-decoration: none;">What\'s
                                                    it Making? Understand Sellers Discretionary Earnings</a></td>
                                        </tr>
                                        <tr>
                                            <td style="height: 2px;"></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 267px;"><a
                                                    href="https://blog.wesellrestaurants.com/how-to-buy-a-restaurant-the-9-steps-from-inquiry-to-closing"
                                                    style="color: #fff; font-family: 'Arimo', sans-serif; font-size:16px; line-height: 36px; text-decoration: none;">The
                                                    9 steps from Inquiry to Closing <br /></a></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 267px;"><a
                                                    href="https://www.wesellrestaurants.com/restaurants-for-sale/Restaurant-Financing"
                                                    style="color: #fff; font-family: 'Arimo', sans-serif; font-size:16px; line-height: 36px; text-decoration: none;">Guide
                                                    to Restaurant Financing</a></td>
                                        </tr>
                                        <tr>
                                            <td style="height: 20px;"></td>
                                        </tr>
                                    </table>
                                </td>
                                <td style="width: 20px; background-color: #333;"></td>
                                <td style="width: 310px; background-color: #333; vertical-align:top;">
                                    <table width="100%" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td colspan="3" style="height: 20px;"></td>
                                        </tr>
                                        <tr>
                                            <td align="middle" style="width: 28px;"><img align="middle"
                                                    src="{{ public_path('assets/images/print_pdf/phone-redi.png') }}"
                                                    alt="phone" style="height: 28px; width: 28px;" /></td>
                                            <td style="width: 15px;"></td>
                                            <td align="middle"><a href="tel: 404-800-6700"
                                                    style="color: #fff; font-family: 'Arimo', sans-serif; font-size:16px; line-height: 36px; text-decoration: none; display: inline-block; ">404-800-6700</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" style="height: 2px;"></td>
                                        </tr>
                                        <tr>
                                            <td align="middle" style="width: 28px;"><img align="middle"
                                                    src="{{ public_path('assets/images/print_pdf/globes.png') }}"
                                                    alt="phone" style="height: 28px; width: 28px;" /></td>
                                            <td style="width: 15px;"></td>
                                            <td align="middle" style="width: 267px;"><a
                                                    href="https://www.wesellrestaurants.com/"
                                                    style="color: #fff; font-family: 'Arimo', sans-serif; font-size:16px; line-height: 36px; text-decoration: none; display: inline-block; ">https://www.wesellrestaurants.com/</a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </main>
</body>

</html>