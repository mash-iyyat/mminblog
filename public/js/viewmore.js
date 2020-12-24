let pageNumber = 2;

class Blog {
	constructor(title, content, id, createdAt, userName, image) {
		this.title = title;
		this.content = content;
	  this.image = image;
		this.id = id;
		this.createdAt = createdAt;
		this.userName = userName; 
	}

	blogCard() {
		return `
			<div class="col">
        <a href="blog/view=${this.id}" class="blog-cards">
          <div class="card">
            <div class="card-content">
              <p>${this.userName}</p>
              <p class="posted-at">${this.createdAt}</p>
              <p class="card-blog-title">${this.title}</p>
              <p class="blog-content">${this.content}</p>
            </div>
          </div>  
        </a>
      </div>
		`
	}

	blogCardWithImage() {
		return `
			<div class="col">
        <a href="blog/view=${this.id}" class="blog-cards">
          <div class="card">
	          <div class="card-image">
              <img src="storage/images/blog_images/${this.image}">
            </div>
            <div class="card-content">
              <p>${this.userName}</p>
              <p class="posted-at">${this.createdAt}</p>
              <p class="card-blog-title">${this.title}</p>
              <p class="blog-content">${this.content}</p>
            </div>
          </div>  
        </a>
      </div>
		`
	}
}

$('#view-more-btn').on('click', e => {
	$.ajax({
		type:'GET',
		url:`${url}/blog/paginate?page=${pageNumber}`
	}).done(res => {	
		if (res.data.length === 0) {
			Materialize.toast("All blogs loaded", 2000);
		}
		console.log(res);
		pageNumber = pageNumber + 1;
		for(var x in res.data) {
			let blog = new Blog(res.data[x].title,res.data[x].content,res.data[x].id,res.data[x].created_at,res.data[x].user.username, res.data[x].image);
			if (res.data[x].image === 'no-image.jpg') {
				$('.blog-container').append(blog.blogCard());
			}else {
			  $('.blog-container').append(blog.blogCardWithImage());
			}
		}
	}).fail(err => {
		console.log(err);
	})
});

$('#view-more-profile-btn').on('click', e => {
	$.ajax({
		type:'GET',
		url:`${url}/blog/profile/myblogs?page=${pageNumber}`
	}).done(res => {
		console.log(res);
		if (res.data.length === 0) {
			Materialize.toast("All blogs loaded", 2000);
		}
		pageNumber = pageNumber + 1;
		for(var x in res.data) {
			let myBlogs = new Blog(res.data[x].title,res.data[x].content,res.data[x].id,res.data[x].created_at,res.data[x].user.username, res.data[x].image);
			if (res.data[x].image === 'no-image.jpg') {
				$('.newPost').prepend(myBlogs.blogCard());
			}else {
			  $('.newPost').prepend(myBlogs.blogCardWithImage());
			}
		}
	}).fail(err => {
		console.log(err);
	})
});