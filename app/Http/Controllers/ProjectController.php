<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Solicitation; // Certifique-se de importar o modelo Solicitation

class ProjectController extends Controller
{
    // Exibir todos os projetos aprovados
    public function index() {
        $projects = Project::where('status', 'aprovado')->get();
        return view('projects.index', compact('projects'));
    }

    // Exibir formulário de envio de projeto (somente para alunos)
    public function create() {
        return view('projects.create');
    }

    // Salvar solicitação de projeto
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
            'documento' => 'nullable|string|max:1|in:S,N',
        ]);
        
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

    public function welcome() {
        $projects = Project::where('status', 'aprovado')->get();
        return view('welcome', compact('projects'));
    }
    
    // Exibir solicitações de projetos pendentes (somente para professores)
    public function approveIndex() {
        $solicitations = Solicitation::where('status', 'pendente')->get();
        return view('projects.approve', compact('solicitations'));
    }

    // Aprovar projeto (somente para professores)
    public function approve(Solicitation $solicitation) {
        // Criar novo projeto a partir da solicitação aprovada
        $project = new Project();
        $project->title = $solicitation->title;
        $project->description = $solicitation->description;
        $project->data_inicio = $solicitation->data_inicio; // Opcional, se necessário
        $project->data_final = $solicitation->data_final; // Opcional, se necessário
        $project->status = 'aprovado';
        $project->user_id = $solicitation->user_id; // Manter a referência do usuário
        $project->save();
    
        // Deletar a solicitação após aprovação
        $solicitation->delete();

        return redirect()->route('dashboard')->with('success', 'Projeto aprovado e movido com sucesso!');
    }
}
