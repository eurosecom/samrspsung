<!doctype html>
<html>
<?php
do
{
$sys = 'UCT';
$urov = 3000;
$copern = $_REQUEST['copern'];
//$tis = $_REQUEST['tis'];
//if (!isset($tis)) $tis = 0;

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
$pole = explode(".", $kli_vume);
$kli_vmes=$pole[0];
$kli_vrok=$pole[1];

$citfir = include("../cis/citaj_fir.php");

$cislo_oc = 9999;
//$subor = $_REQUEST['subor'];
//$elsubor = $_REQUEST['elsubor'];
$strana = 1*$_REQUEST['strana'];
if ( $strana == 0 ) $strana=1;
$zoznamaut=1;

//.jpg source
$jpg_source="../dokumenty/dan_z_prijmov2017/ozn176/ozn176_v17";
$jpg_title="tla�ivo Ozn�menie o vykonan� �pravy z�kladu dane pre rok $kli_vrok $strana.strana";

$cislo_cpl = 1*$_REQUEST['cislo_cpl'];
if ( $strana == 5 ) { $_REQUEST['cislo_cpl']=0; }

$xml = 1*$_REQUEST['xml'];

//nastav dic
    if ( $copern == 1001 )
    {
$cislo_cpl = 1*$_REQUEST['cislo_cpl'];
$icoset = 1*$_REQUEST['icoset'];

$sqlttt = "SELECT * FROM F$kli_vxcf"."_ico WHERE ico = $icoset ";
$sqldok = mysql_query("$sqlttt");
 if (@$zaznam=mysql_data_seek($sqldok,0))
 {
 $riaddok=mysql_fetch_object($sqldok);
 $zodic=$riaddok->dic;
 $zonaz=$riaddok->nai;
 $zouli=$riaddok->uli;
 $zomes=$riaddok->mes;
 $zopsc=$riaddok->psc;
 $zostat="SR";
 }


$uprtxt = "UPDATE F$kli_vxcf"."_uctoznamenie_uprzd SET".
" zodic='$zodic', zonaz='$zonaz', ".
" zouli='$zouli', zocdm='$zocdm', zopsc='$zopsc', zomes='$zomes', zostat='$zostat', ".
" zoulava30a='$zoulava30a', zoulava30b='$zoulava30b', suma='$suma', datum='$datumsql' ".
" WHERE oc = 1 AND cpl = $cislo_cpl ";

$upravene = mysql_query("$uprtxt");



$copern=20;
$strana=2;
$zoznamaut=0;
    }
//koniec nastav dic

//uprav vozidlo
    if ( $copern == 346 )
    {
$cislo_cpl = 1*$_REQUEST['cislo_cpl'];
$copern=20;
$strana=2;
$zoznamaut=0;
    }
//koniec uprav vozidlo

//nove
    if ( $copern == 336 )
    {
$sql = "INSERT INTO F".$kli_vxcf."_uctoznamenie_uprzd (oc,konx1) VALUES ( 1, 0 ) ";
$vysledok = mysql_query($sql);

$cislo_cpl=0;
$sqlttt = "SELECT * FROM F$kli_vxcf"."_uctoznamenie_uprzd WHERE oc = 1 ORDER BY cpl DESC LIMIT 1";
$sqldok = mysql_query("$sqlttt");
 if (@$zaznam=mysql_data_seek($sqldok,0))
 {
 $riaddok=mysql_fetch_object($sqldok);
 $cislo_cpl=$riaddok->cpl;
 }
$copern=20;
$strana=2;
$zoznamaut=0;
$_REQUEST['cislo_cpl']=$cislo_cpl;
    }
//koniec nove

$cislo_dic = 1*$_REQUEST['cislo_dic'];
//zmaz
    if ( $copern == 316 )
    {
$cislo_cpl = 1*$_REQUEST['cislo_cpl'];
?>
<script type="text/javascript">
if( !confirm ("Chcete vymaza� subjekt s di� <?php echo $cislo_dic; ?> ?") )
         { location.href='oznamenie_uprzd2017.php?cislo_oc=9999&drupoh=1&copern=20&strana=5&cislo_cpl=<?php echo $cislo_cpl; ?>' }
else
         { location.href='oznamenie_uprzd2017.php?copern=3166&drupoh=1&cislo_cpl=<?php echo $cislo_cpl; ?>' }
</script>
<?php
exit;
    }

    if ( $copern == 3166 )
    {

$cislo_cpl = 1*$_REQUEST['cislo_cpl'];
$sql = "DELETE FROM F".$kli_vxcf."_uctoznamenie_uprzd WHERE cpl = $cislo_cpl ";
$vysledok = mysql_query($sql);

$copern=20;
$strana=5;
$zoznamaut=1;
    }
//zmaz vozidlo


//zapis upravene udaje
if ( $copern == 23 )
     {
$cislo_cpl = 1*$_REQUEST['cislo_cpl'];

if ( $strana == 1 ) {
$kriad=1*$_REQUEST['kriad'];
$kdoda=1*$_REQUEST['kdoda'];
$obod = $_REQUEST['obod'];
$obodsql=SqlDatum($obod);
$obdo = $_REQUEST['obdo'];
$obdosql=SqlDatum($obdo);
$oprav=1*$_REQUEST['oprav'];
$datoprav = $_REQUEST['datoprav'];
$datoprav_sql = SqlDatum($datoprav);
$ulava30a = 1*$_REQUEST['ulava30a'];
$ulava30b = 1*$_REQUEST['ulava30b'];
$datum = $_REQUEST['datum'];
$datumsql=SqlDatum($datum);

$uprtxt = "UPDATE F$kli_vxcf"."_uctoznamenie_uprzd SET ".
" kriad='$kriad', kdoda='$kdoda', obod='$obodsql', obdo='$obdosql',
  oprav='$oprav', datoprav='$datoprav_sql',
  ulava30a='$ulava30a', ulava30b='$ulava30b', datum='$datumsql' ".
" WHERE oc >= 0 ";
                    }

if ( $strana == 2 ) {
$zodic = strip_tags($_REQUEST['zodic']);
$zoprie = trim(strip_tags($_REQUEST['zoprie']));
$zomeno = trim(strip_tags($_REQUEST['zomeno']));
$zotitl = trim(strip_tags($_REQUEST['zotitl']));
$zotitz = trim(strip_tags($_REQUEST['zotitz']));
$zonaz = trim(strip_tags($_REQUEST['zonaz']));
$zouli = trim(strip_tags($_REQUEST['zouli']));
$zocdm = trim(strip_tags($_REQUEST['zocdm']));
$zopsc = trim(strip_tags($_REQUEST['zopsc']));
$zomes = trim(strip_tags($_REQUEST['zomes']));
$zostat = trim(strip_tags($_REQUEST['zostat']));
$zoulava30a = 1*$_REQUEST['zoulava30a'];
$zoulava30b = 1*$_REQUEST['zoulava30b'];
$suma = strip_tags($_REQUEST['suma']);

$uprtxt = "UPDATE F$kli_vxcf"."_uctoznamenie_uprzd SET ".
" zodic='$zodic', zoprie='$zoprie', zomeno='$zomeno',
  zotitl='$zotitl', zotitz='$zotitz', zonaz='$zonaz',
  zouli='$zouli', zocdm='$zocdm', zopsc='$zopsc', zomes='$zomes', zostat='$zostat',
  zoulava30a='$zoulava30a', zoulava30b='$zoulava30b', suma='$suma' ".
" WHERE oc = 1 AND cpl = $cislo_cpl ";
                    }

//echo $uprtxt;
$upravene = mysql_query("$uprtxt");

$copern=20;
     }
//koniec zapisu upravenych udajov




//vytvorenie
$sql = "SELECT iu30a FROM F".$kli_vxcf."_uctoznamenie_uprzd";
$vysledok = mysql_query($sql);
if (!$vysledok)
{
$sqlt = 'DROP TABLE F'.$kli_vxcf.'_uctoznamenie_uprzd';
$vysledok = mysql_query("$sqlt");

$sqlt = <<<mzdprc
(
   cpl           int not null auto_increment,
   oc            INT(7) DEFAULT 0,
   datum         DATE NOT NULL,
   ico           DECIMAL(10,0) DEFAULT 0,
   iu30a         DECIMAL(1,0) DEFAULT 0,
   iu30b         DECIMAL(1,0) DEFAULT 0,
   suma          DECIMAL(10,2) DEFAULT 0,

   konx          DECIMAL(10,0) DEFAULT 0,
   konx1         DECIMAL(10,0) DEFAULT 0,
   konx2         DECIMAL(10,0) DEFAULT 0,
   konx3         DECIMAL(10,0) DEFAULT 0,
   PRIMARY KEY(cpl)
);
mzdprc;

$vsql = 'CREATE TABLE F'.$kli_vxcf.'_uctoznamenie_uprzd'.$sqlt;
$vytvor = mysql_query("$vsql");

$sql = "INSERT INTO F".$kli_vxcf."_uctoznamenie_uprzd (oc,konx1) VALUES ( 9999, 0 ) ";
$vysledok = mysql_query($sql);
}

$sql = "SELECT ulava30b FROM F".$kli_vxcf."_uctoznamenie_uprzd";
$vysledok = mysql_query($sql);
if (!$vysledok)
{
$sql = "ALTER TABLE F$kli_vxcf"."_uctoznamenie_uprzd ADD zodic DECIMAL(10,0) DEFAULT 0 AFTER konx";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_uctoznamenie_uprzd ADD zoprie VARCHAR(40) NOT NULL AFTER konx";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_uctoznamenie_uprzd ADD zomeno VARCHAR(20) NOT NULL AFTER konx";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_uctoznamenie_uprzd ADD zotitl VARCHAR(20) NOT NULL AFTER konx";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_uctoznamenie_uprzd ADD zotitz VARCHAR(20) NOT NULL AFTER konx";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_uctoznamenie_uprzd ADD zonaz VARCHAR(50) NOT NULL AFTER konx";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_uctoznamenie_uprzd ADD zouli VARCHAR(30) NOT NULL AFTER konx";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_uctoznamenie_uprzd ADD zocdm VARCHAR(30) NOT NULL AFTER konx";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_uctoznamenie_uprzd ADD zopsc VARCHAR(10) NOT NULL AFTER konx";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_uctoznamenie_uprzd ADD zomes VARCHAR(30) NOT NULL AFTER konx";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_uctoznamenie_uprzd ADD zostat VARCHAR(30) NOT NULL AFTER konx";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_uctoznamenie_uprzd ADD zoulava30a DECIMAL(4,0) DEFAULT 0 AFTER konx";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_uctoznamenie_uprzd ADD zoulava30b DECIMAL(4,0) DEFAULT 0 AFTER konx";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_uctoznamenie_uprzd ADD vypr VARCHAR(40) NOT NULL AFTER konx";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_uctoznamenie_uprzd ADD ulava30a DECIMAL(4,0) DEFAULT 0 AFTER konx";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_uctoznamenie_uprzd ADD ulava30b DECIMAL(4,0) DEFAULT 0 AFTER konx";
$vysledek = mysql_query("$sql");
}
$sql = "SELECT obdo FROM F".$kli_vxcf."_uctoznamenie_uprzd";
$vysledok = mysql_query($sql);
if (!$vysledok)
{
$sql = "ALTER TABLE F$kli_vxcf"."_uctoznamenie_uprzd ADD obod DATE NOT NULL AFTER konx";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_uctoznamenie_uprzd ADD obdo DATE NOT NULL AFTER konx";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_uctoznamenie_uprzd MODIFY suma DECIMAL(12,2) DEFAULT 0 AFTER konx";
$vysledek = mysql_query("$sql");
}
//zmeny2017
$sql = "SELECT datoprav FROM F".$kli_vxcf."_uctoznamenie_uprzd";
$vysledok = mysql_query($sql);
if (!$vysledok)
{
$sql = "ALTER TABLE F$kli_vxcf"."_uctoznamenie_uprzd ADD new2017 DECIMAL(2,0) DEFAULT 0 AFTER konx3";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_uctoznamenie_uprzd ADD kriad DECIMAL(2,0) DEFAULT 0 AFTER new2017";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_uctoznamenie_uprzd ADD kdoda DECIMAL(2,0) DEFAULT 0 AFTER new2017";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_uctoznamenie_uprzd ADD oprav DECIMAL(2,0) DEFAULT 0 AFTER new2017";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_uctoznamenie_uprzd ADD datoprav DATE NOT NULL AFTER new2017";
$vysledek = mysql_query("$sql");
}
//koniec vytvorenie
?>

<?php
//nacitaj udaje pre upravu
//if ( $copern == 20 OR $copern == 110 OR $copern == 10 )
//     {


if ( $strana == 1 OR $strana == 9999 ) {

$sqlfir = "SELECT * FROM F$kli_vxcf"."_uctoznamenie_uprzd".
" WHERE oc = 9999 ";
$fir_vysledok = mysql_query($sqlfir);
$fir_riadok=mysql_fetch_object($fir_vysledok);

$zodic = $fir_riadok->zodic;
$kriad = 1*$fir_riadok->kriad;
$kdoda = 1*$fir_riadok->kdoda;
$obod = $fir_riadok->obod;
$obodsk=SkDatum($obod);
if ( $obodsk == '00.00.0000' ) { $obodsk="01.01.".$kli_vrok;}
$obdo = $fir_riadok->obdo;
$obdosk=SkDatum($obdo);
if ( $obdosk == '00.00.0000' ) { $obdosk="31.12.".$kli_vrok;}
$oprav = 1*$fir_riadok->oprav;
$datoprav_sk = SkDatum($fir_riadok->datoprav);
$ulava30a = $fir_riadok->ulava30a;
$ulava30b = $fir_riadok->ulava30b;
$datum = $fir_riadok->datum;
$datumsk=SkDatum($datum);
                    }

if ( $strana == 2 OR $strana == 9999) {

$sqlfir = "SELECT * FROM F$kli_vxcf"."_uctoznamenie_uprzd".
" WHERE oc = 1 AND cpl = $cislo_cpl ";
$fir_vysledok = mysql_query($sqlfir);
$fir_riadok=mysql_fetch_object($fir_vysledok);

$zodic = $fir_riadok->zodic;
$zoprie = $fir_riadok->zoprie;
$zomeno = $fir_riadok->zomeno;
$zotitl = $fir_riadok->zotitl;
$zotitz = $fir_riadok->zotitz;
$zonaz = $fir_riadok->zonaz;
$zouli = $fir_riadok->zouli;
$zocdm = $fir_riadok->zocdm;
$zopsc = $fir_riadok->zopsc;
$zomes = $fir_riadok->zomes;
$zostat = $fir_riadok->zostat;
$zoulava30a = $fir_riadok->zoulava30a;
$zoulava30b = $fir_riadok->zoulava30b;
$suma = $fir_riadok->suma;
                    }
mysql_free_result($fir_vysledok);
//     }
//koniec nacitania

//FO z ufirdalsie
$sqlfir = "SELECT * FROM F$kli_vxcf"."_ufirdalsie";
$fir_vysledok = mysql_query($sqlfir);
if ($fir_vysledok) { $fir_riadok=mysql_fetch_object($fir_vysledok); }
$dmeno = $fir_riadok->dmeno;
$dprie = $fir_riadok->dprie;
$dtitl = $fir_riadok->dtitl;
$dtitz = $fir_riadok->dtitz;
$duli = $fir_riadok->duli;
$dcdm = $fir_riadok->dcdm;
$dmes = $fir_riadok->dmes;
$dpsc = $fir_riadok->dpsc;
$dtel = $fir_riadok->dtel;
$dstat = $fir_riadok->dstat;
if ( $fir_uctt03 != 999 )
{
$dmeno = "";
$dprie = "";
$dtitl = "";
$dtitz = "";
$duli = $fir_fuli;
$dcdm = $fir_fcdm;
$dmes = $fir_fmes;
$dpsc = $fir_fpsc;
$dtel = $fir_ftel;
$dstat = "SK";
}
if ( $fir_uctt03 == 999 )
{
$fir_fnaz = "";
}

//pocet stran
$sqltt = "SELECT * FROM F$kli_vxcf"."_uctoznamenie_uprzd WHERE oc = 1 ORDER BY zodic ";
$sql = mysql_query("$sqltt");
$pocetstran = 1*mysql_num_rows($sql);

//vypracoval
$zrobil = $fir_mzdt05; if ( $fir_mzdt05 == '' ) $zrobil=$kli_uzmeno." ".$kli_uzprie;
?>
<head>
<meta charset="cp1250">
<link rel="stylesheet" href="../css/reset.css">
<link rel="stylesheet" href="../css/tlaciva.css">
<title>Ozn�menie o �prave ZD | EuroSecom</title>
<style type="text/css">
.bg-white {
  background-color: white;
}
tr.zero-line > td {
  border: 0 !important;
  height: 0 !important;
}
div.wrap-vozidla {
  overflow: auto;
  width: 100%;
  background-color: #fff;
}
table.vozidla {
  width: 900px;
  margin: 16px auto;
  background-color: ;
}
table.vozidla caption {
  height: 24px;
  font-weight: bold;
  font-size: 14px;
  text-align: left;
}
.btn-item-new {
  position: absolute;
  top: 34px;
  left: 170px;
  cursor: pointer;
  font-weight: bold;
  color: #fff;
  font-size: 10px;
  padding: 8px 12px 7px 12px;
  border-radius: 2px;
  box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.25);
  text-transform: uppercase;
  background-color: #1ccc66;
}
a.btn-item-new:hover {
  background-color: #1abd5f;
}

table.vozidla tr.body:hover {
  background-color: #f1faff;
}
table.vozidla th {
  height: 14px;
  vertical-align: middle;
  font-size: 11px;
  font-weight: bold;
  color: #999;
}
table.vozidla td {
  height: 28px;
  line-height: 28px;
  border-top: 2px solid #add8e6;
  font-size: 14px;
}
table.vozidla td img {
  width: 18px;
  height: 18px;
  vertical-align: text-bottom;
  cursor: pointer;
}
span.text-echo {
  font-size: 18px;
  letter-spacing: 13px;
}
div.input-echo {
  position: absolute;
  font-size: 18px;
  background-color: #fff;
}
.tooltip-body ul li {
  font-size: 13px;
  line-height: 20px;
}
.tooltip-body ul li strong {
  font-size: 14px;
}
#content > p {
  line-height: 22px;
  font-size: 14px;
}
#content > p > a {
  color: #00e;
}
#content > p > a:hover {
  text-decoration: underline;
}
#upozornenie > h2 {
  line-height: 20px;
  margin-top: 25px;
  margin-bottom: 10px;
  overflow: auto;
}
#upozornenie > h2 > strong {
  font-size: 16px;
  font-weight: bold;
}
#upozornenie > ul > li {
  line-height: 18px;
  margin: 10px 0;
  font-size: 13px;
}
.red {
  border-left: 4px solid #f22613;
  text-indent: 8px;
}
.orange {
  border-left: 4px solid #f89406;
  text-indent: 8px;
}
dl.legend-area {
  height: 14px;
  line-height: 14px;
  font-size: 11px;
  position: relative;
  top: 5px;
}
dl.legend-area > dt {
  width:10px;
  height:10px;
  margin: 2px 5px 0 12px;
}
.box-red {
  background-color: #f22613;
}
.box-orange {
  background-color: #f89406;
}
.header-section {
  padding-top: 5px;
}
</style>
</head>
<body id="white" onload="ObnovUI();">
<?php if ( $copern != 10 ) { ?>
<div id="wrap-heading">
 <table id="heading">
  <tr>
   <td class="ilogin">EuroSecom</td>
   <td class="ilogin" align="right"><?php echo "<strong>UME</strong> $kli_vume&nbsp;&nbsp;<strong>FIR</strong> $kli_vxcf:$kli_nxcf&nbsp;&nbsp;<strong>login</strong> $kli_uzmeno $kli_uzprie / $kli_uzid"; ?></td>
  </tr>
  <tr>
   <td class="header">Ozn�menie o �prave z�kladu dane
<?php if ( $copern == 110 ) { ?>
 / Export XML <span class="subheader"></span>
<?php }     ?>
   </td>
   <td>
    <div class="bar-btn-form-tool">
<?php if ( $copern != 110 ) { ?>
     <img src="../obr/ikony/upbox_blue_icon.png" onclick="FormXML();" title="Export do XML" class="btn-form-tool">
<?php } ?>
     <img src="../obr/ikony/printer_blue_icon.png" onclick="FormPDF();" title="Zobrazi� v�etky strany v PDF" class="btn-form-tool">
    </div>
   </td>
  </tr>
 </table>
</div>


<div id="content">
<?php
//uprav udaje
  if ( $copern == 20 )
  {
if ( $strana == 5 ) { $cislo_cpl=0; }
?>
<form name="formv1" method="post" action="oznamenie_uprzd2017.php?copern=23&cislo_oc=1&cislo_cpl=<?php echo $cislo_cpl; ?>&strana=<?php echo $strana; ?>">
<?php
$clas1="noactive"; $clas2="noactive"; $clas5="noactive";
if ( $strana == 1 ) $clas1="active"; if ( $strana == 2 ) $clas2="active";
if ( $strana == 5 ) $clas5="active";

$source="../ucto/oznamenie_uprzd2017.php?cislo_oc=1&drupoh=1&cislo_cpl=$cislo_cpl";
?>
<div class="navbar">
 <a href="#" onclick="window.open('<?php echo $source; ?>&copern=20&strana=1', '_self');" class="<?php echo $clas1; ?> toleft">1</a>
<?php if ( $strana != 5 AND $cislo_cpl > 0 ) { ?>
 <a href="#" onclick="window.open('<?php echo $source; ?>&copern=20&strana=2', '_self');" class="<?php echo $clas2; ?> toleft">2</a>
<?php } ?>
 <a href="#" onclick="window.open('<?php echo $source; ?>&copern=20&strana=5', '_self');" class="<?php echo $clas5; ?> toleft">Subjekty</a>
<?php if ( $strana != 5 ) { ?><input type="submit" id="uloz" name="uloz" value="Ulo�i� zmeny" class="btn-top-formsave"><?php } ?>
</div>

<?php if ( $strana == 1 ) { ?>
<img src="<?php echo $jpg_source; ?>_str1.jpg" alt="<?php echo $jpg_title; ?>" class="form-background">
<span class="text-echo" style="top:313px; left:57px;"><?php echo $fir_fdic; ?></span>
<input type="checkbox" name="kriad" value="1" style="top:305px; left:336px;">
<input type="checkbox" name="kdoda" value="1" style="top:328px; left:336px;">
<input type="text" name="obod" id="obod" onkeyup="CiarkaNaBodku(this);" style="width:196px; top:307px; left:696px;"/>
<input type="text" name="obdo" id="obdo" onkeyup="CiarkaNaBodku(this);" style="width:196px; top:346px; left:696px;"/>
<input type="checkbox" name="oprav" value="1" style="top:389px; left:180px;">
<input type="text" name="datoprav" id="datoprav" onkeyup="CiarkaNaBodku(this);" maxlength="10" style="width:195px; top:387px; left:697px;"/>
<!-- fo -->
<div class="input-echo" style="width:359px; top:557px; left:52px;"><?php echo $dprie; ?></div>
<div class="input-echo" style="width:244px; top:557px; left:432px;"><?php echo $dmeno; ?></div>
<div class="input-echo" style="width:112px; top:557px; left:696px;"><?php echo $dtitl; ?></div>
<div class="input-echo" style="width:68px; top:557px; left:827px;"><?php echo $dtitz; ?></div>
<!-- po -->
<div class="input-echo" style="width:842px; height:66px; top:634px; left:52px;"><?php echo $fir_fnaz; ?></div>
<!-- adresa -->
<div class="input-echo" style="width:635px; top:750px; left:52px;"><?php echo $duli; ?></div>
<div class="input-echo" style="width:175px; top:750px; left:718px;"><?php echo $dcdm; ?></div>
<div class="input-echo" style="width:107px; top:805px; left:52px;"><?php echo $dpsc; ?></div>
<div class="input-echo" style="width:451px; top:805px; left:178px;"><?php echo $dmes; ?></div>
<div class="input-echo" style="width:245px; top:805px; left:649px;"><?php echo $dstat; ?></div>
<input type="checkbox" name="ulava30a" value="1" style="top:843px; left:54px;">
<input type="checkbox" name="ulava30b" value="1" style="top:865px; left:54px;">
<!-- vypracoval -->
<div class="input-echo" style="width:308px; top:916px; left:53px;"><?php echo $zrobil; ?></div>
<input type="text" name="datum" id="datum" onkeyup="CiarkaNaBodku(this);" style="width:197px; top:915px; left:385px;"/>
<div class="input-echo" style="width:290px; top:916px; left:603px;"><?php echo $fir_mzdt04; ?></div>
<!-- pocet 2.stran -->
<div class="input-echo" style="width:105px; top:1019px; left:190px;"><?php echo $pocetstran; ?></div><!-- dopyt,v html ned�va -->
<?php                                        } ?>

<?php if ( $strana == 2 ) { ?>
<img src="<?php echo $jpg_source; ?>_str2.jpg" alt="<?php echo $jpg_title; ?>" class="form-background">
<span class="text-echo" style="top:94px; left:310px;"><?php echo $fir_fdic;?></span>
<div style="position:absolute; top:127px; left:43px; width:316px; height:42px; background-color:white;">&nbsp;</div>
<input type="text" name="zodic" id="zodic" style="width:220px; top:239px; left:52px;" onclick="myIcoElement.style.display='none';"/>
<!-- fo -->
<input type="text" name="zoprie" id="zoprie" style="width:357px; top:317px; left:52px;"/>
<input type="text" name="zomeno" id="zomeno" style="width:243px; top:317px; left:430px;"/>
<input type="text" name="zotitl" id="zotitl" style="width:112px; top:317px; left:694px;"/>
<input type="text" name="zotitz" id="zotitz" style="width:66px; top:317px; left:827px;"/>
<!-- po -->
<input type="text" name="zonaz" id="zonaz" style="width:840px; height:62px; top:396px; left:52px;"/>
<!-- adresa -->
<input type="text" name="zouli" id="zouli" style="width:635px; top:516px; left:51px;"/>
<input type="text" name="zocdm" id="zocdm" style="width:175px; top:516px; left:718px;"/>
<input type="text" name="zopsc" id="zopsc" maxlength="5" style="width:107px; top:572px; left:51px;"/>
<input type="text" name="zomes" id="zomes" style="width:451px; top:572px; left:178px;"/>
<input type="text" name="zostat" id="zostat" style="width:243px; top:572px; left:650px;"/>
<input type="checkbox" name="zoulava30a" value="1" style="top:611px; left:54px;">
<input type="checkbox" name="zoulava30b" value="1" style="top:633px; left:54px;">
<input type="text" name="suma" id="suma" onkeyup="CiarkaNaBodku(this);" style="width:288px; top:698px; left:478px;"/>
<?php                                        } ?>

<?php if ( $strana == 5 ) {
//zoznam osob
$sluztt = "SELECT * FROM F$kli_vxcf"."_uctoznamenie_uprzd WHERE oc = 1 ORDER BY zodic ";
//echo $sluztt;
$sluz = mysql_query("$sluztt");
$slpol = mysql_num_rows($sluz);
?>
<div class="wrap-vozidla">
 <a href="#" onclick="NoveVzd();" title="Prida� subjekt" class="btn-item-new" >+ Subjekt</a>
<table class="vozidla">
<caption>Zoznam subjektov</caption>
<tr class="zero-line">
 <td style="width:4%;"></td><td style="width:11%;"></td><td style="width:32%;"></td>
 <td style="width:23%;"></td><td style="width:10%;"></td><td style="width:20%;"></td>
</tr>
<tr>
 <th>#</th>
 <th align="left">DI�</th>
 <th align="left">N�zov</th>
 <th align="left">Obec</th>
 <th align="right">Suma �pravy</th>
 <th>&nbsp;</th>
</tr>
<?php
$i=0;
  while ( $i <= $slpol )
  {
  if (@$zaznam=mysql_data_seek($sluz,$i))
 {
$rsluz=mysql_fetch_object($sluz);
$cisloi=$i+1;
?>
<tr class="body">
 <td align="center"><?php echo "$cisloi."; ?></td>
 <td><?php echo $rsluz->zodic; ?></td>
 <td><?php echo $rsluz->zonaz.$rsluz->zoprie." ".$rsluz->zomeno; ?></td>
 <td><?php echo $rsluz->zomes; ?></td>
 <td align="right"><?php echo $rsluz->suma; ?></td>
 <td align="right">
  <img src="../obr/ikony/pencil_blue_icon.png" onclick="UpravVzd(<?php echo $rsluz->cpl; ?>);" title="Upravi�">&nbsp;&nbsp;&nbsp;
  <img src="../obr/ikony/xmark_lred_icon.png" onclick="ZmazVzd(<?php echo $rsluz->cpl; ?>, '<?php echo $rsluz->zodic; ?>');" title="Vymaza�">&nbsp;&nbsp;&nbsp;
 </td>
</tr>
<?php
 }
$i=$i+1;
   }
?>
 </table>
</div>
<?php                                        } ?>

<div class="navbar">
<?php if ( $strana != 5 ) { ?>
 <a href="#" onclick="window.open('<?php echo $source; ?>&copern=20&strana=1', '_self');" class="<?php echo $clas1; ?> toleft">1</a>
 <a href="#" onclick="window.open('<?php echo $source; ?>&copern=20&strana=2', '_self');" class="<?php echo $clas2; ?> toleft">2</a>
 <?php } ?>
 <a href="#" onclick="window.open('<?php echo $source; ?>&copern=20&strana=5', '_self');" class="<?php echo $clas5; ?> toleft">Subjekty</a>
<?php if ( $strana != 5 ) { ?>
 <input type="submit" id="uloz" name="uloz" value="Ulo�i� zmeny" class="btn-bottom-formsave">
<?php                     } ?>
</div>
</form>


<?php if ( $strana == 2 ) { ?>
<script src="../jquery/jquery-3.1.1.min.js"></script>
<img src='../obr/ikony/searchl_blue_icon.png' id="buttjson" name="buttjson" title="Vyh�ada� DI�" class="btn-row-tool" style="top:241px; left:290px;">
<div id="myIcoElement"></div>
<style>
.div-ponuka {
  position: absolute;
  top: 238px;
  left: 280px;
  padding: 7px 20px;
  box-sizing: border-box;
  background-color: #fff;
  border-bottom: 1px solid #c4c4c4;
  border-left: 1px solid #d3d3d3;
  border-right: 1px solid #d3d3d3;
  border-top: 1px solid #d3d3d3;
  box-shadow: 0 1px 0 rgba(0,0,0,0.07);
  border-radius: 2px;
  overflow: auto;
  max-height: 450px;
}
.odb-ponuka tr {
  background-color: #fff;
  border-bottom: 1px solid lightblue;
  line-height: 26px;
}
.odb-ponuka tr:last-child {
  border-bottom: 0;
}
.odb-ponuka tr:first-child:hover {
  background-color: transparent;
}
.odb-ponuka tr:hover {
  background-color: #eee;
}
.odb-ponuka th {
  font-size: 11px;
  text-align: left;
  height: 14px;
  padding: 0 7px;
}
.odb-ponuka td {
  padding: 0 7px;
  font-size: 12px;
}
.odb-ponuka td img {
  cursor: pointer;
  display: inline-block;
  top: 4px;
  width: 18px;
  height: 18px;
  position: relative;
  top: 5px;
}
</style>
<script type="text/javascript">
  $("#buttjson").click(function( event )
  {
    $( "#myIcoElement" ).empty();
    $( "#myIcoElement" ).show( "fast", function()
       {
    // Animation complete.
       });
       event.preventDefault();
       var jsonAPI = "oznamenie_uprzd_jsonico.php";
       var zodic = $( "#zodic" ).val();
       if ($.trim($("#zodic").val()) != '')
       {
         $.getJSON(jsonAPI, {
           tags: "xxxxxx",
           prm1: zodic
          })
           .done(function (data)
           {
             $("<div id='divponuka' class='div-ponuka'></div>").appendTo("#myIcoElement");
             $("<table id='tableponuka' class='odb-ponuka'>" +
                "<tr>" +
                 "<th style=''>DI�</th>" +
                 "<th style=''>N�zov</th>" +
                 "<th style=''>Ulica</th>" +
                 "<th style=''>Mesto</th>" +
                 "<th style=''>PS�</th>" +
                 "<th style=''></th>" +
                "</tr>" +
               "</table>").appendTo("#divponuka");
             $.each(data.firmy, function (i, item) {
               $("<tr>" +
                  "<td>" + item.dic + "</td>" +
                  "<td>" + item.nai + "</td>" +
                  "<td>" + item.uli + "</td>" +
                  "<td>" + item.mes + "</td>" +
                  "<td>" + item.psc + "</td>" +
                  "<td><img src='../obr/ok.png' title='Vybra�' onclick=\"vykonajIco('" + item.ico + "','" + item.dic + "','" + item.nai + "','" + item.uli + "','" + item.mes + "','" + item.psc + "')\"></td>" +
                 "</tr>").appendTo("#tableponuka");
                 if (i === 300) { return false; } });
           });
         }
  });
</script>
<script type="text/javascript">


//co urobi po potvrdeni ok z tabulky ico
function vykonajIco(ico,dic,nazov,ulica,mesto,psc)
                {
document.forms.formv1.zodic.value = dic;
document.forms.formv1.zonaz.value = nazov;
document.forms.formv1.zodic.focus();
document.forms.formv1.zodic.select();
myIcoElement.style.display='none';

window.open('oznamenie_uprzd2017.php?copern=1001&icoset=' + ico + '&cislo_cpl=<?php echo $cislo_cpl; ?>', '_self' );


                }

</script>
<?php                    } ?>

<?php
//mysql_free_result($vysledok);
  }
//koniec uprav
?>

<?php
//xml
if ( $copern == 110 )
     {
$hhmm = Date( "Hi", MkTime( date("H"),date("i"),date("s"),date("m"),date("d"),date("Y") ) );
$kli_nxcf10 = substr($kli_nxcf,0,10);
$kli_nxcf10=trim(str_replace(" ","",$kli_nxcf10));
$kli_nxcf10=trim(str_replace(".","",$kli_nxcf10));
$kli_nxcf10=trim(str_replace(",","",$kli_nxcf10));
$kli_nxcf10=trim(str_replace("-","",$kli_nxcf10));
$kli_nxcf10 = StrTr($kli_nxcf10, "�����������������������������ͼ�����������ݎ","aacdeeeilnooorrstuuuyzAACDEEELINOOORRSTUUUYZ");

$nazsub="../tmp/ozn176".$kli_vrok."_id".$kli_uzid."_".$kli_nxcf10."_".$hhmm.".xml";

$outfilexdel="../tmp/ozn176".$kli_vrok."_id".$kli_uzid."_*.*";
foreach (glob("$outfilexdel") as $filename) { unlink($filename); }
$outfilex=$nazsub;
if ( File_Exists("$outfilex") ) { $soubor = unlink("$outfilex"); }
$soubor = fopen("$nazsub", "a+");

//prva strana
if ( File_Exists("$nazsub") ) { $soubor = unlink("$nazsub"); }
$soubor = fopen("$nazsub", "a+");

//hlavicka
$cislo_cpl = 1*$_REQUEST['cislo_cpl'];
$sqltt = "SELECT * FROM F$kli_vxcf"."_uctoznamenie_uprzd WHERE oc = 9999 ORDER BY zodic ";

$sql = mysql_query("$sqltt");
$pol = mysql_num_rows($sql);

$i=0;
$j=0; //zaciatok strany ak by som chcel strankovat
  while ( $i <= $pol )
  {
  if (@$zaznam=mysql_data_seek($sql,$i))
{
$hlavicka=mysql_fetch_object($sql);

$aktualna=$i+1;

$obdobie=$kli_vmes;
$dat_dat = Date ("d.m.Y", MkTime (date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")));
$dat_datsql = Date ("Y-m-d", MkTime (date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")));

if ( $j == 0 )
     {
  $text = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>"."\r\n"; fwrite($soubor, $text);

  $text = "<dokument xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:noNamespaceSchemaLocation=\"OZN176v17.xsd\">"."\r\n"; fwrite($soubor, $text);


  $text = "<hlavicka>"."\r\n"; fwrite($soubor, $text);
$dic=$fir_fdic;
  $text = " <dic><![CDATA[".$dic."]]></dic>"."\r\n"; fwrite($soubor, $text);
$kriad=1*$hlavicka->kriad;
  $text = " <viazeRP><![CDATA[".$kriad."]]></viazeRP>"."\r\n"; fwrite($soubor, $text);
$kdoda=1*$hlavicka->kdoda;
  $text = " <viazeDP><![CDATA[".$kdoda."]]></viazeDP>"."\r\n"; fwrite($soubor, $text);

  $text = " <zaObdobie>"."\r\n"; fwrite($soubor, $text);
$hodnota=SkDatum($hlavicka->obod);
//if ( $hodnota == '00.00.0000' ) { $hodnota="01.01.".$kli_vrok; }
  $text = "  <datumOd><![CDATA[".$hodnota."]]></datumOd>"."\r\n"; fwrite($soubor, $text);
$hodnota=SkDatum($hlavicka->obdo);
//if ( $hodnota == '00.00.0000' ) { $hodnota="31.12.".$kli_vrok; }
  $text = "  <datumDo><![CDATA[".$hodnota."]]></datumDo>"."\r\n"; fwrite($soubor, $text);
  $text = " </zaObdobie>"."\r\n"; fwrite($soubor, $text);

$oprav=1*$hlavicka->oprav;
  $text = " <dovodDoplnenia><![CDATA[".$oprav."]]></dovodDoplnenia>"."\r\n"; fwrite($soubor, $text);
$datoprav=SkDatum($hlavicka->datoprav);
  $text = " <datumPovodne><![CDATA[".$datoprav."]]></datumPovodne>"."\r\n"; fwrite($soubor, $text);

  $text = " <fyzickaOsoba>"."\r\n"; fwrite($soubor, $text);
$hodnota=iconv("CP1250", "UTF-8", $dprie);
  $text = "  <priezvisko><![CDATA[".$hodnota."]]></priezvisko>"."\r\n"; fwrite($soubor, $text);
$hodnota=iconv("CP1250", "UTF-8", $dmeno);
  $text = "  <meno><![CDATA[".$hodnota."]]></meno>"."\r\n"; fwrite($soubor, $text);
$hodnota=iconv("CP1250", "UTF-8", $dtitl);
  $text = "  <titulPred><![CDATA[".$hodnota."]]></titulPred>"."\r\n"; fwrite($soubor, $text);
$hodnota=iconv("CP1250", "UTF-8", $dtitz);
  $text = "  <titulZa><![CDATA[".$hodnota."]]></titulZa>"."\r\n"; fwrite($soubor, $text);
  $text = " </fyzickaOsoba>"."\r\n"; fwrite($soubor, $text);

  $text = " <pravnickaOsoba>"."\r\n"; fwrite($soubor, $text);
  $text = "  <obchodneMeno>"."\r\n"; fwrite($soubor, $text);
$hodnota=iconv("CP1250", "UTF-8", $fir_fnaz);
if ( $fir_uctt03 == 999 ) { $hodnota=""; }
  $text = "   <riadok><![CDATA[".$hodnota."]]></riadok>"."\r\n"; fwrite($soubor, $text);
$hodnota="";
  $text = "   <riadok><![CDATA[".$hodnota."]]></riadok>"."\r\n"; fwrite($soubor, $text);
  $text = "  </obchodneMeno>"."\r\n"; fwrite($soubor, $text);
  $text = " </pravnickaOsoba>"."\r\n"; fwrite($soubor, $text);

  $text = " <sidlo>"."\r\n"; fwrite($soubor, $text);
$hodnota=iconv("CP1250", "UTF-8", $duli);
  $text = "  <ulica><![CDATA[".$hodnota."]]></ulica>"."\r\n"; fwrite($soubor, $text);
$hodnota=$dcdm;
  $text = "  <supisneOrientacneCislo><![CDATA[".$hodnota."]]></supisneOrientacneCislo>"."\r\n"; fwrite($soubor, $text);
$hodnota=$dpsc;
$hodnota=str_replace(" ","",$hodnota);
  $text = "  <psc><![CDATA[".$hodnota."]]></psc>"."\r\n"; fwrite($soubor, $text);
$hodnota=iconv("CP1250", "UTF-8", $dmes);
  $text = "  <obec><![CDATA[".$hodnota."]]></obec>"."\r\n"; fwrite($soubor, $text);
$hodnota=iconv("CP1250", "UTF-8", $dstat);
  $text = "  <stat><![CDATA[".$hodnota."]]></stat>"."\r\n"; fwrite($soubor, $text);
  $text = " </sidlo>"."\r\n"; fwrite($soubor, $text);

$hodnota=1*$hlavicka->ulava30a;
  $text = " <ulava30a><![CDATA[".$hodnota."]]></ulava30a>"."\r\n"; fwrite($soubor, $text);
$hodnota=1*$hlavicka->ulava30b;
  $text = " <ulava30b><![CDATA[".$hodnota."]]></ulava30b>"."\r\n"; fwrite($soubor, $text);

  $text = "</hlavicka>"."\r\n"; fwrite($soubor, $text);

  $text = " <vypracoval>"."\r\n"; fwrite($soubor, $text);
$hodnota=iconv("CP1250", "UTF-8", $fir_mzdt05);
  $text = "  <vypracoval><![CDATA[".$hodnota."]]></vypracoval>"."\r\n"; fwrite($soubor, $text);

$hodnota=SkDatum($hlavicka->datum);
  $text = "  <dna><![CDATA[".$hodnota."]]></dna>"."\r\n"; fwrite($soubor, $text);
$hodnota=$fir_mzdt04;
  $text = "  <telefon><![CDATA[".$hodnota."]]></telefon>"."\r\n"; fwrite($soubor, $text);
$hodnota="1";
  $text = "  <podpis><![CDATA[".$hodnota."]]></podpis>"."\r\n"; fwrite($soubor, $text);
  $text = " </vypracoval>"."\r\n"; fwrite($soubor, $text);

  $text = "  <pocetStrPrilohy><![CDATA[".$pocetstran."]]></pocetStrPrilohy>"."\r\n"; fwrite($soubor, $text);

  $text = "<telo>"."\r\n"; fwrite($soubor, $text);

     }
//koniec hlavicka ak j=0

}
$i = $i + 1;
$j = $j + 1;
  }

//telo
$cislo_cpl = 1*$_REQUEST['cislo_cpl'];
$sqltt = "SELECT * FROM F$kli_vxcf"."_uctoznamenie_uprzd WHERE oc = 1 ORDER BY zodic ";

$sql = mysql_query("$sqltt");
$pol = mysql_num_rows($sql);

$i=0;
$j=0; //zaciatok strany ak by som chcel strankovat
  while ( $i <= $pol )
  {
  if (@$zaznam=mysql_data_seek($sql,$i))
{
$telo=mysql_fetch_object($sql);

$aktualna=$i+1;

$obdobie=$kli_vmes;
$dat_dat = Date ("d.m.Y", MkTime (date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")));
$dat_datsql = Date ("Y-m-d", MkTime (date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")));

  $text = "<priloha>"."\r\n"; fwrite($soubor, $text);
  $text = "  <strana>"."\r\n"; fwrite($soubor, $text);
  $text = "  <aktualna><![CDATA[".$aktualna."]]></aktualna>"."\r\n"; fwrite($soubor, $text);
  $text = "  <celkovo><![CDATA[".$pocetstran."]]></celkovo>"."\r\n"; fwrite($soubor, $text);
  $text = "  </strana>"."\r\n"; fwrite($soubor, $text);

  $text = "<zavislaOsoba>"."\r\n"; fwrite($soubor, $text);
$hodnota=$telo->zodic;
  $text = " <dic><![CDATA[".$hodnota."]]></dic>"."\r\n"; fwrite($soubor, $text);
  $text = " <fyzickaOsoba>"."\r\n"; fwrite($soubor, $text);
$hodnota=iconv("CP1250", "UTF-8", $telo->zoprie);
  $text = "  <priezvisko><![CDATA[".$hodnota."]]></priezvisko>"."\r\n"; fwrite($soubor, $text);
$hodnota=iconv("CP1250", "UTF-8", $telo->zomeno);
  $text = "  <meno><![CDATA[".$hodnota."]]></meno>"."\r\n"; fwrite($soubor, $text);
$hodnota=iconv("CP1250", "UTF-8", $telo->zotitl);
  $text = "  <titulPred><![CDATA[".$hodnota."]]></titulPred>"."\r\n"; fwrite($soubor, $text);
$hodnota=iconv("CP1250", "UTF-8", $telo->zotitz);
  $text = "  <titulZa><![CDATA[".$hodnota."]]></titulZa>"."\r\n"; fwrite($soubor, $text);
  $text = " </fyzickaOsoba>"."\r\n"; fwrite($soubor, $text);

  $text = " <pravnickaOsoba>"."\r\n"; fwrite($soubor, $text);
  $text = "  <obchodneMeno>"."\r\n"; fwrite($soubor, $text);
$hodnota=iconv("CP1250", "UTF-8", $telo->zonaz);
  $text = "   <riadok><![CDATA[".$hodnota."]]></riadok>"."\r\n"; fwrite($soubor, $text);
$hodnota="";
  $text = "   <riadok><![CDATA[".$hodnota."]]></riadok>"."\r\n"; fwrite($soubor, $text);
  $text = "  </obchodneMeno>"."\r\n"; fwrite($soubor, $text);
  $text = " </pravnickaOsoba>"."\r\n"; fwrite($soubor, $text);

  $text = " <sidlo>"."\r\n"; fwrite($soubor, $text);
$hodnota=iconv("CP1250", "UTF-8", $telo->zouli);
  $text = "  <ulica><![CDATA[".$hodnota."]]></ulica>"."\r\n"; fwrite($soubor, $text);
$hodnota=$telo->zocdm;
  $text = "  <supisneOrientacneCislo><![CDATA[".$hodnota."]]></supisneOrientacneCislo>"."\r\n"; fwrite($soubor, $text);
$hodnota=$telo->zopsc;
$hodnota=str_replace(" ","",$hodnota);
  $text = "  <psc><![CDATA[".$hodnota."]]></psc>"."\r\n"; fwrite($soubor, $text);
$hodnota=iconv("CP1250", "UTF-8", $telo->zomes);
  $text = "  <obec><![CDATA[".$hodnota."]]></obec>"."\r\n"; fwrite($soubor, $text);
$hodnota=iconv("CP1250", "UTF-8", $telo->zostat);
  $text = "  <stat><![CDATA[".$hodnota."]]></stat>"."\r\n"; fwrite($soubor, $text);
  $text = " </sidlo>"."\r\n"; fwrite($soubor, $text);

$hodnota=1*$telo->zoulava30a;
  $text = " <ulava30a><![CDATA[".$hodnota."]]></ulava30a>"."\r\n"; fwrite($soubor, $text);
$hodnota=1*$telo->zoulava30b;
  $text = " <ulava30b><![CDATA[".$hodnota."]]></ulava30b>"."\r\n"; fwrite($soubor, $text);

  $text = " <upravaZakladu>"."\r\n"; fwrite($soubor, $text);
$hodnota=$telo->suma;
if ( $hodnota == 0 ) $hodnota="";
  $text = "  <suma><![CDATA[".$hodnota."]]></suma>"."\r\n"; fwrite($soubor, $text);
  $text = " </upravaZakladu>"."\r\n"; fwrite($soubor, $text);

  $text = "</zavislaOsoba>"."\r\n"; fwrite($soubor, $text);
  $text = "</priloha>"."\r\n"; fwrite($soubor, $text);


}
$i = $i + 1;
$j = $j + 1;
  }

  $text = "</telo>"."\r\n"; fwrite($soubor, $text);
  $text = "</dokument>"."\r\n"; fwrite($soubor, $text);

fclose($soubor);
?>

<div class="bg-white" style="padding: 16px 24px;">
  <p style="line-height: 32px;">Stiahnite si ni��ie uveden� s�bor XML na V� lok�lny disk a na��tajte ho na str�nku <a href="https://www.financnasprava.sk/sk/titulna-stranka" target="_blank" title="Str�nka Finan�nej spr�vy">Finan�nej spr�vy</a> alebo do aplik�cie eDane:
  </p>
  <p style="line-height: 48px;"><a href="<?php echo $nazsub; ?>"><?php echo $nazsub; ?></a></p>
<?php
//xml alert
$upozorni1=0; $upozorni2=0;
?>
<div id="upozornenie" style="display:none;">
<h2>
<strong class="toleft">Upozornenie</strong>
<dl class="toright legend-area">
 <dt class="toleft box-red"></dt><dd class="toleft">kritick�</dd>
 <dt class="toleft box-orange"></dt><dd class="toleft">logick�</dd>
</dl>
</h2>
<ul id="alertpage1" style="display:none;">
<li class="header-section">STRANA 1</li>
<?php if ( $hlavicka->obod == '0000-00-00' OR $hlavicka->obdo == '0000-00-00' )
{
?>
<li class="red">
<?php
$upozorni1=1;
echo "Subjekt s di� $hlavicka->zodic nem� vyplnen� <strong>za zda�ovacie obdobie</strong> ozn�menia.";
?>
</li>
<?php
}
?>
<?php if ( $hlavicka->datum == '0000-00-00' )
{
?>
<li class="red">
<?php
$upozorni1=1;
echo "Subjekt s di� $hlavicka->zodic nem� vyplnen� <strong>d�tum vypracovania</strong> ozn�menia.";
?>
</li>
<?php
}
?>



</ul>

<ul id="alertpage2" style="display:none;">
<li class="header-section">STRANA 2</li>
<?php if ( $telo->zomes == '' )
{
?>
<li class="red">
<?php
$upozorni2=1;
echo "Subjekt s di� $telo->zodic nem� vyplnen� polo�ku <strong>obec</strong> v adrese z�vislej osoby na 2.strane ozn�menia.";
?>
</li>
<?php
}
?>
<?php if ( $telo->suma == 0 )
{
?>
<li class="red">
<?php
$upozorni2=1;
echo "Subjekt s di� $telo->zodic nem� vyplnen� <strong>sumu �pravy z�kladu dane</strong> na 2.strane ozn�menia.";
?>
</li>
<?php
}
?>
<?php if ( $telo->zodic == '0' )
{
?>
<li class="red">
<?php
$upozorni2=1;
echo "Subjekt s di� $telo->zodic nem� vyplnen� <strong>di�</strong> z�vislej osoby na 2.strane ozn�menia.";
?>
</li>
<?php
}
?>
<?php if ( trim($telo->zoprie) == '' AND trim($telo->zomeno) == '' AND trim($telo->zonaz) == '' )
{
?>
<li class="red">
<?php
$upozorni2=1;
echo "Subjekt s di� $telo->zodic nem� vyplnen� <strong>priezvisko, meno alebo n�zov</strong> z�vislej osoby na 2.strane ozn�menia.";
?>
</li>
<?php
}
?>
<?php if ( $telo->zoprie != '' AND $telo->zomeno != ''  AND $telo->zonaz != '' )
{
?>
<li class="red">
<?php
$upozorni2=1;
echo "Subjekt s di� $telo->zodic m� s��asne vyplnen� <strong>priezvisko, meno a n�zov</strong> z�vislej osoby na 2.strane ozn�menia.";
?>
</li>
<?php
}
?>
<?php if ( $telo->zonaz == '' AND (( $telo->zoprie != '' AND $telo->zomeno == '' ) OR
 ( $telo->zoprie == '' AND $telo->zomeno != '' )) )
{
?>
<li class="red">
<?php
$upozorni2=1;
echo "Subjekt s di� $telo->zodic pri fyzickej osobe mus�te vyplni� <strong>priezvisko aj meno</strong> z�vislej osoby na 2.strane ozn�menia.";
?>
</li>
<?php
}
?>


</ul>
</div><!-- #upozornenie -->
</div><!-- .bg-white -->
<script type="text/javascript">
<?php
if ( $upozorni1 == 1 OR $upozorni2 == 1 ) { echo "upozornenie.style.display='block';"; }
if ( $upozorni1 == 1 ) { echo "alertpage1.style.display='block';"; }
if ( $upozorni2 == 1 ) { echo "alertpage2.style.display='block';"; }
?>
</script>
<?php
//mysql_free_result($vysledok);
     }
//koniec xml
?>
</div><!-- #content -->
<?php } ?>

<?php
//pdf
if ( $copern == 10 )
{
$hhmmss = Date ("d_m_H_i_s", MkTime (date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")));

 $outfilexdel="../tmp/oznuprzd_".$kli_uzid."_*.*";
 foreach (glob("$outfilexdel") as $filename) {
    unlink($filename);
 }

$outfilex="../tmp/oznuprzd_".$kli_uzid."_".$hhmmss.".pdf";
if ( File_Exists("$outfilex") ) { $soubor = unlink("$outfilex"); }

     define('FPDF_FONTPATH','../fpdf/font/');
     require('../fpdf/fpdf.php');

$sirka_vyska="210,320";
$velkost_strany = explode(",", $sirka_vyska);
$pdf=new FPDF("P","mm", $velkost_strany );
$pdf->Open();
$pdf->AddFont('arial','','arial.php');

//ramcek fpdf 1=zap,0=vyp
$rmc=0;
$rmc1=0;

//vytlac
$sqltt = "SELECT * FROM F$kli_vxcf"."_uctoznamenie_uprzd WHERE oc = 9999 AND cpl > 0 ORDER BY zodic ";

$sql = mysql_query("$sqltt");
$pol = mysql_num_rows($sql);

$i=0;
$j=0; //zaciatok strany ak by som chcel strankovat
  while ($i <= $pol )
  {
  if (@$zaznam=mysql_data_seek($sql,$i))
{
$hlavicka=mysql_fetch_object($sql);

if ( ( $strana == 1 OR $strana == 9999 ) AND $j == 0 ) {
$pdf->AddPage();
$pdf->SetFont('arial','',12);
$pdf->SetLeftMargin(10);
$pdf->SetTopMargin(10);
if ( File_Exists($jpg_source.'_str1.jpg') )
{
$pdf->Image($jpg_source.'_str1.jpg',0,0,210,297);
}
$pdf->SetY(10);

//dic
$pdf->Cell(190,55.5," ","$rmc1",1,"L");
$text="1234567890";
$text=$fir_fdic;
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
$pdf->Cell(2,6," ","$rmc1",0,"R");$pdf->Cell(4,6,"$t01","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t02","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t03","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t04","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t05","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t06","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t07","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t08","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t09","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(5,6,"$t10","$rmc",0,"C");

//oznamenie-viaze
$text1=" "; if ( $hlavicka->kriad == 1 ) { $text1="x"; }
$text2=" "; if ( $hlavicka->kdoda == 1 ) { $text2="x"; }
$pdf->SetY(65);
$pdf->Cell(65,6," ","$rmc1",0,"C");$pdf->Cell(3,3,"$text1","$rmc",1,"C");
$pdf->Cell(190,2," ","$rmc1",1,"L");
$pdf->Cell(65,6," ","$rmc1",0,"C");$pdf->Cell(3,3,"$text2","$rmc",1,"C");

//za-obdobie
$text=SkDatum($hlavicka->obod);
$t01=substr($text,0,1);
$t02=substr($text,1,1);
$t03=substr($text,3,1);
$t04=substr($text,4,1);
$t05=substr($text,8,1);
$t06=substr($text,9,1);
$pdf->SetY(65);
$pdf->Cell(144,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t01","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t02","$rmc",0,"C");
$pdf->Cell(4,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t03","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t04","$rmc",0,"C");
$pdf->Cell(13,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t05","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t06","$rmc",1,"C");
$pdf->Cell(190,3," ","$rmc1",1,"L");
$text=SkDatum($hlavicka->obdo);
$t01=substr($text,0,1);
$t02=substr($text,1,1);
$t03=substr($text,3,1);
$t04=substr($text,4,1);
$t05=substr($text,8,1);
$t06=substr($text,9,1);
$pdf->Cell(144,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t01","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t02","$rmc",0,"C");
$pdf->Cell(4,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t03","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t04","$rmc",0,"C");
$pdf->Cell(13,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t05","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t06","$rmc",1,"C");

//oprava-udajov
$pdf->Cell(190,4," ","$rmc1",1,"L");
$text1=" "; if ( $hlavicka->oprav == 1 ) { $text1="x"; }
$pdf->Cell(30.5,6," ","$rmc1",0,"C");$pdf->Cell(3,3,"$text1","$rmc",0,"C");
$text2=SkDatum($hlavicka->datoprav);
$t01=substr($text2,0,1);
$t02=substr($text2,1,1);
$t03=substr($text2,3,1);
$t04=substr($text2,4,1);
$t05=substr($text2,8,1);
$t06=substr($text2,9,1);
$pdf->SetY(83.5);
$pdf->Cell(144,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t01","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t02","$rmc",0,"C");
$pdf->Cell(4,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t03","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t04","$rmc",0,"C");
$pdf->Cell(13,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t05","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t06","$rmc",1,"C");

//fo-priezvisko
$pdf->Cell(190,32," ","$rmc1",1,"L");
$text=$dprie;
$A=substr($text,0,1);
$B=substr($text,1,1);
$C=substr($text,2,1);
$D=substr($text,3,1);
$E=substr($text,4,1);
$F=substr($text,5,1);
$G=substr($text,6,1);
$H=substr($text,7,1);
$I=substr($text,8,1);
$J=substr($text,9,1);
$K=substr($text,10,1);
$L=substr($text,11,1);
$M=substr($text,12,1);
$N=substr($text,13,1);
$O=substr($text,14,1);
$P=substr($text,15,1);
$pdf->Cell(2,6," ","$rmc1",0,"R");$pdf->Cell(4,6,"$A","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$B","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$C","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$D","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$E","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$F","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$G","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$H","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$I","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$J","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$K","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$L","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(5,6,"$M","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$N","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$O","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$P","$rmc",0,"C");
//fo-meno
$text=$dmeno;
$A=substr($text,0,1);
$B=substr($text,1,1);
$C=substr($text,2,1);
$D=substr($text,3,1);
$E=substr($text,4,1);
$F=substr($text,5,1);
$G=substr($text,6,1);
$H=substr($text,7,1);
$I=substr($text,8,1);
$J=substr($text,9,1);
$K=substr($text,10,1);
$pdf->Cell(3,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$A","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$B","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$C","$rmc",0,"C");
$pdf->Cell(2,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$D","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$E","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$F","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$G","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$H","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$I","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$J","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$K","$rmc",0,"C");
//fo-tituly
$pdf->Cell(4,6," ","$rmc1",0,"C");$pdf->Cell(25,6,"$dtitl","$rmc",0,"L");
$pdf->Cell(4,6," ","$rmc1",0,"C");$pdf->Cell(16,6,"$dtitz","$rmc",1,"L");
//po-nazov
$pdf->Cell(190,12.5," ","$rmc1",1,"L");
$text=$fir_fnaz;
$A=substr($text,0,1);
$B=substr($text,1,1);
$C=substr($text,2,1);
$D=substr($text,3,1);
$E=substr($text,4,1);
$F=substr($text,5,1);
$G=substr($text,6,1);
$H=substr($text,7,1);
$I=substr($text,8,1);
$J=substr($text,9,1);
$K=substr($text,10,1);
$L=substr($text,11,1);
$M=substr($text,12,1);
$N=substr($text,13,1);
$O=substr($text,14,1);
$P=substr($text,15,1);
$R=substr($text,16,1);
$S=substr($text,17,1);
$T=substr($text,18,1);
$U=substr($text,19,1);
$V=substr($text,20,1);
$W=substr($text,21,1);
$X=substr($text,22,1);
$Y=substr($text,23,1);
$Z=substr($text,24,1);
$A1=substr($text,25,1);
$B1=substr($text,26,1);
$C1=substr($text,27,1);
$D1=substr($text,28,1);
$E1=substr($text,29,1);
$F1=substr($text,30,1);
$G1=substr($text,31,1);
$H1=substr($text,32,1);
$I1=substr($text,33,1);
$J1=substr($text,34,1);
$K1=substr($text,35,1);
$L1=substr($text,36,1);
$pdf->Cell(2,6," ","$rmc1",0,"R");$pdf->Cell(4,6,"$A","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$B","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$C","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$D","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$E","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$F","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$G","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$H","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(5,6,"$I","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$J","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$K","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$L","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$M","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$N","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$O","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$P","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$R","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$S","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$T","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$U","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(5,6,"$V","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$W","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$X","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$Y","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$Z","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$A1","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$B1","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$C1","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$D1","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$E1","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$F1","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$G1","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(5,6,"$H1","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$I1","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$J1","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$K1","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$L1","$rmc",1,"C");
//adresa-ulica
$pdf->Cell(190,19.5," ","$rmc1",1,"L");
$text=$duli;
$textxx="ABCDEFGHIJKLMNOPRSTUVXYZ1234";
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
$pdf->Cell(2,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t01","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t02","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t03","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t04","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t05","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t06","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t07","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t08","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t09","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t10","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t11","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(5,7,"$t12","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t13","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t14","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t15","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t16","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t17","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t18","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t19","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t20","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t21","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t22","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t23","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t24","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(5,7,"$t25","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t26","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t27","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t28","$rmc",0,"C");
//adresa-cislo
$text=$dcdm;
$textxx="111122";
$t01=substr($text,0,1);
$t02=substr($text,1,1);
$t03=substr($text,2,1);
$t04=substr($text,3,1);
$t05=substr($text,4,1);
$t06=substr($text,5,1);
$t07=substr($text,6,1);
$t08=substr($text,7,1);
$pdf->Cell(6,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t01","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t02","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t03","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t04","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t05","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t06","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(5,7,"$t07","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t08","$rmc",1,"C");
//adresa-psc
$pdf->Cell(190,6.5," ","$rmc1",1,"L");
$text=$dpsc;
$textxx="12345";
$text=str_replace(" ","",$text);
$t01=substr($text,0,1);
$t02=substr($text,1,1);
$t03=substr($text,2,1);
$t04=substr($text,3,1);
$t05=substr($text,4,1);
$pdf->Cell(2,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t01","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t02","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t03","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t04","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t05","$rmc",0,"C");
//adresa-obec
$text=$dmes;
$textxx="ABCDEFGHIJKLMNOPRSTU";
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
$pdf->Cell(3,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t01","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(5,6,"$t02","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t03","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t04","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t05","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t06","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t07","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t08","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t09","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t10","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t11","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t12","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t13","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t14","$rmc",0,"C");
$pdf->Cell(2,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t15","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t16","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t17","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t18","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t19","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t20","$rmc",0,"C");
//adresa-stat
$text=$dstat;
$textxx="SK";
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
$pdf->Cell(4,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t01","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t02","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t03","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t04","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t05","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t06","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t07","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t08","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t09","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t10","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t11","$rmc",1,"C");
//dan-ulava
$pdf->Cell(190,2.5," ","$rmc1",1,"L");
$text1=" "; if ( $hlavicka->ulava30a == 1 ) { $text1="x"; }
$text2=" "; if ( $hlavicka->ulava30b == 1 ) { $text2="x"; }
$pdf->Cell(2.5,3," ","$rmc1",0,"C");$pdf->Cell(3,3,"$text1","$rmc",1,"C");
$pdf->Cell(190,2," ","$rmc1",1,"L");
$pdf->Cell(2.5,3," ","$rmc1",0,"C");$pdf->Cell(3,3,"$text2","$rmc",1,"C");

//vypracoval
$pdf->Cell(190,8.5," ","$rmc1",1,"L");
$pdf->Cell(2,6," ","$rmc1",0,"C");$pdf->Cell(69,6,"$zrobil","$rmc",0,"L");
//vypracoval-dna
$text=SkDatum($hlavicka->datum);
$da1=substr($text,0,1);
$da2=substr($text,1,1);
$da3=substr($text,3,1);
$da4=substr($text,4,1);
$da7=substr($text,8,1);
$da8=substr($text,9,1);
$pdf->Cell(4,6," ","$rmc1",0,"L");$pdf->Cell(4,6,"$da1","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$da2","$rmc",0,"C");
$pdf->Cell(4,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$da3","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$da4","$rmc",0,"C");
$pdf->Cell(4,6," ","$rmc1",0,"C");$pdf->Cell(4,6," ","$rmc1",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6," ","$rmc1",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$da7","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$da8","$rmc",0,"C");
//vypracoval-telefon
$text=str_replace("/","",$fir_mzdt04);
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
$pdf->Cell(3,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t01","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t02","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(5,6,"$t03","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t04","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t05","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t06","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t07","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t08","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t09","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t10","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t11","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t12","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(5,6,"$t13","$rmc",1,"C");
//pocet-priloh
$pdf->Cell(190,18," ","$rmc1",1,"L");
$text=$pocetstran;
$hodx=$text;
$text=sprintf("% 5s",$hodx);
$t01=substr($text,0,1);
$t02=substr($text,1,1);
$t03=substr($text,2,1);
$t04=substr($text,3,1);
$t05=substr($text,4,1);
$pdf->Cell(32,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t01","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t02","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t03","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t04","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t05","$rmc",1,"C");
                                       } //koniec 1.strany

}
$i = $i + 1;
$j = $j + 1;
  }

$sqltt = "SELECT * FROM F$kli_vxcf"."_uctoznamenie_uprzd WHERE oc = 1 AND cpl > 0 ORDER BY zodic ";

$sql = mysql_query("$sqltt");
$pol = mysql_num_rows($sql);

$i=0;
$j=0; //zaciatok strany ak by som chcel strankovat
  while ($i <= $pol )
  {
  if (@$zaznam=mysql_data_seek($sql,$i))
{
$hlavicka=mysql_fetch_object($sql);

if ( $strana == 2 OR $strana == 9999 ) {
$pdf->AddPage();
$pdf->SetFont('arial','',12);
$pdf->SetLeftMargin(10);
$pdf->SetTopMargin(10);
if ( File_Exists($jpg_source.'_str2.jpg') )
{
$pdf->Image($jpg_source.'_str2.jpg',0,0,210,297);
}
$pdf->SetY(10);

//dic
$pdf->Cell(195,4.5," ","$rmc1",1,"L");
$textxx="0123456789";
$text=$fir_fdic;
$fdicc=1*$fir_fdic;
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
$pdf->Cell(58,7," ","$rmc1",0,"R");$pdf->Cell(4,7,"$t01","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t02","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t03","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t04","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t05","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t06","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t07","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t08","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t09","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t10","$rmc",1,"C");

//strana
$pdf->Cell(195,4," ","$rmc1",1,"L");
$aktualna=$i+1;
$text=$aktualna;
$hodx=$text;
$text=sprintf("% 5s",$hodx);
$t01=substr($text,0,1);
$t02=substr($text,1,1);
$t03=substr($text,2,1);
$t04=substr($text,3,1);
$t05=substr($text,4,1);
$pdf->Cell(13,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t01","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t02","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t03","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t04","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t05","$rmc",0,"C");
$text=$pol;
$hodx=$text;
$text=sprintf("% 5s",$hodx);
$t01=substr($text,0,1);
$t02=substr($text,1,1);
$t03=substr($text,2,1);
$t04=substr($text,3,1);
$t05=substr($text,4,1);
$pdf->Cell(6,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t01","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t02","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4.5,6,"$t03","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t04","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t05","$rmc",1,"C");

//zo-dic
$pdf->Cell(190,18," ","$rmc1",1,"L");
$text="1234567890";
$text=$hlavicka->zodic;
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
$pdf->Cell(2,6," ","$rmc1",0,"R");$pdf->Cell(4,6,"$t01","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t02","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t03","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t04","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t05","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t06","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t07","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t08","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t09","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t10","$rmc",0,"C");
//zo-fo-priezvisko
$pdf->Cell(190,18," ","$rmc1",1,"L");
$text=$hlavicka->zoprie;
$A=substr($text,0,1);
$B=substr($text,1,1);
$C=substr($text,2,1);
$D=substr($text,3,1);
$E=substr($text,4,1);
$F=substr($text,5,1);
$G=substr($text,6,1);
$H=substr($text,7,1);
$I=substr($text,8,1);
$J=substr($text,9,1);
$K=substr($text,10,1);
$L=substr($text,11,1);
$M=substr($text,12,1);
$N=substr($text,13,1);
$O=substr($text,14,1);
$P=substr($text,15,1);
$pdf->Cell(2,6," ","$rmc1",0,"R");$pdf->Cell(4,6,"$A","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$B","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$C","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$D","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$E","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$F","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$G","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$H","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$I","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$J","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$K","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$L","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(5,6,"$M","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$N","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$O","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$P","$rmc",0,"C");
//zo-fo-meno
$text=$hlavicka->zomeno;
$A=substr($text,0,1);
$B=substr($text,1,1);
$C=substr($text,2,1);
$D=substr($text,3,1);
$E=substr($text,4,1);
$F=substr($text,5,1);
$G=substr($text,6,1);
$H=substr($text,7,1);
$I=substr($text,8,1);
$J=substr($text,9,1);
$K=substr($text,10,1);
$pdf->Cell(3,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$A","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$B","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$C","$rmc",0,"C");
$pdf->Cell(2,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$D","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$E","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$F","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$G","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$H","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$I","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$J","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$K","$rmc",0,"C");
//zo-fo-tituly
$pdf->Cell(4,6," ","$rmc1",0,"C");$pdf->Cell(25,6,"$hlavicka->zotitl","$rmc",0,"L");
$pdf->Cell(4,6," ","$rmc1",0,"C");$pdf->Cell(15,6,"$hlavicka->zotitz","$rmc",1,"L");
//zo-po-nazov
$pdf->Cell(190,12.5," ","$rmc1",1,"L");
$text=$hlavicka->zonaz;
$A=substr($text,0,1);
$B=substr($text,1,1);
$C=substr($text,2,1);
$D=substr($text,3,1);
$E=substr($text,4,1);
$F=substr($text,5,1);
$G=substr($text,6,1);
$H=substr($text,7,1);
$I=substr($text,8,1);
$J=substr($text,9,1);
$K=substr($text,10,1);
$L=substr($text,11,1);
$M=substr($text,12,1);
$N=substr($text,13,1);
$O=substr($text,14,1);
$P=substr($text,15,1);
$R=substr($text,16,1);
$S=substr($text,17,1);
$T=substr($text,18,1);
$U=substr($text,19,1);
$V=substr($text,20,1);
$W=substr($text,21,1);
$X=substr($text,22,1);
$Y=substr($text,23,1);
$Z=substr($text,24,1);
$A1=substr($text,25,1);
$B1=substr($text,26,1);
$C1=substr($text,27,1);
$D1=substr($text,28,1);
$E1=substr($text,29,1);
$F1=substr($text,30,1);
$G1=substr($text,31,1);
$H1=substr($text,32,1);
$I1=substr($text,33,1);
$J1=substr($text,34,1);
$K1=substr($text,35,1);
$L1=substr($text,36,1);
$pdf->Cell(2,6," ","$rmc1",0,"R");$pdf->Cell(4,6,"$A","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$B","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$C","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$D","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$E","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$F","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$G","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$H","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(5,6,"$I","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$J","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$K","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$L","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$M","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$N","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$O","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$P","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$R","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$S","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$T","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$U","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(5,6,"$V","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$W","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$X","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$Y","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$Z","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$A1","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$B1","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$C1","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$D1","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$E1","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$F1","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$G1","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(5,6,"$H1","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$I1","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$J1","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$K1","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$L1","$rmc",1,"C");
//zo-adresa-ulica
$pdf->Cell(190,20," ","$rmc1",1,"L");
$text=$hlavicka->zouli;
$textxx="ABCDEFGHIJKLMNOPRSTUVXYZ1234";
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
$pdf->Cell(2,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t01","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t02","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t03","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t04","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t05","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t06","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t07","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t08","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t09","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t10","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t11","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(5,7,"$t12","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t13","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t14","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t15","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t16","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t17","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t18","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t19","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t20","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t21","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t22","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t23","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t24","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(5,7,"$t25","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t26","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t27","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t28","$rmc",0,"C");
//zo-adresa-cislo
$text=$hlavicka->zocdm;
$textxx="111122";
$t01=substr($text,0,1);
$t02=substr($text,1,1);
$t03=substr($text,2,1);
$t04=substr($text,3,1);
$t05=substr($text,4,1);
$t06=substr($text,5,1);
$t07=substr($text,6,1);
$t08=substr($text,7,1);
$pdf->Cell(6,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t01","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t02","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t03","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t04","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t05","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t06","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(5,7,"$t07","$rmc",0,"C");
$pdf->Cell(1,7," ","$rmc1",0,"C");$pdf->Cell(4,7,"$t08","$rmc",1,"C");
//zo-adresa-psc
$pdf->Cell(190,6," ","$rmc1",1,"L");
$text=$hlavicka->zopsc;
$textxx="12345";
$text=str_replace(" ","",$text);
$t01=substr($text,0,1);
$t02=substr($text,1,1);
$t03=substr($text,2,1);
$t04=substr($text,3,1);
$t05=substr($text,4,1);
$pdf->Cell(2,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t01","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t02","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t03","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t04","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t05","$rmc",0,"C");
//zo-adresa-obec
$text=$hlavicka->zomes;
$textxx="ABCDEFGHIJKLMNOPRSTU";
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
$pdf->Cell(3,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t01","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(5,6,"$t02","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t03","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t04","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t05","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t06","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t07","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t08","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t09","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t10","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t11","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t12","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t13","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t14","$rmc",0,"C");
$pdf->Cell(2,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t15","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t16","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t17","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t18","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t19","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t20","$rmc",0,"C");
//zo-adresa-stat
$text=$hlavicka->zostat;
$textxx="SK";
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
$pdf->Cell(4,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t01","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t02","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t03","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t04","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t05","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t06","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t07","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t08","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t09","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t10","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$t11","$rmc",1,"C");
//zo-dan-ulava
$pdf->Cell(190,4," ","$rmc1",1,"L");
$text1=" "; if ( $hlavicka->zoulava30a == 1 ) { $text1="x"; }
$text2=" "; if ( $hlavicka->zoulava30b == 1 ) { $text2="x"; }
$pdf->Cell(2.5,6," ","$rmc1",0,"C");$pdf->Cell(3,3,"$text1","$rmc",1,"C");
$pdf->Cell(190,1.5," ","$rmc1",1,"L");
$pdf->Cell(2.5,6," ","$rmc1",0,"C");$pdf->Cell(3,3,"$text2","$rmc",1,"C");
//zo-suma-upravy
$pdf->Cell(190,12," ","$rmc1",1,"L");
$hodx=100*$hlavicka->suma;
if ( $hodx == 0 ) $hodx="";
$text=sprintf('% 12s',$hodx);
$A=substr($text,0,1);
$B=substr($text,1,1);
$C=substr($text,2,1);
$D=substr($text,3,1);
$E=substr($text,4,1);
$F=substr($text,5,1);
$G=substr($text,6,1);
$H=substr($text,7,1);
$I=substr($text,8,1);
$J=substr($text,9,1);
$K=substr($text,10,1);
$L=substr($text,11,1);
$pdf->Cell(95,6," ","$rmc1",0,"R");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$A","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$B","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$C","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$D","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$E","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$F","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$G","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$H","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$I","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$J","$rmc",0,"C");
$pdf->Cell(6.5,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$K","$rmc",0,"C");
$pdf->Cell(1,6," ","$rmc1",0,"C");$pdf->Cell(4,6,"$L","$rmc",1,"C");
                                       } //koniec 2.strany
}
$i = $i + 1;
$j = $j + 1;
  }
$pdf->Output("$outfilex");
?>
<script type="text/javascript"> var okno = window.open("<?php echo $outfilex; ?>", "_self"); </script>
<?php
}
//koniec copern==10
?>

<?php
$sqlt = 'DROP TABLE F'.$kli_vxcf.'_mzdprcvypl'.$kli_uzid;
$vysledok = mysql_query("$sqlt");
$sqlt = 'DROP TABLE F'.$kli_vxcf.'_mzdprcvyplx'.$kli_uzid;
//$vysledok = mysql_query("$sqlt");
$sqlt = 'DROP TABLE F'.$kli_vxcf.'_mzdprcvyplz'.$kli_uzid;
$vysledok = mysql_query("$sqlt");

//celkovy koniec dokumentu
if ( $copern != 10) { $cislista = include("uct_lista_norm.php"); }
} while (false);
?>
<script type="text/javascript">
//parameter okna
var blank_param = 'scrollbars=yes,resizable=yes,top=0,left=0,width=1080,height=900';

<?php
//uprava
  if ( $copern == 20 )
  {
?>
  function ObnovUI()
  {
<?php if ( $strana == 1 ) { ?>
<?php if ( $kriad == 1 ) { ?> document.formv1.kriad.checked = "checked"; <?php } ?>
<?php if ( $kdoda == 1 ) { ?> document.formv1.kdoda.checked = "checked"; <?php } ?>
   document.formv1.obod.value = '<?php echo $obodsk; ?>';
   document.formv1.obdo.value = '<?php echo $obdosk; ?>';
<?php if ( $oprav == 1 ) { ?> document.formv1.oprav.checked = "checked"; <?php } ?>
   document.formv1.datoprav.value = '<?php echo $datoprav_sk; ?>';
<?php if ( $ulava30a == 1 ) { ?> document.formv1.ulava30a.checked = "checked"; <?php } ?>
<?php if ( $ulava30b == 1 ) { ?> document.formv1.ulava30b.checked = "checked"; <?php } ?>
   document.formv1.datum.value = '<?php echo $datumsk; ?>';
<?php                                        } ?>

<?php if ( $strana == 2 ) { ?>
   document.formv1.zodic.value = '<?php echo $zodic; ?>';
   document.formv1.zoprie.value = '<?php echo $zoprie; ?>';
   document.formv1.zomeno.value = '<?php echo $zomeno; ?>';
   document.formv1.zotitl.value = '<?php echo $zotitl; ?>';
   document.formv1.zotitz.value = '<?php echo $zotitz; ?>';
   document.formv1.zonaz.value = '<?php echo $zonaz; ?>';
   document.formv1.zouli.value = '<?php echo $zouli; ?>';
   document.formv1.zocdm.value = '<?php echo $zocdm; ?>';
   document.formv1.zopsc.value = '<?php echo $zopsc; ?>';
   document.formv1.zomes.value = '<?php echo $zomes; ?>';
   document.formv1.zostat.value = '<?php echo $zostat; ?>';
<?php if ( $zoulava30a == 1 ) { ?> document.formv1.zoulava30a.checked = "checked"; <?php } ?>
<?php if ( $zoulava30b == 1 ) { ?> document.formv1.zoulava30b.checked = "checked"; <?php } ?>
   document.formv1.suma.value = '<?php echo $suma; ?>';
<?php                                        } ?>
   }
<?php
//koniec uprava
  }
?>

<?php if ( $copern != 20 ) { ?>
  function ObnovUI()
  {
  }
<?php                      } ?>

//Z ciarky na bodku
  function CiarkaNaBodku(Vstup)
  {
    if ( Vstup.value.search(/[^0-9.-]/g) != -1) { Vstup.value=Vstup.value.replace(",","."); }
  }

  function FormPDF()
  {
   window.open('oznamenie_uprzd2017.php?cislo_oc=<?php echo $cislo_oc; ?>&copern=10&drupoh=1&strana=9999&cislo_cpl=0', '_blank', blank_param);
  }


  function UpravVzd(cpl)
  {
    var cislo_cpl = cpl;
    window.open('oznamenie_uprzd2017.php?copern=346&cislo_cpl='+ cislo_cpl + '&uprav=0', '_self');
  }
  function ZmazVzd(cpl, cislo_dic)
  {
   var cislo_cpl = cpl;
   window.open('../ucto/oznamenie_uprzd2017.php?copern=316&cislo_cpl='+ cislo_cpl + '&cislo_dic='+ cislo_dic + '&uprav=0', '_self');
  }
  function NoveVzd()
  {
   window.open('../ucto/oznamenie_uprzd2017.php?copern=336&uprav=0', '_self');
  }
  function FormXML()
  {
   window.open('oznamenie_uprzd2017.php?copern=110&drupoh=1&uprav=1&cislo_cpl=0&cislo_dic=0', '_blank', blank_param);
  }
</script>
</body>
</html>