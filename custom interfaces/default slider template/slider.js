var toolsList = [];
$.ajax({
	url:		'/custom_config?www.[domain].com.sitemason.com/?ajax=listTools&someParamNecessaryForThisHack=1/bogus.js',
	dataType:	'json',
	type:		'GET',
	success:	function(_data) { if ($.isPlainObject(_data) && $.isArray(_data.items)) { toolsList = _data.items; } },
	error:		function(jqXHR, textStatus, errorThrown) {
		console.info('jqXHR:'); console.dir(jqXHR);
		console.info('textStatus: ' + textStatus);
		console.info('errorThrown: ' + errorThrown);
	}
});

modifyConf('toolPanel', function() {
	var itemsTab = this.getTab('itemsTab');
		itemsTab.set('label', 'Slides');

		this.getTab('tagsTab').remove();
		this.getTab('tagGroupsTab').remove();
		this.getTab('subscriptionsTab').remove();
});

modifyConf('itemPanel', function() {
	var contentTab = this.getTab('contentTab');

	var title = contentTab.getContentItem('title');
		title.set('label', 'Call To Action');

	var subtitle = contentTab.getContentItem('subtitle');
		subtitle.set('label', 'Button/Link Text');

		contentTab.getContentItem('summary').remove();
		contentTab.getContentItem('description').remove();

		subtitle.addContentItemAfter({
			width: 	'100%',
			type: 	'field',
			name: 	'custom_field_json.linkExternalURL',
			label: 	'External Link URL'
		});

		contentTab.getContentItem('custom_field_json.linkExternalURL').addContentItemAfter({
			type:		'singleSelect',
			name:		'custom_field_json.linkInternalURL',
			label:		'Internal Link URL',
			dataFormat:	'string',
			placeholder:'Select a Tool/Page...',
			items:		toolsList
		});

		this.getTab('detailsTab').remove();
		this.getTab('mediaTab').remove();
		this.getTab('publishTab').remove();
		this.getTab('tagsTab').remove();
		this.getTab('locationTab').remove();
		this.getTab('customTab').remove();
		this.getTab('seoTab').remove();
});