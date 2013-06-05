function checkAll(commande) {
for (i=0, n=commande.elements.length; i<n; i++){
   var objName = commande.elements[i].name;
   var objType = commande.elements[i].type;
   if (objType = "checkbox"){
     box = eval(commande.elements[i]);
     if (box.checked == false) box.checked = true;
   }
}
}

function unCheckAll(commande) {
for (i=0, n=commande.elements.length; i<n; i++){
   var objName = commande.elements[i].name;
   var objType = commande.elements[i].type;
   if (objType = "checkbox"){
     box = eval(commande.elements[i]);
     if (box.checked == true) box.checked = false;
   }
}
}

function lookupid() {
  // si la valeur du champ uids est vide

if (document.openurlform.uids.value == "")
{
    // message d'alerte
alert('entrez un identificateur avant');
}

if ((document.openurlform.uids.value != "") && (document.openurlform.tid.value == "pmid"))
{
    // alors on rempli automatiquement le formulaire, ceci ecrasse ce qu'y est inscrit dans le formulaire normal et l'envoie
updateform();
}

if ((document.openurlform.uids.value != "") && (document.openurlform.tid.value == "reroid"))
{
updateform2();
}

if ((document.openurlform.uids.value != "") && (document.openurlform.tid.value == "isbn"))
{
updateform3();
}

if ((document.openurlform.uids.value != "") && (document.openurlform.tid.value == "doi"))
{
updateform4();
}

}

var url = 'lookup.php?pmid=';

function handleHttpResponse() {
  if (http.readyState == 4) {
    if (http.responseText.indexOf('invalid') == -1) {
//alert(http.responseText);
var xmlDocument = http.responseText;

var atitled = xmlDocument.indexOf("<Item Name=\"Title\" Type=\"String\">");
atitled = atitled+33;
var atitlef = xmlDocument.indexOf("</Item>",atitled);
var atitle = xmlDocument.substring(atitled,atitlef);


var authorsd = xmlDocument.indexOf("<Item Name=\"Author\" Type=\"String\">");
authorsd = authorsd+34;
var authorsf = xmlDocument.indexOf("</Item>",authorsd);
var authors = xmlDocument.substring(authorsd,authorsf);

var journald = xmlDocument.indexOf("<Item Name=\"FullJournalName\" Type=\"String\">");
if (journald != -1) {
journald = journald+43;
var journalf = xmlDocument.indexOf("</Item>",journald);
var journal = xmlDocument.substring(journald,journalf);
}
else
{
journald = xmlDocument.indexOf("<Item Name=\"Source\" Type=\"String\">");
journald = journald+34;
var journalf = xmlDocument.indexOf("</Item>",journald);
var journal = xmlDocument.substring(journald,journalf);
}

var anneed = xmlDocument.indexOf("<Item Name=\"PubDate\" Type=\"Date\">");
anneed = anneed+33;
var anneef = anneed + 4;
var annee = xmlDocument.substring(anneed,anneef);

var vold = xmlDocument.indexOf("<Item Name=\"Volume\" Type=\"String\">");
if (vold != -1) {
vold = vold+34;
var volf = xmlDocument.indexOf("</Item>",vold);
var vol = xmlDocument.substring(vold,volf);
}
else
{
var vol = '-';
}

var nod = xmlDocument.indexOf("<Item Name=\"Issue\" Type=\"String\">");
if (nod != -1) {
nod = nod+33;
var nof = xmlDocument.indexOf("</Item>",nod);
var no = xmlDocument.substring(nod,nof);
}
else
{
var vol = '-';
}

var pagesd = xmlDocument.indexOf("<Item Name=\"Pages\" Type=\"String\">");
pagesd = pagesd+33;
var pagesf = xmlDocument.indexOf("</Item>",pagesd);
var pages = xmlDocument.substring(pagesd,pagesf);

var issnd = xmlDocument.indexOf("<Item Name=\"ISSN\" Type=\"String\">");
if (issnd != -1) {
issnd = issnd+32;
var issnf = xmlDocument.indexOf("</Item>",issnd);
var issn = xmlDocument.substring(issnd,issnf);
}
else
{
var issn = '';
}
document.openurlform.atitle.value = atitle;
document.openurlform.aulast.value = authors;
document.openurlform.title.value = journal;
document.openurlform.date.value = annee;
document.openurlform.volume.value = vol;
document.openurlform.issue.value = no;
document.openurlform.pages.value = pages;
document.openurlform.issn.value = issn;
document.openurlform.uid.value = "pmid:" + document.openurlform.uids.value;
isWorking = false;
document.openurlform.submit();
    }
  }
}


var isWorking = false;

function updateform() {
  if (!isWorking && http) {
    var pmidValue = document.openurlform.uids.value;
    http.open("GET", url + encodeURI(pmidValue), true);
    http.onreadystatechange = handleHttpResponse;
    isWorking = true;
    http.send(null);
  }
}

function getHTTPObject() {
  var xmlhttp;
  /*@cc_on
  @if (@_jscript_version >= 5)
    try {
      xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
      try {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      } catch (E) {
        xmlhttp = false;
      }
    }
  @else
  xmlhttp = false;
  @end @*/
  if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
    try {
      xmlhttp = new XMLHttpRequest();
    } catch (e) {
      xmlhttp = false;
    }
  }
  return xmlhttp;
}

var http = getHTTPObject();


function lookupid2() {
  // si la valeur du champ identifiant est non vide
  if ((document.openurlform.uids.value != "") && (document.openurlform.tid.value == "reroid"))
updateIllform2();
else
alert ('Il faut au moins un identifiant');
}

var url2 = 'lookup.php?reroid=';
// URL d'exemple http://opac.rero.ch/gateway?function=MARCSCR&search=KEYWORD&u1=12&rootsearch=KEYWORD&t1=R004581066
// var url2 = 'http://sarasvati.rero.ch/gateway?&function=INITREQ&search=FREEFORM&sortby=pubti&sortdirection=1&host=sarasvati.rero.ch+8891+DEFAULT&t1=rero:';

function handleHttpResponse2() {
  if (http2.readyState == 4) {
    if (http2.responseText.indexOf('invalid') == -1) {
// alert(http2.responseText);
var xmlDocument2 = http2.responseText;
// alert(xmlDocument2);


var titred = xmlDocument2.indexOf(">245<");
titred = xmlDocument2.indexOf("$a",titred);
titred = titred + 3;
var titre2 = xmlDocument2.indexOf("$c",titred);
if (titre2 != -1) {
var titre = xmlDocument2.substring(titred,titre2 - 3);
titre = titre.replace('$b ','');
}

var authorsd = xmlDocument2.indexOf(">100<");
if (authorsd != -1) {
authorsd = xmlDocument2.indexOf("$a",authorsd);
authorsd = authorsd + 3;
var authors2 = xmlDocument2.indexOf(" </td>",authorsd);
if (authors2 != -1) {
var authors = xmlDocument2.substring(authorsd,authors2);
}
}
else
{
var authorsd = xmlDocument2.indexOf(">700<");
if (authorsd != -1) {
authorsd = xmlDocument2.indexOf("$a",authorsd);
authorsd = authorsd + 3;
var authors2 = xmlDocument2.indexOf(" </td>",authorsd);
if (authors2 != -1) {
var authors = xmlDocument2.substring(authorsd,authors2);
authors = authors.replace('$e','');
}
}
}

var anneed = xmlDocument2.indexOf(">260<");
if (anneed != -1) {
var editeurd = xmlDocument2.indexOf("$a",anneed);
anneed = xmlDocument2.indexOf("$c",anneed);
anneed = anneed + 3;
var anneef = xmlDocument2.indexOf(" </td>",anneed);
var annee = xmlDocument2.substring(anneed,anneef);
var editeur = xmlDocument2.substring(editeurd + 3,anneed - 5);
editeur = editeur.replace('$b ','');
}
else
{
var annee = '';
var editeur = '';
}

var issnd = xmlDocument2.indexOf(">020<");
if (issnd != -1) {
issnd = xmlDocument2.indexOf("$a",issnd);
var issnf = xmlDocument2.indexOf(" </td>",issnd);
var issn = xmlDocument2.substring(issnd + 3,issnf);
}
else
{
var issn = '';
}

var editiond = xmlDocument2.indexOf(">250<");
if (editiond != -1) {
editiond = xmlDocument2.indexOf("$a",editiond);
var editionf = xmlDocument2.indexOf(" </td>",editiond);
var edition = xmlDocument2.substring(editiond + 3,editionf);
if (editeur != '') {
edition = edition + " - ";
}
}
else
{
var edition = '';
}



// alert("titred = " + titred + " titre2 = " + titre2 + " titre = " + titre);

document.openurlform.genre.value = "book";
document.openurlform.title.value = titre;
document.openurlform.aulast.value = authors;
document.openurlform.date.value = annee;
// document.openurlform.edition.value = edition + editeur;
document.openurlform.issn.value = issn;
document.openurlform.uid.value = "RERO:" + document.openurlform.uids.value;

isWorking2 = false;
    }
  }
}


var isWorking2 = false;

function updateform2() {
  if (!isWorking2 && http2) {
    var idrero = document.openurlform.uids.value;
    http2.open("GET", url2 + encodeURI(idrero), true);
    http2.onreadystatechange = handleHttpResponse2;
    isWorking2 = true;
    http2.send(null);
  }
}

function getHTTPObject2() {
  var xmlhttp2;
  /*@cc_on
  @if (@_jscript_version >= 5)
    try {
      xmlhttp2 = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
      try {
        xmlhttp2 = new ActiveXObject("Microsoft.XMLHTTP");
      } catch (E) {
        xmlhttp2 = false;
      }
    }
  @else
  xmlhttp2 = false;
  @end @*/
  if (!xmlhttp2 && typeof XMLHttpRequest != 'undefined') {
    try {
      xmlhttp2 = new XMLHttpRequest();
    } catch (e) {
      xmlhttp2 = false;
    }
  }
  return xmlhttp2;
}

var http2 = getHTTPObject2();



function lookupid3() {
  // si la valeur du champ identifiant est non vide
  if ((document.openurlform.uids.value != "") && (document.openurlform.tid.value == "isbn"))
updateform3();
else
alert ('Il faut au moins un identifiant');
}

var url3 = 'lookup.php?isbn=';

// URL d'exemple http://opac.rero.ch/gateway?function=MARCSCR&search=KEYWORD&u1=7&rootsearch=KEYWORD&t1=2742968121

function handleHttpResponse3() {
  if (http3.readyState == 4) {
    if (http3.responseText.indexOf('invalid') == -1) {
// alert(http3.responseText);
var xmlDocument3 = http3.responseText;
// alert(xmlDocument3);


var titred = xmlDocument3.indexOf(">245<");
titred = xmlDocument3.indexOf("$a",titred);
titred = titred + 3;
var titre2 = xmlDocument3.indexOf("$c",titred);
if (titre2 != -1) {
var titre = xmlDocument3.substring(titred,titre2 - 3);
titre = titre.replace('$b ','');
}

var authorsd = xmlDocument3.indexOf(">100<");
if (authorsd != -1) {
authorsd = xmlDocument3.indexOf("$a",authorsd);
authorsd = authorsd + 3;
var authors2 = xmlDocument3.indexOf(" </td>",authorsd);
if (authors2 != -1) {
var authors = xmlDocument3.substring(authorsd,authors2);
}
}
else
{
var authorsd = xmlDocument3.indexOf(">700<");
if (authorsd != -1) {
authorsd = xmlDocument3.indexOf("$a",authorsd);
authorsd = authorsd + 3;
var authors2 = xmlDocument3.indexOf(" </td>",authorsd);
if (authors2 != -1) {
var authors = xmlDocument3.substring(authorsd,authors2);
authors = authors.replace('$e','');
}
}
}

var anneed = xmlDocument3.indexOf(">260<");
if (anneed != -1) {
var editeurd = xmlDocument3.indexOf("$a",anneed);
anneed = xmlDocument3.indexOf("$c",anneed);
anneed = anneed + 3;
var anneef = xmlDocument3.indexOf(" </td>",anneed);
var annee = xmlDocument3.substring(anneed,anneef);
var editeur = xmlDocument3.substring(editeurd + 3,anneed - 5);
editeur = editeur.replace('$b ','');
}
else
{
var annee = '';
var editeur = '';
}

var issnd = xmlDocument3.indexOf(">020<");
if (issnd != -1) {
issnd = xmlDocument3.indexOf("$a",issnd);
var issnf = xmlDocument3.indexOf(" </td>",issnd);
var issn = xmlDocument3.substring(issnd + 3,issnf);
}
else
{
var issn = '';
}

var editiond = xmlDocument3.indexOf(">250<");
if (editiond != -1) {
editiond = xmlDocument3.indexOf("$a",editiond);
var editionf = xmlDocument3.indexOf(" </td>",editiond);
var edition = xmlDocument3.substring(editiond + 3,editionf);
if (editeur != '') {
edition = edition + " - ";
}
}
else
{
var edition = '';
}



// alert("titred = " + titred + " titre2 = " + titre2 + " titre = " + titre);

document.openurlform.genre.value = "book";
document.openurlform.title.value = titre;
document.openurlform.aulast.value = authors;
document.openurlform.date.value = annee;
// document.openurlform.edition.value = edition + editeur;
document.openurlform.issn.value = issn;
document.openurlform.uid.value = "ISBN:" + document.openurlform.uids.value;

isWorking3 = false;
    }
  }
}


var isWorking3 = false;

function updateform3() {
  if (!isWorking3 && http3) {
    var isbn = document.openurlform.uids.value;
    http3.open("GET", url3 + encodeURI(isbn), true);
    http3.onreadystatechange = handleHttpResponse3;
    isWorking3 = true;
    http3.send(null);
  }
}

function getHTTPObject3() {
  var xmlhttp3;
  /*@cc_on
  @if (@_jscript_version >= 5)
    try {
      xmlhttp3 = new ActiveXObject("Msxml3.XMLHTTP");
    } catch (e) {
      try {
        xmlhttp3 = new ActiveXObject("Microsoft.XMLHTTP");
      } catch (E) {
        xmlhttp3 = false;
      }
    }
  @else
  xmlhttp3 = false;
  @end @*/
  if (!xmlhttp3 && typeof XMLHttpRequest != 'undefined') {
    try {
      xmlhttp3 = new XMLHttpRequest();
    } catch (e) {
      xmlhttp3 = false;
    }
  }
  return xmlhttp3;
}

var http3 = getHTTPObject3();



function lookupid4() {
  // si la valeur du champ identifiant est non vide
  if ((document.openurlform.uids.value != "") && (document.openurlform.tid.value == "doi"))
updateform4();
else
alert ('Il faut au moins un identifiant');
}

var url4 = 'lookup.php?doi=';

// URL d'exemple http://www.crossref.org/openurl?pid=login:password&id=doi:10.1103/PhysRev.47.777&noredirect=true

function handleHttpResponse4() {
  if (http4.readyState == 4) {
    if (http4.responseText.indexOf('invalid') == -1) {
// alert(http4.responseText);
var xmlDocument4 = http4.responseText;
// alert(xmlDocument4);


var atitled = xmlDocument4.indexOf("<article_title>");
atitled = atitled+15;
var atitlef = xmlDocument4.indexOf("</article_title>",atitled);
var atitle = xmlDocument4.substring(atitled,atitlef);


var typedocd = xmlDocument4.indexOf("<doi type=");
typedocd = typedocd+11
var typedocf = xmlDocument4.indexOf(">",typedocd);
var typedoc = xmlDocument4.substring(typedocd,typedocf-1);

var issnd = xmlDocument4.indexOf("<issn type=\"print\">");
if (issnd != -1) {
issnd = issnd+19
var issnf = xmlDocument4.indexOf("</issn>",issnd);
var issn = xmlDocument4.substring(issnd,issnf);
issn = issn.substring(0,4) + "-" + issn.substring(4,8);
}
else
{
var issnd = xmlDocument4.indexOf("<issn type=\"electronic\">");
if (issnd != -1) {
issnd = issnd+24
var issnf = xmlDocument4.indexOf("</issn>",issnd);
var issn = xmlDocument4.substring(issnd,issnf);
issn = issn.substring(0,4) + "-" + issn.substring(4,8);
}
}


var journald = xmlDocument4.indexOf("<journal_title>");
if (journald != -1) {
journald = journald+15;
var journalf = xmlDocument4.indexOf("</journal_title>",journald);
var journal = xmlDocument4.substring(journald,journalf);
}
else
{
var journal = "";
}

var authorsd = xmlDocument4.indexOf("<author>");
if (authorsd != -1) {
authorsd = authorsd+8;
var authorsf = xmlDocument4.indexOf("</author>",authorsd);
var authors = xmlDocument4.substring(authorsd,authorsf);
}
else
{
var authors = "";
}

var anneed = xmlDocument4.indexOf("<year>");
if (anneed != -1) {
anneed = anneed+6;
var anneef = xmlDocument4.indexOf("</year>",anneed);
var annee = xmlDocument4.substring(anneed,anneef);
}
else
{
var annee = "";
}

var vold = xmlDocument4.indexOf("<volume>");
if (vold != -1) {
vold = vold+8;
var volf = xmlDocument4.indexOf("</volume>",vold);
var vol = xmlDocument4.substring(vold,volf);
}
else
{
var vol = "";
}

var nod = xmlDocument4.indexOf("<issue>");
if (nod != -1) {
nod = nod+7;
var nof = xmlDocument4.indexOf("</issue>",nod);
var no = xmlDocument4.substring(nod,nof);
}
else
{
var no = "";
}

var pagesd = xmlDocument4.indexOf("<first_page>");
if (pagesd != -1) {
pagesd = pagesd+12;
var pagesf = xmlDocument4.indexOf("</first_page>",pagesd);
var pages = xmlDocument4.substring(pagesd,pagesf) + "-?";
}
else
{
var pages = "";
}

// alert("titred = " + titred + " titre2 = " + titre2 + " titre = " + titre);

if (typedoc == "book_title")
{
document.openurlform.genre.value = "book";
}
if (typedoc == "book_content")
{
document.openurlform.genre.value = "bookitem";
}

document.openurlform.atitle.value = atitle;
document.openurlform.title.value = journal;
document.openurlform.aulast.value = authors;
document.openurlform.date.value = annee;
document.openurlform.volume.value = vol;
document.openurlform.issue.value = no;
document.openurlform.pages.value = pages;
// document.openurlform.edition.value = typedoc;
document.openurlform.issn.value = issn;
document.openurlform.uid.value = "DOI:" + document.openurlform.uids.value;

isWorking4 = false;
    }
  }
}


var isWorking4 = false;

function updateform4() {
  if (!isWorking4 && http4) {
    var doi = document.openurlform.uids.value;
    http4.open("GET", url4 + encodeURI(doi), true);
    http4.onreadystatechange = handleHttpResponse4;
    isWorking4 = true;
    http4.send(null);
  }
}

function getHTTPObject4() {
  var xmlhttp4;
  /*@cc_on
  @if (@_jscript_version >= 5)
    try {
      xmlhttp4 = new ActiveXObject("Msxml4.XMLHTTP");
    } catch (e) {
      try {
        xmlhttp4 = new ActiveXObject("Microsoft.XMLHTTP");
      } catch (E) {
        xmlhttp4 = false;
      }
    }
  @else
  xmlhttp4 = false;
  @end @*/
  if (!xmlhttp4 && typeof XMLHttpRequest != 'undefined') {
    try {
      xmlhttp4 = new XMLHttpRequest();
    } catch (e) {
      xmlhttp4 = false;
    }
  }
  return xmlhttp4;
}

var http4 = getHTTPObject4();




function bottin( ) {
  if  ((document.commande.nom.value != "") || (document.commande.prenom.value != "")) {
  var monurl= "formsendbot.php?name=" + document.commande.nom.value + "&surname=" + document.commande.prenom.value;
window.open(monurl); }
else
alert("Rentrez un nom d'abord")
  }

function bottinunil( ) {
  if  ((document.commande.nom.value != "") || (document.commande.prenom.value != "")) {
  var monurl= "formsendbotunil.php?nom=" + document.commande.nom.value + "&prenom" + document.commande.prenom.value;
window.open(monurl); }
else
alert("Rentrez un nom d'abord")
  }

function openlist( ) {
  if  (document.commande.title.value != "") {
  var monurl= "../openlist/recherche.php?init=&q=" + document.commande.title.value;
window.open(monurl); }
else
alert("Rentrez un titre d'abord")
  }

function perunil( ) {
  if  (document.commande.title.value != "")
  {
  var montitre = document.commande.title.value
  montitre = montitre.replace(' & ',' ');
  montitre = montitre.replace(' the ',' ');
  montitre = montitre.replace('The ','');
  montitre = montitre.replace(' and ',' ');
  montitre = montitre.replace(' of ',' ');
  montitre = montitre.replace(' - ',' ');
  montitre = montitre.replace('-',' ');
  var post1 = montitre.indexOf(':',montitre);
  if (post1 != -1) {
  montitre = montitre.substring(0,post1);
  }
  var post2 = montitre.indexOf('=',montitre);
  if (post2 != -1) {
  montitre = montitre.substring(0,post2);
  }
  var post3 = montitre.indexOf('.',montitre);
  if (post3 != -1) {
  montitre = montitre.substring(0,post3);
  }
  var post4 = montitre.indexOf(';',montitre);
  if (post4 != -1) {
  montitre = montitre.substring(0,post4);
  }
  var monurl = "http://perunil.unil.ch/perunil/periodiques/FMPro?-db=per-bichi.fp5&-lay=results&-format=results.html&-error=errors.html&Cat=per&-max=25&-Script.PreSort=Recherche&Max=20&Debut=1&-find=chercher&TypeRech=on&TitreRech=" + montitre;
  window.open(monurl);
  }
  else
  alert("Rentrez un titre d'abord")
  }

/*
   name - name of the cookie
   value - value of the cookie
   [expires] - expiration date of the cookie
     (defaults to end of current session)
   [path] - path for which the cookie is valid
     (defaults to path of calling document)
   [domain] - domain for which the cookie is valid
     (defaults to domain of calling document)
   [secure] - Boolean value indicating if the cookie transmission requires
     a secure transmission
   * an argument defaults when it is assigned null as a placeholder
   * a null placeholder is not required for trailing omitted arguments
*/

function setCookie(name, value, expires, path, domain, secure) {
  var curCookie = name + "=" + escape(value) +
      ((expires) ? "; expires=" + expires.toGMTString() : "") +
      ((path) ? "; path=" + path : "") +
      ((domain) ? "; domain=" + domain : "") +
      ((secure) ? "; secure" : "");
  document.cookie = curCookie;
}


/*
  name - name of the desired cookie
  return string containing value of specified cookie or null
  if cookie does not exist
*/

function getCookie(name) {
  var dc = document.cookie;
  var prefix = name + "=";
  var begin = dc.indexOf("; " + prefix);
  if (begin == -1) {
    begin = dc.indexOf(prefix);
    if (begin != 0) return null;
  } else
    begin += 2;
  var end = document.cookie.indexOf(";", begin);
  if (end == -1)
    end = dc.length;
  return unescape(dc.substring(begin + prefix.length, end));
}


/*
   name - name of the cookie
   [path] - path of the cookie (must be same as path used to create cookie)
   [domain] - domain of the cookie (must be same as domain used to
     create cookie)
   path and domain default if assigned null or omitted if no explicit
     argument proceeds
*/

function deleteCookie(name, path, domain) {
  if (getCookie(name)) {
    document.cookie = name + "=" +
    ((path) ? "; path=" + path : "") +
    ((domain) ? "; domain=" + domain : "") +
    "; expires=Thu, 01-Jan-70 00:00:01 GMT";
  }
}

// date - any instance of the Date object
// * hand all instances of the Date object to this function for "repairs"

function fixDate(date) {
  var base = new Date(0);
  var skew = base.getTime();
  if (skew > 0)
    date.setTime(date.getTime() - skew);
}

function coocout() {
deleteCookie("nom");
deleteCookie("prenom");
deleteCookie("service");
deleteCookie("servautre");
deleteCookie("cgra");
deleteCookie("cgrb");
deleteCookie("mail");
deleteCookie("tel");
deleteCookie("adresse");
deleteCookie("cp");
deleteCookie("ville");
alert("LE COOKIE A ETE SUPPRIME");
}

function okcooc() {
if  (document.commande.cooc.checked == true)
{
// create an instance of the Date object
var now = new Date();
// fix the bug in Navigator 2.0, Macintosh
fixDate(now);

/*
cookie expires in one year (actually, 365 days)
365 days in a year
24 hours in a day
60 minutes in an hour
60 seconds in a minute
1000 milliseconds in a second
*/

now.setTime(now.getTime() + 365 * 24 * 60 * 60 * 1000);

// set the new cookie
var nom = document.commande.nom.value;
var prenom = document.commande.prenom.value;
var service = document.commande.service.value;
var servautre = document.commande.servautre.value;
var cgra = document.commande.CGRA.value;
var cgrb = document.commande.CGRB.value;
var mail = document.commande.mail.value;
var tel = document.commande.tel.value;
var adresse = document.commande.adresse.value;
var cp = document.commande.postal.value;
var ville = document.commande.localite.value;
setCookie("nom", nom, now);
setCookie("prenom", prenom, now);
setCookie("service", service, now);
setCookie("servautre", servautre, now);
setCookie("cgra", cgra, now);
setCookie("cgrb", cgrb, now);
setCookie("mail", mail, now);
setCookie("tel", tel, now);
setCookie("adresse", adresse, now);
setCookie("cp", cp, now);
setCookie("ville", ville, now);
}
}

function remplirauto() {
if (getCookie("nom") != null) {document.commande.nom.value = getCookie("nom");}
if (getCookie("prenom") != null) {document.commande.prenom.value = getCookie("prenom");}
if (getCookie("service") != null) {document.commande.service.value = getCookie("service");}
if (getCookie("servautre") != null) {document.commande.servautre.value = getCookie("servautre");}
if (getCookie("cgra") != null) {document.commande.CGRA.value = getCookie("cgra");}
if (getCookie("cgrb") != null) {document.commande.CGRB.value = getCookie("cgrb");}
if (getCookie("mail") != null) {document.commande.mail.value = getCookie("mail");}
if (getCookie("tel") != null) {document.commande.tel.value = getCookie("tel");}
if (getCookie("adresse") != null) {document.commande.adresse.value = getCookie("adresse");}
if (getCookie("cp") != null) {document.commande.postal.value = getCookie("cp");}
if (getCookie("ville") != null) {document.commande.localite.value = getCookie("ville");}

// ********************************************
// Récupération de paramètres OpenURL d'une requête HTTP get
// Auteur : Pablo Iriarte / BiUM (www.pablog.ch)
// ********************************************

var paramOk = true;

function FaitTableau(n) {
  // Création d'un tableau (array)
  // aux dimensions du nombre de paramètres.
  this.length = n;
  for (var i = 0; i <= n; i++) {
    this[i] = 0
  }
  return this
}

function ParamValeur(nValeur) {
  // Récupération de la valeur d'une variable
  // Pour créer la variable en Javascript.
  var nTemp = "";
  for (var i=0;i<(param.length+1);i++) {
    if (param[i].substring(0,param[i].indexOf("=")) == nValeur)
      nTemp = param[i].substring(param[i].indexOf("=")+1,param[i].length)
  }
  return Decode(nTemp)
}

// Extraction des paramètres de la requête HTTP
// et initialise la variable "paramOk" à false
// s'il n'y a aucun paramètre.
if (!location.search) {
  paramOk = false;
}
else {
  // Éliminer le "?"
  nReq = location.search.substring(1,location.search.length)
  // Extrait les différents paramètres avec leur valeur.
  nReq = nReq.split("&");
  param = new FaitTableau(nReq.length-1)
  for (var i=0;i<(nReq.length);i++) {
    param[i] = nReq[i]
  }
}

// Décoder la requête HTTP
// manuellement pour le signe (+)
function Decode(tChaine) {
  while (true) {
    var i = tChaine.indexOf('+');
    if (i < 0) break;
    tChaine = tChaine.substring(0,i) + '%20' + tChaine.substring(i + 1, tChaine.length);
  }
  return unescape(tChaine)
}
// End -->
// Attribution des valeurs recuperes de la requête dans les champs du formulaire
if (location.search) {
document.commande.uid.value = ParamValeur("id");
document.commande.title.value = ParamValeur("title");
if (ParamValeur("jtitle"))
document.commande.title.value = ParamValeur("jtitle");
if (ParamValeur("btitle"))
document.commande.title.value = ParamValeur("btitle");
document.commande.atitle.value = ParamValeur("atitle");
monauteur = ParamValeur("aulast");
if (ParamValeur("aufirst"))
monauteur = monauteur + ", " + ParamValeur("aufirst");
document.commande.auteurs.value = monauteur;
document.commande.date.value = ParamValeur("date");
document.commande.volume.value = ParamValeur("volume");
document.commande.issue.value = ParamValeur("issue");
document.commande.pages.value = ParamValeur("pages");
if (!ParamValeur("pages")) {
if (ParamValeur("spage"))
document.commande.pages.value = ParamValeur("spage")
if (ParamValeur("epage"))
document.commande.pages.value = document.commande.pages.value + '-' + ParamValeur("epage");
}
if (ParamValeur("issn")) {
monissn = ParamValeur("issn");
   var i = monissn.indexOf('-');
    if (i < 0)
    monissn = monissn.substring(0,4) + '-' + monissn.substring(4, monissn.length);
document.commande.issn.value = monissn;
}
if (ParamValeur("isbn"))
document.commande.issn.value = ParamValeur("isbn");
if (ParamValeur("pmid"))
document.commande.uid.value = 'pmid:' + ParamValeur("pmid");
if (ParamValeur("id"))
{
document.commande.uid.value = ParamValeur("id");
}
else
{
if (ParamValeur("meduid"))
document.commande.uid.value = 'pmid:' + ParamValeur("meduid");
if (ParamValeur("pid"))
document.commande.uid.value = ParamValeur("pid");
if (ParamValeur("doi"))
document.commande.uid.value = 'doi:' + ParamValeur("doi");
}
if (ParamValeur("genre"))
document.commande.genre.value = ParamValeur("genre");
}
}