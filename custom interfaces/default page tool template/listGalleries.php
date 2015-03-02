<?php

	$tools = $smCurrentSite->getTools();

	$galleryTools = array();
	foreach($tools as $tool) {
		$tooltype = $tool->getToolType();
		if($tool->getToolType() == 'folder') {
			foreach($tool->getTools() as $subtool) {
				$subtooltype = $subtool->getToolType();
				if($subtool->getToolType() == 'gallery') {
					$galleryTools[] = $subtool->getTitle() . ' [' . $subtool->getSlug() . ']';
				}
			}
		} else {
			if($tool->getToolType() == 'gallery') {
				$galleryTools[] = $tool->getTitle() . ' [' . $tool->getSlug() . ']';
			}
		}
	}

	$returnVal = array(
		'items'	=> $galleryTools
	);
	
	$output = json_encode($returnVal);
	echo $output;

?>