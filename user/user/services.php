<?php 
$user = $conn->query("SELECT *, concat(firstname, ' ', coalesce(concat(middlename,' '),''),lastname) as `name` FROM member_list where id ='".$_settings->userdata('id')."'");
foreach($user->fetch_array() as $k => $v){
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
                                        <th>Post ID</th>
                                        <th>Coin Exchanged</th>
                                        <th>Status</th>
                                        <th>Date Accepted</th>
                                        <th>Post Owner</th>
                                        <th>Action</th>
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
                                            if(in_array($fname,array('.','..')))
                                              continue;
                                            $files[]= validate_image($row['upload_path'].$fname);
                                        }
                                    ?>
                                    <tr>
                                        <td><?= $row['id'] ?></td>
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
                                            <?php if ($row['status'] == 1): ?>
                                                <form method="post">
                                                    <input type="hidden" name="postId" value="<?= $row['id'] ?>">
                                                    <button type="submit" class="btn btn-primary" name="finishService">Finish Service</button>
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
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['finishService'])) {
    $postId = $_POST['postId'];
    // Add code here to update the status in the `checkhand_list` table to indicate that the service has been finished
    // You can use an SQL UPDATE statement for this purpose.
    // For example:
    // $update_query = $conn->query("UPDATE checkhand_list SET status = 2 WHERE post_id = '{$postId}' AND slected = '{$_settings->userdata('id')}'");
}
?>
