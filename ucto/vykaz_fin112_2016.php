<!doctype html>
<HTML>
<?php
//celkovy zaciatok
do
{
$sys = 'UCT';
$urov = 3000;
$copern = $_REQUEST['copern'];

$uziv = include("../uziv.php");
if ( !$uziv ) exit;

require_once("../pswd/password.php");
@$spojeni = mysql_connect($mysqlhost, $mysqluser, $mysqlpasswd);
  if (!$spojeni):
    echo "Spojenie so serverom nedostupne.";
    exit;
  endif;
  mysql_select_db($mysqldb);

//datumove funkcie
$sDat = include("../funkcie/dat_sk_us.php");

//ramcek fpdf 1=zap,0=vyp
$rmc=0;
$rmc1=0;

//.jpg podklad
$jpg_cesta="../dokumenty/statistika2016/fin112/fin1-12_v16";
$jpg_popis="Finan�n� v�kaz o pr�jmoch, v�davkoch a finan�n�ch oper�ci�ch FIN 1-12 za rok ".$kli_vrok;

$pole = explode(".", $kli_vume);
$kli_vmes=$pole[0];
$kli_vrok=$pole[1];

$citfir = include("../cis/citaj_fir.php");

$cislo_oc = 1*$_REQUEST['cislo_oc'];
$subor = $_REQUEST['subor'];
$strana = 1*$_REQUEST['strana'];
if ( $strana == 0 ) $strana=9999;

if ( $cislo_oc == 0 ) $cislo_oc=1;
if( $cislo_oc == 1 ) { $datum="31.01.".$kli_vrok; $mesiac="01"; $kli_vume="1.".$kli_vrok; }
if( $cislo_oc == 2 ) { $datum="28.02.".$kli_vrok; $mesiac="02"; $kli_vume="2.".$kli_vrok; }
if( $cislo_oc == 3 ) { $datum="31.03.".$kli_vrok; $mesiac="03"; $kli_vume="3.".$kli_vrok; }
if( $cislo_oc == 4 ) { $datum="30.04.".$kli_vrok; $mesiac="04"; $kli_vume="4.".$kli_vrok; }
if( $cislo_oc == 5 ) { $datum="31.05.".$kli_vrok; $mesiac="05"; $kli_vume="5.".$kli_vrok; }
if( $cislo_oc == 6 ) { $datum="30.06.".$kli_vrok; $mesiac="06"; $kli_vume="6.".$kli_vrok; }
if( $cislo_oc == 7 ) { $datum="31.07.".$kli_vrok; $mesiac="07"; $kli_vume="7.".$kli_vrok; }
if( $cislo_oc == 8 ) { $datum="31.08.".$kli_vrok; $mesiac="08"; $kli_vume="8.".$kli_vrok; }
if( $cislo_oc == 9 ) { $datum="30.09.".$kli_vrok; $mesiac="09"; $kli_vume="9.".$kli_vrok; }
if( $cislo_oc == 10 ) { $datum="31.10.".$kli_vrok; $mesiac="10"; $kli_vume="10.".$kli_vrok; }
if( $cislo_oc == 11 ) { $datum="30.11.".$kli_vrok; $mesiac="11"; $kli_vume="11.".$kli_vrok; }
if( $cislo_oc == 12 ) { $datum="31.12.".$kli_vrok; $mesiac="12"; $kli_vume="12.".$kli_vrok; }


$vsetkyprepocty=0;

//vymaz polozku
if ( $copern == 316 )
    {
$cislo_cpl = 1*$_REQUEST['cislo_cpl'];

$sql = "SELECT * FROM F$kli_vxcf"."_uctvykaz_fin104 WHERE cpl = $cislo_cpl";
$sqldok = mysql_query("$sql");
  if (@$zaznam=mysql_data_seek($sqldok,0))
  {
  $riaddok=mysql_fetch_object($sqldok);
  $meno=$riaddok->meno;

$zdroj = $riaddok->zdroj;
$oddiel = $riaddok->oddiel;
$polozka = $riaddok->polozka;
$schvaleny = 1*$riaddok->schvaleny;
$zmeneny = 1*$riaddok->zmeneny;
$predpoklad = 1*$riaddok->predpoklad;
$skutocnost = 1*$riaddok->skutocnost;
  }


$sqtoz = "DELETE FROM F$kli_vxcf"."_uctvykaz_fin104 WHERE cpl = $cislo_cpl";
$oznac = mysql_query("$sqtoz");
$copern=20;

    }
//koniec vymaz polozku


// zapis polozku
if ( $copern == 23 )
    {
$daz = $_REQUEST['daz'];
$daz_sql = SqlDatum($daz);
//$zdroj = strip_tags($_REQUEST['zdroj']);
//$oddiel = strip_tags($_REQUEST['oddiel']);



if ( $strana == 2 OR $strana == 4 )    {


$polozka = strip_tags($_REQUEST['polozka']);
$schvaleny = 1*$_REQUEST['schvaleny'];
$zmeneny = 1*$_REQUEST['zmeneny'];
$predpoklad = 1*$_REQUEST['predpoklad'];
$skutocnost = 1*$_REQUEST['skutocnost'];
$druh=$strana-1;

$uprtxt = "UPDATE F$kli_vxcf"."_uctvykaz_fin104set SET zdroj='$zdroj' ";
$upravene = mysql_query("$uprtxt");


$uprtxt = "INSERT INTO F$kli_vxcf"."_uctvykaz_fin104 (oc,druh,zdroj,polozka,schvaleny,zmeneny,predpoklad,skutocnost) VALUES ".
" (  '$cislo_oc', '$druh', '$zdroj', '$polozka', '$schvaleny', '$zmeneny', '$predpoklad', '$skutocnost' ) ";

//echo $uprtxt;
$upravene = mysql_query("$uprtxt");

$uprtxt = "UPDATE F$kli_vxcf"."_uctvykaz_fin104 SET ".
" daz='$daz_sql' ".
//" okres='', obec='', daz='$daz_sql', xpolozka=SUBSTRING(polozka,1,3), podpolozka=SUBSTRING(polozka,4,3), ".
//" xoddiel=SUBSTRING(oddiel,1,2), skupina=SUBSTRING(oddiel,4,1), trieda=SUBSTRING(oddiel,6,1), podtrieda=SUBSTRING(oddiel,8,1) ".
" WHERE oc >= 0 "; 
//echo $uprtxt;
$upravene = mysql_query("$uprtxt");



                       }



if ( $strana == 3 OR $strana == 5 )    {

$polozka = strip_tags($_REQUEST['polozka']);
$schvaleny = 1*$_REQUEST['schvaleny'];
$zmeneny = 1*$_REQUEST['zmeneny'];
$predpoklad = 1*$_REQUEST['predpoklad'];
$skutocnost = 1*$_REQUEST['skutocnost'];

$druh=$strana-1;

$uprtxt = "UPDATE F$kli_vxcf"."_uctvykaz_fin104set SET zdroj='$zdroj', oddiel='$oddiel' ";
$upravene = mysql_query("$uprtxt");


$uprtxt = "INSERT INTO F$kli_vxcf"."_uctvykaz_fin104 (oc,druh,zdroj,oddiel,polozka,schvaleny,zmeneny,predpoklad,skutocnost) VALUES ".
" (  '$stvrtrok', '$druh', '$zdroj', '$oddiel', '$polozka', '$schvaleny', '$zmeneny', '$predpoklad', '$skutocnost' ) ";

//echo $uprtxt;
$upravene = mysql_query("$uprtxt");

$uprtxt = "UPDATE F$kli_vxcf"."_uctvykaz_fin104 SET ".
" okres='$okres', obec='$obec', daz='$daz_sql', xpolozka=SUBSTRING(polozka,1,3), podpolozka=SUBSTRING(polozka,4,3), ".
" xoddiel=SUBSTRING(oddiel,1,2), skupina=SUBSTRING(oddiel,4,1), trieda=SUBSTRING(oddiel,6,1), podtrieda=SUBSTRING(oddiel,8,1) ".
" WHERE oc >= 0 "; 
//echo $uprtxt;
$upravene = mysql_query("$uprtxt");

                       }


$copern=20;
if (!$upravene):
?>
<script type="text/javascript"> alert( "�DAJE NEBOLI UPRAVEN�" ) </script>
<?php
endif;
if ($upravene):
$uprav="OK";
endif;
    }
//koniec zapisu polozky


//prac.subor a subor 
$sqlt = 'DROP TABLE F'.$kli_vxcf.'_uctprcvykaz'.$kli_uzid;
$vysledok = mysql_query("$sqlt");
$sqlt = 'DROP TABLE F'.$kli_vxcf.'_uctprcvykazx'.$kli_uzid;
$vysledok = mysql_query("$sqlt");
$sqlt = 'DROP TABLE F'.$kli_vxcf.'_uctprcvykazz'.$kli_uzid;
$vysledok = mysql_query("$sqlt");

$sql = "SELECT px12 FROM F".$kli_vxcf."_uctvykaz_fin104";
$vysledok = mysql_query($sql);
if (!$vysledok)
{
$sqlt = 'DROP TABLE F'.$kli_vxcf.'_uctvykaz_fin104';
$vysledok = mysql_query("$sqlt");


$pocdes="10,2";
$sqlt = <<<mzdprc
(
   cpl         int not null auto_increment,
   px12         DECIMAL($pocdes) DEFAULT 0,
   oc           INT(7) DEFAULT 0,
   druh         DECIMAL(10,0) DEFAULT 0,
   okres        VARCHAR(11) NOT NULL,
   obec         VARCHAR(11) NOT NULL,
   daz          DATE NOT NULL,
   kor          INT DEFAULT 0,
   prx          INT DEFAULT 0,
   uce          VARCHAR(11) NOT NULL,
   ucm          VARCHAR(11) NOT NULL,
   ucd          VARCHAR(11) NOT NULL,
   hod          DECIMAL($pocdes) DEFAULT 0,
   mdt          DECIMAL($pocdes) DEFAULT 0,
   dal          DECIMAL($pocdes) DEFAULT 0,
   program      VARCHAR(11) NOT NULL,
   zdroj        VARCHAR(11) NOT NULL,
   oddiel       VARCHAR(11) NOT NULL,
   skupina      VARCHAR(11) NOT NULL,
   trieda       VARCHAR(11) NOT NULL,
   podtrieda    VARCHAR(11) NOT NULL,
   polozka      VARCHAR(11) NOT NULL,
   podpolozka   VARCHAR(11) NOT NULL,
   nazov        VARCHAR(80) NOT NULL,
   schvaleny    DECIMAL($pocdes) DEFAULT 0,
   zmeneny      DECIMAL($pocdes) DEFAULT 0,
   skutocnost   DECIMAL($pocdes) DEFAULT 0,
   ico          INT DEFAULT 0,
   PRIMARY KEY(cpl)
);
mzdprc;

$vsql = 'CREATE TABLE F'.$kli_vxcf.'_uctvykaz_fin104'.$sqlt;
$vytvor = mysql_query("$vsql");

}
//koniec create
$sql = "SELECT xpolozka FROM F".$kli_vxcf."_uctvykaz_fin104";
$vysledok = mysql_query($sql);
if (!$vysledok)
{
$sql = "ALTER TABLE F$kli_vxcf"."_uctvykaz_fin104 ADD xpolozka VARCHAR(11) NOT NULL AFTER polozka";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_uctvykaz_fin104 ADD xoddiel VARCHAR(11) NOT NULL AFTER oddiel";
$vysledek = mysql_query("$sql");
}

$sql = "SELECT predpoklad FROM F".$kli_vxcf."_uctvykaz_fin104";
$vysledok = mysql_query($sql);
if (!$vysledok)
{
$sql = "ALTER TABLE F$kli_vxcf"."_uctvykaz_fin104 ADD predpoklad DECIMAL(10,2) DEFAULT 0 AFTER zmeneny";
$vysledek = mysql_query("$sql");
}

$sql = "SELECT px12 FROM F".$kli_vxcf."_uctvykaz_fin104set";
$vysledok = mysql_query($sql);
if (!$vysledok)
{
$sqlt = 'DROP TABLE F'.$kli_vxcf.'_uctvykaz_fin104set';
$vysledok = mysql_query("$sqlt");

$sqlt = <<<mzdprc
(
   cpl         int not null auto_increment,
   px12         DECIMAL(10,0) DEFAULT 0,
   program      VARCHAR(11) NOT NULL,
   zdroj        VARCHAR(11) NOT NULL,
   oddiel       VARCHAR(11) NOT NULL,
   skupina      VARCHAR(11) NOT NULL,
   trieda       VARCHAR(11) NOT NULL,
   ico          INT DEFAULT 0,
   PRIMARY KEY(cpl)
);
mzdprc;

$vsql = 'CREATE TABLE F'.$kli_vxcf.'_uctvykaz_fin104set '.$sqlt;
$vytvor = mysql_query("$vsql");

$uprtxt = "INSERT INTO F$kli_vxcf"."_uctvykaz_fin104set ( zdroj, oddiel ) VALUES (  '46', '0.7.2.2' ) ";
$upravene = mysql_query("$uprtxt");

}

//koniec vytvorenie 


//vypocty
if ( $copern == 10 OR $copern == 20 )
{

$uprtxt = "UPDATE F$kli_vxcf"."_uctvykaz_fin104 SET program='', zdroj='' WHERE druh = 3 OR druh = 4 ";
$upravene = mysql_query("$uprtxt");

$uprtxt = "UPDATE F$kli_vxcf"."_uctvykaz_fin104 SET ".
" xpolozka=SUBSTRING(polozka,1,3), podpolozka=SUBSTRING(polozka,4,3), ".
" xoddiel=SUBSTRING(oddiel,1,2), skupina=SUBSTRING(oddiel,4,1), trieda=SUBSTRING(oddiel,6,1), podtrieda=SUBSTRING(oddiel,8,1) ".
" WHERE oc >= 0 "; 
//echo $uprtxt;
$upravene = mysql_query("$uprtxt");

}
//koniec vypocty


if( $strana == 9999 ) $strana=1;

//nacitaj udaje pre upravu
if ( $copern == 20 )
    {
$sqlfir = "SELECT * FROM F$kli_vxcf"."_uctvykaz_fin104set  ";

$fir_vysledok = mysql_query($sqlfir);
$fir_riadok=mysql_fetch_object($fir_vysledok);


$zdrojx = $fir_riadok->zdroj;
$oddielx = $fir_riadok->oddiel;


mysql_free_result($fir_vysledok);



    }
//koniec nacitania

//6-miestne ico
$fir_ficox=$fir_fico; if ( $fir_ficox < 999999 ) { $fir_ficox="00".$fir_ficox; }

//skrateny datum k
$skutku=substr($datum,0,6);
?>
<HEAD>
<META http-equiv="Content-Type" content="text/html; charset=cp1250">
 <link rel="stylesheet" href="../css/reset.css">
 <link rel="stylesheet" href="../css/tlaciva.css">
<title>V�kaz FIN 1-12</title>
<style type="text/css">
form input[type=text] {
  height: 20px;
  line-height: 20px;
  padding-left: 4px;
  border: 1px solid #39f;
  font-size: 14px;
}
div.input-echo {
  position: absolute;
  font-size: 16px;
  background-color: #fff;
  font-weight: bold;
}
div.form-background-wide {
  width: 1250px;
  height: 1000px;
  background-color: #fff;
  clear: left;
}
div.form-content-wide {
  width: 1150px;
  margin: 0 auto;
}
h2.form-header {
  height: 30px;
  line-height: 30px;
  padding-top: 15px;
  font-size: 15px;
}
.fixne-menu {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  z-index: 1;
  padding: 6px 0;
  background-color: #ddd;
}
table.table-heading {
  width: 1150px;
  background-color: #ddd;
  height: 24px;
  line-height: 24px;
  text-align: center;
  font-size: 11px;
  margin: 0 auto;
}
table.zoznam tbody tr:hover {
  background-color:#ddd;
}
table.zoznam tbody td {
  font-size: 12px;
  line-height: 20px;
}
table.zoznam tfoot th {
  height: 24px;
  line-height: 24px;
  font-size: 11px;
  background-color: #ddd;
}
table.zoznam tfoot td input[type=text] {
  height: 18px;
  line-height: 18px;
  padding-left: 4px;
  border: 1px solid #39f;
  font-size: 14px;
  position: static;
  display: block;
  margin: 6px auto;
}
/* dopyt, spravi� zebru */
tr.zero-line > td { /* urcenie sirky stlpcov */
  height: 0;
}

img.btn-cancel {
  width: 14px;
  height: 14px;
  position: relative;
  top: 3px;
  cursor: pointer;
  opacity: 0.7;
}
img.btn-cancel:hover {
  opacity: 1;
}
</style>
<script type="text/javascript">
<?php
//uprava 
  if ( $copern == 20 )
  { 
?>


function ProgramEnter(e)
                {
  var k = (navigator.appName=="Netscape") ? e : event.keyCode; // k�d stla�enej kl�vesy

  if(k == 13 ){
        document.forms.formv1.zdroj.focus();
        document.forms.formv1.zdroj.select();
              }
                }

function ZdrojEnter(e)
                {
  var k = (navigator.appName=="Netscape") ? e : event.keyCode; // k�d stla�enej kl�vesy

  if(k == 13 ){
        <?php if ( $strana == 2 ) { ?>
        document.forms.formv1.polozka.focus();
        document.forms.formv1.polozka.select();
        <?php                     } ?>
        <?php if ( $strana == 3 ) { ?>
        document.forms.formv1.oddiel.focus();
        document.forms.formv1.oddiel.select();
        <?php                     } ?>
              }
                }

function OddielEnter(e)
                {
  var k = (navigator.appName=="Netscape") ? e : event.keyCode; // k�d stla�enej kl�vesy

  if(k == 13 ){
        document.forms.formv1.polozka.focus();
        document.forms.formv1.polozka.select();
              }
                }

function PolozkaEnter(e)
                {
  var k = (navigator.appName=="Netscape") ? e : event.keyCode; // k�d stla�enej kl�vesy

  if(k == 13 ){
        <?php if ( $strana <= 3 ) { ?>
        document.forms.formv1.schvaleny.focus();
        document.forms.formv1.schvaleny.select();
        <?php                     } ?>
        <?php if ( $strana >  3 ) { ?>
        document.forms.formv1.skutocnost.focus();
        document.forms.formv1.skutocnost.select();
        <?php                     } ?>

              }
                }

function SchvalenyEnter(e)
                {
  var k = (navigator.appName=="Netscape") ? e : event.keyCode; // k�d stla�enej kl�vesy

  if(k == 13 ){
        document.formv1.zmeneny.value=document.formv1.schvaleny.value; 
        document.forms.formv1.zmeneny.focus();
        document.forms.formv1.zmeneny.select();
              }
                }

function ZmenenyEnter(e)
                {
  var k = (navigator.appName=="Netscape") ? e : event.keyCode; // k�d stla�enej kl�vesy

  if(k == 13 ){
        document.forms.formv1.predpoklad.focus();
        document.forms.formv1.predpoklad.select();
              }
                }

function PredpokladEnter(e)
                {
  var k = (navigator.appName=="Netscape") ? e : event.keyCode; // k�d stla�enej kl�vesy

  if(k == 13 ){
        document.forms.formv1.skutocnost.focus();
        document.forms.formv1.skutocnost.select();
              }
                }

function SkutocnostEnter(e)
                {
  var k = (navigator.appName=="Netscape") ? e : event.keyCode; // k�d stla�enej kl�vesy

  if(k == 13 ){

    var okvstup=1;

<?php if ( $strana == 2 OR $strana == 3 )           { ?>
    if ( document.formv1.zdroj.value == '' ) okvstup=0;
    if ( document.formv1.zdroj.value == 0 ) okvstup=0;
<?php                                               } ?>
    if ( document.formv1.polozka.value == '' ) okvstup=0;
    if ( document.formv1.polozka.value == 0 ) okvstup=0;

    if ( okvstup == 1 ) { document.formv1.uloz.disabled = false; Fx.style.display="none"; return (true);  document.forms.formv1.submit(); return (true); }
       else { document.formv1.uloz.disabled = true; Fx.style.display=""; return (false) ; }

              }
                }


    function ObnovUI()
    {

<?php if ( $strana == 2 )                           { ?>

<?php if( $zdroj == '' ) { $zdroj=$zdrojx; } ?>

document.formv1.zdroj.value = '<?php echo $zdroj;?>';
document.formv1.polozka.value = '<?php echo $polozka;?>';
document.formv1.schvaleny.value = '<?php echo $schvaleny;?>';
document.formv1.zmeneny.value = '<?php echo $zmeneny;?>';
document.formv1.predpoklad.value = '<?php echo $predpoklad;?>';
document.formv1.skutocnost.value = '<?php echo $skutocnost;?>';

       // document.forms.formv1.zdroj.focus(); dopyt, potom zru�i� //
        //document.forms.formv1.zdroj.select();


<?php                                               } ?>

<?php if ( $strana == 4 )                           { ?>



document.formv1.polozka.value = '<?php echo $polozka;?>';
document.formv1.skutocnost.value = '<?php echo $skutocnost;?>';


        document.forms.formv1.polozka.focus();
        document.forms.formv1.polozka.select();


<?php                                               } ?>

<?php if ( $strana == 3 )                           { ?>

<?php if( $zdroj == '' ) { $zdroj=$zdrojx; } ?>
<?php if( $oddiel == '' ) { $zdroj=$oddielx; } ?>

document.formv1.zdroj.value = '<?php echo $zdroj;?>';
document.formv1.oddiel.value = '<?php echo $oddiel;?>';
document.formv1.polozka.value = '<?php echo $polozka;?>';
document.formv1.schvaleny.value = '<?php echo $schvaleny;?>';
document.formv1.zmeneny.value = '<?php echo $zmeneny;?>';
document.formv1.predpoklad.value = '<?php echo $predpoklad;?>';
document.formv1.skutocnost.value = '<?php echo $skutocnost;?>';

 document.formv1.uloz.disabled = true;
        //document.forms.formv1.zdroj.focus();
        //document.forms.formv1.zdroj.select();

<?php                                               } ?>

<?php if ( $strana == 5 )                           { ?>

<?php if( $oddiel == '' ) { $zdroj=$oddielx; } ?>

document.formv1.oddiel.value = '<?php echo $oddiel;?>';
document.formv1.polozka.value = '<?php echo $polozka;?>';
document.formv1.skutocnost.value = '<?php echo $skutocnost;?>';

 document.formv1.uloz.disabled = true;
        document.forms.formv1.oddiel.focus();
        document.forms.formv1.oddiel.select();
<?php                                                } ?>



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

//Z ciarky na bodku
  function CiarkaNaBodku(Vstup)
  {
   if ( Vstup.value.search(/[^0-9.-]/g) != -1) { Vstup.value=Vstup.value.replace(",","."); }
  }

  function MetodVypln()
  {
   window.open('<?php echo $jpg_cesta; ?>_vysvetlivky.pdf',
'_blank', 'width=980, height=900, top=0, left=20, status=yes, resizable=yes, scrollbars=yes, menubar=yes, toolbar=yes');
  }
  function TlacVykaz()
  {
   window.open('vykaz_fin112_2016.php?cislo_oc=<?php echo $cislo_oc;?>&copern=10&drupoh=1&page=1&subor=0&strana=9999',
'_blank', 'width=1050, height=900, top=0, left=20, status=yes, resizable=yes, scrollbars=yes');
  }

function DbfFin112nujpod()
                {

window.open('fin112nujpoddbf.php?cislo_oc=<?php echo $cislo_oc;?>&copern=1&drupoh=1&page=1&subor=0',
 '_blank', 'width=1080, height=900, top=0, left=10, status=yes, resizable=yes, scrollbars=yes' );
                }

  function Vymaz(cpl)
  {
   window.open('vykaz_fin112_2016.php?cislo_oc=<?php echo $cislo_oc;?>&copern=316&drupoh=1&page=1&subor=0&strana=2&cislo_cpl=' + cpl + '&xx=1',
'_self', 'width=1050, height=900, top=0, left=20, status=yes, resizable=yes, scrollbars=yes');
  }
</script>
</HEAD>
<BODY onload="ObnovUI();">
<?php
//uprav udaje
if ( $copern == 20 )
     {
?>
<div id="wrap-heading">
 <table id="heading">
 <tr>
  <td class="ilogin">EuroSecom</td>
  <td class="ilogin" align="right"><?php echo "<strong>UME</strong> $kli_vume&nbsp;&nbsp;<strong>FIR</strong> $kli_vxcf:$kli_nxcf&nbsp;&nbsp;<strong>login</strong> $kli_uzmeno $kli_uzprie / $kli_uzid";?></td>
 </tr>
 <tr>
  <td class="header">FIN 1-12 Pr�jmy, v�davky a finan�n� oper�cie za
   <span style="color:#39f;"><?php echo "$cislo_oc. mesiac";?></span>
  </td>
  <td>
   <div class="bar-btn-form-tool">
    <img src="../obr/ikony/info_blue_icon.png" onclick="MetodVypln();" title="Vysvetlivky na vyplnenie v�kazu" class="btn-form-tool">
    <img src="../obr/ikony/upbox_blue_icon.png" onclick="DbfFin112nujpod();" title="Export do DBF" class="btn-form-tool">
    <img src="../obr/ikony/printer_blue_icon.png" onclick="TlacVykaz();" title="Zobrazi� v�etky strany v PDF" class="btn-form-tool">
   </div>
  </td>
 </tr>
 </table>
</div>
<?php if ( $strana < 1 OR $strana > 5 ) $strana=1; ?> <!-- dopyt, neviem, �i je v poriadku -->

<?php
$sirka=950;
$vyska=1300;
if ( $strana == 2 OR $strana == 3 OR $strana == 4 OR $strana == 5 )
{
$sirka=1250; $vyska=920;
}
?>
<div id="content" style="width:<?php echo $sirka; ?>px; height:<?php echo $vyska; ?>px;">
<FORM name="formv1" method="post" action="../ucto/vykaz_fin112_2016.php?copern=23&cislo_oc=<?php echo $cislo_oc;?>&strana=<?php echo $strana; ?>">
<?php
$clas1="noactive"; $clas2="noactive"; $clas3="noactive"; $clas4="noactive"; $clas5="noactive";
if ( $strana == 1 ) $clas1="active"; if ( $strana == 2 ) $clas2="active";
if ( $strana == 3 ) $clas3="active"; if ( $strana == 4 ) $clas4="active";
if ( $strana == 5 ) $clas5="active";
$source="vykaz_fin112_2016.php";
?>
<div class="navbar">
 <a href="#" onclick="window.open('<?php echo $source; ?>?copern=20&strana=1&cislo_oc=<?php echo $cislo_oc; ?>', '_self');" class="<?php echo $clas1; ?> toleft">1</a>
 <a href="#" onclick="window.open('<?php echo $source; ?>?copern=20&strana=2&cislo_oc=<?php echo $cislo_oc; ?>', '_self');" class="<?php echo $clas2; ?> toleft">Pr�jmy</a>
 <a href="#" onclick="window.open('<?php echo $source; ?>?copern=20&strana=3&cislo_oc=<?php echo $cislo_oc; ?>', '_self');" class="<?php echo $clas3; ?> toleft">V�davky</a>
 <a href="#" onclick="window.open('<?php echo $source; ?>?copern=20&strana=4&cislo_oc=<?php echo $cislo_oc; ?>', '_self');" class="<?php echo $clas4; ?> toleft">Pr�jmov� oper�cie</a>
 <a href="#" onclick="window.open('<?php echo $source; ?>?copern=20&strana=5&cislo_oc=<?php echo $cislo_oc; ?>', '_self');" class="<?php echo $clas5; ?> toleft">V�davkov� oper�cie</a>
<?php if ( $strana == 1 ) { ?>
 <INPUT type="submit" id="uloz" name="uloz" value="Ulo�i� zmeny" class="btn-top-formsave">
<?php                     } ?>
</div>

<?php if ( $strana == 1 ) { ?>
<img src="<?php echo $jpg_cesta; ?>_str1.jpg" class="form-background"
     alt="<?php echo $jpg_popis; ?> 1.strana 265kB">

<span class="text-echo" style="top:153px; left:403px;"><?php echo $datum; ?></span>
<span class="text-echo" style="top:241px; left:141px;">x</span>
<span class="text-echo" style="top:516px; left:141px; letter-spacing:13.5px;"><?php echo $fir_ficox; ?></span>
<span class="text-echo" style="top:516px; left:342px; letter-spacing:14px;"><?php echo $mesiac; ?></span>
<span class="text-echo" style="top:516px; left:409px; letter-spacing:13.5px;"><?php echo $kli_vrok; ?></span>
<div class="input-echo" style="width:687px; top:574px; left:135px; height:40px; line-height:40px;"><?php echo $fir_fnaz; ?></div>
<div class="input-echo" style="width:687px; top:655px; left:135px; height:19px; line-height:19px; font-size:15px;"><?php echo $fir_uctt02; ?></div>
<div class="input-echo" style="width:687px; top:735.5px; left:135px; height:39.5px; line-height:39.5px;"><?php echo $fir_fuli; ?></div>
<div class="input-echo" style="width:105px; top:816.5px; left:135px; height:19px; line-height:19px;"><?php echo $fir_fpsc; ?></div>
<div class="input-echo" style="width:553px; top:816.5px; left:269px; height:39.5px; line-height:39.5px;"><?php echo $fir_fmes; ?></div>
<div class="input-echo" style="width:687px; top:898px; left:135px; height:19px; line-height:19px; font-size:15px;"><?php echo $fir_fem1; ?></div>
<input type="text" name="daz" id="daz" onkeyup="CiarkaNaBodku(this);"
       style="width:80px; top:966px; left:236px; height:22px; line-height:22px; font-size:14px; padding-left:4px;"/>
<?php                     } ?>


<?php if ( $strana == 2 ) { ?>
<div class="form-background-wide">
<div class="form-content-wide">
 <h2 class="form-header">�as� I. - Pr�jmy</h2>

<div id="FixneMenu">
<table class="table-heading">
<tr>
 <th style="width:20%;">Zdroj.Typ zdroja</th>
 <th style="width:15%;">Polo�ka.Podpolo�ka</th>
 <th style="width:15%;">Schv�len� rozpo�et</th>
 <th style="width:15%;">Rozpo�et po zmen�ch</th>
 <th style="width:15%;">O�ak�van� skuto�nos�</th>
 <th style="width:15%;">Skuto�nos� k</th> <!-- dopyt, dorobi� premenn� -->
 <th style="width:5%;"></th>
</tr>
</table>
</div>
<script type="text/javascript">
    var menu = document.getElementById('FixneMenu');
    window.onscroll = function () {
      menu.className = (
        document.documentElement.scrollTop + document.body.scrollTop > menu.parentNode.offsetTop + 70
        && document.documentElement.clientHeight > menu.offsetHeight
      ) ? "fixne-menu" : "";
    }
</script>

<table class="zoznam" style="width:100%;">
<thead>
<tr class="zero-line">
 <td style="width:20%;"></td>
 <td style="width:15%;"></td>
 <td style="width:15%;"></td>
 <td style="width:15%;"></td>
 <td style="width:15%;"></td>
 <td style="width:15%;"></td>
 <td style="width:5%;"></td>
</tr>
</thead>
<?php
$sluztt = "UPDATE F$kli_vxcf"."_uctvykaz_fin104 SET kor=1*zdroj ";
$sluz = mysql_query("$sluztt");
$sluztt = "SELECT * FROM F$kli_vxcf"."_uctvykaz_fin104 WHERE oc >= 0 AND druh = 1 ORDER BY cpl DESC ";
$sluz = mysql_query("$sluztt");
$slpol = mysql_num_rows($sluz);

//zaciatok vypisu
$i=0;
$j=0;
  while ( $i <= $slpol )
  {
  if (@$zaznam=mysql_data_seek($sluz,$i))
{
$rsluz=mysql_fetch_object($sluz);
?>
<tbody>
<tr>
 <td class="center"><?php echo $rsluz->zdroj; ?></td>
 <td class="center"><?php echo $rsluz->polozka; ?></td>
 <td class="right"><?php echo $rsluz->schvaleny; ?></td>
 <td class="right"><?php echo $rsluz->zmeneny; ?></td>
 <td class="right"><?php echo $rsluz->predpoklad; ?></td>
 <td class="right"><?php echo $rsluz->skutocnost; ?></td>
 <td class="center">
  <img src="../obr/ikony/xmark_lred_icon.png" onclick="Vymaz(<?php echo $rsluz->cpl;?>);"
       title="Vymaza� riadok" class="btn-cancel">
 </td>
</tr>
</tbody>
<?php
}
$i = $i + 1;
$j = $j + 1;
  }
?>
<?php
$sqlxx = "SELECT SUM(schvaleny) AS uhrn1, SUM(zmeneny) AS uhrn2, SUM(predpoklad) AS uhrn3, SUM(skutocnost) AS uhrn4 FROM F$kli_vxcf"."_uctvykaz_fin104 WHERE druh = 1 ";
$vysledokxx = mysql_query($sqlxx);
if ( $vysledokxx ) {
$riadokxx=mysql_fetch_object($vysledokxx);
$uhrn1 = $riadokxx->uhrn1;
$uhrn2 = $riadokxx->uhrn2;
$uhrn3 = $riadokxx->uhrn3;
$uhrn4 = $riadokxx->uhrn4;
}
if ( $uhrn1 == '' ) { $uhrn1=0; }
if ( $uhrn2 == '' ) { $uhrn2=0; }
if ( $uhrn3 == '' ) { $uhrn3=0; }
if ( $uhrn4 == '' ) { $uhrn4=0; }
?>
<tfoot>
<tr>
 <th colspan="2" class="center">Spolu</th>
 <th class="right"><?php echo $uhrn1; ?></th>
 <th class="right"><?php echo $uhrn2; ?></th>
 <th class="right"><?php echo $uhrn3; ?></th>
 <th class="right"><?php echo $uhrn4; ?></th>
 <th class="center">&nbsp;</th>
</tr>
<tr>
 <td>
  <input type="text" name="zdroj" id="zdroj" onkeyup="CiarkaNaBodku(this);" style="width:100px;"/>
 </td>
 <td>
  <input type="text" name="polozka" id="polozka" onkeyup="CiarkaNaBodku(this);" style="width:104px;"/>
 </td>
 <td>
  <input type="text" name="schvaleny" id="schvaleny" onkeyup="CiarkaNaBodku(this);" style="width:103px;"/>
 </td>
 <td>
  <input type="text" name="zmeneny" id="zmeneny" onkeyup="CiarkaNaBodku(this);" style="width:104px;"/>
 </td>
 <td>
  <input type="text" name="predpoklad" id="predpoklad" onkeyup="CiarkaNaBodku(this);" style="width:104px;"/>
 </td>
 <td>
  <input type="text" name="skutocnost" id="skutocnost" onkeyup="CiarkaNaBodku(this);" style="width:104px;"/>
 </td>
 <td>&nbsp;</td>
</tr>
<tr>
 <td>
  <INPUT type="submit" id="uloz" name="uloz" value="Ulo�i�" style="height:24px; cursor:pointer;">
 </td>
 <td colspan="6">&nbsp;</td>
</tr>
</tfoot>
</table>

</div>
</div> <!-- .form-background-wide -->
<?php                     } ?>


<?php if ( $strana == 3 ) { ?>
<div class="form-background-wide">
<div class="form-content-wide">
 <h2 class="form-header">�as� I. - V�davky</h2>

<div id="FixneMenu">
<table class="table-heading">
<tr>
 <th style="width:15%;">Zdroj.Typ zdroja</th>
 <th style="width:15%;">Program</th>
 <th style="width:15%;">Oddiel.Skupina.Trieda.Podtrieda</th>
 <th style="width:10%;">Polo�ka.Podpolo�ka</th>
 <th style="width:10%;">Schv�len� rozpo�et</th>
 <th style="width:10%;">Rozpo�et po zmen�ch</th>
 <th style="width:10%;">O�ak�van� skuto�nos�</th>
 <th style="width:10%;">Skuto�nos� k</th> <!-- dopyt, dorobi� premenn� -->
 <th style="width:5%;"></th>
</tr>
</table>
</div>
<script type="text/javascript">
    var menu = document.getElementById('FixneMenu');
    window.onscroll = function () {
      menu.className = (
        document.documentElement.scrollTop + document.body.scrollTop > menu.parentNode.offsetTop + 70
        && document.documentElement.clientHeight > menu.offsetHeight
      ) ? "fixne-menu" : "";
    }
</script>

<table class="zoznam" style="width:100%;">
<thead>
<tr class="zero-line">
 <td style="width:15%;"></td>
 <td style="width:15%;"></td>
 <td style="width:15%;"></td>
 <td style="width:10%;"></td>
 <td style="width:10%;"></td>
 <td style="width:10%;"></td>
 <td style="width:10%;"></td>
 <td style="width:10%;"></td>
 <td style="width:5%;"></td>
</tr>
</thead>
<tbody>
<tr>
 <td class="center"><?php echo $rsluz->zdroj; ?></td>
 <td></td>
 <td></td>
 <td class="center"><?php echo $rsluz->polozka; ?></td>
 <td class="right"><?php echo $rsluz->schvaleny; ?></td>
 <td class="right"><?php echo $rsluz->zmeneny; ?></td>
 <td class="right"><?php echo $rsluz->predpoklad; ?></td>
 <td class="right"><?php echo $rsluz->skutocnost; ?></td>
 <td class="center">
  <img src="../obr/ikony/xmark_lred_icon.png" onclick="Vymaz(<?php echo $rsluz->cpl;?>);"
       title="Vymaza� riadok" class="btn-cancel">
 </td>
</tr>
</tbody>
<tfoot>
<tr>
 <th colspan="4" class="center">Spolu</th>
 <th class="right"><?php echo $uhrn1; ?></th>
 <th class="right"><?php echo $uhrn2; ?></th>
 <th class="right"><?php echo $uhrn3; ?></th>
 <th class="right"><?php echo $uhrn4; ?></th>
 <th class="center">&nbsp;</th>
</tr>
<tr>
 <td>
  <input type="text" name="zdroj" id="zdroj" onkeyup="CiarkaNaBodku(this);" style="width:100px;"/>
 </td>
 <td></td>
 <td></td>
 <td>
  <input type="text" name="polozka" id="polozka" onkeyup="CiarkaNaBodku(this);" style="width:104px;"/>
 </td>
 <td>
  <input type="text" name="schvaleny" id="schvaleny" onkeyup="CiarkaNaBodku(this);" style="width:103px;"/>
 </td>
 <td>
  <input type="text" name="zmeneny" id="zmeneny" onkeyup="CiarkaNaBodku(this);" style="width:104px;"/>
 </td>
 <td>
  <input type="text" name="predpoklad" id="predpoklad" onkeyup="CiarkaNaBodku(this);" style="width:104px;"/>
 </td>
 <td>
  <input type="text" name="skutocnost" id="skutocnost" onkeyup="CiarkaNaBodku(this);" style="width:104px;"/>
 </td>
 <td>&nbsp;</td>
</tr>
<tr>
 <td>
  <INPUT type="submit" id="uloz" name="uloz" value="Ulo�i�" style="height:24px; cursor:pointer;">
 </td>
 <td colspan="6">&nbsp;</td>
</tr>
</tfoot>
</table>

</div>
</div> <!-- .form-background-wide -->
<?php                     } ?>


<?php if ( $strana == 4 ) { ?>
<div class="form-background-wide">
<div class="form-content-wide">
 <h2 class="form-header">�as� II. - Pr�jmov� oper�cie</h2>

<div id="FixneMenu">
<table class="table-heading">
<tr>
 <th style="width:20%;">K�d ��tu</th>
 <th style="width:20%;">Zdroj</th>
 <th style="width:15%;">Polo�ka.Podpolo�ka</th>
 <th style="width:10%;">Schv�len� rozpo�et</th>
 <th style="width:10%;">Rozpo�et po zmen�ch</th>
 <th style="width:10%;">O�ak�van� udalos�</th>
 <th style="width:10%;">Skuto�nos� k</th> <!-- dopyt, dorobi� premenn� -->
 <th style="width:5%;"></th>
</tr>
</table>
</div>
<script type="text/javascript">
    var menu = document.getElementById('FixneMenu');
    window.onscroll = function () {
      menu.className = (
        document.documentElement.scrollTop + document.body.scrollTop > menu.parentNode.offsetTop + 70
        && document.documentElement.clientHeight > menu.offsetHeight
      ) ? "fixne-menu" : "";
    }
</script>

<table class="zoznam" style="width:100%;">
<thead style=" ">
<tr class="zero-line">
 <td style="width:20%;"></td>
 <td style="width:20%;"></td>
 <td style="width:15%;"></td>
 <td style="width:10%;"></td>
 <td style="width:10%;"></td>
 <td style="width:10%;"></td>
 <td style="width:10%;"></td>
 <td style="width:5%;"></td>
</tr>
</thead>
<tbody>
<tr>
 <td></td>
 <td class="center"><?php echo $rsluz->zdroj; ?></td>
 <td class="center"><?php echo $rsluz->polozka; ?></td>
 <td class="right"><?php echo $rsluz->schvaleny; ?></td>
 <td class="right"><?php echo $rsluz->zmeneny; ?></td>
 <td class="right"><?php echo $rsluz->predpoklad; ?></td>
 <td class="right"><?php echo $rsluz->skutocnost; ?></td>
 <td class="center">
  <img src="../obr/ikony/xmark_lred_icon.png" onclick="Vymaz(<?php echo $rsluz->cpl;?>);"
       title="Vymaza� riadok" class="btn-cancel">
 </td>
</tr>
</tbody>
<tfoot>
<tr>
 <th colspan="3" class="center">Spolu</th>
 <th class="right"><?php echo $uhrn1; ?></th>
 <th class="right"><?php echo $uhrn2; ?></th>
 <th class="right"><?php echo $uhrn3; ?></th>
 <th class="right"><?php echo $uhrn4; ?></th>
 <th class="center">&nbsp;</th>
</tr>
<tr>
 <td></td>
 <td>
  <input type="text" name="zdroj" id="zdroj" onkeyup="CiarkaNaBodku(this);" style="width:100px;"/>
 </td>
 <td>
  <input type="text" name="polozka" id="polozka" onkeyup="CiarkaNaBodku(this);" style="width:104px;"/>
 </td>
 <td>
  <input type="text" name="schvaleny" id="schvaleny" onkeyup="CiarkaNaBodku(this);" style="width:103px;"/>
 </td>
 <td>
  <input type="text" name="zmeneny" id="zmeneny" onkeyup="CiarkaNaBodku(this);" style="width:104px;"/>
 </td>
 <td>
  <input type="text" name="predpoklad" id="predpoklad" onkeyup="CiarkaNaBodku(this);" style="width:104px;"/>
 </td>
 <td>
  <input type="text" name="skutocnost" id="skutocnost" onkeyup="CiarkaNaBodku(this);" style="width:104px;"/>
 </td>
 <td>&nbsp;</td>
</tr>
<tr>
 <td>
  <INPUT type="submit" id="uloz" name="uloz" value="Ulo�i�" style="height:24px; cursor:pointer;">
 </td>
 <td colspan="6">&nbsp;</td>
</tr>
</tfoot>
</table>

</div>
</div> <!-- .form-background-wide -->
<?php                     } ?>


<?php if ( $strana == 5 ) { ?>
<div class="form-background-wide">
<div class="form-content-wide">
 <h2 class="form-header">�as� II. - V�davkov� oper�cie</h2>

<div id="FixneMenu">
<table class="table-heading">
<tr>
 <th style="width:10%;">K�d ��tu</th>
 <th style="width:15%;">Zdroj</th>
 <th style="width:15%;">Oddiel.Skupina.Trieda.Podtrieda</th>
 <th style="width:15%;">Polo�ka.Podpolo�ka</th>
 <th style="width:10%;">Schv�len� rozpo�et</th>
 <th style="width:10%;">Rozpo�et po zmen�ch</th>
 <th style="width:10%;">O�ak�van� skuto�nos�</th>
 <th style="width:10%;">Skuto�nos� k</th> <!-- dopyt, dorobi� premenn� -->
 <th style="width:5%;"></th>
</tr>
</table>
</div>
<script type="text/javascript">
    var menu = document.getElementById('FixneMenu');
    window.onscroll = function () {
      menu.className = (
        document.documentElement.scrollTop + document.body.scrollTop > menu.parentNode.offsetTop + 70
        && document.documentElement.clientHeight > menu.offsetHeight
      ) ? "fixne-menu" : "";
    }
</script>

<table class="zoznam" style="width:100%;">
<thead style=" ">
<tr class="zero-line">
 <td style="width:10%;"></td>
 <td style="width:15%;"></td>
 <td style="width:15%;"></td>
 <td style="width:15%;"></td>
 <td style="width:10%;"></td>
 <td style="width:10%;"></td>
 <td style="width:10%;"></td>
 <td style="width:10%;"></td>
 <td style="width:5%;"></td>
</tr>
</thead>
<tbody>
<tr>
 <td></td>
 <td class="center"><?php echo $rsluz->zdroj; ?></td>
 <td></td>
 <td class="center"><?php echo $rsluz->polozka; ?></td>
 <td class="right"><?php echo $rsluz->schvaleny; ?></td>
 <td class="right"><?php echo $rsluz->zmeneny; ?></td>
 <td class="right"><?php echo $rsluz->predpoklad; ?></td>
 <td class="right"><?php echo $rsluz->skutocnost; ?></td>
 <td class="center">
  <img src="../obr/ikony/xmark_lred_icon.png" onclick="Vymaz(<?php echo $rsluz->cpl;?>);"
       title="Vymaza� riadok" class="btn-cancel">
 </td>
</tr>
</tbody>
<tfoot>
<tr>
 <th colspan="4" class="center">Spolu</th>
 <th class="right"><?php echo $uhrn1; ?></th>
 <th class="right"><?php echo $uhrn2; ?></th>
 <th class="right"><?php echo $uhrn3; ?></th>
 <th class="right"><?php echo $uhrn4; ?></th>
 <th class="center">&nbsp;</th>
</tr>
<tr>
 <td></td>
 <td>
  <input type="text" name="zdroj" id="zdroj" onkeyup="CiarkaNaBodku(this);" style="width:100px;"/>
 </td>
 <td></td>
 <td>
  <input type="text" name="polozka" id="polozka" onkeyup="CiarkaNaBodku(this);" style="width:104px;"/>
 </td>
 <td>
  <input type="text" name="schvaleny" id="schvaleny" onkeyup="CiarkaNaBodku(this);" style="width:103px;"/>
 </td>
 <td>
  <input type="text" name="zmeneny" id="zmeneny" onkeyup="CiarkaNaBodku(this);" style="width:104px;"/>
 </td>
 <td>
  <input type="text" name="predpoklad" id="predpoklad" onkeyup="CiarkaNaBodku(this);" style="width:104px;"/>
 </td>
 <td>
  <input type="text" name="skutocnost" id="skutocnost" onkeyup="CiarkaNaBodku(this);" style="width:104px;"/>
 </td>
 <td>&nbsp;</td>
</tr>
<tr>
 <td>
  <INPUT type="submit" id="uloz" name="uloz" value="Ulo�i�" style="height:24px; cursor:pointer;">
 </td>
 <td colspan="6">&nbsp;</td>
</tr>
</tfoot>
</table>

</div>
</div> <!-- .form-background-wide -->
<?php                     } ?>

<div class="navbar">
 <a href="#" onclick="window.open('<?php echo $source; ?>?copern=20&strana=1&cislo_oc=<?php echo $cislo_oc; ?>', '_self');" class="<?php echo $clas1; ?> toleft">1</a>
 <a href="#" onclick="window.open('<?php echo $source; ?>?copern=20&strana=2&cislo_oc=<?php echo $cislo_oc; ?>', '_self');" class="<?php echo $clas2; ?> toleft">Pr�jmy</a>
 <a href="#" onclick="window.open('<?php echo $source; ?>?copern=20&strana=3&cislo_oc=<?php echo $cislo_oc; ?>', '_self');" class="<?php echo $clas3; ?> toleft">V�davky</a>
 <a href="#" onclick="window.open('<?php echo $source; ?>?copern=20&strana=4&cislo_oc=<?php echo $cislo_oc; ?>', '_self');" class="<?php echo $clas4; ?> toleft">Pr�jmov� oper�cie</a>
 <a href="#" onclick="window.open('<?php echo $source; ?>?copern=20&strana=5&cislo_oc=<?php echo $cislo_oc; ?>', '_self');" class="<?php echo $clas5; ?> toleft">V�davkov� oper�cie</a>
<?php if ( $strana == 1 ) { ?>
 <INPUT type="submit" id="uloz" name="uloz" value="Ulo�i� zmeny" class="btn-bottom-formsave">
<?php                     } ?>
</div>

</FORM>
</div> <!-- #content -->
<?php
     }
//koniec uprav
?>

<?php
/////////////////////////////////////////////////VYTLAC
if ( $copern == 10 )
{
$hhmmss = Date ("is", MkTime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")) );

 $outfilexdel="../tmp/vykfin_".$kli_uzid."_*.*";
 foreach (glob("$outfilexdel") as $filename) {
    unlink($filename);
 }

$outfilex="../tmp/vykfin_".$kli_uzid."_".$hhmmss.".pdf";
if ( File_Exists("$outfilex") ) { $soubor = unlink("$outfilex"); }

   define('FPDF_FONTPATH','../fpdf/font/');
   require('../fpdf/fpdf.php');


$sirka_vyska="210,320";
$velkost_strany = explode(",", $sirka_vyska);

$pdf=new FPDF("P","mm", $velkost_strany );
$pdf->Open();
$pdf->AddFont('arial','','arial.php');


//vytlac

$sqlt = 'DROP TABLE F'.$kli_vxcf.'_uctprcvykazx'.$kli_uzid;
$vysledok = mysql_query("$sqlt");


$vsql = 'CREATE TABLE F'.$kli_vxcf.'_uctprcvykazx'.$kli_uzid." SELECT * FROM F$kli_vxcf"."_uctvykaz_fin104 WHERE druh = 5 ";
$vytvor = mysql_query("$vsql");

// cpl  px12  oc  druh  okres  obec  daz  kor  prx  uce  ucm  ucd  hod  mdt  dal  
// program  zdroj  oddiel  xoddiel  skupina  trieda  podtrieda  polozka  xpolozka  podpolozka  nazov  schvaleny  zmeneny  skutocnost  ico  

//prijmy
//sumare
$dsqlt = "INSERT INTO F$kli_vxcf"."_uctprcvykazx".$kli_uzid." "." SELECT".
" 0,1,oc,druh,okres,obec,daz,kor,0,uce,ucm,ucd,0,0,0,".
" program,zdroj,oddiel,xoddiel,skupina,trieda,podtrieda,polozka,xpolozka,podpolozka,'',".
"SUM(schvaleny),SUM(zmeneny),SUM(predpoklad),SUM(skutocnost),ico ".
" FROM F$kli_vxcf"."_uctvykaz_fin104".
" WHERE druh = 1 OR druh = 3 ".
" GROUP BY druh,zdroj,polozka".
"";
//echo $dsqlt;
$dsql = mysql_query("$dsqlt");

//exit;

$dsqlt = "INSERT INTO F$kli_vxcf"."_uctprcvykazx".$kli_uzid." "." SELECT".
" 0,1,oc,druh,okres,obec,daz,kor,10,uce,ucm,ucd,0,0,0,".
" program,zdroj,oddiel,xoddiel,skupina,trieda,podtrieda,polozka,xpolozka,podpolozka,'',".
"SUM(schvaleny),SUM(zmeneny),SUM(predpoklad),SUM(skutocnost),ico ".
" FROM F$kli_vxcf"."_uctvykaz_fin104".
" WHERE druh = 1 OR druh = 3 ".
" GROUP BY druh,zdroj,xpolozka".
"";
//echo $dsqlt;
$dsql = mysql_query("$dsqlt");

$dsqlt = "INSERT INTO F$kli_vxcf"."_uctprcvykazx".$kli_uzid." "." SELECT".
" 0,1,oc,druh,okres,obec,daz,kor,200,uce,ucm,ucd,0,0,0,".
" program,zdroj,'99999','99999',skupina,trieda,podtrieda,999999,999,podpolozka,'',".
"SUM(schvaleny),SUM(zmeneny),SUM(predpoklad),SUM(skutocnost),ico ".
" FROM F$kli_vxcf"."_uctvykaz_fin104".
" WHERE druh = 1 ".
" GROUP BY druh,zdroj".
"";
//echo $dsqlt;
$dsql = mysql_query("$dsqlt");

$dsqlt = "INSERT INTO F$kli_vxcf"."_uctprcvykazx".$kli_uzid." "." SELECT".
" 0,1,oc,druh,okres,obec,daz,kor,500,uce,ucm,ucd,0,0,0,".
" program,'99999','99999','99999',skupina,trieda,podtrieda,polozka,xpolozka,podpolozka,'',".
"SUM(schvaleny),SUM(zmeneny),SUM(predpoklad),SUM(skutocnost),ico ".
" FROM F$kli_vxcf"."_uctvykaz_fin104".
" WHERE druh = 1 OR druh = 3 ".
" GROUP BY druh".
"";
//echo $dsqlt;
$dsql = mysql_query("$dsqlt");

//exit;

//vydavky
//sumare
$dsqlt = "INSERT INTO F$kli_vxcf"."_uctprcvykazx".$kli_uzid." "." SELECT".
" 0,1,oc,druh,okres,obec,daz,kor,0,uce,ucm,ucd,0,0,0,".
" program,zdroj,oddiel,xoddiel,skupina,trieda,podtrieda,polozka,xpolozka,podpolozka,'',".
"SUM(schvaleny),SUM(zmeneny),SUM(predpoklad),SUM(skutocnost),ico ".
" FROM F$kli_vxcf"."_uctvykaz_fin104".
" WHERE druh = 2 OR druh = 4 ".
" GROUP BY druh,zdroj,polozka".
"";
//echo $dsqlt;
$dsql = mysql_query("$dsqlt");

$dsqlt = "INSERT INTO F$kli_vxcf"."_uctprcvykazx".$kli_uzid." "." SELECT".
" 0,1,oc,druh,okres,obec,daz,kor,10,uce,ucm,ucd,0,0,0,".
" program,zdroj,oddiel,xoddiel,skupina,trieda,podtrieda,polozka,xpolozka,podpolozka,'',".
"SUM(schvaleny),SUM(zmeneny),SUM(predpoklad),SUM(skutocnost),ico ".
" FROM F$kli_vxcf"."_uctvykaz_fin104".
" WHERE druh = 2 OR druh = 4 ".
" GROUP BY druh,zdroj,xpolozka".
"";
//echo $dsqlt;
$dsql = mysql_query("$dsqlt");

$dsqlt = "INSERT INTO F$kli_vxcf"."_uctprcvykazx".$kli_uzid." "." SELECT".
" 0,1,oc,druh,okres,obec,daz,kor,200,uce,ucm,ucd,0,0,0,".
" program,zdroj,'99999','99999',skupina,trieda,podtrieda,999999,999,podpolozka,'',".
"SUM(schvaleny),SUM(zmeneny),SUM(predpoklad),SUM(skutocnost),ico ".
" FROM F$kli_vxcf"."_uctvykaz_fin104".
" WHERE druh = 2 ".
" GROUP BY druh,zdroj".
"";
//echo $dsqlt;
$dsql = mysql_query("$dsqlt");


$dsqlt = "INSERT INTO F$kli_vxcf"."_uctprcvykazx".$kli_uzid." "." SELECT".
" 0,1,oc,druh,okres,obec,daz,kor,500,uce,ucm,ucd,0,0,0,".
" program,'99999','99999','99999',skupina,trieda,podtrieda,polozka,xpolozka,podpolozka,'',".
"SUM(schvaleny),SUM(zmeneny),SUM(predpoklad),SUM(skutocnost),ico ".
" FROM F$kli_vxcf"."_uctvykaz_fin104".
" WHERE druh = 2 OR druh = 4  ".
" GROUP BY druh".
"";
//echo $dsqlt;
$dsql = mysql_query("$dsqlt");


if ( $_SERVER['SERVER_NAME'] == "www.smmgbely.sk" ) { $fin1a12=0; }

$sqltt = "SELECT * FROM F$kli_vxcf"."_uctprcvykazx".$kli_uzid." ".
" WHERE F$kli_vxcf"."_uctprcvykazx$kli_uzid.oc >= 0  ORDER BY druh,zdroj,xpolozka,prx,polozka";

$sql = mysql_query("$sqltt");
$pol = mysql_num_rows($sql);
$i=0;
$j=0;

  while ($i <= $pol )
  {
  if (@$zaznam=mysql_data_seek($sql,$i))
{
$hlavicka=mysql_fetch_object($sql);

$dat_dat = Date ("d.m.Y", MkTime (date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))); 
$dat_dat = SkDatum($hlavicka->da21 );
if( $dat_dat == '0000-00-00' ) $dat_dat="";

//prva strana j=0
if ( $j == 0 ) {

if ( $i == 0 )
     {
$pdf->AddPage();
$pdf->SetLeftMargin(10);
$pdf->SetTopMargin(10);
if ( File_Exists($jpg_cesta.'_str1.jpg') )
{
$pdf->Image($jpg_cesta.'_str1.jpg',0,0,210,297);
}
$pdf->SetY(10);

//obdobie k
$pdf->SetFont('arial','',10);
$text=$datum;
$pdf->Cell(195,19," ","$rmc1",1,"L");
$pdf->Cell(78,6," ","$rmc1",0,"R");$pdf->Cell(22,4,"$text","$rmc",1,"C");

//druh vykazu krizik
$text="x";
$pdf->Cell(195,17," ","$rmc1",1,"L");
$pdf->Cell(20,4," ","$rmc1",0,"R");$pdf->Cell(4,3,"$text","$rmc",1,"C");

//ico
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
$pdf->Cell(195,59," ","$rmc1",1,"L");
$pdf->Cell(20,5," ","$rmc1",0,"R");
$pdf->Cell(5,5,"$t01","$rmc",0,"C");$pdf->Cell(5,5,"$t02","$rmc",0,"C");
$pdf->Cell(5,5,"$t03","$rmc",0,"C");$pdf->Cell(4,5,"$t04","$rmc",0,"C");
$pdf->Cell(5,5,"$t05","$rmc",0,"C");$pdf->Cell(5,5,"$t06","$rmc",0,"C");
$pdf->Cell(5,5,"$t07","$rmc",0,"C");$pdf->Cell(5,5,"$t08","$rmc",0,"C");
//mesiac
$text=$mesiac;
$textx="12345678";
$t01=substr($text,0,1);
$t02=substr($text,1,1);
$pdf->Cell(5,5," ","$rmc1",0,"C");
$pdf->Cell(5,5,"$t01","$rmc",0,"C");$pdf->Cell(5,5,"$t02","$rmc",0,"C");
//rok
$text=$kli_vrok;
$textx="1234";
$t01=substr($text,0,1);
$t02=substr($text,1,1);
$t03=substr($text,2,1);
$t04=substr($text,3,1);
$pdf->Cell(5,5," ","$rmc1",0,"C");
$pdf->Cell(5,5,"$t01","$rmc",0,"C");$pdf->Cell(5,5,"$t02","$rmc",0,"C");
$pdf->Cell(5,5,"$t03","$rmc",0,"C");$pdf->Cell(5,5,"$t04","$rmc",1,"C");

//nazov subjektu
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
$pdf->Cell(195,8.5," ","$rmc1",1,"L");
$pdf->Cell(20,5," ","$rmc1",0,"C");
$pdf->Cell(5,5,"$t01","$rmc",0,"C");$pdf->Cell(5,5,"$t02","$rmc",0,"C");
$pdf->Cell(4,5,"$t03","$rmc",0,"C");$pdf->Cell(5,5,"$t04","$rmc",0,"C");
$pdf->Cell(5,5,"$t05","$rmc",0,"C");$pdf->Cell(5,5,"$t06","$rmc",0,"C");
$pdf->Cell(5,5,"$t07","$rmc",0,"C");$pdf->Cell(5,5,"$t08","$rmc",0,"C");
$pdf->Cell(5,5,"$t09","$rmc",0,"C");$pdf->Cell(5,5,"$t10","$rmc",0,"C");
$pdf->Cell(5,5,"$t11","$rmc",0,"C");$pdf->Cell(5,5,"$t12","$rmc",0,"C");
$pdf->Cell(5,5,"$t13","$rmc",0,"C");$pdf->Cell(5,5,"$t14","$rmc",0,"C");
$pdf->Cell(5,5,"$t15","$rmc",0,"C");$pdf->Cell(5,5,"$t16","$rmc",0,"C");
$pdf->Cell(5,5,"$t17","$rmc",0,"C");$pdf->Cell(5,5,"$t18","$rmc",0,"C");
$pdf->Cell(5,5,"$t19","$rmc",0,"C");$pdf->Cell(4,5,"$t20","$rmc",0,"C");
$pdf->Cell(5,5,"$t21","$rmc",0,"C");$pdf->Cell(5,5,"$t22","$rmc",0,"C");
$pdf->Cell(5,5,"$t23","$rmc",0,"C");$pdf->Cell(5,5,"$t24","$rmc",0,"C");
$pdf->Cell(5,5,"$t25","$rmc",0,"C");$pdf->Cell(5,5,"$t26","$rmc",0,"C");
$pdf->Cell(5,5,"$t27","$rmc",0,"C");$pdf->Cell(5,5,"$t28","$rmc",0,"C");
$pdf->Cell(5,5,"$t29","$rmc",0,"C");$pdf->Cell(5,5,"$t30","$rmc",0,"C");
$pdf->Cell(5,5,"$t31","$rmc",1,"C");
//
$text=substr($fir_fnaz,31,30);;
$textx="��0123456789abcdefghijklmnoprstuv";
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
$pdf->Cell(20,5," ","$rmc1",0,"C");
$pdf->Cell(5,5,"$t01","$rmc",0,"C");$pdf->Cell(5,5,"$t02","$rmc",0,"C");
$pdf->Cell(4,5,"$t03","$rmc",0,"C");$pdf->Cell(5,5,"$t04","$rmc",0,"C");
$pdf->Cell(5,5,"$t05","$rmc",0,"C");$pdf->Cell(5,5,"$t06","$rmc",0,"C");
$pdf->Cell(5,5,"$t07","$rmc",0,"C");$pdf->Cell(5,5,"$t08","$rmc",0,"C");
$pdf->Cell(5,5,"$t09","$rmc",0,"C");$pdf->Cell(5,5,"$t10","$rmc",0,"C");
$pdf->Cell(5,5,"$t11","$rmc",0,"C");$pdf->Cell(5,5,"$t12","$rmc",0,"C");
$pdf->Cell(5,5,"$t13","$rmc",0,"C");$pdf->Cell(5,5,"$t14","$rmc",0,"C");
$pdf->Cell(5,5,"$t15","$rmc",0,"C");$pdf->Cell(5,5,"$t16","$rmc",0,"C");
$pdf->Cell(5,5,"$t17","$rmc",0,"C");$pdf->Cell(5,5,"$t18","$rmc",0,"C");
$pdf->Cell(5,5,"$t19","$rmc",0,"C");$pdf->Cell(4,5,"$t20","$rmc",0,"C");
$pdf->Cell(5,5,"$t21","$rmc",0,"C");$pdf->Cell(5,5,"$t22","$rmc",0,"C");
$pdf->Cell(5,5,"$t23","$rmc",0,"C");$pdf->Cell(5,5,"$t24","$rmc",0,"C");
$pdf->Cell(5,5,"$t25","$rmc",0,"C");$pdf->Cell(5,5,"$t26","$rmc",0,"C");
$pdf->Cell(5,5,"$t27","$rmc",0,"C");$pdf->Cell(5,5,"$t28","$rmc",0,"C");
$pdf->Cell(5,5,"$t29","$rmc",0,"C");$pdf->Cell(5,5,"$t30","$rmc",0,"C");
$pdf->Cell(5,5,"$t31","$rmc",1,"C");

//pravna forma
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
$pdf->Cell(195,8.5," ","$rmc1",1,"L");
$pdf->Cell(20,5," ","$rmc1",0,"C");
$pdf->Cell(5,5,"$t01","$rmc",0,"C");$pdf->Cell(5,5,"$t02","$rmc",0,"C");
$pdf->Cell(4,5,"$t03","$rmc",0,"C");$pdf->Cell(5,5,"$t04","$rmc",0,"C");
$pdf->Cell(5,5,"$t05","$rmc",0,"C");$pdf->Cell(5,5,"$t06","$rmc",0,"C");
$pdf->Cell(5,5,"$t07","$rmc",0,"C");$pdf->Cell(5,5,"$t08","$rmc",0,"C");
$pdf->Cell(5,5,"$t09","$rmc",0,"C");$pdf->Cell(5,5,"$t10","$rmc",0,"C");
$pdf->Cell(5,5,"$t11","$rmc",0,"C");$pdf->Cell(5,5,"$t12","$rmc",0,"C");
$pdf->Cell(5,5,"$t13","$rmc",0,"C");$pdf->Cell(5,5,"$t14","$rmc",0,"C");
$pdf->Cell(5,5,"$t15","$rmc",0,"C");$pdf->Cell(5,5,"$t16","$rmc",0,"C");
$pdf->Cell(5,5,"$t17","$rmc",0,"C");$pdf->Cell(5,5,"$t18","$rmc",0,"C");
$pdf->Cell(5,5,"$t19","$rmc",0,"C");$pdf->Cell(4,5,"$t20","$rmc",0,"C");
$pdf->Cell(5,5,"$t21","$rmc",0,"C");$pdf->Cell(5,5,"$t22","$rmc",0,"C");
$pdf->Cell(5,5,"$t23","$rmc",0,"C");$pdf->Cell(5,5,"$t24","$rmc",0,"C");
$pdf->Cell(5,5,"$t25","$rmc",0,"C");$pdf->Cell(5,5,"$t26","$rmc",0,"C");
$pdf->Cell(5,5,"$t27","$rmc",0,"C");$pdf->Cell(5,5,"$t28","$rmc",0,"C");
$pdf->Cell(5,5,"$t29","$rmc",0,"C");$pdf->Cell(5,5,"$t30","$rmc",0,"C");
$pdf->Cell(5,5,"$t31","$rmc",1,"C");

//ulica a cislo
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
$pdf->Cell(195,13.5," ","$rmc1",1,"L");
$pdf->Cell(20,5," ","$rmc1",0,"C");
$pdf->Cell(5,5,"$t01","$rmc",0,"C");$pdf->Cell(5,5,"$t02","$rmc",0,"C");
$pdf->Cell(4,5,"$t03","$rmc",0,"C");$pdf->Cell(5,5,"$t04","$rmc",0,"C");
$pdf->Cell(5,5,"$t05","$rmc",0,"C");$pdf->Cell(5,5,"$t06","$rmc",0,"C");
$pdf->Cell(5,5,"$t07","$rmc",0,"C");$pdf->Cell(5,5,"$t08","$rmc",0,"C");
$pdf->Cell(5,5,"$t09","$rmc",0,"C");$pdf->Cell(5,5,"$t10","$rmc",0,"C");
$pdf->Cell(5,5,"$t11","$rmc",0,"C");$pdf->Cell(5,5,"$t12","$rmc",0,"C");
$pdf->Cell(5,5,"$t13","$rmc",0,"C");$pdf->Cell(5,5,"$t14","$rmc",0,"C");
$pdf->Cell(5,5,"$t15","$rmc",0,"C");$pdf->Cell(5,5,"$t16","$rmc",0,"C");
$pdf->Cell(5,5,"$t17","$rmc",0,"C");$pdf->Cell(5,5,"$t18","$rmc",0,"C");
$pdf->Cell(5,5,"$t19","$rmc",0,"C");$pdf->Cell(4,5,"$t20","$rmc",0,"C");
$pdf->Cell(5,5,"$t21","$rmc",0,"C");$pdf->Cell(5,5,"$t22","$rmc",0,"C");
$pdf->Cell(5,5,"$t23","$rmc",0,"C");$pdf->Cell(5,5,"$t24","$rmc",0,"C");
$pdf->Cell(5,5,"$t25","$rmc",0,"C");$pdf->Cell(5,5,"$t26","$rmc",0,"C");
$pdf->Cell(5,5,"$t27","$rmc",0,"C");$pdf->Cell(5,5,"$t28","$rmc",0,"C");
$pdf->Cell(5,5,"$t29","$rmc",0,"C");$pdf->Cell(5,5,"$t30","$rmc",0,"C");
$pdf->Cell(5,5,"$t31","$rmc",1,"C");
//
$text=" ";
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
$pdf->Cell(20,5," ","$rmc1",0,"C");
$pdf->Cell(5,5,"$t01","$rmc",0,"C");$pdf->Cell(5,5,"$t02","$rmc",0,"C");
$pdf->Cell(4,5,"$t03","$rmc",0,"C");$pdf->Cell(5,5,"$t04","$rmc",0,"C");
$pdf->Cell(5,5,"$t05","$rmc",0,"C");$pdf->Cell(5,5,"$t06","$rmc",0,"C");
$pdf->Cell(5,5,"$t07","$rmc",0,"C");$pdf->Cell(5,5,"$t08","$rmc",0,"C");
$pdf->Cell(5,5,"$t09","$rmc",0,"C");$pdf->Cell(5,5,"$t10","$rmc",0,"C");
$pdf->Cell(5,5,"$t11","$rmc",0,"C");$pdf->Cell(5,5,"$t12","$rmc",0,"C");
$pdf->Cell(5,5,"$t13","$rmc",0,"C");$pdf->Cell(5,5,"$t14","$rmc",0,"C");
$pdf->Cell(5,5,"$t15","$rmc",0,"C");$pdf->Cell(5,5,"$t16","$rmc",0,"C");
$pdf->Cell(5,5,"$t17","$rmc",0,"C");$pdf->Cell(5,5,"$t18","$rmc",0,"C");
$pdf->Cell(5,5,"$t19","$rmc",0,"C");$pdf->Cell(4,5,"$t20","$rmc",0,"C");
$pdf->Cell(5,5,"$t21","$rmc",0,"C");$pdf->Cell(5,5,"$t22","$rmc",0,"C");
$pdf->Cell(5,5,"$t23","$rmc",0,"C");$pdf->Cell(5,5,"$t24","$rmc",0,"C");
$pdf->Cell(5,5,"$t25","$rmc",0,"C");$pdf->Cell(5,5,"$t26","$rmc",0,"C");
$pdf->Cell(5,5,"$t27","$rmc",0,"C");$pdf->Cell(5,5,"$t28","$rmc",0,"C");
$pdf->Cell(5,5,"$t29","$rmc",0,"C");$pdf->Cell(5,5,"$t30","$rmc",0,"C");
$pdf->Cell(5,5,"$t31","$rmc",1,"C");

//psc
$fir_fpsc=str_replace(" ","",$fir_fpsc);
$text=$fir_fpsc;
$textx="123456";
$t01=substr($text,0,1);
$t02=substr($text,1,1);
$t03=substr($text,2,1);
$t04=substr($text,3,1);
$t05=substr($text,4,1);
$pdf->Cell(195,8.5," ","$rmc1",1,"L");
$pdf->Cell(20,5," ","$rmc1",0,"C");
$pdf->Cell(5,5,"$t01","$rmc",0,"C");$pdf->Cell(5,5,"$t02","$rmc",0,"C");
$pdf->Cell(4,5,"$t03","$rmc",0,"C");$pdf->Cell(5,5,"$t04","$rmc",0,"C");
$pdf->Cell(5,5,"$t05","$rmc",0,"C");
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
$pdf->Cell(5,5," ","$rmc1",0,"C");
$pdf->Cell(5,5,"$t01","$rmc",0,"C");$pdf->Cell(5,5,"$t02","$rmc",0,"C");
$pdf->Cell(5,5,"$t03","$rmc",0,"C");$pdf->Cell(5,5,"$t04","$rmc",0,"C");
$pdf->Cell(5,5,"$t05","$rmc",0,"C");$pdf->Cell(5,5,"$t06","$rmc",0,"C");
$pdf->Cell(5,5,"$t07","$rmc",0,"C");$pdf->Cell(5,5,"$t08","$rmc",0,"C");
$pdf->Cell(5,5,"$t09","$rmc",0,"C");$pdf->Cell(5,5,"$t10","$rmc",0,"C");
$pdf->Cell(5,5,"$t11","$rmc",0,"C");$pdf->Cell(5,5,"$t12","$rmc",0,"C");
$pdf->Cell(5,5,"$t13","$rmc",0,"C");$pdf->Cell(4,5,"$t14","$rmc",0,"C");
$pdf->Cell(5,5,"$t15","$rmc",0,"C");$pdf->Cell(5,5,"$t16","$rmc",0,"C");
$pdf->Cell(5,5,"$t17","$rmc",0,"C");$pdf->Cell(5,5,"$t18","$rmc",0,"C");
$pdf->Cell(5,5,"$t19","$rmc",0,"C");$pdf->Cell(5,5,"$t20","$rmc",0,"C");
$pdf->Cell(5,5,"$t21","$rmc",0,"C");$pdf->Cell(5,5,"$t22","$rmc",0,"C");
$pdf->Cell(5,5,"$t23","$rmc",0,"C");$pdf->Cell(5,5,"$t24","$rmc",0,"C");
$pdf->Cell(5,5,"$t25","$rmc",1,"C");
//
$text=" ";
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
$pdf->Cell(49,5," ","$rmc1",0,"C");
$pdf->Cell(5,5,"$t01","$rmc",0,"C");$pdf->Cell(5,5,"$t02","$rmc",0,"C");
$pdf->Cell(5,5,"$t03","$rmc",0,"C");$pdf->Cell(5,5,"$t04","$rmc",0,"C");
$pdf->Cell(5,5,"$t05","$rmc",0,"C");$pdf->Cell(5,5,"$t06","$rmc",0,"C");
$pdf->Cell(5,5,"$t07","$rmc",0,"C");$pdf->Cell(5,5,"$t08","$rmc",0,"C");
$pdf->Cell(5,5,"$t09","$rmc",0,"C");$pdf->Cell(5,5,"$t10","$rmc",0,"C");
$pdf->Cell(5,5,"$t11","$rmc",0,"C");$pdf->Cell(5,5,"$t12","$rmc",0,"C");
$pdf->Cell(5,5,"$t13","$rmc",0,"C");$pdf->Cell(4,5,"$t14","$rmc",0,"C");
$pdf->Cell(5,5,"$t15","$rmc",0,"C");$pdf->Cell(5,5,"$t16","$rmc",0,"C");
$pdf->Cell(5,5,"$t17","$rmc",0,"C");$pdf->Cell(5,5,"$t18","$rmc",0,"C");
$pdf->Cell(5,5,"$t19","$rmc",0,"C");$pdf->Cell(5,5,"$t20","$rmc",0,"C");
$pdf->Cell(5,5,"$t21","$rmc",0,"C");$pdf->Cell(5,5,"$t22","$rmc",0,"C");
$pdf->Cell(5,5,"$t23","$rmc",0,"C");$pdf->Cell(5,5,"$t24","$rmc",0,"C");
$pdf->Cell(5,5,"$t25","$rmc",1,"C");

//email
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
$pdf->Cell(195,8.5," ","$rmc1",1,"L");
$pdf->Cell(20,5," ","$rmc1",0,"C");
$pdf->Cell(5,5,"$t01","$rmc",0,"C");$pdf->Cell(5,5,"$t02","$rmc",0,"C");
$pdf->Cell(4,5,"$t03","$rmc",0,"C");$pdf->Cell(5,5,"$t04","$rmc",0,"C");
$pdf->Cell(5,5,"$t05","$rmc",0,"C");$pdf->Cell(5,5,"$t06","$rmc",0,"C");
$pdf->Cell(5,5,"$t07","$rmc",0,"C");$pdf->Cell(5,5,"$t08","$rmc",0,"C");
$pdf->Cell(5,5,"$t09","$rmc",0,"C");$pdf->Cell(5,5,"$t10","$rmc",0,"C");
$pdf->Cell(5,5,"$t11","$rmc",0,"C");$pdf->Cell(5,5,"$t12","$rmc",0,"C");
$pdf->Cell(5,5,"$t13","$rmc",0,"C");$pdf->Cell(5,5,"$t14","$rmc",0,"C");
$pdf->Cell(5,5,"$t15","$rmc",0,"C");$pdf->Cell(5,5,"$t16","$rmc",0,"C");
$pdf->Cell(5,5,"$t17","$rmc",0,"C");$pdf->Cell(5,5,"$t18","$rmc",0,"C");
$pdf->Cell(5,5,"$t19","$rmc",0,"C");$pdf->Cell(4,5,"$t20","$rmc",0,"C");
$pdf->Cell(5,5,"$t21","$rmc",0,"C");$pdf->Cell(5,5,"$t22","$rmc",0,"C");
$pdf->Cell(5,5,"$t23","$rmc",0,"C");$pdf->Cell(5,5,"$t24","$rmc",0,"C");
$pdf->Cell(5,5,"$t25","$rmc",0,"C");$pdf->Cell(5,5,"$t26","$rmc",0,"C");
$pdf->Cell(5,5,"$t27","$rmc",0,"C");$pdf->Cell(5,5,"$t28","$rmc",0,"C");
$pdf->Cell(5,5,"$t29","$rmc",0,"C");$pdf->Cell(5,5,"$t30","$rmc",0,"C");
$pdf->Cell(5,5,"$t31","$rmc",1,"C");

//datum zostavenia
$daz= SkDatum($hlavicka->daz);
if ( $daz == '00.00.0000' ) $daz="";
$pdf->Cell(195,12," ","$rmc1",1,"L");
$pdf->Cell(40,5," ","$rmc1",0,"C");$pdf->Cell(22,4,"$daz","$rmc",1,"C");

     }
//koniec ak i=0 





//nova dalsia strana
$pdf->AddPage();
$pdf->SetFont('arial','',9);


if( $hlavicka->druh == 1 AND $hlavicka->prx == 0 )
{
$pdf->Cell(155,4,"�as� I. Pr�jmy a v�davky rozpo�tu subjektu verejnej spr�vy","0",0,"L");$pdf->Cell(30,4,"Strana: 2","0",1,"R");
$pdf->Cell(155,4,"1.1. Pr�jmy","0",1,"L");

$pdf->Cell(20,4," ","T",0,"L");$pdf->Cell(20,4,"Zdroj","T",0,"L");
$pdf->Cell(35,4," ","T",0,"L");$pdf->Cell(35,4,"Polo�ka+","T",0,"L");

$pdf->Cell(25,4,"Schv�len�","T",0,"R");
$pdf->Cell(25,4,"Rozpo�et","T",0,"R");$pdf->Cell(25,4,"Skuto�nos�","T",1,"R");


$pdf->Cell(20,4," ","B",0,"L");$pdf->Cell(20,4," ","B",0,"L");
$pdf->Cell(35,4," ","B",0,"L");$pdf->Cell(35,4,"podpolo�ka","B",0,"L");

$pdf->Cell(25,4,"rozpo�et","B",0,"R");
$pdf->Cell(25,4,"po zmen�ch","B",0,"R");$pdf->Cell(25,4," ","B",1,"R");
}


if( $hlavicka->druh == 2 AND $hlavicka->prx == 0 )
{

$pdf->Cell(155,4,"�as� I. Pr�jmy a v�davky rozpo�tu subjektu verejnej spr�vy","0",0,"L");$pdf->Cell(30,4,"Strana: 3","0",1,"R");
$pdf->Cell(155,4,"1.2. V�davky","0",1,"L");


$pdf->Cell(20,4,"Program","T",0,"L");$pdf->Cell(20,4,"Zdroj","T",0,"L");
$pdf->Cell(35,4,"Odd.skup.","T",0,"L");$pdf->Cell(35,4,"Polo�ka+","T",0,"L");

$pdf->Cell(25,4,"Schv�len�","T",0,"R");
$pdf->Cell(25,4,"Rozpo�et","T",0,"R");$pdf->Cell(25,4,"Skuto�nos�","T",1,"R");


$pdf->Cell(20,4," ","B",0,"L");$pdf->Cell(20,4," ","B",0,"L");
$pdf->Cell(35,4,"tr.podtr.","B",0,"L");$pdf->Cell(35,4,"podpolo�ka","B",0,"L");

$pdf->Cell(25,4,"rozpo�et","B",0,"R");
$pdf->Cell(25,4,"po zmen�ch","B",0,"R");$pdf->Cell(25,4," ","B",1,"R");
}



if( $hlavicka->druh == 3 AND $hlavicka->prx == 0 )
{
$pdf->Cell(155,4,"�as� III. Podnikate�sk� �innos� subjektu verejnej spr�vy","0",0,"L");$pdf->Cell(30,4,"Strana: 4","0",1,"R");
$pdf->Cell(155,4,"3.1. Pr�jmy","0",1,"L");

$pdf->Cell(20,4," ","T",0,"L");$pdf->Cell(20,4," ","T",0,"L");
$pdf->Cell(35,4," ","T",0,"L");$pdf->Cell(35,4,"Polo�ka+","T",0,"L");

$pdf->Cell(25,4," ","T",0,"R");
$pdf->Cell(25,4," ","T",0,"R");$pdf->Cell(25,4,"Skuto�nos�","T",1,"R");


$pdf->Cell(20,4," ","B",0,"L");$pdf->Cell(20,4," ","B",0,"L");
$pdf->Cell(35,4," ","B",0,"L");$pdf->Cell(35,4,"podpolo�ka","B",0,"L");

$pdf->Cell(25,4," ","B",0,"R");
$pdf->Cell(25,4," ","B",0,"R");$pdf->Cell(25,4," ","B",1,"R");

}

if( $hlavicka->druh == 4 AND $hlavicka->prx == 0 )
{

$pdf->Cell(155,4,"�as� III. Podnikate�sk� �innos� subjektu verejnej spr�vy","0",0,"L");$pdf->Cell(30,4,"Strana: 5","0",1,"R");
$pdf->Cell(155,4,"3.2. V�davky","0",1,"L");


$pdf->Cell(20,4," ","T",0,"L");$pdf->Cell(20,4," ","T",0,"L");
$pdf->Cell(35,4,"Odd.skup.","T",0,"L");$pdf->Cell(35,4,"Polo�ka+","T",0,"L");

$pdf->Cell(25,4," ","T",0,"R");
$pdf->Cell(25,4," ","T",0,"R");$pdf->Cell(25,4,"Skuto�nos�","T",1,"R");


$pdf->Cell(20,4," ","B",0,"L");$pdf->Cell(20,4," ","B",0,"L");
$pdf->Cell(35,4,"tr.podtr.","B",0,"L");$pdf->Cell(35,4,"podpolo�ka","B",0,"L");

$pdf->Cell(25,4," ","B",0,"R");
$pdf->Cell(25,4," ","B",0,"R");$pdf->Cell(25,4," ","B",1,"R");

}



               }
//koniec j=0



$schvaleny=$hlavicka->schvaleny;
if( $hlavicka->schvaleny == 0 ) $schvaleny="";
$zmeneny=$hlavicka->zmeneny;
if( $hlavicka->zmeneny == 0 ) $zmeneny="";
$predpoklad=$hlavicka->predpoklad;
if( $hlavicka->predpoklad == 0 ) $predpoklad="";
$skutocnost=$hlavicka->skutocnost;
if( $hlavicka->skutocnost == 0 ) $skutocnost="";

//prijem

if( ( $hlavicka->druh == 1 OR $hlavicka->druh == 3 ) AND $hlavicka->prx == 0 )
{
$pdf->Cell(20,4," ","0",0,"L");$pdf->Cell(20,4,"$hlavicka->zdroj","0",0,"L");
$pdf->Cell(35,4," ","0",0,"L");$pdf->Cell(35,4,"$hlavicka->polozka","0",0,"L");

$pdf->Cell(25,4,"$schvaleny","0",0,"R");
$pdf->Cell(25,4,"$zmeneny","0",0,"R");$pdf->Cell(25,4,"$skutocnost","0",1,"R");
}

if( ( $hlavicka->druh == 1 OR $hlavicka->druh == 3 ) AND $hlavicka->prx == 10 )
{
$pdf->Cell(20,4,"$hlavicka->program","T",0,"L");$pdf->Cell(20,4,"$hlavicka->zdroj","T",0,"L");
$pdf->Cell(35,4," ","T",0,"L");$pdf->Cell(35,4,"$hlavicka->xpolozka","T",0,"L");

$pdf->Cell(25,4,"$schvaleny","0",0,"R");
$pdf->Cell(25,4,"$zmeneny","0",0,"R");$pdf->Cell(25,4,"$skutocnost","0",1,"R");
}

if( ( $hlavicka->druh == 1 OR $hlavicka->druh == 3 ) AND $hlavicka->prx == 200 )
{
$pdf->Cell(20,4,"$hlavicka->program","T",0,"L");$pdf->Cell(20,4,"$hlavicka->zdroj zdroj celkom","T",0,"L");
$pdf->Cell(35,4," ","T",0,"L");$pdf->Cell(35,4," ","T",0,"L");

$pdf->Cell(25,4,"$schvaleny","0",0,"R");
$pdf->Cell(25,4,"$zmeneny","0",0,"R");$pdf->Cell(25,4,"$skutocnost","0",1,"R");
}

if( ( $hlavicka->druh == 1 OR $hlavicka->druh == 3 ) AND $hlavicka->prx == 500 )
{
$pdf->Cell(20,4,"�HRN","T",0,"L");$pdf->Cell(20,4," ","T",0,"L");
$pdf->Cell(35,4," ","T",0,"L");$pdf->Cell(35,4," ","T",0,"L");

$pdf->Cell(25,4,"$schvaleny","T",0,"R");
$pdf->Cell(25,4,"$zmeneny","T",0,"R");$pdf->Cell(25,4,"$skutocnost","T",1,"R");
$j=-1;
}

//vydaj

if( ( $hlavicka->druh == 2 OR $hlavicka->druh == 4 ) AND $hlavicka->prx == 0 )
{
$pdf->Cell(20,4," ","0",0,"L");$pdf->Cell(20,4,"$hlavicka->zdroj","0",0,"L");
$pdf->Cell(35,4," ","0",0,"L");$pdf->Cell(35,4,"$hlavicka->polozka","0",0,"L");

$pdf->Cell(25,4,"$schvaleny","0",0,"R");
$pdf->Cell(25,4,"$zmeneny","0",0,"R");$pdf->Cell(25,4,"$skutocnost","0",1,"R");
}

if( ( $hlavicka->druh == 2 OR $hlavicka->druh == 4 ) AND $hlavicka->prx == 10 )
{
$pdf->Cell(20,4," ","T",0,"L");$pdf->Cell(20,4,"$hlavicka->zdroj","T",0,"L");
$pdf->Cell(35,4,"$hlavicka->oddiel","T",0,"L");$pdf->Cell(35,4,"$hlavicka->xpolozka","T",0,"L");

$pdf->Cell(25,4,"$schvaleny","0",0,"R");
$pdf->Cell(25,4,"$zmeneny","0",0,"R");$pdf->Cell(25,4,"$skutocnost","0",1,"R");
}

if( ( $hlavicka->druh == 2 OR $hlavicka->druh == 4 ) AND $hlavicka->prx == 200 )
{
$pdf->Cell(20,4," ","T",0,"L");$pdf->Cell(20,4,"$hlavicka->zdroj zdroj celkom","T",0,"L");
$pdf->Cell(35,4," ","T",0,"L");$pdf->Cell(35,4," ","T",0,"L");

$pdf->Cell(25,4,"$schvaleny","T",0,"R");
$pdf->Cell(25,4,"$zmeneny","T",0,"R");$pdf->Cell(25,4,"$skutocnost","T",1,"R");
}

if( ( $hlavicka->druh == 2 OR $hlavicka->druh == 4 ) AND $hlavicka->prx == 500 )
{
$pdf->Cell(20,4,"�HRN","T",0,"L");$pdf->Cell(20,4," ","T",0,"L");
$pdf->Cell(35,4," ","T",0,"L");$pdf->Cell(35,4," ","T",0,"L");

$pdf->Cell(25,4,"$schvaleny","T",0,"R");
$pdf->Cell(25,4,"$zmeneny","T",0,"R");$pdf->Cell(25,4,"$skutocnost","T",1,"R");
$j=-1;
}


//koniec polozky


}
$i = $i + 1;
$j = $j + 1;
  }
$pdf->Output("$outfilex");
?>

<script type="text/javascript">
  var okno = window.open("<?php echo $outfilex; ?>", "_self");
</script>

<?php
}
/////////////////////////////////////////KONIEC VYTLACENIA 
?>

<?php
$sqlt = 'DROP TABLE F'.$kli_vxcf.'_uctprcvykaz'.$kli_uzid;
$vysledok = mysql_query("$sqlt");
$sqlt = 'DROP TABLE F'.$kli_vxcf.'_uctprcvykazx'.$kli_uzid;
$vysledok = mysql_query("$sqlt");
$sqlt = 'DROP TABLE F'.$kli_vxcf.'_uctprcvykazz'.$kli_uzid;
$vysledok = mysql_query("$sqlt");

//celkovy koniec
$cislista = include("uct_lista_norm.php");
} while (false);
?>
</BODY>
</HTML>