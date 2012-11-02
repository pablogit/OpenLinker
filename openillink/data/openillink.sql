-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Mar 05 Juin 2012 à 15:00
-- Version du serveur: 5.5.16
-- Version de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `openillink`
--

-- --------------------------------------------------------

--
-- Structure de la table `libraries`
--

CREATE TABLE IF NOT EXISTS `libraries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `default` tinyint(1) DEFAULT NULL,
  `name1` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `name2` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name3` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name4` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name5` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Contenu de la table `libraries`
--

INSERT INTO `libraries` (`id`, `code`, `default`, `name1`, `name2`, `name3`, `name4`, `name5`) VALUES
(1, 'LIB1', 1, 'Bibliothèque centrale', 'Central Library', 'Central Library', 'Central Library', 'Central Library'),
(2, 'LIB2', 0, 'Bibliothèque de l''institut XYZ', 'Library of XYZ institute', 'Library of XYZ institute', 'Library of XYZ institute', 'Library of XYZ institute'),
(3, 'LIB3', 0, 'Bibliothèque de l''institut ABC', 'Library of ABC institute', 'Library of ABC institute', 'Library of ABC institute', 'Library of ABC institute'),
(4, 'LIB4', 0, 'Bibliothèque de la faculté JKL', 'Library of JKL faculty', 'Library of JKL faculty', 'Library of JKL faculty', 'Library of JKL faculty'),
(5, 'LIB5', 0, 'Bibliothèque de la faculté MNO', 'Library of MNO faculty', 'Library of MNO faculty', 'Library of MNO faculty', 'Library of MNO faculty'),
(6, 'LIB6', 0, 'Bibliothèque de la faculté PQR', 'Library of PQR faculty', 'Library of PQR faculty', 'Library of PQR faculty', 'Library of PQR faculty'),
(7, 'LIB7', 0, 'Bibliothèque de la faculté STU', 'Library of STU faculty', 'Library of STU faculty', 'Library of STU faculty', 'Library of STU faculty');

-- --------------------------------------------------------

--
-- Structure de la table `links`
--

CREATE TABLE IF NOT EXISTS `links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `search_issn` tinyint(1) NOT NULL,
  `search_isbn` tinyint(1) NOT NULL,
  `search_ptitle` tinyint(1) NOT NULL,
  `search_btitle` tinyint(1) NOT NULL,
  `search_atitle` tinyint(1) NOT NULL,
  `order_ext` tinyint(1) NOT NULL,
  `order_form` tinyint(1) NOT NULL,
  `openurl` tinyint(1) NOT NULL,
  `library` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `title` (`title`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=48 ;

--
-- Contenu de la table `links`
--

INSERT INTO `links` (`id`, `title`, `url`, `search_issn`, `search_isbn`, `search_ptitle`, `search_btitle`, `search_atitle`, `order_ext`, `order_form`, `openurl`, `library`, `active`) VALUES
(3, 'Google', 'http://www.google.ch/search?hl=fr&newwindow=1&q=%22XTITLEX%22', 0, 0, 0, 0, 1, 0, 0, 0, 'LIB1', 1),
(2, 'PubMed', 'http://www.ncbi.nlm.nih.gov/entrez/query.fcgi?otool=mycode&orig_db=PubMed&db=PubMed&cmd=Search&otool=mycode&term=XTITLEX', 0, 0, 0, 0, 1, 0, 0, 0, 'LIB1', 1),
(4, 'RERO', 'http://opac.rero.ch/gateway?function=INITREQ&search=SCAN&rootsearch=SCAN&u1=4&t1=XTITLEX', 0, 0, 0, 0, 1, 0, 0, 0, 'LIB1', 1),
(5, 'IDS', 'http://ml.metabib.ch/V/?func=quick-1-check1&mode=advanced&find_request_1=&find_code_2=WRD&find_op_1=AND&find_code_3=WRD&find_request_3=&group_number=000002060&find_request_2=XTITLEX', 0, 0, 0, 0, 1, 0, 0, 0, 'LIB1', 1),
(6, 'perUnil', 'http://www2.unil.ch/perunil/search.php?q=XTITLEX&init=&search=simple&field=title&format=all', 0, 0, 1, 0, 0, 0, 0, 0, 'LIB1', 1),
(8, 'WEG', 'http://biblio.weg-edu.ch/webopac/', 0, 0, 1, 0, 0, 0, 0, 0, 'LIB1', 1),
(9, 'NLM Locator Plus', 'http://130.14.16.150/cgi-bin/Pwebrecon.cgi?Search_Arg=XTITLEX&Search_Code=JALL&CNT=25&HIST=1', 0, 0, 1, 0, 0, 0, 0, 0, 'LIB1', 0),
(10, 'Ge8', 'http://resolver.rero.ch/unige/az?param_lang_save=fre&param_letter_group_save=&param_perform_save=locate&param_letter_group_script_save=&param_chinese_checkbox_save=0&param_services2filter_save=getFullTxt&param_current_view_save=detail&param_jumpToPage_save=1&param_type_save=textSearch&param_textSearchType_save=contains&param_jumpToPage_value=&param_pattern_value=&param_textSearchType_value=contains&param_vendor_active=1&param_locate_category_active=1&param_issn_value=XISSNX', 1, 0, 0, 0, 0, 0, 0, 0, 'LIB1', 1),
(11, 'EPFL', 'http://library.epfl.ch/periodicals/?stype=&ti=&pu=&me=&status=&lib=&shelfmark=&-find=CHERCHER&issn=XISSNX', 1, 0, 0, 0, 0, 0, 0, 0, 'LIB1', 1),
(12, 'Belle-Idée (HUG)', 'http://biblioglas.hcuge.ch:8080/GLASOPAC/Search/AdvancedSearch.asp?HitCount=1&ShowOptions=false&GoPressed=true&SearchCash=8CF980000%7E0&IsFirstDisplay=false&selectPageSize=10&limitsLocation=&PubYear=&selectField1=8&selectField2=&selectField3=&selectBoolean1=1&selectBoolean2=1&txtSearch1=XISSNX&txtSearch2=&txtSearch3=&select_field1=8&txt_search1=".$enreg[''issn'']."&select_boolean1=1&select_field2=&txt_search2=&select_boolean2=1&select_field3=&txt_search3=&limits_location=&select_labels_medium=&select_labels_type=&select_page_size=10&pub_year=&formAction=&curPage=1&SelectedLinkCodes=&CurBatch=1&BatchChanged=&lblTitlesCount=0+S%E9lectionn%E9%28e%29s+&SortIndex=0', 1, 0, 0, 0, 0, 0, 0, 0, 'LIB1', 1),
(13, 'RP/VZ', 'http://libraries.admin.ch/cgi-bin/gw/chameleon?search=KEYWORD&rootsearch=KEYWORD&function=INITREQ&SourceScreen=HOLDINGSCR&skin=rpvz&conf=.%2fchameleon.conf&lng=fr-ch&itemu1=8&scant1=&scanu1=4&pos=1&prevpos=1&beginsrch=1&u1=8&t1=XISSNX', 1, 0, 0, 0, 0, 0, 0, 0, 'LIB1', 1),
(14, 'Helveticat', 'http://libraries.admin.ch/cgi-bin/gw/chameleon?search=KEYWORD&function=INITREQ&SourceScreen=HOLDINGSCR&skin=helveticat&lng=fr-ch&inst=consortium&conf=.%2fchameleon.conf&u1=8&op1=0&pos=1&rootsearch=KEYWORD&t1=XISSNX', 1, 0, 0, 0, 0, 0, 0, 0, 'LIB1', 1),
(15, 'RERO CC', 'http://opac.rero.ch/get_bib_record.cgi?db=cc&issn=XISSNX', 1, 0, 0, 0, 0, 0, 0, 0, 'LIB1', 1),
(16, 'RERO VD', 'http://opac.rero.ch/gateway?skin=vd&function=INITREQ&search=KEYWORD&rootsearch=KEYWORD&u1=8&t1=XISSNX', 1, 0, 0, 0, 0, 0, 0, 0, 'LIB1', 1),
(17, 'IDS', 'http://ml.metabib.ch/V/?func=quick-1-check1&mode=advanced&find_request_1=&find_code_2=ISSN&find_op_1=AND&find_code_3=WRD&find_request_3=&group_number=000002060&find_request_2=XISSNX', 1, 0, 0, 0, 0, 0, 0, 0, 'LIB1', 1),
(18, 'ZDB', 'http://dispatch.opac.ddb.de/DB=1.1/SET=1/TTL=1/CMD?ACT=SRCH&IKT=8&TRM=XISSNX', 1, 0, 0, 0, 0, 0, 0, 0, 'LIB1', 1),
(19, 'Ge8', 'http://resolver.rero.ch/unige/az?param_lang_save=fre&param_letter_group_save=&param_perform_save=searchTitle&param_letter_group_script_save=&param_chinese_checkbox_save=0&param_services2filter_save=getFullTxt&param_current_view_save=detail&param_jumpToPage_save=1&param_type_save=textSearch&param_textSearchType_save=contains&param_type_value=textSearch&param_jumpToPage_value=&param_textSearchType_value=contains&param_chinese_checkbox_value=0&param_pattern_value=XTITLEX', 0, 0, 1, 0, 0, 0, 0, 0, 'LIB1', 1),
(20, 'Ge8', 'http://www.medecine.unige.ch/organisation/bfm/openillink/', 0, 0, 0, 0, 0, 1, 0, 1, 'LIB1', 1),
(21, 'EPFL', 'http://library.epfl.ch/pret-inter/?pg=article&pSerial=XTITLEX&pYear=XDATEX&pVolume=XVOLUMEX&pIssue=XISSUEX&pPage=XPAGESX&pAuthor=XAULASTX&pTitle=XATITLEX&pIsbn=XISSNX&uComment=Ref%20interne%20XPIDX&uName=[my_library_name]&uStatus=other&uNebis=&uEmail=[my_email]&uAddress=[my_address]&uPhone=[my_phone]', 0, 0, 0, 0, 0, 1, 0, 0, 'LIB1', 1),
(22, 'IDS (Ba/Be)', 'forms.php?form=basel&my_customer_code=[my_basel_code]&my_customer_password=[my_basel_password]&my_customer_name=[my_customer_name]', 0, 0, 0, 0, 0, 0, 1, 0, 'LIB1', 1),
(42, 'Uni Bern', 'http://www.zb.unibe.ch/unicd/docdel.php?Journal=XTITLEX&Author=XAULASTX&Article=XATITLEX&Volume=XVOLUMEX&Issue=XISSUEX&Year=XDATEX&Pages=XPAGESX&ISSN=XISSNX&meduid=XPMIDX&sid=XSIDX&Publisher=&PubliPlace=&ou=&bennr=[my_bern_ill_code]&passwort=[my_bern_ill_password]&wo_bestellen=schweiz&mitteilung=XNAMEX+%28XPIDX%29', 0, 0, 0, 0, 0, 1, 0, 0, 'LIB1', 1),
(23, 'Swiss Serials', 'http://www.ubka.uni-karlsruhe.de/hylib-bin/kvk/nph-kvk2.cgi?maske=chzk&timeout=120&title=Portail+suisse+des+p%E9riodiques+%28PSP%29+%3A+Liste+des+R%E9sultats&header=http%3A%2F%2Fead.nb.admin.ch%2Fweb%2Fswiss-serials%2Fanzeige_fr.htm&spacer=http%3A%2F%2Fead.nb.admin.ch%2Fweb%2Fswiss-serials%2Fanzeigetop_fr.htm&footer=http%3A%2F%2Fead.nb.admin.ch%2Fweb%2Fswiss-serials%2Fanzeigemail_fr.htm&lang=de&zeiten=nein&kvk-session=08CSUG05&flexpositon_start=1&RERO=&DEUTSCHSCHWEIZ=&WEITERE=&kataloge=CHZK_FRIB&kataloge=CHZK_GENF&kataloge=CHZK_RCBN&kataloge=CHZK_VALAIS&kataloge=CHZK_VAUD&kataloge=CHZK_BASEL&kataloge=CHZK_LUZERN&kataloge=CHZK_STGALLEN&kataloge=ZUERICH&kataloge=CHZK_NEBIS&kataloge=ALEXANDRIA&kataloge=CHZK_BGR&kataloge=HELVETICAT&kataloge=CHZK_SBT&kataloge=CHZK_SGBN&kataloge=LIECHTENSTEIN&kataloge=CHZK_CERN&kataloge=VKCH_KUNSTHAUS&kataloge=CHZK_RPVZ&ALL=&SE=&VORT=&CI=&SS=XISSNX&target=_blank&Timeout=120&inhibit_redirect=1', 1, 0, 0, 0, 0, 0, 0, 0, 'LIB1', 1),
(24, 'Doctor-Doc', 'http://www.doctor-doc.com/version1.0/daia.do?issn=XISSNX', 1, 0, 0, 0, 0, 0, 0, 0, 'LIB1', 1),
(25, 'ZDB', 'http://dispatch.opac.ddb.de/DB=1.1/SET=1/TTL=1/CMD?ACT=SRCH&IKT=8508&TRM=XTITLEX', 0, 0, 1, 0, 0, 0, 0, 0, 'LIB1', 1),
(26, 'Ulrichs', 'http://ulrichsweb.com/ulrichsweb/Search/ViewSearchResults.asp?navPage=1&SortOrder=Asc&SortField=f_display_title&collection=SERIAL&QueryMode=Simple&ScoreThreshold=0&ResultCount=25&ResultTemplate=quickSearchResults.hts&QueryText=sn=XISSNX', 1, 0, 0, 0, 0, 0, 0, 0, 'LIB1', 1),
(27, 'perUnil', 'http://www2.unil.ch/perunil/search.php?allfields=&title=&search=advanced&field=title&publisher=&issn=XISSNX&format=all&accessunil=1&accesslibre=1&sujet=&platform=&licence=&statut=&localisation=&cote=', 1, 0, 0, 0, 0, 0, 0, 0, 'LIB1', 1),
(28, 'RP/VZ', 'http://links.admin.ch/cgi-bin/gw/chameleon?search=KEYWORD&rootsearch=KEYWORD&function=INITREQ&SourceScreen=HOLDINGSCR&skin=rpvz&conf=.%2fchameleon.conf&lng=fr-ch&itemu1=8&scant1=&scanu1=4&pos=1&prevpos=1&beginsrch=1&u1=4&t1=XTITLEX', 0, 0, 1, 0, 0, 0, 0, 0, 'LIB1', 1),
(29, 'Helveticat', 'http://links.admin.ch/cgi-bin/gw/chameleon?search=KEYWORD&function=INITREQ&skin=helveticat&lng=fr-ch&inst=consortium&conf=.%2fchameleon.conf&u1=1035&op1=0&t2=p&u2=8701&pos=1&rootsearch=KEYWORD&t1=XTITLEX', 0, 0, 1, 0, 0, 0, 0, 0, 'LIB1', 1),
(30, 'RERO CC', 'http://opac.rero.ch/gateway?function=INITREQ&search=SCAN&rootsearch=SCAN&u1=2019&t1=XTITLEX', 0, 0, 1, 0, 0, 0, 0, 0, 'LIB1', 1),
(31, 'RERO VD', 'http://opac.rero.ch/gateway?skin=vd&function=INITREQ&search=SCAN&rootsearch=SCAN&u1=2019&t1=XTITLEX', 0, 0, 1, 0, 0, 0, 0, 0, 'LIB1', 1),
(32, 'IDS', 'http://ml.metabib.ch/V/?func=quick-1-check1&mode=advanced&find_request_1=&find_code_2=WRD&find_op_1=AND&find_code_3=WRD&find_request_3=&group_number=000002060&find_request_2=XTITLEX', 0, 0, 1, 0, 0, 0, 0, 0, 'LIB1', 1),
(33, 'Swiss Serials', 'http://www.ubka.uni-karlsruhe.de/hylib-bin/kvk/nph-kvk2.cgi?maske=chzk&timeout=120&title=Portail+suisse+des+p%E9riodiques+%28PSP%29+%3A+Liste+des+R%E9sultats&header=http%3A%2F%2Fead.nb.admin.ch%2Fweb%2Fswiss-serials%2Fanzeige_fr.htm&spacer=http%3A%2F%2Fead.nb.admin.ch%2Fweb%2Fswiss-serials%2Fanzeigetop_fr.htm&footer=http%3A%2F%2Fead.nb.admin.ch%2Fweb%2Fswiss-serials%2Fanzeigemail_fr.htm&lang=de&zeiten=nein&kvk-session=08CSUG05&flexpositon_start=1&RERO=&DEUTSCHSCHWEIZ=&WEITERE=&kataloge=CHZK_FRIB&kataloge=CHZK_GENF&kataloge=CHZK_RCBN&kataloge=CHZK_VALAIS&kataloge=CHZK_VAUD&kataloge=CHZK_BASEL&kataloge=CHZK_LUZERN&kataloge=CHZK_STGALLEN&kataloge=ZUERICH&kataloge=CHZK_NEBIS&kataloge=ALEXANDRIA&kataloge=CHZK_BGR&kataloge=HELVETICAT&kataloge=CHZK_SBT&kataloge=CHZK_SGBN&kataloge=LIECHTENSTEIN&kataloge=CHZK_CERN&kataloge=VKCH_KUNSTHAUS&kataloge=CHZK_RPVZ&ALL=&SE=XTITLEX&VORT=&CI=&SS=&target=_blank&Timeout=120&inhibit_redirect=1', 0, 0, 1, 0, 0, 0, 0, 0, 'LIB1', 1),
(34, 'Doctor-Doc', 'http://www.doctor-doc.com/version1.0/daia.do?jtitle=XTITLEX', 0, 0, 1, 0, 0, 0, 0, 0, 'LIB1', 1),
(35, 'Ulrichs', 'http://ulrichsweb.com/ulrichsweb/Search/ViewSearchResults.asp?navPage=1&SortOrder=Asc&SortField=f_display_title&collection=SERIAL&QueryMode=Simple&ScoreThreshold=0&ResultCount=25&ResultTemplate=quickSearchResults.hts&QueryText=kt=XTITLEX', 0, 0, 1, 0, 0, 0, 0, 0, 'LIB1', 1),
(36, 'NLM', 'http://www.ncbi.nlm.nih.gov/sites/entrez?Db=nlmcatalog&Cmd=DetailsSearch&Term=XTITLEX', 0, 0, 1, 1, 0, 0, 0, 0, 'LIB1', 1),
(37, 'Google', 'http://www.google.ch/search?hl=fr&newwindow=1&q=%22XTITLEX%22', 0, 0, 1, 1, 0, 0, 0, 0, 'LIB1', 1),
(38, 'Amazon', 'http://www.amazon.com/s/ref=nb_sb_noss?url=search-alias%3Dstripbooks&field-keywords=XTITLEX', 0, 0, 0, 1, 0, 0, 0, 0, 'LIB1', 1),
(39, 'SAPHIR', 'http://www.saphirdoc.ch/ListRecord.htm?idinlist=0&list=request&NumReq=101912492919&objecttype_03Adresse=on&objecttype_03Annuaire=on&objecttype_03Article=on&objecttype_03Dossier=on&objecttype_03Multim%25E9dia=on&objecttype_03Publication=on&objecttype_03Site%2Bweb=on&oper_1=3&oper_2=20000000&inselect=0&cluster_2=XTITLEX', 0, 0, 0, 1, 0, 0, 0, 0, 'LIB1', 1),
(40, 'RERO', 'http://opac.rero.ch/gateway?function=INITREQ&search=SCAN&rootsearch=SCAN&u1=4&t1=XTITLEX', 0, 0, 0, 1, 0, 0, 0, 0, 'LIB1', 1),
(41, 'IDS', 'http://ml.metabib.ch/V/?func=quick-1-check1&mode=advanced&find_request_1=&find_code_2=WRD&find_op_1=AND&find_code_3=WRD&find_request_3=&group_number=000002060&find_request_2=XTITLEX', 0, 0, 0, 1, 0, 0, 0, 0, 'LIB1', 1),
(43, 'Zurich 100', 'forms.php?form=zu100&my_customer_code=[my_zu100_code]&my_customer_name=[my_customer_name]&my_contact_name=[my_contact_name]&my_contact_phone=[my_contact_phone]&my_contact_email=[my_contact_email]&my_contact_address=[my_contact_address]&my_contact_city=[my_contact_city]&my_contact_cp=[my_contact_cp]&my_contact_cowntry=[my_contact_cowntry]', 0, 0, 0, 0, 0, 0, 1, 0, 'LIB1', 1),
(44, 'NLM', 'forms.php?form=nlm&my_customer_code=[my_nlm_code]&my_customer_name=[my_library_name]&my_contact_first_name=[my_contact_first_name]&my_contact_last_name=[my_contact_last_name]&my_contact_phone=[my_contact_phone]&my_contact_email=[my_contact_email]&my_delivery_email=[my_delivery_email]&my_price_limit=50$', 0, 0, 0, 0, 0, 0, 1, 0, 'LIB1', 1),
(45, 'SUBITO', 'http://www.subito-doc.de/order/openurl.php?sid=[my_subito_broker_id]:[my_subito_customer_code]%2F[my_subito_password]', 0, 0, 0, 0, 0, 1, 0, 1, 'LIB1', 1),
(46, 'ILL RERO', 'http://falbala.rero.ch/cgi-bin/WebObjects/ILLForm.woa/wa/LoginFromChameleon/menu?lang=fr-ch&genre=XGENREX&issn=XISSNX&btitle=XTITLEX&jtitle=XTITLEX&volume=XVOLUMEX&issue=XISSUEX&date=XDATEX&spage=XPAGESX&atitle=XATITLEX&aulast=XAULASTX', 0, 0, 0, 0, 0, 1, 0, 0, 'LIB1', 1);

-- --------------------------------------------------------

--
-- Structure de la table `localizations`
--

CREATE TABLE IF NOT EXISTS `localizations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `library` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name1` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name2` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name3` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name4` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name5` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=26 ;

--
-- Contenu de la table `localizations`
--

INSERT INTO `localizations` (`id`, `code`, `library`, `name1`, `name2`, `name3`, `name4`, `name5`) VALUES
(1, 'LIB1', 'LIB1', 'Bibliothèque centrale', 'Central Library', 'Central Library', 'Central Library', 'Central Library'),
(2, 'LIB1_A', 'LIB1', 'Bibliothèque centrale : Archives', 'Central Library : Archive', 'Central Library : Archive', 'Central Library : Archive', 'Central Library : Archive'),
(3, 'LIB1_B', 'LIB1', 'Bibliothèque centrale : Salle du libre accès', 'Central Library : Open access room', 'Central Library : Open access room', 'Central Library : Open access room', 'Central Library : Open access room'),
(4, 'LIB1_C', 'LIB1', 'Bibliothèque centrale : Compactus', 'Central Library : Compactus', 'Central Library : Compactus', 'Central Library : Compactus', 'Central Library : Compactus'),
(5, 'LIB1_D', 'LIB1', 'Bibliothèque centrale : Dépôt', 'Central Library : Deposit', 'Central Library : Deposit', 'Central Library : Deposit', 'Central Library : Deposit'),
(6, 'LIB1_DOUBLE', 'LIB1', 'Doublon vérifié', 'Double verified', 'Double verified', 'Double verified', 'Double verified'),
(7, 'LIB1_E', 'LIB1', 'Bibliothèque centrale : Expo de nouveautés', 'Central Library : Recent issues', 'Central Library : Recent issues', 'Central Library : Recent issues', 'Central Library : Recent issues'),
(8, 'LIB1_NETWORK', 'LIB1', 'Bibliothèque centrale : Journaux électroniques sous licence', 'Central Library : Electronic Journals licensed', 'Central Library : Electronic Journals licensed', 'Central Library : Electronic Journals licensed', 'Central Library : Electronic Journals licensed'),
(9, 'LIB1_NLM', 'LIB1', 'National Library of Medicine (NLM)', 'National Library of Medicine (NLM)', 'National Library of Medicine (NLM)', 'National Library of Medicine (NLM)', 'National Library of Medicine (NLM)'),
(10, 'LIB1_P', 'LIB1', 'Bibliothèque centrale : Abonnement personnel', 'Central Library : Personnal account', 'Central Library : Personnal account', 'Central Library : Personnal account', 'Central Library : Personnal account'),
(11, 'LIB1_SUBITO', 'LIB1', 'SUBITO', 'SUBITO', 'SUBITO', 'SUBITO', 'SUBITO'),
(12, 'LIB1_WWW', 'LIB1', 'Disponible gratuitement sur le web', 'Web access free', 'Web access free', 'Web access free', 'Web access free'),
(13, 'LIB1_X', 'LIB1', 'Demande à l''auteur', 'Requested to the author', 'Requested to the author', 'Requested to the author', 'Requested to the author'),
(14, 'LIB1_Y', 'LIB1', 'Bibliothèque centrale : Salle de références', 'Central Library : Reference Room', 'Central Library : Reference Room', 'Central Library : Reference Room', 'Central Library : Reference Room'),
(15, 'LIB1_Z', 'LIB1', 'Bibliothèque centrale : salle de reliure', 'Central Library : Binding room', 'Central Library : Binding room', 'Central Library : Binding room', 'Central Library : Binding room'),
(16, 'LIB2_A', 'LIB2', 'Bibliothèque de l''institut XYZ', 'Library of XYZ institute', 'Library of XYZ institute', 'Library of XYZ institute', 'Library of XYZ institute'),
(17, 'LIB2_B', 'LIB2', 'Bibliothèque de l''institut XYZ : Archives', 'Library of XYZ institute : Archives', 'Library of XYZ institute : Archives', 'Library of XYZ institute : Archives', 'Library of XYZ institute : Archives'),
(18, 'LIB3_A', 'LIB3', 'Bibliothèque de l''institut ABC', 'Library of ABC institute', 'Library of ABC institute', 'Library of ABC institute', 'Library of ABC institute'),
(19, 'LIB3_SCAN', 'LIB3', 'Bibliothèque de l''institut ABC : Scan', 'Library of ABC institute : Scan', 'Library of ABC institute : Scan', 'Library of ABC institute : Scan', 'Library of ABC institute : Scan'),
(20, 'LIB4_A', 'LIB4', 'Bibliothèque de la faculté JKL', 'Library of JKL faculty', 'Library of JKL faculty', 'Library of JKL faculty', 'Library of JKL faculty'),
(21, 'LIB5_A', 'LIB5', 'Bibliothèque de la faculté MNO', 'Library of MNO faculty', 'Library of MNO faculty', 'Library of MNO faculty', 'Library of MNO faculty'),
(22, 'LIB5_B', 'LIB5', 'Bibliothèque de la faculté MNO : Archives', 'Library of MNO faculty : Archives', 'Library of MNO faculty : Archives', 'Library of MNO faculty : Archives', 'Library of MNO faculty : Archives'),
(23, 'LIB6_A', 'LIB6', 'Bibliothèque de la faculté PQR', 'Library of PQR faculty', 'Library of PQR faculty', 'Library of PQR faculty', 'Library of PQR faculty'),
(24, 'LIB7_A', 'LIB7', 'Bibliothèque de la faculté STU', 'Library of STU faculty', 'Library of STU faculty', 'Library of STU faculty', 'Library of STU faculty'),
(25, 'LIB7_X', 'LIB7', 'Bibliothèque de la faculté STU : Compactus', 'Library of STU faculty : Compactus', 'Library of STU faculty : Compactus', 'Library of STU faculty : Compactus', 'Library of STU faculty : Compactus');

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `illinkid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `stade` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `localisation` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `sid` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pid` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `envoye` date DEFAULT NULL,
  `facture` date DEFAULT NULL,
  `renouveler` date DEFAULT NULL,
  `prix` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prepaye` char(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ref` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `arrivee` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nom` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `prenom` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `service` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cgra` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cgrb` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mail` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adresse` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code_postal` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `localite` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type_doc` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `urgent` char(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `envoi_par` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `titre_periodique` text COLLATE utf8_unicode_ci NOT NULL,
  `annee` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `volume` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numero` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `supplement` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pages` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `titre_article` text COLLATE utf8_unicode_ci,
  `auteurs` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `edition` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isbn` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `issn` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `eissn` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `doi` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uid` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remarques` text COLLATE utf8_unicode_ci,
  `remarquespub` text COLLATE utf8_unicode_ci,
  `historique` text COLLATE utf8_unicode_ci,
  `saisie_par` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bibliotheque` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `refinterbib` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PMID` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `referer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`illinkid`),
  KEY `bibliotheque` (`bibliotheque`),
  KEY `stade` (`stade`),
  KEY `localisation` (`localisation`),
  KEY `date` (`date`),
  KEY `cgra` (`cgra`),
  KEY `nom` (`nom`,`prenom`),
  KEY `mail` (`mail`),
  KEY `service` (`service`),
  KEY `annee` (`annee`),
  KEY `volume` (`volume`),
  KEY `pages` (`pages`),
  KEY `ref` (`ref`),
  KEY `sid` (`sid`,`pid`),
  KEY `isbn` (`isbn`),
  KEY `issn` (`issn`,`eissn`),
  KEY `ui` (`uid`,`doi`,`PMID`),
  KEY `renouveler` (`renouveler`),
  FULLTEXT KEY `titre_periodique` (`titre_periodique`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Contenu de la table `orders`
--

INSERT INTO `orders` (`illinkid`, `stade`, `localisation`, `sid`, `pid`, `date`, `envoye`, `facture`, `renouveler`, `prix`, `prepaye`, `ref`, `arrivee`, `nom`, `prenom`, `service`, `cgra`, `cgrb`, `mail`, `tel`, `adresse`, `code_postal`, `localite`, `type_doc`, `urgent`, `envoi_par`, `titre_periodique`, `annee`, `volume`, `numero`, `supplement`, `pages`, `titre_article`, `auteurs`, `edition`, `isbn`, `issn`, `eissn`, `doi`, `uid`, `remarques`, `remarquespub`, `historique`, `saisie_par`, `bibliotheque`, `refinterbib`, `PMID`, `ip`, `referer`) VALUES
(1, 2, 'LIB1_B', NULL, NULL, '2012-01-01', '2012-01-03', '0000-00-00', '0000-00-00', '', '', '', 'publicform', 'Merdwrieva', 'Marie', 'DAR', '', '', 'Marie.Merdwrieva@univxyz.com', '', '', '', '', 'article', '2', 'mail', 'Acta neuropathologica', '1993', '86', '3', '', '215', 'Posterior cortical atrophy in Alzheimer''s disease: analysis of a new case and re-evaluation of a historical report', 'Hof', '', '', '0001-6322', '', '', '', '', NULL, 'Commande saisie par 224.654.248.71 le 01/01/2012 15:16:36<br /> Commande modifiée par User XYZ le 02/01/2012 16:15:37 [localisation - stade - ]<br /> Commande modifiée par Gerard Dubois le 03/01/2012 09:23:37 [stade - ]', '224.654.248.71', 'LIB1', '', '', '224.654.7.44', 'http%3A%2F%2Fsfx.univxyz.com%2Fsfx_local%3Fsid%3Dgoogle%26auinit%3DPR%26aulast%3DHof%26atitle%3DPosterior%2Bcortical%2Batrophy%2Bin%2BAlzheimer%2527s%2Bdisease%3A%2Banalysis%2Bof%2Ba%2Bnew%2Bcase%2Band%2Bre-evaluation%2Bof%2Ba%2Bhistorical%2Breport%26titl'),
(2, 2, 'LIB1_Y', NULL, NULL, '2012-01-01', '2012-01-03', '0000-00-00', '0000-00-00', '', '', '', 'publicform', 'Merdwrieva', 'Marie', 'DAR', '', '', 'Marie.Merdwrieva@univxyz.com', '', '', '', '', 'article', '2', 'mail', 'Anatomy and embryology', '1993', '187', '6', '', '515', 'Layer V pyramidal cells in the adult human cingulate cortex', 'Schlaug', '', '', '0340-2061', '', '', '', '', NULL, 'Commande saisie par 224.654.248.71 le 01/01/2012 15:44:19<br /> Commande modifiée par Isabelle de Kaenel le 02/01/2012 16:01:06 [stade - localisation - ]<br /> Commande modifiée par Gerard Dubois le 03/01/2012 14:58:52 [stade - ]', '224.654.248.71', 'LIB1', '', '', '224.654.7.44', 'http%3A%2F%2Fsfx.univxyz.com%2Fsfx_local%3Fsid%3Dgoogle%26auinit%3DG%26aulast%3DSchlaug%26atitle%3DLayer%2BV%2Bpyramidal%2Bcells%2Bin%2Bthe%2Badult%2Bhuman%2Bcingulate%2Bcortex%26title%3DAnatomy%2Band%2Bembryology%26volume%3D187%26issue%3D6%26date%3D1993%'),
(3, 3, 'LIB1_Z', NULL, NULL, '2012-01-01', '2012-01-10', '2012-01-25', '0000-00-00', '', '', '', 'publicform', 'Merdwrieva', 'Marie', 'DAR', '', '', 'Marie.Merdwrieva@univxyz.com', '', '', '', '', 'book', '2', 'mail', 'Cingulate neurobiology and disease', '2009', '', '', '', '', '', 'Vogt BA', '', '', '', '', '', '', '', NULL, 'Commande saisie par 224.654.248.75 le 01/01/2012 18:21:25<br /> Commande modifiée par Gerard Dubois le 03/01/2012 09:49:14 [stade - localisation - ]<br /> Commande modifiée par Gerard Dubois le 10/01/2012 14:59:03 [stade - ]<br /> Commande modifiée par Marc Laurel le 25/01/2012 17:21:33 [stade - ]', '224.654.248.75', 'LIB1', '', '', '224.654.7.44', 'http%3A%2F%2Fsfx.univxyz.com%2Fsfx_local%3Fsid%3Dgoogle%26auinit%3DZ%26aulast%3DLi%26atitle%3DIncreased%2B%25E2%2580%259Cdefault%2Bmode%25E2%2580%259D%2Bactivity%2Bin%2Badolescents%2Bprenatally%2Bexposed%2Bto%2Bcocaine%26title%3DHuman%2Bbrain%2Bmapping%26'),
(4, 2, 'LIB1_A', NULL, NULL, '2012-01-02', '2012-01-03', '0000-00-00', '0000-00-00', '', '', '', 'publicform', 'Gstzuirer', 'Marc', 'GLN', '', '', 'marc.gstzuirer@univxyz.com', '34674', '', '', '', 'article', '2', 'mail', 'Neurology', '1983', '33', '12', '', '1573-83', 'The anatomic basis of pure alexia.', 'Damasio AR', '', '', '0028-3878', '', '', 'pmid:6685830', 'pdf fait', NULL, 'Commande saisie par 224.654.7.44 le 02/01/2012 00:03:31<br /> Commande modifiée par Anissa Djeddou le 02/01/2012 16:13:14 [localisation - stade - ]<br /> Commande modifiée par Gerard Dubois le 03/01/2012 09:59:24 [remarques - ]<br /> Commande modifiée par Gerard Dubois le 03/01/2012 11:22:24 [stade - ]', '224.654.7.44', 'LIB1', '', '6685830', '224.654.7.44', ''),
(5, 2, 'LIB1_SUBITO', NULL, NULL, '2012-01-02', '2012-01-03', '0000-00-00', '0000-00-00', '', '', 'SUBITO:LG12010300351', 'publicform', 'Grossz', 'Sandra', 'URG', 'URG123', '', 'Sandra.Grossz@univxyz.com', '', 'Victoria Ruffie 77', '2454', 'Lausanne', 'article', '2', 'mail', 'Journal of gerontological nursing', '2004', '30', '6', '', '10-5; quiz 52-3', 'The transition of elderly patients between hospitals and nursing homes. Improving nurse-to-nurse communication.', 'Cortes TA', '', '', '0098-9134', '', '', 'pmid:15227932 ', '', NULL, 'Commande saisie par 178.198.138.121 le 02/01/2012 15:08:17<br /> Commande modifiée par Gerard Dubois le 03/01/2012 09:29:05 [ref ecrassee par PMID - email - service - ]<br /> Commande modifiée par Gerard Dubois le 03/01/2012 09:30:47 [stade - ref fournisseur - localisation - ]<br /> Commande modifiée par Gerard Dubois le 03/01/2012 12:06:02 [stade - ]', '178.198.138.121', 'LIB1', '', '15227932 ', '224.654.7.44', 'http%3A%2F%2Fwww.univxyz.com%2Fopenillink%2Fneworder.php'),
(6, 2, 'LIB1_WWW', NULL, NULL, '2012-01-02', '2012-01-03', '0000-00-00', '0000-00-00', '', '', '', 'publicform', 'Grossz', 'Sandra', 'URG', 'URG123', '', 'Sandra.Grossz@univxyz.com', '', 'Victoria Ruffie 77', '2454', 'Lausanne', 'article', '2', 'mail', 'Journal of advanced nursing', '1997', '26', '5', '', '864-71', 'The transition to nursing home life: a comparison of planned and unplanned admissions.', 'Wilson SA', '', '', '0309-2402', '', '', 'pmid:9372389', '', NULL, 'Commande saisie par 178.198.138.121 le 02/01/2012 15:25:05<br /> Commande modifiée par Anissa Djeddou le 02/01/2012 16:11:58 [localisation - stade - ]<br /> Commande modifiée par Gerard Dubois le 03/01/2012 09:22:19 [stade - ]<br /> Commande modifiée par Gerard Dubois le 03/01/2012 09:22:54 [email - service - cgra - ]', '178.198.138.121', 'LIB1', '', '9372389', '224.654.7.44', 'http%3A%2F%2Fwww.univxyz.com%2Fopenillink%2Fneworder.php'),
(7, 2, 'LIB1_Z', NULL, NULL, '2012-01-02', '2012-01-03', '0000-00-00', '0000-00-00', '', '', '', 'publicform', 'Fritzjdue', 'Fernand', 'Nursing Pole', '', '', 'fernand.fritzjdue@univxyz.com', '', 'avenue du vin 75', '1124', 'Lausanne', 'article', '2', 'mail', 'The Nursing clinics of North America', '2011', '46', '3', '', '321-33, vi-vii', 'Promoting health literacy: a nursing imperative.', 'Speros', '', '', '0029-6465', '1558-1357', '', 'pmid:21791267', '', NULL, 'Commande saisie par 224.654.7.44 le 02/01/2012 16:12:44<br /> Commande modifiée par Anissa Djeddou le 02/01/2012 16:14:18 [email - ]<br /> Commande modifiée par Gerard Dubois le 03/01/2012 10:35:30 [stade - localisation - ]<br /> Commande modifiée par Gerard Dubois le 03/01/2012 11:36:48 [stade - ]', '224.654.7.44', 'LIB1', '', '21791267', '224.654.7.44', 'http%3A%2F%2Flinksolver.ovid.com%2FOpenUrl%2FLinkSolver%3Fsid%3DEntrez%3APubMed%26id%3Dpmid%3A21791267'),
(8, 2, 'LIB1_SUBITO', NULL, NULL, '2012-01-02', '2012-01-10', '0000-00-00', '2012-01-10', '', '', 'SUBITO:LG12011000467', 'publicform', 'Fritzjdue', 'Fernand', 'Nursing Pole', '', '', 'fernand.fritzjdue@univxyz.com', '', 'avenue du vin 75', '1124', 'Lausanne', 'article', '2', 'mail', 'Holistic nursing practice', '2010', '24', '4', '', '204-12', 'The concept of health literacy within the older adult population.', 'Oldfield SR, Dreher HM.', '', '', '0887-9311', '', '', 'pmid:20588129', 'écrit le 3.1 à etieurted@wrteint.edu', NULL, 'Commande saisie par 224.654.7.44 le 02/01/2012 16:19:51<br /> Commande modifiée par Gerard Dubois le 03/01/2012 10:34:45 [stade - renouveler - localisation - ref ecrassee par PMID - remarques - auteurs - ]<br /> Commande modifiée par Gerard Dubois le 03/01/2012 11:30:34 [remarques - stade - ]<br /> Commande modifiée par Gerard Dubois le 03/01/2012 11:33:34 [renouveler - ]<br /> Commande modifiée par Gerard Dubois le 10/01/2012 09:35:01 [stade - ref fournisseur - localisation - ]<br /> Commande modifiée par Gerard Dubois le 10/01/2012 15:41:20 [stade - ]', '224.654.7.44', 'LIB1', '', '20588129', '224.654.7.44', 'http%3A%2F%2Flinksolver.ovid.com%2FOpenUrl%2FLinkSolver%3Fsid%3DEntrez%3APubMed%26id%3Dpmid%3A20588129'),
(9, 2, 'LIB1_B', NULL, NULL, '2012-01-03', '2012-01-03', '0000-00-00', '0000-00-00', '', '', '', 'publicform', 'Nielsend', 'Gerald', 'HCN', '', '', 'gerald.nielsend@univxyz.com', '', '', '', '', 'article', '2', 'surplace', 'The Journal of nursing education', '2002', '41', '1', '', '25-31', 'A new perspective on competencies for self-directed learning.', 'Patterson', '', '', '0148-4834', '', '', '', '', NULL, 'Commande saisie par 224.654.7.43 le 03/01/2012 00:28:53<br /> Commande modifiée par Gerard Dubois le 03/01/2012 10:31:52 [stade - localisation - ]<br /> Commande modifiée par Gerard Dubois le 03/01/2012 11:53:19 [stade - ]', '224.654.7.43', 'LIB1', '', '', '224.654.7.44', 'http%3A%2F%2Fwww.univxyz.com%2Fopenillink%2Fopenlinker%2F%3Ftid%3Dpmid%26uids%3D%26aulast%3DPatterson%26atitle%3DA%2Bnew%2Bperspective%2Bon%2Bcompetencies%2Bfor%2Bself-directed%2Blearning.%26title%3DThe%2BJournal%2Bof%2Bnursing%2Beducation%26date%3D2002%2'),
(10, 2, 'LIB7_X', NULL, NULL, '2012-01-03', '2012-01-03', '0000-00-00', '0000-00-00', '', '', 'SUBITO:LE145341233453', '', 'Guerrero', 'Marco', 'IUXYZSP', '', '', 'Marco.Guerrero@univxyz.com', '', '', '', '', 'article', '2', 'mail', 'Epigenomics', '2011', '3', '4', '', '503-518', 'Epigenetic diet: impact on the epigenome and cancer', 'Hardy Tabitha M', '', '', '1750-1911', '', '', 'DOI:10.2217/epi.11.71', 'Facture subito C4534523-234625\r\n', NULL, 'Commande saisie par Franco Josquin le 03/01/2012 07:30:43<br /> Commande modifiée par Franco Josquin le 03/01/2012 07:33:51 [ref fournisseur - stade - localisation - ]<br /> Commande modifiée par Franco Josquin le 03/01/2012 15:40:08 [stade - ref fournisseur - ]<br /> Commande modifiée par Franco Josquin le 16/02/2012 14:02:11 [remarques - ]', 'Franco Josquin', 'LIB8', '', '', '224.654.7.44', 'http%3A%2F%2Fwww.univxyz.com%2Fopenillink%2Fin.php'),
(11, 4, 'LIB1_DOUBLE', NULL, NULL, '2012-01-03', '0000-00-00', '0000-00-00', '0000-00-00', '', '', '', 'publicform', 'Dupont', 'Pierre', 'THCX', '', '', 'pierre.dupont@univxyz.com', '', '', '', '', 'article', '2', 'mail', 'Medical progress through technology', '1994', '20', '3-4', '', '231-42', 'Evaluation of the Omniflow collagen-polymer vascular prosthesis.', 'Werkmeister', '', '', '0047-6552', '', '', 'pmid:7877568', 'ATTENTION POSSIBLE DOUBLON DE LA COMMANDE 92276 oui, erreur de saisie', NULL, 'Commande saisie par 224.654.7.44 le 03/01/2012 13:29:25<br /> Commande modifiée par Gerard Dubois le 03/01/2012 13:40:27 [remarques - stade - localisation - ]<br /> Commande modifiée par Gerard Dubois le 03/01/2012 16:25:39 [stade - remarques - ]', '224.654.7.44', 'LIB1', '', '7877568', '224.654.7.43', 'http%3A%2F%2Flinksolver.ovid.com%2FOpenUrl%2FLinkSolver%3Fsid%3DEntrez%3APubMed%26id%3Dpmid%3A7877568'),
(12, 4, 'LIB3_A', NULL, NULL, '2012-01-03', '0000-00-00', '0000-00-00', '0000-00-00', '', '', '', '', 'Ansirmet', 'Michel', 'NCP', 'NCP456', '', 'Michel.Ansirmet@univxyz.com', '', '', '', '', 'article', '2', 'mail', 'The Journal of clinical psychiatry', '1989', '50', '11', '', '424-7', 'Chlorprothixene-induced hypouricemia: a biologic indicator of drug compliance.', 'Shalev', '', '', '0160-6689', '1555-2101,1096-0104', '', 'pmid:2808309', '', NULL, 'Commande saisie par Vera Bort le 03/01/2012 14:06:43', 'James Abbot', 'LIB3', '', '2808309', '224.654.7.43', 'http%3A%2F%2Flinksolver.ovid.com%2FOpenUrl%2FLinkSolver%3Fsid%3DEntrez%3APubMed%26id%3Dpmid%3A2808309'),
(13, 4, 'LIB3_A', NULL, NULL, '2012-01-03', '0000-00-00', '0000-00-00', '0000-00-00', '', '', '', '', 'Ansirmet', 'Michel', 'NCP', 'NCP3457A', '', 'Michel.Ansirmet@univxyz.com', '', '', '', '', 'article', '2', 'mail', 'Acta psychiatrica Scandinavica. Supplementum', '1974', '255', '', '', '71-4', 'Plasma levels of chlorprothixene in alcoholics.', 'Mattsson', '', '', '0065-1591', '1600-5473', '', 'pmid:4533717', '', NULL, 'Commande saisie par Vera Bort le 03/01/2012 14:08:45', 'James Abbot', 'LIB3', '', '4533717', '224.654.7.43', 'http%3A%2F%2Flinksolver.ovid.com%2FOpenUrl%2FLinkSolver%3Fsid%3DEntrez%3APubMed%26id%3Dpmid%3A4533717'),
(14, 9, 'LIB1_E', NULL, NULL, '2012-01-05', '0000-00-00', '0000-00-00', '2012-04-15', '', '', '', 'publicform', 'Niegger', 'Lin', 'EXT_MEDECIN', '', '', 'cabinet.niegger@dzuaozer.com', '', '', '', '', 'article', '2', 'mail', 'Current pharmaceutical biotechnology', '2011', 'Jul 8', '', '', 'Epub ahead of print', 'In Search of a Consensus Terminology in the Field of Platelet Concentrates for Surgical Use: Platelet-Rich Plasma (PRP), Platelet-Rich Fibrin (PRF), Fibrin Gel Polymerization and Leukocytes.', 'Dohan Ehrenfest DM', '', '', '1389-2010', '', '', 'pmid:21740379', 'écrit le 9.1 à:tr346@treiu.com > non, il ne l''a pas: attendre, tjrs ahead le 23.1, idem le 6.2, idem le 1.3, idem le 15.3, idem le 30.3, attendre', NULL, 'Commande saisie par 85.3.79.229 le 05/01/2012 19:16:43<br /> Commande modifiée par Marc Laurel le 09/01/2012 09:14:41 [volume - ]<br /> Commande modifiée par Marc Laurel le 09/01/2012 09:16:12 [remarques - stade - localisation - renouveler - ]<br /> Commande modifiée par Mary Kingston le 09/01/2012 10:27:32 [stade - stade - remarques - ]<br /> Commande modifiée par Marc Laurel le 09/01/2012 13:49:38 [remarques - ]<br /> Commande modifiée par Marc Laurel le 09/01/2012 13:49:58 [remarques - ]<br /> Commande modifiée par Marc Laurel le 09/01/2012 13:50:50 [remarques - renouveler - ]<br /> Commande modifiée par Gerard Dubois le 23/01/2012 09:39:37 [remarques - renouveler - ]<br /> Commande modifiée par Gerard Dubois le 30/01/2012 08:43:44 [renouveler - ]<br /> Commande modifiée par Gerard Dubois le 06/02/2012 16:14:08 [renouveler - remarques - ]<br /> Commande modifiée par Marc Laurel le 01/03/2012 12:29:26 [remarques - ]<br /> Commande modifiée par Marc Laurel le 01/03/2012 12:29:33 [renouveler - ]<br /> Commande modifiée par Marc Laurel le 15/03/2012 10:12:09 [remarques - renouveler - ]<br /> Commande modifiée par Marc Laurel le 30/03/2012 09:10:50 [renouveler - remarques - ]', '85.3.79.229', 'LIB1', '', '21740379', '224.654.7.44', 'http%3A%2F%2Fwww.univxyz.com%2Fopenillink%2Fneworder.php'),
(15, 9, 'LIB1_E', NULL, NULL, '2012-01-08', '0000-00-00', '0000-00-00', '2012-04-15', '', '', '', 'publicform', 'Niegger', 'Lin', 'EXT_MEDECIN', '', '', 'cabinet.niegger@dzuaozer.com', '', '', '', '', 'article', '2', 'mail', 'Current pharmaceutical biotechnology', '2011', 'Jul 8', '', '', 'Epub ahead of print', 'Sports Medicine Applications of Platelet Rich Plasma.', 'Mishra A, Harmon K, Woodall J, Vieira A.', '', '', '1389-2010', '', '', 'pmid:21740373', 'écrit le 9.1 à: am453@gratrezu.com, tjrs ahead le 23.1, idem le 6.2, idem le 1.3, idem le 15.3, idem le 30.3, attendre\r\n', NULL, 'Commande saisie par 188.62.220.105 le 08/01/2012 21:19:25<br /> Commande modifiée par Marc Laurel le 09/01/2012 14:15:27 [volume - ]<br /> Commande modifiée par Marc Laurel le 09/01/2012 14:16:50 [remarques - stade - localisation - renouveler - ]<br /> Commande modifiée par Gerard Dubois le 18/01/2012 08:48:17 [auteurs - ]<br /> Commande modifiée par Marc Laurel le 18/01/2012 11:07:10 [renouveler - ]<br /> Commande modifiée par Gerard Dubois le 23/01/2012 09:38:41 [renouveler - remarques - ]<br /> Commande modifiée par Gerard Dubois le 30/01/2012 08:44:01 [renouveler - ]<br /> Commande modifiée par Gerard Dubois le 06/02/2012 16:13:29 [renouveler - remarques - ]<br /> Commande modifiée par Gerard Dubois le 06/02/2012 16:14:27 [renouveler - ]<br /> Commande modifiée par Marc Laurel le 01/03/2012 12:29:59 [renouveler - remarques - ]<br /> Commande modifiée par Marc Laurel le 15/03/2012 10:14:45 [renouveler - remarques - ]<br /> Commande modifiée par Marc Laurel le 30/03/2012 09:09:51 [remarques - renouveler - ]', '188.62.220.105', 'LIB1', '', '21740373', '224.654.7.44', 'http%3A%2F%2Fwww.univxyz.com%2Fopenillink%2Fneworder.php'),
(16, 9, 'LIB7_A', NULL, NULL, '2012-01-09', '0000-00-00', '0000-00-00', '2012-05-10', '', '', '', '', 'Joss', 'Friederich', 'IUXYZSP', '', '', 'Friederich.Joss@univxyz.com', '', '', '', '', 'article', '2', 'mail', 'Clinical rehabilitation', '2011', '', '', '', '', 'Early mobilization out of bed after ischaemic stroke reduces severe complications but not cerebral blood flow: a randomized controlled pilot trial.', 'Diserens K', '', '', '0269-2155', '', '', 'pmid:22144725', 'POUR DI: Epub attendre la pagination pour commnder Vu MF il n''a pas le pdf', NULL, 'Commande saisie par Franco Josquin le 09/01/2012 14:44:27<br /> Commande modifiée par Franco Josquin le 10/01/2012 16:55:26 [stade - ]<br /> Commande modifiée par Franco Josquin le 24/01/2012 08:59:09 [renouveler - ]<br /> Commande modifiée par Franco Josquin le 16/02/2012 16:17:07 [renouveler - ]<br /> Commande modifiée par Franco Josquin le 14/03/2012 15:22:16 [renouveler - ]<br /> Commande modifiée par Franco Josquin le 26/03/2012 07:57:13 [renouveler - ]<br /> Commande modifiée par Franco Josquin le 12/04/2012 14:14:47 [renouveler - ]', 'Franco Josquin', 'LIB8', '', '22144725', '224.654.7.44', 'http%3A%2F%2Fwww.univxyz.com%2Fopenillink%2Fall.php'),
(17, 3, 'LIB1_NETWORK', NULL, NULL, '2012-01-11', '2012-01-25', '2012-02-03', '0000-00-00', '', '', '00556773345', 'publicform', 'Charles', 'Nicoleta', 'EXT_ENT', '', '', 'cnicoleta@debiaphorm.com', '4236 3466463 34', 'Debiaphorm SA / Ch. du Tissage', '34563', 'Lausanne', 'book', '2', 'mail', 'Système financier national et développement économique : réflexion théorique sur le choix entre une politique néo-libérale et une politique d''intervention sur les systèmes financiers des économies en retard : rejet du monétarisme', '1992', '', '', '', '', '', 'Lurati, Francesco', 'Ed. Universitaires, Fribourg', '2827105977', '', '', '', '', 'KBR\r\ncdé à subito par erreur, renvoyé tout de suite le livre subito et cdé dans rero (Mary)/ prêt > 18.2', NULL, 'Commande saisie par 212.74.146.92 le 11/01/2012 16:23:18<br /> Commande modifiée par Marc Laurel le 11/01/2012 16:45:09 [stade - ref fournisseur - localisation - ]<br /> Commande modifiée par Gerard Dubois le 23/01/2012 10:25:27 [stade - ]<br /> Commande modifiée par Gerard Dubois le 23/01/2012 11:01:40 [stade - ref fournisseur - localisation - remarques - ]<br /> Commande modifiée par Marc Laurel le 25/01/2012 17:07:21 [stade - remarques - ]<br /> Commande modifiée par Marc Laurel le 25/01/2012 17:15:12<br /> Commande modifiée par Marc Laurel le 03/02/2012 09:23:18 [stade - ]', '212.74.146.92', 'LIB1', '', '', '224.654.7.44', 'http%3A%2F%2Fwww.univxyz.com%2Fopenillink%2Fneworder.php'),
(18, 1, 'LIB1_SUBITO', NULL, NULL, '2012-01-15', '0000-00-00', '0000-00-00', '0000-00-00', '', '', 'SUBITO:2012032701440', 'publicform', 'Niegger', 'Lin', 'EXT_MEDECIN', '', '', 'cabinet.niegger@bluewon.ch', '', '', '', '', 'article', '2', 'mail', 'International journal of immunopathology and pharmacology', '2011', '24', '1 Suppl 2', '', '79-83', 'Platelet rich plasma and tendinopathy: state of the art.', 'Del Buono A', '', '', '0394-6320', '', '', 'pmid:21669143', 'recdé à mü le 27.3', NULL, 'Commande saisie par 85.3.22.72 le 15/01/2012 13:20:17<br /> Commande modifiée par Gerard Dubois le 16/01/2012 09:07:05 [stade - ref fournisseur - localisation - ]<br /> Commande modifiée par Gerard Dubois le 27/03/2012 12:37:13 [ref fournisseur - remarques - ]', '85.3.22.72', 'LIB1', '', '21669143', '224.654.7.44', 'http%3A%2F%2Fwww.univxyz.com%2Fopenillink%2Fneworder.php'),
(19, 3, 'LIB1_NETWORK', NULL, NULL, '2012-01-16', '2012-01-19', '2012-02-20', '0000-00-00', '', '', '00555303', '', 'Neuter', 'Ronald', 'STUDENT', '', '', 'ronald.neuter@bluewon.ch', '', '', '', '', 'book', '2', 'mail', 'Le cerveau pour les nuls', '2010', '', '', '', '', '', 'Sedel, Frédéric', 'Paris : First', '', '', '', '', 'RERO:R005662646', 'prêt > 13.2, prolongé jusqu''au 12.3', NULL, 'Commande saisie par Gerard Dubois le 16/01/2012 12:20:17<br /> Commande modifiée par Gerard Dubois le 16/01/2012 12:21:06 [stade - localisation - ref fournisseur - ]<br /> Commande modifiée par Marc Laurel le 19/01/2012 15:55:32 [stade - remarques - ]<br /> Commande modifiée par Marc Laurel le 19/01/2012 15:56:43 [remarques - ]<br /> Commande modifiée par Marc Laurel le 19/01/2012 15:59:44 [remarques - ]<br /> Commande modifiée par Gerard Dubois le 13/02/2012 09:36:55 [remarques - ]<br /> Commande modifiée par Gerard Dubois le 20/02/2012 08:39:43 [stade - ]', 'Gerard Dubois', 'LIB1', '', '', '224.654.7.44', 'http%3A%2F%2Fwww.univxyz.com%2Fopenillink%2Fin.php'),
(20, 3, 'LIB1_D', NULL, NULL, '2012-01-19', '2012-01-19', '2012-03-08', '0000-00-00', '', '', '', '', 'Miranda Queiros', 'Joao', 'GCP', 'GCP7384H', '', 'Joao.Miranda-Queiros@univxyz.com', '3278 42938 422', '', '', '', 'book', '2', 'mail', 'L''éthique de la santé : guide pour une intégration de l''éthique dans les pratiques infirmières', '2009 ', '', '', '', '', '', 'Saint-Arnaud, Jocelyne', '', '', '', '', '', '', 'ECVP 4398 \r\n2e cote 22.6 SAI \r\nDépôt salle HETRI > prêt fait à BUPSY jusqu''au 18.2(envoyer par navette interne)\r\n', NULL, 'Commande saisie par John Smith le 19/01/2012 13:19:37<br /> Commande modifiée par John Smith le 19/01/2012 13:20:06 [bibliotheque - ]<br /> Commande modifiée par Marc Laurel le 19/01/2012 14:36:33 [stade - localisation - ]<br /> Commande modifiée par Marc Laurel le 19/01/2012 15:04:22 [remarques - ]<br /> Commande modifiée par Marc Laurel le 19/01/2012 15:45:04 [stade - remarques - ]<br /> Commande modifiée par Marc Laurel le 08/03/2012 11:41:06 [stade - ]', 'John Smith', 'LIB3', '', '', '224.654.7.44', 'http%3A%2F%2Fwww.univxyz.com%2Fopenillink%2Fin.php');

-- --------------------------------------------------------

--
-- Structure de la table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` smallint(6) NOT NULL,
  `title1` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `help1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title2` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `help2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title3` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `help3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title4` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `help4` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title5` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `help5` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `in` tinyint(1) DEFAULT NULL,
  `out` tinyint(1) DEFAULT NULL,
  `trash` tinyint(1) DEFAULT NULL,
  `color` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `special` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `special` (`special`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Contenu de la table `status`
--

INSERT INTO `status` (`id`, `code`, `title1`, `help1`, `title2`, `help2`, `title3`, `help3`, `title4`, `help4`, `title5`, `help5`, `in`, `out`, `trash`, `color`, `special`) VALUES
(1, 0, 'Nouvelle commande', 'Nouvelle commande non traitée', 'New order', 'New norder not processed', 'New order', 'New norder not processed', 'New order', 'New norder not processed', 'New order', 'New norder not processed', 1, 0, 0, 'green', 'new'),
(2, 1, 'Commandée', 'Commande traitée et envoyée à une autre bibliothèque ou fournisseur externe et pas encore reçue', 'Ordered', 'Order is processed and sent to another library or an external supplier and not yet received', 'Ordered', 'Order is processed and sent to another library or an external supplier and not yet received', 'Ordered', 'Order is processed and sent to another library or an external supplier and not yet received', 'Ordered', 'Order is processed and sent to another library or an external supplier and not yet received', 0, 1, 0, 'black', NULL),
(3, 2, 'Reçue et envoyée au client', 'Reçue et envoyée au client à l''origine de la commande', 'Received and sent to the client', 'Received and sent to the customer at the origin of the order', 'Received and sent to the client', 'Received and sent to the customer at the origin of the order', 'Received and sent to the client', 'Received and sent to the customer at the origin of the order', 'Received and sent to the client', 'Received and sent to the customer at the origin of the order', 0, 0, 0, 'gray', 'sent'),
(4, 3, 'Soldée', 'Commande reçue, envoyée et payée par le client', 'Order paid', 'Order received, sent and paid by the customer', 'Order paid', 'Order received, sent and paid by the customer', 'Order paid', 'Order received, sent and paid by the customer', 'Order paid', 'Order received, sent and paid by the customer', 0, 0, 0, 'gray', 'paid'),
(5, 4, 'Abandonnée', 'Commande abandonnée par le client à cause du prix ou du delai', 'Order aborted', 'Order aborted by the client because of the price or delay', 'Order aborted', 'Order aborted by the client because of the price or delay', 'Order aborted', 'Order aborted by the client because of the price or delay', 'Order aborted', 'Order aborted by the client because of the price or delay', 0, 0, 1, 'purple', NULL),
(6, 5, 'Validée', 'Commande validée par la bibliothèque ou la personne responsable de l''unité', 'Order confirmed', 'Order confirmed by the library or the person responsible for the unit', 'Order confirmed', 'Order confirmed by the library or the person responsible for the unit', 'Order confirmed', 'Order confirmed by the library or the person responsible for the unit', 'Order confirmed', 'Order confirmed by the library or the person responsible for the unit', 1, 0, 0, 'green', ''),
(7, 6, 'Rejetée', 'Commande rejetée par la bibliothèque qui devait la fournir ou par la personne responsable de la validation', 'Order rejected', 'Order rejected by the library that would provide it or the person responsible for validation', 'Order rejected', 'Order rejected by the library that would provide it or the person responsible for validation', 'Order rejected', 'Order rejected by the library that would provide it or the person responsible for validation', 'Order rejected', 'Order rejected by the library that would provide it or the person responsible for validation', 0, 1, 0, 'red', 'reject'),
(8, 7, 'En transit', 'Commande envoyée par la bibliothèque prêteuse et pas encore reçue par celle qui commande', 'Order in transit', 'order sent by the lending library and not yet received', 'Order in transit', 'order sent by the lending library and not yet received', 'Order in transit', 'order sent by the lending library and not yet received', 'Order in transit', 'order sent by the lending library and not yet received', 0, 1, 0, 'orange', NULL),
(9, 8, 'En traitement', 'Commande en cours de traitement (scan en cours, recherche dans les archives, etc.)', 'Order in process', 'Order being processed (current scan, archive search, etc.).', 'Order in process', 'Order being processed (current scan, archive search, etc.).', 'Order in process', 'Order being processed (current scan, archive search, etc.).', 'Order in process', 'Order being processed (current scan, archive search, etc.).', 1, 0, 0, 'orange', NULL),
(10, 9, 'A renouveler', 'Commande mise en attente pour une durée déterminée (document en cours de publication et pas encore reçu, etc.)', 'Order put on hold', 'Order put on hold for a fixed term (document in press and not yet received, etc.).', 'Order put on hold', 'Order put on hold for a fixed term (document in press and not yet received, etc.).', 'Order put on hold', 'Order put on hold for a fixed term (document in press and not yet received, etc.).', 'Order put on hold', 'Order put on hold for a fixed term (document in press and not yet received, etc.).', 0, 0, 0, 'orange', 'renew'),
(11, 10, 'A valider', 'Commande à valider par la bibliothèque ou la personne responsable de l''unité', 'Order to be confirmed', 'Order to be confirmed by the library or the person responsible for the unit', 'Order to be confirmed', 'Order to be confirmed by the library or the person responsible for the unit', 'Order to be confirmed', 'Order to be confirmed by the library or the person responsible for the unit', 'Order to be confirmed', 'Order to be confirmed by the library or the person responsible for the unit', 1, 0, 0, 'orange', 'tobevalidated'),
(12, 11, 'Supprimée', 'Commande supprimée (erreur de saisie, spam, etc.)', 'Order deleted', 'Order deleted (mistake, spam, etc.)', 'Order deleted', 'Order deleted (mistake, spam, etc.)', 'Order deleted', 'Order deleted (mistake, spam, etc.)', 'Order deleted', 'Order deleted (mistake, spam, etc.)', 0, 0, 1, 'red', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `units`
--

CREATE TABLE IF NOT EXISTS `units` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name1` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name2` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name3` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name4` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name5` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `department` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `faculty` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `library` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `internalip1display` tinyint(1) NOT NULL,
  `internalip2display` tinyint(1) NOT NULL,
  `externalipdisplay` tinyint(1) NOT NULL,
  `validation` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `department` (`department`),
  KEY `name1` (`name1`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Contenu de la table `units`
--

INSERT INTO `units` (`id`, `code`, `name1`, `name2`, `name3`, `name4`, `name5`, `department`, `faculty`, `library`, `internalip1display`, `internalip2display`, `externalipdisplay`, `validation`) VALUES
(1, 'DAR', 'Radiologie', 'Radiology', 'Radiology', 'Radiology', 'Radiology', 'Radiology', 'Medicine', 'LIB1', 1, 0, 0, 0),
(2, 'EXT_ENT', 'Entreprise privée', 'Private Firm', 'Private Firm', 'Private Firm', 'Private Firm', '', '', 'LIB1', 0, 0, 1, 1),
(3, 'EXT_MEDECIN', 'Médecin en cabinet privé', 'Physician in private practice', 'Physician in private practice', 'Physician in private practice', 'Physician in private practice', NULL, NULL, 'LIB1', 0, 0, 1, 0),
(4, 'GCP', 'Gastroentrologie', 'Gastroenterology', 'Gastroenterology', 'Gastroenterology', 'Gastroenterology', 'Internal Medicine', 'Medicine', 'LIB1', 1, 0, 0, 0),
(5, 'GLN', 'Neurologie', 'Neurology', 'Neurology', 'Neurology', 'Neurology', 'Neurosciences', 'Medicine', 'LIB3', 1, 0, 0, 0),
(6, 'HCN', 'Neurochirurgie', 'Neurosurgery', 'Neurosurgery', 'Neurosurgery', 'Neurosurgery', 'Neurosciences', 'Medicine', 'LIB1', 1, 0, 0, 0),
(7, 'IUXYZSP', 'Sociologie', 'Sociology', 'Sociology', 'Sociology', 'Sociology', 'Sociology', 'Humanities', 'LIB2', 0, 1, 0, 0),
(8, 'NCP', 'Psychologie', 'Psychology', 'Psychology', 'Psychology', 'Psychology', 'Psychology', 'Humanities', 'LIB2', 0, 1, 0, 0),
(9, 'STUDENT', 'Etudiant', 'Student', 'Student', 'Student', 'Student', NULL, 'Medicine', 'LIB1', 1, 1, 1, 0),
(10, 'THCX', 'Transplantation', 'Transplantation', 'Transplantation', 'Transplantation', 'Transplantation', 'Transplantation', 'Medicine', 'LIB1', 1, 0, 0, 0),
(11, 'URG', 'Urgences', 'Emergency medicine', 'Emergency medicine', 'Emergency medicine', 'Emergency medicine', 'Emergency medicine', 'Medicine', 'LIB4', 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(9) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `login` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `library` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `created_ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `login`, `password`, `library`, `status`, `created_ip`, `created_on`, `admin`) VALUES
(1, 'Super administrateur', 'sadmin@unixyz.com', 'sadmin', 'c5edac1b8c1d58bad90a246d8f08f53b', 'LIB1', 1, '127.0.0.1', '2012-05-24 22:12:37', 1),
(2, 'Utilisateur', 'user@unixyz.com', 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'LIB7', 1, '127.0.0.1', '2012-05-24 21:52:53', 3),
(3, 'Administrateur', 'admin@unixyz.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'LIB1', 1, '127.0.0.1', '2012-05-24 22:12:50', 2),
(4, 'Administrateur 2', 'admin2@unixyz.com', 'admin2', 'c84258e9c39059a89ab77d846ddab909', 'LIB1', 1, '127.0.0.1', '2012-05-24 22:12:20', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
