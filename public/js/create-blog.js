$(document).ready(function() {
	let requestUrl = "";
	let blogId = "";
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
				$('#blog-container').prepend(blog.blogCard());
			}else {
			  $('#blog-container').prepend(blog.blogCardWithImage());
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


function deleteBlog(id) {
	$.ajax({
		type:'DELETE',
		url:`${url}/blog/delete/${id}`,
		data: {
			_token: $('input[name=_token]').val()
		}
	}).done(res => {
		Materialize.toast("Blog Deleted",2000);
		$(`#blog-container-${id}`).fadeOut(500);
	}).fail(err => {
		console.log(err);
	});
}

function editPost(id)
{
	$.ajax({
		type:'GET',
		url:`${url}/blog/find/${id}`
	}).done(res => {
		blogResponse = res;
		console.log(blogResponse);
	  $('#edit-title').val(res.blog.title);
	  $('#edit-content').val(res.blog.content);
	}).fail(err => {
		console.log(err);
	});
}


$('#edit-blog-form').on('submit', function(e) {
	e.preventDefault();
	let editedBlogData = new FormData(this);
	$.ajax({
		type:'POST',
		data: editedBlogData,
		url:`${url}/blog/update/${blogResponse.blog.id}`,
		cache:false,
		contentType:false,
		processData: false,
	}).done(res => {
		Materialize.toast("Blog updated",2000);
		$(`#blog-card-${blogResponse.blog.id}`).remove();
		let editedBlog = new Blog(res.blog.title,res.blog.content,res.blog.id,res.blog.created_at,res.user[0].username, res.blog.image)
		if (res.blog.image === 'no-image.jpg') {
			$('#blog-container-'+res.blog.id).prepend(editedBlog.blogCard());
		}else {
		  $('#blog-container-'+res.blog.id).prepend(editedBlog.blogCardWithImage());
		}

		$('#edit-blog-modal').modal('close');
		$('#edit-title').val("");
		$('#edit-content').val("");
		console.log(res);
	}).fail(err => {
		console.log(err);
	});

});	