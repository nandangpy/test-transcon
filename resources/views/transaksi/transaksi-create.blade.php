@extends('layouts.public')

@section('container')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Transaksi</h1>
        </div>

        @if (session('msg'))
        <div class="alert alert-primary alert-dismissible fade show mt-2" role="alert">
            {{ session('msg') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        {{-- <p>Admin Dashboard</p> --}}
        <div class="row mt-4 d-flex justify-content-center">
            <div class="col-lg-8">
                <div class="card card-primary">

                    <form method="POST" action="{{route('transaksi.store')}}" enctype="multipart/form-data">@csrf
                        <div class="card-body">

                            <div class="form-group row">
                                <label for="no_transaksi" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                    Transaction No
                                    <span style="color:red;">*</span>
                                </label>
                                <div class="col-8">
                                    <input id="no_transaksi" type="text"
                                        class="form-control @error('no_transaksi')is-invalid @enderror"
                                        name="no_transaksi" value="{{ old('no_transaksi') }}" placeholder="Input No.">
                                    @error('no_transaksi')
                                    <span class="has-error">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="no_transaksi" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                    Transaction Date
                                    <span style="color:red;">*</span>
                                </label>
                                <div class="col-8">
                                    <input id="date_transaksi" type="date"
                                        class="form-control @error('date_transaksi')is-invalid @enderror"
                                        name="date_transaksi" value="{{ old('date_transaksi') }}"
                                        placeholder="Ex. Harga">
                                    @error('date_transaksi')
                                    <span class="has-error">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <hr>

                            <div class="form-group row">
                                <label for="keterangan" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                    Detail Item
                                </label>
                                <div class="col-8">
                                    <button type="button" id="add-item" class="btn btn-success btn-sm">
                                        Add Item
                                    </button>
                                </div>

                            </div>
                            {{-- <div class="form-group row"> --}}
                                <div class="form-group row" id="transaction-items">
                                    <div class="transaction-item">
                                        <label for="item1">Item:</label>
                                        <input type="text" name="item[]" required>
                                        <label for="quantity1">Quantity:</label>
                                        <input type="number" name="quantity[]" required>
                                    </div>
                                </div>
                                {{--
                            </div> --}}

                        </div>

                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary btn-sm">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- --}}
    </section>
</div>

<script>
    document.getElementById('add-item').addEventListener('click', function() {
        var itemsDiv = document.getElementById('transaction-items');
        var itemIndex = itemsDiv.children.length + 1;
        var itemDiv = document.createElement('div');
        itemDiv.classList.add('transaction-item');
        itemDiv.innerHTML = `
            <label for="item${itemIndex}">Item:</label>
            <input type="text" name="item[]" required>
            <label for="quantity${itemIndex}">Quantity:</label>
            <input type="number" name="quantity[]" required>
            <button type="button" class="remove-item">Hapus</button>
        `;
        itemsDiv.appendChild(itemDiv);
    });

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-item')) {
            e.target.parentNode.remove();
        }
    });
</script>
@endsection