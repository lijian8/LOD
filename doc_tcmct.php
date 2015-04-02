<?php
include_once ("./header.php");
?>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-body">
            <p>
                <img width ="100%" src ="img/tcmct_logo.jpg"></img>   
            </p> 
            <p class="lead"><strong>系统介绍</strong></p>
            <p>
                中医药临床术语集（Traditional Chinese Medicine Clinical Terms，TCMCT）
                是IITCM以中医自身独特理论为核心，借鉴SNOMED CT的概念分轴、语义关联等体例和其在适应信息化发展过程中采用的编码方式，吸收国内已完成的对中医术语标准化研究成果，采用当前成熟的本体论工程和术语知识库构建方法，完成的一部具有中医特色、能够实现与世界水平同步接轨、概念标准、分类合理、编码完善、易于被计算机处理和被临床医生广泛接受的中医药临床术语集。TCMCT中每个术语实例的内容包括：概念词、名称字符类、概念定义、相关概念、概念状态、状态原因等。TCMCT主要收词范围为：中医药领域的国标、行标、全国中医药院校教科书、中医药学主题词表、权威中医药字典、词典以及中医临床病历用词等。
            </p>
            <p>
                <a class="btn btn-default" href="entity.php?id=370495&db_name=tcmct"><span class="glyphicon glyphicon-search">
                    </span>&nbsp;术语浏览</a>
                <a class="btn btn-default" href="index.php?db=tcmct"><span class="glyphicon glyphicon-search">
                    </span>&nbsp;术语检索</a>
            </p>
            <hr>
            <p class="lead"><strong>顶层语义网络</strong></p>
            <p>TCMCT包含一个大型的复杂语义网络，它完整、系统性地表达了中医药临床概念之间的各种语义关系。该语义网络的上层结构包括“术语分类操作性框架” （即语义类型）和“连接词”（即语义关系）。术语分类操作性框架将“临床发现”和“操作/治疗方法”作为两大分类主轴，并设定了“病、证”、“药物器械”、“处方”、“机体形态”、“环境”、“量词”、“连接词”、“特殊概念”等分类轴，从而对所收录的中医药专有术语进行分类。另外，TCMCT使用60个连接词，将具有内在关系的概念两两联结起来，构成形如“概念1+连接词+概念2”的陈述，用以明确描述一个临床事件。
            </p>
            <p>
                <a class="btn btn-default" href="sn_profile.php?db_name=tcmct" role="button"><span class="glyphicon glyphicon-search"></span>&nbsp;浏览语义网络</a>
            </p>
            <hr>
            <p class="lead"><strong>词库</strong></p>
            <p>TCMCT已收录10万多个中医临床概念，它们分为12个大类：</p>
            <div class="panel panel-default">
                <div class="panel-body">
                    <a href="entity.php?id=163&db_name=tcmct">临床发现</a>
                    <a href="entity.php?id=240&db_name=tcmct">药物/器械</a>
                    <a href="entity.php?id=244&db_name=tcmct">处方</a>
                    <a href="entity.php?id=247&db_name=tcmct">机体形态</a>
                    <a href="entity.php?id=250&db_name=tcmct">环境</a>
                    <a href="entity.php?id=253&db_name=tcmct">量词</a>
                    <a href="entity.php?id=260&db_name=tcmct">连接词</a>
                    <a href="entity.php?id=5836&db_name=tcmct">经验</a>
                    <a href="entity.php?id=262&db_name=tcmct">中医病证</a>
                    <a href="entity.php?id=85&db_name=tcmct">操作/治疗方法</a>
                    <a href="entity.php?id=6113&db_name=tcmct">特殊概念</a>
                    <a href="entity.php?id=1&db_name=tcmct">原理</a>
                </div>
            </div>
            <hr>
            <p class="lead"><strong>相关链接</strong></p>
            <ul>
                <li>
                    <p><a href="http://www.cintcm.ac.cn/opencms/opencms/xxyj/zyybzyj/zyyyyx.html" target="_blank">查看中医药临床术语集的介绍</a></p>
                </li>
                <li>
                    <p><a href="http://tcmls.cintcm.com:8888/snomed/tccontroller?pEvent=WELCOME" target="_blank">进入加工系统</a></p>
                </li>
            </ul>
            
        </div>
    </div> <!-- /container -->
</div>
<?php
include_once ("./foot.php");
?>