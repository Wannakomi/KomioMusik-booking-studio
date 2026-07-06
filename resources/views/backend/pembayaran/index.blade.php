@extends('backend.v_layouts.app')

@section('title', 'Daftar Pembayaran')

@section('content')
<div class="container-fluid">
    <h4 class="mb-4">Daftar Pembayaran</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Kode Booking</th>
                        <th>Nama Pemesan</th>
                        <th>Tanggal Booking</th>
                        <th>Total Pembayaran</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pembayaran as $booking)
                    <tr>
                        <td>{{ $booking->kode_booking }}</td>
                        <td>{{ $booking->user->nama ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($booking->tanggal)->format('d M Y') }}</td>
                        <td>
                            @if($booking->pembayaran)
                                Rp {{ number_format($booking->pembayaran->total_pembayaran, 0, ',', '.') }}
                            @else
                                <span class="text-muted">Belum dibayar</span>
                            @endif
                        </td>
                        <td>
                            @if($booking->pembayaran && $booking->pembayaran->status == 'paid')
                                <span class="badge bg-success">Lunas</span>
                            @elseif($booking->pembayaran && $booking->pembayaran->status == 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @else
                                <span class="badge bg-secondary">Pending</span>
                            @endif
                        </td>
                        <td>
                            @if($booking->pembayaran)
                                @if($booking->pembayaran->status == 'pending')
                                    <form action="{{ route('backend.pembayaran.markAsPaid', $booking->pembayaran->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success mb-1">Verifikasi</button>
                                    </form>

                                    <form action="{{ route('backend.pembayaran.destroy', $booking->pembayaran->id) }}" method="POST" style="display:inline;">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus pembayaran ini?')">Hapus</button>
                                    </form>
                                @else
                                    <span class="text-muted">Sudah dibayar</span>
                                @endif
                            @else
                                <span class="text-muted d-block">Belum ada pembayaran</span>

                                {{-- Tambahin hapus booking kalau belum ada pembayaran --}}
                                <form action="{{ route('backend.booking.destroy', $booking->id) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger mt-1" onclick="return confirm('Hapus booking ini?')">Hapus Booking</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Belum ada data pembayaran.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
