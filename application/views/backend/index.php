<?php
	 $account_type       =	$this->session->userdata('login_type');
	?>
<!DOCTYPE html>
<html lang="en" dir="">
<head>
	
	<title>index | Customer Portal </title>
    
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Ekattor School Manager Pro - Creativeitem" />
	<meta name="author" content="Creativeitem" />
	
	

	<?php include 'includes_top.php';?>
	
</head>
<body class="page-body skin-purple" >
	<div class="page-container" >
		<?php include $account_type.'/navigation.php';?>	
		<div class="main-content">
		
			<?php include 'header.php';?>

           <h3 style="">
           	<i class="entypo-right-circled"></i> 
				<?php echo $page_title;?>
           </h3>

			<?php include $account_type.'/'.$page_name.'.php';?>

			<?php include 'footer.php';?>

		</div>
		<?php //include 'chat.php';?>
        	
	</div>
    <?php include 'includes_bottom.php';?>
    
</body>
</html>