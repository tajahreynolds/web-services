$(window).on("load", onReady);

// set ajax parameters
var settings = {
    "url": "http://ceclnx01.cec.miamioh.edu/~reynolt4/cse451-web-public-2021/week2/kv/kv.php/api/v1/info",
    "method": "GET",
    "timeout": 0,
    "headers": {
    "Content-Type": "application/json"
    },
    "data": data,
}

// send data and process response
$.ajax(settings).done(function (response) {
console.log(response);
});

function onReady() {
    $.ajax(settings)
}