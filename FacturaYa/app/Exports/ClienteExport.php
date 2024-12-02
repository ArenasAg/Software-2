<?php

namespace App\Exports;

use App\Models\Cliente;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Response;

class ClienteExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Cliente::all();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Numero de documento',
            'Direccion',
            'Telefono',
            'Email',
            'Ciudad'
        ];
    }

    /**
     * Export the data to an Excel file.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export()
    {
        $clientes = $this->collection();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set the headers
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Numero de documento');
        $sheet->setCellValue('C1', 'Direccion');
        $sheet->setCellValue('D1', 'Telefono');
        $sheet->setCellValue('E1', 'Email');
        $sheet->setCellValue('F1', 'Ciudad');

        // Set the data
        $row = 2;
        foreach ($clientes as $cliente) {
            $sheet->setCellValue('A' . $row, $cliente->id);
            $sheet->setCellValue('B' . $row, $cliente->numero_documento);
            $sheet->setCellValue('C' . $row, $cliente->direccion);
            $sheet->setCellValue('D' . $row, $cliente->telefono);
            $sheet->setCellValue('E' . $row, $cliente->email);
            $sheet->setCellValue('F' . $row, $cliente->ciudad);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'clientes.xlsx';
        $writer->save($fileName);

        return Response::download($fileName)->deleteFileAfterSend(true);
    }
}
