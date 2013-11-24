<?php
include_once ("./header.php");


    ?>

    <div class="container">

        <div class="well">
            <h1>中医药领域的本体资源</h1>
            <p class="lead">中医药领域的本体资源。</p>
            <p><a class="btn  btn-success" href="http://v3.bootcss.com/examples/justified-nav/#" role="button">查看相关综述&nbsp;>></a></p>
        </div>

        <!-- Jumbotron -->


        <!-- Example row of columns -->
        <div class="row">
            <div class="col-lg-6">
                <h2><a href="tcmls_sn.php" target="_blank">中医药学语言系统的语义网络框架</a></h2>
                <p>TCMLS-SN本体为“中医药学语言系统的语义网络框架(TCMLS Semantic Network)”的OWL/RDF版本。中医药学语言系统（TCMLS）旨在实现规范化、一体化的中医药术语体系，以支持中医药文献与数据资源的合理组织和有效检索。“Health informatics--Semantic network framework of traditional Chinese medicine language system [ISO/DTS 17938]”（健康信息学—中医药学语言系统的语义网络框架）是国际标准化组织（ISO）于近期完成、正在审核的技术规范草案。它作为一个面向中医药领域的规范化顶层本体，为中医药学语言系统中的所有概念提供了一体化的概念框架，对于中医药学语言系统的规范化和国际化具有重要意义。</p>


                <p><a class="btn btn-primary" href="tcmls-sn.rdf" role="button">下载本体&nbsp;>></a></p>
            </div>

            <div class="col-lg-6">
                <h2><a href="tcmlm.php" target="_blank">中医药文献元数据本体</a></h2>
                <p>目前在国际上尚缺乏一部面向中医药领域的文献元数据技术规范，这不利于中医药文献的标引和检索。“ISO/DTS 17948 Traditional Chinese medicine literature metadata（中医药文献元数据）”是国际标准化组织（ISO）于近期完成、正在审核的技术规范草案。它反映了中医药文献的特点，对于中医药文献资源的系统保护和深度利用具有重要意义。本文阐述该技术规范草案的内容和特点，对其与相关元数据标准进行比较分析。</p>
                <p><a class="btn btn-primary" href="tcmlm.rdf" role="button">下载本体&nbsp;>></a></p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <h2><a>症状</a></h2>

                <p>“中医通过望神，发现病人处于‘郁怒’的状态；进一步辨认出病人具有‘肝气郁结’等的证候，据此确定‘疏肝理气’等治法；最后开出‘柴胡疏肝散’用于治疗”。这一推理案例虽然简单，但涉及了诊断、辨证、立法和组方等中医临床推理的基本环节。</p>
                <p><a class="btn btn-primary" href="http://v3.bootcss.com/examples/justified-nav/#" role="button">查看详情 »</a></p>
            </div>
            <div class="col-lg-4">
                <h2>证候</h2>
                <p> 证型是具有标准名称的证候类型，它是由包括阴阳、五行、脏腑和精微物质在内的中医术语所构成的复合概念。
                    证型之间通过层次关系构成一个层次结构；尽管不同病人的病理变化以及临床表现纷繁复杂，但运用证候层次结构可以对病情进行统一的分门别类。结合具体案例对中医证候知识和层次结构进行建模... </p>
                <p><a class="btn btn-primary" href="http://v3.bootcss.com/examples/justified-nav/#" role="button">查看详情 »</a></p>
            </div>
            <div class="col-lg-4">
                <h2>方剂</h2>
                <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa.</p>
                <p><a class="btn btn-primary" href="<?php echo $_SERVER['PHP_SELF'] . '?example=formula'; ?>" role="button">查看详情 »</a></p>
            </div>
        </div>
        <hr>
    </div> <!-- /container -->

    <?php

include_once ("./foot.php");
?>