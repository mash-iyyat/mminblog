const url = location.protocol +'//'+location.host;

$(document).ready(function() {
	$(".button-collapse").sideNav();
	$('.modal').modal();
	$('.parallax').parallax();
});

function loader() {
  swal({
	text:'Loading....',
	button:false
  });
}