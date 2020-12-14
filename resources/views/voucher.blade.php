<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Voucher for {{ $reward->name }}</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        @font-face {
            font-family: 'PinyonScript';
            src: url({{ asset('PinyonScript-Regular.ttf') }})
        }
        h2 {
            font-family: cursive;
        }
    </style>
</head>
<body style="background-image:url('{{ asset('img/voucher-bg.jpg') }}'); background-repeat: no-repeat; background-size: 100%; padding: 100px 200px;">
    <p style="font-size: .9rem; font-family: PinyonScript;">On the Date of {{ \Carbon\Carbon::now() }}</p>
    <h2 style="font-family: PinyonScript;  text-align: center;">
        {{ $user->name }} is entitled to {{ $rewardUser->multiplier }}
    </h2>
    <h1 style="font-family: Garamond, serif; text-align: center;">
        {{ $reward->title }}
    </h1>
    <p style="font-family: PinyonScript; text-align: center;">
        {{ $reward->description }}
    </p>
</body>
</html>
