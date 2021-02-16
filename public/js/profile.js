class ProfileBlog {
	constructor(title, content, id, createdAt, userName, image, commentCount, slug, pinned) {
		this.title = title;
		this.content = content.substring(0, 150) + "...";
		this.image = image;
		if(image == 'no-image.jpg') {
		  this.image = '';
		}else {
		  this.image = `
		    <img src="/storage/images/blog_images/${this.image}" style="width:100%">
		  `
		}
		this.id = id;
		this.createdAt = createdAt;
		this.userName = userName; 
		this.commentCount = commentCount;
		this.slug = slug;
		if(pinned == true) {
			let pin = new PinButton(this.id)
			this.pinned = pin.unpinButton()
		}else {
			let pin = new PinButton(this.id)
			this.pinned = pin.pinButton()
		}
	}

	blogCard() {
		return `
		<li id="blog-${this.id}">
            <div class="card">
                <div class="card-content">
                    <a class="secondary-content blue-text" href="/blog/edit/${this.slug}"><i class="fa fa-pencil"></i></a>
                    <a onclick="deleteBlog('${this.id}')" class="secondary-content red-text"><i class="fa fa-trash"></i></a>
                    <h5>${this.title}</h5>
					${this.image}
					<p>${this.content}</p>
                </div>
                <div class="card-action">
                    <a target="_blank" href="${url}/blog/read/${this.slug}" class="btn btn-flat blue lighten-1 waves-effect waves-light white-text" style="width:49%">
                    read blog
					</a>
					<span class="pin-container-${this.id}">${this.pinned}</span>
                </div>
            </div>
        </li>
		`
	}
}

class PinButton {
	constructor(id) {
		this.id = id;
	}
	pinButton() {
		return `
		<button class="btn btn-flat blue lighten-1 waves-effect waves-light white-text" style="width:49%" onclick="pinBlog('${this.id}')" id="pin-btn-${this.id}">
			Pin blog
		</button>
		`;
	}

	unpinButton() {
		return `
		<button class="btn btn-flat red lighten-1 waves-effect waves-light white-text" style="width:49%" onclick="unpinBlog('${this.id}')" id="pin-btn-${this.id}">
			Unpin blog
		</button>
		`;
	}
}

$(document).ready(function() {
  getProfileBlogs(paginationNumber)
})

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
			console.log(res);
			$('#create-modal').modal('close');
			$('#create-title').val('');
			$('#create-content').val('')
			Materialize.toast("Blog added", 3000);
			let blog1 = new ProfileBlog(
              res.blog.title, 
              res.blog.content, 
              res.blog.id, 
              res.blog.createdAt, 
              res.user.username, 
              res.blog.image, 
              res.comments.length, 
			  res.blog.slug,
			  res.blog.pinned
            )
			$('.blog-collection-container').prepend(blog1.blogCard())
		}).fail(err => {
			swal.close()
			for(var x in err.responseJSON.errors) {
				Materialize.toast(err.responseJSON.errors[x], 3000, 'red lighten-1');
			}
			console.log(err);
		})
	});

	$('.load-more-btn').on('click', function() {
	  getProfileBlogs(paginationNumber)
	});

})/* =============== GET AND LOAD MORE BLOGS =================*/

//================ FUNCTIONS ====================
let paginationNumber = 1;
function getProfileBlogs(pagenumber) {
	swal("Please wait...",{
		buttons:false,
		closeOnClickOutside:false,
		icon:"info"
	});
    $.ajax({
      type:'GET',
      url:`${url}/blog/json/profile?page=${pagenumber}`
    }).done(res => {
	  if(res.blogs.data.length === 0) {
		$('.load-more-btn').remove();
		Materialize.toast("All blogs are loaded",3000,'blue lighten-1');
	  }
	  paginationNumber = paginationNumber + 1;
	  console.log(res)
	  swal.close()
      for(var x in res.blogs.data) {
        let blog1 = new ProfileBlog(
          res.blogs.data[x].title, 
          res.blogs.data[x].content, 
          res.blogs.data[x].id, 
          res.blogs.data[x].createdAt, 
          res.blogs.data[x].user.userName, 
          res.blogs.data[x].image, 
          res.blogs.data[x].comments.length, 
		  res.blogs.data[x].slug,
		  res.blogs.data[x].pinned
        )
        $('.blog-collection-container').append(blog1.blogCard())
      }
    }).fail(err => {
      console.log(err)
    })
}

function deleteBlog(id) {
	swal({
		text:"Are you sure?",
		icon:'warning',
		buttons: {
			cancel: {
			  text: "Cancel",
			  className: "blue white-text lighten-1 waves-effect waves-light",
			  closeModal:true,
			  visible:true
			},
			confirm: {
			  text: "Confirm",
			  className: "red lighten-1 waves-effect waves-light",
			}
		},
	}).then((willDelete) => {
		if(willDelete){
			$.ajax({
			  type:'DELETE',
			  url:`${url}/blog/delete/${id}`,
			  data: {
				_token:$('input[name=_token]').val()
			}
			}).done(res => {
			  Materialize.toast("Blog removed", 3000, 'blue lighten-1');
			  $(`#blog-${id}`).remove();
			}).fail(err => {
			  console.log(err)
			});
		}/* ================= IF USER WILL CONFIRM DELETE ==============*/	
	}).catch((err) => {
		console.log(err);
	});
}

function pinBlog(id) {
  $.ajax({
	type:'post',
	url:`${url}/blog/pin/${id}`,
	data: {
		_token:$('input[name=_token]').val()
	}
  }).done((res) => {
	  Materialize.toast("Pinned",2000);
	  $(`#pin-btn-${id}`).remove();
	  let pinButton1 = new PinButton(id);
	  $(`.pin-container-${id}`).append(pinButton1.unpinButton());
	  console.log(res)
  }).fail((err) => {
	  console.log(err)
  })
}

function unpinBlog(id) {
	$.ajax({
	  type:'post',
	  url:`${url}/blog/unpin/${id}`,
	  data: {
		  _token:$('input[name=_token]').val()
	  }
	}).done((res) => {
		Materialize.toast("Unpinned",2000);
	    $(`#pin-btn-${id}`).remove();
	    let pinButton1 = new PinButton(id);
	    $(`.pin-container-${id}`).append(pinButton1.pinButton());
	    console.log(res)
	}).fail((err) => {
		console.log(err)
	})
}