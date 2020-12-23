const url = location.protocol +'//'+location.host;
$(document).ready(function() {

	$('#create-blog-form').on('submit', function(e) {
		e.preventDefault();
		let blogData = new FormData(this);
		$.ajax({
			type:'POST',
			url:`${url}/blog/create`,
			contentType: false,
      cache: false,
      processData: false,
			data:blogData
		}).done(res => {
			console.log(res);
			$('#create-blog-modal').modal('close');
			$('#title').val("");
			$('#content').val("");
			Materialize.toast("Post Created",3000);
		}).fail(err => {
			console.log(err);
		})
	});

});