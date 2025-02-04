<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style.css?v=1.32">
    <!-- i am Using BoxIcons for get icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>AppliedHub | Student Profile</title>
</head>
<body>
    <!-------------------------- overlay & colorSelection -->
    <div class="overlay hide"></div>
    <div class="selectThemeCon">
        <div class="selectThemeBox b-l-primary">
            <div class="c3b82f6" onclick="colorSelection('#3b82f6')"></div>
            <div class="c128a07" onclick="colorSelection('#128a07')"></div>
            <div class="c6a82f6" onclick="colorSelection('#6a82f6')"></div>
            <div class="cc36af6" onclick="colorSelection('#c36af6')"></div>
            <div class="ce6b400" onclick="colorSelection('#e6b400')"></div>
        </div>
    </div>


    <!-- ---------------------------mainStructure -->
    <div class="container">
        <aside class="sidebar bg-primary">
            <h2 class="sidebarLogoName">AppliedHub</h2>
            <div class="sidebarLinks">
                <a href="./dashboard.php"><i class='bx bxs-dashboard'></i> Dashboard</a>
                <a href="./profilestudent.php?reg=" class="active"><i class='bx bxs-user-badge'></i> Student Profile</a>
                <a href="./detailsstudent.php"><i class='bx bxs-book-reader'></i> Student Details</a>
                <a href="./profilestaff.php?reg="><i class='bx bxs-user-circle'></i> Staff Profile</a>
                <a href="./detailsstaff.php"><i class='bx bxs-user-detail'></i> Staff Details</a>
                <a href="./detailsdep.php"><i class='bx bxs-server'></i> Department Details</a>
                <hr>
                <button onclick="changeThemeModel()"><i class='bx bx-color-fill'></i> Change Theme</button>
                <button onclick="logout()" class="logout"><i class='bx bx-exit' ></i> Logout</button>
            </div>
        </aside>
    
        <!---------------------------------- mainContent -->
        <main class="content">
            <div class="navbar bg-primary">
                <div class="logoSet">
                    <img src="sources/menu.svg" id="sidebarButton" alt="menuOption">
                    <h2 class="hide logo">AppliedHub</h2>
                </div>
                <div class="profileSet">
                <div class="profile">
                        <img src="staffs/staff.jpg" alt="Profile">
                        <span>System Admin</span>
                    </div>
                     <img src="sources/moon.svg" id="changeTheme" alt="changeTheme">
                </div>
            </div>
            <h2>AppliedHub | Student Profile</h2>
            <span class="currentTime">Last refresh at </span>

            <div class="profileSearchContainer">
                <form class="searchBox" action="profilestudent.php" method="get"><input type="text" placeholder="Search Reg Number" class="b-primary" name="reg"><button type="submit" class="bg-primary b-primary">Search</button></form>
            </div>
            
            <div class="profileContainer">
                <form action="engine.php" method="post" class="profileContainerForm" enctype="multipart/form-data">
<?PHP
require_once 'conn.php';

$targetStudent = $_GET['reg'];
$target=false;
$sql="SELECT * FROM students WHERE streg='$targetStudent'";
$run=mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($run)){
    $name=$row['stname'];
    $reg=$row['streg'];
    $batch=$row['stbatch'];
    $department=$row['stdep'];
    $contact=$row['stcontact'];
    $mail=$row['stmail'];
    $status=$row['ststatus'];
    $img=$row['stimg'];

    if (mysqli_num_rows($run) > 0 ){
        $target=true;
        
    }
    else{
        echo "
        <script>
        document.querySelector('.profileContainerForm').classList.add('hide');
        const alert = document.createElement('div');
        alert.style.display = 'flex';
        alert.style.flexDirection = 'Column';
        alert.style.alignItems = 'center';
        alert.style.justifyContent = 'center';
        alert.innerHTML=`
                <p style='font-size:20px'>Registration Number $targetStudent Is Not Found!</p>
                <button onclick='createNew()' class='bg-primary' style='margin-bottom:20px;padding:10px;text-decoration:none; border-radius:12px; color:#000;'><i class='bx bxs-user-plus'></i> Add New Student</button>
        `;
        document.querySelector('.profileContainer').appendChild(alert);
        function createNew(){
            document.querySelector('.profileContainerForm').classList.remove('hide');
            alert.style.display = 'none';
            addNewStudentProfile()
        }
    </script>";
    }

}

if (mysqli_num_rows($run) > 0 ){
    $target=true;
    
}
else{
    echo "
    <script>
        document.querySelector('.profileContainerForm').classList.add('hide');
        const alert = document.createElement('div');
        alert.style.display = 'flex';
        alert.style.flexDirection = 'Column';
        alert.style.alignItems = 'center';
        alert.style.justifyContent = 'center';
        alert.innerHTML=`
                <p style='font-size:20px'>Registration Number $targetStudent Is Not Found!</p>
                <button onclick='createNew()' class='bg-primary' style='margin-bottom:20px;padding:10px;text-decoration:none; border-radius:12px; color:#000;'><i class='bx bxs-user-plus'></i> Add New Student</button>
        `;
        document.querySelector('.profileContainer').appendChild(alert);
        function createNew(){
            document.querySelector('.profileContainerForm').classList.remove('hide');
            alert.style.display = 'none';
            addNewStudentProfile()
        }
    </script>";
}

?>
                    <div class="imageSet">
                        <label for="image">Image <span></span></label>
                        <input type="file" accept="image/*" name="uploadfile" value="<?=$target?$img:''?>">
                    </div>
                    <div class="imageSetPreview">
                        <img class="studentimagepreview" src="students/<?=$target?$img:''?>" alt="studentName">
                    </div>
                    <?=($target?(($status==0)?'<div class="nameSet"><label style="color:red;">THIS STUDENT IS DROPPED OUT<span></span></label></div>':''):'')?>
                    <div class="nameSet">
                        <label for="name" class="name">Student Name: <span></span></label>
                        <input type="text" name="name" id="name" value="<?= $target?$name:'';?>" disabled>
                    </div>
                    <div class="regno">
                        <label for="regno" class="regno">Student Reg No: <span></span></label>
                        <input type="text" name="regno" id="regno" value="<?= $target?$reg:'';?>" disabled>
                    </div>
                    <div class="department">
                        <label for="department" class="department">Department: <span></span></label>
                        <select name="department" id="department" disabled>
<?php
            $sql_dep = "SELECT depname FROM departments";
            $result_dep = mysqli_query($conn, $sql_dep);

            if (mysqli_num_rows($result_dep) > 0) {
                while ($row = mysqli_fetch_assoc($result_dep)) {
                    $selected = $target?($department==$row['depname'] ? 'selected' : ''):'';
                    echo "<option value='" . $row['depname'] . "' $selected>" . $row['depname'] . "</option>";
                }
            }else{
                echo "<option value=''>No Option Available</option>";
            }
?>
                        </select>
                    </div>
                    <div class="batch">
                        <label for="batch" class="batch">Batch: <span></span></label>
                        <select name="batch" id="batch" disabled>
<?php
            $sql_dep = "SELECT bname FROM batchs";
            $result_dep = mysqli_query($conn, $sql_dep);

            if (mysqli_num_rows($result_dep) > 0) {
                while ($row = mysqli_fetch_assoc($result_dep)) {
                    $selected = $target?($batch==$row['bname'] ? 'selected' : ''):'';
                    echo "<option value='" . $row['bname'] . "' $selected>" . $row['bname'] . "</option>";
                }
            }else{
                echo "<option value=''>No Option Available</option>";
            }
?>
                        </select>
                    </div>
                    <div class="contact">
                        <label for="contact" class="contact">Contact No: <span></span></label>
                        <input type="text" name="contact" id="contact" value="<?= $target?$contact:'';?>" disabled>
                    </div>
                    <div class="mail">
                        <label for="mail" class="mail">Mail Address: <span></span></label>
                        <input type="email" name="mail" id="mail" value="<?= $target?$mail:'';?>" disabled>
                    </div>
                    <section class="formButtonSet">
                        <button type="button" class="edit" onclick="editStudentProfile()" style="background: var(--black);color:var(--white)"><i class='bx bxs-pencil'></i> Edit Student</button>
                        <button name="drop_student" type="submit" class="mark" style="background:red;<?=$target?($status==0?'display:none;':''):''?>"><i class='bx bxs-user-x'></i> Mark As Dropdown</button>
                        <button name="add_student" type="submit" class="add bg-primary"  id="submitButton" disabled><i class='bx bxs-user-check'></i> Add or Update Student</button>
                        <button type="button" class="addnew bg-primary" onclick="addNewStudentProfile()"><i class='bx bxs-user-plus'></i> Add New Student</button>
                    </section>
                </form>
            </div>
            
        </main>
    </div>

    <div class="notificationCon"></div>

    <script>
        const inputs = document.querySelectorAll('.profileContainerForm input');
        const submitButton = document.getElementById('submitButton');

        function checkInputs() {
            let allFilled = true;
            inputs.forEach(input => {
                if (input.value.trim() === '') {
                    allFilled = false;
                }
            });
            submitButton.disabled = !allFilled;
        }

        inputs.forEach(input => input.addEventListener('input', checkInputs));
    </script>
    <script src="scripts/form.js?v=1.3"></script>
    <script src="scripts/main.js"></script>
    <script>
        studentProfile()
    </script>
</body>
</html>