
<?php
require_once('./../config.php');
if (isset($_POST['createOption'])) {
    $newOptionName = $_POST['optname'];
    $newOptionCoinValue = floatval($_POST['coinval']); // Convert to float

    // Validate input data (e.g., check for empty fields)

    // Use prepared statement
    $insertQuery = $conn->prepare("INSERT INTO options_list (name, coin_value) VALUES (?, ?)");
    $insertQuery->bind_param("sd", $newOptionName, $newOptionCoinValue);

    if ($insertQuery->execute()) {
        // Option inserted successfully, you can redirect or display a success message
        echo '<script>alert("Option created successfully.");</script>';
    } else {
        // Error occurred while inserting the option
        echo '<script>alert("Error creating option: ' . $conn->error . '");</script>';
    }

    // Close the prepared statement
    $insertQuery->close();
}
?>

<div class="card card-outline rounded-0 card-navy">
	<div class="card-body">
		<div class="container-fluid">
			<div id="msg"></div>
			<form method="post" id="manage-opt">	
				<input type="hidden" name="id" value="<?= isset($meta['id']) ? $meta['id'] : '' ?>">
				<div class="form-group">
					<label for="name">Option Name</label>
					<input type="text" name="optname" id="optname" class="form-control" value="<?php echo isset($meta['name']) ? $meta['name']: '' ?>" required>
				</div>
				<div class="form-group">
					<label for="name">Coin Value</label>
					<input type="number" name="coinval" id="coinval" class="form-control" value="<?php echo isset($meta['coin_value']) ? $meta['coin_value']: '' ?>">
				</div>
			</form>
		</div>
	</div>
	<div class="card-footer">
			<div class="col-md-12">
				<div class="row">
					<button class="btn btn-sm btn-primary rounded-0 mr-3" form="manage-opt">Save Option Details</button>
					<a href="./?page=options/list" class="btn btn-sm btn-default border rounded-0" form="manage-user"><i class="fa fa-angle-left"></i> Cancel</a>
				</div>
			</div>
		</div>
</div>
<style>
	img#cimg{
		height: 15vh;
		width: 15vh;
		object-fit: cover;
		border-radius: 100% 100%;
	}
</style>
