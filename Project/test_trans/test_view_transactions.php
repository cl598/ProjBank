<?php require_once(__DIR__ . "/../partials/nav.php"); ?>

<?php
if (!has_role("Admin")) {
    // This will redirect to login and kill the rest of this script (prevent it from executing)
    //flash("Sorry, you do not have permission to access this page.");
    //die(header("Location:" . getURL("login.php")));
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
    $name = $_POST["name"];
    $state = $_POST["state"];
    $actnum = $_POST["account_number"];
    $acttype = $_POST["account_type"];
    $bal = $_POST["balance"];
    $nst = date('Y-m-d H:i:s');
    $user = get_user_id();
    $db = getDB();
    $stmt = $db->prepare("INSERT INTO Accounts (name, actnum, acttype, bal, user_id) VALUES(:name, :state, :nst,:user)");
    $r = $stmt->execute([
            ":id" => $id,
            ":name"=>$name,
            ":state"=>$state,
            ":actnum"=>$actnum,
            ":acttype"=>$acttype,
            ":bal"=>$bal,
            ":nst"=>$nst,
            ":user"=>$user
    ]);
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
                <div>Account type is <?php safer_echo($result["account_type"]); ?></div>
                <div>Balance is <?php safer_echo($result["balance"]); ?></div>
            </div>
        </div>
    </div>
<?php else: ?>
    <p>An error has occurred upon looking up the id.</p>
<?php endif; ?>
<?php require(__DIR__ . "/../partials/flash.php");