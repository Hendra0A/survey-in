<?php

namespace App\Exports;

use App\Models\DataSurvey;
use App\Models\JenisFasos;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class DataSurveyExport implements FromView, ShouldAutoSize, WithEvents
{
    protected $id;

    function __construct($id)
    {
        $this->id = $id;
    }

    public function view(): View
    {
        $data = DataSurvey::with(['user', 'konstruksiJalan', 'konstruksiSaluran', 'kecamatan', 'fasosTable.jenisFasos', 'lampiranFoto.jenisLampiran'])->where('kecamatan_id', $this->id)->get();
        $fasos = JenisFasos::all();
        return view('admin.data-survei.view-cetak-resume-detail-data-survei', [
            'title' => 'Data Survei',
            'datas' => $data,
            'fasos' => $fasos
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A:AH')->applyFromArray([
                    'font' => [
                        'size' => 12,
                        'name'      =>  'Times New Roman'
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                ]);
                $event->sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 14
                    ],
                ]);
                $event->sheet->getStyle('B')->applyFromArray([
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_LEFT,
                    ]
                ]);
                $event->sheet->getStyle('A3:AH5')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ]
                ]);
            }
        ];
    }
}
