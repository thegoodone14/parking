@extends('base')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center py-3">
                    <h4 class="mb-0">Vérification de l'email</h4>
                </div>
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <p class="text-muted">
                            Merci de vous être inscrit ! Avant de commencer, pourriez-vous vérifier votre adresse e-mail en cliquant sur le lien que nous venons de vous envoyer ?
                            Si vous n'avez pas reçu l'e-mail, nous vous en enverrons volontiers un autre.
                        </p>
                    </div>

                    @if (session('status') == 'verification-link-sent')
                        <div class="alert alert-success mb-4">
                            Un nouveau lien de vérification a été envoyé à l'adresse e-mail que vous avez fournie lors de l'inscription.
                        </div>
                    @endif

                    <div class="d-flex justify-content-between">
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                Renvoyer l'email de vérification
                            </button>
                        </form>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger">
                                Se déconnecter
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection