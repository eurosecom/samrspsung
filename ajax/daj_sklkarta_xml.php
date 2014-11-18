<?php
$sys = 'SKL';
$urov = 1;
$uziv = include("../uziv.php");
if( !$uziv ) exit;

//vytvorenie skladovej karty pre vybranu polozku
// set the output content type as xml
header('Content-Type: text/xml; Accept-Charset: utf-8; ');
//header('Content-Type: text/xml ');
// create the new XML document
$dom = new DOMDocument();

// create the root <response> element
$response = $dom->createElement('response');
$dom->appendChild($response);

// create the <vety> element and append it as a child of <response>
$vety = $dom->createElement('vety');
$response->appendChild($vety);


require_once("../pswd/password.php");
@$spojeni = mysql_connect($mysqlhost, $mysqluser, $mysqlpasswd);
  if (!$spojeni):
    echo "Spojenie so serverom nedostupne.";
    exit;
  endif;
  mysql_select_db($mysqldb);

//datumove funkcie
$sDat = include("../funkcie/dat_sk_us.php");

$prm1 = $_GET['prm1'];
$prm2 = $_GET['prm2'];
$prm3 = $_GET['prm3'];
$prm4 = $_GET['prm4'];
$cprm1 = 1*$prm1;
$cprm3 = 1*$prm3;
$prm2BD = StrTr($prm2, "�����������������������������ͼ�����������ݎ",
"aacdeeeilnooorrstuuuyzAACDEEELINOOORRSTUUUYZ");

$podmskl = "skl > 0";
if( $cprm3 > 0 ) $podmskl = "skl = ".$cprm3;

$h_min = 1*$_GET['h_min'];
$databaza="";
if( $h_min == 1 )
{
$citfir = include("../cis/citaj_fir.php");
$kli_vxcf=$fir_allx11;

$dtbzx = include("../cis/oddel_dtbz1.php");

}


$sqltt = "SELECT drp, skl, dat, dok, poh, mno, prj, vdj, ".$databaza."F$kli_vxcf"."_sklprckar".$kli_uzid.".cis, nat, natBD, ".$databaza."F$kli_vxcf"."_sklprckar".$kli_uzid.".cen,".
" mer, zas, ".$databaza."F$kli_vxcf"."_sklprckar".$kli_uzid.".ico, nai".
" FROM ".$databaza."F$kli_vxcf"."_sklprckar".$kli_uzid.
" LEFT JOIN ".$databaza."F$kli_vxcf"."_sklcis".
" ON ".$databaza."F$kli_vxcf"."_sklprckar".$kli_uzid.".cis=".$databaza."F$kli_vxcf"."_sklcis.cis".
" LEFT JOIN ".$databaza."F$kli_vxcf"."_ico".
" ON ".$databaza."F$kli_vxcf"."_sklprckar".$kli_uzid.".ico=".$databaza."F$kli_vxcf"."_ico.ico".
" WHERE ".$databaza."F$kli_vxcf"."_sklprckar".$kli_uzid.".cis = $cprm1 AND $podmskl ORDER BY dat,dok,poh";
//echo $sqltt;
$sql = mysql_query("$sqltt");

$zostatok=0;

$cpol = mysql_num_rows($sql);
$i=0;
   while ($i <= $cpol )
   {
  if (@$zaznam=mysql_data_seek($sql,$i))
  {
$riadok=mysql_fetch_object($sql);

//odstrani diakritiku
$diak=1;
if( $diak == 0 ) 
{ 
$txp01 = StrTr($riadok->ico, "�����������������������������ͼ�����������ݎ",
"aacdeeeilnooorrstuuuyzAACDEEELINOOORRSTUUUYZ");
$txp02 = StrTr($riadok->nai, "�����������������������������ͼ�����������ݎ",
"aacdeeeilnooorrstuuuyzAACDEEELINOOORRSTUUUYZ"); 
$txp03 = StrTr($riadok->mes, "�����������������������������ͼ�����������ݎ",
"aacdeeeilnooorrstuuuyzAACDEEELINOOORRSTUUUYZ"); 
$txp04 = StrTr($riadok->uc1, "�����������������������������ͼ�����������ݎ",
"aacdeeeilnooorrstuuuyzAACDEEELINOOORRSTUUUYZ"); 
$txp05 = StrTr($riadok->nm1, "�����������������������������ͼ�����������ݎ",
"aacdeeeilnooorrstuuuyzAACDEEELINOOORRSTUUUYZ"); 
$txp06 = StrTr($riadok->dns, "�����������������������������ͼ�����������ݎ",
"aacdeeeilnooorrstuuuyzAACDEEELINOOORRSTUUUYZ"); 
}


$dat_sk=SkDatum($riadok->dat);

//s diakritikou prevod do utf-8
if( $diak == 1 ) 
{ 
$zasoba=$riadok->zas;
//$zasoba=8;
$Cislo=$zasoba+"";
$zasoba3=sprintf("%0.3f", $Cislo);

$txp01 = $retezec = iconv("CP1250", "UTF-8", $dat_sk); 
$txp02 = $retezec = iconv("CP1250", "UTF-8", $riadok->dok); 
$txp03 = $retezec = iconv("CP1250", "UTF-8", $riadok->poh); 
$txp04 = $retezec = iconv("CP1250", "UTF-8", $riadok->cen); 
$txp05 = $retezec = iconv("CP1250", "UTF-8", $riadok->prj); 
$txp06 = $retezec = iconv("CP1250", "UTF-8", $riadok->vdj); 
$txp07 = $retezec = iconv("CP1250", "UTF-8", $zasoba3);
$txp08 = $retezec = iconv("CP1250", "UTF-8", $riadok->skl);
$txp09 = $retezec = iconv("CP1250", "UTF-8", $riadok->mno);
$txp10 = $retezec = iconv("CP1250", "UTF-8", $riadok->drp);
$txp11 = $retezec = iconv("CP1250", "UTF-8", $riadok->nai);
}

$zostatok=$zostatok+$riadok->zas;
$Cislo=$zostatok+"";
$zostatok3=sprintf("%0.3f", $Cislo);

if( $txp01 == '' ) $txp01='0';
if( $txp02 == '' ) $txp02='0';
if( $txp03 == '' ) $txp03='0';
if( $txp04 == '' ) $txp04='0';
if( $txp05 == '' ) $txp05='0';
if( $txp05 == 0 ) $txp05='-';
if( $txp06 == '' ) $txp06='0';
if( $txp06 == 0 ) $txp06='-';
if( $txp07 == '' ) $txp07='0';
if( $txp08 == '' ) $txp08='0';
if( $txp09 == '' ) $txp09='0';
if( $txp10 == '' ) $txp10='0';
if( $txp11 == '' ) $txp11='0';

// create the title element for the veta
$pol01 = $dom->createElement('pol01');
$pol01Text = $dom->createTextNode($txp01);
$pol01->appendChild($pol01Text);

// create the pol02 element for the veta
$pol02 = $dom->createElement('pol02');
$pol02Text = $dom->createTextNode($txp02);
$pol02->appendChild($pol02Text);

// create the pol03 element for the veta
$pol03 = $dom->createElement('pol03');
$pol03Text = $dom->createTextNode($txp03);
$pol03->appendChild($pol03Text);

// create the pol04 element for the veta
$pol04 = $dom->createElement('pol04');
$pol04Text = $dom->createTextNode($txp04);
$pol04->appendChild($pol04Text);
 
// create the pol05 element for the veta
$pol05 = $dom->createElement('pol05');
$pol05Text = $dom->createTextNode($txp05);
$pol05->appendChild($pol05Text);

// create the pol06 element for the veta
$pol06 = $dom->createElement('pol06');
$pol06Text = $dom->createTextNode($txp06);
$pol06->appendChild($pol06Text);

// create the pol07 element for the veta
$pol07 = $dom->createElement('pol07');
$pol07Text = $dom->createTextNode($zostatok3);
$pol07->appendChild($pol07Text);

// create the pol08 element for the veta
$pol08 = $dom->createElement('pol08');
$pol08Text = $dom->createTextNode($txp08);
$pol08->appendChild($pol08Text);

// create the pol09 element for the veta
$pol09 = $dom->createElement('pol09');
$pol09Text = $dom->createTextNode($txp09);
$pol09->appendChild($pol09Text);

// create the pol10 element for the veta
$pol10 = $dom->createElement('pol10');
$pol10Text = $dom->createTextNode($txp10);
$pol10->appendChild($pol10Text);

// create the pol11 element for the veta
$pol11 = $dom->createElement('pol11');
$pol11Text = $dom->createTextNode($txp11);
$pol11->appendChild($pol11Text);

// create the <veta> element 
$veta = $dom->createElement('veta');
$veta->appendChild($pol01);
$veta->appendChild($pol02);
$veta->appendChild($pol03);
$veta->appendChild($pol04);
$veta->appendChild($pol05);
$veta->appendChild($pol06);
$veta->appendChild($pol07);
$veta->appendChild($pol08);
$veta->appendChild($pol09);
$veta->appendChild($pol10);
$veta->appendChild($pol11);

// append <veta> as a child of <vety>
$vety->appendChild($veta);

  }
$i = $i + 1;
   }


//uloz xml strukturu
// build the XML structure in a string variable
$dom->encoding = 'utf-8';
$xmlString = $dom->saveXML();
// output the XML string
echo $xmlString;

// vystup textoveho retazca
//echo $xmlString;
//print $xmlString;

// konfigurace pro ulo�en�
//$dom->formatOutput = TRUE;
//$dom->encoding = 'utf-8';
//$dom->save('../tmp/sklkarta.xml');
?>
