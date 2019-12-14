<?php
$salt = '$2a$07$usesomesillystringforsalt$';
$hashed_password = crypt('mypassword',$salt); 
echo $hashed_password;
$password = 'mypassword';
if(crypt($password, $salt) == $hashed_password){
    echo('//nthis is how you authenticate');
}else{
    echo('This more to learn');
}
//password = password
//email = test@gmail.com
?>