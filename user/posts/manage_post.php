<?php
require_once('./../../config.php');
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `post_list` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}
?>
<style>
	#upload-images{
		height:40em;
		width:100%;
		display:flex;
		flex-direction:column;
		align-items:center;
		justify-content:center;
		border: 2px dashed gray;
		position: running;
	}
	a {
    color:#fff;
}
.dropdown dd, .dropdown dt {
    margin:0px;
    padding:0px;
}
.dropdown ul {
    margin: -1px 0 0 0;
}
.dropdown dd {
    position:relative;
}
.dropdown a, 
.dropdown a:visited {
    color:#fff;
    text-decoration:none;
    outline:none;
    font-size: 12px;
}
.dropdown dt a {
    background-color:#6C757D;
    display:block;
    padding: 8px 20px 5px 10px;
    min-height: 25px;
    line-height: 24px;
    overflow: hidden;
    border:0;
    width:272px;
}
.dropdown dt a span, .multiSel span {
    cursor:pointer;
    display:inline-block;
    padding: 0 3px 2px 0;
}
.dropdown dd ul {
    background-color: #6C757D;
    border:0;
    color:#fff;
    display:none;
    left:0px;
    padding: 2px 15px 2px 5px;
    position:absolute;
    top:2px;
    width:280px;
    list-style:none;
    height: 100px;
    overflow: auto;
}
.dropdown span.value {
    display:none;
}
.dropdown dd ul li a {
    padding:5px;
    display:block;
}
.dropdown dd ul li a:hover {
    background-color:#fff;
}
button {
  background-color: #6BBE92;
  width: 302px;
  border: 0;
  padding: 10px 0;
  margin: 5px 0;
  text-align: center;
  color: #fff;
  font-weight: bold;
}
</style>
<div class="container-fluid">
	<form action="" id="post-form">
		<input type="hidden" name ="id" value="<?php echo isset($id) ? $id : '' ?>">
		<div class="form-group mb-3">
			<label for="caption" class="control-label">Caption</label>
			<textarea rows="3" class="form-control form-control-sm rounded-0" id="caption" name="caption" required="required"><?= isset($caption) ? $caption : '' ?></textarea>
			<!--COINVALUE,TAGS, OPTIONS-->
			<div class="form-group mb-3">
    <label for="coin_value" class="control-label">Coin Value</label>
    <input type="number" min="0" max="1000" class="form-control form-control-sm rounded-0" id="coin_value" name="coin_value" value="<?= isset($coin_value) ? $coin_value : 0 ?>" required="required">
</div>
		</div>

			<div class="form-group mb-3">
				<label for="tag" class="control-label">Tags</label>
				<input type="text" class="form-control form-control-sm rounded-0" id="tag" name="tag" value="<?= isset($tag) ? $tag : '' ?>" required="required">
			</div>
			<?php 
			//list id option and name from options_list table
			function get_options() {

				$db = new DBConnection;
				$conn = $db->conn;
				$qry = $conn->query("SELECT * FROM options_list");  

				if ($qry && $qry->num_rows > 0) {
					while ($row = $qry->fetch_assoc()) {
						$options[] = $row;
					}
				}

				return $options;
			}
			$options = get_options();
			?>
			<!--THIS IS THE DROP DOWN LIST OF OPTIONS-->
			<dl class="dropdown">
				<dt>
					<a href="#">
						<span class="hida">Select</span>
						<p class="multiSel"></p>
					</a>
				</dt>
				<dd>
					<div class="mutliSelect">
						<ul>
							<?php foreach ($options as $option) : ?>
								<li>
									<?php
									$optionId = 'options_list' . $option['id']; // Unique ID for each checkbox
									?>
									<input type="checkbox" value="<?php echo $option['coin_value']; ?>" id="<?php echo $optionId; ?>" name="<?php echo $optionId; ?>" onchange="updateSelectedNames(this);" />
									<label for="<?php echo $optionId; ?>"><?php echo $option['name']." ".$option['coin_value'].""; ?></label>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</dd>
			</dl>
			<div id="upload-images" class="mt-4">
				<h4 class="font-weight-bolder" id="upload-text">Drop your Photos Here</h4>
				<div id="holder" class="w-100 px-3">
					<div id="template" class="row mt-2">
						<div class="col-auto">
							<span class="preview"><img src="data:," alt="" data-dz-thumbnail /></span>
						</div>
						<div class="col d-flex align-items-center">
							<p class="mb-0">
							<span class="lead" data-dz-name></span>
							(<span data-dz-size></span>)
							</p>
							<strong class="error text-danger" data-dz-errormessage></strong>
						</div>
						<div class="col-auto d-flex align-items-center">
							<div class="btn-group">
								<button data-dz-remove class="btn btn-light bg-gradient-light border btn-sm cancel" type="button">
								<i class="fas fa-times-circle"></i>
								<span>Cancel</span>
								</button>
							</div>
						</div>
					</div>
				</div>
				<button id='select-upload' class='btn btn-primary bg-gradient-primary rounded-0' type='button'>Upload Photos</button>
			</div>
		</div>
	</form>
</div>
<script>
	$(document).ready(function(){
		$('#post-form').submit(function (e) {
            e.preventDefault();
            var _this = $(this);
            $('.err-msg').remove();

            // Get the default coin value
            var defaultCoinValue = parseFloat('<?= isset($coin_value) ? $coin_value : 0 ?>');

            // Get the total coin value from selected options
            var totalCoinValue = 0;
            const checkboxes = document.querySelectorAll('input[name^="options_list"]:checked');
            checkboxes.forEach((checkbox) => {
                totalCoinValue += parseFloat(checkbox.value);
            });

            // Check if the total value is less than the default value
            if (totalCoinValue < defaultCoinValue) {
                alert('Total coin value cannot be less than the default value.');
                return; // Prevent form submission
            }
    $.ajax({
				url:_base_url_+"classes/Master.php?f=save_post",
				data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
				error:err=>{
					console.log(err)
					alert_toast("An error occured",'error');
					end_loader();
				},
				success:function(resp){
					if(typeof resp =='object' && resp.status == 'success'){
						location.href = "./?page=posts/view_post&id="+resp.aid
					}else if(resp.status == 'failed' && !!resp.msg){
                        var el = $('<div>')
                            el.addClass("alert alert-danger err-msg").text(resp.msg)
                            _this.prepend(el)
                            el.show('slow')
                            $("html, body, .modal").scrollTop(0)
                            end_loader()
                    }else{
						alert_toast("An error occured",'error');
						end_loader();
                        console.log(resp)
					}
				}
			})
		})

		$('#uni_modal').on('shown.bs.modal', function(){
			// DropzoneJS Demo Code Start
			Dropzone.autoDiscover = false

			// Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
			var previewNode = document.querySelector("#template")
			previewNode.id = ""
			var previewTemplate = previewNode.parentNode.innerHTML
			previewNode.parentNode.removeChild(previewNode)

			var myDropzone = new Dropzone(document.querySelector('#upload-images'), { // Make the whole body a dropzone
			url: "/target-url", // Set the url
			thumbnailWidth: 80,
			thumbnailHeight: 80,
			parallelUploads: 20,
			previewTemplate: previewTemplate,
			autoQueue: false, // Make sure the files aren't queued until manually added
			previewsContainer: "#holder", // Define the container to display the previews
			clickable: "#select-upload" // Define the element that should be used as click trigger to select files.
			})

			myDropzone.on("addedfile", function(file) {
			// Hookup the start button
			var input = document.createElement('input')
			input.setAttribute('type','file')
			input.setAttribute('name',"img[]")
			input.classList.add("d-none");
			// input.files = file
			var data = new DataTransfer();
			data.items.add(file)
			input.files = data.files
			$(file.previewElement).append($(input))
			file.previewElement.querySelector(".cancel").onclick = function() { 
				if($('#holder .dz-image-preview').length <=0){
					$('#upload-text').removeClass('d-none')
					$('#select-upload').removeClass('d-none')
				}
			 }
			$('#upload-text').addClass('d-none')
			$('#select-upload').addClass('d-none')
			})

			// Update the total progress bar
			myDropzone.on("totaluploadprogress", function(progress) {
			document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
			})

			myDropzone.on("sending", function(file) {
			// Show the total progress bar when upload starts
			document.querySelector("#total-progress").style.opacity = "1"
			// And disable the start button
			file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
			})

			// Hide the total progress bar when nothing's uploading anymore
			myDropzone.on("queuecomplete", function(progress) {
			document.querySelector("#total-progress").style.opacity = "0"
			})
		})

	})
	//DISPLAYED VALUES AFTER CHECKING BOXES OPTIONS
	function updateSelectedNames(checkbox) {
    const selectedNames = [];
    let coinstotalmin = 0;
    const checkboxes = document.querySelectorAll('input[name^="options_list"]:checked');
    checkboxes.forEach((checkbox) => {
        const label = checkbox.nextElementSibling;
        selectedNames.push(label.textContent);
        coinstotalmin += Number(checkbox.value);
    });

    const multiSel = document.querySelector('.multiSel');
    multiSel.textContent = selectedNames.join(', ');

    const coin_valuemin = document.querySelector('#coin_value');
    coin_valuemin.value = coinstotalmin;
    coin_valuemin.min = coinstotalmin; // Set the minimum value to the total sum of selected options
}
// Add this function to update the minimum value of the coin_value input
function updateMinCoinValue() {
  const selectedOptions = document.querySelectorAll('input[name^="options_list"]:checked');
  let sumOfSelectedOptions = 0;
  selectedOptions.forEach((option) => {
    sumOfSelectedOptions += Number(option.value);
  });

  const coinValueInput = document.getElementById('coin_value');
  coinValueInput.min = sumOfSelectedOptions;
}

// Call the updateMinCoinValue function when any checkbox is clicked
document.querySelectorAll('input[name^="options_list"]').forEach((checkbox) => {
  checkbox.addEventListener('click', updateMinCoinValue);
});

// Call the updateMinCoinValue function on page load to set the initial minimum value
updateMinCoinValue();

 


	$(".dropdown dt a").on('click', function () {
	$(".dropdown dd ul").slideToggle('fast');
	});

	$(".dropdown dd ul li a").on('click', function () {
	$(".dropdown dd ul").hide();
	});

	function getSelectedValue(id) {
	return $("#" + id).find("dt a span.value").html();
	}

	$(document).bind('click', function (e) {
	var $clicked = $(e.target);
	if (!$clicked.parents().hasClass("dropdown")) {
		$(".dropdown dd ul").hide()
	};
	});


	$('.mutliSelect input[type="checkbox"]').on('click', function () {

	var title = $(this).closest('.mutliSelect').find('input[type="checkbox"]').val(),
		title = $(this).val() + ",";

	if ($(this).is(':checked')) {
		var html = '<span title="' + title + '">' + title + '</span>';
		$('.multiSel').append(html);
		$(".hida").hide();
	}else {
		$('span[title="' + title + '"]').remove();
		var ret = $(".hida");
		$('.dropdown dt a').append(ret);
	}

	});
	

</script>