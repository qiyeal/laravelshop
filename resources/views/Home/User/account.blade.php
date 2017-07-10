<!DOCTYPE html>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>账户资金-{$tpshop_config['shop_info_store_title']}</title>
    <meta http-equiv="keywords" content="{$tpshop_config['shop_info_store_keyword']}" />
    <meta name="description" content="{$tpshop_config['shop_info_store_desc']}" />
    <link rel="stylesheet" href="{{URL::asset('Static/css/index.css')}}" type="text/css">
    <link rel="stylesheet" href="{{URL::asset('Static/css/page.css')}}" type="text/css">
    <script src="{{URL::asset('Static/js/jquery-1.10.2.min.js')}}"></script>
    <script src="{{URL::asset('Static.js/slider.js')}}"></script>
</head>

<body>
<!--------头部开始-------------->
{{--<include file="Public/header" />--}}
@include('Home.Public.header')
<!--------头部结束-------------->

<div class="layout ov-hi">
    <div class="breadcrumb-area">    
	    <foreach name="navigate_user" key="k" item="v">
	        <if condition="$k neq '首页'"> > </if>  
            <a href="{$v}">{$k}</a> 
        </foreach>
    </div>
</div>
<div class="layout pa-to-10 fo-fa-ar">
    <!--菜单-->
    {{--<include file="User/menu" />--}}
    @include('Home.User.menu')
    <!--菜单-->
    <div class="fr wi940">
        <div class="he50 wddd">
            <div class="fl ddd-h2">
                <h2><span>我的资金</span></h2>
            </div>
        </div>
        <div class="myHuaban-info">
            <div class="myHuaban-point">
                <dl>
                    <dt>余额</dt>
                    <dd>
                        <span>{$user.user_money}</span>
                        <em>元</em>
                    </dd>
                </dl>
            </div>
            <div class="myHuaban-redeem">
                <dl>
                    <dt>积分</dt>
                    <dd>
                        <span>{$user.pay_points}</span>
                        <em>积分</em>
                    </dd>
                </dl>
            </div>
            <div class="myHuaban-check">
                <!--<p class="h-text">连续签到：<span><label id="singinKeepDay">0</label>&nbsp;天</span>&nbsp;&nbsp;&nbsp;总签到：<span><label id="singinTotalDay">0</label>&nbsp;天</span></p>-->
            </div>
        </div>
        <div class="he50 wddd ma-to-50">
            <div class="fl ddd-h2">
                <h2><span>账户记录</span></h2>
            </div>
            <div class="fr">
                <div class="po-re zjs">
                    <ul>
                        <li id="q-s" class="fl cullent"><a href="{{url('home/user/account')}}"><span>全部记录</span></a></li>
                        <!--<li id="h-s" class="fl"><a href="{:U('Home/User/account',array('type'=>1))}"><span>收入记录</span></a></li>-->
                        <!--<li id="j-s" class="fl"><a href="{:U('Home/User/account',array('type'=>2))}"><span>支出记录</span></a></li>-->
                    </ul>
                    <div class="ec-ta-x wi82" style="left:0"></div>
                </div>
            </div>
        </div>
        <div class="wddd-js ov-in">
            <div class="list-group-title">
                <table class="merge-tab" border="0" cellpadding="0" cellspacing="0">
                    <thead>
                    <tr>
                        <!--<th class="col-pro">日期</th>-->
                        <th class="wi230">时间</th>
                        <th class="wi230">金额</th>
                        <th class="wi230">积分</th>
                        <th class="col-operate wi230">说明</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <div class="merge-list">
                <div class="ma-0--1">
                    <div class="o-pro">
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tbody>
                            <volist id="log" name="account_log">
                                <tr>
                                    <!--<td class=""><span>类型</span></td>-->
                                    <td class="wi230">{$log.change_time|date='Y-m-d H:i',###}</td>
                                    <td rowspan="1" class="wi230">
                                        <span>
                                            <if condition="$log[user_money] gt 0">+</if>
                                            {$log.user_money}
                                        </span>
                                    </td>
                                    <td rowspan="1" class="wi230">
                                        <span>
                                            <if condition="$log[pay_points] gt 0">+</if>
                                            {$log.pay_points}
                                        </span>
                                    </td>
                                    <td rowspan="1" class="col-operate wi230">
                                        <p class="p-link">{$log.desc}</p>
                                    </td>
                                </tr>
                            </volist>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div>
                {$page}
            </div>
        </div>
    </div>
</div>
<div class="he80"></div>
<!--------footer-开始-------------->
{{--<include file="Public/footer2" />--}}
@include('Home.Public.footer2')
<!--------footer-结束-------------->


</body>
<script>
    /*$(function () {
     $("#h-s").click(function () {
     $('.ec-ta-x').css('left','124px');
     $('.ec-ta-x').css('width','110px');
     $(this).addClass("cullent");
     $('#q-s').removeClass("cullent");
     });
     });
     */
</script>

<script>
    $(function () {
        $(function () {
            $("#q-s").mouseover(function () {
                $('.ec-ta-x').css('left','0px');
                $(this).addClass("cullent");
            });
            $("#q-s").mouseout(function () {
                $('.ec-ta-x').css('left','0px');
            });
        });
        $("#h-s").mouseover(function () {
            $('.ec-ta-x').css('left','82px');
            $(this).addClass("cullent");
        });
        $("#h-s").mouseout(function () {
            $('.ec-ta-x').css('left','0px');
            $(this).removeClass("cullent");
        });
    });

    $(function () {
        $("#j-s").mouseover(function () {
            $('.ec-ta-x').css('left','164px');
            $(this).addClass("cullent");
        });
        $("#j-s").mouseout(function () {
            $('.ec-ta-x').css('left','0px');
            $(this).removeClass("cullent");
        });
    });
</script>
</html>