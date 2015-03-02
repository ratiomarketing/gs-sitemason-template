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

modifyConf('toolPanel', function(){
	var contentTab = this.getTab('contentTab');

	var description = contentTab.getContentItem('description');

		description.addContentItemBefore({
			type: 	'field',
			name: 	'custom_field_json.pageHeader',
			label: 	'Page Header',
		});

		description.addContentItemBefore({
			type: 	'field',
			name: 	'custom_field_json.pageSubheader',
			label: 	'Page Sub Header',
		});

		description.remove();

		contentTab.getContentItem('custom_field_json.pageSubheader').addContentItemAfter({
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
			name: 	'custom_field_json.externalCTAText',
			label: 	'External CTA Text'
		});

		contentTab.getContentItem('custom_field_json.externalCTAText').addContentItemAfter({
			width: 	'100%',
			type: 	'field',
			name: 	'custom_field_json.externalCTAURL',
			label: 	'External CTA URL'
		});

		contentTab.getContentItem('custom_field_json.externalCTAURL').addContentItemAfter({
			width: 	'100%',
			type: 	'field',
			name: 	'custom_field_json.internalCTAText',
			label: 	'Internal CTA Text'
		});

		contentTab.getContentItem('custom_field_json.internalCTAText').addContentItemAfter({
			type:		'singleSelect',
			name:		'custom_field_json.internalCTAURL',
			label:		'Internal CTA URL',
			dataFormat:	'string',
			placeholder:'Select a Tool/Page...',
			items:		toolsList
		});

		contentTab.getContentItem('custom_field_json.internalCTAURL').addContentItemAfter({
			type:		'singleSelect',
			name:		'custom_field_json.imageGallery',
			label:		'Image Gallery',
			dataFormat:	'string',
			placeholder:'Select a Gallery...',
			items:		galleries
		});

	function g(_name) { return glossary('gallery', _name, currentPage); }
	var tab = listItemPictureTab();
	var pictureTab = contentTab.addTabAfter( {
		id:		'picture_tab',
		name:	'pictureTab',
		title:	'Picture',
		icon:	'gallery',
		content:	tab.content
	} );
});