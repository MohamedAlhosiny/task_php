<?php
// DataBase connection 
$localname = 'localhost';
$username = 'root';
$password = '';
$dbname = 'company';

$conn = mysqli_connect($localname, $username, $password, $dbname);


// Create data in DataBase 
$message = '';
if (isset($_POST['submit'])) {
    $name = $_POST['Name'];
    $address = $_POST['Address'];
    $gender = $_POST['Gender'];
    $email = $_POST['Email'];
    $salary = $_POST['Salary'];
    $department = $_POST['Department'];
    $phone = $_POST['Phone'];
    $insertQuery = "insert into `employees` values (null , '$name' , '$address' , '$gender' , '$email' , $salary , '$department' , '$phone')";
    $insert = mysqli_query($conn, $insertQuery);
    if ($insert) {
        $message =  "data added successfully";
    }
}

// Select Data From DataBase

$selectquery = "select * from `employees` ";
$select = mysqli_query($conn, $selectquery);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company</title>
</head>

<body>
    <div>
        <?php if (!empty($message)): ?>
            <?= $message ?>
    </div>
<?php endif; ?>



</div>
<form method="post">
    <label for="Name">Name</label>
    <input type="text" name="Name" id="Name" />
    <label for="Address">Address</label>
    <input type="text" name="Address" id="Address" />
    <br><br>

    <label for="Gender">Gender</label>
    <select name="Gender" id="Gender">
        <option value="Male">Male</option>
        <option value="Female">Female</option>
    </select>
    &nbsp; &nbsp; &nbsp;
    <label for="Email">Email</label>
    <input type="Email" name="Email" id="Email">
    <label for="Salary">Salary</label>
    <input type="number" name="Salary" id="Salary">
    <br> &nbsp;
    <br>
    <label for="Department">Department</label>
    <select name="Department" id="Department">
        <option value="IT">IT</option>
        <option value="SW">SW</option>
        <option value="HR">HR</option>
        <option value="Sales">Sales</option>
    </select>
    &nbsp; &nbsp;
    <label for="Phone">Phone</label>
    <input type="text" name="Phone" id="Phone">

    <input type="submit" name="submit" id="submit">
</form>
<br>
<br>
<br>

<table border="1">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Address</th>
            <th>Gender</th>
            <th>Email</th>
            <th>Salary</th>
            <th>Department</th>
            <th>Phone</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($select as $index => $emp) : ?>
            <tr>
                <td><?= $index + 1 ?></td>
                <td><?= $emp['name'] ?></td>
                <td><?= $emp['address'] ?></td>
                <td><?= $emp['gender'] ?></td>
                <td><?= $emp['email'] ?></td>
                <td><?= $emp['salary'] ?></td>
                <td><?= $emp['department'] ?></td>
                <td><?= $emp['phone'] ?></td>
            </tr>


        <?php endforeach; ?>
    </tbody>
</table>

</body>

</html>