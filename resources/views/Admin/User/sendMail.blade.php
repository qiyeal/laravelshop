<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="keywords" content="{$tpshop_config['shop_info_store_keyword']}" />
    <meta name="description" content="{$tpshop_config['shop_info_store_desc']}" />
    <link rel="stylesheet" href="{{URL::asset('Static/css/edit_address.css')}}" type="text/css">
    <script src="{{URL::asset('js/jquery-1.10.2.min.js')}}"></script>
    <script src="{{URL::asset('Static/js/slider.js')}}"></script>
	<script src="{{URL::asset('js/layer/layer-min.js')}}"></script><!--弹窗js 参考文档 http://layer.layui.com/-->
</head>
<style type="text/css">
.wi80-BFB{width:80%}
.wi40-BFB{width:40%}
.seauii{ padding:7px 10px; margin-right:10px}
.he110{ height:110px}
.di-bl{ display:inherit}
</style>
<body>
<div class="adderss-add">
    <div class="ner-reac ol_box_4" style="visibility: visible; position: fixed; z-index: 500; width: 100%; height:100%">
        <div class="box-ct">
            {{--<div class="box-header">--}}
                {{--<!-- <a href="" class="box-close"></a> -->--}}
            {{--</div>--}}
            <form action="{{url('admin/User/doSendMail')}}" method="post" onSubmit="return checkForm()">
                {{csrf_field()}}
                <table width="90%" border="0" cellspacing="0" cellpadding="0">
                    <input name="call_back" type="hidden" value="call_back" />
                    <input name="smtp" type="hidden" value="{$smtp}" />
                    <tr class="postmessage" style=" height:32px">
                        <td></td>
                        <td>
                            @if(count($arr)>0)
                                <input id="allvip" type="radio"checked="checked" name="type"><label for="allvip"  class="allvip">发送给以下会员</label>
                            @endif
                        </td>
                    </tr>
                    @if(count($arr)>0)
                     <tr>
                    	<td align="right" valign="top">会员列表：</td>
                    	<td>
                            <div class="wi80-BFB re-no viplist" >
                                @foreach($arr as $user)
                                    <input type="hidden" name="user[]" value="{{$user[0]->user_id}}" />
                                    <input type="hidden" name="email[]" value="{{$user[0]->email}}">
                                    <p><span>ID:{{$user[0]->user_id}}</span>&nbsp;&nbsp;<span>昵称:{{$user[0]->nickname}}</span>&nbsp;&nbsp;<span>邮箱:{{$user[0]->email}}</span></p>
                                @endforeach
                            </div>
                        </td>
                    </tr>
                    @endif
                    <tr>
                        <td align="right" valign="top">邮箱标题：</td>
                        <td><input name="title" id="title" maxlength="100" placeholder="邮箱标题" maxlength="100" /></td>
                    </tr>
                    <tr>
                        <td align="right" valign="top">邮件内容：</td>
                        <td><textarea class="he110 wi80-BFB re-no" name="text" id="text" placeholder="邮件内容" maxlength="100"></textarea></td>
                    </tr>
                   <tr style="height:60px">
                        <td align="right">
                            <button type="submit" style="padding: 0px 16px;cursor: pointer;"><span>发送</span></button>
                        </td>    
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<script src="{{URL::asset('js/global.js')}}"></script>
<script src="{{URL::asset('js/pc_common.js')}}"></script>

<script>
    function checkForm(){
        var text = $('#text').val();
        var title = $('#title').val();
        var user = $("input[name='user[]']").val();
        var error = '';
        if(text == ''){
            error += '邮件内容不能为空 <br/>';
        }
        if(title == ''){
            error += '邮件标题不能为空 <br/>';
        }
        if((typeof(user))  == "undefined"){
            error += '所选的会员没有邮箱 <br/>';
        }
        if(error){
			layer.msg(error, {icon: 5});
            return false;
        }
        return true;
    }
</script>
</body>
</html>
