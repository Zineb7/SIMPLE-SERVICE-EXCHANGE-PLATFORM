<?php
// ... Your existing code for database connection and other functions ...

$user = $conn->query("SELECT *, concat(firstname, ' ', coalesce(concat(middlename, ' '), ''), lastname) as `name` FROM member_list WHERE id = '".$_settings->userdata('id')."'");
foreach ($user->fetch_assoc() as $k => $v) {
    $$k = $v;
}
// Function to get the owner's member ID based on the post ID
function getOwnerMemberId($postId) {
    global $conn; // Assuming you have the database connection available in this scope.

    $qry = $conn->query("SELECT member_id FROM post_list WHERE id = '{$postId}'");
    if ($qry->num_rows > 0) {
        $row = $qry->fetch_assoc();
        return $row['member_id'];
    }

    return null; // Return null or an appropriate value if the post ID is not found.
}




if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['finishService'])) {
        $postId = $_POST['postId'];
        $get_coin_value_qry = $conn->query("SELECT coin_value FROM post_list WHERE id = '{$postId}' LIMIT 1");
        if ($get_coin_value_qry->num_rows > 0) {
            $row = $get_coin_value_qry->fetch_assoc();
            $coinsExchanged = $row['coin_value'];
        } else {
            // Handle the case when the post ID does not exist or other errors.
            // You can add an appropriate error handling here.
            exit;
        }
        $dateNow = date("Y-m-d H:i:s"); // Current date and time.
        
        // Assuming you have the necessary data to insert into the coin_list table.
        $senderId = $_settings->userdata('id'); // The sender is the connected member (the one currently logged in).

        // Check if the coin_list entry already exists for the given postId
        $check_existing_qry = $conn->query("SELECT * FROM coin_list WHERE post_id = '{$postId}' LIMIT 1");
        if ($check_existing_qry->num_rows == 0) {
            // If the coin_list entry does not exist, insert the new row into the coin_list table.
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

                    if ($insert_coin_list_qry) {
                        // Insert successful, disable the "Finish Service" button after insertion.
                        echo "<script>document.getElementById('btn_finish_{$postId}').setAttribute('disabled', true);</script>";
                    } else {
                        // Insert failed, handle the error (e.g., display an error message).
                    }
                    break; // Exit the loop after insertion to avoid multiple inserts.
                }
            }
        }

        // After processing the form submission, you don't need to redirect or reload the page.
        // No header() or JavaScript redirection is needed.
        // ...
    } elseif (isset($_POST['cancelService'])) {
        $postId = $_POST['postId'];
                // Get the coin_value for the post from the database
        $get_coin_value_qry = $conn->query("SELECT coin_value FROM post_list WHERE id = '{$postId}' LIMIT 1");
        if ($get_coin_value_qry->num_rows > 0) {
            $row = $get_coin_value_qry->fetch_assoc();
            $coinsExchanged = $row['coin_value'];
        } else {
            // Handle the case when the post ID does not exist or other errors.
            // You can add an appropriate error handling here.
            exit;
        }


        // Insert a new row in the coin_list table with status=7
        $senderId = $_settings->userdata('id'); // The sender is the connected member (the one currently logged in).
        $dateNow = date("Y-m-d H:i:s"); // Current date and time.

        // Assuming you have the necessary data to insert into the coin_list table.
        $receiverId = getOwnerMemberId($postId); // Get the owner's member ID using the function.

        if ($receiverId !== null) {
            // Insert the new row in the coin_list table
            $insert_coin_list_qry = $conn->query("INSERT INTO coin_list (sender_id, receiver_id, post_id, coins_exchanged, date_created, date_updated, deadline, status) 
                                                 VALUES ('{$senderId}', '{$receiverId}', '{$postId}', '{$coinsExchanged}', 
                                                         '{$dateNow}', '{$dateNow}', '{$dateNow}', '7')");

            if ($insert_coin_list_qry) {
                // Insert successful, update the member's balance and the owner's balance.
                $update_sender_balance_qry = $conn->query("UPDATE member_list 
                                                           SET coin = coin - ({$coinsExchanged} * 0.25) 
                                                           WHERE id = '{$senderId}'");

                $update_receiver_balance_qry = $conn->query("UPDATE member_list 
                                                             SET coin = coin + ({$coinsExchanged} * 0.25) 
                                                             WHERE id = '{$receiverId}'");

                if ($update_sender_balance_qry && $update_receiver_balance_qry) {
                    // Balances updated successfully.
                    // You can add a success message here if needed.
                } else {
                    // Update failed, handle the error (e.g., display an error message).
                }
            } else {
                // Insert failed, handle the error (e.g., display an error message).
            }
        } else {
            // Handle the case when the post ID does not exist or there is no owner.
        }
        echo '<script>window.location.href = window.location.href;</script>';
        exit; 
    }
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
.btn-action[disabled] {
        /* Add your preferred styles for the disabled button here */
        background-color: #ccc; /* Set the background color to gray */
        cursor: not-allowed; /* Change the cursor to 'not-allowed' to indicate it's disabled */
    }
    .btn-fixed-width {
        width: 120px; /* Adjust the width as per your preference */
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

   <!-- ... Your existing HTML code ... -->

<!-- ... Your existing HTML code ... -->

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
            // Fetch service requests sent by the connected member (status = 1)
            $service_requests_qry = $conn->query("SELECT p.*, c.slected, c.status, c.date_clicked, m.firstname, m.lastname FROM post_list p 
                INNER JOIN checkhand_list c ON p.id = c.post_id
                INNER JOIN member_list m ON p.member_id = m.id
                WHERE c.slected = '{$_settings->userdata('id')}' AND c.status = 1
                ORDER BY unix_timestamp(p.date_updated) DESC");

            // Create a flag to check if any records are displayed
            $recordsDisplayed = false;

            while($row = $service_requests_qry->fetch_assoc()):
                $recordsDisplayed = true; // Set the flag to true for each record displayed
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
                    <button class="btn btn-accepted">Accepted</button>
                </td>
                <td><?= ($row['status'] == 1) ? date("M d, Y h:i A", strtotime($row['date_clicked'])) : '' ?></td>
                <td><?= $row['firstname'] . ' ' . $row['lastname'] ?></td>
                <!-- ... Your existing code for displaying the table ... -->

<td>
    <!-- Check if the post ID is already inserted in coin_list with status = 2 -->
    <?php
    $check_coin_list_qry = $conn->query("SELECT * FROM coin_list WHERE post_id = '{$row['id']}' AND status = '2' LIMIT 1");
    if ($check_coin_list_qry->num_rows > 0) {
        // If it exists, disable the "Finish Service" button and apply gray color
        echo '<button class="btn btn-secondary btn-action btn-fixed-width" disabled>Finished</button>';
    } else {
        // If it does not exist, display the "Finish Service" button
        echo '
        <form method="post" style="display:inline;">
            <input type="hidden" name="postId" value="' . $row['id'] . '">
            <button type="submit" class="btn btn-primary btn-action btn-fixed-width" name="finishService">Finish Service</button>
        </form>';
    }
    ?>
</td>

<td>
    <!-- Check if the post ID is already inserted in coin_list with status = 7 -->
    <?php
    $check_coin_list_qry = $conn->query("SELECT * FROM coin_list WHERE post_id = '{$row['id']}' AND status = '7' LIMIT 1");
    if ($check_coin_list_qry->num_rows > 0) {
        // If it exists, disable the "Cancel Service" button and apply a different color
        echo '<button class="btn btn-warning btn-action btn-fixed-width" disabled>Service Canceled</button>';
    } elseif ($row['status'] == 1) {
        // If it does not exist and the status is 1 (accepted), display the "Cancel Service" button
        echo '
        <form method="post" style="display:inline;">
            <input type="hidden" name="postId" value="' . $row['id'] . '">
            <button type="submit" class="btn btn-danger btn-action btn-fixed-width" name="cancelService">Cancel Service</button>
        </form>';
    } else {
        // For other cases, display an empty cell
        echo '';
    }
    ?>
</td>

<!-- ... The rest of your HTML code ... -->

            </tr>
            <?php endwhile; ?>

            <?php
            // If no records are displayed, show a message in a new row
            if (!$recordsDisplayed):
            ?>
            <tr>
                <td colspan="7">No service requests found.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- ... The rest of your HTML code ... -->

<!-- ... The rest of your HTML code ... -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

