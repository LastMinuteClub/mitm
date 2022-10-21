function getCurrentTime(){ //Gets current time of user
    var date = new Date();
    var currentTime = date.getTime();
    $('#time').val(currentTime);
}

function submitLatency(){ //
    getCurrentTime();
    var message = $('#message').val();

    if(message == ""){
        $('#error-message').show();
    } else {
        $('#message-copy').val($('#message').val());
        $('#note-form-latency').submit();
    }
}