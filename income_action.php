<?php
include_once 'config/Database.php';
include_once 'class/Income.php';

$database = new Database();
$db = $database->getConnection();

$income = new Income($db);

// ✅ Log that the script is running
error_log("✅ income_action.php executed!");

// ✅ Handle listing income records
if (!empty($_POST['action']) && $_POST['action'] == 'listIncome') {
    $income->listIncome();
}

// ✅ Handle getting income details
if (!empty($_POST['action']) && $_POST['action'] == 'getIncomeDetails') {
    $income->id = $_POST["id"]; // Fix incorrect property
    $income->getIncomeDetails();
}

// ✅ Handle adding income
if (!empty($_POST['action']) && $_POST['action'] == 'addIncome') {
    error_log("✅ addIncome action triggered!");

    // Check if required fields exist, otherwise set defaults
    $income->income_category = $_POST["income_cat"] ?? 'Missing';
    $income->amount = $_POST["amount"] ?? 'Missing';
    $income->income_date = $_POST["income_date"] ?? date("Y-m-d"); // Default to today
    $income->user_id = $_SESSION['user_id'] ?? 1; // Default to user ID 1 if missing

    error_log("✅ Income Details: Cat={$income->income_category}, Amount={$income->amount}, Date={$income->income_date}, User={$income->user_id}");

    // Insert into the database
    if ($income->insert()) {
        error_log("✅ Income inserted successfully!");
        echo json_encode(["status" => "success", "message" => "Income added successfully"]);
    } else {
        error_log("❌ Income insert failed.");
        echo json_encode(["status" => "error", "message" => "Failed to add income"]);
    }
}

// ✅ Handle updating income
if (!empty($_POST['action']) && $_POST['action'] == 'updateIncome') {
    $income->id = $_POST["id"];
    $income->income_category = $_POST["income_cat"];
    $income->amount = $_POST["amount"];
    $income->income_date = $_POST["income_date"];

    if ($income->update()) {
        error_log("✅ Income updated successfully!");
        echo json_encode(["status" => "success", "message" => "Income updated successfully"]);
    } else {
        error_log("❌ Income update failed.");
        echo json_encode(["status" => "error", "message" => "Failed to update income"]);
    }
}

// ✅ Handle deleting income
if (!empty($_POST['action']) && $_POST['action'] == 'deleteIncome') {
    $income->id = $_POST["id"];

    if ($income->delete()) {
        error_log("✅ Income deleted successfully!");
        echo json_encode(["status" => "success", "message" => "Income deleted successfully"]);
    } else {
        error_log("❌ Income delete failed.");
        echo json_encode(["status" => "error", "message" => "Failed to delete income"]);
    }
}

// ✅ Final debug message
error_log("✅ income_action.php execution completed!");

?>
