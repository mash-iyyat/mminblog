class Comment {
	constructor(id, comment, username, created_at) {
		this.id = id;
		this.comment = comment;
		this.username = username;
		this.created_at = created_at;
 	}

 	commentCard() {
 		return `
			<li class="collection-item avatar" id="comment-${this.id}">
				<img src="/images/no-image.jpg" alt="" class="circle">
				<span class="title">${this.username}</span>
				<a class='red-text secondary-content' onclick="deleteComment('${this.id}')">
				<i class="fa fa-trash"></i>
				</a>
				<p>${this.comment}</p>
			</li>
			`
 	}
}

$('#add-comment-form').on('submit', function(e) {
	e.preventDefault();
	let commentData = new FormData(this);
	$.ajax({
		type:'POST',
		url:`${url}/comment/create`,
		contentType: false,
		cache: false,
		processData:false,
		data: commentData
	}).done(res => {
		getCommentCount(res.count)
		$('#comment').val("");
		Materialize.toast('Comment Added',2000);
		let comment1 = new Comment(res.comment.id, res.comment.comment, res.user[0].username, res.comment.created_at);
		$('.comments-container').prepend(comment1.commentCard());
		// console.log(res);
	}).fail(err => {
		console.log(err);
	});
})

function deleteComment(id) {
	swal({
    title: "Are you sure ?",
    text: "The comment will be deleted",
    icon: "warning",
    buttons: true,
    dangerMode: true
  }).then((willDelete) => {
  	if (willDelete) {
	  	$.ajax({
			type:'DELETE',
			url:`${url}/comment/delete/${id}`,
			data: {
				_token: $('input[name=_token]').val()
			}
		}).done(res => {
			getCommentCount(res.count)
			// console.log(res);
			Materialize.toast("Comment Deleted",2000);
			$(`#comment-${id}`).fadeOut(500, () => { $(this).remove() });
		}).fail(err => {
			console.log(err);
		});	/* ajax */
  	}/* if user clicks delete */
  });
}

let commentsUrl = "";
function getComments(id) {
  $.ajax({
	type:'GET',
	url:`${url}/blog/comments/${id}`
  }).done((res) => {
	getCommentCount(res.count)
	// console.log(res);
	commentsUrl = res.comments.next_page_url;
	appendComment(res);
  }).fail((err) => {
	console.log(err)
  })
}

let countComment = '';
function getCommentCount(count) {
  $('#comment-count').remove();
  $('.count-container').append(`
    <p id="comment-count"><i class="fa fa-comment"></i> ${count} comments</p>
  `);
}

$(document).ready(() => {
	$('.view-more-comment-btn').on('click', function() {
	  $.ajax({
		type:'GET',
		url:commentsUrl
	  }).done((res) => {
		getCommentCount(res.count)
		if(res.comments.next_page_url === null) {
		  Materialize.toast("All comments are loaded", 3000, 'blue lighten-1')
		  $('.view-more-comment-btn').remove()
		}
		// console.log(res);
		commentsUrl = res.comments.next_page_url;
		appendComment(res);
	  }).fail((err) => {
		console.log(err)
	  })
	});
  })

function appendComment(response) {
  for(var x in  response.comments.data) {
	let comment1 = new Comment(
	  response.comments.data[x].id, 
	  response.comments.data[x].comment, 
	  response.comments.data[x].user.username, 
	  response.comments.data[x].created_at 
	)
	$('.comments-container').prepend(comment1.commentCard())
  }
}
