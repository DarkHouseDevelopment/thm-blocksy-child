(function($) {
	'use strict';

	const $body = $('body'),
				$header = $('header[role="banner"]');

	$(document).ready(function() {
		init.ready();
	});

	$(window).on('resize',function() {
		init.resize();
	});

	$(window).on('load',function() {
		init.load();
	});

	var init = {

		/**
		* Call functions when document ready
		*/
		ready: function() {
			this.initCodeEditors();
		},

		/**
		* Call functions when window load.
		*/
		load: function() {
		},

		/**
		* Call functions when window resizes.
		*/
		resize: function() {
		},

		// CUSTOM FUNCTIONS BELOW
		initCodeEditors: function() {
			if($('#custom_css_0').length){
				wp.codeEditor.initialize($('#custom_css_0'), cm_settings);
			}
			
			if($('#custom_scripts_0_head_scripts').length){
				wp.codeEditor.initialize($('#custom_scripts_0_head_scripts'), cm_settings);
				wp.codeEditor.initialize($('#custom_scripts_1_body_scripts'), cm_settings);
				wp.codeEditor.initialize($('#custom_scripts_2_footer_scripts'), cm_settings);
			}
		},
	};

})(jQuery);
