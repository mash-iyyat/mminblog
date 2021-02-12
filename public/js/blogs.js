class Blog {
	constructor(title, content, id, createdAt, userName, image, commentCount, slug) {
		this.title = title;
		this.content = content.substring(0, 200) + "...";
		this.image = image;
		if(image != 'no-image.jpg') {
			this.image = `
			<li>
				<img src="storage/images/blog_images/${this.image}" style="width:100%">
			</li> 
			`
		}else {
			this.image = "";
		}
		this.id = id;
		this.createdAt = createdAt;
		this.userName = userName; 
		this.commentCount = commentCount;
		this.slug = slug;
	}

	blogCard() {
		return `
		<ul class="collection with-header">
          <li class="collection-header center">
			<h4 class="card-blog-title">${this.title}</h4>
			<span>Posted by ${this.userName}</span>
          </li>
		  ${this.image}
          <li class="collection-item" style="text-align:justify">
            <p class="blog-content">${this.content}</p>
          </li>
          <li class="collection-item center">
            <i class="fa fa-comment"></i> ${this.commentCount} comments
          </li>
          <li class="collection-item white-text view-blog-item">
            <a href="blog/read/${this.slug}" class="btn btn-flat blue waves-effect waves-light" target="_blank"> Read Blog</a>
          </li>
        </ul> 
		`
	}
}
let paginationNumber = 1;
$(document).ready(function() {
	getBlogs(paginationNumber);
})

function getBlogs(pageNumber) {
	swal("Getting blogs...",{
		buttons:false,
		closeOnClickOutside:false,
		closeOnEscape:false,
		icon:"info"
	});
	$.ajax({
		type:'GET',
		url:`${url}/blog/json?page=${pageNumber}`
	}).done(res => {
		if(res.blogs.data.length == 0) {
			Materialize.toast("All blogs are loaded", 3000, 'blue lighten-1')
			$('#view-more-btn').remove()
		}
		paginationNumber = paginationNumber + 1;
		console.log(paginationNumber)
		swal.close()
		for(var x in res.blogs.data) {
			let blog1 = new Blog(
				res.blogs.data[x].title, 
				res.blogs.data[x].content, 
				res.blogs.data[x].id, 
				res.blogs.data[x].created_at, 
				res.blogs.data[x].user.username, 
				res.blogs.data[x].image, 
				res.blogs.data[x].comments.length,
				res.blogs.data[x].slug, 
			)
			$('.blog-container').append(blog1.blogCard());
		}
	}).fail(err => {
		swal("Something is wrong",{
			buttons:false,
			closeOnClickOutside:false,
			closeOnEscape:false,
			icon:"warning"
		});
		console.log(err)
	})
}

$('#view-more-btn').on('click', function() {
	getBlogs(paginationNumber)
})