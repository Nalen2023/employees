<!DOCTYPE html>
<?php include('model.php'); ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
    integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <div class="container-fluid bg-dark float-end p-3">
        <h1 class="text-light">Employees Information</h1>
        <button id="openAdd" type="button" class="btn btn-primary float-end " data-bs-toggle="modal"
            data-bs-target="#exampleModal">
            <i class="fa-solid fa-plus"></i> Add
        </button>
    </div>
    <div class="modal fade" id="exampleModalDelete" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Are you sure?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="temp_id" id="id">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button name="btnDelete" id="btnDelete" type="submit" class="btn btn-primary">Yes,Delete
                            its.</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <table class="table table-dark table-hover align-middle" style="table-layout: fixed;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Position</th>
                <th>Salary</th>
                <th>OT</th>
                <th>Icome</th>
                <th>Profile</th>
                <th>Create At</th>
                <th>Update At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
           <?php readData()?>
        </tbody>
    </table>
</body>
<script>
    $(document).ready(function () {
        $("#openAdd").click(function () {
            $("#title").text("Enter Employees Information");
            $("#btnSave").show();
            $("#btnUpdate").hide();
        })
        $("body").on("click", "#openUpdate", function () {
            $("#title").text("Edit Employees Information");
            $("#btnSave").hide();
            $("#btnUpdate").show();
            var id = $(this).parents("tr").find("td").eq(0).text();
            var name = $(this).parents("tr").find("td").eq(1).text();
           var gender = $(this).parents("tr").find("td").eq(2).text();
           var position = $(this).parents("tr").find("td").eq(3).text();
           var salary = $(this).parents("tr").find("td").eq(4).text();
           var ot = $(this).parents("tr").find("td").eq(5).text();
           var income = $(this).parents("tr").find("td").eq(6).text();

            var profile = $(this).parents("tr").find("td:eq(7) img").attr("alt");

            $("#name").val(name);
            $("#gender").val(gender);
            $("#position").val(position);
            $("#salary").val(salary);
            $("#ot").val(ot);
            $("#income").val(income);
            $("#hide_thumbnail").val(profile);
            $("#hide_id").val(id);
        })
        $("body").on("click", "#openDelete", function () {
            var id = $(this).parents("tr").find("td").eq(0).text();
            $("#id").val(id);
        })
     
    });
</script>
</html>