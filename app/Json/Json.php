<?php

namespace App\Json;

use Exception;

class Json
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
        $result = $data['Model']::query()->select($data['Query']);
        // Agregamos las condiciones de filtro
        if (!empty($search['value']))
            $result = $result->where($data['Row'], '=', $search['value']);

        $result = $result->limit($length)
            ->offset($start)
            ->get()->toArray();


        // damos la respuesta en formato JSON como lo requeire el DataTable
        return [
            'draw' => $request->json('draw'),
            'recordsTotal' => count($result),
            'recordsFiltered' => $data['Model']::query()->count('id'),
            'data' => $result
        ];
    }
}
