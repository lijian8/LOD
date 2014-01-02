<?php
include_once ("./header.php");

if (isset($_GET['example'])) {
    include_once ($_GET['example'] . ".php");
} else {
    ?>
    <div align="center" class="container">
        <img width ="100%" src ="img/spleen_logo.jpg"></img>    
    </div>


    <div class="container">
        <br> 
        <p class="lead"><strong>项目介绍</strong></p>
        <p>我们在中国中医科学院
            基本科研业务费自主选题项目“构建中医脾系证候知识体系研究”的资助下，开展了构建中医脾系证候知识体系的示范研究。包括：一是基础研究：明确中医脏腑证侯的知识分类，实现准确描述中医脾系证候概念的含义，理顺概念间逻辑关系（包括语义关系），同时支持语义关系推理，以期获得概念间的隐性语义关系，为中医药信息后续研究搭建科研平台，为建立规范化数据库和统一检索平台提供可能；在此部分研究的基础上，探索中医知识体系框架的构建模式，二是应用研究：利用语义审核工具筛查语义关系，把分析对象之间错综复杂的共引网状关系简化并表示出来，实现概念的多维度、多层次关系的复杂展示，为中医基础理论知识的再利用提供服务。三是培养一支中医药信息理论研究的科研团队。
        </p>
        <hr>
        <p class="lead"><strong>知识库的内容</strong></p>
        <p>中医脾系证候知识库对中医脾系证候的知识体系进行了系统梳理，确定概念及其关系，准确描述以脏腑的辨证定位的中医脾系证候概念的含义，理顺概念间语义关系。已经录入的数据有2710条，其中证候有265个，证候加减527个，疾病86个，方剂482个，中药385个，症状959个。概念间的关系有30种，10471个。 
        </p>
        <p>我们在该知识库的基础上，通过一些相对简单但较为完整的中医临床案例，分析中医辨证论治的思维过程，探讨基于本体推理和问答系统来支持中医临床决策的方法。</p>

        <hr>
        <p class="lead"><strong>知识服务</strong></p>
        <p>我们在该知识库的基础上，提供了知识检索、知识浏览、知识问答等服务:</p>

        <div class="panel-group" id="accordion">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            <strong>1.&nbsp;知识问答：</strong>&nbsp;构建了中医问答系统的雏形，提供根据症状辨别证候，以及推荐处方等常见的问答形式。<span class="glyphicon glyphicon-chevron-down"></span>
                        </a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse">
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-lg-offset-1 col-lg-10">
                                <a href="qa_main.php">
                                    <img src="img/spleen_qa.jpg" width="100%"  alt="...">
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4" >
                                <p class="lead"><a href="qa_main.php">中医辨证问答</a></p>   
                                <p>在用户可输入一组症状，如口干,唇干,干呕,呃逆,面色潮红,皮肤干燥,大便干结等。系统从知识库中找出最为匹配的证候（如脾胃阴虚证）。下面是一些例子：</p>
                                <?php
                                $symptom_lists = array('口干,唇干,干呕,呃逆,面色潮红,皮肤干燥,大便干结', '舌淡红,苔少,脉细数,口干,饥不欲食,大便干结', '大便干结,腹胀,腹痛,口干,口臭,面赤,心烦', '发狂,咽喉肿痛,大便秘结,舌红,苔黄,脉滑数', '口苦,心烦,易怒,胸胁胀满,胃脘闷胀');
                                echo '<ol>';
                                foreach ($symptom_lists as $symptom_list) {
                                    echo '<li>';
                                    echo '<a target="_blank" href="qa.php?db_name=spleen&keywords=' . $symptom_list . '&submit=&question_type=症状">' . $symptom_list . '</a>';
                                    echo '</li>';
                                }
                                echo '</ol>';
                                ?>         

                            </div>
                            <div class="col-lg-4">
                                <p class="lead"><a href="qa_main.php">中医证候信息问答</a></o>
                                <p>用户输入证候（如“肝气犯胃证”），系统根据知识库向用户推荐合适的方剂，并可处理各种证候加减变化的情况。下面是一些例子：</p>
                                <?php
                                $syndromes = array('气滞湿阻证', '肝气犯胃证', '肺脾气虚证', '脾胃虚寒证', '胃阴虚证', '脾肾两虚证',
                                    '脾肾阳虚证', '心脾不足证', '肝胃不和证', '外邪犯胃证', '饮食伤胃证', '饮食内停证', '心脾不足证', '土败木贼证', '阳虚水泛证',
                                    '湿热中阻证', '湿热阻胃证', '瘀血内结证', '瘀血停胃证', '寒邪客胃证', '痰气交阻证', '痰湿中阻证'
                                );
                                $syndrome_links = array();
                                foreach ($syndromes as $syndrome) {
                                    array_push($syndrome_links, '<a target="_blank" href="qa.php?db_name=spleen&keywords=' . $syndrome . '&submit=&question_type=证候">' . $syndrome . '</a>');
                                }

                                $syndrome_pluses = array('脾胃虚寒，无泛吐清水，无手足不温者');

                                foreach ($syndrome_pluses as $syndrome_plus) {
                                    array_push($syndrome_links, '<a target="_blank" href="qa.php?db_name=spleen&keywords=' . $syndrome_plus . '&submit=&question_type=证候加减">' . $syndrome_plus . '</a>');
                                }


                                echo '<p>';
                                echo implode(';&nbsp;', $syndrome_links);
                                echo '</p>';
                                ?>

                            </div>
                            <div class="col-lg-4">
                                <p class="lead"><a href="qa_main.php">中医疾病信息问答</a></p>
                                <p>用户可输入疾病名称（如痰饮），系统基于知识库向用户推荐方剂（如苓桂术甘汤），并列出相关证候的简要信息。下面是一些例子：</p>

                                <?php
                                $diseases = array('痰饮', '消渴', '胃痛', '虚劳', '黄疸', '肥胖',
                                    '泄泻', '不寐', '中风', '便秘', '吐血', '多寐', '头痛', '尿血',
                                    '感冒', '痢疾', '痴呆', '眩晕', '紫斑', '腹痛', '遗精', '郁证',
                                    '阳痿', '颤证', '黄疸', '鼓胀', '鼻衄', '齿衄');
                                $disease_links = array();
                                foreach ($diseases as $disease) {
                                    array_push($disease_links, '<a target="_blank" href="qa.php?db_name=spleen&keywords=' . $disease . '&submit=&question_type=疾病">' . $disease . '</a>');
                                }

                                echo '<p>';
                                echo implode(';&nbsp;', $disease_links);
                                echo '</p>';
                                ?>

                            </div>
                        </div> 
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                            <strong>2.&nbsp;知识检索：</strong>&nbsp;实现基于关键词的知识检索功能，提供概念的基本信息以及信息界面链接。<span class="glyphicon glyphicon-chevron-down"></span>
                        </a>
                    </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="row" align="center">
                            <div class="col-lg-12" >
                                <a href="search.php?keywords=肝气犯胃证&db_name=spleen">
                                    <img src="img/spleen_search.jpg" width="80%"  alt="...">
                                </a>
                            </div>   
                            <div class="col-lg-offset-2 col-lg-8" >
                                <p class="lead"><a href="search.php?keywords=肝气犯胃证&db_name=spleen">基于关键词的知识检索界面</a></p>
                                <p>系统提供了基于关键词的知识检索功能:用户可输入关键词——“肝气犯胃证”，系统将会提供“肝气犯胃证”等概念的基本信息，并推荐“肝气犯胃证”的相关链接。系统还提供了“肝气犯胃证”、“胃痛”等概念的链接：当用户点击这些概念的链接时，系统将引导到这些概念的相关页面。
                                </p> 
                            </div>
                        </div>


                    </div>

                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                            <strong>3.&nbsp;知识浏览：</strong>&nbsp;系统以Web的方式向网络用户提供知识浏览与导航功能。<span class="glyphicon glyphicon-chevron-down"></span>
                        </a>
                    </h4>
                </div>
                <div id="collapseThree" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-offset-2 col-lg-3" >
                                <a href="entity.php?id=679&db_name=spleen" target="_blank">
                                    <img src="img/spleen_concept.jpg" width="100%"  alt="...">
                                </a>
                            </div>   
                            <div class="col-lg-6" >
                                <br>
                                <p class="lead"><a href="entity.php?id=679&db_name=spleen" target="_blank">以概念为单位的知识浏览</a></p>
                                系统以概念为单位对中医脾系证候知识库进行展示，它提供概念信息的展示功能，以及基于概念语义关系的知识导航功能。
                                例如，在<a href="entity.php?id=679&db_name=spleen" target="_blank">“脾胃阴虚证”信息的展示界面</a>中，提供了“脾胃阴虚证”的中文正名、类型、来源等信息，基于“现象表达”关系导航到该证候相关的疾病，
                                并基于“由…组成”关系导航到该证候相关的“症状”。
                            </div>   

                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-offset-1 col-lg-4" >
                                <a href="db_profile.php?db_name=spleen&active_class=%E8%AF%81%E5%80%99" target="_blank">
                                    <img src="img/spleen_nav1.jpg" width="100%"  alt="...">
                                </a>
                            </div>   
                            <div class="col-lg-6" >
                                <br>
                                <p class="lead"><a href="db_profile.php?db_name=spleen&active_class=%E8%AF%81%E5%80%99" target="_blank">简单的分类导航界面</a></p>
                                在该界面中，左侧为一个简单的类型列表，提供了语义类型的名称及其实例数量；当用户选择某一类型时，系统列出该类型的实例。当用户点击某一概念的链接时，系统会导航到该概念的展示界面。
                            </div>   
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-offset-1 col-lg-4" >
                                <a href="db_property_profile.php?db_name=spleen&active_relation=由...组成" target="_blank">
                                    <img src="img/spleen_nav2.jpg" width="100%"  alt="...">
                                </a>
                            </div>  
                            <div class="col-lg-6" >
                                <br>
                                <p class="lead"><a href="db_property_profile.php?db_name=spleen&active_relation=由...组成" target="_blank">语义关系的导航界面</a></p>
                                在界面的左侧，列出了知识库中的语义关系（如“由…组成”、“来源于”、“上位词”、“下位词”等）以供用户选择。比如，当用户选择“由…组成”时，系统则分页显示知识库中所有的“由…组成”关系。用户还可以输入关键词对语义关系进行筛选。
                            </div>   

                        </div>                      
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                            <strong>4.&nbsp;语义网络：</strong>&nbsp;顶层语义网络是由语义类型所构成的关系网络。系统提供按类型和关系对语义网络进行浏览的功能。<span class="glyphicon glyphicon-chevron-down"></span>
                        </a>
                    </h4>
                </div>
                <div id="collapseFour" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="row" align="center">
                            <div class="col-lg-6" >
                                <a href="sn_profile.php?db_name=spleen&active_class=%E8%AF%81%E5%80%99" target="_blank">
                                    <img src="img/spleen_semantic_network.jpg" width="80%"  alt="...">
                                </a>
                            </div>   
                            <div class="col-lg-6" >

                                <a href="http://localhost/LOD/sn_relation_search.php?db_name=spleen&subject=%E8%AF%81%E5%80%99&predicate=&object=" target="_blank">
                                    <img src="img/spleen_semantic_network_1.jpg" width="100%"  alt="...">
                                </a>
                            </div>
                        </div>
                        <div class="row" align="center">
                            <div class="col-lg-6" >
                                <p class="lead"><a href="sn_profile.php?db_name=spleen&active_class=%E8%AF%81%E5%80%99" target="_blank">按类型的语义网络浏览界面</a></p>
                                <p>顶层语义网络是由语义类型所构成的关系网络。我们开发了一个用于浏览顶层语义网络的界面，
                                    它列出“证候库”中的语义类型（包括症状、证候加减、方剂、中药、证候、疾病和工具书）供用户选择；
                                    当用户选择某一类型（如“证候”）时，系统会列出相关的语义关系（如“证候 由…组成 症状”）。用户可点击某一语义关系，进一步查看该关系的实例。
                                    例如，“证候 由…组成 症状”的实例包括“脾肺气虚证 由…组成 气短”、“脾肺气虚证 由…组成 腹胀”等。
                                </p>                               
                            </div>   
                            <div class="col-lg-6" >
                                <p class="lead"><a href="http://localhost/LOD/sn_relation_search.php?db_name=spleen&subject=%E8%AF%81%E5%80%99&predicate=&object=" target="_blank">语义关系搜索界面</a></p>
                                <p>
                                    用户可以任选主体、谓词和客体的类型，系统则将符合条件的语义关系分门别类地展示出来。
                                    用户可选择“证候”作为主体，查看相关的语义关系。系统则显示出“证候 由…组成 症状”、“证候 来源于 工具书”、“证候 现象表达 疾病”等关系。
                                    对于每条顶层语义关系，系统都给出了一些实例供用户参考。例如，“证候 由…组成 症状”的例子包括“肺脾气虚证 由…组成 气短”,“肺脾气虚证 由…组成 倦怠”等。
                                    又如，若用户若想了解“哪些类型的事物可以治疗证候”，则可选择主体为“任意事物”，谓词为“治疗”，客体为“证候”，系统会显示“方剂 治疗 证候”等关系。
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Tab panes -->

        <hr>
        <p class="lead"><strong>总结</strong></p>
        <p>通过建构中医知识体系中医脏腑证候部分，摸索出一套较为成熟的知识体系构建方法，为构建中医知识体系中的其他部分的研究提供参考。</p>
        <br>
        <p align="center"><a class="btn btn-lg btn-success" href="ontologies/spleen-1.0.owl" role="button"><span class="glyphicon glyphicon-cloud-download"></span>&nbsp;下载OWL本体</a>
            &nbsp;<a class="btn btn-lg btn-primary" href="docs/spleen.docx" role="button"><span class="glyphicon glyphicon-book"></span>&nbsp;下载技术报告</a></p>

        <hr>


    </div> <!-- /container -->

    <?php
}
include_once ("./foot.php");
?>