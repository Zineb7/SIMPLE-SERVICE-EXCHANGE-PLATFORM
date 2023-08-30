
<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
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
        while($row = $qry->fetch_assoc()):
        ?>
        <tr>
            <td class="text-center"><?php echo $i++; ?></td>
            <td><?php echo date("Y-m-d H:i", strtotime($row['date_created'])) ?></td>
            <td><?php echo $row['provider_name'] ?></td>
            <td><?php echo $row['receiver_name'] ?></td>
            <td class=""><p class="m-0 truncate-1"><?= $row['caption'] ?></p></td>
            <td align="center">
                <button type="button" class="btn btn-flat p-1 btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                    Action
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
				<div class="dropdown-menu" role="menu">
				<a class="dropdown-item view_data" href="/s4s/admin/reclamations/view_post_id.php?id=<?php echo $row['post_id'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item accept_data" href="javascript:void(0)" data-id="<?php echo $row['post_id'] ?>"><span class="fa fa-check text-success"></span> Accept</a>
    <a class="dropdown-item decline_data" href="javascript:void(0)" data-id="<?php echo $row['post_id'] ?>"><span class="fa fa-times text-danger"></span> Decline</a>
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
	$(document).ready(function(){
		$('.delete_data').click(function(){
			_conf("Are you sure to delete this post permanently?","delete_post",[$(this).attr('data-id')])
		})
		$('.table').dataTable({
			columnDefs: [
					{ orderable: false, targets: [4] }
			],
			order:[0,'asc']
		});
		$('.dataTable td,.dataTable th').addClass('py-1 px-2 align-middle')
	})
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
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>