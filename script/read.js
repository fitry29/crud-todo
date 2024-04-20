// const btn = document.getElementById("button");

// let statusOutput = document.getElementById("doneStatus");

// btn.addEventListener("click", readAll);
// import { goCreate, goHome, goUpdate } from "./page.js";

async function readAll(){
    const res = await fetch("http://localhost/simpleAPI/api/readAll.php");

    const taskData = await res.json();

    const objTask = await taskData;

    console.log(taskData.data[0].taskName);

    let readAllDiv =  ``;
    
    let varStatus = "";

    for($i = 0; $i<taskData.data.length; $i++){
        console.log(taskData.data[$i]);
        let value = taskData.data[$i];

        if(value.done == 1){
            varStatus = "done";
        }
        else{
            varStatus = "Not Done"
        }

        // <tr id = "${value.taskId}" class="task-list" onclick="readListId(this.id);">
        //     <td id="myId" width="10%">${value.taskId}</td>
        //     <td width="15%">${value.taskName}</td>
        //     <td width="30%">${value.taskDesc}</td>
        //     <td width="15%">${value.createdDate}</td>
        //     <td width="15%">${varStatus}</td>
        //     <td width="15%"><input type="button" id = "delete-btn" value="Delete" onclick="deleteTask(${value.taskId})"></td>
        // </tr>

        readAllDiv += `
        <div class="card" id = "${value.taskId}" ondblclick="readListId(this.id);">
            <div class="card-content1">
                <div class = "task-name" id="myId" >#${value.taskId} ${value.taskName}</div>
                <div id = "desc">${value.taskDesc}</div>
            </div>
            <div class="card-content2">
                <div id="date">${value.createdDate}</div>
                <button id = "delete" onclick="deleteTask(${value.taskId})"><i class="fa-solid fa-trash"></i></button>
            </div>
        </div>
        `;
    }
    
    document.getElementById("inner-body").innerHTML = readAllDiv;
}

let taskObj = {}

async function setObj(id, nameObj, desc, date, stat){
    taskObj.id = id;
    taskObj.name = nameObj;
    taskObj.desc = desc;
    taskObj.date = date;
    taskObj.status = stat;
}

async function readListId(tId){
    const res1 = await fetch(`http://localhost/simpleAPI/api/api.php?taskId=${tId}`);

    const taskData1 = await res1.json();
    
    alert(taskData1.data.taskId + " " + taskData1.data.taskName);

    let value = taskData1.data;

    setObj(value.taskId, value.taskName, value.taskDesc, value.createdDate, value.done);

    sessionStorage.setItem("taskObj", JSON.stringify(taskObj));

    alert(taskObj.id, taskObj.name);
    
    window.location.href = "pages/update_page.php";
    // let id = document.getElementById("taskId-update");
    // let name = document.getElementById("taskName-update");
    // let desc = document.getElementById("taskDesc-update");
    // let date = document.getElementById("date-update");
    // let status = document.getElementById("status-update");

    // name.value = taskObj.taskName;
    // desc.value = taskObj.taskDesc;
    // date.value = taskObj.createdDate;
    // id.innerHTML = "Task Id: " + id;
    
    // if(taskObj.done == 1){
    //     status.checked;
    // }
}

function updateFillForm(){
    taskObj = JSON.parse(sessionStorage.getItem("taskObj"));

    console.log(taskObj)

    let id = taskObj.id;
    let name = taskObj.name;
    let desc = taskObj.desc;
    let cDate = taskObj.date;
    let status = taskObj.status;

    //document.getElementById("taskId-update").innerHTML = "Task Id: " + id;
    document.getElementById("taskName-update").value = name;
    document.getElementById("taskDesc-update").value = desc;
    document.getElementById("date-update").value = cDate;
    
    if(taskObj.status == 1){
        document.getElementById("status-update").checked = "yes";
        document.getElementById("status-update").value = "1";
    }
}


async function readId(){
    let taskId = document.getElementById("taskId").value;

    if(taskId == ""){
        readAll();
    }
    else{
        const res1 = await fetch(`http://localhost/simpleAPI/api/api.php?taskId=${taskId}`);

        const taskData1 = await res1.json();

        console.log(taskData1.data);

        let readAllDiv =  `
        <tr>
            <th>Task Id</th>
            <th>Title</th>
            <th>Description</th>
            <th>Date</th>
            <th>Status</th>
            <th>Delete</th>
            
        </tr>
        `;
        
        let varStatus = "";
        let value = taskData1.data;
            
        if(value.done == 1){
            varStatus = "done";
        }
        else{
            varStatus = "Not Done"
        }

        readAllDiv += `
            <tr>
                <td>${value.taskId}</td>
                <td>${value.taskName}</td>
                <td>${value.taskDesc}</td>
                <td>${value.createdDate}</td>
                <td>${varStatus}</td>
                <td><input type="button" id = "delete-btn" value="Delete" onclick="deleteTask(${value.taskId})"></td>
            </tr>
            `;
        
        document.getElementById("read-all-list").innerHTML = readAllDiv;

        // let readOnly = 
        // `
        // <ul>
        //     <li> Task Id : ${taskData1.data.taskId} </li>
        //     <li> Task Name : ${taskData1.data.taskName} </li>
        //     <li> Task Description : ${taskData1.data.taskDesc} </li>
        //     <li> Task Status : ${taskData1.data.done} </li>
        //     <li> Task Date : ${taskData1.data.createdDate} </li>
        // </ul>
        // `
        // document.getElementById("read-id").innerHTML = readOnly;
    }


}

async function createTask(){
    let name = document.getElementById("taskName").value;
    let desc = document.getElementById("taskDesc").value;

    console.log(name + " " + desc);

    const createData = {
        taskName: name,
        taskDesc: desc,
        done: 0
    }

    const responseCreate = await fetch(`http://localhost/simpleAPI/api/create.php`,{
        method: "POST",
        headers: {
            'Accept': 'application/json',       // receive json
            'Content-Type': 'application/json'  
        },
        body: JSON.stringify(createData)
    });

    const createdTask = await responseCreate.json();

    console.log(createdTask);

    window.location.href = "../index.php";
}

// const updateForm  = document.getElementById('update-task-form');

// updateForm.addEventListener('submit', updateTask);


async function updateTask(){
    taskObj = JSON.parse(sessionStorage.getItem("taskObj"));

    let taskId = taskObj.id;
    let name = document.getElementById("taskName-update").value;
    let desc = document.getElementById("taskDesc-update").value;
    let done = document.getElementById("status-update");

    let stat = 0;
   
    if(done.checked == true){
           stat = 1;
        }else{
            stat = 0;
        }

    console.log(name + " " + desc + " " + taskId + " " + stat);

    const updateData = {
        taskId: taskId,
        taskName: name,
        taskDesc: desc,
        done: stat
    }

    alert(JSON.stringify(updateData));

    const responseUpdate = await fetch(`http://localhost/simpleAPI/api/update.php`,{
        method: "PUT",
        headers: {
            'Accept': 'application/json',       // receive json
            'Content-Type': 'application/json'  
        },
        body: JSON.stringify(updateData)
    });

    const updateTask = await responseUpdate.json();

    console.log(updateTask);
}

// const deleteForm = document.getElementById("delete-task");
// deleteForm.addEventListener('submit', deleteTask);

async function deleteTask(idTask){
    let deleteId = idTask;

    alert(deleteId);
    // fetch(`http://localhost/simpleAPI/api/delete.php?taskId=${taskId}`, {
    //     method: 'DELETE',
    // })
    // .then(res => res.text()) // or res.json()
    // .then(res => console.log(res))


    console.log(deleteId);

    const $deleteIdData = {
        taskId: deleteId
    }

    const resDel = await fetch(`http://localhost/simpleAPI/api/delete.php`,{
        method: "Delete",
        headers: {
            'Accept': 'application/json',       // receive json
            'Content-Type': 'application/json'  
        },
        body: JSON.stringify($deleteIdData )
    });

    const deletedData = await resDel.json();

    console.log(deletedData);

    location.reload();

}
