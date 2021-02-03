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
			<tr id="tr-${this.id}">
	      <td class='td-${this.id}'>${this.id}</td>
	      <td class='td-${this.id}'>${this.title}</td>
	      <td class='td-${this.id}'>${this.createdAt}</td>
	      <td class='td-${this.id}'>
	      	<button class="btn-flat btn waves-effect waves-light white-text red" onclick="deleteRow('${this.id}')">
	      		<i class="fa fa-trash"></i>
	      	</button>
	      	<button class="btn btn-flat green darken-3 white-text modal-trigger" onclick="editRow('${this.id}')"  href="#edit-blog-modal">
		      	<i class="fa fa-pencil"></i>
		      </button>
	      </td>
	    </tr>
		`
	}

	tableData() {
		return `
			<td class='td-${this.id}'>${this.title}</td>
      <td class='td-${this.id}'>${this.createdAt}</td>
      <td class='td-${this.id}'>
      	<button class="btn-flat btn waves-effect waves-light white-text red" onclick="deleteRow('${this.id}')">
      		<i class="fa fa-trash"></i>
      	</button>
      	<button class="btn btn-flat green darken-3 white-text modal-trigger" onclick="editRow('${this.id}')"  href="#edit-blog-modal">
	      	<i class="fa fa-pencil"></i>
	      </button>
      </td>
		`;
	}
}

$(document).ready(function() {
	$('#create-blog-table-form').on('submit', function(e) {
		e.preventDefault();
		let blogData = new FormData(this)
		swal("Please wait...",{
	    buttons:false,
	    closeOnClickOutside:false,
	    icon:"info"
	  });
		$.ajax({
			type:'POST',
			url:`${url}/blog/create`,
			data: blogData,
			contentType:false,
			cache:false,
			processData:false
		}).done(res => {
			swal.close()
			$('#create-modal').modal('close');
			$('#create-title').val('');
			$('#create-content').val('')
			Materialize.toast("Blog added", 3000);
			let responseBlog = new BlogTable(res.blog.title, res.blog.content, res.blog.id, res.blog.created_at, res.user[0].username, res.blog.image)
			$('#blog-tbl-body').prepend(responseBlog.tableRow());
			console.log(res);
		}).fail(err => {
			console.log(err);
		})
	})
})

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

function deleteRow(id) {
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
				$(`#tr-${id}`).fadeOut(500).remove();
			}).fail(err => {
				console.log(err);
			});	/* ajax */
  	}/* if user clicks delete */
  });
	
}

$('#view-more-btn').on('click', function() {
	swal("Please wait...",{
    buttons:false,
    closeOnClickOutside:false,
    icon:"info"
  });
	$.ajax({
		type:'GET',
		url:`${url}/blog/paginate?page=${tableNumber}`,
	}).done(res => {
		swal.close()
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



