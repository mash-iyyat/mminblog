class Comment {
	constructor(id, comment, username, created_at) {
		this.id = id;
		this.comment = comment;
		this.username = username;
		this.created_at = created_at;
 	}

 	commentCard() {
 		return `
				<div class="card" id="comment-c-${this.id}">
          <div class="col s2 v-comment-profile">
            <img src="${url}/images/no-image.jpg">
          </div>
          <div class="card-content">
            <p class="card-title v-comment-name">${this.username}</p>
            <p>${this.comment}</p>
          </div>
          <div class="card-action">
            <button class="btn-flat btn white-text waves-effect waves-light red" onclick="deleteComment('${this.id}')">
              <i class="fa fa-trash"></i>
            </button>
          </div>
        </div>
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
				$(`#comment-c-${id}`).remove();
			}).fail(err => {
				console.log(err);
			});	/* ajax */
  	}/* if user clicks delete */
  });
	
}