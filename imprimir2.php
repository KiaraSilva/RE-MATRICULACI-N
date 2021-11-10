<?php
require 'conexionBD.php';
require_once 'dompdf/autoload.inc.php';

ob_start(); // Desde aquí se empieza a almacenar la página

//$dni = $_POST["dni"];//Acá recibimos la variable enviada desde un anterior formulario para realizar la búsqueda en la BD
//$resultadop = "SELECT * FROM alumnos WHERE dni = ".$dni;
//$results = $resultadop->fetch(PDO::FETCH_ASSOC); //se obtienen los datos del usuario

$records = $conn->prepare('SELECT id, dni, contrasena FROM alumnos WHERE dni = :dni');
$records->bindParam(':dni', $_POST['dni']); //lo q recibe, lo vincula a ese parametro
$records->execute(); //ejecuta consulta
$results = $records->fetch(PDO::FETCH_ASSOC); //se obtienen los datos del usuario
$dni = $results["dni"];
//while ($resultado = $results) { 
?>
<!DOCTYPE html>
 <html>
 <head>
    <title>Matrícula</title>
 </head>
 <body>
        <h1>Matrícula</h1>
        <table align="center">
            <tr>
                <td><label>DNI </label></td>
                <td><input type="text" name="dni" value="<?php echo $results["dni"]; ?>" ></td>
            </tr>
            <tr>
                <td><label>ID: </label></td>
                <td><input type="text" name="id" value="<?php echo $results["id"]; ?>" ></td>
                <td><label>CONTRASEÑA: </label></td>
                <td><input type="text" name="contrasena" value="<?php echo $results["contrasena"]; ?>" ></td>
            </tr>
        </table>

    </form> 
 </body>
 </html>

 <?php
 $html = ob_get_clean(); //Acá indicamos que es el final de la página y almacenamos en una variable.
//}
use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('Times-Roman', 'Courier'); // Indicamos la fuente del PDF
$dompdf = new Dompdf($options);

$dompdf->loadHtml($html); //Acá se especifíca la variable donde almacenamos la página

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait'); //Indicamos el tamaño del PDF y la orientación

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('Matrícula_'.$dni.'.pdf'); // Indicamos el nombre del PDF a generar. 
 ?>