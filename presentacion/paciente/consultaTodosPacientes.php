<?php
$administrador = new Administrador($_SESSION['id']);
$administrador->consultar();

include 'presentacion/menuAdministrador.php';
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
        <?php echo "var ruta = \"indexAjax.php?pid=" . base64_encode("presentacion/paciente/filtroPacientes.php") . "\";"; ?>
        $("#tabla").load(ruta);

</script>