<?PHP
require_once 'conn.php';
$count=0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style.css?v=1.32">
    <!-- i am Using BoxIcons for get icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>AppliedHub | Staff Details</title>
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
                <a href="./profilestudent.php?reg=" ><i class='bx bxs-user-badge'></i> Student Profile</a>
                <a href="./detailsstudent.php" ><i class='bx bxs-book-reader'></i> Student Details</a>
                <a href="./profilestaff.php?reg=" ><i class='bx bxs-user-circle'></i> Staff Profile</a>
                <a href="./detailsstaff.php" class="active"><i class='bx bxs-user-detail'></i> Staff Details</a>
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
            <h2>AppliedHub | Staff Details</h2>
            <span class="currentTime">Last refresh at </span>

            <div class="profileSearchContainerSet">
                <form class="searchSet" action="" method="get" style="align-items: end;">
                    <div>
                        <label for="department">Select Department</label><br>
                        <select name="department" id="department">
                            <option value="">Select</option>
<?php
            // Fetch unique departments from the students table
            $sql_dep = "SELECT DISTINCT sfdep FROM staffs";
            $result_dep = mysqli_query($conn, $sql_dep);

            if (mysqli_num_rows($result_dep) > 0) {
                while ($row = mysqli_fetch_assoc($result_dep)) {
                    $selected = (isset($_GET['sfdep']) && $_GET['sfdep'] == $row['sfdep']) ? 'selected' : '';
                    echo "<option value='" . $row['sfdep'] . "' $selected>" . $row['sfdep'] . "</option>";
                }
            }
?>
                        </select>
                    </div>
                    <div>
                        <label for="type">Select Type</label><br>
                        <select name="type" id="type">
                            <option value="">Select</option>
<?php
    // Fetch unique batches from the students table
    $sql_batch = "SELECT DISTINCT sftype FROM staffs";
    $result_batch = mysqli_query($conn, $sql_batch);

    if (mysqli_num_rows($result_batch) > 0) {
        while ($row = mysqli_fetch_assoc($result_batch)) {
            $selected = (isset($_GET['sftype']) && $_GET['sftype'] == $row['sftype']) ? 'selected' : '';
            echo "<option value='" . $row['sftype'] . "' $selected>" . $row['sftype'] . "</option>";
        }
    }
?>
                        </select>
                    </div>
                    <button type="submit" style="padding:8px 25px; border:1px solid; border-radius:8px; cursor:pointer" class="bg-primary">
                        Search
                    </button>
                </form>
                <a href="profilestaff.php?reg" class="bg-primary"><i class='bx bxs-user-plus' ></i> Add New Staff</a>
            </div>
            
            <div class="tableCon">
                <table>
                    <tr>
                        <th colspan="6" style="position: relative;">
                            <span class="primary count" style="float: right; border-bottom: 1px; font-size: medium;"></span>
                        </th>
                    </tr>
                    <tr>
                        <th>Reg No</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
<?PHP

$option1 = isset($_GET['department']) ? $_GET['department'] : '';
$option2 = isset($_GET['type']) ? $_GET['type'] : '';

// Build the SQL query based on the selected options
$sql = "SELECT * FROM staffs";
$conditions = [];

if (!empty($option1)) {
    $conditions[] = "sfdep = '$option1'";
}

if (!empty($option2)) {
    $conditions[] = "sftype = '$option2'";
}

if (count($conditions) > 0) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
}

$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
?>
                    <tr>
                        <td><?=$row['sfreg']?></td>
                        <td><?=$row['sfname']?></td>
                        <td><?=$row['sfdep']?></td>
                        <td><?=$row['sftype']?></td>
                        <td <?=$row['sfstatus']==0?'style="color: red;"':''?>><?=$row['sfstatus']==0?'Dropped Out':'Active'?></td>
                        <td><a href="profilestaff.php?reg=<?=$row['sfreg']?>" class="hover-bg-primary"><i class='bx bx-link-external'></i> View</a></td>
                    </tr>
<?PHP
        $count++;
    }
} else {
    echo '<tr>
            <th colspan="6" style="position: relative; padding:30px 0">
                <span style="border-bottom: 1px; font-size: medium;">No Results Found</span>
            </th>
        </tr>';
    // echo "<script>
    //     document.querySelector('.tableCon').style.display='none';
    // </script>";
}
echo '<script>document.querySelector(".count").innerHTML="'.$count.' Staff(s) Found"</script>';
?>
                </table>
            </div>
            
        </main>
    </div>

    <div class="notificationCon"></div>

    <script src="scripts/form.js?v=1.3"></script>
    <script src="scripts/main.js"></script>
</body>
</html>