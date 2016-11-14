/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	config.removePlugins = 'cssanim, stylescombo, widgetbootstrap';
	config.removeButtons = 'Font';
	config.extraPlugins = 'btgrid';
	config.height = '600px';
	// config.toolbar = 'MyToolbar';
	// config.toolbar_MyToolbar =
	// [
	// 	{ name: 'document', items : [ 'NewPage','Preview' ] },
	// 	{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
	// 	{ name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','Scayt' ] },
	// 	{ name: 'insert', items : [ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'
 //                 ,'Iframe' ] },
 //                '/',
	// 	{ name: 'styles', items : [ 'Styles','Format' ] },
	// 	{ name: 'basicstyles', items : [ 'Bold','Italic','Strike','-','RemoveFormat' ] },
	// 	{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote' ] },
	// 	{ name: 'links', items : [ 'Link','Unlink','Anchor' ] },
	// 	{ name: 'tools', items : [ 'Maximize','-','About' ] }
	// ];
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
};
