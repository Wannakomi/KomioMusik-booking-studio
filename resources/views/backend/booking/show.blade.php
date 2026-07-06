@extends('backend.v_layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card shadow rounded border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="bi bi-info-circle-fill me-2"></i> Detail Booking Studio
            </h5>
            <a href="{{ route('backend.booking.index') }}" class="btn btn-sm btn-light shadow-sm">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover align-middle">
                <tbody>
                    <tr>
                        <th class="bg-light text-end" width="30%">Kode Booking</th>
                        <td>{{ $booking->kode_booking }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light text-end">Nama Pemesan</th>
                        <td>{{ $booking->nama_pemesan }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light text-end">Tanggal</th>
                        <td>{{ $booking->tanggal }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light text-end">Jam</th>
                        <td>
                            <span class="badge bg-dark text-white fs-6">
                                {{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th class="bg-light text-end">Ruangan</th>
                        <td>{{ $booking->ruangan->nama ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light text-end">Status</th>
                        <td>
                            @php
                                $statusClass = match($booking->status) {
                                    'paid' => 'bg-success',
                                    'pending' => 'bg-warning text-dark',
                                    'batal' => 'bg-danger',
                                    default => 'bg-secondary text-light',
                                };
                            @endphp

                            <span class="badge {{ $statusClass }} fs-6">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
