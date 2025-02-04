<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style.css?v=1.32">
    <!-- i am Using BoxIcons for get icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>AppliedHub | Department</title>
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
                <a href="./dashboard.php" ><i class='bx bxs-dashboard'></i> Dashboard</a>
                <a href="./profilestudent.php?reg="><i class='bx bxs-user-badge'></i> Student Profile</a>
                <a href="./detailsstudent.php"><i class='bx bxs-book-reader'></i> Student Details</a>
                <a href="./profilestaff.php?reg="><i class='bx bxs-user-circle'></i> Staff Profile</a>
                <a href="./detailsstaff.php"><i class='bx bxs-user-detail'></i> Staff Details</a>
                <a href="./detailsdep.php" class="active"><i class='bx bxs-server'></i> Department Details</a>
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
            <h2>AppliedHub | Department Details</h2>
            <span class="currentTime">Last refresh at </span>

            <div style="width: 100%; display: flex; align-items: last baseline; justify-content: start; gap: 20px; margin-top: 50px;">
                <form class="searchSet" action="engine.php" method="post" style="display: flex; align-items:end; gap:20px">
                    <div>
                        <label for="department" class="department" style="display: inline-block;">New Department Name:<span></span></label><br>
                        <input type="text" name="department" id="department" style="padding: 8px; border-radius: 8px; border: 1px solid;">
                    </div>
                    <button name="add_dep" type="submit"  id="submitButton" disabled style="padding: 10px; border: 1px solid; border-radius: 8px; cursor: pointer;" class="bg-primary" onclick="addDep()"><i class="bx bxs-business"></i> Add New Department</button>
                </form>
            </div>
            
            <div class="tableCon">
                <table>
                    <tr>
                        <th colspan="2">
                            
                        </th>
                    </tr>
                    <tr>
                        <th>Department Name</th>
                        <th>Action</th>
                    </tr>
<?PHP
require_once 'conn.php';
$sql = "SELECT depname FROM departments";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
?>
                    <tr>
                        <td><?=htmlspecialchars($row['depname'])?></td>
                        <td><form  action="engine.php" method='post'><input type='hidden' name='delete_dep' value="<?=htmlspecialchars($row['depname'])?>"><button style="cursor: pointer;background: red;" type="submit"><i class='bx bxs-trash'></i> Drop</button></form></td>
                    </tr>
<?PHP
    }
?>
                </table>
<?PHP
} else {
    echo "No records found.";
}
?>
            </div>
        </main>
    </div>


    <div class="notificationCon"></div>

    <script>
        const inputs = document.querySelectorAll('.searchSet input');
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