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
			let blog = new Blog(res.blog.title,res.blog.content,res.blog.id,res.blog.created_at,res.user[0].username, res.blog.image)
			if (res.blog.image === 'no-image.jpg') {
				$('#blog-container').append(blog.blogCard());
			}else {
			  $('#blog-container').append(blog.blogCardWithImage());
			}
			$('#create-blog-modal').modal('close');
			$('#title').val("");
			$('#content').val("");
			Materialize.toast("Post Created",3000);
		}).fail(err => {
			console.log(err);
		})
	});

});