PHP at top of site template:

	if($_GET['ajax'] == 'listTools') {
		require_once('[path-to-file-relative-to-site-template]/listTools.php');
		exit();
	}

	if($_GET['ajax'] == 'listGalleries') {
		require_once('[path-to-file-relative-to-site-template]/listGalleries.php');
		exit();
	}