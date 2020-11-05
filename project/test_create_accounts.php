
<?php require_once(__DIR__ . "/partials/nav.php"); ?>
<?php
if (!has_role("Admin")) {
  
    //this will redirect to login and kill the rest of this script (prevent it from executing)
    flash("You don't have permission to access this page");
    die(header("Location: login.php"));
}
?>

<form method="POST">
	<label>Name</label>
	<input name="name" placeholder="Name"/>
  
	<label>Account Number</label>
  <input type="number" min="0" name="account_number"/>

	<label>User</label>
	<input type="number" min="0" name="user_id"/>
  
	<label>Account Type</label>
	<input type="number" min="0" name="account_type"/>
  
	<label>Balance</label>
	<input type="number" min="0" name="balance"/>
  
	<input type="submit" name="save" value="Create"/>
</form>

<?php

if(isset($_POST["save"])){
	//TODO add proper validation/checks
	$name = $_POST["name"];
	$acctnum = $_POST["account_number"];
	$accttype = $_POST["account_type"];
	$bal = $_POST["balance"];
	$user = get_user_id();
	$db = getDB();
	$stmt = $db->prepare("INSERT INTO Accounts (id, account_number, user_id, account_type, opened_date, last_updated, balance)");
	$r = $stmt->execute([
		":name"=>$name,
		":acctnum"=>$acctnum,
		":accttype"=>$accttype,
		":bal"=>$bal,
		":user"=>$user
	]);
	if($r){
		flash("Created successfully with id: " . $db->lastInsertId());
	}
	else{
		$e = $stmt->errorInfo();
		flash("Error creating: " . var_export($e, true));
	}
}
?>
<?php require(__DIR__ . "/partials/flash.php");
