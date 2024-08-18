<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Models\Task;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Barryvdh\DomPDF\Facade\Pdf;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportController extends Controller
{
    public function exportExcel(Request $request) {
        $cacheKey = 'tasks_excel_' . md5(serialize($request->all()));
        if (empty($request->input('task_status')) && empty($request->input('conclusion_date'))) {
            return redirect()->route('project.index')->withErrors(['error' => 'Pelo menos um dos campos deve ser preenchido.']);
        }
        $filePath = Cache::remember($cacheKey, now()->addMinutes(10), function () use ($request) {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setTitle('Tasks');

            $query = Task::query();
            $status = $request->input('task_status') == 'em_progresso' ?  str_replace('_', ' ', $request->input('task_status')) : $request->input('task_status');
            $conclusionDate = $request->input('conclusion_date');

            if ($status){
                $query->where('status', $status);
            }
            if ($conclusionDate){
                $query->where('conclusion_date', $conclusionDate);
            }

            $tasks = $query->get();
            $headers = ['id', 'Titulo', 'Descrição', 'Estado','Previsao', 'Entrega'];
            $sheet->fromArray($headers);

            $row = 2;

            foreach ($tasks as $task) {
                $sheet->setCellValue("A" . $row, $task->id);
                $sheet->setCellValue("B" . $row, $task->getTitle());
                $sheet->setCellValue("C" . $row, $task->getDescription());
                $sheet->setCellValue("D" . $row, $task->getStatus());
                $sheet->setCellValue("E" . $row, $task->getDueDate());
                $sheet->setCellValue("F" . $row, $task->getConclusionDate());
                $row++;
            }

            $writer = new Xlsx($spreadsheet);

            $filePath = storage_path('app/public/exports/tasks.xlsx');
            $writer->save($filePath);

            return $filePath;
        });

        return response()->download($filePath)->deleteFileAfterSend(true);
    }

    public function exportPdf(Request $request){
        $cacheKey = 'tasks_pdf_' . md5(serialize($request->all()));
        if (empty($request->input('task_status')) && empty($request->input('conclusion_date'))) {
            return redirect()->route('project.index')->withErrors(['error' => 'Pelo menos um dos campos deve ser preenchido.']);
        }

        $data = Cache::remember($cacheKey, now()->addMinutes(10), function () use ($request) {
            $query = Task::query();
            $status = $request->input('task_status') == 'em_progresso' ?  str_replace('_', ' ', $request->input('task_status')) : $request->input('task_status');
            $conclusionDate = $request->input('conclusion_date');
            if ($status){
                $query->where('status', $status);
            }
            if ($conclusionDate){
                $query->where('conclusion_date', $conclusionDate);
            }

            $tasks = $query->get();
            if (is_null($tasks)) {
                return redirect()->route('project.index')->with('error', 'Sem arquivos!');
            }
            $data = [];
            foreach ($tasks as $task) {
                $data[] = [
                    'id' => $task->id,
                    'Titulo' => $task->getTitle(),
                    'Descrição' => $task->getDescription(),
                    'Estado' => $task->getStatus(),
                    'Previsao' => $task->getDueDate(),
                    'Entrega' => $task->getConclusionDate(),
                ];
            }

            return $data;
        });
        $pdf = Pdf::loadView('task.taskPdf', ['data' => $data]);

        $filePath = storage_path('app/public/exports/tasks.pdf');
        $pdf->save($filePath);

        return response()->download($filePath);
    }
}
