<?php
// start the session
session_start();
if (!isset($_SESSION['username'])){
    header("Location: index.php");
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
    <script>
        // set ajax params
        let settings = {
            "url": "http://ceclnx01.cec.miamioh.edu/~campbest/cse451-campbest-web-public/week2/week2-rest.php/api/v1/info",
            "method": "GET",
            "timeout": 0,
        };
        // send query
        $.ajax(settings).done(function (response) {
            for (let key in response.keys) {
                addToTable(key);
            }
        });
        function addToTable(key) {
            // set ajax params
            let settings = {
                "url": "http://ceclnx01.cec.miamioh.edu/~campbest/cse451-campbest-web-public/week2/week2-rest.php/api/v1/info",
                "method": "GET",
                "timeout": 0,
            };
            // send query and process response
            $.ajax(settings).done(function (response) {
                $("#pairs").append("<tr><td>" + key + "</td><td>" + response.value + "</td></tr>");
            }).fail(function (error) {
                console.error(error);
            });
        }

    </script>
</head>

<body>
    <header><?php print($username) ?></header>
    <div>
        <table>
            <tr><th>Key</th><th>Value</th></tr>
            <tbody id="pairs"></tbody>
        </table>
    </div>

</body>
</html>