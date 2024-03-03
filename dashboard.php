<!-- HOME PAGE -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    
    <div class="container-fluid">
    <!-- Navigation Bar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <a class="navbar-brand" href="dashboard.php"><img src="img/hero.png" alt="logo"></a>
            
            <!-- Responsive Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link btn btn-success text-white" href="add.html">Add</a>
                    </li>
                </ul>
                <a class="nav-link btn btn-info" href="index.html" onclick="logOut()">Log Out</a>
            </div>
        </nav>
    </div>



    <div class="container-fluid">
        <h1 class="dashboard-title">Developer Details</h1>
    </div>

    <div class="data">
        <!-- Developer Details Table -->
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Email</th>
                    <th>Operation</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // connection establish
                $con = mysqli_connect("localhost", "root", "", "test2");

                // Check the connection
                if (!$con) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                $query = "SELECT * FROM developerdetails";
                $stmt = mysqli_prepare($con, $query);

                if ($stmt) {
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    while ($row = mysqli_fetch_array($result)) {
                        $id = $row['id'];
                        $firstName = $row['firstName'];
                        $lastName = $row['lastName'];
                        $email = $row['email'];
                        ?>
                        <tr>
                            <td><?php echo $firstName; ?></td>
                            <td><?php echo $lastName; ?></td>
                            <td><?php echo $email; ?></td>
                            <td>
                                <a href="devdetails.php?devdetails=<?php echo $id; ?>" class="badge badge-primary">Read</a>
                                <a href="update.php?updateid=<?php echo $id; ?>" class="badge badge-success">Update</a>
                                <a href="delete.php?deleteid=<?php echo $id; ?>" class="badge badge-danger delme" data-confirm="Are you sure you want to delete this item?">Delete</a>
                            </td>
                        </tr>
                        <?php
                    }

                    mysqli_stmt_close($stmt);
                } else {
                    echo "Error in prepared statement: " . mysqli_error($con);
                }

                mysqli_close($con);
                ?>
            </tbody>
        </table>
    </div>
    <script>
        function logOut() {
            alert("You have been logged out");
        }

        $(document).ready(function () {
            $('a[data-confirm]').on("click", function (e) {
                e.preventDefault();

                var choice = confirm($(this).attr('data-confirm'));

                if (choice) {
                    window.location.href = $(this).attr('href');
                }
            });
        });
    </script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
