<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User management application</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>


    <?php
    require 'process.php';
    ?>
    <div class="row justify-content-center" style="margin-top: 10px; ">

        <form action="process.php" method="post">
            <input type="hidden" name="id" value=<?php echo $id; ?>>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter your name:" value="<?php echo $name ?>" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" class="form-control" placeholder="Enter your Address: " value="<?php echo $address ?>" required>
            </div>
            <br>
            <?php
            if ($update == true) : ?>

                <button class="btn btn-info" name="update">Update</button>
            <?php else : ?>
                <button class="btn btn-primary" name="save">Save</button>
            <?php endif; ?>
        </form>

    </div>

    <?php
    if (isset($_SESSION['message'])) :  ?>
        <div class="alert alert-<?php echo $_SESSION['msg_type'] ?>">

            <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?>
        </div>
    <?php endif ?>

    <?php
    include 'db.php';
    $result = $conn->query('Select*from data');  //selects all the data from table data and stores the result in the var. result
    ?>


    <div class="row justify-content-center">
        <div class="container">
            <div class="row">
                <div class="col"></div>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>


                <?php
                if ($result->num_rows > 0)

                    while ($row = $result->fetch_assoc()) : ?>

                    <tr>

                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                        <td>
                            <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a>
                            <a href="process.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>

                        </td>
                    </tr>

                <?php endwhile; ?>



            </table>

        </div>
    </div>
</body>

</html>