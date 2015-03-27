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