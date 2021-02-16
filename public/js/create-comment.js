class Comment {
	constructor(id, comment, username, created_at, auth) {
		this.id = id;
		this.comment = comment;
		this.username = username;
		this.created_at = created_at;
		if(auth == true) {
		  this.auth = `
			<a class='red-text secondary-content delete-comment' onclick="deleteComment('${this.id}')">
			  <i class="fa fa-trash"></i>
			</a>
		  `;
		}else { 
		  this.auth = "" ;
		}
 	}

 	commentCard() {
 		return `
			<li class="collection-item avatar" id="comment-${this.id}">
				<img src="/images/no-image.jpg" alt="" class="circle">
				<span class="title"><b>${this.username}</b></span>
				${this.auth}
				<p>${this.comment}</p>
			</li>
			`;
 	}
}

$('#add-comment-form').on('submit', function(e) {
	e.preventDefault();
	let commentData = new FormData(this);
	swal("Adding comment...",{
	  buttons:false,
	  closeOnClickOutside:false,
	  closeOnEscape:false,
	  icon:"info"
	});
	$.ajax({
		type:'POST',
		url:`${url}/comment/create`,
		contentType: false,
		cache: false,
		processData:false,
		data: commentData
	}).done(res => {
		swal.close();
		getCommentCount(res.count)
		$('#comment').val("");
		Materialize.toast('Comment Added',2000);
		let comment1 = new Comment(
			res.comment.id, 
			res.comment.comment, 
			res.user.username, 
			res.comment.created_at,res.authorized
		);
		$('.comments-container').prepend(comment1.commentCard());
	}).fail(err => {
		Materialize.toast('Something is wrong',3000,'red lighten-1 white-text');
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
			data: { token: $('input[name=_token]').val() }
		}).done(res => {
			getCommentCount(res.count)
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
  swal("Getting comments...",{
	buttons:false,
	closeOnClickOutside:false,
	closeOnEscape:false,
	icon:"info"
  });
  $.ajax({
	type:'GET',
	url:`${url}/blog/comments/${id}`
  }).done((res) => {
	swal.close();
	getCommentCount(res.count)
	commentsUrl = res.comments.next_page_url;
	appendComment(res);
  }).fail((err) => {
	console.log(err);
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
	  swal("Getting comments...",{
		buttons:false,
		closeOnClickOutside:false,
		closeOnEscape:false,
		icon:"info"
	  });
	  $.ajax({
		type:'GET',
		url:commentsUrl
	  }).done((res) => {
		swal.close();
		getCommentCount(res.count);
		if(res.comments.next_page_url === null) {
		  $('.view-more-comment-btn').remove();
		}
		commentsUrl = res.comments.next_page_url;
		appendComment(res);
	  }).fail((err) => {
		console.log(err)
	  })
	});
});

function appendComment(response) {
  for(var x in  response.comments.data) {
	let comment1 = new Comment(
	  response.comments.data[x].id, 
	  response.comments.data[x].comment, 
	  response.comments.data[x].user.username, 
	  response.comments.data[x].created_at ,
	  response.authorized 
	)
	$('.comments-container').append(comment1.commentCard())
  }
}
