<?php
// ***************************************************************************
// ***************************************************************************
// ***************************************************************************
// OpenLinker is a web based library system designed to manage 
// journals, ILL, document delivery and OpenURL links
// 
// Copyright (C) 2012, Pablo Iriarte
// 
// This program is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
// 
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
// 
// You should have received a copy of the GNU General Public License
// along with this program.  If not, see <http://www.gnu.org/licenses/>.
// 
// ***************************************************************************
// ***************************************************************************
// ***************************************************************************
// 
// Home page : links generation
//

// ***************************************
// Affichage des variables et des liens dans la page 
// ***************************************
if ($urlquery)
{
echo "<div class='box'><div class='box-content'>\n";

// Liens vers le texte intégral si accès OK

echo "<a href='http://www.crossref.org/openurl\n";
echo $urlquery . "&pid=brokerid:brokerpass\n";
echo "' target='_blank'><b><font color='green'>Accès au texte intégral</font></b></a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;\n";

// Liens vers la commande OpenILLink

echo "<a href='../openillink/\n";
echo $urlquery;
echo "' target='_blank'><b>Commander le document via OpenILLink</b></a>\n";
echo "</div></div><div class='box-footer'><div class='box-footer-right'></div></div>\n";

echo "<div class='box'><div class='box-content'>\n";

// Liens par titre de la revue s'il y a un titre de revue ou un $issn

if ($title != "" || $issn != "")
echo "Chercher la revue <b>" . $title . "</b> dans :<ul><li><a href='../openlist/recherche.php?init=&q=" . $title . "' target='_blank'>OpenList</li>\n";

if ($title !="") {
echo "<li><a href='http://perunil.unil.ch/perunil/periodiques/FMPro?-db=per-bichi.fp5&-lay=results&-format=results.html&-error=errors.html&Cat=per&-max=25&-Script.PreSort=Recherche&Max=20&Debut=1&StatutAbo=&-find=chercher&-sortfield=TitreRech&-sortorder=Ascending&-sortfield=Support&-sortorder=Ascending&-sortfield=Biblio&-sortorder=Ascending&TypeRech=on&TitreRech=\n";
echo $title;
echo "' target='_blank'>Perunil</a>\n";
}
else {
if ($stitle !="") {
echo "<li><a href='http://perunil.unil.ch/perunil/periodiques/FMPro?-db=per-bichi.fp5&-lay=results&-format=results.html&-error=errors.html&Cat=per&-max=25&-Script.PreSort=Recherche&Max=20&Debut=1&StatutAbo=&-find=chercher&-sortfield=TitreRech&-sortorder=Ascending&-sortfield=Support&-sortorder=Ascending&-sortfield=Biblio&-sortorder=Ascending&TypeRech=on&TitreRech=\n";
echo $stitle;
echo "' target='_blank'>Perunil</a>\n";
}
else {
if ($issn !="") {
echo "<li><a href='http://perunil.unil.ch/perunil/periodiques/FMPro?-db=per-bichi.fp5&-format=results.html&-lay=results&-sortfield=titrerech&-sortfield=support&-sortfield=biblio&Cat=per&Support=&Biblio=&StatutAbo=&TypeRech=&SujetSHS=&SujetMED=&Editeur=&TitreRech=&Max=25&Start=1&-Script.PreSort=recherche&ISSN9=\n";
echo $issn;
echo "&-find' target='_blank'>Perunil</a>\n";
}
}
}

if ($issn !="") {

echo "</li><li><a href='http://opac.rero.ch/get_bib_record.cgi?db=cc&issn=\n";
echo $issn;
echo "' target='_blank'>RERO (catalogue collectif)</a>\n";

echo "</li><li><a href='http://opac.rero.ch/get_bib_record.cgi?db=vd&issn=\n";
echo $issn;
echo "' target='_blank'>RERO (catalogue Vaudois)</a>\n";

echo "</li><li><a href='http://idbib3.unizh.ch:8331/V/?func=quick-1-check1&mode=advanced&find_request_1=&find_code_2=ISSN&find_op_1=AND&find_code_3=WRD&find_request_3=&group_number=000002069&find_request_2=\n";
echo $issn;
echo "' target='_blank'>IDS (catalogue suisse alémanique)</a>\n";


echo "</li><li><a href='http://www.ubka.uni-karlsruhe.de/hylib-bin/kvk/nph-kvk2.cgi?maske=chzk&timeout=120&title=Portail+suisse+des+p%E9riodiques+%28PSP%29+%3A+Liste+des+R%E9sultats&header=http%3A%2F%2Fead.nb.admin.ch%2Fweb%2Fswiss-serials%2Fanzeige_fr.htm&spacer=http%3A%2F%2Fead.nb.admin.ch%2Fweb%2Fswiss-serials%2Fanzeigetop_fr.htm&footer=http%3A%2F%2Fead.nb.admin.ch%2Fweb%2Fswiss-serials%2Fanzeigemail_fr.htm&lang=de&zeiten=nein&kvk-session=08CSUG05&flexpositon_start=1&RERO=&DEUTSCHSCHWEIZ=&WEITERE=&kataloge=CHZK_FRIB&kataloge=CHZK_GENF&kataloge=CHZK_RCBN&kataloge=CHZK_VALAIS&kataloge=CHZK_VAUD&kataloge=CHZK_BASEL&kataloge=CHZK_LUZERN&kataloge=CHZK_STGALLEN&kataloge=ZUERICH&kataloge=CHZK_NEBIS&kataloge=ALEXANDRIA&kataloge=CHZK_BGR&kataloge=HELVETICAT&kataloge=CHZK_SBT&kataloge=CHZK_SGBN&kataloge=LIECHTENSTEIN&kataloge=CHZK_CERN&kataloge=VKCH_KUNSTHAUS&kataloge=CHZK_RPVZ&ALL=&SE=&VORT=&CI=&target=_blank&Timeout=120&inhibit_redirect=1&SS=\n";
echo $issn;
echo "' target='_blank'>Swiss-Serials (catalogue suisse de périodiques)</a>\n";

echo "</li><li><a href='http://links.isiglobalnet2.com/gateway/Gateway.cgi?GWVersion=2&SrcAuth=JCR&SrcApp=JCR&DestApp=JCR&PointOfEntry=Impact&KeyRecord=\n";
echo $issn;
echo "' target='_blank'>Impact Factor de la revue (JCR de ISI)</a><b><font color='red'> *</font></b>\n";

echo "</li><li><a href='http://ulrichsweb.com/ulrichsweb/Search/ViewSearchResults.asp?navPage=1&SortOrder=Asc&SortField=f_display_title&collection=SERIAL&QueryMode=Simple&ScoreThreshold=0&ResultCount=25&ResultTemplate=quickSearchResults.hts&QueryText=sn=\n";
echo $issn;
echo "' target='_blank'>Plus d'informations sur cette revue avec l'Ulrich's</a><b><font color='red'> *</font></b></ul>\n";

}

if ($issn == "" && ($title != "" || $stitle != "")) {

echo "</li><li><a href='http://opac.rero.ch/get_bib_record.cgi?db=cc&issn=\n";
echo $title;
if ($title == "" && $stitle != "")
echo $stitle;
echo "' target='_blank'>RERO (catalogue collectif)</a>\n";

echo "</li><li><a href='http://opac.rero.ch/get_bib_record.cgi?db=vd&issn=\n";
echo $title;
if ($title == "" && $stitle != "")
echo $stitle;
echo "' target='_blank'>RERO (catalogue Vaudois)</a>\n";

echo "</li><li><a href='http://idbib3.unizh.ch:8331/V/?func=quick-1-check1&mode=advanced&find_request_1=&find_code_2=ISSN&find_op_1=AND&find_code_3=WRD&find_request_3=&group_number=000002069&find_request_2=\n";
echo $title;
if ($title == "" && $stitle != "")
echo $stitle;
echo "' target='_blank'>IDS (catalogue suisse alémanique)</a>\n";


echo "</li><li><a href='http://www.ubka.uni-karlsruhe.de/hylib-bin/kvk/nph-kvk2.cgi?maske=chzk&timeout=120&title=Portail+suisse+des+p%E9riodiques+%28PSP%29+%3A+Liste+des+R%E9sultats&header=http%3A%2F%2Fead.nb.admin.ch%2Fweb%2Fswiss-serials%2Fanzeige_fr.htm&spacer=http%3A%2F%2Fead.nb.admin.ch%2Fweb%2Fswiss-serials%2Fanzeigetop_fr.htm&footer=http%3A%2F%2Fead.nb.admin.ch%2Fweb%2Fswiss-serials%2Fanzeigemail_fr.htm&lang=de&zeiten=nein&kvk-session=08CSUG05&flexpositon_start=1&RERO=&DEUTSCHSCHWEIZ=&WEITERE=&kataloge=CHZK_FRIB&kataloge=CHZK_GENF&kataloge=CHZK_RCBN&kataloge=CHZK_VALAIS&kataloge=CHZK_VAUD&kataloge=CHZK_BASEL&kataloge=CHZK_LUZERN&kataloge=CHZK_STGALLEN&kataloge=ZUERICH&kataloge=CHZK_NEBIS&kataloge=ALEXANDRIA&kataloge=CHZK_BGR&kataloge=HELVETICAT&kataloge=CHZK_SBT&kataloge=CHZK_SGBN&kataloge=LIECHTENSTEIN&kataloge=CHZK_CERN&kataloge=VKCH_KUNSTHAUS&kataloge=CHZK_RPVZ&ALL=&SE=&VORT=&CI=&target=_blank&Timeout=120&inhibit_redirect=1&SS=\n";
echo $title;
  if ($title == "" && $stitle != "")
echo $stitle;
echo "' target='_blank'>Swiss-Serials (catalogue suisse de périodiques)</a>\n";


echo "</li><li><a href='http://links.isiglobalnet2.com/gateway/Gateway.cgi?GWVersion=2&SrcAuth=JCR&SrcApp=JCR&DestApp=JCR&PointOfEntry=Impact&KeyRecord=\n";
echo $title;
if ($title == "" && $stitle != "")
echo $stitle;
echo "' target='_blank'>Impact Factor de la revue (JCR de ISI)</a><b><font color='red'> *</font></b>\n";

echo "</li><li><a href='http://ulrichsweb.com/ulrichsweb/Search/ViewSearchResults.asp?navPage=1&SortOrder=Asc&SortField=f_display_title&collection=SERIAL&QueryMode=Simple&ScoreThreshold=0&ResultCount=25&ResultTemplate=quickSearchResults.hts&QueryText=sn=\n";
echo $title;
if ($title == "" && $stitle != "")
echo $stitle;
echo "' target='_blank'>Plus d'informations sur cette revue avec l'Ulrich's</a><b><font color='red'> *</font></b></ul>\n";

}


// Liens par titre

if ($atitle !="") {
echo "</ul>Chercher le titre de l'article dans<ul>\n";
echo "</li><li><a href='http://portal.isiknowledge.com/portal.cgi?DestApp=WOS&DestParams=%3F%26CustomersID%3DResearchSoft%26Func%3DSearch%26Form%3DHomePage%26Promo%2BCode%3Drs02%26PublisherID%3DResearchSoft%26ServiceName%3DTransferToWos%26ServiceUser%3DLinks%26topic%3D\n";
echo $atitle;
echo "&DestFail=http%3A%2F%2Fwww.isinet.com%2Fisi%2Fproducts%2Fesource%2Fservice.html&SrcApp=RefMan&SrcAuth=ResearchSoft' target='_blank'>Web of Science</a><b><font color='red'> *</font></b>\n";

echo "</li><li><a href='http://scholar.google.com/scholar?q=%22\n";
echo $atitle;
echo "%22' target='_blank'>Google Scholar</a>\n";

echo "</li><li><a href='http://www.scirus.com/srsapp/search?t=all&q=\n";
echo $atitle;
echo "' target='_blank'>SCIRUS</a>\n";

echo "</li><li><a href='http://www.google.com/search?hl=fr&q=%22\n";
echo $atitle;
echo "%22' target='_blank'>Google</a></ul>\n";
}


// Liens par premier auteur


if (aulast != "") {
echo "</ul>Chercher les documents de <b>\n";
echo $aulast;

if (aufirst !="") {
echo ", \n";
echo $aufirst;
}
echo "</b> dans :<ul>\n";

echo "<li><a href='http://www.ncbi.nlm.nih.gov/entrez/query.fcgi?otool=ichuvlib&CMD=search&DB=PubMed&term=\n";
echo $aulast;
if (aufirst !="") {
echo "+\n";
echo $aufirst;
}
echo "[Author]' target='_blank'>PubMed</a>\n";

echo "</li><li><a href='http://gateway.ovid.com/ovidweb.cgi?&T=JS&PAGE=main&D=prem,mesz&MODE=ovid&NEWS=N&SEARCH=\n";
echo $aulast;
if (aufirst !="") {
echo "+\n";
echo $aufirst;
}
echo ".au.' target='_blank'>Medline (OVID)</a></a><b><font color='red'> *</font></b>\n";

echo "</li><li><a href='http://gateway.ovid.com/ovidweb.cgi?&T=JS&PAGE=main&D=psyc,biol,nursing,ebmz&MODE=ovid&NEWS=N&SEARCH=\n";
echo $aulast;
if (aufirst !="") {
echo "+\n";
echo $aufirst;
}
echo ".au.' target='_blank'>Autres bases OVID (Biosis, Cinhal, PsycInfo et Cochrane)</a></a><b><font color='red'> *</font></b>\n";

echo "</li><li><a href='http://opac.rero.ch/gateway?function=INITREQ&search=KEYWORD&rootsearch=KEYWORD&sortby=pubti&sortdirection=1&u1=1003&t1=\n";
echo $aulast;
if (aufirst !="") {
echo "+\n";
echo $aufirst;
}
echo "' target='_blank'>RERO (catalogue des biblioth&egrave;ques universitaires romandes)</a>\n";

echo "</li><li><a href='http://aleph.unisg.ch/ids-mbs/direct.htm?find=WAU=\n";
echo $aulast;
if (aufirst !="") {
echo "+\n";
echo $aufirst;
}
echo "' target='_blank'>IDS (catalogue des biblioth&egrave;ques universitaires al&eacute;maniques)</a>\n";

echo "</li><li><a href='http://www.saphirdoc.ch/ListRecord.htm?selectobjet=6&what=\n";
echo $aulast;
if (aufirst !="") {
echo "+\n";
echo $aufirst;
}
echo "' target='_blank'>SAPHIR (base documentaire suisse en sant&eacute; publique)</a>\n";

echo "</li><li><a href='http://www.bdsp.tm.fr/Base/Scripts/SearchA.bs?Mot=&Motscles=&Date=+&Titperio=&Other=&bqMaxList=100&bqListOrder=-1&Auteur=\n";
echo $aulast;
if (aufirst !="") {
echo "+\n";
echo $aufirst;
}
echo "' target='_blank'>BDSP (base documentaire francaise en sant&eacute; publique)</a>\n";

echo "</li><li><a href='http://portal.isiknowledge.com/portal.cgi?DestApp=WOS&DestParams=%3F%26CustomersID%3DResearchSoft%26Func%3DSearch%26Form%3DHomePage%26Promo%2BCode%3Drs02%26PublisherID%3DResearchSoft%26ServiceName%3DTransferToWos%26ServiceUser%3DLinks%26topic%3D\n";
echo $aulast;
if (aufirst !="") {
echo "+\n";
echo $aufirst;
}
echo "&DestFail=http%3A%2F%2Fwww.isinet.com%2Fisi%2Fproducts%2Fesource%2Fservice.html&SrcApp=RefMan&SrcAuth=ResearchSoft' target='_blank'>Web of Science</a></a><b><font color='red'> *</font></b>\n";

echo "</li><li><a href='http://web5s.silverplatter.com/webspirs/start.ws?customer=udl&language=fr&databases=FNCS&search=\n";
echo $aulast;
if (aufirst !="") {
echo "+\n";
echo $aufirst;
}
echo "' target='_blank'>FRANCIS</a></a><b><font color='red'> *</font></b>\n";

echo "</li><li><a href='http://www.scopus.com/scopus/search/submit/basic.url?scint=1&menu=search&field1=AUTHOR-NAME&searchterm1=\n";
echo $aulast;
if (aufirst !="") {
echo "+\n";
echo $aufirst;
}
echo "' target='_blank'>SCOPUS</a></a><b><font color='red'> *</font></b>\n";

echo "</li><li><a href='http://scholar.google.com/scholar?as_q=&num=10&btnG=Search+Scholar&as_epq=&as_oq=&as_eq=&as_occt=any&as_publication=&as_ylo=&as_yhi=&as_allsubj=all&hl=en&lr=&c2coff=1&as_sauthors=\n";
echo $aulast;
if (aufirst !="") {
echo "+\n";
echo $aufirst;
}
echo "' target='_blank'>Google scholar</a>\n";

echo "</li><li><a href='http://doc.rero.ch/search.py?sc=1&ln=fr&f=author&cc=RERO+DOC&c=RERO+DOC%2FBOOKS&c=RERO+DOC%2FTHESES&c=RERO+DOC%2FJOURNALS&c=RERO+DOC%2FPREPRINTS&c=RERO+DOC%2FPOSTPRINTS&c=RERO+DOC%2FDISSERTATION&p=\n";
echo $aulast;
if (aufirst !="") {
echo "+\n";
echo $aufirst;
}
echo "' target='_blank'>RERO doc</a>\n";

echo "</li><li><a href='http://infoscience.epfl.ch/search.py?as=0&sc=1&ln=fr&f=author&p=\n";
echo $aulast;
if (aufirst !="") {
echo "+\n";
echo $aufirst;
}
echo "' target='_blank'>INFOSCIENCE (EPFL)</a>\n";

echo "</li><li><a href='http://www.saphirdoc.ch/alistedoc2.htm?idinlist=0&list=request&bib=&style=&NumReq=101911392919&oper_5=20111000&oper_6=20111000&oper_7=20111000&oper_8=&oper_13=&cluster_5=&cluster_6=&cluster_7=&cluster_8=&oper_1=20100000&cluster_1=&oper_2=20100000&cluster_2=&oper_3=20100000&oper_4=20111000&cluster_4=&oper_9=20100000&cluster_9=&oper_12=20100000&cluster_12=&oper_10=3&cluster_10=&typeapr=on&typearg=on&typeliv=on&typerap=on&typevar=on&oper_14=&cluster_14_DUMSC=on&cluster_14_DPCHUV=on&cluster_14_IUMSP=on&cluster_14_CNP=on&cluster_14_IST=on&cluster_14_DUPA=on&cluster_14_SMPP=on&cluster_14_SUPAA=on&cluster_14_SUPEA=on&cluster_3=\n";
echo $aulast;
if (aufirst !="") {
echo "+\n";
echo $aufirst;
}
echo "' target='_blank'>Publications institutionnelles CHUV</a>\n";
echo "</li><li><a href='http://www.oaister.org/cgi/b/bib/bib-idx?type=boolean&size=10&rgn1=author&rgn2=entire+record&rgn3=entire+record&c=oaister&searchfield=Author%2FCreator&q1=\n";
echo $aulast;
if (aufirst !="") {
echo "+\n";
echo $aufirst;
}
echo "&op2=And&searchfield=Entire+Record&q2=&op3=And&searchfield=Entire+Record&q3=&op6=And&rgn6=norm&restype=all+types&sort=title&submit2=search' target='_blank'>OAISTER (Open Archives)</a>\n";
echo "</ul>\n";
}

if (aulast !="" || $issn !="") {
echo "<b><font color='red'>* accès uniquement possible depuis l'Unil et le CHUV</font></b>\n";
}
echo "</div></div><div class='box-footer'><div class='box-footer-right'></div></div>\n";
}
?>
