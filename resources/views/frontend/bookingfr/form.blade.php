@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="card bg-dark text-white shadow-sm border-0">
        <div class="card-header bg-warning text-dark fw-bold d-flex align-items-center">
            <i class="fas fa-music me-2"></i> Form Booking Studio
        </div>

        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle me-1"></i> {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('booking.user.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nama_pemesan" class="form-label">Nama Pemesan</label>
                    <input type="text" name="nama_pemesan" id="nama_pemesan" class="form-control rounded-3" value="{{ old('nama_pemesan', auth()->user()->name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="text" name="tanggal" id="tanggal" class="form-control rounded-3" value="{{ old('tanggal') }}" required>
                </div>

                <div class="mb-3">
                    <label for="jam_mulai" class="form-label">Jam Mulai</label>
                    <input type="time" name="jam_mulai" id="jam_mulai" class="form-control rounded-3" value="{{ old('jam_mulai') }}" required>
                </div>

                <div class="mb-3">
                    <label for="jam_selesai" class="form-label">Jam Selesai</label>
                    <input type="time" name="jam_selesai" id="jam_selesai" class="form-control rounded-3" value="{{ old('jam_selesai') }}" required>
                </div>

                <div class="mb-4">
                    <label for="ruangan_id" class="form-label">Ruangan</label>
                    <select name="ruangan_id" id="ruangan_id" class="form-select rounded-3" required>
                        <option value="">Pilih Ruangan</option>
                        @foreach($ruangan as $r)
                            <option value="{{ $r->id }}">{{ $r->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="harga" class="form-label">Harga Ruangan</label>
                    <input type="text" class="form-control" id="harga" readonly>
                </div>

                <button type="submit" class="btn btn-primary rounded-pill px-4 py-2">
                    <i class="fas fa-calendar-check me-2"></i> Booking Sekarang
                </button>
            </form>

        </div>
    </div>
</div>

<!-- Script untuk otomatis isi Jam Selesai 1 jam setelah Jam Mulai -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const inputJamMulai = document.getElementById('jam_mulai');
        const inputJamSelesai = document.getElementById('jam_selesai');

        inputJamMulai.addEventListener('change', function () {
            const waktu = this.value;

            if (!waktu.includes(':')) return;

            let [jam, menit] = waktu.split(':').map(Number);
            jam = (jam + 1) % 24;

            const jamFormatted = String(jam).padStart(2, '0') + ':' + String(menit).padStart(2, '0');
            inputJamSelesai.value = jamFormatted;
        });
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#ruangan_id').on('change', function () {
            var ruanganId = $(this).val();

            if (ruanganId) {
                $.ajax({
                    url: '/get-harga-ruangan/' + ruanganId,
                    type: 'GET',
                    success: function (data) {
                        $('#harga').val("Rp " + parseInt(data.harga).toLocaleString());
                    },
                    error: function () {
                        $('#harga').val('Harga tidak ditemukan');
                    }
                });
            } else {
                $('#harga').val('');
            }
        });

        // Trigger awal kalau data lama dipilih ulang
        $('#ruangan_id').trigger('change');
    });
</script>

@endsection
