@extends('base')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Demander une nouvelle réservation</div>

                <div class="card-body">
                    <p>Cliquez sur le bouton ci-dessous pour lancer une demande de réservation :</p>
                    @if(auth()->user()->est_bloque == 1)
                    <div class="alert alert-danger"> Votre compte est bloqué, vous ne pouvez pas effectuer de réservation. </div>
                    @else
                    <form action="{{ route('reservations.store') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-primary">Demander une réservation</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

