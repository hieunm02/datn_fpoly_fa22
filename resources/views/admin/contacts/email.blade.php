<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email</title>
</head>

<body>
    <h3>Chào bạn {{ $mailData['name'] }}</h3>
    {{ $mailData['content'] }}
    <p>Chúng tôi xin chân thành cảm ơn bạn đã luôn ủng hộ chúng tôi!</p>
    <p>Thân ái</p>
    <strong>BeeFood</strong>
</body>

</html>
