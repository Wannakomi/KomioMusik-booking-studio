@extends('backend.v_layouts.app')

@section('title', 'Daftar Pembayaran Lunas')

@section('content')
<div class="container-fluid">
    <h4 class="mb-4 fw-bold text-dark">✅ Daftar Pembayaran Lunas</h4>

    @if(session('success'))
        <div class="alert alert-success shadow-sm rounded">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm border-0 rounded">
        <div class="card-body table-responsive">
            <table class="table table-hover align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Kode Booking</th>
                        <th>Nama Pemesan</th>
                        <th>Tanggal Booking</th>
                        <th>Total Pembayaran</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pembayaran as $data)
                        <tr>
                            <td><span class="fw-semibold text-primary">{{ $data->kode_booking }}</span></td>
                            <td class="text-start">{{ $data->nama_pemesan }}</td>
                            <td>
                                {{ optional($data->booking)->tanggal ? \Carbon\Carbon::parse($data->booking->tanggal)->format('d M Y') : '-' }}
                            </td>
                            <td class="text-end">Rp {{ number_format($data->total_pembayaran, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge bg-success px-3 py-2">LUNAS</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada data.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
