<?php

namespace App\Http\Controllers;

use App\Models\Avalista;
use Dotenv\Util\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AvalistaController extends Controller
{
    public function show($id)
    {
        $avalista = Avalista::find($id);

        if (!$avalista) {
            return response()->json(
                ['message' => 'Avalista não encontrado'],
                404
            );
        }

        return response()->json(
            $avalista,
            200
        );
    }

    public function store(Request $request)
    {
        $avalista = new Avalista();

        if (Avalista::where('avalista_email', $request->avalista_email)->exists()) {
            return response()->json([
                'message' => 'E-mail já cadastrado'
            ], 400);
        }

        if (!$this->verifyEmailDomain($request->avalista_email)) {
            return response()->json([
                'message' => 'E-mail inválido, favor utilizar o domínio institucional'
            ], 400);
        }

        $avalista->avalista_nome = $request->avalista_nome;
        $avalista->avalista_email = $request->avalista_email;
        $avalista->curso_id = $request->curso_id;
        $avalista->avalista_senha = Hash::make($request->avalista_senha);

        if ($avalista->save()) {
            return response()->json(
                ['message' => 'Avalista cadastrado com sucesso'],
                201
            );
        } else {
            return response()->json(
                ['message' => 'Erro ao cadastrar avalista'],
                500
            );
        }

    }

    public function update(Request $request, $avalista_id)
    {
        $avalista = Avalista::find($avalista_id);

        if (!$avalista) {
            return response()->json(
                ['message' => 'Avalista não encontrado'],
                404
            );
        }

        if (Avalista::where('avalista_email', $request->avalista_email)->where('avalista_id', '!=', $avalista_id)->exists()) {
            return response()->json(
                ['message' => 'E-mail já cadastrado'],
                400
            );
        }

        if (!$this->verifyEmailDomain($request->avalista_email)) {
            return response()->json(
                ['message' => 'E-mail favor utilizar o domínio institucional'],
                400
            );
        }

        $avalista->avalista_nome = $request->avalista_nome;
        $avalista->curso_id = $request->curso_id;
        $avalista->avalista_email = $request->avalista_email;
        $avalista->avalista_senha = Hash::make($request->avalista_senha);

        if ($avalista->update()) {
            return response()->json(
                ['message' => 'Avalista atualizado com sucesso'],
                200
            );
        }else {
            return response()->json(
                ['message' => 'Erro ao atualizar avalista'],
                500
            );
        }
    }


    public function verifyEmailDomain(String $email)
    {
        $emailDomain = explode('@', $email)[1];
        $allowedDomains = ['senac.sp.br'];
        return in_array($emailDomain, $allowedDomains);
    }
}
