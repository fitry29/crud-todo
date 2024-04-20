<?php
    header("Content-Type:application/json");
    header("Acces-Control-Allow-Origin:*");
    header("Acces-Control-Allow-Method: GET");
    header("Acces-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With");

    require "connection.php";
    // require_once('functions.php');

    $requestMethod = $_SERVER["REQUEST_METHOD"];
    // $myFunc = new Functions();

    if($requestMethod  == "GET"){

        // $taskList = $myFunc -> readAll();
        // echo $taskList;

        $sql = "SELECT * FROM task ORDER BY taskId";
        $result = mysqli_query($con, $sql);

        if($result){

            if(mysqli_num_rows($result)> 0){
                $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

                $data = [
                    'status' => 200,
                    'message' => 'Task Fetch Succesfully',
                    'data' => $data
                ];
                header("HTTP/1.0 200 Task Fetch Succesfully");
        
                echo json_encode( $data,JSON_PRETTY_PRINT);

            }else{
                $data = [
                    'status' => 404,
                    'message' => 'No Task Found',
                ];
                header("HTTP/1.0 404 No Task Found");
        
                echo json_encode( $data , JSON_PRETTY_PRINT);
            }

        }else{
            $data = [
                'status' => 500,
                'message' => 'Internal Server Error',
            ];
            header("HTTP/1.0 500 Internal Server Error");
    
            echo json_encode( $data, JSON_PRETTY_PRINT );
        }
        
    }
    else{
        $data = [
            'status' => 405,
            'message' => $requestMethod. ' Method Not Allowed',
        ];
        header("HTTP/1.0 405 Method Not Allowed");

        echo json_encode( $data, JSON_PRETTY_PRINT);
    }


