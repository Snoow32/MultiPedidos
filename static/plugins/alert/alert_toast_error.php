<!DOCTYPE html>
<html>
<head>
    <title>Error</title>
    <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        .animated-icon {
            animation: spin 2s linear infinite;
        }
    </style>
</head>
<body>

    <div class="container">
        <button id="error">Abrir alert_error</button>
    </div>

    <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
    <script>
        function alert_toast(msg, bg, pos) {
            var Toast = Swal.mixin({
                toast: true,
                position: pos || 'top',
                showConfirmButton: false,
                timer: 3000
            });
            Toast.fire({
                icon: bg,
                title: msg,
                iconHtml: '<div class="swal2-icon swal2-error swal2-icon-show" style="display: flex;"><span class="swal2-x-mark"><span class="swal2-x-mark-line-left"></span><span class="swal2-x-mark-line-right"></span></span></div>'
            });
        }

        document.getElementById('error').addEventListener('click', function() {
            alert_toast('Algo deu errado.', 'error');
        });
    </script>
</body>
</html>
