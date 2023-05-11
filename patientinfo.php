<!DOCTYPE html>
<html>

<head>
    <title>Patients List</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<body>

    <div class="container">
        <h2>Patients List</h2>
        <?php
        include('header.php');
        include('functions.php');
        include('connection.php');

        if (!isset($_SESSION['loggedInUser']) || $_SESSION['loggedInUserType'] != 'patient') {
            header('Location: http://' . $_SERVER['HTTP_HOST'] . '/pms/');
        }

        $userID = $_SESSION['loggedInUser_id'];

        $query = "SELECT * FROM users WHERE user_id = $userID AND user_type = 'patient'";

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $firstName = $row['firstName'];
            $lastName = $row['lastName'];
            $contact = $row['contact'];
            $email = $row['email'];
            $age = $row['age'];
            $gender = $row['gender'];
            $blood_group = $row['blood_group'];
            $address = $row['address'];
            $prescriptionDate = $row['prescription_date'];

            echo "<table class='table'>
                <tr>
                    <th>Name</th>
                    <td>$firstName $lastName</td>
                </tr>
                <tr>
                    <th>Age</th>
                    <td>$age</td>
                </tr>
                <tr>
                    <th>Gender</th>
                    <td>$gender</td>
                </tr>
                <tr>
                    <th>Blood Group</th>
                    <td>$blood_group</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>$email</td>
                </tr>
                <tr>
                    <th>Contact</th>
                    <td>$contact</td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td>$address</td>
                </tr>
                <tr>
                    <th>Prescription Date</th>
                    <td>$prescriptionDate</td>
                </tr>
            </table>";

            $query = "SELECT * FROM prescriptions WHERE patient_id = $userID";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                echo "<h3>Prescription History</h3>";
                echo "<table class='table'>
                    <thead>
                        <tr>
                            <th>medicine_Date</th>
                            <th>Doctor</th>
                            <th>Medicines</th>     
                            <th>prescription date</th>
                        </tr>
                    </thead>
                    <tbody>";

                while ($row = mysqli_fetch_assoc($result)) {
                    $date = $row['medicine_time'];
                    $doctor = $row['prescription_id'];
                    $medicines = $row['medicine_id'];
                   
                    $prescription_date = $row['prescription_date'];

                    echo "<tr>
                        <td>$date</td>
                        <td>$doctor</td>
                        <td>$medicines</td> 
                        <td>$prescription_date</td>
                      </tr>";
                }

                echo "</tbody>
                 </table>";
            } else {
                echo "<div class='alert alert-info'>No prescription found in the database.</div>";
            }
        } else {
            echo "<div class='alert alert-info'>No patient found in the database.</div>";
        }
        ?>
    </div>

</body>

</html>