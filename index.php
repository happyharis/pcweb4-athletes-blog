<?php require("dbconfig/config.php"); ?>
<?php include("navbar.php"); ?>

<h1>Athletes</h1>

<?php
$query = "SELECT PlayerName from players";
$result = mysqli_query($con, $query);

// get array of names
while ($row = mysqli_fetch_array($result)) :
    $name = $row['PlayerName'];
    echo
    "
    <h4>
        <a href='index.php?name=$name'>$name</a>
        <br>
    </h4>
    ";
endwhile;
?>

<?php if (isset($_GET["name"])) : ?>

    <?php
    $name = $_GET["name"];
    $query = "SELECT Image, Description  FROM players WHERE PlayerName = '$name'";
    $query_run = mysqli_query($con, $query);
    $row = mysqli_fetch_array($query_run);
    ?>

    <p><?php echo $name ?></p>
    <p><?php echo $row['Description'] ?></p>

    <img src="data:image/jpeg; base64,<?php echo base64_encode($row['Image']) ?>" height="200">

    <form action="index.php?name=<?php echo $name ?>" method="post">
        <input type="submit" value="Delete Player" name="delete">
    </form>

<?php endif; ?>


<?php
if (isset($_POST["delete"])) :
    $query = "DELETE FROM players where PlayerName = '$name'";
    $query_run = mysqli_query($con, $query);
    if ($query_run) :
        echo "
            <script>
                alert('Player deleted');
                location.href = 'index.php';
            </script>
    ";
    endif;
endif;
?>