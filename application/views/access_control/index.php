<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <div class="container">
        <h1>Enter Artist's Name:</h1>
        <form action="#" method="post">
            <label for="user_input">Enter Artists's Name:</label>
            <input id="user_input" name="user_input" type="search">
            <input type="submit" value="search">
        </form>
        <div id="results"></div>    
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('form').submit(function() {
                var url = "https://itunes.apple.com/search?term=";
                url += $('#user_input').val();
                url += "&entity=musicVideo";
                $.get(url, function(res) {
                    if(res.results.length !== 0) {
                        html_string = "<video controls src='" +
                                    res.results[0].previewUrl +
                                    "'><\/video>"; 
                    } else {
                        html_string = "Not Found";
                    }
                    $('#results').html(html_string);
                }, 'json');
                return false;
            });
        });
    </script>
  </body>
</html>