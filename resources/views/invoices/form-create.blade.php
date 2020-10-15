@extends('layouts.web')

@push('head')
    <link href="{{ asset('css/libs/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/libs/jquery-confirm.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/libs/products.css') }}" rel="stylesheet">
@endpush

@push('endBody')
    <script src="{{ asset('js/libs/jquery-confirm.min.js')}}"></script>
    <script src="{{ asset('js/libs/jquery.repeater.js')}}"></script>
    <script src="{{ asset('js/libs/select2.min.js')}}"></script>
    @includeJS([
        "url" => "invoices/assets/_form-create.js",
        "params" => [
            '[URL_TMP]' => route('ajax-tmp-invoice')
        ]
    ])
@endpush

@section('content')

    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-note2 icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>Crear facturas
                    <div class="page-title-subheading">Aqui podras crear facturas
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
            </div>
        </div>
    </div>

    {{-- ENCABEZAOD --}}
    @if(!empty($User->id))
    <x-title-header title="Actualizar Factura"
                    :urls="[['Facturas', route('invoices-list')],['Factura # '. $User->id]]">
    </x-title-header>
    @else
        <x-title-header title="Crear Factura"
                        :urls="[['Facturas', route('invoices-list')],['Crear Factura']]">
        </x-title-header>
    @endif

<div class="card">
    <div class="card-body">
        <form action="{{ route('invoices-insert')  }}" method="POST" class="repeater"  onsubmit="handleSubmit()" enctype="multipart/form-data" id="customForm">
            @csrf

            <div class="loading d-none">
                Cargando....
            </div>

            <div class="saving d-none"></div>

            <div class="row">
                <div class="col-4">
                    <label for="customer_id">Cliente</label>
                    <input type="text" id="customer_id" name="Invoice[customer_id]" class="form-control"
                           value="{{ Cache::get('tmp_invoice.customer_id', '')  }}"
                           onchange="saveTemp(this.value,'tmp_invoice.customer_id')">
                </div>
                <div class="col-8 pt-4">
                    <div class="input-group w-50 float-right">
                        <input type="text" class="form-control" placeholder="Cantidad" id="numVeces" aria-label="Cantidad"
                            aria-describedby="button-addon2" style="width: 10%;">
                        <div class="input-group-append">
                            <button type="button" id="btn-add-products"
                                    class="btn btn-dark btn-sm"
                                    data-repeater-create input-quantity="numVeces"><i class="fa fa-plus"></i>
                                Agregar item
                            </button>
                        </div>
                    </div>
                </div>
            </div>


            <hr>
            <div data-repeater-list="producto">

                <div data-repeater-item class="form-row border-bottom pt-3 pl-5">

                    <div class="col mb-5">
                        <label class="control-label">Producto</label>
                        <div class="input-group mb-3">
                            @php($selected = Cache::get('tmp_invoice.producto[0][product]', ''))
                            <select class="form-control select2-products" name="product"
                                    onchange="saveTemp(this.value,'tmp_invoice.'+this.name)">
                                <option></option>
                                @foreach($products as $product)
                                    <option
                                        value="{{$product->id}}"
                                        data-price="{{$product->price}}"
                                        {{ $selected == $product->id ? 'selected':'' }}>
                                        {{$product->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="col mb-3">
                            <label for="name">Cantidad</label>
                            <input id="name" name="name" type="number" class="form-control" min="0"
                                   value="{{ Cache::get('tmp_invoice.producto[0][name]', '')  }}"
                                   onchange="saveTemp(this.value,'tmp_invoice.'+this.name);updateQuantity(this)">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="col mb-3">
                            <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
                                <div class="col-md-10">
                                    <div class="table-responsive">
                                        <table class="table ">
                                            <thead>
                                                <tr>
                                                    <th class="text-right font-weight-bold text-muted text-uppercase">Precio</th>
                                                    <th class="text-right font-weight-bold text-muted text-uppercase">Iva</th>
                                                    <th class="text-right pr-0 font-weight-bold text-muted text-uppercase">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="font-weight-boldest">
                                                    <td class="text-right pt-7 align-middle info-price">$2000</td>
                                                    <td class="text-right pt-7 align-middle info-iva">$250</td>
                                                    <td class="text-primary pr-0 pt-7 text-right align-middle info-total">$25200</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-2">
                        <div class="col mb-3">
                        </div>
                    </div>


                    <div class="mb-2 pr-5">
                        <label>Eliminar</label>
                        <button type="button"
                                class="btn-danger btn-sm form-control"
                                data-repeater-delete><i class="fa fa-trash"></i>
                        </button>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">
                        <i class="fa fa-save mr-1"></i>
                        Crear Productos
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
