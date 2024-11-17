<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat with AI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Guide Ai Beion</h1>
    <form id="chat-form">
        <div class="mb-3">
            <label for="message" class="form-label">Tanya</label>
            <input type="text" class="form-control" id="message" name="message" required>
        </div>
        <button type="submit" class="btn btn-primary">Kirim</button>
    </form>
    <div class="mt-3">
        <h5>Jawab</h5>
        <div id="chat-response" class="border p-3"></div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#chat-form').on('submit', function(event) {
        event.preventDefault();
        
        let message = $('#message').val();
        
        $.ajax({
            url: "{{ route('user.chat') }}", // Sesuaikan dengan rute Anda
            type: 'POST',
            data: {
                message: message,
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                $('#chat-response').text(response.message);
            },
            error: function(xhr, status, error) {
                $('#chat-response').text('Something went wrong. Please try again.');
            }
        });
    });
});
</script>
</body>
</html>
