<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mail</title>
</head>
<body>
    <h2 style="border-bottom: 1px solid">{{ $data['location_name'] }}</h2>
    <p>Tere.</p><br/>
    <p>Olete broneerinud aja teenindusse: {{ $data['location_name'] }}</p><br/>
    <p>Broneerimise aeg: {{ $data['time'] }}</p>
    <p>Valitud teenused: {{ $data['service_name'] }}</p>
    <p>{{ $data['mark'] }} : {{ $data['model'] }}</p>
    <p>
        E-post: info@mydisain.com<br/>
        Telefon: 5105308<br/>
        Märkused: test bronn<br/><br/>
    </p>
    <p>
        Kui leiate, et Te ei saa broneeritud ajal kohale ilmuda, siis<br/>
        on kõige mugavam broneering tühistada klikkides järgnevat
    </p>
    <p>
        linki:
    </p>
    <a href="https://nano-zen.com/booking/time/cancel?token=fafd862a0cda204b98b392ec2bcc9737">https://nano-zen.com/booking/time/cancel?token=fafd862a0cda204b98b392ec2bcc9737</a>
    <br/><br/>
    <p>Täname!</p>
</body>
</html>