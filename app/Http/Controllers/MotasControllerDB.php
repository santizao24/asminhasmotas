<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage; 

class MotasController extends Controller
{
    private $ficheiro = 'motas.json';

    private function getMotas() {
        if (Storage::exists($this->ficheiro)) {
            $conteudo = Storage::get($this->ficheiro);
            return json_decode($conteudo, true);
        }

        return [
            ["Honda", "CBR 900 RR", 160],
            ["BMW", "S1000rr", 210],
            ["Kawasaki", "Versys", 70],
            ["Vespa", "Forte", 10],
        ];
    }

    public function index() : View {
        $motos = $this->getMotas();
        
        return view('asminhasmotasdb', [
            'motas' => $motos, 
            'num' => count($motos)
        ]);
    }

    public function store(Request $request) {
        // 1. Vai buscar as motas que já existem
        $motos = $this->getMotas();

        $motos[] = [
            $request->input('marca'),
            $request->input('modelo'),
            $request->input('potencia')
        ];

        Storage::put($this->ficheiro, json_encode($motos));

        return redirect()->back();
    }
}

?>