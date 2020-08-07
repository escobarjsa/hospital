
<?php
$medico = new Medico( $_SESSION['id'] );
$medico -> consultar();
$medico->consultar();
include 'presentacion/medico/menuMedico.php';
$solicitud = new Solicitud( $_GET['idSolicitud'] );
$solicitud -> consultar();

$paciente = new Paciente( $solicitud -> getPaciente() );
$paciente -> consultarTodos();
$fecha = date( 'Y-m-d' );
$error = 0;
if ( isset( $_POST['generar'] ) ) {
    $observacion = $_POST['observacion'];
    $tratamiento = $_POST['tratamiento'];

    if ( isset( $_POST['diagnostico'] ) ) {
        $diagnostico = $_POST['diagnostico'];
        if ( $tratamiento == 'Si' ) {
            if ( $_POST['medico'] != '------------' ) {
                $tratamiento = 'Necesita tratamiento con un especialista en '.$_POST['medico'];
                $soli = new Solicitud( '', 0, 0, '', 3, '', $paciente -> getId(), date( 'Y-m-d' ), date( 'h:i:sa' ), $_POST['medico'] );
                $soli -> registraraux();
                $reporte = new reporteClinico( '', $fecha, $diagnostico, $tratamiento, $observacion, $paciente -> getId() );
                $reporte -> registrar();
                $solicitudM = new Solicitud( $_GET['idSolicitud'], 1 );
                $solicitudM -> actualizarEstadoP();
                $error = 1;
            } else {
                $error = 2;
            }

        } else {
            $tratamiento = 'No necesita un tratamiento';
            $reporte = new reporteClinico( '', $fecha, $diagnostico, $tratamiento, $observacion, $paciente -> getId() );
            $reporte -> registrar();
            $solicitudM = new Solicitud( $_GET['idSolicitud'], 1 );
            $solicitudM -> actualizarEstadoP();
            $error = 1;
        }

    } else {
        $reporte = new reporteClinico( '', $fecha, 'Sin Diagnostico', $tratamiento, $observacion, $paciente -> getId() );
        $reporte -> registrar();
        $error = 1;
        $solicitudM = new Solicitud( $_GET['idSolicitud'], 1 );
        $solicitudM -> actualizarEstadoP();
    }
}
?>
<div class = 'container'>
<div class = 'row'>
<div class = 'col-11'>
<div class = 'card'>
<div class = 'card-header bg-primary text-white'>Reporte Clinico</div>
<div class = 'card-body'>
<?php
if ( $error == 1 ) {
    ?>
    <div class = 'alert alert-success' role = 'alert'>
    Reporte Clinico Registrado Exitosamente
    </div>
    <?php } else if ( $error == 2 ) {
        ?>
        <div class = 'alert alert-danger' role = 'alert'>
        Seleccione una especialidad
        </div>
        <?php }
        ?>
        <form action = <?php echo 'index.php?pid=' . base64_encode( 'presentacion/paciente/historialMedico.php' ).'&idSolicitud='.$_GET['idSolicitud']?> method = 'post'>
        <div class = 'field is-horizontal'>
        <div class = 'field-label is-normal'>
        <label class = 'label'>Fecha : </label>
        </div>
        <div class = 'field-body'>
        <div class = 'field'>
        <p><?php echo $fecha?></p>
        </div>
        </div>
        </div>

        <div class = 'field is-horizontal'>
        <div class = 'field-label is-normal'>
        <label class = 'label'>paciente$paciente : </label>
        </div>
        <div class = 'field-body'>
        <div class = 'field'>
        <p><?php echo $paciente -> getNombre()?></p>
        </div>
        <div class = 'field-label is-normal'>
        <label class = 'label'>Tipo : </label>
        </div>
        <div class = 'field-body'>
        <div class = 'field'>
        <p><?php echo $paciente -> getTipo()?></p>
        </div>

        </div>
        </div>
        </div>
        <div class = 'field is-horizontal'>
        <div class = 'field-label is-normal'>
        <label class = 'label'>Sexo : </label>
        </div>
        <div class = 'field-body'>
        <div class = 'field'>
        <p><?php echo $paciente -> getSexo()?></p>
        </div>
        <div class = 'field-label is-normal'>
        <label class = 'label'>Cliente : </label>
        </div>
        <div class = 'field-body'>
        <div class = 'field'>
        <p><?php echo $paciente -> getCliente()?></p>
        </div>

        </div>
        </div>
        </div>
        <div class = 'field is-horizontal'>
        <div class = 'field-label is-normal'>
        <label class = 'label'>Fecha Nacimiento : </label>
        </div>
        <div class = 'field-body'>
        <div class = 'field'>
        <p><?php echo $paciente -> getF_nacimiento()?></p>
        </div>
        <div class = 'field-label is-normal'>
        <label class = 'label'>Peso : </label>
        </div>
        <div class = 'field-body'>
        <div class = 'field'>
        <p><?php echo $paciente -> getPeso()?> Kg</p>
        </div>

        </div>
        </div>
        </div>
        <?php if ( $medico -> getEspecialidad() == 'General' ) {
            ?>
            <div class = 'field is-horizontal'>
            <div class = 'field-label is-normal'>
            <label class = 'label'>Diagnostico</label>
            </div>
            <div class = 'field-body'>
            <div class = 'field'>
            <div class = 'control'>
            <textarea class = 'textarea' name = 'diagnostico' required = 'required'
            placeholder = 'Diagnostico De La '></textarea>
            </div>
            </div>
            </div>
            </div>

            <div class = 'field is-horizontal'>
            <div class = 'field-label'>
            <label class = 'label'>Necesita Tratamiento?</label>
            </div>
            <div class = 'field-body'>
            <div class = 'field is-narrow'>
            <div class = 'control'>
            <label class = 'radio'> <input id = 'accion' type = 'radio' name = 'tratamiento' value = 'Si' required = 'required'> Si</label>
            <label class = 'radio'> <input id = 'accion1' type = 'radio' name = 'tratamiento' value = 'No' required = 'required'> No</label>
            </div>
            </div>
            </div>
            </div>
            <div id = 'contenedor'>

            </div>

            <?php } else {
                ?>
                <div class = 'field is-horizontal'>
                <div class = 'field-label is-normal'>
                <label class = 'label'>Tratamiento</label>
                </div>
                <div class = 'field-body'>
                <div class = 'field'>
                <div class = 'control'>
                <textarea class = 'textarea' name = 'tratamiento' required = 'required'
                placeholder = 'Tratamiento del Paciente'></textarea>
                </div>
                </div>
                </div>
                </div>

                <?php }
                ?>
                <div class = 'field is-horizontal'>
                <div class = 'field-label is-normal'>
                <label class = 'label'>Observaciones</label>
                </div>
                <div class = 'field-body'>
                <div class = 'field'>
                <div class = 'control'>
                <input class = 'input' type = 'text' required = 'required' name = 'observacion'
                placeholder = 'Observaciones Del Tratamiento O Diagnostico'>
                </div>
                </div>
                </div>
                </div>

                <?php if ( !isset( $_POST['generar'] ) ) {
                    ?>
                    <div class = 'field is-horizontal'>
                    <div class = 'field-label'>
                    <!-- Left empty for spacing -->
                    </div>
                    <div class = 'field-body'>
                    <div class = 'field'>
                    <div class = 'control'>
                    <button type = 'submit' name = 'generar' class = 'button is-primary'>Generar Reporte Clinico</button>
                    </div>
                    </div>
                    </div>
                    </div>
                    <?php }
                    ?>
                    </form>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    <script type = 'text/javascript'>
                    $( document ).ready( function() {
                        $( '#accion' ).change( function() {
                            <?php echo 'var ruta = \'indexAjax.php?pid = ' . base64_encode('presentacion/paciente$paciente/historialMedicoAjax.php').'\';\n';
                            ?>
                            $( '#contenedor' ).load( ruta );

                        }
                    );
                    $( '#accion1' ).change( function() {
                        $( '#contenedor' ).empty();

                    }
                );
            }
        );
        </script>