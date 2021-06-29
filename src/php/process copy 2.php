<?php 
    $conn = new mysqli("localhost","root","","ipg-isti");
    if($conn->connect_error){
        die("Connection Failed".$conn->connect_error);
    }
    echo("Success");

    $result = array('error' => false);
    $action ='';

    if(isset($_GET['action'])){
        $action = $_GET['action'];
    }

    if($action == 'read'){
        $sql = $conn->query("SELECT * FROM filieres");
        $users = array();
        while($row = $sql->fetch_assoc()){
            array_push($users, $row);
        }

        $result['users'] = $users;

    }

    if($action == 'readFiliere'){
        $sql = $conn->query("SELECT * FROM `users`");
        if($sql){
            $filieres = array();
            while($row = $sql->fetch_assoc()){
                array_push($filieres, $row);
            }

            $result['filieres'] = $filieres;
        }
        else{
            echo('Error');
        }
    }
    
    if($action == 'create'){
        $pseudo = $_POST['pseudo'];
        $lastName = $_POST['lastName'];
        $firstName = $_POST['firstName'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];

        $sql = $conn->query("INSERT INTO users (pseudo, lastName, firstName, email, password, confirmPassword) 
        VALUES ('$pseudo', '$lastName', '$firstName', '$email', '$password', '$confirmPassword')");
        
        if($sql){
            $result['message']= 'User added sucessfully!';
        }
        else{
            $result['error'] = true;
            $result['message'] = 'Error to add user';
        }

        $result['users'] = $users;

    }
    
    if($action == 'update'){
        $user_id = $_POST['user_id'];
        $pseudo = $_POST['pseudo'];
        $lastName = $_POST['lastName'];
        $firstName = $_POST['firstName'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        $birthday = $_POST['birthday'];
        $adresse = $_POST['adresse'];

        $sql = $conn->query("UPDATE users SET user_id='$user_id', pseudo='$pseudo', lastName='$lastName', firstName='$firstName', email='$email', password='$password', confirmPassword='$confirmPassword', birthday='$birthday', adresse ='$adresse '");
        
        if($sql){
            $result['message']= 'User updated sucessfully!';
        }
        else{
            $result['error'] = true;
            $result['message'] = 'Error to update user';
        }

        $result['users'] = $users;

    }
    $conn->close();
    echo json_encode($result);
?>