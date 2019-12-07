/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

	// The toolbar groups arrangement, optimized for two toolbar rows.
	// config.toolbarGroups = [
	// 	{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
	// 	{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
	// 	{ name: 'links' },
	// 	{ name: 'insert' },
	// 	{ name: 'forms' },
	// 	{ name: 'tools' },
	// 	{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
	// 	{ name: 'others' },
	// 	'/',
	// 	{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
	// 	{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
	// 	{ name: 'styles' },
	// 	{ name: 'colors' },
	// 	{ name: 'about' }
	// ];

    config.skin = 'office2013';
    config.width = '100%';
    config.enterMode = CKEDITOR.ENTER_BR;
    config.extraPlugins = 'preview,find,mathjax,youtube,wordcount,tabletools,iframe,copyformatting,colorbutton,colordialog,justify,font,button';
    config.mathJaxLib = '//cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.0/MathJax.js?config=TeX-AMS_HTML';
    config.wordcount = {
        showParagraphs: false,
        showCharCount: true
    };
    config.colorButton_colors = 'FFBF00,9966CC,7FFFD4,007FFF,F5F5DC,3D2B1F,000000,0000FF,964B00,F0DC82,CC5500,' +
        'C41E3A,960018,ACE1AF,DE3163,007BA7,7FFF00,0047AB,B87333,FF7F50,FFFDD0,DC143C,00FFFF,50C878,FFD700,' +
        '808080,00FF00,DF73FF,4B0082,00A86B,C3B091,E6E6FA,CCFF00,FF00FF,800000,993366,c8a2c8,000080,CC7722,' +
        '808000,FF7F00,DA70D6,FFE5B4,CCCCFF,FFC0CB,660066,003399,CC8899,660099,FF0000,FF8C69,FF2400,704214,' +
        'C0C0C0,D2B48C,008080,30D5C8,FF4D00,BF00BF,40826D,FFFFFF,FFFF00';

	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	config.removeButtons = 'Underline,Subscript,Superscript';

	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre';

	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';
};
