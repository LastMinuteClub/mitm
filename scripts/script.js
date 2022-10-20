function getCurrentTime(){
    var date = new Date();
    var currentTime = date.getTime();
    // document.getElementById("time").val(currentTime);
    $('#time').val(currentTime);
}
getCurrentTime();

function submitLatency(){
    getCurrentTime();
    var message = $('#message').val();

    if(message == ""){
        $('#error-message').show();
    } else {
        $('#message-copy').val($('#message').val());
        $('#note-form-latency').submit();
    }
}