<?php

namespace App\Exports;

use App\Models\Libro;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Response;

class LibroExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Libro::all();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Código',
            'Nombre',
            'Imagen',
            'Precio de Venta',
            'Medida',
            'Categoría ID',
            'Impuesto ID'
        ];
    }

    /**
     * Export the data to an Excel file.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export()
    {
        $libros = $this->collection();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set the headers
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Código');
        $sheet->setCellValue('C1', 'Nombre');
        $sheet->setCellValue('D1', 'Imagen');
        $sheet->setCellValue('E1', 'Precio de Venta');
        $sheet->setCellValue('F1', 'Medida');
        $sheet->setCellValue('G1', 'Categoría ID');
        $sheet->setCellValue('H1', 'Impuesto ID');

        // Set the data
        $row = 2;
        foreach ($libros as $libro) {
            $sheet->setCellValue('A' . $row, $libro->id);
            $sheet->setCellValue('B' . $row, $libro->codigo);
            $sheet->setCellValue('C' . $row, $libro->nombre);
            $sheet->setCellValue('D' . $row, $libro->imagen);
            $sheet->setCellValue('E' . $row, $libro->precio_venta);
            $sheet->setCellValue('F' . $row, $libro->medida);
            $sheet->setCellValue('G' . $row, $libro->categoria_id);
            $sheet->setCellValue('H' . $row, $libro->impuesto_id);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'libros.xlsx';
        $writer->save($fileName);

        return Response::download($fileName)->deleteFileAfterSend(true);
    }
}
