<?php
include_once ("./header.php");
?>
<div class="container">
    <div class="panel panel-default">   
        <div class="panel-body">
            <p>
                <img width ="100%" src ="img/tcmls_logo.jpg"></img>  
            </p>
            <p class="lead"><strong>系统介绍</strong></p>
            <p>
                中医药学语言系统（Traditional Chinese Medicine Language System，TCMLS）
                是以中医药学科体系为核心，遵循中医药学语言特点，借鉴语义网络的理念，建立的一个中医药学语言集成系统。

                它的词库涵盖了中医药学科系统及与中医药学科相关联的生物、植物、化工等自然与人文科学专业词汇。

                TCMLS的核心组件是一个大型的复杂语义网络，通过将中医药学概念中隐含的各种语义关系全部提取出来，形成关系表，并以此为中心，
                建立学科术语概念与概念、概念与名词、概念与含义、名词与名词之间的内在联系，形成一个网状的信息表示结构。
            </p>
            <p>
                我所参考了UMLS等语言系统的结构特征，以中医药学科及相关学科知识为主干，设计了中医药学语言系统的结构。
                TCMLS主要包括语义网络和基础词库两大部分。TCMLS的整体结构设计原则符合中医药学结构特点，且能满足现有中医药数字化需求。
            </p>
            <p>
                <a class="btn btn-default" href="entity.php?id=260000&db_name=tcmls"><span class="glyphicon glyphicon-search">
                    </span>&nbsp;术语浏览</a>
                <a class="btn btn-default" href="index.php?db=tcmls"><span class="glyphicon glyphicon-search">

                    </span>&nbsp;术语检索</a>

            </p>


            <hr>
            <p class="lead"><strong>语义网络</strong></p>
            <p>语义网络的上层结构包括97种语义类型和55种语义关系，下面分别加以介绍：
            <ul>
                <li>语义类型（Semantic Type）：TCMLS制定了97种语义类型，其中39种属于实体类型，而58种属于事件类型。          
                </li>
                <li>语义关系（Semantic Relation）：TCMLS制定了55种语义关系，除了代表上下位父子关系的等级关系外，还包括54种相关关系，并且按照物理上相关、空间上相关、影响、时间上相关、概念上相关这五个大类展开。            
                </li>
            </ul>


            <p>ISO/TC215健康信息学全体大会于2011年10月19-21日在芝加哥召开，我国代表团全程参加了传统医学任务组（TM TF）会议、语义术语组（WG3）会议、ISO/TC215全体大会。此次会议上，我国代表团提出了标准项目提案“Semantic network framework and coding of traditional Chinese medicine （中医药语义网络框架和代码）”。2012年2月24日，会议投票结果在网上公布：“中医药语义网络框架和代码标准”提案得到批准，作为新的项目立项，由中国、日本、韩国、荷兰和英国参与编制。这是我国中医药信息标准在ISO中首次成功立项，具有突破性的意义。</p>
            <p>
                <a class="btn btn-default" href="sn_profile.php?db_name=tcmls" role="button"><span class="glyphicon glyphicon-search"></span>&nbsp;浏览语义网络</a>&nbsp;
                &nbsp;&nbsp;
                <a class="btn btn-primary" href="tcmls_sn.php" role="button"><span class="glyphicon glyphicon-book"></span>&nbsp;查看ISO技术规范</a>
            </p>
            <hr>
            <p class="lead"><strong>基础词库</strong></p>    
            <p>TCMLS在其语义网络的框架下，构建了一个面向中医药领域的基础词库。它以概念为单位对中医药术语资源进行了系统化表达，并建立了概念与概念之间的语义关系。
                TCMLS的基础词库包括如下16个大类：
            </p>


            <div class="panel panel-default">
                <div class="panel-body">
                    <a href="entity.php?id=163297&db_name=tcmls">自然科学与物理科学</a>&nbsp;&nbsp;
                    <a href="entity.php?id=163292&db_name=tcmls">地理学</a>&nbsp;&nbsp;
                    <a href="entity.php?id=324391&db_name=tcmls">治则治法3</a>&nbsp;&nbsp;
                    <a href="entity.php?id=1018&db_name=tcmls">医学信息学与文献学</a>&nbsp;&nbsp;
                    <a href="entity.php?id=1&db_name=tcmls">方剂学</a>&nbsp;&nbsp;
                    <a href="entity.php?id=163298&db_name=tcmls">卫生医疗机构管理</a>&nbsp;&nbsp;
                    <a href="entity.php?id=66706&db_name=tcmls">病因病机与诊断</a>&nbsp;&nbsp;
                    <a href="entity.php?id=33645&db_name=tcmls">预防与养生学</a>&nbsp;&nbsp;
                    <a href="entity.php?id=66834&db_name=tcmls">治则治法</a>&nbsp;&nbsp;
                    <a href="entity.php?id=276&db_name=tcmls">针灸学</a>&nbsp;&nbsp;
                    <a href="entity.php?id=1004&db_name=tcmls">药用动植物学</a>&nbsp;&nbsp;
                    <a href="entity.php?id=1209&db_name=tcmls">中医学说与相关学科</a>&nbsp;&nbsp;
                    <a href="entity.php?id=1236&db_name=tcmls">疾病</a>&nbsp;&nbsp;
                    <a href="entity.php?id=163290&db_name=tcmls">人文科学</a>&nbsp;&nbsp;
                    <a href="entity.php?id=163280&db_name=tcmls">中药化学</a>&nbsp;&nbsp;
                    <a href="entity.php?id=1108&db_name=tcmls">中药学</a>&nbsp;&nbsp;
                    <a href="entity.php?id=43&db_name=tcmls">中医基础理论</a> 
                </div>       
            </div>   
            <p>
                <a class="btn btn-default" href="db_profile.php?db_name=tcmls" role="button"><span class="glyphicon glyphicon-search"></span>&nbsp;浏览概念实体</a>
            </p>
            <hr>
            <p class="lead"><strong>相关链接</strong></p>
            <ul>
                <li>
                    <p><a href="http://www.cintcm.ac.cn/opencms/opencms/xxyj/zyybzyj/news_0001.html" target="_blank">查看中医药学语言系统的介绍</a></p>
                </li>
                <li>
                    <p><a href="http://tcmls.cintcm.com:8888/conceptchoir/tccontroller?pEvent=WELCOME" target="_blank">进入加工系统</a></p>
                </li>
            </ul>
        </div> <!-- /container -->

    </div>
</div>
<?php
include_once ("./foot.php");
?>