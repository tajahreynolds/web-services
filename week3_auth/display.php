<?php
// start the session
session_start();
if (!isset($_SESSION['username'])){
    header("Location: index.php");
    error_log("logout from display: no session username set");
    exit();
}
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
    <script>
        // function to delete kv pairs from http://campbest.451.csi.miamioh.edu/button.php
        function deleteEvent(event) {
            console.log("key is " + $(this).attr('key'));
            $("#msg").append("<ul>Key is " + $(this).attr('key') + "</ul>");
        }
        $(document).ready(() => {
                $(".delete").click(deleteEvent);
        });
    </script>
    
</head>

<body onbeforeunload="<?php error_log("logout"); ?>">
    <header>User: <?php print($username) ?></header>
    <div>
        <table>
            <tr><th>Key</th><th>Value</th></tr>
            <tbody id="pairs"></tbody>
        </table>
        <div id="msg"></div>
    </div>

    <script>
        // set ajax params
        let settings = {
            "url": "http://ceclnx01.cec.miamioh.edu/~campbest/cse451-campbest-web-public-2021/week2/week2-rest.php/api/v1/info",
            "method": "GET",
            "timeout": 0,
        };
        // send query
        $.ajax(settings).done(function (response) {
            for (let key in response.keys) {
                addToTable(key);
            }
        }).fail(function (error) {
                <?php error_log(error) ?>
        });
        function addToTable(key) {
            // set ajax params
            let settings = {
                "url": "http://ceclnx01.cec.miamioh.edu/~campbest/cse451-campbest-web-public-2021/week2/week2-rest.php/api/v1/info",
                "method": "GET",
                "timeout": 0,
            };
            // send query and process response
            $.ajax(settings).done(function (response) {
                $("#pairs").append("<tr><td>" + key + "</td><td>" + response.value + "</td><td><button class='delete' key=" + key + " onclick='deleteEvent()'>Delete</button></td></tr>");
            }).fail(function (error) {
                console.error(error);
                <?php error_log("unable to query") ?>
            });
        }
        
        
</script>
</body>
</html>
