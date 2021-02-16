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
            <a href="blog/read/${this.slug}" class="btn btn-flat blue waves-effect waves-light"> Read Blog</a>
          </li>
        </ul> 
		`
	}
}

class PinnedBlog {
	constructor(id, title, userName, slug) {
		this.id = id;
		this.title = title.substring(0, 45) + "...";;
		this.username = userName;
		this.slug = slug;
	}

	pinnedBlogCollection() {
		return	`
			<a href="/blog/read/${this.slug}" class="collection-item black-text">
				<i class="fa fa-chevron-right"></i> ${this.title}
			</a>
		`;
	}
}

$(document).ready(function() {
	swal("Loading....", {
		button: false,
	});
	getBlogs();
	getPinnedBlogs()
})

let blogsUrl = `${url}/blog/json?page=1`;
function getBlogs() {
	$.ajax({
		type:'GET',
		url:blogsUrl
	}).done(res => {
		blogsUrl = res.blogs.next_page_url
		if(res.blogs.next_page_url == null) {
			$('#view-more-btn').remove();
		}
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
		Materialize.toast("Something is wrong",3000,'red lighten-1');
		console.log(err)
	})
}

$('#view-more-btn').on('click', function() {
	getBlogs()
})

let pinnedBlogUrl = `${url}/blog/json/pinned-blogs?page=1`;
function getPinnedBlogs(){
	$.ajax({
		type:'get',
		url:pinnedBlogUrl
	}).done((res) => {
		console.log(res);
		pinnedBlogUrl = res.pinned_blogs.next_page_url;
		if(res.pinned_blogs.next_page_url == null) {
			$('#view-more-pinned-blog').remove();
		}
		for(var x in res.pinned_blogs.data) {
			let pinnedBlog1 = new PinnedBlog(
				res.pinned_blogs.data[x].id,
				res.pinned_blogs.data[x].title,
				res.pinned_blogs.data[x].user.username,
				res.pinned_blogs.data[x].slug,
			)
			$('#pinned-blog-container').append(pinnedBlog1.pinnedBlogCollection());
		}
	}).fail((err) => {
		Materialize.toast("Something is wrong",3000,'red lighten-1');
		console.log(err);
	});
}

$('#view-more-pinned-blog').on('click', function() {
	getPinnedBlogs();
});