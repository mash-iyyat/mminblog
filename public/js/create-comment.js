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
        <span class="title"><b>${this.username}</b> | ${this.created_at}</span>
        <p>
          ${this.comment}
        </p>
        <a onclick="deleteComment('${this.id}')" class="secondary-content">
          <i class="fa fa-trash red-text"></i>
        </a>
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
		$('#comment').val("");
		Materialize.toast('Comment Added',2000);
		let commentDataCard = new Comment(res.comment.id, res.comment.comment, res.user[0].username, res.comment.created_at);
		$('#comments-container').prepend(commentDataCard.commentCard());
		console.log(res);
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
				Materialize.toast("Comment Deleted",2000);
				$(`#comment-${id}`).remove();
			}).fail(err => {
				console.log(err);
			});	/* ajax */
  	}/* if user clicks delete */
  });
	
}