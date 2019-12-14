<!doctype html>
<?php
?>
<html>

<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
	 crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
	 crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script>
		<?php $firstName = '';
				 if(isset($_COOKIE['firstName'])){
					 $firstName = $_COOKIE['firstName'];
				 }
				 ?>
		checkUser();

		function addUser() {
			return new Promise(function(resolve, reject) {
				$(document).ready(function() {
					$.post("addUser.php", {
						firstName: document.getElementById("firstName").value,
						lastName: document.getElementById("lastName").value,
						email: document.getElementById("email").value,
						password: document.getElementById("password").value,
						phone: document.getElementById("phone").value
					});
				});
				checkUser();
				resolve();
			}, error => {
				reject();
			});
		}

		function checkUser() {
			const cookieFound =
				<?php if(isset($_COOKIE['firstName'])){
			 echo 1;
		 }
			 else {
				 echo 0;
			 }
		 ?>
			;
			if (cookieFound == 0) {
				$(document).ready(() => {
					console.log('Show SignupForm but HIDE dashBoard');
					$("#signUpForm").show();
					$("#dashBoard").hide();
				});
			} else {
				$(document).ready(() => {
					console.log('Hide SignupForm But show dashBoard');
					$("#signUpForm").hide();
					$("#dashBoard").show();
				});
			}
		}
	</script>
</head>

<body>
	<div class="jumbotron jumbotron-fluid">
		<div class="container">
			<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
				<div class="row">
					<div class="col-md-5 p-lg-5 mx-auto my-5">
						<h1 class="display-4 font-weight-normal">Sign Up for our newsletter</h1>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<div class="m-4">
							<!--  action="addUser.php" method="POST" -->
							<form id="signUpForm">
								<div class="form-group">
									<div class="row">
										<div class="col">
											<div class="row">
												<div class="col">
													<label>First Name</label>&nbsp;
													<input class="form-control" type="text" id="firstName" name="firstName">
												</div>
											</div>
											<div class="row">
												<div class="col">
													<label>Last Name</label>&nbsp;
													<input class="form-control" type="text" id="lastName" name="lastName">
												</div>
											</div>
											<div class="row">
												<div class="col">
													<label>emailAddress</label>&nbsp;
													<input class="form-control" type="text" id="email" name="email">
												</div>
											</div>
											<div class="row">
												<div class="col">
													<label>Password</label>&nbsp;
													<input type="password" class="form-control" id="password" type="password" name="password">
													<input type="checkbox" onclick="showPass()">Show Password
												</div>
											</div>
											<div class="row">
												<div class="col">
													<label>Phone</label>&nbsp;
													<input class="form-control" type="text" id="phone" name="phone" min="10" max="10">
												</div>
											</div>
										</div>
									</div>
									<button type="button" class="btn btn-primary" onclick="addUser()">Submit</button>
							</form>
							</div>
							<div id="dashBoard" class="row">
								<div class="col">
									<h1> Welcome
										<?php echo $firstName ?>
									</h1>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<script>
				function showPass() {
					const x = document.getElementById("password");
					if (x.type === "password") {
						x.type = "text";
					} else {
						x.type = "password";
					}
				}
			</script>
</body>

</html>