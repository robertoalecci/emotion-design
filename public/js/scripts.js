$(document).ready(function(){
    
    //Gestione dei messaggi di feedback
    $feedback_msg = $('.admin-feedback-message');
    //Se è presente il messaggio
    if($feedback_msg.length){
        $feedback_msg.css({visibility: "visible"}).animate({ opacity: 1 }, 500, function() {
            setTimeout(function() {
                $feedback_msg.animate({ opacity: 0 }, 500, function() { $feedback_msg.css({visibility: "hidden"}) });
            }, 5000);
        });
    }

});