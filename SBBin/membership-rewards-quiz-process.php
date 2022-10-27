<?php
//print '<xmp>'; print_r($_REQUEST); exit;
/*
$_REQUEST['53290'] = 'No, help me please.';
$_REQUEST['53294'] = 'Not sure.';
$_REQUEST['53295'] = 'Hope to get a few more years.';
$_REQUEST['53298'] = 'Less than 3 Years';
$_REQUEST['53296'] = 'No';
$_REQUEST['53297'] = 'Now. Seriously. I am uncomfortable.';
*/

$firstChoice['Classic'] = 0;
$firstChoice['Premium'] = 0;
$firstChoice['Ultimate'] = 0;

$secondChoice['Classic'] = 0;
$secondChoice['Premium'] = 0;
$secondChoice['Ultimate'] = 0;

// Do you like to change your own filters?
switch ($_REQUEST['53290']) {
    case 'Yes, like clockwork.':
        $firstChoice['Classic']++;
        $secondChoice['Premium']++;
        break;
    case 'I do it, but don\'t like to.':
        $firstChoice['Premium']++;
        $secondChoice['Ultimate']++;
        break;
    case 'No, help me please.':
        $firstChoice['Premium']++;
        $secondChoice['Ultimate']++;
        break;
}
// Does your System have a humidifier?
switch ($_REQUEST['53294']) {
    case 'Yes, and I love it.':
        $firstChoice['Premium']++;
        $secondChoice['Ultimate']++;
        break;
    case 'No, not yet.':
        $firstChoice['Classic']++;
        $secondChoice['Premium']++;
        break;
    case 'Not sure.':
        $firstChoice['Classic']++;
        break;
}

// 	On a Scale of 1 to 5 what condition is your system in?
switch ($_REQUEST['53295']) {
    case 'Best days are behind.':
        $firstChoice['Classic']++;
        $secondChoice['Premium']++;
        break;
    case 'Hope to get a few more years.':
        $firstChoice['Classic']++;
        $secondChoice['Premium']++;
        break;
    case 'Still Running Steady.':
        $firstChoice['Premium']++;
        $secondChoice['Ultimate']++;
        break;
    case 'Only a couple years old.':
        $firstChoice['Premium']++;
        $secondChoice['Ultimate']++;
        break;
    case 'Brand new, excellent condition.':
        $firstChoice['Premium']++;
        break;
}

// What type of coverage do you like on new appliances?
switch ($_REQUEST['53298']) {
    case 'Lifetime':
        $firstChoice['Ultimate']++;
        break;
    case '3-5 Years':
        $firstChoice['Premium']++;
        break;
    case 'Less than 3 Years':
        $firstChoice['Classic']++;
        break;
}

// Do you have allergy or dust concerns you would like addressed?
switch ($_REQUEST['53296']) {
    case 'Yes':
        $firstChoice['Premium']++;
        $secondChoice['Ultimate']++;
        break;
    case 'No':
        $firstChoice['Classic']++;
        break;
}

// If your system fails, how soon do you want us there?
switch ($_REQUEST['53297']) {
    case 'Sometime in the next 24 hours.':
        $firstChoice['Premium']++;
        break;
    case 'Now. Seriously. I am uncomfortable.':
        $firstChoice['Ultimate']++;
        break;
    case 'Uncomfortable, but can wait a day or two.':
        $firstChoice['Premium']++;
        $secondChoice['Classic']++;
        break;
}

arsort($firstChoice);
arsort($secondChoice);

$firstChoiceKeys = array_keys($firstChoice);

if ($firstChoice[$firstChoiceKeys[0]] == $firstChoice[$firstChoiceKeys[1]] && $firstChoice[$firstChoiceKeys[0]] == $firstChoice[$firstChoiceKeys[2]]) {
    // all 3 match, Ultimate wins
    $firstChoiceWinner = 'Ultimate';
} else if ($firstChoice[$firstChoiceKeys[0]] == $firstChoice[$firstChoiceKeys[1]]) {
    // first 2 match, find higher plan
    for ($x = 0; $x <= 2; $x++) {
        if ($firstChoiceKeys[0] == 'Ultimate' || $firstChoiceKeys[1] == 'Ultimate') {
            $firstChoiceWinner = 'Ultimate';
        } else if ($firstChoiceKeys[0] == 'Premium' || $firstChoiceKeys[1] == 'Premium') {
            $firstChoiceWinner = 'Premium';
        } else {
            $firstChoiceWinner = 'Classic';
        }
    }
} else {
    $firstChoiceWinner = $firstChoiceKeys[0];
}

$secondChoiceWinner = '';
while($secondChoiceWinner == '') {
    $secondChoiceKeys = array_keys($secondChoice);

    if ($secondChoice[$secondChoiceKeys[0]] == $secondChoice[$secondChoiceKeys[1]] && $secondChoice[$secondChoiceKeys[0]] == $secondChoice[$secondChoiceKeys[2]]) {
        // all 3 match, Ultimate wins
        $secondChoicePossibleWinner = 'Ultimate';
    } else if ($secondChoice[$secondChoiceKeys[0]] == $secondChoice[$secondChoiceKeys[1]]) {
        // first 2 match, find higher plan
        for ($x = 0; $x <= 2; $x++) {
            if ($secondChoiceKeys[0] == 'Ultimate' || $secondChoiceKeys[1] == 'Ultimate') {
                $secondChoicePossibleWinner = 'Ultimate';
            } else if ($secondChoiceKeys[0] == 'Premium' || $secondChoiceKeys[1] == 'Premium') {
                $secondChoicePossibleWinner = 'Premium';
            } else {
                $secondChoicePossibleWinner = 'Classic';
            }
        }
    } else {
        $secondChoicePossibleWinner = $secondChoiceKeys[0];
    }
    if ($secondChoicePossibleWinner != $firstChoiceWinner) {
        $secondChoiceWinner = $secondChoicePossibleWinner;
    } else {
        unset($secondChoice[$secondChoicePossibleWinner]);
    }
}

switch ($firstChoiceWinner) {
    case 'Ultimate':
        $price = '44';
        $text = 'has everything to offer will little to sacrifice. Never pay a diagnostics charge and earn $50 a year in loyalty dollars.';
        $color = '1D679B';
        break;
    case 'Premium':
        $price = '33';
        $text = 'is the perfect combination of both worlds with extra savings and warranty protection. This is the most popular plan.';
        $color = 'CF152D';
        break;
    case 'Classic':
        $price = '24';
        $text = 'is a valuable investment without breaking the bank. Clean, Save and Protect is the best way to extend the life of your HVAC system.';
        $color = '2889C4';
        break;
}

//print $firstChoiceWinner." | ".$secondChoiceWinner; print '<xmp>'; print_r($firstChoiceKeys); print_r($firstChoice); print_r($secondChoice); print '</xmp>';

ob_start();
?>
<h3 class="color-secondary weight-600 text-center">Congrats! Here are your results:</h3>
<section class="quiz-results">
    <div class="quiz-results-head" style="background-color: #<?php echo $color; ?>;">
        <div class="row align-middle">
            <div class="columns small-6">
                <?php //<a class="quiz-results-head-link" data-open="quiz-modal">More Details</a> ?>
            </div>
            <div class="columns small-6">
                <h4 class="quiz-results-head-title"><?php echo $firstChoiceWinner; ?> Membership</h4>
            </div>
        </div><!-- end .row.align-middle -->
    </div><!-- end .quiz-results-head -->
    <div class="quiz-results-body">
        <div class="row">
            <div class="columns small-12 medium-6">
                <img class="quiz-results-img" src="/images/img-membership-quiz-results-<?php echo strtolower($firstChoiceWinner); ?>-<?php echo strtolower($secondChoiceWinner); ?>.png" alt="" />
                <?php if (intval($_REQUEST['53316']) > 1) { ?>
                <img class="quiz-results-discount-img" src="/images/img-membership-quiz-results-discount.png" alt="" />
                <span class="quiz-results-discount-text">You qualify<br />for an<br />additional<br />system<br />discount!</span>
                <?php } ?>
            </div>
            <div class="columns small-12 medium-6">
                <h4 class="quiz-results-content-title"><sup>$</sup><?php echo $price; ?><small>/mo</small></h4>
                <p class="quiz-results-content-text">The <strong><?php echo $firstChoiceWinner; ?> Membership</strong> <?php echo $text; ?> <strong>Price is per system.</strong></p>
                <p class="quiz-results-content-text"><a class="btn" href="rewards-subscription.html?s=<?php echo $price; ?>" title="Subscribe Now">Subscribe Now</a></p>
            </div>
        </div><!-- end .row.align-middle -->
    </div><!-- end .quiz-results-body -->
    <div class="quiz-results-foot">
        <div class="row">
            <div class="columns small-12">
                <p class="quiz-results-foot-text"><strong>Secondary Recommendation:</strong> <?php echo $secondChoiceWinner; ?></p>
            </div>
        </div><!-- end .row -->
        <div class="row">
            <div class="columns small-12">
                <p style="font-size: .75rem; line-height: .94rem;">* Price modifications may occur based on customized plan needs. All clients are entitled to best pricing based on the number of systems.</p>
            </div>
        </div>
    </div><!-- end .quiz-results-foot -->
</section><!-- end .quiz-results -->
<?php /*
<div class="reveal quiz-modal" id="quiz-modal" data-reveal>
    <h4 class="quiz-modal-title">Premium Details</h4>
    <p class="quiz-modal-text">The Premium Membership is the perfect combination of both worlds with extra savings and warranty protection. This is the most popular plan.</p>
    <p class="quiz-modal-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    <p class="quiz-modal-text">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore. Lorem ipsum dolor sit amet, consectetur adipiscing elit,</p>
    <button class="close-button quiz-modal-btn" data-close aria-label="Close modal" type="button"><span aria-hidden="true">&times;</span></button>
</div>
*/ ?>
<p class="text-center"><a class="btn btn-secondary width100" style="max-width:310px;" href="rewards-membership.html" title="View All Plans">View All Plans</a></p>
<?php
$_SESSION['formThankYou'] = ob_get_clean();
?>
