<?php $this->load->view("header") ?>
<div class="span9" id="content_error" style="background:#fff;min-height:500px;padding: 20px;background-image:url('<?php echo base_url() ?>asset/404-1.png'); background-repeat: no-repeat;background-position:center;">
	<h1>
		<?php 
			if($error == "404"){
				echo "Page Not Found";
			}else if($error == "403"){
				echo "You have no access here";
			}
		?>
	</h1>
<?php $this->load->view("footer") ?>