$(document).ready(function() {
 	$('.button-collapse').sideNav();
 		var yesterday = new Date((new Date()).valueOf()-1000*60*60*24);
	$('.dropdown-button').dropdown({
	  inDuration: 300,
	  outDuration: 225,
	  constrain_width: false, // Does not change width of dropdown to that of the activator
	  hover: true, // Activate on hover
	  gutter: 0, // Spacing from edge
	  belowOrigin: false, // Displays dropdown below the button
	  alignment: 'left' // Displays dropdown with edge aligned to the left of button
	}
	);
 });