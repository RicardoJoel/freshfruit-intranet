<?php

namespace App\Exports;

use Carbon\Carbon;
/* From array */
use Maatwebsite\Excel\Concerns\FromArray;
/* Heading */
use Maatwebsite\Excel\Concerns\WithHeadings;
/* Value binders */
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
/* Auto size column */
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
/* Styling */
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class InvoicesExport extends DefaultValueBinder implements FromArray, WithHeadings, WithCustomValueBinder, ShouldAutoSize, WithStyles
{
    protected $invoices;
    protected $headings;
    protected $detail;

    public function __construct(array $invoices, array $headings, $product, $country, $shipper, $consignee, $detail, $start_at, $end_at)
    {
        $this->invoices = $invoices;
        $this->headings = $headings;
        $this->product = $product;
        $this->country = $country;
        $this->shipper = $shipper;
        $this->consignee = $consignee;
        $this->detail = $detail;
        $this->start_at = $start_at;
        $this->end_at = $end_at;
    }

    public function array(): array
    {
        return $this->invoices;
    }

    public function headings(): array
    {
        $head = ['País destino','Exportador','Consignatario'];
        switch ($this->detail) {
            case 'Anual':
                foreach ($this->headings as $heading)
                    $head[] = $heading['detail'];
                break;
            case 'Mensual':
                setlocale(LC_ALL, 'es_ES');
                foreach ($this->headings as $heading)
                    $head[] = ucfirst(Carbon::parse($heading['detail'])->formatLocalized('%B %Y'));
                break;
            case 'Semanal':
                foreach ($this->headings as $heading)
                    $head[] = 'Sem'.substr($heading['detail'],4,2).' '.substr($heading['detail'],0,4);
                break;
            default:
                foreach ($this->headings as $heading)
                    $head[] = Carbon::parse($heading['detail'])->format('d/m/Y');
        }
        $head[] = 'Volumen total';
        return [
            ['Exportación nacional de '.$this->product.' (todos los valores se muestran en kilogramos)'],
            [],
            ['País destino:', 'Exportador:', 'Consignatario:'],
            [$this->country, $this->shipper, $this->consignee],
            ['Detalle:', 'Fecha inicio:', 'Fecha fin:'],
            [$this->detail, $this->start_at, $this->end_at],
            [],
            $head,
        ];
    }

    public function bindValue(Cell $cell, $value)
    {
        if (is_numeric($value)) {
            $cell->setValueExplicit($value, DataType::TYPE_NUMERIC);
            return true;
        }
        // else return default behavior
        return parent::bindValue($cell, $value);
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:C1');
        return [
            // Style the first row as bold text
            3 => ['font' => ['bold' => true]],
            5 => ['font' => ['bold' => true]],
            8 => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
            1 => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
        ];
    }
}