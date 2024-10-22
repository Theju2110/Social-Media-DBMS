<?php
    // Assuming $con is a valid MySQL connection

    // Sanitize $_GET['post_id'] to prevent SQL injection
    $get_id = mysqli_real_escape_string($con, $_GET['post_id']);

    $get_com = "SELECT * FROM comments WHERE post_id='$get_id' ORDER BY 1 DESC";

    $run_com = mysqli_query($con, $get_com);

    if (!$run_com) {
        die('Error: ' . mysqli_error($con));
    }

    while ($row = mysqli_fetch_array($run_com)) {
        $com = $row['comment'];
        $com_name = $row['comment_author'];
        $date = $row['date'];

        echo "
        <div class='row'>
            <div class='col-md-6 col-offset-3'>
                <div class='panel panel-info'>
                    <div class='panel-body'>
                        <div class='text-center'>
                            <h4><strong>$com_name</strong><i> Commented</i> on $date</h4>
                            <p class='text-primary mx-auto' style='font-size: 20px; margin-left: 5px;'>$com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>";
    }
?>
