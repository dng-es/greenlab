<?php

namespace App\Exports;

use App\Expense;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\Fill;
class ExpensesExport implements FromCollection, WithHeadings, WithEvents, WithStrictNullComparison, ShouldAutoSize
{

    use RegistersEventListeners;

    private $request;
    private $type;

    function __construct($type, $request){
        $this->type = $type;
        $this->request = $request;
    }

    public static function afterSheet(AfterSheet $event)
    {
        $event->sheet->getDelegate()->getStyle('A1:'.$event->sheet->getDelegate()->getHighestColumn().'1')
        ->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('b0b0b0');
    }

    public function headings(): array
    {
        return [
            __('app.Supplier'),
            __('general.Notes'),
            __('app.Amount'),
            __('app.Price'),
            __('app.Total'),
            __('general.Date'),
            __('general.Created_at'),
        ];
    } 

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
     
        $export_ini = $this->request->input('export_ini', '');
        $export_end = $this->request->input('export_end', '');
        $data = Expense::select('suppliers.name', 'expenses.notes', 'expenses.amount', 'expenses.price', 'expenses.total', 'expenses.date_at', 'expenses.created_at')
                ->leftJoin('suppliers', 'suppliers.id', 'expenses.supplier_id')
                ->when($export_ini != '', function($query) use ($export_ini){
                    return $query->whereDate('warehouses.date_at', '>=', $export_ini);
                })
                ->when($export_end != '', function($query) use($export_end){
                    return $query->whereDate('warehouses.date_at', '<=', $export_end);
                })
                ->get();

        return $data;
    }
}
