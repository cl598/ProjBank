<?php require_once(__DIR__ . "/../partials/nav.php"); ?>

<?php
if (!has_role("Admin")) {
    // This will redirect to login and kill the rest of this script (prevent it from executing)
    //flash("Sorry, you do not have permission to access this page.");
    //die(header("Location:" . getURL("login.php")));
}
?>

    <form method="POST">
        <label>Name</label>
        <input name="name" placeholder="Name"/>

        <label>Types</label>
        <select name="state">
            <option value="0">Checking</option>
            <option value="1">Savings</option>
            <option value="2">Loans</option>
        </select>
        <input type="submit" name="save" value="Create"/>
    </form>

<?php
if(isset($_POST["save"])){

    //TODO add proper validation/checks
    $name = $_POST["name"];
    $state = $_POST["state"];
    $actnum = $_POST["account_number"];
    $acttype = $_POST["account_type"];
    $bal = $_POST["balance"];
    $nst = date('Y-m-d H:i:s');
    $user = get_user_id();
    $db = getDB();
    $stmt = $db->prepare("INSERT INTO Accounts (name, state, actnum, acttype, bal, next_stage_time, user_id) VALUES(:name, :state, :nst,:user)");
    $r = $stmt->execute([
        ":name"=>$name,
        ":state"=>$state,
        ":actnum"=>$actnum,
        ":acttype"=>$acttype,
        ":bal"=>$bal,
        ":nst"=>$nst,
        ":user"=>$user
    ]);
    if($r){
        flash("Created successfully with id ... " . $db->lastInsertId());
    }
    else{
        $e = $stmt->errorInfo();
        flash("Following error has occurred ... " . var_export($e, true));
    }
}
?>
<?php require(__DIR__ . "/../partials/flash.php");