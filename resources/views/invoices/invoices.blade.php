@extends('layouts.web')

@push('head')
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="{{ asset('css/libs/jquery-confirm.min.css') }}" rel="stylesheet">
@endpush
@push('endBody')
    <script src="{{ asset('js/libs/jquery-confirm.min.js')}}"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    @includeJS(['url'=>'invoices/assets/_invoices.js', 'params' => [
        '[URL_DELETE]' => route('invoices-delete'),
        '[PATH_AJAX]' => route('invoices-list'),
        '[URL_FORM]' => route('invoices-update'),
        '[URL_ES]' => asset('i18n/datatables-spanish.json')
    ]])
@endpush

@section('content')

    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-note2 icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>Facturas
                    <div class="page-title-subheading">Aqui podras interactuar con las facturas
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
            </div>   
        </div>
    </div>

    <x-title-header title="Lista de facturas" :urls="[['Facturas']]"></x-title-header>

    <div class="card border-right">
        <div class="card-body"> 
            
            <div class="row mb-3">
                <div class="col text-right">
                    <a href="{{ route('invoices-update') }}" class="btn btn-dark">
                        <i class="fa fa-save"></i>
                        Crear Factura
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-12 table-responsive">
                    <table id="datatable"
                        class="table table-striped table-bordered dt-responsive display no-wrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Total</th>
                                <th>Descuento total</th>
                                <th>Iva total</th>
                                <th>Fecha de creación</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
