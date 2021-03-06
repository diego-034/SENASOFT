@extends('layouts.web')

@push('head')
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="{{ asset('css/libs/jquery-confirm.min.css') }}" rel="stylesheet">
@endpush
@push('endBody')
    <script src="{{ asset('js/libs/jquery-confirm.min.js')}}"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    @includeJS(['url'=>'products/assets/_products.js', 'params' => [
        '[URL_DELETE]' => route('products-delete'),
        '[PATH_AJAX]' => route('products-list'),
        '[URL_FORM]' => route('products-update'),
        '[URL_ES]' => asset('i18n/datatables-spanish.json')
    ]])
@endpush

@section('content')

    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-box1 icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>Productos
                    <div class="page-title-subheading">Aqui podras interactuar con los productos
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
            </div>   
        </div>
    </div>

    <x-title-header title="Lista de productos" :urls="[['Productos']]"></x-title-header>

    <div class="card border-right">
        <div class="card-body"> 
            
            <div class="row mb-3">
                <div class="col text-right">
                    <a href="{{ route('products-update') }}" class="btn btn-dark">
                        <i class="fa fa-save"></i>
                        Crear Producto
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
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Stock</th>
                                <th>Precio</th>
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
