$('#update-account-form').on('submit', function(e) {
	e.preventDefault();
	let updateData = new FormData(this);
	$.ajax({
		type:'POST',
		url:`${url}/profile/update/account`,
		contentType:false,
		cache:false,
		processData:false,
		data: updateData
	}).done(res => {
		Materialize.toast("Account Updated", 2000);
		$('#firstname').val(res.firstname);
		$('#lastname').val(res.lastname);
		$('#username').val(res.username);
		console.log(res);
	}).fail(err => {
		console.log(err);
	});

});