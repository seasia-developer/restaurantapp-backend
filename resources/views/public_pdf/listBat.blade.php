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

if (isset($result['listing_bat']['foodCosts'])) {
    $foodCosts = $result['listing_bat']['foodCosts'];
}
if (isset($result['listing_bat']['alcohalCosts'])) {
    $alcohalCosts = $result['listing_bat']['alcohalCosts'];
}
if (isset($result['listing_bat']['otherCogs'])) {
    $otherCogs = $result['listing_bat']['otherCogs'];
}

if (isset($result['listing_bat']['advertising'])) {
    $advertising = $result['listing_bat']['advertising'];
}
if (isset($result['listing_bat']['auto'])) {
    $auto = $result['listing_bat']['auto'];
}
if (isset($result['listing_bat']['bankCharges'])) {
    $bankCharges = $result['listing_bat']['bankCharges'];
}
if (isset($result['listing_bat']['depreciation'])) {
    $depreciation = $result['listing_bat']['depreciation'];
}
if (isset($result['listing_bat']['duesSubscriptions'])) {
    $duesSubscriptions = $result['listing_bat']['duesSubscriptions'];
}
if (isset($result['listing_bat']['insurance'])) {
    $insurance = $result['listing_bat']['insurance'];
}
if (isset($result['listing_bat']['interestExpense'])) {
    $interestExpense = $result['listing_bat']['interestExpense'];
}
if (isset($result['listing_bat']['legal'])) {
    $legal = $result['listing_bat']['legal'];
}
if (isset($result['listing_bat']['licensesFees'])) {
    $licensesFees = $result['listing_bat']['licensesFees'];
}
if (isset($result['listing_bat']['miscellaneous'])) {
    $miscellaneous = $result['listing_bat']['miscellaneous'];
}
if (isset($result['listing_bat']['payrollTaxes'])) {
    $payrollTaxes = $result['listing_bat']['payrollTaxes'];
}
if (isset($result['listing_bat']['postageDelivery'])) {
    $postageDelivery = $result['listing_bat']['postageDelivery'];
}
if (isset($result['listing_bat']['ownerPersonalExpenses'])) {
    $ownerPersonalExpenses = $result['listing_bat']['ownerPersonalExpenses'];
}
if (isset($result['listing_bat']['rent'])) {
    $rent = $result['listing_bat']['rent'];
}
if (isset($result['listing_bat']['repairsMaintenance'])) {
    $repairsMaintenance = $result['listing_bat']['repairsMaintenance'];
}
if (isset($result['listing_bat']['restaurantSupplies'])) {
    $restaurantSupplies = $result['listing_bat']['restaurantSupplies'];
}
if (isset($result['listing_bat']['royalties'])) {
    $royalties = $result['listing_bat']['royalties'];
}
if (isset($result['listing_bat']['salariesWages'])) {
    $salariesWages = $result['listing_bat']['salariesWages'];
}
if (isset($result['listing_bat']['telephone'])) {
    $telephone = $result['listing_bat']['telephone'];
}
if (isset($result['listing_bat']['utilities'])) {
    $utilities = $result['listing_bat']['utilities'];
}
if (isset($result['listing_bat']['uniforms'])) {
    $uniforms = $result['listing_bat']['uniforms'];
}
if (isset($result['listing_bat']['otherUncategorized'])) {
    $otherUncategorized = $result['listing_bat']['otherUncategorized'];
}
if (isset($result['listing_bat']['officeSupplies'])) {
    $officeSupplies = $result['listing_bat']['officeSupplies'];
}
if (isset($result['listing_bat']['janitorial'])) {
    $janitorial = $result['listing_bat']['janitorial'];
}
if (isset($result['listing_bat']['equipmentlease'])) {
    $equipmentlease = $result['listing_bat']['equipmentlease'];
}
if (isset($result['listing_bat']['donations'])) {
    $donations = $result['listing_bat']['donations'];
}
if (isset($result['listing_bat']['filledfieldvalue'])) {
    $filledfieldvalue = $result['listing_bat']['filledfieldvalue'];
}

if (isset($result['listing_bat']['foodCosts_2'])) {
    $foodCosts_2 = $result['listing_bat']['foodCosts_2'];
}
$ownerSalary = 0;
if (isset($result['listing_bat']['ownerSalary'])) {
    $ownerSalary = $result['listing_bat']['ownerSalary'];
}
$benefits = 0;
if(isset($result['listing_bat']['benefits'])){
    $benefits = $result['listing_bat']['benefits'];
}
$interestExpense = 0;
if(isset($result['listing_bat']['interestExpense'])){
    $interestExpense = $result['listing_bat']['interestExpense'];
}
$depreciation = 0;
if(isset($result['listing_bat']['depreciation'])){
    $depreciation = $result['listing_bat']['depreciation'];
}
$other = 0;
if(isset($result['listing_bat']['other'])){
    $other = $result['listing_bat']['other'];
}
$ownerPersonalExpenses = 0;
if(isset($result['listing_bat']['ownerPersonalExpenses'])){
    $ownerPersonalExpenses = $result['listing_bat']['ownerPersonalExpenses'];
}


if (isset($result['listing_bat']['grossSales'])) {
    $gross_sales = $result['listing_bat']['grossSales'];
    if ((int)$result['listing_bat']['grossSales'] > 0) {

        $totalCOGS = $batMap->getTotalCOGS($foodCosts, $alcohalCosts, $otherCogs);

        $grossMargin = $batMap->getGrossMargin($gross_sales, $totalCOGS);

        $totalExpenses = $batMap->getTotalExpenses($advertising, $auto, $bankCharges, $creditCardFees, $depreciation, $duesSubscriptions, $insurance, $interestExpense, $legal, $licensesFees, $miscellaneous, $payrollTaxes, $postageDelivery, $ownerPersonalExpenses, $rent, $repairsMaintenance, $restaurantSupplies, $royalties, $salariesWages, $telephone, $utilities, $uniforms, $otherUncategorized, $officeSupplies, $janitorial, $equipmentlease, $donations, $filledfieldvalue);

        $netIncome = $batMap->getNetIncome($grossMargin, $totalExpenses);

        $totalAddBacks = $batMap->getTotalAddBacks($ownerSalary, $benefits, $interestExpense, $depreciation,
        $other, $ownerPersonalExpenses);      

        $ownerBenefit = $batMap->getOwnerBenefit($netIncome, $totalAddBacks);      
    }
} else {
    $gross_sales = 0;
}
//
$foodCosts_2 = 0;
if(isset($result['listing_bat']['foodCosts_2'])){
    $foodCosts_2 = $result['listing_bat']['foodCosts_2'];
}

$alcohalCosts_2 = 0;
if(isset($result['listing_bat']['alcohalCosts_2'])){
    $alcohalCosts_2 = $result['listing_bat']['alcohalCosts_2'];
}

$otherCogs_2 = 0;
if(isset($result['listing_bat']['otherCogs_2'])){
    $otherCogs_2 = $result['listing_bat']['otherCogs_2'];
}
$benefits_2 = 0;
if(isset($result['listing_bat']['benefits_2'])){
    $benefits_2 = $result['listing_bat']['benefits_2'];
}

if (isset($result['listing_bat']['grossSales_2'])) {
    $grossSales1 = $result['listing_bat']['grossSales_2'];
    if ((int)$result['listing_bat']['grossSales_2'] > 0) {
        $totalCOGS1 = $batMap->getTotalCOGS($foodCosts_2, $alcohalCosts_2, $otherCogs_2);

        $grossMargin1 = $batMap->getGrossMargin($grossSales1, $totalCOGS1);

        $totalExpenses1 = $batMap->getTotalExpenses($result['listing_bat']['advertising_2'], $result['listing_bat']['auto_2'], $result['listing_bat']['bankCharges_2'], $result['listing_bat']['creditCardFees_2'], $result['listing_bat']['depreciation_3'], $result['listing_bat']['duesSubscriptions_2'], $result['listing_bat']['insurance_2'], $result['listing_bat']['interestExpense_3'], $result['listing_bat']['legal_2'], $result['listing_bat']['licensesFees_2'], $result['listing_bat']['miscellaneous_2'], $result['listing_bat']['payrollTaxes_2'], $result['listing_bat']['postageDelivery_2'], $result['listing_bat']['interestExpense_3'], $result['listing_bat']['rent_2'], $result['listing_bat']['repairsMaintenance_2'], $result['listing_bat']['restaurantSupplies_2'], $result['listing_bat']['royalties_2'], $result['listing_bat']['salariesWages_2'], $result['listing_bat']['telephone_2'], $result['listing_bat']['utilities_2'], $result['listing_bat']['uniforms_2'], $result['listing_bat']['otherUncategorized_2'], $result['listing_bat']['officeSupplies_2'], $result['listing_bat']['janitorial_2'], $result['listing_bat']['equipmentlease_2'], $result['listing_bat']['donations_2'], $result['listing_bat']['filledfieldvalue_2']);

        $netIncome1 = $batMap->getNetIncome($grossMargin1, $totalExpenses1);

        $totalAddBacks1 = $batMap->getTotalAddBacks($result['listing_bat']['ownerSalary_2'], $benefits_2, $result['listing_bat']['interestExpense_4'], $result['listing_bat']['depreciation_4'], $result['listing_bat']['ownerPersonalExpenses_4'], $result['listing_bat']['other_2']);

        $ownerBenefit1 = $batMap->getOwnerBenefit($netIncome1, $totalAddBacks1);

        $gross_sales1 = $result['listing_bat']['grossSales_2'];
    }
} else {
    $grossSales_2 = 0;
}

$equipmentlist = '';
$equi_text1 = '';
$equi_text2 = '';


if (isset($result['listing_bat']['equiptext'])) {
    $equiptext = $result['listing_bat']['equiptext'];
    $equipment_arr = explode("\\n", $equiptext);
    $total_eqp = count($equipment_arr);
    if ($total_eqp > 75) {
        $text1 = array_slice($equipment_arr, 0, 75); // break array into 0 to 31 chunks
        $text_half = array_chunk($text1, ceil(count($text1) / 2));
        $text_half[1] = [];
        $equi_text1 = implode("\n", $text_half[0]);
        $equi_text2 = implode("\n", $text_half[1]);
        $equipmentlist = '<table width="100%" border="0" cellspacing="0" cellpadding="0" nobr="true">
            <tr>
                <td colpan="4" height="8"></td>
            </tr>
            <tr>
                <td style="width: 2%"></td>
                <td style="width: 48%; font-size: 14px; font-family: "Arimo", sans-serif; line-height: 22px; color: #000;">' . nl2br($equi_text1) . '</td>
                <td style="width: 48%; font-size: 14px; font-family: "Arimo", sans-serif; line-height: 22px; color: #000;">' . nl2br($equi_text1) . '</td>
                <td style="width: 2%"></td>
            </tr>
        </table>';
    }
    // 
    if ($total_eqp <= 75) {

        $text1 = array_slice($equipment_arr, 0, 75); // break array into 0 to 31 chunks
        $text_half = array_chunk($text1, ceil(count($text1) / 2));
        $text_half[1] = [];
        $equi_text1 = implode("\n", $text_half[0]);
        $equi_text2 = implode("\n", $text_half[1]);
        $equipmentlist = '
            <table width="100%" border="0" cellspacing="0" cellpadding="0" nobr="true">
                <tr>
                    <td colpan="4" height="8"></td>
                </tr>
                <tr>
                    <td style="width: 2%"></td>
                    <td style="width: 48%; font-size: 14px; font-family: "Arimo", sans-serif; line-height: 22px; color: #000;">' . nl2br($equi_text1) . '</td>
                    <td style="width: 48%; font-size: 14px; font-family: "Arimo", sans-serif; line-height: 22px; color: #000;">' . nl2br($equi_text2) . '</td>
                    <td style="width: 2%"></td>
                </tr>
                <tr>
                    <td colpan="4" height="8"></td>
                </tr>
            </table>
        ';
    }
    // 
    if ($total_eqp > 150) {
        $text1 = array_slice($equipment_arr, 150, 75);
        //$text_half = array_chunk($text1, ceil(count($text1)/2));
        $equi_text1 = implode("\n", $text1);
        //$equi_text2 = implode("\n",$text_half[1]);
        $equipmentlist = '
            <table width="100%" border="0" cellspacing="0" cellpadding="0" nobr="true">
                <tr>
                    <td width="100%" bgcolor="white">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" nobr="true">
                            <tr>
                                <td colpan="4" height="8"></td>
                            </tr>
                            <tr>
                                <td style="width: 2%"></td>
                                <td style="width: 48%; font-size: 14px; font-family: "Arimo", sans-serif; line-height: 22px; color: #000;">' . nl2br($equi_text1) . '</td>
                                <td style="width: 2%"></td>
                            </tr>
                            <tr>
                                <td colpan="4" height="8"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        ';
    }
}

$sourceOfDataYear = '';
$sourceOfDataYear_2 = '';
if (isset($result['listing_bat']['sourceOfDataYear'])) {
    $sourceOfDataYear = $result['listing_bat']['sourceOfDataYear'];
}
if (isset($result['listing_bat']['sourceOfDataYear_2'])) {
    $sourceOfDataYear_2 = $result['listing_bat']['sourceOfDataYear_2'];
}

$yearData = '';
if (isset($result['listing_bat']['includetobat'])) {
    if ($result['listing_bat']['includetobat'] != 'No') {
        $yearData = '<table cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <th style="text-align:left;" width="35%">&nbsp;</th>
                <th style="text-align:left;"  width="15%">Year-' . $sourceOfDataYear . '</th>
                <th style="text-align:left;"  width="14%">% of Sales</th>
                <th style="text-align:left;"  width="15%">Year-' . $sourceOfDataYear_2 . '</th>
                <th style="text-align:left;"  width="14%">% of Sales</th>
            </tr>
            <tr>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:15px"><b>Add Backs</b></td>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;">&nbsp;</td>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;">&nbsp;</td>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;">&nbsp;</td>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;">&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px">Owner Salary</td>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px">$' .  $result['listing_bat']['ownerSalary'] . '</td>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px">' . $batMap->calculatePercentage( $result['listing_bat']['ownerSalary'], $result['listing_bat']['grossSales']) . '</td>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px">$' .  $result['listing_bat']['ownerSalary_2'] . '</td>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px">' . $batMap->calculatePercentage( $result['listing_bat']['ownerSalary_2'],  $result['listing_bat']['grossSales_2']) . '</td>
            </tr>
            <tr>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px">Benefits</td>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px">$' .  $result['listing_bat']['benefits'] . '</td>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px">' . $batMap->calculatePercentage( $result['listing_bat']['benefits'], $result['listing_bat']['grossSales']) . '</td>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px">$' .  $benefits_2 . '</td>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px">' . $batMap->calculatePercentage( $benefits_2,  $result['listing_bat']['grossSales_2']) . '</td>
            </tr>
            <tr>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px">Interest Expense</td>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px">$' . $result['listing_bat']['interestExpense'] . '</td>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px">' . $batMap->calculatePercentage($result['listing_bat']['interestExpense'], $result['listing_bat']['grossSales']) . '</td>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px">$' .  $benefits_2 . '</td>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px">' . $batMap->calculatePercentage( $benefits_2,  $result['listing_bat']['grossSales_2']) . '</td>
            </tr>
            <tr>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px">Depreciation/Amortization</td>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px">$' .  $result['listing_bat']['depreciation_2'] . '</td>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px">' . $batMap->calculatePercentage( $result['listing_bat']['depreciation_2'], $result['listing_bat']['grossSales']) . '</td>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px">$' .  $result['listing_bat']['depreciation_4'] . '</td>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px">' . $batMap->calculatePercentage( $result['listing_bat']['depreciation_4'],  $result['listing_bat']['grossSales_2']) . '</td>
            </tr>
            <tr>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px">Owner Personal/Travel/Meals</td>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px">$' .  $result['listing_bat']['ownerPersonalExpenses_2'] . '</td>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px">' . $batMap->calculatePercentage( $result['listing_bat']['ownerPersonalExpenses_2'], $result['listing_bat']['grossSales']) . '</td> 
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px">$' .  $result['listing_bat']['ownerPersonalExpenses_4'] . '</td>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px">' . $batMap->calculatePercentage( $result['listing_bat']['ownerPersonalExpenses_4'],  $result['listing_bat']['grossSales_2']) . '</td>
            </tr>
            <tr>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px">Other</td>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px">$' .  $result['listing_bat']['other'] . '</td>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px">' . $batMap->calculatePercentage( $result['listing_bat']['other'], $result['listing_bat']['grossSales']) . '</td>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px">$' .  $result['listing_bat']['other_2'] . '</td>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px">' . $batMap->calculatePercentage( $result['listing_bat']['other_2'],  $result['listing_bat']['grossSales_2']) . '</td>
            </tr>
            <tr>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px"><b>Total Add Backs</b></td>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px"><b><u>$' . $totalAddBacks . '</u></b></td>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px"><b><u>' . $batMap->calculatePercentage($totalAddBacks, $result['listing_bat']['grossSales']) . '</u></b></td>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px"><b><u>$' . $totalAddBacks1 . '</u></b></td>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px"><b><u>' . $batMap->calculatePercentage($totalAddBacks1,  $result['listing_bat']['grossSales_2']) . '</u></b></td>
            </tr>
            <tr>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px"><b>Discretionary Earnings</b></td>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px"><b><u>' . ( $ownerBenefit) . '</u></b></td>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px"><b><u>' . $batMap->calculatePercentage($ownerBenefit, $result['listing_bat']['grossSales']) . '</u></b></td>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px"><b><u>$' . ( $ownerBenefit1) . '</u></b></td>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px"><b><u>' . $batMap->calculatePercentage($ownerBenefit1,  $result['listing_bat']['grossSales_2']) . '</u></b></td>
            </tr> 
        </table>';
    } else {
        $yearData = '<table cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <th style="text-align:left;" width="40%">&nbsp;</th>
                <th style="text-align:left;">Year-' . $sourceOfDataYear . '</th>
                <th style="text-align:left;">% of Sales</th>
            </tr>
            <tr>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:15px"><b>Add Backs</b></td>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;">&nbsp;</td>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;">&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px">Owner Salary</td>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px">$' .  $result['listing_bat']['ownerSalary'] . '</td>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px">' . $batMap->calculatePercentage( $result['listing_bat']['ownerSalary'], $result['listing_bat']['grossSales']) . '</td>
            </tr>
            <tr>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px">Benefits</td>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px">$' .  $result['listing_bat']['benefits'] . '</td>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px">' . $batMap->calculatePercentage( $result['listing_bat']['benefits'], $result['listing_bat']['grossSales']) . '</td>
            </tr>
            <tr>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px">Interest Expense</td>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px">$' . $result['listing_bat']['interestExpense'] . '</td>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px">' . $batMap->calculatePercentage($result['listing_bat']['interestExpense'], $result['listing_bat']['grossSales']) . '</td>
            </tr>
            <tr>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px">Depreciation/Amortization</td>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px">$' .  $result['listing_bat']['depreciation_2'] . '</td>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px">' . $batMap->calculatePercentage( $result['listing_bat']['depreciation_2'], $result['listing_bat']['grossSales']) . '</td>
            </tr>
            <tr>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px">Owner Personal/Travel/Meals</td>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px">$' .  $result['listing_bat']['ownerPersonalExpenses_2'] . '</td>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px">' . $batMap->calculatePercentage( $result['listing_bat']['ownerPersonalExpenses_2'], $result['listing_bat']['grossSales']) . '</td>
            </tr>
            <tr>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px">Other</td>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px">$' .  $result['listing_bat']['other'] . '</td>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px">' . $batMap->calculatePercentage( $result['listing_bat']['other'], $result['listing_bat']['grossSales']) . '</td>
            </tr>
            <tr>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px"><b>Total Add Backs</b></td>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px"><b><u>$' . $totalAddBacks . '</u></b></td>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px"><b><u>' . $batMap->calculatePercentage($totalAddBacks, $result['listing_bat']['grossSales']) . '</u></b></td>
            </tr>
            <tr>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px"><b>Discretionary Earnings</b></td>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px"><b><u>' . number_format( $result['listing_bat']['ownerBenefit']) . '</u></b></td>
                <td style="text-align:left;line-height:30px;font-family: "Arimo", sans-serif;font-size:14px"><b><u>' . $batMap->calculatePercentage( $result['listing_bat']['ownerBenefit'], $result['listing_bat']['grossSales']) . '</u></b></td>
            </tr> 
        </table>';
    }
}

if (isset($result['listing_bat']['ltotalmonthrent'])) {
    $dataArr = $result['listing_bat']['ltotalmonthrent'];
} else {
    $dataArr = '';
}
if ($dataArr != '') {
    $dataArr = json_decode($dataArr, true);
    $dataArr = is_array($dataArr) ? $dataArr : array($dataArr);
    $totalmonthlyrent =  array_sum($dataArr);
} else {
    $totalmonthlyrent = 0;
}

if (isset($result['listing_bat']['linsidesqt'])) {
    $sqtArr = $result['listing_bat']['linsidesqt'];
} else {
    $sqtArr = '';
}
if ($sqtArr != '') {
    $sqtArr = json_decode($sqtArr, true);
    $sqtArr = is_array($sqtArr) ? $sqtArr : array($sqtArr);
    $totalSqtArr =  array_sum($sqtArr);
} else {
    $totalSqtArr = 0;
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>listing_bat_{!! $result['id'] !!}</title>
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
                    <table cellspacing="0" cellpadding="0" border="0" style="width: 100%;">
                        <tr>
                            <td style="height: 31px"></td>
                        </tr>
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
        <!-- page 1 -->
        <div id="page1">
            <div class="wsr-main-pdf-page">
                <table style="width: 100%;  box-sizing: border-box;">
                    <tr>
                        <td colspan="2">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td colspan="2" style="font-family: 'Arimo', sans-serif; margin:0; color: #000000; font-size:18px; line-height: 24px; font-weight:bold;"> Listing # {{$result['id']}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 400px; font-family: 'Arimo', sans-serif; font-size: 34px; line-height: 36px; color: #333; font-weight: bold;"> CONFIDENTIAL <br><span style="font-size: 48px; line-height: 52px;">BUSINESS</span> <br>ANALYSIS TOOL </td>
                                    
                                    <td align="center">
                                        <img src="{{ public_path('assets/images/print_pdf/logo-pdfs.png') }}" alt="logo" style="width: 180px; height: 180px; border-radius: 50%;" />
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="height: 4px;"></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="font-family: 'Arimo', sans-serif; font-size:24px; line-height: 48px; padding: 15px 0 5px; margin:0; color: #e70033; font-weight:bold;"> &nbsp;Listing:</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="font-family: 'Arimo', sans-serif; color: #000000; margin:0; padding:0 0 5px;line-height:20px; font-weight:normal; font-size:16px;"> &nbsp;@if(isset($result['bname'])) {{$result['bname']}} @endif</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="font-family: 'Arimo', sans-serif; color: #000000; margin:0; padding:0 0 5px;line-height:20px; font-weight:normal; font-size:16px;"> &nbsp; @if(isset($result['baddress'])) {{$result['baddress']}} @endif</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="font-family: 'Arimo', sans-serif; color: #000000; margin:0; padding:0 0 5px;line-height:20px; font-weight:normal; font-size:16px;"> &nbsp;
                            @if(isset($result['bcity'])) {{$result['bcity']}}, @endif
                            @if(isset($result['bstate'])) {{$result['bstate']}} @endif
                            @if(isset($result['bzip'])) {{$result['bzip']}} @endif
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
                            &nbsp; @if(isset($result['bsaleprice'])) ${{$result['bsaleprice']}} @else $0 @endif</td>
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
                            &nbsp;@if(isset($result['agent']['firstname'])){{$result['agent']['firstname']}}@endif &nbsp;
                            @if(isset($result['agent']['lastname'])){{$result['agent']['lastname']}}@endif</td>
                    </tr>
                    <tr>
                        <td colspan="2"
                            style="font-family: 'Arimo', sans-serif; color: #000000; margin:0; padding:0 0 5px;line-height:20px; font-weight:normal; font-size:16px;">
                            &nbsp;@if(isset($result['agent']['email'])){{$result['agent']['email']}}@endif</td>
                    </tr>
                    <tr>
                        <td colspan="2"
                            style="font-family: 'Arimo', sans-serif; color: #000000; margin:0; padding:0 0 5px;line-height:20px; font-weight:normal; font-size:16px;">
                            &nbsp;@if(isset($result['agent']['cellphone'])){{$result['agent']['cellphone']}}@endif &nbsp;
                            www.wesellrestaurants.com</td>
                    </tr>
                    <tr>
                        <td colspan="2"
                            style="font-family: 'Arimo', sans-serif; color: #000000; margin:0; padding:0 0 5px;line-height:20px; font-weight:normal; font-size:16px;">
                            &nbsp; 
                            @if(isset($result['listing_office']['officeaddress'])) 
                                {{ $result['listing_office']['officeaddress'] }} 
                            @endif
                            @if(isset($result['listing_office']['officecity'])) 
                                {{ $result['listing_office']['officecity'] }} 
                            @endif, 
                            @if(isset($result['listing_office']['officestate']))
                                {{ $result['listing_office']['officestate'] }} 
                            @endif
                            @if(isset($result['listing_office']['officezip'])) 
                                {{ $result['listing_office']['officezip'] }} 
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="height: 4px;"></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="vertical-align: middle;">
                        
                            @if(isset( $result['listing_media']['img_file']))
                            <img align="middle"
                                src="{{ url('storage/images/list/main_images/'. $result['listing_media']['img_file']) }}" alt="logo"
                                style="width: 260px; height: 260px; vertical-align: middle;" />
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        
        <!-- page 2 -->
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
                            <a href="#page8"
                                style="font-family: 'Arimo', sans-serif; font-size: 18px; line-height: 25px; color: #333333; text-decoration: none;">Equipment
                                List</a>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding-left: 10px;">
                            <a href="#page9"
                                style="font-family: 'Arimo', sans-serif; font-size: 18px; line-height: 25px; color: #333333; text-decoration: none;">Lease
                                Overview</a>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding-left: 10px;">
                            <a href="#page10"
                                style="font-family: 'Arimo', sans-serif; font-size: 18px; line-height: 25px; color: #333333; text-decoration: none;">Business
                                & Transfer Structure</a>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding-left: 10px;">
                            <a href="#page12"
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
        
        <!-- page 3 -->
        <div id="page3" style="page-break-before: always;">
            <table width="100%" cellpadding="0" cellspacing="0"
                style="border-collapse: separate; border-spacing: 0px 10px;">
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
                        This
                        Business Analysis Tool is a Confidential Document containing information about a business for
                        sale that is represented by We Sell Restaurants. This data is provided to familiarize
                        prospective buyers with confidential information about the business and is specifically covered
                        by the confidentiality agreement you have signed.</td>
                </tr>

                <tr>
                    <td width="3%"></td>
                    <td width="94%"
                        style="font-size: 15px; line-height: 26px; font-family: 'Arimo', sans-serif; color: #333333;">
                        All
                        of the information presented in the Business Analysis Tool is highly sensitive and confidential.
                        It is only intended for individuals or companies who have signed a Confidentiality or
                        Non-Disclosure Agreement or are bound to confidentiality by their professional ethics. DO NOT
                        PROCEED FURTHER UNLESS YOU ARE BOUND BY ONE OF THESE AGREEMENTS. If you have electronically
                        acknowledged this confidentiality agreement online through our website www.wesellrestaurants.com
                        you are fully bound by the terms of that confidentiality agreement under United States law for
                        all information released to you herein.</td>
                </tr>

                <tr>
                    <td width="3%"></td>
                    <td width="94%"
                        style="font-size: 15px; line-height: 26px; font-family: 'Arimo', sans-serif; color: #333333;">
                        The
                        definition of an electronic signature is set out in the Uniform Electronic Transactions Act
                        ("UETA") released by the National Conference of Commissioners on Uniform State Laws (NCCUSL) in
                        1999. Under UETA, the term "electronic signature" means "an electronic sound, symbol, or
                        process, attached to or logically associated with a record and executed or adopted by a person
                        with the intent to sign the record." In other words, your electronic intent, demonstrated by a
                        signature initiated on your computer, traceable by your IP address, confirmed by the data you
                        provide about your physical address, name and phone number is fully enforceable in a court of
                        law.</td>
                </tr>

                <tr>
                    <td width="3%"></td>
                    <td width="94%"
                        style="font-size: 15px; line-height: 26px; font-family: 'Arimo', sans-serif; color: #333333;">
                        All
                        the information contained in this Business Analysis Tool has been provided by the business
                        offered for sale. We Sell Restaurants&reg; has not confirmed this information and makes no
                        representations or warranties as to its accuracy or completeness. Any and all representations
                        shall be made solely by the business offered for sale as set forth in asigned asset purchase
                        agreement.</td>
                </tr>

                <tr>
                    <td width="3%"></td>
                    <td width="94%"
                        style="font-size: 15px; line-height: 26px; font-family: 'Arimo', sans-serif; color: #333333;">By
                        accepting this Business Analysis Tool, the recipient acknowledges their responsibility to
                        perform a thorough due diligence review and to make their own evaluation prior to any
                        acquisition of the business for sale.</td>
                </tr>

                <tr>
                    <td width="3%"></td>
                    <td width="94%"
                        style="font-size: 15px; line-height: 26px; font-family: 'Arimo', sans-serif; color: #333333;">
                        The
                        business employees, customers, suppliers and competitors are not aware that the business is for
                        sale. Contact with any party of the business, stakeholder, landlord, vendor and employee or
                        otherwise is strictly prohibited except in an "undercover" manner while acting normally as a
                        customer.
                    </td>
                </tr>
            </table>
        </div>
        
        <!-- page 4  -->
        <div id="page4" style="page-break-before: always;">
            <table width="100%" cellspacing="0" cellpadding="0" align="center" style="max-width:700px;">
                <tr>
                    <td colspan="2"
                        style="font-family: 'Arimo', sans-serif; padding-left: 10px; margin:0;color:#fff;font-size:30px; font-weight:bold; background-color: #333333;height: 60px; vertical-align: middle;">
                        &nbsp; MEET BROKER</td>
                </tr>
                <tr>
                    <td height="20"></td>
                </tr>
                <tr>
                    <td width="3%"></td>';
                    @if(isset($result['agent']['agentdes']))
                    @if(strlen($result['agent']['agentdes']) > 360)
                    <td width="94%"
                        style="font-size: 15px; line-height: 26px; font-family: 'Arimo', sans-serif; color: #333333;">
                        &nbsp;{!! $result['agent']['agentdes'] !!}</td>
                    @else
                    <td width="94%"
                        style="font-size: 15px; line-height: 26px; font-family: 'Arimo', sans-serif; color: #333333;">
                        &nbsp;{!! $result['agent']['agentdes']!!}</td>
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
                        <table width="100%" border="0" cellpadding="0" style="border-collapse: separate;
                            border-spacing: 0px 30px;">
                            <tr>
                                <td width="100%"
                                    style="font-size: 20px; line-height: 22px; font-family: 'Arimo', sans-serif; color: #e70033; text-align: left; font-weight: bold;">
                                    @if(isset($result['agent']['firstname'])){!! $result['agent']['firstname'] !!}@endif &nbsp;
                                    @if(isset($result['agent']['lastname'])){!! $result['agent']['lastname'] !!}@endif</td>
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
                                    <a href="mailto:" @if(isset($result['agent']['email'])){!! $result['agent']['email'] !!} @endif
                                        style="text-decoration: none; width: 400px; height: 80px; font-size: 22px;
                                        color: #ffffff; background-color: #e70033; font-family: 'Arimo', sans-serif;
                                        padding: 20px 0;">&nbsp; &nbsp; &nbsp;
                                        @if(isset($result['agent']['email'])) {!! $result['agent']['email'] !!} @endif
                                        &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                            </tr>

                            <tr>
                                <td>
                                    <a href="tel:" @if(isset($result['agent']['cellphone'])){!! $result['agent']['cellphone'] !!} @endif
                                        style="text-decoration: none; width: 400px; height: 80px; font-size: 22px;
                                        color: #ffffff; background-color: #e70033; font-family: 'Arimo', sans-serif;
                                        padding: 20px 0;">&nbsp; &nbsp; &nbsp;
                                        @if(isset($result['agent']['cellphone'])) {!! $result['agent']['cellphone'] !!} @endif
                                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                        &nbsp; &nbsp;
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td style="width: 40%;">

                        @if(isset($result['agent']['img']))

                        <img src="{{ public_path('assets/images/agent/'.$result['agent']['img']) }}"
                            style="width: 200px; height: 200px;" alt="image">
                        @endif
                    </td>
                </tr>
                <tr>
                    <td style="width: 100%; height: 40px;"></td>
                </tr>
            </table>
        </div>
        
        <!-- page 5 -->
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
                        @if(isset( $result['bheadlinead'])){!! $result['bheadlinead'] !!} @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="2" height="10" bgcolor="white"></td>
                </tr>
                <tr>
                    <td width="3%" bgcolor="white"></td>
                    <td width="94%" bgcolor="white" style="font-size: 16px; line-height: 22px; font-family: 'Arimo', sans-serif; color: #333333; text-align: left;">
                        @if(isset( $result['bdetailedad'])) {!! $result['bdetailedad'] !!} @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="2" height="10" bgcolor="white"></td>
                </tr>
            </table>
        </div>
        
        <!-- page 5.1 -->
        <div style="page-break-before: always;">
            <table cellpadding="0" cellspacing="0" width="100%" bgcolor="white">
                <tr>
                    <td height="20"></td>
                </tr>
                <tr>
                    <td width="3%"></td>
                    <td width="97%"
                        style="font-size: 20px; line-height: 38px; font-family: 'Arimo', sans-serif; color: #e70033; text-align: left; font-weight: bold;">
                        This business is offered at @if(isset($result['bsaleprice'])) ${!! number_format($result['bsaleprice'], 2)
                        !!} @else $0 @endif</td>
                </tr>
                <tr>
                    <td height="10" bgcolor="white"></td>
                </tr>
                <tr>
                    <td width="3%"></td>
                    @if(isset( $result['listing_media']['img_file']))
                    <td width="97%"><img src="{{ url('storage/images/list/main_images/'. $result['listing_media']['img_file']) }}"
                            alt="blog" style="width: 100%; max-width: 550px; height: auto;" /></td>
                    @endif
                </tr>
                <tr>
                    <td height="5"></td>
                </tr>
                <tr>
                    <td width="3%"></td>
                    <td width="97%"
                        style="font-size: 18px; line-height: 30px; font-family: 'Arimo', sans-serif; color: #000; text-align: left; font-weight: bold;">
                        @if(isset($result['bname'])) {!! $result['bname'] !!} @endif
                    </td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td width="3%"></td>
                    <td width="97%"
                        style="font-size: 18px; line-height: 30px; font-family: 'Arimo', sans-serif; color: #000; text-align: left; font-weight: bold;">
                        @if(isset($result['baddress'])) {!! $result['baddress'] !!} @endif
                    </td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td width="3%"></td>
                    <td width="97%"
                        style="font-size: 18px; line-height: 30px; font-family: 'Arimo', sans-serif; color: #000; text-align: left; font-weight: bold;">
                        @if(isset($result['bcity'])) {!! $result['bcity'] !!} @endif
                        @if(isset($result['bstate'])) {!! $result['bstate'] !!} @endif
                        @if(isset($result['bzip'])) {!! $result['bzip'] !!} @endif
                    </td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td width="3%"></td>
                    <td width="97%"
                        style="font-size: 18px; line-height: 30px; font-family: 'Arimo', sans-serif; color: #000; text-align: left;">
                        Years Owned by Current Owner: @if(isset( $result['listing_ops']['yearestablish'])) {!!  $result['listing_ops']['yearestablish'] !!} @endif
                    </td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td width="3%"></td>
                    <td width="97%"
                        style="font-size: 18px; line-height: 30px; font-family: 'Arimo', sans-serif; color: #000; text-align: left;">
                        Reason for Selling: @if(isset( $result['listing_bat']['reasonForSelling'])) {!!  $result['listing_bat']['reasonForSelling'] !!} @endif
                    </td>
                </tr> 
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td width="3%"></td>
                    <td width="97%"
                        style="font-size: 14px; line-height: 28px; font-family: 'Arimo', sans-serif; color: #000; text-align: left;">
                        @if(isset( $result['listing_bat']['add_more_details'])) {!!  $result['listing_bat']['add_more_details'] !!} @endif
                    </td>
                </tr>
                <tr>
                    <td height="20"></td>
                </tr>
            </table>
        </div>
        
        <!-- page 6 -->
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
                    <td colspan="2" bgcolor="white">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" nobr="true">
                            <tr>
                                <td height="15"></td>
                            </tr>
                            <tr>
                                <td width="2%"></td>
                                <td width="96%"
                                    style="font-size: 22px; line-height: 28px; font-family: 'Arimo', sans-serif; color: #e70033; text-align: left; font-weight: bold;">
                                    Key Considerations</td>
                                <td width="2%"></td>
                            </tr>
                            <tr>
                                <td width="2%"></td>
                                <td width="97%"
                                    style="font-size: 16px; line-height: 28px; font-family: 'Arimo', sans-serif; color: #000; text-align: left;">
                                    When buying a restaurant, there are key items associated with the purchase of the
                                    business. Review critical details such as the cost of goods sold, monthly rent,
                                    hours of operation, and more.</td>
                                <td width="2%"></td>
                            </tr>
                            <tr>
                                <td></td>
                            </tr>
                            <tr>
                                <td width="2%"></td>
                                <td width="97%"
                                    style="font-size: 16px; line-height: 28px; font-family: 'Arimo', sans-serif; color: #000; text-align: left;">
                                    <b>Questions?</b> Contact your Certified Restaurant Broker for more details on the
                                    information shared in this listing package.
                                </td>
                                <td width="2%"></td>
                            </tr>
                            <tr>
                                <td height="15"></td>
                            </tr>
                        </table>
                    </td>
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
                                                <img src="{{ public_path('assets/images/print_pdf/business-1.png') }}"
                                                    alt="business" style="width: 150px; height: 150px;" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="2"></td>
                                        </tr>
                                        <tr>
                                            <td width="100%"
                                                style="font-size: 22px; line-height: 28px; font-family: 'Arimo', sans-serif; color: #000; text-align: center; font-weight: bold;">
                                                ${!! number_format($totalCOGS) !!}</td>
                                        </tr>
                                        <tr>
                                            <td width="100%"
                                                style="font-size: 16px; line-height: 18px; font-family: 'Arimo', sans-serif; color: #000; text-align: center; font-style: italic;">
                                                Total COGS</td>
                                        </tr>
                                    </table>
                                </td>
                                <td style="width: 28px;"></td>
                                <td style="width: 150px;  text-align: center;">
                                    <table style="text-align: center" width="100%" border="0" cellspacing="0"
                                        cellpadding="0" nobr="true">
                                        <tr>
                                            <td>
                                                <img src="{{ public_path('assets/images/print_pdf/business-2.png') }}"
                                                    alt="business" style="width: 150px; height: 150px;" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="2"></td>
                                        </tr>
                                        <tr>
                                            <td width="100%"
                                                style="font-size: 22px; line-height: 28px; font-family: 'Arimo', sans-serif; color: #000; text-align: center; font-weight: bold;">
                                                @if(isset($result['listing_bat']['grossSales'])) ${!! $result['listing_bat']['grossSales'] !!} @else $0 @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="100%"
                                                style="font-size: 16px; line-height: 18px; font-family: 'Arimo', sans-serif; color: #000; text-align: center; font-style: italic;">
                                                Sales</td>
                                        </tr>
                                    </table>
                                </td>
                                <td style="width: 28px;"></td>
                                <td style="width: 150px;  text-align: center;">
                                    <table style="text-align: center" width="100%" border="0" cellspacing="0"
                                        cellpadding="0" nobr="true">
                                        <tr>
                                            <td>
                                                <img src="{{ public_path('assets/images/print_pdf/business-4.png') }}"
                                                    alt="business" style="width: 150px; height: 150px;" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="2"></td>
                                        </tr>
                                        <tr>
                                            <td width="100%"
                                                style="font-size: 22px; line-height: 28px; font-family: 'Arimo', sans-serif; color: #000; text-align: center; font-weight: bold;">
                                                ${!! $ownerBenefit !!}</td>
                                        </tr>
                                        <tr>
                                            <td width="100%"
                                                style="font-size: 16px; line-height: 18px; font-family: 'Arimo', sans-serif; color: #000; text-align: center; font-style: italic;">
                                                SDE</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td height="2"></td>
                            </tr>
                            <tr>
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
                                                style="font-size: 18px; line-height: 28px; font-family: 'Arimo', sans-serif; color: #000; text-align: center; font-weight: bold;">
                                                ${!! $totalmonthlyrent !!}</td>
                                        </tr>
                                        <tr>
                                            <td width="100%"
                                                style="font-size: 16px; line-height: 18px; font-family: 'Arimo', sans-serif; color: #000; text-align: center; font-style: italic;">
                                                Monthly Rent</td>
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
                                                style="font-size: 18px; line-height: 28px; font-family: 'Arimo', sans-serif; color: #000; text-align: center; font-weight: bold;">
                                                {!! $totalSqtArr !!}</td>
                                        </tr>
                                        <tr>
                                            <td width="100%"
                                                style="font-size: 16px; line-height: 18px; font-family: 'Arimo', sans-serif; color: #000; text-align: center; font-style: italic;">
                                                Lease sq. ft</td>
                                        </tr>
                                    </table>
                                </td>
                                <td style="width: 28px;"></td>
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
                                                style="font-size: 18px; line-height: 28px; font-family: 'Arimo', sans-serif; color: #000; text-align: center; font-weight: bold;">
                                                @if(isset( $result['listing_ops']['opTraining'])) {!!  $result['listing_ops']['opTraining'] !!} @endif</td>
                                        </tr>
                                        <tr>
                                            <td width="100%"
                                                style="font-size: 16px; line-height: 18px; font-family: 'Arimo', sans-serif; color: #000; text-align: center; font-style: italic;">
                                                Training</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
        
        <!-- page 6.1 -->
        <div style="page-break-before: always;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" nobr="true">
                <tr>
                    <td colspan="2" width="100%"
                        style="font-size: 18px; line-height: 34px; font-family: 'Arimo', sans-serif; color: #e70033; text-align: left; font-weight: bold;">
                        Listing Price: @if(isset($result['bsaleprice'])) ${!! $result['bsaleprice'] !!} @else $0 @endif</td>
                </tr>
                <tr>
                    <td colspan="2" height="2"></td>
                </tr>
                <tr>
                    <td colspan="2" height="8" bgcolor="white"></td>
                </tr>
                <tr>
                    <td style="width: 50%;" bgcolor="white">
                        <table style="width: 100%; border: none;" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="100%"
                                    style="font-size: 20px; line-height: 38px; font-family: 'Arimo', sans-serif; color: #000; text-align: left; font-weight: bold;">
                                    Financing Options</td>
                            </tr>
                            <tr>
                                <td width="100%"
                                    style="font-size: 16px; line-height: 22px; font-family: 'Arimo', sans-serif; color: #000; text-align: left;">
                                    Seller Financing: @if(isset( $result['listing_bat']['sellerFinancing'])) {!!  $result['listing_bat']['sellerFinancing'] !!}
                                    @endif</td>
                            </tr>
                            <tr>
                                <td width="100%"
                                    style="font-size: 16px; line-height: 22px; font-family: 'Arimo', sans-serif; color: #000; text-align: left;">
                                    Bank Financing: @if(isset( $result['listing_bat']['bankFinancing'])) {!!  $result['listing_bat']['bankFinancing'] !!} @endif
                                </td>
                            </tr>
                            <tr>
                                <td width="100%"
                                    style="font-size: 16px; line-height: 22px; font-family: 'Arimo', sans-serif; color: #000; text-align: left;">
                                    @if(isset( $result['listing_bat']['bankFinancingPercentage'])) {!!  $result['listing_bat']['bankFinancingPercentage'] !!}
                                    @else 0.00 @endif % Down</td>
                            </tr>
                            <tr>
                                <td width="100%"
                                    style="font-size: 20px; line-height: 38px; font-family: 'Arimo', sans-serif; color: #000; text-align: left; font-weight: bold;">
                                    Additional Info</td>
                            </tr>
                            <tr>
                                <td width="100%"
                                    style="font-size: 16px; line-height: 22px; font-family: 'Arimo', sans-serif; color: #000; text-align: left;">
                                    Non-Compete (Years): @if(isset( $result['listing_bat']['nonCompeteAgreementYears'])) {!!
                                     $result['listing_bat']['nonCompeteAgreementYears'] !!} @endif</td>
                            </tr>
                            <tr>
                                <td width="100%"
                                    style="font-size: 16px; line-height: 22px; font-family: 'Arimo', sans-serif; color: #000; text-align: left;">
                                    Non-Compete (Miles): @if(isset( $result['listing_bat']['nonCompeteAgreementMiles'])) {!!
                                     $result['listing_bat']['nonCompeteAgreementMiles'] !!} @endif</td>
                            </tr>
                        </table>
                    </td>
                    <td style="width: 50%;" bgcolor="white" style="vertical-align: top;">
                        <table style="width: 100%; border: none;" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="100%"
                                    style="font-size: 20px; line-height: 38px; font-family: 'Arimo', sans-serif; color: #000; text-align: left; font-weight: bold;">
                                    Franchise Information</td>
                            </tr>
                            <tr>
                                <td width="100%"
                                    style="font-size: 16px; line-height: 22px; font-family: 'Arimo', sans-serif; color: #000; text-align: left;">
                                    Franchise: @if(isset( $result['listing_bat']['batFranchise'])) {!!  $result['listing_bat']['batFranchise'] !!} @endif</td>
                            </tr>
                            <tr>
                                <td width="100%"
                                    style="font-size: 16px; line-height: 22px; font-family: 'Arimo', sans-serif; color: #000; text-align: left;">
                                    Franchise Transfer Fee: @if(isset( $result['listing_bat']['franchiseTransferFee'])) ${!!
                                     $result['listing_bat']['franchiseTransferFee'] !!} @else $0 @endif</td>
                            </tr>
                            <tr>
                                <td width="100%"
                                    style="font-size: 16px; line-height: 22px; font-family: 'Arimo', sans-serif; color: #000; text-align: left;">
                                    Marketing Fee: @if(isset( $result['listing_bat']['marketingFees'])) {!!  $result['listing_bat']['marketingFees'] !!}% @else
                                    0.00% @endif</td>
                            </tr>
                            <tr>
                                <td width="100%"
                                    style="font-size: 16px; line-height: 22px; font-family: 'Arimo', sans-serif; color: #000; text-align: left;">
                                    Royalty Fee: @if(isset( $result['listing_bat']['royaltyFees'])) {!!  $result['listing_bat']['royaltyFees'] !!}% @else 0.00%
                                    @endif</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" height="8" bgcolor="white"></td>
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
                                                <img src="{{ public_path('assets/images/print_pdf/business-7.png') }}"
                                                    alt="business" style="width: 150px; height: 150px;" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="2"></td>
                                        </tr>
                                        <tr>
                                            <td width="100%"
                                                style="font-size: 16px; line-height: 22px; font-family: 'Arimo', sans-serif; color: #000; text-align: center; font-weight: bold;">
                                                @if(isset( $result['listing_ops']['nofulltimeemp'])) {!!  $result['listing_ops']['nofulltimeemp'] !!} , @endif
                                                @if(isset( $result['listing_ops']['noparttimeemp'])) {!!  $result['listing_ops']['noparttimeemp'] !!} @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="100%"
                                                style="font-size: 18px; line-height: 24px; font-family: 'Arimo', sans-serif; color: #000; text-align: center; font-style: italic;">
                                                Employees</td>
                                        </tr>
                                        <tr>
                                            <td width="100%"
                                                style="font-size: 18px; line-height: 24px; font-family: 'Arimo', sans-serif; color: #000; text-align: center; font-style: italic;">
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
                                                style="font-size: 16px; line-height: 22px; font-family: 'Arimo', sans-serif; color: #000; text-align: center; font-weight: bold;">
                                                @if(isset( $result['listing_ops']['operatinghours'])) {!!  $result['listing_ops']['operatinghours'] !!} @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="100%"
                                                style="font-size: 18px; line-height: 24px; font-family: 'Arimo', sans-serif; color: #000; text-align: center; font-style: italic;">
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
                                                style="font-size: 16px; line-height: 22px; font-family: 'Arimo', sans-serif; color: #000; text-align: center; font-weight: bold;">
                                                @if(isset( $result['listing_ops']['noinsideseats'])) {!!  $result['listing_ops']['noinsideseats'] !!} , @endif
                                                @if(isset(['listing_ops']['nooutsideeats'])) {!! ['listing_ops']['nooutsideeats'] !!} @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="100%"
                                                style="font-size: 18px; line-height: 24px; font-family: 'Arimo', sans-serif; color: #000; text-align: center; font-style: italic;">
                                                Seats</td>
                                        </tr>
                                        <tr>
                                            <td width="100%"
                                                style="font-size: 18px; line-height: 24px; font-family: 'Arimo', sans-serif; color: #000; text-align: center; font-style: italic;">
                                                Inside, Outside</td>
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
                                                style="font-size: 16px; line-height: 22px; font-family: 'Arimo', sans-serif; color: #000; text-align: center; font-weight: bold;">
                                                @if(isset( $result['listing_ops']['greasetrap'])) {!!  $result['listing_ops']['greasetrap'] !!} @endif</td>
                                        </tr>
                                        <tr>
                                            <td width="100%"
                                                style="font-size: 18px; line-height: 24px; font-family: 'Arimo', sans-serif; color: #000; text-align: center; font-style: italic;">
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
                                                style="font-size: 16px; line-height: 22px; font-family: 'Arimo', sans-serif; color: #000; text-align: center; font-weight: bold;">
                                                @if(isset( $result['listing_ops']['liquorlicensetype'])) {!!  $result['listing_ops']['liquorlicensetype'] !!}
                                                @endif</td>
                                        </tr>
                                        <tr>
                                            <td width="100%"
                                                style="font-size: 18px; line-height: 24px; font-family: 'Arimo', sans-serif; color: #000; text-align: center; font-style: italic;">
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
                                                style="font-size: 16px; line-height: 22px; font-family: 'Arimo', sans-serif; color: #000; text-align: center; font-weight: bold;">
                                                @if(isset(['listing_ops']['hoodsystem'])) {!! ['listing_ops']['hoodsystem'] !!} @endif</td>
                                        </tr>
                                        <tr>
                                            <td width="100%"
                                                style="font-size: 18px; line-height: 24px; font-family: 'Arimo', sans-serif; color: #000; text-align: center; font-style: italic;">
                                                Hood System </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
        
        <!-- page 7  -->
        <div id="page7" style="page-break-before: always;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" nobr="true">

                <tr>
                    <td align="left" valign="left"
                        style="font-family: 'Arimo', sans-serif; font-size:36px; font-weight:bold; color:#ff0000;">
                        Income Statement
                    </td>
                </tr>
                <tr>
                    <td width="100%"
                        style="font-size: 18px; line-height: 24px; font-family: 'Arimo', sans-serif; color: #e70033; text-align: left; font-weight: bold;">
                        @if(isset($result['bname'])) {!! $result['bname'] !!} @endif</td>
                </tr>
                <tr>
                    <td width="100%"
                        style="font-size: 18px; line-height: 24px; font-family: 'Arimo', sans-serif; color: #e70033; text-align: left; font-weight: bold;">
                        Data Source: @if(isset(['listing_bat']['sourceOfData'])) {!! ['listing_bat']['sourceOfData'] !!} @endif ,
                        @if(isset(['listing_bat']['sourceOfDataYear'])) {!! ['listing_bat']['sourceOfDataYear'] !!} @endif </td>
                </tr>
                <tr>
                    <td height="8"></td>
                </tr>
                <tr>
                    <td width="100%" bgcolor="white" style="padding: 15px;">
                        <table width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td
                                    style="font-size:15px; font-family: 'Arimo', sans-serif;width:45%; font-weight:bold;">
                                </td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">Year -
                                    @if(isset(['listing_bat']['sourceOfDataYear'])) {!!
                                    ['listing_bat']['sourceOfDataYear'] !!} @endif</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">% of Sales</td>
                            </tr>
                            <tr>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;width:45%;  font-weight:bold;">
                                    Net Sales</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;"><strong>${!!
                                        number_format($gross_sales) !!}</strong></td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;width:45%; "><strong>Food
                                        Costs</strong></td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    <strong>@if(isset($result['listing_bat']['foodCosts'])) ${!!
                                        number_format($result['listing_bat']['foodCosts']) !!} @else $0 @endif</strong>
                                </td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    <strong>@if(isset($result['listing_bat']['foodCosts'])) {!!
                                        $batMap->calculatePercentage($result['listing_bat']['foodCosts'],$gross_sales) !!} @else $0 @endif</strong>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;width:45%; ">Alcohol Costs
                                </td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    @if(isset($result['listing_bat']['alcohalCosts'])) ${!!
                                    number_format($result['listing_bat']['alcohalCosts']) !!} @else $0 @endif</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    @if(isset($result['listing_bat']['alcohalCosts'])) {!!
                                    $batMap->calculatePercentage($result['listing_bat']['alcohalCosts'],$gross_sales) !!} @else $0 @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">Other COGS</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    @if(isset($result['listing_bat']['otherCogs'])) ${!! $result['listing_bat']['otherCogs'] !!} @else
                                    $0 @endif</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    @if(isset($result['listing_bat']['otherCogs']))
                                    {!! $batMap->calculatePercentage($result['listing_bat']['otherCogs'], $gross_sales) !!}
                                    @else
                                    0
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif; font-weight:bold;">Total
                                    COGS</td>
                                <td
                                    style="font-size:15px; font-family: 'Arimo', sans-serif; font-weight:bold; text-decoration:underline;">
                                    ${!!
                                    number_format($totalCOGS) !!}</td>
                                <td
                                    style="font-size:15px; font-family: 'Arimo', sans-serif; font-weight:bold; text-decoration:underline;">
                                    {!!
                                    $batMap->calculatePercentage($totalCOGS,$gross_sales) !!}</td>
                            </tr>
                            <tr>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif; font-weight:bold;">Gross
                                    Margin</td>
                                <td
                                    style="font-size:15px; font-family: 'Arimo', sans-serif; font-weight:bold; text-decoration:underline;">
                                    ${!!
                                    number_format($grossMargin) !!}</td>
                                <td
                                    style="font-size:15px; font-family: 'Arimo', sans-serif; font-weight:bold; text-decoration:underline;">
                                    {!!
                                    $batMap->calculatePercentage($grossMargin,$gross_sales) !!}</td>
                            </tr>
                            <tr>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif; font-weight:bold;">
                                    Accounting</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">&nbsp;</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">Advertising/Promotion</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    @if(isset($result['listing_bat']['advertising'])) ${!!
                                    number_format($result['listing_bat']['advertising']) !!} @else $0 @endif</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    @if(isset($result['listing_bat']['advertising'])) {!!
                                    $batMap->calculatePercentage($result['listing_bat']['advertising'],$gross_sales) !!} @else 0 @endif</td>
                            </tr>
                            <tr>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">Auto</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">@if(isset($result['listing_bat']['auto']))
                                    ${!! number_format($result['listing_bat']['auto']) !!}
                                    @else $0 @endif</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">@if(isset($result['listing_bat']['auto'])) {!!
                                    $batMap->calculatePercentage($result['listing_bat']['auto'],$gross_sales) !!} @else 0 @endif</td>
                            </tr>
                            <tr>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">Bank Charges</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    @if(isset($result['listing_bat']['bankCharges'])) ${!!
                                    number_format($result['listing_bat']['bankCharges']) !!} @else $0 @endif</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    @if(isset($result['listing_bat']['bankCharges'])) {!!
                                    $batMap->calculatePercentage($result['listing_bat']['bankCharges'],$gross_sales) !!} @else 0 @endif </td>
                            </tr>
                            <tr>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">Credit Card Fees</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    @if(isset($result['listing_bat']['creditCardFees'])) ${!!
                                    number_format($result['listing_bat']['creditCardFees']) !!} @else $0 @endif</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    @if(isset($result['listing_bat']['creditCardFees'])) {!!
                                    $batMap->calculatePercentage($result['listing_bat']['creditCardFees'],$gross_sales) !!} @else $0 @endif</td>
                            </tr>
                            <tr>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">Depreciation/Amortization
                                </td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    @if(isset($result['listing_bat']['depreciation'])) ${!!
                                    number_format($result['listing_bat']['depreciation']) !!} @else $0 @endif</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    @if(isset($result['listing_bat']['depreciation'])) {!!
                                    $batMap->calculatePercentage($result['listing_bat']['depreciation'],$gross_sales) !!} @else $0 @endif</td>
                            </tr>
                            <tr>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">Donations/Sponsorships
                                </td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    @if(isset($result['listing_bat']['donations'])) ${!!
                                    number_format($result['listing_bat']['donations']) !!} @else $0 @endif</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    @if(isset($result['listing_bat']['donations'])) {!!
                                    $batMap->calculatePercentage($result['listing_bat']['donations'],$gross_sales) !!} @else $0 @endif</td>
                            </tr>
                            <tr>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">Dues &amp; Subscriptions
                                </td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    @if(isset($result['listing_bat']['duesSubscriptions'])) ${!!
                                    number_format($result['listing_bat']['duesSubscriptions']) !!} @else $0 @endif</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    @if(isset($result['listing_bat']['duesSubscriptions'])) {!!
                                    $batMap->calculatePercentage($result['listing_bat']['duesSubscriptions'],$gross_sales) !!} @else $0 @endif</td>
                            </tr>
                            <tr>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">Equipment lease</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    @if(isset($result['listing_bat']['equipmentlease'])) ${!!
                                    number_format($result['listing_bat']['equipmentlease']) !!} @else $0 @endif </td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    @if(isset($result['listing_bat']['equipmentlease'])) {!!
                                    $batMap->calculatePercentage($result['listing_bat']['equipmentlease'],$gross_sales) !!} @else $0 @endif </td>
                            </tr>
                            <tr>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">Insurance</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    @if(isset($result['listing_bat']['insurance'])) ${!!
                                    number_format($result['listing_bat']['insurance']) !!} @else $0 @endif</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    @if(isset($result['listing_bat']['insurance'])) {!!
                                    $batMap->calculatePercentage($result['listing_bat']['insurance'],$gross_sales) !!} @else $0 @endif</td>
                            </tr>
                            <tr>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">Interest Expense</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    @if(isset($result['listing_bat']['interestExpense'])) ${!!
                                    number_format($result['listing_bat']['interestExpense']) !!} @else $0 @endif</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    @if(isset($result['listing_bat']['interestExpense'])) {!!
                                    $batMap->calculatePercentage($result['listing_bat']['interestExpense'],$gross_sales) !!} @else $0 @endif</td>
                            </tr>
                            <tr>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    Janitorial/Cleaning/Laundry</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    @if(isset($result['listing_bat']['janitorial'])) ${!!
                                    number_format($result['listing_bat']['janitorial']) !!} @else $0 @endif</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    @if(isset($result['listing_bat']['janitorial'])) {!!
                                    $batMap->calculatePercentage($result['listing_bat']['janitorial'],$gross_sales) !!} @else $0 @endif</td>
                            </tr>
                            <tr>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">Legal and Accounting</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">@if(isset($result['listing_bat']['legal']))
                                    ${!! number_format($result['listing_bat']['legal']) !!}
                                    @else $0 @endif </td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">@if(isset($result['listing_bat']['legal']))
                                    {!!
                                    $batMap->calculatePercentage($result['listing_bat']['legal'],$gross_sales) !!} @else $0 @endif</td>
                            </tr>
                            <tr>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">Licenses and Fees</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    @if(isset($result['listing_bat']['licensesFees'])) ${!!
                                    number_format($result['listing_bat']['licensesFees']) !!} @else $0 @endif</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    @if(isset($result['listing_bat']['licensesFees'])) {!!
                                    $batMap->calculatePercentage($result['listing_bat']['licensesFees'],$gross_sales) !!} @else $0 @endif</td>
                            </tr>
                            <tr>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">Miscellaneous</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    @if(isset($result['listing_bat']['miscellaneous'])) ${!!
                                    number_format($result['listing_bat']['miscellaneous']) !!} @else $0 @endif</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    @if(isset($result['listing_bat']['miscellaneous'])) {!!
                                    $batMap->calculatePercentage($result['listing_bat']['miscellaneous'],$gross_sales) !!} @else $0 @endif</td>
                            </tr>
                            <tr>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">Payroll Taxes</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    @if(isset($result['listing_bat']['payrollTaxes'])) ${!!
                                    number_format($result['listing_bat']['payrollTaxes']) !!} @else $0 @endif</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    @if(isset($result['listing_bat']['payrollTaxes'])) {!!
                                    $batMap->calculatePercentage($result['listing_bat']['payrollTaxes'],$gross_sales) !!} @else $0 @endif</td>
                            </tr>
                            <tr>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">Postage/3rd Party Delivery
                                </td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    @if(isset($result['listing_bat']['postageDelivery'])) ${!!
                                    number_format($result['listing_bat']['postageDelivery']) !!} @else $0 @endif</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    @if(isset($result['listing_bat']['postageDelivery'])) {!!
                                    $batMap->calculatePercentage($result['listing_bat']['postageDelivery'],$gross_sales) !!} @else $0 @endif</td>
                            </tr>
                            <tr>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">Office Supplies</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    @if(isset($result['listing_bat']['officeSupplies'])) ${!!
                                    number_format($result['listing_bat']['officeSupplies']) !!} @else $0 @endif</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    @if(isset($result['listing_bat']['officeSupplies'])) {!!
                                    $batMap->calculatePercentage($result['listing_bat']['officeSupplies'],$gross_sales) !!} @else $0 @endif</td>
                            </tr>
                            <tr>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">Owner
                                    Personal/Travel/Meals</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    @if(isset($result['listing_bat']['ownerPersonalExpenses'])) ${!!
                                    number_format($result['listing_bat']['ownerPersonalExpenses']) !!} @else $0 @endif</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    @if(isset($result['listing_bat']['ownerPersonalExpenses'])) {!!
                                    $batMap->calculatePercentage($result['listing_bat']['ownerPersonalExpenses'],$gross_sales) !!} @else $0 @endif</td>
                            </tr>
                            <tr>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">Rent</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">@if(isset($result['listing_bat']['rent']))
                                    ${!! number_format($result['listing_bat']['rent']) !!}
                                    @else $0 @endif</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">@if(isset($result['listing_bat']['rent'])) {!!
                                    $batMap->calculatePercentage($result['listing_bat']['rent'],$gross_sales) !!} @else $0 @endif</td>
                            </tr>
                            <tr>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">Repairs &amp; Maintenance
                                </td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    @if(isset($result['listing_bat']['repairsMaintenance'])) ${!!
                                    number_format($result['listing_bat']['repairsMaintenance']) !!} @else $0 @endif</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    @if(isset($result['listing_bat']['repairsMaintenance'])) {!!
                                    $batMap->calculatePercentage($result['listing_bat']['repairsMaintenance'],$gross_sales) !!} @else $0 @endif</td>
                            </tr>
                            <tr>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">Restaurant Supplies</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    @if(isset($result['listing_bat']['restaurantSupplies'])) ${!!
                                    number_format($result['listing_bat']['restaurantSupplies']) !!} @else $0 @endif</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    @if(isset($result['listing_bat']['restaurantSupplies'])) {!!
                                    $batMap->calculatePercentage($result['listing_bat']['restaurantSupplies'],$gross_sales) !!} @else $0 @endif</td>
                            </tr>

                            <tr>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">Royalties</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    @if(isset($result['listing_bat']['royalties'])) ${!!
                                    number_format($result['listing_bat']['royalties']) !!} @else $0 @endif</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    @if(isset($result['listing_bat']['royalties'])) {!!
                                    $batMap->calculatePercentage($result['listing_bat']['royalties'],$gross_sales) !!} @else $0 @endif</td>
                            </tr>
                            <tr>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">Salaries &amp; Wages</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    @if(isset($result['listing_bat']['salariesWages'])) ${!!
                                    number_format($result['listing_bat']['salariesWages']) !!} @else $0 @endif</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    @if(isset($result['listing_bat']['salariesWages'])) {!!
                                    $batMap->calculatePercentage($result['listing_bat']['salariesWages'],$gross_sales) !!} @else $0 @endif</td>
                            </tr>
                            <tr>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">Telephone/Internet/Cable
                                </td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    @if(isset($result['listing_bat']['telephone'])) ${!!
                                    number_format($result['listing_bat']['telephone']) !!} @else $0 @endif</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    @if(isset($result['listing_bat']['telephone'])) {!!
                                    $batMap->calculatePercentage($result['listing_bat']['telephone'],$gross_sales) !!} @else $0 @endif</td>
                            </tr>
                            <tr>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">Utilities</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    @if(isset($result['listing_bat']['utilities'])) ${!!
                                    number_format($result['listing_bat']['utilities']) !!} @else $0 @endif</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    @if(isset($result['listing_bat']['utilities'])) {!!
                                    $batMap->calculatePercentage($result['listing_bat']['utilities'],$gross_sales) !!} @else $0 @endif</td>
                            </tr>
                            <tr>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">Uniforms</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">@if(isset($result['listing_bat']['uniforms']))
                                    ${!!
                                    number_format($result['listing_bat']['uniforms']) !!} @else $0 @endif</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">@if(isset($result['listing_bat']['uniforms']))
                                    {!!
                                    $batMap->calculatePercentage($result['listing_bat']['uniforms'],$gross_sales) !!} @else $0 @endif</td>
                            </tr>
                            <tr>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">Other Uncategorized</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    @if(isset($result['listing_bat']['otherUncategorized'])) ${!!
                                    number_format($result['listing_bat']['otherUncategorized']) !!} @else $0 @endif</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    @if(isset($result['listing_bat']['otherUncategorized'])) {!!
                                    $batMap->calculatePercentage($result['listing_bat']['otherUncategorized'],$gross_sales) !!} @else $0 @endif</td>
                            </tr>
                            <tr>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    @if(isset($result['listing_bat']['prefilledfield'])) {!! $result['listing_bat']['prefilledfield']
                                    !!} @endif </td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    @if(isset($result['listing_bat']['filledfieldvalue'])) ${!!
                                    number_format($result['listing_bat']['filledfieldvalue']) !!} @else $0 @endif</td>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif;">
                                    @if(isset($result['listing_bat']['filledfieldvalue'])) {!!
                                    $batMap->calculatePercentage($result['listing_bat']['filledfieldvalue'],$gross_sales) !!} @else $0 @endif</td>
                            </tr>
                            <tr>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif; font-weight:bold;">Total
                                    Expenses</td>
                                <td
                                    style="font-size:15px; font-family: 'Arimo', sans-serif; font-weight:bold; text-decoration:underline;">
                                    ${!!
                                    number_format($totalExpenses) !!}</td>
                                <td
                                    style="font-size:15px; font-family: 'Arimo', sans-serif; font-weight:bold; text-decoration:underline;">
                                    {!!
                                    $batMap->calculatePercentage($totalExpenses,$gross_sales) !!}</td>
                            </tr>
                            <tr>
                                <td style="font-size:15px; font-family: 'Arimo', sans-serif; font-weight:bold;">Net
                                    Income</td>
                                <td
                                    style="font-size:15px; font-family: 'Arimo', sans-serif; font-weight:bold; text-decoration:underline;">
                                    ${!!
                                    number_format($netIncome) !!}</td>
                                <td
                                    style="font-size:15px; font-family: 'Arimo', sans-serif; font-weight:bold; text-decoration:underline;">
                                    {!!
                                    $batMap->calculatePercentage($netIncome,$gross_sales) !!}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td height="2">
                        <br />
                    </td>
                </tr>
                <tr>
                    <td
                        style="width: 100%; font-size: 14px; font-family: 'Arimo', sans-serif; line-height:20px; color: #000; font-style: italic;">
                        Note
                        that these figures have been provided by the seller of this restaurant. We Sell Restaurants has
                        depended on the seller to provide true and accurate data. We Sell Restaurants does not warrant
                        or verify the source of this data. All buyers are advised to conduct independent due diligence
                        of this information.</td>
                </tr>
            </table>
        </div>
        
        <!-- page 7.1 -->
        <div style="page-break-before: always;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" nobr="true">
                <tr>
                    <td height="15" align="center">&nbsp;</td>
                </tr>
                <tr>
                    <td align="left" valign="left"
                        style="font-family: 'Arimo', sans-serif;  font-size:36px; font-weight:bold; color:#ff0000;">
                        Income Statement
                    </td>
                </tr>
                <tr>
                    <td width="100%"
                        style="font-size: 18px; line-height: 24px; font-family: 'Arimo', sans-serif; color: #e70033; text-align: left; font-weight: bold;">
                        {!! $result['bname'] !!}</td>
                </tr>
                <tr>
                    <td width="100%"
                        style="font-size: 14px; line-height: 18px; font-family: 'Arimo', sans-serif; color: #e70033; text-align: left; font-weight: bold;">
                        Data Source: @if(isset(['listing_bat']['sourceOfDataYear'])) {!! ['listing_bat']['sourceOfDataYear'] !!} @endif,
                        @if(isset($result['listing_bat']['sourceOfDataYear_2'])) {!! $result['listing_bat']['sourceOfDataYear_2'] !!} @endif</td>
                </tr>
                <tr>
                    <td height="8"></td>
                </tr>

                <tr>
                    <td bgcolor="white"
                        style="padding: 15px; font-family: 'Arimo', sans-serif; font-size:16px; line-height: 30px;">{!!
                        $yearData !!}</td>
                </tr>
                <tr>
                    <td style="height: 20px;"></td>
                </tr>

                <tr>
                    <td
                        style="width: 100%; font-family: 'Arimo', sans-serif; font-size:16px; line-height:22px; color: #000; font-style: italic;">
                        <b>Discretionary Earnings:</b> Discretionary Earnings(DE), also known as Sellers Discretionary
                        Cash Flow, Sellers Discretionary Earnings or Owners Benefit, is the adjusted earnings before
                        taxes, interest income or expense, non-operating and non-recurring income/expenses, depreciation
                        and other non-cash charges. It includes a single owner/operator or officer\'s compensation and
                        is typically used as the basis for SBA and conventional lending.
                    </td>
                </tr>
                <tr>
                    <td
                        style="width: 100%; font-family: 'Arimo', sans-serif; font-size:16px; line-height:22px; color: #000; font-style: italic;">
                        <b>Add
                            Backs:</b> Add backs refer to typical expense and/or non-cash item "added back" to the net
                        profit to calculate the Discretionary Earnings. Such items would be fully documented in the
                        Profit & Loss statement and could include any personal expenses paid for by the business. This
                        could also include items like: owner compensation, owner insurance paid by company, owner car
                        expense paid by company, plus interest, depreciation, and amortization. Add backs usually
                        include a manager s salary as We Sell Restaurants recasts to the standard SBA model for lending
                        based on a single owner/operator.
                    </td>
                </tr>
                <tr>
                    <td
                        style="width: 100%; font-family: 'Arimo', sans-serif; font-size:16px; line-height:22px; color: #000; font-style: italic;">
                        <b>Net
                            Sales:</b> Net Sales are the total sales of the restaurant minus any comps, promos, tips or
                        sales tax. If the restaurant is a franchise, this is the amount on which royalties are paid.
                    </td>
                </tr>
                <tr>
                    <td style="width: 100%; height: 20px;"></td>
                </tr>
                <tr>
                    <td
                        style="border: 1px solid #e70033; width: 100%; font-family: 'Arimo', sans-serif; font-size:16px; line-height:22px; color: #000; font-style: italic; height: 48px;">
                        &nbsp; <b>Notes: @if(isset($result['listing_bat']['batNotes'])) {!! $result['listing_bat']['batNotes'] !!} @endif</b></td>
                </tr>
            </table>
        </div>
        
        <!-- page 8 -->
        <div id="page8" style="page-break-before: always;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" nobr="true">
                <tr>
                    <td align="left" valign="left"
                        style="font-family: 'Arimo', sans-serif; font-size:32px; font-weight:bold; color:#ff0000;">
                        Equipment List
                    </td>
                </tr>
                <tr>
                    <td height="8"></td>
                </tr>
                <tr>
                    <td width="100%" bgcolor="white" style="font-family: 'Arimo', sans-serif;">{!! $equipmentlist !!}
                    </td>
                </tr>
            </table>
        </div>
        
        <!-- page 9 -->
        <div id="page9" style="page-break-before: always;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td align="left" valign="left"
                        style="font-family: 'Arimo', sans-serif;font-size:32px;font-weight:bold; color:#ff0000;">Lease Overview
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
                                                @if(isset($result['bname'])) {!! $result['bname'] !!} @endif</td>
                                        </tr>
                                        <tr>
                                            <td
                                                style="color: #ffffff; font-size: 16px; font-family: 'Arimo', sans-serif; line-height: 24px;">
                                                @if(isset($result['baddress'])) {!! $result['baddress'] !!} @endif</td>
                                        </tr>
                                        <tr>
                                            <td
                                                style="color: #ffffff; font-size: 16px; font-family: 'Arimo', sans-serif; line-height: 24px;">
                                                @if(isset($result['bcity'])) {{$result['bcity']}} @endif,
                                                @if(isset($result['bstate'])) {{$result['bstate']}} @endif
                                                @if(isset($result['bzip'])) {{$result['bzip']}} @endif
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
                                                                            style="width: 80px; height: 60px; margin-bottom: 15px;" />
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
                                                                            style="width: 60px; height: 57px; margin-bottom: 15px;" />
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
                                                                        @if(isset($result['listing_occupancy_leases']['lterm'])) {!! $result['listing_occupancy_leases']['lterm'] !!}
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
                                                                            style="width: 51px; height: 57px; margin-bottom: 15px;" />
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
                                                                        @if(isset($result['listing_bat']['franchiserenewal'])) {!! $result['listing_bat']['franchiserenewal'] !!}
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
        <div id="page10" style="page-break-before: always;">
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
                    <td style="width: 50%; vertical-align: top; padding: 15px;" bgcolor="white">
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
                                                @if(isset(['listing_ops']['currentowner'] )) {!! ['listing_ops']['currentowner'] !!} @endif</td>
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
                    <td style="width: 50%; vertical-align: top; padding: 15px;" bgcolor="white">
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
                                                @if(isset(['listing_bat']['hoursWorkedByOwner'])) {!! ['listing_bat']['hoursWorkedByOwner'] !!}
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
                    <td style="width: 50%; vertical-align: top; padding: 15px;" bgcolor="white">
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
                                                @if(isset($result['seller_notes']['buyer_id'])) {!! $result['seller_notes']['buyer_id'] !!} @endif</td>
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
        <div id="page11" style="page-break-before: always;">
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
                                                Asking Price: @if(isset($result['bsaleprice'])) ${!! $result['bsaleprice'] !!}
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
                                                        style="font-family: 'Arimo', sans-serif; font-size: 14px; line-height: 20px; color: #000000">
                                                        Furniture, fixtures, and equipment</li>
                                                    <li
                                                        style="font-family: 'Arimo', sans-serif; font-size: 14px; line-height: 20px; color: #000000">
                                                        All
                                                        customer/client lists</li>
                                                    <li
                                                        style="font-family: 'Arimo', sans-serif; font-size: 14px; line-height: 20px; color: #000000">
                                                        Lease
                                                    </li>
                                                    <li
                                                        style="font-family: 'Arimo', sans-serif; font-size: 14px; line-height: 20px; color: #000000">
                                                        Business phone number</li>
                                                    <li
                                                        style="font-family: 'Arimo', sans-serif; font-size: 14px; line-height: 20px; color: #000000">
                                                        Social Media Accounts</li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="height: 20px;"></td>
                                        </tr>
                                        <tr>
                                            <td
                                                style="font-family: 'Arimo', sans-serif; font-size: 16px; line-height: 24px; color: #000000">
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
                                                        style="font-family: 'Arimo', sans-serif; font-size: 14px; line-height: 20px; color: #000000">
                                                        Cash
                                                        on hand</li>
                                                    <li
                                                        style="font-family: 'Arimo', sans-serif; font-size: 14px; line-height: 20px; color: #000000">
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
                                                style="font-family: 'Arimo', sans-serif; font-size: 16px; line-height: 24px; color: #000000">
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
                                                        style="font-family: 'Arimo', sans-serif; font-size: 14px; line-height: 20px; color: #000000">
                                                        Due
                                                        Diligence Period</li>
                                                    <li
                                                        style="font-family: 'Arimo', sans-serif; font-size: 14px; line-height: 20px; color: #000000">
                                                        Approval of the landlord</li>
                                                    <li
                                                        style="font-family: 'Arimo', sans-serif; font-size: 14px; line-height: 20px; color: #000000">
                                                        Approval of the lender (if applicable)</li>
                                                    <li
                                                        style="font-family: 'Arimo', sans-serif; font-size: 14px; line-height: 20px; color: #000000">
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
                                    Comparative Analysis</td>
                            </tr>
                            <tr>
                                <td height="4px"></td>
                            </tr>
                            <tr>
                                <td colspan="2"
                                    style="text-align:justify;padding:0px;margin:0px;color: #000;font-family: 'Arimo', sans-serif;font-size:16px; line-height:22px; font-weight:400;">
                                    There are a number of questions that buyers should ask themselves when reviewing the
                                    financial statements of a business offered for sale. These questions are based on
                                    common United States accounting practices and methods. Some of the focus areas would
                                    typically include: Profits & Profit Margin, Sales, Food Costs and Labor Costs.
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" height="10px"></td>
                            </tr>
                            <tr>
                                <td colspan="2"
                                    style="text-align:left;color: #000000;font-weight:bold;padding:0px;margin:0px; font-family: 'Arimo', sans-serif;font-size: 18px; line-height: 30px;">
                                    Profitability - Are profitability trends favorable in this restaurant?
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"
                                    style="text-align:justify;color: #000000;padding:0px;margin:0px;font-family: 'Arimo', sans-serif;font-size:16px; line-height:22px; font-weight:400; ">
                                    A restaurant\'s net profit margin should be compared to competitors in the industry.
                                    No profit statistic is more important than the net profit margin -- it is crucial in
                                    the short and long run. The other variable to consider is net profit dollars. If
                                    sales decrease and expenses remain constant, there is risk to net profit dollars. In
                                    particular, restaurants are vulnerable to shifts in sales if they do not control
                                    food and labor costs.
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" height="10px"></td>
                            </tr>
                            <tr>
                                <td colspan="2"
                                    style="text-align:left;color: #000000;font-weight:bold; padding:0px;margin:0px;font-family: 'Arimo', sans-serif; font-size: 18px; line-height: 30px;">
                                    Sales - Are sales growing and satisfactory?
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"
                                    style="text-align:justify;color: #000000;padding:0px;margin:0px;font-family: 'Arimo', sans-serif; font-size:16px; line-height:22px; font-weight:400;">
                                    Sales changes in themselves are typically not vital analytical points. Profitability
                                    trends are more important. Still the clear goal over time is to increase sales since
                                    the cost of doing business almost always goes up over the long run.
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" height="10px"></td>
                            </tr>
                            <tr>
                                <td colspan="2"
                                    style="text-align:left;color: #000000;font-weight:bold; padding:0px;margin:0px;font-family: 'Arimo', sans-serif; font-size: 18px; line-height: 30px;">
                                    Expenses - Is the company controlling expenses effectively?
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"
                                    style="text-align:justify;color: #000000;padding:0px;margin:0px; font-family: 'Arimo', sans-serif; font-size:16px; line-height:22px; font-weight:400;">
                                    Key variables specific to the restaurant industry include Food Costs and Labor Costs
                                    which can dramatically impact the company\'s profit. Both of these variables are
                                    often compared to industry standards to provide a snapshot of this company\'s
                                    operating profitability and opportunity.
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" height="10px"></td>
                            </tr>
                            <tr>
                                <td colspan="2"
                                    style="text-align:left;color: #000000;font-weight:bold; padding:0px;margin:0px;font-family: 'Arimo', sans-serif; font-size: 18px; line-height: 30px;">
                                    Industry Comparisons -
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"
                                    style="text-align:justify;color: #000000;padding:0px;margin:0px;font-family: 'Arimo', sans-serif;font-size:16px; line-height:22px; font-weight:400;">
                                    Is the company operating at, below, or above industry standards? Industry specific
                                    comparison are helpful in understanding the efficiency of a restaurant as well as
                                    the opportunity for improvement.
                                </td>
                            </tr>
                            <tr>
                                <td height="20px"></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align: center; width: 100%;"><img
                                        src="{{ public_path('assets/images/print_pdf/industry.jfif') }}" alt="owner"
                                        style="width: 280px; height: auto;" /></td>
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
                    <td>
                        <table cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td colspan="2"
                                    style="text-align:left;color: #e70033;font-family: 'Arimo', sans-serif; font-size: 48px; line-height: 60px; padding-bottom: 20px;">
                                    The Restaurant Industry</td>
                            </tr>
                            <tr>
                                <td height="4px"></td>
                            </tr>
                            <tr>
                                <td colspan="2"
                                    style="text-align:justify;padding:0px;margin:0px;color: #000;font-family: 'Arimo', sans-serif;font-size:16px; line-height:22px; font-weight:400; font-style: italic;">
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
                                    total $789 Billion dollars in 2021, up 19.7% from 2020. Sales in 2020 were
                                    negatively affected by the virus but the National Restaurant Association reports
                                    that consumer spending in restaurants trended sharply higher during the first half
                                    of 2021, driven by rising vaccination numbers, additional stimulus payments and
                                    healthy household balance sheets. <br /> <br /> Looking to the future, the National
                                    Restaurant Association projects 2030 restaurant sales to be $1.2 trillion dollars
                                    and provide employment opportunities for more than 17 million individuals. </td>
                            </tr>
                            <tr>
                                <td colspan="2" height="10px"></td>
                            </tr>
                            <tr>
                                <td colspan="2"
                                    style="text-align:left;color: #000000;font-weight:bold; padding:0px;margin:0px;font-family: 'Arimo', sans-serif;font-size: 18px; line-height: 30px;">
                                    Growth </td>
                            </tr>
                            <tr>
                                <td colspan="2"
                                    style="text-align:justify;color: #000000;padding:0px;margin:0px;font-family: 'Arimo', sans-serif; font-size:16px; line-height:22px; font-weight:400;">
                                    Growth in the restaurant industry for the past several decades has been driven by
                                    consumers desire for convenience, socialization, and high-quality food and service.
                                    <br /> <br /> These same drivers will be the catalysts for expansion well into the
                                    future, as the restaurant industry continues to innovate and adapt to the
                                    ever-changing tastes and preferences of consumers. <br /> <br /> Nearly 8 in 10
                                    adults say their favorite restaurant foods deliver flavor and taste sensations that
                                    just can\'t be duplicated in the home kitchen. <br /> <br /> Restaurants are an
                                    integral part of our social fabric; 6 in 10 adults say restaurants are an essential
                                    part of their lifestyle.
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
        
        <!-- page 13.1  -->
        <div style="page-break-before: always;">
            <table width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td>
                        <table cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td colspan="2"
                                    style="text-align:left;color: #000000;font-weight:bold;padding:0px;margin:0px; font-family: 'Arimo', sans-serif;font-size: 18px; line-height: 30px;">
                                    Profit Margins
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"
                                    style="text-align:justify;color: #000000;padding:0px;margin:0px;font-family: 'Arimo', sans-serif;font-size:16px; line-height:22px; font-weight:400; ">
                                    The Gross Profit Margin dollars are calculated by taking the restaurant revenue and
                                    subtracting the cost of goods sold. The Gross Profit Margin is a ratio of the Gross
                                    Profit Margin dollars divided by the restaurant revenue. For a restaurant with
                                    revenue over $1 million, we expect to see higher gross profit dollars as shown in
                                    the chart. <br /> <br /> Net Profit margin refers to the percentage an
                                    owner/operator would have available for his or her benefit after all expenses are
                                    paid. It is calculated by taking the net income divided by the restaurant revenue.
                                    Again, for restaurants over $1 million in sales, we expect to see higher net income.
                                    <br /> <br /> Net Income does not usually include dollars in salary paid to an owner
                                    or a manager. The Discretionary Earnings or Owner Benefit shown on this report
                                    reflects EBITDA (Earnings before Interest, Taxes, Depreciation and Amortization)
                                    plus the salary of the owner or full time manager in the restaurant. This is the
                                    industry standard for evaluation for lending. Discretionary Earnings may also
                                    commonly be referred to as Owner benefit, recast EBITDA, SDE (Sellers Discretionary
                                    Earning) or SDCF (Sellers Discretionary Cash Flow). <br /> <br />
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"
                        style="text-align:justify;color: #000000;padding:0px;margin:0px;font-family: 'Arimo', sans-serif;font-size:16px; line-height:22px; font-weight:400; font-style: italic">
                        Financial analysis is not a science; it is about the interpretation and evaluation of financial
                        events.Some judgment will always be part of any report and analysis. Before making any financial
                        decision, always consult an experienced and knowledgeable professional.</td>
                </tr>
                <tr>
                    <td colspan="2" style="height: 4px"></td>
                </tr>
                <tr>
                    <td colspan="2"
                        style="text-align:left;color: #e70033;font-family: 'Arimo', sans-serif;font-size:22px; line-height: 26px; padding: 20px 0px;">
                        Industry Comparisons</td>
                </tr>
                <tr>
                    <td colspan="2" height="8">
                        <table width="100%" cellspacing="0" cellpadding="0">
                            <tr>
                                <td style="width: 65%;" bgcolor="white">
                                    <table cellpadding="0" cellspacing="0" width="100%">
                                        <tr>
                                            <td>
                                                <table cellpadding="0" cellspacing="0" width="100%">
                                                    <tr>
                                                        <td colspan="3" style="height: 8px"></td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width: 3%"></th>
                                                        <th style="width: 30.33%;"></th>
                                                        <th
                                                            style="width: 28.33%; font-size: 14px; line-height: 18px; color: #000; font-family: sans-serif; font-weight: bold;">
                                                            This Restaurant</th>
                                                        <th
                                                            style="width: 36.33%; font-size: 14px; line-height: 18px; color: #000; font-family: sans-serif; font-weight: bold;">
                                                            Industry Standard</th>
                                                        <th style="width: 3%"></th>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5" style="height: 8px"></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 3%"></td>
                                                        <td
                                                            style="width: 30.33%; font-size: 14px; line-height: 16px; color: #000; font-family: sans-serif; font-weight: bold;">
                                                            Gross <br /> Profit <br /> Margin</td>
                                                        <td
                                                            style="width: 28.33%; font-size: 14px; line-height: 16px; color: #000; font-family: sans-serif;">
                                                            68.2%</td>
                                                        <td
                                                            style="width: 36.33%; font-size: 14px; line-height: 16px; color: #000; font-family: sans-serif;">
                                                            54.9% (&#60;$1MM Sales) <br /> 56.6% (&#62;$1MM Sales)</td>
                                                        <td style="width: 3%"></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5" style="height: 8px"></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 3%"></td>
                                                        <td
                                                            style="width: 30.33%; font-size: 14px; line-height: 16px; color: #000; font-family: sans-serif; font-weight: bold;">
                                                            Net <br /> Profit <br /> Margin</td>
                                                        <td
                                                            style="width: 28.33%; font-size: 14px; line-height: 16px; color: #000; font-family: sans-serif;">
                                                            6.2%</td>
                                                        <td
                                                            style="width: 36.33%; font-size: 14px; line-height: 16px; color: #000; font-family: sans-serif;">
                                                            10.0% (&#60;$1MM Sales) <br /> 12.0% (&#62;$1MM Sales)</td>
                                                        <td style="width: 3%"></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5" style="height: 8px"></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td style="width: 2%"></td>
                                <td style="width: 33%;">
                                    <img src="{{ public_path('assets/images/print_pdf/sale.png') }}" alt=""
                                        style="max-width: 100%; height: auto;" />
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">

                    </td>
                </tr>
            </table>
        </div>
        
        <!-- page 13.2 -->
        <div style="page-break-before: always;">
            <table width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td colspan="2"
                        style="text-align:left;color: #000000;font-weight:bold;padding:0px;margin:0px; font-family: 'Arimo', sans-serif;font-size: 20px; line-height: 36px;">
                        Labor Costs</td>
                </tr>
                <tr>
                    <td colspan="2"
                        style="text-align:justify;color: #000000;padding:0px;margin:0px;font-family: 'Arimo', sans-serif;font-size:16px; line-height:22px; font-weight:400; ">
                        A profitable restaurant typically generates a 25% or lower labor cost. Combined with food costs,
                        these expenses consume 50-75% of total revenue. Because of the impact that labor costs have on
                        restaurant operations and profitability, this is a key metric to examine. <br /> <br /> Beyond
                        the bottom line, labor costs also reflect an operator\'s skill level. High labor costs in a
                        restaurant available for sale signals an opportunity for greater profit dollars delivered to a
                        strong operator. The industry standard is based on the Uniform System of Accounts for
                        Restaurants (a handbook available from the National Restaurant Association). Owner Compensation
                        or Manager Compensation, if included in payroll costs, is added back on this document to reflect
                        Discretionary Income. Labor costs do not always reflect payroll taxes or the cost of payroll
                        processing so the reader should confirm those costs as well.</td>
                </tr>
                <tr>
                    <td colspan="2" style="height: 8px"></td>
                </tr>
                <tr>
                    <td colspan="2" style="height: 2px"></td>
                </tr>
                <tr>
                    <td style="width: 150px;"></td>
                    <td style="width: 240px;" bgcolor="white">
                        <table cellpadding="0" cellspacing="0" width="100%" bgcolor="white">
                            <tr>
                                <td colspan="5" style="height: 8px; width: 300px;"></td>
                            </tr>
                            <tr>
                                <th style="width: 30px"></th>
                                <th style="width: 80px;"></th>
                                <th
                                    style="width: 80px; font-size: 14px; line-height: 18px; color: #000; font-family: sans-serif; font-weight: bold;">
                                    This Restaurant</th>
                                <th
                                    style="width: 80px; font-size: 14px; line-height: 18px; color: #000; font-family: sans-serif; font-weight: bold;">
                                    Industry Avg.</th>
                                <th style="width: 30px"></th>
                            </tr>
                            <tr>
                                <td colspan="5" style="height: 8px; width: 300px;"></td>
                            </tr>
                            <tr>
                                <th style="width: 30px"></th>
                                <td
                                    style="width: 80px; font-size: 12px; line-height: 16px; color: #000; font-family: sans-serif; font-weight: bold;">
                                    Labor Cost</td>
                                <td
                                    style="width: 80px; font-size: 12px; line-height: 16px; color: #000; font-family: sans-serif;">
                                    18.9%</td>
                                <td
                                    style="width: 80px; font-size: 12px; line-height: 16px; color: #000; font-family: sans-serif;">
                                    High 25%, <br /> Low 20%</td>
                                <th style="width: 30px"></th>
                            </tr>
                            <tr>
                                <td colspan="5" style="height: 8px; width: 300px;"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td style="width: 150px;"></td>
                    <td style="width: 310px;">
                        <img src="{{ public_path('assets/images/print_pdf/labour.png') }}" alt="labour" />
                    </td>
                </tr>
            </table>
        </div>        

        <!-- page 13.3 -->
        <div style="page-break-before: always;">
            <table width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td colspan="3"
                        style="text-align:left;color: #000000;font-weight:bold;padding:0px;margin:0px; font-family: 'Arimo', sans-serif;font-size: 20px; line-height: 36px;">
                        Food Costs</td>
                </tr>
                <tr>
                    <td colspan="3"
                        style="text-align:justify;color: #000000;padding:0px;margin:0px;font-family: 'Arimo', sans-serif;font-size:16px; line-height:22px; font-weight:400; ">
                        Food cost is an important factor to consider in the operation of a restaurant. It refers to the
                        percentage of revenue that is spent on food and beverage items. A high food cost can have a
                        negative impact on the profitability of a restaurant, as it could indicate waste or inattention
                        to menu pricing and inventory management. On the other hand, a low food cost may suggest that
                        the restaurant is cutting corners or using low-quality ingredients. <br /> <br /> There are
                        several ways to manage food cost in a restaurant: <br /> Menu pricing: Setting prices for menu
                        items that reflect the cost of ingredients and other expenses can help to maintain a healthy
                        food cost percentage.<br /> Inventory management: Careful tracking of inventory and ordering of
                        supplies can help to minimize waste and reduce the cost of food. <br />Recipe standardization:
                        Ensuring that recipes are followed consistently can help to control portion sizes and reduce
                        wast. <br /> Cost analysis: Regularly analyzing the cost of ingredients and menu items can help
                        a restaurant to make informed decisions about pricing and menu planning. <br /> <br /> Overall,
                        it is important for a restaurant to strike a balance between maintaining a reasonable food cost
                        and providing high-quality ingredients and dishes to customers. <br /> <br /> <i>Calculations
                            for Food Cost, Occupancy Cost, Gross Profit and Net Profit are based on the Uniform System
                            of Accounts for Restaurants (a handbook available from the National Restaurant
                            Association)</i></td>
                </tr>
                <tr>
                    <td colspan="3" style="height: 40px"></td>
                </tr>
                <tr>
                    <td colspan="3"
                        style="text-align:left;color: #e70033;font-family: 'Arimo', sans-serif;font-size:16px; line-height: 21px;">
                        Industry Comparisons</td>
                </tr>
                <tr>
                    <td colspan="3" style="height: 8px"></td>
                </tr>
                <tr>
                    <td style="width: 50%;" bgcolor="white">
                        <table cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td>
                                    <table cellpadding="0" cellspacing="0" width="100%" bgcolor="white">
                                        <tr>
                                            <td colspan="3" style="height: 8px"></td>
                                        </tr>
                                        <tr>
                                            <th style="width: 5%"></th>
                                            <th
                                                style="width: 40%; font-size: 14px; line-height: 18px; color: #000; font-family: 'Arimo', sans-serif; font-weight: bold;">
                                            </th>
                                            <th
                                                style="width: 40%; font-size: 14px; line-height: 18px; color: #000; font-family: 'Arimo', sans-serif; font-weight: bold;">
                                                Avg. Food Cost</th>
                                            <th style="width: 5%"></th>
                                        </tr>
                                        <tr>
                                            <td colspan="5" style="height: 8px"></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 5%"></td>
                                            <td
                                                style="width: 50%; font-size: 16px; line-height: 26px; color: #000; font-family: 'Arimo', sans-serif; font-weight: bold;">
                                                This Restaurant</td>
                                            <td
                                                style="width: 30%; font-size: 16px; line-height: 26px; color: #000; font-family: 'Arimo', sans-serif; font-weight: bold;">
                                                31.8%</td>
                                            <td style="width: 5%"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="height: 8px"></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 5%"></td>
                                            <td
                                                style="width: 50%; font-size: 16px; line-height: 26px; color: #000; font-family: 'Arimo', sans-serif;">
                                                Fine Dining Avg.</td>
                                            <td
                                                style="width: 30%; font-size: 16px; line-height: 26px; color: #000; font-family: 'Arimo', sans-serif; font-weight: bold;">
                                                35%</td>
                                            <td style="width: 5%"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="height: 8px"></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 5%"></td>
                                            <td
                                                style="width: 50%; font-size: 16px; line-height: 26px; color: #000; font-family: 'Arimo', sans-serif;">
                                                Pizza/Italian Avg.</td>
                                            <td
                                                style="width: 30%; font-size: 16px; line-height: 26px; color: #000; font-family: 'Arimo', sans-serif; font-weight: bold;">
                                                32%</td>
                                            <td style="width: 5%"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="height: 8px"></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 5%"></td>
                                            <td
                                                style="width: 50%; font-size: 16px; line-height: 26px; color: #000; font-family: 'Arimo', sans-serif;">
                                                American Casual</td>
                                            <td
                                                style="width: 30%; font-size: 16px; line-height: 26px; color: #000; font-family: 'Arimo', sans-serif; font-weight: bold;">
                                                29%</td>
                                            <td style="width: 5%"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="height: 8px"></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td style="width: 2%"></td>
                    <td style="width: 48%;">
                        <img src="{{ public_path('assets/images/print_pdf/food.png') }}" alt="" />
                    </td>
                </tr>
            </table>
        </div>
        
        <!-- page 13.4 -->
        <div style="page-break-before: always;">
            <table width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td>
                        <table cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td colspan="2"
                                    style="text-align:left;color: #000000;font-weight:bold;padding:0px;margin:0px; font-family: 'Arimo', sans-serif;font-size: 22px; line-height: 40px;">
                                    Rent & Occupancy Costs </td>
                            </tr>
                            <tr>
                                <td colspan="2"
                                    style="text-align:justify;color: #000000;padding:0px;margin:0px;font-family: 'Arimo', sans-serif;font-size:16px; line-height:22px; font-weight:400; ">
                                    Physical location is very important to the restaurant owner. The length and value of
                                    the lease and its cost as a percent of total sales is a key indicator. In most large
                                    markets, rising rent costs in the past decade have made this variable even more
                                    important. <br /> <br /> We Sell Restaurants reflects the total occupancy costs in
                                    this tool. That means you are looking at both base rent plus all CAMS (Common Area
                                    Maintenance Charges), Taxes and Insurance charged to you as a part of your lease in
                                    the space. <br /> <br /> Competition to be in the most desirable parts of the dining
                                    scene has driven rents to all-time highs with no end in sight. For these reasons,
                                    acquisition of an existing business may be the only way to gain a space in these
                                    highly competitive markets. <br /> <br /> A restaurant buyer is often assigned the
                                    existing rights of the current tenant along with options to renews the lease.
                                    Evaluation of a property should include some subjective consideration of the lease
                                    and location. <br /> <br /> <i>Annual Rent Expense WILL ALWAYS include CAMS or
                                        Common Area Maintenance Charges Unless Noted.</i>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="height: 2px"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <table cellpadding="0" cellspacing="0" bg-color="white">
                            <tr>
                                <td colspan="5" style="height: 8px; width: 300px;"></td>
                            </tr>
                            <tr>
                                <th style="width: 30px"></th>
                                <th
                                    style=" font-size: 16px; line-height:22px; color: #000; font-family: sans-serif; font-weight: bold;  ">
                                    This Restaurant</th>
                                <td
                                    style="width: 80px; font-size: 16px; line-height:22px; color: #000; font-family: sans-serif; font-weight: bold;;">
                                    Industry Avg.</td>
                                <th style="width: 80px;"></th>
                                <th style="width: 30px"></th>
                            </tr>
                            <tr>
                                <td colspan="5" style="height: 8px; width: 300px;"></td>
                            </tr>
                            <tr>
                                <th style="width: 30px"></th>
                                <td
                                    style="width: 80px; font-size: 14px; line-height: 22px; color: #000; font-family: sans-serif; font-weight: bold;">
                                    Occupancy Cost</td>
                                <td
                                    style="width: 80px; font-size: 14px; line-height: 22px; color: #000; font-family: sans-serif;">
                                    14.6%</td>
                                <td
                                    style="width: 80px; font-size: 14px; line-height: 22px; color: #000; font-family: sans-serif;">
                                    High 12%, <br /> Low 8%</td>
                                <th style="width: 30px"></th>
                            </tr>
                            <tr>
                                <td colspan="5" style="height: 8px; width: 300px;"></td>
                            </tr>
                            <tr>
                                <td style="width: 150px;"></td>
                                <td style="width: 310px;">
                                    <img src="{{ public_path('assets/images/print_pdf/rent.png') }}" alt=""
                                        style="width: 310px; height: 240px" />
                                </td>
                            </tr>


                            <!-- <tr>
                                <html>

                                <head>
                                    <style>
                                    table {
                                        font-family: arial, sans-serif;
                                        border-collapse: collapse;
                                        width: 100%;
                                    }

                                    td,
                                    th {
                                        border: 1px solid #dddddd;
                                        text-align: left;
                                        margin: 20px;
                                    }

                                    tr:nth-child(even) {
                                        background-color: #dddddd;
                                    }
                                    </style>
                                </head>

                                <body>

                                    <h2>HTML Table</h2>

                                    <table>
                                        <tr>
                                            <th></th>
                                            <th>This Restaurant</th>
                                            <th></th>

                                            <th>Industry Avg.</th>
                                        </tr>
                                        <td>Occupancy Cost</td>

                                        <td>0.0%</td>
                                        <td>High 0%
                                        <td>
                                            <tr>


                                            </tr>
                                        <th></th>
                                        <th></th>
                                        <td>Low 0%
                                        <td>

                                    </table>

                                </body>

                                </html>
                            </tr>
                        </table> -->
                    </td>
                </tr>
            </table>
        </div>
        
        <!-- page 14 -->
        <div id="page14" style="page-break-before: always;">
            <table width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td>
                        <table cellpadding="0" cellspacing="0" width="100%"
                            style="background-color: #fff; border-collapse: separate; border-spacing: 0px 20px;">
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
                                <td colspan="2" height="8px"></td>
                            </tr>
                            <tr>
                                <td style="width: 4%"></td>
                                <td style="width: 92%;text-align: center;">
                                    @if(isset( $result['listing_media']['img_file']))
                                    <img src="{{ url('storage/images/list/main_images/'. $result['listing_media']['img_file']) }}"
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
                                <td style="width: 4%"> </td>
                                <td style="width: 92%;text-align: center;">
                                    @if(!empty($result['listing_sub_media']))
                                    
                                    <img src="{{ url('storage/images/list/sub_images/'.$result['listing_sub_media'][0]['sub_img_file']) }}"
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
        
        <!-- page 13.6 -->
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
                                @if(!empty($result['listing_sub_media']))
                                @if(count($result['listing_sub_media']) > 0)
                                @foreach($result['listing_sub_media'] as $k=>$v)
                                <td style="padding: 0px 10px;">
                                
                                    <img src="{{ url('storage/images/list/sub_images/'.$v['sub_img_file']) }}"
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
        
        <!-- page 15 -->
        <div id="page15" style="page-break-before: always;">
            <table width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td>
                        <table cellpadding="0" cellspacing="0" width="100%"
                            style="border-collapse: separate; border-spacing: 0px 5px;">
                            <tr>
                                <td colspan="3"
                                    style="font-family: 'Arimo', sans-serif; padding-left: 10px; margin:0; color:#fff; font-size:30px; font-weight:bold; background-color: #333333;height: 60px; vertical-align: middle;">
                                    &nbsp; NEXT STEPS</td>
                            </tr>
                            <tr>
                                <td colspan="3" height="20"></td>
                            </tr>

                            <table cellpadding="0" cellspacing="0" width="100%"
                                style="border-collapse: separate; border-spacing: 0px 20px;">
                                <tr>
                                    <td style="width: 88px; vertical-align: middle">
                                        <img src="{{ public_path('assets/images/print_pdf/step-1pdfs.png') }}"
                                            alt="step" style="max-width: 100px; height: auto; vertical-align: middle" />
                                    </td>
                                    <td style="width: 20px"></td>
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
                                        <img src="{{ public_path('assets/images/print_pdf/step-2pdfs.png') }}"
                                            alt="step" style="max-width: 100px; height: auto; vertical-align: middle" />
                                    </td>
                                    <td style="width: 20px"></td>
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
                                        <img src="{{ public_path('assets/images/print_pdf/step-3pdfs.png') }}"
                                            alt="step" style="max-width: 100px; height: auto; vertical-align: middle" />
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
                                        <img src="{{ public_path('assets/images/print_pdf/step-4pdfs.png') }}"
                                            alt="step" style="max-width: 100px; height: auto; vertical-align: middle" />
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
                                        <img src="{{ public_path('assets/images/print_pdf/step-5pdfs.png') }}"
                                            alt="step" style="max-width: 100px; height: auto; vertical-align: middle" />
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
                                        <img src="{{ public_path('assets/images/print_pdf/step-6pdfs.png') }}"
                                            alt="step" style="max-width: 100px; height: auto; vertical-align: middle" />
                                    </td>
                                    <td style="width: 20px"></td>
                                    <td
                                        style="width: 390px; font-family: 'Arimo', sans-serif; font-size:18px; line-height:26px; color: #000; vertical-align: middle">
                                        Congratulations! You have achieved your goal of restaurant ownership.
                                    </td>
                                </tr>
                            </table>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
        
        <!-- page -->
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
                                        <li
                                            style="font-family: 'Arimo', sans-serif; font-size:16px; line-height:22px; color: #000000">
                                            the overall
                                            location</li>
                                        <li
                                            style="font-family: 'Arimo', sans-serif; font-size:16px; line-height:22px; color: #000000">
                                            the parking
                                            situation</li>
                                        <li
                                            style="font-family: 'Arimo', sans-serif; font-size:16px; line-height:22px; color: #000000">
                                            the signage</li>
                                        <li
                                            style="font-family: 'Arimo', sans-serif; font-size:16px; line-height:22px; color: #000000">
                                            the staff</li>
                                        <li
                                            style="font-family: 'Arimo', sans-serif; font-size:16px; line-height:22px; color: #000000">
                                            the cleanliness
                                        </li>
                                        <li
                                            style="font-family: 'Arimo', sans-serif; font-size:16px; line-height:22px; color: #000000">
                                            the menu</li>
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
                                    next step, the Buyer and Seller
                                    meeting! </td>
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
        
        <!-- page -->
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
                                    Restaurants&reg; brand is unmatched in experience and knowledge. <br /> <br /> Our
                                    website is an invaluable resource where we focus on sharing knowledge, information
                                    and of course, restaurants for sale listings. We train and certify the best in the
                                    industry with the only Certified Restaurant Broker&reg; program in the nation.
                                </td>
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
                                <td style="background-color: #333; padding-top: 0px;">
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
        
        <!-- page -->
        <div id="page17" style="page-break-before: always;">
            <table width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="height: 190px"></td>
                </tr>
                <tr>
                    <td style="text-align:center; vertical-align:middle;">
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
                                            <td align="middle" style="width: 28px;">
                                                <img align="middle"
                                                    src="{{ public_path('assets/images/print_pdf/phone-redi.png') }}"
                                                    alt="phone" style="height: 28px; width: 28px;" />
                                            </td>
                                            <td style="width: 15px;"></td>
                                            <td align="middle"><a href="tel: 404-800-6700"
                                                    style="color: #fff; font-family: 'Arimo', sans-serif; font-size:16px; line-height: 36px; text-decoration: none; display: inline-block; ">404-800-6700</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" style="height: 2px;"></td>
                                        </tr>
                                        <tr>
                                            <td align="middle" style="width: 28px;">
                                                <img align="middle"
                                                    src="{{ public_path('assets/images/print_pdf/globes.png') }}"
                                                    alt="phone" style="height: 28px; width: 28px;" />
                                            </td>
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
        
        <!-- page -->
    </main>
</body>

</html>