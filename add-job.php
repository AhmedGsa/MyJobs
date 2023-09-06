<?php
include('./config/db_connect.php');
$errors = ['email' => '', 'job' => '', 'skills'=> ''];
$email = '';
$job = '';
$skills = '';
if (isset($_POST['submit'])) {
    if (empty($_POST['companyEmail'])) {
        $errors['email'] = 'Company email is required!<br>';
    } else {
        $email = $_POST['companyEmail'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Please enter a valid email !<br>';
        }
    }
    $job = $_POST['job'];
    if (empty($job)) {
        $errors['job'] = 'Job is required!<br>';
    }
    if (empty($_POST['skills'])) {
        $errors['skills'] = 'At least one skill is required!<br>';
    } else {
        $skills = $_POST['skills'];
        if (!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $skills)) {
            $errors['skills'] = 'Skills must be comma seperated !';
        }
    }
    if(!array_filter($errors)) {
        $email = mysqli_real_escape_string($conn, $email);
        $job = mysqli_real_escape_string($conn, $job);
        $skills = mysqli_real_escape_string($conn, $skills);
        $sql = "INSERT INTO jobs (companyEmail, job, skills) VALUES ('$email', '$job', '$skills')";
        if(mysqli_query($conn, $sql)) {
            header("Location: index.php");
        } else {
            echo mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php
include('./templates/head.php');
?>

<body class="grey lighten-4">
    <?php
    include('./templates/header.php');
    ?>
    <section class="container grey-text">
        <h4 class="center">Add a job</h4>
        <form action="add-job.php" method="post" class="white">
            <lable>Company email: </lable>
            <input type="text" name="companyEmail" value="<?php echo htmlspecialchars($email); ?>">
            <div class="red-text">
                <?php echo $errors['email']; ?>
            </div>
            <lable>Job: </lable>
            <input type="text" name="job" value="<?php echo htmlspecialchars($job);?>">
            <div class="red-text">
                <?php echo $errors['job']; ?>
            </div>
            <lable>Skills (comma seperated): </lable>
            <input type="text" name="skills" value="<?php echo htmlspecialchars($skills); ?>">
            <div class="red-text">
                <?php echo $errors['skills']; ?>
            </div>
            <div class="center">
                <input type="submit" value="submit" name="submit" class="btn z-depth-0 brand">
            </div>
        </form>
    </section>

    <?php
    include('./templates/footer.php');
    ?>
</body>

</html>