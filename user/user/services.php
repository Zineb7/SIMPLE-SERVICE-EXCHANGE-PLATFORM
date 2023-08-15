
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

            $dateNow = date("Y-m-d H:i:s"); // Current date and time.

            // Assuming you have the necessary data to insert into the coin_list table.
            $senderId = $_settings->userdata('id'); // The sender is the connected member (the one currently logged in).
            $receiverId = getOwnerMemberId($postId); // Get the owner's member ID using the function.

            // Check if the coin_list entry already exists for the given postId
            $check_existing_qry = $conn->query("SELECT * FROM coin_list WHERE post_id = '{$postId}' LIMIT 1");
            
                // If the coin_list entry does not exist, insert the new row into the coin_list table.
                $insert_coin_list_qry = $conn->query("INSERT INTO coin_list (sender_id, receiver_id, post_id, coins_exchanged, date_created, date_updated, deadline, status) 
                                                     VALUES ('{$senderId}', '{$receiverId}', '{$postId}', '{$coinsExchanged}', 
                                                             '{$dateNow}', '{$dateNow}', '{$dateNow}', '2')");

                if ($insert_coin_list_qry) {
                    // Insert successful, disable the "Finish Service" button after insertion.
                    echo "<script>document.getElementById('btn_finish_{$postId}').setAttribute('disabled', true);</script>";
                } else {
                    echo '<div class="alert alert-danger">Error inserting coin_list record: ' . $conn->error . '</div>';
                }
                echo '<script>window.location.href = window.location.href;</script>';
                exit;
            
        }
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

        // Define the coin percentage as a variable
        $coinPercentage = 0.25;

        if ($receiverId !== null) {
            // Insert the new row in the coin_list table
            $insert_coin_list_qry = $conn->query("INSERT INTO coin_list (sender_id, receiver_id, post_id, coins_exchanged, date_created, date_updated, deadline, status) 
                                                 VALUES ('{$senderId}', '{$receiverId}', '{$postId}', '{$coinsExchanged}', 
                                                         '{$dateNow}', '{$dateNow}', '{$dateNow}', '7')");

            if ($insert_coin_list_qry) {
                // Insert successful, update the member's balance and the owner's balance.
                $senderCoinDeduction = $coinsExchanged * $coinPercentage;
                $receiverCoinAddition = $coinsExchanged * $coinPercentage;

                $update_sender_balance_qry = $conn->query("UPDATE member_list 
                                                           SET coin = coin - {$senderCoinDeduction} 
                                                           WHERE id = '{$senderId}'");

                $update_receiver_balance_qry = $conn->query("UPDATE member_list 
                                                             SET coin = coin + {$receiverCoinAddition} 
                                                             WHERE id = '{$receiverId}'");

                if ($update_sender_balance_qry && $update_receiver_balance_qry) {
                    echo '<div class="alert alert-success">Balances updated successfully.</div>';
                } else {
                    echo '<div class="alert alert-danger">Failed to update balances: ' . $conn->error . '</div>';
                }
            } else {
                echo '<div class="alert alert-danger">Error inserting coin_list record: ' . $conn->error . '</div>';
            }
            echo '<script>window.location.href = window.location.href;</script>';
            exit;
        } else {
            echo '<div class="alert alert-danger">Failed to insert coin_list record.</div>';
        }
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
                WHERE c.member_id = '{$_settings->userdata('id')}' AND c.status = 1
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

<td>
    <?php
    $check_coin_list_qry = $conn->query("SELECT * FROM coin_list WHERE post_id = '{$row['id']}' AND status = '2' LIMIT 1");
    $check_cancelled_qry = $conn->query("SELECT * FROM coin_list WHERE post_id = '{$row['id']}' AND status = '7' LIMIT 1");
    
    if ($check_cancelled_qry->num_rows > 0) {
        // If status = 7, display "Cancelled" text in gray and disable the button
        echo '<button class="btn btn-secondary btn-action btn-fixed-width" disabled>Cancelled</button>';
    } elseif ($check_coin_list_qry->num_rows > 0) {
        // If status = 2, display "Asked Finish" text in gray and disable the button
        echo '<button class="btn btn-secondary btn-action btn-fixed-width" disabled>Asked Finish</button>';
    } elseif ($row['status'] == 1) {
        if (isset($_POST['finishService']) && $_POST['postId'] == $row['id']) {
            // If the "Finish Service" button was clicked for this row, display "Asked Finish"
            echo '<button class="btn btn-warning btn-action btn-fixed-width" disabled>Asked Finish</button>';
        } else {
            // If status = 1 (accepted), display the "Finish Service" button in blue
            echo '
            <form method="post" style="display:inline;">
                <input type="hidden" name="postId" value="' . $row['id'] . '">
                <button type="submit" class="btn btn-primary btn-action btn-fixed-width" name="finishService">Finish Service</button>
            </form>';
        }
    } else {
        // For other cases, display an empty cell
        echo '';
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


<div class="col-lg-12 mt-4">
    <h3>Requests for Finishing Services (Post Owners)</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Post Link</th>
                <th>Coin Exchanged</th>
                <th>Status</th>
                <th>Date Requested</th>
                <th>Service Requester</th>
                <th>Action1</th>
                <th>Action2</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            // Fetch requests for finishing services initiated by post owners
            $owner_requests_qry = $conn->query("SELECT p.*, c.status, c.date_created, m.firstname, m.lastname FROM post_list p 
                INNER JOIN coin_list c ON p.id = c.post_id
                INNER JOIN member_list m ON c.sender_id = m.id
                WHERE p.member_id = '{$_settings->userdata('id')}' AND c.status = 2
                      AND NOT EXISTS (SELECT 1 FROM coin_list WHERE post_id = p.id AND status = 7)
                ORDER BY unix_timestamp(c.date_created) DESC");

            while($row = $owner_requests_qry->fetch_assoc()):
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
                <?php
                $postId = $row['id'];
                // Get the coin_value for the post from the database
                $get_coin_value_qry = $conn->query("SELECT coin_value FROM post_list WHERE id = '{$postId}' LIMIT 1");
                if ($get_coin_value_qry->num_rows > 0) {
                    $coinRow = $get_coin_value_qry->fetch_assoc();
                    $coinsExchanged = $coinRow['coin_value'];
                }
                ?>
                <td><?= $coinsExchanged ?></td>
                <td>Asked Finish</td>
                <td><?= date("M d, Y h:i A", strtotime($row['date_created'])) ?></td>
                <td><?= $row['firstname'] . ' ' . $row['lastname'] ?></td>
                <td>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="requestId" value="<?= $row['id'] ?>">
                        <button id="btn_acceptFinish_<?= $postId ?>" class="btn btn-success btn-action btn-fixed-width" type="submit" name="acceptFinish">Accept Finish</button>
                    </form>
                </td>
                <td>
                <form method="post" style="display:inline;">
                    <input type="hidden" name="requestId" value="<?= $row['id'] ?>">
                    <button type="submit" class="btn btn-danger btn-action btn-fixed-width" name="declineFinish">Refuse Finish</button>
                </form>
            </td>
            </tr>
            <?php endwhile; ?>

            <?php if ($owner_requests_qry->num_rows == 0): ?>
            <tr>
                <td colspan="6">No requests for finishing services found.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>






<?php
function getPostOwnerMemberId($conn, $postId) {
    $query = "SELECT member_id FROM post_list WHERE id = '{$postId}' LIMIT 1";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['member_id'];
    } else {
        return null;
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ... Your existing code ...

// Handle "Accept Finish" button click
if (isset($_POST['acceptFinish'])) {
    $postId = $_POST['requestId'];

    // Check if a query with status = 3 already exists for the clicked post
    $check_query_exists = $conn->query("SELECT id FROM coin_list WHERE post_id = '{$postId}' AND status = 3 LIMIT 1");
    
    if ($check_query_exists->num_rows > 0) {
        // If a query with status = 3 exists, disable the button and change its color
        echo "<script>document.getElementById('btn_acceptFinish_{$postId}').setAttribute('disabled', true);
                      document.getElementById('btn_acceptFinish_{$postId}').classList.add('btn-disabled');</script>";
    } else {
        // If the query doesn't exist, proceed with inserting a new record
        $get_coin_value_qry = $conn->query("SELECT coin_value, member_id FROM post_list WHERE id = '{$postId}' LIMIT 1");

        if ($get_coin_value_qry->num_rows > 0) {
            $row = $get_coin_value_qry->fetch_assoc();
            $coinsExchanged = $row['coin_value'];
            $ownerId = $_settings->userdata('id'); // Connected member's ID as the owner
            
            // Get the actual provider's member ID based on the post ID from checkhand_list table
            $providerIdQuery = $conn->query("SELECT member_id FROM checkhand_list WHERE post_id = '{$postId}' LIMIT 1");
            if ($providerIdQuery->num_rows > 0) {
                $providerRow = $providerIdQuery->fetch_assoc();
                $providerId = $providerRow['member_id']; // Provider's member ID
            } else {
                // Handle the case when provider's member ID is not found.
                echo '<div class="alert alert-danger">Provider member not found.</div>';
                exit;
            }
    
            $dateNow = date("Y-m-d H:i:s"); // Current date and time.
    
            // Get the owner's member ID based on the post ID using the new function
            $ownerId = getPostOwnerMemberId($conn, $postId); // The owner's member ID
    
            if ($ownerId !== null) {
                $insert_coin_list_qry = $conn->query("INSERT INTO coin_list (sender_id, receiver_id, post_id, coins_exchanged, date_created, date_updated, deadline, status) 
                                                     VALUES ('{$providerId}', '{$ownerId}', '{$postId}', '{$coinsExchanged}', 
                                                             '{$dateNow}', '{$dateNow}', '{$dateNow}', '3')");
    
                if ($insert_coin_list_qry) {
                    // Insert successful, disable the button after successful insertion
                    $update_sender_balance_qry = $conn->query("UPDATE member_list 
                                                             SET coin = coin + {$coinsExchanged} 
                                                             WHERE id = '{$providerId}'");
                     // Disable the button after successful insertion and change its color
                    echo "<script>document.getElementById('btn_acceptFinish_{$postId}').setAttribute('disabled', true);
                                  document.getElementById('btn_acceptFinish_{$postId}').classList.add('btn-disabled');</script>";
                } else {
                    echo '<div class="alert alert-danger">Error inserting coin_list record: ' . $conn->error . '</div>';
                }
                echo '<script>window.location.href = window.location.href;</script>';
                exit;
            } else {
                echo '<div class="alert alert-danger">Owner member not found.</div>';
                exit;
            }
        }
    }
}


    
}

?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

