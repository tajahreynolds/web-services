<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>reflect</title>
    <script
			  src="https://code.jquery.com/jquery-3.5.1.min.js"
			  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
			  crossorigin="anonymous"></script>
	<script>
function deleteEvent(event) {
	console.log("key is " + $(this).attr('key'));
	$("#msg").append("<ul>Key is " + $(this).attr('key') + "</ul>");
}
		$(document).ready(() => {
			$(".delete").click(deleteEvent);
		});
	</script>

  </head>
  <body>
<div>
<h1>Click on button example</h1>
</div>
<table>
	<tr><td>one</td><td><button class='delete' key='1'>Delete</button></td></tr>
	<tr><td>two</td><td><button class='delete' key='2'>Delete</button></td></tr>
</table>

<div id='msg'></div>

  </body>
</html>
