<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h2>User Login</h2>
    <?php
    include('header.php');
    include('functions.php');
    include('connection.php');

    $formID = $formEmail = $formPass = $loginError = "";

    if (isset($_SESSION['loggedInUser'])) {
        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/Prescription-Management-System-master/Prescription-Management-System-master/patient ');
    }

    if (isset($_SESSION['lockCheckEmail'])) {
        $loginEmail = $_SESSION['lockCheckEmail'];
    }

    if (isset($_POST['login'])) {
        $formID = validateFormData($_POST['id']);
        $formEmail = validateFormData($_POST['email']);
        $formPass = validateFormData($_POST['password']);

        $emailOrContact = "email='$formEmail' OR contact='$formEmail'";
        $query = "SELECT * FROM users WHERE ($emailOrContact) AND user_id = $formID";

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $user_id = $row['user_id'];
                $firstName = $row['firstName'];
                $lastName = $row['lastName'];
                $user_type = $row['user_type'];
                $pass = $row['password'];
            }

            if ($formPass == $pass) {
                $_SESSION['loggedInUser'] = $firstName;
                $_SESSION['loggedInUser_id'] = $user_id;
                $_SESSION['loggedInUserType'] = $user_type;

                header('Location: http://' . $_SERVER['HTTP_HOST'] . '/Prescription-Management-System-master/Prescription-Management-System-master/patientinfo.php');
            } else {
                $_SESSION['lockCheckEmail'] = $formEmail;
                $loginError = "<div class='alert alert-danger'>Wrong username/Password combination. Try again.</div>";
            }
        } else {
            $loginError = "<div class='alert alert-danger'>No such user in database. Please try again. <a class ='close' data-dismiss='alert'>&times;</a></div>";
        }
    }
    ?>
    <form method="post" action="">
        <div class="form-group">
            <label for="id">ID:</label>
            <input type="text" class="form-control" id="id" name="id" required>
        </div>
        <div class="form-group">
            <label for="email">Email or Contact Number:</label>
            <input type="text" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" name="login" class="btn btn-primary">Login</button>
    </form>
    <?php if(isset($loginError)) { echo $loginError; } ?>
</div>

</body>
</html>