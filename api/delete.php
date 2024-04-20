<?php
    header("Content-Type:application/json");

    include "connection.php";

    $requestMethod = $_SERVER["REQUEST_METHOD"];

    if($requestMethod == "DELETE"){
        $inputData = json_decode(file_get_contents("php://input"), true);

        if(empty($inputData)){
            $deleteTask = deleteTask($_POST);
         }
         else{
             $deleteTask = deleteTask($inputData);
         }
         echo $deleteTask;
    }
    else{
        $data = [
            'status' => 405,
            'message' => $requestMethod. ' Method Not Allowed',
        ];
        header("HTTP/1.0 405 Method Not Allowed");

        echo json_encode( $data, JSON_PRETTY_PRINT);
    }

    function deleteTask($taskInput){
        global $con;

        $taskId = mysqli_real_escape_string($con, $taskInput["taskId"]);

        $sql = "SELECT * FROM task WHERE taskId = $taskId";
        $res = mysqli_query($con, $sql);

        if(mysqli_num_rows($res) == 1){
            $sqlDel = "DELETE FROM task WHERE taskId = $taskId";
            $result = mysqli_query($con, $sqlDel);
            
            if($result){
                $data = [
                    'status' => 200,
                    'message' => 'Task Deleted Successfully'
                ];
                header("HTTP/1.0 200 Deleted");
    
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
        else{
            $data = [
                'status' => 404,
                'message' => 'No Task Found',
            ];
            header("HTTP/1.0 404 Not Found");
    
            echo json_encode( $data, JSON_PRETTY_PRINT );            
        }
    }

    // if(isset($_GET['taskId']) && $_GET['taskId']!=""){
    //     $taskId = $_GET['taskId'];

    //     $sql = "DELETE FROM task WHERE taskId = $taskId";
    //     $result = mysqli_query($con, $sql);

    //     if($result){
    //         echo json_encode(array("status" => "Data Deleted"));
    //     }
    //     else{
    //         echo json_encode(array("status" => "Delete Failed"));
    //     }
    // }
    // else{
    //     echo json_encode(array("status" => "Invalid Value"));
    //     exit();
    // }

