<?php
	// directory for assets: '/_dev' for dev site, '/_' for live) 
    if (strpos($_SERVER['HTTP_HOST'],'.sitemason.com')) {
        // uncomment after initial development - $assetDir = '/smTemplate/dev';
        $assetDir = '/smTemplate';
    } else {
        $assetDir = '/smTemplate';
    }
?>
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
		<link href="<?php echo $assetDir; ?>/css/reset.css" rel="stylesheet">
		<link href="<?php echo $assetDir; ?>/css/style.css" rel="stylesheet">
	</head>
	
	<?php 
		$bodyClass = 'body-' . $smCurrentTool->getSlug();
	?>
	<body class="<?php echo $bodyClass; ?>">
		<header class="site-header clearfix">
			<a class="site-logo" href="/"><h1 class="site-heading">The Boilerplate Template</h1></a>
			<?php include('inc/nav.php'); ?>
		</header>
		
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
		
		
		<footer class="site-footer">
			<div class="content-footer">
				<small class="footer-copyright">
				<?php
					echo 'copyright: '. $smCurrentFolder->getCopyright();
				?>
				</small>
				<small class="footer-promo">
				<?php
					// Display the Footer data
					echo $smCurrentFolder->getFooter();
				?>
				</small>
			</div>
		</footer>

	</body>
</html>