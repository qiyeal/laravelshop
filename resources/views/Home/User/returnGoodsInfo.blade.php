<!DOCTYPE html>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>退换货详情-{$tpshop_config['shop_info_store_title']}</title>
    <meta http-equiv="keywords" content="{$tpshop_config['shop_info_store_keyword']}"/>
    <meta name="description" content="{$tpshop_config['shop_info_store_desc']}"/>
    <link rel="stylesheet" href="{{asset('Static/css/index.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('Static/css/page.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('Static/css/outhu.css')}}" type="text/css">
    <script src="{{asset('Static/js/jquery-1.10.2.min.js')}}"></script>
</head>

<body>
<!--------头部开始-------------->
{{--<include file="Public/header"/>--}}
@include("Home.Public.header")
<!--------头部结束-------------->

<div class="layout ov-hi">
    <div class="breadcrumb-area">
        <foreach name="navigate_user" key="k" item="v">
            <if condition="$k neq '首页'"> ></if>
            <a href="{$v}">{$k}</a></foreach>
    </div>
</div>
<div class="layout pa-to-10 fo-fa-ar">
    <!--菜单-->
    {{--<include file="User/menu"/>--}}
    @include('Home.User.menu')
    <!--菜单-->
    <div class="fr wi940">
        <div id="main">
            <div class="mod-main mod-comm">
                <div class="mt">
                    <h3>申请服务详情</h3>
                </div>
                <div class="mc">
                    <div class="remind-box">
                        <div class="after-sale-info">
                            <div class="r-col">
                                <div class="after-sale-item">
                                    <div class="p-img"><img height="50" width="50" style="height:50px; width:50px"
                                                            title="" src="{{url($goodsInfo->original_img)}}"
                                                            data-img="1" alt=""></div>
                                    <div class="after-sale-msg">
                                        <div><span>{{$goodsInfo->goods_name}}</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mc" id="vendorTel"></div>
            </div>
            <div class="mod-main mod-comm">
                <div class="mt">
                    <h3>售后信息</h3>
                </div>
                <div class="mc">
                    <!--进度条代码开始begin-->
                    <div class="mod-main mod-comm" id="air06">
                        <div class="mc">
                            <div id="processDivId" class="qa-progress-new qa-new-w4">
                                <div class="node ready">
                                    @if($returnGoodsInfo->status == 0)
                                        <div class="info pro-1-4"><span class="con">申请</span><b></b></div>
                                    @endif
                                    <i class="icon-node"></i>
                                    <span class="txt">提交申请</span>
                                </div>
                                <div class="proce ready"><i class="icon-proce"></i></div>
                                <div class="node ready">
                                    @if($returnGoodsInfo->status == 1)
                                        <div class="info pro-1-4"><span class="con">处理</span><b></b></div>
                                    @endif
                                    <i class="icon-node"></i>
                                    <span class="txt">客服处理</span>
                                </div>
                                <div class="proce ready"><i class="icon-proce"></i></div>
                                <div class="node ready">
                                    @if($returnGoodsInfo->status == 2)
                                        <div class="info pro-1-4"><span class="con">已完成</span><b></b></div>
                                    @endif
                                    <i class="icon-node"></i>
                                    <span class="txt">完成</span>
                                </div>
                            </div>
                        </div>
                        <div id="processTipDiv" class="mt20" style="display: none;"></div>
                        <div class="op-btns mt20" id="ProTipDiv" style="display: none;">
                            <div id="divOpSatis">
                            </div>
                        </div>
                    </div>

                    <div class="deal-cont">
                        <div class="deal-items">
                            <div class="deal-item ">
                                <div class="deal-txt"> 处理环节<b></b></div>
                                <ul>
                                    <li class="fore1">
                                        <div class="deal-msg"><strong>问题描述：</strong>

                                            <div>{{$returnGoodsInfo->reason}}</div>
                                        </div>
                                        <div class="deal-opers">
                                            <strong>问题照片：</strong>
                                            @foreach($returnGoodsInfo->imgs as $v)
                                                <a href="{{url($v)}}" target="_blank"><img src="{{url($v)}}" width="85"
                                                                                       height="85"/></a>&nbsp;&nbsp;&nbsp;
                                            @endforeach
                                        </div>
                                        <div class="deal-opers">
                                            <strong>客服备注：</strong>
                                            {{$returnGoodsInfo->remark}}
                                        </div>

                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="he80"></div>
<!--------footer-开始-------------->
{{--<include file="Public/footer2"/>--}}
@include("Home.Public.footer")
<!--------footer-结束-------------->

</body>
</html>