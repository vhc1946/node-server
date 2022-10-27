<?php
/*
error_reporting(E_ALL);
ini_set("display_errors","1");

if (!isset($_COOKIE["PHPSESSID"])) {
    $_COOKIE["PHPSESSID"] = '59f7792abb3bf5281c4c351020da51af';
}
*/
session_id($_COOKIE["PHPSESSID"]);
session_start();

$date = new DateTime(date('Y-m-d'));
$date->add(new DateInterval('P1Y'));

$pattern = "/\(([A-Z]+)\)/i";
preg_match_all($pattern, $_SESSION['formTemp-54080'], $matches);
$theState = $matches[1][0];

$AdditionalSystems = '';
$StandardFilters = '';
$HumidifierServicePad = '';
$AdditionalComponent = '';
$SpecialtyFilters = '';
$TimeSaverDeduction = '';
// Additional Systems
if (isset($_SESSION['formTemp-54055'])) {
    $pieces = explode('@', $_SESSION['formTemp-54055']);
    $AdditionalSystems = trim($pieces[0]);
}
// Standard Filters
if (isset($_SESSION['formTemp-54064'])) {
    $pieces = explode('@', $_SESSION['formTemp-54064']);
    $StandardFilters = trim($pieces[0]);
}
// Humidifier Service/Pad
if (isset($_SESSION['formTemp-54066'])) {
    $pieces = explode('@', $_SESSION['formTemp-54066']);
    $HumidifierServicePad = trim($pieces[0]);
}
// Additional Component
if (isset($_SESSION['formTemp-54058'])) {
    $pieces = explode('@', $_SESSION['formTemp-54058']);
    $AdditionalComponent = trim($pieces[0]);
}
// Specialty Filters
if (isset($_SESSION['formTemp-54070'])) {
    $pieces = explode('@', $_SESSION['formTemp-54070']);
    $SpecialtyFilters = trim($pieces[0]);
}
// Time Saver Deduction
if (isset($_SESSION['formTemp-54075'])) {
    $pieces = explode('@', $_SESSION['formTemp-54075']);
    $TimeSaverDeduction = trim($pieces[0]);
}

$ultMonthly = '';
$ultAdditionalSystems = '';
$ultStandardFilters = '';
$ultHumidifierServicePad = '';
$ultAdditionalComponent = '';
$ultSpecialtyFilters = '';
$ultTimeSaverDeduction = '';
$ultAdditionalSystemsChk = '';
$ultStandardFiltersChk = '';
$ultHumidifierServicePadChk = '';
$ultAdditionalComponentChk = '';
$ultSpecialtyFiltersChk = '';
$ultTimeSaverDeductionChk = '';
$ultTotal = '';

$premMonthly = '';
$premAdditionalSystems = '';
$premStandardFilters = '';
$premHumidifierServicePad = '';
$premAdditionalComponent = '';
$premSpecialtyFilters = '';
$premTimeSaverDeduction = '';
$premAdditionalSystemsChk = '';
$premStandardFiltersChk = '';
$premHumidifierServicePadChk = '';
$premAdditionalComponentChk = '';
$premSpecialtyFiltersChk = '';
$premTimeSaverDeductionChk = '';
$premTotal = '';

$clasMonthly = '';
$clasAdditionalSystems = '';
$clasStandardFilters = '';
$clasHumidifierServicePad = '';
$clasAdditionalComponent = '';
$clasSpecialtyFilters = '';
$clasTimeSaverDeduction = '';
$clasAdditionalSystemsChk = '';
$clasStandardFiltersChk = '';
$clasHumidifierServicePadChk = '';
$clasAdditionalComponentChk = '';
$clasSpecialtyFiltersChk = '';
$clasTimeSaverDeductionChk = '';
$clasTotal = '';

if (strpos($_SESSION['formTemp-54231'], 'Ultimate') !== false) {
    $ultMonthly = '<div class="checkbox">☑</div>';
    if ($AdditionalSystems != '') {
        $ultAdditionalSystems = '<div class="table-numbers">'.$AdditionalSystems.'</div>';
        $ultAdditionalSystemsChk = $ultMonthly;
    }
    if ($StandardFilters != '') {
        $ultStandardFilters = '<div class="table-numbers">'.$StandardFilters.'</div>';
        $ultStandardFiltersChk = $ultMonthly;
    }
    if ($HumidifierServicePad != '') {
        $ultHumidifierServicePad = '<div class="table-numbers">'.$HumidifierServicePad.'</div>';
        $ultHumidifierServicePadChk = $ultMonthly;
    }
    if ($AdditionalComponent != '') {
        $ultAdditionalComponent = '<div class="table-numbers">'.$AdditionalComponent.'</div>';
        $ultAdditionalComponentChk = $ultMonthly;
    }
    if ($SpecialtyFilters != '') {
        $ultSpecialtyFilters = '<div class="table-numbers">'.$SpecialtyFilters.'</div>';
        $ultSpecialtyFiltersChk = $ultMonthly;
    }
    if ($TimeSaverDeduction != '') {
        $ultTimeSaverDeduction = '<div class="table-numbers">'.$TimeSaverDeduction.'</div>';
        $ultTimeSaverDeductionChk = $ultMonthly;
    }
    $ultTotal = $_SESSION['formTemp-amount'];
} else if (strpos($_SESSION['formTemp-54231'], 'Premium') !== false) {
    $premMonthly = '<div class="checkbox">☑</div>';
    if ($AdditionalSystems != '') {
        $premAdditionalSystems = '<div class="table-numbers">'.$AdditionalSystems.'</div>';
        $premAdditionalSystemsChk = $premMonthly;
    }
    if ($StandardFilters != '') {
        $premStandardFilters = '<div class="table-numbers">'.$StandardFilters.'</div>';
        $premStandardFiltersChk = $premMonthly;
    }
    if ($HumidifierServicePad != '') {
        $premHumidifierServicePad = '<div class="table-numbers">'.$HumidifierServicePad.'</div>';
        $premHumidifierServicePadChk = $premMonthly;
    }
    if ($AdditionalComponent != '') {
        $premAdditionalComponent = '<div class="table-numbers">'.$AdditionalComponent.'</div>';
        $premAdditionalComponentChk = $premMonthly;
    }
    if ($SpecialtyFilters != '') {
        $premSpecialtyFilters = '<div class="table-numbers">'.$SpecialtyFilters.'</div>';
        $premSpecialtyFiltersChk = $premMonthly;
    }
    if ($TimeSaverDeduction != '') {
        $premTimeSaverDeduction = '<div class="table-numbers">'.$TimeSaverDeduction.'</div>';
        $premTimeSaverDeductionChk = $premMonthly;
    }
    $premTotal = $_SESSION['formTemp-amount'];
} else if (strpos($_SESSION['formTemp-54231'], 'Classic') !== false) {
    $clasMonthly = '<div class="checkbox">☑</div>';
    if ($AdditionalSystems != '') {
        $clasAdditionalSystems = '<div class="table-numbers">'.$AdditionalSystems.'</div>';
        $clasAdditionalSystemsChk = $clasMonthly;
    }
    if ($StandardFilters != '') {
        $clasStandardFilters = '<div class="table-numbers">'.$StandardFilters.'</div>';
        $clasStandardFiltersChk = $clasMonthly;
    }
    if ($HumidifierServicePad != '') {
        $clasHumidifierServicePad = '<div class="table-numbers">'.$HumidifierServicePad.'</div>';
        $clasHumidifierServicePadChk = $clasMonthly;
    }
    if ($AdditionalComponent != '') {
        $clasAdditionalComponent = '<div class="table-numbers">'.$AdditionalComponent.'</div>';
        $clasAdditionalComponentChk = $clasMonthly;
    }
    if ($SpecialtyFilters != '') {
        $clasSpecialtyFilters = '<div class="table-numbers">'.$SpecialtyFilters.'</div>';
        $clasSpecialtyFiltersChk = $clasMonthly;
    }
    if ($TimeSaverDeduction != '') {
        $clasTimeSaverDeduction = '<div class="table-numbers">'.$TimeSaverDeduction.'</div>';
        $clasTimeSaverDeductionChk = $clasMonthly;
    }
    $clasTotal = $_SESSION['formTemp-amount'];
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link href="https://fonts.googleapis.com/css?family=Cairo:400,600,700,900" rel="stylesheet">
<style>
    *, *::before, *::after {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
    body {
        margin: 0;
        padding: 40px;
        font-family: "Cairo", sans-serif;
        font-weight: 400;
        font-size: 1rem;
        color: #000000;
    }
    h1 {
        color: #cf152d;
        font-size: 2.4rem;
        font-weight: bold;
    }
    .row1-block {
        border: 3px solid #1b6a9f;
        width: 290px;
        float: left;
        margin-right: 25px;
        margin-top: 20px;
    }
    .block-title {
        background-color: #1b6a9f;
        height: 60px;
        text-align: center;
        vertical-align: middle;
        color: #ffffff;
        font-size: 1.4rem;
        font-weight: 900;
        padding-top: 6px;
    }
    table {
        margin: 4px;
    }
    .checkbox {
        font-size: 1.5rem;
        line-height: 0;
    }
    .no-checkbox {
        border: 1px solid #000000;
        width: 1rem;
        height: 1rem;
        text-align: center;
        margin: 0px 4px;
    }
    .table-numbers {
        text-align: center;
        border-bottom: 1px solid #000000;
    }
</style>
</head>
<body>
    <?php /*
    <div class="no-checkbox">&nbsp;</div>
    <div class="checkbox">☑</div>
    */?>
    <img src="https://www.vogelheating.com/images/logo-pdf.png" style="width: 270px; float: right;" />
    <h1>Rewards Membership Agreement</h1>

    <div class="row1-block" style="clear: both;">
        <div class="block-title">Ultimate</div>
        <table border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td style="width: 180px;">Monthly Plan</td>
                <td style="width: 40px;">&nbsp;</td>
                <td>$44</td>
                <td><?php echo $ultMonthly; ?></td>
            </tr>
            <tr>
                <td>Additional System</td>
                <td><?php echo $ultAdditionalSystems; ?></td>
                <td>$37</td>
                <td><?php echo $ultAdditionalSystemsChk; ?></td>
            </tr>
            <tr>
                <td>Additional Component</td>
                <td><?php echo $ultAdditionalComponent; ?></td>
                <td>$12</td>
                <td><?php echo $ultAdditionalComponentChk; ?></td>
            </tr>
            <tr>
                <td colspan="4"><strong>Enhancements</strong></td>
            </tr>
            <tr>
                <td>Standard Filters</td>
                <td><?php echo $ultStandardFilters; ?></td>
                <td>$0</td>
                <td><?php echo $ultStandardFiltersChk; ?></td>
            </tr>
            <tr>
                <td>Humidifier Service/Pad</td>
                <td><?php echo $ultHumidifierServicePad; ?></td>
                <td>$0</td>
                <td><?php echo $ultHumidifierServicePadChk; ?></td>
            </tr>
            <tr>
                <td>Specialty Filters</td>
                <td><?php echo $ultSpecialtyFilters; ?></td>
                <td>$7</td>
                <td><?php echo $ultSpecialtyFiltersChk; ?></td>
            </tr>
            <tr>
                <td>Time Saver Deduction</td>
                <td><?php echo $ultTimeSaverDeduction; ?></td>
                <td>-$4</td>
                <td><?php echo $ultTimeSaverDeductionChk; ?></td>
            </tr>
            <tr>
                <td>Total</td>
                <td></td>
                <td colspan="2">$<?php echo $ultTotal; ?></td>
            </tr>
        </table>
    </div>
    <div class="row1-block">
        <div class="block-title">Premium</div>
        <table border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td style="width: 180px;">Monthly Plan</td>
                <td style="width: 40px;">&nbsp;</td>
                <td>$33</td>
                <td><?php echo $premMonthly; ?></td>
            </tr>
            <tr>
                <td>Additional System</td>
                <td><?php echo $premAdditionalSystems; ?></td>
                <td>$29</td>
                <td><?php echo $premAdditionalSystemsChk; ?></td>
            </tr>
            <tr>
                <td>Additional Component</td>
                <td><?php echo $premAdditionalComponent; ?></td>
                <td>$12</td>
                <td><?php echo $premAdditionalComponentChk; ?></td>
            </tr>
            <tr>
                <td colspan="4"><strong>Enhancements</strong></td>
            </tr>
            <tr>
                <td>Standard Filters</td>
                <td><?php echo $premStandardFilters; ?></td>
                <td>$0</td>
                <td><?php echo $premStandardFiltersChk; ?></td>
            </tr>
            <tr>
                <td>Humidifier Service/Pad</td>
                <td><?php echo $premHumidifierServicePad; ?></td>
                <td>$0</td>
                <td><?php echo $premHumidifierServicePadChk; ?></td>
            </tr>
            <tr>
                <td>Specialty Filters</td>
                <td><?php echo $premSpecialtyFilters; ?></td>
                <td>$7</td>
                <td><?php echo $premSpecialtyFiltersChk; ?></td>
            </tr>
            <tr>
                <td>Time Saver Deduction</td>
                <td><?php echo $premTimeSaverDeduction; ?></td>
                <td>-$4</td>
                <td><?php echo $premTimeSaverDeductionChk; ?></td>
            </tr>
            <tr>
                <td>Total</td>
                <td></td>
                <td colspan="2">$<?php echo $premTotal; ?></td>
            </tr>
        </table>
    </div>
    <div class="row1-block" style="margin-right: 0;">
        <div class="block-title">Classic</div>
        <table border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td style="width: 180px;">Monthly Plan</td>
                <td style="width: 40px;">&nbsp;</td>
                <td>$24</td>
                <td><?php echo $clasMonthly; ?></td>
            </tr>
            <tr>
                <td>Additional System</td>
                <td><?php echo $clasAdditionalSystems; ?></td>
                <td>$21</td>
                <td><?php echo $clasAdditionalSystemsChk; ?></td>
            </tr>
            <tr>
                <td>Additional Component</td>
                <td><?php echo $clasAdditionalComponent; ?></td>
                <td>$12</td>
                <td><?php echo $clasAdditionalComponentChk; ?></td>
            </tr>
            <tr>
                <td colspan="4"><strong>Enhancements</strong></td>
            </tr>
            <tr>
                <td>Standard Filters</td>
                <td><?php echo $clasStandardFilters; ?></td>
                <td>$5</td>
                <td><?php echo $clasStandardFiltersChk; ?></td>
            </tr>
            <tr>
                <td>Humidifier Service/Pad</td>
                <td><?php echo $clasHumidifierServicePad; ?></td>
                <td>$5</td>
                <td><?php echo $clasHumidifierServicePadChk; ?></td>
            </tr>
            <tr>
                <td>Specialty Filters</td>
                <td><?php echo $clasSpecialtyFilters; ?></td>
                <td>$12</td>
                <td><?php echo $clasSpecialtyFiltersChk; ?></td>
            </tr>
            <tr>
                <td>Time Saver Deduction</td>
                <td><?php echo $clasTimeSaverDeduction; ?></td>
                <td>-$4</td>
                <td><?php echo $clasTimeSaverDeductionChk; ?></td>
            </tr>
            <tr>
                <td>Total</td>
                <td></td>
                <td colspan="2">$<?php echo $clasTotal; ?></td>
            </tr>
        </table>
    </div>

    <div style="clear: both;">&nbsp;</div>

    <div class="block-title" style="width: 270px;">
        Other
    </div>
    <div style="clear: both; border: 3px solid #1b6a9f; width: 920px;">
        <table border="0" cellpadding="0" cellspacing="0" style="width: 99%;">
            <tr>
                <td style="border-bottom: 1px solid #000000;">&nbsp;</td>
            </tr>
            <tr>
                <td style="border-bottom: 1px solid #000000;">&nbsp;</td>
            </tr>
            <tr>
                <td style="border-bottom: 1px solid #000000;">&nbsp;</td>
            </tr>
        </table>
    </div>

    <div style="float: left; margin-right: 25px; width: 420px;">
        <div class="block-title" style="width: 270px; margin-top: 20px;">
            Billing
        </div>
        <div style="clear: both; border: 3px solid #1b6a9f; padding: 4px;">
            Payment: $<?php echo $_SESSION['formTemp-amount']; ?><br />
            <span class="checkbox">☑</span> Monthly<br />
            Agreement Start Date: <?php echo date("n/j/Y"); ?><br />
            Agreement Renewal Date: <?php echo $date->format('n/j/Y'); ?><br />
            Credit Card: XXXX<?php echo $_SESSION['formTemp-lastFour']; ?><br />
            Exp Date: <?php echo $_SESSION['formTemp-expDate']; ?><br />
            Type: <?php echo $_SESSION['formTemp-accountType']; ?><br />
        </div>
    </div>

    <div style="float: left; width: 420px;">
        <div class="block-title" style="width: 270px; margin-top: 20px;">
            Member
        </div>
        <div style="clear: both; border: 3px solid #1b6a9f; padding: 4px;">
            Name: <span style="border-bottom: 1px solid #000000; width: 350px; display: inline-block;"><?php echo $_SESSION['formTemp-54077'];?></span><br />
            Address: <span style="border-bottom: 1px solid #000000; width: 335px; display: inline-block;"><?php echo $_SESSION['formTemp-54078'];?></span><br />
            City: <span style="border-bottom: 1px solid #000000; width: 176px; display: inline-block;"><?php echo $_SESSION['formTemp-54079'];?></span> State: <span style="border-bottom: 1px solid #000000; width: 50px; display: inline-block;"><?php echo $theState;?></span> Zip: <span style="border-bottom: 1px solid #000000; width: 60px; display: inline-block;"><?php echo $_SESSION['formTemp-54081'];?></span><br />
            Phone: <span style="border-bottom: 1px solid #000000; width: 346px; display: inline-block;"><?php echo $_SESSION['formTemp-54082'];?></span><br />
            Email: <span style="border-bottom: 1px solid #000000; width: 353px; display: inline-block;"><?php echo $_SESSION['formTemp-54083'];?></span>
        </div>
        I agree to the terms and conditions on the following pages
    </div>

    <div style="clear: both;">&nbsp;</div>

    <div style="page-break-before: always; padding-top: 50px;">
        <h2 style="text-align: center;">Terms and Conditions</h2>
<p><span style="font-size: 18px;"><strong>Term</strong></span><br />The term of this auto renewing agreement is 12 months. Agreements and terms self-renew annually. Vogel Heating and Cooling reserves the right to change any of the terms and features of future agreement offers (at time of renewal only).<br />Written notice of any changes shall be provided to customer 60 days prior to renewal date.</p>
<p><span style="font-size: 18px;"><strong>Billing</strong></span><br />Agreement will be billed monthly in twelve (12) equal installments. Payment method listed on the account will be charged on the 15th of each month for our services. Member must provide payment information at the time of acceptance of this agreement. Each agreement is subject to an annual increase not to exceed 5% without written notice. Anything exceeding 5% requires 60 days advance notice.</p>
<p><span style="font-size: 18px;"><strong>Cancellation</strong></span><br />Agreement can be cancelled by either party provided the cancelling party provide written notice to the other party 30 days or more prior to the renewal date of this agreement. In the case of early cancellation, the member is financially responsible for services received in excess of payments made. Likewise, if upon cancellation the payments made exceed services rendered, Vogel will be responsible to refund to the member any payments received in excess of services rendered.</p>
<p><span style="font-size: 18px;"><strong>Hours of Service</strong></span><br />The services covered by this agreement will be scheduled during regular work hours, 8 AM to 4:30 PM, Monday through Friday, except holidays. After hours or weekend scheduling is available for an additional charge.</p>
<p>In the case of boiler systems, bleeding radiators, water treatment, and filling of hot water systems shall be treated as repair work, and is not included in seasonal maintenance. System Performance enhancement will be done during regular working hours.</p>
<p><span style="font-size: 18px;"><strong>Wi-Fi Thermostat</strong></span><br />Includes Wi-Fi control and installation which is a $595 value. This control is the property of Vogel Heating and Cooling.</p>
<p>Ownership of the Wi-Fi control is transferred to members who maintain their Ultimate Membership for a period of five (5) years. Members who cancel Ultimate Membership prior to five year period must allow Vogel Heating and Cooling to remove Wi-Fi control from their residence. Members who do not allow access to home for removal of control will be responsible for the installed cost of the control. Damaged controls will be the responsibility of the member.</p>
    </div>
    <div style="page-break-before: always; padding-top: 50px;">
<p><span style="font-size: 18px;"><strong>Equipment Accrual</strong></span><br />Equipment Accrual is a true discount off of our fully discounted standard book price for replacement systems. This accrual can be utilized at a new residence in the case a Plan Member moves from the contract location. Equipment Accrual has no cash value. Maximum allowable accrual account is $900 per matched full system and $400 per single Cooling System or Heating System. Accruals are earned per agreement per year. For example, a member with two agreements would earn 2 accruals per year (1 for each qualifying agreement).<br />Filters<br />Premium and Ultimate Members receive one of the following per contract year for your equipment:<br />(1) 12 x 1&rdquo; Inch Filters, 6 x 2&rdquo; Filters or 2 x 4&rdquo; Inch Filters (does not include specialty filters)<br />(2) Filters not listed are considered specialty filters.<br />(3) Specialty Filters are not included in the plans are an additional cost.</p>
<p>These are defined as: (2) Infinity/Performance Air Purifier Filters and Aprilaire/Air Bear MERV 10/11 Filters and higher ratings. Classic Plan Members can add filters for $5 / mo. to their plan(s) for an annual supply of filters. If they have specialty filters add the additional $7/mo. for specialty filters for a total of $12/ mo. subscription. These annual filter benefits are not transferrable and have no cash value.</p>
<p><span style="font-size: 18px;"><strong>Humidifiers</strong></span><br />For proper operations Humidifiers require annual maintenance that include clearing the drain, changing the media/pad, cleaning orifices, and checking operation of solenoids and humidistats. Members that have humidifier coverage will receive one (1) pad each fall per humidifier on the plan. Humidifiers covered include: by-pass &amp; power Humidifiers made by Honeywell, Aprilaire, Generalaire, and Carrier. Steam Humidifiers are an additional cost and can be paid for at the time of service.</p>
<p><span style="font-size: 18px;"><strong>Plan Level Discount Tiers</strong></span><br />Plan Level Discounts are available to existing plan members only and may be extended to new clients signing up for the plan upon payment of your first monthly membership payment or annual membership. This is at the discretion of the company. Plan Member Discount Tiers are below:</p>
<p>Ultimate Plan Members receive a 15% Discount on all repairs at the time of service. This discount can also apply to system upgrades.</p>
<p>Premium Plan &amp; Classic Plan Members receive a 10% Discount on all repairs at the time of service. This discount can also apply to system upgrades.<br />Discounts toward System Upgrades cannot be combined with Seasonal Promotions but the client is entitled to the &ldquo;Best Current&rdquo; offer for season promotions.</p>
<p><span style="font-size: 18px;"><strong>Seasonal Availability &amp; During Regular Hours of Operation</strong></span><br />Seasonal Combination Clean &amp; Checks are not available during peak seasons defined as June &ndash; July and when outdoor temperatures are not conducive to proper outdoor clean &amp; checks. Your technician will make you aware of the availability of this promotion.</p>
    </div>
</body>
</html>
