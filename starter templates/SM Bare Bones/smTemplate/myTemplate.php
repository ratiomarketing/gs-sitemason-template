<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- load all meta info via template file, which includes page title & meta tags, opengraph tags, and twitter card tags -->
		<?php include 'inc/meta.php'; ?>
		<?php 
			/* if shouldIncludeInSiteMap is not checked, hide this page via robots */
			if (!$smCurrentTool->shouldIncludeInSiteMap() || $smCurrentTool->getItem()->hasTagWithTitle('no-index')) {
				echo '<meta name="robots" content="noindex, nofollow">';
			} 
		?>
		<link href="<?=$smTemplateFolder;?>/css/reset.css" rel="stylesheet">
		<link href="<?=$smTemplateFolder;?>/css/style.css" rel="stylesheet">
	</head>
	
	<?php 
		$bodyClass = 'body-' . $smCurrentTool->getSlug();
	?>
	<body class="<?php echo $bodyClass; ?>">
		<!-- Include the header -->
		<?php include('inc/header.php'); ?>
		
		<section role="main" class="content">
			<div class="content-main">
			<?php
			
				if ($smCurrentTool->getView() == 'list') {
					require_once('inc/layouts/list.php');
				} else {
					require_once('inc/layouts/detail.php');
				}
				
			?>	
			</div>
			
		</section>
		
		
		<!-- Include the footer -->
		<?php include('inc/footer.php'); ?>

		<!-- jQuery -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

		<!--[if lt IE 9]>-->
			<script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="<?=$smTemplateFolder?>/js/respond.min.js"></script>
		<!--<![endif]-->

	</body>
</html>