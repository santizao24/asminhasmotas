<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class MotasControllerDB extends Controller
{

    // Devolve todas as motas
    public function getAll() : View{
        $motas = DB::select('SELECT * FROM motas');
        return view('asminhasmotasdb', ['motas' => $motas, 'num' => count($motas)]);
    }

    // Devolve os detalhes de uma mota específica
    public function getOne(int $id) : View{
        $mota = DB::select('SELECT * FROM motas WHERE id = ?', [$id]);
        return view('detalhesdamotadb', ['mota' => $mota]);
    }

    // Insere uma nova mota
    public function add(Request $r){

        $novamota = DB::insert('INSERT INTO motas(marca, modelo, potencia, kilometros) 
                                VALUES (?, ?, ?, ?)', 
        [
            $r->input('marca'),
            $r->input('modelo'),
            $r->input('potencia'),
            $r->input('kilometros')
        ]);

        $msg = "";
        $status = -1;
        if($novamota){
            $msg = "Nova mota inserida com sucesso!";
            $status = 1;
        } else {
            $msg = "Ocorreu um erro ao introduzir a mota";
            $status = 0;
        }

        // fazer o redirect para a rota, as variáveis passadas estão disponiveis na session 
        return redirect('/motas')
                ->with('status', $status)
                ->with('msg', $msg);
    }

    public function remove(int $id){
        $mota = DB::delete('DELETE FROM motas WHERE id = ?', [$id]);
        
        $msg = "";
        $status = -1;
        if($mota >= 1){
            $msg = "Mota removida com sucesso!";
            $status = 1;
        } else {
            $msg = "Ocorreu um erro ao remover a mota";
            $status = 0;
        }

        // fazer o redirect para a rota, as variáveis passadas estão disponiveis na session 
        return redirect('/motas')
                ->with('status', $status)
                ->with('msg', $msg);
    }
}
