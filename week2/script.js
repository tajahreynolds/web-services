/* TaJah Reynolds
    CSE451 Week2 Assignment
    02/09/2021
*/
function onReady() {
    // set ajax params
    let settings = {
        "url": "http://ceclnx01.cec.miamioh.edu/~reynolt4/cse451-reynolt4-web/week2/week2-rest.php/api/v1/info",
        "method": "GET",
        "timeout": 0,
    };
    // send query and process response
    $.ajax(settings).done(function (response) {
        console.log(response.keys);
        for (let key in response.keys) {
            addToTable(key);
        }
    });
}

function addToTable(key) {
    // set ajax params
    let settings = {
        "url": "http://ceclnx01.cec.miamioh.edu/~reynolt4/cse451-reynolt4-web/week2/week2-rest.php/api/v1/info/" + key,
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








$(window).on("load", onReady);