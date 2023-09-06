<?php 
    include('./config/db_connect.php');
    if(isset($_POST['delete'])) {
        $id = mysqli_real_escape_string($conn,$_POST['id']);
        $query = "DELETE FROM jobs WHERE id = $id";
        if(mysqli_query($conn, $query)) {
            header('Location: index.php');
        } else {
            echo mysqli_error($conn);
        }
        mysqli_free_result($result);
        mysqli_close($conn);
        header('Location: index.php');
    }
    if(isset($_GET['id'])) {
        $id = mysqli_real_escape_string($conn,$_GET['id']);
        $query = "SELECT * FROM jobs WHERE id = $id";
        $result = mysqli_query($conn, $query);
        $job = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        mysqli_close($conn);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php
    include('./templates/head.php');
?>
</head>
<body>
    <?php include('./templates/header.php') ?>

    <h2 class="center">Job Details</h2>
    <div class="container center">
        <?php if($job) : ?>
            <h2><?php echo htmlspecialchars($job['job']); ?></h2>
            <p>Created by: <?php echo htmlspecialchars($job['companyEmail']); ?></p>
            <p><?php echo date($job['createdAt']); ?></p>
            <h5>Required skills:</h5>
            <p><?php echo htmlspecialchars($job['skills']); ?></p>
            <form action="./details.php" method="post">
                <input type="hidden" name="id" value="<?php echo $job['id']; ?>">
                <input type="submit" name="delete" class="btn brand z-depth-0" value="Delete">
            </form>
        <?php else : ?>
            <h4>404 Error - Job not found !</h4>
        <?php endif; ?>
    </div>

    <?php include('./templates/footer.php');?>
</body>
</html>