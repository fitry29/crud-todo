<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Create Task</title>
</head>
    <body id="body"> 
    <h2>Create Task</h2>
        <div id="inner-body">
            <div id="task">
                <form id="task-form" action = "../index.php">
                    <label for="taskName">Task Name</label>
                    <input type="text" name="taskName" id="taskName" placeholder="Enter task name" required>
                    <label for="taskDesc">Description</label>
                    <input type="text" name="taskDesc" id="taskDesc" placeholder="Enter Description" required>

                    <div id="button">
                        <button type="submit" onclick="createTask()">Create</button>
                    </div>
                    
                </form>
            </div>
            <script src="../script/read.js">
            </script>
            <script src="../script/page.js">
            </script>
        </div>
    </body>


</html>