<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter name" required>
                        <input type="text" name="gender" id="gender" class="form-control mt-3" placeholder="Enter gender"
                            required>
                        <input type="text" name="position" id="position" class="form-control mt-3" placeholder="Enter position"
                            required>
                         <input type="text" name="salary" id="salary" class="form-control mt-3" placeholder="Enter salary"
                            required>
                        <input type="text" name="ot" id="ot" class="form-control mt-3" placeholder="Enter ot"
                            required>
                        
                        <input type="file" name="profile" id="profile" class="form-control  mt-3"
                            placeholder="Choose image">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button name="btnSave" id="btnSave" type="submit" class="btn btn-primary">Save</button>
                            <button name="btnUpdate" id="btnUpdate" type="submit"
                                class="btn btn-success">Update</button>
                        </div>
                        <!-- Hide thumbnail -->
                        <input type="hidden" name="hide_thumbnail" id="hide_thumbnail">
                        <!-- Hide Id -->
                        <input type="hidden" name="hide_id" id="hide_id">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
    try {
        $connection = new mysqli('localhost', 'root', '', 'db_people');
    } catch (\Throwable $th) {
        //throw $th;
    }
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        function income($salary,$position,$ot){
            $position=$_POST['position'];
            $salary=$_POST['salary'];
            $ot=$_POST['ot'];
            if($position=='IT'){
                $bonus=$salary*0.25;
            }else if($position=='Manager'){
                $bonus=$salary*0.20;
            }else if($position=='Accounting'){
                $bonus=$salary*0.15;
            }else{
                $bonus=$salary*0.10;
            }
           
            $incomes=$salary+$bonus+$ot*10;
            return $incomes;
        }
    
    }  
function insertData()
{
    global $connection;
    if (isset($_POST['btnSave'])) {
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $position = $_POST['position'];
        $salary = $_POST['salary'];
        $ot = $_POST['ot'];
        $income=income($salary,$position,$ot);
        $profile = rand(1, 10000) . '-' . $_FILES['profile']['name'];
        move_uploaded_file($_FILES['profile']['tmp_name'], 'images/' . $profile);
        if (!empty($name) && !empty($gender) && !empty($position) && !empty($ot) && !empty($profile)) {
            try {
                $sql = "INSERT INTO `tbl_employees`(`name`, `gender`, `position`, `salary`, `ot`, `icome`, `profile`)
                 VALUES ('$name','$gender','$position','$salary','$ot','$income','$profile')";
                $row = $connection->query($sql);
            } catch (\Throwable $th) {
                //throw $th;
            }
            if ($row) {
                echo '
                <script>
                    $(document).ready(function(){
                        swal({
                            title: "Good job!",
                            text: "You clicked the button!",
                            icon: "success",
                            button: "Aww yiss!",
                        });
                    })
                </script>
                ';
            }
        } else {
            echo 00;
        }
    }
}
insertData();
function readData()
{
    global $connection;
    try {
        $sql = "SELECT * FROM `tbl_employees` ORDER BY id DESC";
        $row = $connection->query($sql);
        while ($data = mysqli_fetch_assoc($row)) {
            echo '
            <tr>
                <td>' . $data['id'] . '</td>
                <td>' . $data['name'] . '</td>
                <td>' . $data['gender'] . '</td>
                <td>' . $data['position'] . '</td>
                <td>' . $data['salary'] . '</td>
                <td>' . $data['ot'] . '</td>
                <td>' . $data['icome'] . '</td>
                <td>
                    <img src="images/' . $data['profile'] . '" width="100" alt="' . $data['profile'] . '">
                </td>
                <td>' . $data['creat_at'] . '</td>
                <td>' . $data['update_at'] . '</td>
                <td>
                    <button id="openUpdate" class="btn btn-warning mx-2" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">Update</button>
                    <button id="openDelete" type="button" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#exampleModalDelete">Delete</button>
                </td>
            </tr>
            ';
        }
    } catch (\Throwable $th) {
        //throw $th;
    }
}
function deleteData()
{
    global $connection;
    if (isset($_POST['btnDelete'])) {
        $id = $_POST['temp_id'];
        try {
            $sql = "DELETE FROM `tbl_employees` WHERE id = '$id'";
            $result = $connection->query($sql);
            if ($result) {
                echo '
                <script>
                    $(document).ready(function(){
                        swal({
                            title: "Good job!",
                            text: "You clicked the button!",
                            icon: "success",
                            button: "Aww yiss!",
                        });
                    })
                </script>
                ';
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
deleteData();
function updateData()
{
    global $connection;
    if (isset($_POST['btnUpdate'])) {
        $id=$_POST['hide_id'];
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $position = $_POST['position'];
        $salary = $_POST['salary'];
        $ot = $_POST['ot'];
        $income=income($salary,$position,$ot);
        $profile = $_FILES['profile']['name'];
        if (!empty($profile)) {
            $thumbnail = rand(1, 100000) . '-' . $profile;
            move_uploaded_file($_FILES['profile']['tmp_name'], 'images/' . $profile);
        } else {
            $thumbnail = $_POST['hide_thumbnail'];
        }
        if (!empty($name) && !empty($gender) && !empty($position) && !empty($ot) && !empty($profile)) {
            try {
                $sql = "UPDATE `tbl_employees` SET `name`='$name',`gender`='$gender',`position`='$position',`salary`='$salary',`ot`='$ot',`icome`='$income',`profile`='$profile' WHERE id = '$id'";
                $row = $connection->query($sql);
            } catch (\Throwable $th) {
                //throw $th;
            }
            if ($row) {
                echo '
                <script>
                    $(document).ready(function(){
                        swal({
                            title: "Good job!",
                            text: "You clicked the button!",
                            icon: "success",
                            button: "Aww yiss!",
                        });
                    })
                </script>
                ';
            }
        } else {
            echo 00;
        }

    }
}
updateData();
?>