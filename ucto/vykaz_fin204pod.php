<HTML>
<?php

do
{
$sys = 'UCT';
$urov = 3000;
$copern = $_REQUEST['copern'];
$tis = $_REQUEST['tis'];
if(!isset($tis)) $tis = 0;
$fort = $_REQUEST['fort'];
if(!isset($fort)) $fort = 1;

$uziv = include("../uziv.php");
if( !$uziv ) exit;

require_once("../pswd/password.php");
@$spojeni = mysql_connect($mysqlhost, $mysqluser, $mysqlpasswd);
  if (!$spojeni):
    echo "Spojenie so serverom nedostupne.";
    exit;
  endif;
  mysql_select_db($mysqldb);

//datumove funkcie
$sDat = include("../funkcie/dat_sk_us.php");

//ramcek fpdf
$rmc=0;

$pole = explode(".", $kli_vume);
$kli_vmes=$pole[0];
$kli_vrok=$pole[1];

$citfir = include("../cis/citaj_fir.php");
$mena1 = $fir_mena1;
$mena2 = $fir_mena2;
$kurz12 = $fir_kurz12;

$cislo_oc = 1*$_REQUEST['cislo_oc'];
$subor = $_REQUEST['subor'];
$strana = 1*$_REQUEST['strana'];
if( $strana == 0 ) $strana=9999;

if( $cislo_oc == 0 ) $cislo_oc=1;
if( $cislo_oc == 1 ) { $datum="31.03.".$kli_vrok; $mesiac="03"; $kli_vume="3.".$kli_vrok; }
if( $cislo_oc == 2 ) { $datum="30.06.".$kli_vrok; $mesiac="06"; $kli_vume="6.".$kli_vrok; }
if( $cislo_oc == 3 ) { $datum="30.09.".$kli_vrok; $mesiac="09"; $kli_vume="9.".$kli_vrok; }
if( $cislo_oc == 4 ) { $datum="31.12.".$kli_vrok; $mesiac="12"; $kli_vume="12.".$kli_vrok; }


$vsetkyprepocty=0;

//tlacove okno
$tlcuwin="width=700, height=' + vyskawin + ', top=0, left=200, status=yes, resizable=yes, scrollbars=yes, menubar=yes, toolbar=yes";
$tlcswin="width=980, height=' + vyskawin + ', top=0, left=20, status=yes, resizable=yes, scrollbars=yes, menubar=yes, toolbar=yes";
$tlcvwin="width=1020, height=' + vyskawin + ', top=0, left=20, status=yes, resizable=yes, scrollbars=yes, menubar=yes, toolbar=yes";
$uliscwin="width=' + sirkawic + ', height=' + vyskawic + ', top=0, left=0, status=yes, resizable=yes, scrollbars=yes, menubar=no, toolbar=no";

//ak nie je generovanie daj standartne
$niejegen=0;
$sql = "SELECT * FROM F".$kli_vxcf."_crf204pod_no ";
$vysledok = mysql_query($sql);
if (!$vysledok)
{

$copern=1002;
$niejegen=1;
}
//koniec ak nie je generovanie daj standartne


//Tabulka crf204nuj_no
if ( $copern == 1001 )
{
?>
<script type="text/javascript">
if( !confirm ("Chcete na��ta� �tandartn� generovanie v�kazu FIN 2-04 POD ?") )
         { window.close()  }
else
         { location.href='vykaz_fin204pod.php?copern=1002&page=1&drupoh=1'  }
</script>
<?php
    }

    if ( $copern == 1002 )
    {

$sql = "DROP TABLE F$kli_vxcf"."_crf204pod_no";
$vysledok = mysql_query("$sql");

$sqlt = <<<crf204nuj_no
(
   cpl         int not null auto_increment,
   uce         VARCHAR(10),
   crs         INT,
   cpl01       INT,
   PRIMARY KEY(cpl)
);
crf204nuj_no;

$sql = 'CREATE TABLE F'.$kli_vxcf.'_crf204pod_no'.$sqlt;
$vysledek = mysql_query("$sql");

$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '012', '2' ); "; $ulozene = mysql_query("$sqult"); 
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '014', '2' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '015', '2' ); "; $ulozene = mysql_query("$sqult"); 
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '072', '2' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '073', '2' ); "; $ulozene = mysql_query("$sqult"); 
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '074', '2' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '075', '2' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '079', '2' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '091', '2' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '051', '3' ); "; $ulozene = mysql_query("$sqult"); 
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '095', '3' ); "; $ulozene = mysql_query("$sqult"); 
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '013', '4' ); "; $ulozene = mysql_query("$sqult"); 
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '018', '4' ); "; $ulozene = mysql_query("$sqult"); 
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '019', '4' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '073', '4' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '078', '4' ); "; $ulozene = mysql_query("$sqult"); 
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '079', '4' ); "; $ulozene = mysql_query("$sqult"); 
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '041', '5' ); "; $ulozene = mysql_query("$sqult"); 
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '093', '5' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '031', '7' ); "; $ulozene = mysql_query("$sqult"); 
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '025', '8' ); "; $ulozene = mysql_query("$sqult"); 
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '085', '8' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '092', '8' ); "; $ulozene = mysql_query("$sqult"); 
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '032', '9' ); "; $ulozene = mysql_query("$sqult"); 
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '021', '10' ); "; $ulozene = mysql_query("$sqult"); 
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '081', '10' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '022', '11' ); "; $ulozene = mysql_query("$sqult"); 
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '023', '11' ); "; $ulozene = mysql_query("$sqult"); 
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '082', '11' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '083', '11' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '052', '13' ); "; $ulozene = mysql_query("$sqult"); 
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '024', '14' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '025', '14' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '026', '14' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '028', '14' ); "; $ulozene = mysql_query("$sqult"); 
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '029', '14' ); "; $ulozene = mysql_query("$sqult"); 
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '084', '14' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '085', '14' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '086', '14' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '088', '14' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '089', '14' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '042', '15' ); "; $ulozene = mysql_query("$sqult"); 
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '094', '15' ); "; $ulozene = mysql_query("$sqult");

$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '061', '18' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '062', '18' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '063', '18' ); "; $ulozene = mysql_query("$sqult"); 
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '096', '18' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '065', '19' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '066', '20' ); "; $ulozene = mysql_query("$sqult"); 
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '067', '20' ); "; $ulozene = mysql_query("$sqult"); 
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '069', '20' ); "; $ulozene = mysql_query("$sqult"); 
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '053', '21' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '043', '21' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '069', '22' ); "; $ulozene = mysql_query("$sqult");
  
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '111', '23' ); "; $ulozene = mysql_query("$sqult"); 
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '112', '23' ); "; $ulozene = mysql_query("$sqult"); 
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '119', '23' ); "; $ulozene = mysql_query("$sqult"); 
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '121', '23' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '122', '23' ); "; $ulozene = mysql_query("$sqult");  
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '123', '23' ); "; $ulozene = mysql_query("$sqult"); 
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '124', '23' ); "; $ulozene = mysql_query("$sqult"); 
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '131', '23' ); "; $ulozene = mysql_query("$sqult"); 
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '132', '23' ); "; $ulozene = mysql_query("$sqult"); 
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '139', '23' ); "; $ulozene = mysql_query("$sqult"); 
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '191', '23' ); "; $ulozene = mysql_query("$sqult"); 
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '192', '23' ); "; $ulozene = mysql_query("$sqult"); 
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '193', '23' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '194', '23' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '195', '23' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '196', '23' ); "; $ulozene = mysql_query("$sqult");

$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '311', '25' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '391', '25' ); "; $ulozene = mysql_query("$sqult"); 
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '312', '26' ); "; $ulozene = mysql_query("$sqult"); 
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '314', '27' ); "; $ulozene = mysql_query("$sqult"); 
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '313', '28' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '375', '28' ); "; $ulozene = mysql_query("$sqult");  

$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '346', '30' ); "; $ulozene = mysql_query("$sqult"); 
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '347', '30' ); "; $ulozene = mysql_query("$sqult");

$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '374', '31' ); "; $ulozene = mysql_query("$sqult");

$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '373', '32' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '376', '32' ); "; $ulozene = mysql_query("$sqult");

$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '358', '33' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '398', '33' ); "; $ulozene = mysql_query("$sqult");
 
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '351', '34' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '354', '34' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '355', '34' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '371', '34' ); "; $ulozene = mysql_query("$sqult");

$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '315', '35' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '335', '35' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '378', '35' ); "; $ulozene = mysql_query("$sqult");


$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '211', '37' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '213', '37' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '221', '38' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '261', '38' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '251', '39' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '257', '39' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '291', '39' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '253', '40' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '255', '40' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '256', '40' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '259', '41' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '381', '42' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '382', '42' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '385', '42' ); "; $ulozene = mysql_query("$sqult");


$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '323', '44' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '451', '44' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '459', '44' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '478', '46' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '322', '47' ); "; $ulozene = mysql_query("$sqult");

$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '373', '48' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '377', '48' ); "; $ulozene = mysql_query("$sqult");

$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '473', '49' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '321', '50' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '326', '50' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '476', '50' ); "; $ulozene = mysql_query("$sqult");

$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '324', '53' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '475', '53' ); "; $ulozene = mysql_query("$sqult");

$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '474', '56' ); "; $ulozene = mysql_query("$sqult");

$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '331', '59' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '333', '59' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '336', '60' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '341', '60' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '342', '60' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '343', '60' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '345', '60' ); "; $ulozene = mysql_query("$sqult");

$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '346', '61' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '348', '61' ); "; $ulozene = mysql_query("$sqult");

$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '367', '62' ); "; $ulozene = mysql_query("$sqult");

$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '368', '63' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '398', '63' ); "; $ulozene = mysql_query("$sqult");

$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '325', '65' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '379', '65' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '472', '65' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '479', '65' ); "; $ulozene = mysql_query("$sqult");

$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '461', '69' ); "; $ulozene = mysql_query("$sqult");

$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '231', '70' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '232', '70' ); "; $ulozene = mysql_query("$sqult");

$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '241', '71' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '249', '72' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '383', '73' ); "; $ulozene = mysql_query("$sqult");
$sqult = "INSERT INTO F$kli_vxcf"."_crf204pod_no ( uce,crs ) VALUES ( '384', '73' ); "; $ulozene = mysql_query("$sqult");

if( $niejegen == 0 ) {
?>
<script type="text/javascript">
window.open('../ucto/oprcis.php?copern=308&drupoh=87&page=1&sysx=UCT', '_self' );
</script>
<?php
exit;
                     }
$copern=20;
}
//koniec tabulky crf204pod_no


// znovu nacitaj
if ( $copern == 26 )
    {
//echo "citam";
$nasielvyplnene=0;

$sqlttt = "SELECT * FROM F$kli_vxcf"."_uctvykaz_fin204pod WHERE oc = $cislo_oc ";
$sqldok = mysql_query("$sqlttt");
  if (@$zaznam=mysql_data_seek($sqldok,0))
  {
  $nasielvyplnene=1;

  $riaddok=mysql_fetch_object($sqldok);
  $xokres=1*$riaddok->okres;
  $xobec=1*$riaddok->obec;
  }

$sqtoz = "DELETE FROM F$kli_vxcf"."_uctvykaz_fin204pod WHERE oc = $cislo_oc";
$oznac = mysql_query("$sqtoz");
$copern=20;
if( $zupravy == 1 ) $copern=20;
$subor=1;
$vsetkyprepocty=1;
    }
//koniec znovu nacitaj



// zapis upravene udaje
if ( $copern == 23 )
    {


if ( $strana == 1 )    {

$okres = strip_tags($_REQUEST['okres']);
$obec = strip_tags($_REQUEST['obec']);
$daz = $_REQUEST['daz'];
$daz_sql = SqlDatum($daz);

$r01 = 1*$_REQUEST['r01']; $rk01 = 1*$_REQUEST['rk01']; $rn01 = 1*$_REQUEST['rn01']; $rm01 = 1*$_REQUEST['rm01'];
$r02 = 1*$_REQUEST['r02']; $rk02 = 1*$_REQUEST['rk02']; $rn02 = 1*$_REQUEST['rn02']; $rm02 = 1*$_REQUEST['rm02'];
$r03 = 1*$_REQUEST['r03']; $rk03 = 1*$_REQUEST['rk03']; $rn03 = 1*$_REQUEST['rn03']; $rm03 = 1*$_REQUEST['rm03'];
$r04 = 1*$_REQUEST['r04']; $rk04 = 1*$_REQUEST['rk04']; $rn04 = 1*$_REQUEST['rn04']; $rm04 = 1*$_REQUEST['rm04'];
$r05 = 1*$_REQUEST['r05']; $rk05 = 1*$_REQUEST['rk05']; $rn05 = 1*$_REQUEST['rn05']; $rm05 = 1*$_REQUEST['rm05'];
$r06 = 1*$_REQUEST['r06']; $rk06 = 1*$_REQUEST['rk06']; $rn06 = 1*$_REQUEST['rn06']; $rm06 = 1*$_REQUEST['rm06'];
$r07 = 1*$_REQUEST['r07']; $rk07 = 1*$_REQUEST['rk07']; $rn07 = 1*$_REQUEST['rn07']; $rm07 = 1*$_REQUEST['rm07'];
$r08 = 1*$_REQUEST['r08']; $rk08 = 1*$_REQUEST['rk08']; $rn08 = 1*$_REQUEST['rn08']; $rm08 = 1*$_REQUEST['rm08'];
$r09 = 1*$_REQUEST['r09']; $rk09 = 1*$_REQUEST['rk09']; $rn09 = 1*$_REQUEST['rn09']; $rm09 = 1*$_REQUEST['rm09'];
$r10 = 1*$_REQUEST['r10']; $rk10 = 1*$_REQUEST['rk10']; $rn10 = 1*$_REQUEST['rn10']; $rm10 = 1*$_REQUEST['rm10'];
$r11 = 1*$_REQUEST['r11']; $rk11 = 1*$_REQUEST['rk11']; $rn11 = 1*$_REQUEST['rn11']; $rm11 = 1*$_REQUEST['rm11'];
$r12 = 1*$_REQUEST['r12']; $rk12 = 1*$_REQUEST['rk12']; $rn12 = 1*$_REQUEST['rn12']; $rm12 = 1*$_REQUEST['rm12'];
$r13 = 1*$_REQUEST['r13']; $rk13 = 1*$_REQUEST['rk13']; $rn13 = 1*$_REQUEST['rn13']; $rm13 = 1*$_REQUEST['rm13'];
$r14 = 1*$_REQUEST['r14']; $rk14 = 1*$_REQUEST['rk14']; $rn14 = 1*$_REQUEST['rn14']; $rm14 = 1*$_REQUEST['rm14'];
$r15 = 1*$_REQUEST['r15']; $rk15 = 1*$_REQUEST['rk15']; $rn15 = 1*$_REQUEST['rn15']; $rm15 = 1*$_REQUEST['rm15'];
$r16 = 1*$_REQUEST['r16']; $rk16 = 1*$_REQUEST['rk16']; $rn16 = 1*$_REQUEST['rn16']; $rm16 = 1*$_REQUEST['rm16'];
$r17 = 1*$_REQUEST['r17']; $rk17 = 1*$_REQUEST['rk17']; $rn17 = 1*$_REQUEST['rn17']; $rm17 = 1*$_REQUEST['rm17'];
$r18 = 1*$_REQUEST['r18']; $rk18 = 1*$_REQUEST['rk18']; $rn18 = 1*$_REQUEST['rn18']; $rm18 = 1*$_REQUEST['rm18'];
$r19 = 1*$_REQUEST['r19']; $rk19 = 1*$_REQUEST['rk19']; $rn19 = 1*$_REQUEST['rn19']; $rm19 = 1*$_REQUEST['rm19'];
$r20 = 1*$_REQUEST['r20']; $rk20 = 1*$_REQUEST['rk20']; $rn20 = 1*$_REQUEST['rn20']; $rm20 = 1*$_REQUEST['rm20'];
$r21 = 1*$_REQUEST['r21']; $rk21 = 1*$_REQUEST['rk21']; $rn21 = 1*$_REQUEST['rn21']; $rm21 = 1*$_REQUEST['rm21'];
$r22 = 1*$_REQUEST['r22']; $rk22 = 1*$_REQUEST['rk22']; $rn22 = 1*$_REQUEST['rn22']; $rm22 = 1*$_REQUEST['rm22'];

$uprtxt = "UPDATE F$kli_vxcf"."_uctvykaz_fin204pod SET r22='$r22', rk22='$rk22', rn22='$rn22', rm22='$rm22', ".
" r01='$r01', rk01='$rk01', rn01='$rn01', rm01='$rm01', r02='$r02', rk02='$rk02', rn02='$rn02', rm02='$rm02', ".
" r03='$r03', rk03='$rk03', rn03='$rn03', rm03='$rm03', r04='$r04', rk04='$rk04', rn04='$rn04', rm04='$rm04', ".
" r05='$r05', rk05='$rk05', rn05='$rn05', rm05='$rm05', r06='$r06', rk06='$rk06', rn06='$rn06', rm06='$rm06', ".
" r07='$r07', rk07='$rk07', rn07='$rn07', rm07='$rm07', r08='$r08', rk08='$rk08', rn08='$rn08', rm08='$rm08', ".
" r09='$r09', rk09='$rk09', rn09='$rn09', rm09='$rm09', r10='$r10', rk10='$rk10', rn10='$rn10', rm10='$rm10', ".
" r11='$r11', rk11='$rk11', rn11='$rn11', rm11='$rm11', r12='$r12', rk12='$rk12', rn12='$rn12', rm12='$rm12', ".
" r13='$r13', rk13='$rk13', rn13='$rn13', rm13='$rm13', r14='$r14', rk14='$rk14', rn14='$rn14', rm14='$rm14', ".
" r15='$r15', rk15='$rk15', rn15='$rn15', rm15='$rm15', r16='$r16', rk16='$rk16', rn16='$rn16', rm16='$rm16', ".
" r17='$r17', rk17='$rk17', rn17='$rn17', rm17='$rm17', r18='$r18', rk18='$rk18', rn18='$rn18', rm18='$rm18', ".
" r19='$r19', rk19='$rk19', rn19='$rn19', rm19='$rm19', r20='$r20', rk20='$rk20', rn20='$rn20', rm20='$rm20', ".
" r21='$r21', rk21='$rk21', rn21='$rn21', rm21='$rm21',  ".
" okres='$okres', obec='$obec', daz='$daz_sql' ".
" WHERE oc = $cislo_oc"; 

                       }



if ( $strana == 2 )    {

$r23 = 1*$_REQUEST['r23']; $rk23 = 1*$_REQUEST['rk23']; $rn23 = 1*$_REQUEST['rn23']; $rm23 = 1*$_REQUEST['rm23'];
$r24 = 1*$_REQUEST['r24']; $rk24 = 1*$_REQUEST['rk24']; $rn24 = 1*$_REQUEST['rn24']; $rm24 = 1*$_REQUEST['rm24'];
$r25 = 1*$_REQUEST['r25']; $rk25 = 1*$_REQUEST['rk25']; $rn25 = 1*$_REQUEST['rn25']; $rm25 = 1*$_REQUEST['rm25'];
$r26 = 1*$_REQUEST['r26']; $rk26 = 1*$_REQUEST['rk26']; $rn26 = 1*$_REQUEST['rn26']; $rm26 = 1*$_REQUEST['rm26'];
$r27 = 1*$_REQUEST['r27']; $rk27 = 1*$_REQUEST['rk27']; $rn27 = 1*$_REQUEST['rn27']; $rm27 = 1*$_REQUEST['rm27'];
$r28 = 1*$_REQUEST['r28']; $rk28 = 1*$_REQUEST['rk28']; $rn28 = 1*$_REQUEST['rn28']; $rm28 = 1*$_REQUEST['rm28'];
$r29 = 1*$_REQUEST['r29']; $rk29 = 1*$_REQUEST['rk29']; $rn29 = 1*$_REQUEST['rn29']; $rm29 = 1*$_REQUEST['rm29'];

$r30 = 1*$_REQUEST['r30']; $rk30 = 1*$_REQUEST['rk30']; $rn30 = 1*$_REQUEST['rn30']; $rm30 = 1*$_REQUEST['rm30'];
$r31 = 1*$_REQUEST['r31']; $rk31 = 1*$_REQUEST['rk31']; $rn31 = 1*$_REQUEST['rn31']; $rm31 = 1*$_REQUEST['rm31'];
$r32 = 1*$_REQUEST['r32']; $rk32 = 1*$_REQUEST['rk32']; $rn32 = 1*$_REQUEST['rn32']; $rm32 = 1*$_REQUEST['rm32'];
$r33 = 1*$_REQUEST['r33']; $rk33 = 1*$_REQUEST['rk33']; $rn33 = 1*$_REQUEST['rn33']; $rm33 = 1*$_REQUEST['rm33'];
$r34 = 1*$_REQUEST['r34']; $rk34 = 1*$_REQUEST['rk34']; $rn34 = 1*$_REQUEST['rn34']; $rm34 = 1*$_REQUEST['rm34'];
$r35 = 1*$_REQUEST['r35']; $rk35 = 1*$_REQUEST['rk35']; $rn35 = 1*$_REQUEST['rn35']; $rm35 = 1*$_REQUEST['rm35'];
$r36 = 1*$_REQUEST['r36']; $rk36 = 1*$_REQUEST['rk36']; $rn36 = 1*$_REQUEST['rn36']; $rm36 = 1*$_REQUEST['rm36'];
$r37 = 1*$_REQUEST['r37']; $rk37 = 1*$_REQUEST['rk37']; $rn37 = 1*$_REQUEST['rn37']; $rm37 = 1*$_REQUEST['rm37'];
$r38 = 1*$_REQUEST['r38']; $rk38 = 1*$_REQUEST['rk38']; $rn38 = 1*$_REQUEST['rn38']; $rm38 = 1*$_REQUEST['rm38'];
$r39 = 1*$_REQUEST['r39']; $rk39 = 1*$_REQUEST['rk39']; $rn39 = 1*$_REQUEST['rn39']; $rm39 = 1*$_REQUEST['rm39'];

$r40 = 1*$_REQUEST['r40']; $rk40 = 1*$_REQUEST['rk40']; $rn40 = 1*$_REQUEST['rn40']; $rm40 = 1*$_REQUEST['rm40'];
$r41 = 1*$_REQUEST['r41']; $rk41 = 1*$_REQUEST['rk41']; $rn40 = 1*$_REQUEST['rn41']; $rm41 = 1*$_REQUEST['rm41'];
$r42 = 1*$_REQUEST['r42']; $rk42 = 1*$_REQUEST['rk42']; $rn40 = 1*$_REQUEST['rn42']; $rm42 = 1*$_REQUEST['rm42'];
$r43 = 1*$_REQUEST['r43']; $rk43 = 1*$_REQUEST['rk43']; $rn40 = 1*$_REQUEST['rn43']; $rm43 = 1*$_REQUEST['rm43'];

$uprtxt = "UPDATE F$kli_vxcf"."_uctvykaz_fin204pod SET ".
" r23='$r23', rk23='$rk23', rn23='$rn23', rm23='$rm23', ". 
" r24='$r24', rk24='$rk24', rn24='$rn24', rm24='$rm24', r25='$r25', rk25='$rk25', rn25='$rn25', rm25='$rm25', ".
" r26='$r26', rk26='$rk26', rn26='$rn26', rm26='$rm26', r27='$r27', rk27='$rk27', rn27='$rn27', rm27='$rm27', ".
" r28='$r28', rk28='$rk28', rn28='$rn28', rm28='$rm28', r29='$r29', rk29='$rk29', rn29='$rn29', rm29='$rm29', ".
" r30='$r30', rk30='$rk30', rn30='$rn30', rm30='$rm30', r31='$r31', rk31='$rk31', rn31='$rn31', rm31='$rm31', ".
" r32='$r32', rk32='$rk32', rn32='$rn32', rm32='$rm32', r33='$r33', rk33='$rk33', rn33='$rn33', rm33='$rm33', ".
" r34='$r34', rk34='$rk34', rn34='$rn34', rm34='$rm34', r35='$r35', rk35='$rk35', rn35='$rn35', rm35='$rm35', ".
" r36='$r36', rk36='$rk36', rn36='$rn36', rm36='$rm36', r37='$r37', rk37='$rk37', rn37='$rn37', rm37='$rm37', ".
" r38='$r38', rk38='$rk38', rn38='$rn38', rm38='$rm38', r39='$r39', rk39='$rk39', rn39='$rn39', rm39='$rm39', ".
" r40='$r40', rk40='$rk40', rn40='$rn40', rm40='$rm40',  ".
" r41='$r41', rk41='$rk41', rn41='$rn41', rm41='$rm41',  ".
" r42='$r42', rk42='$rk42', rn42='$rn42', rm42='$rm42',  ".
" r43='$r43', rk43='$rk43', rn43='$rn43', rm43='$rm43'   ".
" WHERE oc = $cislo_oc"; 

                       }


if ( $strana == 3 )    {

$r44 = 1*$_REQUEST['r44']; $rm44 = 1*$_REQUEST['rm44'];
$r45 = 1*$_REQUEST['r45']; $rm45 = 1*$_REQUEST['rm45'];
$r46 = 1*$_REQUEST['r46']; $rm46 = 1*$_REQUEST['rm46'];
$r47 = 1*$_REQUEST['r47']; $rm47 = 1*$_REQUEST['rm47'];
$r48 = 1*$_REQUEST['r48']; $rm48 = 1*$_REQUEST['rm48'];
$r49 = 1*$_REQUEST['r49']; $rm49 = 1*$_REQUEST['rm49'];
$r50 = 1*$_REQUEST['r50']; $rm50 = 1*$_REQUEST['rm50'];
$r51 = 1*$_REQUEST['r51']; $rm51 = 1*$_REQUEST['rm51'];
$r52 = 1*$_REQUEST['r52']; $rm52 = 1*$_REQUEST['rm52'];
$r53 = 1*$_REQUEST['r53']; $rm53 = 1*$_REQUEST['rm53'];
$r54 = 1*$_REQUEST['r54']; $rm54 = 1*$_REQUEST['rm54'];
$r55 = 1*$_REQUEST['r55']; $rm55 = 1*$_REQUEST['rm55'];
$r56 = 1*$_REQUEST['r56']; $rm56 = 1*$_REQUEST['rm56'];
$r57 = 1*$_REQUEST['r57']; $rm57 = 1*$_REQUEST['rm57'];
$r58 = 1*$_REQUEST['r58']; $rm58 = 1*$_REQUEST['rm58'];
$r59 = 1*$_REQUEST['r59']; $rm59 = 1*$_REQUEST['rm59'];
$r60 = 1*$_REQUEST['r60']; $rm60 = 1*$_REQUEST['rm60'];
$r61 = 1*$_REQUEST['r61']; $rm61 = 1*$_REQUEST['rm61'];
$r62 = 1*$_REQUEST['r62']; $rm62 = 1*$_REQUEST['rm62'];
$r63 = 1*$_REQUEST['r63']; $rm63 = 1*$_REQUEST['rm63'];
$r64 = 1*$_REQUEST['r64']; $rm64 = 1*$_REQUEST['rm64'];
$r65 = 1*$_REQUEST['r65']; $rm65 = 1*$_REQUEST['rm65'];
$r66 = 1*$_REQUEST['r66']; $rm66 = 1*$_REQUEST['rm66'];
$r67 = 1*$_REQUEST['r67']; $rm67 = 1*$_REQUEST['rm67'];
$r68 = 1*$_REQUEST['r68']; $rm68 = 1*$_REQUEST['rm68'];
$r69 = 1*$_REQUEST['r69']; $rm69 = 1*$_REQUEST['rm69'];
$r70 = 1*$_REQUEST['r70']; $rm70 = 1*$_REQUEST['rm70'];

$r71 = 1*$_REQUEST['r71']; $rm71 = 1*$_REQUEST['rm71'];
$r72 = 1*$_REQUEST['r72']; $rm72 = 1*$_REQUEST['rm72'];
$r73 = 1*$_REQUEST['r73']; $rm73 = 1*$_REQUEST['rm73'];
$r74 = 1*$_REQUEST['r74']; $rm74 = 1*$_REQUEST['rm74'];

$uprtxt = "UPDATE F$kli_vxcf"."_uctvykaz_fin204pod SET ".
"  r44='$r44', rm44='$rm44', ".
" r45='$r45', rm45='$rm45', r46='$r46', rm46='$rm46', ".
" r47='$r47', rm47='$rm47', r48='$r48', rm48='$rm48', ".
" r49='$r49', rm49='$rm49', r50='$r50', rm50='$rm50', ".
" r51='$r51', rm51='$rm51', r52='$r52', rm52='$rm52', ".
" r53='$r53', rm53='$rm53', r54='$r54', rm54='$rm54', ".
" r55='$r55', rm55='$rm55', r56='$r56', rm56='$rm56', ".
" r57='$r57', rm57='$rm57', r58='$r58', rm58='$rm58', ".
" r59='$r59', rm59='$rm59', r60='$r60', rm60='$rm60', ".
" r61='$r61', rm61='$rm61', r62='$r62', rm62='$rm62', ".
" r63='$r63', rm63='$rm63', r64='$r64', rm64='$rm64', ".
" r65='$r65', rm65='$rm65', r66='$r66', rm66='$rm66', ".
" r67='$r67', rm67='$rm67', r68='$r68', rm68='$rm68', ".
" r69='$r69', rm69='$rm69', r70='$r70', rm70='$rm70',  ".
" r70='$r70', rm70='$rm70', r71='$r71', rm71='$rm71', r72='$r72', rm72='$rm72', r73='$r73', rm73='$rm73', r74='$r74', rm74='$rm74'  ".
" WHERE oc = $cislo_oc"; 
                       }

//echo $uprtxt;
$upravene = mysql_query("$uprtxt");  

$nepoc = 1*$_REQUEST['nepoc'];
$vsetkyprepocty=1;
if( $nepoc == 1 ) $vsetkyprepocty=0;

$copern=20;
if (!$upravene):
?>
<script type="text/javascript"> alert( "�DAJE NEBOLI UPRAVEN� " ) </script>
<?php
endif;
if ($upravene):
$uprav="OK";
endif;
    }
//koniec zapisu upravenych udajov

//prac.subor a subor 
$sqlt = 'DROP TABLE F'.$kli_vxcf.'_uctprcvykaz'.$kli_uzid;
$vysledok = mysql_query("$sqlt");
$sqlt = 'DROP TABLE F'.$kli_vxcf.'_uctprcvykazx'.$kli_uzid;
$vysledok = mysql_query("$sqlt");
$sqlt = 'DROP TABLE F'.$kli_vxcf.'_uctprcvykazz'.$kli_uzid;
$vysledok = mysql_query("$sqlt");


$sql = "SELECT px08 FROM F".$kli_vxcf."_uctvykaz_fin204pod";
$vysledok = mysql_query($sql);
if (!$vysledok)
{
$sqlt = 'DROP TABLE F'.$kli_vxcf.'_uctvykaz_fin204pod';
$vysledok = mysql_query("$sqlt");
$sqlt = 'DROP TABLE F'.$kli_vxcf.'_uctvykaz_fin204podd2';
//$vysledok = mysql_query("$sqlt");


$pocdes="10,2";
$sqlt = <<<mzdprc
(
   px08         DECIMAL($pocdes) DEFAULT 0,
   oc           INT(7) DEFAULT 0,
   druh         DECIMAL(10,0) DEFAULT 0,
   okres        VARCHAR(11),
   obec         VARCHAR(11),
   daz          DATE,
   kor          INT,
   prx          INT,
   uce          VARCHAR(11),
   ucm          VARCHAR(11),
   ucd          VARCHAR(11),
   rdk          INT,
   prv          INT,
   hod          DECIMAL($pocdes),
   mdt          DECIMAL($pocdes),
   dal          DECIMAL($pocdes),
   r01          DECIMAL($pocdes),
   r02          DECIMAL($pocdes),
   r03          DECIMAL($pocdes),
   r04          DECIMAL($pocdes),
   r05          DECIMAL($pocdes),
   r06          DECIMAL($pocdes),
   r07          DECIMAL($pocdes),
   r08          DECIMAL($pocdes),
   r09          DECIMAL($pocdes),
   r10          DECIMAL($pocdes),
   r11          DECIMAL($pocdes),
   r12          DECIMAL($pocdes),
   r13          DECIMAL($pocdes),
   r14          DECIMAL($pocdes),
   r15          DECIMAL($pocdes),
   r16          DECIMAL($pocdes),
   r17          DECIMAL($pocdes),
   r18          DECIMAL($pocdes),
   r19          DECIMAL($pocdes),
   r20          DECIMAL($pocdes),
   r21          DECIMAL($pocdes),
   r22          DECIMAL($pocdes),
   r23          DECIMAL($pocdes),
   r24          DECIMAL($pocdes),
   r25          DECIMAL($pocdes),
   r26          DECIMAL($pocdes),
   r27          DECIMAL($pocdes),
   r28          DECIMAL($pocdes),
   r29          DECIMAL($pocdes),
   r30          DECIMAL($pocdes),
   r31          DECIMAL($pocdes),
   r32          DECIMAL($pocdes),
   r33          DECIMAL($pocdes),
   r34          DECIMAL($pocdes),
   r35          DECIMAL($pocdes),
   r36          DECIMAL($pocdes),
   r37          DECIMAL($pocdes),
   r38          DECIMAL($pocdes),
   r39          DECIMAL($pocdes),
   r40          DECIMAL($pocdes),
   r41          DECIMAL($pocdes),
   r42          DECIMAL($pocdes),
   r43          DECIMAL($pocdes),
   r44          DECIMAL($pocdes),
   r45          DECIMAL($pocdes),
   r46          DECIMAL($pocdes),
   r47          DECIMAL($pocdes),
   r48          DECIMAL($pocdes),
   r49          DECIMAL($pocdes),
   r50          DECIMAL($pocdes),
   r51          DECIMAL($pocdes),
   r52          DECIMAL($pocdes),
   r53          DECIMAL($pocdes),
   r54          DECIMAL($pocdes),
   r55          DECIMAL($pocdes),
   r56          DECIMAL($pocdes),
   r57          DECIMAL($pocdes),
   r58          DECIMAL($pocdes),
   r59          DECIMAL($pocdes),
   r60          DECIMAL($pocdes),
   r61          DECIMAL($pocdes),
   r62          DECIMAL($pocdes),
   r63          DECIMAL($pocdes),
   r64          DECIMAL($pocdes),
   r65          DECIMAL($pocdes),
   r66          DECIMAL($pocdes),
   r67          DECIMAL($pocdes),
   r68          DECIMAL($pocdes),
   r69          DECIMAL($pocdes),
   r70          DECIMAL($pocdes),
   r71          DECIMAL($pocdes),
   r72          DECIMAL($pocdes),
   r73          DECIMAL($pocdes),
   r74          DECIMAL($pocdes),
   r75          DECIMAL($pocdes),
   r76          DECIMAL($pocdes),
   r77          DECIMAL($pocdes),
   r78          DECIMAL($pocdes),
   r79          DECIMAL($pocdes),
   r80          DECIMAL($pocdes),
   r81          DECIMAL($pocdes),
   r82          DECIMAL($pocdes),
   r83          DECIMAL($pocdes),
   r84          DECIMAL($pocdes),
   r85          DECIMAL($pocdes),
   r86          DECIMAL($pocdes),
   r87          DECIMAL($pocdes),
   r88          DECIMAL($pocdes),
   r89          DECIMAL($pocdes),
   r90          DECIMAL($pocdes),
   r91          DECIMAL($pocdes),
   r92          DECIMAL($pocdes),
   r93          DECIMAL($pocdes),
   r94          DECIMAL($pocdes),
   r95          DECIMAL($pocdes),
   r96          DECIMAL($pocdes),
   r97          DECIMAL($pocdes),
   r98          DECIMAL($pocdes),
   r99          DECIMAL($pocdes),
   r100         DECIMAL($pocdes),
   r101         DECIMAL($pocdes),
   r102         DECIMAL($pocdes),
   r103         DECIMAL($pocdes),
   r104         DECIMAL($pocdes),
   r105         DECIMAL($pocdes),
   r106         DECIMAL($pocdes),
   r107         DECIMAL($pocdes),
   r108         DECIMAL($pocdes),
   r109         DECIMAL($pocdes),
   r110         DECIMAL($pocdes),
   r111         DECIMAL($pocdes),
   r112         DECIMAL($pocdes),
   r113         DECIMAL($pocdes),
   r114         DECIMAL($pocdes),
   r115         DECIMAL($pocdes),
   r116         DECIMAL($pocdes),
   r117         DECIMAL($pocdes),
   r118         DECIMAL($pocdes),
   rk01          DECIMAL($pocdes),
   rk02          DECIMAL($pocdes),
   rk03          DECIMAL($pocdes),
   rk04          DECIMAL($pocdes),
   rk05          DECIMAL($pocdes),
   rk06          DECIMAL($pocdes),
   rk07          DECIMAL($pocdes),
   rk08          DECIMAL($pocdes),
   rk09          DECIMAL($pocdes),
   rk10          DECIMAL($pocdes),
   rk11          DECIMAL($pocdes),
   rk12          DECIMAL($pocdes),
   rk13          DECIMAL($pocdes),
   rk14          DECIMAL($pocdes),
   rk15          DECIMAL($pocdes),
   rk16          DECIMAL($pocdes),
   rk17          DECIMAL($pocdes),
   rk18          DECIMAL($pocdes),
   rk19          DECIMAL($pocdes),
   rk20          DECIMAL($pocdes),
   rk21          DECIMAL($pocdes),
   rk22          DECIMAL($pocdes),
   rk23          DECIMAL($pocdes),
   rk24          DECIMAL($pocdes),
   rk25          DECIMAL($pocdes),
   rk26          DECIMAL($pocdes),
   rk27          DECIMAL($pocdes),
   rk28          DECIMAL($pocdes),
   rk29          DECIMAL($pocdes),
   rk30          DECIMAL($pocdes),
   rk31          DECIMAL($pocdes),
   rk32          DECIMAL($pocdes),
   rk33          DECIMAL($pocdes),
   rk34          DECIMAL($pocdes),
   rk35          DECIMAL($pocdes),
   rk36          DECIMAL($pocdes),
   rk37          DECIMAL($pocdes),
   rk38          DECIMAL($pocdes),
   rk39          DECIMAL($pocdes),
   rk40          DECIMAL($pocdes),
   rk41          DECIMAL($pocdes),
   rk42          DECIMAL($pocdes),
   rk43          DECIMAL($pocdes),
   rk44          DECIMAL($pocdes),
   rk45          DECIMAL($pocdes),
   rk46          DECIMAL($pocdes),
   rk47          DECIMAL($pocdes),
   rk48          DECIMAL($pocdes),
   rk49          DECIMAL($pocdes),
   rk50          DECIMAL($pocdes),
   rk51          DECIMAL($pocdes),
   rk52          DECIMAL($pocdes),
   rk53          DECIMAL($pocdes),
   rk54          DECIMAL($pocdes),
   rk55          DECIMAL($pocdes),
   rk56          DECIMAL($pocdes),
   rk57          DECIMAL($pocdes),
   rk58          DECIMAL($pocdes),
   rk59          DECIMAL($pocdes),
   rk60          DECIMAL($pocdes),
   rk61          DECIMAL($pocdes),
   rk62          DECIMAL($pocdes),
   rk63          DECIMAL($pocdes),
   rk64          DECIMAL($pocdes),
   rn01          DECIMAL($pocdes),
   rn02          DECIMAL($pocdes),
   rn03          DECIMAL($pocdes),
   rn04          DECIMAL($pocdes),
   rn05          DECIMAL($pocdes),
   rn06          DECIMAL($pocdes),
   rn07          DECIMAL($pocdes),
   rn08          DECIMAL($pocdes),
   rn09          DECIMAL($pocdes),
   rn10          DECIMAL($pocdes),
   rn11          DECIMAL($pocdes),
   rn12          DECIMAL($pocdes),
   rn13          DECIMAL($pocdes),
   rn14          DECIMAL($pocdes),
   rn15          DECIMAL($pocdes),
   rn16          DECIMAL($pocdes),
   rn17          DECIMAL($pocdes),
   rn18          DECIMAL($pocdes),
   rn19          DECIMAL($pocdes),
   rn20          DECIMAL($pocdes),
   rn21          DECIMAL($pocdes),
   rn22          DECIMAL($pocdes),
   rn23          DECIMAL($pocdes),
   rn24          DECIMAL($pocdes),
   rn25          DECIMAL($pocdes),
   rn26          DECIMAL($pocdes),
   rn27          DECIMAL($pocdes),
   rn28          DECIMAL($pocdes),
   rn29          DECIMAL($pocdes),
   rn30          DECIMAL($pocdes),
   rn31          DECIMAL($pocdes),
   rn32          DECIMAL($pocdes),
   rn33          DECIMAL($pocdes),
   rn34          DECIMAL($pocdes),
   rn35          DECIMAL($pocdes),
   rn36          DECIMAL($pocdes),
   rn37          DECIMAL($pocdes),
   rn38          DECIMAL($pocdes),
   rn39          DECIMAL($pocdes),
   rn40          DECIMAL($pocdes),
   rn41          DECIMAL($pocdes),
   rn42          DECIMAL($pocdes),
   rn43          DECIMAL($pocdes),
   rn44          DECIMAL($pocdes),
   rn45          DECIMAL($pocdes),
   rn46          DECIMAL($pocdes),
   rn47          DECIMAL($pocdes),
   rn48          DECIMAL($pocdes),
   rn49          DECIMAL($pocdes),
   rn50          DECIMAL($pocdes),
   rn51          DECIMAL($pocdes),
   rn52          DECIMAL($pocdes),
   rn53          DECIMAL($pocdes),
   rn54          DECIMAL($pocdes),
   rn55          DECIMAL($pocdes),
   rn56          DECIMAL($pocdes),
   rn57          DECIMAL($pocdes),
   rn58          DECIMAL($pocdes),
   rn59          DECIMAL($pocdes),
   rn60          DECIMAL($pocdes),
   rn61          DECIMAL($pocdes),
   rn62          DECIMAL($pocdes),
   rn63          DECIMAL($pocdes),
   rn64          DECIMAL($pocdes),
   rm01          DECIMAL($pocdes),
   rm02          DECIMAL($pocdes),
   rm03          DECIMAL($pocdes),
   rm04          DECIMAL($pocdes),
   rm05          DECIMAL($pocdes),
   rm06          DECIMAL($pocdes),
   rm07          DECIMAL($pocdes),
   rm08          DECIMAL($pocdes),
   rm09          DECIMAL($pocdes),
   rm10          DECIMAL($pocdes),
   rm11          DECIMAL($pocdes),
   rm12          DECIMAL($pocdes),
   rm13          DECIMAL($pocdes),
   rm14          DECIMAL($pocdes),
   rm15          DECIMAL($pocdes),
   rm16          DECIMAL($pocdes),
   rm17          DECIMAL($pocdes),
   rm18          DECIMAL($pocdes),
   rm19          DECIMAL($pocdes),
   rm20          DECIMAL($pocdes),
   rm21          DECIMAL($pocdes),
   rm22          DECIMAL($pocdes),
   rm23          DECIMAL($pocdes),
   rm24          DECIMAL($pocdes),
   rm25          DECIMAL($pocdes),
   rm26          DECIMAL($pocdes),
   rm27          DECIMAL($pocdes),
   rm28          DECIMAL($pocdes),
   rm29          DECIMAL($pocdes),
   rm30          DECIMAL($pocdes),
   rm31          DECIMAL($pocdes),
   rm32          DECIMAL($pocdes),
   rm33          DECIMAL($pocdes),
   rm34          DECIMAL($pocdes),
   rm35          DECIMAL($pocdes),
   rm36          DECIMAL($pocdes),
   rm37          DECIMAL($pocdes),
   rm38          DECIMAL($pocdes),
   rm39          DECIMAL($pocdes),
   rm40          DECIMAL($pocdes),
   rm41          DECIMAL($pocdes),
   rm42          DECIMAL($pocdes),
   rm43          DECIMAL($pocdes),
   rm44          DECIMAL($pocdes),
   rm45          DECIMAL($pocdes),
   rm46          DECIMAL($pocdes),
   rm47          DECIMAL($pocdes),
   rm48          DECIMAL($pocdes),
   rm49          DECIMAL($pocdes),
   rm50          DECIMAL($pocdes),
   rm51          DECIMAL($pocdes),
   rm52          DECIMAL($pocdes),
   rm53          DECIMAL($pocdes),
   rm54          DECIMAL($pocdes),
   rm55          DECIMAL($pocdes),
   rm56          DECIMAL($pocdes),
   rm57          DECIMAL($pocdes),
   rm58          DECIMAL($pocdes),
   rm59          DECIMAL($pocdes),
   rm60          DECIMAL($pocdes),
   rm61          DECIMAL($pocdes),
   rm62          DECIMAL($pocdes),
   rm63          DECIMAL($pocdes),
   rm64          DECIMAL($pocdes),
   rm65          DECIMAL($pocdes),
   rm66          DECIMAL($pocdes),
   rm67          DECIMAL($pocdes),
   rm68          DECIMAL($pocdes),
   rm69          DECIMAL($pocdes),
   rm70          DECIMAL($pocdes),
   rm71          DECIMAL($pocdes),
   rm72          DECIMAL($pocdes),
   rm73          DECIMAL($pocdes),
   rm74          DECIMAL($pocdes),
   rm75          DECIMAL($pocdes),
   rm76          DECIMAL($pocdes),
   rm77          DECIMAL($pocdes),
   rm78          DECIMAL($pocdes),
   rm79          DECIMAL($pocdes),
   rm80          DECIMAL($pocdes),
   rm81          DECIMAL($pocdes),
   rm82          DECIMAL($pocdes),
   rm83          DECIMAL($pocdes),
   rm84          DECIMAL($pocdes),
   rm85          DECIMAL($pocdes),
   rm86          DECIMAL($pocdes),
   rm87          DECIMAL($pocdes),
   rm88          DECIMAL($pocdes),
   rm89          DECIMAL($pocdes),
   rm90          DECIMAL($pocdes),
   rm91          DECIMAL($pocdes),
   rm92          DECIMAL($pocdes),
   ico           INT
);
mzdprc;

$vsql = 'CREATE TABLE F'.$kli_vxcf.'_uctvykaz_fin204pod'.$sqlt;
$vytvor = mysql_query("$vsql");


}
//koniec vytvorenie 



$vsql = 'CREATE TABLE F'.$kli_vxcf.'_uctprcvykaz'.$kli_uzid." SELECT * FROM F$kli_vxcf"."_uctvykaz_fin204pod";
$vytvor = mysql_query("$vsql");
$vsql = 'CREATE TABLE F'.$kli_vxcf.'_uctprcvykazx'.$kli_uzid." SELECT * FROM F$kli_vxcf"."_uctvykaz_fin204pod";
$vytvor = mysql_query("$vsql");

$vsql = 'TRUNCATE TABLE F'.$kli_vxcf.'_uctprcvykaz'.$kli_uzid." ";
$vytvor = mysql_query("$vsql");
$vsql = 'TRUNCATE TABLE F'.$kli_vxcf.'_uctprcvykazx'.$kli_uzid." ";
$vytvor = mysql_query("$vsql");

//exit;


$jepotvrd=0;
$sql = "SELECT * FROM F$kli_vxcf"."_uctvykaz_fin204pod WHERE oc = $cislo_oc";
$sqldok = mysql_query("$sql");
  if (@$zaznam=mysql_data_seek($sqldok,0))
  {
  $jepotvrd=1;
  }
if( $jepotvrd == 0 ) $subor=1;

//vytvor pracovny subor
if( $subor == 1 )
{

//zober data z kun
$sql = "SELECT * FROM F$kli_vxcf"."_mzdkun WHERE oc = $cislo_oc";
$sqldok = mysql_query("$sql");
  if (@$zaznam=mysql_data_seek($sqldok,0))
  {
  $riaddok=mysql_fetch_object($sqldok);
  $meno=$riaddok->meno;

  }

$ttvv = "INSERT INTO F$kli_vxcf"."_uctprcvykaz$kli_uzid ".
" ( oc   ) VALUES ".
" ( '$cislo_oc' )";
//$ttqq = mysql_query("$ttvv");

/////////////////////////////////nacitaj hodnoty z ucta do suboru
echo "Na��tavam hodnoty";

//zober pociatocny stav uctov
$dsqlt = "INSERT INTO F$kli_vxcf"."_uctprcvykaz$kli_uzid"." SELECT".
" pmd,$cislo_oc,0,'','','0000-00-00',".
" 0,0,uce,uce,0,0,0,0,pmd,0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,".
"$fir_fico FROM F$kli_vxcf"."_uctosnova".
" WHERE F$kli_vxcf"."_uctosnova.pmd != 0";
//echo $dsqlt;
$dsql = mysql_query("$dsqlt");

$dsqlt = "INSERT INTO F$kli_vxcf"."_uctprcvykaz$kli_uzid"." SELECT".
" -pda,$cislo_oc,0,'','','0000-00-00',".
" 0,0,uce,uce,0,0,0,0,0,pda,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,".
"$fir_fico FROM F$kli_vxcf"."_uctosnova".
" WHERE F$kli_vxcf"."_uctosnova.pda != 0";
//echo $dsqlt;
$dsql = mysql_query("$dsqlt");


//exit;

$psys=1;
while ($psys <= 9 ) 
  {
//zober prijmove pokl
if( $psys == 1 ) { $uctovanie="uctpokuct"; $doklad="pokpri"; }
//zober vydavkove pokl
if( $psys == 2 ) { $uctovanie="uctpokuct"; $doklad="pokvyd"; }
//zober bankove
if( $psys == 3 ) { $uctovanie="uctban"; $doklad="banvyp"; }
//zober vseobecne
if( $psys == 4 ) { $uctovanie="uctvsdp"; $doklad="uctvsdh"; }
//zober odberatelske
if( $psys == 5 ) { $uctovanie="uctodb"; $doklad="fakodb"; }
//zober dodavatelske
if( $psys == 6 ) { $uctovanie="uctdod"; $doklad="fakdod"; }
//zober majetok
if( $psys == 7 ) { $uctovanie="uctmaj"; }
//zober majetok
if( $psys == 8 ) { $uctovanie="uctskl"; }
//zober mzdy
if( $psys == 9 ) { $uctovanie="uctmzd"; }

if( $psys <= 6 )
{
$dsqlt = "INSERT INTO F$kli_vxcf"."_uctprcvykaz$kli_uzid"." SELECT".
" 0,$cislo_oc,0,'','','0000-00-00',".
"0,0,ucm,ucm,0,0,0,0,F$kli_vxcf"."_$uctovanie.hod,0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,".
" $fir_fico FROM F$kli_vxcf"."_$uctovanie,F$kli_vxcf"."_$doklad".
" WHERE F$kli_vxcf"."_$uctovanie.dok=F$kli_vxcf"."_$doklad.dok AND ucm > 0 AND ume <= $kli_vume";
//echo $dsqlt;
$dsql = mysql_query("$dsqlt");

$dsqlt = "INSERT INTO F$kli_vxcf"."_uctprcvykaz$kli_uzid"." SELECT".
" 0,$cislo_oc,0,'','','0000-00-00',".
" 0,0,ucd,0,ucd,0,0,0,0,F$kli_vxcf"."_$uctovanie.hod,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,".
" $fir_fico FROM F$kli_vxcf"."_$uctovanie,F$kli_vxcf"."_$doklad".
" WHERE F$kli_vxcf"."_$uctovanie.dok=F$kli_vxcf"."_$doklad.dok AND ucd > 0 AND ume <= $kli_vume";
$dsql = mysql_query("$dsqlt");

}
else
{
//tu budu podsystemy

$dsqlt = "INSERT INTO F$kli_vxcf"."_uctprcvykaz$kli_uzid"." SELECT".
" 0,$cislo_oc,0,'','','0000-00-00',".
" 0,0,ucm,ucm,0,0,0,0,SUM(hod),0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,".
" $fir_fico FROM F$kli_vxcf"."_$uctovanie".
" WHERE ( ucm > 0 AND ume <= $kli_vume ) GROUP BY F$kli_vxcf"."_$uctovanie.ucm";
//echo $dsqlt;
$dsql = mysql_query("$dsqlt");

$dsqlt = "INSERT INTO F$kli_vxcf"."_uctprcvykaz$kli_uzid"." SELECT".
" 0,$cislo_oc,0,'','','0000-00-00',".
" 0,0,ucd,0,ucd,0,0,0,0,SUM(hod),".
"0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,".
" $fir_fico FROM F$kli_vxcf"."_$uctovanie".
" WHERE ( ucd > 0 AND ume <= $kli_vume ) GROUP BY F$kli_vxcf"."_$uctovanie.ucd";
$dsql = mysql_query("$dsqlt");

}
$psys=$psys+1;
  }

$sqtoz = "UPDATE F$kli_vxcf"."_uctprcvykaz$kli_uzid,F$kli_vxcf"."_crf204pod_no".
" SET rdk=F$kli_vxcf"."_crf204pod_no.crs".
" WHERE LEFT(F$kli_vxcf"."_uctprcvykaz$kli_uzid.uce,3) = LEFT(F$kli_vxcf"."_crf204pod_no.uce,3) ";
//echo $sqtoz;
$oznac = mysql_query("$sqtoz");

$sqtoz = "UPDATE F$kli_vxcf"."_uctprcvykaz$kli_uzid,F$kli_vxcf"."_crf204pod_no".
" SET rdk=F$kli_vxcf"."_crf204pod_no.crs".
" WHERE F$kli_vxcf"."_uctprcvykaz$kli_uzid.uce = F$kli_vxcf"."_crf204pod_no.uce ";
//echo $sqtoz;
$oznac = mysql_query("$sqtoz");
//exit;

//korekcia
$sqtoz = "UPDATE F$kli_vxcf"."_uctprcvykaz$kli_uzid".
" SET kor=1".
" WHERE LEFT(uce,3) = 071 OR LEFT(uce,3) = 072 OR LEFT(uce,3) = 073 OR LEFT(uce,3) = 074 OR LEFT(uce,3) = 075 OR LEFT(uce,3) = 076 OR LEFT(uce,3) = 079 ".
" OR LEFT(uce,3) = 081 OR LEFT(uce,3) = 082 OR LEFT(uce,3) = 083 OR LEFT(uce,3) = 084 OR LEFT(uce,3) = 085 OR LEFT(uce,3) = 086 ".
" OR LEFT(uce,3) = 088 OR LEFT(uce,3) = 089 ".
" OR LEFT(uce,3) = 091 OR LEFT(uce,3) = 092 OR LEFT(uce,3) = 093 OR LEFT(uce,3) = 094 OR LEFT(uce,3) = 095 OR LEFT(uce,3) = 096 OR LEFT(uce,3) = 098 ".
" OR LEFT(uce,3) = 191 OR LEFT(uce,3) = 192 OR LEFT(uce,3) = 193 OR LEFT(uce,3) = 194 OR LEFT(uce,3) = 195 OR LEFT(uce,3) = 196 ".
" OR LEFT(uce,3) = 197 OR LEFT(uce,3) = 198 OR LEFT(uce,3) = 199 ".
" OR LEFT(uce,3) = 291 OR LEFT(uce,3) = 391 ".
"";
//echo $sqtoz;
$oznac = mysql_query("$sqtoz");

//exit;

//rozdel do riadkov , vypocitaj netto

$rdk=1;
while ($rdk <= 74 ) 
  {
$crdk=$rdk;
if( $rdk < 10 ) $crdk="0".$rdk;

$sqtoz = "UPDATE F$kli_vxcf"."_uctprcvykaz$kli_uzid SET r$crdk=mdt-dal WHERE rdk = $rdk AND kor = 0 ";
if( $rdk > 43 ) { $sqtoz = "UPDATE F$kli_vxcf"."_uctprcvykaz$kli_uzid SET r$crdk=dal-mdt WHERE rdk = $rdk "; }
$oznac = mysql_query("$sqtoz");

if( $rdk < 44 ) { 
$sqtoz = "UPDATE F$kli_vxcf"."_uctprcvykaz$kli_uzid SET rk$crdk=dal-mdt WHERE rdk = $rdk AND kor = 1 ";
$oznac = mysql_query("$sqtoz");

$sqtoz = "UPDATE F$kli_vxcf"."_uctprcvykaz$kli_uzid SET rn$crdk=r$crdk-rk$crdk WHERE rdk > 0 ";
$oznac = mysql_query("$sqtoz");

                }

$sqtoz = "UPDATE F$kli_vxcf"."_uctprcvykaz$kli_uzid SET rm$crdk=px08 WHERE rdk = $rdk ";
if( $rdk > 43 ) { $sqtoz = "UPDATE F$kli_vxcf"."_uctprcvykaz$kli_uzid SET rm$crdk=-px08 WHERE rdk = $rdk "; }
$oznac = mysql_query("$sqtoz");

$rdk=$rdk+1;
  }



//sumar za riadky
$dsqlt = "INSERT INTO F$kli_vxcf"."_uctprcvykaz$kli_uzid "." SELECT".
" 0,$cislo_oc,0,'','','0000-00-00',".
" 0,1,uce,ucm,ucd,rdk,prv,hod,mdt,dal,".
"SUM(r01),SUM(r02),SUM(r03),SUM(r04),SUM(r05),SUM(r06),SUM(r07),SUM(r08),SUM(r09),SUM(r10),".
"SUM(r11),SUM(r12),SUM(r13),SUM(r14),SUM(r15),SUM(r16),SUM(r17),SUM(r18),SUM(r19),SUM(r20),".
"SUM(r21),SUM(r22),SUM(r23),SUM(r24),SUM(r25),SUM(r26),SUM(r27),SUM(r28),SUM(r29),SUM(r30),".
"SUM(r31),SUM(r32),SUM(r33),SUM(r34),SUM(r35),SUM(r36),SUM(r37),SUM(r38),SUM(r39),SUM(r40),".
"SUM(r41),SUM(r42),SUM(r43),SUM(r44),SUM(r45),SUM(r46),SUM(r47),SUM(r48),SUM(r49),SUM(r50),".
"SUM(r51),SUM(r52),SUM(r53),SUM(r54),SUM(r55),SUM(r56),SUM(r57),SUM(r58),SUM(r59),SUM(r60),".
"SUM(r61),SUM(r62),SUM(r63),SUM(r64),SUM(r65),SUM(r66),SUM(r67),SUM(r68),SUM(r69),SUM(r70),".
"SUM(r71),SUM(r72),SUM(r73),SUM(r74),SUM(r75),SUM(r76),SUM(r77),SUM(r78),SUM(r79),SUM(r80),".
"SUM(r81),SUM(r82),SUM(r83),SUM(r84),SUM(r85),SUM(r86),SUM(r87),SUM(r88),SUM(r89),SUM(r90),".
"SUM(r91),SUM(r92),SUM(r93),SUM(r94),SUM(r95),SUM(r96),SUM(r97),SUM(r98),SUM(r99),SUM(r100),".
"SUM(r101),SUM(r102),SUM(r103),SUM(r104),SUM(r105),SUM(r106),SUM(r107),SUM(r108),SUM(r109),SUM(r110),".
"SUM(r111),SUM(r112),SUM(r113),SUM(r114),SUM(r115),SUM(r116),SUM(r117),SUM(r118),".
"SUM(rk01),SUM(rk02),SUM(rk03),SUM(rk04),SUM(rk05),SUM(rk06),SUM(rk07),SUM(rk08),SUM(rk09),SUM(rk10),".
"SUM(rk11),SUM(rk12),SUM(rk13),SUM(rk14),SUM(rk15),SUM(rk16),SUM(rk17),SUM(rk18),SUM(rk19),SUM(rk20),".
"SUM(rk21),SUM(rk22),SUM(rk23),SUM(rk24),SUM(rk25),SUM(rk26),SUM(rk27),SUM(rk28),SUM(rk29),SUM(rk30),".
"SUM(rk31),SUM(rk32),SUM(rk33),SUM(rk34),SUM(rk35),SUM(rk36),SUM(rk37),SUM(rk38),SUM(rk39),SUM(rk40),".
"SUM(rk41),SUM(rk42),SUM(rk43),SUM(rk44),SUM(rk45),SUM(rk46),SUM(rk47),SUM(rk48),SUM(rk49),SUM(rk50),".
"SUM(rk51),SUM(rk52),SUM(rk53),SUM(rk54),SUM(rk55),SUM(rk56),SUM(rk57),SUM(rk58),SUM(rk59),SUM(rk60),".
"SUM(rk61),SUM(rk62),SUM(rk63),SUM(rk64),".
"SUM(rn01),SUM(rn02),SUM(rn03),SUM(rn04),SUM(rn05),SUM(rn06),SUM(rn07),SUM(rn08),SUM(rn09),SUM(rn10),".
"SUM(rn11),SUM(rn12),SUM(rn13),SUM(rn14),SUM(rn15),SUM(rn16),SUM(rn17),SUM(rn18),SUM(rn19),SUM(rn20),".
"SUM(rn21),SUM(rn22),SUM(rn23),SUM(rn24),SUM(rn25),SUM(rn26),SUM(rn27),SUM(rn28),SUM(rn29),SUM(rn30),".
"SUM(rn31),SUM(rn32),SUM(rn33),SUM(rn34),SUM(rn35),SUM(rn36),SUM(rn37),SUM(rn38),SUM(rn39),SUM(rn40),".
"SUM(rn41),SUM(rn42),SUM(rn43),SUM(rn44),SUM(rn45),SUM(rn46),SUM(rn47),SUM(rn48),SUM(rn49),SUM(rn50),".
"SUM(rn51),SUM(rn52),SUM(rn53),SUM(rn54),SUM(rn55),SUM(rn56),SUM(rn57),SUM(rn58),SUM(rn59),SUM(rn60),".
"SUM(rn61),SUM(rn62),SUM(rn63),SUM(rn64),".
"SUM(rm01),SUM(rm02),SUM(rm03),SUM(rm04),SUM(rm05),SUM(rm06),SUM(rm07),SUM(rm08),SUM(rm09),SUM(rm10),".
"SUM(rm11),SUM(rm12),SUM(rm13),SUM(rm14),SUM(rm15),SUM(rm16),SUM(rm17),SUM(rm18),SUM(rm19),SUM(rm20),".
"SUM(rm21),SUM(rm22),SUM(rm23),SUM(rm24),SUM(rm25),SUM(rm26),SUM(rm27),SUM(rm28),SUM(rm29),SUM(rm30),".
"SUM(rm31),SUM(rm32),SUM(rm33),SUM(rm34),SUM(rm35),SUM(rm36),SUM(rm37),SUM(rm38),SUM(rm39),SUM(rm40),".
"SUM(rm41),SUM(rm42),SUM(rm43),SUM(rm44),SUM(rm45),SUM(rm46),SUM(rm47),SUM(rm48),SUM(rm49),SUM(rm50),".
"SUM(rm51),SUM(rm52),SUM(rm53),SUM(rm54),SUM(rm55),SUM(rm56),SUM(rm57),SUM(rm58),SUM(rm59),SUM(rm60),".
"SUM(rm61),SUM(rm62),SUM(rm63),SUM(rm64),SUM(rm65),SUM(rm66),SUM(rm67),SUM(rm68),SUM(rm69),SUM(rm70),".
"SUM(rm71),SUM(rm72),SUM(rm73),SUM(rm74),SUM(rm75),SUM(rm76),SUM(rm77),SUM(rm78),SUM(rm79),SUM(rm80),".
"SUM(rm81),SUM(rm82),SUM(rm83),SUM(rm84),SUM(rm85),SUM(rm86),SUM(rm87),SUM(rm88),SUM(rm89),SUM(rm90),".
"SUM(rm91),SUM(rm92),".
"$fir_fico".
" FROM F$kli_vxcf"."_uctprcvykaz$kli_uzid".
" WHERE rdk > 0".
" GROUP BY prx".
"";
//echo $dsqlt;
$dsql = mysql_query("$dsqlt");



$dsqlt = "UPDATE F$kli_vxcf"."_uctprcvykaz".$kli_uzid." ".
" SET r11=r11+r12, rk11=rk11+rk12, rn11=rn11+rn12  WHERE oc = $cislo_oc ";
//echo $dsqlt;
$dsql = mysql_query("$dsqlt");

$dsqlt = "INSERT INTO F$kli_vxcf"."_uctprcvykazx".$kli_uzid." ".
" SELECT * FROM F$kli_vxcf"."_uctprcvykaz".$kli_uzid." WHERE oc = $cislo_oc ";
//echo $dsqlt;
$dsql = mysql_query("$dsqlt");


/////////////////////////////////koniec naCITAJ HODNOTY

//uloz 
$sqtoz = "DELETE FROM F$kli_vxcf"."_uctvykaz_fin204pod WHERE oc = $cislo_oc";
$oznac = mysql_query("$sqtoz");


$dsqlt = "INSERT INTO F$kli_vxcf"."_uctvykaz_fin204pod".
" SELECT * FROM F$kli_vxcf"."_uctprcvykazx".$kli_uzid." WHERE oc = $cislo_oc AND prx = 1 ".
" GROUP BY oc".
"";
//echo $dsqlt;
$dsql = mysql_query("$dsqlt");

  if ( $nasielvyplnene == 1 )
  {
$sqtoz = "UPDATE F$kli_vxcf"."_uctvykaz_fin204pod SET okres='$xokres',  obec='$xobec'  WHERE oc = $cislo_oc ";
//echo $sqtoz;
$oznac = mysql_query("$sqtoz");

  }


}
//koniec pracovneho suboru pre rocne 

//vypocty
if( $copern == 10 OR $copern == 20 )
{

//vypocitaj riadky strana 2
$vsldat="uctprcvykaz";
$sqtoz = "UPDATE F$kli_vxcf"."_uctvykaz_fin204pod SET ".
"r01=r02+r03+r05, ".
"r06=r07+r08+r04+r09+r10+r11+r13+r14+r15+r16, ".
"r17=r18+r19+r20+r21+r22, ".
"r24=r25+r26+r27+r28+r29+r30+r31+r32+r33+r34+r35, ".
"r36=r37+r38+r39+r40+r41, ". 

"rk01=rk02+rk03+rk05, ".
"rk06=rk07+rk08+rk04+rk09+rk10+rk11+rk13+rk14+rk15+rk16, ".
"rk17=rk18+rk19+rk20+rk21+rk22, ".
"rk24=rk25+rk26+rk27+rk28+rk29+rk30+rk31+rk32+rk33+rk34+rk35, ".
"rk36=rk37+rk38+rk39+rk40+rk41, ".

"rn01=rn02+rn03+rn05, ".
"rn06=rn07+rn08+rn04+rn09+rn10+rn11+rn13+rn14+rn15+rn16, ".
"rn17=rn18+rn19+rn20+rn21+rn22, ".
"rn24=rn25+rn26+rn27+rn28+rn29+rn30+rn31+rn32+rn33+rn34+rn35, ".
"rn36=rn37+rn38+rn39+rn40+rn41, ".

"rm01=rm02+rm03+rm05, ".
"rm06=rm07+rm08+rm04+rm09+rm10+rm11+rm13+rm14+rm15+rm16, ".
"rm17=rm18+rm19+rm20+rm21+rm22, ".
"rm24=rm25+rm26+rm27+rm28+rm29+rm30+rm31+rm32+rm33+rm34+rm35, ".
"rm36=rm37+rm38+rm39+rm40+rm41 ".

" WHERE oc = $cislo_oc ";
$oznac = mysql_query("$sqtoz");

$sqtoz = "UPDATE F$kli_vxcf"."_uctvykaz_fin204pod SET ".
"r43=r01+r06+r17+r23+r24+r36+r42, ".
"rk43=rk01+rk06+rk17+rk23+rk24+rk36+rk42, ".
"rn43=rn01+rn06+rn17+rn23+rn24+rn36+rn42, ".
"rm43=rm01+rm06+rm17+rm23+rm24+rm36+rm42  ".
" WHERE oc = $cislo_oc ";
$oznac = mysql_query("$sqtoz");

//vypocitaj riadky strana 3
$vsldat="uctprcvykaz";
$sqtoz = "UPDATE F$kli_vxcf"."_uctvykaz_fin204pod SET ".
"r45=r46+r47+r48+r49+r50+r53+r56+r59+r60+r61+r62+r63+r64+r65, ".
"r68=r69+r70+r71+r72, ".

"rm45=rm46+rm47+rm48+rm49+rm50+rm53+rm56+rm59+rm60+rm61+rm62+rm63+rm64+rm65, ".
"rm68=rm69+rm70+rm71+rm72  ".

" WHERE oc = $cislo_oc ";
$oznac = mysql_query("$sqtoz");

$vsldat="uctprcvykaz";
$sqtoz = "UPDATE F$kli_vxcf"."_uctvykaz_fin204pod SET ".
"r74=r44+r45+r68+r73, ".

"rm74=rm44+rm45+rm68+rm73  ".

" WHERE oc = $cislo_oc ";
$oznac = mysql_query("$sqtoz");


$sqtoz = "UPDATE F$kli_vxcf"."_uctvykaz_fin204pod SET ".
" r51=r50-r52, r54=r53-r55, r57=r56-r58, r66=r65-r67  ".

" WHERE oc = $cislo_oc ";
$oznac = mysql_query("$sqtoz");

}
//koniec vypocty

/////////////NACITANIE UDAJOV Z PARAMETROV
$sqldok = mysql_query("SELECT * FROM F$kli_vxcf"."_mzdprm");
  if (@$zaznam=mysql_data_seek($sqldok,0))
  {
  $riaddok=mysql_fetch_object($sqldok);
  $cicz=$riaddok->cicz;
  }

/////////////////////////////////////////////////VYTLAC ROCNE
if( $copern == 10 )
{


if (File_Exists ("../tmp/vykazfin.$kli_uzid.pdf")) { $soubor = unlink("../tmp/vykazfin.$kli_uzid.pdf"); }

   define('FPDF_FONTPATH','../fpdf/font/');
   require('../fpdf/fpdf.php');


$sirka_vyska="210,320";
$velkost_strany = explode(",", $sirka_vyska);

$pdf=new FPDF("P","mm", $velkost_strany );
$pdf->Open();
$pdf->AddFont('arial','','arial.php');


//vytlac
$sqltt = "SELECT * FROM F$kli_vxcf"."_uctvykaz_fin204pod".
" WHERE F$kli_vxcf"."_uctvykaz_fin204pod.oc = $cislo_oc  ORDER BY oc";


$sql = mysql_query("$sqltt");
$pol = mysql_num_rows($sql);

$i=0;
$j=0; //zaciatok strany ak by som chcel strankovat
  while ($i <= $pol )
  {

  if (@$zaznam=mysql_data_seek($sql,$i))
{
$hlavicka=mysql_fetch_object($sql);

  $ozam_np = $hlavicka->ozam_np;
  $pole = explode(".", $ozam_np);
  $Cozam_np = $pole[0];
  $Dozam_np = substr($pole[1],0,1);

$dat_dat = Date ("d.m.Y", MkTime (date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))); 
$dat_dat = SkDatum($hlavicka->da21 );
if( $dat_dat == '0000-00-00' ) $dat_dat="";

if ( $strana == 1 OR $strana == 9999 )    {

$pdf->AddPage();
$pdf->SetLeftMargin(8); 
$pdf->SetTopMargin(10);

if (File_Exists ('../dokumenty/vykazy_nujfin2015/fin204pod/fin204pod_str1.jpg') )
{
$pdf->Image('../dokumenty/vykazy_nujfin2015/fin204pod/fin204pod_str1.jpg',0,0,211,295); 
}

$pdf->SetY(10);
$pdf->SetFont('arial','',10);

//obdobie k
$pdf->Cell(195,63,"                          ","$rmc",1,"L");
$text=$datum;
$textx="14.01.2010";
$t01=substr($text,0,1);

$pdf->Cell(78,6," ","$rmc",0,"R");$pdf->Cell(41,6,"$text","$rmc",1,"C");


//i�o
$pdf->Cell(195,34,"                          ","$rmc",1,"L");
$text=$fir_fico;
$textx="12345678";
$t01=substr($text,0,1);
$t02=substr($text,1,1);
$t03=substr($text,2,1);
$t04=substr($text,3,1);
$t05=substr($text,4,1);
$t06=substr($text,5,1);
$t07=substr($text,6,1);
$t08=substr($text,7,1);

$pdf->Cell(1,5," ","$rmc",0,"R");
$pdf->Cell(6,5,"$t01","$rmc",0,"C");$pdf->Cell(6,5,"$t02","$rmc",0,"C");$pdf->Cell(6,5,"$t03","$rmc",0,"C");$pdf->Cell(6,5,"$t04","$rmc",0,"C");
$pdf->Cell(6,5,"$t05","$rmc",0,"C");$pdf->Cell(6,5,"$t06","$rmc",0,"C");$pdf->Cell(6,5,"$t07","$rmc",0,"C");$pdf->Cell(6,5,"$t08","$rmc",0,"C");
$pdf->Cell(6,5," ","$rmc",0,"C");


//mesiac
$text=$mesiac;
$textx="12345678";
$t01=substr($text,0,1);
$t02=substr($text,1,1);

$pdf->Cell(6,5,"$t01","$rmc",0,"C");$pdf->Cell(6,5,"$t02","$rmc",0,"C");$pdf->Cell(6,5," ","$rmc",0,"C");


//rok
$text=$kli_vrok;
$textx="1234";
$t01=substr($text,0,1);
$t02=substr($text,1,1);
$t03=substr($text,2,1);
$t04=substr($text,3,1);

$pdf->Cell(6,5,"$t01","$rmc",0,"C");$pdf->Cell(6,5,"$t02","$rmc",0,"C");$pdf->Cell(6,5,"$t03","$rmc",0,"C");$pdf->Cell(6,5,"$t04","$rmc",0,"C");
$pdf->Cell(7,5," ","$rmc",0,"C");


//kod okresu
$text=$hlavicka->okres;
$textx="123";
$t01=substr($text,0,1);
$t02=substr($text,1,1);
$t03=substr($text,2,1);

$pdf->Cell(6,5,"$t01","$rmc",0,"C");$pdf->Cell(6,5,"$t02","$rmc",0,"C");$pdf->Cell(6,5,"$t03","$rmc",0,"C");$pdf->Cell(24,5," ","$rmc",0,"C");


//kod obce
$text=$hlavicka->obec;
$textx="123456";
$t01=substr($text,0,1);
$t02=substr($text,1,1);
$t03=substr($text,2,1);
$t04=substr($text,3,1);
$t05=substr($text,4,1);
$t06=substr($text,5,1);

$pdf->Cell(6,5,"$t01","$rmc",0,"C");$pdf->Cell(6,5,"$t02","$rmc",0,"C");$pdf->Cell(6,5,"$t03","$rmc",0,"C");$pdf->Cell(6,5,"$t04","$rmc",0,"C");
$pdf->Cell(6,5,"$t05","$rmc",0,"C");$pdf->Cell(6,5,"$t06","$rmc",1,"C");


//nazov subj. VS
$pdf->Cell(195,14,"                          ","$rmc",1,"L");
$text=$fir_fnaz;
$textx="0123456789abcdefghijklmnoprstuv";
$t01=substr($text,0,1);
$t02=substr($text,1,1);
$t03=substr($text,2,1);
$t04=substr($text,3,1);
$t05=substr($text,4,1);
$t06=substr($text,5,1);
$t07=substr($text,6,1);
$t08=substr($text,7,1);
$t09=substr($text,8,1);
$t10=substr($text,9,1);
$t11=substr($text,10,1);
$t12=substr($text,11,1);
$t13=substr($text,12,1);
$t14=substr($text,13,1);
$t15=substr($text,14,1);
$t16=substr($text,15,1);
$t17=substr($text,16,1);
$t18=substr($text,17,1);
$t19=substr($text,18,1);
$t20=substr($text,19,1);
$t21=substr($text,20,1);
$t22=substr($text,21,1);
$t23=substr($text,22,1);
$t24=substr($text,23,1);
$t25=substr($text,24,1);
$t26=substr($text,25,1);
$t27=substr($text,26,1);
$t28=substr($text,27,1);
$t29=substr($text,28,1);
$t30=substr($text,29,1);
$t31=substr($text,30,1);

$pdf->Cell(1,5," ","$rmc",0,"C");
$pdf->Cell(6,5,"$t01","$rmc",0,"C");$pdf->Cell(6,5,"$t02","$rmc",0,"C");$pdf->Cell(6,5,"$t03","$rmc",0,"C");$pdf->Cell(6,5,"$t04","$rmc",0,"C");
$pdf->Cell(6,5,"$t05","$rmc",0,"C");$pdf->Cell(6,5,"$t06","$rmc",0,"C");$pdf->Cell(6,5,"$t07","$rmc",0,"C");$pdf->Cell(6,5,"$t08","$rmc",0,"C");
$pdf->Cell(6,5,"$t09","$rmc",0,"C");$pdf->Cell(6,5,"$t10","$rmc",0,"C");$pdf->Cell(6,5,"$t11","$rmc",0,"C");$pdf->Cell(6,5,"$t12","$rmc",0,"C");
$pdf->Cell(6,5,"$t13","$rmc",0,"C");$pdf->Cell(6,5,"$t14","$rmc",0,"C");$pdf->Cell(6,5,"$t15","$rmc",0,"C");$pdf->Cell(6,5,"$t16","$rmc",0,"C");
$pdf->Cell(6,5,"$t17","$rmc",0,"C");$pdf->Cell(6,5,"$t18","$rmc",0,"C");$pdf->Cell(6,5,"$t19","$rmc",0,"C");$pdf->Cell(6,5,"$t20","$rmc",0,"C");
$pdf->Cell(6,5,"$t21","$rmc",0,"C");$pdf->Cell(6,5,"$t22","$rmc",0,"C");$pdf->Cell(7,5,"$t23","$rmc",0,"C");$pdf->Cell(6,5,"$t24","$rmc",0,"C");
$pdf->Cell(6,5,"$t25","$rmc",0,"C");$pdf->Cell(6,5,"$t26","$rmc",0,"C");$pdf->Cell(6,5,"$t27","$rmc",0,"C");$pdf->Cell(6,5,"$t28","$rmc",0,"C");
$pdf->Cell(6,5,"$t29","$rmc",0,"C");$pdf->Cell(6,5,"$t30","$rmc",0,"C");$pdf->Cell(6,5,"$t31","$rmc",1,"C");

//nazov subj. VS 2
$pdf->Cell(195,1,"                          ","$rmc",1,"L");
$text=substr($fir_fnaz,31,30);;
$textx="0123456789abcdefghijklmnoprstuv";
$t01=substr($text,0,1);
$t02=substr($text,1,1);
$t03=substr($text,2,1);
$t04=substr($text,3,1);
$t05=substr($text,4,1);
$t06=substr($text,5,1);
$t07=substr($text,6,1);
$t08=substr($text,7,1);
$t09=substr($text,8,1);
$t10=substr($text,9,1);
$t11=substr($text,10,1);
$t12=substr($text,11,1);
$t13=substr($text,12,1);
$t14=substr($text,13,1);
$t15=substr($text,14,1);
$t16=substr($text,15,1);
$t17=substr($text,16,1);
$t18=substr($text,17,1);
$t19=substr($text,18,1);
$t20=substr($text,19,1);
$t21=substr($text,20,1);
$t22=substr($text,21,1);
$t23=substr($text,22,1);
$t24=substr($text,23,1);
$t25=substr($text,24,1);
$t26=substr($text,25,1);
$t27=substr($text,26,1);
$t28=substr($text,27,1);
$t29=substr($text,28,1);
$t30=substr($text,29,1);
$t31=substr($text,30,1);

$pdf->Cell(1,5," ","$rmc",0,"C");
$pdf->Cell(6,5,"$t01","$rmc",0,"C");$pdf->Cell(6,5,"$t02","$rmc",0,"C");$pdf->Cell(6,5,"$t03","$rmc",0,"C");$pdf->Cell(6,5,"$t04","$rmc",0,"C");
$pdf->Cell(6,5,"$t05","$rmc",0,"C");$pdf->Cell(6,5,"$t06","$rmc",0,"C");$pdf->Cell(6,5,"$t07","$rmc",0,"C");$pdf->Cell(6,5,"$t08","$rmc",0,"C");
$pdf->Cell(6,5,"$t09","$rmc",0,"C");$pdf->Cell(6,5,"$t10","$rmc",0,"C");$pdf->Cell(6,5,"$t11","$rmc",0,"C");$pdf->Cell(6,5,"$t12","$rmc",0,"C");
$pdf->Cell(6,5,"$t13","$rmc",0,"C");$pdf->Cell(6,5,"$t14","$rmc",0,"C");$pdf->Cell(6,5,"$t15","$rmc",0,"C");$pdf->Cell(6,5,"$t16","$rmc",0,"C");
$pdf->Cell(6,5,"$t17","$rmc",0,"C");$pdf->Cell(6,5,"$t18","$rmc",0,"C");$pdf->Cell(6,5,"$t19","$rmc",0,"C");$pdf->Cell(6,5,"$t20","$rmc",0,"C");
$pdf->Cell(6,5,"$t21","$rmc",0,"C");$pdf->Cell(6,5,"$t22","$rmc",0,"C");$pdf->Cell(7,5,"$t23","$rmc",0,"C");$pdf->Cell(6,5,"$t24","$rmc",0,"C");
$pdf->Cell(6,5,"$t25","$rmc",0,"C");$pdf->Cell(6,5,"$t26","$rmc",0,"C");$pdf->Cell(6,5,"$t27","$rmc",0,"C");$pdf->Cell(6,5,"$t28","$rmc",0,"C");
$pdf->Cell(6,5,"$t29","$rmc",0,"C");$pdf->Cell(6,5,"$t30","$rmc",0,"C");$pdf->Cell(6,5,"$t31","$rmc",1,"C");


//pravna forma subj. VS
$pdf->Cell(195,15,"                          ","$rmc",1,"L");
$text=$fir_uctt02;
$textx="0123456789abcdefghijklmnoprstuv";
$t01=substr($text,0,1);
$t02=substr($text,1,1);
$t03=substr($text,2,1);
$t04=substr($text,3,1);
$t05=substr($text,4,1);
$t06=substr($text,5,1);
$t07=substr($text,6,1);
$t08=substr($text,7,1);
$t09=substr($text,8,1);
$t10=substr($text,9,1);
$t11=substr($text,10,1);
$t12=substr($text,11,1);
$t13=substr($text,12,1);
$t14=substr($text,13,1);
$t15=substr($text,14,1);
$t16=substr($text,15,1);
$t17=substr($text,16,1);
$t18=substr($text,17,1);
$t19=substr($text,18,1);
$t20=substr($text,19,1);
$t21=substr($text,20,1);
$t22=substr($text,21,1);
$t23=substr($text,22,1);
$t24=substr($text,23,1);
$t25=substr($text,24,1);
$t26=substr($text,25,1);
$t27=substr($text,26,1);
$t28=substr($text,27,1);
$t29=substr($text,28,1);
$t30=substr($text,29,1);
$t31=substr($text,30,1);

$pdf->Cell(1,5," ","$rmc",0,"C");
$pdf->Cell(6,5,"$t01","$rmc",0,"C");$pdf->Cell(6,5,"$t02","$rmc",0,"C");$pdf->Cell(6,5,"$t03","$rmc",0,"C");$pdf->Cell(6,5,"$t04","$rmc",0,"C");
$pdf->Cell(6,5,"$t05","$rmc",0,"C");$pdf->Cell(6,5,"$t06","$rmc",0,"C");$pdf->Cell(6,5,"$t07","$rmc",0,"C");$pdf->Cell(6,5,"$t08","$rmc",0,"C");
$pdf->Cell(6,5,"$t09","$rmc",0,"C");$pdf->Cell(6,5,"$t10","$rmc",0,"C");$pdf->Cell(6,5,"$t11","$rmc",0,"C");$pdf->Cell(6,5,"$t12","$rmc",0,"C");
$pdf->Cell(6,5,"$t13","$rmc",0,"C");$pdf->Cell(6,5,"$t14","$rmc",0,"C");$pdf->Cell(6,5,"$t15","$rmc",0,"C");$pdf->Cell(6,5,"$t16","$rmc",0,"C");
$pdf->Cell(6,5,"$t17","$rmc",0,"C");$pdf->Cell(6,5,"$t18","$rmc",0,"C");$pdf->Cell(6,5,"$t19","$rmc",0,"C");$pdf->Cell(6,5,"$t20","$rmc",0,"C");
$pdf->Cell(6,5,"$t21","$rmc",0,"C");$pdf->Cell(6,5,"$t22","$rmc",0,"C");$pdf->Cell(7,5,"$t23","$rmc",0,"C");$pdf->Cell(6,5,"$t24","$rmc",0,"C");
$pdf->Cell(6,5,"$t25","$rmc",0,"C");$pdf->Cell(6,5,"$t26","$rmc",0,"C");$pdf->Cell(6,5,"$t27","$rmc",0,"C");$pdf->Cell(6,5,"$t28","$rmc",0,"C");
$pdf->Cell(6,5,"$t29","$rmc",0,"C");$pdf->Cell(6,5,"$t30","$rmc",0,"C");$pdf->Cell(6,5,"$t31","$rmc",1,"C");


//ulica a cislo
$pdf->Cell(195,20,"                          ","$rmc",1,"L");
$text=$fir_fuli." ".$fir_fcdm;
$textx="0123456789abcdefghijklmnoprstuv";
$t01=substr($text,0,1);
$t02=substr($text,1,1);
$t03=substr($text,2,1);
$t04=substr($text,3,1);
$t05=substr($text,4,1);
$t06=substr($text,5,1);
$t07=substr($text,6,1);
$t08=substr($text,7,1);
$t09=substr($text,8,1);
$t10=substr($text,9,1);
$t11=substr($text,10,1);
$t12=substr($text,11,1);
$t13=substr($text,12,1);
$t14=substr($text,13,1);
$t15=substr($text,14,1);
$t16=substr($text,15,1);
$t17=substr($text,16,1);
$t18=substr($text,17,1);
$t19=substr($text,18,1);
$t20=substr($text,19,1);
$t21=substr($text,20,1);
$t22=substr($text,21,1);
$t23=substr($text,22,1);
$t24=substr($text,23,1);
$t25=substr($text,24,1);
$t26=substr($text,25,1);
$t27=substr($text,26,1);
$t28=substr($text,27,1);
$t29=substr($text,28,1);
$t30=substr($text,29,1);
$t31=substr($text,30,1);

$pdf->Cell(1,5," ","$rmc",0,"C");
$pdf->Cell(6,5,"$t01","$rmc",0,"C");$pdf->Cell(6,5,"$t02","$rmc",0,"C");$pdf->Cell(6,5,"$t03","$rmc",0,"C");$pdf->Cell(6,5,"$t04","$rmc",0,"C");
$pdf->Cell(6,5,"$t05","$rmc",0,"C");$pdf->Cell(6,5,"$t06","$rmc",0,"C");$pdf->Cell(6,5,"$t07","$rmc",0,"C");$pdf->Cell(6,5,"$t08","$rmc",0,"C");
$pdf->Cell(6,5,"$t09","$rmc",0,"C");$pdf->Cell(6,5,"$t10","$rmc",0,"C");$pdf->Cell(6,5,"$t11","$rmc",0,"C");$pdf->Cell(6,5,"$t12","$rmc",0,"C");
$pdf->Cell(6,5,"$t13","$rmc",0,"C");$pdf->Cell(6,5,"$t14","$rmc",0,"C");$pdf->Cell(6,5,"$t15","$rmc",0,"C");$pdf->Cell(6,5,"$t16","$rmc",0,"C");
$pdf->Cell(6,5,"$t17","$rmc",0,"C");$pdf->Cell(6,5,"$t18","$rmc",0,"C");$pdf->Cell(6,5,"$t19","$rmc",0,"C");$pdf->Cell(6,5,"$t20","$rmc",0,"C");
$pdf->Cell(6,5,"$t21","$rmc",0,"C");$pdf->Cell(6,5,"$t22","$rmc",0,"C");$pdf->Cell(7,5,"$t23","$rmc",0,"C");$pdf->Cell(6,5,"$t24","$rmc",0,"C");
$pdf->Cell(6,5,"$t25","$rmc",0,"C");$pdf->Cell(6,5,"$t26","$rmc",0,"C");$pdf->Cell(6,5,"$t27","$rmc",0,"C");$pdf->Cell(6,5,"$t28","$rmc",0,"C");
$pdf->Cell(6,5,"$t29","$rmc",0,"C");$pdf->Cell(6,5,"$t30","$rmc",0,"C");$pdf->Cell(6,5,"$t31","$rmc",1,"C");


//psc
$pdf->Cell(195,14,"                          ","$rmc",1,"L");
$fir_fpsc=str_replace(" ","",$fir_fpsc);
$text=$fir_fpsc;
$textx="123456";
$t01=substr($text,0,1);
$t02=substr($text,1,1);
$t03=substr($text,2,1);
$t04=substr($text,3,1);
$t05=substr($text,4,1);

$pdf->Cell(1,5," ","$rmc",0,"C");
$pdf->Cell(6,5,"$t01","$rmc",0,"C");$pdf->Cell(6,5,"$t02","$rmc",0,"C");$pdf->Cell(6,5,"$t03","$rmc",0,"C");$pdf->Cell(6,5,"$t04","$rmc",0,"C");
$pdf->Cell(6,5,"$t05","$rmc",0,"C");$pdf->Cell(6,5," ","$rmc",0,"C");


//obec
$text=$fir_fmes;
$textx="123456789abcdefghijklmnov";
$t01=substr($text,0,1);
$t02=substr($text,1,1);
$t03=substr($text,2,1);
$t04=substr($text,3,1);
$t05=substr($text,4,1);
$t06=substr($text,5,1);
$t07=substr($text,6,1);
$t08=substr($text,7,1);
$t09=substr($text,8,1);
$t10=substr($text,9,1);
$t11=substr($text,10,1);
$t12=substr($text,11,1);
$t13=substr($text,12,1);
$t14=substr($text,13,1);
$t15=substr($text,14,1);
$t16=substr($text,15,1);
$t17=substr($text,16,1);
$t18=substr($text,17,1);
$t19=substr($text,18,1);
$t20=substr($text,19,1);
$t21=substr($text,20,1);
$t22=substr($text,21,1);
$t23=substr($text,22,1);
$t24=substr($text,23,1);
$t25=substr($text,24,1);

$pdf->Cell(6,5,"$t01","$rmc",0,"C");$pdf->Cell(6,5,"$t02","$rmc",0,"C");$pdf->Cell(6,5,"$t03","$rmc",0,"C");$pdf->Cell(6,5,"$t04","$rmc",0,"C");
$pdf->Cell(6,5,"$t05","$rmc",0,"C");$pdf->Cell(6,5,"$t06","$rmc",0,"C");$pdf->Cell(6,5,"$t07","$rmc",0,"C");$pdf->Cell(6,5,"$t08","$rmc",0,"C");
$pdf->Cell(6,5,"$t09","$rmc",0,"C");$pdf->Cell(6,5,"$t10","$rmc",0,"C");$pdf->Cell(6,5,"$t11","$rmc",0,"C");$pdf->Cell(6,5,"$t12","$rmc",0,"C");
$pdf->Cell(6,5,"$t13","$rmc",0,"C");$pdf->Cell(6,5,"$t14","$rmc",0,"C");$pdf->Cell(6,5,"$t15","$rmc",0,"C");$pdf->Cell(6,5,"$t16","$rmc",0,"C");
$pdf->Cell(7,5,"$t17","$rmc",0,"C");$pdf->Cell(6,5,"$t18","$rmc",0,"C");$pdf->Cell(6,5,"$t19","$rmc",0,"C");$pdf->Cell(6,5,"$t20","$rmc",0,"C");
$pdf->Cell(6,5,"$t21","$rmc",0,"C");$pdf->Cell(6,5,"$t22","$rmc",0,"C");$pdf->Cell(6,5,"$t23","$rmc",0,"C");$pdf->Cell(6,5,"$t24","$rmc",0,"C");
$pdf->Cell(6,5,"$t25","$rmc",1,"C");


//smerove cislo telefonu
$pdf->Cell(195,14,"                          ","$rmc",1,"L");
$pole = explode("/", $fir_ftel);
$tel_pred=$pole[0];
$tel_za=$pole[1];
$text=$tel_pred;
$textx="01234567";
$t01=substr($text,0,1);
$t02=substr($text,1,1);
$t03=substr($text,2,1);
$t04=substr($text,3,1);
$t05=substr($text,4,1);
$t06=substr($text,5,1);
$t07=substr($text,6,1);
$t08=substr($text,7,1);

$pdf->Cell(1,5," ","$rmc",0,"C");
$pdf->Cell(6,5,"$t01","$rmc",0,"C");$pdf->Cell(6,5,"$t02","$rmc",0,"C");$pdf->Cell(6,5,"$t03","$rmc",0,"C");$pdf->Cell(6,5,"$t04","$rmc",0,"C");
$pdf->Cell(6,5,"$t05","$rmc",0,"C");$pdf->Cell(6,5,"$t06","$rmc",0,"C");$pdf->Cell(6,5,"$t07","$rmc",0,"C");$pdf->Cell(6,5,"$t08","$rmc",0,"C");
$pdf->Cell(6,5," ","$rmc",0,"C");

//cislo telefonu
$text=$tel_za;
$textx="0123456789";
$t01=substr($text,0,1);
$t02=substr($text,1,1);
$t03=substr($text,2,1);
$t04=substr($text,3,1);
$t05=substr($text,4,1);
$t06=substr($text,5,1);
$t07=substr($text,6,1);
$t08=substr($text,7,1);
$t09=substr($text,8,1);
$t10=substr($text,9,1);

$pdf->Cell(6,5,"$t01","$rmc",0,"C");$pdf->Cell(6,5,"$t02","$rmc",0,"C");$pdf->Cell(6,5,"$t03","$rmc",0,"C");$pdf->Cell(6,5,"$t04","$rmc",0,"C");
$pdf->Cell(6,5,"$t05","$rmc",0,"C");$pdf->Cell(6,5,"$t06","$rmc",0,"C");$pdf->Cell(6,5,"$t07","$rmc",0,"C");$pdf->Cell(6,5,"$t08","$rmc",0,"C");
$pdf->Cell(6,5,"$t09","$rmc",0,"C");$pdf->Cell(6,5,"$t10","$rmc",0,"C");
$pdf->Cell(7,5," ","$rmc",0,"C");

//cislo faxu
$pole = explode("/", $fir_ffax);
$tel_pred=$pole[0];
$tel_za=$pole[1];
$text=$tel_za;
$textx="01234567";
$t01=substr($text,0,1);
$t02=substr($text,1,1);
$t03=substr($text,2,1);
$t04=substr($text,3,1);
$t05=substr($text,4,1);
$t06=substr($text,5,1);
$t07=substr($text,6,1);
$t08=substr($text,7,1);
$t09=substr($text,8,1);
$t10=substr($text,9,1);
$t11=substr($text,10,1);

$pdf->Cell(6,5,"$t01","$rmc",0,"C");$pdf->Cell(6,5,"$t02","$rmc",0,"C");$pdf->Cell(6,5,"$t03","$rmc",0,"C");$pdf->Cell(6,5,"$t04","$rmc",0,"C");
$pdf->Cell(6,5,"$t05","$rmc",0,"C");$pdf->Cell(6,5,"$t06","$rmc",0,"C");$pdf->Cell(6,5,"$t07","$rmc",0,"C");$pdf->Cell(6,5,"$t08","$rmc",0,"C");
$pdf->Cell(6,5,"$t09","$rmc",0,"C");$pdf->Cell(6,5,"$t10","$rmc",0,"C");$pdf->Cell(6,5,"$t11","$rmc",1,"C");


//email
$pdf->Cell(195,14,"                          ","$rmc",1,"L");
$text=$fir_fem1;
$textx="0123456789abcdefghijklmnoprstuv";
$t01=substr($text,0,1);
$t02=substr($text,1,1);
$t03=substr($text,2,1);
$t04=substr($text,3,1);
$t05=substr($text,4,1);
$t06=substr($text,5,1);
$t07=substr($text,6,1);
$t08=substr($text,7,1);
$t09=substr($text,8,1);
$t10=substr($text,9,1);
$t11=substr($text,10,1);
$t12=substr($text,11,1);
$t13=substr($text,12,1);
$t14=substr($text,13,1);
$t15=substr($text,14,1);
$t16=substr($text,15,1);
$t17=substr($text,16,1);
$t18=substr($text,17,1);
$t19=substr($text,18,1);
$t20=substr($text,19,1);
$t21=substr($text,20,1);
$t22=substr($text,21,1);
$t23=substr($text,22,1);
$t24=substr($text,23,1);
$t25=substr($text,24,1);
$t26=substr($text,25,1);
$t27=substr($text,26,1);
$t28=substr($text,27,1);
$t29=substr($text,28,1);
$t30=substr($text,29,1);
$t31=substr($text,30,1);

$pdf->Cell(1,5," ","$rmc",0,"C");
$pdf->Cell(6,5,"$t01","$rmc",0,"C");$pdf->Cell(6,5,"$t02","$rmc",0,"C");$pdf->Cell(6,5,"$t03","$rmc",0,"C");$pdf->Cell(6,5,"$t04","$rmc",0,"C");
$pdf->Cell(6,5,"$t05","$rmc",0,"C");$pdf->Cell(6,5,"$t06","$rmc",0,"C");$pdf->Cell(6,5,"$t07","$rmc",0,"C");$pdf->Cell(6,5,"$t08","$rmc",0,"C");
$pdf->Cell(6,5,"$t09","$rmc",0,"C");$pdf->Cell(6,5,"$t10","$rmc",0,"C");$pdf->Cell(6,5,"$t11","$rmc",0,"C");$pdf->Cell(6,5,"$t12","$rmc",0,"C");
$pdf->Cell(6,5,"$t13","$rmc",0,"C");$pdf->Cell(6,5,"$t14","$rmc",0,"C");$pdf->Cell(6,5,"$t15","$rmc",0,"C");$pdf->Cell(6,5,"$t16","$rmc",0,"C");
$pdf->Cell(6,5,"$t17","$rmc",0,"C");$pdf->Cell(6,5,"$t18","$rmc",0,"C");$pdf->Cell(6,5,"$t19","$rmc",0,"C");$pdf->Cell(6,5,"$t20","$rmc",0,"C");
$pdf->Cell(6,5,"$t21","$rmc",0,"C");$pdf->Cell(6,5,"$t22","$rmc",0,"C");$pdf->Cell(7,5,"$t23","$rmc",0,"C");$pdf->Cell(6,5,"$t24","$rmc",0,"C");
$pdf->Cell(6,5,"$t25","$rmc",0,"C");$pdf->Cell(6,5,"$t26","$rmc",0,"C");$pdf->Cell(6,5,"$t27","$rmc",0,"C");$pdf->Cell(6,5,"$t28","$rmc",0,"C");
$pdf->Cell(6,5,"$t29","$rmc",0,"C");$pdf->Cell(6,5,"$t30","$rmc",0,"C");$pdf->Cell(6,5,"$t31","$rmc",1,"C");


//datum zostavenia
$pdf->Cell(195,21,"                          ","$rmc",1,"L");
$daz= SkDatum($hlavicka->daz);
if( $daz == '00.00.0000' ) $daz="";

$pdf->Cell(1,6," ","$rmc",0,"C");$pdf->Cell(48,6,"$daz","$rmc",1,"C");

                                          }

if ( $strana == 2 OR $strana == 9999 )    {

//strana 2
$pdf->AddPage();
$pdf->SetLeftMargin(8); 
$pdf->SetTopMargin(10);

if (File_Exists ('../dokumenty/vykazy_nujfin2015/fin204pod/fin204pod_str2.jpg') )
{
$pdf->Image('../dokumenty/vykazy_nujfin2015/fin204pod/fin204pod_str2.jpg',5,5,200,297); 
}

$pdf->SetFont('arial','',7);

//zostatok k
$skutku=substr($datum,0,6);
$textx="14.01.2010";
$pdf->SetY(26);

$pdf->Cell(135,3," ","$rmc",0,"R");$pdf->Cell(12,4,"$skutku","$rmc",1,"C");


//VYBRANE AKTIVA 
$pdf->Cell(195,23,"                          ","$rmc",1,"L");

$r01=$hlavicka->r01;
if( $hlavicka->r01 == 0 ) $r01="";
$r02=$hlavicka->r02;
if( $hlavicka->r02 == 0 ) $r02="";
$r03=$hlavicka->r03;
if( $hlavicka->r03 == 0 ) $r03="";
$r04=$hlavicka->r04;
if( $hlavicka->r04 == 0 ) $r04="";
$r05=$hlavicka->r05;
if( $hlavicka->r05 == 0 ) $r05="";
$r06=$hlavicka->r06;
if( $hlavicka->r06 == 0 ) $r06="";
$r07=$hlavicka->r07;
if( $hlavicka->r07 == 0 ) $r07="";
$r08=$hlavicka->r08;
if( $hlavicka->r08 == 0 ) $r08="";
$r09=$hlavicka->r09;
if( $hlavicka->r09 == 0 ) $r09="";
$r10=$hlavicka->r10;
if( $hlavicka->r10 == 0 ) $r10="";
$r11=$hlavicka->r11;
if( $hlavicka->r11 == 0 ) $r11="";
$r12=$hlavicka->r12;
if( $hlavicka->r12 == 0 ) $r12="";
$r13=$hlavicka->r13;
if( $hlavicka->r13 == 0 ) $r13="";
$r14=$hlavicka->r14;
if( $hlavicka->r14 == 0 ) $r14="";
$r15=$hlavicka->r15;
if( $hlavicka->r15 == 0 ) $r15="";
$r16=$hlavicka->r16;
if( $hlavicka->r16 == 0 ) $r16="";
$r17=$hlavicka->r17;
if( $hlavicka->r17 == 0 ) $r17="";
$r18=$hlavicka->r18;
if( $hlavicka->r18 == 0 ) $r18="";
$r19=$hlavicka->r19;
if( $hlavicka->r19 == 0 ) $r19="";
$r20=$hlavicka->r20;
if( $hlavicka->r20 == 0 ) $r20="";
$r21=$hlavicka->r21;
if( $hlavicka->r21 == 0 ) $r21="";

$rk01=$hlavicka->rk01;
if( $hlavicka->rk01 == 0 ) $rk01="";
$rk02=$hlavicka->rk02;
if( $hlavicka->rk02 == 0 ) $rk02="";
$rk03=$hlavicka->rk03;
if( $hlavicka->rk03 == 0 ) $rk03="";
$rk04=$hlavicka->rk04;
if( $hlavicka->rk04 == 0 ) $rk04="";
$rk05=$hlavicka->rk05;
if( $hlavicka->rk05 == 0 ) $rk05="";
$rk06=$hlavicka->rk06;
if( $hlavicka->rk06 == 0 ) $rk06="";
$rk07=$hlavicka->rk07;
if( $hlavicka->rk07 == 0 ) $rk07="";
$rk08=$hlavicka->rk08;
if( $hlavicka->rk08 == 0 ) $rk08="";
$rk09=$hlavicka->rk09;
if( $hlavicka->rk09 == 0 ) $rk09="";
$rk10=$hlavicka->rk10;
if( $hlavicka->rk10 == 0 ) $rk10="";
$rk11=$hlavicka->rk11;
if( $hlavicka->rk11 == 0 ) $rk11="";
$rk12=$hlavicka->rk12;
if( $hlavicka->rk12 == 0 ) $rk12="";
$rk13=$hlavicka->rk13;
if( $hlavicka->rk13 == 0 ) $rk13="";
$rk14=$hlavicka->rk14;
if( $hlavicka->rk14 == 0 ) $rk14="";
$rk15=$hlavicka->rk15;
if( $hlavicka->rk15 == 0 ) $rk15="";
$rk16=$hlavicka->rk16;
if( $hlavicka->rk16 == 0 ) $rk16="";
$rk17=$hlavicka->rk17;
if( $hlavicka->rk17 == 0 ) $rk17="";
$rk18=$hlavicka->rk18;
if( $hlavicka->rk18 == 0 ) $rk18="";
$rk19=$hlavicka->rk19;
if( $hlavicka->rk19 == 0 ) $rk19="";
$rk20=$hlavicka->rk20;
if( $hlavicka->rk20 == 0 ) $rk20="";
$rk21=$hlavicka->rk21;
if( $hlavicka->rk21 == 0 ) $rk21="";

$rn01=$hlavicka->rn01;
if( $hlavicka->rn01 == 0 ) $rn01="";
$rn02=$hlavicka->rn02;
if( $hlavicka->rn02 == 0 ) $rn02="";
$rn03=$hlavicka->rn03;
if( $hlavicka->rn03 == 0 ) $rn03="";
$rn04=$hlavicka->rn04;
if( $hlavicka->rn04 == 0 ) $rn04="";
$rn05=$hlavicka->rn05;
if( $hlavicka->rn05 == 0 ) $rn05="";
$rn06=$hlavicka->rn06;
if( $hlavicka->rn06 == 0 ) $rn06="";
$rn07=$hlavicka->rn07;
if( $hlavicka->rn07 == 0 ) $rn07="";
$rn08=$hlavicka->rn08;
if( $hlavicka->rn08 == 0 ) $rn08="";
$rn09=$hlavicka->rn09;
if( $hlavicka->rn09 == 0 ) $rn09="";
$rn10=$hlavicka->rn10;
if( $hlavicka->rn10 == 0 ) $rn10="";
$rn11=$hlavicka->rn11;
if( $hlavicka->rn11 == 0 ) $rn11="";
$rn12=$hlavicka->rn12;
if( $hlavicka->rn12 == 0 ) $rn12="";
$rn13=$hlavicka->rn13;
if( $hlavicka->rn13 == 0 ) $rn13="";
$rn14=$hlavicka->rn14;
if( $hlavicka->rn14 == 0 ) $rn14="";
$rn15=$hlavicka->rn15;
if( $hlavicka->rn15 == 0 ) $rn15="";
$rn16=$hlavicka->rn16;
if( $hlavicka->rn16 == 0 ) $rn16="";
$rn17=$hlavicka->rn17;
if( $hlavicka->rn17 == 0 ) $rn17="";
$rn18=$hlavicka->rn18;
if( $hlavicka->rn18 == 0 ) $rn18="";
$rn19=$hlavicka->rn19;
if( $hlavicka->rn19 == 0 ) $rn19="";
$rn20=$hlavicka->rn20;
if( $hlavicka->rn20 == 0 ) $rn20="";
$rn21=$hlavicka->rn21;
if( $hlavicka->rn21 == 0 ) $rn21="";

$rm01=$hlavicka->rm01;
if( $hlavicka->rm01 == 0 ) $rm01="";
$rm02=$hlavicka->rm02;
if( $hlavicka->rm02 == 0 ) $rm02="";
$rm03=$hlavicka->rm03;
if( $hlavicka->rm03 == 0 ) $rm03="";
$rm04=$hlavicka->rm04;
if( $hlavicka->rm04 == 0 ) $rm04="";
$rm05=$hlavicka->rm05;
if( $hlavicka->rm05 == 0 ) $rm05="";
$rm06=$hlavicka->rm06;
if( $hlavicka->rm06 == 0 ) $rm06="";
$rm07=$hlavicka->rm07;
if( $hlavicka->rm07 == 0 ) $rm07="";
$rm08=$hlavicka->rm08;
if( $hlavicka->rm08 == 0 ) $rm08="";
$rm09=$hlavicka->rm09;
if( $hlavicka->rm09 == 0 ) $rm09="";
$rm10=$hlavicka->rm10;
if( $hlavicka->rm10 == 0 ) $rm10="";
$rm11=$hlavicka->rm11;
if( $hlavicka->rm11 == 0 ) $rm11="";
$rm12=$hlavicka->rm12;
if( $hlavicka->rm12 == 0 ) $rm12="";
$rm13=$hlavicka->rm13;
if( $hlavicka->rm13 == 0 ) $rm13="";
$rm14=$hlavicka->rm14;
if( $hlavicka->rm14 == 0 ) $rm14="";
$rm15=$hlavicka->rm15;
if( $hlavicka->rm15 == 0 ) $rm15="";
$rm16=$hlavicka->rm16;
if( $hlavicka->rm16 == 0 ) $rm16="";
$rm17=$hlavicka->rm17;
if( $hlavicka->rm17 == 0 ) $rm17="";
$rm18=$hlavicka->rm18;
if( $hlavicka->rm18 == 0 ) $rm18="";
$rm19=$hlavicka->rm19;
if( $hlavicka->rm19 == 0 ) $rm19="";
$rm20=$hlavicka->rm20;
if( $hlavicka->rm20 == 0 ) $rm20="";
$rm21=$hlavicka->rm21;
if( $hlavicka->rm21 == 0 ) $rm21="";

$r22=$hlavicka->r22;
if( $hlavicka->r22 == 0 ) $r22="";
$r23=$hlavicka->r23;
if( $hlavicka->r23 == 0 ) $r23="";
$r24=$hlavicka->r24;
if( $hlavicka->r24 == 0 ) $r24="";
$r25=$hlavicka->r25;
if( $hlavicka->r25 == 0 ) $r25="";
$r26=$hlavicka->r26;
if( $hlavicka->r26 == 0 ) $r26="";
$r27=$hlavicka->r27;
if( $hlavicka->r27 == 0 ) $r27="";
$r28=$hlavicka->r28;
if( $hlavicka->r28 == 0 ) $r28="";
$r29=$hlavicka->r29;
if( $hlavicka->r29 == 0 ) $r29="";
$r30=$hlavicka->r30;
if( $hlavicka->r30 == 0 ) $r30="";
$r31=$hlavicka->r31;
if( $hlavicka->r31 == 0 ) $r31="";
$r32=$hlavicka->r32;
if( $hlavicka->r32 == 0 ) $r32="";
$r33=$hlavicka->r33;
if( $hlavicka->r33 == 0 ) $r33="";
$r34=$hlavicka->r34;
if( $hlavicka->r34 == 0 ) $r34="";
$r35=$hlavicka->r35;
if( $hlavicka->r35 == 0 ) $r35="";
$r36=$hlavicka->r36;
if( $hlavicka->r36 == 0 ) $r36="";
$r37=$hlavicka->r37;
if( $hlavicka->r37 == 0 ) $r37="";
$r38=$hlavicka->r38;
if( $hlavicka->r38 == 0 ) $r38="";
$r39=$hlavicka->r39;
if( $hlavicka->r39 == 0 ) $r39="";
$r40=$hlavicka->r40;
if( $hlavicka->r40 == 0 ) $r40="";
$r41=$hlavicka->r41;
if( $hlavicka->r41 == 0 ) $r41="";
$r42=$hlavicka->r42;
if( $hlavicka->r42 == 0 ) $r42="";
$r43=$hlavicka->r43;
if( $hlavicka->r43 == 0 ) $r43="";

$rk22=$hlavicka->rk22;
if( $hlavicka->rk22 == 0 ) $rk22="";
$rk23=$hlavicka->rk23;
if( $hlavicka->rk23 == 0 ) $rk23="";
$rk24=$hlavicka->rk24;
if( $hlavicka->rk24 == 0 ) $rk24="";
$rk25=$hlavicka->rk25;
if( $hlavicka->rk25 == 0 ) $rk25="";
$rk26=$hlavicka->rk26;
if( $hlavicka->rk26 == 0 ) $rk26="";
$rk27=$hlavicka->rk27;
if( $hlavicka->rk27 == 0 ) $rk27="";
$rk28=$hlavicka->rk28;
if( $hlavicka->rk28 == 0 ) $rk28="";
$rk29=$hlavicka->rk29;
if( $hlavicka->rk29 == 0 ) $rk29="";
$rk30=$hlavicka->rk30;
if( $hlavicka->rk30 == 0 ) $rk30="";
$rk31=$hlavicka->rk31;
if( $hlavicka->rk31 == 0 ) $rk31="";
$rk32=$hlavicka->rk32;
if( $hlavicka->rk32 == 0 ) $rk32="";
$rk33=$hlavicka->rk33;
if( $hlavicka->rk33 == 0 ) $rk33="";
$rk34=$hlavicka->rk34;
if( $hlavicka->rk34 == 0 ) $rk34="";
$rk35=$hlavicka->rk35;
if( $hlavicka->rk35 == 0 ) $rk35="";
$rk36=$hlavicka->rk36;
if( $hlavicka->rk36 == 0 ) $rk36="";
$rk37=$hlavicka->rk37;
if( $hlavicka->rk37 == 0 ) $rk37="";
$rk38=$hlavicka->rk38;
if( $hlavicka->rk38 == 0 ) $rk38="";
$rk39=$hlavicka->rk39;
if( $hlavicka->rk39 == 0 ) $rk39="";
$rk40=$hlavicka->rk40;
if( $hlavicka->rk40 == 0 ) $rk40="";
$rk41=$hlavicka->rk41;
if( $hlavicka->rk41 == 0 ) $rk41="";
$rk42=$hlavicka->rk42;
if( $hlavicka->rk42 == 0 ) $rk42="";
$rk43=$hlavicka->rk43;
if( $hlavicka->rk43 == 0 ) $rk43="";

$rn22=$hlavicka->rn22;
if( $hlavicka->rn22 == 0 ) $rn22="";
$rn23=$hlavicka->rn23;
if( $hlavicka->rn23 == 0 ) $rn23="";
$rn24=$hlavicka->rn24;
if( $hlavicka->rn24 == 0 ) $rn24="";
$rn25=$hlavicka->rn25;
if( $hlavicka->rn25 == 0 ) $rn25="";
$rn26=$hlavicka->rn26;
if( $hlavicka->rn26 == 0 ) $rn26="";
$rn27=$hlavicka->rn27;
if( $hlavicka->rn27 == 0 ) $rn27="";
$rn28=$hlavicka->rn28;
if( $hlavicka->rn28 == 0 ) $rn28="";
$rn29=$hlavicka->rn29;
if( $hlavicka->rn29 == 0 ) $rn29="";
$rn30=$hlavicka->rn30;
if( $hlavicka->rn30 == 0 ) $rn30="";
$rn31=$hlavicka->rn31;
if( $hlavicka->rn31 == 0 ) $rn31="";
$rn32=$hlavicka->rn32;
if( $hlavicka->rn32 == 0 ) $rn32="";
$rn33=$hlavicka->rn33;
if( $hlavicka->rn33 == 0 ) $rn33="";
$rn34=$hlavicka->rn34;
if( $hlavicka->rn34 == 0 ) $rn34="";
$rn35=$hlavicka->rn35;
if( $hlavicka->rn35 == 0 ) $rn35="";
$rn36=$hlavicka->rn36;
if( $hlavicka->rn36 == 0 ) $rn36="";
$rn37=$hlavicka->rn37;
if( $hlavicka->rn37 == 0 ) $rn37="";
$rn38=$hlavicka->rn38;
if( $hlavicka->rn38 == 0 ) $rn38="";
$rn39=$hlavicka->rn39;
if( $hlavicka->rn39 == 0 ) $rn39="";
$rn40=$hlavicka->rn40;
if( $hlavicka->rn40 == 0 ) $rn40="";
$rn41=$hlavicka->rn41;
if( $hlavicka->rn41 == 0 ) $rn41="";
$rn42=$hlavicka->rn42;
if( $hlavicka->rn42 == 0 ) $rn42="";
$rn43=$hlavicka->rn43;
if( $hlavicka->rn43 == 0 ) $rn43="";


$rm22=$hlavicka->rm22;
if( $hlavicka->rm22 == 0 ) $rm22="";
$rm23=$hlavicka->rm23;
if( $hlavicka->rm23 == 0 ) $rm23="";
$rm24=$hlavicka->rm24;
if( $hlavicka->rm24 == 0 ) $rm24="";
$rm25=$hlavicka->rm25;
if( $hlavicka->rm25 == 0 ) $rm25="";
$rm26=$hlavicka->rm26;
if( $hlavicka->rm26 == 0 ) $rm26="";
$rm27=$hlavicka->rm27;
if( $hlavicka->rm27 == 0 ) $rm27="";
$rm28=$hlavicka->rm28;
if( $hlavicka->rm28 == 0 ) $rm28="";
$rm29=$hlavicka->rm29;
if( $hlavicka->rm29 == 0 ) $rm29="";
$rm30=$hlavicka->rm30;
if( $hlavicka->rm30 == 0 ) $rm30="";
$rm31=$hlavicka->rm31;
if( $hlavicka->rm31 == 0 ) $rm31="";
$rm32=$hlavicka->rm32;
if( $hlavicka->rm32 == 0 ) $rm32="";
$rm33=$hlavicka->rm33;
if( $hlavicka->rm33 == 0 ) $rm33="";
$rm34=$hlavicka->rm34;
if( $hlavicka->rm34 == 0 ) $rm34="";
$rm35=$hlavicka->rm35;
if( $hlavicka->rm35 == 0 ) $rm35="";
$rm36=$hlavicka->rm36;
if( $hlavicka->rm36 == 0 ) $rm36="";
$rm37=$hlavicka->rm37;
if( $hlavicka->rm37 == 0 ) $rm37="";
$rm38=$hlavicka->rm38;
if( $hlavicka->rm38 == 0 ) $rm38="";
$rm39=$hlavicka->rm39;
if( $hlavicka->rm39 == 0 ) $rm39="";
$rm40=$hlavicka->rm40;
if( $hlavicka->rm40 == 0 ) $rm40="";
$rm41=$hlavicka->rm41;
if( $hlavicka->rm41 == 0 ) $rm41="";
$rm42=$hlavicka->rm42;
if( $hlavicka->rm42 == 0 ) $rm42="";
$rm43=$hlavicka->rm43;
if( $hlavicka->rm43 == 0 ) $rm43="";

$pdf->Cell(115,4," ","$rmc",0,"C");$pdf->Cell(19,7,"$r01","$rmc",0,"R");$pdf->Cell(22,7,"$rk01","$rmc",0,"R");$pdf->Cell(16,7,"$rn01","$rmc",0,"R");
$pdf->Cell(21,7,"$rm01","$rmc",1,"R");
$pdf->Cell(115,4," ","$rmc",0,"C");$pdf->Cell(19,5,"$r02","$rmc",0,"R");$pdf->Cell(22,5,"$rk02","$rmc",0,"R");$pdf->Cell(16,5,"$rn02","$rmc",0,"R");
$pdf->Cell(21,5,"$rm02","$rmc",1,"R");
$pdf->Cell(115,4," ","$rmc",0,"C");$pdf->Cell(19,5,"$r03","$rmc",0,"R");$pdf->Cell(22,5,"$rk03","$rmc",0,"R");$pdf->Cell(16,5,"$rn03","$rmc",0,"R");
$pdf->Cell(21,5,"$rm03","$rmc",1,"R");

$pdf->Cell(115,4," ","$rmc",0,"C");$pdf->Cell(19,10,"$r04","$rmc",0,"R");$pdf->Cell(22,10,"$rk04","$rmc",0,"R");$pdf->Cell(16,10,"$rn04","$rmc",0,"R");
$pdf->Cell(21,10,"$rm04","$rmc",1,"R");

$pdf->Cell(115,4," ","$rmc",0,"C");$pdf->Cell(19,5,"$r05","$rmc",0,"R");$pdf->Cell(22,5,"$rk05","$rmc",0,"R");$pdf->Cell(16,5,"$rn05","$rmc",0,"R");
$pdf->Cell(21,5,"$rm05","$rmc",1,"R");
$pdf->Cell(115,4," ","$rmc",0,"C");$pdf->Cell(19,5,"$r06","$rmc",0,"R");$pdf->Cell(22,5,"$rk06","$rmc",0,"R");$pdf->Cell(16,5,"$rn06","$rmc",0,"R");
$pdf->Cell(21,5,"$rm06","$rmc",1,"R");
$pdf->Cell(115,4," ","$rmc",0,"C");$pdf->Cell(19,5,"$r07","$rmc",0,"R");$pdf->Cell(22,5,"$rk07","$rmc",0,"R");$pdf->Cell(16,5,"$rn07","$rmc",0,"R");
$pdf->Cell(21,5,"$rm07","$rmc",1,"R");
$pdf->Cell(115,4," ","$rmc",0,"C");$pdf->Cell(19,5,"$r08","$rmc",0,"R");$pdf->Cell(22,5,"$rk08","$rmc",0,"R");$pdf->Cell(16,5,"$rn08","$rmc",0,"R");
$pdf->Cell(21,5,"$rm08","$rmc",1,"R");

$pdf->Cell(115,4," ","$rmc",0,"C");$pdf->Cell(19,4,"$r09","$rmc",0,"R");$pdf->Cell(22,4,"$rk09","$rmc",0,"R");$pdf->Cell(16,4,"$rn09","$rmc",0,"R");
$pdf->Cell(21,4,"$rm09","$rmc",1,"R");

$pdf->Cell(115,4," ","$rmc",0,"C");$pdf->Cell(19,5,"$r10","$rmc",0,"R");$pdf->Cell(22,5,"$rk10","$rmc",0,"R");$pdf->Cell(16,5,"$rn10","$rmc",0,"R");
$pdf->Cell(21,5,"$rm10","$rmc",1,"R");
$pdf->Cell(115,4," ","$rmc",0,"C");$pdf->Cell(19,5,"$r11","$rmc",0,"R");$pdf->Cell(22,5,"$rk11","$rmc",0,"R");$pdf->Cell(16,5,"$rn11","$rmc",0,"R");
$pdf->Cell(21,5,"$rm11","$rmc",1,"R");
$pdf->Cell(115,4," ","$rmc",0,"C");$pdf->Cell(19,5,"$r12","$rmc",0,"R");$pdf->Cell(22,5,"$rk12","$rmc",0,"R");$pdf->Cell(16,5,"$rn12","$rmc",0,"R");
$pdf->Cell(21,5,"$rm12","$rmc",1,"R");
$pdf->Cell(115,4," ","$rmc",0,"C");$pdf->Cell(19,5,"$r13","$rmc",0,"R");$pdf->Cell(22,5,"$rk13","$rmc",0,"R");$pdf->Cell(16,5,"$rn13","$rmc",0,"R");
$pdf->Cell(21,5,"$rm13","$rmc",1,"R");
$pdf->Cell(115,4," ","$rmc",0,"C");$pdf->Cell(19,5,"$r14","$rmc",0,"R");$pdf->Cell(22,5,"$rk14","$rmc",0,"R");$pdf->Cell(16,5,"$rn14","$rmc",0,"R");
$pdf->Cell(21,5,"$rm14","$rmc",1,"R");
$pdf->Cell(115,4," ","$rmc",0,"C");$pdf->Cell(19,5,"$r15","$rmc",0,"R");$pdf->Cell(22,5,"$rk15","$rmc",0,"R");$pdf->Cell(16,5,"$rn15","$rmc",0,"R");
$pdf->Cell(21,5,"$rm15","$rmc",1,"R");
$pdf->Cell(115,4," ","$rmc",0,"C");$pdf->Cell(19,5,"$r16","$rmc",0,"R");$pdf->Cell(22,5,"$rk16","$rmc",0,"R");$pdf->Cell(16,5,"$rn16","$rmc",0,"R");
$pdf->Cell(21,5,"$rm16","$rmc",1,"R");

$pdf->Cell(115,4," ","$rmc",0,"C");$pdf->Cell(19,4,"$r17","$rmc",0,"R");$pdf->Cell(22,4,"$rk17","$rmc",0,"R");$pdf->Cell(16,4,"$rn17","$rmc",0,"R");
$pdf->Cell(21,4,"$rm17","$rmc",1,"R");

$pdf->Cell(115,4," ","$rmc",0,"C");$pdf->Cell(19,5,"$r18","$rmc",0,"R");$pdf->Cell(22,5,"$rk18","$rmc",0,"R");$pdf->Cell(16,5,"$rn18","$rmc",0,"R");
$pdf->Cell(21,5,"$rm18","$rmc",1,"R");
$pdf->Cell(115,4," ","$rmc",0,"C");$pdf->Cell(19,5,"$r19","$rmc",0,"R");$pdf->Cell(22,5,"$rk19","$rmc",0,"R");$pdf->Cell(16,5,"$rn19","$rmc",0,"R");
$pdf->Cell(21,5,"$rm19","$rmc",1,"R");
$pdf->Cell(115,4," ","$rmc",0,"C");$pdf->Cell(19,5,"$r20","$rmc",0,"R");$pdf->Cell(22,5,"$rk20","$rmc",0,"R");$pdf->Cell(16,5,"$rn20","$rmc",0,"R");
$pdf->Cell(21,5,"$rm20","$rmc",1,"R");

$pdf->Cell(115,4," ","$rmc",0,"C");$pdf->Cell(19,10,"$r21","$rmc",0,"R");$pdf->Cell(22,10,"$rk21","$rmc",0,"R");$pdf->Cell(16,10,"$rn21","$rmc",0,"R");
$pdf->Cell(21,10,"$rm21","$rmc",1,"R");

$pdf->Cell(115,4," ","$rmc",0,"C");$pdf->Cell(19,5,"$r22","$rmc",0,"R");$pdf->Cell(22,5,"$rk22","$rmc",0,"R");$pdf->Cell(16,5,"$rn22","$rmc",0,"R");
$pdf->Cell(21,5,"$rm22","$rmc",1,"R");
$pdf->Cell(115,4," ","$rmc",0,"C");$pdf->Cell(19,5,"$r23","$rmc",0,"R");$pdf->Cell(22,5,"$rk23","$rmc",0,"R");$pdf->Cell(16,5,"$rn23","$rmc",0,"R");
$pdf->Cell(21,5,"$rm23","$rmc",1,"R");
$pdf->Cell(115,4," ","$rmc",0,"C");$pdf->Cell(19,5,"$r24","$rmc",0,"R");$pdf->Cell(22,5,"$rk24","$rmc",0,"R");$pdf->Cell(16,5,"$rn24","$rmc",0,"R");
$pdf->Cell(21,5,"$rm24","$rmc",1,"R");

$pdf->Cell(115,4," ","$rmc",0,"C");$pdf->Cell(19,4,"$r25","$rmc",0,"R");$pdf->Cell(22,4,"$rk25","$rmc",0,"R");$pdf->Cell(16,4,"$rn25","$rmc",0,"R");
$pdf->Cell(21,4,"$rm25","$rmc",1,"R");

$pdf->Cell(115,4," ","$rmc",0,"C");$pdf->Cell(19,5,"$r26","$rmc",0,"R");$pdf->Cell(22,5,"$rk26","$rmc",0,"R");$pdf->Cell(16,5,"$rn26","$rmc",0,"R");
$pdf->Cell(21,5,"$rm26","$rmc",1,"R");
$pdf->Cell(115,4," ","$rmc",0,"C");$pdf->Cell(19,5,"$r27","$rmc",0,"R");$pdf->Cell(22,5,"$rk27","$rmc",0,"R");$pdf->Cell(16,5,"$rn27","$rmc",0,"R");
$pdf->Cell(21,5,"$rm27","$rmc",1,"R");
$pdf->Cell(115,4," ","$rmc",0,"C");$pdf->Cell(19,5,"$r28","$rmc",0,"R");$pdf->Cell(22,5,"$rk28","$rmc",0,"R");$pdf->Cell(16,5,"$rn28","$rmc",0,"R");
$pdf->Cell(21,5,"$rm28","$rmc",1,"R");
                                                                                   
$pdf->Cell(115,4," ","$rmc",0,"C");$pdf->Cell(19,10,"$r29","$rmc",0,"R");$pdf->Cell(22,10,"$rk29","$rmc",0,"R");$pdf->Cell(16,10,"$rn29","$rmc",0,"R");
$pdf->Cell(21,10,"$rm29","$rmc",1,"R");

$pdf->Cell(115,4," ","$rmc",0,"C");$pdf->Cell(19,5,"$r30","$rmc",0,"R");$pdf->Cell(22,5,"$rk30","$rmc",0,"R");$pdf->Cell(16,5,"$rn30","$rmc",0,"R");
$pdf->Cell(21,5,"$rm30","$rmc",1,"R");
$pdf->Cell(115,4," ","$rmc",0,"C");$pdf->Cell(19,5,"$r31","$rmc",0,"R");$pdf->Cell(22,5,"$rk31","$rmc",0,"R");$pdf->Cell(16,5,"$rn31","$rmc",0,"R");
$pdf->Cell(21,5,"$rm31","$rmc",1,"R");
$pdf->Cell(115,4," ","$rmc",0,"C");$pdf->Cell(19,5,"$r32","$rmc",0,"R");$pdf->Cell(22,5,"$rk32","$rmc",0,"R");$pdf->Cell(16,5,"$rn32","$rmc",0,"R");
$pdf->Cell(21,5,"$rm32","$rmc",1,"R");
$pdf->Cell(115,4," ","$rmc",0,"C");$pdf->Cell(19,5,"$r33","$rmc",0,"R");$pdf->Cell(22,5,"$rk33","$rmc",0,"R");$pdf->Cell(16,5,"$rn33","$rmc",0,"R");
$pdf->Cell(21,5,"$rm33","$rmc",1,"R");

$pdf->Cell(115,4," ","$rmc",0,"C");$pdf->Cell(19,10,"$r34","$rmc",0,"R");$pdf->Cell(22,10,"$rk34","$rmc",0,"R");$pdf->Cell(16,10,"$rn34","$rmc",0,"R");
$pdf->Cell(21,10,"$rm34","$rmc",1,"R");

$pdf->Cell(115,4," ","$rmc",0,"C");$pdf->Cell(19,4,"$r35","$rmc",0,"R");$pdf->Cell(22,4,"$rk35","$rmc",0,"R");$pdf->Cell(16,4,"$rn35","$rmc",0,"R");
$pdf->Cell(21,4,"$rm35","$rmc",1,"R");
$pdf->Cell(115,4," ","$rmc",0,"C");$pdf->Cell(19,5,"$r36","$rmc",0,"R");$pdf->Cell(22,5,"$rk36","$rmc",0,"R");$pdf->Cell(16,5,"$rn36","$rmc",0,"R");
$pdf->Cell(21,5,"$rm36","$rmc",1,"R");
$pdf->Cell(115,4," ","$rmc",0,"C");$pdf->Cell(19,5,"$r37","$rmc",0,"R");$pdf->Cell(22,5,"$rk37","$rmc",0,"R");$pdf->Cell(16,5,"$rn37","$rmc",0,"R");
$pdf->Cell(21,5,"$rm37","$rmc",1,"R");

$pdf->Cell(115,4," ","$rmc",0,"C");$pdf->Cell(19,5,"$r38","$rmc",0,"R");$pdf->Cell(22,5,"$rk38","$rmc",0,"R");$pdf->Cell(16,5,"$rn38","$rmc",0,"R");
$pdf->Cell(21,5,"$rm38","$rmc",1,"R");


$pdf->Cell(115,4," ","$rmc",0,"C");$pdf->Cell(19,10,"$r39","$rmc",0,"R");$pdf->Cell(22,10,"$rk39","$rmc",0,"R");$pdf->Cell(16,10,"$rn39","$rmc",0,"R");
$pdf->Cell(21,10,"$rm39","$rmc",1,"R");
$pdf->Cell(115,4," ","$rmc",0,"C");$pdf->Cell(19,10,"$r40","$rmc",0,"R");$pdf->Cell(22,10,"$rk40","$rmc",0,"R");$pdf->Cell(16,10,"$rn40","$rmc",0,"R");
$pdf->Cell(21,10,"$rm40","$rmc",1,"R");

$pdf->Cell(115,4," ","$rmc",0,"C");$pdf->Cell(19,5,"$r41","$rmc",0,"R");$pdf->Cell(22,5,"$rk41","$rmc",0,"R");$pdf->Cell(16,5,"$rn41","$rmc",0,"R");
$pdf->Cell(21,5,"$rm41","$rmc",1,"R");
$pdf->Cell(115,4," ","$rmc",0,"C");$pdf->Cell(19,5,"$r42","$rmc",0,"R");$pdf->Cell(22,5,"$rk42","$rmc",0,"R");$pdf->Cell(16,5,"$rn42","$rmc",0,"R");
$pdf->Cell(21,5,"$rm42","$rmc",1,"R");
$pdf->Cell(115,4," ","$rmc",0,"C");$pdf->Cell(19,4,"$r43","$rmc",0,"R");$pdf->Cell(22,4,"$rk43","$rmc",0,"R");$pdf->Cell(16,4,"$rn43","$rmc",0,"R");
$pdf->Cell(21,4,"$rm43","$rmc",1,"R");

                                          }
//koniec strany 2



if ( $strana == 3 OR $strana == 9999 )    {

//strana 3
$pdf->AddPage();
$pdf->SetLeftMargin(8); 
$pdf->SetTopMargin(10);

if (File_Exists ('../dokumenty/vykazy_nujfin2015/fin204pod/fin204pod_str3a.jpg') )
{
$pdf->Image('../dokumenty/vykazy_nujfin2015/fin204pod/fin204pod_str3a.jpg',5,5,200,60); 
}

if (File_Exists ('../dokumenty/vykazy_nujfin2015/fin204pod/fin204pod_str3b.jpg') )
{
$pdf->Image('../dokumenty/vykazy_nujfin2015/fin204pod/fin204pod_str3b.jpg',8,64,193,155); 
}

//zostatok k
$pdf->SetFont('arial','',7);
$skutku=substr($datum,0,6);
$textx="14.01.2010";
$pdf->SetY(19);

$pdf->Cell(152,3," ","$rmc",0,"R");$pdf->Cell(12,4,"$skutku","$rmc",1,"C");


//VYBRANE PASIVA
$pdf->Cell(196,18,"                          ","$rmc",1,"L");

$r44=$hlavicka->r44;
if( $hlavicka->r44 == 0 ) $r44="";
$r45=$hlavicka->r45;
if( $hlavicka->r45 == 0 ) $r45="";
$r46=$hlavicka->r46;
if( $hlavicka->r46 == 0 ) $r46="";
$r47=$hlavicka->r47;
if( $hlavicka->r47 == 0 ) $r47="";
$r48=$hlavicka->r48;
if( $hlavicka->r48 == 0 ) $r48="";
$r49=$hlavicka->r49;
if( $hlavicka->r49 == 0 ) $r49="";
$r50=$hlavicka->r50;
if( $hlavicka->r50 == 0 ) $r50="";
$r51=$hlavicka->r51;
if( $hlavicka->r51 == 0 ) $r51="";
$r52=$hlavicka->r52;
if( $hlavicka->r52 == 0 ) $r52="";
$r53=$hlavicka->r53;
if( $hlavicka->r53 == 0 ) $r53="";
$r54=$hlavicka->r54;
if( $hlavicka->r54 == 0 ) $r54="";
$r55=$hlavicka->r55;
if( $hlavicka->r55 == 0 ) $r55="";
$r56=$hlavicka->r56;
if( $hlavicka->r56 == 0 ) $r56="";
$r57=$hlavicka->r57;
if( $hlavicka->r57 == 0 ) $r57="";
$r58=$hlavicka->r58;
if( $hlavicka->r58 == 0 ) $r58="";
$r59=$hlavicka->r59;
if( $hlavicka->r59 == 0 ) $r59="";
$r60=$hlavicka->r60;
if( $hlavicka->r60 == 0 ) $r60="";
$r61=$hlavicka->r61;
if( $hlavicka->r61 == 0 ) $r61="";
$r62=$hlavicka->r62;
if( $hlavicka->r62 == 0 ) $r62="";
$r63=$hlavicka->r63;
if( $hlavicka->r63 == 0 ) $r63="";
$r64=$hlavicka->r64;
if( $hlavicka->r64 == 0 ) $r64="";
$r65=$hlavicka->r65;
if( $hlavicka->r65 == 0 ) $r65="";
$r66=$hlavicka->r66;
if( $hlavicka->r66 == 0 ) $r66="";
$r67=$hlavicka->r67;
if( $hlavicka->r67 == 0 ) $r67="";
$r68=$hlavicka->r68;
if( $hlavicka->r68 == 0 ) $r68="";
$r69=$hlavicka->r69;
if( $hlavicka->r69 == 0 ) $r69="";
$r70=$hlavicka->r70;
if( $hlavicka->r70 == 0 ) $r70="";

$r71=$hlavicka->r71;
if( $hlavicka->r71 == 0 ) $r71="";
$r72=$hlavicka->r72;
if( $hlavicka->r72 == 0 ) $r72="";
$r73=$hlavicka->r73;
if( $hlavicka->r73 == 0 ) $r73="";
$r74=$hlavicka->r74;
if( $hlavicka->r74 == 0 ) $r74="";

$rm44=$hlavicka->rm44;
if( $hlavicka->rm44 == 0 ) $rm44="";
$rm45=$hlavicka->rm45;
if( $hlavicka->rm45 == 0 ) $rm45="";
$rm46=$hlavicka->rm46;
if( $hlavicka->rm46 == 0 ) $rm46="";
$rm47=$hlavicka->rm47;
if( $hlavicka->rm47 == 0 ) $rm47="";
$rm48=$hlavicka->rm48;
if( $hlavicka->rm48 == 0 ) $rm48="";
$rm49=$hlavicka->rm49;
if( $hlavicka->rm49 == 0 ) $rm49="";
$rm50=$hlavicka->rm50;
if( $hlavicka->rm50 == 0 ) $rm50="";
$rm51=$hlavicka->rm51;
if( $hlavicka->rm51 == 0 ) $rm51="";
$rm52=$hlavicka->rm52;
if( $hlavicka->rm52 == 0 ) $rm52="";
$rm53=$hlavicka->rm53;
if( $hlavicka->rm53 == 0 ) $rm53="";
$rm54=$hlavicka->rm54;
if( $hlavicka->rm54 == 0 ) $rm54="";
$rm55=$hlavicka->rm55;
if( $hlavicka->rm55 == 0 ) $rm55="";
$rm56=$hlavicka->rm56;
if( $hlavicka->rm56 == 0 ) $rm56="";
$rm57=$hlavicka->rm57;
if( $hlavicka->rm57 == 0 ) $rm57="";
$rm58=$hlavicka->rm58;
if( $hlavicka->rm58 == 0 ) $rm58="";
$rm59=$hlavicka->rm59;
if( $hlavicka->rm59 == 0 ) $rm59="";
$rm60=$hlavicka->rm60;
if( $hlavicka->rm60 == 0 ) $rm60="";
$rm61=$hlavicka->rm61;
if( $hlavicka->rm61 == 0 ) $rm61="";
$rm62=$hlavicka->rm62;
if( $hlavicka->rm62 == 0 ) $rm62="";
$rm63=$hlavicka->rm63;
if( $hlavicka->rm63 == 0 ) $rm63="";
$rm64=$hlavicka->rm64;
if( $hlavicka->rm64 == 0 ) $rm64="";
$rm65=$hlavicka->rm65;
if( $hlavicka->rm65 == 0 ) $rm65="";
$rm66=$hlavicka->rm66;
if( $hlavicka->rm66 == 0 ) $rm66="";
$rm67=$hlavicka->rm67;
if( $hlavicka->rm67 == 0 ) $rm67="";
$rm68=$hlavicka->rm68;
if( $hlavicka->rm68 == 0 ) $rm68="";
$rm69=$hlavicka->rm69;
if( $hlavicka->rm69 == 0 ) $rm69="";
$rm70=$hlavicka->rm70;
if( $hlavicka->rm70 == 0 ) $rm70="";

$rm71=$hlavicka->rm71;
if( $hlavicka->rm71 == 0 ) $rm71="";
$rm72=$hlavicka->rm72;
if( $hlavicka->rm72 == 0 ) $rm72="";
$rm73=$hlavicka->rm73;
if( $hlavicka->rm73 == 0 ) $rm73="";
$rm74=$hlavicka->rm74;
if( $hlavicka->rm74 == 0 ) $rm74="";


$pdf->Cell(128,4," ","$rmc",0,"C");$pdf->Cell(34,6,"$r44","$rmc",0,"R");$pdf->Cell(27,6,"$rm44","$rmc",1,"R");
$pdf->Cell(128,4," ","$rmc",0,"C");$pdf->Cell(34,4,"$r45","$rmc",0,"R");$pdf->Cell(27,4,"$rm45","$rmc",1,"R");
$pdf->Cell(128,4," ","$rmc",0,"C");$pdf->Cell(34,5,"$r46","$rmc",0,"R");$pdf->Cell(27,5,"$rm46","$rmc",1,"R");
$pdf->Cell(128,4," ","$rmc",0,"C");$pdf->Cell(34,5,"$r47","$rmc",0,"R");$pdf->Cell(27,5,"$rm47","$rmc",1,"R");
$pdf->Cell(128,4," ","$rmc",0,"C");$pdf->Cell(34,5,"$r48","$rmc",0,"R");$pdf->Cell(27,5,"$rm48","$rmc",1,"R");
$pdf->Cell(128,4," ","$rmc",0,"C");$pdf->Cell(34,5,"$r49","$rmc",0,"R");$pdf->Cell(27,5,"$rm49","$rmc",1,"R");
$pdf->Cell(128,4," ","$rmc",0,"C");$pdf->Cell(34,5,"$r50","$rmc",0,"R");$pdf->Cell(27,5,"$rm50","$rmc",1,"R");
$pdf->Cell(128,4," ","$rmc",0,"C");$pdf->Cell(34,5,"$r51","$rmc",0,"R");$pdf->Cell(27,5,"$rm51","$rmc",1,"R");
$pdf->Cell(128,4," ","$rmc",0,"C");$pdf->Cell(34,5,"$r52","$rmc",0,"R");$pdf->Cell(27,5,"$rm52","$rmc",1,"R");
$pdf->Cell(128,4," ","$rmc",0,"C");$pdf->Cell(34,5,"$r53","$rmc",0,"R");$pdf->Cell(27,5,"$rm53","$rmc",1,"R");
$pdf->Cell(128,4," ","$rmc",0,"C");$pdf->Cell(34,5,"$r54","$rmc",0,"R");$pdf->Cell(27,5,"$rm54","$rmc",1,"R");
$pdf->Cell(128,4," ","$rmc",0,"C");$pdf->Cell(34,5,"$r55","$rmc",0,"R");$pdf->Cell(27,5,"$rm55","$rmc",1,"R");
$pdf->Cell(128,4," ","$rmc",0,"C");$pdf->Cell(34,5,"$r56","$rmc",0,"R");$pdf->Cell(27,5,"$rm56","$rmc",1,"R");
$pdf->Cell(128,4," ","$rmc",0,"C");$pdf->Cell(34,5,"$r57","$rmc",0,"R");$pdf->Cell(27,5,"$rm57","$rmc",1,"R");
$pdf->Cell(128,4," ","$rmc",0,"C");$pdf->Cell(34,5,"$r58","$rmc",0,"R");$pdf->Cell(27,5,"$rm58","$rmc",1,"R");
$pdf->Cell(128,4," ","$rmc",0,"C");$pdf->Cell(34,5,"$r59","$rmc",0,"R");$pdf->Cell(27,5,"$rm59","$rmc",1,"R");

$pdf->Cell(128,4," ","$rmc",0,"C");$pdf->Cell(34,10,"$r60","$rmc",0,"R");$pdf->Cell(27,10,"$rm60","$rmc",1,"R");

$pdf->Cell(128,4," ","$rmc",0,"C");$pdf->Cell(34,5,"$r61","$rmc",0,"R");$pdf->Cell(27,5,"$rm61","$rmc",1,"R");
$pdf->Cell(128,4," ","$rmc",0,"C");$pdf->Cell(34,5,"$r62","$rmc",0,"R");$pdf->Cell(27,5,"$rm62","$rmc",1,"R");
$pdf->Cell(128,4," ","$rmc",0,"C");$pdf->Cell(34,5,"$r63","$rmc",0,"R");$pdf->Cell(27,5,"$rm63","$rmc",1,"R");

$pdf->Cell(128,4," ","$rmc",0,"C");$pdf->Cell(34,10,"$r64","$rmc",0,"R");$pdf->Cell(27,10,"$rm64","$rmc",1,"R");

$pdf->Cell(128,4," ","$rmc",0,"C");$pdf->Cell(34,10,"$r65","$rmc",0,"R");$pdf->Cell(27,10,"$rm65","$rmc",1,"R");

$pdf->Cell(128,4," ","$rmc",0,"C");$pdf->Cell(34,5,"$r66","$rmc",0,"R");$pdf->Cell(27,5,"$rm66","$rmc",1,"R");
$pdf->Cell(128,4," ","$rmc",0,"C");$pdf->Cell(34,5,"$r67","$rmc",0,"R");$pdf->Cell(27,5,"$rm67","$rmc",1,"R");
$pdf->Cell(128,4," ","$rmc",0,"C");$pdf->Cell(34,5,"$r68","$rmc",0,"R");$pdf->Cell(27,5,"$rm68","$rmc",1,"R");
$pdf->Cell(128,4," ","$rmc",0,"C");$pdf->Cell(34,5,"$r69","$rmc",0,"R");$pdf->Cell(27,5,"$rm69","$rmc",1,"R");

$pdf->Cell(128,4," ","$rmc",0,"C");$pdf->Cell(34,10,"$r70","$rmc",0,"R");$pdf->Cell(27,10,"$rm70","$rmc",1,"R");

$pdf->Cell(128,4," ","$rmc",0,"C");$pdf->Cell(34,5,"$r71","$rmc",0,"R");$pdf->Cell(27,5,"$rm71","$rmc",1,"R");
$pdf->Cell(128,4," ","$rmc",0,"C");$pdf->Cell(34,5,"$r72","$rmc",0,"R");$pdf->Cell(27,5,"$rm72","$rmc",1,"R");
$pdf->Cell(128,4," ","$rmc",0,"C");$pdf->Cell(34,5,"$r73","$rmc",0,"R");$pdf->Cell(27,5,"$rm73","$rmc",1,"R");
$pdf->Cell(128,4," ","$rmc",0,"C");$pdf->Cell(34,5,"$r74","$rmc",0,"R");$pdf->Cell(27,5,"$rm74","$rmc",1,"R");

                                          }
//koniec strany 3


}
$i = $i + 1;

  }

$pdf->Output("../tmp/vykazfin.$kli_uzid.pdf");
?>

<script type="text/javascript">
  var okno = window.open("../tmp/vykazfin.<?php echo $kli_uzid; ?>.pdf","_self");
</script>


<?php
}
/////////////////////////////////////////KONIEC VYTLACENIA ROCNEHO

if( $strana == 9999 ) $strana=1;

//nacitaj udaje pre upravu
if ( $copern == 20 )
    {
$sqlfir = "SELECT * FROM F$kli_vxcf"."_uctvykaz_fin204pod WHERE oc = $cislo_oc ";

$fir_vysledok = mysql_query($sqlfir);
$fir_riadok=mysql_fetch_object($fir_vysledok);

if( $strana == 1 OR $strana == 9999 )
{

$okres = 1*$fir_riadok->okres;
$obec = 1*$fir_riadok->obec;
$daz = $fir_riadok->daz;
$daz_sk=SkDatum($daz);

$r01 = $fir_riadok->r01;
$rk01 = $fir_riadok->rk01;
$rn01 = $fir_riadok->rn01;
$rm01 = $fir_riadok->rm01;
$r02 = $fir_riadok->r02;
$rk02 = $fir_riadok->rk02;
$rn02 = $fir_riadok->rn02;
$rm02 = $fir_riadok->rm02;
$r03 = $fir_riadok->r03;
$rk03 = $fir_riadok->rk03;
$rn03 = $fir_riadok->rn03;
$rm03 = $fir_riadok->rm03;
$r04 = $fir_riadok->r04;
$rk04 = $fir_riadok->rk04;
$rn04 = $fir_riadok->rn04;
$rm04 = $fir_riadok->rm04;
$r05 = $fir_riadok->r05;
$rk05 = $fir_riadok->rk05;
$rn05 = $fir_riadok->rn05;
$rm05 = $fir_riadok->rm05;
$r06 = $fir_riadok->r06;
$rk06 = $fir_riadok->rk06;
$rn06 = $fir_riadok->rn06;
$rm06 = $fir_riadok->rm06;
$r07 = $fir_riadok->r07;
$rk07 = $fir_riadok->rk07;
$rn07 = $fir_riadok->rn07;
$rm07 = $fir_riadok->rm07;
$r08 = $fir_riadok->r08;
$rk08 = $fir_riadok->rk08;
$rn08 = $fir_riadok->rn08;
$rm08 = $fir_riadok->rm08;
$r09 = $fir_riadok->r09;
$rk09 = $fir_riadok->rk09;
$rn09 = $fir_riadok->rn09;
$rm09 = $fir_riadok->rm09;
$r10 = $fir_riadok->r10;
$rk10 = $fir_riadok->rk10;
$rn10 = $fir_riadok->rn10;
$rm10 = $fir_riadok->rm10;

$r11 = $fir_riadok->r11;
$rk11 = $fir_riadok->rk11;
$rn11 = $fir_riadok->rn11;
$rm11 = $fir_riadok->rm11;
$r12 = $fir_riadok->r12;
$rk12 = $fir_riadok->rk12;
$rn12 = $fir_riadok->rn12;
$rm12 = $fir_riadok->rm12;
$r13 = $fir_riadok->r13;
$rk13 = $fir_riadok->rk13;
$rn13 = $fir_riadok->rn13;
$rm13 = $fir_riadok->rm13;
$r14 = $fir_riadok->r14;
$rk14 = $fir_riadok->rk14;
$rn14 = $fir_riadok->rn14;
$rm14 = $fir_riadok->rm14;
$r15 = $fir_riadok->r15;
$rk15 = $fir_riadok->rk15;
$rn15 = $fir_riadok->rn15;
$rm15 = $fir_riadok->rm15;
$r16 = $fir_riadok->r16;
$rk16 = $fir_riadok->rk16;
$rn16 = $fir_riadok->rn16;
$rm16 = $fir_riadok->rm16;
$r17 = $fir_riadok->r17;
$rk17 = $fir_riadok->rk17;
$rn17 = $fir_riadok->rn17;
$rm17 = $fir_riadok->rm17;
$r18 = $fir_riadok->r18;
$rk18 = $fir_riadok->rk18;
$rn18 = $fir_riadok->rn18;
$rm18 = $fir_riadok->rm18;
$r19 = $fir_riadok->r19;
$rk19 = $fir_riadok->rk19;
$rn19 = $fir_riadok->rn19;
$rm19 = $fir_riadok->rm19;
$r20 = $fir_riadok->r20;
$rk20 = $fir_riadok->rk20;
$rn20 = $fir_riadok->rn20;
$rm20 = $fir_riadok->rm20;

$r21 = $fir_riadok->r21;
$rk21 = $fir_riadok->rk21;
$rn21 = $fir_riadok->rn21;
$rm21 = $fir_riadok->rm21;

$r22 = $fir_riadok->r22;
$rk22 = $fir_riadok->rk22;
$rn22 = $fir_riadok->rn22;
$rm22 = $fir_riadok->rm22;
}

if( $strana == 2 )
{

$r23 = $fir_riadok->r23;
$rk23 = $fir_riadok->rk23;
$rn23 = $fir_riadok->rn23;
$rm23 = $fir_riadok->rm23;
$r24 = $fir_riadok->r24;
$rk24 = $fir_riadok->rk24;
$rn24 = $fir_riadok->rn24;
$rm24 = $fir_riadok->rm24;
$r25 = $fir_riadok->r25;
$rk25 = $fir_riadok->rk25;
$rn25 = $fir_riadok->rn25;
$rm25 = $fir_riadok->rm25;
$r26 = $fir_riadok->r26;
$rk26 = $fir_riadok->rk26;
$rn26 = $fir_riadok->rn26;
$rm26 = $fir_riadok->rm26;

$r27 = $fir_riadok->r27;
$rk27 = $fir_riadok->rk27;
$rn27 = $fir_riadok->rn27;
$rm27 = $fir_riadok->rm27;
$r28 = $fir_riadok->r28;
$rk28 = $fir_riadok->rk28;
$rn28 = $fir_riadok->rn28;
$rm28 = $fir_riadok->rm28;
$r29 = $fir_riadok->r29;
$rk29 = $fir_riadok->rk29;
$rn29 = $fir_riadok->rn29;
$rm29 = $fir_riadok->rm29;

$r30 = $fir_riadok->r30;
$rk30 = $fir_riadok->rk30;
$rn30 = $fir_riadok->rn30;
$rm30 = $fir_riadok->rm30;
$r31 = $fir_riadok->r31;
$rk31 = $fir_riadok->rk31;
$rn31 = $fir_riadok->rn31;
$rm31 = $fir_riadok->rm31;
$r32 = $fir_riadok->r32;
$rk32 = $fir_riadok->rk32;
$rn32 = $fir_riadok->rn32;
$rm32 = $fir_riadok->rm32;
$r33 = $fir_riadok->r33;
$rk33 = $fir_riadok->rk33;
$rn33 = $fir_riadok->rn33;
$rm33 = $fir_riadok->rm33;
$r34 = $fir_riadok->r34;
$rk34 = $fir_riadok->rk34;
$rn34 = $fir_riadok->rn34;
$rm34 = $fir_riadok->rm34;
$r35 = $fir_riadok->r35;
$rk35 = $fir_riadok->rk35;
$rn35 = $fir_riadok->rn35;
$rm35 = $fir_riadok->rm35;
$r36 = $fir_riadok->r36;
$rk36 = $fir_riadok->rk36;
$rn36 = $fir_riadok->rn36;
$rm36 = $fir_riadok->rm36;
$r37 = $fir_riadok->r37;
$rk37 = $fir_riadok->rk37;
$rn37 = $fir_riadok->rn37;
$rm37 = $fir_riadok->rm37;
$r38 = $fir_riadok->r38;
$rk38 = $fir_riadok->rk38;
$rn38 = $fir_riadok->rn38;
$rm38 = $fir_riadok->rm38;
$r39 = $fir_riadok->r39;
$rk39 = $fir_riadok->rk39;
$rn39 = $fir_riadok->rn39;
$rm39 = $fir_riadok->rm39;

$r40 = $fir_riadok->r40;
$rk40 = $fir_riadok->rk40;
$rn40 = $fir_riadok->rn40;
$rm40 = $fir_riadok->rm40;

$r41 = $fir_riadok->r41;
$rk41 = $fir_riadok->rk41;
$rn41 = $fir_riadok->rn41;
$rm41 = $fir_riadok->rm41;

$r42 = $fir_riadok->r42;
$rk42 = $fir_riadok->rk42;
$rn42 = $fir_riadok->rn42;
$rm42 = $fir_riadok->rm42;

$r43 = $fir_riadok->r43;
$rk43 = $fir_riadok->rk43;
$rn43 = $fir_riadok->rn43;
$rm43 = $fir_riadok->rm43;
}

if( $strana == 3 )
{

$r44 = $fir_riadok->r44;
$rm44 = $fir_riadok->rm44;
$r45 = $fir_riadok->r45;
$rm45 = $fir_riadok->rm45;
$r46 = $fir_riadok->r46;
$rm46 = $fir_riadok->rm46;
$r47 = $fir_riadok->r47;
$rm47 = $fir_riadok->rm47;
$r48 = $fir_riadok->r48;
$rm48 = $fir_riadok->rm48;
$r49 = $fir_riadok->r49;
$rm49 = $fir_riadok->rm49;

$r50 = $fir_riadok->r50;
$rm50 = $fir_riadok->rm50;
$r51 = $fir_riadok->r51;
$rm51 = $fir_riadok->rm51;
$r52 = $fir_riadok->r52;
$rm52 = $fir_riadok->rm52;
$r53 = $fir_riadok->r53;
$rm53 = $fir_riadok->rm53;
$r54 = $fir_riadok->r54;
$rm54 = $fir_riadok->rm54;
$r55 = $fir_riadok->r55;
$rm55 = $fir_riadok->rm55;
$r56 = $fir_riadok->r56;
$rm56 = $fir_riadok->rm56;
$r57 = $fir_riadok->r57;
$rm57 = $fir_riadok->rm57;
$r58 = $fir_riadok->r58;
$rm58 = $fir_riadok->rm58;
$r59 = $fir_riadok->r59;
$rm59 = $fir_riadok->rm59;

$r60 = $fir_riadok->r60;
$rm60 = $fir_riadok->rm60;
$r61 = $fir_riadok->r61;
$rm61 = $fir_riadok->rm61;
$r62 = $fir_riadok->r62;
$rm62 = $fir_riadok->rm62;
$r63 = $fir_riadok->r63;
$rm63 = $fir_riadok->rm63;
$r64 = $fir_riadok->r64;
$rm64 = $fir_riadok->rm64;
$r65 = $fir_riadok->r65;
$rm65 = $fir_riadok->rm65;
$r66 = $fir_riadok->r66;
$rm66 = $fir_riadok->rm66;
$r67 = $fir_riadok->r67;
$rm67 = $fir_riadok->rm67;
$r68 = $fir_riadok->r68;
$rm68 = $fir_riadok->rm68;
$r69 = $fir_riadok->r69;
$rm69 = $fir_riadok->rm69;
$r70 = $fir_riadok->r70;
$rm70 = $fir_riadok->rm70;

$r71 = $fir_riadok->r71;
$rm71 = $fir_riadok->rm71;
$r72 = $fir_riadok->r72;
$rm72 = $fir_riadok->rm72;
$r73 = $fir_riadok->r73;
$rm73 = $fir_riadok->rm73;
$r74 = $fir_riadok->r74;
$rm74 = $fir_riadok->rm74;

}


mysql_free_result($fir_vysledok);



    }
//koniec nacitania

$pol=0;
if( $okres == 0 OR $obec == 0 )
{
$sqlokr = "SELECT * FROM F$kli_vxcf"."_uctvykaz_fin104 WHERE okres > 0 AND obec > 0 ";
$okr_vysledok = mysql_query($sqlokr);
if( $okr_vysledok ) { $pol = 1*mysql_num_rows($okr_vysledok); }
if( $pol > 0) { $okr_riadok=mysql_fetch_object($okr_vysledok); $okres=1*$okr_riadok->okres; $obec=1*$okr_riadok->obec; }
}
$pol=0;
if( $okres == 0 OR $obec == 0 )
{
$sqlokr = "SELECT * FROM F$kli_vxcf"."_uctvykaz_fin204pod WHERE okres > 0 AND obec > 0 ";
$okr_vysledok = mysql_query($sqlokr);
if( $okr_vysledok ) { $pol = 1*mysql_num_rows($okr_vysledok); }
if( $pol > 0) { $okr_riadok=mysql_fetch_object($okr_vysledok); $okres=1*$okr_riadok->okres; $obec=1*$okr_riadok->obec; }
}
$pol=0;
if( $okres == 0 OR $obec == 0 )
{
$sqlokr = "SELECT * FROM F$kli_vxcf"."_uctvykaz_fin504 WHERE okres > 0 AND obec > 0 ";
$okr_vysledok = mysql_query($sqlokr);
if( $okr_vysledok ) { $pol = 1*mysql_num_rows($okr_vysledok); }
if( $pol > 0) { $okr_riadok=mysql_fetch_object($okr_vysledok); $okres=1*$okr_riadok->okres; $obec=1*$okr_riadok->obec; }
}
$pol=0;
if( $okres == 0 OR $obec == 0 )
{
$sqlokr = "SELECT * FROM F$kli_vxcf"."_uctvykaz_fin604 WHERE okres > 0 AND obec > 0 ";
$okr_vysledok = mysql_query($sqlokr);
if( $okr_vysledok ) { $pol = 1*mysql_num_rows($okr_vysledok); }
if( $pol > 0) { $okr_riadok=mysql_fetch_object($okr_vysledok); $okres=1*$okr_riadok->okres; $obec=1*$okr_riadok->obec; }
}



$dness = Date ("d.m.Y", MkTime (date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")));
if( $daz_sk == '00.00.0000' ) { $daz_sk=$dness; }

?>
<HEAD>
<META http-equiv="Content-Type" content="text/html; charset=cp1250">
  <link type="text/css" rel="stylesheet" href="../css/styl.css">
<title>V�kaz FIN 2-04 POD</title>
  <style type="text/css">

  </style>
<script type="text/javascript">
//sirka a vyska okna
var sirkawin = screen.width-10;
var vyskawin = screen.height-175;
var vyskawic = screen.height-20;
var sirkawic = screen.width-10;

<?php
//uprava sadzby strana 1
  if ( $copern == 20 )
  { 
?>
    function ObnovUI()
    {

<?php if ( $strana == 1  )                           { ?>

document.formv1.okres.value = '<?php echo $okres;?>';
document.formv1.obec.value = '<?php echo $obec;?>';
document.formv1.daz.value = '<?php echo $daz_sk;?>';
document.formv1.r01.value = '<?php echo $r01;?>';
document.formv1.rk01.value = '<?php echo $rk01;?>';
document.formv1.rn01.value = '<?php echo $rn01;?>';
document.formv1.rm01.value = '<?php echo $rm01;?>';
document.formv1.r02.value = '<?php echo $r02;?>';
document.formv1.rk02.value = '<?php echo $rk02;?>';
document.formv1.rn02.value = '<?php echo $rn02;?>';
document.formv1.rm02.value = '<?php echo $rm02;?>';
document.formv1.r03.value = '<?php echo $r03;?>';
document.formv1.rk03.value = '<?php echo $rk03;?>';
document.formv1.rn03.value = '<?php echo $rn03;?>';
document.formv1.rm03.value = '<?php echo $rm03;?>';
document.formv1.r04.value = '<?php echo $r04;?>';
document.formv1.rk04.value = '<?php echo $rk04;?>';
document.formv1.rn04.value = '<?php echo $rn04;?>';
document.formv1.rm04.value = '<?php echo $rm04;?>';
document.formv1.r05.value = '<?php echo $r05;?>';
document.formv1.rk05.value = '<?php echo $rk05;?>';
document.formv1.rn05.value = '<?php echo $rn05;?>';
document.formv1.rm05.value = '<?php echo $rm05;?>';
document.formv1.r06.value = '<?php echo $r06;?>';
document.formv1.rk06.value = '<?php echo $rk06;?>';
document.formv1.rn06.value = '<?php echo $rn06;?>';
document.formv1.rm06.value = '<?php echo $rm06;?>';
document.formv1.r07.value = '<?php echo $r07;?>';
document.formv1.rk07.value = '<?php echo $rk07;?>';
document.formv1.rn07.value = '<?php echo $rn07;?>';
document.formv1.rm07.value = '<?php echo $rm07;?>';
document.formv1.r08.value = '<?php echo $r08;?>';
document.formv1.rk08.value = '<?php echo $rk08;?>';
document.formv1.rn08.value = '<?php echo $rn08;?>';
document.formv1.rm08.value = '<?php echo $rm08;?>';
document.formv1.r09.value = '<?php echo $r09;?>';
document.formv1.rk09.value = '<?php echo $rk09;?>';
document.formv1.rn09.value = '<?php echo $rn09;?>';
document.formv1.rm09.value = '<?php echo $rm09;?>';
document.formv1.r10.value = '<?php echo $r10;?>';
document.formv1.rk10.value = '<?php echo $rk10;?>';
document.formv1.rn10.value = '<?php echo $rn10;?>';
document.formv1.rm10.value = '<?php echo $rm10;?>';

document.formv1.r11.value = '<?php echo $r11;?>';
document.formv1.rk11.value = '<?php echo $rk11;?>';
document.formv1.rn11.value = '<?php echo $rn11;?>';
document.formv1.rm11.value = '<?php echo $rm11;?>';
document.formv1.r12.value = '<?php echo $r12;?>';
document.formv1.rk12.value = '<?php echo $rk12;?>';
document.formv1.rn12.value = '<?php echo $rn12;?>';
document.formv1.rm12.value = '<?php echo $rm12;?>';
document.formv1.r13.value = '<?php echo $r13;?>';
document.formv1.rk13.value = '<?php echo $rk13;?>';
document.formv1.rn13.value = '<?php echo $rn13;?>';
document.formv1.rm13.value = '<?php echo $rm13;?>';
document.formv1.r14.value = '<?php echo $r14;?>';
document.formv1.rk14.value = '<?php echo $rk14;?>';
document.formv1.rn14.value = '<?php echo $rn14;?>';
document.formv1.rm14.value = '<?php echo $rm14;?>';
document.formv1.r15.value = '<?php echo $r15;?>';
document.formv1.rk15.value = '<?php echo $rk15;?>';
document.formv1.rn15.value = '<?php echo $rn15;?>';
document.formv1.rm15.value = '<?php echo $rm15;?>';
document.formv1.r16.value = '<?php echo $r16;?>';
document.formv1.rk16.value = '<?php echo $rk16;?>';
document.formv1.rn16.value = '<?php echo $rn16;?>';
document.formv1.rm16.value = '<?php echo $rm16;?>';
document.formv1.r17.value = '<?php echo $r17;?>';
document.formv1.rk17.value = '<?php echo $rk17;?>';
document.formv1.rn17.value = '<?php echo $rn17;?>';
document.formv1.rm17.value = '<?php echo $rm17;?>';
document.formv1.r18.value = '<?php echo $r18;?>';
document.formv1.rk18.value = '<?php echo $rk18;?>';
document.formv1.rn18.value = '<?php echo $rn18;?>';
document.formv1.rm18.value = '<?php echo $rm18;?>';
document.formv1.r19.value = '<?php echo $r19;?>';
document.formv1.rk19.value = '<?php echo $rk19;?>';
document.formv1.rn19.value = '<?php echo $rn19;?>';
document.formv1.rm19.value = '<?php echo $rm19;?>';
document.formv1.r20.value = '<?php echo $r20;?>';
document.formv1.rk20.value = '<?php echo $rk20;?>';
document.formv1.rn20.value = '<?php echo $rn20;?>';
document.formv1.rm20.value = '<?php echo $rm20;?>';

document.formv1.r21.value = '<?php echo $r21;?>';
document.formv1.rk21.value = '<?php echo $rk21;?>';
document.formv1.rn21.value = '<?php echo $rn21;?>';
document.formv1.rm21.value = '<?php echo $rm21;?>';

document.formv1.r22.value = '<?php echo $r22;?>';
document.formv1.rk22.value = '<?php echo $rk22;?>';
document.formv1.rn22.value = '<?php echo $rn22;?>';
document.formv1.rm22.value = '<?php echo $rm22;?>';

<?php                                                                   } ?>

<?php if ( $strana == 2  )                           { ?>

document.formv1.r23.value = '<?php echo $r23;?>';
document.formv1.rk23.value = '<?php echo $rk23;?>';
document.formv1.rn23.value = '<?php echo $rn23;?>';
document.formv1.rm23.value = '<?php echo $rm23;?>';
document.formv1.r24.value = '<?php echo $r24;?>';
document.formv1.rk24.value = '<?php echo $rk24;?>';
document.formv1.rn24.value = '<?php echo $rn24;?>';
document.formv1.rm24.value = '<?php echo $rm24;?>';
document.formv1.r25.value = '<?php echo $r25;?>';
document.formv1.rk25.value = '<?php echo $rk25;?>';
document.formv1.rn25.value = '<?php echo $rn25;?>';
document.formv1.rm25.value = '<?php echo $rm25;?>';
document.formv1.r26.value = '<?php echo $r26;?>';
document.formv1.rk26.value = '<?php echo $rk26;?>';
document.formv1.rn26.value = '<?php echo $rn26;?>';
document.formv1.rm26.value = '<?php echo $rm26;?>';

document.formv1.r27.value = '<?php echo $r27;?>';
document.formv1.rk27.value = '<?php echo $rk27;?>';
document.formv1.rn27.value = '<?php echo $rn27;?>';
document.formv1.rm27.value = '<?php echo $rm27;?>';
document.formv1.r28.value = '<?php echo $r28;?>';
document.formv1.rk28.value = '<?php echo $rk28;?>';
document.formv1.rn28.value = '<?php echo $rn28;?>';
document.formv1.rm28.value = '<?php echo $rm28;?>';
document.formv1.r29.value = '<?php echo $r29;?>';
document.formv1.rk29.value = '<?php echo $rk29;?>';
document.formv1.rn29.value = '<?php echo $rn29;?>';
document.formv1.rm29.value = '<?php echo $rm29;?>';

document.formv1.r30.value = '<?php echo $r30;?>';
document.formv1.rk30.value = '<?php echo $rk30;?>';
document.formv1.rn30.value = '<?php echo $rn30;?>';
document.formv1.rm30.value = '<?php echo $rm30;?>';
document.formv1.r31.value = '<?php echo $r31;?>';
document.formv1.rk31.value = '<?php echo $rk31;?>';
document.formv1.rn31.value = '<?php echo $rn31;?>';
document.formv1.rm31.value = '<?php echo $rm31;?>';
document.formv1.r32.value = '<?php echo $r32;?>';
document.formv1.rk32.value = '<?php echo $rk32;?>';
document.formv1.rn32.value = '<?php echo $rn32;?>';
document.formv1.rm32.value = '<?php echo $rm32;?>';
document.formv1.r33.value = '<?php echo $r33;?>';
document.formv1.rk33.value = '<?php echo $rk33;?>';
document.formv1.rn33.value = '<?php echo $rn33;?>';
document.formv1.rm33.value = '<?php echo $rm33;?>';
document.formv1.r34.value = '<?php echo $r34;?>';
document.formv1.rk34.value = '<?php echo $rk34;?>';
document.formv1.rn34.value = '<?php echo $rn34;?>';
document.formv1.rm34.value = '<?php echo $rm34;?>';
document.formv1.r35.value = '<?php echo $r35;?>';
document.formv1.rk35.value = '<?php echo $rk35;?>';
document.formv1.rn35.value = '<?php echo $rn35;?>';
document.formv1.rm35.value = '<?php echo $rm35;?>';
document.formv1.r36.value = '<?php echo $r36;?>';
document.formv1.rk36.value = '<?php echo $rk36;?>';
document.formv1.rn36.value = '<?php echo $rn36;?>';
document.formv1.rm36.value = '<?php echo $rm36;?>';
document.formv1.r37.value = '<?php echo $r37;?>';
document.formv1.rk37.value = '<?php echo $rk37;?>';
document.formv1.rn37.value = '<?php echo $rn37;?>';
document.formv1.rm37.value = '<?php echo $rm37;?>';
document.formv1.r38.value = '<?php echo $r38;?>';
document.formv1.rk38.value = '<?php echo $rk38;?>';
document.formv1.rn38.value = '<?php echo $rn38;?>';
document.formv1.rm38.value = '<?php echo $rm38;?>';
document.formv1.r39.value = '<?php echo $r39;?>';
document.formv1.rk39.value = '<?php echo $rk39;?>';
document.formv1.rn39.value = '<?php echo $rn39;?>';
document.formv1.rm39.value = '<?php echo $rm39;?>';

document.formv1.r40.value = '<?php echo $r40;?>';
document.formv1.rk40.value = '<?php echo $rk40;?>';
document.formv1.rn40.value = '<?php echo $rn40;?>';
document.formv1.rm40.value = '<?php echo $rm40;?>';

document.formv1.r41.value = '<?php echo $r41;?>';
document.formv1.rk41.value = '<?php echo $rk41;?>';
document.formv1.rn41.value = '<?php echo $rn41;?>';
document.formv1.rm41.value = '<?php echo $rm41;?>';

document.formv1.r42.value = '<?php echo $r42;?>';
document.formv1.rk42.value = '<?php echo $rk42;?>';
document.formv1.rn42.value = '<?php echo $rn42;?>';
document.formv1.rm42.value = '<?php echo $rm42;?>';

document.formv1.r43.value = '<?php echo $r43;?>';
document.formv1.rk43.value = '<?php echo $rk43;?>';
document.formv1.rn43.value = '<?php echo $rn43;?>';
document.formv1.rm43.value = '<?php echo $rm43;?>';

<?php                                                                   } ?>

<?php if ( $strana == 3   )                           { ?>


document.formv1.r44.value = '<?php echo $r44;?>';
document.formv1.rm44.value = '<?php echo $rm44;?>';
document.formv1.r45.value = '<?php echo $r45;?>';
document.formv1.rm45.value = '<?php echo $rm45;?>';
document.formv1.r46.value = '<?php echo $r46;?>';
document.formv1.rm46.value = '<?php echo $rm46;?>';
document.formv1.r47.value = '<?php echo $r47;?>';
document.formv1.rm47.value = '<?php echo $rm47;?>';
document.formv1.r48.value = '<?php echo $r48;?>';
document.formv1.rm48.value = '<?php echo $rm48;?>';
document.formv1.r49.value = '<?php echo $r49;?>';
document.formv1.rm49.value = '<?php echo $rm49;?>';

document.formv1.r50.value = '<?php echo $r50;?>';
document.formv1.rm50.value = '<?php echo $rm50;?>';
document.formv1.r51.value = '<?php echo $r51;?>';
document.formv1.rm51.value = '<?php echo $rm51;?>';
document.formv1.r52.value = '<?php echo $r52;?>';
document.formv1.rm52.value = '<?php echo $rm52;?>';
document.formv1.r53.value = '<?php echo $r53;?>';
document.formv1.rm53.value = '<?php echo $rm53;?>';
document.formv1.r54.value = '<?php echo $r54;?>';
document.formv1.rm54.value = '<?php echo $rm54;?>';
document.formv1.r55.value = '<?php echo $r55;?>';
document.formv1.rm55.value = '<?php echo $rm55;?>';
document.formv1.r56.value = '<?php echo $r56;?>';
document.formv1.rm56.value = '<?php echo $rm56;?>';
document.formv1.r57.value = '<?php echo $r57;?>';
document.formv1.rm57.value = '<?php echo $rm57;?>';
document.formv1.r58.value = '<?php echo $r58;?>';
document.formv1.rm58.value = '<?php echo $rm58;?>';

document.formv1.r59.value = '<?php echo $r59;?>';
document.formv1.rm59.value = '<?php echo $rm59;?>';
document.formv1.r60.value = '<?php echo $r60;?>';
document.formv1.rm60.value = '<?php echo $rm60;?>';
document.formv1.r61.value = '<?php echo $r61;?>';
document.formv1.rm61.value = '<?php echo $rm61;?>';
document.formv1.r62.value = '<?php echo $r62;?>';
document.formv1.rm62.value = '<?php echo $rm62;?>';

document.formv1.r63.value = '<?php echo $r63;?>';
document.formv1.rm63.value = '<?php echo $rm63;?>';
document.formv1.r64.value = '<?php echo $r64;?>';
document.formv1.rm64.value = '<?php echo $rm64;?>';
document.formv1.r65.value = '<?php echo $r65;?>';
document.formv1.rm65.value = '<?php echo $rm65;?>';
document.formv1.r66.value = '<?php echo $r66;?>';
document.formv1.rm66.value = '<?php echo $rm66;?>';
document.formv1.r67.value = '<?php echo $r67;?>';
document.formv1.rm67.value = '<?php echo $rm67;?>';
document.formv1.r68.value = '<?php echo $r68;?>';
document.formv1.rm68.value = '<?php echo $rm68;?>';
document.formv1.r69.value = '<?php echo $r69;?>';
document.formv1.rm69.value = '<?php echo $rm69;?>';
document.formv1.r70.value = '<?php echo $r70;?>';
document.formv1.rm70.value = '<?php echo $rm70;?>';

document.formv1.r71.value = '<?php echo $r71;?>';
document.formv1.rm71.value = '<?php echo $rm71;?>';
document.formv1.r72.value = '<?php echo $r72;?>';
document.formv1.rm72.value = '<?php echo $rm72;?>';
document.formv1.r73.value = '<?php echo $r73;?>';
document.formv1.rm73.value = '<?php echo $rm73;?>';
document.formv1.r74.value = '<?php echo $r74;?>';
document.formv1.rm74.value = '<?php echo $rm74;?>';

<?php                                                                   } ?>





    }

<?php
//koniec uprava
  }
?>

<?php
  if ( $copern != 20 )
  { 
?>
    function ObnovUI()
    {

    }
<?php
  }
?>

//Kontrola datumu Sk
function kontrola_datum(vstup, Oznam, x1, errflag)
		{
		var text
		var index
		var tecka
		var den
		var mesic
		var rok
		var ch
                var err

		text=""
                err=0 
		
		den=""
		mesic=""
		rok=""
		tecka=0
		
		for (index = 0; index < vstup.value.length; index++) 
			{
      ch = vstup.value.charAt(index);
			if (ch != "0" && ch != "1" && ch != "2" && ch != "3" && ch != "4" && ch != "5" && ch != "6" && ch != "7" && ch != "8" && ch != "9" && ch != ".") 
				{text="Pole Datum zadavajte vo formate DD.MM alebo DD.MM.RRRR (DD=den, MM=mesiac, RRRR=rok).\r"; err=3 }
			if ((ch == "0" || ch == "1" || ch == "2" || ch == "3" || ch == "4" || ch == "5" || ch == "6" || ch == "7" || ch == "8" || ch == "9") && (text ==""))
				{
				if (tecka == 0)
					{den=den + ch}
				if (tecka == 1)
					{mesic=mesic + ch}
				if (tecka == 2)
					{rok=rok + ch}
				}
			if (ch == "." && text == "")
				{
				if (tecka == 1)
					{tecka=2}
				if (tecka == 0)
					{tecka=1}
				
				}	
			}
			
		if (tecka == 2 && rok == "" )
			{rok=<?php echo $kli_vrok; ?>}
		if (tecka == 1 && rok == "" )
			{rok=<?php echo $kli_vrok; ?>; err= 0}
		if (tecka == 1 && mesic == "" )
			{mesic=<?php echo $kli_vmes; ?>; err= 0}
		if (tecka == 0 && mesic == "" )
			{mesic=<?php echo $kli_vmes; ?>; rok=<?php echo $kli_vrok; ?>; err= 0}
		if ((den<1 || den >31) && (text == ""))
			{text=text + "Pocet dni v uvedenom mesiaci nemoze byt mensi ako 1 a vacsi ako 31.\r"; err=1 }
		if ((mesic<1 || mesic>12) && (text == ""))
			{text=text + "Pocet mesiacov nemoze byt mensi ako 1 a vacsi ako 12.\r"; err=2 }
		if (rok<1930 && tecka == 2 && text == "" && rok != "" )
			{text=text + "Rok nemoze byt mensi ako 1930.\r"; err=3 }
		if (rok>2029 && tecka == 2 && text == "" && rok != "" )
			{text=text + "Rok nemoze byt v��� ako 2029.\r"; err=3 }
		if (tecka > 2)
			{text=text+ "Datum zadavajte vo formatu DD.MM alebo DD.MM.RRRR (DD=den, MM=mesiac, RRRR=rok)\r"; err=3 }

		if (mesic == 2)
			{
			if (rok != "")
				{
				if (rok % 4 == 0)
					{
					if (den>29)
						{text=text + "Vo februari roku " + rok + " je maximalne 29 dni.\r"; err=1 }
					}
				else
					{
					if (den>28)
						{text=text + "Vo februari roku " + rok + " je maximalne 28 dni.\r"; err=1 }
					}
				}
			else
				{
				if (den>29)
					{text=text + "Vo februari roku je maximalne 29 dni.\r"}
				}
			}

		if ((mesic == 4 || mesic == 6 || mesic == 9 || mesic == 11) && (den>30))
			{text=text + "Pocet dni v uvedenom mesiaci nemoze byt mensi ako 1 a vacsi ako 30.\r"}
		



		if (text!="" && err == 1 && vstup.value.length > 0 )
			{
                        Oznam.style.display="";
                        x1.value = den + "??"  + "." + mesic+ "." + rok;
                        errflag.value = "1";
                        x1.focus();
			return false;
                        }
		if (text!="" && err == 2 && vstup.value.length > 0 )
			{
                        Oznam.style.display="";
                        x1.value = den + "." + mesic + "??" + "." + rok;
                        errflag.value = "1";
                        x1.focus();
			return false;
                        }
		if (text!="" && err == 3 && vstup.value.length > 0 )
			{
                        Oznam.style.display="";
                        x1.value = den + "." + mesic +  "." + rok + "??";
                        errflag.value = "1";
                        x1.focus();
			return false;
                        }
		if (err == 0)
			{
                        Oznam.style.display="none";
                        x1.value = den + "." + mesic +  "." + rok ;
                        errflag.value = "0";
			return true;
			}

		}
//koniec kontrola datumu

// Kontrola cisla celeho v rozsahu x az y  
      function intg(x1,x,y,Oznam) 
      { 
       var b;
       b=x1.value;
       var anyString=b;
       Oznam.style.display="none";
         if (b == "") return true;
         else{
         if (Math.floor(b)==b && b>=x && b<=y) return true; 
         else {
         Oznam.style.display="";
         document.formv1.uloz.disabled = true;
         x1.focus();
         return false;
              } 
             }
      }


// Kontrola des.cisla celeho v rozsahu x az y  
      function cele(x1,x,y,Oznam,des) 
      { 
       var b;
       b=x1.value;
       var anyString=b;
       var err=0;
       var c;
       var d;
       var cele;
       var pocdes;
       cele=0;
       pocdes=0;
       c=b.toString();
       d=c.split('.');
       if ( isNaN(d[1]) ) { cele=1; }
       if ( cele == 0 ) { pocdes=d[1].length; }

         if (b == "") { err=0 }
         if (b>=x && b<=y) { err=0 }
         if ( x1.value.search(/[^0-9.-]/g) != -1) { err=1 }
         if (b<x && b != "") { err=1 }
         if (b>y && b != "") { err=1 }
         if (cele == 0 && pocdes > des ) { err=1 }

	 if (err == 0)
	 {         
         Oznam.style.display="none";
         return true;
         }

	 if (err == 1)
	 { 
         Oznam.style.display="";
         document.formv1.uloz.disabled = true;
         x1.focus();
         x1.value = b + "??";
         return false;
         }

      }


//  Kontrola cisla
    function KontrolaCisla(Vstup, Oznam)
    {
     if ( Vstup.value.search(/[^0-9]/g) != -1) { Vstup.value=Vstup.value.replace(",","."); }
     if ( Vstup.value.search(/[^0-9]/g) != -1) { Oznam.style.display=""; }
     else { Oznam.style.display="none"; }
    }

//  Kontrola cisla desatinneho
    function KontrolaDcisla(Vstup, Oznam)
    {
     if ( Vstup.value.search(/[^0-9.-]/g) != -1) { Vstup.value=Vstup.value.replace(",","."); }
     if ( Vstup.value.search(/[^0-9.-]/g) != -1) { Oznam.style.display=""; }
     else { Oznam.style.display="none"; }
    }

//  Kontrola datumu
    function KontrolaDatum(Vstup, Oznam)
    {
     if ( Vstup.value.search(/[^0-9.]/g) != -1) { Vstup.value=Vstup.value.replace(",","."); }
     if ( Vstup.value.search(/[^0-9.]/g) != -1) { Oznam.style.display=""; }
     else { Oznam.style.display="none"; }
    }


function ZnovuPotvrdenie()
                {
window.open('vykaz_fin204pod.php?cislo_oc=<?php echo $cislo_oc;?>&copern=26&drupoh=1&page=1&subor=1',
 '_self', 'width=1080, height=900, top=0, left=10, status=yes, resizable=yes, scrollbars=yes' );
                }


  function Generuj()
  { 

window.open('../ucto/oprcis.php?copern=308&drupoh=87&page=1&sysx=UCT', '_blank','<?php echo $tlcuwin; ?>' );

  }
</script>
</HEAD>
<BODY class="white" id="white" onload="ObnovUI();" >
<table class="h2" width="100%" >
<tr>
<td>EuroSecom - V�kaz FIN 2-04 POD</td>
<td align="right"><span class="login"><?php echo "UME $kli_vume FIR$kli_vxcf-$kli_nxcf  login: $kli_uzmeno $kli_uzprie / $kli_uzid ";?></span></td>
</tr>
</table>

<?php if( $copern == 20 ) { ?>
<table class="h2" width="100%" >
<tr>
<td align="left">
<?php if( $strana < 1 OR $strana > 3 ) $strana=1; ?>
<?php echo "�tvr�rok: $cislo_oc ";?>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="#" onclick="window.open('vykaz_fin204pod.php?cislo_oc=<?php echo $cislo_oc;?>&copern=26&drupoh=1&page=1&subor=0',
 '_self', 'width=1050, height=900, top=0, left=20, status=yes, resizable=yes, scrollbars=yes' );">
<img src='../obr/orig.png' width=20 height=15 border=0 title='Znovu na��ta� hodnoty ' ></a>
<a href="#" onClick="window.open('vykaz_fin204pod.php?cislo_oc=<?php echo $cislo_oc;?>&copern=10&drupoh=1&page=1&subor=0&strana=9999',
 '_blank', 'width=1050, height=900, top=0, left=20, status=yes, resizable=yes, scrollbars=yes' );">
<img src='../obr/tlac.png' width=20 height=15 border=0 title='Tla� do PDF' ></a>
</td>
<td>
<a href="#" onClick="Generuj();"><img src='../obr/zoznam.png' width=15 height=15 border=0 title='Generovanie na��tania' ></a>
</td>
</tr>
</table>
<?php                     } ?>

<?php
//upravy  udaje strana
if ( $copern == 20 )
    {
?>
<tr>
<span id="Cele" style="display:none; width:100%; align:center; font-family:bold; font-weight:bold; background-color:red; color:black;">
 Hodnota mus� by� cel� kladn� ��slo</span>
<span id="Datum" style="display:none; width:100%; align:center; font-family:bold; font-weight:bold; background-color:red; color:black;">
 D�tum mus� by� v tvare DD.MM.RRRR,DD.MM alebo DD napr�klad 21.10.2008 , 21 program doplni na 21.<?php echo $kli_vume; ?>;</span>
<span id="Desc" style="display:none; width:100%; align:center; font-family:bold; font-weight:bold; background-color:red; color:black;">
 Hodnota mus by� desatinn� ��slo, maxim�lne 2 desatinn� miesta;</span>
<span id="Desc4" style="display:none; width:100%; align:center; font-family:bold; font-weight:bold; background-color:red; color:black;">
 Hodnota mus by� desatinn� ��slo, maxim�lne 4 desatinn� miesta;</span>
<span id="Desc1" style="display:none; width:100%; align:center; font-family:bold; font-weight:bold; background-color:red; color:black;">
 Hodnota mus by� desatinn� ��slo, maxim�lne 1 desatinn� miesto;</span>
<span id="Oc" style="display:none; width:100%; align:center; font-family:bold; font-weight:bold; background-color:red; color:black;">
 OS� mus� by� cel� kladn� ��slo v rozsahu 1 a� 9999</span>
<span id="Fx" style="display:none; width:100%; align:center; font-family:bold; font-weight:bold; background-color:red; color:black;">
 Mus�te vyplni� v�etky polo�ky vstupu</span>
<span id="Ul" style="display:none; width:100%; align:center; font-family:bold; font-weight:bold; background-color:yellow; color:black;">
 Polo�ka OS�=<?php echo $h_oc;?> spr�vne ulo�en�</span>
</tr>
<table class="fmenu" width="100%" style="margin-bottom:5px;">
<FORM name="formv1" class="obyc" method="post" action="../ucto/vykaz_fin204pod.php?copern=23&cislo_oc=<?php echo $cislo_oc;?>&strana=<?php echo $strana;?>" >
<tr>
<td width="10%"></td><td width="10%"></td><td width="10%"></td><td width="10%"></td><td width="10%"></td>
<td width="10%"></td><td width="10%"></td><td width="10%"></td><td width="10%"></td><td width="10%"></td>
</tr>
<?php
$prev_str=$strana-1;
$next_str=$strana+1;
if( $prev_str == 0 ) $prev_str=3;
if( $next_str == 4 ) $next_str=1;
?>
<tr>
<td colspan="4" class="bmenu" width="10%">&nbsp;&nbsp;Strana <?php echo $strana;?>&nbsp;&nbsp;&nbsp;
<a href="#" onclick="window.open('vykaz_fin204pod.php?copern=20&drupoh=1&page=1&subor=0&cislo_oc=<?php echo $cislo_oc;?>&strana=<?php echo $prev_str;?>', '_self' )">
<img src='../obr/prev.png' width=12 height=12 border=0 title='Strana <?php echo $prev_str;?> obdobie <?php echo $cislo_oc; ?>' ></a>
<a href="#" onclick="window.open('vykaz_fin204pod.php?copern=20&drupoh=1&page=1&subor=0&cislo_oc=<?php echo $cislo_oc;?>&strana=<?php echo $next_str;?>', '_self' )">
<img src='../obr/next.png' width=12 height=12 border=0 title='Strana <?php echo $next_str;?> obdobie <?php echo $cislo_oc; ?>' ></a>
</td>
<td colspan="3" class="bmenu">
<img src='../obr/tlac.png' width="20" height="15" border=0 title="Tla�i� vybran� stranu �." ></a>
<a href="#" onclick="window.open('../ucto/vykaz_fin204pod.php?cislo_oc=<?php echo $cislo_oc;?>&copern=10&drupoh=1&page=1&subor=0&strana=1', '_self' );">1</a> 
<a href="#" onclick="window.open('../ucto/vykaz_fin204pod.php?cislo_oc=<?php echo $cislo_oc;?>&copern=10&drupoh=1&page=1&subor=0&strana=2', '_self' );">2</a>
<a href="#" onclick="window.open('../ucto/vykaz_fin204pod.php?cislo_oc=<?php echo $cislo_oc;?>&copern=10&drupoh=1&page=1&subor=0&strana=3', '_self' );">3</a>
</td>
<td colspan="3" class="obyc" align="center"><INPUT type="submit" id="uloz" name="uloz" value="Ulo�i� zmeny"></td>
<!-- 
<a href="#" onclick="window.open('../ucto/vykaz_fin204pod.php?cislo_oc=<?php echo $cislo_oc;?>&copern=20&drupoh=1&page=1&subor=0&strana=1', '_self' );">1</a> 
<a href="#" onclick="window.open('../ucto/vykaz_fin204pod.php?cislo_oc=<?php echo $cislo_oc;?>&copern=20&drupoh=1&page=1&subor=0&strana=2', '_self' );">2</a>
<a href="#" onclick="window.open('../ucto/vykaz_fin204pod.php?cislo_oc=<?php echo $cislo_oc;?>&copern=20&drupoh=1&page=1&subor=0&strana=3', '_self' );">3</a>
 -->
</tr>

<?php if ( $strana == 1   )                           { ?>

<tr><td class="pvstuz" colspan="10">�daje o firme </td></tr>
<tr>
<td class="bmenu" colspan="10">&nbsp;K�d okresu:<input type="text" name="okres" id="okres" size="10" />
K�d obce:&nbsp;<input type="text" name="obec" id="obec" size="10" />
V�kaz zostaven� d�a:&nbsp;<input type="text" name="daz" id="daz" size="10" />
</td>
</tr>
<tr><td style="height:5px;" colspan="10"></td></tr>
<tr><td class="pvstuz" colspan="10">3.1. Vybran� akt�va </td></tr>
<tr>
<td class="pvstuz" colspan="1" align="center">�.r.</td>
<td class="pvstuz" colspan="5" align="center">Popis / ��ty</td>
<td class="pvstuz" colspan="1" align="center">Brutto</td>
<td class="pvstuz" colspan="1" align="center">Korekcia</td>
<td class="pvstuz" colspan="1" align="center">Netto</td>
<td class="pvstuz" colspan="1" align="center">Predch�dzaj�ce</td>
</tr>
<tr>
<td class="bmenu" colspan="1" align="center">01</td>
<td class="bmenu" colspan="5">Dlhodob� nehmotn� majetok (r. 02 a� r. 05)</td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="r01" id="r01" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rk01" id="rk01" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rn01" id="rn01" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rm01" id="rm01" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" style="font-weight:normal;" align="center">02</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;Aktivovan� n�klady na v�voj, ocenite�n� pr�va a goodwill / 012,014,015-(07X,091A)</td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="r02" id="r02" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rk02" id="rk02" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rn02" id="rn02" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rm02" id="rm02" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" align="center" style="font-weight:normal;">03</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;Poskytnut� preddavky na dlhodob� nehmotn� majetok / 051-(095A)</td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="r03" id="r03" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rk03" id="rk03" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rn03" id="rn03" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rm03" id="rm03" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" align="center" style="font-weight:normal;">04</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;In� dlhodob� nehmotn� majetok / 013,018,019-(07x,091A)</td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="r04" id="r04" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rk04" id="rk04" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rn04" id="rn04" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rm04" id="rm04" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" align="center" style="font-weight:normal;">05</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;Obstaranie dlhodob�ho nehmotn�ho majetku / 041-(093)</td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="r05" id="r05" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rk05" id="rk05" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rn05" id="rn05" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rm05" id="rm05" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" align="center">06</td>
<td class="bmenu" colspan="5">Dlhodob� hmotn� majetok (r. 07 a� r. 11 + r. 13 a� r. 16)</td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="r06" id="r06" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rk06" id="rk06" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rn06" id="rn06" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rm06" id="rm06" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" align="center" style="font-weight:normal;">07</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;Pozemky / 031</td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="r07" id="r07" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rk07" id="rk07" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rn07" id="rn07" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rm07" id="rm07" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" align="center" style="font-weight:normal;">08</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;Pestovate�sk� celky trval�ch porastov / 025-(085,092A)</td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="r08" id="r08" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rk08" id="rk08" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rn08" id="rn08" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rm08" id="rm08" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" align="center" style="font-weight:normal;">09</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;Umeleck� diela a zbierky / 032</td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="r09" id="r09" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rk09" id="rk09" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rn09" id="rn09" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rm09" id="rm09" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" align="center" style="font-weight:normal;">10</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;Stavby / 021-(081,092A)</td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="r10" id="r10" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rk10" id="rk10" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rn10" id="rn10" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rm10" id="rm10" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" align="center" style="font-weight:normal;">11</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;Samostatn� hnute�n� veci a s�bory hnute�n�ch vec� / 022-(082,092A)</td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="r11" id="r11" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rk11" id="rk11" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rn11" id="rn11" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rm11" id="rm11" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" align="center" style="font-weight:normal;">12</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;z toho: Dopravn� prostriedky / 023-(083,092A)</td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="r12" id="r12" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rk12" id="rk12" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rn12" id="rn12" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rm12" id="rm12" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" align="center" style="font-weight:normal;">13</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;Poskytnut� preddavky na dlhodob� hmotn� majetok / 052-(095A)</td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="r13" id="r13" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rk13" id="rk13" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rn13" id="rn13" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rm13" id="rm13" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" align="center" style="font-weight:normal;">14</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;In� dlhodob� hmotn� majetok / 026,029,02X -(08X,092A)</td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="r14" id="r14" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rk14" id="rk14" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rn14" id="rn14" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rm14" id="rm14" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" align="center" style="font-weight:normal;">15</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;Obstaranie dlhodob�ho hmotn�ho majetku / 042-(094)</td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="r15" id="r15" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rk15" id="rk15" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rn15" id="rn15" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rm15" id="rm15" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" align="center" style="font-weight:normal;">16</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">Opravn� polo�ka k nadobudnut�mu majetku / +/-097 (+/-098)</td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="r16" id="r16" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rk16" id="rk16" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rn16" id="rn16" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rm16" id="rm16" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" align="center" >17</td>
<td class="bmenu" colspan="5" >&nbsp;Dlhodob� finan�n� majetok (r. 18 a� r. 22) </td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="r17" id="r17" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rk17" id="rk17" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rn17" id="rn17" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rm17" id="rm17" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" align="center" style="font-weight:normal;">18</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;Podielov� cenn� papiere a podiely / 061,062-(096A)</td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="r18" id="r18" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rk18" id="rk18" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rn18" id="rn18" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rm18" id="rm18" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" style="font-weight:normal;" align="center">19</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;Dlhov� CP dr�an� do splatnosti / 065-(096A)</td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="r19" id="r19" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rk19" id="rk19" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rn19" id="rn19" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rm19" id="rm19" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" style="font-weight:normal;" align="center">20</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;P��i�ky ��tovnej jednotke v konsolidovanom celku a ostatn� p��i�ky / 066, 067</td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="r20" id="r20" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rk20" id="rk20" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rn20" id="rn20" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rm20" id="rm20" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" style="font-weight:normal;" align="center">21</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;Poskytnut� preddavky na DhFM a obstaranie DhFM / 053,043-(096A)</td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="r21" id="r21" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rk21" id="rk21" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rn21" id="rn21" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rm21" id="rm21" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" align="center" style="font-weight:normal;">22</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">Ostatn� dlhodob� finan�n� majetok / 069-(096A)</td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="r22" id="r22" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rk22" id="rk22" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rn22" id="rn22" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rm22" id="rm22" size="10" /></td>
</tr>

<?php                                                                  } //koniec 1.strana ?>

<?php if ( $strana == 2  )                           { ?>

<tr><td class="pvstuz" colspan="10">3.1. Vybran� akt�va </td></tr>
<tr>
<td class="pvstuz" colspan="1" align="center">�.r.</td>
<td class="pvstuz" colspan="5" align="center">Popis / ��ty</td>
<td class="pvstuz" colspan="1" align="center">Brutto</td>
<td class="pvstuz" colspan="1" align="center">Korekcia</td>
<td class="pvstuz" colspan="1" align="center">Netto</td>
<td class="pvstuz" colspan="1" align="center">Predch�dzaj�ce</td>
</tr>
<tr>
<td class="bmenu" colspan="1" align="center">23</td>
<td class="bmenu" colspan="5">Z�soby / skupina 11,12,13-(19x)</td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="r23" id="r23" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rk23" id="rk23" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rn23" id="rn23" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rm23" id="rm23" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" align="center" >24</td>
<td class="bmenu" colspan="5" >&nbsp;Poh�ad�vky (r. 25 a� r. 35)</td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="r24" id="r24" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rk24" id="rk24" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rn24" id="rn24" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rm24" id="rm24" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" style="font-weight:normal;" align="center">25</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;Odberatelia / 311-(391A)</td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="r25" id="r25" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rk25" id="rk25" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rn25" id="rn25" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rm25" id="rm25" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" style="font-weight:normal;" align="center">26</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;Zmenky na inkaso / 312</td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="r26" id="r26" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rk26" id="rk26" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rn26" id="rn26" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rm26" id="rm26" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" style="font-weight:normal;" align="center">27</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;Poskytnut� prev�dzkov� preddavky / 314A</td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="r27" id="r27" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rk27" id="rk27" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rn27" id="rn27" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rm27" id="rm27" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" style="font-weight:normal;" align="center">28</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;Poh�ad�vky za eskontovan� cenn� papiere, poh�ad�vky z vydan�ch dlhopisov / 313,375</td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="r28" id="r28" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rk28" id="rk28" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rn28" id="rn28" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rm28" id="rm28" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" style="font-weight:normal;" align="center">29</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;Da�ov� poh�ad�vky a poh�ad�vky zo soci�lneho a zdravotn�ho poistenia / 336,341,342,343,345</td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="r29" id="r29" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rk29" id="rk29" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rn29" id="rn29" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rm29" id="rm29" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" style="font-weight:normal;" align="center">30</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;Dot�cie zo �t�tneho rozpo�tu a ostatn� dot�cie / 346,347</td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="r30" id="r30" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rk30" id="rk30" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rn30" id="rn30" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rm30" id="rm30" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" style="font-weight:normal;" align="center">31</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;Poh�ad�vky z n�jmu/ 374-(391A)</td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="r31" id="r31" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rk31" id="rk31" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rn31" id="rn31" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rm31" id="rm31" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" style="font-weight:normal;" align="center">32</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;Poh�ad�vky z pevn�ch term�nov�ch oper�ci� a nak�pen� opcie / 373A,376-(391A)</td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="r32" id="r32" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rk32" id="rk32" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rn32" id="rn32" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rm32" id="rm32" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" style="font-weight:normal;" align="center">33</td>
<td class="bmenu" colspan="5" style="font-weight:normal;" >Poh�ad�vky vo�i ��astn�kom zdru�enia, spojovac� ��et pri zdru�en� / 358,398A-(391A)</td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="r33" id="r33" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rk33" id="rk33" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rn33" id="rn33" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rm33" id="rm33" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" style="font-weight:normal;" align="center">34</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;Poh�ad�vky v r�mci konsolid.celku, vo�i spolo�n�kom a �lenom,z predaja podniku / 351,354,355,35X,371-(391A)</td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="r34" id="r34" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rk34" id="rk34" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rn34" id="rn34" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rm34" id="rm34" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" style="font-weight:normal;" align="center">35</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;Ostatn� poh�ad�vky / 315,335,378-(391A)</td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="r35" id="r35" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rk35" id="rk35" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rn35" id="rn35" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rm35" id="rm35" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1"  align="center" >36</td>
<td class="bmenu" colspan="5" >&nbsp;Finan�n� ��ty (r. 37 a� r. 41) </td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="r36" id="r36" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rk36" id="rk36" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rn36" id="rn36" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rm36" id="rm36" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" style="font-weight:normal;" align="center">37</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;Pokladnica a ceniny / 211,213</td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="r37" id="r37" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rk37" id="rk37" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rn37" id="rn37" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rm37" id="rm37" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" style="font-weight:normal;" align="center">38</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;Bankov� ��ty / 221+-261</td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="r38" id="r38" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rk38" id="rk38" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rn38" id="rn38" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rm38" id="rm38" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" align="center"style="font-weight:normal;">39</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;Majetkov� cenn� papiere / 251,257A,25XA-(291A,29X)</td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="r39" id="r39" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rk39" id="rk39" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rn39" id="rn39" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rm39" id="rm39" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" align="center"style="font-weight:normal;">40</td>
<td class="bmenu" colspan="5"style="font-weight:normal;">&nbsp;Dlhov� cenn� papiere / 253,256,257A,25XA-(291A,29X)</td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="r40" id="r40" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rk40" id="rk40" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rn40" id="rn40" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rm40" id="rm40" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" align="center" style="font-weight:normal;">41</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">Obstaranie kr�tkodob�ho finan�n�ho majetku / 259,314A-(291A,391A)</td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="r41" id="r41" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rk41" id="rk41" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rn41" id="rn41" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rm41" id="rm41" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" align="center">42</td>
<td class="bmenu" colspan="5">&nbsp;�asov� rozl�enie / 381, 382, 385</td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="r42" id="r42" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rk42" id="rk42" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rn42" id="rn42" size="10" /></td>
<td class="bmenu" colspan="1" align="center"><input type="text" name="rm42" id="rm42" size="10" /></td>
</tr>
<tr>
<td class="pvstuz" colspan="1" align="center">43</td>
<td class="pvstuz" colspan="5">&nbsp;Vybran� akt�va spolu (r. 01 + r. 06 + r. 17 + r. 23 + r. 24 + r. 36 + r. 42)</td>
<td class="pvstuz" colspan="1" align="center"><input type="text" name="r43" id="r43" size="10" /></td>
<td class="pvstuz" colspan="1" align="center"><input type="text" name="rk43" id="rk43" size="10" /></td>
<td class="pvstuz" colspan="1" align="center"><input type="text" name="rn43" id="rn43" size="10" /></td>
<td class="pvstuz" colspan="1" align="center"><input type="text" name="rm43" id="rm43" size="10" /></td>
</tr>


<?php                                                                  } //koniec 2.strana ?>

<?php if ( $strana == 3  )                           { ?>
<tr>
<td class="pvstuz" colspan="10">3.2. Vybran� pas�va </td>
</tr>
<tr>
<td class="pvstuz" colspan="1" align="center">�.r.</td>
<td class="pvstuz" colspan="5" align="center">Popis / ��ty</td>
<td class="pvstuz" colspan="2" align="center">Be�n� obdobie</td>
<td class="pvstuz" colspan="2" align="center">Predch�dzaj�ce</td>
</tr>
<tr>
<td class="bmenu" colspan="1" align="center">44</td>
<td class="bmenu" colspan="5">Rezervy / <span style="font-weight:normal;">323,451,459</span></td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="r44" id="r44" size="10" /></td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="rm44" id="rm44" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" align="center">45</td>
<td class="bmenu" colspan="5">Z�v�zky (r. 46 a� r. 50 + r. 53 + r. 56 + r. 59 a� r. 65)</td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="r45" id="r45" size="10" /></td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="rm45" id="rm45" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" style="font-weight:normal;" align="center">46</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;Dlhodob� zmenky na �hradu / 478</td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="r46" id="r46" size="10" /></td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="rm46" id="rm46" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" style="font-weight:normal;" align="center">47</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;Kr�tkodob� zmenky na �hradu / 322</td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="r47" id="r47" size="10" /></td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="rm47" id="rm47" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" style="font-weight:normal;" align="center">48</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;Z�v�zky z pevn�ch term�nov�ch oper�ci� / 373A</td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="r48" id="r48" size="10" /></td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="rm48" id="rm48" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" style="font-weight:normal;" align="center">49</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;Vydan� dlhopisy dlhodob� / 473</td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="r49" id="r49" size="10" /></td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="rm49" id="rm49" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" style="font-weight:normal;" align="center">50</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;Dod�vatelia a nevyfakturovan� dod�vky / 321,326,476</td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="r50" id="r50" size="10" /></td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="rm50" id="rm50" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" style="font-weight:normal;" align="center">51</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;&nbsp;&nbsp;- kr�tkodob�</td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="r51" id="r51" size="10" /></td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="rm51" id="rm51" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" style="font-weight:normal;" align="center">52</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;&nbsp;&nbsp;- dlhodob�</td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="r52" id="r52" size="10" /></td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="rm52" id="rm52" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" style="font-weight:normal;" align="center">53</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">Prijat� preddavky / 324,475</td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="r53" id="r53" size="10" /></td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="rm53" id="rm53" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" style="font-weight:normal;" align="center">54</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;&nbsp;&nbsp;- kr�tkodob�</td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="r54" id="r54" size="10" /></td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="rm54" id="rm54" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" style="font-weight:normal;" align="center">55</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;&nbsp;&nbsp;- dlhodob�</td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="r55" id="r55" size="10" /></td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="rm55" id="rm55" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" style="font-weight:normal;" align="center">56</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;Z�v�zky z n�jmu / 474</td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="r56" id="r56" size="10" /></td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="rm56" id="rm56" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" style="font-weight:normal;" align="center">57</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;&nbsp;&nbsp;- kr�tkodob�</td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="r57" id="r57" size="10" /></td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="rm57" id="rm57" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" style="font-weight:normal;" align="center">58</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;&nbsp;&nbsp;- dlhodob�</td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="r58" id="r58" size="10" /></td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="rm58" id="rm58" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" style="font-weight:normal;" align="center">59</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;Z�v�zky vo�i zamestnancom / 331,333</td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="r59" id="r59" size="10" /></td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="rm59" id="rm59" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" style="font-weight:normal;" align="center">60</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;Da�ov� z�v�zky a z�v�zky zo soc. a zdravot. poistenia / 336,341,342,343,345</td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="r60" id="r60" size="10" /></td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="rm60" id="rm60" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" style="font-weight:normal;" align="center">61</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;Dot�cie a z��tovanie so �R a ostatn� / 346,348</td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="r61" id="r61" size="10" /></td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="rm61" id="rm61" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" style="font-weight:normal;" align="center">62</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;Z�v�zky z up�san�ch nesplaten�ch CP a vkladov / 367</td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="r62" id="r62" size="10" /></td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="rm62" id="rm62" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" style="font-weight:normal;" align="center">63</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;Z�v�zky vo�i ��astn�kom zdru�en�, spojovac� ��et pri zdru�en� / 368,396</td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="r63" id="r63" size="10" /></td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="rm63" id="rm63" size="10" /></td>
</tr>

<tr>
<td class="bmenu" colspan="1" style="font-weight:normal;" align="center">64</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;Z�v�zky v r�mci konsolidovan�ho celku, vo�i spolo�n�kom a �lenom, z k�py podniku / 361,364,365,366,372</td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="r64" id="r64" size="10" /></td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="rm64" id="rm64" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" style="font-weight:normal;" align="center">65</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;Ostatn� z�v�zky / 325,379,472,479</td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="r65" id="r65" size="10" /></td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="rm65" id="rm65" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" style="font-weight:normal;" align="center">66</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;&nbsp;&nbsp;- kr�tkodob�</td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="r66" id="r66" size="10" /></td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="rm66" id="rm66" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" style="font-weight:normal;" align="center">67</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;&nbsp;&nbsp;- dlhodob�</td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="r67" id="r67" size="10" /></td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="rm67" id="rm67" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" align="center">68</td>
<td class="bmenu" colspan="5">Bankov� �very a v�pomoci (r.69 a� r.72)</td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="r68" id="r68" size="10" /></td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="rm68" id="rm68" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" style="font-weight:normal;" align="center">69</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;Dlhodob� bankov� �very / 461A</td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="r69" id="r69" size="10" /></td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="rm69" id="rm69" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" style="font-weight:normal;" align="center">70</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;Be�n� bankov� �very / 231,232,461A</td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="r70" id="r70" size="10" /></td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="rm70" id="rm70" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" style="font-weight:normal;" align="center">71</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;Vydan� dlhopisy kr�tkodob� / 241</td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="r71" id="r71" size="10" /></td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="rm71" id="rm71" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" style="font-weight:normal;" align="center">72</td>
<td class="bmenu" colspan="5" style="font-weight:normal;">&nbsp;Kr�tkodob� finan�n� v�pomoci / 249</td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="r72" id="r72" size="10" /></td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="rm72" id="rm72" size="10" /></td>
</tr>
<tr>
<td class="bmenu" colspan="1" align="center">73</td>
<td class="bmenu" colspan="5">�asov� rozl�enie / <span style="font-weight:normal;">383,384</span></td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="r73" id="r73" size="10" /></td>
<td class="bmenu" colspan="2" align="center"><input type="text" name="rm73" id="rm73" size="10" /></td>
</tr>
<tr>
<td class="pvstuz" colspan="1" align="center">74</td>
<td class="pvstuz" colspan="5">Vybran� pas�va spolu (r. 44 + r. 45 + r. 68 + r. 73)</td>
<td class="pvstuz" colspan="2" align="center"><input type="text" name="r74" id="r74" size="10" /></td>
<td class="pvstuz" colspan="2" align="center"><input type="text" name="rm74" id="rm74" size="10" /></td>
</tr>






<?php                                                                  } //koniec 3.strana ?>






</FORM>

</table>

<div id="myBANKADelement"></div>
<div id="jeBANKADelement"></div>


<script type="text/javascript">

</script>

<?php
//mysql_free_result($vysledok);
    }
//koniec uprav  udaje 
?>


<?php
$sqlt = 'DROP TABLE F'.$kli_vxcf.'_uctprcvykaz'.$kli_uzid;
$vysledok = mysql_query("$sqlt");
$sqlt = 'DROP TABLE F'.$kli_vxcf.'_uctprcvykazx'.$kli_uzid;
$vysledok = mysql_query("$sqlt");
$sqlt = 'DROP TABLE F'.$kli_vxcf.'_uctprcvykazz'.$kli_uzid;
$vysledok = mysql_query("$sqlt");

// celkovy koniec dokumentu
$cislista = include("uct_lista.php");
       } while (false);
?>
</BODY>
</HTML>
