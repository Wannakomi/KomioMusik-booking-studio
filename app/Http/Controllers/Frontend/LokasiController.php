<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JamOperasional;

class LokasiController extends Controller
{
    public function index()
    {
        $jam_operasional = JamOperasional::orderByRaw("FIELD(hari, 'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu')")->get();

        return view('frontend.lokasi', compact('jam_operasional'));
    }  

}
