// holds an instance of XMLHttpRequest
var xmlHttp = createXmlHttpRequestObject();

// creates an XMLHttpRequest instance
function createXmlHttpRequestObject() 
{
  // will store the reference to the XMLHttpRequest object
  var xmlHttp;
  // this should work for all browsers except IE6 and older
  try
  {
    // try to create XMLHttpRequest object
    xmlHttp = new XMLHttpRequest();
  }
  catch(e)
  {
    // assume IE6 or older
    var XmlHttpVersions = new Array("MSXML2.XMLHTTP.6.0",
                                    "MSXML2.XMLHTTP.5.0",
                                    "MSXML2.XMLHTTP.4.0",
                                    "MSXML2.XMLHTTP.3.0",
                                    "MSXML2.XMLHTTP",
                                    "Microsoft.XMLHTTP");
    // try every prog id until one works
 
    for (var i=0; i<XmlHttpVersions.length && !xmlHttp; i++) 
    {
      try 
      { 
        // try to create XMLHttpRequest object
        xmlHttp = new ActiveXObject(XmlHttpVersions[i]);
      } 
      catch (e) {}
    }
  }
  // return the created object or display an error message
  if (!xmlHttp)
    alert("Error creating the XMLHttpRequest object.");
  else 
    return xmlHttp;
}

// read a file from the server
function volajAutoUCT(odkial,drupoh,pohyb)
{
  // only continue if xmlHttp isn't void
  if (xmlHttp)
  {
    // try to connect to the server
    try
    {

//    nastav hodiny
      bodywhite = document.getElementById("white");
      bodywhite.style.cursor = "wait";

      var h_odkial = odkial; 


//    odkial=9 z jednoducheho hlavicka dokladov
      if( h_odkial == 9 )
      {
      var h_drupoh = drupoh; 
      var h_pohyb = pohyb;
      var h_uce = document.forms.fhlv1.h_uce.value; 
      var h_dok = document.forms.fhlv1.h_dok.value; 
      var h_ico = document.forms.fhlv1.h_ico.value; 
      var h_dat = document.forms.fhlv1.h_dat.value; 
      var h_zk0 = document.forms.fhlv1.h_zk0.value; 
      var h_zk1 = document.forms.fhlv1.h_zk1.value; 
      var h_zk2 = document.forms.fhlv1.h_zk2.value; 
      var h_dn1 = document.forms.fhlv1.h_dn1.value; 
      var h_dn2 = document.forms.fhlv1.h_dn2.value; 
      var h_txp = document.forms.fhlv1.h_txp.value; 
      var h_txz = document.forms.fhlv1.h_txz.value;
      var h_kto = document.forms.fhlv1.h_kto.value;
      var h_poz = document.forms.fhlv1.h_poz.value;
      var h_unk = document.forms.fhlv1.h_unk.value;
      var pau80 = 0;
      if( document.fhlv1.pau80.checked ) { pau80=1; }

      // create the params string
      var params = "h_drupoh=" + h_drupoh + "&h_pohyb=" + h_pohyb + "&h_odkial=" + h_odkial + "&h_dok=" + h_dok + "&h_ico=" + h_ico;
          params += "&h_dat=" + h_dat + "&h_zk0=" + h_zk0 + "&h_zk1=" + h_zk1;
          params += "&h_zk2=" + h_zk2 + "&h_dn1=" + h_dn1 + "&h_dn2=" + h_dn2 + "&pau80=" + pau80; 
          params += "&h_uce=" + h_uce + "&h_txp=" + h_txp + "&h_txz=" + h_txz + "&h_poz=" + h_poz + "&h_kto=" + h_kto + "&h_unk=" + h_unk;

      // initiate reading a file from the server
      xmlHttp.open("GET", "robot_ju.php?" + params, true);
      }

//    odkial=19 z jednoducheho polozky dokladov
      if( h_odkial == 19 )
      {
      var h_drupoh = drupoh; 
      var h_pohyb = pohyb;
      var h_uce = document.forms.forms1.h_uce.value; 
      var h_dok = document.forms.forms1.h_dok.value; 
      var h_fak = document.forms.forms1.h_fak.value; 
      var h_ico = document.forms.forms1.h_ico.value; 
      var h_hod = document.forms.forms1.h_hop.value; 
      var h_hdx = document.forms.forma4.h_hdx.value; 

      // create the params string
      var params = "h_drupoh=" + h_drupoh + "&h_pohyb=" + h_pohyb + "&h_odkial=" + h_odkial + "&h_dok=" + h_dok;
          params += "&h_uce=" + h_uce + "&h_fak=" + h_fak + "&h_ico=" + h_ico + "&h_hod=" + h_hod + "&h_hdx=" + h_hdx;

      // initiate reading a file from the server
      xmlHttp.open("GET", "robot_ju.php?" + params, true);
      }


//    odkial=0 z podvojneho hlavicka dokladov
      if( h_odkial == 0 )
      {
      var h_drupoh = drupoh; 
      var h_pohyb = pohyb;
      var h_uce = document.forms.fhlv1.h_uce.value; 
      var h_dok = document.forms.fhlv1.h_dok.value; 
      var h_ico = document.forms.fhlv1.h_ico.value; 
      var h_dat = document.forms.fhlv1.h_dat.value; 
      var h_zk0 = document.forms.fhlv1.h_zk0.value; 
      var h_zk1 = document.forms.fhlv1.h_zk1.value; 
      var h_zk2 = document.forms.fhlv1.h_zk2.value; 
      var h_dn1 = document.forms.fhlv1.h_dn1.value; 
      var h_dn2 = document.forms.fhlv1.h_dn2.value; 
      var h_txp = document.forms.fhlv1.h_txp.value; 
      var h_txz = document.forms.fhlv1.h_txz.value;
      var h_kto = document.forms.fhlv1.h_kto.value;
      var h_poz = document.forms.fhlv1.h_poz.value;
      var h_unk = document.forms.fhlv1.h_unk.value;
      var pau80 = 0;
      if( document.fhlv1.pau80.checked ) { pau80=1; }

      // create the params string
      var params = "h_drupoh=" + h_drupoh + "&h_pohyb=" + h_pohyb + "&h_odkial=" + h_odkial + "&h_dok=" + h_dok + "&h_ico=" + h_ico;
          params += "&h_dat=" + h_dat + "&h_zk0=" + h_zk0 + "&h_zk1=" + h_zk1;
          params += "&h_zk2=" + h_zk2 + "&h_dn1=" + h_dn1 + "&h_dn2=" + h_dn2 + "&pau80=" + pau80; 
          params += "&h_uce=" + h_uce + "&h_txp=" + h_txp + "&h_txz=" + h_txz + "&h_poz=" + h_poz + "&h_kto=" + h_kto + "&h_unk=" + h_unk;



      // initiate reading a file from the server
      xmlHttp.open("GET", "robot_pu.php?" + params, true);
      }

//    odkial=10 z podvojneho polozky dokladov
      if( h_odkial == 10 )
      {
      var h_drupoh = drupoh; 
      var h_pohyb = pohyb;
      var h_uce = document.forms.forms1.h_uce.value; 
      var h_dok = document.forms.forms1.h_dok.value; 
      var h_fak = document.forms.forms1.h_fak.value; 
      var h_ico = document.forms.forms1.h_ico.value; 
      var h_hod = document.forms.forms1.h_hop.value; 
      var h_hod1 = 0;
      var h_hod2 = 0;
      var h_hod3 = 0;
      var h_hod4 = 0;
      if( h_drupoh == 4 || h_drupoh == 5 || h_drupoh == 21 || h_drupoh == 22 ) {
                          var h_hod1 = document.forms.fhoddok.h_hod1.value;
                          var h_hod2 = document.forms.fhoddok.h_hod2.value;
                          var h_hod3 = document.forms.fhoddok.h_hod3.value;
                          var h_hod4 = document.forms.fhoddok.h_hod4.value;
                                           }
      var pau80 = 0;
      if( h_drupoh == 2 || h_drupoh == 4 || h_drupoh == 5  ) {
      if( document.forms1.pau80.checked ) { pau80=1; }
                                            }

      // create the params string
      var params = "h_drupoh=" + h_drupoh + "&h_pohyb=" + h_pohyb + "&h_odkial=" + h_odkial + "&h_dok=" + h_dok + "&pau80=" + pau80;
          params += "&h_uce=" + h_uce + "&h_fak=" + h_fak + "&h_ico=" + h_ico + "&h_hod=" + h_hod + "&h_hdx=" + h_hdx;
          params += "&h_hod1=" + h_hod1 + "&h_hod2=" + h_hod2 + "&h_hod3=" + h_hod3 + "&h_hod4=" + h_hod4;

      // initiate reading a file from the server
      xmlHttp.open("GET", "robot_pu.php?" + params, true);
      }

//    odkial=29 z jednoducheho polozky dokladov
      if( h_odkial == 29 )
      {
      var h_drupoh = drupoh; 
      var h_pohyb = pohyb;
      var h_uce = document.forms.forms1.h_uce.value; 
      var h_dok = document.forms.forms1.h_dok.value; 
      var h_fak = document.forms.forms1.h_fak.value; 
      var h_ico = document.forms.forms1.h_ico.value; 
      var h_hod = document.forms.forms1.h_hop.value; 
      var h_hod1 = 0;
      var h_hod2 = 0;
      var h_hod3 = 0;
      var h_hod4 = 0;
      if( h_drupoh == 4 || h_drupoh == 5 ) {
                          var h_hod1 = document.forms.fhoddok.h_hod1.value;
                          var h_hod2 = document.forms.fhoddok.h_hod2.value;
                          var h_hod3 = document.forms.fhoddok.h_hod3.value;
                          var h_hod4 = document.forms.fhoddok.h_hod4.value;
                                           }


      // create the params string
      var params = "h_drupoh=" + h_drupoh + "&h_pohyb=" + h_pohyb + "&h_odkial=" + h_odkial + "&h_dok=" + h_dok;
          params += "&h_uce=" + h_uce + "&h_fak=" + h_fak + "&h_ico=" + h_ico + "&h_hod=" + h_hod + "&h_hdx=" + h_hdx;
          params += "&h_hod1=" + h_hod1 + "&h_hod2=" + h_hod2 + "&h_hod3=" + h_hod3 + "&h_hod4=" + h_hod4;

      // initiate reading a file from the server
      xmlHttp.open("GET", "robot_ju.php?" + params, true);
      }


      xmlHttp.onreadystatechange = cakajHlas;
      xmlHttp.send(null);
    }
    // display the error in case of failure
    catch (e)
    {
      alert("Can't connect to server:\n" + e.toString());
    }
  }
}



// function called when the state of the HTTP request changes
function cakajHlas() 
{
  // when readyState is 4, we are ready to read the server response
  if (xmlHttp.readyState == 4) 
  {
    // continue only if HTTP status is "OK"
    if (xmlHttp.status == 200) 
    {
      try
      {

        // vypis do tabulky samostatnej ;
          tabulka_HlasXML();

      }
      catch(e)
      {
        // display error message
        alert("Error reading the response: " + e.toString());
      }
    } 
    else
    {
      // display status message
      alert("There was a problem retrieving the data:\n" + 
            xmlHttp.statusText);
 
    }
  }
}



// vypis do tabulky s parametrom
function tabulka_HlasXML()
{
  // read the message from the server
  var xmlResponse = xmlHttp.responseXML;
  // catching potential errors with IE and Opera
  if (!xmlResponse || !xmlResponse.documentElement)
    throw("Invalid XML structure:\n" + xmlHttp.responseText);
  // catching potential errors with Firefox
  var rootNodeName = xmlResponse.documentElement.nodeName;
  if (rootNodeName == "parsererror") throw("Invalid XML structure");
  // obtain the XML's document element
  xmlRoot = xmlResponse.documentElement;  
  // obtain arrays with book titles and ISBNs 
  pol01Array = xmlRoot.getElementsByTagName("pol01");
  pol02Array = xmlRoot.getElementsByTagName("pol02");
  pol03Array = xmlRoot.getElementsByTagName("pol03");
  pol04Array = xmlRoot.getElementsByTagName("pol04");
  pol05Array = xmlRoot.getElementsByTagName("pol05");

  // generate HTML output
  var odkial = 0;
  var drupoh = 0;
  var pohyb = 0;
  var uce = 0;
  var dok = 0;
  var ico = 0;

  for (var i=0; i<pol01Array.length; i++)
    {
    odkial = pol01Array.item(i).firstChild.data;
    drupoh = pol02Array.item(i).firstChild.data;
    pohyb = pol03Array.item(i).firstChild.data;
    uce = pol04Array.item(i).firstChild.data;
    dok = pol05Array.item(i).firstChild.data;
    }

  var html = "<table  class='fmenz' width='100%'>";


  // iterate through the arrays and create an HTML structure
  for (var i=0; i<pol01Array.length; i++)
    {
    if( odkial == 0 ) {  html += "<tr><td width='7%' class='hvstuz'>OKay</td></tr>"; }
    if( odkial == 9 ) {  html += "<tr><td width='7%' class='hvstuz'>OKay</td></tr>"; }
    if( odkial == 10 ) {  html += "<tr><td width='7%' class='hvstuz'>OKay</td></tr>"; }
    }

  // obtain a reference to the <div> element on the page
     html += "</table>";


  myhlas = document.getElementById("robothlas");
  // display the HTML output
  bodywhite.style.cursor = "auto";
  myhlas.innerHTML = html;
  robotmenu.style.display='none';
  robothlas.style.display='';

  if( odkial == 9 && drupoh == 1 ) {
var parok = "sysx=UCT&hladaj_uce=" + uce + "&rozuct=ANO&copern=8&drupoh=1&page=1&h_tlsl=1&rozb1=NOT&rozb2=NOT" +
            "&cislo_dok=" + dok + "&h_ico=" + ico +"&h_uce=" + uce + "&h_unk";
window.open('vspk_u.php?' + parok, '_self' );

                                   }

  if( odkial == 9 && drupoh == 2 ) {
var parok = "sysx=UCT&hladaj_uce=" + uce + "&rozuct=ANO&copern=8&drupoh=2&page=1&h_tlsl=1&rozb1=NOT&rozb2=NOT" +
            "&cislo_dok=" + dok + "&h_ico=" + ico +"&h_uce=" + uce + "&h_unk";
window.open('vspk_u.php?' + parok, '_self' );

                                   }

  if( odkial == 0 && drupoh == 1 ) {
var parok = "sysx=UCT&hladaj_uce=" + uce + "&rozuct=ANO&copern=8&drupoh=1&page=1&h_tlsl=1&rozb1=NOT&rozb2=NOT" +
            "&cislo_dok=" + dok + "&h_ico=" + ico +"&h_uce=" + uce + "&h_unk";
window.open('vspk_u.php?' + parok, '_self' );

                                   }

  if( odkial == 0 && drupoh == 2 ) {
var parok = "sysx=UCT&hladaj_uce=" + uce + "&rozuct=ANO&copern=8&drupoh=2&page=1&h_tlsl=1&rozb1=NOT&rozb2=NOT" +
            "&cislo_dok=" + dok + "&h_ico=" + ico +"&h_uce=" + uce + "&h_unk";
window.open('vspk_u.php?' + parok, '_self' );

                                   }

  if( odkial == 19 && drupoh == 104 ) {
var parok = "sysx=UCT&hladaj_uce=" + uce + "&rozuct=ANO&copern=8&drupoh=4&page=1&h_tlsl=1&rozb1=NOT&rozb2=NOT" +
            "&cislo_dok=" + dok + "&h_ico=" + ico +"&h_uce=" + uce + "&h_unk";
window.open('vspk_u.php?' + parok, '_self' );

                                   }

  if( odkial == 19 && drupoh == 105 ) {
var parok = "sysx=UCT&hladaj_uce=" + uce + "&rozuct=ANO&copern=8&drupoh=5&page=1&h_tlsl=1&rozb1=NOT&rozb2=NOT" +
            "&cislo_dok=" + dok + "&h_ico=" + ico +"&h_uce=" + uce + "&h_unk";
window.open('vspk_u.php?' + parok, '_self' );

                                   }

  if( odkial == 19 && drupoh == 204 ) {
var parok = "sysx=UCT&hladaj_uce=" + uce + "&rozuct=ANO&copern=8&drupoh=4&page=1&h_tlsl=1&rozb1=NOT&rozb2=NOT" +
            "&cislo_dok=" + dok + "&h_ico=" + ico +"&h_uce=" + uce + "&h_unk";
window.open('vspk_u.php?' + parok, '_self' );

                                   }

  if( odkial == 19 && drupoh == 205 ) {
var parok = "sysx=UCT&hladaj_uce=" + uce + "&rozuct=ANO&copern=8&drupoh=5&page=1&h_tlsl=1&rozb1=NOT&rozb2=NOT" +
            "&cislo_dok=" + dok + "&h_ico=" + ico +"&h_uce=" + uce + "&h_unk";
window.open('vspk_u.php?' + parok, '_self' );

                                   }

  if( odkial == 19 && drupoh == 102 ) {
var parok = "sysx=UCT&hladaj_uce=" + uce + "&rozuct=ANO&copern=8&drupoh=2&page=1&h_tlsl=1&rozb1=NOT&rozb2=NOT" +
            "&cislo_dok=" + dok + "&h_ico=" + ico +"&h_uce=" + uce + "&h_unk";
window.open('vspk_u.php?' + parok, '_self' );

                                   }

  if( odkial == 19 && drupoh == 201 ) {
var parok = "sysx=UCT&hladaj_uce=" + uce + "&rozuct=ANO&copern=8&drupoh=1&page=1&h_tlsl=1&rozb1=NOT&rozb2=NOT" +
            "&cislo_dok=" + dok + "&h_ico=" + ico +"&h_uce=" + uce + "&h_unk";
window.open('vspk_u.php?' + parok, '_self' );

                                   }

  if( odkial == 10 && drupoh == 4 ) {
var parok = "sysx=UCT&hladaj_uce=" + uce + "&rozuct=ANO&copern=8&drupoh=4&page=1&h_tlsl=1&rozb1=NOT&rozb2=NOT" +
            "&cislo_dok=" + dok + "&h_ico=" + ico +"&h_uce=" + uce + "&h_unk";
window.open('vspk_u.php?' + parok, '_self' );

                                   }

  if( odkial == 10 && drupoh == 5 ) {
var parok = "sysx=UCT&hladaj_uce=" + uce + "&rozuct=ANO&copern=8&drupoh=5&page=1&h_tlsl=1&rozb1=NOT&rozb2=NOT" +
            "&cislo_dok=" + dok + "&h_ico=" + ico +"&h_uce=" + uce + "&h_unk";
window.open('vspk_u.php?' + parok, '_self' );

                                   }

  if( odkial == 10 && drupoh == 21 ) {
var parok = "sysx=UCT&hladaj_uce=" + uce + "&rozuct=ANO&copern=8&drupoh=1&page=1&h_tlsl=1&rozb1=NOT&rozb2=NOT" +
            "&cislo_dok=" + dok + "&h_ico=" + ico +"&h_uce=" + uce + "&h_unk";
window.open('vspk_u.php?' + parok, '_self' );

                                   }

  if( odkial == 10 && drupoh == 22 ) {
var parok = "sysx=UCT&hladaj_uce=" + uce + "&rozuct=ANO&copern=8&drupoh=2&page=1&h_tlsl=1&rozb1=NOT&rozb2=NOT" +
            "&cislo_dok=" + dok + "&h_ico=" + ico +"&h_uce=" + uce + "&h_unk";
window.open('vspk_u.php?' + parok, '_self' );

                                   }


  if( odkial == 29 && drupoh == 4 ) {
var parok = "sysx=UCT&hladaj_uce=" + uce + "&rozuct=ANO&copern=8&drupoh=4&page=1&h_tlsl=1&rozb1=NOT&rozb2=NOT" +
            "&cislo_dok=" + dok + "&h_ico=" + ico +"&h_uce=" + uce + "&h_unk";
window.open('vspk_u.php?' + parok, '_self' );

                                   }

  if( odkial == 29 && drupoh == 5 ) {
var parok = "sysx=UCT&hladaj_uce=" + uce + "&rozuct=ANO&copern=8&drupoh=5&page=1&h_tlsl=1&rozb1=NOT&rozb2=NOT" +
            "&cislo_dok=" + dok + "&h_ico=" + ico +"&h_uce=" + uce + "&h_unk";
window.open('vspk_u.php?' + parok, '_self' );

                                   }

}




