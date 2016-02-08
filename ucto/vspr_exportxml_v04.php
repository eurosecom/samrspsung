<HTML>
<?php
do
{
$sys = 'UCT';
$urov = 1000;
$copern = 1*$_REQUEST['copern'];
$cislo_dok = 1*$_REQUEST['cislo_dok'];

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

$citfir = include("../cis/citaj_fir.php");

//tlacove okno
$tlcuwin="width=700, height=' + vyskawin + ', top=0, left=200, status=yes, resizable=yes, scrollbars=yes, menubar=yes, toolbar=yes";
$tlcswin="width=980, height=' + vyskawin + ', top=0, left=20, status=yes, resizable=yes, scrollbars=yes, menubar=yes, toolbar=yes";
$uliscwin="width=' + sirkawic + ', height=' + vyskawic + ', top=0, left=0, status=yes, resizable=yes, scrollbars=yes, menubar=no, toolbar=no";

$hhmm = Date ("H_i", MkTime (date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")));
$idx=$kli_uzid.$hhmm;

$nazsub="PRIKAZ_".$cislo_dok."_".$idx.".xml";

$copern=10;
$zarchivu=1;
$elsubor=2;

$tabl = "uctpriku";
$uctpol = "uctprikp";

?>

<HEAD>
<META http-equiv="Content-Type" content="text/html; charset=cp1250">
 <link type="text/css" rel="stylesheet" href="../css/styl.css">
<title>Uz�vierka MUJ XML</title>
<style type="text/css">
td.hvstup_zlte  { background-color:#ffff90; color:black; font-weight:bold;
                  height:12px; font-size:12px; }
td.hvstup_tzlte { background-color:#ecaa12; color:black; font-weight:bold;
                  height:12px; font-size:12px; }
td.hvstup_bsede { background-color:#eaeaea; color:black; font-weight:normal;
                  height:12px; font-size:12px; }
td.hvstup_bred { background-color:#ff6c6c; color:black; font-weight:normal;
                  height:12px; font-size:12px; }
</style>

<script type="text/javascript">
//sirka a vyska okna
var sirkawin = screen.width-10;
var vyskawin = screen.height-175;
var vyskawic = screen.height;
var sirkawic = screen.width-10;
</script>
</HEAD>
<BODY class="white">
 <table class="h2" width="100%" >
 <tr>
  <td>EuroSecom  -  Pr�kaz na �hradu �. <?php echo $cislo_dok; ?> - export do XML pain.001.001.04</td>
  <td align="right">
   <span class="login"><?php echo "UME $kli_vume FIR$kli_vxcf-$kli_nxcf  login: $kli_uzmeno $kli_uzprie / $kli_uzid ";?></span>
  </td>
 </tr>
 </table>

<?php
///////////////////////////////////////////////////TLAC a VYTVORENIE XML SUBORU PRE ELEKTRONIKU elsubor=1,2
if ( $copern == 10 AND $elsubor == 2  )
    {

//prva strana
if ( File_Exists("../tmp/$nazsub") ) { $soubor = unlink("../tmp/$nazsub"); }
$soubor = fopen("../tmp/$nazsub", "a+");

//format xml prikazu na uhradu full verzia
$sqlt = <<<mzdprc
(
<?xml version="1.0" encoding="UTF-8"?>
<Document xmlns="urn:iso:std:iso:20022:tech:xsd:pain.001.001.04" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="urn:iso:std:iso:20022:tech:xsd:pain.001.001.04 pain.001.001.04.xsd">
<CstmrCdtTrfInitn>
<GrpHdr>
<MsgId>MEDOSPOL.SR.O./160203/154052</MsgId>
<CreDtTm>2016-02-03T15:40:52</CreDtTm>
<NbOfTxs>1</NbOfTxs>
<CtrlSum>18.58</CtrlSum>
<InitgPty>
<Nm>MEDO spol.s r.o.</Nm>
<PstlAdr>
<Ctry>SK</Ctry>
<AdrLine>Cervenej armady 882</AdrLine>
<AdrLine>Jablonica</AdrLine>
</PstlAdr>
</InitgPty>
</GrpHdr>
<PmtInf>
<PmtInfId>MEDOSPOL.SR.O./160203/154052S00</PmtInfId>
<PmtMtd>TRF</PmtMtd>
<BtchBookg>FALSE</BtchBookg>
<PmtTpInf>
<InstrPrty>NORM</InstrPrty>
<SvcLvl>
<Cd>SEPA</Cd>
</SvcLvl>
<LclInstrm>
<Cd>TRF</Cd>
</LclInstrm>
</PmtTpInf>
<ReqdExctnDt>2016-02-03</ReqdExctnDt>
<Dbtr>
<Nm>MEDO spol.s r.o.</Nm>
<PstlAdr>
<Ctry>SK</Ctry>
<AdrLine>Cervenej armady 882</AdrLine>
<AdrLine>Jablonica</AdrLine>
</PstlAdr>
</Dbtr>
<DbtrAcct>
<Id>
<IBAN>SK3956000000003298707001</IBAN>
</Id>
</DbtrAcct>
<DbtrAgt>
<FinInstnId>
<BICFI>KOMASK2X</BICFI>
</FinInstnId>
</DbtrAgt>
<CdtTrfTxInf>
<PmtId>
<InstrId>MEDOSPOL.SR.O./160203/154052/0001</InstrId>
<EndToEndId>/VS8180/SS70201/KS0558</EndToEndId>
</PmtId>
<Amt>
<InstdAmt Ccy="EUR">18.58</InstdAmt>
</Amt>
<CdtrAgt>
<FinInstnId>
<BICFI>SPSRSKBA</BICFI>
</FinInstnId>
</CdtrAgt>
<Cdtr>
<Nm>Rozhlas a televizia Slovenska</Nm>
<PstlAdr>
<Ctry>SK</Ctry>
<AdrLine>Mlynska dolina</AdrLine>
<AdrLine>Bratislava - Lamac</AdrLine>
</PstlAdr>
</Cdtr>
<CdtrAcct>
<Id>
<IBAN>SK8681800000007000333333</IBAN>
</Id>
</CdtrAcct>
<RmtInf>
<Ustrd>Rozhlas a televizia Slovenska</Ustrd>
</RmtInf>
</CdtTrfTxInf>
</PmtInf>
</CstmrCdtTrfInitn>
</Document>
);
mzdprc;

//prikaz hlavicka
//celkova suma
$celksuma=0;
$sqlts = "SELECT SUM(hodm) AS shod FROM F$kli_vxcf"."_$uctpol WHERE dok = $cislo_dok GROUP BY dok ";
//echo $sqlts;
$sqls = mysql_query("$sqlts");
$hlavickas=mysql_fetch_object($sqls);
$celksuma=$hlavickas->shod;


$sqltt = "SELECT * FROM F$kli_vxcf"."_$tabl".
" LEFT JOIN F$kli_vxcf"."_ico".
" ON F$kli_vxcf"."_$tabl.ico=F$kli_vxcf"."_ico.ico".
" LEFT JOIN klienti".
" ON F$kli_vxcf"."_$tabl.id=klienti.id_klienta".
" LEFT JOIN F$kli_vxcf"."_dban".
" ON F$kli_vxcf"."_$tabl.uce=F$kli_vxcf"."_dban.dban".
" WHERE F$kli_vxcf"."_$tabl.dok = $cislo_dok ";

//echo $sqltt."<br /";
$sql = mysql_query("$sqltt");
$pol = mysql_num_rows($sql);

$i=0;
$j=0; //zaciatok strany ak by som chcel strankovat
  while ($i <= $pol )
  {
  if (@$zaznam=mysql_data_seek($sql,$i))
{
$hlavicka=mysql_fetch_object($sql);

$obdobie=$kli_vmes;
$dat_dat = Date ("d.m.Y", MkTime (date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")));

if ( $j == 0 )
     {

  $text = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>"."\r\n"; fwrite($soubor, $text);
  $text = "<Document xmlns=\"urn:iso:std:iso:20022:tech:xsd:pain.001.001.04\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" ".		
          " xsi:schemaLocation=\"urn:iso:std:iso:20022:tech:xsd:pain.001.001.04 pain.001.001.04.xsd\">"."\r\n"; fwrite($soubor, $text);
  $text = " <CstmrCdtTrfInitn>"."\r\n"; fwrite($soubor, $text);

  $text = " <GrpHdr>"."\r\n"; fwrite($soubor, $text);

$datumuhrady=$hlavicka->dat;
$bankauhrady=$hlavicka->uce;


$priban=""; $prbic=""; $nban=""; $nstat="SK";
$sqlfir = "SELECT * FROM F$kli_vxcf"."_dban WHERE dban = $hlavicka->uce ";
$fir_vysledok = mysql_query($sqlfir);
if( $fir_vysledok ) 
{
$fir_riadok=mysql_fetch_object($fir_vysledok);

$priban = $fir_riadok->iban;
$prbic = $fir_riadok->twib;
$nban = $fir_riadok->nban;
$nstat = trim(substr($priban,0,2));
if( $nstat == '' ) { $nstat="SK"; }
}

$priban=str_replace(" ","",$priban);
$priban=strtoupper($priban);

  $text = "  <MsgId>BAN".$bankauhrady."/DOK".$hlavicka->dok."/CCT001</MsgId>"."\r\n"; fwrite($soubor, $text);

$credtm = Date ("Y-m-d", MkTime (date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")));
$credtm2 = Date ("H:i:s", MkTime (date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")));
$credtm3=$credtm."T".$credtm2;

  $text = "  <CreDtTm>".$credtm3."</CreDtTm>"."\r\n"; fwrite($soubor, $text);

$sqltt2 = "SELECT * FROM F$kli_vxcf"."_$uctpol WHERE F$kli_vxcf"."_$uctpol.dok = $cislo_dok ORDER BY cpl";
$sql2 = mysql_query("$sqltt2");
$pocpol = mysql_num_rows($sql2);


  $text = "  <NbOfTxs>".$pocpol."</NbOfTxs>"."\r\n"; fwrite($soubor, $text);


  $text = "  <CtrlSum>".$celksuma."</CtrlSum>"."\r\n"; fwrite($soubor, $text);


  $text = "  <InitgPty>"."\r\n"; fwrite($soubor, $text);


$hiconm = $fir_fnaz;
$hicoad1 = trim($fir_fuli);
$hicoad2 = trim($fir_fpsc." ".$fir_fmes);

$hiconm = StrTr($hiconm, "�����������������������������ͼ�����������ݎ","aacdeeeilnooorrstuuuyzAACDEEELINOOORRSTUUUYZ");
$hiconm = StrTr($hiconm, "!@#$%^&*()_+=-[[{};:|<>?�\"\'���","                              ");
$hicoad1 = StrTr($hicoad1, "�����������������������������ͼ�����������ݎ","aacdeeeilnooorrstuuuyzAACDEEELINOOORRSTUUUYZ");
$hicoad1 = StrTr($hicoad1, "!@#$%^&*()_+=-[[{};:|<>?�\"\'���","                              ");
$hicoad2 = StrTr($hicoad2, "�����������������������������ͼ�����������ݎ","aacdeeeilnooorrstuuuyzAACDEEELINOOORRSTUUUYZ");
$hicoad2 = StrTr($hicoad2, "!@#$%^&*()_+=-[[{};:|<>?�\"\'���","                              ");

  $text = "  <Nm>".$hiconm."</Nm>"."\r\n"; fwrite($soubor, $text);

  $text = "  <PstlAdr>"."\r\n"; fwrite($soubor, $text);
  $text = "  <Ctry>".$nstat."</Ctry>"."\r\n"; fwrite($soubor, $text);
  $text = "  <AdrLine>".$hicoad1."</AdrLine>"."\r\n"; fwrite($soubor, $text);
  $text = "  <AdrLine>".$hicoad2."</AdrLine>"."\r\n"; fwrite($soubor, $text);
  $text = "  </PstlAdr>"."\r\n"; fwrite($soubor, $text);


  $text = "  </InitgPty>"."\r\n"; fwrite($soubor, $text);


  $text = " </GrpHdr>"."\r\n"; fwrite($soubor, $text);


  $text = " <PmtInf>"."\r\n"; fwrite($soubor, $text);

  $text = "  <PmtInfId>BAN".$bankauhrady."/DOK".$hlavicka->dok."/".$datumuhrady."</PmtInfId>"."\r\n"; fwrite($soubor, $text);
  $text = "  <PmtMtd>TRF</PmtMtd>"."\r\n"; fwrite($soubor, $text);

  $text = "  <BtchBookg>FALSE</BtchBookg>"."\r\n"; fwrite($soubor, $text);

  $text = " <PmtTpInf>"."\r\n"; fwrite($soubor, $text);

  $text = "  <InstrPrty>NORM</InstrPrty>"."\r\n"; fwrite($soubor, $text);

  $text = " <SvcLvl>"."\r\n"; fwrite($soubor, $text);
  $text = "  <Cd>SEPA</Cd>"."\r\n"; fwrite($soubor, $text);
  $text = " </SvcLvl>"."\r\n"; fwrite($soubor, $text);

  $text = " <LclInstrm>"."\r\n"; fwrite($soubor, $text);
  $text = "  <Cd>TRF</Cd>"."\r\n"; fwrite($soubor, $text);
  $text = " </LclInstrm>"."\r\n"; fwrite($soubor, $text);

  $text = " </PmtTpInf>"."\r\n"; fwrite($soubor, $text);

  $text = "  <ReqdExctnDt>".$hlavicka->dat."</ReqdExctnDt>"."\r\n"; fwrite($soubor, $text);

  $text = " <Dbtr>"."\r\n"; fwrite($soubor, $text);
  $text = "  <Nm>".$hiconm."</Nm>"."\r\n"; fwrite($soubor, $text);
  $text = "  <PstlAdr>"."\r\n"; fwrite($soubor, $text);
  $text = "  <Ctry>".$nstat."</Ctry>"."\r\n"; fwrite($soubor, $text);
  $text = "  <AdrLine>".$hicoad1."</AdrLine>"."\r\n"; fwrite($soubor, $text);
  $text = "  <AdrLine>".$hicoad2."</AdrLine>"."\r\n"; fwrite($soubor, $text);
  $text = "  </PstlAdr>"."\r\n"; fwrite($soubor, $text);
  $text = " </Dbtr>"."\r\n"; fwrite($soubor, $text);

  $text = " <DbtrAcct>"."\r\n"; fwrite($soubor, $text);
  $text = "  <Id>"."\r\n"; fwrite($soubor, $text);
  $text = "  <IBAN>".$priban."</IBAN>"."\r\n"; fwrite($soubor, $text);
  $text = "  </Id>"."\r\n"; fwrite($soubor, $text);
  $text = "  <Ccy>EUR</Ccy>"."\r\n"; fwrite($soubor, $text);
  $text = " </DbtrAcct>"."\r\n"; fwrite($soubor, $text);


  $text = " <DbtrAgt>"."\r\n"; fwrite($soubor, $text);
  $text = " <FinInstnId>"."\r\n"; fwrite($soubor, $text);
  $text = "  <BICFI>".$prbic."</BICFI>"."\r\n"; fwrite($soubor, $text);

$bname = iconv("CP1250", "UTF-8", $nban);

  $text = "  <Nm>".$bname."</Nm>"."\r\n"; fwrite($soubor, $text);
  $text = " </FinInstnId>"."\r\n"; fwrite($soubor, $text);
  $text = " </DbtrAgt>"."\r\n"; fwrite($soubor, $text);


     }

}
$i = $i + 1;
$j = $j + 1;
  }
//koniec prikaz hlavicka

//prikaz riadky

$sqltt = "SELECT * FROM F$kli_vxcf"."_$uctpol".
" WHERE F$kli_vxcf"."_$uctpol.dok = $cislo_dok ".
" ORDER BY cpl";

//echo $sqltt."<br /";
$sql = mysql_query("$sqltt");
$pol = mysql_num_rows($sql);

$i=0;
$j=0; //zaciatok strany ak by som chcel strankovat
  while ($i <= $pol )
  {
  if (@$zaznam=mysql_data_seek($sql,$i))
{
$hlavickav=mysql_fetch_object($sql);



  $text = " <CdtTrfTxInf>"."\r\n"; fwrite($soubor, $text);

  $text = "  <PmtId>"."\r\n"; fwrite($soubor, $text);

$instrid="BAN".$bankauhrady."/DOK".$hlavickav->dok."/".$datumuhrady;

  $text = "   <InstrId>".$instrid."</InstrId>"."\r\n"; fwrite($soubor, $text);

$endtoendid="/VS".$hlavickav->vsy."/SS".$hlavickav->ssy."/KS".$hlavickav->ksy."";

  $text = "   <EndToEndId>".$endtoendid."</EndToEndId>"."\r\n"; fwrite($soubor, $text);

  $text = "  </PmtId>"."\r\n"; fwrite($soubor, $text);

  $text = "  <Amt>"."\r\n"; fwrite($soubor, $text);

$instdamt=$hlavickav->hodp;

  $text = "   <InstdAmt Ccy=\"EUR\">".$instdamt."</InstdAmt>"."\r\n"; fwrite($soubor, $text);

  $text = "  </Amt>"."\r\n"; fwrite($soubor, $text);


  $text = " <CdtrAgt>"."\r\n"; fwrite($soubor, $text);
  $text = " <FinInstnId>"."\r\n"; fwrite($soubor, $text);
  $text = "  <BICFI>".$hlavickav->pbic."</BICFI>"."\r\n"; fwrite($soubor, $text);
  $text = " </FinInstnId>"."\r\n"; fwrite($soubor, $text);
  $text = " </CdtrAgt>"."\r\n"; fwrite($soubor, $text);



$iconm=""; $icoad1=""; $icoad2=""; $polico=0; $polico1=0; $polico2=0;
$sqlfir = "SELECT * FROM F$kli_vxcf"."_ico WHERE ico = $hlavickav->ico ";
$fir_vysledok = mysql_query($sqlfir);
$polico = 1*mysql_num_rows($fir_vysledok);
if( $polico > 0 ) 
  {
if( $fir_vysledok ) 
{
$fir_riadok=mysql_fetch_object($fir_vysledok);

$iconm = $fir_riadok->nai;
$icoad1 = trim($fir_riadok->uli);
$icoad2 = trim($fir_riadok->psc." ".$fir_riadok->mes);
}
  }

if( $polico == 0 ) 
  {
$sqlfir1 = "SELECT * FROM F$kli_vxcf"."_ico WHERE ib1 LIKE '%".$hlavickav->iban."%' ";
$fir_vysledok1 = mysql_query($sqlfir1);
$polico1 = 1*mysql_num_rows($fir_vysledok1);
if( $fir_vysledok1 ) 
{
$fir_riadok1=mysql_fetch_object($fir_vysledok1);

$iconm = $fir_riadok1->nai;
$icoad1 = trim($fir_riadok1->uli);
$icoad2 = trim($fir_riadok1->psc." ".$fir_riadok1->mes);
}
  }

if( $polico > 0 ) { $polico1=1; $polico2=1; }

if( $polico1 == 0 ) 
  {
$sqlfir2 = "SELECT * FROM F$kli_vxcf"."_ico WHERE ib2 LIKE '%".$hlavickav->iban."%' ";
$fir_vysledok2 = mysql_query($sqlfir2);
$polico2 = 1*mysql_num_rows($fir_vysledok2);
if( $fir_vysledok2 ) 
{
$fir_riadok2=mysql_fetch_object($fir_vysledok2);

$iconm = $fir_riadok2->nai;
$icoad1 = trim($fir_riadok2->uli);
$icoad2 = trim($fir_riadok2->psc." ".$fir_riadok2->mes);
}
  }

if( $polico1 > 0 ) { $polico2=1; }

if( $polico2 == 0 ) 
  {
$sqlfir3 = "SELECT * FROM F$kli_vxcf"."_ico WHERE ib3 LIKE '%".$hlavickav->iban."%' ";
$fir_vysledok3 = mysql_query($sqlfir3);
$polico3 = 1*mysql_num_rows($fir_vysledok3);
if( $fir_vysledok3 ) 
{
$fir_riadok3=mysql_fetch_object($fir_vysledok3);

$iconm = $fir_riadok3->nai;
$icoad1 = trim($fir_riadok3->uli);
$icoad2 = trim($fir_riadok3->psc." ".$fir_riadok3->mes);
}
  }

$iconm = StrTr($iconm, "�����������������������������ͼ�����������ݎ","aacdeeeilnooorrstuuuyzAACDEEELINOOORRSTUUUYZ");
$iconm = StrTr($iconm, "!@#$%^&*()_+=-[[{};:|<>?�\"\'���","                              ");
$icoad1 = StrTr($icoad1, "�����������������������������ͼ�����������ݎ","aacdeeeilnooorrstuuuyzAACDEEELINOOORRSTUUUYZ");
$icoad2 = StrTr($icoad2, "�����������������������������ͼ�����������ݎ","aacdeeeilnooorrstuuuyzAACDEEELINOOORRSTUUUYZ");
$icoad1 = StrTr($icoad1, "!@#$%^&*()_+=-[[{};:|<>?�\"\'���","                              ");
$icoad2 = StrTr($icoad2, "!@#$%^&*()_+=-[[{};:|<>?�\"\'���","                              ");

if( $iconm == '' ) { $iconm="Prijemca Nazov"; }
if( $icoad1 == '' ) { $icoad1="Ulica"; }
if( $icoad2 == '' ) { $icoad2="Mesto"; }


$pstat = trim(substr($hlavickav->iban,0,2));
if( $pstat == '' ) { $pstat="SK"; }

  $text = " <Cdtr>"."\r\n"; fwrite($soubor, $text);
  $text = " <Nm>".$iconm."</Nm>"."\r\n"; fwrite($soubor, $text);
  $text = " <PstlAdr>"."\r\n"; fwrite($soubor, $text);
  $text = "  <Ctry>".$pstat."</Ctry>"."\r\n"; fwrite($soubor, $text);
  $text = "  <AdrLine>".$icoad1."</AdrLine>"."\r\n"; fwrite($soubor, $text);
  $text = "  <AdrLine>".$icoad2."</AdrLine>"."\r\n"; fwrite($soubor, $text);
  $text = " </PstlAdr>"."\r\n"; fwrite($soubor, $text);
  $text = " </Cdtr>"."\r\n"; fwrite($soubor, $text);

  $text = " <CdtrAcct>"."\r\n"; fwrite($soubor, $text);
  $text = "  <Id>"."\r\n"; fwrite($soubor, $text);

$ibanxx=str_replace(" ","",$hlavickav->iban);
$ibanxx=strtoupper($ibanxx);

  $text = "  <IBAN>".$ibanxx."</IBAN>"."\r\n"; fwrite($soubor, $text);
  $text = "  </Id>"."\r\n"; fwrite($soubor, $text);
  $text = " </CdtrAcct>"."\r\n"; fwrite($soubor, $text);

$ustrdxx=trim($hlavickav->twib);
$ustrdxx = StrTr($ustrdxx, "�����������������������������ͼ�����������ݎ","aacdeeeilnooorrstuuuyzAACDEEELINOOORRSTUUUYZ");
$ustrdxx = StrTr($ustrdxx, "!@#$%^&*()_+=-[[{};:|<>?�\"\'���","                              ");
if( $ustrdxx == '' ) { $ustrdxx="info"; }

  $text = " <RmtInf>"."\r\n"; fwrite($soubor, $text);
  $text = "  <Ustrd>".$ustrdxx."</Ustrd>"."\r\n"; fwrite($soubor, $text);
  $text = " </RmtInf>"."\r\n"; fwrite($soubor, $text);


  $text = " </CdtTrfTxInf>"."\r\n"; fwrite($soubor, $text);

}
$i = $i + 1;
$j = $j + 1;
  }
//koniec prikaz riadky


  $text = " </PmtInf>"."\r\n"; fwrite($soubor, $text);
  $text = " </CstmrCdtTrfInitn>"."\r\n"; fwrite($soubor, $text);
  $text = " </Document>"."\r\n"; fwrite($soubor, $text);

fclose($soubor);
?>

<?php
if ( $elsubor == 2 )
{
?>
<br />
<br />
Stiahnite si ni��ie uveden� s�bor XML na V� lok�lny disk a na��tajte do InternetBankingu :
<br />
<br />
<a href="../tmp/<?php echo $nazsub; ?>">../tmp/<?php echo $nazsub; ?></a>
<br />
<br />
<?php
}
?>


<?php
//mysql_free_result($vysledok);
    }
/////////////////////////////////////////////////////koniec TLAC a VYTVORENIE XML SUBORU PRE ELEKTRONIKU


$sqlt = 'DROP TABLE F'.$kli_vxcf.'_prcprizdphsx'.$kli_uzid;
$vysledok = mysql_query("$sqlt");

//celkovy koniec dokumentu
} while (false);
?>
</BODY>
</HTML>