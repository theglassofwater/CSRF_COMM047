<?php 

$amount = filter_input(INPUT_POST, 'amount', FILTER_SANITIZE_NUMBER_INT);
$recipient_account = filter_input(INPUT_POST, 'recipient_account', FILTER_SANITIZE_NUMBER_INT);

$inputs['amount'] = $amount;
$inputs['recipient_account'] = $recipient_account;


?>



<header>
    <h1>Fund Transfer</h1>
</header>
<div>
    Thanks for using this service!
</div>

<div>
    You have sent £<?php echo $inputs['amount'] ?> to account:<?php echo $inputs['recipient_account'] ?>
</div>

