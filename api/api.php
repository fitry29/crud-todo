<?php
    header("Content-Type:application/json");
    header("Acces-Control-Allow-Origin:*");
    header("Acces-Control-Allow-Method: GET");
    header("Acces-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With");
    
    include('connection.php');

    $requestMethod = $_SERVER["REQUEST_METHOD"];

    if($requestMethod == "GET"){
        //echo $requestMethod;
        if(isset($_GET['taskId'])){

            if($_GET['taskId'] == null){
                echo error422('Enter task Id');
            }

            $taskId = mysqli_real_escape_string($con, $_GET['taskId']);

            $sql = "SELECT * FROM task WHERE taskId = $taskId";

            $result = mysqli_query($con, $sql);

            if($result){

                if(mysqli_num_rows($result) == 1){

                    $res = mysqli_fetch_assoc($result);

                    $data = [
                        'status' => 200,
                        'message' => 'Task fetch successfully',
                        'data' => $res
                        
                    ];
                    header("HTTP/1.0 200 Ok");
            
                    echo json_encode( $data,JSON_PRETTY_PRINT);

                }else{
                    $data = [
                        'status' => 404,
                        'message' => 'No Task Found',
                    ];
                    header("HTTP/1.0 404 Not Found");
            
                    echo json_encode( $data, JSON_PRETTY_PRINT );
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
    }else{
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

    // if(isset($_GET['taskId']) && $_GET['taskId']!=""){
    //     $taskId = $_GET['taskId'];

    //     $result = mysqli_query(
    //         $con, "SELECT * FROM task WHERE taskId = $taskId"
    //     );

    //     if(mysqli_num_rows($result)>0){
    //         $row = mysqli_fetch_array($result);

    //         $taskName = $row['taskName'];
    //         $taskDesc = $row['taskDesc'];
    //         $done = $row['done'];
    //         $createdDate = $row['createdDate'];

    //         response($taskId, $taskName, $taskDesc, $done, $createdDate);
    //         mysqli_close($con);
    //     }else{
    //         echo json_encode(array("status" => "No Data"));
    //         exit();
    //     }
    // }
    // else{
    //     echo json_encode(array("status" => "Invalid Value"));
    //     exit();
    // }

    // function response($taskId, $taskName, $taskDesc, $done, $createdDate){
    //     $response['taskId'] = $taskId;
    //     $response['taskName'] = $taskName;
    //     $response['taskDesc'] = $taskDesc;
    //     $response['done'] = $done;
    //     $response['createdDate'] = $createdDate;

    //     $json_response = json_encode($response);
    //     echo $json_response;
    // }
