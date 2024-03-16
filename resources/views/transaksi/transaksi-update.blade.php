@extends('layouts.public')

@section('container')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Transaksi</h1>
        </div>

        @if (session('msg'))
        <div class="alert alert-primary alert-dismissible fade show mt-2" role="alert">
            {{ session('msg') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <div class="row mt-4 d-flex justify-content-center">
            <div class="col-lg-8">
                <div class="card card-primary">
                    {{-- 'transaksi.edit', $transaksi->id --}}
                    <form action="{{route('transaksi.update', [$transaksi->id])}}" method="POST"
                        enctype="multipart/form-data">{{method_field("PUT")}}@csrf

                        <div class="card-body">
                            <div class="form-group row">
                                <label for="no_transaksi" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                    Transaction No
                                    <span style="color:red;">*</span>
                                </label>
                                <div class="col-8">
                                    <input id="no_transaksi" type="text"
                                        class="form-control @error('no_transaksi')is-invalid @enderror"
                                        name="no_transaksi" value="{{ $transaksi->no_transaction }}"
                                        placeholder="Input No." required>
                                    @error('no_transaksi')
                                    <span class="has-error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="date_transaksi"
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                    Transaction Date
                                    <span style="color:red;">*</span>
                                </label>
                                <div class="col-8">
                                    <input id="date_transaksi" type="date"
                                        class="form-control @error('date_transaksi')is-invalid @enderror"
                                        name="date_transaksi" value="{{ $transaksi->transaction_date }}"
                                        placeholder="Ex. Harga" required>
                                    @error('date_transaksi')
                                    <span class="has-error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <hr>

                            <div class="form-group row">
                                <label for="keterangan" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                    Detail Item
                                </label>
                                <div class="col-8">
                                    @foreach($transaksi->details as $index => $detail)
                                    <div class="transaction-item">
                                        <label for="item{{ $index + 1 }}">Item:</label>
                                        <input type="text" name="item[]" value="{{ $detail->item }}" required>
                                        <label for="quantity{{ $index + 1 }}">Quantity:</label>
                                        <input type="number" name="quantity[]" value="{{ $detail->quantity }}" required>
                                        <button type="button" class="remove-item">Hapus</button>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary btn-sm">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-item')) {
            e.target.parentNode.remove();
        }
    });
</script>
@endsection