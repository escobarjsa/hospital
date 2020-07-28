<link rel="stylesheet" 	href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
<?php

if ($_GET["type"] == "i" && $_GET["loc"] != null) {
    echo "<i class='fa " . $_GET["loc"] . "' style='color:" . (($_GET["color"] == null) ? "#000000" : $_GET["color"]) . ";'></i>";
} else {
    ?>

<img src="<?php echo $_GET['loc'] ?>" height="<?php echo ((isset($_GET['h'])) ? ($_GET['h']) : "auto"); ?>" width="<?php echo ((isset($_GET['h'])) ? ($_GET['w']) : "auto"); ?>"
	<?php if (isset($_GET["style"])) {
        echo "style='" . $_GET["style"] . "'";
    }
    ?>>
<?php }?>
