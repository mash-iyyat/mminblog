let pageNumber = 2;

class Blog {
	constructor(title, content, id, createdAt, userName) {
		this.title = title;
		this.content = content;
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
}


$('#view-more-btn').on('click', e => {
	Materialize.toast("WORKING");
	$.ajax({
		type:'GET',
		url:`${url}/blog/paginate?page=${pageNumber}`
	}).done(res => {	
		console.log(res);
		pageNumber = pageNumber + 1;
		for(var x in res.data) {
			let blog = new Blog(res.data[x].title,res.data[x].content,res.data[x].id,res.data[x].created_at,res.data[x].user.username);
			$('.blog-container').prepend(blog.blogCard()).fadeIn(1000);
		}
	}).fail(err => {
		console.log(err);
	})
});