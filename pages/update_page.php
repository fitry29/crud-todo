<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Update Task</title>
</head>
    <body id="body" onload = "updateFillForm()"> 
        <div id="inner-body">
            <div id="task">
                <h2>Update Task</h2>
                <form id="task-form" action = "../index.html">
                    <div for="taskId-update"></div>
                    <label for="taskName-update">Task Name</label>
                    <input type="text" name="taskName-update" id="taskName-update" placeholder="Enter task name" >
                    <label for="taskDesc-update">Description</label>
                    <input type="text" name="taskDesc-update" id="taskDesc-update" placeholder="Enter Description">
                    <label for="date-update">Date</label>
                    <input type="date" format="yyyy-mm-dd" name="date-update" id="date-update" value="">
                    <div id="check-status">
                        <label for="status-update">Status :</label>
                        <input type="checkbox" name="status-update" id="status-update" placeholder="Enter Description">                        
                    </div>

                    <div id="button">
                        <button type="submit" onclick="updateTask()">Update</button>
                    </div>
                    
                </form>
  
        </div>
    </body>
          </div>
            <script src="../script/read.js">
             
            </script>
            <script src="../script/page.js"></script>
</html>