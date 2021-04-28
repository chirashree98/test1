CKEDITOR.editorConfig = function( config ) {
	config.toolbar_Custom_mini =
	[
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Strike', '-', 'RemoveFormat' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
		{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'Undo', 'Redo' ] },
		'/',
		{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize', 'TextColor', 'BGColor' ] },
		{ name: 'tools', items: [ 'Maximize' ] }	
		
	];

	config.toolbar_Custom_medium =
	[
	
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source', 'Preview', 'Print' ] },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Strike', '-', 'RemoveFormat' ] },
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'Undo', 'Redo' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },		
		'/',
		{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize', 'TextColor', 'BGColor' ] },
		{ name: 'insert', items: [ 'Image', 'Flash', 'Table', 'HorizontalRule'] },
		{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] }

		
	];	

	var path = window.location.protocol+'//'+window.location.host+'/chocoposdev/public/js/kcfinder/'; 
        config.filebrowserBrowseUrl 		= 	path + 'browse.php?type=files';
	config.filebrowserImageBrowseUrl 	= 	path + 'browse.php?type=images';
	config.filebrowserFlashBrowseUrl	= 	path + 'browse.php?type=flash';
	config.filebrowserUploadUrl 		= 	path + 'upload.php?type=files';
	config.filebrowserImageUploadUrl 	= 	path + 'upload.php?type=images';
	config.filebrowserFlashUploadUrl 	= 	path + 'upload.php?type=flash';
	config.allowedContent = true;
	config.ignoreEmptyParagraph = true;
        config.autoParagraph = false;
	config.extraAllowedContent = 'ul ol li';
        
};
