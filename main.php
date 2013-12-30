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
                <p align="right"><a class="btn btn-link" href="http://v3.bootcss.com/examples/justified-nav/#" role="button">查看详情 »</a></p>
            </div>
        </div>    



        <div class="panel panel-default">
            <div class="panel-heading lead">中医药术语系统</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-4">                        
                        <p class="lead"><a href="doc_spleen.php">中医药学语言系统</a></p>
                        <p >“中医药学语言系统（Traditional Chinese Medicine Language System，TCMLS）”是以中医药学科体系为核心的大型计算机化语言系统，共收录约10万条概念词、30 万个术语和130万条语义关系。</p>
                        <p><a class="btn btn-link" href="<?php echo $_SERVER['PHP_SELF'] . '?example=syndrome'; ?>" role="button">查看详情 »</a></p>
                    </div>
                    <div class="col-lg-4">
                        <p class="lead"><a href="<?php echo $_SERVER['PHP_SELF'] . '?example=syndrome'; ?>">中医临床术语集</a></p>
                        <p> “中医药临床术语集（Traditional Chinese Medicine Clinical Terms，TCMCT）”是专门面向中医临床领域的大型术语集，共收录11万多条概念词，27万多个术语，可用于电子病历、临床决策支持等多种应用。 </p>
                        <p><a class="btn btn-link" href="<?php echo $_SERVER['PHP_SELF'] . '?example=syndrome'; ?>" role="button">查看详情 »</a></p>
                    </div>
                    <div class="col-lg-4">
                        <p class="lead"><a href="doc_spleen.php">中医古籍语言系统</a></p>
                        <p>中医古籍语言系统是以中医药学语言系统（TCMLS）为依托，以TCMLS的语义类型和语义关系为基础构建的，旨在初步建立中医古籍蕴含的概念知识点之间的语义网络，从而实现与TCMLS的兼容检索与查询。</p>
                        <p><a class="btn btn-link" href="http://v3.bootcss.com/examples/justified-nav/#" role="button">查看详情 »</a></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading lead">中医药知识集成</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <p class="lead"><a href="doc_spleen.php"  target="_blank">中医脾系证候知识库</a></p>    
                        <p>中医脾系证候知识库对中医脾系证候的知识体系进行了已经录入的数据有2710条，其中证候有265个，证候加减527个，疾病86个，方剂482个，中药385个，症状959个。概念间的关系有30种，10471个。
                            我们基于该知识库分析中医辨证论治的思维过程，探讨基于本体推理和问答系统来支持中医临床决策的方法。</p>
                        <p><a class="btn btn-link" href="doc_spleen.php"  target="_blank">查看详情 »</a></p>            
                    </div>
                    <div class="col-lg-6">
                        <p class="lead"><a href="<?php echo $_SERVER['PHP_SELF'] . '?example=syndrome'; ?>">中药数据库集成框架</a></p>
                        <p>中药数据库集成框架，基于面向中药领域的规范化数据模型， 集成中药药理实验数据库、中药化学实验数据库、中国中药化学成分数据库、中国方剂数据库、方剂现代应用数据库等数据库资源，包含中药基础信息、中药化学成分属性信息、方剂信息、药理作用、中药化学实验信息等，支持中药学研究。</p>
                        <p><a class="btn btn-link" href="<?php echo $_SERVER['PHP_SELF'] . '?example=syndrome'; ?>" role="button">查看详情 »</a></p>
                    </div>

                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading lead">中医药领域本体</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <p class="lead"><a href="doc_spleen.php" target="_blank">中医药学语言系统的语义网络框架</a></p>                      
                        <p> “Health informatics--Semantic network framework of traditional Chinese medicine language system [ISO/DTS 17938]”
                            （健康信息学—中医药学语言系统的语义网络框架）是国际标准化组织（ISO）于近期完成、正在审核的技术规范草案。它作为一个面向中医药领域的规范化顶层本体，
                            为中医药学语言系统中的所有概念提供了一体化的概念框架，对于中医药学语言系统的规范化和国际化具有重要意义。</p>
                        <p><a class="btn btn-link" href="ontologies.php"  target="_blank">查看详情 »</a></p>            
                    </div>
                    <div class="col-lg-6">
                        <p class="lead"><a href="ontologies.php" target="_blank">中医药文献元数据本体</a></p>
                        <p>目前在国际上尚缺乏一部面向中医药领域的文献元数据技术规范，这不利于中医药文献的标引和检索。“ISO/DTS 17948 Traditional Chinese medicine literature metadata（中医药文献元数据）”是国际标准化组织（ISO）于近期完成、正在审核的技术规范草案。它反映了中医药文献的特点，对于中医药文献资源的系统保护和深度利用具有重要意义。</p>
                        <p><a class="btn btn-link" href="ontologies.php"  target="_blank">查看详情 »</a></p>
                    </div>
                </div>              
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading lead">中医药知识服务</div>

            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <a class="pull-left" href="#">
                            
                       
                            <img src="img/search.jpg" width="100%" alt="...">
                             </a>
                          
                       
                    </div>
                    <div class="col-sm-6 col-md-4">
                        
                            <img src="img/navigate.jpg"  width="100%"  alt="...">
                            <!--
                            <div class="caption">
                                <h3>Thumbnail label</h3>
                                <p>...</p>
                                <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                            </div>-->
                        
                    </div>
                    <div class="col-sm-6 col-md-4">
                      
                            <img src="img/qa_ui.jpg"  width="100%" alt="...">
                           
                       
                    </div>
                </div>
              

                <div class="row"  align="center">
                    <div class="col-sm-6 col-lg-4">

                        <p class="lead"><a href="doc_spleen.php" target="_blank">中医药知识检索</a></p>       

                        <p> “Health informatics--Semantic network framework of traditional Chinese medicine language system [ISO/DTS 17938]”
                            （健康信息学—中医药学语言系统的语义网络框架）是国际标准化组织（ISO）于近期完成、正在审核的技术规范草案。它作为一个面向中医药领域的规范化顶层本体，
                            为中医药学语言系统中的所有概念提供了一体化的概念框架，对于中医药学语言系统的规范化和国际化具有重要意义。</p>
                        <p><a class="btn btn-link" href="ontologies.php"  target="_blank">查看详情 »</a></p>            
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <p class="lead"><a href="ontologies.php" target="_blank">中医药知识问答</a></p>
                        <p>目前在国际上尚缺乏一部面向中医药领域的文献元数据技术规范，这不利于中医药文献的标引和检索。“ISO/DTS 17948 Traditional Chinese medicine literature metadata（中医药文献元数据）”是国际标准化组织（ISO）于近期完成、正在审核的技术规范草案。它反映了中医药文献的特点，对于中医药文献资源的系统保护和深度利用具有重要意义。</p>
                        <p><a class="btn btn-link" href="ontologies.php"  target="_blank">查看详情 »</a></p>
                    </div>

                    <div class="col-sm-6 col-lg-4">
                        <p class="lead"><a href="ontologies.php" target="_blank">中医药知识浏览</a></p>
                        <p>目前在国际上尚缺乏一部面向中医药领域的文献元数据技术规范，这不利于中医药文献的标引和检索。“ISO/DTS 17948 Traditional Chinese medicine literature metadata（中医药文献元数据）”是国际标准化组织（ISO）于近期完成、正在审核的技术规范草案。它反映了中医药文献的特点，对于中医药文献资源的系统保护和深度利用具有重要意义。</p>
                        <p><a class="btn btn-link" href="ontologies.php"  target="_blank">查看详情 »</a></p>
                    </div>


                </div>              
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading lead">相关科研项目</div>
            <div class="panel-body">          
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                    面向中药领域的数据库集成框架研究
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse">
                            <div class="panel-body">
                                随着互联网技术的迅猛发展，日积月累并不断涌现大量内容丰富、种类各异的数据，结构化、半结构化、非结构化数据并存的混合型数据具有海量、异构、个性化、复杂的特点。当前应用中，对信息个性化增值服务方面存在广泛需求。本项目基于我所构建的12个中药相关数据库，分析数据库集成信息与结构，将已存、分布、自治、异构的数据库系统连接起来，抽取信息形成规范化数据模型，提出数据库与数据模型之间映射的数据集成方法，建立基于语义web的中药数据库集成框架。
                                <p align="right"><a class="btn btn-link" href="doc_herbnet.php"  target="_blank">查看详情 »</a></p>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                    构建中医脾系证候知识体系研究
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse">
                            <div class="panel-body">
                                研究目的是建立中医脾系证候知识体系，以中医脏腑部分为示范研究。包括：一是基础研究：明确中医脏腑证侯的知识分类，实现准确描述中医脾系证候概念的含义，理顺概念间逻辑关系（包括语义关系），同时支持语义关系推理，以期获得概念间的隐性语义关系，为中医药信息后续研究搭建科研平台，为建立规范化数据库和统一检索平台提供可能；在此部分研究的基础上，探索中医知识体系框架的构建模式，二是应用研究：利用语义审核工具筛查语义关系，把分析对象之间错综复杂的共引网状关系简化并表示出来，实现概念的多维度、多层次关系的复杂展示，为中医基础理论知识的再利用提供服务。三是培养一支中医药信息理论研究的科研团队。      
                                <p align="right"><a class="btn btn-link" href="doc_spleen.php"  target="_blank">查看详情 »</a></p>

                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                    Collapsible Group Item #3
                                </a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse">
                            <div class="panel-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </div>
                        </div>
                    </div>
                    <br>
                </div>

            </div>
        </div>




    </div>



    <?php
}
include_once ("./foot.php");
?>