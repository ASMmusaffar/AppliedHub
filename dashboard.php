<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style.css?v=1.32">
    <!-- i am Using BoxIcons for get icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>AppliedHub | Dashboard</title>
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
                <a href="./dashboard.php" class="active"><i class='bx bxs-dashboard'></i> Dashboard</a>
                <a href="./profilestudent.php?reg="><i class='bx bxs-user-badge'></i> Student Profile</a>
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
            <h2>Welcome</h2>
            <span class="currentTime">Last refresh at </span>

            <div class="cardContainer">
                <div class="card">
                    <div class="cardDetails">
                        <h3>Departments</h3>
                        <p class="ongoingDep">4 <span>/ongoing</span></p>
                    </div>
                    <div class="cardIcon">
                        <i class='bx bx-sitemap icon-primary'></i>
                    </div>
                </div>
                <div class="card">
                    <div class="cardDetails">
                        <h3>Batches</h3>
                        <p class="ongoingBatch">5 <span>/ongoing</span></p>
                    </div>
                    <div class="cardIcon">
                        <i class='bx bxs-vector icon-primary'></i>
                    </div>
                </div>
                <div class="card">
                    <div class="cardDetails">
                        <h3>Lecturers</h3>
                        <p class="activeLec">18 <span>/active</span></p>
                    </div>
                    <div class="cardIcon">
                        <i class='bx bxs-user-detail icon-primary'></i>
                    </div>
                </div>
                <div class="card">
                    <div class="cardDetails">
                        <h3>Academic Staffs</h3>
                        <p class="activeStf">22 <span>/active</span></p>
                    </div>
                    <div class="cardIcon">
                        <i class='bx bxs-book-open icon-primary'></i>
                    </div>
                </div>
                <div class="card">
                    <div class="cardDetails">
                        <h3>Non Academic Staffs</h3>
                        <p class="activeStfN">15 <span>/active</span></p>
                    </div>
                    <div class="cardIcon">
                        <i class='bx bxs-business icon-primary'></i>
                    </div>
                </div>
                <div class="card">
                    <div class="cardDetails">
                        <h3>Students</h3>
                        <p class="activeStd">409 <span>/active</span></p>
                    </div>
                    <div class="cardIcon">
                        <i class='bx bxs-graduation icon-primary'></i>
                    </div>
                </div>
            </div>
<?PHP
    require_once 'conn.php';

    $sql = "SELECT COUNT(*) AS active_count FROM students WHERE ststatus = '1'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $activeStd = $row['active_count'];
        echo "<script>document.querySelector('.activeStd').innerHTML=`".$activeStd."<span>/active</span>`</script>";
    }

    $sql = "SELECT COUNT(*) AS dep FROM students";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $dep = $row['dep'];
        echo "<script>document.querySelector('.ongoingDep').innerHTML=`".$dep." <span>/ongoing</span>`</script>";
    }

    $sql = "SELECT COUNT(*) AS bat FROM batchs";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $bat = $row['bat'];
        echo "<script>document.querySelector('.ongoingBatch').innerHTML=`".$bat." <span>/ongoing</span>`</script>";
    }

    $sql = "SELECT COUNT(*) AS active_lec FROM staffs WHERE sfstatus = '1' AND (sftype = 'Permenent Lecture' OR sftype = 'Temporary Lecture')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $active_lec = $row['active_lec'];
        echo "<script>document.querySelector('.activeLec').innerHTML=`".$active_lec." <span>/active</span>`</script>";
    }

    $sql = "SELECT COUNT(*) AS active_stf FROM staffs WHERE sfstatus = '1' AND sftype = 'Academical Staff' ";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $active_stf = $row['active_stf'];
        echo "<script>document.querySelector('.activeStf').innerHTML=`".$active_stf." <span>/active</span>`</script>";
    }

    $sql = "SELECT COUNT(*) AS active_stfN FROM staffs WHERE sfstatus = '1' AND sftype = 'Non Academical Staff'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $active_stfN = $row['active_stfN'];
        echo "<script>document.querySelector('.activeStfN').innerHTML=`".$active_stfN." <span>/active</span>`</script>";
    }

?>
            <div class="tableCon">
                <table>
                    <tr>
                        <th colspan="4">
                            <span class="primary">Running batch details</span>
                            <button class="bg-primary" onclick="showContainer('.addNewBatchCon')"><i class='bx bxs-user-plus' ></i> Add New Batch</button>
                        </th>
                    </tr>
                    <tr>
                        <th>Batch</th>
                        <th>Department</th>
                        <th>Commenced</th>
                    </tr>
                    <?PHP
require_once 'conn.php';
$sql = "SELECT * FROM batchs";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
?>
                    <tr>
                        <td><?=htmlspecialchars($row['bname'])?></td>
                        <td><?=htmlspecialchars($row['bdep'])?></td>
                        <td><?=htmlspecialchars($row['bcommenced'])?></td>
                    </tr>
<?PHP
    }
} else {
    echo '<tr>
            <td colspan="3" style="display:flex; justify-content:center; padding:30px 0">
                <span style=" font-size: medium; text-align:center">No Results Found</span>
            </td>
        </tr>';
}
?>
                </table>
            </div>
        </main>
    </div>

    <!-- ----------------------------------addNewBatch -->
    <div class="addNewBatchCon hide">
        <div class="addNewBatch hide b-l-primary">
            <form action="engine.php" method="post">
                <label for="batch" class="batch">Batch Year: <span></span></label>
                <input type="text" id="batch" name="batch">
                <br>
                <label for="department" class="department">Department: <span></span></label>
                <select id="department" name="department">
                    <option value="">Select</option>
<?php
            $sql_dep = "SELECT depname FROM departments";
            $result_dep = mysqli_query($conn, $sql_dep);

            if (mysqli_num_rows($result_dep) > 0) {
                while ($row = mysqli_fetch_assoc($result_dep)) {
                    echo "<option value='" .$row['depname']. "'>" . $row['depname'] . "</option>";
                }
            }else{
                echo "<option value=''>No Option Available</option>";
            }
?>
                </select>
                <br>
                <label for="commenced" class="commenced">Commenced On: <span></span></label>
                <input type="date" id="commenced" name="commenced">
                <br>
                <div class="btn-grp">
                    <button type="button" onclick="hideContainer('.addNewBatchCon')" style="background:red;color:#fff">Cancel</button>
                    <button type="submit" name="add_batch" class="bg-primary" id="submitButton" disabled>Add Batch</button>
                </div>
            </form>
        </div>
    </div>

    <div class="notificationCon"></div>
    <script>
        const inputs = document.querySelectorAll('input');
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
</body>
</html>