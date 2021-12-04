<?php

/*
* <União Metropolitana de Educação e Cultura>
* <Bacharelado em Sistemas de Informação>
* <Programação para Web II>
* <Pablo Ricardo Roxo Silva>
* <Luan Ventura de Almeida>
*/

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarroRequest;
use App\Http\Requests\UpdateCarroRequest;
use App\Models\Carro;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class CarroController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $value = $request->value;

        $order_by = $request->order_by;
        $order = $request->order === 'desc'
            ? 'desc'
            : 'asc';

        $colunas = ['modelo', 'potencia', 'ano', 'torque', 'combustivel'];

        $carro = Carro::select(['*'])
            ->when($search && in_array($search, $colunas) && $value, function ($query) use ($search, $value) {
                $query->where($search, 'like', '%' . $value . '%');
            })
            ->when($order_by && in_array($order_by, $colunas), function ($query) use ($order_by, $order) {
                $query->orderBy($order_by, $order);
            })
            ->get();

        return response()->json($carro);
    }

    public function show($id)
    {
        $carro = Carro::findOrFail($id);
        //SELECT * FROM carro WHERE id = $id
        return response()->json($carro);
    }

    public function store(Request $request)
    {
        $dados = $request->all();

        $validator = Validator::make($dados, (new StoreCarroRequest())->rules());
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $carro = Carro::create($dados);
        //INSERT INTO carro (modelo, potencia, ano, torque, combustivel) VALUES ('$dados->modelo', '$dados->potecia', '$dados->ano', '$dados->torque', '$dados->combustivel')
        return response()->json($carro, 201);
    }

    public function update(Request $request, $id)
    {
        $dados = $request->all();

        $validator = Validator::make($dados, (new UpdateCarroRequest())->rules());
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        Carro::findOrFail($id)->update($dados);
        //UPDATE carro SET modelo = '$request->modelo', potencia = '$request->potencia', ano = '$request->ano', torque = '$request->torque', combustivel = '$request->combustivel' WHERE id = $id
        return $this->show($id);
    }

    public function destroy($id)
    {
        Carro::findOrFail($id)->delete();
        //DELETE FROM carro WHERE id = $id
        return response()->json('', 204);
    }
}
