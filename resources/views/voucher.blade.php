<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Voucher for {{ $reward->name }}</title>
</head>
<body style="background-image:url('{{ asset('img/voucher-bg.jpg') }}'); background-repeat: no-repeat; background-size: contain; padding: 100px 200px;">
    <p style="font-size: .9rem; font-family: Snell Roundhand, 'Brush Script MT', cursive;">On the Date of {{ \Carbon\Carbon::now() }}</p>
    <h2 style="font-family: Snell Roundhand, 'Brush Script MT', cursive;  text-align: center;">
        {{ $user->name }} is entitled to {{ $multiplier }} of:
    </h2>
    <h1 style="font-family: Garamond, serif; text-align: center;">
        {{ $reward->title }}
    </h1>
    <p style="font-family: Snell Roundhand, 'Brush Script MT', cursive; text-align: center;">
        {{ $reward->description }}
    </p>

</body>
</html>
