<?php
session_start();
$sessData = !empty($_SESSION['sessData']) ? $_SESSION['sessData'] : '';
if (!empty($sessData['status']['msg'])) {
    $statusMsg = $sessData['status']['msg'];
    $statusMsgType = $sessData['status']['type'];
    unset($_SESSION['sessData']['status']);
}
?>

<body>
    <div class="container">
        <div class="row">
            <?php include 'encabezado.php'; ?>
        </div>
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">Recuperación contraseña</div>
                    <div class="card-body">
                        <div class="card">
                            <h2>Ingresa tu Dirección de Correo Electrónico para Resetear tu Contraseña</h2>
                            <?php echo !empty($statusMsg) ? '<p class="' . $statusMsgType . '">' . $statusMsg . '</p>' : ''; ?>

                            <div class="regisFrm">
                                <form action="registro.php" method="post">
                                    <div class="form-group">
                                        <input type="email" name="correo" class="form-control" placeholder="Correo" required="required">
                                        <div class="send-button">
                                            <button type="submit" class="forgotSubmit" value="Continuar">Continuar</button>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <a class="btn btn-primary" href="index.php" role="button">Inicio</a>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
</body>