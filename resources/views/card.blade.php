<!DOCTYPE html>
<html>
<head>
    <title>Tyrell System Card Distribution</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <form id="cardForm">
        @csrf
        <label for="num_people">Enter Number of People:</label>
        <input type="number" id="num_people" name="num_people">
        <button type="submit">Distribute Cards</button>
    </form>

    <p id="errorMessage" style="color: red; display: none;"></p>

    <div id="resultContainer">
        <h2>Distributed Cards</h2>
        <div id="cardResults"></div>
    </div>

    <script>
        $(document).ready(function() {
            $('#cardForm').on('submit', function(e) {
                e.preventDefault();
                let numPeople = $('#num_people').val();

                $.ajax({
                    url: "{{ route('distribute') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        num_people: numPeople
                    },
                    success: function(response) {
                        if (response.error) {
                            $('#errorMessage').text(response.error).show();
                            $('#cardResults').html('');
                        } else {
                            $('#errorMessage').hide();
                            let html = response.result.map(row => `<p>${row}</p>`).join('');
                            $('#cardResults').html(html);
                        }
                    },
                    error: function() {
                        alert('An error occurred. Please try again.');
                    }
                });
            });
        });
    </script>
</body>
</html>
