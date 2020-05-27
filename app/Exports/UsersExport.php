<?php

namespace App\Exports;

use App\User;
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

class UsersExport implements FromCollection, WithHeadings, WithEvents, WithStrictNullComparison, ShouldAutoSize
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
            'Email',
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

        $data = DB::table('users')
            ->select('id', 'name', 'email', 'created_at')
            ->when(($export_ini != '' && $export_end != ''), function ($query) use ($export_ini, $export_end) {
                return $query->whereDate('created_at', '>=', $export_ini)
                             ->whereDate('created_at', '<=', $export_end);
            })
            ->when(($export_ini == '' && $export_end != ''), function ($query) use ($export_end) {
                return $query->whereDate('created_at', '<=', $export_end);
            })
            ->when(($export_ini != '' && $export_end == ''), function ($query) use ($export_ini) {
                return $query->whereDate('created_at', '>=', $export_ini);
            })
            ->get();


        return $data;
    }
}
