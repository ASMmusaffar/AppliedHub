<?PHP

require_once 'conn.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    if(isset($_POST['login'])){
        $id=$_POST['id'];
        $pass=$_POST['pass'];
        $sql = "SELECT * FROM staffs WHERE sfreg = '$id' AND password = '$pass'";
        $result= mysqli_query($conn, $sql);
        if ($result->num_rows > 0) {
            header("Location: dashboard.php");
        }else{
            echo "<script>alert('Login failed! Give anothe shot')</script>";
            header("Location: index.php");
        }
    }

    

    if(isset($_POST['add_batch'])){
        $batch=$_POST['batch'];
        $commenced=$_POST['commenced'];
        $department=$_POST['department'];
        $sql = "INSERT INTO batchs (bname, bdep, bcommenced) VALUES ('$batch', '$department', '$commenced')";
        if(mysqli_query($conn, $sql)){
            header("Location: dashboard.php");
            exit();
        }else{
            $error=mysqli_error($conn);
        }
    }

    if(isset($_POST['add_dep'])){
        $department=$_POST['department'];
        $sql = "INSERT INTO departments (depname) VALUES ('$department')";
        if(mysqli_query($conn, $sql)){
            header("Location: detailsdep.php");
            exit();
        }else{
            $error=mysqli_error($conn);
        }
    }
    
    if(isset($_POST['delete_dep'])){
        $id = $_POST['delete_dep']; 

        $sql = "DELETE FROM departments WHERE depname = '$id'";
    
        if (mysqli_query($conn, $sql)) {
            header("Location: detailsdep.php");
            exit();
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
    }

    // ------------------------------------------------------STUDENTS
    // -------------------------------------------add_stutent or Update_student
    if(isset($_POST['add_student'])){

        $name=$_POST['name'];
        $batch=$_POST['batch'];
        $regno=$_POST['regno'];
        $department=$_POST['department'];
        $contact=$_POST['contact'];
        $mail=$_POST['mail'];
        if((isset($_FILES['uploadfile']) && $_FILES['uploadfile']['error'] == UPLOAD_ERR_OK)) {
            $filename = $_FILES["uploadfile"]["name"];
            $tempname = $_FILES["uploadfile"]["tmp_name"];
            $cleanFilename = str_replace(' ', '', $filename);
            $folder = "./students/" . $cleanFilename;
            move_uploaded_file($tempname, $folder);
        }else{
            $cleanFilename='student.jpg';
            echo "<script>alert('Image Not set!')</script>";
        }

        $checkSql = "SELECT COUNT(*) as count FROM students WHERE streg = '$regno'";
        $result = mysqli_query($conn, $checkSql);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            if ($row['count'] > 0) {
                $sql = "UPDATE students SET stimg='$cleanFilename', stname='$name', stbatch='$batch', stdep='$department', stcontact='$contact', stmail='$mail' WHERE streg='$regno';";
            }else{
                $sql = "INSERT INTO students(stimg,stname,stbatch,streg,stdep,stcontact,stmail) VALUES ('$cleanFilename','$name','$batch','$regno','$department','$contact','$mail');";
            }

            if(mysqli_query($conn,$sql)){
                header("Location: profilestudent.php?reg=$regno");
                exit();
            }else{
                $error=mysqli_error($conn);
            }
        }
    }

    // -------------------------------Drop_student
    if(isset($_POST['drop_student'])){
        echo "<script>alert('Set')</script>";
        $regno=$_POST['regno'];
        $sql = "UPDATE students SET ststatus='0' WHERE streg='$regno';";
        if(mysqli_query($conn,$sql)){
            echo "<script>alert('Resigned')</script>";
            header("Location: profilestudent.php?reg=$regno");
            // exit();
        }else{
            $error=mysqli_error($conn);
            echo "<script>alert('$error')</script>";
        }
    }

    // ------------------------------------------------------STAFFS
    // -------------------------------------------add_staff or Update_staff
    if(isset($_POST['add_staff'])){

        $name=$_POST['name'];
        $type=$_POST['type'];
        $regno=$_POST['regno'];
        $department=$_POST['department'];
        $contact=$_POST['contact'];
        $mail=$_POST['mail'];
        if((isset($_FILES['uploadfile']) && $_FILES['uploadfile']['error'] == UPLOAD_ERR_OK)) {
            $filename = $_FILES["uploadfile"]["name"];
            $tempname = $_FILES["uploadfile"]["tmp_name"];
            $cleanFilename = str_replace(' ', '', $filename);
            $folder = "./staffs/" . $cleanFilename;
            move_uploaded_file($tempname, $folder);
        }else{
            $cleanFilename='staff.jpg';
            echo "<script>alert('Image Not set!')</script>";
        }

        $checkSql = "SELECT COUNT(*) as count FROM staffs WHERE sfreg = '$regno'";
        $result = mysqli_query($conn, $checkSql);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            if ($row['count'] > 0) {
                $sql = "UPDATE staffs SET sfimg='$cleanFilename', sfname='$name', sftype='$type', sfdep='$department', sfcontact='$contact', sfmail='$mail' WHERE sfreg='$regno';";
            }else{
                $sql = "INSERT INTO staffs(sfimg,sfname,sftype,sfreg,sfdep,sfcontact,sfmail) VALUES ('$cleanFilename','$name','$type','$regno','$department','$contact','$mail');";
            }

            if(mysqli_query($conn,$sql)){
                header("Location: profilestaff.php?reg=$regno");
                exit();
            }else{
                $error=mysqli_error($conn);
            }
        }
    }

    // -------------------------------Resign_staff
    if(isset($_POST['resign_staff'])){
        echo "<script>alert('Set')</script>";
        $regno=$_POST['regno'];
        $sql = "UPDATE staffs SET sfstatus='0' WHERE sfreg='$regno';";
        if(mysqli_query($conn,$sql)){
            echo "<script>alert('Resigned')</script>";
            header("Location: profilestaff.php?reg=$regno");
            // exit();
        }else{
            $error=mysqli_error($conn);
            echo "<script>alert('$error')</script>";
        }
    }




}


?>