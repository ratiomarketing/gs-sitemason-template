<?php
// set some constants
// Organization Name (will be added to page title)
$orgName = $smCurrentSite->getWindowTitle();
// Blog/News tool slug (if exists)
$blogTool = 'news';
// Default share image (if available)
$shareImg = 'http://www.thestraightshotmusic.com/smTemplate/images/jdstraightshotdefaultshare.jpg';

//grab current page as item
$item = $smCurrentTool->getItem();

// Page Title and Description. Show blog titles as page titles, all other pages default
if ($smCurrentTool->getSlug() == $blogTool) {
	if ($smCurrentTool->getView() == 'list') {
		if ($smCurrentTool->getWindowTitle()) {
			echo '<title>' . $smCurrentTool->getWindowTitle() . ' | ' . $orgName . '</title>';
		} else {
			echo '<title>' . $smCurrentTool->getTitle() . ' | ' . $orgName . '</title>';
		}
	} else {
		echo '<title>' . $item->getTitle() . ' | ' . $orgName . '</title>';
	}
	if ($item->getSummary()) {
		echo '<meta name="description" content="' . strip_tags($item->getSummary()) . '">';
	} else {
		echo '<meta name="description" content="' . $smCurrentFolder->getMetaDescription() . '">';
	}
} else {
	if ($smCurrentTool->getWindowTitle()) {
		echo '<title>' . $smCurrentTool->getWindowTitle() . ' | ' . $orgName . '</title>';
	} else {
		echo '<title>' . $smCurrentTool->getTitle() . ' | ' . $orgName . '</title>';
	}
	echo '<meta name="description" content="' . $smCurrentFolder->getMetaDescription() . '">';
}

if ($smCurrentTool->getView() == 'detail' && $smCurrentTool->getItem()) {
	//$item = $smCurrentTool->getItem();
	if ($item->getTitle()) {

		// Start Open Graph tags
		echo '<meta property="og:title" content="' . $item->getTitle() . '">';
		echo '<meta property="og:type" content="article">';
		echo '<meta property="og:site_name" content="'. $smCurrentSite->getWindowTitle() .'">';
		echo '<meta property="og:url" content="'. $item->getURL() .'">';
		$image = $item->getThumbnailImageSize();
		if ($image) {
			echo '<meta property="og:image" content="'. $image->getURL() .'">';
		} else {
			if($shareImg){
				echo '<meta property="og:image" content="' . $shareImg . '">';
			}
		}

		if ($item->getSummary()) {
			echo '<meta property="og:description" content="' . strip_tags($item->getSummary()) . '">';
		}

		if ($item->getAuthorEmailAddress()) {
			echo '<meta property="og:email" content="'. $item->getAuthorEmailAddress() .'">';
		}

		if ($item->getLocation()) {
			if ($item->getLocation()->getAddress1()) {
				echo '<meta property="og:street-address" content="'. $item->getLocation()->getAddress1() .'">';
			}

			if ($item->getLocation()->getCity()) {
				echo '<meta property="og:locality" content="'. $item->getLocation()->getCity() .'">';
			}

			if ($item->getLocation()->getState()) {
				echo '<meta property="og:region" content="'. $item->getLocation()->getState() .'">';
			}

			if ($item->getLocation()->getZip()) {
				echo '<meta property="og:postal-code" content="'. $item->getLocation()->getZip() .'">';
			}

			if ($item->getLocation()->getLatitude()) {
				echo '<meta property="og:latitude" content="'. $item->getLocation()->getLatitude() .'">';
			}

			if ($item->getLocation()->getLongitude()) {
				echo '<meta property="og:longitude" content="'. $item->getLocation()->getLongitude() .'">';
			}
		}
	}
	// Twitter Card
	if ($item->getTitle()) {
		echo '<meta name="twitter:card" content="summary">';
		echo '<meta property="twitter:title" content="' . $item->getTitle() . '">';
		$image = $item->getThumbnailImageSize();
		if ($image) {
			echo '<meta property="twitter:image" content="'. $image->getURL() .'">';
		}

		if ($item->getSummary()) {
			echo '<meta property="twitter:description" content="' . strip_tags($item->getSummary()) . '">';
		}
	}
} else if ($smCurrentTool->getView() == 'list') {
	if ($smCurrentTool->getTitle()) {
		echo '<meta property="og:title" content="' . $smCurrentTool->getTitle() . '">';
		echo '<meta property="og:site_name" content="' . $smCurrentSite->getWindowTitle() . '">';
		echo '<meta property="og:url" content="' . $smCurrentTool->getURL() . '">';
		$image = $item->getThumbnailImageSize();
		if ($image) {
			echo '<meta property="og:image" content="'. $image->getURL() .'">';
		} else {
			if($shareImg){
				echo '<meta property="og:image" content="' . $shareImg . '">';
			}
		}
	}
}