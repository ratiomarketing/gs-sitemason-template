Sitemason's default page tool only has one field: Body/Description.

This template adds the following field(s):

* Page Header
* Page Subheader
* Body/Description (modifies this one to add a "Remove Formatting" button the Rich Text Editor)
* Call-to-Action External Link Text
* Call-to-Action External URL
* Call-to-Action Internal Link Text
* Call-to-Action Internal URL (lists all Sitemason tools)
* Image Gallery (lists all Sitemason Gallery tools)

It also adds the following tab(s):

* Picture



Add this PHP to the top of your site template:

	if($_GET['ajax'] == 'listTools') {
		require_once('[path-to-file-relative-to-site-template]/listTools.php');
		exit();
	}

	if($_GET['ajax'] == 'listGalleries') {
		require_once('[path-to-file-relative-to-site-template]/listGalleries.php');
		exit();
	}