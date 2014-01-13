<?php

$tcmls = array("localhost", "root", "yutong", "tcmls1");
$spleen = array("localhost", "root", "yutong", "spleen");
$herb = array("localhost", "root", "yutong", "herb");
$formula = array("localhost", "root", "yutong", "formula");
$formula_dic = array("localhost", "root", "yutong", "formula_dic");
$cases = array("localhost", "root", "yutong", "cases");
$herbnet = array("localhost", "root", "yutong", "exp");
$docs = array("localhost", "root", "yutong", "hamster1");
$tcmct = array("localhost", "root", "yutong", "tcmct");
$clan = array("localhost", "root", "yutong", "clan");

//$dbs = array( "tcmls" => $tcmls, "tcmct" => $tcmct, "clan" => $clan, "spleen" => $spleen, "herb" => $herb, "herbnet" => $herbnet,  "formula" => $formula, "formula_dic" => $formula_dic, "cases" => $cases, "docs" => $docs);
//$db_labels = array( "tcmls" => "TCMLS", "tcmct" => "TCMCT", "clan" => "古籍语言", "spleen" => "证候库", "herb" => "中药库", "herbnet" => "HerbNet", "formula" => "方剂库", "formula_dic" => "方剂辞典",  "cases" => "医案库","docs" => "文献库");
$dbs = array( "tcmls" => $tcmls, "tcmct" => $tcmct, "clan" => $clan, "spleen" => $spleen,  "docs" => $docs, "herbnet" => $herbnet);
$db_labels = array( "tcmls" => "TCMLS", "tcmct" => "TCMCT", "clan" => "古籍语言", "spleen" => "证候库", "docs" => "文献库", "herbnet" => "HerbNet");
$db_comments = array( "tcmls" => "中医药学语言系统（Traditional Chinese Medicine Language System，TCMLS）”是以中医药学科体系为核心的大型计算机化语言系统，共收录约10万条概念词、30 万个术语和130万条语义关系。", 
    "tcmct" => "“中医药临床术语集（Traditional Chinese Medicine Clinical Terms，TCMCT）”是专门面向中医临床领域的大型术语集，共收录11万多条概念词，27万多个术语，可用于电子病历、临床决策支持等多种应用。",
    "clan" => "中医古籍语言系统是以中医药学语言系统（TCMLS）为依托，以TCMLS的语义类型和语义关系为基础构建的，旨在初步建立中医古籍蕴含的概念知识点之间的语义网络，从而实现与TCMLS的兼容检索与查询。", 
    "spleen" => "中医脾系证候知识库对中医脾系证候的知识体系进行了系统梳理和准确表达。已经录入的数据有2710条，其中证候有265个，证候加减527个，疾病86个，方剂482个，中药385个，症状959个。概念间的关系有30种，10471个。 ", 
    "docs" => "基于中医药学语言系统从文本中提取语义关系所构成的文献库。",
    "herbnet" => "中药数据库集成框架，基于面向中药领域的规范化数据模型， 集成多个中药数据库资源，包含中药基础信息、中药化学成分属性信息、方剂信息、药理作用、中药化学实验信息等，支持中药学研究。");


?>
