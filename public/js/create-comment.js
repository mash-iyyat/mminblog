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
		$('#comments-container').prepend(
			`
				<div class="col s12" id="comment-c-${res.comment.id}">
          <div class="col s2 v-comment-profile">
            <img src="${url}/images/no-image.jpg">
          </div>
          <div class="card col s10">
            <div class="card-content v-comment-card">
              <p class="card-title v-comment-name">${res.user[0].username}</p>
              <p>${res.comment.comment}</p>
            </div>
          </div>  
          <button class="btn btn-flat red white-text" onclick="deleteComment('{{$comment->id}}')">Delete</button>
        </div>
			`
			);
		console.log(res);
	}).fail(err => {
		console.log(err);
	});

})


function deleteComment(id) {
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