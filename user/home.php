
<style>
	.avatar-img{
      height: 3em;
      width: 3em !important;
      object-fit: cover;
      object-position: center;
    }
</style>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
      <?php 
		$qry = $conn->query("SELECT p.*, 
		concat(m.firstname, ' ', coalesce(concat(m.middlename,' '),''), m.lastname) as `name`, 
		m.avatar, m.coin,
		COALESCE((SELECT count(member_id) FROM `like_list` WHERE post_id = p.id), 0) as `likes`,
        COALESCE((SELECT count(member_id) FROM `checkhand_list` WHERE post_id = p.id), 0) as `checkhand`,		
		COALESCE((SELECT count(member_id) FROM `comment_list` WHERE post_id = p.id), 0) as `comments`, 
		p.coin_value, p.tag
		FROM post_list p 
		INNER JOIN `member_list` m ON p.member_id = m.id 
		ORDER BY unix_timestamp(p.date_updated) DESC");
   while($row = $qry->fetch_assoc()):
			  $qry_like = $conn->query("SELECT post_id FROM `like_list` where post_id = '{$row['id']}' and member_id = '{$_settings->userdata('id')}'")->num_rows > 0;
			  $qry_checkhand = $conn->query("SELECT post_id FROM `checkhand_list` where post_id = '{$row['id']}' and member_id = '{$_settings->userdata('id')}'")->num_rows > 0;
			  //DISPLAY OPTIONS AND TAG
			  $qry_options = $conn->query("SELECT DISTINCT o.name FROM post_list p CROSS JOIN options_list o WHERE CONCAT(';', p.options, ';') LIKE CONCAT('%;', o.id, ';%') AND p.id = '{$row['id']}'");

			  $options = array(); // Initialize an array to store options data
			  
			  // Check if there are any options for the post
			  if ($qry_options->num_rows > 0) {
				  while ($option_data = $qry_options->fetch_assoc()) {
					  $options[] = $option_data;
				  }
				} 
			
	  ?>
      <div class="card rounded-0 shadow">
        <div class="card-body">
          <div class="container-fluid">
            <div class="d-flex w-100 justify-content-between align-items-center">
              <div class="col-auto">
                <img src="<?= validate_image($row['avatar']) ?>" alt="" class="avatar-img img-thumbnail rounded-circle p-0">
              </div>
              <div class="col-auto flex-shrink-1 flex-grow-1">
                <div style="line-height:1em">
                <div class="font-weight-bolder"><?= $row['name'] ?></div>
                <div class="text-meted"><small>Posted <i class="far fa-calendar"></i> <?=  date("M d, Y h:i A", strtotime($row['date_created'])) ?></small></div>
				<div class="col-auto ml-auto text-right">
				<!-- Display coin_value on the right side -->
				<div class="font-weight-bolder"><?= $row['coin_value'] ?> Coins</div>
        	</div>
    
			</div>
              </div>
			  
            </div>
            <hr>
            <div>
              <div class="truncate-5 truncated-text">
				<?= str_replace(["\n\r","\n","\r"], "<br />", $row['caption'])  ?>
				<!--TAG-->
					<?php if (!empty($row['tag'])) : ?>
					<br><strong>Tags: </strong><?= str_replace(["\n\r","\n","\r"], "<br />", $row['tag']) ?>
				<?php endif; ?>
				<!--OPTIONS-->
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
			<!--
            <div class="container-fluid bg-gradient-light" style="height: 30em !important">
              <?php 
              if(isset($row['upload_path']) && is_dir(base_app.$row['upload_path'])):
              $files = array();
              $fopen = scandir(base_app.$row['upload_path']);
              if(count($fopen) > 2):
              ?>
              <?php 
                foreach($fopen as $fname){
                if(in_array($fname,array('.','..')))
                  continue;
                $files[]= validate_image($row['upload_path'].$fname);
                }
              ?>
              <div id="post<?= $row['id'] ?>"  class="carousel slide h-100" data-interval="false">
              <ol class="carousel-indicators">
                  <?php foreach($files as $k => $img): ?>
                    <li data-target="#post<?= $row['id'] ?>" data-slide-to="<?= $k ?>" class=" <?php echo $k == 0? 'active': '' ?>"></li>
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
                <a class="carousel-control-prev" href="#post<?= $row['id'] ?>" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#post<?= $row['id'] ?>" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
                <?php endif; ?>
              </div>
              <?php endif; ?>
              <?php endif; ?>
            </div>
				-->
            <hr class="mx-n4">
            <?php if(isset($qry_like) && !! $qry_like): ?>
            <a href="javascript:void(0)" data-like='true' class="text-reset text-decoration-none like_post" data-id="<?= $row['id'] ?>"><i class="fa fa-heart text-danger"></i></a>
            <?php else: ?>
            <a href="javascript:void(0)" data-like='false' class="text-reset text-decoration-none like_post" data-id="<?= $row['id'] ?>"><i class="far fa-heart"></i></a>
            <?php endif; ?>
            <span class="like-count font-style-italic"><?= format_num($row['likes']) ?></span>
            <a href="javascript:void(0)" class="text-reset text-decoration-none post_comments" data-id="<?= $row['id'] ?>"><i class="far fa-comment"></i></a>
            <span class="comment-count font-style-italic"><?= format_num($row['comments']) ?></span>
			<!--CHECKHANDS ICON-->
			<?php $clr_checkhand=(isset($qry_checkhand) && !! $qry_checkhand)?"text-success" :"text-info"; ?>
			<?php $statu_checkhand=(isset($qry_checkhand) && !! $qry_checkhand)?'true':'false'  ; ?>
			<a href="javascript:void(0)" data-handshake='<?= $statu_checkhand; ?>' class="text-reset text-decoration-none handshake_post " data-id="<?= $row['id'] ?>">	<i class="far fa-handshake fa-lg <?= $clr_checkhand; ?>"></i></a>
			<span class="handshake-count font-style-italic " style="font-size: x-large;"><?= format_num($row['checkhand']) ?></span>
			
			<!-- Your existing HTML code here -->
			<!-- 
			<script>
			$(function() {
				$('.post_comments').click(function() {
				// Get the post ID from the data-id attribute of the clicked element
				var postId = $(this).data('id');

				// Perform your action here, for example, show an alert message
				alert('You clicked on the handshake icon for post ID ' + postId);
				});
			});
			</script>
			-->

			<hr class="mx-n4 mb-3">
            <div class="mx-n4">
              <div class="list-group mb-3">
                <?php 
                $comment_qry = $conn->query("SELECT c.*, concat(m.firstname, ' ', coalesce(concat(middlename,' '),''),m.lastname) as `name` FROM `comment_list` c inner join member_list m on c.member_id = m.id where c.post_id = '{$row['id']}'");
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
              </div>
              <div class="d-flex align-items-center w-100">
                <div class="col-auto flex-shrink-1 flex-grow-1">
                  <textarea rows="2" class="form-control form-control-sm comment-field" data-id = '<?= $row['id'] ?>' placeholder="Write your comment here"></textarea>
                </div>
                <div class="col-auto ">
                  <a href="javascript:void(0)" class="text-reset text-decoration-none submit-comment"><i class="fa fa-paper-plane"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
  </div>
</div>
<script>
  $(function(){
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
  })
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
					location.replace("./?page=posts");
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

</script>