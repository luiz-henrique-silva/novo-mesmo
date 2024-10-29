<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

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
            'status' => 'nullable|string|max:50',
            'documento' => 'nullable|string|max:2', // S ou N
        ]);
        
        $project = new Project();
        $project->title = $request->title;
        $project->description = $request->description;
        $project->data_inicio = $request->data_inicio;
        $project->data_final = $request->data_final;
        $project->integrantes = $request->integrantes;
        $project->curso_id = $request->curso_id;
        $project->professor_orientador_id = $request->professor_orientador_id;
        $project->link_github = $request->link_github;
        $project->status = $request->status ?? 'pendente'; // Padrão: pendente
        $project->documento = $request->documento;
        $project->user_id = auth()->user()->id; // Aluno que enviou o projeto
        $project->save();
    
        return redirect()->route('dashboard')->with('success', 'Projeto enviado com sucesso!');
    }

    public function welcome() {
        $projects = Project::where('status', 'aprovado')->get();
        return view('welcome', compact('projects'));
    }
    
    // Exibir solicitações de projetos pendentes (somente para professores)
    public function approveIndex() {
        $projects = Project::where('status', 'pendente')->get();
        return view('projects.approve', compact('projects'));
    }

    // Aprovar projeto (somente para professores)
    public function approve(Project $project) {
        $project->status = 'aprovado';
        $project->save();
    
        return redirect()->route('dashboard')->with('success', 'Projeto aprovado com sucesso!');
    }
}
