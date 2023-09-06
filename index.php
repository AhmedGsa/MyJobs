<?php
    include('./config/db_connect.php');
    $sql = 'SELECT * FROM jobs ORDER BY createdAt';
    $result = mysqli_query($conn, $sql);
    $jobs = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
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

    <h4 class="center grey-text">Jobs</h4>
    <div class="container">
        <div class="row">
            <?php foreach($jobs as $job) :?>
                <div class="col s6 md3">
                    <div class="card z-depth-0">
                        <div class="card-content center">
                            <h6><?php echo htmlspecialchars($job['job']); ?></h6>
                            <ul>
                                <?php foreach(explode(', ',$job['skills']) as $skill) : ?>
                                <li><?php echo htmlspecialchars($skill); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="card-action right-align">
                            <a class="brand-text" href="./details.php?id=<?php echo $job['id'] ?>">
                                more info
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php 
        include('./templates/footer.php');
    ?>
</body>
</html>