<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vanny Ezha test pusher</title>
    @vite('resources/js/app.js')

</head>
<body>
    <h2 id="result"></h2>



    <script type="module">
        window.Echo.channel('set_vannyezha_grome800000001').listen('PoolEvent', function(data){
            console.log(data)
            const result = document.getElementById("result");
            result.innerText = data["message"];
        })
        </script>
</body>
</html>
