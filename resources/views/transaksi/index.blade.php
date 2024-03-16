@extends('layouts.public')
@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">

@stop

@section('container')
<!-- Main Content -->
<div class="main-content">

    <section class="section">
        <div class="section-header">
            <h1>Data Transaksi</h1>
        </div>
        <div class="col-12">
            <div class="card">
                {{-- <div class="needs-validation" novalidate=""> --}}

                    <div class="card-body">
                        <div class="p-0 col-md-3 mt-2">
                            <a href="{{ route('transaksi.create') }}" class="btn btn-primary"><i
                                    class="fas fa-plus-circle"></i> New Transaksi</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="exest" class="table table-striped mb-0">
                                <thead>
                                    <th>No.</th>
                                    <th>Transaksi</th>
                                    <th>Total Item</th>
                                    <th>Total Quantity</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>

                                    @if (!empty($transactions))
                                    @foreach ($transactions as $transaction)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>{{ $transaction->no_transaction }}</td>
                                        <td>{{ $transaction->details->count() }}</td>
                                        <td>{{ $transaction->details->sum('quantity') }}</td>

                                        <td>
                                            <form action="{{ route('transaksi.destroy', $transaction->id) }}"
                                                method="POST">
                                                <a href="{{ route('transaksi.edit', $transaction->id) }}"
                                                    class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                                @csrf
                                                @method('DELETE')

                                                @if (empty($detail))
                                                <button type="submit" class="btn btn-sm btn-danger swal-confirm"><i
                                                        class="fas fa-trash"></i></button>
                                                @endif
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else

                                    @endif


                                </tbody>
                                <tfoot>
                                    <tr>

                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    {{--
                </div> --}}
            </div>
        </div>

    </section>
    {{-- --}}

</div>
@endsection

{{-- Jika ada script tambahan Libreri --}}
@section('js-libraies')
<script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
{{-- <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js">
</script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js">
</script> --}}
@endsection

{{-- Jika ada script tambahan Specifik --}}
@section('js-specific')
{{-- <script src="/assets/js/chartJS-module.js"></script> --}}
@endsection
