<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Modelo User
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Exibir o formulário de registro
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Processar o registro
    public function register(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'type' => 'required|in:aluno,professor', // Validação para aluno ou professor
        ]);

        // Criar o usuário no banco de dados
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => $request->type, // Define o tipo de usuário
        ]);

        // Autenticar o usuário e redirecionar
        auth()->login($user);

        return redirect()->route('dashboard'); // Redireciona para o dashboard
    }
}
