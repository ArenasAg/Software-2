<?php

namespace App\Exports;

use App\Models\MetodoPago;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Response;

class MetodoPagoExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return MetodoPago::all();
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
        $metodosPago = $this->collection();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set the headers
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Nombre');
        $sheet->setCellValue('C1', 'Creado en');
        $sheet->setCellValue('D1', 'Actualizado en');

        // Set the data
        $row = 2;
        foreach ($metodosPago as $metodo) {
            $sheet->setCellValue('A' . $row, $metodo->id);
            $sheet->setCellValue('B' . $row, $metodo->nombre);
            $sheet->setCellValue('C' . $row, $metodo->created_at);
            $sheet->setCellValue('D' . $row, $metodo->updated_at);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'metodo_pagos.xlsx';
        $writer->save($fileName);

        return Response::download($fileName)->deleteFileAfterSend(true);
    }
}
