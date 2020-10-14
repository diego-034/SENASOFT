<?php

namespace App\Json;

use Exception;

class Json extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function Json($request, $data)
    {
        $search = $request->json('search');
        $start = $request->json('start');
        $length = $request->json('length');

        // Creamos la query para la consulta
        $data = $data['Model']::query()->select($data['Query']);
            // ->join('options', 'options.id', '=', 'products.category')
            // ->join('options as op', 'op.id', '=', 'products.unitOfMeasurement')

        // Agregamos las condiciones de filtro
        if (!empty($search['value']))
            $data = $data->where($data['Row'], '=', $search['value']);

        $data = $data->limit($length)
            ->offset($start)
            ->get()->toArray();


        // damos la respuesta en formato JSON como lo requeire el DataTable
        return response()->json([
            'draw' => $request->json('draw'),
            'recordsTotal' => count($data),
            'recordsFiltered' => $data['Model']::query()->count('id'),
            'data' => $data
        ]);
       
    }
}
