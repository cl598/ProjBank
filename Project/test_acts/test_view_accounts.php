<?php require_once(__DIR__ . "/../partials/nav.php"); ?>

<?php
if (!has_role("Admin")) {
    // This will redirect to login and kill the rest of this script (prevent it from executing)
    flash("Sorry, you do not have permission to access this page.");
    die(header("Location:" . getURL("login.php")));
}
?>
<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];
}
?>
<?php
// Fetching
$result = [];
if (isset($id)) {
    $db = getDB();
    $stmt = $db->prepare("SELECT id,name,state,next_stage_time, user_id from Accounts WHERE name like :q LIMIT 10");
    $r = $stmt->execute([":id" => $id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$result) {
        $e = $stmt->errorInfo();
        flash($e[2]);
    }
}
?>
<?php if (isset($result) && !empty($result)): ?>
    <div class="card">
        <div class="card-title">
            <?php safer_echo($result["name"]); ?>
        </div>
        <div class="card-body">
            <div>
                <p>Accounts</p>
                <div>Account number is <?php safer_echo($result["account_number"]); ?></div>
                <div>Account type is <?php getState($result["account_type"]); ?></div>
                <div>Balance is <?php getState($result["balance"]); ?></div>
                <div>Opened date is <?php safer_echo($result["opened_date"]); ?></div>
                <div>Last updated is <?php safer_echo($result["last_updated"]); ?></div>
            </div>
        </div>
    </div>
<?php else: ?>
    <p>An error has occurred upon looking up the id.</p>
<?php endif; ?>
<?php require(__DIR__ . "/../partials/flash.php");