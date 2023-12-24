<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NSS SMIT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <div class="container text-center">
        <p>Welcome to official page of National Service Scheme of Sikkim Manipal Institute of Technology.</p>
        <h4>NOT ME BUT YOU</h4>
    </div>

    <form action="{{ route('test') }}" method="POST" id="addpost">
        @csrf
        <label for="">Text</label>
        <input type="text" name="title">

        <label for="">Description</label>
        <input type="text" name="description">

        <input type="submit">
    </form>

    <div id="message"></div>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#addpost').on('submit', function(event){
                event.preventDefault();
                jQuery.ajax({
                    url: "{{ url('ajaxupload') }}",
                    data: jQuery('#addpost').serialize(),
                    type: 'post',

                    success:function(result){
                        $('#message').css('display','block');
                        jQuery('#message').html(result.message);
                        jQuery('#addpost')[0].reset();
                    }
                })
            });
        });
    </script>
</body>
</html>
