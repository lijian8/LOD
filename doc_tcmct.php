<?php
include_once ("./header.php");
?>
<div align="center" class="container">
    <img width ="100%" src ="img/tcmct_logo.jpg"></img>    
</div>


<div class="container">
    <br> 
    <p class="lead"><strong>系统介绍</strong></p>
    <p>
        <a href="http://www.cintcm.ac.cn/opencms/opencms/xxyj/zyybzyj/zyyyyx.html" target="_blank">中医药临床术语集（Traditional Chinese Medicine Clinical Terms，TCMCT）</a>
        是IITCM以中医自身独特理论为核心，借鉴SNOMED CT的概念分轴、语义关联等体例和其在适应信息化发展过程中采用的编码方式，吸收国内已完成的对中医术语标准化研究成果，采用当前成熟的本体论工程和术语知识库构建方法，完成的一部具有中医特色、能够实现与世界水平同步接轨、概念标准、分类合理、编码完善、易于被计算机处理和被临床医生广泛接受的中医药临床术语集。TCMCT中每个术语实例的内容包括：概念词、名称字符类、概念定义、相关概念、概念状态、状态原因等。TCMCT主要收词范围为：中医药领域的国标、行标、全国中医药院校教科书、中医药学主题词表、权威中医药字典、词典以及中医临床病历用词等。
    </p>


    <hr>
    <p class="lead"><strong>顶层语义网络</strong></p>
    <p>TCMCT包含一个大型的复杂语义网络，它完整、系统性地表达了中医药临床概念之间的各种语义关系。该语义网络的上层结构包括“术语分类操作性框架” （即语义类型）和“连接词”（即语义关系）。术语分类操作性框架将“临床发现”和“操作/治疗方法”作为两大分类主轴，并设定了“病、证”、“药物器械”、“处方”、“机体形态”、“环境”、“量词”、“连接词”、“特殊概念”等分类轴，从而对所收录的中医药专有术语进行分类。另外，TCMCT使用60个连接词，将具有内在关系的概念两两联结起来，构成形如“概念1+连接词+概念2”的陈述，用以明确描述一个临床事件。
    </p>
    <p align="center">
        <a class="btn btn-lg btn-success" href="sn_profile.php?db_name=tcmct" role="button"><span class="glyphicon glyphicon-search"></span>&nbsp;浏览语义网络</a>

    </p>
    <br>




</div> <!-- /container -->

<?php
include_once ("./foot.php");
?>