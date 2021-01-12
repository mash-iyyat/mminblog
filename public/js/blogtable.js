let tableNumber = 2;
class BlogTable {
	constructor(title, content, id, createdAt, userName, image) {
		this.title = title;
		this.content = content;
	  this.image = image;
		this.id = id;
		this.createdAt = createdAt;
		this.userName = userName;
		this.image = image;
	}

	tableRow() {
		return `
			<tr>
	      <td id='td-${this.id}'>${this.title}</td>
	      <td id='td-${this.id}'>${this.createdAt}</td>
	      <td id='td-${this.id}'>
	      	<button class="btn-flat btn waves-effect waves-light white-text red">
	      		<i class="fa fa-trash"></i>
	      	</button>
	      	<button class="btn btn-flat green darken-3 white-text modal-trigger" onclick="editRow('${this.id}')"  href="#edit-blog-modal">
		      	<i class="fa fa-pencil"></i>
		      </button>
	      </td>
	    </tr>
		`
	}

}

function editRow(id)
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

$('#view-more-btn').on('click', function() {
	$.ajax({
		type:'GET',
		url:`${url}/blog/paginate?page=${tableNumber}`,
	}).done(res => {
		if (res.data.length === 0) {
			Materialize.toast("All blogs loaded", 2000);
		}
		console.log(res)
		tableNumber = tableNumber + 1
		for(var x in res.data) {
			let newBlogTable = new BlogTable(res.data[x].title,res.data[x].content,res.data[x].id,res.data[x].created_at,res.data[x].user.username, res.data[x].image);
			$('#blog-tbl-body').append(newBlogTable.tableRow());
		}
	}).fail(err => {
		console.log(err)
	});
})

$('#edit-blog-form').on('submit',function(e) {
	e.preventDefault();
	let editBlogData = new FormData(this)
	$.ajax({
		type:'POST',
		data: editBlogData,
		url:`${url}/blog/update/${blogResponse.blog.id}`,
		cache:false,
		contentType:false,
		processData: false,
	}).done(res => {
		$('#edit-blog-modal').modal('close');
		Materialize.toast("Blog Updated!",3000);
		console.log(res)
	}).fail(errr => {
		console.log(err)
	});
});



