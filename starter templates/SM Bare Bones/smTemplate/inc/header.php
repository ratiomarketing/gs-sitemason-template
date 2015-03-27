<header class="site-header clearfix">
	<a class="site-logo" href="/"><h1 class="site-heading">The Boilerplate Template</h1></a>
	<nav class="nav">
		<?php
			$pages = $smCurrentSite->getNavigationTools();
			foreach ($pages as $page) {
				$classes = 'nav-link';
				if ($page->isCurrentlyDisplayed()) {
					$classes .= ' nav-link-active';
				}
				
				echo '<a class="'. $classes .'" href="'. $page->getPath() .'">'. $page->getTitle() .'</a>';
			}
		?>
	</nav>
</header>