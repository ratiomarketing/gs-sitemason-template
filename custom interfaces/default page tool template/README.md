# DESCRIPTION

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


## INSTRUCTIONS:

1. Place "page.js" in the "smInterface" directory
2. Place "../data/listGalleries.php" and "../data/listTools.php" in a sub-directory of the "smTemplate" directory
3. In the Sitemason interface, go to the "Developer Settings" tab, then the "Custom Interfaces" tab
4. In the field "URL to custom interface Javascript file", type "http://www.[domain].com.sitemason.com/smInterface/page.js", replacing "[domain]" with your domain
5. In the field "Match to this tool type", choose "Page"
6. Add the following PHP to the top of your site template:

#### PHP
	if($_GET['ajax'] == 'listTools') {
		require_once('[path-to-file-relative-to-site-template]/listTools.php');
		exit();
	}

	if($_GET['ajax'] == 'listGalleries') {
		require_once('[path-to-file-relative-to-site-template]/listGalleries.php');
		exit();
	}

##### NOTE:
If you are using other custom interface files to affect individual page tools (by slug, for example), be sure to list this file AFTER the individualized file in the Sitemason -> Developer Settings -> Custom Interfaces listing.