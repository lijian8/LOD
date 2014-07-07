<?php
include_once ("./header.php");
?>

<div align="center" class="container">
    <img width ="100%" src ="img/ontologies.jpg"></img>    

</div>
<div class="container">


    <div class="well">
        <p class="lead">我所近年来参与了国际标准化组织（ISO）的中医药信息标准化工作，编制了“Health informatics--Semantic network framework of traditional Chinese medicine language system [ISO/DTS 17938]”（健康信息学—中医药学语言系统的语义网络框架）和“ISO/DTS 17948 Traditional Chinese medicine literature metadata（中医药文献元数据）”等国际技术规范。在此，提供这些技术规范的本体模型，在语义网的环境中推动中医药术语的标准化。</p>
        <p><a class="btn  btn-success" href="http://v3.bootcss.com/examples/justified-nav/#" role="button">查看相关综述&nbsp;>></a></p>
    </div>

    <!-- Jumbotron -->


    <!-- Example row of columns -->
    <div class="row">
        <div class="col-lg-3">
            <a class="btn btn-link" href="tcmls_sn.php" target="_blank">
                <img class="media-object pull-left" width="80%" src="img/iso-tcmls-sn.jpg"  alt="...">
            </a>
        </div>
        <div class="col-lg-offset-1 col-lg-8">
            <h2><a href="tcmls_sn.php" target="_blank">中医药学语言系统的语义网络框架</a></h2>
            <p >TCMLS-SN本体为“中医药学语言系统的语义网络框架(TCMLS Semantic Network)”的OWL/RDF版本。中医药学语言系统（TCMLS）旨在实现规范化、一体化的中医药术语体系，以支持中医药文献与数据资源的合理组织和有效检索。“Health informatics--Semantic network framework of traditional Chinese medicine language system [ISO/DTS 17938]”（健康信息学—中医药学语言系统的语义网络框架）是国际标准化组织（ISO）于近期完成、正在审核的技术规范草案。它作为一个面向中医药领域的规范化顶层本体，为中医药学语言系统中的所有概念提供了一体化的概念框架，对于中医药学语言系统的规范化和国际化具有重要意义。</p>


            <p><a class="btn btn-primary" href="tcmls-sn.rdf" role="button">下载本体&nbsp;>></a></p>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-3">
            <a class="btn btn-link " href="tcmlm.php"  target="_blank">
                <img class="media-object pull-left" width="80%" src="img/iso-tcmlm.jpg"  alt="...">                         
            </a>
        </div>
        <div class="col-lg-offset-1 col-lg-8">
            <h2><a href="tcmlm.php" target="_blank">中医药文献元数据本体</a></h2>
            <p>目前在国际上尚缺乏一部面向中医药领域的文献元数据技术规范，这不利于中医药文献的标引和检索。“ISO/DTS 17948 Traditional Chinese medicine literature metadata（中医药文献元数据）”是国际标准化组织（ISO）于近期完成、正在审核的技术规范草案。它反映了中医药文献的特点，对于中医药文献资源的系统保护和深度利用具有重要意义。本文阐述该技术规范草案的内容和特点，对其与相关元数据标准进行比较分析。</p>
            <p><a class="btn btn-primary" href="tcmlm.rdf" role="button">下载本体&nbsp;>></a></p>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-4">
            <br>
            <a class="btn btn-link " href="herbnet.php"  target="_blank">
                <img class="media-object pull-left" width="100%" src="img/herbnet-network.jpg"  alt="...">                         
            </a>
        </div>
        <div class="col-lg-8">
            <h2><a href="herbnet.php" target="_blank">Herbnet: 中药领域顶层本体</a></h2>
            <p>随着互联网技术的迅猛发展，日积月累并不断涌现大量内容丰富、种类各异的数据，
        结构化、半结构化、非结构化数据并存的混合型数据具有海量、异构、个性化、复杂的特点。
        当前应用中，对信息个性化增值服务方面存在广泛需求。本文提出了一个简单的中药领域顶层本体——Herbnet框架。
        Herbnet框架为实现中药数据库集成提供了基本的顶层本体框架。
        Herbnet框架是根据中药领域模型的特点，从“中医药学语言系统的语义网络框架（以下简称TCMLS-SN）”中抽取一部分元素而构建出来的。</p>
            <p><a class="btn btn-primary" href="herbnet.rdf" role="button">下载本体&nbsp;>></a></p>
        </div>
    </div>
    <hr>
</div> <!-- /container -->

<?php
include_once ("./foot.php");
?>