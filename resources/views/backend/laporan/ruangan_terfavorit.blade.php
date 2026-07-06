@extends('backend.v_layouts.app')

@section('title', 'Ruangan Terfavorit')

@section('content')
<div class="container-fluid">
    <h4 class="mb-4">Ruangan Terfavorit</h4>

    <div class="card">
        <div class="card-body">
            @if ($ruangan->isEmpty())
                <div class="alert alert-info text-center">
                    Belum ada data ruangan favorit.
                </div>
            @else
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Ruangan</th>
                            <th>Jumlah Booking</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ruangan as $r)
                        <tr>
                            <td>{{ $r->ruangan }}</td>
                            <td>{{ $r->jumlah }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
