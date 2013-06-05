// ***************************************
// Affichage des variables et des liens dans la page 
// ***************************************
if (paramOk) {

OpenURL2form()

  document.write("<div class='box'><div class='box-content'>");

// Liens vers le texte intégral si accès OK

  document.write("<a href='http://www.crossref.org/openurl");
  document.write(location.search + "&pid=udm:udm124");
  document.write("' target='_blank'><b><font color='green'>Accès au texte intégral</font></b></a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;");

// Liens vers la commande OpenILLink

  document.write("<a href='../openillink/");
  document.write(location.search);
  document.write("' target='_blank'><b>Commander le document via OpenILLink</b></a>");
  document.write("</div></div><div class='box-footer'><div class='box-footer-right'></div></div>");

  document.write("<div class='box'><div class='box-content'>");

// Liens par titre de la revue s'il y a un titre de revue ou un ISSN

if (title != "" || issn != "")
  document.write("Chercher la revue <b>" + title + "</b> dans :<ul><li><a href='../openlist/recherche.php?init=&q=" + title + "' target='_blank'>OpenList</li>");

if (title !="") {
  document.write("<li><a href='http://perunil.unil.ch/perunil/periodiques/FMPro?-db=per-bichi.fp5&-lay=results&-format=results.html&-error=errors.html&Cat=per&-max=25&-Script.PreSort=Recherche&Max=20&Debut=1&StatutAbo=&-find=chercher&-sortfield=TitreRech&-sortorder=Ascending&-sortfield=Support&-sortorder=Ascending&-sortfield=Biblio&-sortorder=Ascending&TypeRech=on&TitreRech=");
  document.write(title);
  document.write("' target='_blank'>Perunil</a>");
}
else {
if (stitle !="") {
  document.write("<li><a href='http://perunil.unil.ch/perunil/periodiques/FMPro?-db=per-bichi.fp5&-lay=results&-format=results.html&-error=errors.html&Cat=per&-max=25&-Script.PreSort=Recherche&Max=20&Debut=1&StatutAbo=&-find=chercher&-sortfield=TitreRech&-sortorder=Ascending&-sortfield=Support&-sortorder=Ascending&-sortfield=Biblio&-sortorder=Ascending&TypeRech=on&TitreRech=");
  document.write(stitle);
  document.write("' target='_blank'>Perunil</a>");
}
else {
if (issn !="") {
  document.write("<li><a href='http://perunil.unil.ch/perunil/periodiques/FMPro?-db=per-bichi.fp5&-format=results.html&-lay=results&-sortfield=titrerech&-sortfield=support&-sortfield=biblio&Cat=per&Support=&Biblio=&StatutAbo=&TypeRech=&SujetSHS=&SujetMED=&Editeur=&TitreRech=&Max=25&Start=1&-Script.PreSort=recherche&ISSN9=");
  document.write(issn);
  document.write("&-find' target='_blank'>Perunil</a>");
}
}
}

if (issn !="") {

  document.write("</li><li><a href='http://opac.rero.ch/get_bib_record.cgi?db=cc&issn=");
  document.write(issn);
  document.write("' target='_blank'>RERO (catalogue collectif)</a>");

  document.write("</li><li><a href='http://opac.rero.ch/get_bib_record.cgi?db=vd&issn=");
  document.write(issn);
  document.write("' target='_blank'>RERO (catalogue Vaudois)</a>");

  document.write("</li><li><a href='http://idbib3.unizh.ch:8331/V/?func=quick-1-check1&mode=advanced&find_request_1=&find_code_2=ISSN&find_op_1=AND&find_code_3=WRD&find_request_3=&group_number=000002069&find_request_2=");
  document.write(issn);
  document.write("' target='_blank'>IDS (catalogue suisse alémanique)</a>");


  document.write("</li><li><a href='http://www.ubka.uni-karlsruhe.de/hylib-bin/kvk/nph-kvk2.cgi?maske=chzk&timeout=120&title=Portail+suisse+des+p%E9riodiques+%28PSP%29+%3A+Liste+des+R%E9sultats&header=http%3A%2F%2Fead.nb.admin.ch%2Fweb%2Fswiss-serials%2Fanzeige_fr.htm&spacer=http%3A%2F%2Fead.nb.admin.ch%2Fweb%2Fswiss-serials%2Fanzeigetop_fr.htm&footer=http%3A%2F%2Fead.nb.admin.ch%2Fweb%2Fswiss-serials%2Fanzeigemail_fr.htm&lang=de&zeiten=nein&kvk-session=08CSUG05&flexpositon_start=1&RERO=&DEUTSCHSCHWEIZ=&WEITERE=&kataloge=CHZK_FRIB&kataloge=CHZK_GENF&kataloge=CHZK_RCBN&kataloge=CHZK_VALAIS&kataloge=CHZK_VAUD&kataloge=CHZK_BASEL&kataloge=CHZK_LUZERN&kataloge=CHZK_STGALLEN&kataloge=ZUERICH&kataloge=CHZK_NEBIS&kataloge=ALEXANDRIA&kataloge=CHZK_BGR&kataloge=HELVETICAT&kataloge=CHZK_SBT&kataloge=CHZK_SGBN&kataloge=LIECHTENSTEIN&kataloge=CHZK_CERN&kataloge=VKCH_KUNSTHAUS&kataloge=CHZK_RPVZ&ALL=&SE=&VORT=&CI=&target=_blank&Timeout=120&inhibit_redirect=1&SS=");
  document.write(issn);
  document.write("' target='_blank'>Swiss-Serials (catalogue suisse de périodiques)</a>");

  document.write("</li><li><a href='http://links.isiglobalnet2.com/gateway/Gateway.cgi?GWVersion=2&SrcAuth=JCR&SrcApp=JCR&DestApp=JCR&PointOfEntry=Impact&KeyRecord=");
  document.write(issn);
  document.write("' target='_blank'>Impact Factor de la revue (JCR de ISI)</a><b><font color='red'> *</font></b>");

  document.write("</li><li><a href='http://ulrichsweb.com/ulrichsweb/Search/ViewSearchResults.asp?navPage=1&SortOrder=Asc&SortField=f_display_title&collection=SERIAL&QueryMode=Simple&ScoreThreshold=0&ResultCount=25&ResultTemplate=quickSearchResults.hts&QueryText=sn=");
  document.write(issn);
  document.write("' target='_blank'>Plus d'informations sur cette revue avec l'Ulrich's</a><b><font color='red'> *</font></b></ul>");

}

if (issn == "" && (title != "" || stitle != "")) {

  document.write("</li><li><a href='http://opac.rero.ch/get_bib_record.cgi?db=cc&issn=");
  document.write(title);
  if (title == "" && stitle != "")
  document.write(stitle);
  document.write("' target='_blank'>RERO (catalogue collectif)</a>");

  document.write("</li><li><a href='http://opac.rero.ch/get_bib_record.cgi?db=vd&issn=");
  document.write(title);
  if (title == "" && stitle != "")
  document.write(stitle);
  document.write("' target='_blank'>RERO (catalogue Vaudois)</a>");

  document.write("</li><li><a href='http://idbib3.unizh.ch:8331/V/?func=quick-1-check1&mode=advanced&find_request_1=&find_code_2=ISSN&find_op_1=AND&find_code_3=WRD&find_request_3=&group_number=000002069&find_request_2=");
  document.write(title);
  if (title == "" && stitle != "")
  document.write(stitle);
  document.write("' target='_blank'>IDS (catalogue suisse alémanique)</a>");


  document.write("</li><li><a href='http://www.ubka.uni-karlsruhe.de/hylib-bin/kvk/nph-kvk2.cgi?maske=chzk&timeout=120&title=Portail+suisse+des+p%E9riodiques+%28PSP%29+%3A+Liste+des+R%E9sultats&header=http%3A%2F%2Fead.nb.admin.ch%2Fweb%2Fswiss-serials%2Fanzeige_fr.htm&spacer=http%3A%2F%2Fead.nb.admin.ch%2Fweb%2Fswiss-serials%2Fanzeigetop_fr.htm&footer=http%3A%2F%2Fead.nb.admin.ch%2Fweb%2Fswiss-serials%2Fanzeigemail_fr.htm&lang=de&zeiten=nein&kvk-session=08CSUG05&flexpositon_start=1&RERO=&DEUTSCHSCHWEIZ=&WEITERE=&kataloge=CHZK_FRIB&kataloge=CHZK_GENF&kataloge=CHZK_RCBN&kataloge=CHZK_VALAIS&kataloge=CHZK_VAUD&kataloge=CHZK_BASEL&kataloge=CHZK_LUZERN&kataloge=CHZK_STGALLEN&kataloge=ZUERICH&kataloge=CHZK_NEBIS&kataloge=ALEXANDRIA&kataloge=CHZK_BGR&kataloge=HELVETICAT&kataloge=CHZK_SBT&kataloge=CHZK_SGBN&kataloge=LIECHTENSTEIN&kataloge=CHZK_CERN&kataloge=VKCH_KUNSTHAUS&kataloge=CHZK_RPVZ&ALL=&SE=&VORT=&CI=&target=_blank&Timeout=120&inhibit_redirect=1&SS=");
  document.write(title);
  if (title == "" && stitle != "")
  document.write(stitle);
  document.write("' target='_blank'>Swiss-Serials (catalogue suisse de périodiques)</a>");


  document.write("</li><li><a href='http://links.isiglobalnet2.com/gateway/Gateway.cgi?GWVersion=2&SrcAuth=JCR&SrcApp=JCR&DestApp=JCR&PointOfEntry=Impact&KeyRecord=");
  document.write(title);
  if (title == "" && stitle != "")
  document.write(stitle);
  document.write("' target='_blank'>Impact Factor de la revue (JCR de ISI)</a><b><font color='red'> *</font></b>");

  document.write("</li><li><a href='http://ulrichsweb.com/ulrichsweb/Search/ViewSearchResults.asp?navPage=1&SortOrder=Asc&SortField=f_display_title&collection=SERIAL&QueryMode=Simple&ScoreThreshold=0&ResultCount=25&ResultTemplate=quickSearchResults.hts&QueryText=sn=");
  document.write(title);
  if (title == "" && stitle != "")
  document.write(stitle);
  document.write("' target='_blank'>Plus d'informations sur cette revue avec l'Ulrich's</a><b><font color='red'> *</font></b></ul>");

}


// Liens par titre

if (atitle !="") {
  document.write("</ul>Chercher le titre de l'article dans<ul>");
  document.write("</li><li><a href='http://portal.isiknowledge.com/portal.cgi?DestApp=WOS&DestParams=%3F%26CustomersID%3DResearchSoft%26Func%3DSearch%26Form%3DHomePage%26Promo%2BCode%3Drs02%26PublisherID%3DResearchSoft%26ServiceName%3DTransferToWos%26ServiceUser%3DLinks%26topic%3D");
  document.write(atitle);
  document.write("&DestFail=http%3A%2F%2Fwww.isinet.com%2Fisi%2Fproducts%2Fesource%2Fservice.html&SrcApp=RefMan&SrcAuth=ResearchSoft' target='_blank'>Web of Science</a><b><font color='red'> *</font></b>");

  document.write("</li><li><a href='http://scholar.google.com/scholar?q=%22");
  document.write(atitle);
  document.write("%22' target='_blank'>Google Scholar</a>");

  document.write("</li><li><a href='http://www.scirus.com/srsapp/search?t=all&q=");
  document.write(atitle);
  document.write("' target='_blank'>SCIRUS</a>");

  document.write("</li><li><a href='http://www.google.com/search?hl=fr&q=%22");
  document.write(atitle);
  document.write("%22' target='_blank'>Google</a></ul>");
}


// Liens par premier auteur


if (aulast != "") {
  document.write("</ul>Chercher les documents de <b>");
  document.write(aulast);

if (aufirst !="") {
  document.write(", ");
  document.write(aufirst);}
  document.write("</b> dans :<ul>");

  document.write("<li><a href='http://www.ncbi.nlm.nih.gov/entrez/query.fcgi?otool=ichuvlib&CMD=search&DB=PubMed&term=");
  document.write(aulast);
if (aufirst !="") {
  document.write("+");
  document.write(aufirst);}
  document.write("[Author]' target='_blank'>PubMed</a>");

  document.write("</li><li><a href='http://gateway.ovid.com/ovidweb.cgi?&T=JS&PAGE=main&D=prem,mesz&MODE=ovid&NEWS=N&SEARCH=");
  document.write(aulast);
if (aufirst !="") {
  document.write("+");
  document.write(aufirst);}
  document.write(".au.' target='_blank'>Medline (OVID)</a></a><b><font color='red'> *</font></b>");

  document.write("</li><li><a href='http://gateway.ovid.com/ovidweb.cgi?&T=JS&PAGE=main&D=psyc,biol,nursing,ebmz&MODE=ovid&NEWS=N&SEARCH=");
  document.write(aulast);
if (aufirst !="") {
  document.write("+");
  document.write(aufirst);}
  document.write(".au.' target='_blank'>Autres bases OVID (Biosis, Cinhal, PsycInfo et Cochrane)</a></a><b><font color='red'> *</font></b>");

  document.write("</li><li><a href='http://opac.rero.ch/gateway?function=INITREQ&search=KEYWORD&rootsearch=KEYWORD&sortby=pubti&sortdirection=1&u1=1003&t1=");
  document.write(aulast);
if (aufirst !="") {
  document.write("+");
  document.write(aufirst);}
  document.write("' target='_blank'>RERO (catalogue des biblioth&egrave;ques universitaires romandes)</a>");

  document.write("</li><li><a href='http://aleph.unisg.ch/ids-mbs/direct.htm?find=WAU=");
  document.write(aulast);
if (aufirst !="") {
  document.write("+");
  document.write(aufirst);}
  document.write("' target='_blank'>IDS (catalogue des biblioth&egrave;ques universitaires al&eacute;maniques)</a>");

  document.write("</li><li><a href='http://www.saphirdoc.ch/ListRecord.htm?selectobjet=6&what=");
  document.write(aulast);
if (aufirst !="") {
  document.write("+");
  document.write(aufirst);}
  document.write("' target='_blank'>SAPHIR (base documentaire suisse en sant&eacute; publique)</a>");

  document.write("</li><li><a href='http://www.bdsp.tm.fr/Base/Scripts/SearchA.bs?Mot=&Motscles=&Date=+&Titperio=&Other=&bqMaxList=100&bqListOrder=-1&Auteur=");
  document.write(aulast);
if (aufirst !="") {
  document.write("+");
  document.write(aufirst);}
  document.write("' target='_blank'>BDSP (base documentaire francaise en sant&eacute; publique)</a>");

  document.write("</li><li><a href='http://portal.isiknowledge.com/portal.cgi?DestApp=WOS&DestParams=%3F%26CustomersID%3DResearchSoft%26Func%3DSearch%26Form%3DHomePage%26Promo%2BCode%3Drs02%26PublisherID%3DResearchSoft%26ServiceName%3DTransferToWos%26ServiceUser%3DLinks%26topic%3D");
  document.write(aulast);
if (aufirst !="") {
  document.write("+");
  document.write(aufirst);}
  document.write("&DestFail=http%3A%2F%2Fwww.isinet.com%2Fisi%2Fproducts%2Fesource%2Fservice.html&SrcApp=RefMan&SrcAuth=ResearchSoft' target='_blank'>Web of Science</a></a><b><font color='red'> *</font></b>");

  document.write("</li><li><a href='http://web5s.silverplatter.com/webspirs/start.ws?customer=udl&language=fr&databases=FNCS&search=");
  document.write(aulast);
if (aufirst !="") {
  document.write("+");
  document.write(aufirst);}
  document.write("' target='_blank'>FRANCIS</a></a><b><font color='red'> *</font></b>");

  document.write("</li><li><a href='http://www.scopus.com/scopus/search/submit/basic.url?scint=1&menu=search&field1=AUTHOR-NAME&searchterm1=");
  document.write(aulast);
if (aufirst !="") {
  document.write("+");
  document.write(aufirst);}
  document.write("' target='_blank'>SCOPUS</a></a><b><font color='red'> *</font></b>");

  document.write("</li><li><a href='http://scholar.google.com/scholar?as_q=&num=10&btnG=Search+Scholar&as_epq=&as_oq=&as_eq=&as_occt=any&as_publication=&as_ylo=&as_yhi=&as_allsubj=all&hl=en&lr=&c2coff=1&as_sauthors=");
  document.write(aulast);
if (aufirst !="") {
  document.write("+");
  document.write(aufirst);}
  document.write("' target='_blank'>Google scholar</a>");

  document.write("</li><li><a href='http://doc.rero.ch/search.py?sc=1&ln=fr&f=author&cc=RERO+DOC&c=RERO+DOC%2FBOOKS&c=RERO+DOC%2FTHESES&c=RERO+DOC%2FJOURNALS&c=RERO+DOC%2FPREPRINTS&c=RERO+DOC%2FPOSTPRINTS&c=RERO+DOC%2FDISSERTATION&p=");
  document.write(aulast);
if (aufirst !="") {
  document.write("+");
  document.write(aufirst);}
  document.write("' target='_blank'>RERO doc</a>");

  document.write("</li><li><a href='http://infoscience.epfl.ch/search.py?as=0&sc=1&ln=fr&f=author&p=");
  document.write(aulast);
if (aufirst !="") {
  document.write("+");
  document.write(aufirst);}
  document.write("' target='_blank'>INFOSCIENCE (EPFL)</a>");

  document.write("</li><li><a href='http://www.saphirdoc.ch/alistedoc2.htm?idinlist=0&list=request&bib=&style=&NumReq=101911392919&oper_5=20111000&oper_6=20111000&oper_7=20111000&oper_8=&oper_13=&cluster_5=&cluster_6=&cluster_7=&cluster_8=&oper_1=20100000&cluster_1=&oper_2=20100000&cluster_2=&oper_3=20100000&oper_4=20111000&cluster_4=&oper_9=20100000&cluster_9=&oper_12=20100000&cluster_12=&oper_10=3&cluster_10=&typeapr=on&typearg=on&typeliv=on&typerap=on&typevar=on&oper_14=&cluster_14_DUMSC=on&cluster_14_DPCHUV=on&cluster_14_IUMSP=on&cluster_14_CNP=on&cluster_14_IST=on&cluster_14_DUPA=on&cluster_14_SMPP=on&cluster_14_SUPAA=on&cluster_14_SUPEA=on&cluster_3=");
  document.write(aulast);
if (aufirst !="") {
  document.write("+");
  document.write(aufirst);}
  document.write("' target='_blank'>Publications institutionnelles CHUV</a>");
  
  document.write("</li><li><a href='http://www.oaister.org/cgi/b/bib/bib-idx?type=boolean&size=10&rgn1=author&rgn2=entire+record&rgn3=entire+record&c=oaister&searchfield=Author%2FCreator&q1=");
  document.write(aulast);
if (aufirst !="") {
  document.write("+");
  document.write(aufirst);}
  document.write("&op2=And&searchfield=Entire+Record&q2=&op3=And&searchfield=Entire+Record&q3=&op6=And&rgn6=norm&restype=all+types&sort=title&submit2=search' target='_blank'>OAISTER (Open Archives)</a>");
  document.write("</ul>");
}

if (aulast !="" || issn !="") {
document.write("<b><font color='red'>* accès uniquement possible depuis l'Unil et le CHUV</font></b>");
}
  document.write("</div></div><div class='box-footer'><div class='box-footer-right'></div></div>");
}
