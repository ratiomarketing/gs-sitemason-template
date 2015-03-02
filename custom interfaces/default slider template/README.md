# DESCRIPTION

This template creates the following field(s):

* Call-to-Action Text
* Button Text
* External Link URL
* Internal Link URL (lists all Sitemason tools)


## INSTRUCTIONS:

1. Place "slider.js" in the "smInterface" directory
2. Place "../data/listTools.php" in a sub-directory of the "smTemplate" directory
3. In the Sitemason interface, go to the "Developer Settings" tab, then the "Custom Interfaces" tab, and click one of the "+" symbols to add a new custom interface
4. In the field "URL to custom interface Javascript file", type "http://www.[domain].com.sitemason.com/smInterface/slider.js", replacing "[domain]" with your domain
5. In the field "Match to this list of slugs (comma-delimited)", type the slug of the tool you want to match to this custom interface
6. Add the following PHP to the top of your site template:

#### PHP
	if($_GET['ajax'] == 'listTools') {
		require_once('[path-to-file-relative-to-site-template]/listTools.php');
		exit();
	}