<?php
// DataBase connection 
$localname = 'localhost';
$username = 'root';
$password = '';
$dbname = 'company';

$conn = mysqli_connect($localname, $username, $password, $dbname);


// Create data in DataBase 
$message = '';

$allDepartment = ["IT", "SW", "HR", "Sales"];
if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $salary = $_POST['salary'];
    $department = $_POST['department'];
    $phone = $_POST['phone'];
    $insertQuery = "insert into `employees` values (null , '$name' , '$address' , '$gender' , '$email' , $salary , '$department' , '$phone')";
    $insert = mysqli_query($conn, $insertQuery);
    if ($insert) {
        $message =  "data added successfully";
    }
}

//Delete from data

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $deleteQuery = "DELETE FROM `employees` where id = $id";
    $delete = mysqli_query($conn, $deleteQuery);
    if ($delete) {
        header("LOCATION: mec115.php");
    }
}
//edit data
$name = '';
$address = '';
$gender = '';
$email = '';
$salary = '';
$department = '';
$phone = '';
$isEditMode = false;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $selectquery = "SELECT * FROM `employees` WHERE id = $id";
    $selectOne = mysqli_query($conn, $selectquery);
    $row = mysqli_fetch_assoc($selectOne);
    $name = $row['name'];
    $address = $row['address'];
    $gender = $row['gender'];
    $email = $row['email'];
    $salary = $row['salary'];
    $department = $row['department'];
    $phone = $row['phone'];
    $isEditMode = true;

    //update Data that was selected in Edit =====

    if (isset($_POST['update'])) {
        $name = $_POST['name'];
        $address = $_POST['address'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $salary = $_POST['salary'];
        $department = $_POST['department'];
        $phone = $_POST['phone'];
        $updateQuery = "UPDATE `employees` SET `name` = '$name' , `address`='$address' , gender = '$gender' , `email` = '$email' , salary = $salary , department = '$department' , phone = '$phone' WHERE id =  $id ";
        $update = mysqli_query($conn, $updateQuery);
        if ($update) {
            header("LOCATION: mec115.php");
        }
    }
}

// Select Data From DataBase 

$selectquery = "SELECT * FROM `employees` ";


// select Data From DataBase in case Search ====
$valueSearch = '';
if (isset($_GET['search'])) {
    $valueSearch = $_GET['search'];
    $selectquery = "SELECT * FROM `employees` WHERE `name` LIKE '%$valueSearch%' OR email LIKE '%$valueSearch%' OR `address` LIKE '%$valueSearch%' OR phone LIKE '%$valueSearch%'  ";
}

if (isset($_GET['asc'])) {
    $column = $_GET['column'];
    $selectquery = "SELECT * FROM `employees` ORDER BY $column ASC";
} else if (isset($_GET['desc'])) {
    $column = $_GET['column'];
    $selectquery = "SELECT * FROM `employees` ORDER BY $column DESC";
}


// select exceute 

$select = mysqli_query($conn, $selectquery);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company</title>
    <link rel="stylesheet" href="mec115.css">

</head>

<body>
    <div>
        <?php if (!empty($message)): ?>
            <?= $message ?>
    </div>
<?php endif; ?>



</div>
<form method="post">
    <label for="name">Name</label>
    <input type="text" value="<?= $name ?>" name="name" id="name" />
    <label for="address">Address</label>
    <input type="text" value="<?= $address ?>" name="address" id="address" />
    <br><br>

    <label for="gender">Gender</label>
    <select name="gender" id="gender">
        <?php if ($gender == "Male"): ?>
            <option selected value="Male">Male</option>
            <option value="Female">Female</option>
        <?php elseif ($gender == "Female"): ?>
            <option value="Male">Male</option>
            <option selected value="Female">Female</option>
        <?php else: ?>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        <?php endif; ?>
    </select>
    &nbsp; &nbsp; &nbsp;
    <label for="Email">Email</label>
    <input type="Email" value="<?= $email ?>" name="email" id="email">
    <label for="salary">Salary</label>
    <input type="number" value="<?= $salary ?>" name="salary" id="salary">
    <br> &nbsp;
    <br>

    <label for="department">Department</label>
    <select name="department" id="department">
        <?php foreach ($allDepartment as $dep) : ?>
            <?php if ($dep == $department): ?>
                <option selected value="<?= $dep ?>"><?= $dep ?></option>
            <?php else : ?>
                <option value="<?= $dep ?>"><?= $dep ?></option>
            <?php endif; ?>
        <?php endforeach; ?>
    </select>
    &nbsp; &nbsp;
    <label for="phone">Phone</label>
    <input type="text" value="<?= $phone ?>" name="phone" id="phone">


    <?php //Cancel And Update buttons when click on Edit button ====    
    ?>

    <?php if ($isEditMode) : ?>
        <button name="update">Update</button>
        <a href="mec115.php">Cancel</a>
    <?php else : ?>
        <button name="submit">Submit</button>
    <?php endif; ?>
</form>
<br><br><br>
<!-- ==================== -->
<div>
    <form>
        <label for="search">Search</label>
        <input type="text" name="search" value="<?= $valueSearch ?>" placeholder="Searh هنا يا كبير">
        <button>Search</button>
        <?php if (!empty($valueSearch)): ?>
            <a href="mec115.php">Cancel</a>
        <?php endif; ?>

    </form>
</div>
<br>
<div>
    <form>
        &nbsp; &nbsp;
        <select name="column">
            <option value="name">name</option>
            <option value="address">address</option>
            <option value="gender">gender</option>
            <option value="email">email</option>
            <option value="salary">salary</option>
            <option value="department">department</option>
        </select>
        <div>
            <?php if (isset($_GET['asc']) || isset($_GET['desc'])): ?>
                <a href="mec115.php">Cancel</a>
            <?php endif; ?>

            <button name="asc">ASC</button>
            <button name="desc">DESC</button>

        </div>
    </form>
</div>
<br>


<br><br><br>
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
            <th colspan="2">Actions</th>
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
                <td><?= $emp['salary'] ?>$ </td>
                <td><?= $emp['department'] ?></td>
                <td><?= $emp['phone'] ?></td>
                <td>
                    <!-- <form>
                        <input type="text" value=<?= $emp['id'] ?> name="delete" hidden>
                        <button>Delete</button> طريقة تانية لل delete
                     </form> -->
                    <a href=?delete=<?= $emp['id']  ?>>Delete</a>
                </td>
                <td>
                    <a href=?edit=<?= $emp['id'] ?>> Edit </a>
                </td>

            </tr>


        <?php endforeach; ?>
    </tbody>
</table>

</body>

</html>