<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Administrateur</title>
    <!-- Inclure les fichiers CSS de Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <!-- Header -->
        <header class="mt-3 mb-4 text-center">
            <h1>Menu Administrateur</h1>
        </header>

        <!-- Menu des options -->
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Gestion des utilisateurs</h5>
                        <p class="card-text">Accédez à la liste des utilisateurs et effectuez des actions telles que la modification ou la suppression.</p>
                        <a href="{{ route('admin.users') }}" class="btn btn-primary">Gérer les utilisateurs</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Gestion des places</h5>
                        <p class="card-text">Accédez à la liste des places de parking et effectuez des actions telles que l'ajout, la modification ou la suppression.</p>
                        <a href="{{ route('admin.places') }}" class="btn btn-primary">Gérer les places</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Historique des réservations</h5>
                        <p class="card-text">Consultez l'historique complet des réservations effectuées dans le système.</p>
                        <a href="{{ route('admin.reservations.history') }}" class="btn btn-primary">Consulter l'historique</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Liste d'attente des utilisateurs</h5>
                        <p class="card-text">Consultez la liste d'attente des utilisateurs en attente de place de parking.</p>
                        <a href="{{ route('admin.waitlist') }}" class="btn btn-primary">Consulter la liste d'attente</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
