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
				<div class="col s12">
          <div class="col s2 v-comment-profile">
            <img src="images/no-image.jpg">
          </div>
          <div class="card col s10">
            <div class="card-content v-comment-card">
              <p class="card-title v-comment-name">${res.user[0].username}</p>
              <p>${res.comment.comment}</p>
            </div>
          </div>  
        </div>
			`
			);
		console.log(res);
	}).fail(err => {
		console.log(err);
	});

})