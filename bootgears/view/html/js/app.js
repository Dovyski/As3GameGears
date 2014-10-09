var AS3GAMEGEARS = new function() {
	this.createMarkdownTextarea = function(theTextId) {
		$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
			var aActiveTab 	= e.target + '';
			var aOldTab 	= e.relatedTarget + '';

			aActiveTab 		= aActiveTab.substr(aActiveTab.lastIndexOf('#'));
			aOldTab 		= aOldTab.substr(aOldTab.lastIndexOf('#'));

			if(aActiveTab.indexOf('view-markdown') != -1) {
				$(aActiveTab).html('<i class="fa fa-circle-o-notch fa-spin"></i> Loading...');

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
	
	this.saveItem = function(theDomId, theItemId) {
		console.log(theItemId, $('#' + theDomId).val());
		$.ajax({
		  type: 'POST',
		  url: 'ajax-edit.php',
		  data: {'action': 'savetext', 'id': theItemId, 'content': $('#' + theDomId).val() }
		})
		.done(function( msg ) {
			console.log(msg);
		})
		.fail(function(jqXHR, textStatus) {
			console.log('Something went wrong!');
		});
	};
};