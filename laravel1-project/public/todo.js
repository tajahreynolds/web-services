$(document).ready(() => {
	$.ajax({
		url: 'api/todo'
	}).done(function(data) {
		for (i = 0; i < data.tasks.length; i++) {
			$("#tasks").append("<li>" + data.tasks[i] + "</li>");
		}
	}).error(function(error) {
		console.error(error);
		$("#msg").html("Error retrieving data");
	});
});
