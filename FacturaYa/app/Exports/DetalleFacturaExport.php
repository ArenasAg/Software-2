<?php

namespace App\Exports;

use App\Models\DetalleFactura;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Response;

class DetalleFacturaExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DetalleFactura::all();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Cantidad',
            'Valor Total',
            'Descuento',
            'Libro ID',
            'Factura ID'
        ];
    }

    /**
     * Export the data to an Excel file.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export()
    {
        $detalles = $this->collection();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set the headers
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Cantidad');
        $sheet->setCellValue('C1', 'Valor Total');
        $sheet->setCellValue('D1', 'Descuento');
        $sheet->setCellValue('E1', 'Libro ID');
        $sheet->setCellValue('F1', 'Factura ID');

        // Set the data
        $row = 2;
        foreach ($detalles as $detalle) {
            $sheet->setCellValue('A' . $row, $detalle->id);
            $sheet->setCellValue('B' . $row, $detalle->cantidad);
            $sheet->setCellValue('C' . $row, $detalle->valor_total);
            $sheet->setCellValue('D' . $row, $detalle->descuento);
            $sheet->setCellValue('E' . $row, $detalle->libro_id);
            $sheet->setCellValue('F' . $row, $detalle->factura_id);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'detalle_facturas.xlsx';
        $writer->save($fileName);

        return Response::download($fileName)->deleteFileAfterSend(true);
    }
}
