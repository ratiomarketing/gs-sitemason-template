<?php

	$allTools = $smCurrentSite->getTools();
	$toolsList = array();
	foreach($allTools as $item) {
		$str = '';
		$foldername = '';
		if($item->getToolType() == 'folder') {
			$foldername = $item->getTitle() . '/';
			$folderitems = $item->getTools();
			foreach($folderitems as $folderitem) {
				$str = $foldername . $folderitem->getTitle() . ' :: ' . $folderitem->getSlug() . ' :: ' . $folderitem->getId();
				$toolsList[] = $str;
			}
		} else {
			$str  = $item->getTitle() . ' :: ' . $item->getSlug() . ' :: ' . $item->getId();
			$toolsList[] = $str;
		}
	}


	$returnVal = array(
		'items'	=> $toolsList
	);
	
	$output = json_encode($returnVal);
	echo $output;

?>