<?php require_once(__DIR__ . "/../partials/nav.php"); ?>

<?php
if (!has_role("Admin")) {
    // This will redirect to login and kill the rest of this script (prevent it from executing)
    // flash("Sorry, you do not have permission to access this page.");
    // die(header("Location:" . getURL("login.php")));
}
?>
<?php
// We'll put this at the top so both php block have access to it
if(isset($_GET["id"])){
    $id = $_GET["id"];
}
?>
<?php
// Saving
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
    $stmt = $db->prepare("INSERT INTO Transactions (name, state, actnum, acttype, bal, next_stage_time, user_id) VALUES(:name, :state, :nst,:user)");
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
            flash("Updated successfully with id: " . $id);
        }
        else{
            $e = $stmt->errorInfo();
            flash("Error updating: " . var_export($e, true));
        }
    }
    else{
        flash("ID isn't set, we need an ID in order to update");
}
?>

<?php
// Fetching
$result = [];
if(isset($id)){
    $id = $_GET["id"];
    $db = getDB();
    $stmt = $db->prepare("SELECT * FROM Accounts where id = :id");
    $r = $stmt->execute([":id"=>$id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

    <form method="POST">
        <label>Name</label>
        <input name="name" placeholder="Name" value="<?php echo $result["name"];?>"/>
        <label>State</label>
        <select name="state" value="<?php echo $result["state"];?>">
            <option value="0" <?php echo ($result["state"] == "0"?'selected="selected"':'');?>>Checking</option>
            <option value="1" <?php echo ($result["state"] == "1"?'selected="selected"':'');?>>Savings</option>
            <option value="2" <?php echo ($result["state"] == "2"?'selected="selected"':'');?>>Loan</option>
        </select>
        <input type="submit" name="save" value="Update"/>
    </form>


<?php require(__DIR__ . "/../partials/flash.php");