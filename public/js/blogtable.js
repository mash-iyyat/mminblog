
$('#edit-blog-form').on('submit',function(e) {
	e.preventDefault();
	let editBlogData = new FormData(this)
	swal("Updating...",{
    buttons:false,
    closeOnClickOutside:false,
    icon:"info"
  });
	$.ajax({
		type:'POST',
		data: editBlogData,
		url:`${url}/blog/update/${blogResponse.blog.id}`,
		cache:false,
		contentType:false,
		processData: false,
	}).done(res => {
		swal.close()
		$('#edit-blog-modal').modal('close');
		$(`.td-${res.blog.id}`).remove();
		console.log(res)
		let newTd = new BlogTable(res.blog.title, res.blog.content, res.blog.id, res.blog.created_at, res.user[0].username, res.blog.image);
		$(`#tr-${res.blog.id}`).prepend(newTd.tableData());
		Materialize.toast("Blog Updated!",3000);
	}).fail(errr => {
		console.log(err)
	});
});



