<?php
    header("Content-Type:application/json");

    include "connection.php";

    $requestMethod = $_SERVER["REQUEST_METHOD"];

    if($requestMethod == "PUT"){
        $inputData = json_decode(file_get_contents("php://input"), true);

        if(empty($inputData)){
            $taskUpdate = updateTask($_POST);
         }
         else{
             $taskUpdate = updateTask($inputData);
         }
         echo $taskUpdate;
    }
    else{
        $data = [
            'status' => 405,
            'message' => $requestMethod. ' Method Not Allowed',
        ];
        header("HTTP/1.0 405 Method Not Allowed");

        echo json_encode( $data, JSON_PRETTY_PRINT);
    }

    function updateTask($taskInput){
        global $con;

        $taskId = mysqli_real_escape_string($con, $taskInput["taskId"]);

        $sql = "SELECT * FROM task WHERE taskId = $taskId";

        $result = mysqli_query($con, $sql);

        if($result){
            if(mysqli_num_rows($result) == 1){

                $name = mysqli_real_escape_string($con, $taskInput["taskName"]);
                $desc = mysqli_real_escape_string($con, $taskInput["taskDesc"]);
                $done = mysqli_real_escape_string($con, $taskInput["done"]);
                $createdDate = date("Y-m-d");

                if($name != "" && $desc != "" && $done != ""){
                    $updateSql = "UPDATE `task` SET `taskName`='$name',`taskDesc`='$desc',`done`='$done', `createdDate`='$createdDate' WHERE `taskId`='$taskId'";

                    $res = mysqli_query($con, $updateSql);
    
                    if($res){
                        $data = [
                            'status' => 200,
                            'message' => 'Task Update Successfully'
                        ];
                        header("HTTP/1.0 200 Updated");
            
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
                    return error422("Enter all field");
                }


            }else{
                $data = [
                    'status' => 404,
                    'message' => 'No Task Found',
                ];
                header("HTTP/1.0 404 Not Found");
        
                echo json_encode( $data, JSON_PRETTY_PRINT );
            }
        }
        else{
            $data = [
                'status' => 500,
                'message' => 'Internal Server Error',
            ];
            header("HTTP/1.0 500 Internal Server Error");
    
            echo json_encode( $data, JSON_PRETTY_PRINT );
        }
    }

        function error422($message){
        $data = [
            'status' => 422,
            'message' => $message,    
        ];
        header('HTTP/1.0 422 Unprocessable Entity');
        echo json_encode( $data, JSON_PRETTY_PRINT);
    }

