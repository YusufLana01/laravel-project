<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;

class DashboardController extends Controller
{
    private function hitungCPI($data)
    {
        $max = [
            'g1' => Mahasiswa::max('g1'),
            'g2' => Mahasiswa::max('g2'),
            'g3' => Mahasiswa::max('g3'),
            'studytime' => Mahasiswa::max('studytime'),
        ];

        $minAbsence = Mahasiswa::min('absences');

        foreach ($data as $m) {

            $norm_g1 = $max['g1'] > 0 ? ($m->g1 / $max['g1']) : 0;
            $norm_g2 = $max['g2'] > 0 ? ($m->g2 / $max['g2']) : 0;
            $norm_g3 = $max['g3'] > 0 ? ($m->g3 / $max['g3']) : 0;
            $norm_studytime = $max['studytime'] > 0 ? ($m->studytime / $max['studytime']) : 0;

            if ($m->absences == 0) {
                $norm_absences = 1;
            } else {
                $norm_absences = $minAbsence / $m->absences;
            }

            $m->cpi =
                ($norm_g1 * 0.20) +
                ($norm_g2 * 0.25) +
                ($norm_g3 * 0.30) +
                ($norm_absences * 0.15) +
                ($norm_studytime * 0.10);
        }

        return $data;
    }

    public function analisis()
    {
        $data = Mahasiswa::all();
        $data = $this->hitungCPI($data);

        $avgCpi = $data->avg('cpi');
        $maxCpi = $data->max('cpi');
        $minCpi = $data->min('cpi');

        return view('dashboard.analisis', compact('data', 'avgCpi', 'maxCpi', 'minCpi'));
    }

    public function ranking()
    {
        $ranking = Mahasiswa::all();
        $ranking = $this->hitungCPI($ranking);
        $ranking = $ranking->sortByDesc('cpi')->take(10);

        return view('dashboard.ranking', compact('ranking'));
    }
}
