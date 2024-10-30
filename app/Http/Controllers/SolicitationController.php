<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\Solicitation;


class SolicitationController extends Controller
{
    // Exibir todas as solicitações pendentes
    public function index() {
        $solicitations = Solicitation::all(); // ou adicionar filtros conforme necessário
        return view('solicitations.index', compact('solicitations'));
    }

    // Salvar uma nova solicitação
    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'data_inicio' => 'nullable|date',
            'data_final' => 'nullable|date',
            'integrantes' => 'nullable|string',
            'curso_id' => 'nullable|integer',
            'professor_orientador_id' => 'nullable|integer',
            'link_github' => 'nullable|url',
            'documento' => 'nullable|string|max:2', // S ou N
        ]);
    
        // Criar nova solicitação
        $solicitation = new Solicitation();
        $solicitation->title = $request->title;
        $solicitation->description = $request->description;
        $solicitation->data_inicio = $request->data_inicio;
        $solicitation->data_final = $request->data_final;
        $solicitation->integrantes = $request->integrantes;
        $solicitation->curso_id = $request->curso_id;
        $solicitation->professor_orientador_id = $request->professor_orientador_id;
        $solicitation->link_github = $request->link_github;
        $solicitation->status = 'pendente'; // Definindo o status padrão
        $solicitation->documento = $request->documento;
        $solicitation->user_id = auth()->user()->id; // Aluno que enviou a solicitação
        $solicitation->save();
    
        return redirect()->route('dashboard')->with('success', 'Solicitação de projeto enviada com sucesso!');
    }

    // Aprovar uma solicitação (mover para projetos)
    public function approve(Solicitation $solicitation) {
        // Lógica para mover para a tabela de projetos, semelhante ao que foi discutido antes
    }

    // Outros métodos conforme necessário...
}
