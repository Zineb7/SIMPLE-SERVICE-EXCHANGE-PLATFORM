<?php
$user = $conn->query("SELECT *, concat(firstname, ' ', coalesce(concat(middlename, ' '), ''), lastname) as `name` FROM member_list WHERE id = '".$_settings->userdata('id')."'");
foreach ($user->fetch_assoc() as $k => $v) {
    $$k = $v;
}
?>

<style>
    #profile-avatar{
        height: 8em;
        width: 8em !important;
        object-fit: cover;
        object-position: center;
    }
    .post-holder{
        width:100%;
        height:20em;
    }
    .post-img{
        width:100%;
        height:100%;
        object-fit:cover;
        object-position:center center;
        transition:transform .3s ease-in-out;
    }
    .post-item:hover .post-img{
        transform:scale(1.2);
    }
    .btn-accepted {
        background-color: #28a745;
        color: #fff;
        border: none;
        padding: 5px 10px;
        border-radius: 3px;
        font-weight: bold;
        cursor: pointer;
    }
    .btn-action {
    width: 120px; 
}

</style>
<div class="mx-0 py-5 px-3 mx-ns-4 bg-gradient-light shadow blur d-flex w-100 justify-content-center align-items-center flex-column">
    <img src="<?= validate_image(isset($avatar) ? $avatar : '') ?>" alt="" class="img-thumbnail rounded-circle p-0" id="profile-avatar">
    <h3 class="text-center font-weight-bolder"><?= isset($name) ? $name : '' ?></h3>
    <div class="text-center font-weight-light text-muted"><?= isset($email) ? $email : '' ?></div>
</div>
<div class="row justify-content-center" style="margin-top:-2em;">
    <div class="col-lg-10 col-md-11 col-sm-12 col-xs-12">
        <div class="card rounded-0 shadow">
            <div class="card-body">
                <div class="container-fluid">
                    <div class="row">
                        <h3>My Services</h3>
                       <!-- ... The rest of your HTML code ... -->

                       <div class="col-lg-12">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Post Link</th>
                <th>Coin Exchanged</th>
                <th>Status</th>
                <th>Date Accepted</th>
                <th>Post Owner</th>
                <th>Action1</th>
                <th>Action2</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $qry = $conn->query("SELECT p.*, c.slected, c.status, c.date_clicked, m.firstname, m.lastname FROM post_list p 
                INNER JOIN checkhand_list c ON p.id = c.post_id
                INNER JOIN member_list m ON p.member_id = m.id
                WHERE c.slected = '{$_settings->userdata('id')}'
                ORDER BY unix_timestamp(p.date_updated) DESC");

            while($row = $qry->fetch_assoc()):
                $files = array();
                $fopen = scandir(base_app.$row['upload_path']);
                foreach($fopen as $fname){
                    if(in_array($fname, array('.', '..')))
                        continue;
                    $files[] = validate_image($row['upload_path'].$fname);
                }
            ?>
            <tr>
                <td>
                    <!-- Link to view_post page with the corresponding post ID -->
                    <a href="?page=posts/view_post&id=<?= $row['id'] ?>"><?= $row['id'] ?></a>
                </td>
                <td><?= $row['coin_value'] ?></td>
                <td>
                    <?php if ($row['status'] == 1): ?>
                        <button class="btn btn-accepted">Accepted</button>
                    <?php else: ?>
                        Not Available
                    <?php endif; ?>
                </td>
                <td><?= ($row['status'] == 1) ? date("M d, Y h:i A", strtotime($row['date_clicked'])) : '' ?></td>
                <td><?= $row['firstname'] . ' ' . $row['lastname'] ?></td>
                <td>
    <form method="post">
        <input type="hidden" name="postId" value="<?= $row['id'] ?>">
        <input type="hidden" name="coinsExchanged" value="<?= $row['coin_value'] ?>">
        <!-- Add the coinsExchanged as a hidden input field here -->

        <?php if ($row['status'] == 1): ?>
            <button type="submit" class="btn btn-primary btn-action" name="finishService">Finish Service</button>
        <?php else: ?>
            <!-- New gray "Stop Service" button -->
            <button class="btn btn-secondary btn-action" disabled>Finished</button>
        <?php endif; ?>

    </form>
</td>
<td>
    <?php if ($row['status'] == 1): ?>
        <form method="post">
            <input type="hidden" name="postId" value="<?= $row['id'] ?>">
            <button type="submit" class="btn btn-danger btn-action" name="cancelService">Cancel Service</button>
        </form>
    <?php endif; ?>
</td>

            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['finishService'])) {
        // Assuming $_POST['postId'] is correctly set, you should validate and sanitize the input before using it in the query.
        $postId = $_POST['postId'];
        $coinsExchanged = $_POST['coinsExchanged']; // Capture the value of coinsExchanged from the form submission.
        $dateNow = date("Y-m-d H:i:s"); // Current date and time.
        
        // Assuming you have the necessary data to insert into the coin_list table.
        $senderId = $_settings->userdata('id'); // The sender is the connected member (the one currently logged in).

        // Check if the coin_list entry already exists for the given postId
        $check_existing_qry = $conn->query("SELECT * FROM coin_list WHERE post_id = '{$postId}' LIMIT 1");
        if ($check_existing_qry->num_rows == 0) {
            // Insert the new row into the coin_list table.
            $qry = $conn->query("SELECT p.*, c.slected, c.status, c.date_clicked, m.firstname, m.lastname, m.id as receiver_id
            FROM post_list p 
            INNER JOIN checkhand_list c ON p.id = c.post_id
            INNER JOIN member_list m ON p.member_id = m.id
            WHERE c.slected = '{$_settings->userdata('id')}'
            ORDER BY unix_timestamp(p.date_updated) DESC");

            // Move the PHP form submission handling inside the while loop
            while ($row = $qry->fetch_assoc()) {
                if (isset($_POST['postId']) && $_POST['postId'] == $row['id']) {
                    $receiverId = $row['receiver_id']; // Move this line inside the while loop to get the receiver ID from the current row.
                    $insert_coin_list_qry = $conn->query("INSERT INTO coin_list (sender_id, receiver_id, post_id, coins_exchanged, date_created, date_updated, deadline, status) 
                                             VALUES ('{$senderId}', '{$receiverId}', '{$postId}', '{$coinsExchanged}', 
                                                     '{$dateNow}', '{$dateNow}', '{$dateNow}', '2')");

                   /* if (!$insert_coin_list_qry) {
                        echo "Error: " . $conn->error; // Display the SQL error if any.
                        // You can also log the error to a log file for further analysis.
                    }*/

                    // Check if the insert was successful, and handle any errors if necessary.
                    if ($insert_coin_list_qry) {
                        // Insert successful, do something (e.g., display a success message).
                    } else {
                        // Insert failed, do something (e.g., display an error message).
                    }
                    break; // Exit the loop after insertion to avoid multiple inserts.
                }
            }
        }

        // After processing the form submission, perform a redirect to the same page (Post/Redirect/Get pattern).
        //header("Location: http://localhost/s4s/user/");
        exit(); // Terminate the script to ensure a clean redirect.
    } elseif (isset($_POST['cancelService'])) {
        // Code to handle the "Cancel Service" button click
        // ...
    }
}
?>

