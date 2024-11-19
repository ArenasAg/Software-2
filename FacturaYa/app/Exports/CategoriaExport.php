<?php

namespace App\Exports;

use App\Models\Categoria;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Response;

class CategoriaExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Categoria::all();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Nombre',
            'Creado en',
            'Actualizado en'
        ];
    }

    /**
     * Export the data to an Excel file.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export()
    {
        $categorias = $this->collection();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set the headers
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Nombre');
        $sheet->setCellValue('C1', 'Creado en');
        $sheet->setCellValue('D1', 'Actualizado en');

        // Set the data
        $row = 2;
        foreach ($categorias as $categoria) {
            $sheet->setCellValue('A' . $row, $categoria->id);
            $sheet->setCellValue('B' . $row, $categoria->nombre);
            $sheet->setCellValue('C' . $row, $categoria->created_at);
            $sheet->setCellValue('D' . $row, $categoria->updated_at);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'categorias.xlsx';
        $writer->save($fileName);

        return Response::download($fileName)->deleteFileAfterSend(true);
    }
}
