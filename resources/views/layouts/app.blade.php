<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Todo</title>

    <!-- Bootstrap CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">

        <!-- ===== Alerts (global) ===== -->
        <!-- Erfolg (Flash) -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" aria-live="polite">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Schließen"></button>
            </div>
        @endif

        <!-- Validation / Fehler (falls vorhanden) -->
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert" aria-live="polite">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Schließen"></button>
            </div>
        @endif
        <!-- ========================= -->

        @yield('content')
    </div>

    <!-- Bootstrap Bundle (JS incl. Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Auto-Close Script: schließt Alerts nach 3000 ms (3s) -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Wähle nur sichtbare Alerts aus (z.B. .alert-success oder .alert-danger)
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach((alert) => {
                // Zeit in ms bis das Alert automatisch zugeht
                const timeout = 3000;

                // setTimeout erst starten, wenn das Alert die Klassen "show" (sichtbar) hat
                if (alert.classList.contains('show')) {
                    setTimeout(() => {
                        // Verwende die Bootstrap API, um das Alert zu schließen (korrekte Animation)
                        const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
                        bsAlert.close();
                    }, timeout);
                }
            });
        });
    </script>
</body>
</html>
