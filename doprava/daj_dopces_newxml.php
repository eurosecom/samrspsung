<?php
$sys = 'DOP';
$urov = 100;
$uziv = include("../uziv.php");
if( !$uziv ) exit;


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

$prm1 = $_GET['prm1'];
$prm2 = 1*$_GET['prm2'];
$polozka = 1*$_GET['polozka'];

//prm2 1-po enter,2-klik na ikonku

if( $prm2 == 2 )
{ 
$sqltt = "SELECT * FROM F$kli_vxcf"."_dopslcesty WHERE cpl > 0 ORDER BY msta,mstb";
$sql = mysql_query("$sqltt");
}


if( $prm2 == 1 AND $prm1 != '' )
{ 
$sqltt = "SELECT * FROM F$kli_vxcf"."_dopslcesty WHERE mstb LIKE '%$prm1%' ORDER BY mstb";
$sql = mysql_query("$sqltt");
}


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

//s diakritikou prevod do utf-8
if( $diak == 1 ) 
{ 
$txp01 = $retezec = iconv("CP1250", "UTF-8", $riadok->msta); 
$txp02 = $retezec = iconv("CP1250", "UTF-8", $riadok->mstb); 
$txp03 = $retezec = iconv("CP1250", "UTF-8", $riadok->kma); 
$txp04 = $retezec = iconv("CP1250", "UTF-8", $riadok->kmb); 
$txp05 = $retezec = iconv("CP1250", "UTF-8", $riadok->cpl); 
$txp06 = $retezec = iconv("CP1250", "UTF-8", $polozka); 
}

if( $txp01 == '' ) $txp01='--';
if( $txp02 == '' ) $txp02='--';
$txp02 = AddSlashes($txp02);
if( $txp03 == '' ) $txp03='--';
if( $txp04 == '' ) $txp04='--';
if( $txp05 == '' ) $txp05='--';
if( $txp06 == '' ) $txp06='0';

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
$pol07Text = $dom->createTextNode($cpol);
$pol07->appendChild($pol07Text);

// create the <veta> element 
$veta = $dom->createElement('veta');
$veta->appendChild($pol01);
$veta->appendChild($pol02);
$veta->appendChild($pol03);
$veta->appendChild($pol04);
$veta->appendChild($pol05);
$veta->appendChild($pol06);
$veta->appendChild($pol07);

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
//$dom->save('../tmp/cesty.xml');
?>
