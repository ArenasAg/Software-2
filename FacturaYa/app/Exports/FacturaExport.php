<?php

namespace App\Exports;

use App\Models\Factura;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Response;

class FacturaExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Factura::all();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Código',
            'Subtotal',
            'Total Impuestos',
            'Total',
            'Estado',
            'Cliente ID',
            'Método de Pago ID'
        ];
    }

    /**
     * Export the data to an Excel file.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export()
    {
        $facturas = $this->collection();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set the headers
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Código');
        $sheet->setCellValue('C1', 'Subtotal');
        $sheet->setCellValue('D1', 'Total Impuestos');
        $sheet->setCellValue('E1', 'Total');
        $sheet->setCellValue('F1', 'Estado');
        $sheet->setCellValue('G1', 'Cliente ID');
        $sheet->setCellValue('H1', 'Método de Pago ID');

        // Set the data
        $row = 2;
        foreach ($facturas as $factura) {
            $sheet->setCellValue('A' . $row, $factura->id);
            $sheet->setCellValue('B' . $row, $factura->codigo);
            $sheet->setCellValue('C' . $row, $factura->subtotal);
            $sheet->setCellValue('D' . $row, $factura->total_impuestos);
            $sheet->setCellValue('E' . $row, $factura->total);
            $sheet->setCellValue('F' . $row, $factura->estado);
            $sheet->setCellValue('G' . $row, $factura->cliente_id);
            $sheet->setCellValue('H' . $row, $factura->metodo_pago_id);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'facturas.xlsx';
        $writer->save($fileName);

        return Response::download($fileName)->deleteFileAfterSend(true);
    }
}
