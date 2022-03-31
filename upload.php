<?php require("dbconfig/config.php"); ?>
<?php include("navbar.php"); ?>

<h1>Upload</h1>

<?php

$player = $desc = "";

if (isset($_POST["upload"])) :
    $player = $_POST["player"];
    $desc = $_POST["description"];
    $file =  addslashes(file_get_contents($_FILES["image"]["tmp_name"]));

    $query = "INSERT INTO players VALUES('$player', '$desc', '$file')";
    // INSERT INTO players VALUES('haris', 'rock climber', 'climb.png')
    $success = mysqli_query($con, $query);

    if ($success) :
        echo "<script>alert('Player added')</script>";
    endif;
endif;
?>

<form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <h2>Player</h2>
    <input type="text" name="player" class="player">
    <h2>Description</h2>
    <textarea name="description" class="desc"></textarea>
    <input type="file" name="image">
    <input type="submit" value="Submit" name="upload">
</form>