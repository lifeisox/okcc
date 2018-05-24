<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>문의사항</title>
    </head>
    <body>
        <h4>{{ config('app.name', 'Application Name') }}의 문의사항을 통해 생성된 이메일 입니다.</h4> 
        <hr>
        <p>Phone Number: {{ $phone }}</p>
        <p>{{ $contentMessage }}</p>
    </body>
</html>
