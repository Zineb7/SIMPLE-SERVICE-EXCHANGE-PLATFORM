<?php

if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT p.*, concat(m.firstname, ' ', 
	coalesce(concat(m.middlename,' '),''),m.lastname) as `name`, m.avatar, m.coin,
	COALESCE((SELECT count(member_id) FROM `checkhand_list` WHERE post_id = p.id), 0) as `checkhand`,
	COALESCE((SELECT count(member_id) FROM `like_list` where post_id = p.id),0) as `likes`, 
	COALESCE((SELECT count(member_id) FROM `comment_list` where post_id = p.id),0) as `comments`, 
	p.coin_value, p.tag FROM post_list p 
	inner join `member_list` m on p.member_id = m.id 
	where p.id = '{$_GET['id']}' and p.member_id = '{$_settings->userdata('id')}'");
    
	if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
		if(isset($id)){
			$qry_checkhand = $conn->query("SELECT post_id FROM `checkhand_list` where post_id = '{$id}' and member_id = '{$_settings->userdata('id')}'")->num_rows > 0;
			$qry_like = $conn->query("SELECT post_id FROM `like_list` where post_id = '{$id}' and member_id = '{$_settings->userdata('id')}'")->num_rows > 0;
		
			//tester 
		}
		
		
    }else{
        echo '<script> alert("Post ID is invalid."); location.replace("./?page=user/profile");</script>';
    }
}else{
    echo '<script> alert("Post ID is required."); location.replace("./?page=user/profile");</script>';
}

$qry_options = $conn->query("SELECT DISTINCT o.name FROM post_list p CROSS JOIN options_list o WHERE CONCAT(';', p.options, ';') LIKE CONCAT('%;', o.id, ';%') AND p.id = '{$id}'");

$options = array(); // Initialize an array to store options data

// Check if there are any options for the post
if ($qry_options->num_rows > 0) {
    while ($option_data = $qry_options->fetch_assoc()) {
        $options[] = $option_data;
    }
}
?>
<div class="mx-0 py-5 px-3 mx-ns-4 bg-gradient-light shadow blur">
	<h3><b>Post Details</b></h3>
</div>
<style>
	.avatar-img{
      height: 3em;
      width: 3em !important;
      object-fit: cover;
      object-position: center;
    }
	
</style>
<div class="row justify-content-center" style="margin-top:-2em;">
	<div class="col-lg-6 col-md-8 col-sm-11 col-xs-11">
		<div class="card rounded-0 shadow">
			<div class="card-body">
				<div class="container-fluid">
					<div class="d-flex w-100 align-items-center">
						<div class="col-auto">
							<img src="<?= validate_image(isset($avatar) ? $avatar : '') ?>" alt="" class="avatar-img img-thumbnail rounded-circle p-0">
						</div>
						<div class="col-auto flex-shrink-1 flex-grow-1">
							<div style="line-height:1em">
							<div class="font-weight-bolder"><?= isset($name) ? $name : '' ?></div>
							<div class="text-meted"><small>Posted <i class="far fa-calendar"></i> <?= isset($date_created) ?  date("M d, Y h:i A", strtotime($date_created)): '' ?></small></div>
							<div class="col-auto ml-auto text-right">
								<!-- Display coin_value on the right side -->
								<div class="col-auto ml-auto text-right">
								<!-- Display coin_value on the right side -->
								<div class="font-weight-bolder"><?= $coin_value ?> Coins</div>
								</div>

							</div>
							</div>
						</div>
					</div>
					<hr>
					<div>

					<!-- Diplay post's infos -->
					<div class="truncate-5 truncated-text">
						<?= isset($caption) ? str_replace(["\n\r", "\n", "\r"], "<br />", $caption) : '' ?>
						<?php if (!empty($row['tag'])) : ?>
						<?= isset($tag) ? '<br /><strong>Tags:</strong> ' . str_replace(["\n\r", "\n", "\r"], "<br />", $tag) : '' ?>
						<?php endif; ?>
						<?php if (!empty($options)) : ?>
							<br /><strong>Options:</strong>
								<?php foreach ($options as $option) : ?>
									<?= $option['name'] ?>
								<?php endforeach; ?>
						<?php endif; ?>
					</div>
					<a href="javascript:void(0)" class="seemore d-none">Read More</a>
					<a href="javascript:void(0)" class="seeless d-none">Show Less</a>
				</div>

					<div class="container-fluid bg-gradient-light" style="height: 30em !important">
							<?php 
							
							if(isset($upload_path) && is_dir(base_app.$upload_path)):
							$files = array();
							$fopen = scandir(base_app.$upload_path);
							if(count($fopen) > 2):
							?>
							<?php 
								foreach($fopen as $fname){
								if(in_array($fname,array('.','..')))
									continue;
								$files[]= validate_image($upload_path.$fname);
								}
							?>
							<div id="post<?= isset($id) ? $id:'' ?>"  class="carousel slide h-100" data-interval="false">
								<ol class="carousel-indicators">
										<?php foreach($files as $k => $img): ?>
											<li data-target="#post<?= isset($id) ? $id:'' ?>" data-slide-to="<?= $k ?>" class=" <?php echo $k == 0? 'active': '' ?>"></li>
										<?php endforeach; ?>
								</ol>
									<div class="carousel-inner h-100">
										<?php foreach($files as $k => $img): ?>
										<div class="carousel-item  h-100 <?php echo $k == 0? 'active': '' ?>">
											<img class="d-block w-100  h-100" style="object-fit:scale-down" src="<?php echo $img ?>" alt="">
										</div>
										<?php endforeach; ?>
									</div>
									<?php if(count($files) >1): ?>
									<a class="carousel-control-prev" href="#post<?= isset($id) ? $id:'' ?>" role="button" data-slide="prev">
										<span class="carousel-control-prev-icon" aria-hidden="true"></span>
										<span class="sr-only">Previous</span>
									</a>
									<a class="carousel-control-next" href="#post<?= isset($id) ? $id:'' ?>" role="button" data-slide="next">
										<span class="carousel-control-next-icon" aria-hidden="true"></span>
										<span class="sr-only">Next</span>
									</a>
									<?php endif; ?>
							</div>
							<?php endif; ?>
							<?php endif; ?>
							
							
						</div>

					<hr class="mx-n4">
					<?php if(isset($qry_like) && !! $qry_like): ?>
					<a href="javascript:void(0)" data-like='true' class="text-reset text-decoration-none like_post" data-id="<?= isset($id) ? $id : '' ?>"><i class="fa fa-heart text-danger"></i></a>
					<?php else: ?>
					<a href="javascript:void(0)" data-like='false' class="text-reset text-decoration-none like_post" data-id="<?= isset($id) ? $id : '' ?>"><i class="far fa-heart"></i></a>
					<?php endif; ?>
					<span class="like-count font-style-italic"><?= isset($likes) ? format_num($likes) : 0 ?></span>
					<a href="javascript:void(0)" class="text-reset text-decoration-none post_comments" data-id="<?= isset($id) ? $id : '' ?>"><i class="far fa-comment"></i></a>
					<span class="comment-count font-style-italic"><?= isset($comments) ? format_num($comments) : 0 ?></span>
					<!--CHECKHANDS ICON-->
					<?php $clr_checkhand=(isset($qry_checkhand) && !! $qry_checkhand)?"text-success" :"text-info"; ?>
					<?php $statu_checkhand=(isset($qry_checkhand) && !! $qry_checkhand)?'false':'true'  ; ?>
					<a href="javascript:void(0)" data-handshake='<?= $statu_checkhand; ?>' class="text-reset text-decoration-none handshake_post " data-id="<?= isset($id) ? $id : '' ?>">	<i class="far fa-handshake fa-lg <?= $clr_checkhand; ?>"></i></a>
					<span class="handshake-count font-style-italic " style="font-size: x-large;"><?= format_num($checkhand) ?></span>
					<hr class="mx-n4 mb-3">
					<div class="mx-n4">
						<div class="list-group mb-3">
							<?php if(isset($id)): ?>
							<?php 
							$comment_qry = $conn->query("SELECT c.*, concat(m.firstname, ' ', coalesce(concat(middlename,' '),''),m.lastname) as `name` FROM `comment_list` c inner join member_list m on c.member_id = m.id where c.post_id = '{$id}'");
							while($crow = $comment_qry->fetch_assoc()):
							?>
							<div class="list-group-item">
								<div class="d-flex w-100">
									<div class="col-auto flex-shrink-1 flex-grow-1">
										<b class="mr-2"><?= $crow['name'] ?></b>
										<span><?= str_replace(["\n", "\r", "\n\r"], '<br/>', $crow['message']) ?></span>
									</div>
									<?php if($crow['member_id'] == $_settings->userdata('id')): ?>
									<div class="col-auto">
										<div class="dropdown">
											<a class="text-reset text-decoration-none" type="button" id="comment<?= $crow['id'] ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<i class="fa fa-ellipsis-v"></i>
											</a>
											<div class="dropdown-menu" aria-labelledby="comment<?= $crow['id'] ?>">
												<a class="dropdown-item delete-comment" data-id="<?= $crow['id'] ?>" href="javascript:void(0)">Delete</a>
											</div>
										</div>
									</div>
									<?php endif; ?>
								</div>
							</div>
							<?php endwhile; ?>
							<?php endif; ?>
						</div>
						<div class="d-flex align-items-center w-100">
							<div class="col-auto flex-shrink-1 flex-grow-1">
								<textarea rows="2" class="form-control form-control-sm comment-field" data-id = '<?= isset($id) ? $id : '' ?>' placeholder="Write your comment here"></textarea>
							</div>
							<div class="col-auto ">
								<a href="javascript:void(0)" class="text-reset text-decoration-none submit-comment"><i class="fa fa-paper-plane"></i></a>
							</div>
						</div>
<!-- ... Your previous code ... -->
<hr class="mx-n2 mb-3">

<div class="mx-n2 align-items-center w-100">
    <h6>Providers for this service:</h6>
    <?php
    // Number of rows to display per page
    $rows_per_page = 5;

    // Get the current page number from the URL, default to page 1
    $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

    // Calculate the offset for the SQL query
    $offset = max(0, ($current_page - 1) * $rows_per_page);

    // Fetch total number of rows for pagination
    $post_id = $id; // Replace 26 with the actual post_id for which you want to retrieve handshake members
    $total_rows_qry = $conn->query("SELECT COUNT(*) as total FROM `checkhand_list` WHERE `post_id` = '{$post_id}'");
    $total_rows = $total_rows_qry->fetch_assoc()['total'];

    // Calculate total number of pages
    $total_pages = ceil($total_rows / $rows_per_page);

    // Fetch members who clicked on handshake for this post with pagination and ratings
    $qry_handshake_members = $conn->query("SELECT ch.`id`, CONCAT(m.firstname, ' ', m.lastname) AS full_name, m.coin, ch.date_clicked, ch.status,
                                                sr.rating, sr.comment
                                          FROM `checkhand_list` ch
                                          INNER JOIN `member_list` m ON ch.member_id = m.id
                                          LEFT JOIN `service_ratings` sr ON ch.member_id = sr.receiver_id AND ch.post_id = sr.provider_id
                                          WHERE ch.post_id = '{$post_id}'
                                          LIMIT $offset, $rows_per_page");

    if ($qry_handshake_members) {
        if ($qry_handshake_members->num_rows > 0) {
            ?>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Balance</th>
            <th>Request Date</th>
            <th>Rating</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($handshake_member = $qry_handshake_members->fetch_assoc()): ?>
            <tr>
                <td><?= $handshake_member['full_name'] ?></td>
                <td><?= $handshake_member['coin'] ?></td>
                <td><?= date("M d, Y h:i A", strtotime($handshake_member['date_clicked'])) ?></td>
                <td><?= $handshake_member['rating'] ?></td>
                       <td>
            <?php if ($handshake_member['status'] == 0): ?>
                <!-- Accept handshake form -->
                <form method="post" >
                    <!-- Hidden input fields to pass handshakeId and postId -->
                    <input type="hidden" name="handshakeId" value="<?= $handshake_member['id'] ?>">
                    <input type="hidden" name="postId" value="<?= $post_id ?>">
                    <button type="submit" class="btn btn-success btn-sm acceptButton">Accept</button>
                </form>
                <!-- End of accept handshake form -->

                <a href="decline_handshake.php?id=<?= $handshake_member['id'] ?>&post_id=<?= $post_id ?>" class="btn btn-danger btn-sm">Decline</a>
            <?php else: ?>
                <?php if ($handshake_member['status'] == 1): ?>
                    <button class="btn btn-info btn-sm">Accepted</button>
                <?php else: ?>
                    <button class="btn btn-secondary btn-sm">Not Available</button>
                <?php endif; ?>
            <?php endif; ?>
        </td>

            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
<?php
// Check if the form is submitted using POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the required POST parameters (handshakeId and postId) are present
    if (isset($_POST['handshakeId']) && isset($_POST['postId'])) {
        // Include your database connection file here

        // Get the handshakeId and postId from the POST data
        $handshakeId = $_POST['handshakeId'];
        $postId = $_POST['postId'];
        $status = 1; // Set the status to 1 (accepted)

        // Fetch the coin balance of the post owner
        $post_owner_qry = $conn->query("SELECT coin FROM member_list WHERE id = (SELECT member_id FROM post_list WHERE id = '{$postId}')");
        $post_owner_coin = $post_owner_qry->fetch_assoc()['coin'];

        // Fetch the required coins for this handshake
        $required_coins_qry = $conn->query("SELECT coin_value FROM post_list WHERE id = '{$postId}'");
        $required_coins = $required_coins_qry->fetch_assoc()['coin_value'];

        // Check if the post owner has enough coins
        if ($post_owner_coin >= $required_coins) {
            // Deduct coins from post owner's balance
            $updated_post_owner_coin = $post_owner_coin - $required_coins;

            // Perform the database update
            $update_query = $conn->query("UPDATE checkhand_list SET status = '{$status}', slected = '{$status}' WHERE id = '{$handshakeId}' AND post_id = '{$postId}'");
            $update_query1 = $conn->query("UPDATE post_list SET status = '{$status}' WHERE id = '{$postId}'");

            // Update the post owner's coin balance
            $update_post_owner_qry = $conn->query("UPDATE member_list SET coin = '{$updated_post_owner_coin}' WHERE id = (SELECT member_id FROM post_list WHERE id = '{$postId}')");
			
            if ($update_query && $update_query1 && $update_post_owner_qry) {
                $qry_accepted_handshake = $conn->query("SELECT member_id FROM checkhand_list WHERE id = '{$handshakeId}'")->fetch_assoc();
                $acceptedMemberId = $qry_accepted_handshake['member_id'];

                $updatedCheckhandId = $handshakeId;
                $updated_member_coin = $updated_post_owner_coin; // Use the updated coin value after performing the deduction
				$member_id = $_settings->userdata('id'); // Replace with the appropriate method to get the current logged-in member's ID

				// Update the member's coin balance
				$update_member_qry = $conn->query("UPDATE member_list SET coin = '{$updated_member_coin}' WHERE id = '{$member_id}'");
				// After successful coin update, perform the redirection
				
				// Insert new row in CoinList
				$coins_exchanged = $required_coins;
				$date_created = date('Y-m-d H:i:s');
				$date_updated = date('Y-m-d H:i:s');
				$deadline = date('Y-m-d H:i:s');
				$status = '1';

				//Insert new query in CoinList
				$insert_coin_list_qry = $conn->query("INSERT INTO coin_list (sender_id, receiver_id, post_id, coins_exchanged, date_created, date_updated, deadline, status) 
                                         VALUES ('{$_settings->userdata('id')}', '{$acceptedMemberId}', '{$postId}', '{$coins_exchanged}', 
                                                 '{$date_created}', '{$date_updated}', '{$deadline}', '{$status}')");

				
				
				echo "Request accepted successfully!! Post ID: {$postId}, Checkhand List ID: {$updatedCheckhandId}, Accepted Member ID: {$acceptedMemberId}";
				//header("Location: user/home.php");

            } else {
                echo "Error updating handshake status or deducting coins.";
            }
        } else {
            echo "Error: Not enough coins in the post owner's balance.";
        }
    } else {
        // If the required POST parameters are not present, handle the error
        echo "Invalid request. Missing handshakeId or postId.";
    }
}
?>

            <!-- Pagination links (displayed only if there are more than 5 rows) -->
            <?php if ($total_rows > $rows_per_page): ?>
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <?php for ($page = 1; $page <= $total_pages; $page++): ?>
                            <li class="page-item <?= ($page === $current_page) ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $page ?>"><?= $page ?></a>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </nav>
            <?php endif; ?>
            <?php
        } else {
            echo "No members have clicked on handshake for this post.";
        }
    } else {
        echo "Error executing the query: " . $conn->error;
    }
	
    ?>
</div>
					</div>
				</div>
			</div>
			
			<div class="card-footer text-center py-1">
				<button class="btn btn-danger bg-gradient-danger rounded-0" id="delete-data"><i class="fa fa-trash"></i> Delete Post</button>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.accept-handshake-btn').click(function() {
            var handshakeId = $(this).data('id');
        var postId = $(this).data('post-id');

        // Display the post ID and handshake ID in the success modal
        $('#postID').text(postId);
        $('#handshakeID').text(handshakeId);
		$('#successModal').modal('show');

        });
		
        $('#delete-data').click(function(){
			_conf("Are you sure to delete this post permanently?","delete_post",['<?= isset($id) ? $id : '' ?>'])
		})
		$('.delete-comment').click(function(){
			_conf('Are you sure to delete this comment?', 'delete_comment', [$(this).attr('data-id')])
		})
		$('.truncate-5').each(function(){
			var _this = $(this)
			var oh = _this[0].offsetHeight
			var sh = _this[0].scrollHeight
			if(oh < sh){
				_this.siblings('.seemore').removeClass('d-none')
			}
		})
		$('.seemore').click(function(){
			$(this).addClass('d-none')
			$(this).siblings('.seeless').removeClass('d-none')
			$(this).siblings('.truncated-text').removeClass('truncate-5')
		})
		$('.seeless').click(function(){
			$(this).addClass('d-none')
			$(this).siblings('.seemore').removeClass('d-none')
			$(this).siblings('.truncated-text').addClass('truncate-5')
		})
		$('.carousel').each(function(){
			var _this = $(this)
			if(_this.find('.carousel-item:nth-child(1)').hasClass('active')){
				_this.find('.carousel-control-prev').addClass('d-none')
			}else{
				_this.find('.carousel-control-prev').removeClass('d-none')
			}
			if(_this.find('.carousel-item:nth-last-child(1)').hasClass('active')){
				_this.find('.carousel-control-next').addClass('d-none')
			}else{
				_this.find('.carousel-control-next').removeClass('d-none')
			}
		})
		$('.carousel').on('slid.bs.carousel', function () {
			var _this = $(this)
			if(_this.find('.carousel-item:nth-child(1)').hasClass('active')){
				_this.find('.carousel-control-prev').addClass('d-none')
			}else{
				_this.find('.carousel-control-prev').removeClass('d-none')
			}
			if(_this.find('.carousel-item:nth-last-child(1)').hasClass('active')){
				_this.find('.carousel-control-next').addClass('d-none')
			}else{
				_this.find('.carousel-control-next').removeClass('d-none')
			}
			if(_this.find('.carousel-item').length > 2 && !_this.find('.carousel-item:nth-child(1)').hasClass('active') &&  !_this.find('.carousel-item:nth-last-child(1)').hasClass('active')){
				_this.find('.carousel-control-prev').removeClass('d-none')
				_this.find('.carousel-control-next').removeClass('d-none')
			}
		})
		$('.like_post').click(function(){
			var _this = $(this)
			var is_like = ($(this).attr('data-like') == 'true' ? true : false);
			if(!is_like){
				_this.find('i').removeClass('far').addClass('fa text-danger')
				_this.attr('data-like',true)
				var status = 1
			}else{
				_this.find('i').removeClass('fa text-danger').addClass('far')
				_this.attr('data-like',false)
				var status = 0

			}
			update_like(_this.attr('data-id'),status)
		})
		$('.handshake_post').click(function(){
			var _this = $(this)
			var is_like = ($(this).attr('data-handshake') == 'true' ? true : false);
			if(!is_like){
			
				_this.attr('data-handshake',true)
				var status = 1
			}else{
			
				_this.attr('data-handshake',false)
				var status = 0

			}
			update_handshake(_this.attr('data-id'),status)
		})
		$('.submit-comment').click(function(){
			var post_id = $(this).closest('.d-flex').find('.comment-field').attr('data-id')
			post_comment(post_id)
		})
		$('textarea.comment-field').keypress(function(e){
			if(e.which == 13 && e.shiftKey==false){
				e.preventDefault()
				var post_id = $(this).attr('data-id')
				post_comment(post_id)
			}
		})
		
	});
	function update_like(post_id, status){
		$.ajax({
			url:_base_url_+"classes/Master.php?f=update_like",
			method:'POST',
			data:{post_id : post_id, status:status},
			dataType:'json',
			error:err=>{
				console.log(err)
				alert_toast("Post Like has failed", 'error')
			},
			success:function(resp){
				if(!resp.status == 'success'){
					alert_toast("Post Like has failed", 'error')
				}else{
					$(".like_post[data-id='"+post_id+"']").siblings('.like-count').text(parseFloat(resp.likes).toLocaleString('en-US'))
				}
			}
		})
	}
	function post_comment(post_id){
		var comment = $('textarea.comment-field[data-id="'+post_id+'"]').val()
		start_loader()
		$.ajax({
			url:_base_url_+"classes/Master.php?f=save_comment",
			method:'POST',
			data:{post_id : post_id, comment:comment},
			dataType:'json',
			error:err=>{
				console.log(err)
				alert_toast("Saving Comment Failed", 'error')
				end_loader()
			},
			success:function(resp){
				if(!resp.status == 'success'){
					alert_toast("Saving Comment Failed", 'error')
				}else{
					$(".post_comments[data-id='"+post_id+"']").siblings('.comment-count').text(parseFloat(resp.comments).toLocaleString('en-US'))
					$('textarea.comment-field[data-id="'+post_id+'"]').val('')
					location.reload()
				}
				end_loader()
			}
		})
	}
    function delete_post($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_post",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.replace("./?page=user/profile");
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
	function delete_comment($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_comment",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload()
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
	function update_handshake(post_id, stat){
		$.ajax({
			url:_base_url_+"classes/Master.php?f=update_handshake",
			method:'POST',
			data:{post_id : post_id, status:stat},
			dataType:'json',
			error:err=>{
				console.log(err)
				alert_toast("Post handshake has failed", 'error')
			},
			success:function(resp){
				if(!resp.status == 'success'){
					alert_toast("Post handshake has failed", 'error')
				}else{
					$(".handshake_post[data-id='"+post_id+"']").siblings('.handshake-count').text(parseFloat(resp.handshake).toLocaleString('en-US'))
				}
			}
		})

	}
	

</script>