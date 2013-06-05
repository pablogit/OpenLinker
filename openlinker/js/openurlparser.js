// ************************************************************************************************
// Récupération des paramètres OpenURL 0.1 d'une requête HTTP GET pour remplissage d'un formulaire HTML (version 31 mai 2007)
// Auteur : Pablo Iriarte / BiUM - CHUV, Lausanne 
// Sous licence Creative Commons 2.5 : Paternité - Pas d'Utilisation Commerciale - Partage des Conditions Initiales à l'Identique
// ************************************************************************************************

// exemple d'OpenURL : http://[Adresse de la page]?sid=google&auinit=M&aulast=Revilla&atitle=Bacterial+and+Phytoplankton+Dynamics+along+a+Trophi+Gradient+in+a+Shallow+Temperate+Estuary&title=Estuarine+and+coastal+marine+science&volume=50&issue=3&date=2000&spage=297&epage=310


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
  // Eliminer le "?"
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

// ***************************************
// Variables OpenURL
// ***************************************
function OpenURL2form() {
if (paramOk) {
  atitle = ParamValeur("atitle");
  aulast = ParamValeur("aulast");
  aufirst = ParamValeur("aufirst");
  auinit = ParamValeur("auinit");
  auinit1 = ParamValeur("auinit1");
  auinitm = ParamValeur("auinitm");
  date = ParamValeur("date");
  eissn = ParamValeur("eissn");
  isbn = ParamValeur("isbn");
  issn = ParamValeur("issn");
  coden = ParamValeur("coden");
  issue = ParamValeur("issue");
  uid = ParamValeur("uid");
  pid = ParamValeur("pid");
  sid = ParamValeur("sid");
  spage = ParamValeur("spage");
  epage = ParamValeur("epage");
  pages = ParamValeur("pages");
  artnum = ParamValeur("artnum");
  title = ParamValeur("title");
  stitle = ParamValeur("stitle");
  volume = ParamValeur("volume");
  part = ParamValeur("part");

// Attribution des valeurs recuperes de la requête dans les champs du formulaire
document.openurlform.uid.value = uid;
document.openurlform.title.value = title;
if (!title)
if (stitle)
{
document.openurlform.title.value = stitle;
}
document.openurlform.atitle.value = atitle;
if (aulast)
monauteur = aulast;
if (aufirst)
monauteur = monauteur + ", " + aufirst;
else
if (auinit)
monauteur = monauteur + ", " + auinit;
else
if (auinit1)
monauteur = monauteur + ", " + auinit1 + auinitm;
document.openurlform.aulast.value = monauteur;
document.openurlform.date.value = date;
document.openurlform.volume.value = volume;
document.openurlform.issue.value = issue;
document.openurlform.pages.value = pages;
if (!pages) {
if (spage)
document.openurlform.pages.value = spage
if (epage)
document.openurlform.pages.value += "-" + epage;
if (artnum)
document.openurlform.pages.value += "article numéro " + artnum
}
if (issn) {
monissn = issn;
   var i = monissn.indexOf('-');
    if (i < 0)
    monissn = monissn.substring(0,4) + '-' + monissn.substring(4, monissn.length);
document.openurlform.issn.value = monissn;
}
document.openurlform.isbn.value = isbn;
}
}
