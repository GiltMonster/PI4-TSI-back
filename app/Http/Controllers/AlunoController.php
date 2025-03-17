<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AlunoController extends Controller
{
    public function store(Request $request)
    {
        $aluno = new Aluno();

        if (Aluno::where('aluno_id', $request->aluno_id)->exists()) {
            return response()->json(
                ['message' => 'RA já cadastrado'],
                400
            );
        }

        if (Aluno::where('aluno_email', $request->aluno_email)->exists()) {
            return response()->json(
                ['message' => 'Email já cadastrado'],
                400
            );
        }

        if (Aluno::where('aluno_github', $request->aluno_github)->exists()) {
            return response()->json(
                ['message' => 'Github já cadastrado'],
                400
            );
        }

        if (Aluno::where('aluno_linkedin', $request->aluno_linkedin)->exists()) {
            return response()->json(
                ['message' => 'Linkedin já cadastrado'],
                400
            );
        }

        if (Aluno::where('aluno_insta', $request->aluno_insta)->exists()) {
            return response()->json(
                ['message' => 'Instagram já cadastrado'],
                400
            );
        }

        $aluno->aluno_id = $request->aluno_id;
        $aluno->curso_id = $request->curso_id;
        $aluno->aluno_nome = $request->aluno_nome;
        $aluno->aluno_email = $request->aluno_email;
        $aluno->aluno_senha = Hash::make($request->aluno_senha);
        $aluno->aluno_semestre = $request->aluno_semestre;
        $aluno->aluno_github = $request->aluno_github;
        $aluno->aluno_linkedin = $request->aluno_linkedin;
        $aluno->aluno_insta = $request->aluno_insta;
        $aluno->aluno_foto_url = $request->aluno_foto_url;

        if ($aluno->save()) {
            return response()->json([
                'message' => 'Aluno cadastrado com sucesso',
                'aluno' => $aluno
            ], 201);
        } else {
            return response()->json([
                'message' => 'Erro ao cadastrar aluno',
                'aluno' => null
            ], 400);
        }
    }

    public function show($id)
    {
        $aluno = Aluno::find($id);

        if ($aluno) {
            return response()->json([
                'message' => 'Aluno encontrado',
                'aluno' => $aluno
            ], 200);
        } else {
            return response()->json([
                'message' => 'Aluno não encontrado',
                'aluno' => null
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $aluno = Aluno::find($id);

        if ($aluno) {
            $aluno->aluno_id = $request->aluno_id;
            $aluno->curso_id = $request->curso_id;
            $aluno->aluno_nome = $request->aluno_nome;
            $aluno->aluno_email = $request->aluno_email;
            $aluno->aluno_senha = Hash::make($request->aluno_senha);
            $aluno->aluno_semestre = $request->aluno_semestre;
            $aluno->aluno_github = $request->aluno_github;
            $aluno->aluno_linkedin = $request->aluno_linkedin;
            $aluno->aluno_insta = $request->aluno_insta;
            $aluno->aluno_foto_url = $request->aluno_foto_url;

            if ($aluno->update()) {
                return response()->json([
                    'message' => 'Aluno atualizado com sucesso',
                    'aluno' => $aluno
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Erro ao atualizar aluno',
                    'aluno' => null
                ], 400);
            }
        } else {
            return response()->json([
                'message' => 'Aluno não encontrado',
                'aluno' => null
            ], 404);
        }
    }
}
