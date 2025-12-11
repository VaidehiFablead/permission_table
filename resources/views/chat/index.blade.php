<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@extends('layouts.app')

<style>
    .chat-box {
        height: 60vh;
        overflow: auto;
        border: 1px solid #ddd;
        padding: 10px;
    }

    .msg {
        margin-bottom: 10px;
    }

    .msg.user {
        text-align: right;
    }

    .msg.assistant {
        text-align: left;
    }
</style>

@section('content')
    <h3>Clinic Chat Assistant</h3>

  

    <div id="chat" class="chat-box mb-3">
        @foreach ($messages as $m)
            <div class="msg {{ $m->role }}">
                <small class="text-muted">{{ $m->role }}</small>

                @if ($m->role == 'user')
                    <div class="p-2 bg-primary text-white fw-bold rounded">
                        {{ $m->content }}
                    </div>
                @else
                    <div class="p-2 bg-light rounded">
                        {{ $m->content }}
                    </div>
                @endif
            </div>
        @endforeach
    </div>


    <form id="chatForm">
        <div class="input-group">
            <input id="message" class="form-control" autocomplete="off" placeholder="Type your question...">
            <button class="btn btn-primary" type="submit">Send</button>
        </div>
    </form>

    <script>
        $("#chatForm").submit(function(e) {
            e.preventDefault();

            let msg = $("#message").val().trim();
            if (!msg) return;

            // Show user message instantly
            $("#chat").append(`
                <div class="msg user">
                    <small class="text-muted">user</small>
                    <div class="p-2 bg-primary text-white rounded">${msg}</div>
                </div>
            `);

            $("#message").val("");
            $("#chat").scrollTop($("#chat")[0].scrollHeight);

            // AJAX Call
            $.ajax({
                url: "{{ route('chat.send') }}",
                type: "POST",
                data: {
                    _token: $("meta[name='csrf-token']").attr("content"),
                    message: msg
                },
                success: function(res) {
                    console.log(res);

                    if (res.status === "ok") {
                        $("#chat").append(`
                            <div class="msg assistant">
                                <small class="text-muted">assistant</small>
                                <div class="p-2 bg-light rounded">${res.assistant}</div>
                            </div>
                        `);

                        $("#chat").scrollTop($("#chat")[0].scrollHeight);
                    } else {
                        alert("Error: " + res.message);
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    alert("Request failed");
                }
            });
        });
    </script>
@endsection
