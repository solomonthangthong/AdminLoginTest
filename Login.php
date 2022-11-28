<?php
session_start();

$host = "localhost";
$username = "uvggqct2luuzo";
$password = "cst@8238";
$database = "dbtpdciah0gtkg";

if (isset($_POST["email"]) && isset($_POST["password"])) {
    
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
        
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        try {
            $sqlQuery = "SELECT * FROM Employee";
            $result = $pdo->query($sqlQuery);
            $numberOfRows = $result->rowCount();
            
            for ($i = 0; $i < $numberOfRows; ++ $i) {
                
                $row = $result->fetch();
                if ($row["EmailAddress"] == $_POST["email"] && $row["Password"] == $_POST["password"]) {
                    $_SESSION['valid'] = true;
                    $_SESSION['timeout'] = time();
                    $_SESSION['username'] = $_POST["email"];
                    $_SESSION['code'] = $row["AdminCode"];
                }
            }
            header('Location: ViewAllEmployees.php');
            exit;
        } catch (PDOException $e) {
            
        }
    } catch (PDOException $e) {
        
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
			</div>
			<!-- Col 4 menu end -->

			<div class="col-8">

				<form action="Login.php" method="post">
					<label for="email"> Email Address </label> <input type="email"
						id="email" name="email"><br> <label for="password">Password </label>
					<input type="text" id="password" name="password"><br> <input
						type="submit" name="submit" value="Login">
				</form>

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

