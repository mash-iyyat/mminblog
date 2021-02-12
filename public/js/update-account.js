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

$('#update-profile-form').on('submit', function(e) {
	e.preventDefault();
	let imageData = new FormData(this);
	$.ajax({
		type:'POST',
		url:`${url}/profile/update/image`,
		data:imageData,
		contentType:false,
		cache:false,
		processData:false
	}).done(res => {
		Materialize.toast("Profile image Updated", 2000);
		console.log(res)
	}).fail(err => {
		console.log(err)
	});
});

$(document).ready(function() {
  $('#reset-password-btn').on('click', function() {
	swal({
		content: {
		    element: "input",
		    attributes: {
		    placeholder: "Type your password",
		    type: "password",
		  },
		},
	  }).then((value) => {
		if(value) {
			$.ajax({
			type:'post',
			url:`${url}/profile/check-password`,
			data: {
				password: value,
				_token:$('input[name=_token]').val()
			}
			}).done(res => {
				swal({
					content: {
						element: "input",
						attributes: {
						placeholder: "Enter your new password",
						type: "password",
						},
					},
				}).then((newPassword) => {
					if(newPassword) {
						$.ajax({
							type:'post',
							url:`${url}/profile/update-password`,
							data: {
							password: newPassword,
							_token:$('input[name=_token]').val()
							}
						}).done(res => {
							Materialize.toast(res.message,3000,'blue lighten-1 white-text')
							console.log(res);
						}).fail(err => {
							console.log(err);
						})/*================ UPDATE PASSWORD ===============*/		
					}/*================ IF NEW PASSWORD HAS VALUE ===============*/	
				});
			}).fail(err => {
			  Materialize.toast(err.responseJSON.error, 3000, 'red lighten-1 white-text');
			});/*================ CHECK PASSWORD IF MATCHED ===============*/
		}/*================ IF PASSWORD HAS VALUE ===============*/
	  }).catch((err) => {
		 console.log(err)
	  })
  })
})