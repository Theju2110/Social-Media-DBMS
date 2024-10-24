<!DOCTYPE html>
<?php
session_start();
include("includes/header.php");

if (!isset($_SESSION['user_email'])) {
    header("location: index.php");
    exit(); // Ensure script stops after redirection
}
?>

<html>
<head>
    <title>Edit Post</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style/home_style2.css">
</head>
<body>
<div class='row'>
    <div class='col-sm-3'></div>
    <div class='col-sm-6'>
        <?php
        if (isset($_GET['post_id'])) {
            $get_id = $_GET['post_id'];
            $get_post = "SELECT * FROM posts WHERE post_id = '$get_id'";
            $run_post = mysqli_query($con, $get_post);
            $row = mysqli_fetch_array($run_post);
            $post_con = $row['post_content'];

        }
        ?>
        <form action="" method="post" id="f">
            <center><h2>Edit Your Post</h2></center><br>
            <textarea class='form-control' cols='83' rows='4' name='content'><?php echo $post_con; ?></textarea><br>
            <input type='submit' name='update' value='Update Post' class='btn btn-info'/>
        </form>
        <?php
        if (isset($_POST['update'])) {
            $content = mysqli_real_escape_string($con, $_POST['content']);
            $update_post = "UPDATE posts SET post_content = '$content' WHERE post_id = '$get_id'";
            $run_update = mysqli_query($con, $update_post);

            if ($run_update) {
                echo "<script>alert('A Post has been Updated!')</script>";
                echo "<script>window.open('home.php', '_self')</script>";
            } else {
                echo 'Error updating post: ' . mysqli_error($con);
            }
        }
        ?>
    </div>
    <div class='col-sm-3'></div>
</div>
</body>
</html>
