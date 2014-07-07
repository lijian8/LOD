<?php
include_once ("./header.php");

require 'vendor/autoload.php';
require_once "html_tag_helpers.php";

include_once ("./onto_helper.php");
$instances = array(
    '疾病' => array('糖尿病', '脑缺血', '高脂血症'),
    '中药' => array('大黄', '人参', '丹参', '仙人掌', '黄芩', '冬虫夏草'),
    '方剂' => array('丹参素注射液', '茯苓泽泻加山楂汤', '川芎葛根人参方', '复方丹参', '健脾方', '芪黄胶囊', '黄连解毒汤'),  
    '中药药理作用' => array('降脂药', '降糖药', '益智药', '抗脑缺血药', '降血糖药'),
    '中药化学成分' => array('小檗碱',   '大黄素',   '牛磺酸' ,  '三七提取物' ,  '葛根素')  , 
     '化学实验方法' => array('柱层析法', '硅胶柱色谱法', '薄层层析法', '理化鉴别法', '红外光谱法')       
);

$graph = new EasyRdf_Graph("http://localhost/lod/herbnet.rdf");
$graph->load();
?>

<div class="container">
    <ol class="breadcrumb">
        <li><a href="#">首页</a></li>
        <li><a href="#">本体</a></li>
        <li class="active">Herbnet</li>
    </ol>
    <h1>Herbnet: 中药领域顶层本体</h1>
    <hr>
    <table class="table table-bordered">
        <tbody>
            <tr>
                <td width='10%'><strong>当前版本：</strong></td>
                <td><a href="herbnet.rdf">http://localhost/lod/herbnet.rdf</a></td>
            </tr>
            <tr>
                <td width='10%'><strong>最新版本：</strong></td>
                <td><a href="herbnet.rdf">http://localhost/lod/herbnet.rdf</a></td>
            </tr>
            <tr>
                <td width='10%'><strong>版本号：</strong></td>
                <td>1.00</td>
            </tr>
            <tr>
                <td width='10%'><strong>上次更新：</strong></td>
                <td>2014-05-14</td>
            </tr>
            <tr>
                <td width='10%'><strong>编辑：</strong></td>
                <td>刘丽红，于彤</td>
            </tr>
            <tr>
                <td width='10%'><strong>作者：</strong></td>
                <td>刘丽红，于彤</td>
            </tr>
            <tr>
                <td width='10%'><strong>贡献者：</strong></td>
                <td>详见<a href="#sec-ack">致谢</a></td>
            </tr>
            <tr>
                <td width='10%'><strong>建模技术：</strong></td>
                <td>Herbnet本体基于RDF和OWL技术实现，它们是由W3C提出的开放性技术规范。</td>
            </tr>
            <tr>
                <td width='10%'><strong>示范应用和演示系统：</strong></td>
                <td><a href="/herbnet/">http://localhost/herbnet/</a></td>              
            </tr>
        </tbody>        
    </table>
    <hr>
    <h2>摘要</h2>
    <p>随着互联网技术的迅猛发展，日积月累并不断涌现大量内容丰富、种类各异的数据，
        结构化、半结构化、非结构化数据并存的混合型数据具有海量、异构、个性化、复杂的特点。
        当前应用中，对信息个性化增值服务方面存在广泛需求。本文提出了一个简单的中药领域顶层本体——Herbnet框架。
        Herbnet框架为实现中药数据库集成提供了基本的顶层本体框架。
        Herbnet框架是根据中药领域模型的特点，从“中医药学语言系统的语义网络框架（以下简称TCMLS-SN）”中抽取一部分元素而构建出来的。
    </p>

    <hr>
    <h2>关于本文</h2>
    本文为一份不断完善的文档。它是通过运行一份PHP脚本而自动生成的，将Herbnet本体的内容综合呈现出来。 
    <h2>目录</h2>
    <ul>
        <li><a href="#sec-intro">1. 介绍</a>
            <ul>
                <li><a href="#sec-notation">1.1. 术语</a></li>
            </ul>
        </li>
        <!--<li><a href="#sec-glance">2. Herbnet概览</a></li>-->
        <li><a href="#sec-desc">2. Herbnet描述</a>
            <!--
            <ul>
                <li><a href="#sec-example">3.1. 例子</a></li>
                <li><a href="#sec-background">3.2. 背景</a></li>
                <li><a href="#sec-evolution">4.1. TCMLS-SN的更新和扩展</a></li>
                <li><a href="#sec-modules">4.2. TCMLS-SN的模块</a></li>
                <li><a href="#sec-standards">4.3. TCMLS-SN的相关标准</a></li>
                <li><a href="#sec-sioc-rdf">4.4. TCMLS-SN和RDF</a></li>
            </ul>-->
        </li>
        <li><a href="#sec-glance">3. Herbnet的类和属性列表</a></li>
        <!--<li><a href="#sec-external">5. 外部类和属性</a></li>-->
        <li><a href="#sec-ack">4. 致谢</a></li>
        <li><a href="#sec-conclusion">5. 小结</a></li>        
        <li><a href="#sec-reference">6. 参考文献</a></li>
        <li><a href="#sec-changes">7. 变更记录</a></li>
    </ul>
    <hr>
    <h2><a name="sec-intro" id="sec-intro"></a>1. 介绍</h2>
    <p>
        中药各个数据库虽然内容丰富，且已经建立了良好的关系，但是各个数据库之间缺乏信息关联，仅反映了某一类数据的专业特点，
        试想可以在这些专业型数据库基础上建立一个内容相对完整规范、不同领域内容相互关联、方便用户整体掌握并有效应用的中药规范化数据模型，
        模型元素包括中药单味药属性、化学成分属性及相关药理活性、化学实验信息等知识。
    </p>
    <p>
        面向中药领域的规范化数据模型需要包含中药基础信息、中药化学成分属性信息、方剂信息、药理作用、中药化学实验信息等。
        中药数据库集成建设要考虑多个数据来源信息的关联性，在进行的中药药理实验与中药化学实验数据库调查问卷研究中，
        其中约50-70%用户在中药药理实验方面数据关注较广泛，其中相对突出的关注点包括中药化学成分、研究对象、相关毒理实验信息等。
        在检索方式上更加注重关联信息查询，如中药相关疾病、中药基础信息、化学实验信息等。
        一些基础科研用户更加注重在数据之间相互关联产生的一些信息中进行知识发现与知识推理，目的在于寻求其中的某种关联甚至是推理衍生的规律，知识等。
        深入调查用户需求，有效的将这些中药数据库之间的联系完美织构，对中药科研工作者甚至是对整个中药信息学的发展都具有重要意义。
    </p>
    <p>本研究分析用户需求，将中药数据库群进行解析、比合，尝试中药不同类型数据之间的最大有效关联，将中药信息数据库中关注度较高的中药化学成分作为轴心，
        关联中药单味药信息、方剂信息、药理作用、中药化学成分相关化学实验等信息，另外将与这些字段都能相联的作者信息一共设置为6个不同的检索入口，
        每个检索入口都可以进行相互关联信息的展示与查询，并尽可能将这些关联结果文献来源进行标注，使用户在进行相关文献分析的同时可以明确数据信息来源的可靠性。
    </p>
    <div class="row">
        <div class="col-sm-12 col-md-offset-3 col-md-6">
            <div align="center" class="thumbnail">
                <img src="./img/herbnet_model.jpg" alt="...">
                <div class="caption">
                    <p><strong>图1.</strong>&nbsp;面向中药领域的规范化数据模型</p>
                </div>
            </div>
        </div>
    </div>

    <!--<h2><a name="sec-glance" id="sec-glance"></a>2. Herbnet概览</h2>-->

    <h2><a name="sec-desc" id="sec-desc"></a>2. Herbnet描述</h2>
    <p>
        HerbNet是根据中药领域模型的特点，从“中医药学语言系统的语义网络框架（以下简称TCMLS-SN）”中抽取一部分元素而构建出来的。
        构建本体的目的之一，是实现数据的跨域集成和异构系统的互操作。因此，本体的一个设计原则是尽量重用已有的本体和术语资源，或与它们相互兼容。
        在设计中药领域本体时，希望可以尽量重用TCMLS的语义网络框架中的元素。
    </p>
    <div class="row">
        <div class="col-sm-12 col-md-offset-3 col-md-6">
            <div align="center" class="thumbnail">
                <img src="./img/herbnet-network.jpg" alt="...">
                <div class="caption">
                    <p><strong>图2.</strong>&nbsp;Herbnet的语义类型</p>
                </div>
            </div>
        </div> 
    </div>
    <p>
        经过对TCMLS的语义网络框架进行分析，我们使用其中的如下词汇：中医疾病（DiseaseTCM），方剂（Formula），中药（Chinese Medicinal），
        中药化学成分（Chemical constituent of Chinese medicine）。从中药领域需求的角度出发，我们添加了药理作用（Pharmacological Effects）、
        中药实验（Chemical Experiment）、化学实验方法（Chemical Experiment Methods）这三个类。
        另外，引入药用物质（Medicinal Substance）作为方剂、中药、化学成分的共同父类。
        只需建立“药用物质”与其他类型之间的关系，其子类即可继承这些关系。
    </p>
    <div class="row">
        <div class="col-sm-12 col-md-offset-4 col-md-4">
            <div class="thumbnail">
                <img  src="./img/herbnet-properties.jpg" alt="...">
                <div align="center" class="caption">
                    <strong>图3.</strong>&nbsp;Herbnet的属性
                </div>
            </div>
        </div>
    </div>
    <p>在语义关系的设计方面，重用一些TCMLS-SN中的语义关系（源自 UMLS Semantic Network），将语义类型相互连接起来。
        HerbNet框架可以被看成是“中医药学语言系统的语义网络框架”在中药领域的一个子本体。
    </p>   
    <h2><a name="sec-glance" id="sec-glance"></a>3. Herbnet的类和属性列表</h2>
    <p>
        在Herbnet本体中，定义了&nbsp;<strong><?php echo num_of_instances($graph, 'owl:Class'); ?></strong>个类（owl:Class）,
        &nbsp;<strong><?php echo num_of_instances($graph, 'owl:ObjectProperty'); ?></strong>&nbsp;个对象属性（owl:ObjectProperty）,
        &nbsp;以及 <strong><?php echo num_of_instances($graph, 'owl:DatatypeProperty'); ?></strong>&nbsp;个数值属性（owl:DatatypeProperty）：
    </p>

    <div class="well">
        <?php render_nav($graph); ?>
    </div>
    下面对Herbnet中定义的类和属性进行具体介绍 (欲知详情，请查看<a href="herbnet.rdf">Herbnet的OWL/RDF文件)</a>:

    <?php render_details($graph, "herbnet", $instances); ?>

    <!--<h2><a name="sec-external" id="sec-external"></a>5. 外部类和属性</h2>-->
    <h2><a name="sec-ack" id="sec-ack"></a>4. 致谢</h2>
    <p>本文的视觉风格和文档结构，借鉴于Dan Brickley和Libby Miller的“FOAF Vocabulary Specification”，以及Uldis Bojārs和John G. Breslin的“SIOC Core Ontology Specification”。</p>
    <p>这项工作得到如下基金项目资助：基于语义Web的中药数据库集成框架研究（ ZZ070317）；中国博士后科学基金资助项目（编号：2012M520559）-“面向中医药复杂语义网络的方法学研究”；中国中医科学院基本科研业务费自主选题项目（编号：ZZ070311）-“中医药复杂语义网络模型研究”。
    </p>
    <h2><a name="sec-conclusion" id="sec-conclusion"></a>5. 小结</h2>
    <p>在中医药信息化建设过程中，先后构建起多个专业的数据库系统。由于各个数据库开发的时间、需求不同，以至于在各个单位，每个部门都建立了自己独立的、各个专业的主题数据库，
        这些专题数据库散在、分布式存在，形成了“信息孤岛”。从整体上有效地组织和管理这些数据，消除“信息孤岛”现象，就是数据集成需要解决的问题。
        本研究以面向中药领域的数据库作为研究对象，构建中药规范化数据模型，提出Herbnet这个中药顶层本体，以支持中药数据库的集成和共享，促进中医药信息事业发展。
    </p>
    <h2><a name="sec-reference" id="sec-reference"></a>6. 参考文献</h2>
    <ol>
        <li>
            刘杰书，郜红利，陈龙全. 2011. 建立中药数据库教学应用研究.时珍国医国药，22（4）：970-970.
        </li>
        <li>
            王建岭，李仁玲，段彦蕊，等. 2011. 中药药理信息系统建设初议.河北中医药学报，26（3）：48-49.
        </li>
        <li>    
            郑益，毛楚祥. 2010. 传统数据库技术与信息检索技术的集成.计算机时代，（8）：1-3，6.
        </li>
        <li>    
            宫彦婷. 2009. 分布异构数据库信息集成的设计与实现.福建电脑，（5）：155-156，134.
        </li>
        <li>    
            刘威，杨丹. 2009. 基于虚拟视图的异构数据库集成平台的研究.计算机技术与发展，19（6）：91-94.
        </li>
        <li>    
            金晓磊，闫红漫，翁之浩，等. 2009. 基于虚拟数据库的信息系统集成研究.计算机技术与发展，19（6）：87-90.
        </li>
        <li>
            宋亚林，任冬英. 2011. 文档型数据库与关系型数据库中数据集成的研究.福建电脑，（2）：157-158.
        </li>
        <li>
            Halevy AY. 2001. Answering queries using views: A survey[J]. The VLDB Journal, 10(4), 270-294.
        </li>

    </ol> 

    <h2><a name="sec-changes" id="sec-changes"></a>7. 变更记录</h2>
    <ul>
        <li>2013-01-18: 于彤提出Herbnet本体的设计方案。</li>
        <li>2014-05-14: 刘丽红使用Protege开发了Herbnet本体的最初版本。</li>
        <li>2014-07-07: 于彤完成了Herbnet本体发布网站（本网站）的开发。</li>
        <li>2014-07-07: 于彤对Herbnet本体进行了修改：添加了类型的英文标签，标明文字标签的语种（如en表示英文，zh表示中文）。</li>
    </ul>  
</div>


<?php
include_once ("./foot.php");
?>