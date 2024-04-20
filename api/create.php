<?php
        header("Content-Type:application/json");
        header("Acces-Control-Allow-Origin:*");
        header("Acces-Control-Allow-Method: POST");
        header("Acces-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With");

    include "connection.php";
    // $taskName = $_POST['taskName'];

    // if(isset($taskName)){
    //     $taskName = $_POST['taskName'];
    //     $taskDesc = $_POST["taskDesc"];
    //     $done = $_POST["done"];
    //     $createdDate = date("Y-m-d");

    //     echo json_encode((array("Date" => $createdDate)));

    //     $insertQuery = "INSERT INTO `task`(`taskName`, `taskDesc`, `done`, `createdDate`) VALUES ('$taskName' ,'$taskDesc' ,'$done ', '$createdDate')";

    //     $result = mysqli_query($con, $insertQuery);

    //     if($result){
    //         echo json_encode(array("status" => "Success"));
    //     }else{
    //         echo json_encode(array("status" => "Failed"));
    //     }

    //     echo "ada";
    // }else{
    //     echo "Huuu";
    // }

    $requestMethod = $_SERVER["REQUEST_METHOD"];

    if($requestMethod == "POST"){
        
        $inputData = json_decode(file_get_contents("php://input"), true);
        if(empty($inputData)){
           $taskStore = storeTask($_POST);
        }
        else{
            $taskStore = storeTask($inputData);
        }
        echo $taskStore;
    }
    else{
        $data = [
            'status' => 405,
            'message' => $requestMethod. ' Method Not Allowed',
        ];
        header("HTTP/1.0 405 Method Not Allowed");

        echo json_encode( $data, JSON_PRETTY_PRINT);
    }

    function error422($message){
        $data = [
            'status' => 422,
            'message' => $message,    
        ];
        header('HTTP/1.0 422 Unprocessable Entity');
        echo json_encode( $data, JSON_PRETTY_PRINT);
    }

    function storeTask($taskInput){

       global $con;

        $name = mysqli_real_escape_string($con, $taskInput["taskName"]);
        $desc = mysqli_real_escape_string($con, $taskInput["taskDesc"]);
        $done = mysqli_real_escape_string($con, $taskInput["done"]);

        $createdDate = date("Y-m-d");

        echo json_encode((array("Date" => $createdDate)));

        if(empty(trim($name))){
            return error422("Enter Task Name");
        }else if(empty(trim($desc))){
            return error422("Enter Task Name");
        }
        else{
            $insertQuery = "INSERT INTO `task`(`taskName`, `taskDesc`, `done`, `createdDate`) VALUES ('$name' ,'$desc' ,'$done ', '$createdDate')";
            
            $result = mysqli_query($con, $insertQuery);
            
            if($result){
                $data = [
                    'status' => 201,
                    'message' => 'Task Created Successfully'
                    
                ];
                header("HTTP/1.0 201 Created");
        
                return json_encode( $data,JSON_PRETTY_PRINT);
            }
            else{
                $data = [
                    'status' => 500,
                    'message' => 'Internal Server Error',
                ];
                header("HTTP/1.0 500 Internal Server Error");
        
                return json_encode( $data, JSON_PRETTY_PRINT );
            }
        
        }
    }

    