var AS3GAMEGEARS = new function() {
	this.createMarkdownTextarea = function(theTextId) {
		$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
			var aActiveTab 	= e.target + '';
			var aOldTab 	= e.relatedTarget + '';

			aActiveTab 		= aActiveTab.substr(aActiveTab.lastIndexOf('#'));
			aOldTab 		= aOldTab.substr(aOldTab.lastIndexOf('#'));

			if(aActiveTab.indexOf('view-markdown') != -1) {
				$(aActiveTab).html('<img src="./ajax-loader.gif" title="Loading" align="absmiddle"> Loading...');

				$.ajax({
				  type: 'POST',
				  url: 'ajax-markdown.php',
				  data: {'text': $('#' + theTextId).val() }
				})
				.done(function( msg ) {
					$(aActiveTab).html(msg);
				})
				.fail(function(jqXHR, textStatus) {
					$(aActiveTab).html('Oops, algum erro aconteceu. Desculpe =/');
				});
			}
		});
	};
};