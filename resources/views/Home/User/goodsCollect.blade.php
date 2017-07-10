@extends('layouts.home')

@section('title','收货地址')

@section('content')
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
                <h2><span>我的收藏</span></h2>
            </div>
        </div>
        <div class="wddd-js ov-in">
            <!--<div class="merge">-->
                <!--<label class="ma-ri-20 di-in-bl cu-po" for="checkallbox"><input class="ma-ri-10  ve-al-mi" id="checkallbox" type="checkbox"><span class="ve-al-mi fo-si-14 fo-fa-ta">全选</span></label>-->
                <!--<a class="jrgwcv vam fo-fa-ta co-28c0c6" href="">加入购物车</a>-->
                <!--<span class="vam fo-fa-ta">&nbsp;|&nbsp;</span>-->
                <!--<a class="jrgwcv vam fo-fa-ta co-28c0c6" href="">取消关注</a>-->
            <!--</div>-->
            <div class="flool-b layer wi940">
                <ul class="flool-cle">
                @if(empty($lists))
                    <p style="text-align:center"><img src="{{URL::asset('Static/images/null_data.jpg')}}" width="400"  /></p>
                @else
                    @foreach($lists as $list)
                    <li class="sellers sellers-two wi25-BFB">
                        <div class="best-two ma0-20-20-0">
                            <div class="he364 about-ced best-tans">
                                <div class="best_img best_img2 best_img3">
                                    <a href=""><img src="{{$list->original_img}}" /></a>
                                </div>
                                <div class="intr-t intr-t3 pa0-20">{{$list->goods_name}}<span class="intr-b"></span></div>
                                <div class="price prices">
                                    <span>¥</span><em>{{$list->shop_price}}</em>
                                </div>
                                <div class="add-join">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                        <td align="center" class="joins-ri">
                                            <a href="{{url('home/goods/goodsinfo/'.$list->goods_id)}}">去购买</a>
                                        </td>
                                        <td align="center" class="joins-ri">
                                            <a href="{{url('home/user/cancelCollect/'.$list->collect_id)}}">取消收藏</a>
                                        </td>
                                        </tr>
                                    </table>
                                </div>
                                <!--<div class="tag">-->
                                    <!--<img src="__STATIC__/images/1382593860805.png" alt="首发" />-->
                                <!--</div>-->
                            </div>
                        </div>
                    </li>
                    @endforeach
                @endif
                </ul>
            </div>
            <!--<div class="merge fl">-->
                <!--<label class="ma-ri-20 di-in-bl cu-po" for="checkallbox"><input class="ma-ri-10  ve-al-mi" id="checkallbox" type="checkbox"><span class="ve-al-mi fo-si-14 fo-fa-ta">全选</span></label>-->
                <!--<a class="jrgwcv vam fo-fa-ta co-28c0c6" href="">加入购物车</a>-->
                <!--<span class="vam fo-fa-ta">&nbsp;|&nbsp;</span>-->
                <!--<a class="jrgwcv vam fo-fa-ta co-28c0c6" href="">取消关注</a>-->
            <!--</div>-->
            <div class="merge pager-paging fr">
                {$page}
            </div>
        </div>
    </div>
</div>
<div class="he80"></div>
<!--------footer-开始-------------->
{{--<include file="Public/footer2" />--}}
@include('Home.Public.footer')
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
        $("#h-s").mouseover(function () {
            $('.ec-ta-x').css('left','124px');
            $('.ec-ta-x').css('width','110px');
            $(this).addClass("cullent");
        });
        $("#h-s").mouseout(function () {
            $('.ec-ta-x').css('left','0px');
            $('.ec-ta-x').css('width','124px');
            $(this).removeClass("cullent");
        });
    });
    $(function () {
        $("#q-s").mouseover(function () {
            $('.ec-ta-x').css('left','0px');
            $(this).addClass("cullent");
        });
        $("#q-s").mouseout(function () {
            $('.ec-ta-x').css('left','0px');
        });
    });

</script>
@stop