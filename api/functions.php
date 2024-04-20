<?php

class Functions{
    public function filterRequest($requestname){
        return htmlspecialchars(strip_tags($_POST[$requestname]));
    }

    public function response($taskId, $taskName, $taskDesc, $done, $createdDate){
        $response['taskId'] = $taskId;
        $response['taskName'] = $taskName;
        $response['taskDesc'] = $taskDesc;
        $response['done'] = $done;
        $response['createdDate'] = $createdDate;

        $json_response = json_encode($response);
        echo $json_response;
    }

    // public function readAll(){
    //     global $con;

    //     $sql = "SELECT * FROM task ORDER BY taskId";
    //     $result = mysqli_query($con, $sql);

    //     if($result){

    //         if(mysqli_num_rows($result)> 0){
    //             $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

    //             $data = [
    //                 'status' => 200,
    //                 'message' => 'Task Fetch Succesfully',
    //                 'data' => $data
    //             ];
    //             header("HTTP/1.0 200 Task Fetch Succesfully");
        
    //             return json_encode( $data,JSON_PRETTY_PRINT);

    //         }else{
    //             $data = [
    //                 'status' => 404,
    //                 'message' => 'No Task Found',
    //             ];
    //             header("HTTP/1.0 404 No Task Found");
        
    //             return json_encode( $data , JSON_PRETTY_PRINT);
    //         }

    //     }else{
    //         $data = [
    //             'status' => 500,
    //             'message' => 'Internal Server Error',
    //         ];
    //         header("HTTP/1.0 500 Internal Server Error");
    
    //         return json_encode( $data, JSON_PRETTY_PRINT );
    //     }
    // }
}

