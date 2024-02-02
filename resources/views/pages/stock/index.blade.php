@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4">
        <h3 class="mt-4">Stock Barang</h3>
        <ol class="breadcrumb mb-5">
            <li class="breadcrumb-item active">Stock All Device</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#myModal">
                    <i class="fa-solid fa-plus"></i> Tambah
                </button>
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Deskripsi</th>
                            <th>Stock</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stocks as $stock)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $stock->nama_barang }}</td>
                                <td>{{ $stock->deskripsi }}</td>
                                <td>{{ $stock->stock }}</td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#editModal">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#destroyModal">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Barang</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form method="POST" action="{{ route('stock.store') }}">
                        @csrf
                        <div class="mt-3">
                            <input type="text" name="nama_barang" placeholder="Nama Barang" class="form-control">
                        </div>
                        <div class="mt-3">
                            <input type="text" name="deskripsi" placeholder="Deskripsi" class="form-control">
                        </div>
                        <div class="mt-3">
                            <input type="number" name="stock" class="form-control" placeholder="Stock">
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- The Modal Edit -->
    @foreach ($stocks as $stock)
        <div class="modal fade" id="editModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Barang</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form method="POST" action="{{ route('stock.update', ['id' => $stock->id]) }}">
                            @method('PUT')
                            @csrf
                            <div class="mt-3">
                                <input type="text" name="nama_barang" placeholder="Nama Barang" class="form-control"
                                    value="{{ $stock->nama_barang }}">
                            </div>
                            <div class="mt-3">
                                <input type="text" name="deskripsi" placeholder="Deskripsi" class="form-control"
                                    value="{{ $stock->deskripsi }}">
                            </div>
                            <div class="mt-3">
                                <input type="number" name="stock" class="form-control" placeholder="Stock"
                                    value="{{ $stock->stock }}">
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-warning">Update</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

     <!-- The Modal Edit -->
     @foreach ($stocks as $stock)
     <div class="modal fade" id="destroyModal">
         <div class="modal-dialog">
             <div class="modal-content">

                 <!-- Modal Header -->
                 <div class="modal-header">
                     <h4 class="modal-title">Hapus Barang</h4>
                     <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                 </div>

                 <!-- Modal body -->
                 <div class="modal-body">
                     <form method="GET" action="{{ route('stock.destroy', ['id' => $stock->id]) }}">
                         @method('DELETE')
                         @csrf

                         <div class="align-middle">
                             <p>Apakah Anda Yakin Akan Menghapus ?</p>
                         </div>

                         <!-- Modal footer -->
                         <div class="modal-footer">
                             <button type="submit" class="btn btn-danger">Delete</button>
                             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
     </div>
 @endforeach
@endsection
