<?php
session_start();
?>
<?php 
if (! isset($_SESSION['username']) && empty($_SESSION['username'])) {
    header('location:Admin.php');
    exit;
}
if (isset($_SESSION['username']) && $_SESSION['code'] != "999"){
    header('location:Admin.php');
    exit;
}
?>

<!doctype html>
<html>
<head>
<title>Lab 9 - Access MySQL database using PDO</title>
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
			<?php 
$host = "localhost";
$username = "uvggqct2luuzo";
$password = "cst@8238";
$database = "dbtpdciah0gtkg";

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
        
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully" . "</br>";
        
        try {
            $sqlQuery = "SELECT * FROM Employee";
            $result = $pdo->query($sqlQuery);
            $numberOfRows = $result->rowCount();
            
            for ($i = 0; $i < $numberOfRows; ++ $i) {
                
                $row = $result->fetch();
                echo "<form action=\"UpdateAccount.php\" method=\"post\">";
                echo "<input type=\"hidden\" name=\"employeeID\" value=\"" . $row["EmployeeID"] . "\" />";
                echo "<input type=\"hidden\" name=\"firstName\" value=\"" . $row["FirstName"] . "\" />";
                echo "<input type=\"hidden\" name=\"lastName\" value=\"" . $row["LastName"] . "\" />";
                echo "<input type=\"hidden\" name=\"emailAddress\" value=\"" . $row["EmailAddress"] . "\" />";
                echo "<input type=\"hidden\" name=\"number\" value=\"" . $row["TelephoneNumber"] . "\" />";
                echo "<input type=\"hidden\" name=\"designation\" value=\"" . $row["Designation"] . "\" />";
                echo "<input type=\"hidden\" name=\"code\" value=\"" . $row["AdminCode"] . "\" />";
                echo "<input type=\"submit\" name=\"editButton\" value=\"Edit Person\" />";
                echo "</form>";
                echo '<tr>' . '<td>' . "First Name: " . $row["FirstName"] . '</td>' . '<br>' . '<td>' . "Last Name: " . $row["LastName"] . '</td>' . '<br>' . '<br>';
            }
        } catch (PDOException $e) {
            echo "Employee Could Not Be Found  " . $e->getMessage();
        }
    } catch (PDOException $e) {
        echo "Connection failed:  " . $e->getMessage();
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

