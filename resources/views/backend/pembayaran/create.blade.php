@extends('backend.v_layouts.app')

@section('title', 'Tambah Pembayaran')

@section('content')
<div class="container-fluid">
    <h4 class="mb-4">Tambah Pembayaran</h4>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('backend.pembayaran.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="booking_id" class="form-label">Pilih Booking</label>
            <select name="booking_id" id="booking_id" class="form-control" required>
                <option value="">-- Pilih Booking --</option>
                @foreach ($booking as $item)
                    <option value="{{ $item->id }}" 
                        data-kode="{{ $item->kode_booking }}" 
                        data-nama="{{ $item->nama_pemesan }}" 
                        data-tanggal="{{ $item->tanggal }}">
                        {{ $item->kode_booking }} - {{ $item->nama_pemesan }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Kode Booking</label>
            <input type="text" name="kode_booking" id="kode_booking" class="form-control" readonly required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Pemesan</label>
            <input type="text" name="nama_pemesan" id="nama_pemesan" class="form-control" readonly required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Booking</label>
            <input type="date" name="tanggal_booking" id="tanggal_booking" class="form-control" readonly required>
        </div>

        <div class="mb-3">
            <label class="form-label">Total Pembayaran</label>
            <input type="number" name="total_pembayaran" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

{{-- Script untuk auto fill --}}
<script>
    document.getElementById('booking_id').addEventListener('change', function () {
        const selected = this.options[this.selectedIndex];
        document.getElementById('kode_booking').value = selected.getAttribute('data-kode') || '';
        document.getElementById('nama_pemesan').value = selected.getAttribute('data-nama') || '';
        document.getElementById('tanggal_booking').value = selected.getAttribute('data-tanggal') || '';
    });
</script>
@endsection
