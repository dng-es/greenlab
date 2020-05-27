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

class MembersExport implements FromCollection, WithHeadings, WithEvents, WithStrictNullComparison, ShouldAutoSize
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
            'Code',
            __('general.Name'),
            __('general.Last_name'),
            __('general.Telephone'),
            'Email',
            __('general.Image'),
            __('general.Born_at'),
            __('general.Notes'),
            __('general.Active'),
            __('general.Created_at'),
            __('general.Updated_at'),
        ];
    }    

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
     
        $export_ini = $this->request->input('export_ini', '');
        $export_end = $this->request->input('export_end', '');

        $data = DB::table('members')
            ->get();


        return $data;
    }
}
