$(document).ready(()=>{
	console.log('ready');
	$(".click").click(showTasks);
});

function showTasks(event) {
	var id = $(this).attr('href');
	$.ajax({
		url: 'api/todo/' + token + '/' + id
	}).done(function(data) {
		$("#tasks").html("");
		console.log("tasks",data);
		var count = Object.keys(data).length;
		console.log(count);
		if (count > 0) {
			for (i = 0; i < data.tasks.length; i++) {
				$("#tasks").append("<li>" + data.tasks[i] + "</li>");
			}
		} else {
			$("#tasks").append("No tasks");
		}
	}).fail(function(error) {
		console.error(error);
		$("#msg").html("Error retrieving");
	});
}
