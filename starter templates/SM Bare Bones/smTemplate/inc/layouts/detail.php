<?php
	$item = $smCurrentTool->getItem();
?>

<article class="article article-detail">
	<div class="article-content">
		<h1 class="page-title"><?php echo $item->getTitle(); ?></h1>
		<?php echo $item->getBody(); ?>	
	</div>
</article>