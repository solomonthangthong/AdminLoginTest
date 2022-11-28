<?php
session_start();

$host = "localhost";
$username = "uvggqct2luuzo";
$password = "cst@8238";
$database = "dbtpdciah0gtkg";

if (! isset($_POST["fname"]) || ! isset($_POST["lname"]) || ! isset($_POST["email"]) || ! isset($_POST["number"]) || ! isset($_POST["sin"]) || ! isset($_POST["password"]) || ! isset($_POST["designation"]) || ! isset($_POST["code"])) {
    $error = "Please enter all data fields.";
} else {
    if ($_POST["fname"] != "" && $_POST["lname"] != "" && $_POST["email"] != "" && $_POST["number"] != "" && $_POST["sin"] != "" && $_POST["password"] != "" && $_POST["designation"] != "" && $_POST["code"] != "") {
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
            
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully" . "</br>";
            
            if ($_POST["designation"] == "Manager") {
                if ($_POST["code"] != "999") {
                    echo "Invalid Admin Code for Managers" . '<br>';
                } else {
                    $sqlQuery = "INSERT INTO Employee (FirstName, LastName, EmailAddress, TelephoneNumber, SocialInsuranceNumber, Password, Designation, AdminCode) VALUES('" . $_POST["fname"] . "', '" . $_POST["lname"] . "', '" . $_POST["email"] . "', '" . $_POST["number"] . "', '" . $_POST["sin"] . "', '" . $_POST["password"] . "', '" . $_POST["designation"] . "', '" . $_POST["code"] . "')";
                    
                    try {
                        $result = $pdo->query($sqlQuery);
                        echo "Employee Successfully Added" . "<br>";
                        header('location:ViewAllEmployees.php');
                        exit;
                    } catch (PDOException $e) {
                        echo "Employee Could not be added:  " . $e->getMessage();
                    }
                }
            }
            
            if ($_POST["designation"] == "ITDeveloper") {
                if ($_POST["code"] == "999") {
                    echo "Invalid Admin Code for ITDeveloper" . '<br>';
                } else {
                    $sqlQuery = "INSERT INTO Employee (FirstName, LastName, EmailAddress, TelephoneNumber, SocialInsuranceNumber, Password, Designation, AdminCode) VALUES('" . $_POST["fname"] . "', '" . $_POST["lname"] . "', '" . $_POST["email"] . "', '" . $_POST["number"] . "', '" . $_POST["sin"] . "', '" . $_POST["password"] . "', '" . $_POST["designation"] . "', '" . $_POST["code"] . "')";
                    
                    try {
                        $result = $pdo->query($sqlQuery);
                        echo "Employee Successfully Added" . "<br>";
                        header('location:ViewAllEmployees.php');
                        exit;
                    } catch (PDOException $e) {
                        echo "Employee Could not be added:  " . $e->getMessage();
                    }
                }
            }
        } catch (PDOException $e) {
            echo "Connection failed:  " . $e->getMessage();
        }
    } else {
        $error = "Employee failed to be created. Please enter all data fields." . '<br>';
        echo $error;
    }
}

?>

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
			</div><!-- Col 4 menu end -->
			
			<div class="col-8">
			
			<form action="CreateAccount.php" method="post">
			<label for="fname">First Name </label> <input type="text" id="fname" name="fname"><br>
			<label for="lname">Last Name </label> <input type="text" id="lname" name="lname"><br>
			<label for="email"> Email </label> <input type="email" id="email" name="email"><br>
			<label for="number">Phone Number </label> <input type="number" id="number" name="number"><br>
			<label for="sin">SIN </label>  <input type="number" id="sin" name="sin"><br>
			<label for="password">Password </label>  <input type="text" id="password" name="password"><br>
			<label for="designation">Designation </label> <input type="text" id="designation" name="designation"><br>
    		<label for="code">Admin Code </label> <input type="number" id="code" name="code"><br>
  
			 <input type="submit" name="submit" value="Submit Information">
			</form>

			</div> <!-- Column 8 End -->

		</div> <!-- Row div end -->
	</div>
	<!-- Container div end -->
</body>
<footer>
<?php include_once "Footer.php";?>
</footer>
</html>

