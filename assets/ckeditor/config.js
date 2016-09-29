/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';

    config.enterMode = CKEDITOR.ENTER_BR;
	config.filebrowserBrowseUrl = 'http://bietthubaidai.com/assets/ckfinder/ckfinder.html';
	config.filebrowserImageBrowseUrl = 'http://bietthubaidai.com/assets/ckfinder/ckfinder.html?type=Images';
	config.filebrowserFlashBrowseUrl = 'http://bietthubaidai.com/assets/ckfinder/ckfinder.html?type=Flash';
	config.filebrowserUploadUrl = 'http://bietthubaidai.com/assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
	config.filebrowserImageUploadUrl = 'http://bietthubaidai.com/assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
	config.filebrowserFlashUploadUrl = 'http://bietthubaidai.com/assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
};
