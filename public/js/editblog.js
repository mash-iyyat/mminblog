$(document).ready(() => {
    $('#update-blog-form').on('submit', function(e) {
        e.preventDefault();
        let blogData = new FormData(this);
        $.ajax({
            type:'POST',
            url:`${url}/blog/update/${blogId}`,
            data:blogData,
            cache:false,
            contentType:false,
            processData:false
        }).done((res) => {
            swal("Blog updated");
            window.location.replace('/profile');
        }).fail((err) => {
            console.log(err);
        });
    });
});