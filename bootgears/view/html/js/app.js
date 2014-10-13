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
	
	this.saveEntry = function(theEntryId, theEntryType) {
		var aData = {};
		
		$('.editable').each(function() {
			aData[$(this).attr('name')] = $(this).val();
		});
		
		aData['action'] = 'save';
		aData['id'] 	= theEntryId;
		aData['type'] 	= theEntryType;
		
		console.log(theEntryId, theEntryType, aData);

		$.ajax({
		  type: 'POST',
		  url: 'ajax-edit.php',
		  data: aData
		})
		.done(function( msg ) {
			console.log(msg);
		})
		.fail(function(jqXHR, textStatus) {
			console.log('Something went wrong!');
		});
	};
};