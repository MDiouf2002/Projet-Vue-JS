<?php 
    $conn = new mysqli("localhost","root","","ipg-isti");
    if($conn->connect_error){
        die("Connection Failed".$conn->connect_error);
    }

    $received_data = json_decode(file_get_contents("php://input"));
    
    
    if($received_data->action == 'fetchAll'){
        $sql = $conn->query("SELECT * FROM filieres");
        $data = array();
        while($row = $sql->fetch_assoc()){
            array_push($data, $row);
        }
        echo json_encode($data);
    }
    
    else if($received_data->action == 'AddFiliere'){
            $name  = $received_data->name;
            $description  = $received_data->description;
            $year  = $received_data->year;
            $price  = $received_data->price;
            $initiale  = $received_data->initiale;
            $diplome_required  = $received_data->diplome_required;
        $sql = "INSERT INTO filieres
            (name, description, year, price, initiale, diplome_required)
            VALUES ('".$name."', '".$description."', '".$year."', '".$price."', '".$initiale."', '".$diplome_required."')
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
    
    else if($received_data->action == 'UpdateFiliere'){
        $data = array(
            $filiere_id = $received_data->filiere_id,
            $name = $received_data->name,
            $description = $received_data->description,
            $year = $received_data->year,
            $price = $received_data->price,
            $initiale = $received_data->initiale,
            $diplome_required = $received_data->diplome_required
        );
        
        $sql = "UPDATE filieres set
        name='$name', description='$description', year='$year', price='$price', initiale='$initiale', diplome_required='$diplome_required' WHERE filiere_id= '$filiere_id'" ;

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
    
    else if($received_data->action == 'DeleteFiliere'){
        $data = array(
            $filiere_id = $received_data->filiere_id,
        );
        
        $sql = "DELETE FROM filieres WHERE filiere_id= '$filiere_id'" ;

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

    else if($received_data->action == 'fetchFiliere'){
        $sql = $conn->query("SELECT * FROM filieres");
        $data = array();
        while($row = $sql->fetch_assoc()){
            array_push($data, $row);
        }
        echo json_encode($data);
    }

?>