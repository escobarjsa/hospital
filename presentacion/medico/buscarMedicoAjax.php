<?php
$medico = new Medico();
$medico = $medico->filtro($_GET["filtro"]);
?>
<?php
foreach ($medico as $v) {
    echo "<tr>";
    echo "<td>" . $v->getId() . "</td>";
    echo "<td>" . $v->getNombre() . "</td>";
    echo "<td>" . $v->getApellido() . "</td>";
    echo "<td>" . $v->getCorreo() . "</td>";
    echo "<td>" . $v->getTarjetaProfesional() . "</td>";
    echo "<td>" . $v->getEspecialidad_Idespecialidad() . "</td>";
    echo "</tr>";
}
echo "<tr><td colspan='6'>" . count($medico) . " registros encontrados</td></tr>" ?>