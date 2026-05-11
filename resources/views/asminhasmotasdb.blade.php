<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>As minhas motas</title>
        <style>
            .msg{
                position: absolute;
                padding: 10px;
                right: 20px;
            }
            .sucesso{
                color: #0f5132;
                background-color: #d1e7dd;
                border-color: #badbcc;
                border-radius: .25rem;
            }
            .erro{
                color: #842029;
                background-color: #f8d7da;
                border-color: #f5c2c7;
                border-radius: .25rem;
            }
        </style>

        <script>
            // Isto é só para fazer desaparecer a mensagem após alguns segundos
            setTimeout(() => {
                document.getElementById("msg").style.display = 'none';
            }, 2000);
        </script>

    </head>
    <body>
        <header>
            <h1>As minha frota de motas</h1>
        </header>

        @if (session('msg'))
            <div id="msg" @class(['msg', 'sucesso' => (session('status') == 1), 'erro' => (session('status') == 0) ])>
                {{ session('msg') }}
            </div>
        @endif

        <div>
            @forelse ($motas as $m)
                @if ($loop->first)
                <table> 
                    <tr>
                        <th>id</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Potência</th>
                        <th>Kms</th>
                        <th></th>
                    </tr>
                @endif
                    <tr>
                        <td>{{ $m->id }}</td>
                        <td>{{ $m->marca }}</td>
                        <td>{{ $m->modelo }}</td>
                        <td>{{ $m->potencia }}</td>
                        <td>{{ $m->kilometros }}</td>
                        <td>
                            <form method="post" action="/motas/{{ $m->id }}">
                                @csrf
                                @method('delete')
                                <input type="submit" name="remover" value="remover">
                            </form>
                        </td>
                    </tr>
                @if ($loop->last)
                </table>
                @endif
            @empty
            <p>A tua frota ainda não tem motas!</p>
            @endforelse      
        </div>
        <fieldset>
            <legend>Adicionar mota</legend>
            <form method="post" action="/motas">
                <div id="form" style="display: flex">
                    <div>
                        <label for="marca">Marca</label><br>    
                        <input type="text" name="marca" required>
                    </div> 
                    <div>
                        <label for="modelo">Modelo</label><br>    
                        <input type="text" name="modelo" required>
                    </div> 
                    <div>
                        <label for="marca">Potência</label><br>    
                        <input type="number" name="potencia" required>
                    </div> 
                    <div>
                        <label for="kms">Kms</label><br>    
                        <input type="number" name="kilometros" required>
                    </div> 
                    <div>
                        <label for="guardar"></label><br>    
                        <input type="submit" name="guardar" value="guardar">
                    </div> 
                </div>
            </form>    
        </fieldset>    
    </body>
</html>
