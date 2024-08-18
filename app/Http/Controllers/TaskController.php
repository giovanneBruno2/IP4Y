<?php

namespace App\Http\Controllers;

use App\Exports\tasksExport;
use App\Http\Controllers\Controller;
use App\Models\Projects;
use App\Models\Task;
use App\Models\User;
use App\Notifications\TaskAssigned;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use function Laravel\Prompts\error;

class TaskController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('task.create',  [
            'task' => new Task(),
            'users' => User::all(),
            'projects' => Projects::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
            $user = User::findOrFail($request->get('assigned_to'));
            $task = new Task();
            $task->setTitle($request->get('task_title'));
            $task->setDescription($request->get('task_description'));
            $task->setStatus('pendente');
            $task->setDueDate($request->get('due_date'));
            $task->setProjectsId($request->get('project_id'));
            $task->setAssignedTo($request->get('assigned_to'));
            $task->save();
            try {
                Notification::send($user, new TaskAssigned($task));
                Log::info('Notificação enviada com sucesso.', ['user_id' => $user->id]);
            } catch (\Exception $e) {
                Log::error('Falha ao enviar notificação: ' . $e->getMessage());
            }
        return redirect()->route('project.index');
    }

    public function edit(Task $task) {
        return view('task.edit',  [
            'task' => $task,
            'users' => User::all(),
            'projects' => Projects::all(),
            'statuses' => ['pendente', 'em progresso', 'concluido']
        ]);
    }
    public function update(Request $request, Task $task) {
        $request->validate([
            'task_title' => 'required|string|max:255',
            'task_description' => 'required|string|max:500',
            'due_date' => 'required|date',
        ]);
        $task->update([
            'title' => $request->input('task_title'),
            'description' => $request->input('task_description'),
            'due_date' => $request->input('due_date'),
            'project_id' => $request->input('project_id'),
            'assigned_to' => $request->input('assigned_to'),
            'status' => $request->input('task_status'),
            'conclusion_date' => $request->input('task_status') == 'concluido' ? now()->toDateString() : '',
        ]);
        $user = User::findOrFail($request->get('assigned_to'));
        try {
            Notification::send($user, new TaskAssigned($task));
            Log::info('Notificação enviada com sucesso.', ['user_id' => $user->id]);
        } catch (\Exception $e) {
            Log::error('Falha ao enviar notificação: ' . $e->getMessage());
        }
        return redirect()->route('project.index')->with('success', 'Project  updated successfully!');;
        //
    }

    public function destroy(Task $task) {
        $task->delete();
        return redirect()->route('project.index')->with('success', 'Project  updated successfully!');
    }

    public function exportTasks($type) {
        $export = new tasksExport();
        if ($type == 'excel') {
            return $export->excelExport();
        } else {
            return $export->pdfExport();
        }
    }
}
