<?php 
    $conn = new mysqli("localhost","root","","ipg-isti");
    if($conn->connect_error){
        die("Connection Failed".$conn->connect_error);
    }

    $received_data = json_decode(file_get_contents("php://input"));
   
    
    if($received_data->action == 'AddUser'){
        $pseudo = $received_data->pseudo;
        $lastName = $received_data->lastName;
        $firstName = $received_data->firstName;
        $email = $received_data->email;
        $password = $received_data->password;

        $sql = "INSERT INTO users
            (pseudo, lastName, firstName, email, password)
            VALUES ('".$pseudo."', '".$lastName."', '".$firstName."', '".$email."', '".$password."')
            ";


        if($conn->query($sql)){
            $output = array(
                'message' => "true"
            );
        }
        else{
            $output = array(
                'message' => "false"
            );
        }
        echo json_encode($output);
    }
    
    else if($received_data->action == 'UpdateUser'){
        $data = array(
            $user_id = $received_data->user_id,
            $pseudo = $received_data->pseudo,
            $lastName = $received_data->lastName,
            $firstName = $received_data->firstName,
            $email = $received_data->email
        );
        
        $sql = "UPDATE users set
        pseudo='$pseudo', lastName='$lastName', firstName='$firstName', email='$email' WHERE user_id= '$user_id'" ;

        mysqli_query($conn,$sql);
    }
    
    else if($received_data->action == 'UpdatePassword'){
        $data = array(
            $password = $received_data->password,
            $confirmPassword = $received_data->confirmPassword
        );
        
        $sql = "UPDATE users set
        password='$password', confirmPassword='$confirmPassword' WHERE user_id= '$user_id'" ;

        mysqli_query($conn,$sql);
    }
    
    else if($received_data->action == 'DeleteUser'){
        $data = array(
            $user_id = $received_data->user_id,
        );
        
        $sql = "DELETE FROM users WHERE user_id= '$user_id'" ;

        mysqli_query($conn,$sql);

        
        echo json_encode('Deleted Success');
    }

    else if($received_data->action == 'ConnectUser'){
        $data = array(
            $usernameOrEmail = $received_data->usernameOrEmail,
            $password = $received_data->password,
        );

        $sql = $conn->query("SELECT * FROM users WHERE (pseudo = '$usernameOrEmail' OR email = '$usernameOrEmail') AND password='$password'");
        $data = array();
        while($row = $sql->fetch_assoc()){
            array_push($data, $row);
        }
        echo json_encode($data);
    }

?>