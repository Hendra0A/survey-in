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
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class DataSurveyExport implements FromView, ShouldAutoSize
{

    // 
    // WithMapping,
    // WithHeadings,
    // WithEvents,
    // WithCustomStartCell
    protected $id;

    function __construct($id)
    {
        $this->id = $id;
    }

    public function view(): View
    {
        $data = DataSurvey::with(['user', 'konstruksiJalan', 'konstruksiSaluran', 'kecamatan', 'fasosTable.jenisFasos', 'lampiranFoto.jenisLampiran'])->where('kecamatan_id', $this->id)->get();
        $fasos = JenisFasos::all();
        // $data = DataSurvey::with(['user', 'konstruksiJalan', 'konstruksiSaluran', 'kecamatan', 'fasosTable.jenisFasos', 'lampiranFoto.jenisLampiran'])->get();
        // // dd($data);
        return view('admin.data-survei.view-cetak-resume-detail-data-survei', [
            'title' => 'Data Survei',
            // 'profile' => User::where('role', 'admin')->get(['nama_lengkap', 'avatar'])[0],
            'datas' => $data,
            'fasos' => $fasos
        ]);
    }

    // public function collection()
    // {
    //     return DataSurvey::with(['user', 'konstruksiJalan', 'konstruksiSaluran', 'kecamatan', 'fasosTable.jenisFasos', 'lampiranFoto.jenisLampiran'])->get();
    // }

    // public function map($data): array
    // {
    //     return [
    //         $data->nama_gang,
    //         $data->lokasi,
    //     ];
    // }

    // public function headings(): array
    // {
    //     return [
    //         'Nama Perumahan dan Gang',
    //         'Lokasi Perumahan',
    //         ['Jenis Rumah', 'Developer', 'Swadaya'],
    //     ];
    // }

    // public function registerEvents(): array
    // {
    //     return [
    //         AfterSheet::class => function (AfterSheet $event) {
    //             $event->sheet->getStyle('A3:D3')->applyFromArray([
    //                 'font' => [
    //                     'bold' => true
    //                 ],
    //                 'borders' => [
    //                     'outline' => [
    //                         'borderStyle' => Border::BORDER_THICK,
    //                         'color' => ['argb' => 'FFFF0000'],
    //                     ],
    //                 ]
    //             ]);
    //         }
    //     ];
    // }

    // public function startCell(): string
    // {
    //     return 'A3';
    // }
}
