@extends('layouts.app')

@section('content')
<div class="container py-5 text-white">
    <h2 class="text-center mb-4">Lokasi Studio Kami</h2>
    
    <div class="text-center mb-4">
        <!-- GANTI LINK INI DENGAN LINK EMBED GOOGLE MAPS KAMU -->
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.6465232474598!2d106.68878967499111!3d-6.310082593679231!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69e5280e897973%3A0x5e6c576ce592ff4a!2sAlwan%20badak!5e0!3m2!1sen!2sid!4v1748625619765!5m2!1sen!2sid" width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

    <div class="text-center">
        <p class="mb-0"><strong>Alamat:</strong></p>
        <p>Jl. Auwowo No. 14, Banten</p>
    </div>

    <div class="card bg-dark text-light p-4 mt-4">
        <h4 class="mb-3">Jam Operasional</h4>

        @if(isset($jam_operasional) && $jam_operasional->count())
            <div class="table-responsive">
                <table class="table table-dark table-borderless mb-0">
                    <tbody>
                        @foreach($jam_operasional as $jam)
                        <tr>
                            <td><strong>{{ $jam->hari }}</strong></td>
                            <td class="text-end">{{ \Carbon\Carbon::parse($jam->jam_buka)->format('H:i') }} - {{ \Carbon\Carbon::parse($jam->jam_tutup)->format('H:i') }}</td>
                            <td>
                                @if($jam->status == 'Aktif')
                                    <span class="text-success">(Buka)</span>
                                @else
                                    <span class="text">(Tutup)</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text">Data jam operasional belum tersedia.</p>
        @endif
    </div>
</div>
@endsection