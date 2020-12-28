const url = location.protocol +'//'+location.host;

$(document).ready(function() {
	$(".button-collapse").sideNav();
	$('.modal').modal();
	$('.parallax').parallax();
});

// var macy = Macy({
//     container: '#macy-container',
//     trueOrder: false,
//     waitForImages: true,
//     margin: 0,
//     columns: 2,
//     breakAt: {
//         1200: 2,
//         940: 2,
//         520: 1,
//         400: 1
//     }
// });