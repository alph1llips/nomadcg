<?php
$conn = include("./connect.php");
if ($conn->connect_error) {
    echo "Connection failed: " . $conn->connection_error;
} else if ($conn) {
    // $email = $_POST["email"];
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $phone = $_POST["phone"];
    userTable($conn, $email, $firstName, $lastName, $phone, $password);
}

function userTable($conn, $email, $firstName, $lastName, $phone, $password)
{
    $exists = mysqli_query($conn, "select 1 from nomadcg.users");
    if (!$exists) {
        $createSql = "CREATE TABLE nomadcg.users (
            userId int(5) AUTO_INCREMENT PRIMARY KEY,
            firstName varchar(15) NOT NULL,
            lastName varchar(20) NOT NULL,
            email varchar(100) NOT NULL,
            password varchar(50) NOT NULL,
            phone int(10) NOT NULL,
            insert_date TIMESTAMP
        )";
        $conn->query($createSql);
    }
    insertNewUser($conn, $email, $firstName, $lastName, $phone, $password);
}

function isDuplicateemail($conn, $email)
{
    $select = $conn->prepare("select email from nomadcg.users 
    where email = (?)");
    try {
       $select->bind_param("s", $email);
    $select->execute();
    $select->bind_result($email);
    $isDuplicate = $select->fetch();
    $select->close(); 
}catch(exception $e){
 echo($e);   
}


    if ($isDuplicate) { 
        return true;
    }
    return false;
}

function insertNewUser($conn, $email, $firstName, $lastName, $phone, $password)
{
    $password = encryptPassword($password);
    if (!isDuplicateemail($conn, $email)) {
        $timestamp = date("Y-m-d H:i:s");
        $sqlInsert = $conn->prepare("insert into nomadcg.users (firstName, lastName, 
        email, password, phone, insert_date) values (?,?,?,?,?,?)");
        $sqlInsert->bind_param("ssssii", $firstName, $lastName, $email, $password, $phone, $timestamp);
        $sqlInsert->execute();
        $sqlInsert->close();
        echo("User Added");
    } else {
        echo("email already exist");
    }
    setcookie('firstName',$firstName, time() + (600 * 30),"/");
    setcookie('lastName', $lastName, time() + (600 * 30),"/");
    setcookie('email', $email, time() + (600 * 30),"/");
    echo(json_encode($password));
    // header('Location: userAdded.php');
    $conn->close();
}
function encryptPassword($password){
    $salt = '$2a$07$thisisacustomestringforus$';
    $hashPassword = md5($password); 
    return $hashPassword;
}
?>