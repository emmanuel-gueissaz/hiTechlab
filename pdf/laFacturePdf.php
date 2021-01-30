<?php
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

$nDevis = $_GET['id'];

$requete = "select * from facturesansreg($nDevis);";
$requete = $conn->prepare($requete);
$requete->execute();

$requete = "select * from reparation inner join modele on modele.id_modele = reparation.id_modele
         inner join a ON a.id = reparation.id
         inner join marque ON marque.id_marque = modele.id_marque
         where reparation.id = $nDevis
         order by a.id_statut desc
         limit 1";
$requete = $conn->prepare($requete);
$requete->execute();
$ligne = $requete->fetch();
$email = $ligne['email'];
$modele = $ligne['lib_modeele'];
$heure = $ligne['heure'];
$date = date('d-m-Y', strtotime($ligne['datee']));
$nomMarque = $ligne['nom'];
$numeserie = $ligne['numserie'];
$numFact = $ligne['id_facture'];
    $notevisiblebon = $ligne['notevisiblebon'];




$requete = "select * from client where email = '$email'";
$requete = $conn->prepare($requete);
$requete->execute();
$ligne = $requete->fetch();
$nom = $ligne['nom'];
$prenom = $ligne['prenom'];
$tel = $ligne['tel'];
$rue = $ligne['rue'];
$cpost = $ligne['cpost'];
$ville = $ligne['ville'];


$requete = "select * from boutique";
$requete = $conn->prepare($requete);
$requete->execute();
$ligne = $requete->fetch();
$nomBoutique = $ligne['nom'];
$telBoutique = $ligne['tel'];
$emailBoutique = $ligne['email'];
$rueBoutique = $ligne['rue'];
$cpostBoutique = $ligne['cpost'];
$villeBoutique = $ligne['ville'];


$montantTotal = 0;

ob_start();
?>
<link href="facture.css" rel="stylesheet" type="text/css"/>
<page class='laPage'>
    <table style="width: 100%;  ">
        <tr style="font-size: 150%;text-align: center; " >
            <td style="width: 50%; ">Facture N° <?php echo $numFact ?></td>
            <td style="width: 50%;">     <img src="../image/logo_facture.png" style="width: 90%;"/></td>

        </tr>

    </table>
    <table style="width: 100%; text-align: left; margin-left: 5%; margin-top: 2%; ">
        <tr style="font-size: 150%; " >
            <td style="width: 50%; ">Entreprise</td>
            <td style="width: 50%; ">  Client</td>
        </tr>
        <tr  >
            <td style="width: 50%;  "><?php echo $nomBoutique ?></td>
            <td style="width: 50%; "><?php echo $nom . ' ' . $prenom ?>  </td>
        </tr>
        <tr style="font-size: 120%; " >
            <td style="width: 50%;  "><?php echo $rueBoutique ?></td>
            <td style="width: 50%; "><?php echo $rue ?>  </td>
        </tr>
        <tr style="font-size: 120%; " >
            <td style="width: 50%;  "><?php echo $cpostBoutique . ' ' . $villeBoutique ?></td>
            <td style="width: 50%; "><?php echo $cpost . ' ' . $ville ?>  </td>
        </tr>
        <tr style="font-size: 120%; " >
            <td style="width: 50%;  "><?php echo $emailBoutique ?></td>
            <td style="width: 50%; "><?php echo $email ?>  </td>
        </tr>
        <tr style="font-size: 120%; " >
            <td style="width: 50%;  "><?php echo $telBoutique ?></td>
            <td style="width: 50%; "><?php echo $tel ?>  </td>
        </tr>


    </table>
    <table style="width: 100%; text-align: center; margin-left: 5%; margin-top: 2%; ">
        <tr >
            <td class="titrecolonne" style="width:  20%;">Marque </td>
            <td class="titrecolonne" style="width:  15%;">Modèle </td>
            <td class="titrecolonne" style="width:  25%;">IMEI / N°serie </td>
            <td class="titrecolonne" style="width:  20%;">Date</td>

        </tr>
        <tr >
            <td class="infoColonne"> <?php echo $nomMarque; ?> </td>
            <td class="infoColonne" ><?php echo $modele; ?></td>
            <td class="infoColonne" ><?php echo $numeserie; ?></td>
            <td class="infoColonne" ><?php echo $date . ' ' . $heure ?></td>

        </tr>
    </table>

    <table style="width: 100%; text-align: center; margin-left: 5%; margin-top: 2%; ">


        <tr >
            <td class="titrecolonne" style="width:  40%;">Interventions </td>
            <td class="titrecolonne" style="width:  10%;">PU HT</td>
            <td class="titrecolonne" style="width:  12%;">Qte</td>
            <td class="titrecolonne" style="width:  13%;">TVA</td>
            <td class="titrecolonne" style="width:  15%;">Total HT</td>
        </tr>

        <?php
        $requete = "select * from forfait 
INNER join prend ON prend.id_forfait = forfait.id_forfait
inner join reparation ON reparation.id = prend.id
where reparation.id = $nDevis";
        $requete = $conn->prepare($requete);
        $requete->execute();
        while ($ligne = $requete->fetch()) {
            $nom_forfait = $ligne['nom_forfait'];
            $tarif = $ligne['tarif'];
            $qte = $ligne['qte'];
            $total = $tarif * $qte;
            $montantTotal += $total;

            echo "
         <tr style='text-align: center;'>
            <td class='infoColonne' style='width:  40%;'>$nom_forfait </td>
            <td class='infoColonne' style='width:  12%;'>$tarif €</td>
            <td class='infoColonne' style='width:  10%;'>$qte</td>
            <td class='infoColonne' style='width:  13%;'>TVA non applicable</td>
            <td class='infoColonne' style='width:  15%;'> $total € </td>
                
        </tr>";
        }

        $requete = "select * from remise inner join compter ON compter.id_remise = remise.id_remise where compter.id_reparation = $nDevis";
        $requete = $conn->prepare($requete);
        $requete->execute();
        while ($ligne = $requete->fetch()) {
            $lib_remise = $ligne['lib_remise'];
            $tarif = $ligne['montant'];


            $montantTotal -= $tarif;

            echo "
         <tr style='text-align: center;'>
            <td class='infoColonne' style='width:  40%;'>$lib_remise </td>
            <td class='infoColonne' style='width:  12%;'>-$tarif €</td>
            <td class='infoColonne' style='width:  10%;'>1</td>
            <td class='infoColonne' style='width:  13%;'>TVA non applicable</td>
            <td class='infoColonne' style='width:  15%;'>-$tarif € </td>
                
        </tr>";
        }
        ?>

    </table>

    <table style="width: 100%; text-align: center; margin-left: 5%; margin-top: 2%; ">
        <tr>
            <td  style="width:  60%;"> </td>
            <td style="width:  34%;">TVA non applicable, art. 293B du CGI
            </td>
        </tr>
    </table>

    <table style="width: 100%; text-align: center; margin-left: 5%; margin-top: 2%; ">
        <tr>
            <td  style="width:  64%;"> </td>
            <td class="titrecolonne" style="width:  28%;">Total HT</td>
        </tr>
        <tr>
            <td  style="width:  64%;"> </td>
            <td class="infoColonne" style="width:  28%;"><?php echo $montantTotal ?> €</td>
        </tr>
    </table>


    <table style="width: 100%; text-align: left; margin-left: 5%; margin-top: 2%; ">
        <tr>
            <td  style="width:  82%;"> Référence du devis associé à cette facture : <?php echo $nDevis; ?> </td>
        </tr>

        <tr>
            <td > Date limite de règlement : à réception de la facture </td>
        </tr>
        <tr>
            <td  > Taux des pénalités en cas de retard de paiement : taux directeur de refinancement de la BCE, majoré de 10 points     </td>
        </tr>
        <tr>
            <td > Escompte en cas de paiement anticipé : aucun     </td>
        </tr>
        <tr>
            <td style="border-top: 1px;"> Pour tout diagnostic informatique et ou téléphonie, nécessitant une prise en charge avec tests de composants et    </td>
        </tr>
        <tr>
            <td > ouverture de tout appareil électronique, un minimum de 40€ de "diagnostic avancé" sera dû qu'il y ai ou non résolution    </td>
        </tr>
        <tr>
            <td > de la panne ou refus d'un devis ayant nécessité des tests avant intervention    </td>
        </tr>
            
        <tr>
            <td  style="margin-top: 2%;"> <b>Conditions ou informations spécifiques à la vente / prestation: </b> </td>
        </tr>
        <tr>
            <td > <?php echo $notevisiblebon; ?> </td>
        </tr>
    </table>

    <page_footer>
        <table style="width: 100%; text-align: left; margin-left: 5%; margin-top: 2%;">
            <tr >
                <td   style=" border-top: 1px; width: 92%; "> HI-TECH LAB - 820 362 226 RCS Romans Sur Isère - APE : 9511Z  </td>
            </tr>
            <tr>
                <td  > Signature du client  </td>
            </tr>
            <tr>
                <td  > Précédée de la mention "Bon pour accord"  </td>
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