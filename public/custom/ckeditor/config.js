/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.replaceClass = 'ckeditor';


CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
    config.extraPlugins = 'base64image';
    config.language = 'ru';
   // config.extraPlugins = 'wordcount';
    //config.extraPlugins = 'mathjax';
    //config.mathJaxLib = '//cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML';
    config.mathJaxLib = '/custom/js/MathJax.js?config=TeX-AMS_HTML';

    config.toolbar = 'MyToolbar';
    //config.removePlugins = 'easyimage, cloudservices';
    config.toolbar_MyToolbar =
        [
            ['Source','Maximize','Preview','-','NewPage','Undo', 'Redo','-',
            'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-'],
            [ '-', 'Find', 'Replace', '-', 'SelectAll', 'RemoveFormat','CopyFormatting'],
            [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript',  'TextColor', 'BGColor', '-',
            'NumberedList', 'BulletedList', 'Outdent', 'Indent', '-','Blockquote', 'CreateDiv', 'HorizontalRule', 'PageBreak', '-'],
            'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-','BidiLtr', 'BidiRtl', '-',
            [  'Link', 'UnLink', 'base64image',  'Mathjax', 'Table',  'Smiley', 'Iframe','-',
                 'InlineLabel','Format', 'Styles', 'Font', 'FontSize'
            ]
        ];



    config.wordcount = {

        // Whether or not you want to show the Paragraphs Count
        showParagraphs: true,

        // Whether or not you want to show the Word Count
        showWordCount: true,

        // Whether or not you want to show the Char Count
        showCharCount: true,

        // Whether or not you want to count Spaces as Chars
        countSpacesAsChars: false,

        // Whether or not to include Html chars in the Char Count
        countHTML: false,

        // Maximum allowed Word Count, -1 is default for unlimited
        maxWordCount: -1,

        // Maximum allowed Char Count, -1 is default for unlimited
        maxCharCount: -1,

        // Add filter to add or remove element before counting (see CKEDITOR.htmlParser.filter), Default value : null (no filter)
        filter: new CKEDITOR.htmlParser.filter({
            elements: {
                div: function( element ) {
                    if(element.attributes.class == 'mediaembed') {
                        return false;
                    }
                }
            }
        })
    };
};

/*
CKEDITOR.replace('editor1', {
    extraPlugins: 'mathjax',
    mathJaxLib: 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML',
    height: 320
});*/
