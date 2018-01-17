<?php
session_start();
include_once('settings/config.php');
date_default_timezone_set('Asia/Kolkata');
$current_date = time();
include_once 'DBManager.php';
$DBManager = new DBManager();
include_once 'LoaderManager.php';
$loaderManager = new LoaderManager();
if (isset($_POST["manageInvoiceId"])) {

	if($_POST['type']==1) {
		$invoice_digits = mysqli_real_escape_string($DBManager->conn, $_POST['invoice_digits']);
		$starting_no = mysqli_real_escape_string($DBManager->conn, $_POST['starting_no']);
		$export_invoice_prefix = mysqli_real_escape_string($DBManager->conn,$_POST['export_invoice_prefix'] );
		$india_based_prefix = mysqli_real_escape_string($DBManager->conn, $_POST['india_based_prefix']);
	} else {
		$invoice_digits = 6;
		$starting_no = 1;
		$export_invoice_prefix = NULL;
		$india_based_prefix = NULL;
	}
	
	$createTableInvoice = $loaderManager->createInvoiceTable($invoice_digits, $starting_no, $export_invoice_prefix, $india_based_prefix);
	if($createTableInvoice) {
		$type = mysqli_real_escape_string($DBManager->conn,$_POST['type'] );
		$updateLoaderTable = $loaderManager->updateLoaderTable('invoice_id', $type);
		if($updateLoaderTable) {
			$updateSetup = $loaderManager->updateSetupTable();
			$_SESSION['successMsg'] = 'successMsg';
			header('location:index.php');
		} else {
			$_SESSION['failMsg'] = 'failMsg';
			header('location:setup.php?step=3');
		}
	} else {
			$_SESSION['failMsg'] = 'failMsg';
			header('location:setup.php?step=3');
	}

}
//manageEmployeeId
if (isset($_POST["manageEmployeeId"])) {

	if($_POST['type']==1) {
		$digits = mysqli_real_escape_string($DBManager->conn, $_POST['invoice_digits']);
		$starting_no = mysqli_real_escape_string($DBManager->conn, $_POST['starting_no']);
		$prefix = mysqli_real_escape_string($DBManager->conn,$_POST['export_invoice_prefix'] );
	} else {
		$digits = 6;
		$starting_no = 1;
		$prefix = NULL;
	}
	
	$createTableEmployee = $loaderManager->createEmployeeTable($digits, $starting_no, $prefix);
	if($createTableEmployee) {
		$type = mysqli_real_escape_string($DBManager->conn,$_POST['type'] );
		$updateLoaderTable = $loaderManager->updateLoaderTable('employee_id', $type);
		if($updateLoaderTable) {
			$_SESSION['successMsg'] = 'successMsg';
			header('location:setup.php?step=2');
		} else {
			$_SESSION['failMsg'] = 'failMsg';
			header('location:setup.php?step=1');
		}
	} else {
			$_SESSION['failMsg'] = 'failMsg';
			header('location:setup.php?step=1');
	}

}
// manageClientId 
if (isset($_POST["manageClientId"])) {

	if($_POST['type']==1) {
		$digits = mysqli_real_escape_string($DBManager->conn, $_POST['invoice_digits']);
		$starting_no = mysqli_real_escape_string($DBManager->conn, $_POST['starting_no']);
		$prefix = mysqli_real_escape_string($DBManager->conn,$_POST['export_invoice_prefix'] );
	} else {
		$digits = 6;
		$starting_no = 1;
		$prefix = NULL;
	}
	
	$createTableClient = $loaderManager->createClientTable($digits, $starting_no, $prefix);
	if($createTableClient) {
		$type = mysqli_real_escape_string($DBManager->conn,$_POST['type'] );
		$updateLoaderTable = $loaderManager->updateLoaderTable('client_id', $type);
		if($updateLoaderTable) {
			$_SESSION['successMsg'] = 'successMsg';
			header('location:setup.php?step=3');
		} else {
			$_SESSION['failMsg'] = 'failMsg';
			header('location:setup.php?step=2');
		}
	} else {
			$_SESSION['failMsg'] = 'failMsg';
			header('location:setup.php?step=2');
	}

}