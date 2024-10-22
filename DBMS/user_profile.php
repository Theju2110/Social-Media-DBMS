<?php
if (isset($_GET['u_id'])) {
    global $con;
    $user_id = $_GET['u_id'];
    $select = "select * from users where user_id= '$user_id'";
    $run = mysqli_query($con, $select);
    $row = mysqli_fetch_array($run);
    $id = $row['user_id'];
    $image = $row['user_image'];
    $name = $row['user_name'];
    $f_name = $row['f_name'];
    $l_name = $row['l_name'];
    $describe_user = $row['describe_user'];
    $country = $row['user_country'];
    $gender = $row['user_gender'];
    $register_date = $row['user_reg_date'];

    echo "
    <div class='row'>
        <div class='col-sm-1'></div>
        <center>
            <div style='background-color: #e6e6e6;' class='col-sm-3'>
                <h2>Information about</h2>
                <img class='img-circle' src='users/$image' width='150' height='150'><br><br>
                <ul class=\"list-group\">
                    <li class='list-group-item' title='Username'><strong>$f_name $l_name</strong></li>
                    <li class='list-group-item' title='Description'><strong>$describe_user</strong></li>
                    <li class='list-group-item' title='Gender'><strong>$gender</strong></li>
                    <li class='list-group-item' title='Country'><strong>$country</strong></li>
                    <li class='list-group-item' title='Registration Date'><strong>$register_date</strong></li>
                </ul>
            </div>
        </center>
    ";
    $user = $_SESSION['user_email'];
    $get_user = "select * from users where user_email = '$user'";
    $run_user = mysqli_query($con, $get_user);
    $row = mysqli_fetch_array($run_user);

    $userown_id = $row['user_id'];

    if ($user_id == $userown_id) {
        echo "<a href='edit_profile.php?u_id=$userown_id' class='btn btn-success'/> Edit Profile</a><br><br><br>";
    }

    echo "</div>";
}
?>

<div class='col-sm-8'>
    <center><h1><strong><?php echo "$f_name $l_name"; ?></strong> Posts</h1></center>
    <?php
    global $con;

    if (isset($_GET['u_id'])) {
        $u_id = $_GET['u_id'];
    }

    $get_posts = "select * from posts where user_id= '$u_id' ORDER by 1 DESC LIMIT 5";

    $run_posts = mysqli_query($con, $get_posts);

    while ($row_posts = mysqli_fetch_array($run_posts)) {
        $post_id = $row_posts['post_id'];
        $user_id = $row_posts['user_id'];
        $content = $row_posts['post_content'];
        $upload_image = $row_posts['upload_image'];
        $post_date = $row_posts['post_date'];

        $user = "select * from users where user_id='$user_id' AND posts='yes'";
        $run_user = mysqli_query($con, $user);
        $row_user = mysqli_fetch_array($run_user);

        $user_image = $row_user['user_image'];
        $user_name = $row_user['user_name'];
        $user_f_name = $row_user['f_name'];
        $user_l_name = $row_user['l_name'];

        echo "<div id='own_posts'>";
        echo "<div class='row'>";
        echo "<div class='col-sm-2'>";
        echo "<p><img src='users/$user_image' class='image-circle' width='100px'></p>";
        echo "</div>";
        echo "<div class='col-sm-6'>";
        echo "<h3><a style='text-decoration:none; cursor:pointer;color #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h3>";
        echo "<h4><small style='color: black;'> Update a post on<strong>$post_date</strong></small></h4>";
        echo "</div>";
        echo "<div class='col-sm-4'></div>";
        echo "</div>";

        if ($content == "No" && strlen($upload_image) >= 1) {
            echo "<div class='row'>";
            echo "<div class='col-sm-12'>";
            echo "<img id='posts_img' src='imagpost/$upload_image' style='height:350px'>";
            echo "</div>";
            echo "</div>";
            echo "<br>";
            echo "<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-success'>View</button></a>";
            echo "<a href='functions/delete_post.php?post_id=$post_id' style='float:right;'><button class='btn btn-danger'>Delete</button></a>";
            echo "</div><br/><br/>";
        } elseif (strlen($content) > 1 && strlen($upload_image) >= 1) {
            echo "<div class='row'>";
            echo "<div class='col-sm-12'>";
            echo "<p>$content</p>";
            echo "<img id='posts_img' src='imagpost/$upload_image' style='height:350px'>";
            echo "</div>";
            echo "</div>";
            echo "<br>";
            echo "<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-success'>View</button></a>";
            echo "<a href='functions/delete_post.php?post_id=$post_id' style='float:right;'><button class='btn btn-danger'>Delete</button></a>";
            echo "</div><br/></br>";
        } else {
            echo "<div class='row'>";
            echo "<div class='col-sm-2'></div>";
            echo "<div class='col-sm-6'>";
            echo "<h3><p>$content</p></h3>";
            echo "</div>";
            echo "<div class='col-sm-4'></div>";
            echo "</div>";
            echo "<br>";
            echo "<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-success'>Comment</button></a><br>";
            echo "</div><br><br>";
        }
    }
    ?>
</div>
</div>
</div>
</body>
</html>
