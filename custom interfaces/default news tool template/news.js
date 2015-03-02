var galleries = [];
$.ajax({
	url:		'/custom_config?www.[domain].com.sitemason.com/?ajax=listGalleries&someParamNecessaryForThisHack=1/bogus.js',
	dataType:	'json',
	type:		'GET',
	success:	function(_data) { if ($.isPlainObject(_data) && $.isArray(_data.items)) { galleries = _data.items; } },
	error:		function(jqXHR, textStatus, errorThrown) {
		console.info('jqXHR:'); console.dir(jqXHR);
		console.info('textStatus: ' + textStatus);
		console.info('errorThrown: ' + errorThrown);
	}
});

modifyConf('itemPanel', function() {
	var contentTab = this.getTab('contentTab');

	var subtitle = contentTab.getContentItem('subtitle');

		contentTab.getContentItem('summary').remove();
		contentTab.getContentItem('subtitle').addContentItemAfter({
			width: 	'100%',
			type: 	'editor',
			name: 	'summary',
			label: 	'Summary',
			toolbar: [
				['Bold','Italic','Underline','Strike'],
				['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
				['Undo','Redo'],
				['Copy','PasteText'],	
		 		['NumberedList','BulletedList'],
		 		['Outdent','Indent'], 
				['Link','Unlink'],
				['Image','Table'],
				['Format'],
				['Source'],
				['Maximize'],
				['RemoveFormat']
			]
		});

		contentTab.getContentItem('description').remove();
		contentTab.getContentItem('summary').addContentItemAfter({
			width: 	'100%',
			type: 	'editor',
			name: 	'description',
			label: 	'Body',
			toolbar: [
				['Bold','Italic','Underline','Strike'],
				['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
				['Undo','Redo'],
				['Copy','PasteText'],	
		 		['NumberedList','BulletedList'],
		 		['Outdent','Indent'], 
				['Link','Unlink'],
				['Image','Table'],
				['Format'],
				['Source'],
				['Maximize'],
				['RemoveFormat']
			]
		});

		contentTab.getContentItem('description').addContentItemAfter({
			width: 	'100%',
			type: 	'field',
			name: 	'custom_field_json.ctaText',
			label: 	'CTA Text'
		});

		contentTab.getContentItem('custom_field_json.ctaText').addContentItemAfter({
			width: 	'100%',
			type: 	'field',
			name: 	'custom_field_json.ctaLink',
			label: 	'CTA Link'
		});

		contentTab.getContentItem('custom_field_json.ctaLink').addContentItemAfter({
			type:		'singleSelect',
			name:		'custom_field_json.imageGallery',
			label:		'Image Gallery',
			dataFormat:	'string',
			placeholder:'Select a Gallery...',
			items:		galleries
		});
});