<?php

namespace App\Exports;

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
class ProductsExport implements FromCollection, WithHeadings, WithEvents, WithStrictNullComparison, ShouldAutoSize
{

    use RegistersEventListeners;

    private $request;

    function __construct($request){
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
            'ID',
            __('general.Name'),
            __('app.Category'),
            __('app.Price'),
            __('app.Amount'),
            __('app.Menu'),
        ];
    } 

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
     
        $export_ini = $this->request->input('export_ini', '');
        $export_end = $this->request->input('export_end', '');

        $data = DB::table('products')
            ->select('products.id AS Id', 'products.name AS Name', 'categories.name AS Category', 'products.price', 'products.amount', 'products.menu')
            ->leftJoin('categories', 'categories.id', 'products.category_id')
            ->get();


        return $data;
    }
}
