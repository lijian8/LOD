<?php
include_once ("./header.php");

require 'vendor/autoload.php';
require_once "html_tag_helpers.php";
include_once ("./onto_helper.php");
$onto_file = 'tcmlm.rdf';
$graph = new EasyRdf_Graph("http://localhost/lod/" . $onto_file);
$graph->load();
?>
<div class="container">
    <ol class="breadcrumb">
        <li><a href="main.php">首页</a></li>
        <li><a href="ontologies.php">本体</a></li>
        <li class="active">TCMLM本体规范</li>
    </ol>
    <h1>TCMLM:中医药文献元数据本体规范</h1>
    <table class="table">
        <tbody>
            <tr>
                <td width='10%'><strong>当前版本：</strong></td>
                <td>http://lod.cintcm.com/LOD/ontology.php</td>
            </tr>
            <tr>
                <td width='10%'><strong>最新版本：</strong></td>
                <td>http://lod.cintcm.com/LOD/ontology.php</td>
            </tr>
            <tr>
                <td width='10%'><strong>版本号：</strong></td>
                <td>1.00</td>
            </tr>
            <tr>
                <td width='10%'><strong>上次更新：</strong></td>
                <td>2013-10-06</td>
            </tr>
            <tr>
                <td width='10%'><strong>编辑：</strong></td>
                <td>于彤</td>
            </tr>
            <tr>
                <td width='10%'><strong>作者：</strong></td>
                <td>于彤</td>
            </tr>
            <tr>
                <td width='10%'><strong>贡献者：</strong></td>
                <td>详见<a href="#sec-ack">致谢</a></td>
            </tr>
            <tr>
                <td width='10%'><strong>建模技术：</strong></td>
                <td>TCMLM本体基于RDF和OWL技术实现，它们是由W3C提出的开放性技术规范。</td>
            </tr>


        </tbody>        
    </table>




    <hr>
    <h2>摘要</h2>
    <p>目前在国际上尚缺乏一部面向中医药领域的文献元数据技术规范，这不利于中医药文献的标引和检索。“ISO/DTS 17948 Traditional Chinese medicine literature metadata（中医药文献元数据）”（简称TCMLM）是国际标准化组织（ISO）于近期完成、正在审核的技术规范草案。它反映了中医药文献的特点，对于中医药文献资源的系统保护和深度利用具有重要意义。本文阐述该技术规范草案的内容和特点，对其与相关元数据标准进行比较分析。</p>
    <hr>
    <h2>关于本文</h2>
    本文为一份不断完善的文档。它是通过运行一份PHP脚本而自动生成的，将TCMLM OWL本体与术语说明文档的内容综合呈现出来。 
    <h2>目录</h2>
    <ul>
        <li><a href="#sec-intro">1. 介绍</a></li>       
        <li><a href="#sec-glance">2. TCMLM概览</a></li>
        <li><a href="#sec-vocab">3. TCMLM的技术特点与主要内容</a></li>
        <li><a href="#sec-xref">4. TCMLM的类和属性列表</a></li>
        <li><a href="#sec-comparison">5. TCMLM与相关标准的比较分析</a></li>
        <li><a href="#sec-ack">6. 致谢</a></li>
        <li><a href="#sec-conclusion">7. 小结</a></li>        
        <li><a href="#sec-reference">8. 参考文献</a></li>
        <li><a href="#sec-changes">9. 变更记录</a></li>
    </ul>
    <hr>
    <h2><a name="sec-intro" id="sec-intro"></a>1. 介绍</h2>
    <p>中医药学历经数千年的传承和发展，形成了异彩纷呈的医学流派，留下了浩如烟海的医学文献。
        中医药文献作为文化传承的纽带，记载着历代医家的智慧和经验。面对如此庞大、复杂的文献资源，如何对它们进行有效的分类、整理、评鉴和保存，
        是中医药传承中的重点和难点问题。近年来，随着信息技术革命的深化，很多信息技术在中医药领域中得到了成功的应用。
        特别是文献标引和检索技术，在中医药文献的数字化保存和深度利用中发挥了重要作用。
        然而，在国际上尚缺乏一部面向中医药领域的文献元数据技术规范，导致各种中医药文献检索系统之间存在着显著的异构性，这不利于中医药文献的标引和检索。
    </p>
    <p>元数据（metadata）是“关于数据的数据”。它是数据组织和处理的基本工具，可以为各种形态的信息和知识资源提供规范和统一的描述方法，
        在数据资源的管理与利用中发挥着日益重要的作用。元数据标准的制定，引起各国的广泛重视。目前，在国际上应用最广、
        影响最大的元数据标准被称为都柏林核心元数据元素集（Dublin Core Metadata Element Set，以下简称DC），它定义了一组最为核心的术语，通用性强，
        可用于描述各种资源。此外，应用于不同领域的元数据标准亦相继出现，例如：描述政府信息资源的元数据GKS，描述档案库与资源集合的元数据EAD，
        描述教育资源的元数据IEEE LOM、GEM等。
    </p>
    <p>元数据标准在医学领域具有广阔的应用前景。它有助于实现信息系统的互操作和知识资源的共享，协助医学专家、患者和普通公民发现所需的知识资源，
        并保证知识资源检索的质量和相关性。世界各国在DC的基础上，研发了MCM、CISMeF、EBM metadata等医学元数据标准。
        这些标准在设计思想上基本一致，它们都是在DC基础上的扩展，在主题描述上采用了MeSH主题词表，并使用了基于Web语言的描述方法，
        这些技术措施增加了元数据的互操作性。这些元数据方案已被用于医学资源联机目录和索引的编制，对医学资源进行有效组织，为医学研究者提供更为有效的检索方法。
    </p>
    <p>
        国内学者亦在元数据领域开展了深入研究。例如，张晓林对各领域元数据的格式、结构、编码语言(包括XML)、
        互操作体系(包括RDF、元数据映射和数字对象方法)等问题及其标准进行了探讨；李毅等提出了制定我国医学元数据标准的基本策略和流程，
        以满足医药卫生科学数据管理和共享服务系统中数据共享的需求；姚伯岳等研制了古籍元数据标准，该标准主要是为数字化古籍元数据著录服务，
        同时兼顾古籍原物元数据著录；徐维等构建了面向前瞻性临床研究的元数据语义架构体系(openPCR)，为前瞻性临床研究的数据标准化、
        数据交换与共享以及与电子病历系统的兼容奠定了基础。
    </p>
    <p>
        中医药文献具有鲜明的领域特色，DC、MCM、CISMeF、EBM metadata等标准都不完全适合中医药领域，
        因此需要建立一套专门面向中医药领域的文献元数据标准。徐春波提出了一套中医药古籍元数据规范，规定了完整描述一部中医药古籍文献所需的数据项集合、
        各数据项语义定义和著录规则等；崔蒙等于2011年起草了“中医数据集元数据规范”这一中医药行业标准的草案，该标准是在充分参考DC等元数据标准的基础上，
        结合中医领域数据集的特性编写完成的。但迄今为止，尚未出现一部国际通行的中医药文献元数据标准，这严重影响了中医文献资源的全球共享以及中医的国际化进程。
    </p>
    <p>
        鉴于此，中国中医科学院中医药信息研究所于2008年代表我国向国际标准化组织（ISO）的健康信息学技术委员会（TC 215）提出了“中医学信息元数据标准”的提案
        。该提案后更名为“Traditional Chinese Medicine Literature Metadata（中医文献元数据）”，
        并于2012年作为一项ISO技术规范（Technical Specification）得到成功立项（编号为[ISO/DTS 17948]，以下简称为“TCMLM”） 。
        经过中国、韩国、英国、美国等多国专家的多次会议讨论和反复修改，TCMLM的草案于2013年完成，进入评审与投票阶段。
        下面将对TCMLM的技术特点与主要内容进行介绍，并对其与相关元数据标准进行比较分析。
    </p>


    <h2><a name="sec-glance" id="sec-glance"></a>2. TCMLM概览</h2>
    <p>目前，在TCMLM这一OWL本体中，定义了&nbsp;<span class="badge"><?php echo num_of_instances($graph, 'owl:Class'); ?></span>个类（owl:Class）和&nbsp;<span class="badge"><?php echo num_of_instances($graph, 'owl:ObjectProperty'); ?></span>&nbsp;个对象属性（owl:ObjectProperty）：</p>
    <div class="well">   
        <?php render_nav($graph); ?>   
    </div>
    <h2><a name="sec-vocab" id="sec-vocab"></a>3. TCMLM的技术特点与主要内容</h2>


    <p>
        中医药文献具有内容宏博、医理深邃、字词古奥、版本藉藉、抄刻误多等鲜明的特色，并继承了中国古代文献的特征性元素。
        通用的文献元数据标准在专指度与精深度上尚显不足，无法充分揭示中医药文献的特征。TCMLM则是一套专门针对中医药文献的元数据技术规范，
        它规定了中医药文献元数据标准化的基本原则和方法，以及中医药文献元数据的基本内容。
        TCMLM建立在DC的基础之上，并参考了“ISO 13119 Health informatics - Clinical knowledge resources-Metadata”、
        “ISO 19115 Geographic information-Metadata”等ISO标准，以及“GB/T 20348-2006 中医基础理论术语”等国家标准。
        另外，TCMLM与中国中医药学主题词表等系统存在依赖和相关关系。从架构上分析，TCMLM的元数据模型分为4个层次：

    </p>
    <ol>
        <li>元数据子集（Metadata section）：元数据的子集合，由相关的元数据实体和元素组成；</li>
        <li>元数据实体（Metadata entity）：一组说明数据相同特征的元数据元素；</li>
        <li>元数据元素（Metadata element）：元数据的基本单元；</li>
        <li>元数据元素的细化（Metadata refinement）：与某个元数据元素具有相同意义，但含义更窄的资源属性。</li>
    </ol>
    <p>TCMLM保留了DC的元数据元素集，又包括中医药领域的特征元素。它的设计原则包括：（1）重用DC元数据元素，如题名（Title）、类型（Type）、
        创建者（Creator）、主题（Subject）、描述（Description）、日期（Date）、标识符（Identifier）、语种（Language）、关联（Relation）等；
        （2）根据中医药领域逻辑，对DC元数据元素进行细化，例如将DC中的题名（Title）进一步细化为版心题名（Title on the Fore-edge）、
        内封题名（Title on the Inside Cover）、书衣题名（Title on the Book Cover）、卷端题名（Title on the First Page of Text）等；
        （3）添加具有中医药特色的元数据元素。
    </p>    
    <div class="col-sm-12 col-md-12">
        <div align="center" class="thumbnail">
            <img width="50%" src="./img/tcmlm/TCMLM-Elements.jpg" alt="...">
            <div class="caption">
                <p><strong>图1.</strong>&nbsp;TCMLM的24个元数据元素以及它们与DC元素之间的关系。</p>
            </div>
        </div>
    </div>

    <p>
        如图1所示，TCMLM中包含24个元数据元素，其中15个源自DC，9个为面向中医药领域的特征元素，它们被分为7个元数据子集：    
    </p>
    <ul>
        <li>           
            <strong>标识信息子集</strong>: 提供了关于中医文献外部特征的描述信息。包括题名（Title）、创建者（Creator）、贡献者（Contributor）、类型（Type）、格式（Format）、标识符（Identifier）、描述（Description）、出版者（Publisher）、出版地点（Place of publication）、印刷地点（Place of printing）和日期（Date）等11个元数据元素。
        </li> 
        <li>  
            <strong>内容信息子集</strong>: 提供了关于中医文献内部特征的描述信息。包括主题（Subject）、历代医家（Physicians of Past Generations）、中医各家（TCM School of Thought）、来源（Source）、覆盖范围（Coverage）、语种（Language）等6个元数据元素。
        </li> 
        <li>  
            <strong>分发信息子集</strong>: 提供了关于用户获取和收藏文献资源的信息。包括存储地点（Storage Location）、收藏历史（Collection History）等2个元数据元素。
        </li> 
        <li>  
            <strong>质量信息子集</strong>: 提供了关于文献资源保存状态的质量信息。包括文献破损级别（Physical Degradation）、珍稀程度（Rare Degree）等2个元数据元素。
        </li> 
        <li>  
            <strong>限制信息子集</strong>: 提供了对文献资源进行获取和使用的限制信息。包括权限（Rights）这一元数据元素。
        </li> 
        <li>  
            <strong>维护信息子集</strong>: 提供了关于维护保养文献资源的信息。包括保存方式（Preserve Method）这一元数据元素。
        </li> 
        <li>  
            <strong>关联信息子集</strong>: 提供了资源之间关联关系的参考信息。包括继承于（Inherit from）、后续（Subsequent）、替代（Substitute for）、被替代（Be Replaced by）、译自（Translated From）、包含（Contain）等关系（Relation）。
        </li> 

    </ul>
    <p>TCMLM为中医药文献资源的规范化描述奠定了基础，它有助于构建明晰、周全、简单、易懂的文献描述性记录，能有效支持中医药文献的收集、保管和利用，改善中医药文献检索的效果，对于中医药文献资源的系统保护和深度利用具有重要意义。</p>

    <h2><a name="sec-xref" id="sec-xref"></a>4. TCMLM的类和属性列表</h2>
    TCMLS-SN定义了如下的类和属性。欲知详情，请查看<a href="tcmdemoen.rdf">TCMLS-SN的OWL/RDF文件</a>.

    <?php render_details($graph, $onto_file); ?>

    <h2><a name="sec-comparison" id="sec-comparison"></a>5. TCMLM与相关标准的比较分析</h2>
    <p>
        国际标准化组织（ISO）已深度介入元数据标准化工作。ISO于2003年正式批准并发布了DC，从而将DC纳入了自身的标准体系；
        并于2009年2月发表了DC的修订版（即[ISO 15386:2009]）。
        此外，ISO的健康信息学技术委员会研制了“ISO 13119 Health informatics - Clinical knowledge resources – Metadata
        （健康信息学-临床知识资源-元数据）”（以下简称CKRM）标准，该标准能够对文档的重要特征进行准确、规范的描述，适用于各类数字化文档，支持文献检索和自动推理。
        那么，TCMLM与这些标准有哪些区别？在医学领域已经存在知识资源元数据标准的前提下，是否有必要提出一项特别面向中医药领域的文献元数据标准？为了回答这些问题，
        我们对TCMLM、CKRM、DC进行比较分析，指出了TCMLM与这些标准之间的区别和差异，论证了提出这一技术规范的必要性。
    </p>
    <div class="col-sm-12 col-md-12">
        <div class="thumbnail">
            <img width="40%" src="./img/tcmlm/TCMLM-CKRM-DC.jpg" alt="...">
            <div class="caption" align="center">
                <strong>图2.</strong>&nbsp;以“中药”为核心的语义网络
            </div>
        </div>
    </div>
    <p>       
        如图2所示，TCMLM在DC的基础上进行了大量的扩充；它与CKRM存在一定的联系，也有本质的区别。
        DC定义了一组通用的元数据元素，是领域专用的元数据标准的共同基础。TCMLM是中医药文献元数据标准，主要反映了中医文献的特点；CKRM是医学知识资源的元数据标准，
        主要反映了西医文献的特点。两者都在各自领域中对DC进行了细化和延伸（包括对DC元素的进行修饰和限制，并添加新的元素）。
        除了共同沿用DC之外，在TCMLM和CKRM之间还存在一些交集（例如，两者都包含“Replaces”和“Is Replaced by”等关系）。
        但它们在意义和用途上有着根本性的不同。与相关标准相比，TCMLM在资源形式、分发收藏、主题内容、质量控制、关联关系等方面都具有显著的特异性，
        因此有必要提出这样一套面向中医药领域的文献元数据标准。    
    </p>

    <h2><a name="sec-ack" id="sec-ack"></a>6. 致谢</h2>
    <p>本文的视觉风格和文档结构，借鉴于Dan Brickley和Libby Miller的“FOAF Vocabulary Specification”，以及Uldis Bojārs和John G. Breslin的“SIOC Core Ontology Specification”。</p>
    <p>这项工作得到如下基金项目资助：中国中医科学院基本科研业务费自主选题项目(编号：ZZ060808)-“中医文献元数据标准、中医语言系统分类框架等国际标准研制”；中国博士后科学基金资助项目（编号：2012M520559）-“面向中医药复杂语义网络的方法学研究”；中国中医科学院基本科研业务费自主选题项目（编号：ZZ070314）-“中医药文献元数据标准的示范应用与评价研究”；中国中医科学院基本科研业务费自主选题项目（编号：ZZ070311）-“中医药复杂语义网络模型研究”。
    </p>
    <h2><a name="sec-conclusion" id="sec-conclusion"></a>7. 小结</h2>
    <p>历代医家为后世留下了浩如烟海的经典文献。中医药文献具有显著的特色，其许多特征是DC等通用的元数据方案所不能完全表达的。我们需要一部专门面向中医药领域的文献元数据技术规范，来表达中医药文献的特色信息。TCMLM覆盖中医药学领域具有共性的全部元数据内容，为中医药学的文献资源提供了一套通用的描述元素。它能够规范，科学、合理地描述中医药学文献，提供有关中医学科学文献的标识、内容、分发、质量、限制和维护信息，以支持中医药文献的收集、存储、检索和使用，促进中医药文献资源的交流与共享。本文对TCMLM的设计理念、结构和内容进行了介绍，并对它与DC、CKRM等相关标准/技术规范进行了比较分析，显示了TCMLM的独特性和必要性。
    </p>
    <h2><a name="sec-reference" id="sec-reference"></a>8. 参考文献</h2>
    <ol>  
        <li> 	Stuart Weibel. The Dublin Core: A Simple Content Description Model for Electronic Resources[J]. Bul. Am. Soc. Info. Sci. Tech., 1997, 24(1):9-11.
        </li>
        <li> 	曹锦丹,李欣欣.基于DC的医学信息资源元数据比较分析[J].图书情报工作,2003,(7):24-27.
        </li>
        <li> 	Gary Malet, Felix Munoz, Richard Appleyard, William Hersh. Model Formulation: A Model for Enhancing Internet Medical Document Retrieval with “Medical Core Metadata”[J]. J Am Med Inform Assoc, 1999, 6(2):163-172.
        </li>
        <li> 	Stéfan Darmoni; Benoit Thirion; Sylvie Platel; Magsly Douyère; Philippe Mourouga & Jean-Philippe Leroy. CISMeF-patient: a French counterpart to MEDLINEplus.. J Med Libr Assoc ,  Apr, Volume 90, Number 2, Pages 248-253, 2002.
        </li>
        <li> 	Yukiko Sakai. 2001. Metadata for Evidence-Based Medicine resources. In Proceedings of the International Conference on Dublin Core and Metadata Applications 2001 (DCMI '01), Keizo Oyama and Hironobu Gotoda (Eds.). National Institute of Informatics, Tokyo, Japan 81-85.
        </li>
        <li> 	吴建中主编. DC元数据. 上海：上海科学技术出版社，2000.
        </li>
        <li> 	张晓林主编. 元数据研究与应用. 北京：北京图书馆出版社，2002.
        </li>
        <li> 	姚伯岳,张丽娟,于义芳等.古籍元数据标准的设计及其系统实现[J].大学图书馆学报,2003,21(1):17-21.
        </li>
        <li> 	李毅,蔡刿,尹岭等.医学元数据标准制定基本策略和流程[J].情报学报,2006,25(3):312-315.
        </li>
        <li> 	张晓林.元数据开发应用的标准化框架[J].现代图书情报技术,2001,(2):9-11,15.
        </li>
        <li> 	张晓林. 元数据开发应用的标准化框架. 现代图书情报技术，2001（2）：9-11.
        </li>
        <li> 	徐维, 邱君瑞, 朱妍昕, 耿亦兵, 王志勇. 前瞻性临床研究元数据语义结构体系的建构[J]. 图书情报工作, 2012, (16) 108-112.
        </li>
        <li> 	徐春波. 中医药古籍元数据规范研究. 中华中医药学会第九届中医医史文献学术研讨会论文集萃, 2006.
        </li>
        <li> 	李海燕,崔蒙,任冠华等.ISO/TC215传统医学信息标准化工作进展[J].国际中医中药杂志,2011,33(3):193-195.
        </li>
        <li> 	于彤,崔蒙,杨硕. ISO/TC 215传统医学信息标准跟踪研究[J]. 中国数字医学,2013,8(2):46-49.
        </li> 
        <li> 	Klein GO. Metadata-an international standard for clinical knowledge resources [J]. Stud Health Technol Inform., 2011,169:839-43.
        </li> 
    </ol> 

    <h2><a name="sec-changes" id="sec-changes"></a>9. 变更记录</h2>
    <ul>
        <li>2013-11-24: TCMLM本体规范的最初版本.</li>
    </ul>  
</div>


<?php
include_once ("./foot.php");
?>