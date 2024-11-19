<?php

namespace App\Exports;

use App\Models\Informe;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Response;

class InformeExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Informe::all();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Fecha',
            'Tipo de Informe',
            'Datos JSON'
        ];
    }

    /**
     * Export the data to an Excel file.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export()
    {
        $informes = $this->collection();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set the headers
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Fecha');
        $sheet->setCellValue('C1', 'Tipo de Informe');
        $sheet->setCellValue('D1', 'Datos JSON');

        // Set the data
        $row = 2;
        foreach ($informes as $informe) {
            $sheet->setCellValue('A' . $row, $informe->id);
            $sheet->setCellValue('B' . $row, $informe->fecha);
            $sheet->setCellValue('C' . $row, $informe->tipo_informe);
            $sheet->setCellValue('D' . $row, $informe->datos_json);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'informes.xlsx';
        $writer->save($fileName);

        return Response::download($fileName)->deleteFileAfterSend(true);
    }
}
