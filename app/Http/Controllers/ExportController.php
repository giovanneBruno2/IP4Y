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
    public function exportExcel(Request $request)
    {
        $cacheKey = 'tasks_excel_' . md5(serialize($request->all()));
        $tasks = Cache::remember($cacheKey, now()->addMinutes(10), function() use ($request) {
            $query = Task::query();
            $status = $request->input('status');
            if ($status) {
                $query->where('status', $status);
            }

            $dateStart = $request->input('date_start');
            $dateEnd = $request->input('date_end');
            if ($dateStart && $dateEnd) {
                $query->whereBetween('created_at', [$dateStart, $dateEnd]);
            }

            $query = $query->get();

        });

        if (is_null($tasks)) {
            return redirect()->route('project.index')->with('error', 'Sem arquivos!');
        }
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Title');
        $sheet->setCellValue('C1', 'Descrição');
        $sheet->setCellValue('D1', 'Status');
        $sheet->setCellValue('E1', 'Data Finalizado');
        $sheet->setCellValue('F1', 'Ultima Atualização');

        $row = 2;

        foreach ($tasks as $task) {
            $sheet->setCellValue('A' . $row, $task->id);
            $sheet->setCellValue('B' . $row, $task->getTitle());
            $sheet->setCellValue('C' . $row, $task->getDescription());
            $sheet->setCellValue('D' . $row, $task->getStatus());
            $sheet->setCellValue('E' . $row, $task->getDueDate());
            $sheet->setCellValue('F' . $row, $task->created_at);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);

        $response = new StreamedResponse(function () use ($writer) {
            $writer->save('php://output');
        });
        $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->headers->set('Content-Disposition', 'attachment;filename="tasks.xlsx"');
        $response->headers->set('Cache-Control', 'max-age=0');

        return $response;
    }

    public function exportPdf(Request $request){
        $cacheKey = 'tasks_pdf_' . md5(serialize($request->all()));
        $data = Cache::remember($cacheKey, now()->addMinutes(10), function () use ($request) {
            $query = Task::query();
            $status = $request->input('status');
            if ($status) {
                $query->where('status', $status);
            }
            $dateStart = $request->input('date_start');
            $dateEnd = $request->input('date_end');
            if ($dateStart && $dateEnd) {
                $query->whereBetween('created_at', [$dateStart, $dateEnd]);
            }

            $tasks = $query->get();
            if (is_null($tasks)) {
                return redirect()->route('project.index')->with('error', 'Sem arquivos!');
            }
            $data = [];
            foreach ($tasks as $task) {
                $data[] = [
                    'id' => $task->id,
                    'Titulo' => $task->title,
                    'Descrição' => $task->description,
                    'Estado' => $task->status,
                    'Data' => $task->due_date
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
