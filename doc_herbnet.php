<?php
include_once ("./header.php");
?>
<div class="container">
    <div align="center" class="container">
        <img width ="100%" src ="img/herbnet-logo.jpg"></img>    
    </div>
    <br>
  
    <div class="container">
        <p class="lead"><strong>项目介绍</strong></p>
        <p>随着互联网技术的迅猛发展，日积月累并不断涌现大量内容丰富、种类各异的数据，结构化、半结构化、非结构化数据并存的混合型数据具有海量、异构、个性化、复杂的特点。当前应用中，对信息个性化增值服务方面存在广泛需求。本项目基于我所构建的12个中药相关数据库，分析数据库集成信息与结构，将已存、分布、自治、异构的数据库系统连接起来，抽取信息形成规范化数据模型，提出数据库与数据模型之间映射的数据集成方法，建立基于语义web的中药数据库集成框架。
        </p>
        <p class="lead"><strong>中药领域的数据库</strong></p>
        <p>中药的信息可以分为两类，一类是基本稳定的信息资源，包括中药的传统药效、分类学归属、生药学知识、炮制方法等，这类数据知识稳定，认可度高，需要建立标准的中药传统药效数据处理方法，对其标准规范使用。而另外一类是属于研究过程中还在不断增加的信息，如新的天然产物组分，天然产物的药理活性数据等。这类数据多由现代科学技术手段产生，可以对科研人员课题研究方面提供思路与方法。
        </p>
        <p>中国中医科学院中医药信息研究所的中医药科学数据平台中药相关数据库包括中药科技基础信息数据库、中药药理实验数据库、中药化学实验数据库、中药化学成分数据库、中国方剂数据库等，这些数据库系统展示了中医药不同领域的数据特点，数据来源既包括一些基础数据，如来源一些权威书籍《中国药典》、《中华本草》等的信息，数据知识稳定，内容丰富完整，另外还收录了中药不同类型的一次文献信息，这类信息不断更新，反映中药研究的前沿思路与方法。
        </p>
        <ul>
            <li><strong>中药科技基础信息数据库:</strong> 以“中国中药数据库”为基础数据，以权威工具书《中华本草》、《中华人民共和国药典》、《中国常用中药材》、《中国药材学》、《中药现代研究与临床应用》、《现代中药栽培养植与加工手册》、《常用中药成分与药理手册》、《植物活性成分辞典》、《天然活性成分简明手册》、《中药炮制学》以及普通高等教育中医药类规划教材为数据依据。结构上设计有8 张库表，即：单味药、品种、生药材鉴定、中药药理、中药毒理、中药临床药理、化学成分、炮制品,分别设有：14、17、26、30、18、26、27、14 共172 个字段。每张库表即可成为一个独立的个体，又与各表间有着一定的内在关联，使之成为一个有机的整体。

            </li>
            <li>
                <strong>中药药理实验数据库:</strong> 是以中药标准化与中医药科技期刊文献科学实验数据为依据，采用关系型数据库技术，建立关系型数据库模型，数据来源为中国中医药期刊文献数据中主题词包含有“药理学”的中药药理实验一次文献，内容包含中药单味药、方剂、中药化学成分等的药物信息，实验动物、药物作用部位、动物模型、造模方法等实验对象信息，疾病、证候、症状等疾病信息，药理分类、毒理分类等药理信息，以及实验指标和具体的数值数据等。
            </li>
            <li>
                <strong>中药化学实验数据库：</strong> 是以中医药科技期刊文献科学化学实验数据为依据，采用关系型数据库技术构建而成，数据来源为中国中医药期刊文献数据中主题词包含有“化学学”的中药化学实验一次文献，中药化学实验数据库面向中药研究人员，提供中药化学实验研究数据的检索与浏览、关联导航、统计分析。
            </li>
            <li>
                <strong>
                    中国中药化学成分数据库：</strong>  为全面介绍中药化学成分的工具型数据库，共收录相关的中药化学成分14032种，该数据库的编制参考了《植物活性成分辞典》（共三册，中国医药科技出版社，主编：陈蕙芳，副主编：马永华，卞学玮。2001年1月第一版）、《植物药有效成分手册》（人民卫生出版社1986）与《中药有效成分药理与应用》，对每一种化学成分的品名、化学名、理化性质、化学结构、临床应用等方面进行了研究。著录项目：品名、化学名称、英文名称、异名、分子式、来源、药化作用、熔点、旋光度、化学号等字段。检索途径：可从品名、化学名称、英文名称、异名、分子式、来源等字段进行查询。
            </li>
            <li>
                <strong>中国方剂数据库:</strong> 中国方剂数据库为文献型数据库，收录古今中药方剂。收录了来自《圣济总录》、《圣惠》、《普济方》、《外台》、《千金》、《医方类聚》、《辨证录》等710余种古籍及现代文献中的古今中药方剂84464首，分别介绍每一方剂的不同名称、处方来源、药物组成、功效、主治、用药禁忌、药理作用、制备方法等方面信息。

            </li> 
            <li>
                <strong>
                    方剂现代应用数据库：</strong> 主要介绍古今方剂及其现代应用和现代研究，数据库共收录源自《中华人民共和国药典》、《卫生部部颁药品标准--中药成方制剂》及期刊文献中的中药方剂9651种，对每一方剂，分别介绍方剂名称、别名、处方来源、剂型、药物组成、加减、功效、主治、制备方法、用法用量、用药禁忌、不良反应、临床应用、药理作用、毒性试验、化学成分、理化性质、生产厂家、各家论述等内容。检索途径：可通过方名、别名、剂型、药物组成、功效、主治、化学成份、生产厂家、临床应用等途径进行检索。
            </li>
        </ul>


        <p class="lead"><strong>中药数据库集成框架</strong></p>
        <p>
            中药各个数据库虽然内容丰富，且已经建立了良好的关系，但是各个数据库之间缺乏信息关联，仅反映了某一类数据的专业特点，试想可以在这些专业型数据库基础上建立一个内容相对完整规范、不同领域内容相互关联、方便用户整体掌握并有效应用的中药规范化数据模型，模型元素包括中药单味药属性、化学成分属性及相关药理活性、化学实验信息等知识。
        </p>
        <p>
            中药数据库集成框架需要包含中药基础信息、中药化学成分属性信息、方剂信息、药理作用、中药化学实验信息等。中药数据库集成建设要考虑多个数据来源信息的关联性，在进行的中药药理实验与中药化学实验数据库调查问卷研究中，其中约50-70%用户在中药药理实验方面数据关注较广泛，其中相对突出的关注点包括中药化学成分、研究对象、相关毒理实验信息等。在检索方式上更加注重关联信息查询，如中药相关疾病、中药基础信息、化学实验信息等。一些基础科研用户更加注重在数据之间相互关联产生的一些信息中进行知识发现与知识推理，目的在于寻求其中的某种关联甚至是推理衍生的规律，知识等。深入调查用户需求，有效的将这些中药数据库之间的联系完美织构，对中药科研工作者甚至是对整个中药信息学的发展都具有重要意义。
        </p>
        <div class="panel panel-default">
            <div class="panel-body" align="center">
                <img width ="60%" src ="img/herbnet_model.jpg"></img>  
            </div>
        </div>
        <p>
            本研究分析用户需求，将中药数据库群进行解析、比合，尝试中药不同类型数据之间的最大有效关联，将中药信息数据库中关注度较高的中药化学成分作为轴心，关联中药单味药信息、方剂信息、药理作用、中药化学成分相关化学实验等信息，另外将与这些字段都能相联的作者信息一共设置为6个不同的检索入口，每个检索入口都可以进行相互关联信息的展示与查询，并尽可能将这些关联结果文献来源进行标注，使用户在进行相关文献分析的同时可以明确数据信息来源的可靠性。下面对这6个检索入口进行介绍和举例:
        </p>


        <div class="panel panel-default">
            <div class="container">
                <br>

                <div class="row" align="center">
                    <div class="col-lg-4">
                        <p class="lead"><a>疾病</a></p>   
                        <p>从中医理论的角度理解人类的疾病过程。认为人体各个组织、器官共处于一个统一体中，不论在生理上还是在病理上都是互相联系、互相影响的。
                            因而从不孤立地看待某一生理或病理现象，头痛医头，脚痛医脚，而多从整体的角度来对待疾病的治疗与预防，特别强调“整体观”。下面举一些例子：

                            <?php
                            $diseases = array('糖尿病', '脑缺血', '高脂血症');
                            foreach ($diseases as $v) {
                                echo '<a target="_blank" href="entity.php?name=' . $v . '&db_name=herbnet">' . $v . '</a>&nbsp; ';
                            }
                            ?>



                        </p>            
                    </div>
                    <div class="col-lg-4">
                        <p class="lead"><a>中药</a></p>
                        <p>中药（Chinese herbology、Traditional Chinese medicine），是指在中国传统医术指导下应用的药物。中药按加工工艺分为中成药、中药材。
                            中药主要由植物药（根、茎、叶、果）、动物药（内脏、皮、骨、器官等）和矿物药组成。下面是一些例子：
                            <?php
                            $herbs = array('大黄', '人参', '丹参', '仙人掌', '黄芩', '冬虫夏草');
                            foreach ($herbs as $v) {
                                echo '<a target="_blank" href="entity.php?name=' . $v . '&db_name=herbnet">' . $v . '</a>&nbsp; ';
                            }
                            ?>
                        </p>

                    </div>
                    <div class="col-lg-4">
                        <p class="lead"><a>方剂</a></p>
                        <p>方剂，方剂学名。简称方。方指医方。《隋书.经籍志》：“医方者，所以除疾疢保性命之术者也。”剂，古作齐，指调剂。方剂是治法的体现，是根据配伍原则，总结临床经验，以若干药物配合组成的药方。下面是一些例子：
                            <?php
                            $formulae = array('丹参素注射液', '茯苓泽泻加山楂汤', '川芎葛根人参方', '复方丹参', '健脾方', '芪黄胶囊', '黄连解毒汤');
                            foreach ($formulae as $v) {
                                echo '<a target="_blank" href="entity.php?name=' . $v . '&db_name=herbnet">' . $v . '</a>&nbsp; ';
                            }
                            ?>

                        </p>

                    </div>
                </div>
                <br>
                <div class="row" align="center">
                    <div class="col-lg-4">
                        <p class="lead"><a>药理作用</a></p>
                        <p>药理作用可被定义为通过一个在治疗浓度中的药物在体内所产生的生理和/或生物化学的变化。仅有单一的药理作用的药物是不存在的，一种药物通常会产生多种药理作用。下面是一些例子：
                            <?php
                            $effects = array('降脂药', '降糖药', '益智药', '抗脑缺血药', '降血糖药');
                            foreach ($effects as $v) {
                                echo '<a target="_blank" href="entity.php?name=' . $v . '&db_name=herbnet">' . $v . '</a>&nbsp; ';
                            }
                            ?>
                        </p>
                    </div>

                    <div class="col-lg-4">
                        <p class="lead"><a>中药化学成分</a></p>
                        <p>中草药所含化学成分很复杂，通常有糖类、氨基酸、蛋白质、油脂、蜡、酶、色素、维生素、有机酸、鞣质、无机盐、挥发油、生物碱、甙类等。每一种中草药都可能含有多种成分。下面是一些例子：
                            <?php
                            $chemicals = array('小檗碱', '大黄素', '牛磺酸', '三七提取物', '葛根素');
                            foreach ($chemicals as $v) {
                                echo '<a target="_blank" href="entity.php?name=' . $v . '&db_name=herbnet">' . $v . '</a>&nbsp; ';
                            }
                            ?>
                        </p>
                    </div>

                    <div class="col-lg-4">
                        <p class="lead"><a>化学实验方法</a></p>
                        <p>中药化学是一门结合中医药基本理论，运用现代科学技术，特别是运用化学及物理学的理论和方法研究中药化学成分的学科，是中药类专业的一门专业课。下面是一些例子：</p>
                        <?php
                        $methods = array('柱层析法', '硅胶柱色谱法', '薄层层析法', '理化鉴别法', '红外光谱法');
                        foreach ($methods as $v) {
                            echo '<a target="_blank" href="entity.php?name=' . $v . '&db_name=herbnet">' . $v . '</a>&nbsp; ';
                        }
                        ?>
                    </div>




                </div>
            </div>

        </div>

        <p class="lead"><strong>系统功能介绍</strong></p>
        <div class="panel panel-default">
            <div class="panel-body" align="center">
                <div class="row" align="center">
                    <div class="col-lg-offset-1 col-sm-6 col-md-5"> 
                        <div class="well-lg"></div>
                        <div class="well-lg"> <p class="lead"><strong>1. 进入项目主页</strong></p> 
                            在系统主页中选择“中药数据库集成框架”，或在上方“相关项目”中选择“面向中药领域的数据库集成框架研究”，进入项目页面。
                        </div>

                    </div>
                    <div class="col-sm-6 col-md-5">              
                        <a href="main.php" target="_blank"><img width ="100%" src ="img/herbnet_main.jpg"></img></a> 
                    </div>
                </div>
                <hr>  
                <div class="row" align="center">
                    <div class="col-lg-offset-1 col-sm-6 col-md-5"> 
                        <div class="well-lg"></div>
                        <div class="well-lg"> <p class="lead"><strong>2. 进入知识检索界面</strong></p> 
                            在系统主页中的“中药数据库集成框架”项目介绍的下方，选择“知识检索”，进入HerbNet的检索界面。
                        </div>

                    </div>
                    <div class="col-sm-6 col-md-5">              
                        <a href="main.php" target="_blank"><img width ="100%" src ="img/对Herbnet检索.jpg"></img></a> 
                    </div>
                </div>
                <hr>  
                <div class="row" align="center">
                    <div class="col-lg-offset-1 col-sm-6 col-md-5"> 
                        <div class="well-lg"></div>
                        <div class="well-lg"> <p class="lead"><strong>3. 在TCMBase中选择HerbNet进行检索</strong></p> 
                            在TCMBase系统中选择“HerbNet”，则可对HerbNet的知识内容进行检索。
                        </div>

                    </div>
                    <div class="col-sm-6 col-md-5">              
                        <a href="index.php?db=herbnet" target="_blank"><img width ="100%" src ="img/选择HerbNet.jpg"></img></a> 
                    </div>
                </div>                
                <hr>  
                <div class="row" align="center">
                    <div class="col-lg-offset-1 col-sm-6 col-md-5"> 
                        <div class="well-lg"></div>
                        <div class="well-lg"> <p class="lead"><strong>4. 输入关键词进行检索</strong></p> 
                            系统支持用户输入关键词进行检索。用户输入关键词“大黄素”，则可检出HerbNet中与“大黄素”相关的实体。
                        </div>

                    </div>
                    <div class="col-sm-6 col-md-5">              
                        <a href="index.php?db=herbnet" target="_blank"><img width ="100%" src ="img/tcmbase-herbnet-大黄素1.jpg"></img></a> 
                    </div>
                </div>

                <hr>  
                <div class="row" align="center">
                    <div class="col-lg-offset-1 col-sm-6 col-md-5"> 
                        <div class="well-lg"></div>
                        <div class="well-lg"> <p class="lead"><strong>5. 系统列出相关的实体</strong></p> 
                            系统列出与用户输入的关键词相关的领域实体，点击链接可进入相关实体的信息页面。
                        </div>

                    </div>
                    <div class="col-sm-6 col-md-5">              
                        <a href="search.php?db_name=herbnet&keywords=大黄&submit=" target="_blank"><img width ="100%" src ="img/herbnet-search-大黄.jpg"></img></a> 
                    </div>
                </div>
                <hr>  

                <div class="row" align="center">
                    <div class="col-lg-offset-1 col-sm-6 col-md-5"> 
                        <div class="well-lg"></div>
                        <div class="well-lg"> <p class="lead"><strong>6. 实体信息的综合展示</strong></p> 
                            系统会将中药科技基础信息数据库、中药药理实验数据库等多个数据库中的实体信息进行集中展示，并标出了信息来源。
                            用户可通过其中的超链接转到相关实体的信息展示页面。
                        </div>

                    </div>
                    <div class="col-sm-6 col-md-5">              
                        <a href="entity.php?name=大黄素&db_name=herbnet" target="_blank"><img width ="100%" src ="img/herbnet-大黄素.jpg"></img></a> 
                    </div>
                </div>
                <hr>  
                <div class="row" align="center">
                    <div class="col-lg-offset-1 col-sm-6 col-md-5"> 
                        <div class="well-lg"></div>
                        <div class="well-lg"> <p class="lead"><strong>7. 实体相关文献的展示</strong></p> 
                            系统不仅展示实体的结构性信息，而且列出了实体的相关文献。例如，对于某个中药“大黄”，系统会给出对该中药进行实验的相关文献。
                        </div>

                    </div>
                    <div class="col-sm-6 col-md-5">              
                        <a href="entity.php?name=大黄&db_name=herbnet" target="_blank"><img width ="100%" src ="img/herbnet-大黄.jpg"></img></a> 
                    </div>
                </div>


            </div>

        </div>
        <p class="lead"><strong>系统界面截图</strong></p>

        <div class="panel panel-default">
            <div class="panel-body" align="center">


                <ul class="nav nav-tabs">
                    <li class="active"><a href="#p12" data-toggle="tab">人参</a></li>
                    <li><a href="#p2" data-toggle="tab">大黄</a></li>
                    <li><a href="#p13" data-toggle="tab">六味地黄汤</a></li>


                    <li><a href="#p9" data-toggle="tab">糖尿病</a></li>
                    <li><a href="#p10" data-toggle="tab">脑缺血</a></li>
                    <li><a href="#p11" data-toggle="tab">高脂血症</a></li>                  

                    <li><a href="#p1" data-toggle="tab">小檗碱</a></li> 
                    <!--<li><a href="#p3" data-toggle="tab">大黄素</a></li>-->
                    <li><a href="#p7" data-toggle="tab">葛根素</a></li>  

                    <li><a href="#p4" data-toggle="tab">柱层析法</a></li>
                    <li><a href="#p5" data-toggle="tab">硅胶柱色谱法</a></li>

                    <li><a href="#p6" data-toggle="tab">抗脑缺血药</a></li>                     
                    <li><a href="#p8" data-toggle="tab">降血糖药</a></li>



                </ul>
                <br>
                <div class="container">
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="p1">
                            <a href="entity.php?name=小檗碱&db_name=herbnet" target="_blank"><img width ="100%" src ="img/herbnet-小檗碱.jpg"></img></a> 
                        </div>
                        <div class="tab-pane" id="p2">
                            <a href="entity.php?name=大黄&db_name=herbnet" target="_blank"><img width ="100%" src ="img/herbnet-大黄.jpg"></img></a> 
                        </div>
                        <!--
                        <div class="tab-pane" id="p3">
                            <a href="entity.php?name=大黄素&db_name=herbnet" target="_blank"><img width ="100%" src ="img/herbnet-大黄素.jpg"></img></a> 
                        </div>-->
                        <div class="tab-pane" id="p4">
                            <a href="entity.php?name=柱层析法&db_name=herbnet" target="_blank"><img width ="100%" src ="img/herbnet-柱层析法.jpg"></img></a>                         
                        </div>
                        <div class="tab-pane" id="p5">
                            <a href="entity.php?name=硅胶柱色谱法&db_name=herbnet" target="_blank"><img width ="100%" src ="img/herbnet-硅胶柱色谱法.jpg"></img></a>                         
                        </div>
                        <div class="tab-pane" id="p6">
                            <a href="entity.php?name=抗脑缺血药&db_name=herbnet" target="_blank"><img width ="100%" src ="img/herbnet-抗脑缺血药.jpg"></img></a>                         
                        </div>
                        <div class="tab-pane" id="p7">
                            <a href="entity.php?name=葛根素&db_name=herbnet" target="_blank"><img width ="100%" src ="img/herbnet-葛根素.jpg"></img></a>                         
                        </div>
                        <div class="tab-pane" id="p8">
                            <a href="entity.php?name=降血糖药&db_name=herbnet" target="_blank"><img width ="100%" src ="img/herbnet-降血糖药.jpg"></img></a>                         
                        </div>
                        <div class="tab-pane" id="p9">
                            <a href="entity.php?name=糖尿病&db_name=herbnet" target="_blank"><img width ="100%" src ="img/herbnet-糖尿病.jpg"></img></a>                         
                        </div>
                        <div class="tab-pane" id="p10">
                            <a href="entity.php?name=脑缺血&db_name=herbnet" target="_blank"><img width ="100%" src ="img/herbnet-脑缺血.jpg"></img></a>                         
                        </div>
                        <div class="tab-pane" id="p11">
                            <a href="entity.php?name=高脂血症&db_name=herbnet" target="_blank"><img width ="100%" src ="img/herbnet-高脂血症.jpg"></img></a>                         
                        </div>
                        <div class="tab-pane" id="p12">
                            <a href="entity.php?name=人参&db_name=herbnet" target="_blank"><img width ="100%" src ="img/herbnet-人参.jpg"></img></a>                         
                        </div>
                        <div class="tab-pane" id="p13">
                            <a href="entity.php?name=六味地黄汤&db_name=herbnet" target="_blank"><img width ="100%" src ="img/herbnet-六味地黄汤.jpg"></img></a>                         
                        </div>



                    </div>
                </div>



            </div>
        </div>

        <div class="well-lg" align ="center">
              <p><a class="btn btn-lg btn-success" href="db_profile.php?db_name=herbnet" role="button"><span class="glyphicon glyphicon-search"></span>&nbsp;知识库浏览</a>
            <a class="btn btn-lg btn-primary" href="index.php?db=herbnet" role="button"><span class="glyphicon glyphicon-search"></span>&nbsp;知识检索</a></p>
           <!-- <p><a class="btn btn-lg btn-success" href="ontologies/spleen-1.0.owl" role="button"><span class="glyphicon glyphicon-download"></span>&nbsp;下载本体</a>
                <a class="btn btn-lg btn-primary" href="docs/spleen.docx" role="button"><span class="glyphicon glyphicon-download"></span>&nbsp;下载技术报告</a></p>-->
        </div>
        <hr>

    </div> <!-- /container -->
</div>
<?php
include_once ("./foot.php");
?>