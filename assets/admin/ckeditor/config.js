/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';

    config.enterMode = CKEDITOR.ENTER_BR;
	config.filebrowserBrowseUrl = 'http://giaodiendep.vn/assets/ckfinder/ckfinder.html';
	config.filebrowserImageBrowseUrl = 'http://giaodiendep.vn/assets/ckfinder/ckfinder.html?type=Images';
	config.filebrowserFlashBrowseUrl = 'http://giaodiendep.vn/assets/ckfinder/ckfinder.html?type=Flash';
	config.filebrowserUploadUrl = 'http://giaodiendep.vn/assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
	config.filebrowserImageUploadUrl = 'http://giaodiendep.vn/assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
	config.filebrowserFlashUploadUrl = 'http://giaodiendep.vn/assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
};
