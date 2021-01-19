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
			$(this).reset();
			Materialize.toast("Post Created",3000);
		}).fail(err => {
			console.log(err);
		})
	});

});

function deleteBlog(id) {
	swal({
    title: "Are you sure ?",
    text: "The selected product will be deleted",
    icon: "warning",
    buttons: true,
    dangerMode: true
  }).then((willDelete) => {
  	if (willDelete) {
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
			});	/* ajax */
  	}/* if user clicks delete */
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

function pinBlog(id) {
	$.ajax({
		type:'POST',
		url:`${url}/blog/pin/${id}`,
		data: {
			_token: $('input[name=_token]').val()
		}
	}).done(res => {
		$('#pin-btn').remove();
		Materialize.toast("Blog pinned", 1000);
		$('.pin-container').append(`
			<a class="chip btn btn-flat red darken-1 waves-effect waves-light white-text" onclick="unpinBlog('${id}')" id="pin-btn">
        <i class="fa fa-thumb-tack"></i>
      </a> 
		`);
		console.log(res);
	}).fail(err => {
		console.log(err);
	})
}

function unpinBlog(id) {
	$.ajax({
		type:'POST',
		url:`${url}/blog/unpin/${id}`,
		data: {
			_token: $('input[name=_token]').val()
		}
	}).done(res => {
		$('#pin-btn').remove();
		Materialize.toast("Blog unpinned", 1000);
		$('.pin-container').append(`
			<a class="chip btn btn-flat green darken-1 waves-effect waves-light white-text" onclick="pinBlog('${id}')" id="pin-btn">
        <i class="fa fa-thumb-tack"></i>
      </a> 
		`);
	}).fail(err => {
		console.log(err);
	})
}