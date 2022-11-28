<?php
session_start();
?>
<?php 
if (! isset($_SESSION['username']) && empty($_SESSION['username'])) {
    header('location:Admin.php');
    exit;
}?>

<!doctype html>
<html>
<head>
<title>Access MySQL database using PDO</title>
<link
	href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
	rel="stylesheet"
	integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
	crossorigin="anonymous">
</head>


<body>
	<div class="container-fluid">


		<div class="card text-center">
			<div class="card-header">
				<div class="card-body">
      <?php include_once "Header.php";?>
          <small class="text-muted">- Web Programming</small>
				</div>
			</div>
		</div>
		<!-- Card Text Center Div end -->


		<div class="row">

			<div class="col-4">
				<div class="text-center">
					<div class="btn-group-vertical">
			<?php include_once "Menu.php";?>
			</div>
				</div>
			</div>
			<!-- Col 4 menu end -->

			<div class="col-8">
				<form action="UpdateComplete.php" method="post">
					<input type="hidden" name="updateEmployee"
						value="<?php echo  $_POST['employeeID']; ?>" /> First Name: <input
						type="text" name="updatefirstName"
						value="<?php echo  $_POST['firstName']; ?>" /> <br /> Last Name: <input
						type="text" name="updatelastName"
						value="<?php echo  $_POST['lastName']; ?>" /> <br /> Email
					Address: <input type="email" name="updateEmail"
						value="<?php echo  $_POST['emailAddress']; ?>" /> <br /> Phone
					Number: <input type="number" name="updatePhone"
						value="<?php echo  $_POST['number']; ?>" /> <br /> Designation: <input
						type="text" name="updateDesignation"
						value="<?php echo  $_POST['designation']; ?>" /> <br /> Admin
					Code: <input type="number" name="updateCode"
						value="<?php echo  $_POST['code']; ?>" /> <br /> <input
						type="submit" value="Update Record" />
				</form>
	<?php
$host = "localhost";
$username = "uvggqct2luuzo";
$password = "cst@8238";
$database = "dbtpdciah0gtkg";

if (isset($_POST["updateEmployee"])) {
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully" . "</br>";

        $sqlQuery = "UPDATE Employee SET FirstName = '" . $_POST["updatefirstName"] . "', LastName = '" . $_POST["updatelastName"] . "', EmailAddress = '" . $_POST["updateEmail"] . "', TelephoneNumber = '" . $_POST["updatePhone"] . "', Designation = '" . $_POST["updateDesignation"] . "', AdminCode = '" . $_POST["updateCode"] . "' WHERE EmployeeID = '" . $_POST['updateEmployee'] . "'";

        try {
            $result = $pdo->query($sqlQuery);
            header('location:UpdateComplete.php');
        } catch (PDOException $e) {
            echo "Employee Could not be Updated:  " . $e->getMessage();
        }

        $pdo = null;
    } catch (PDOException $e) {
        echo "Connection failed:  " . $e->getMessage();
    }
}

?>
	
	
	
			</div>
			<!-- Column 8 End -->

		</div>
		<!-- Row div end -->
	</div>
	<!-- Container div end -->
</body>
<footer>
<?php include_once "Footer.php";?>
</footer>
</html>

