<?php

namespace App\Exports;

use App\Models\Inventario;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Response;

class InventarioExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Inventario::all();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Fecha',
            'Tipo de Movimiento',
            'Entrada',
            'Salida',
            'Libros ID'
        ];
    }

    /**
     * Export the data to an Excel file.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export()
    {
        $inventarios = $this->collection();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set the headers
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Fecha');
        $sheet->setCellValue('C1', 'Tipo de Movimiento');
        $sheet->setCellValue('D1', 'Entrada');
        $sheet->setCellValue('E1', 'Salida');
        $sheet->setCellValue('F1', 'Libros ID');

        // Set the data
        $row = 2;
        foreach ($inventarios as $inventario) {
            $sheet->setCellValue('A' . $row, $inventario->id);
            $sheet->setCellValue('B' . $row, $inventario->fecha);
            $sheet->setCellValue('C' . $row, $inventario->tipo_movimiento);
            $sheet->setCellValue('D' . $row, $inventario->entrada);
            $sheet->setCellValue('E' . $row, $inventario->salida);
            $sheet->setCellValue('F' . $row, $inventario->libros_id);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'inventarios.xlsx';
        $writer->save($fileName);

        return Response::download($fileName)->deleteFileAfterSend(true);
    }
}
