function resize() {
  	if (document.body.clientWidth > 1200) {
  		document.getElementById("sidebar").style.display = "block";
	} else {
		document.getElementById("sidebar").style.display = "none";
	}
}

$('#shrink').click(function(event) {
    document.getElementById("sidebar").style.display = "none";
});

$('#unshrink').click(function(event) {
    document.getElementById("sidebar").style.display = "block";
});

window.onresize = resize();