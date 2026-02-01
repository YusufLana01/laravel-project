<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        $data = Mahasiswa::all();

        if ($data->count() == 0) {
            return view('mahasiswa.index', compact('data'));
        }

        $max = [
            'g1' => Mahasiswa::max('g1') ?: 1,
            'g2' => Mahasiswa::max('g2') ?: 1,
            'g3' => Mahasiswa::max('g3') ?: 1,
            'studytime' => Mahasiswa::max('studytime') ?: 1,
        ];

        $minAbsence = Mahasiswa::min('absences') ?: 1;

        foreach ($data as $m) {

            $norm_g1 = $m->g1 / $max['g1'];
            $norm_g2 = $m->g2 / $max['g2'];
            $norm_g3 = $m->g3 / $max['g3'];
            $norm_studytime = $m->studytime / $max['studytime'];

            // COST: absences (semakin kecil semakin baik)
            $norm_absences = $m->absences == 0 ? 1 : ($minAbsence / $m->absences);

            // HITUNG CPI
            $m->cpi =
                ($norm_g1 * 0.20) +
                ($norm_g2 * 0.25) +
                ($norm_g3 * 0.30) +
                ($norm_absences * 0.15) +
                ($norm_studytime * 0.10);
        }

        $data = $data->sortByDesc('cpi')->values();

        return view('mahasiswa.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'g1' => 'required|numeric',
            'g2' => 'required|numeric',
            'g3' => 'required|numeric',
            'absences' => 'required|numeric',
            'studytime' => 'required|numeric',
        ]);

        Mahasiswa::create($request->only([
            'nama', 'g1', 'g2', 'g3', 'absences', 'studytime'
        ]));

        return redirect('/mahasiswa')->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'g1' => 'required|numeric',
            'g2' => 'required|numeric',
            'g3' => 'required|numeric',
            'absences' => 'required|numeric',
            'studytime' => 'required|numeric',
        ]);

        Mahasiswa::findOrFail($id)->update($request->only([
            'nama', 'g1', 'g2', 'g3', 'absences', 'studytime'
        ]));

        return redirect('/mahasiswa')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        Mahasiswa::destroy($id);
        return redirect('/mahasiswa')->with('success', 'Data berhasil dihapus');
    }

    public function import(Request $request)
    {
        $request->validate([
            'csv' => 'required|mimes:csv,txt'
        ]);

        $file = $request->file('csv');

        $rows = array_map(function ($line) {
            return str_getcsv($line, ';'); // delimiter ;
        }, file($file));

        unset($rows[0]); // hapus header

        foreach ($rows as $row) {

            if (!isset($row[30], $row[31], $row[32], $row[29], $row[2])) {
                continue;
            }

            Mahasiswa::create([
                'nama' => 'Student-' . uniqid(),
                'g1' => (int) $row[30],
                'g2' => (int) $row[31],
                'g3' => (int) $row[32],
                'absences' => (int) $row[29],
                'studytime' => (int) $row[2],
            ]);
        }

        return redirect('/mahasiswa')->with('success', 'Import CSV berhasil');
    }
}
