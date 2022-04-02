@extends('mahasiswa.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mt-2">
            <h2>JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG</h2>
            </div>
            <div class="float-right my-2">
                <a class="btn btn-success" href="{{ route('mahasiswa.create') }}"> Input Mahasiswa</a>
            </div>
        </div>
    </div>

    <p>Cari Data Mahasiswa :</p>
    <form action="/mahasiswa/cari" method="GET">
        <input type="text" name="cari" placeholder="Cari Mahasiswa .." value="{{ old('cari')}}">
        <input type="submit" value="CARI">
    </form>

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>Nim</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Jurusan</th>
            <th>No_Handphone </th>
            <th>TanggalLahir</th>
            <th>Email</th>
            <th width="280px">Action</th>
        </tr>
    @foreach ($mahasiswa as $mhs)
        <tr>
   
            <td>{{ $mhs ->nim }}</td>
            <td>{{ $mhs ->nama }}</td>
            <td>{{ $mhs ->kelas }}</td>
            <td>{{ $mhs ->jurusan }}</td>
            <td>{{ $mhs ->No_Handphone }}</td>
            <td>{{ $mhs ->TanggalLahir }}</td>
            <td>{{ $mhs ->Email }}</td>
            <td>
            <form action="{{ route('mahasiswa.destroy',['mahasiswa'=>$mhs->nim]) }}" method="POST">
   
                <a class="btn btn-info" href="{{ route('mahasiswa.show',$mhs->nim) }}">Show</a>
                <a class="btn btn-primary" href="{{ route('mahasiswa.edit',$mhs->nim) }}">Edit</a>
                @csrf
                @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
        </td>
    </tr>
    @endforeach
    </table>
@endsection