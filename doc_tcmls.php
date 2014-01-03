<?php
include_once ("./header.php");
?>
<div align="center" class="container">
    <img width ="100%" src ="img/tcmls_logo.jpg"></img>    
</div>


<div class="container">
    <br> 
    <p class="lead"><strong>系统介绍</strong></p>
    <p>
        <a href="http://www.cintcm.ac.cn/opencms/opencms/xxyj/zyybzyj/news_0001.html" target="_blank">中医药学语言系统（Traditional Chinese Medicine Language System，TCMLS）</a>
   是以中医药学科体系为核心，遵循中医药学语言特点，借鉴语义网络的理念，建立的一个中医药学语言集成系统。它的词库涵盖了中医药学科系统及与中医药学科相关联的生物、植物、化工等自然与人文科学专业词汇。TCMLS的核心组件是一个大型的复杂语义网络，通过将中医药学概念中隐含的各种语义关系全部提取出来，形成关系表，并以此为中心，建立学科术语概念与概念、概念与名词、概念与含义、名词与名词之间的内在联系，形成一个网状的信息表示结构。
    </p>
    <hr>
    <p class="lead"><strong>顶层语义网络</strong></p>
    <p>语义网络的上层结构包括97种语义类型和55种语义关系，下面分别加以介绍：
    <ul>
        <li>语义类型（Semantic Type）：TCMLS制定了97种语义类型，其中39种属于实体类型，而58种属于事件类型。          
        </li>
        <li>语义关系（Semantic Relation）：TCMLS制定了55种语义关系，除了代表上下位父子关系的等级关系外，还包括54种相关关系，并且按照物理上相关、空间上相关、影响、时间上相关、概念上相关这五个大类展开。            
        </li>
    </ul>
    <p align="center">
        <a class="btn btn-lg btn-success" href="sn_profile.php?db_name=tcmls" role="button"><span class="glyphicon glyphicon-search"></span>&nbsp;浏览语义网络</a>
                
        <a class="btn btn-lg btn-primary" href="ontologies/tcmls-sn.rdf" role="button"><span class="glyphicon glyphicon-cloud-download"></span>&nbsp;下载OWL本体</a>
    </p>
    <br>
    <p>ISO/TC215健康信息学全体大会于2011年10月19-21日在芝加哥召开，我国代表团全程参加了传统医学任务组（TM TF）会议、语义术语组（WG3）会议、ISO/TC215全体大会。此次会议上，我国代表团提出了标准项目提案“Semantic network framework and coding of traditional Chinese medicine （中医药语义网络框架和代码）”。2012年2月24日，会议投票结果在网上公布：“中医药语义网络框架和代码标准”提案得到批准，作为新的项目立项，由中国、日本、韩国、荷兰和英国参与编制。这是我国中医药信息标准在ISO中首次成功立项，具有突破性的意义。</p>
    <p align="center">
        <a class="btn btn-lg btn-success" href="tcmls_sn.php" role="button"><span class="glyphicon glyphicon-book"></span>&nbsp;查看ISO技术规范</a>
    </p>
    <hr>
    <p class="lead"><strong>TCMLS的叙词表</strong></p>    
    <p>TCMLS在其Semantic Network的框架下，构建了一个面向中医药领域的叙词表。该表以概念为单位对中医药术语资源进行了系统化表达，并建立了概念与概念之间的语义关系。
    </p>
     <p align="center">
        <a class="btn btn-lg btn-success" href="db_profile.php?db_name=tcmls" role="button"><span class="glyphicon glyphicon-search"></span>&nbsp;浏览知识内容</a>
    </p>
    <hr>
    <p class="lead"><strong>总结</strong></p>
    <p>我所参考了UMLS等语言系统的结构特征，以中医药学科及相关学科知识为主干，设计了中医药学语言系统的结构。TCMLS的整体结构设计原则符合中医药学结构特点，且能满足现有中医药数字化需求。</p>
    <br>
    

    <hr>


</div> <!-- /container -->

<?php
include_once ("./foot.php");
?>