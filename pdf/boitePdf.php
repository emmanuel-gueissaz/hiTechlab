<?php
error_reporting(0);
$host = 'localhost';
$db = 'hitechlab';
$username = 'postgres';
$password = 'cjpst2613';

$dns = "pgsql:host=$host;port=5432;dbname=$db;user=$username;password=$password";

try {
    $conn = new PDO($dns);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //if($conn)        echo 'bien connecter';
} catch (Exception $ex) {
    echo $ex->getMessage();
}

require '../vendor/autoload.php';
$idCry = openssl_decrypt($_GET['id'], "AES-128-ECB", 'lEdEvis26300aBz');
$requete = "select id,nom,prenom,tel,modele.lib_modeele, reparation.numserie from reparation
inner join client ON client.email = reparation.email
inner join modele ON modele.id_modele = reparation.id_modele
where reparation.id = $idCry";
$requete = $conn->prepare($requete);
$requete->execute();
$ligne = $requete->fetch();
$id = $ligne['id'];
$nom = $ligne['nom'];
$prenom = $ligne['prenom'];
$tel = $ligne['tel'];
$lib_modeele = $ligne['lib_modeele'];
$numserie = $ligne['numserie'];


ob_start();
?>
<link href="facture.css" rel="stylesheet" type="text/css"/>
<page class='laPage'>
    <table style="width: 100%; text-align: center; border-bottom: 1px;">
        <tr style="font-size: 150%; " >
            <td style="width: 50%;  ">Demande N° <?php echo $id; ?></td>
            <td style="width: 50%;"> <img src="../image/logo_facture.png" style="width: 90%;"/></td>
        </tr>
    </table>
    <table style="width: 100%; text-align: center;margin-left: 15%; margin-top: 2%; ">
        <tr style="display: inline-block;">
            <td style="display: inline-block; width: 45%; font-size:  140%; text-align: left;height: 50px; "> Nom : <?php echo $nom ?>  </td>
            <td style="display: inline-block; width: 50%; font-size:  140%; text-align: left;height: 50px;"> Tel : <?php echo $tel ?>  </td>
        </tr>
        <tr >
            <td style="display: inline-block;width: 45%; font-size:  140%; text-align: left;height: 50px;"> Prenom : <?php echo $prenom ?>  </td>
            <td style="display: inline-block;width: 50%; font-size:  140%; text-align: left;height: 50px;"> Modèle : <?php echo $lib_modeele ?>  </td>
        </tr>
        <tr>
            <td style="display: inline-block;width: 45%; font-size:  140%; text-align: left;padding-bottom: 40%;height: 50px; "> Numéro de série : <?php echo $numserie ?>  </td>

        </tr>
    </table>
    <table style="display: inline-block;width: 100%; text-align: center; margin-top: 2%;border-top: 1px; ">
        <tr>
            <td style="width: 100%;"></td>
        </tr>
    </table>
    <table style="display: inline-block;width: 100%; text-align: center;margin-top: 2%; ">

        <tr>
            <td style="display: inline-block;  width: 85%; "> 
                <?php
                $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
                $lecode = $generator->getBarcode($id, $generator::TYPE_CODE_128);
                echo "$lecode";
                ?>
            </td>
        </tr>
    </table>

    <table style="display: inline-block;width: 100%; text-align: center;margin-top: 2%; ">

        <tr>
            <td><img src="../image/boite.png"  width="100%;"/></td>
        </tr>
    </table>
    <page_footer>
        <table>
            <tr>
                <td>HI-TECH LAB</td>
            </tr>
            <tr>
                <td>112 Grande rue 26700 PIERRELATTE </td>
            </tr>
            <tr>
                <td>Téléphone : 04 75 53 94 14 / 07 68 54 19 87</td>
            </tr>
            <tr>
                <td>Email : contact@hi-tech-lab.com</td>
            </tr>
        </table>
    </page_footer>

</page>
<?php
require '../vendor/autoload.php';
$content = ob_get_contents();

use Spipu\Html2Pdf\Html2Pdf;

$html2pdf = new HTML2PDF("P", "A4", "fr");
$html2pdf->pdf->SetDisplayMode('fullpage');
$html2pdf->setDefaultFont("Arial");
$html2pdf->writeHTML($content);
ob_end_clean();
$html2pdf->Output('tst.pdf', 'I');
?>