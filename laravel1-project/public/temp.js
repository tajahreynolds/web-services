function apiCall() {
	var zip = $("#zip")[0].value;
	$.ajax({
		url: "http://reynolt4.451.csi.miamioh.edu/cse451-reynolt4-web/laravel1-project/public/index.php/api/temp/" + zip,
		method: "GET"
	}).done(function(data) {
		$("#temp").text("" + data.temp + " (" + data.status + ")");
		$("#city").text(data.city);
	});
}

setInterval(function(){
	apiCall()
}, 10000)
