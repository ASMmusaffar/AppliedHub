let edit = document.querySelector('.edit')
let mark = document.querySelector('.mark')
let add = document.querySelector('.add')
let addnew = document.querySelector('.addnew')
let studentImagePreview = document.querySelector('.studentimagepreview')
let staffImagePreview = document.querySelector('.staffimagepreview')
let imageSet = document.querySelector('.imageSet')
let form = document.querySelectorAll('.profileContainer form div input')
let select = document.querySelectorAll('.profileContainer form div select')
let notifyCount =1;




// ---------------------------------------------------------------------------------
// -------------------------------------------------------------Login & Logout------
// ---------------------------------------------------------------------------------

function loginUser(){
    let id = document.getElementById('id').value.trim();
    let pass = document.getElementById('pass').value.trim();
    let idAlert = document.querySelector('.id span');
    let passAlert = document.querySelector('.pass span');

    let isValid = true;

    if (id === "") {
        idAlert.textContent = "ID cannot be empty";
        isValid = false;
    }
    if (pass === "") {
        passAlert.textContent = "Password cannot be empty";
        isValid = false;
    }

    if (isValid) {
        localStorage.setItem('auth','1')
        notification('Login Successfully')
        window.location.href = "dashboard.php"
    }
}


function logout(){
    localStorage.removeItem('auth')
    window.location.href = "index.php"
    notification('Logout Successfully')
}


// ---------------------------------------------------------------------------------
// -------------------------------------------------------------Batch Functions---
// ---------------------------------------------------------------------------------

function addNewBatch() {
    let batch = document.getElementById('batch').value.trim();
    let department = document.getElementById('department').value.trim();
    let commenced = document.getElementById('commenced').value.trim();

    let batchAlert = document.querySelector('.batch span');
    let departmentAlert = document.querySelector('.department span');
    let commencedAlert = document.querySelector('.commenced span');

    batchAlert.textContent = "";
    departmentAlert.textContent = "";
    commencedAlert.textContent = "";

    let isValid = true;

    
    if (batch === "") {
        batchAlert.textContent = "Batch cannot be empty";
        isValid = false;
    } 
    if (department === "") {
        departmentAlert.textContent = "Department cannot be empty";
        isValid = false;
    }
    if (commenced === "") {
        commencedAlert.textContent = "Commencement date cannot be empty";
        isValid = false;
    }

    if (isValid) {
        notification('New Batch Added Successfully')
        hideContainer('.addNewBatchCon')
    }
}

// ---------------------------------------------------------------------------------
// -------------------------------------------------------------Student Functions---
// ---------------------------------------------------------------------------------

function studentProfile(){
    const urlParams = new URLSearchParams(window.location.search);
    const regValue = urlParams.get('reg');
    

    if (!regValue) {
        addNewStudentProfile()
    } else {
        dissableStudentProfile()
    }
}

function dissableStudentProfile(){
    edit.classList.remove('hide')
    mark.classList.add('hide')
    add.classList.add('hide')
    addnew.classList.remove('hide')
    imageSet.style.display='none'
    form.forEach(form=>{
        form.disabled='true'
    })
    select.forEach(select=>{
        select.disabled='true'
    })
}

function editStudentProfile(){
    edit.classList.add('hide')
    mark.classList.remove('hide')
    add.classList.remove('hide')
    addnew.classList.add('hide')
    imageSet.style.display='flex'
    studentImagePreview.classList.add('hide')
    form.forEach(form=>{
        form.removeAttribute('disabled')  
    })
    select.forEach(select=>{
        select.removeAttribute('disabled')  
    })
    
}

function addStudentProfile(){

    let sName = document.getElementById('name').value;
    let sRegno = document.getElementById('regno').value;
    let sDepartment = document.getElementById('department').value;
    let sBatch = document.getElementById('batch').value;
    let sContact = document.getElementById('contact').value;
    let sMail = document.getElementById('mail').value;

    document.querySelector('.contact span').textContent = "";
    document.querySelector('.batch span').textContent = "";
    document.querySelector('.name span').textContent = "";
    document.querySelector('.regno span').textContent = "";
    document.querySelector('.department span').textContent = "";
    document.querySelector('.mail span').textContent = "";
    
    let isValid = true;

    
    if (sName === "") {
        document.querySelector('.name span').textContent = "Name cannot be empty";
        isValid = false;
    } 
    if (sRegno === "") {
        document.querySelector('.regno span').textContent = "Reg Number cannot be empty";
        isValid = false;
    }
    if (sDepartment === "") {
        document.querySelector('.department span').textContent = "Department cannot be empty";
        isValid = false;
    }
    if (sBatch === "") {
        document.querySelector('.batch span').textContent = "Batch cannot be empty";
        isValid = false;
    }
    if (sContact === "") {
        document.querySelector('.contact span').textContent = "Contact cannot be empty";
        isValid = false;
    }
    if (sMail === "") {
        document.querySelector('.mail span').textContent = "Mail cannot be empty";
        isValid = false;
    }

    if (isValid) {
        
        notification('Student details added or updated successfully')
        edit.classList.remove('hide')
        mark.classList.add('hide')
        add.classList.add('hide')
        addnew.classList.remove('hide')
        imageSet.style.display='none'
        studentImagePreview.classList.remove('hide')
        form.forEach(form=>{
            form.disabled='true'
        })
        select.forEach(select=>{
            select.disabled='true'
        })
    }


    
}

function addNewStudentProfile(){
    document.getElementById('name').value='';
    document.getElementById('regno').value='';
    document.getElementById('department').value='';
    document.getElementById('batch').value='';
    document.getElementById('contact').value='';
    document.getElementById('mail').value='';

    editStudentProfile()
    notification('You can add new student details')
}



// ---------------------------------------------------------------------------------
// -------------------------------------------------------------Staff Functions---
// ---------------------------------------------------------------------------------

function staffProfile(){
    const urlParams = new URLSearchParams(window.location.search);
    const regValue = urlParams.get('reg');
    

    if (!regValue) {
        addNewStaffProfile()
    } else {
        dissableStaffProfile()
    }
}

function dissableStaffProfile(){
    edit.classList.remove('hide')
    mark.classList.add('hide')
    add.classList.add('hide')
    addnew.classList.remove('hide')
    form.forEach(form=>{
        form.disabled='true'
    })
    select.forEach(select=>{
        select.disabled='true'
    })
}

function editStaffProfile(){
    edit.classList.add('hide')
    mark.classList.remove('hide')
    add.classList.remove('hide')
    addnew.classList.add('hide')
    imageSet.style.display='flex'
    staffImagePreview.classList.add('hide')
    form.forEach(form=>{
        form.removeAttribute('disabled')  
    })
    select.forEach(select=>{
        select.removeAttribute('disabled')  
    })
    
}

function addStaffProfile(){

    let sName = document.getElementById('name').value;
    let sRegno = document.getElementById('regno').value;
    let sDepartment = document.getElementById('department').value;
    let sType = document.getElementById('type').value;
    let sContact = document.getElementById('contact').value;
    let sMail = document.getElementById('mail').value;

    document.querySelector('.contact span').textContent = "";
    document.querySelector('.type span').textContent = "";
    document.querySelector('.name span').textContent = "";
    document.querySelector('.regno span').textContent = "";
    document.querySelector('.department span').textContent = "";
    document.querySelector('.mail span').textContent = "";
    
    let isValid = true;

    
    if (sName === "") {
        document.querySelector('.name span').textContent = "Name cannot be empty";
        isValid = false;
    } 
    if (sRegno === "") {
        document.querySelector('.regno span').textContent = "Reg Number cannot be empty";
        isValid = false;
    }
    if (sDepartment === "") {
        document.querySelector('.department span').textContent = "Department cannot be empty";
        isValid = false;
    }
    if (sType === "") {
        document.querySelector('.type span').textContent = "Type cannot be empty";
        isValid = false;
    }
    if (sContact === "") {
        document.querySelector('.contact span').textContent = "Contact cannot be empty";
        isValid = false;
    }
    if (sMail === "") {
        document.querySelector('.mail span').textContent = "Mail cannot be empty";
        isValid = false;
    }

    if (isValid) {
        
        notification('Staff details added or updated successfully')
        edit.classList.remove('hide')
        mark.classList.add('hide')
        add.classList.add('hide')
        addnew.classList.remove('hide')
        imageSet.style.display='none'
        staffImagePreview.classList.remove('hide')
        form.forEach(form=>{
            form.disabled='true'
        })
        select.forEach(select=>{
            select.disabled='true'
        })
    }
}

function addNewStaffProfile(){
    document.getElementById('name').value='';
    document.getElementById('regno').value='';
    document.getElementById('department').value='';
    document.getElementById('type').value='';
    document.getElementById('contact').value='';
    document.getElementById('mail').value='';

    editStaffProfile()
    mark.classList.add('hide')
    notification('You can add new staff details')
}


// ---------------------------------------------------------------------------------
// -------------------------------------------------------------Dep Functions-------
// ---------------------------------------------------------------------------------
function addDep(){

    let sDepartment = document.getElementById('department').value;

    document.querySelector('.department span').textContent = "";
    
    if (sDepartment === "") {
        document.querySelector('.department span').textContent = "Department cannot be empty";
    }else{
        notification('New Department added successfully')
    }
}




// ---------------------------------------------------------------------------------
// -------------------------------------------------------------Notification-------
// ---------------------------------------------------------------------------------


function notification(content){
    let notify = document.createElement('div')
    let notifyContent = document.createElement('p')
    notify.classList.add('notification',`notification${notifyCount}`)
    notifyContent.innerHTML=content;
    document.querySelector('.notificationCon').appendChild(notify)
    notify.appendChild(notifyContent)
    setTimeout(notificationAdd, 5000,`notification${notifyCount}`);
}

function notificationAdd(count){
    document.querySelectorAll(`.${count}`).forEach(close=>{
        close.classList.add('hide')
    })
    notifyCount++
}

