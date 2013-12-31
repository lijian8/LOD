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
        <h1>相关科研项目</h1>
        <hr>
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

        </div>
        <hr>
    </div>





    </div>



    <?php
}
include_once ("./foot.php");
?>