@extends('backend.v_layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card shadow rounded border-0">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold text-primary mb-0">
                    <i class="bi bi-calendar-check-fill"></i> Daftar Booking Studio
                </h4>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Filter Form -->
            <form method="GET" action="{{ route('backend.booking.index') }}" class="row g-3 mb-4">
                <div class="col-md-4">
                    <input type="date" name="tanggal" class="form-control border-primary shadow-sm" value="{{ request('tanggal') }}">
                </div>
                <div class="col-md-4">
                    <select name="ruangan_id" class="form-select border-primary shadow-sm">
                        <option value="">Pilih Ruangan</option>
                        @foreach ($ruangans as $ruangan)
                            <option value="{{ $ruangan->id }}" {{ request('ruangan_id') == $ruangan->id ? 'selected' : '' }}>
                                {{ $ruangan->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-outline-primary w-100 shadow-sm">
                        <i class="bi bi-filter-circle me-1"></i> Filter
                    </button>
                </div>
            </form>

            <!-- Tabel Booking -->
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center table-bordered border-light shadow-sm">
                    <thead class="table-light">
                        <tr>
                            <th>Kode</th>
                            <th>Pemesan</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Ruangan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dataBooking as $booking)
                            <tr>
                                <td class="fw-semibold text-primary">{{ $booking->kode_booking }}</td>
                                <td>{{ $booking->nama_pemesan }}</td>
                                <td>{{ \Carbon\Carbon::parse($booking->tanggal)->format('d M Y') }}</td>
                                <td>
                                    <span class="badge bg-light text-dark border border-secondary">
                                        {{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}
                                    </span>
                                </td>
                                <td>{{ $booking->ruangan->nama ?? '-' }}</td>
                                <td>
                                    @php
                                        $statusClass = match($booking->status) {
                                            'paid' => 'bg-success',
                                            'pending' => 'bg-warning text-dark',
                                            'batal' => 'bg-danger',
                                            default => 'bg-secondary text-light',
                                        };
                                    @endphp

                                    <span class="badge {{ $statusClass }}">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('backend.booking.show', $booking->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <form action="{{ route('backend.booking.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus booking ini?')" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-muted">Belum ada data booking</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
