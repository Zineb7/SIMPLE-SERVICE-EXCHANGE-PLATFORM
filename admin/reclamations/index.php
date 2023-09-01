<?php if ($_settings->chk_flashdata('success')): ?>
	<script>
		alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
	</script>
<?php endif; ?>
<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['postId'])) {
        $postId = $_POST['postId'];

        // Fetch the post's status, sender_id, and receiver_id
        $post_status_qry = $conn->query("SELECT status, sender_id, receiver_id
            FROM coin_list
            WHERE post_id = '{$postId}'
            ORDER BY date_created DESC
            LIMIT 1");

        if ($post_status_qry) {
            $post_data = $post_status_qry->fetch_assoc();
            $post_status = $post_data['status'];
            $senderId = $post_data['sender_id'];
            $receiverId = $post_data['receiver_id'];

            if (isset($_POST['accept'])) {
                if ($post_status == 4) {
                    // Provider's action
                    // Fetch the coin value associated with this post
                    $coin_value_qry = $conn->query("SELECT coin_value FROM post_list WHERE id = '{$postId}'");
                    $coin_value = $coin_value_qry->fetch_assoc()['coin_value'];

                    // Deduct 25% from Seeker's balance
                    $seekerCoinsDeduction = $coin_value * 0.25; // 25% deduction

                    // Update Seeker's balance
                    $update_seeker_balance_qry = $conn->query("UPDATE member_list 
                                                              SET coin = coin - {$seekerCoinsDeduction} 
                                                              WHERE id = '{$senderId}'");

                    // Insert a new record with status 6 into coin_list
                    $dateNow = date('Y-m-d H:i:s');
                    $status5 = 5;
                    $insert_query = $conn->query("INSERT INTO coin_list (sender_id, receiver_id, post_id, coins_exchanged, date_created, date_updated, deadline, status) 
                                                 VALUES ('{$receiverId}', '{$senderId}', '{$postId}', '{$coin_value}', 
                                                         '{$dateNow}', '{$dateNow}', '{$dateNow}', '{$status5}')");

                    if ($update_seeker_balance_qry && $insert_query) {
						?>
                        <script>
                            alert_toast("Accepted as Provider. Deducted 25% from Seeker.", 'success');
                        </script>
                        <?php
                    } else {
                        ?>
                        <script>
                            alert_toast("Error deducting coins from Seeker's balance or inserting into coin_list.", 'error');
                        </script>
                        <?php
                    }
                } elseif ($post_status == 7) {
                    // Seeker's action
                    // Fetch the coin value associated with this post
                    $coin_value_qry = $conn->query("SELECT coin_value FROM post_list WHERE id = '{$postId}'");
                    $coin_value = $coin_value_qry->fetch_assoc()['coin_value'];

                    // Deduct 25% from Provider's balance
                    $providerCoinsDeduction = $coin_value * 0.25; // 25% deduction

                    // Update Provider's balance
                    $update_provider_balance_qry = $conn->query("UPDATE member_list 
                                                                 SET coin = coin - {$providerCoinsDeduction} 
                                                                 WHERE id = '{$receiverId}'");

                    // Insert a new record with status 5 into coin_list
                    $dateNow = date('Y-m-d H:i:s');
                    $status6 = 6;
                    $insert_query = $conn->query("INSERT INTO coin_list (sender_id, receiver_id, post_id, coins_exchanged, date_created, date_updated, deadline, status) 
                                                 VALUES ('{$receiverId}', '{$senderId}', '{$postId}', '{$coin_value}', 
                                                         '{$dateNow}', '{$dateNow}', '{$dateNow}', '{$status6}')");

                    if ($update_provider_balance_qry && $insert_query) {
						?>
                        <script>
                            alert_toast("Accepted as Seeker. Deducted 25% from Provider.", 'success');
                        </script>
                        <?php
                    } else {
						?>
                        <script>
                            alert_toast("Error deducting coins from Provider's balance or inserting into coin_list.", 'error');
                        </script>
                        <?php
                    }
                } else {
					?>
                    <script>
                        alert_toast("Reclamation already solved ", 'info');
						// alert_toast("Reclamation already solved with status: <?php echo $post_status; ?>", 'info');
                    </script>
                    <?php
                }
            } elseif (isset($_POST['decline'])) {
                // Handle Decline action
                // Fetch the coin value associated with this post
                $coin_value_qry = $conn->query("SELECT coin_value FROM post_list WHERE id = '{$postId}'");
                $coin_value = $coin_value_qry->fetch_assoc()['coin_value'];

                // Perform your SQL queries and updates here for the decline action
                // For example, update status, etc.

                // After performing the decline action, you can echo a message
				?>
                <script>
                    alert_toast("Declined. Updated Status or Other Actions Here.", 'info');
                </script>
                <?php
            } else {
				?>
                <script>
                    alert_toast("Invalid request. Unknown action.", 'error');
                </script>
                <?php
            }
        } else {
			?>
            <script>
                alert_toast("Error fetching post status.", 'error');
            </script>
            <?php
        }
    } else {
        ?>
        <script>
            alert_toast("Invalid request. Missing postId.", 'error');
        </script>
        <?php
    }
}



?>
<div class="card card-outline rounded-0 card-navy">
	<div class="card-header">
		<h3 class="card-title">List of Reclamations</h3>
	</div>
	<div class="card-body">
		<div class="container-fluid">
			<table class="table table-hover table-striped table-bordered" id="list">
				<thead>
					<tr>
						<th>#</th>
						<th>Date Created</th>
						<th>Provider</th>
						<th>Receiver</th>
						<th>Post Caption</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$qry = $conn->query("SELECT cl.*, CONCAT(mp.firstname, ' ', COALESCE(CONCAT(mp.middlename, ' '), ''), mp.lastname) AS provider_name, CONCAT(mr.firstname, ' ', COALESCE(CONCAT(mr.middlename, ' '), ''), mr.lastname) AS receiver_name, p.caption, p.id AS post_id FROM coin_list cl INNER JOIN member_list mp ON cl.sender_id = mp.id INNER JOIN member_list mr ON cl.receiver_id = mr.id INNER JOIN post_list p ON cl.post_id = p.id WHERE cl.status = 4 UNION SELECT cl.*, CONCAT(mp.firstname, ' ', COALESCE(CONCAT(mp.middlename, ' '), ''), mp.lastname) AS provider_name, CONCAT(mr.firstname, ' ', COALESCE(CONCAT(mr.middlename, ' '), ''), mr.lastname) AS receiver_name, p.caption, p.id AS post_id FROM coin_list cl INNER JOIN member_list mp ON cl.sender_id = mp.id INNER JOIN member_list mr ON cl.receiver_id = mr.id INNER JOIN post_list p ON cl.post_id = p.id WHERE cl.status = 7");
					while ($row = $qry->fetch_assoc()):
						?>
						<tr>
							<td class="text-center">
								<?php echo $i++; ?>
							</td>
							<td>
								<?php echo date("Y-m-d H:i", strtotime($row['date_created'])) ?>
							</td>
							<td>
								<?php echo $row['provider_name'] ?>
							</td>
							<td>
								<?php echo $row['receiver_name'] ?>
							</td>
							<td class="">
								<p class="m-0 truncate-1">
									<?= $row['caption'] ?>
								</p>
							</td>
							<td align="center">
								<button type="button"
									class="btn btn-flat p-1 btn-default btn-sm dropdown-toggle dropdown-icon"
									data-toggle="dropdown">
									Action
									<span class="sr-only">Toggle Dropdown</span>
								</button>
								<div class="dropdown-menu" role="menu">
									<a class="dropdown-item view_data"
										href="/s4s/admin/reclamations/view_post_id.php?id=<?php echo $row['post_id'] ?>"><span
											class="fa fa-eye text-dark"></span> View</a>
									<div class="dropdown-divider"></div>
									<form id="acceptForm" method="post" >
										<input type="hidden" name="postId" value="<?php echo $row['post_id']; ?>">
										<button type="submit" class="dropdown-item" name="accept">
											<span class="fa fa-check text-success"></span> Accept
										</button>
									</form>
									<form id="declineForm" method="post" >
										<input type="hidden" name="postId" value="<?php echo $row['post_id']; ?>">
										<button type="submit" class="dropdown-item" name="decline">
											<span class="fa fa-times text-danger"></span> Decline
										</button>
									</form>
								</div>
			</div>


			</td>
			</tr>
		<?php endwhile; ?>
		</tbody>
		</table>

	</div>
</div>
</div>
<script>
	$(document).ready(function () {
		$('.delete_data').click(function () {
			_conf("Are you sure to delete this post permanently?", "delete_post", [$(this).attr('data-id')])
		})
		$('.table').dataTable({
			columnDefs: [
				{ orderable: false, targets: [4] }
			],
			order: [0, 'asc']
		});
		$('.dataTable td,.dataTable th').addClass('py-1 px-2 align-middle')
	})
	function delete_post($id) {
		start_loader();
		$.ajax({
			url: _base_url_ + "classes/Master.php?f=delete_post",
			method: "POST",
			data: { id: $id },
			dataType: "json",
			error: err => {
				console.log(err)
				alert_toast("An error occured.", 'error');
				end_loader();
			},
			success: function (resp) {
				if (typeof resp == 'object' && resp.status == 'success') {
					location.reload();
				} else {
					alert_toast("An error occured.", 'error');
					end_loader();
				}
			}
		})
	}
</script>