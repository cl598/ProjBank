<link rel="stylesheet" href="../static/css/styles.css">

<?php
// We'll be including this on most/all pages so it's a good place to include anything else we want on those pages
require_once(__DIR__ . "/../lib/helpers.php");
?>

<nav>
    <ul class="nav">

        <li><a href="../home.php">Home</a></li>
        <?php if (!is_logged_in()): ?>
            <li><a href="../login.php">Login</a></li>
            <li><a href="../register.php">Register</a></li>
            <li><a href="#">Create Account</a></li>
            <li><a href="#">Accounts</a></li>
            <li><a href="#">Deposit</a></li>
            <li><a href="#">Withdraw</a></li>
            <li><a href="#">Transfer</a></li>

        <?php endif; ?>

        <?php if (has_role("Admin")): ?>
            <li><a href="../test_acts/test_create_accounts.php">Create an account</a></li>
            <li><a href="../test_acts/test_view_accounts.php">View accounts</a></li>
            <li><a href="../test_trans/test_create_transactions.php">Create a transaction</a></li>
            <li><a href="../test_trans/test_list_transactions.php">View transactions</a></li>
        <?php endif; ?>

        <?php if (is_logged_in()): ?>
            <li><a href="../profile.php">Profile</a></li>
            <li><a href="../logout.php">Logout</a></li>
        <?php endif; ?>

    </ul>
</nav>