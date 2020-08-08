<?php
require_once 'logica/Medico.php';
if($_GET["rol"]=="admin")
{
    $administrador = new Administrador($_SESSION['id']);
    $administrador->consultar();

    include 'presentacion/menuAdministrador.php';
}
else
{
    $medico = new Medico();
    $medico->consultar($_SESSION['id']);
    include 'presentacion/medico/menuMedico.php';
}
?>


<div class="container" style="margin-top: 20px;">

    <div class="col-12" id="tabla">

    </div>
</div>


<div class="modal fade" id="modalPaciente" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="modalContent"></div>
    </div>
</div>

<script>


        $('body').on('show.bs.modal', '.modal', function (e) {
            var link = $(e.relatedTarget);
            $(this).find(".modal-content").load(link.attr("href"));
        });
        <?php 
        error_log("rol: " . $_GET["rol"]);
        echo "var ruta = \"indexAjax.php?pid=" . base64_encode("presentacion/Citas/filtroCitas.php") . "&rol=" . $_GET["rol"] . "\";"; ?>
        $("#tabla").load(ruta);

</script>