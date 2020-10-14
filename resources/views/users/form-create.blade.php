@extends('layouts.web')

@section('content')

    {{-- ENCABEZAOD --}}
    @if(!empty($User->id))
        <x-title-header title="Actualizar Usuario"
                        :urls="[['Usuarios', route('users-list')],['Usuario # '. $User->id]]">
        </x-title-header>
    @else
        <x-title-header title="Crear Usuario"
                        :urls="[['Usuarios', route('users-list')],['Crear Usuario']]">
        </x-title-header>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <form method="POST">
                        @csrf
            
                    </form>
                </div>
            </div>            
        </div>
    </div>

@endsection
