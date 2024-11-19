<?php

namespace App\Exports;

use App\Models\Impuesto;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Response;

class ImpuestoExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Impuesto::all();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Nombre',
            'Porcentaje'
        ];
    }

    /**
     * Export the data to an Excel file.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export()
    {
        $impuestos = $this->collection();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set the headers
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Nombre');
        $sheet->setCellValue('C1', 'Porcentaje');

        // Set the data
        $row = 2;
        foreach ($impuestos as $impuesto) {
            $sheet->setCellValue('A' . $row, $impuesto->id);
            $sheet->setCellValue('B' . $row, $impuesto->nombre);
            $sheet->setCellValue('C' . $row, $impuesto->porcentaje);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'impuestos.xlsx';
        $writer->save($fileName);

        return Response::download($fileName)->deleteFileAfterSend(true);
    }
}
