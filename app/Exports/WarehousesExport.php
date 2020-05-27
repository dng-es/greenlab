<?php

namespace App\Exports;

use App\Warehouse;
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
class WarehousesExport implements FromCollection, WithHeadings, WithEvents, WithStrictNullComparison, ShouldAutoSize
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
            __('general.Name'),
            __('app.Product'),
            __('app.Category'),
            __('app.Bar'),
            __('app.Price'),
            __('app.Amount'),
            __('app.Amount').' real',
            __('app.Total'),
            __('general.Type'),
            __('general.Date'),
        ];
    } 

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
     
        $export_ini = $this->request->input('export_ini', '');
        $export_end = $this->request->input('export_end', '');
        $data = Warehouse::leftJoin('products', 'products.id', 'warehouses.product_id')
                ->leftJoin('categories', 'categories.id', 'products.category_id')
                ->when($this->type == 'S', function($query){
                    return $query->select(DB::raw("CONCAT(members.name,' ',members.last_name)  AS fullname"), 'products.name AS product', 'categories.name AS category', 'categories.bar', 'warehouses.price', 'warehouses.amount', 'warehouses.amount_real', 'warehouses.total', 'warehouses.type', 'warehouses.created_at')
                            ->leftJoin('members', 'members.id', 'warehouses.member_id');
                }, function($query){
                    return $query->select('suppliers.name AS fullname', 'products.name AS product', 'categories.name AS category', 'categories.bar', 'warehouses.price', 'warehouses.amount', 'warehouses.amount_real', 'warehouses.total', 'warehouses.type', 'warehouses.created_at')
                            ->leftJoin('suppliers', 'suppliers.id', 'warehouses.supplier_id');

                })->where('warehouses.type', $this->type)
                ->when($export_ini != '', function($query) use ($export_ini){
                    return $query->whereDate('warehouses.created_at', '>=', $export_ini);
                })
                ->when($export_end != '', function($query) use($export_end){
                    return $query->whereDate('warehouses.created_at', '<=', $export_end);
                })
                ->get();

        return $data;
    }
}
