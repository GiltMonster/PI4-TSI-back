<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Avalista;
use App\Models\Aluno;

class AuthController extends Controller
{

    public function loginAvalista(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $avalista = Avalista::where('avalista_email', $credentials['email'])->first();

        if (!$credentials) {
            return response()->json(['error' => 'Credenciais não informadas'], 400);
        }

        if ($avalista && $credentials['password'] == $avalista->avalista_senha) {
            $token = JWTAuth::fromUser($avalista);
            return response()->json(['message' => 'Login Feito com sucesso!!', 'access_token' => $token], 200);
        }else {
            return response()->json(['error' => 'Credenciais inválidas'], 401);
        }
    }

    public function loginAluno(Request $request){
        $credentials = $request->only('email', 'password');
        $aluno = Aluno::where('aluno_email', $credentials['email'])->first();

        if (!$credentials) {
            return response()->json(['error' => 'Credenciais não informadas'], 400);
        }

        if ($aluno && $credentials['password'] == $aluno->aluno_senha) {
            $token = JWTAuth::fromUser($aluno);
            return response()->json(['message' => 'Login Feito com sucesso!!', 'access_token' => $token], 200);
        }else {
            return response()->json(['error' => 'Credenciais inválidas'], 401);
        }
    }

    public function verifyToken(Request $request)
    {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }

        if ($user instanceof Avalista) {
            $user = Avalista::find($user->avalista_id);
        }

        if ($user instanceof Aluno) {
            $user = Aluno::find($user->aluno_id);
        }

        return response()->json($user);

    }
}
