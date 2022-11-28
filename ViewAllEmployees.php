<?php
session_start();
?>
<?php 
if (! isset($_SESSION['username']) && empty($_SESSION['username'])) {
    header('location:Login.php');
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
			<?php
$host = "localhost";
$username = "uvggqct2luuzo";
$password = "cst@8238";
$database = "dbtpdciah0gtkg";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
    $sqlQuery = "SELECT * FROM Employee";

    $result = $pdo->query($sqlQuery);

    $rowCount = $result->rowCount();

    if ($rowCount == 0)
        echo "*** There are no rows to display from the Employee table ***";
    else {
        echo '<table class="table">';
        echo '<thead>';
        echo '<th scope="col">' . 'First Name' . '</th>';
        echo '<th scope="col">' . 'Last Name' . '</th>';
        echo '<th scope="col">' . 'Email Address' . '</th>';
        echo '<th scope="col">' . 'Phone Number' . '</th>';
        echo '<th scope="col">' . 'SIN' . '</th>';
        echo '<th scope="col">' . 'Designation' . '</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<br>';
        for ($i = 0; $i < $rowCount; ++ $i) {
            $row = $result->fetch();
            echo '<tr>' . '<td>' . $row["FirstName"] . '</td>' . '<td>' . $row["LastName"] . '</td>' . '<td>' . $row["EmailAddress"] . '</td>' . '<td>' . $row["TelephoneNumber"] . '</td>' . '<td>' . $row["SocialInsuranceNumber"] . '</td>' . '<td>' . $row["Designation"] . '</td>' . '</tr>';
        }
        echo '</table>';
    }

    $pdo = null;
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
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