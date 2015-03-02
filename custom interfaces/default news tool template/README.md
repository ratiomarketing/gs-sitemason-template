# DESCRIPTION

This template adds the following field(s):

* Summary & Body (modifies these to add a "Remove Formatting" button the Rich Text Editors)
* Call-to-Action Text
* Call-to-Action URL
* Image Gallery (lists all Sitemason Gallery tools)

It also adds the following tab(s):

* Picture


## INSTRUCTIONS:

1. Place "news.js" in the "smInterface" directory
2. Place "../data/listGalleries.php" in a sub-directory of the "smTemplate" directory
3. In the Sitemason interface, go to the "Developer Settings" tab, then the "Custom Interfaces" tab
4. In the field "URL to custom interface Javascript file", type "http://www.[domain].com.sitemason.com/smInterface/news.js", replacing "[domain]" with your domain
5. In the field "Match to this tool type", choose "News"
6. Add the following PHP to the top of your site template:

#### PHP
	if($_GET['ajax'] == 'listGalleries') {
		require_once('[path-to-file-relative-to-site-template]/listGalleries.php');
		exit();
	}

##### NOTE:
If you are using other custom interface files to affect individual page tools (by slug, for example), be sure to list this file AFTER the individualized file in the Sitemason -> Developer Settings -> Custom Interfaces listing.