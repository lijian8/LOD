<?php
include_once ("./header.php");

if (isset($_GET['example'])) {
    include_once ($_GET['example'] . ".php");
} else {
    ?>
    <div align="center" class="container">
        <img width ="100%" src ="img/banner.jpg"></img>    
    </div>
    <br>
    <div class="container">
        <!--
        <div class="jumbotron">           
            <p class="lead">中国中医科学院中医药信息研究所长期致力于中医药领域数字资源的建设与利用工作，成功研制了中医药学语言系统、中医临床术语集等大型术语系统，以及结构性文献数据库(方剂数据库,医案数据库)。本网站集成了中医药领域的领域本体、术语资源（包括中医药学语言系统、中医临床术语集、中医古籍语言系统等），以及证候、中药、方剂等领域的知识库，面向中医专家提供知识检索、知识问答、知识浏览等服务。
            </p>
        </div>
        -->
        <div class="panel panel-default">
            <div class="panel-heading lead">关于本站</div>
            <div class="panel-body">
                <p class="lead">中国中医科学院中医药信息研究所长期致力于中医药领域数字资源的建设与利用工作，成功研制了中医药学语言系统、中医临床术语集等大型术语系统，以及结构性文献数据库(方剂数据库,医案数据库)。本网站集成了中医药领域的领域本体、术语资源（包括中医药学语言系统、中医临床术语集、中医古籍语言系统等），以及证候、中药、方剂等领域的知识库，面向中医专家提供知识检索、知识问答、知识浏览等服务。
                <p align="right"><a class="btn btn-link" href="about.php" target="_blank" role="button">查看详情 »</a></p>
            </div>
        </div>    

        <div class="panel panel-default">
            <div class="panel-heading lead">中医药标准和本体
                <a class="btn btn-link pull-right" href="ontologies.php"  target="_blank">
                    查看更多&nbsp;»
                </a>
            </div>
            <div class="panel-body">


                <div class="row"  >
                    <div class="col-lg-2">
                        <a class="btn btn-link" href="tcmls_sn.php"  target="_blank">
                            <img class="media-object" width="100%" src="img/iso-tcmls-sn.jpg"  alt="...">
                        </a>
                    </div>
                    <div class="col-lg-4">
                        <p class="lead"><a href="tcmls_sn.php" target="_blank">中医药学语言系统的语义网络框架</a></p>                      
                        <p> “Health informatics--Semantic network framework of traditional Chinese medicine language system [ISO/DTS 17938]”
                            （健康信息学—中医药学语言系统的语义网络框架）是国际标准化组织（ISO）于近期完成、正在审核的技术规范草案。</p>

                    </div>
                    <div class="col-lg-2">
                        <a class="btn btn-link" href="tcmlm.php"  target="_blank">
                            <img class="media-object" width="100%" src="img/iso-tcmlm.jpg"  alt="...">                         
                        </a>
                    </div>
                    <div class="col-lg-4">
                        <p class="lead"><a href="tcmlm.php" target="_blank">中医药文献元数据</a></p>
                        <p>目前国际上尚缺乏一部面向中医药领域的文献元数据技术规范，这不利于中医药文献的标引和检索。“ISO/DTS 17948 Traditional Chinese medicine literature metadata（中医药文献元数据）”是国际标准化组织（ISO）正在审核的技术规范草案。</p>

                    </div>
                </div>              
            </div>
        </div>


        <div class="panel panel-default">
            <div class="panel-heading lead">中医药术语集成</div>
            <div class="panel-body">
                <?php include_once ("./term_fusion.php"); ?>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading lead">中医药知识集成</div>
            <div class="panel-body">
                <div class="row" >
                    <div class="col-sm-6 col-md-6">
                        <a class="pull-left" href="#">
                            <img src="img/spleen.jpg" width="100%" alt="...">
                        </a>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <a class="pull-left" href="#">
                            <img src="img/herbnet.jpg"  width="100%"  alt="...">
                        </a>
                    </div>
                </div>
                <div class="row" align="center">
                    <div class="col-lg-6">
                        <p class="lead"><a href="doc_spleen.php"  target="_blank">中医脾系证候知识库</a></p>    
                        <p>中医脾系证候知识库对中医脾系证候的知识体系进行了系统梳理和准确表达。已经录入的数据有2710条，其中证候有265个，证候加减527个，疾病86个，方剂482个，中药385个，症状959个。概念间的关系有30种，10471个。
                            我们基于该知识库分析中医辨证论治的思维过程，探讨基于本体推理和问答系统来支持中医临床决策的方法。</p>
                        <p><a class="btn btn-link" href="index.php?db=spleen" target="_blank">知识检索&nbsp; »</a>
                            <a class="btn btn-link" href="db_profile.php?db_name=spleen"  target="_blank">分类导航&nbsp; »</a>
                            <a class="btn btn-link" href="doc_spleen.php"  target="_blank">知识问答&nbsp; »</a></p>            
                    </div>
                    <div class="col-lg-6">
                        <p class="lead"><a href="doc_herbnet.php"   target="_blank">中药数据库集成框架</a></p>
                        <p>中药数据库集成框架，基于面向中药领域的规范化数据模型， 集成中药药理实验数据库、中药化学实验数据库、中国中药化学成分数据库、中国方剂数据库、方剂现代应用数据库等数据库资源，包含中药基础信息、中药化学成分属性信息、方剂信息、药理作用、中药化学实验信息等，支持中药学研究。</p>
                        <p><a class="btn btn-link" href="index.php?db=herbnet" target="_blank" role="button">知识检索&nbsp; »</a></p>
                    </div>

                </div>
            </div>
        </div>



        <div class="panel panel-default">
            <div class="panel-heading lead">中医药知识服务</div>

            <div class="panel-body">
                <div class="row" align="center">
                    <div class="col-sm-6 col-md-4">
                        <a  href="index.php">
                            <img src="img/search.jpg" width="80%" alt="...">
                        </a>


                    </div>
                    <div class="col-sm-6 col-md-4">
                        <a  href="db_list.php">
                            <img src="img/navigate.jpg"  width="80%"  alt="...">
                        </a>

                        <!--
                        <div class="caption">
                            <h3>Thumbnail label</h3>
                            <p>...</p>
                            <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                        </div>-->

                    </div>
                    <div class="col-sm-6 col-md-4">
                        <a  href="qa_main.php">
                            <img src="img/qa_ui.jpg"  width="80%" alt="...">
                        </a>                        
                    </div>

                </div>
                <div class="row"  align="center">

                    <div class="col-sm-6 col-lg-4">
                        <p class="lead"><a href="doc_spleen.php" target="_blank">中医药知识检索</a></p>      
                        <p> 基于关键词，对术语系统和知识库中的内容进行检索（示例：<a href="ontologies.php"  target="_blank">人参</a>,&nbsp;
                            <a href="ontologies.php"  target="_blank">肾虚证</a>）。</p>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <p class="lead"><a href="db_list.php" target="_blank">中医药知识浏览</a></p>
                        <p>基于顶层语义网络，对术语系统和知识库进行分类导航和关联导航（示例：<a href="ontologies.php"  target="_blank">人参</a>,&nbsp;
                            <a href="semantic_network.php"  target="_blank">肾虚证</a>）。</p>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <p class="lead"><a href="qa_main.php" target="_blank">中医药知识问答</a></p>
                        <p>基于知识库，提供简单的交互式知识问答功能（示例：<a href="ontologies.php"  target="_blank">人参</a>,&nbsp;
                            <a href="ontologies.php"  target="_blank">肾虚证</a>）。
                        </p>
                    </div>
                </div>      


            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading lead">中医药复杂语义网络工作台</div>

            <div class="panel-body">
                <div class="row" align="center">                    
                     <div class="col-md-6">
                        <a  href="db_list.php">
                            <img src="img/tcmls/证候语义网络.jpg"  width="80%" alt="...">
                        </a>                        
                    </div>
                    <div class="col-md-6">
                        <a  href="db_list.php">
                            <img src="img/semantic_network.jpg"  width="80%" alt="...">
                        </a>                        
                    </div>
                </div>
                <br>
                <div class="row"  align="center">
                     <div class="col-sm-6 col-lg-4">
                        <p class="lead"><a href="semantic_network.php" target="_blank">中医药语义网络归纳</a></p>
                        <p>从各种大型中医药语义网络（如TCMLS）中归纳出语义类型之间的语义关系网络（即顶层语义网络）。
                        </p>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <p class="lead"><a href="semantic_network.php" target="_blank">中医药语义网络浏览</a></p>
                        <p>分别按语义类型和语义关系，对各种中医药领域的顶层语义网络进行浏览（示例：<a href="ontologies.php"  target="_blank">人参</a>,&nbsp;
                            <a href="ontologies.php"  target="_blank">肾虚证</a>）。
                        </p>
                    </div>
                     <div class="col-sm-6 col-lg-4">
                        <p class="lead"><a href="semantic_network.php" target="_blank">中医药语义网络比较</a></p>
                        <p>对中医药领域的顶层语义网络进行比较，生成比较统计报表（示例：<a href="ontologies.php"  target="_blank">人参</a>,&nbsp;
                            <a href="ontologies.php"  target="_blank">肾虚证</a>）。
                        </p>
                    </div>
                </div>  
            </div>
        </div>  

    </div>



    <?php
}
include_once ("./foot.php");
?>