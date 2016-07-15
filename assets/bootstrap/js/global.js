$(document).ready(function(){
	
	var users = new Bloodhound({

		datumTokenizer: Bloodhound.tokenizers.obj.whitespace('username'),
		queryTokenizer:  Bloodhound.tokenizers.obj.whitespace,
		remote: 'users.php?query=%QUERY'
		)};
		users.initialize();

		$('#users').typeahead({

			hint: true,
			highlight: true,
			minLength: 2
		}, {

			name: 'users',
			displayKey: 'username',
			source: users.ttAdapter()

		});
});