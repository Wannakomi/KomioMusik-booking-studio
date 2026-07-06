@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-warning fw-bold">Booking Saya</h2>

    @if (session('success'))
        <div class="alert alert-success d-flex align-items-center" style="background-color: #28a745; color: white; border-radius: 8px;">
            <i class="fas fa-check-circle me-2"></i> {!! session('success') !!}
        </div>
    @endif

    @forelse ($bookings as $booking)
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-body bg-dark text-white rounded-3">
                <p><strong>Kode:</strong> {{ $booking->kode_booking }}</p>
                <p><strong>Nama:</strong> {{ $booking->nama_pemesan }}</p>
                <p><strong>Tanggal:</strong> {{ $booking->tanggal }}</p>
                <p><strong>Ruangan:</strong> {{ $booking->ruangan->nama }}</p>
                <p><strong>Status:</strong>
                    @if($booking->status === 'paid')
                        <span class="badge bg-success">Lunas</span>
                    @elseif($booking->status === 'pending')
                        <span class="badge bg-warning text-dark">Pending</span>
                    @elseif($booking->status === 'cancelled')
                        <span class="badge bg-secondary">Dibatalkan</span>
                    @endif
                </p>

                <div class="mt-3 d-flex flex-wrap gap-2">
                    @if ($booking->status === 'pending')
                        <a href="{{ route('bayar.show', $booking->id) }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-credit-card me-1"></i> Bayar
                        </a>

                        <form action="{{ route('booking.cancel', $booking->id) }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan booking ini?')" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                <i class="fas fa-times me-1"></i> Cancel
                            </button>
                        </form>

                    @elseif($booking->status === 'paid')
                        @if($booking->pembayaran)
                            <a href="{{ route('pembayaran.struk', $booking->pembayaran->id) }}" target="_blank" class="btn btn-outline-success btn-sm">
                                <i class="fas fa-print me-1"></i> Cetak Struk
                            </a>
                        @endif

                    @elseif($booking->status === 'cancelled')
                        <form action="{{ route('booking.restore', $booking->id) }}" method="POST" onsubmit="return confirm('Aktifkan kembali booking ini?')" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-success btn-sm">
                                <i class="fas fa-undo me-1"></i> Aktifkan Ulang
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-warning">Belum ada data booking.</div>
    @endforelse
</div>
@endsection
