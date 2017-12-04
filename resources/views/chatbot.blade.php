@extends('layouts.app')

@section('javascript')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
    (function($) {
    $(document).ready(function() {
        var $chatbox = $('.chatbox'),
            $chatboxTitle = $('.chatbox__title'),
            $chatboxTitleClose = $('.chatbox__title__close'),
            $chatboxCredentials = $('.chatbox__credentials');
        $chatboxTitle.on('click', function() {
            $chatbox.toggleClass('chatbox--tray');
            // to scroll down to the bottom of the chat tray  or chat body
            $('#chatbox_body_content').scrollTop(1E10);
        });
        $chatboxTitleClose.on('click', function(e) {
            //e.stopPropagation();
            //$chatbox.addClass('chatbox--closed');
            $('#chatbox_body_content').html("<h4>Hello!, How can i help you?</h4>");
        });
        $chatbox.on('transitionend', function() {
            if ($chatbox.hasClass('chatbox--closed')) $chatbox.remove();
        });
        $chatboxCredentials.on('submit', function(e) {
            e.preventDefault();
            $chatbox.removeClass('chatbox--empty');
            // to scroll down to the bottom of the chat tray  or chat body
            $('#chatbox_body_content').scrollTop(1E10);
        });

        // this function executes when user hits enter key in chat textarea
        $("#user_input").keypress(function(e){
            var code = (e.keyCode ? e.keyCode : e.which);
            if (code == 13){
                var user_input = $('#user_input').val();
                var context_json = $('#conversation_id').val();

                var user_before = '<div class="chatbox__body__message chatbox__body__message--right"><img src="{{asset('images/user_icon.png')}}" alt="User"><p>';
                var after = '</p></div>';
                var user_finalValue = user_before + user_input + after;
                $('#chatbox_body_content').append(user_finalValue);
                $('#user_input').val('');

                // scroll to the bottom of the chatbot body
                $('#chatbox_body_content').scrollTop(1E10);


                $.ajax({
                    url: "http://chatbot.dev/api/v1/chatbot",
                    data: {user_input: user_input, context: context_json},
                    async: false, 
                    success: function(result){
                        var viman_before = '<div class="chatbox__body__message chatbox__body__message--left"><img src="{{asset('images/viman_agent.png')}}" alt="VIMAN"><p>';

                        var res = result.split("|");

                        var viman_finalValue = viman_before + res[0] + after;
                        $('#chatbox_body_content').append(viman_finalValue);
                        $('#conversation_id').val(res[1]);
                    },
                    error: function(error){
                        $('#chatbox_body_content').append(error);
                    }
                });

                // scroll to the bottom of the chatbot body
                $('#chatbox_body_content').scrollTop(1E10);

                  
            } // end of if condition
          }); // end of keypress function
    }); // end of document ready function
})(jQuery); // end of first function
</script>
@endsection

@section('content')
<div class="chatbox chatbox--tray chatbox--empty">
    <div class="chatbox__title">
        <h5><a href="#">VIMAN Virtual Agent</a></h5>
        <!-- minimize button -->
        <button class="chatbox__title__tray">
            <span></span>
        </button>
        <!-- minimize button ends -->
        <!-- Close button which closes the chatbot -->
        <button class="chatbox__title__close">
            <span>
                <svg viewBox="0 0 12 12" width="12px" height="12px">
                    <line stroke="#FFFFFF" x1="11.75" y1="0.25" x2="0.25" y2="11.75"></line>
                    <line stroke="#FFFFFF" x1="11.75" y1="11.75" x2="0.25" y2="0.25"></line>
                </svg>
            </span>
        </button>
        <!-- close button ends -->
    </div>
    <div class="chatbox__body" id="chatbox_body_content">
        <div class="chatbox__body__message chatbox__body__message--left">
            <img src="{{asset('images/viman_agent.png')}}" alt="VIMAN">
            <p>Hello, Welcome to CyNeuro portal, I am VIMAN your virtual agent.</p>
        </div>
        <!-- <div class="chatbox__body__message chatbox__body__message--right">
            <img src="{{asset('images/user_icon.png')}}" alt="User">
            <p>Nulla vel turpis vulputate, tincidunt lectus sed, porta arcu.</p>
        </div> -->
    </div>
    <form class="chatbox__credentials">
        <div class="form-group">
            <label for="inputName">Name:</label>
            <input type="text" class="form-control" id="inputName" required>
        </div>
        <div class="form-group">
            <label for="inputEmail">Email:</label>
            <input type="text" class="form-control" id="inputEmail" required>
        </div>
        <button type="submit" class="btn btn-success btn-block">Enter Chat</button>
    </form>
    <input type="hidden" id="conversation_id" name="conversation_id" value="{}">
    <input type="text" id="user_input" name="user_input" class="chatbox__message" placeholder="Write something interesting"></input>
</div>
@endsection


