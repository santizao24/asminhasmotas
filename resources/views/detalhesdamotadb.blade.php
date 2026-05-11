<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Os meus carros</title>
    </head>
    <body>
        <header>
            <h1>As minha frota de motas</h1>
        </header>

        <div>
            @if(!empty($mota))
                <h2> Detalhes da minha mota {{ $mota->marca}}</h2>
                <p>
                    <strong>Marca: </strong> {{$mota->marca}}<br>
                    <strong>Modelo: </strong> {{$mota->modelo}}<br>
                    <strong>Potência: </strong> {{$mota->potencia}}<br>
                    <strong>KMs: </strong> {{$mota->kilometros}}<br>
                </p>
            @else
                <h2>Ocorreu algum problema ou a mota com esse ID não existe.</h2>
            @endif
        </div>
        <a href="{{ url('/motas') }}"> voltar ao início </a>
    </body>
</html>
