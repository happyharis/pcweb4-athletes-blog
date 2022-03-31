<?php require("dbconfig/config.php"); ?>
<?php include("navbar.php"); ?>

<h1>Edit</h1>

<?php
$query = "SELECT PlayerName from players";
$result = mysqli_query($con, $query);

while ($row = mysqli_fetch_array($result)) :
    $name = $row['PlayerName'];
    echo
    "
    <h4>
        <a href='edit.php?name=$name'>$name</a>
        <br>
    </h4>
    ";
endwhile;
?>

<?php if (isset($_GET["name"])) : ?>
    <?php
    $name = $_GET["name"];
    $query  = "SELECT * from players where PlayerName = '$name'";
    $query_run = mysqli_query($con, $query);
    $row = mysqli_fetch_array($query_run);
    $playername = $row['PlayerName'];
    $playerdesc = $row['Description'];
    ?>

    <form action="edit.php?name=<?php echo $name ?>" method="post" enctype="multipart/form-data">
        <h2>Player</h2>
        <input type="text" name="player" value="<?php echo $playername ?>">
        <input type="hidden" name="oldplayer" value="<?php echo $playername ?>">
        <h2>Description</h2>
        <textarea name="desc">
            <?php echo $playerdesc ?>
        </textarea>
        <h2>Image</h2>
        <input type="file" name="image">
        <input type="submit" value="Submit" name="edit">
    </form>

<?php else : ?>
    <p>No player selected</p>
<?php endif; ?>



<?php
$player = $desc = $oldplayer = "";
if (isset($_POST["edit"])) :
    $oldplayer = $_GET["name"];
    $player = $_POST["player"];
    $desc = $_POST["desc"];
    $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));

    $query = "UPDATE players 
    SET PlayerName = '$player', Description = '$desc', Image = '$file' 
    WHERE PlayerName = '$oldplayer'";

    $success = mysqli_query($con, $query);
    if ($success) :
        echo "
        <script>
            alert('player updated');
            location.href = 'index.php?name=$player';
        </script>
        ";

    endif;
endif;
?>