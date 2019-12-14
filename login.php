<?php
$conn = include('./connect.php');
if ($conn->connect_error) {
    echo "Connection failed: " . $conn->connection_error;
} else if ($conn) {
    $inputEmail = $_POST["email"];
    $inputPassword = $_POST["password"];
    findUser($conn, $inputEmail, $inputPassword);
    //ruzi@cyber-host.net
}
function findUser($conn, $inputEmail, $inputPassword){
    try {
    $select = $conn->prepare("select email, password, firstName, lastName, phone from users where email = (?)");
    $select->bind_param("s", $inputEmail);
    $select->execute();
    $select->bind_result($email, $password, $fistName, $lastName, $phone);
    $results = $select->fetch();
    $select->close(); 
    }
    catch(exception $e){
        echo(json_encode($e));
    }finally{
        $conn->close();
    }
    checkPassword($inputPassword, $password);
}
function checkPassword($inputPassword, $password){
    $salt = '$2a$07$thisisacustomestringforus$';
    $cryptPassword = md5($inputPassword);
    if($cryptPassword == $password){
        echo('<br>'.'this is how you authenticate');
    }else{
        echo('There is more to learn');
    }
}
?>