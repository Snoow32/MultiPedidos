<!DOCTYPE html>
<html>
<head>
    <title>Sucessful</title>
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
        <button id="sucess" style="margin-bottom: 5em;">Abrir alert_sucess</button>
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
            iconHtml: '<div class="swal2-icon swal2-success swal2-icon-show" style="display: flex;"><div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div><span class="swal2-success-line-tip"></span><span class="swal2-success-line-long"></span><div class="swal2-success-ring"></div><div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div><div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div></div>'
            });
        }

        document.getElementById('sucess').addEventListener('click', function() {
            alert_toast(' Salvo com sucesso!', 'success');
        });
    </script>
</body>

</html>
