<!doctype html>
<HTML>
<?php
//Potvrdenie o prijmoch a preddavkoch v2019
do
{
$sys = 'MZD';
$urov = 3000;
$copern = $_REQUEST['copern'];
$tis = $_REQUEST['tis'];
if (!isset($tis)) $tis = 0;

$uziv = include("../uziv.php");
if ( !$uziv ) exit;

require_once("../pswd/password.php");
@$spojeni = mysql_connect($mysqlhost, $mysqluser, $mysqlpasswd);
  if (!$spojeni):
    echo "Spojenie so serverom nedostupne.";
    exit;
  endif;
  mysql_select_db($mysqldb);

//ramcek fpdf 1=zap,0=vyp
$rmc=0;
$rmc1=0;

$zablokovane=0;
if ( $zablokovane == 1 )
     {
?>
<script type="text/javascript">
alert ("Potvrdenie bude pripraven� v priebehu janu�ra 2019. Aktu�lne info n�jdete na vstupnej str�nke v bode Novinky, tipy, triky.");
window.close();
</script>
<?php
exit;
     }

//datumove funkcie
$sDat = include("../funkcie/dat_sk_us.php");
$pole = explode(".", $kli_vume);
$kli_vmes=$pole[0];
$kli_vrok=$pole[1];

$citfir = include("../cis/citaj_fir.php");

//.jpg podklad
$jpg_cesta="../dokumenty/tlacivo2019/potvrdeniefo/potvrdenie_fo_v19";
$jpg_popis="tla�ivo Potvrdenie o zdanite�n�ch pr�jmoch FO pre rok ".$kli_vrok;

$cislo_oc = $_REQUEST['cislo_oc'];
$subor = $_REQUEST['subor'];
$strana = 1*$_REQUEST['strana'];
if ( $strana == 0 ) $strana=1;

//nazov/priezvisko,meno,titul, bydlisko,/sidlo
$sqlfir = "SELECT * FROM F$kli_vxcf"."_ufirdalsie ";
$fir_vysledok = mysql_query($sqlfir);
if ($fir_vysledok) { $fir_riadok=mysql_fetch_object($fir_vysledok); }
if ( $fir_uctt03 == 999 )
{
$zamestnavatel = $fir_riadok->dprie." ".$fir_riadok->dmeno." ".$fir_riadok->dtitl;
$bydliskosidlo=$fir_riadok->duli." ".$fir_riadok->dcdm.", ".$fir_riadok->dmes;
}
if ( $fir_uctt03 != 999 )
{
$zamestnavatel = $fir_fnaz;
$bydliskosidlo=$fir_fuli." ".$fir_fcdm.", ".$fir_fmes;
}

// znovu nacitaj
if ( $copern == 26 )
     {
$sqtoz = "DELETE FROM F$kli_vxcf"."_mzdpotvrdenieFO WHERE oc = $cislo_oc";
$oznac = mysql_query("$sqtoz");
$copern=20;
$subor=1;
     }

//zapis upravene udaje
if ( $copern == 23 )
     {
$konx1 = strip_tags($_REQUEST['konx1']);
$r01 = strip_tags($_REQUEST['r01']);
$r13 = strip_tags($_REQUEST['r13']);
$r12a = strip_tags($_REQUEST['r12a']);
$r12b = strip_tags($_REQUEST['r12b']);
$r11 = strip_tags($_REQUEST['r11']);
$r11m = strip_tags($_REQUEST['r11m']);
$r02 = strip_tags($_REQUEST['r02']);
$r03a = strip_tags($_REQUEST['r03a']);
$r09 = strip_tags($_REQUEST['r09']);
$r03b = strip_tags($_REQUEST['r03b']);
$r04c = strip_tags($_REQUEST['r04c']);
$r04 = strip_tags($_REQUEST['r04']);
$r05 = strip_tags($_REQUEST['r05']);
//$r06mes = strip_tags($_REQUEST['r06mes']);
$r06sum = strip_tags($_REQUEST['r06sum']);
//$r10 = strip_tags($_REQUEST['r10']);
$r10dds = strip_tags($_REQUEST['r10dds']);
$r07det1 = strip_tags($_REQUEST['r07det1']);
$r07rod1 = strip_tags($_REQUEST['r07rod1']);
$r07mes1 = strip_tags($_REQUEST['r07mes1']);
$r07sum1 = strip_tags($_REQUEST['r07sum1']);
$r07det2 = strip_tags($_REQUEST['r07det2']);
$r07rod2 = strip_tags($_REQUEST['r07rod2']);
$r07mes2 = strip_tags($_REQUEST['r07mes2']);
$r07sum2 = strip_tags($_REQUEST['r07sum2']);
$r07det3 = strip_tags($_REQUEST['r07det3']);
$r07rod3 = strip_tags($_REQUEST['r07rod3']);
$r07mes3 = strip_tags($_REQUEST['r07mes3']);
$r07sum3 = strip_tags($_REQUEST['r07sum3']);
$r07det4 = strip_tags($_REQUEST['r07det4']);
$r07rod4 = strip_tags($_REQUEST['r07rod4']);
$r07mes4 = strip_tags($_REQUEST['r07mes4']);
$r07sum4 = strip_tags($_REQUEST['r07sum4']);
$r07det5 = strip_tags($_REQUEST['r07det5']);
$r07rod5 = strip_tags($_REQUEST['r07rod5']);
$r07mes5 = strip_tags($_REQUEST['r07mes5']);
$r07sum5 = strip_tags($_REQUEST['r07sum5']);
$r07det6 = strip_tags($_REQUEST['r07det6']);
$r07rod6 = strip_tags($_REQUEST['r07rod6']);
$r07mes6 = strip_tags($_REQUEST['r07mes6']);
$r07sum6 = strip_tags($_REQUEST['r07sum6']);
$r07det7 = strip_tags($_REQUEST['r07det7']);
$r07rod7 = strip_tags($_REQUEST['r07rod7']);
$r07mes7 = strip_tags($_REQUEST['r07mes7']);
$r07sum7 = strip_tags($_REQUEST['r07sum7']);
$r08 = strip_tags($_REQUEST['r08']);
//$m01pp = strip_tags($_REQUEST['m01pp']);
//$m02pp = strip_tags($_REQUEST['m02pp']);
//$m03pp = strip_tags($_REQUEST['m03pp']);
//$m04pp = strip_tags($_REQUEST['m04pp']);
//$m05pp = strip_tags($_REQUEST['m05pp']);
//$m06pp = strip_tags($_REQUEST['m06pp']);
//$m07pp = strip_tags($_REQUEST['m07pp']);
//$m08pp = strip_tags($_REQUEST['m08pp']);
//$m09pp = strip_tags($_REQUEST['m09pp']);
//$m10pp = strip_tags($_REQUEST['m10pp']);
//$m11pp = strip_tags($_REQUEST['m11pp']);
//$m12pp = strip_tags($_REQUEST['m12pp']);
//$m13pp = strip_tags($_REQUEST['m13pp']);
//$m01dh = strip_tags($_REQUEST['m01dh']);
//$m02dh = strip_tags($_REQUEST['m02dh']);
//$m03dh = strip_tags($_REQUEST['m03dh']);
//$m04dh = strip_tags($_REQUEST['m04dh']);
//$m05dh = strip_tags($_REQUEST['m05dh']);
//$m06dh = strip_tags($_REQUEST['m06dh']);
//$m07dh = strip_tags($_REQUEST['m07dh']);
//$m08dh = strip_tags($_REQUEST['m08dh']);
//$m09dh = strip_tags($_REQUEST['m09dh']);
//$m10dh = strip_tags($_REQUEST['m10dh']);
//$m11dh = strip_tags($_REQUEST['m11dh']);
//$m12dh = strip_tags($_REQUEST['m12dh']);
//$m13dh = strip_tags($_REQUEST['m13dh']);
//$podpa = strip_tags($_REQUEST['podpa']);
//$podpn = strip_tags($_REQUEST['podpn']);
//$prija = strip_tags($_REQUEST['prija']);
//$prijn = strip_tags($_REQUEST['prijn']);
$datv = strip_tags($_REQUEST['datv']);
$datvsql=SqlDatum($datv);
$pozn = strip_tags($_REQUEST['pozn']);
//$r07 = strip_tags($_REQUEST['r07']);
$obmedz = 1*$_REQUEST['obmedz'];
$dovca = 1*$_REQUEST['dovca'];
$chris = 1*$_REQUEST['chris'];
$oslo1 = 1*$_REQUEST['oslo1'];
$oslo2 = 1*$_REQUEST['oslo2'];

$rekre = 1*$_REQUEST['rekre'];

$prie1 = 1*$_REQUEST['prie1'];
$prie2 = 1*$_REQUEST['prie2'];

$pmes1 = 1*$_REQUEST['pmes1'];
$pmes2 = 1*$_REQUEST['pmes2'];
$uprav="NO";

if ( $strana == 1 ) {
$uprtxt = "UPDATE F$kli_vxcf"."_mzdpotvrdenieFO SET ".
" prie1='$prie1', prie2='$prie2', pmes1='$pmes1', pmes2='$pmes2', rekre='$rekre', ".
" obmedz='$obmedz', dovca='$dovca', chris='$chris', oslo1='$oslo1', oslo2='$oslo2', r12a='$r12a', r12b='$r12b', r11='$r11', r11m='$r11m', r04c='$r04c', ".
" konx1='$konx1', r01='$r01', r13='$r13', r02='$r02', r03a='$r03a', r09='$r09', r03b='$r03b', r04='$r04', r05='$r05', r06sum='$r06sum', r10dds='$r10dds', ".
" r07det1='$r07det1', r07det2='$r07det2', r07det3='$r07det3', r07det4='$r07det4', ".
" r07rod1='$r07rod1', r07rod2='$r07rod2', r07rod3='$r07rod3', r07rod4='$r07rod4', ".
" r07mes1='$r07mes1', r07mes2='$r07mes2', r07mes3='$r07mes3', r07mes4='$r07mes4', ".
" r07sum1='$r07sum1', r07sum2='$r07sum2', r07sum3='$r07sum3', r07sum4='$r07sum4', ".
" datv='$datvsql', pozn='$pozn' ".
" WHERE oc = $cislo_oc";
                    }
if ( $strana == 2 ) {
$uprtxt = "UPDATE F$kli_vxcf"."_mzdpotvrdenieFO SET ".
" r07det5='$r07det5', r07det6='$r07det6', r07det7='$r07det7', ".
" r07rod5='$r07rod5', r07rod6='$r07rod6', r07rod7='$r07rod7', ".
" r07mes5='$r07mes5', r07mes6='$r07mes6', r07mes7='$r07mes7', ".
" r07sum5='$r07sum5', r07sum6='$r07sum6', r07sum7='$r07sum7'  ".
" WHERE oc = $cislo_oc";
                    }

$upravene = mysql_query("$uprtxt");
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
//koniec zapisu upravenych udajov

//vytvor ak nie je
$sqltnew = <<<mzdprc
(
   oc           INT(7) DEFAULT 0,
   r01          DECIMAL(10,2) DEFAULT 0,
   r02          VARCHAR(20),
   r03a         DECIMAL(10,2) DEFAULT 0,
   r03b         DECIMAL(10,2) DEFAULT 0,
   r04          DECIMAL(10,2) DEFAULT 0,
   r05          DECIMAL(10,2) DEFAULT 0,
   r06mes       VARCHAR(20),
   r06sum       DECIMAL(10,2) DEFAULT 0,
   r07          DECIMAL(10,2) DEFAULT 0,
   r07det1      VARCHAR(60),
   r07det2      VARCHAR(60),
   r07det3      VARCHAR(60),
   r07det4      VARCHAR(60),
   r07det5      VARCHAR(60),
   r07det6      VARCHAR(60),
   r07mes1      VARCHAR(20),
   r07mes2      VARCHAR(20),
   r07mes3      VARCHAR(20),
   r07mes4      VARCHAR(20),
   r07mes5      VARCHAR(20),
   r07mes6      VARCHAR(20),
   r07sum1      DECIMAL(10,2) DEFAULT 0,
   r07sum2      DECIMAL(10,2) DEFAULT 0,
   r07sum3      DECIMAL(10,2) DEFAULT 0,
   r07sum4      DECIMAL(10,2) DEFAULT 0,
   r07sum5      DECIMAL(10,2) DEFAULT 0,
   r07sum6      DECIMAL(10,2) DEFAULT 0,
   r08          DECIMAL(10,2) DEFAULT 0,
   r09          DECIMAL(10,2) DEFAULT 0,
   r10          DECIMAL(10,2) DEFAULT 0,
   r11          DECIMAL(10,2) DEFAULT 0,
   r12a         DECIMAL(10,2) DEFAULT 0,
   r12b         DECIMAL(10,2) DEFAULT 0,
   r13          DECIMAL(10,2) DEFAULT 0,
   konx         DECIMAL(10,0) DEFAULT 0,
   konx1        DECIMAL(10,0) DEFAULT 0,
   m01pp        INT,
   m02pp        INT,
   m03pp        INT,
   m04pp        INT,
   m05pp        INT,
   m06pp        INT,
   m07pp        INT,
   m08pp        INT,
   m09pp        INT,
   m10pp        INT,
   m11pp        INT,
   m12pp        INT,
   m13pp        INT,
   m01dh        INT,
   m02dh        INT,
   m03dh        INT,
   m04dh        INT,
   m05dh        INT,
   m06dh        INT,
   m07dh        INT,
   m08dh        INT,
   m09dh        INT,
   m10dh        INT,
   m11dh        INT,
   m12dh        INT,
   m13dh        INT,
   podpa        INT,
   podpn        INT,
   prija        INT,
   prijn        INT,
   konx3        DECIMAL(10,0) DEFAULT 0
);
mzdprc;

$sql = "SELECT datv FROM F$kli_vxcf"."_mzdpotvrdenieFO ";
$vysledok = mysql_query("$sql");
if (!$vysledok)
{
//prac.subor a subor vytvorenych potvrdeni
$sqlt = 'DROP TABLE F'.$kli_vxcf.'_mzdprcvypl'.$kli_uzid;
$vysledok = mysql_query("$sqlt");
$sqlt = 'DROP TABLE F'.$kli_vxcf.'_mzdprcvyplx'.$kli_uzid;
$vysledok = mysql_query("$sqlt");
$sqlt = 'DROP TABLE F'.$kli_vxcf.'_mzdprcvyplz'.$kli_uzid;
$vysledok = mysql_query("$sqlt");
$sqlt = 'DROP TABLE F'.$kli_vxcf.'_mzdpotvrdenieFO ';
$vysledok = mysql_query("$sqlt");

$vsql = 'CREATE TABLE F'.$kli_vxcf.'_mzdpotvrdenieFO'.$sqltnew;
$vytvor = mysql_query("$vsql");

$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD pozn VARCHAR(80) NOT NULL AFTER konx";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD konx3 DECIMAL(10,0) DEFAULT 0 AFTER konx1";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD prijn INT DEFAULT 0 AFTER konx1";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD prija INT DEFAULT 0 AFTER konx1";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD podpn INT DEFAULT 0 AFTER konx1";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD podpa INT DEFAULT 0 AFTER konx1";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD m13dh INT DEFAULT 0 AFTER konx1";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD m12dh INT DEFAULT 0 AFTER konx1";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD m11dh INT DEFAULT 0 AFTER konx1";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD m10dh INT DEFAULT 0 AFTER konx1";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD m09dh INT DEFAULT 0 AFTER konx1";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD m08dh INT DEFAULT 0 AFTER konx1";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD m07dh INT DEFAULT 0 AFTER konx1";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD m06dh INT DEFAULT 0 AFTER konx1";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD m05dh INT DEFAULT 0 AFTER konx1";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD m04dh INT DEFAULT 0 AFTER konx1";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD m03dh INT DEFAULT 0 AFTER konx1";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD m02dh INT DEFAULT 0 AFTER konx1";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD m01dh INT DEFAULT 0 AFTER konx1";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD m13pp INT DEFAULT 0 AFTER konx1";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD m12pp INT DEFAULT 0 AFTER konx1";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD m11pp INT DEFAULT 0 AFTER konx1";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD m10pp INT DEFAULT 0 AFTER konx1";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD m09pp INT DEFAULT 0 AFTER konx1";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD m08pp INT DEFAULT 0 AFTER konx1";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD m07pp INT DEFAULT 0 AFTER konx1";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD m06pp INT DEFAULT 0 AFTER konx1";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD m05pp INT DEFAULT 0 AFTER konx1";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD m04pp INT DEFAULT 0 AFTER konx1";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD m03pp INT DEFAULT 0 AFTER konx1";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD m02pp INT DEFAULT 0 AFTER konx1";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD m01pp INT DEFAULT 0 AFTER konx1";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD datv DATE not null AFTER konx3";
$vysledek = mysql_query("$sql");
}
//koniec vytvor ak nie je

//zmeny2014
$sql = "SELECT r07rod1 FROM F$kli_vxcf"."_mzdpotvrdenieFO ";
$vysledok = mysql_query("$sql");
if (!$vysledok)
{
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD r07det7 VARCHAR(60) not null AFTER r07det6";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD r07mes7 VARCHAR(20) not null AFTER r07mes6";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD r07sum7 DECIMAL(10,2) DEFAULT 0 AFTER r07sum6";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD r07rod7 VARCHAR(15) not null AFTER r07sum7";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD r07rod6 VARCHAR(15) not null AFTER r07sum7";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD r07rod5 VARCHAR(15) not null AFTER r07sum7";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD r07rod4 VARCHAR(15) not null AFTER r07sum7";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD r07rod3 VARCHAR(15) not null AFTER r07sum7";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD r07rod2 VARCHAR(15) not null AFTER r07sum7";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD r07rod1 VARCHAR(15) not null AFTER r07sum7";
$vysledek = mysql_query("$sql");
}
//koniec zmeny2014

//zmeny2015
$sql = "SELECT r04c FROM F$kli_vxcf"."_mzdpotvrdenieFO ";
$vysledok = mysql_query("$sql");
if (!$vysledok)
{
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD new2015 DECIMAL(2,0) DEFAULT 0 AFTER datv";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD obmedz DECIMAL(2,0) DEFAULT 0 AFTER new2015";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD r04c DECIMAL(10,2) DEFAULT 0 AFTER new2015";
$vysledek = mysql_query("$sql");
}
//koniec zmeny2015

//zmeny2016
$sql = "SELECT r10dds FROM F$kli_vxcf"."_mzdpotvrdenieFO ";
$vysledok = mysql_query("$sql");
if (!$vysledok)
{
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD new2016 DECIMAL(2,0) DEFAULT 0 AFTER datv";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD r11m DECIMAL(10,2) DEFAULT 0 AFTER new2016";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD r10dds DECIMAL(10,2) DEFAULT 0 AFTER new2016";
$vysledek = mysql_query("$sql");
}
//zmeny2017
$sql = "SELECT ume FROM F$kli_vxcf"."_mzdpotvrdenieFO ";
$vysledok = mysql_query("$sql");
if (!$vysledok)
{
//echo "idem";
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD ume DECIMAL(7,4) DEFAULT 0 AFTER oc";
$vysledek = mysql_query("$sql");
//exit;
}
//zmeny2018
$sql = "SELECT pmes2 FROM F$kli_vxcf"."_mzdpotvrdenieFO ";
$vysledok = mysql_query("$sql");
if (!$vysledok)
{
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD new2018 DECIMAL(2,0) DEFAULT 0 AFTER obmedz";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD dovca DECIMAL(10,2) DEFAULT 0 AFTER new2018";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD chris DECIMAL(10,2) DEFAULT 0 AFTER new2018";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD oslo1 DECIMAL(10,2) DEFAULT 0 AFTER new2018";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD oslo2 DECIMAL(10,2) DEFAULT 0 AFTER new2018";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD prie1 DECIMAL(10,2) DEFAULT 0 AFTER new2018";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD prie2 DECIMAL(10,2) DEFAULT 0 AFTER new2018";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD pmes1 DECIMAL(5,0) DEFAULT 0 AFTER new2018";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD pmes2 DECIMAL(5,0) DEFAULT 0 AFTER new2018";
$vysledek = mysql_query("$sql");
//exit;
}
//zmeny2019
$sql = "SELECT rekre FROM F$kli_vxcf"."_mzdpotvrdenieFO ";
$vysledok = mysql_query("$sql");
if (!$vysledok)
{
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD new2019 DECIMAL(2,0) DEFAULT 0 AFTER dovca";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdpotvrdenieFO ADD rekre DECIMAL(10,2) DEFAULT 0 AFTER new2019";
$vysledek = mysql_query("$sql");
}
$sqlt = 'DROP TABLE F'.$kli_vxcf.'_mzdprcvypl'.$kli_uzid;
$vysledok = mysql_query("$sqlt");
$sqlt = 'DROP TABLE F'.$kli_vxcf.'_mzdprcvyplx'.$kli_uzid;
$vysledok = mysql_query("$sqlt");
$sqlt = 'DROP TABLE F'.$kli_vxcf.'_mzdprcvyplz'.$kli_uzid;
$vysledok = mysql_query("$sqlt");

$vsql = 'CREATE TABLE F'.$kli_vxcf.'_mzdprcvypl'.$kli_uzid.$sqltnew;
$vytvor = mysql_query("$vsql");
$vsql = 'CREATE TABLE F'.$kli_vxcf.'_mzdprcvyplx'.$kli_uzid.$sqltnew;
$vytvor = mysql_query("$vsql");
$vsql = 'CREATE TABLE F'.$kli_vxcf.'_mzdprcvyplz'.$kli_uzid.$sqltnew;
$vytvor = mysql_query("$vsql");

$sql = "SELECT ume FROM F$kli_vxcf"."_mzdprcvypl".$kli_uzid." ";
$vysledok = mysql_query("$sql");
if (!$vysledok)
{
//echo "idem";
$sql = "ALTER TABLE F$kli_vxcf"."_mzdprcvypl".$kli_uzid." ADD ume DECIMAL(7,4) DEFAULT 0 AFTER oc";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdprcvyplx".$kli_uzid." ADD ume DECIMAL(7,4) DEFAULT 0 AFTER oc";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdprcvyplz".$kli_uzid." ADD ume DECIMAL(7,4) DEFAULT 0 AFTER oc";
$vysledek = mysql_query("$sql");
//exit;
}


$jepotvrd=0;
$sql = "SELECT * FROM F$kli_vxcf"."_mzdpotvrdenieFO WHERE oc = $cislo_oc";
$sqldok = mysql_query("$sql");
  if (@$zaznam=mysql_data_seek($sqldok,0))
  {
  $jepotvrd=1;
  }
if ( $jepotvrd == 0 ) $subor=1;

//pre potvrdenie vytvor pracovny subor
if ( $subor == 1 )
{

$sqtoz = "INSERT INTO F$kli_vxcf"."_mzdprcvypl".$kli_uzid." ( oc ) VALUES ( $cislo_oc )";
$oznac = mysql_query("$sqtoz");

//zober data zo sum zaklady,odvody spocitane novym eurosecom
$dsqlt = "INSERT INTO F$kli_vxcf"."_mzdprcvypl".$kli_uzid.
" SELECT oc,ume,".
"(zdan_dnp+pdan_zn1),'',pdan_fnd,ozam_zp,0,0,'',pdan_dnv,0,".
"'','','','','','','','','','','','',0,0,0,0,0,0,".
"0,(pdan_fnd-ozam_zp),0,0,0,0,0,".
"1,".
"0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0 ".
" FROM F$kli_vxcf"."_mzdzalsum".
" WHERE F$kli_vxcf"."_mzdzalsum.oc = $cislo_oc AND ksum2 != 9".
"";
//echo $dsqlt;
$dsql = mysql_query("$dsqlt");

//zober bonus z vy
$dsqlt = "INSERT INTO F$kli_vxcf"."_mzdprcvypl".$kli_uzid.
" SELECT oc,ume,".
"0,'',0,0,0,0,'',0,-(kc),".
"'','','','','','','','','','','','',-(kc),0,0,0,0,0,".
"-(kc),0,0,0,0,0,0,".
"1,".
"0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0 ".
" FROM F$kli_vxcf"."_mzdzalvy".
" WHERE F$kli_vxcf"."_mzdzalvy.oc = $cislo_oc AND dm = 902".
"";
//echo $dsqlt;
$dsql = mysql_query("$dsqlt");

//zober dan z prijmu 901 z vy
$dsqlt = "INSERT INTO F$kli_vxcf"."_mzdprcvypl".$kli_uzid.
" SELECT oc,ume,".
"0,'',0,0,0,kc,'',0,0,".
"'','','','','','','','','','','','',0,0,0,0,0,0,".
"0,0,0,0,0,0,0,".
"1,".
"0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0 ".
" FROM F$kli_vxcf"."_mzdzalvy".
" WHERE F$kli_vxcf"."_mzdzalvy.oc = $cislo_oc AND dm = 901".
"";
//echo $dsqlt;
$dsql = mysql_query("$dsqlt");

//zober doplatok ZP 954 z vy a pripocitaj k odvodom ak doplacal (954 +kc)
$dsqlt = "INSERT INTO F$kli_vxcf"."_mzdprcvypl".$kli_uzid.
" SELECT oc,ume,".
"0,'',kc,kc,0,0,'',0,0,".
"'','','','','','','','','','','','',0,0,0,0,0,0,".
"0,0,0,0,0,0,0,".
"1,".
"0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0 ".
" FROM F$kli_vxcf"."_mzdzalvy".
" WHERE F$kli_vxcf"."_mzdzalvy.oc = $cislo_oc AND dm = 954 AND kc > 0".
"";
//echo $dsqlt;
$dsql = mysql_query("$dsqlt");

//zober doplatok ZP 954 z vy a pripocitaj k prijmu ak sa mu vracalo (954 -kc)
$dsqlt = "INSERT INTO F$kli_vxcf"."_mzdprcvypl".$kli_uzid.
" SELECT oc,ume,".
"-(kc),'',0,0,0,0,'',0,0,".
"'','','','','','','','','','','','',0,0,0,0,0,0,".
"0,0,0,0,0,0,0,".
"1,".
"0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0 ".
" FROM F$kli_vxcf"."_mzdzalvy".
" WHERE F$kli_vxcf"."_mzdzalvy.oc = $cislo_oc AND dm = 954 AND kc < 0".
"";
//echo $dsqlt;
$dsql = mysql_query("$dsqlt");

//zober DM 968 dobrovolne poistenie dochodkove
$dsqlt = "INSERT INTO F$kli_vxcf"."_mzdprcvypl".$kli_uzid.
" SELECT oc,ume,".
"0,'',0,0,0,0,'',0,0,".
"'','','','','','','','','','','','',0,0,0,0,0,0,".
"0,0,kc,0,0,0,0,".
"1,".
"0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0 ".
" FROM F$kli_vxcf"."_mzdzalvy".
" WHERE F$kli_vxcf"."_mzdzalvy.oc = $cislo_oc AND dm = 968 AND kc > 0".
"";
//echo $dsqlt;
$dsql = mysql_query("$dsqlt");

//dopln pomer a dohodu a z toho na dohodu prijem podla mesiacov
$iume=1;
while( $iume <= 12 ) {

$umexx=$iume.".".$kli_vrok;

$sqtoz = "UPDATE F$kli_vxcf"."_mzdprcvypl$kli_uzid,F$kli_vxcf"."_mzdzalkun".
" SET podpn=pom ".
" WHERE F$kli_vxcf"."_mzdprcvypl$kli_uzid.oc = F$kli_vxcf"."_mzdzalkun.oc AND F$kli_vxcf"."_mzdzalkun.ume = $umexx ";
$oznac = mysql_query("$sqtoz");

$sqtoz = "UPDATE F$kli_vxcf"."_mzdprcvypl$kli_uzid,F$kli_vxcf"."_mzdpomer".
" SET podpa=pm_doh ".
" WHERE F$kli_vxcf"."_mzdprcvypl$kli_uzid.podpn = F$kli_vxcf"."_mzdpomer.pm";
$oznac = mysql_query("$sqtoz");

$sqtoz = "UPDATE F$kli_vxcf"."_mzdprcvypl$kli_uzid ".
" SET r13=r01 WHERE podpa = 1 AND ume = $umexx ";
$oznac = mysql_query("$sqtoz");

$iume=$iume+1;
}
//exit;

//sumarizuj za oc
$dsqlt = "INSERT INTO F$kli_vxcf"."_mzdprcvypl".$kli_uzid.
" SELECT oc,0,".
"sum(r01),r02,sum(r03a),sum(r03b),sum(r04),sum(r05),r06mes,sum(r06sum),sum(r07),".
"'','','','','','',r07mes1,r07mes2,r07mes3,r07mes4,r07mes5,r07mes6,SUM(r07sum1),r07sum2,r07sum3,r07sum4,r07sum5,r07sum6,".
"sum(r08),sum(r09),sum(r10),sum(r11),sum(r12a),sum(r12b),sum(r13),".
"2,konx1,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0 ".
" FROM F$kli_vxcf"."_mzdprcvypl".$kli_uzid.
" GROUP BY oc".
"";
//echo $dsqlt;
$dsql = mysql_query("$dsqlt");

$sqtoz = "DELETE FROM F$kli_vxcf"."_mzdprcvypl$kli_uzid WHERE konx = 1";
$oznac = mysql_query("$sqtoz");

//nastav par50
$sqtoz = "UPDATE F$kli_vxcf"."_mzdprcvypl$kli_uzid".
" SET podpn=1, podpa=0 WHERE oc >= 0";
//echo $sqtoz;
$oznac = mysql_query("$sqtoz");

if ( $alchem == 1 )
{
//zober 197 a nastav par50
$dsqlt = "INSERT INTO F$kli_vxcf"."_mzdprcvyplx".$kli_uzid.
" SELECT oc,0,".
"0,'',0,0,0,0,'',0,kc,".
"'','','','','','','','','','','','',0,0,0,0,0,0,".
"0,0,0,0,0,0,0,".
"1,".
"0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,1 ".
" FROM F$kli_vxcf"."_mzdzalvy".
" WHERE F$kli_vxcf"."_mzdzalvy.oc = $cislo_oc AND dm = 197".
"";
$dsql = mysql_query("$dsqlt");

$dsqlt = "INSERT INTO F$kli_vxcf"."_mzdprcvyplx".$kli_uzid.
" SELECT oc,0,".
"0,'',0,0,0,0,'',0,SUM(r07),".
"'','','','','','','','','','','','',0,0,0,0,0,0,".
"0,0,0,0,0,0,0,".
"1,".
"0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0,0,0,0,0,0,0,0,0,".
"0,0,0,0,0 ".
" FROM F$kli_vxcf"."_mzdprcvyplx".$kli_uzid.
" GROUP BY oc".
"";
//echo $dsqlt;
$dsql = mysql_query("$dsqlt");

$sqtoz = "DELETE FROM F$kli_vxcf"."_mzdprcvyplx$kli_uzid WHERE konx3 = 1";
$oznac = mysql_query("$sqtoz");

$sqtoz = "UPDATE F$kli_vxcf"."_mzdprcvypl$kli_uzid,F$kli_vxcf"."_mzdprcvyplx$kli_uzid".
" SET F$kli_vxcf"."_mzdprcvypl$kli_uzid.podpn=0, F$kli_vxcf"."_mzdprcvypl$kli_uzid.podpa=1 ".
" WHERE F$kli_vxcf"."_mzdprcvypl$kli_uzid.oc=F$kli_vxcf"."_mzdprcvyplx$kli_uzid.oc AND F$kli_vxcf"."_mzdprcvyplx$kli_uzid.r07 > 0";
//echo $sqtoz;
$oznac = mysql_query("$sqtoz");
}
//exit;

//nastav mesiace
$sqtoz = "UPDATE F$kli_vxcf"."_mzdprcvypl$kli_uzid".
" SET r06mes='01-12', r02='01-12' WHERE oc >= 0";
//echo $sqtoz;
$oznac = mysql_query("$sqtoz");

//nastup iny ako pred 1.1.
$sqtoz = "UPDATE F$kli_vxcf"."_mzdprcvypl$kli_uzid,F$kli_vxcf"."_mzdkun".
" SET r02=INSERT(r06mes,1,2,'02') WHERE F$kli_vxcf"."_mzdprcvypl$kli_uzid.oc=F$kli_vxcf"."_mzdkun.oc AND dan >= '".$kli_vrok."-02-01' ";
$oznac = mysql_query("$sqtoz");

$sqtoz = "UPDATE F$kli_vxcf"."_mzdprcvypl$kli_uzid,F$kli_vxcf"."_mzdkun".
" SET r02=INSERT(r06mes,1,2,'03') WHERE F$kli_vxcf"."_mzdprcvypl$kli_uzid.oc=F$kli_vxcf"."_mzdkun.oc AND dan >= '".$kli_vrok."-03-01' ";
$oznac = mysql_query("$sqtoz");

$sqtoz = "UPDATE F$kli_vxcf"."_mzdprcvypl$kli_uzid,F$kli_vxcf"."_mzdkun".
" SET r02=INSERT(r06mes,1,2,'04') WHERE F$kli_vxcf"."_mzdprcvypl$kli_uzid.oc=F$kli_vxcf"."_mzdkun.oc AND dan >= '".$kli_vrok."-04-01' ";
$oznac = mysql_query("$sqtoz");

$sqtoz = "UPDATE F$kli_vxcf"."_mzdprcvypl$kli_uzid,F$kli_vxcf"."_mzdkun".
" SET r02=INSERT(r06mes,1,2,'05') WHERE F$kli_vxcf"."_mzdprcvypl$kli_uzid.oc=F$kli_vxcf"."_mzdkun.oc AND dan >= '".$kli_vrok."-05-01' ";
$oznac = mysql_query("$sqtoz");

$sqtoz = "UPDATE F$kli_vxcf"."_mzdprcvypl$kli_uzid,F$kli_vxcf"."_mzdkun".
" SET r02=INSERT(r06mes,1,2,'06') WHERE F$kli_vxcf"."_mzdprcvypl$kli_uzid.oc=F$kli_vxcf"."_mzdkun.oc AND dan >= '".$kli_vrok."-06-01' ";
$oznac = mysql_query("$sqtoz");

$sqtoz = "UPDATE F$kli_vxcf"."_mzdprcvypl$kli_uzid,F$kli_vxcf"."_mzdkun".
" SET r02=INSERT(r06mes,1,2,'07') WHERE F$kli_vxcf"."_mzdprcvypl$kli_uzid.oc=F$kli_vxcf"."_mzdkun.oc AND dan >= '".$kli_vrok."-07-01' ";
$oznac = mysql_query("$sqtoz");

$sqtoz = "UPDATE F$kli_vxcf"."_mzdprcvypl$kli_uzid,F$kli_vxcf"."_mzdkun".
" SET r02=INSERT(r06mes,1,2,'08') WHERE F$kli_vxcf"."_mzdprcvypl$kli_uzid.oc=F$kli_vxcf"."_mzdkun.oc AND dan >= '".$kli_vrok."-08-01' ";
$oznac = mysql_query("$sqtoz");

$sqtoz = "UPDATE F$kli_vxcf"."_mzdprcvypl$kli_uzid,F$kli_vxcf"."_mzdkun".
" SET r02=INSERT(r06mes,1,2,'09') WHERE F$kli_vxcf"."_mzdprcvypl$kli_uzid.oc=F$kli_vxcf"."_mzdkun.oc AND dan >= '".$kli_vrok."-09-01' ";
$oznac = mysql_query("$sqtoz");

$sqtoz = "UPDATE F$kli_vxcf"."_mzdprcvypl$kli_uzid,F$kli_vxcf"."_mzdkun".
" SET r02=INSERT(r06mes,1,2,'10') WHERE F$kli_vxcf"."_mzdprcvypl$kli_uzid.oc=F$kli_vxcf"."_mzdkun.oc AND dan >= '".$kli_vrok."-10-01' ";
$oznac = mysql_query("$sqtoz");

$sqtoz = "UPDATE F$kli_vxcf"."_mzdprcvypl$kli_uzid,F$kli_vxcf"."_mzdkun".
" SET r02=INSERT(r06mes,1,2,'11') WHERE F$kli_vxcf"."_mzdprcvypl$kli_uzid.oc=F$kli_vxcf"."_mzdkun.oc AND dan >= '".$kli_vrok."-11-01' ";
$oznac = mysql_query("$sqtoz");

$sqtoz = "UPDATE F$kli_vxcf"."_mzdprcvypl$kli_uzid,F$kli_vxcf"."_mzdkun".
" SET r02=INSERT(r06mes,1,2,'12') WHERE F$kli_vxcf"."_mzdprcvypl$kli_uzid.oc=F$kli_vxcf"."_mzdkun.oc AND dan >= '".$kli_vrok."-12-01' ";
$oznac = mysql_query("$sqtoz");

$sqtoz = "UPDATE F$kli_vxcf"."_mzdprcvypl$kli_uzid".
" SET r06mes=r02 WHERE oc >= 0";
//echo $sqtoz;
$oznac = mysql_query("$sqtoz");

//vystup je v roku
$sqtoz = "UPDATE F$kli_vxcf"."_mzdprcvypl$kli_uzid,F$kli_vxcf"."_mzdkun".
" SET r02=INSERT(r06mes,4,2,'01') WHERE F$kli_vxcf"."_mzdprcvypl$kli_uzid.oc=F$kli_vxcf"."_mzdkun.oc AND dav >= '".$kli_vrok."-01-01' AND dav != '0000-00-00'  ";
$oznac = mysql_query("$sqtoz");

$sqtoz = "UPDATE F$kli_vxcf"."_mzdprcvypl$kli_uzid,F$kli_vxcf"."_mzdkun".
" SET r02=INSERT(r06mes,4,2,'02') WHERE F$kli_vxcf"."_mzdprcvypl$kli_uzid.oc=F$kli_vxcf"."_mzdkun.oc AND dav >= '".$kli_vrok."-02-01' AND dav != '0000-00-00'  ";
$oznac = mysql_query("$sqtoz");

$sqtoz = "UPDATE F$kli_vxcf"."_mzdprcvypl$kli_uzid,F$kli_vxcf"."_mzdkun".
" SET r02=INSERT(r06mes,4,2,'03') WHERE F$kli_vxcf"."_mzdprcvypl$kli_uzid.oc=F$kli_vxcf"."_mzdkun.oc AND dav >= '".$kli_vrok."-03-01' AND dav != '0000-00-00'  ";
$oznac = mysql_query("$sqtoz");

$sqtoz = "UPDATE F$kli_vxcf"."_mzdprcvypl$kli_uzid,F$kli_vxcf"."_mzdkun".
" SET r02=INSERT(r06mes,4,2,'04') WHERE F$kli_vxcf"."_mzdprcvypl$kli_uzid.oc=F$kli_vxcf"."_mzdkun.oc AND dav >= '".$kli_vrok."-04-01' AND dav != '0000-00-00'  ";
$oznac = mysql_query("$sqtoz");

$sqtoz = "UPDATE F$kli_vxcf"."_mzdprcvypl$kli_uzid,F$kli_vxcf"."_mzdkun".
" SET r02=INSERT(r06mes,4,2,'05') WHERE F$kli_vxcf"."_mzdprcvypl$kli_uzid.oc=F$kli_vxcf"."_mzdkun.oc AND dav >= '".$kli_vrok."-05-01' AND dav != '0000-00-00'  ";
$oznac = mysql_query("$sqtoz");

$sqtoz = "UPDATE F$kli_vxcf"."_mzdprcvypl$kli_uzid,F$kli_vxcf"."_mzdkun".
" SET r02=INSERT(r06mes,4,2,'06') WHERE F$kli_vxcf"."_mzdprcvypl$kli_uzid.oc=F$kli_vxcf"."_mzdkun.oc AND dav >= '".$kli_vrok."-06-01' AND dav != '0000-00-00'  ";
$oznac = mysql_query("$sqtoz");

$sqtoz = "UPDATE F$kli_vxcf"."_mzdprcvypl$kli_uzid,F$kli_vxcf"."_mzdkun".
" SET r02=INSERT(r06mes,4,2,'07') WHERE F$kli_vxcf"."_mzdprcvypl$kli_uzid.oc=F$kli_vxcf"."_mzdkun.oc AND dav >= '".$kli_vrok."-07-01' AND dav != '0000-00-00'  ";
$oznac = mysql_query("$sqtoz");

$sqtoz = "UPDATE F$kli_vxcf"."_mzdprcvypl$kli_uzid,F$kli_vxcf"."_mzdkun".
" SET r02=INSERT(r06mes,4,2,'08') WHERE F$kli_vxcf"."_mzdprcvypl$kli_uzid.oc=F$kli_vxcf"."_mzdkun.oc AND dav >= '".$kli_vrok."-08-01' AND dav != '0000-00-00'  ";
$oznac = mysql_query("$sqtoz");

$sqtoz = "UPDATE F$kli_vxcf"."_mzdprcvypl$kli_uzid,F$kli_vxcf"."_mzdkun".
" SET r02=INSERT(r06mes,4,2,'09') WHERE F$kli_vxcf"."_mzdprcvypl$kli_uzid.oc=F$kli_vxcf"."_mzdkun.oc AND dav >= '".$kli_vrok."-09-01' AND dav != '0000-00-00'  ";
$oznac = mysql_query("$sqtoz");

$sqtoz = "UPDATE F$kli_vxcf"."_mzdprcvypl$kli_uzid,F$kli_vxcf"."_mzdkun".
" SET r02=INSERT(r06mes,4,2,'10') WHERE F$kli_vxcf"."_mzdprcvypl$kli_uzid.oc=F$kli_vxcf"."_mzdkun.oc AND dav >= '".$kli_vrok."-10-01' AND dav != '0000-00-00'  ";
$oznac = mysql_query("$sqtoz");

$sqtoz = "UPDATE F$kli_vxcf"."_mzdprcvypl$kli_uzid,F$kli_vxcf"."_mzdkun".
" SET r02=INSERT(r06mes,4,2,'11') WHERE F$kli_vxcf"."_mzdprcvypl$kli_uzid.oc=F$kli_vxcf"."_mzdkun.oc AND dav >= '".$kli_vrok."-11-01' AND dav != '0000-00-00'  ";
$oznac = mysql_query("$sqtoz");

$sqtoz = "UPDATE F$kli_vxcf"."_mzdprcvypl$kli_uzid,F$kli_vxcf"."_mzdkun".
" SET r02=INSERT(r06mes,4,2,'12') WHERE F$kli_vxcf"."_mzdprcvypl$kli_uzid.oc=F$kli_vxcf"."_mzdkun.oc AND dav >= '".$kli_vrok."-12-01' AND dav != '0000-00-00'  ";
$oznac = mysql_query("$sqtoz");

$sqtoz = "UPDATE F$kli_vxcf"."_mzdprcvypl$kli_uzid".
" SET r06mes=r02 WHERE oc >= 0";
//echo $sqtoz;
$oznac = mysql_query("$sqtoz");

//deti
$mdt1=""; $rcdt1=''; $msdt1="";
$mdt2=""; $rcdt2=''; $msdt2="";
$mdt3=""; $rcdt3=''; $msdt3="";
$mdt4=""; $rcdt4=''; $msdt4="";
$mdt5=""; $rcdt5=''; $msdt5="";
$mdt6=""; $rcdt6=''; $msdt6="";

$sqldttt = "SELECT * FROM F$kli_vxcf"."_mzddeti WHERE oc = $cislo_oc ORDER BY dr";

$sqldt = mysql_query("$sqldttt");
$poldt = mysql_num_rows($sqldt);

$idt=0;
  while ($idt <= $poldt )
  {
  if (@$zaznam=mysql_data_seek($sqldt,$idt))
{
$deti=mysql_fetch_object($sqldt);

$dr_sk=SkDatum($deti->dr);

if ( $idt == 0 ) { $mdt1=$deti->md; $rcdt1=$deti->rcd; $msdt1="01-12"; }
if ( $idt == 1 ) { $mdt2=$deti->md; $rcdt2=$deti->rcd; $msdt2="01-12"; }
if ( $idt == 2 ) { $mdt3=$deti->md; $rcdt3=$deti->rcd; $msdt3="01-12"; }
if ( $idt == 3 ) { $mdt4=$deti->md; $rcdt4=$deti->rcd; $msdt4="01-12"; }
if ( $idt == 4 ) { $mdt5=$deti->md; $rcdt5=$deti->rcd; $msdt5="01-12"; }
if ( $idt == 5 ) { $mdt6=$deti->md; $rcdt6=$deti->rcd; $msdt6="01-12"; }
if ( $idt == 6 ) { $mdt7=$deti->md; $rcdt7=$deti->rcd; $msdt7="01-12"; }
}
$idt = $idt + 1;
  }

$sql = "ALTER TABLE F$kli_vxcf"."_mzdprcvypl$kli_uzid ADD r07det7 VARCHAR(60) not null AFTER r07det6";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdprcvypl$kli_uzid ADD r07mes7 VARCHAR(15) not null AFTER r07mes6";
$vysledek = mysql_query("$sql");


$sql = "ALTER TABLE F$kli_vxcf"."_mzdprcvypl$kli_uzid ADD r07rod7 VARCHAR(15) not null AFTER r07sum6";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdprcvypl$kli_uzid ADD r07rod6 VARCHAR(15) not null AFTER r07sum6";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdprcvypl$kli_uzid ADD r07rod5 VARCHAR(15) not null AFTER r07sum6";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdprcvypl$kli_uzid ADD r07rod4 VARCHAR(15) not null AFTER r07sum6";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdprcvypl$kli_uzid ADD r07rod3 VARCHAR(15) not null AFTER r07sum6";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdprcvypl$kli_uzid ADD r07rod2 VARCHAR(15) not null AFTER r07sum6";
$vysledek = mysql_query("$sql");
$sql = "ALTER TABLE F$kli_vxcf"."_mzdprcvypl$kli_uzid ADD r07rod1 VARCHAR(15) not null AFTER r07sum6";
$vysledek = mysql_query("$sql");

$sqtoz = "UPDATE F$kli_vxcf"."_mzdprcvypl$kli_uzid SET r07det1='$mdt1', r07rod1='$rcdt1', r07mes1='01-12' WHERE oc >= 0";
if ( $mdt1 != '' ) $oznac = mysql_query("$sqtoz");
$sqtoz = "UPDATE F$kli_vxcf"."_mzdprcvypl$kli_uzid SET r07det2='$mdt2', r07rod2='$rcdt2', r07mes2='01-12' WHERE oc >= 0";
if ( $mdt2 != '' ) $oznac = mysql_query("$sqtoz");
$sqtoz = "UPDATE F$kli_vxcf"."_mzdprcvypl$kli_uzid SET r07det3='$mdt3', r07rod3='$rcdt3', r07mes3='01-12' WHERE oc >= 0";
if ( $mdt3 != '' ) $oznac = mysql_query("$sqtoz");
$sqtoz = "UPDATE F$kli_vxcf"."_mzdprcvypl$kli_uzid SET r07det4='$mdt4', r07rod4='$rcdt4', r07mes4='01-12' WHERE oc >= 0";
if ( $mdt4 != '' ) $oznac = mysql_query("$sqtoz");
$sqtoz = "UPDATE F$kli_vxcf"."_mzdprcvypl$kli_uzid SET r07det5='$mdt5', r07rod5='$rcdt5', r07mes5='01-12' WHERE oc >= 0";
if ( $mdt5 != '' ) $oznac = mysql_query("$sqtoz");
$sqtoz = "UPDATE F$kli_vxcf"."_mzdprcvypl$kli_uzid SET r07det6='$mdt6', r07rod6='$rcdt6', r07mes6='01-12' WHERE oc >= 0";
if ( $mdt6 != '' ) $oznac = mysql_query("$sqtoz");
$sqtoz = "UPDATE F$kli_vxcf"."_mzdprcvypl$kli_uzid SET r07det7='$mdt7', r07rod7='$rcdt7', r07mes7='01-12' WHERE oc >= 0";
if ( $mdt7 != '' ) $oznac = mysql_query("$sqtoz");

//uloz do mzdpotvrdenieFO
$sqtoz = "DELETE FROM F$kli_vxcf"."_mzdpotvrdenieFO WHERE oc = $cislo_oc";
$oznac = mysql_query("$sqtoz");

$dat_dat = Date ("Y-m-d", MkTime (date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")));

//oc
//r01	r02	r03a	r03b	r04	r05	r06mes	r06sum	r07
//r07det1	r07det2	r07det3	r07det4	r07det5	r07det6	r07det7	r07mes1	r07mes2	r07mes3	r07mes4	r07mes5	r07mes6	r07mes7	r07sum1	r07sum2	r07sum3	r07sum4	r07sum5	r07sum6
//	r08	r09	r10	r11	r12a	r12b	r13	konx	pozn	konx1
//m01pp	m02pp	m03pp	m04pp	m05pp	m06pp	m07pp	m08pp	m09pp	m10pp	m11pp	m12pp	m13pp
//m01dh	m02dh	m03dh	m04dh	m05dh	m06dh	m07dh	m08dh	m09dh	m10dh	m11dh	m12dh	m13dh
//podpa	podpn	prija	prijn	konx3	datv

$dsqlt = "INSERT INTO F$kli_vxcf"."_mzdpotvrdenieFO".
" SELECT oc,0,".
"sum(r01),r02,sum(r03a),sum(r03b),sum(r04),sum(r05),r06mes,sum(r06sum),sum(r07),".
"r07det1,r07det2,r07det3,r07det4,r07det5,r07det6,r07det7,r07mes1,r07mes2,r07mes3,r07mes4,r07mes5,r07mes6,r07mes7,SUM(r07sum1),r07sum2,r07sum3,r07sum4,r07sum5,r07sum6,0,".
"r07rod1,r07rod2,r07rod3,r07rod4,r07rod5,r07rod6,r07rod7,".
"sum(r08),sum(r09),sum(r10),sum(r11),sum(r12a),sum(r12b),sum(r13),".
"2,'',konx1,".
"0,0,0,0,0,0,0,0,0,0,0,0,1,".
"0,0,0,0,0,0,0,0,0,0,0,0,1,".
"podpa,podpn,0,1,0,'$dat_dat', ".
"0,0,0, ". //new2015
"0,0,0, ".  //new2016
"0,0,0,0,0,0,0,0,0, ".  //new2018
"0,0 ".  //new2019
" FROM F$kli_vxcf"."_mzdprcvypl".$kli_uzid.
" GROUP BY oc".
"";
//echo $dsqlt;
$dsql = mysql_query("$dsqlt");
//exit;

$dsqlt = "UPDATE F$kli_vxcf"."_mzdpotvrdenieFO SET m13dh=0 WHERE r13 = 0 AND oc = $cislo_oc ";
$dsql = mysql_query("$dsqlt");
$dsqlt = "UPDATE F$kli_vxcf"."_mzdpotvrdenieFO SET m13pp=0 WHERE r01 = r13 AND oc = $cislo_oc ";
$dsql = mysql_query("$dsqlt");
}
//koniec pracovneho suboru pre potvrdenie

/////////////NACITANIE UDAJOV Z PARAMETROV
$sqldok = mysql_query("SELECT * FROM F$kli_vxcf"."_mzdprm");
  if (@$zaznam=mysql_data_seek($sqldok,0))
  {
  $riaddok=mysql_fetch_object($sqldok);
  $cicz=$riaddok->cicz;
  }

//r10 nie je v 2017
$sqtoz = "UPDATE F$kli_vxcf"."_mzdpotvrdenieFO".
" SET r10=0 WHERE oc = $cislo_oc";
//echo $sqtoz;
$oznac = mysql_query("$sqtoz");

//poistne a prispevky celkom r05
$sqtoz = "UPDATE F$kli_vxcf"."_mzdpotvrdenieFO".
" SET r03a=r09+r03b+r04c  WHERE oc = $cislo_oc";
//echo $sqtoz;
$oznac = mysql_query("$sqtoz");

//ciastkovy zaklad dane r06
$sqtoz = "UPDATE F$kli_vxcf"."_mzdpotvrdenieFO".
" SET r04=r01-r03a  WHERE r01 > 0 AND oc = $cislo_oc";
//echo $sqtoz;
$oznac = mysql_query("$sqtoz");

//vdanovy bonus spolu r11
$sqtoz = "UPDATE F$kli_vxcf"."_mzdpotvrdenieFO".
" SET r08=r07sum1+r07sum2+r07sum3+r07sum4+r07sum5+r07sum6+r07sum7  WHERE oc = $cislo_oc";
//echo $sqtoz;
$oznac = mysql_query("$sqtoz");


?>

<?php
//nacitaj udaje pre upravu
if ( $copern == 20 )
     {
$sqlfir = "SELECT * FROM F$kli_vxcf"."_mzdpotvrdenieFO".
" LEFT JOIN F$kli_vxcf"."_mzdkun".
" ON F$kli_vxcf"."_mzdpotvrdenieFO.oc=F$kli_vxcf"."_mzdkun.oc".
" WHERE F$kli_vxcf"."_mzdpotvrdenieFO.oc = $cislo_oc AND konx = 2 ORDER BY konx,prie,meno";

$fir_vysledok = mysql_query($sqlfir);
$fir_riadok=mysql_fetch_object($fir_vysledok);

$oc = $fir_riadok->oc;
$meno = $fir_riadok->meno;
$prie = $fir_riadok->prie;
$rodne = $fir_riadok->rdc."/".$fir_riadok->rdk;
$dar=SkDatum($fir_riadok->dar);
if ( $rodne == "0/" ) { $rodne="$dar"; }
$ptitl = $fir_riadok->titl;
$uli = $fir_riadok->zuli;
$cdm = $fir_riadok->zcdm;
$psc = $fir_riadok->zpsc;
$mes = $fir_riadok->zmes;
$konx1 = $fir_riadok->konx1;
$obmedz = $fir_riadok->obmedz;
$r01 = $fir_riadok->r01;
$r13 = $fir_riadok->r13;
$r12a = $fir_riadok->r12a;
$r12b = $fir_riadok->r12b;
$r11 = $fir_riadok->r11;
$r11m = $fir_riadok->r11m;
$r02 = $fir_riadok->r02;
$r03a = $fir_riadok->r03a;
$r09 = $fir_riadok->r09;
$r03b = $fir_riadok->r03b;
$r04c = $fir_riadok->r04c;
$r04 = $fir_riadok->r04;
$r05 = $fir_riadok->r05;
$r06sum = $fir_riadok->r06sum;
$r10dds = $fir_riadok->r10dds;
$r07det1 = $fir_riadok->r07det1;
$r07det2 = $fir_riadok->r07det2;
$r07det3 = $fir_riadok->r07det3;
$r07det4 = $fir_riadok->r07det4;
$r07det5 = $fir_riadok->r07det5;
$r07det6 = $fir_riadok->r07det6;
$r07det7 = $fir_riadok->r07det7;
$r07mes1 = $fir_riadok->r07mes1;
$r07mes2 = $fir_riadok->r07mes2;
$r07mes3 = $fir_riadok->r07mes3;
$r07mes4 = $fir_riadok->r07mes4;
$r07mes5 = $fir_riadok->r07mes5;
$r07mes6 = $fir_riadok->r07mes6;
$r07mes7 = $fir_riadok->r07mes7;
$r07sum1 = $fir_riadok->r07sum1;
$r07sum2 = $fir_riadok->r07sum2;
$r07sum3 = $fir_riadok->r07sum3;
$r07sum4 = $fir_riadok->r07sum4;
$r07sum5 = $fir_riadok->r07sum5;
$r07sum6 = $fir_riadok->r07sum6;
$r07sum7 = $fir_riadok->r07sum7;
$r07rod1 = $fir_riadok->r07rod1;
$r07rod2 = $fir_riadok->r07rod2;
$r07rod3 = $fir_riadok->r07rod3;
$r07rod4 = $fir_riadok->r07rod4;
$r07rod5 = $fir_riadok->r07rod5;
$r07rod6 = $fir_riadok->r07rod6;
$r07rod7 = $fir_riadok->r07rod7;
$r08 = $fir_riadok->r08;
$dovca = $fir_riadok->dovca;
$chris = $fir_riadok->chris;
$oslo1 = $fir_riadok->oslo1;
$oslo2 = $fir_riadok->oslo2;

$rekre = $fir_riadok->rekre;

$pmes1 = $fir_riadok->pmes1;
$pmes2 = $fir_riadok->pmes2;
$prie1 = $fir_riadok->prie1;
$prie2 = $fir_riadok->prie2;

$datvsk = SkDatum($fir_riadok->datv);
$pozn = $fir_riadok->pozn;
mysql_free_result($fir_vysledok);
     }
//koniec nacitania

//titulza z udajov o zamestn.
$ztitz=" ";
$sqldok = mysql_query("SELECT * FROM F$kli_vxcf"."_mzdtextmzd WHERE invt = $cislo_oc ");
  if (@$zaznam=mysql_data_seek($sqldok,0))
  {
  $riaddok=mysql_fetch_object($sqldok);
  $ztitz=$riaddok->ztitz;
  }
//stat z udajov o zamestn.
$zstat="Slovensko"; $zstak="703";
$sqldok = mysql_query("SELECT * FROM F".$kli_vxcf."_mzdtextmzd WHERE invt = $cislo_oc ");
  if (@$zaznam=mysql_data_seek($sqldok,0))
  {
  $riaddok=mysql_fetch_object($sqldok);
  $zstat=$riaddok->zstat;
  }
if ( $zstat == '' ) { $zstat="Slovensko"; }


//osobne cislo prepinanie
$novy=0;
if ( $novy == 0 )
{
$prev_oc=$cislo_oc-1;
$next_oc=$cislo_oc+1;
if ( $prev_oc == 0 ) $prev_oc=1;
if ( $next_oc > 9999 ) $next_oc=9999;
$nasieloc=0;
$i=0;
while ( $i <= 9999 AND $nasieloc == 0 )
{
$sqlico = mysql_query("SELECT oc FROM F$kli_vxcf"."_mzdkun WHERE oc=$prev_oc ");
  if (@$zaznam=mysql_data_seek($sqlico,$i))
  {
  $riadico=mysql_fetch_object($sqlico);
  $nasieloc=1;
  }
if ( $nasieloc == 0 ) $prev_oc=$prev_oc-1;
if ( $prev_oc <= 1 ) $nasieloc=1;
}
$i=$i+1;

$maxoc=9999;
$sqldok = mysql_query("SELECT * FROM F$kli_vxcf"."_mzdkun ORDER BY oc DESC LIMIT 1");
  if (@$zaznam=mysql_data_seek($sqldok,0))
  {
  $riaddok=mysql_fetch_object($sqldok);
  $maxoc=1*$riaddok->oc;
  }
if ( $next_oc > $maxoc ) $next_oc=$maxoc;

$nasieloc=0;
$i=0;
while ($i <= 9999 AND $nasieloc == 0 AND $next_oc <= $maxoc )
{
$sqlico = mysql_query("SELECT oc FROM F$kli_vxcf"."_mzdkun WHERE oc=$next_oc ");
  if (@$zaznam=mysql_data_seek($sqlico,$i))
  {
  $riadico=mysql_fetch_object($sqlico);
  $nasieloc=1;
  }
if ( $nasieloc == 0 ) $next_oc=$next_oc+1;
if ( $next_oc >= 9999 ) $nasieloc=1;
}
$i=$i+1;
if ( $prev_oc == 0 ) $prev_oc=1;
if ( $next_oc > 9999 ) $next_oc=9999;
}
?>
<HEAD>
<META http-equiv="Content-Type" content="text/html; charset=cp1250">
 <link rel="stylesheet" href="../css/reset.css">
 <link rel="stylesheet" href="../css/tlaciva.css">
<title>EuroSecom - Potvrdenie o pr�jmoch FO</title>
<style>
div.leg-pozn {
  position: absolute;
  top: 1256px;
  left: 815px;
  font: bold 12px Times new Roman;
}
div.input-echo {
  position: absolute;
  font-size: 18px;
  background-color: #fff;
}
img.form-background_pfo {
  display: block;
  width: 950px;
  height: 1500px;
}


</style>

<script type="text/javascript">
//parameter okna
var param = 'scrollbars=yes,resizable=yes,top=0,left=0,width=1080,height=900';

<?php
//uprava sadzby
  if ( $copern == 20 )
  {
?>
  function ObnovUI()
  {


<?php if ( $strana == 1 ) { ?>
<?php if ( $konx1 == 1 ) { ?> document.formv1.konx1.checked = "checked"; <?php } ?>
<?php if ( $obmedz == 1 ) { ?> document.formv1.obmedz.checked = "checked"; <?php } ?>
   document.formv1.r01.value = '<?php echo "$r01";?>';
   document.formv1.r13.value = '<?php echo "$r13";?>';
   document.formv1.r12a.value = '<?php echo "$r12a";?>';
   document.formv1.r12b.value = '<?php echo "$r12b";?>';
   document.formv1.r11.value = '<?php echo "$r11";?>';
   document.formv1.r11m.value = '<?php echo "$r11m";?>';
   document.formv1.r02.value = '<?php echo "$r02";?>';
//   document.formv1.r03a.value = '<?php echo "$r03a";?>';
   document.formv1.r09.value = '<?php echo "$r09";?>';
   document.formv1.r03b.value = '<?php echo "$r03b";?>';
   document.formv1.r04c.value = '<?php echo "$r04c";?>';
//   document.formv1.r04.value = '<?php echo "$r04";?>';
   document.formv1.r05.value = '<?php echo "$r05";?>';
   document.formv1.r06sum.value = '<?php echo "$r06sum";?>';
//   document.formv1.r10.value = '<?php echo "$r10";?>';
   document.formv1.r10dds.value = '<?php echo "$r10dds";?>';
   document.formv1.r07det1.value = '<?php echo "$r07det1";?>';
   document.formv1.r07det2.value = '<?php echo "$r07det2";?>';
   document.formv1.r07det3.value = '<?php echo "$r07det3";?>';
   document.formv1.r07det4.value = '<?php echo "$r07det4";?>';

   document.formv1.r07mes1.value = '<?php echo "$r07mes1";?>';
   document.formv1.r07mes2.value = '<?php echo "$r07mes2";?>';
   document.formv1.r07mes3.value = '<?php echo "$r07mes3";?>';
   document.formv1.r07mes4.value = '<?php echo "$r07mes4";?>';

   document.formv1.r07sum1.value = '<?php echo "$r07sum1";?>';
   document.formv1.r07sum2.value = '<?php echo "$r07sum2";?>';
   document.formv1.r07sum3.value = '<?php echo "$r07sum3";?>';
   document.formv1.r07sum4.value = '<?php echo "$r07sum4";?>';

   document.formv1.r07rod1.value = '<?php echo "$r07rod1";?>';
   document.formv1.r07rod2.value = '<?php echo "$r07rod2";?>';
   document.formv1.r07rod3.value = '<?php echo "$r07rod3";?>';
   document.formv1.r07rod4.value = '<?php echo "$r07rod4";?>';

//   document.formv1.r08.value = '<?php echo "$r08";?>';
   document.formv1.datv.value = '<?php echo "$datvsk";?>';
   document.formv1.pozn.value = '<?php echo "$pozn";?>';

   document.formv1.dovca.value = '<?php echo "$dovca";?>';
   document.formv1.chris.value = '<?php echo "$chris";?>';
   document.formv1.oslo1.value = '<?php echo "$oslo1";?>';
   document.formv1.oslo2.value = '<?php echo "$oslo2";?>';
   document.formv1.rekre.value = '<?php echo "$rekre";?>';

   document.formv1.prie1.value = '<?php echo "$prie1";?>';
   document.formv1.prie2.value = '<?php echo "$prie2";?>';
   document.formv1.pmes1.value = '<?php echo "$pmes1";?>';
   document.formv1.pmes2.value = '<?php echo "$pmes2";?>';
<?php                     } ?>

<?php if ( $strana == 2 ) { ?>
   document.formv1.r07det5.value = '<?php echo "$r07det5";?>';
   document.formv1.r07det6.value = '<?php echo "$r07det6";?>';
   document.formv1.r07det7.value = '<?php echo "$r07det7";?>';

   document.formv1.r07mes5.value = '<?php echo "$r07mes5";?>';
   document.formv1.r07mes6.value = '<?php echo "$r07mes6";?>';
   document.formv1.r07mes7.value = '<?php echo "$r07mes7";?>';

   document.formv1.r07sum5.value = '<?php echo "$r07sum5";?>';
   document.formv1.r07sum6.value = '<?php echo "$r07sum6";?>';
   document.formv1.r07sum7.value = '<?php echo "$r07sum7";?>';

   document.formv1.r07rod5.value = '<?php echo "$r07rod5";?>';
   document.formv1.r07rod6.value = '<?php echo "$r07rod6";?>';
   document.formv1.r07rod7.value = '<?php echo "$r07rod7";?>';
<?php                     } ?>
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

  function prevOC()
  {
   window.open('potvrd_fo2019.php?copern=20&drupoh=1&page=1&subor=0&cislo_oc=<?php echo $prev_oc;?>', '_self');
  }
  function nextOC()
  {
   window.open('potvrd_fo2019.php?copern=20&drupoh=1&page=1&subor=0&cislo_oc=<?php echo $next_oc;?>', '_self');
  }
  function PoucVyplnenie()
  {
   window.open('<?php echo $jpg_cesta; ?>_poucenie.pdf', '_blank', param);
  }
  function ZnovuPotvrdenie()
  {
   window.open('../mzdy/potvrd_fo2019.php?cislo_oc=<?php echo $cislo_oc;?>&copern=26&drupoh=1&page=1&subor=1',
'_self', 'width=1080, height=900, top=0, left=10, status=yes, resizable=yes, scrollbars=yes');
  }
  function TlacPotvrdPrijFO()
  {
   window.open('../mzdy/potvrd_fo2019.php?cislo_oc=<?php echo $cislo_oc;?>&copern=10&drupoh=1&page=1&subor=0',
'_blank', 'width=1050, height=900, top=0, left=20, status=yes, resizable=yes, scrollbars=yes');
  }
  function UpravZamestnanca()
  {
   window.open('zamestnanci.php?sys=<?php echo $sys; ?>&copern=8&page=1&cislo_oc=<?php echo $cislo_oc;?>&h_oc=<?php echo $cislo_oc;?>',
'_blank','width=1060, height=900, top=0, left=12, status=yes, resizable=yes, scrollbars=yes');
  }

  function editForm(strana)
  {
    window.open('potvrd_fo2019.php?cislo_oc=<?php echo $cislo_oc; ?>&copern=20&strana=' + strana + '&drupoh=1&subor=0', '_self');
  }
  function FormPDF(strana)
  {
    window.open('potvrd_fo2019.php?cislo_oc=<?php echo $cislo_oc; ?>&copern=10&strana=' + strana + '&drupoh=1&subor=0', '_blank', blank_param);
  }

  function DetiZamestnanca()
  {
   window.open('../mzdy/deti.php?copern=1&drupoh=1&page=1&zkun=1&cislo_oc=<?php echo $cislo_oc;?>',
'_blank','width=1060, height=900, top=0, left=12, status=yes, resizable=yes, scrollbars=yes');
  }
  function TlacMzdovyList()
  {
   window.open('../mzdy/mzdevid.php?cislo_oc=<?php echo $cislo_oc;?>&copern=10&drupoh=1&page=1',
'_blank','width=1060, height=900, top=0, left=12, status=yes, resizable=yes, scrollbars=yes');
  }
</script>
</HEAD>
<BODY id="white" onload="ObnovUI();">
<?php
//uprav udaje
if ( $copern == 20 )
{
?>
<div id="wrap-heading">
 <table id="heading">
  <tr>
   <td class="ilogin">EuroSecom</td>
   <td class="ilogin" align="right"><?php echo "<strong>UME</strong> $kli_vume&nbsp;&nbsp;<strong>FIR</strong> $kli_vxcf:$kli_nxcf&nbsp;&nbsp;<strong>login</strong> $kli_uzmeno $kli_uzprie / $kli_uzid ";?></td>
  </tr>
  <tr>
   <td class="header">Potvrdenie o pr�jmoch FO - <span class="subheader"><?php echo "$oc $meno $prie"; ?></span>
<?php if ( $novy == 0 ) { ?>
    <img src='../obr/prev.png' onclick="prevOC();" title="Os.�. <?php echo $prev_oc; ?>" class="navoc-icon">
    <img src='../obr/next.png' onclick="nextOC();" title="Os.�. <?php echo $next_oc; ?>" class="navoc-icon">
<?php                   } ?>
   </td>
   <td>
    <div class="bar-btn-form-tool">
     <img src="../obr/ikony/info_blue_icon.png" onclick="PoucVyplnenie();" title="Pou�enie na vyplnenie" class="btn-form-tool">
     <img src="../obr/ikony/reload_blue_icon.png" onclick="ZnovuPotvrdenie();" title="Znovu na��ta� hodnoty" class="btn-form-tool">
     <img src="../obr/ikony/usertwo_blue_icon.png" onclick="DetiZamestnanca();" title="Deti zamestnanca" class="btn-form-tool">
     <img src="../obr/ikony/list_blue_icon.png" onclick="TlacMzdovyList();" title="Zobrazi� mzdov� list v PDF" class="btn-form-tool">
     <img src="../obr/ikony/printer_blue_icon.png" onclick="TlacPotvrdPrijFO();" title="Zobrazi� v PDF" class="btn-form-tool">
    </div>
   </td>
  </tr>
 </table>
</div>

<div id="content">
<FORM name="formv1" method="post" action="potvrd_fo2019.php?copern=23&cislo_oc=<?php echo $cislo_oc;?>&strana=<?php echo $strana;?>">
<?php
$clas1="noactive"; $clas2="noactive";
if ( $strana == 1 ) $clas1="active"; if ( $strana == 2 ) $clas2="active";
?>
<div class="navbar" >
  <a href="#" onclick="editForm(1);" class="<?php echo $clas1; ?> toleft">1</a>
  <a href="#" onclick="editForm(2);" class="<?php echo $clas2; ?> toleft">2</a>

 <INPUT type="submit" id="uloz" name="uloz" value="Ulo�i� zmeny" class="btn-top-formsave" >
</div>

<?php if ( $strana == 1 ) { ?>

<img src="<?php echo $jpg_cesta; ?>.jpg" alt="<?php echo $jpg_popis; ?> 1.strana" class="form-background_pfo">

<input type="checkbox" name="konx1" value="1" style="top:183px; left:835px;"/>

<div class="input-echo" style="width:91px; top:136px; left:763px; height:23px;"><?php echo $kli_vrok; ?></div>


<!-- I.ZAMESTNANEC -->
<img src="../obr/ikony/pencil_blue_icon.png" onclick="UpravZamestnanca();"
     title="Upravi� �daje o zamestnancovi" class="btn-row-tool"
     style="top:264px; left:380px; width:14px; height:14px;">
<span class="text-echo" style="top:264px; left:122px;"><?php echo $prie; ?></span>
<span class="text-echo" style="top:264px; left:420px;"><?php echo $meno; ?></span>
<span class="text-echo" style="top:264px; left:750px;"><?php echo $rodne; ?></span>

<span class="text-echo" style="top:294px; left:260px;"><?php echo $ptitl; ?></span>
<span class="text-echo" style="top:294px; left:660px;"><?php echo $ztitz; ?></span>

<span class="text-echo" style="top:338px; left:160px;"><?php echo $uli; ?></span>
<span class="text-echo" style="top:338px; left:575px;"><?php echo $cdm; ?></span>
<span class="text-echo" style="top:338px; left:740px;"><?php echo $psc; ?></span>

<span class="text-echo" style="top:358px; left:159px;"><?php echo $mes; ?></span>
<span class="text-echo" style="top:358px; left:535px;"><?php echo $zstat; ?></span>
<input type="checkbox" name="obmedz" value="1" style="top:388px; left:820px;"/>

<!-- PRIJMY -->
<input type="text" name="r01" id="r01" onkeyup="CiarkaNaBodku(this);" style="width:91px; top:463px; left:815px;" title="r01"/>
<input type="text" name="r13" id="r13" onkeyup="CiarkaNaBodku(this);" style="width:91px; top:498px; left:815px; height:18px;" title="r01a"/>
<input type="text" name="r12a" id="r12a" onkeyup="CiarkaNaBodku(this);" style="width:91px; top:519px; left:815px; height:21px;" title="r01b"/>
<input type="text" name="r12b" id="r12b" onkeyup="CiarkaNaBodku(this);" style="width:91px; top:543px; left:815px; height:20px;" title="r01c"/>
<input type="text" name="dovca" id="dovca" onkeyup="CiarkaNaBodku(this);" style="width:91px; top:570px; left:815px; height:21px;" title="r01d"/>
<input type="text" name="chris" id="chris" onkeyup="CiarkaNaBodku(this);" style="width:91px; top:597px; left:815px; height:21px;" title="r01e"/>

<!-- Postne -->
<div class="input-echo" style="width:91px; top:628px; left:815px; height:25px; background-color:#d1d1d1;" title="r02 Vypo��tan� hodnota po ulo�en�"><?php echo $r03a; ?></div>
<input type="text" name="r09" id="r09" onkeyup="CiarkaNaBodku(this);" style="width:91px; top:654px; left:815px; height:18px;" title="r02a"/>
<input type="text" name="r03b" id="r03b" onkeyup="CiarkaNaBodku(this);" style="width:91px; top:678px; left:815px; height:18px;" title="r02b"/>
<input type="text" name="r04c" id="r04c" onkeyup="CiarkaNaBodku(this);" style="width:91px; top:701px; left:815px; height:18px;" title="r02c"/>

<!-- CZD -->
<div class="input-echo" style="width:91px; top:724px; left:815px; height:21px; background-color:#d1d1d1;" title="r03 Vypo��tan� hodnota po ulo�en�"><?php echo $r04; ?></div>

<!-- Uhrn preddavkov -->
<input type="text" name="r05" id="r05" onkeyup="CiarkaNaBodku(this);" style="width:91px; top:746px; left:815px; height:18px;" title="r04"/>



<!-- Ine prijmy -->
<input type="text" name="r11" id="r11" onkeyup="CiarkaNaBodku(this);" style="width:91px; top:769px; left:815px; height:18px;" title="r05"/>
<input type="text" name="r11m" id="r11m" onkeyup="CiarkaNaBodku(this);" style="width:91px; top:791px; left:815px; height:18px;" title="r06"/>
<input type="text" name="oslo1" id="oslo1" onkeyup="CiarkaNaBodku(this);" style="width:91px; top:813px; left:815px; height:18px;" title="r07"/>
<input type="text" name="oslo2" id="oslo2" onkeyup="CiarkaNaBodku(this);" style="width:91px; top:835px; left:815px; height:18px;" title="r08"/>
<input type="text" name="rekre" id="rekre" onkeyup="CiarkaNaBodku(this);" style="width:91px; top:855px; left:815px; height:18px;" title="r09"/>

<!-- NCZD -->
<input type="text" name="r06sum" id="r06sum" onkeyup="CiarkaNaBodku(this);" style="width:91px; top:876px; left:815px; height:18px;" title="r09"/>
<input type="text" name="r10dds" id="r10dds" onkeyup="CiarkaNaBodku(this);" style="width:91px; top:897px; left:815px; height:18px;" title="r10"/>

<!-- zuct v mes. -->
<input type="text" name="r02" id="r02" onkeyup="CiarkaNaBodku(this);" style="width:241px; top:919px; left:655px; height:18px;" title="r11"/>

<!-- 4x new 2018 -->
<input type="text" name="prie1" id="prie1" onkeyup="CiarkaNaBodku(this);" style="width:91px; top:957px; left:237px; height:17px;" title="r12"/>
<input type="text" name="prie2" id="prie2" onkeyup="CiarkaNaBodku(this);" style="width:91px; top:957px; left:700px; height:17px;" title="r12"/>

<input type="text" name="pmes1" id="pmes1" onkeyup="CiarkaNaBodku(this);" style="width:60px; top:978px; left:422px; height:17px;" title="r12"/>
<input type="text" name="pmes2" id="pmes2" onkeyup="CiarkaNaBodku(this);" style="width:60px; top:978px; left:679px; height:17px;" title="r12"/>

<!-- DAN.BONUS -->
<input type="text" name="r07det1" id="r07det1" style="width:409px; top:1054px; left:158px; height:18px;"/>
<input type="text" name="r07rod1" id="r07rod1" style="width:93px; top:1054px; left:577px; height:18px;"/>
<input type="text" name="r07mes1" id="r07mes1" style="width:102px; top:1054px; left:680px; height:18px;"/>
<input type="text" name="r07sum1" id="r07sum1" onkeyup="CiarkaNaBodku(this);" style="width:70px; top:1054px; left:792px; height:18px;"/>

<input type="text" name="r07det2" id="r07det2" style="width:409px; top:1075px; left:158px; height:18px;"/>
<input type="text" name="r07rod2" id="r07rod2" style="width:93px; top:1075px; left:577px; height:18px;"/>
<input type="text" name="r07mes2" id="r07mes2" style="width:102px; top:1075px; left:680px; height:18px;"/>
<input type="text" name="r07sum2" id="r07sum2" onkeyup="CiarkaNaBodku(this);" style="width:70px; top:1075px; left:792px; height:18px;"/>

<input type="text" name="r07det3" id="r07det3" style="width:409px; top:1097px; left:158px; height:18px;"/>
<input type="text" name="r07rod3" id="r07rod3" style="width:93px; top:1097px; left:577px; height:18px;"/>
<input type="text" name="r07mes3" id="r07mes3" style="width:102px; top:1097px; left:680px; height:18px;"/>
<input type="text" name="r07sum3" id="r07sum3" onkeyup="CiarkaNaBodku(this);" style="width:70px; top:1097px; left:792px; height:18px;"/>

<input type="text" name="r07det4" id="r07det4" style="width:409px; top:1118px; left:158px; height:18px;"/>
<input type="text" name="r07rod4" id="r07rod4" style="width:93px; top:1118px; left:577px; height:18px;"/>
<input type="text" name="r07mes4" id="r07mes4" style="width:102px; top:1118px; left:680px; height:18px;"/>
<input type="text" name="r07sum4" id="r07sum4" onkeyup="CiarkaNaBodku(this);" style="width:70px; top:1118px; left:792px; height:18px;"/>

<div class="input-echo" style="width:76px; top:1141px; left:790px; height:20px; background-color:#d1d1d1;" title="r10 Vypo��tan� hodnota po ulo�en�">
<?php echo $r08; ?></div>


<!-- III.ZAMESTNAVATEL -->
<span class="text-echo" style="top:1225px; left:119px;"><?php echo "$zamestnavatel / $fir_fdic"; ?></span>
<span class="text-echo" style="top:1260px; left:119px;"><?php echo $bydliskosidlo; ?></span>

<!-- Kde a dna -->
<span class="text-echo" style="top:1298px; left:119px;"><?php echo $fir_fmes; ?></span>
<input type="text" name="datv" id="datv" onkeyup="CiarkaNaBodku(this);" style="width:100px; top:1286px; left:350px;"/>

<!-- Vypracoval, tel -->
<span class="text-echo" style="top:1330px; left:200px;"><?php echo $fir_mzdt05; ?></span>
<span class="text-echo" style="top:1330px; left:450px;"><?php echo $fir_mzdt04; ?></span>

<!-- Poznamka -->
<span class="text-echo" style="top:1364px; left:119px;">Pozn�mka:</span>
<input type="text" name="pozn" id="pozn" style="width:300px; top:1352px; left:206px;"/>

<?php                     } ?>

<?php if ( $strana == 2 ) { ?>

<img src="<?php echo $jpg_cesta; ?>_str2.jpg" alt="<?php echo $jpg_popis; ?> 1.strana" class="form-background_pfo">

<div class="input-echo" style="width:91px; top:136px; left:763px; height:23px;"><?php echo $kli_vrok; ?></div>

<div class="input-echo" style="width:200px; top:184px; left:600px; height:15px;" >- die�a 5. a� 7.</div>


<!-- DAN.BONUS -->
<input type="text" name="r07det5" id="r07det5" style="width:409px; top:230px; left:158px; height:21px;"/>
<input type="text" name="r07rod5" id="r07rod5" style="width:93px; top:230px; left:577px; height:21px;"/>
<input type="text" name="r07mes5" id="r07mes5" style="width:102px; top:230px; left:680px; height:21px;"/>
<input type="text" name="r07sum5" id="r07sum5" onkeyup="CiarkaNaBodku(this);" style="width:70px; top:230px; left:792px; height:21px;"/>

<input type="text" name="r07det6" id="r07det6" style="width:409px; top:257px; left:158px; height:21px;"/>
<input type="text" name="r07rod6" id="r07rod6" style="width:93px; top:257px; left:577px; height:21px;"/>
<input type="text" name="r07mes6" id="r07mes6" style="width:102px; top:257px; left:680px; height:21px;"/>
<input type="text" name="r07sum6" id="r07sum6" onkeyup="CiarkaNaBodku(this);" style="width:70px; top:257px; left:792px; height:21px;"/>

<input type="text" name="r07det7" id="r07det7" style="width:409px; top:282px; left:158px; height:21px;"/>
<input type="text" name="r07rod7" id="r07rod7" style="width:93px; top:282px; left:577px; height:21px;"/>
<input type="text" name="r07mes7" id="r07mes7" style="width:102px; top:282px; left:680px; height:21px;"/>
<input type="text" name="r07sum7" id="r07sum7" onkeyup="CiarkaNaBodku(this);" style="width:70px; top:282px; left:792px; height:21px;"/>


<!-- Kde a dna -->
<span class="text-echo" style="top:385px; left:119px;"><?php echo $fir_fmes; ?></span>
<span class="text-echo" style="top:385px; left:355px;"><?php echo "$datvsk";?></span>


<!-- Vypracoval, tel -->
<span class="text-echo" style="top:423px; left:200px;"><?php echo $fir_mzdt05; ?></span>
<span class="text-echo" style="top:423px; left:450px;"><?php echo $fir_mzdt04; ?></span>

<?php                     } ?>

<div class="navbar">
  <a href="#" onclick="editForm(1);" class="<?php echo $clas1; ?> toleft">1</a>
  <a href="#" onclick="editForm(2);" class="<?php echo $clas2; ?> toleft">2</a>
  <input type="submit" id="uloz" name="uloz" value="Ulo�i� zmeny" class="btn-bottom-formsave">
</div>
</FORM>
</div> <!-- koniec #content -->
<?php
//mysql_free_result($vysledok);
    }
//koniec uprav udaje
?>

<?php
/////////////////////////////////////////////////VYTLAC POTVRDENIE
if ( $copern == 10 )
{

$hhmmss = Date ("is", MkTime (date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")));

 $outfilexdel="../tmp/potvrdfo_".$kli_uzid."_*.*";
 foreach (glob("$outfilexdel") as $filename) {
    unlink($filename);
 }

$outfilex="../tmp/potvrdfo_".$kli_uzid."_".$hhmmss.".pdf";
if (File_Exists ("$outfilex")) { $soubor = unlink("$outfilex"); }

     define('FPDF_FONTPATH','../fpdf/font/');
     require('../fpdf/fpdf.php');

$sirka_vyska="210,320";
$velkost_strany = explode(",", $sirka_vyska);
$pdf=new FPDF("P","mm", $velkost_strany );
$pdf->Open();
$pdf->AddFont('arial','','arial.php');

//vytlac
$sqltt = "SELECT * FROM F$kli_vxcf"."_mzdpotvrdenieFO".
" LEFT JOIN F$kli_vxcf"."_mzdkun".
" ON F$kli_vxcf"."_mzdpotvrdenieFO.oc=F$kli_vxcf"."_mzdkun.oc".
" WHERE F$kli_vxcf"."_mzdpotvrdenieFO.oc = $cislo_oc AND konx = 2 ORDER BY konx,prie,meno";

$sql = mysql_query("$sqltt");
$pol = mysql_num_rows($sql);

$i=0;
$j=0; //zaciatok strany ak by som chcel strankovat
  while ($i <= $pol )
  {
  if (@$zaznam=mysql_data_seek($sql,$i))
{
$hlavicka=mysql_fetch_object($sql);

$dat_dat = Date ("d.m.Y", MkTime (date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")));

$pdf->AddPage();
$pdf->SetFont('arial','',10);
$pdf->SetLeftMargin(8);
$pdf->SetTopMargin(10);
if ( File_Exists($jpg_cesta.'.jpg') AND $i == 0 )
{
$pdf->Image($jpg_cesta.'.jpg',0,10,210,297);
}
$pdf->SetY(10);

$r01=$hlavicka->r01; // if ( $hlavicka->r01 == 0 ) $r01="";
$r02=$hlavicka->r02;
$r03a=$hlavicka->r03a; // if ( $hlavicka->r03a == 0 ) $r03a="";
$r03b=$hlavicka->r03b; if ( $hlavicka->r03b == 0 ) $r03b="";
$r09=$hlavicka->r09; if ( $hlavicka->r09 == 0 ) $r09="";
$r04=$hlavicka->r04; // if ( $hlavicka->r04 == 0 ) $r04="";
$r04c=$hlavicka->r04c; if ( $hlavicka->r04c == 0 ) $r04c="";
$r05=$hlavicka->r05; if ( $hlavicka->r05 == 0 ) $r05="";
$r06sum=$hlavicka->r06sum; if ( $hlavicka->r06sum == 0 ) $r06sum="";
$r07=$hlavicka->r07; if ( $hlavicka->r07 == 0 ) $r07="";
$r08=$hlavicka->r08; if ( $hlavicka->r08 == 0 ) $r08="";
$r09=$hlavicka->r09; if ( $hlavicka->r09 == 0 ) $r09="";
//$r10=$hlavicka->r10; if ( $hlavicka->r10 == 0 ) $r10="";
$r10dds=$hlavicka->r10dds; if ( $hlavicka->r10dds == 0 ) $r10dds="";
$r11=$hlavicka->r11; if ( $hlavicka->r11 == 0 ) $r11="";
$r11m=$hlavicka->r11m; if ( $hlavicka->r11m == 0 ) $r11m="";
$r12a=$hlavicka->r12a; if ( $hlavicka->r12a == 0 ) $r12a="";
$r12b=$hlavicka->r12b; if ( $hlavicka->r12b == 0 ) $r12b="";
$r13=$hlavicka->r13; if ( $hlavicka->r13 == 0 ) $r13="";
$r07sum1=$hlavicka->r07sum1; if ( $hlavicka->r07sum1 == 0 ) $r07sum1="";
$r07sum2=$hlavicka->r07sum2; if ( $hlavicka->r07sum2 == 0 ) $r07sum2="";
$r07sum3=$hlavicka->r07sum3; if ( $hlavicka->r07sum3 == 0 ) $r07sum3="";
$r07sum4=$hlavicka->r07sum4; if ( $hlavicka->r07sum4 == 0 ) $r07sum4="";
$r07sum5=$hlavicka->r07sum5; if ( $hlavicka->r07sum5 == 0 ) $r07sum5="";
$r07sum6=$hlavicka->r07sum6; if ( $hlavicka->r07sum6 == 0 ) $r07sum6="";
$r07sum7=$hlavicka->r07sum7; if ( $hlavicka->r07sum7 == 0 ) $r07sum7="";


$dovca=$hlavicka->dovca; if ( $hlavicka->dovca == 0 ) $dovca="";
$chris=$hlavicka->chris; if ( $hlavicka->chris == 0 ) $chris="";
$oslo1=$hlavicka->oslo1; if ( $hlavicka->oslo1 == 0 ) $oslo1="";
$oslo2=$hlavicka->oslo2; if ( $hlavicka->oslo2 == 0 ) $oslo2="";
$rekre=$hlavicka->rekre; if ( $hlavicka->rekre == 0 ) $rekre="";

$prie1=$hlavicka->prie1; if ( $hlavicka->prie1 == 0 ) $prie1="";
$prie2=$hlavicka->prie2; if ( $hlavicka->prie2 == 0 ) $prie2="";
$pmes1=$hlavicka->pmes1; if ( $hlavicka->pmes1 == 0 ) $pmes1="";
$pmes2=$hlavicka->pmes2; if ( $hlavicka->pmes2 == 0 ) $pmes2="";

//obdobie
$pdf->Cell(190,13," ","$rmc1",1,"L");
$pdf->Cell(190,9," ","$rmc1",1,"L");
$pdf->Cell(160,6," ","$rmc1",0,"L");$pdf->Cell(10,5,"$kli_vrok","$rmc",1,"L");

//opravne
$pdf->Cell(190,4," ","$rmc1",1,"L");
$text="x"; if ( $hlavicka->konx1 == 0 ) $text=" ";
$pdf->Cell(177,6," ","$rmc1",0,"L");$pdf->Cell(3,4,"$text","$rmc",1,"C");

//I.ZAMESTNANEC
$pdf->Cell(190,11.5," ","$rmc1",1,"L");
$pdf->Cell(18,4," ","$rmc1",0,"L");$pdf->Cell(63,6,"$hlavicka->prie","$rmc",0,"L");
$pdf->Cell(2,4," ","$rmc1",0,"L");$pdf->Cell(38,6,"$hlavicka->meno","$rmc",0,"L");
$dar=SkDatum($hlavicka->dar);
$tlacrd="$hlavicka->rdc / $hlavicka->rdk";
if ( $tlacrd == "0 / " ) { $tlacrd="$dar"; }
$pdf->Cell(35,4," ","$rmc1",0,"L");$pdf->Cell(29,6,"$tlacrd","$rmc",1,"L");
//tituly
$pdf->Cell(190,0.5," ","$rmc1",1,"L");
$pdf->Cell(48,4," ","$rmc1",0,"L");$pdf->Cell(54,5,"$hlavicka->titl","$rmc",0,"L");
$pdf->Cell(33,4," ","$rmc1",0,"L");$pdf->Cell(50,5,"$ztitz","$rmc",1,"L");
//adresa
$pdf->Cell(190,4," ","$rmc1",1,"L");
$pdf->Cell(27,5," ","$rmc1",0,"L");$pdf->Cell(54,4,"$hlavicka->zuli","$rmc",0,"L");
$pdf->Cell(37,5," ","$rmc1",0,"L");$pdf->Cell(24,4,"$hlavicka->zcdm","$rmc",0,"L");
$pdf->Cell(11,5," ","$rmc1",0,"L");$pdf->Cell(32,4,"$hlavicka->zpsc","$rmc",1,"L");
$pdf->Cell(27,5," ","$rmc1",0,"L");$pdf->Cell(75,4,"$hlavicka->zmes","$rmc",0,"L");
$pdf->Cell(8,5," ","$rmc1",0,"L");$pdf->Cell(75,4,"$zstat","$rmc",1,"L");
$pdf->Cell(190,2.5," ","$rmc1",1,"L");
$text="x";
if ( $hlavicka->obmedz == 0 ) $text=" ";
$pdf->Cell(174,6," ","$rmc1",0,"L");$pdf->Cell(4,3,"$text","$rmc",1,"L");

//prijmy
$pdf->Cell(190,14," ","$rmc1",1,"L");
$pdf->Cell(169,25," ","$rmc1",0,"L");$pdf->Cell(16,5,"$r01","$rmc",1,"R");
$pdf->Cell(169,4," ","$rmc1",0,"L");$pdf->Cell(16,4,"$r13","$rmc",1,"R");

$pdf->Cell(169,4," ","$rmc1",0,"L");$pdf->Cell(16,5,"$r12a","$rmc",1,"R");
$pdf->Cell(169,6," ","$rmc1",0,"L");$pdf->Cell(16,5,"$r12b","$rmc",1,"R");
$pdf->Cell(169,5," ","$rmc1",0,"L");$pdf->Cell(16,5,"$dovca","$rmc",1,"R");
$pdf->Cell(169,5," ","$rmc1",0,"L");$pdf->Cell(16,6,"$chris","$rmc",1,"R");

//poistne
$pdf->Cell(169,5," ","$rmc1",0,"L");$pdf->Cell(16,6,"$r03a","$rmc",1,"R");
$pdf->Cell(169,3," ","$rmc1",0,"L");$pdf->Cell(16,4,"$r09","$rmc",1,"R");
$pdf->Cell(169,3," ","$rmc1",0,"L");$pdf->Cell(16,5,"$r03b","$rmc",1,"R");
$pdf->Cell(169,3," ","$rmc1",0,"L");$pdf->Cell(16,5,"$r04c","$rmc",1,"R");
$pdf->Cell(169,3," ","$rmc1",0,"L");$pdf->Cell(16,4,"$r04","$rmc",1,"R");
$pdf->Cell(169,6," ","$rmc1",0,"L");$pdf->Cell(16,4,"$r05","$rmc",1,"R");

//ine prijmy
$pdf->Cell(169,5," ","$rmc1",0,"L");$pdf->Cell(16,5,"$r11","$rmc",1,"R");
$pdf->Cell(169,5," ","$rmc1",0,"L");$pdf->Cell(16,4,"$r11m","$rmc",1,"R");
$pdf->Cell(169,4," ","$rmc1",0,"L");$pdf->Cell(16,4,"$oslo1","$rmc",1,"R");
$pdf->Cell(169,4," ","$rmc1",0,"L");$pdf->Cell(16,4,"$oslo2","$rmc",1,"R");
$pdf->Cell(169,4," ","$rmc1",0,"L");$pdf->Cell(16,4,"$rekre","$rmc",1,"R");

//nczd
$pdf->Cell(169,4," ","$rmc1",0,"L");$pdf->Cell(16,5,"$r06sum","$rmc",1,"R");
$pdf->Cell(169,4," ","$rmc1",0,"L");$pdf->Cell(16,4,"$r10dds","$rmc",1,"R");

//v mesiacoch
$pdf->Cell(169,4," ","$rmc1",0,"L");$pdf->Cell(16,5,"$r02","$rmc",1,"R");


//priemer, poc.mes
$pdf->Cell(169,3," ","$rmc1",1,"L");
$pdf->Cell(55,4," ","$rmc1",0,"L");$pdf->Cell(16,4,"$prie1","$rmc",0,"R");$pdf->Cell(85,4," ","$rmc1",0,"L");$pdf->Cell(16,4,"$prie2","$rmc",1,"R");
$pdf->Cell(86,4," ","$rmc1",0,"L");$pdf->Cell(16,4,"$pmes1","$rmc",0,"R");$pdf->Cell(44,4," ","$rmc1",0,"L");$pdf->Cell(16,4,"$pmes2","$rmc",1,"R");



//dan.bonus
$pdf->SetFont('arial','',9);
$pdf->Cell(190,11," ","$rmc1",1,"L");
$pdf->Cell(27,4," ","$rmc1",0,"L");
$pdf->Cell(93,5,"$hlavicka->r07det1","$rmc",0,"L");$pdf->Cell(22,5,"$hlavicka->r07rod1","$rmc",0,"C");
$pdf->Cell(25,5,"$hlavicka->r07mes1","$rmc",0,"C");$pdf->Cell(18,5,"$r07sum1","$rmc",1,"R");
$pdf->Cell(27,5," ","$rmc1",0,"L");
$pdf->Cell(93,4,"$hlavicka->r07det2","$rmc",0,"L");$pdf->Cell(22,4,"$hlavicka->r07rod2","$rmc",0,"C");
$pdf->Cell(25,4,"$hlavicka->r07mes2","$rmc",0,"C");$pdf->Cell(18,4,"$r07sum2","$rmc",1,"R");
$pdf->Cell(27,4," ","$rmc1",0,"L");
$pdf->Cell(93,4,"$hlavicka->r07det3","$rmc",0,"L");$pdf->Cell(22,4,"$hlavicka->r07rod3","$rmc",0,"C");
$pdf->Cell(25,4,"$hlavicka->r07mes3","$rmc",0,"C");$pdf->Cell(18,4,"$r07sum3","$rmc",1,"R");
$pdf->Cell(27,4," ","$rmc1",0,"L");
$pdf->Cell(93,4,"$hlavicka->r07det4","$rmc",0,"L");$pdf->Cell(22,4,"$hlavicka->r07rod4","$rmc",0,"C");
$pdf->Cell(25,4,"$hlavicka->r07mes4","$rmc",0,"C");$pdf->Cell(18,4,"$r07sum4","$rmc",1,"R");

$pdf->Cell(169,4," ","$rmc1",0,"L");$pdf->Cell(16,4,"$r08","$rmc",1,"R");
$pdf->SetFont('arial','',10);

//III.ZAMESTNAVATEL
$pdf->Cell(190,11," ","$rmc1",1,"L");
$pdf->Cell(19,4," ","$rmc1",0,"L");$pdf->Cell(165,5,"$zamestnavatel / $fir_fdic","$rmc",1,"L");
$pdf->Cell(190,3," ","$rmc1",1,"L");
$pdf->Cell(19,4," ","$rmc1",0,"L");$pdf->Cell(165,5,"$bydliskosidlo","$rmc",1,"L");

//VYPRACOVAL
//V a Dna
$pdf->Cell(190,1," ","$rmc1",1,"L");
$datvsk=SkDatum($hlavicka->datv);
$dat_dat=$datvsk; if ( $dat_dat == '00.00.0000' ) $dat_dat="";
$pdf->Cell(17,5," ","$rmc1",0,"L");$pdf->Cell(45,5,"$fir_fmes","$rmc",0,"L");
$pdf->Cell(7,5," ","$rmc1",0,"L");$pdf->Cell(20,5,"$dat_dat","$rmc",1,"C");
//Osoba, tel.
$pdf->Cell(190,2," ","$rmc1",1,"L");
$pdf->SetFont('arial','',8);
$pdf->Cell(34,5," ","$rmc1",0,"L");$pdf->Cell(32,4,"$fir_mzdt05","$rmc",0,"L");
$pdf->Cell(24,5," ","$rmc1",0,"L");$pdf->Cell(25,4,"$fir_mzdt04","$rmc",1,"L");
$pdf->SetFont('arial','',10);

//poznamka
$pdf->Cell(190,2," ","$rmc1",1,"L");
if ( $copern == 10 ) $pozn=$hlavicka->pozn;
$pdf->Cell(17,5," ","$rmc1",0,"L");$pdf->Cell(170,5,"$pozn","$rmc",1,"L");


if( trim($hlavicka->r07det5) != "" )
      {
$pdf->AddPage();
$pdf->SetFont('arial','',10);
$pdf->SetLeftMargin(8);
$pdf->SetTopMargin(10);
if ( File_Exists($jpg_cesta.'.jpg') AND $i == 0 )
{
$pdf->Image($jpg_cesta.'_str2.jpg',0,10,210,297);
}
$pdf->SetY(10);

//obdobie
$pdf->Cell(190,13," ","$rmc1",1,"L");
$pdf->Cell(190,9," ","$rmc1",1,"L");
$pdf->Cell(160,6," ","$rmc1",0,"L");$pdf->Cell(10,5,"$kli_vrok","$rmc",1,"L");

//dan.bonus
$pdf->SetFont('arial','',9);
$pdf->Cell(190,4," ","$rmc1",1,"L");
$pdf->Cell(125,6," ","$rmc1",0,"L");$pdf->Cell(18,6,"- die�a 5. a� 7.","$rmc",1,"L");
$pdf->Cell(190,3," ","$rmc1",1,"L");

$pdf->Cell(27,5," ","$rmc1",0,"L");
$pdf->Cell(93,5,"$hlavicka->r07det5","$rmc",0,"L");$pdf->Cell(22,5,"$hlavicka->r07rod5","$rmc",0,"C");
$pdf->Cell(25,5,"$hlavicka->r07mes5","$rmc",0,"C");$pdf->Cell(18,5,"$r07sum5","$rmc",1,"R");
$pdf->Cell(27,5," ","$rmc1",0,"L");
$pdf->Cell(93,4,"$hlavicka->r07det6","$rmc",0,"L");$pdf->Cell(22,4,"$hlavicka->r07rod6","$rmc",0,"C");
$pdf->Cell(25,4,"$hlavicka->r07mes6","$rmc",0,"C");$pdf->Cell(18,4,"$r07sum6","$rmc",1,"R");
$pdf->Cell(27,4," ","$rmc1",0,"L");
$pdf->Cell(93,4,"$hlavicka->r07det7","$rmc",0,"L");$pdf->Cell(22,4,"$hlavicka->r07rod7","$rmc",0,"C");
$pdf->Cell(25,4,"$hlavicka->r07mes7","$rmc",0,"C");$pdf->Cell(18,4,"$r07sum7","$rmc",1,"R");
$pdf->Cell(27,4," ","$rmc1",0,"L");

$pdf->SetFont('arial','',10);

//VYPRACOVAL
//V a Dna
$pdf->Cell(190,17.5," ","$rmc1",1,"L");
$datvsk=SkDatum($hlavicka->datv);
$dat_dat=$datvsk; if ( $dat_dat == '00.00.0000' ) $dat_dat="";
$pdf->Cell(17,5," ","$rmc1",0,"L");$pdf->Cell(45,5,"$fir_fmes","$rmc",0,"L");
$pdf->Cell(7,5," ","$rmc1",0,"L");$pdf->Cell(20,5,"$dat_dat","$rmc",1,"C");
//Osoba, tel.
$pdf->Cell(190,3," ","$rmc1",1,"L");
$pdf->SetFont('arial','',8);
$pdf->Cell(35,5," ","$rmc1",0,"L");$pdf->Cell(32,4,"$fir_mzdt05","$rmc",0,"L");
$pdf->Cell(23,5," ","$rmc1",0,"L");$pdf->Cell(25,4,"$fir_mzdt04","$rmc",1,"L");
$pdf->SetFont('arial','',10);

//if( trim($hlavicka->r07det5) != "" )
      }


}
$i = $i + 1;
  }
$pdf->Output("$outfilex");
?>

<script type="text/javascript">
  var okno = window.open("<?php echo $outfilex; ?>","_self");
</script>

<?php
}
/////////////////////////////////////////KONIEC VYTLACENIA POTVRDENIA FO
?>

<?php
$sqlt = 'DROP TABLE F'.$kli_vxcf.'_mzdprcvypl'.$kli_uzid;
$vysledok = mysql_query("$sqlt");
$sqlt = 'DROP TABLE F'.$kli_vxcf.'_mzdprcvyplx'.$kli_uzid;
//$vysledok = mysql_query("$sqlt");
$sqlt = 'DROP TABLE F'.$kli_vxcf.'_mzdprcvyplz'.$kli_uzid;
$vysledok = mysql_query("$sqlt");

//celkovy koniec dokumentu
$cislista = include("mzd_lista_norm.php");
} while (false);
?>
</BODY>
</HTML>