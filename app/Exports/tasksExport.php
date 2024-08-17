<?php

namespace App\Exports;
use App\Models\Task;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use Illuminate\Support\Facades\Cache;

class tasksExport {
    public function excelExport() {
        $cacheKey = 'tasksExcel_export';
        $filePath = Cache::remember($cacheKey, now()->addMinutes(10), function () {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setTitle('Tasks');

            $tasks = Task::all();

            $headers = ['id', 'Titulo', 'Descrição', 'Estado','Data'];
            $sheet->fromArray($headers);

            $row = 2;

            foreach ($tasks as $task) {
                $sheet->setCellValue("A" . $row, $task->id);
                $sheet->setCellValue("B" . $row, $task->title);
                $sheet->setCellValue("C" . $row, $task->description);
                $sheet->setCellValue("D" . $row, $task->status);
                $sheet->setCellValue("E" . $row, $task->due_date);
                $row++;
            }

            $writer = new Xlsx($spreadsheet);

            $filePath = storage_path('app/public/exports/tasks.xlsx');
            $writer->save($filePath);

            return $filePath;
        });

        return response()->download($filePath)->deleteFileAfterSend(true);

    }

    public function pdfExport() {
        $cacheKey = 'tasksPdf_export';
        $filePath = Cache::remember($cacheKey, now()->addMinutes(10), function () {
            $data = [];
            $tasks = Task::all();
            foreach ($tasks as $task) {
                $data[] = [
                    'id' => $task->id,
                    'Titulo' => $task->title,
                    'Descrição' => $task->description,
                    'Estado' => $task->status,
                    'Data' => $task->due_date
                ];
            }
            $pdf = Pdf::loadView('task.taskPdf', ['data' => $data]);
            $filePath = storage_path('app/public/exports/tasks.pdf');
            $pdf->save($filePath);

            return $filePath;
        });
        return response()->download($filePath)->deleteFileAfterSend(true);
    }
}
