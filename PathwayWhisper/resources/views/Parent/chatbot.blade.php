@extends('parent.layouts.main')
@section('content')
<style>
#chat-container {
            height: 60vh; /* Set the height to 60% of the viewport height */
            overflow-y: scroll;
            position: relative;
        }

        .typing-indicator {
            position: absolute;
            bottom: 5px;
            left: 0;
            display: none;
            color: #aaa;
        }

        .loader {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #3498db;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            animation: spin 1s linear infinite;
            display: inline-block;
            margin-left: 10px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    PathwayWhisper
                </div>
                <div class="card-body" id="chat-container">
                    <!-- Initial chatbot greeting message -->
                    <div class="alert alert-info" role="alert">PathwayWhisper: Hello! I am PathwayWhisper AI chatbot. How can I help you?</div>
                    <div class="typing-indicator" ><span class="loader"></span> PathwayWhisper is typing...</div>
                    
                </div>
                <div class="card-footer">
                    <div class="input-group">
                        <input type="text" id="user-message" class="form-control" placeholder="Type your message..." oninput="toggleSendButton()" onkeypress="handleKeyPress(event)">
                        <div class="input-group-append">
                            <button class="btn btn-primary" onclick="sendMessage()" id="send-button">Send</button>
                            <span class="loader" style="visibility: hidden;"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var isWaitingForResponse = false;

    function initChat() {
        var initialGreeting = "Hello! I am PathwayWhisper AI chatbot. How can I help you?";
        $('#chat-container').append('<div class="alert alert-info" role="alert">PathwayWhisper: ' + initialGreeting + '</div>');
    }

    function sendMessage() {
        if (isWaitingForResponse) {
            return; // Don't send a new message until the last response arrives
        }

        var userMessage = $('#user-message').val();
        if (userMessage.trim() === '') {
            return; // Don't send empty messages
        }

        $('#user-message').val('');
        $('#chat-container').append('<div class="alert alert-secondary" role="alert">You: ' + userMessage + '</div>');
        disableSendButton();
        showTypingIndicator();

        getChatbotResponse(userMessage, function (response) {
            hideTypingIndicator();
            $('#chat-container').append('<div class="alert alert-info" role="alert">PathwayWhisper: ' + response + '</div>');
            enableSendButton();
            $('#user-message').val('');
            scrollToBottom();
        });
    }

    function showTypingIndicator() {
        $('.typing-indicator').show();
        isWaitingForResponse = true;
    }

    function hideTypingIndicator() {
        $('.typing-indicator').hide();
        isWaitingForResponse = false;
    }

    function positionTypingIndicator() {
        var containerHeight = $('#chat-container').height();
        var indicatorHeight = $('.typing-indicator').outerHeight();
        $('.typing-indicator').css('bottom', containerHeight - indicatorHeight + 'px');
    }

    function getChatbotResponse(userMessage, callback) {
        // Simulating an asynchronous API call with a timeout
        setTimeout(function () {
            $.ajax({
                url: "http://127.0.0.1:5000/cohere?prompt=" + userMessage,
                type: "GET",
                async: true,
                success: function(response) {
                    console.log(response);
                    callback(response);
                },
            });
        }, 1000); // Simulating a 1-second delay
    }

    function toggleSendButton() {
        var userMessage = $('#user-message').val();
        if (userMessage.trim() === '' || isWaitingForResponse) {
            disableSendButton();
        } else {
            enableSendButton();
        }
    }

    function disableSendButton() {
        $('#send-button').prop('disabled', true);
        $('.loader').css('visibility', 'visible');
    }

    function enableSendButton() {
        $('#send-button').prop('disabled', false);
        $('.loader').css('visibility', 'hidden');
    }

    function handleKeyPress(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            sendMessage();
        }
    }

    $(document).ready(function () {
        initChat();
    });
</script>

@endsection