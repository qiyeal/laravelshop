@extends('layouts.home')

@section('title','验证手机')

@section('content')
<!--
    <script src="__STATIC__/js/jquery-1.10.2.min.js"></script>
    <script src="__STATIC__/js/slider.js"></script>
	<script src="__PUBLIC__/js/global.js"></script>
    <script src="__PUBLIC__/js/pc_common.js"></script>
	<script src="__PUBLIC__/js/layer/layer.js"></script>
-->
<!--弹窗js 参考文档 http://layer.layui.com/-->
<div class="uc">
   {{-- <div class="uc_head">
        <div class="uc_head_middle">
            <div class="uc_head_middle_left">我的帐号</div>
            <!--<div class="uc_head_middle_right"><a class="logout_c" href="">问问</a> | <a class="logout_c" href="">退出</a></div>-->
        </div>
    </div>--}}
   <!--左侧菜单-->
       {{--{{dd(session("mobile_code"))}}--}}
   @include('Home.User.menu')
    <div class="uc_body pa-to-30">

        <div class="uc_body_form">
            <!--<div class="diraction_icon dir_icon1">-->
            <!--<ul class="diraction_dl">-->
            <!--<li>1 验证原邮箱</li>-->
            <!--<li>2 安全验证</li>-->
            <!--<li>3 新邮箱绑定</li>-->
            <!--<li>4 验证新邮箱</li>-->
            <!--</ul>-->
            <!--</div>-->
            <table class="changeAccount_theme">
                <tbody>
                {{--<tr class="tr_height">--}}
                    {{--<td class="cl_left fo-si-12" align="right"><label class="fo-si-12">原手机：</label></td>--}}
                    {{--<td class="cl_middle">--}}
                        {{--<input type="text" class="imput_text text_width foce" id="old_email" name="old_email" placeholder="没有请留空">--}}
                    {{--</td>--}}
                    {{--<td>--}}
                        {{--<span id="msg_txtMailAccount"></span>--}}
                    {{--</td>--}}
                {{--</tr>--}}
                {{--<tr class="tr_height">--}}
                    {{--<td align="right" class="cl_left">--}}
                        {{--验证码：--}}
                    {{--</td>--}}
                    {{--<td class="cl_middle">--}}
                        {{--<input type="text" id="old_code" maxlength="4" style="width:100px;" placeholder="没有请留空" class="imput_text" name="old_code">--}}
                        {{--<input type="button" intervaltime="60" value="获取验证码 " id="btnemailAuthCode1" onClick="sendCode(this,'old_email')">--}}
                    {{--</td>--}}

                {{--</tr>--}}
                <tr class="tr_height">
                    <td class="cl_left fo-si-12" align="right"><label class="fo-si-12">手机：</label></td>
                    <td class="cl_middle">
                        <input type="text" class="imput_text text_width foce" id="new_email" name="new_email">
                    </td>
                </tr>
                <tr class="tr_height">
                    <td align="right" class="cl_left">
                        验证码：
                    </td>
                    <td class="cl_middle">
                        <input type="text" id="new_code" maxlength="4" style="width:100px;" class="imput_text" name="new_code">
                        <input type="button" intervaltime="60" value="获取验证码 " id="btnemailAuthCode2" onClick="sendCode(this,'new_email')">
                    </td>

                </tr>
                <tr class="tr_height">
                    <td valign="middle" align="center" colspan="3" style="height:120px;">
                        <input type="button" value="下一步" class="btn_midefy" id="btn_next" onclick="next()">
                    </td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>
<script>
    function next()
    {
        var input = $('#new_email').val();
        var code = $('#new_code').val();

        if(!input){
            layer.alert('手机号码不能为空', {icon: 2});// alert('手机号码格式错误');
            return false;
        }
        if(!checkMobile(input)){
            layer.alert('手机号码格式错误', {icon: 2});// alert('手机号码格式错误');
            return false;
        }

        if(!code){
            layer.alert('请填写验证码', {icon: 2});// alert('手机号码格式错误');
            return false;
        }
        if(code.length<4){
            layer.alert('验证码不正确', {icon: 2});// alert('手机号码格式错误');
            return false;
        }

        {{--var url = '{{url("home/user/checkMobileCode")}}'+"/"+code+"/"+input;--}}
        var url = '{{url("home/user/checkMobileCode")}}';

        $.get(url,{"code":code, "mobile":input}, function(data){
            if(data == 1){
                layer.alert('手机验证成功', {icon: 2})
                history.back();
            }else{
                layer.alert(data, {icon: 2});
                history.back();
            }
        });

    }


    function sendCode(obj,input_id){
        var id = $(obj).attr('id');
        var input = $('#'+input_id).val();
        if(!checkMobile(input)){
            layer.alert('手机号码格式错误', {icon: 2});// alert('手机号码格式错误');
            return false;
        }
        if(input_id == 'old_email')
            var url = "{:U('Home/User/send_phone_code',array('type'=>'old')}";
        if(input_id == 'new_email')
            var url = "{{url('home/user/mobileCode/')}}/"+input;
        //发送验证码
        $.ajax({
            type : "GET",
            url  : url,
            dataType : 'json',
            error: function(request) {
                layer.alert('服务器繁忙, 请联系管理员!', {icon: 2});// alert("服务器繁忙, 请联系管理员!");
                return;
            },
            success: function(res) {
                if(res.status == 1){
                    jsInnerTimeout(id);
                }else{
                    layer.alert(res.msg,{icon: 2});//alert('发送失败');
                }
            }
        });
    }

    //倒计时函数
    function jsInnerTimeout(id)
    {
        var codeObj=$("#"+id);
        var intAs=parseInt(codeObj.attr("IntervalTime"));

        intAs--;
        codeObj.attr("disabled","disabled");
        if(intAs<=-1)
        {
            codeObj.removeAttr("disabled");
            codeObj.attr("IntervalTime",60);
            codeObj.val("获取验证码");
            return true;
        }

        codeObj.val(intAs+'s后再次获取');
        codeObj.attr("IntervalTime",intAs);

        setTimeout("jsInnerTimeout('"+id+"')",1000);
    };

</script>
@stop
