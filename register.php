<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: url(img/bg.jpg) no-repeat center center fixed;
	        background-size: cover;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            max-width: 400px;
            background-color: rgba(52, 73, 94, 0.7);
	        opacity: 0.7;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .alert {
            margin-top: 10px;
        }

        .form-heading {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <a href="index.html" class="btn btn-primary mb-3">Home</a>

        <?php
        // Establish Connection
        $con = mysqli_connect("localhost", "root", "", "test2");

        // checking the connection
        if (mysqli_connect_errno()) {
            echo "Unable to connect to the database: " . mysqli_connect_error();
        }

        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $user = $_POST['username'];
            $pass = $_POST['password'];

            if (empty($user) || empty($pass) || empty($name) || empty($email)) {
                echo "<div class='alert alert-danger' role='alert'>
                        All fields should be filled. Either one or many fields are empty.
                    </div>";
                echo "<a href='register.php' class='btn btn-secondary'>Go back</a>";
            } else {
                mysqli_query($con, "INSERT INTO login(name, email, username, password) VALUES('$name', '$email', '$user', md5('$pass'))")
                    or die("Could not execute the insert query.");

                echo "<div class='alert alert-success' role='alert'>
                        Registration successful!
                    </div>";
                echo "<a href='index.html' class='btn btn-success'>Login</a>";
            }
        } else {
        ?>
            <div class="form-heading">
                <h2>Register</h2>
            </div>
            <form name="form1" method="post" action="">
                <div class="mb-3">
                    <!-- <label for="name" class="form-label">Full Name</label> -->
                    <input type="text" class="form-control" name="name" required placeholder="Full Name">
                </div>
                <div class="mb-3">
                    <!-- <label for="email" class="form-label">Email</label> -->
                    <input type="text" class="form-control" name="email" required placeholder="Email">
                </div>
                <div class="mb-3">
                    <!-- <label for="username" class="form-label">Username</label> -->
                    <input type="text" class="form-control" name="username" required placeholder="Username">
                </div>
                <div class="mb-3">
                    <!-- <label for="password" class="form-label">Password</label> -->
                    <input type="password" class="form-control" name="password" required placeholder="Password">
                </div>
                <button type="submit" name="submit" class="btn btn-success">Submit</button>
            </form>
        <?php
        }
        ?>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
