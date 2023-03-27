<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head> 
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0 ,minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" /> 
  <title>结算页面</title> 
  <link href="/static/Home/xiangmv/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" /> 
  <link href="/static/Home/xiangmv/basic/css/demo.css" rel="stylesheet" type="text/css" /> 
  <link href="/static/Home/xiangmv/css/cartstyle.css" rel="stylesheet" type="text/css" /> 
  <link href="/static/Home/xiangmv/css/jsstyle.css" rel="stylesheet" type="text/css" /> 
  <script type="text/javascript" src="/static/Home/xiangmv/js/address.js"></script> 
 </head> 
 <style type="text/css">
 </style>
 <body> 
  <!--顶部导航条 --> 
  <div class="am-container header"> 
   <ul class="message-l"> 
    <div class="topMessage"> 
     <div class="menu-hd"> 
        @if(session('email'))
          <a href="login.html" target="_top" class="h">欢淫{{session('email')}}</a> 
          <a href="/homelogout" target="_top">退出</a> 
        @else
          <a href="/homelogin/create" target="_top" class="h">亲，请登录</a> 
          <a href="/homeregister/create" target="_top">免费注册</a>
        @endif  
     </div> 
    </div> 
   </ul> 
   <ul class="message-r"> 
    <div class="topMessage home"> 
     <div class="menu-hd">
      <a href="#" target="_top" class="h">商城首页</a>
     </div> 
    </div> 
    <div class="topMessage my-shangcheng"> 
     <div class="menu-hd MyShangcheng">
      <a href="#" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a>
     </div> 
    </div> 
    <div class="topMessage mini-cart"> 
     <div class="menu-hd">
      <a id="mc-menu-hd" href="#" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h">0</strong></a>
     </div> 
    </div> 
    <div class="topMessage favorite"> 
     <div class="menu-hd">
      <a href="#" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a>
     </div> 
    </div>
   </ul> 
  </div> 
  <!--悬浮搜索框--> 
  <div class="nav white"> 
   <div class="logo">
    <img src="/static/Home/xiangmv/images/logo.png" />
   </div> 
   <div class="logoBig"> 
    <li><img src="/static/Home/xiangmv/images/logobig.png" /></li> 
   </div> 
   <div class="search-bar pr"> 
    <a name="index_none_header_sysc" href="#"></a> 
    <form> 
     <input id="searchInput" name="index_none_header_sysc" type="text" placeholder="搜索" autocomplete="off" /> 
     <input id="ai-topsearch" class="submit am-btn" value="搜索" index="1" type="submit" /> 
    </form> 
   </div> 
  </div> 
  <div class="clear"></div> 
  <div class="concent"> 
   <!--地址 --> 
   <div class="paycont"> 
    <div class="address"> 
     <h3>确认收货地址 </h3> 
     <div class="control"> 
      <div class="tc-btn createAddr theme-login am-btn am-btn-danger">
       使用新地址
      </div> 
     </div> 
     <div class="clear"></div> 
     <ul> 
      <div class="per-border"></div> 
      @if(count($alladdress))
      @foreach($alladdress as $address)
      @if($address->status==1)
      <!-- 收货地址开头 -->
      <!-- defaultAddr 这个是默认选中的样式 uid地址id -->
      <li class="user-addresslist" uid="{{$address->id}}" style="border:3px dashed green"> 
       <div class="address-left"> 
        <div class="user"> 
         <span class="buy-address-detail"> <span class="buy-user">名字:{{$address->name}} </span> <span class="buy-phone">电话:{{$address->phone}}</span> </span> 
        </div> 
        <div class="default-address"> 
         <span class="buy-line-title buy-line-title-type">收货地址：</span> 
         <span class="buy--address-detail"> <span class="province">{{$address->address}}</span>  
        </div> 
       <!--  <ins class="deftip">
         默认地址
        </ins>  -->
       </div> 
       <div class="address-right"> 
        <a href="person/address.html"> <span class="am-icon-angle-right am-icon-lg"></span></a> 
       </div> 
       <div class="clear"></div> 
       <div class="new-addr-btn"> 
        <a href="#" class="hidden">设为默认</a> 
        <span class="new-addr-bar hidden">|</span> 
        <a href="#">默认收货地址</a>  
       </div> </li> 
       <!-- 收货地址结尾 -->
       @else
      
      <li class="user-addresslist" uid="{{$address->id}}" style="border:3px dashed black"> 
       <div class="address-left"> 
        <div class="user"> 
         <span class="buy-address-detail"> <span class="buy-user">名字:{{$address->name}} </span> <span class="buy-phone">电话:{{$address->phone}}</span> </span> 
        </div> 
        <div class="default-address"> 
         <span class="buy-line-title buy-line-title-type">收货地址：</span> 
         <span class="buy--address-detail"> <span class="province">{{$address->address}}</span>  
        </div> 
       <!--  <ins class="deftip">
         默认地址
        </ins>  -->
       </div> 
       <div class="address-right"> 
        <a href="person/address.html"> <span class="am-icon-angle-right am-icon-lg"></span></a> 
       </div> 
       <div class="clear"></div> 
       <div class="new-addr-btn"> 
        <a href="#" class="hidden">设为默认</a> 
        <span class="new-addr-bar hidden">|</span> 
        <a href="#">编辑</a> 
        <span class="new-addr-bar">|</span> 
        <a href="javascript:void(0);" onclick="delClick(this);">删除</a> 
       </div> </li>
        @endif
       @endforeach
       @else
       当前还没有收货地址,请去添加
       @endif
      <div class="per-border"></div> 
     </ul> 
     <div class="clear"></div> 
    </div> 
    <!--物流 --> 
    <div class="logistics"> 
     <h3>选择物流方式</h3> 
     <ul class="op_express_delivery_hot"> 
      <li data-value="yuantong" class="OP_LOG_BTN  "><i class="c-gap-right" style="background-position:0px -468px"></i>圆通<span></span></li> 
      <li data-value="shentong" class="OP_LOG_BTN  "><i class="c-gap-right" style="background-position:0px -1008px"></i>申通<span></span></li> 
      <li data-value="yunda" class="OP_LOG_BTN  "><i class="c-gap-right" style="background-position:0px -576px"></i>韵达<span></span></li> 
      <li data-value="zhongtong" class="OP_LOG_BTN op_express_delivery_hot_last "><i class="c-gap-right" style="background-position:0px -324px"></i>中通<span></span></li> 
      <li data-value="shunfeng" class="OP_LOG_BTN  op_express_delivery_hot_bottom"><i class="c-gap-right" style="background-position:0px -180px"></i>顺丰<span></span></li> 
     </ul> 
    </div> 
    <div class="clear"></div> 
    <!--支付方式--> 
    <div class="logistics"> 
     <h3>选择支付方式</h3> 
     <ul class="pay-list"> 
      <li class="pay card"><img src="/static/Home/xiangmv/images/wangyin.jpg" />银联<span></span></li> 
      <li class="pay qq"><img src="/static/Home/xiangmv/images/weizhifu.jpg" />微信<span></span></li> 
      <li class="pay taobao"><img src="/static/Home/xiangmv/images/zhifubao.jpg" />支付宝<span></span></li> 
     </ul> 
    </div> 
    <div class="clear"></div> 
    <!--订单 --> 
    <div class="concent"> 
     <div id="payTable"> 
      <h3>确认订单信息</h3> 
      <div class="cart-table-th"> 
       <div class="wp"> 
        <div class="th th-item"> 
         <div class="td-inner">
          商品信息
         </div> 
        </div> 
        <div class="th th-price"> 
         <div class="td-inner">
          单价
         </div> 
        </div> 
        <div class="th th-amount"> 
         <div class="td-inner">
          数量
         </div> 
        </div> 
        <div class="th th-sum"> 
         <div class="td-inner">
          金额
         </div> 
        </div> 
        <div class="th th-oplist"> 
         <div class="td-inner">
          配送方式
         </div> 
        </div> 
       </div> 
      </div> 
      <div class="clear"></div>  
      <!-- 商品开头 -->
      @foreach($data as $row)
      <div class="bundle  bundle-last"> 
       <div class="bundle-main"> 
        <ul class="item-content clearfix"> 
         <div class="pay-phone"> 
          <li class="td td-item"> 
           <div class="item-pic"> 
            <a href="#" class="J_MakePoint"> <img src="{{$row['pic']}}" class="itempic J_ItemImg"  width="100px" height="100px" /></a> 
           </div> 
           <div class="item-info"> 
            <div class="item-basic-info"> 
             <a href="#" class="item-title J_MakePoint" data-point="tbcart.8.11">{{$row['name']}}</a> 
            </div> 
           </div> </li> 
          <li class="td td-info"> 
           <div class="item-props"> 
            <span class="sku-line">颜色：12#川南玛瑙</span> 
            <span class="sku-line">包装：裸装</span> 
           </div> </li> 
          <li class="td td-price"> 
           <div class="item-price price-promo-promo"> 
            <div class="price-content"> 
             <em class="J_Price price-now">{{$row['price']}}</em> 
            </div> 
           </div> </li> 
         </div> 
         <li class="td td-amount"> 
          <div class="amount-wrapper "> 
           <div class="item-amount "> 
            <span class="phone-title">购买数量</span> 
            <div class="sl"> 
             {{$row['num']}}
            </div> 
           </div> 
          </div> </li> 
         <li class="td td-sum"> 
          <div class="td-inner"> 
           <em tabindex="0" class="J_ItemSum number">{{$row['price']*$row['num']}}</em> 
          </div> </li> 
         <li class="td td-oplist"> 
          <div class="td-inner"> 
           <span class="phone-title">配送方式</span> 
           <div class="pay-logis">
             快递
            <b class="sys_item_freprice">10</b>元 
           </div> 
          </div> </li> 
        </ul> 
        <div class="clear"></div> 
       </div>  
       <div class="clear"></div> 
      </div> 
      @endforeach
     <!-- 商品结束 -->
      <div class="clear"></div> 
      <div class="pay-total"> 
       <!--留言--> 
       <div class="order-extra"> 
        <div class="order-user-info"> 
         <div id="holyshit257" class="memo"> 
          <label>买家留言：</label> 
          <input type="text" title="选填,对本次交易的说明（建议填写已经和卖家达成一致的说明）" placeholder="选填,建议填写和卖家达成一致的说明" class="memo-input J_MakePoint c2c-text-default memo-close" /> 
          <div class="msg hidden J-msg"> 
           <p class="error">最多输入500个字符</p> 
          </div> 
         </div> 
        </div> 
       </div> 
       <div class="clear"></div> 
      </div> 
      <!--含运费小计 --> 
      <div class="buy-point-discharge "> 
       <p class="price g_price "> 合计（含运费） <span>&yen;</span><em class="pay-sum">总计{{$allprice}}元</em> </p> 
      </div> 
      <!--信息 --> 
      <div class="order-go clearfix"> 
       <div class="pay-confirm clearfix">
       <!-- 选择地址开始 -->
       @if(!empty($defaultaddress))
        <div class="box"> 
         <div tabindex="0" id="holyshit267" class="realPay">
          <em class="t">实付款：</em> 
          <span class="price g_price "> <span>&yen;</span> <em class="style-large-bold-red " id="J_ActualFee">总计{{$allprice}}</em> </span> 
         </div> 
         <div id="holyshit268" class="pay-address"> 
          <p class="buy-footer-address"> 寄送至：<span class="buy-line-title buy-line-title-type" id="address">{{$defaultaddress->address}}</span>  </p> 
          <p class="buy-footer-address"> <span class="buy-line-title">收货人：</span> <span class="buy-address-detail"> <span class="buy-user" id="user">{{$defaultaddress->name}} </span> <span class="buy-phone" id="phone">电话:{{$defaultaddress->phone}}</span> </span> </p> 
         </div> 
        </div>
        @else
        此用户还没有默认收货地址,请去添加
        @endif
        <!-- 选择地址结束 -->
        <form action="/order/create" method="post" id="ff">
        <div id="holyshit269" class="submitOrder">
         <div class="go-btn-wrap"> 
          {{csrf_field()}}
          <input type="hidden" name="address_id" value="">
          <input type="hidden" name="tot" value="{{$allprice}}">
          <input type="submit" value="提交订单" id="J_Go" class="btn-go" style="float:right">
         </div> 
        </div>
        </form>  
        <div class="clear"></div> 
       </div> 
      </div> 
     </div> 
     <div class="clear"></div> 
    </div> 
   </div> 
   <div class="footer"> 
    <div class="footer-hd"> 
     <p> <a href="#">恒望科技</a> <b>|</b> <a href="#">商城首页</a> <b>|</b> <a href="#">支付宝</a> <b>|</b> <a href="#">物流</a> </p> 
    </div> 
    <div class="footer-bd"> 
     <p> <a href="#">关于恒望</a> <a href="#">合作伙伴</a> <a href="#">联系我们</a> <a href="#">网站地图</a> <em>&copy; 2015-2025 Hengwang.com 版权所有</em> </p> 
    </div> 
   </div> 
  </div> 
  <div class="theme-popover-mask"></div> 
  <div class="theme-popover"> 
   <!--标题 --> 
   <div class="am-cf am-padding"> 
    <div class="am-fl am-cf">
     <strong class="am-text-danger am-text-lg">新增地址</strong> / 
     <small>Add address</small>
    </div> 
   </div> 
   <hr /> 
   <div class="am-u-md-12"> 
    <form class="am-form am-form-horizontal" action="/addresss/insert" method="post"> 
     <div class="am-form-group"> 
      <label for="user-name" class="am-form-label">收货人</label> 
      <div class="am-form-content"> 
       <input type="text" id="user-name" name="name" placeholder="收货人" /> 
      </div> 
     </div> 
     <div class="am-form-group"> 
      <label for="user-phone" class="am-form-label">手机号码</label> 
      <div class="am-form-content"> 
       <input id="user-phone" placeholder="手机号必填" name="phone" type="text" /> 
      </div> 
     </div> 
     <div class="am-form-group"> 
      <label for="user-phone" class="am-form-label">所在地</label> 
      <div class="am-form-content address"> 
       <select id="cid"> 
          <option value="" class="ss">--请选择--</option> 
       </select> 
      </div> 
     </div> 
     <div class="am-form-group"> 
      <label for="user-intro" class="am-form-label">街道</label> 
      <div class="am-form-content"> 
       <textarea class="" rows="3" id="user-intro" placeholder="输入详细街道" name="adds"></textarea> 
       <small>100字以内写出你的详细街道...</small> 
      </div> 
     </div> 
     @if(!empty($defaultaddress))

     @else
    <div class="am-form-group"> 
      <label for="user-name" class="am-form-label">设置默认</label> 
      <div class="am-form-content"> 
       <input type="radio" name="status" value="1">默认
      </div> 
     </div>
     @endif
     <div class="am-form-group theme-poptit"> 
      <div class="am-u-sm-9 am-u-sm-push-3"> 
       <div class="am-btn am-btn-danger">
        <input type="hidden" name="address" value="">
        {{csrf_field()}}
        <input type="submit" id="buttonid" value="提交">
       </div> 
       <div class="am-btn am-btn-danger close">
        取消
       </div> 
      </div> 
     </div> 
    </form> 
   </div> 
  </div> 
  <div class="clear"></div>  
 </body>
<script type="text/javascript">
  //第一级数据
    $.ajax({
      url:'/address',//url地址
      type:'get',//请求方式
      data:{upid:0},
      async:true,//异步处理
      dataType:'json',//返回响应数据类型
      //Ajax 响应成功匿名函数
      success:
      function(data){
        // alert(data);
        //遍历
        for(var i=0;i<data.length;i++){
          $(".ss").attr("disabled",true);
          // alert(data[i].name);
          //存储在option
          option='<option value="'+data[i].id+'">'+data[i].name+'</option>';
          // alert(option);
          //把带有数据的option内部插入到第一个select
          $("#cid").append(option);
        }
      },
      //Ajax 响应失败的匿名函数
      error:
      function(){
        alert("Ajax响应失败");
      }
    });

    //获取其他几级数据 
    //事件委派 live(事件,事件处理器函数)
    $("select").live("change",function(){
      //移除元素
      $(this).nextAll("select").remove();
      // alert($(this).val());
      o=$(this);
      //获取子级的upid
      upid=$(this).val();
      // alert(upid);
      $.ajax({
      url:'/address',//url地址
      type:'get',//请求方式
      data:{upid:upid},
      async:true,//异步处理
      dataType:'json',//返回响应数据类型
      //Ajax 响应成功匿名函数
      success:
      function(data){
        //创建select
        select=$("<select></select>");
        //内部插入option
        select.append('<option value="" class="mm">--请选择--</option>');
        // alert(data);
        //判断
        if(data.length>0){
          //遍历
          for(var i=0;i<data.length;i++){
            // alert(data[i].name);
            //存储在option
            option='<option value="'+data[i].id+'">'+data[i].name+'</option>';
            // alert(option);
            // 把带有数据的option内部插入到创建好的select
            select.append(option);
          }
          //把创建好的select 追加到前一个select后
          o.after(select);
          //禁用其他级别 请选择
          $(".mm").attr("disabled",true);
        }

      },
      //Ajax 响应失败的匿名函数
      error:
      function(){
        alert("Ajax响应失败");
      }
    });
    });


//获取城市级联选中的数据 =》赋值给隐藏域
$("#buttonid").click(function(){
  arr=[];
  //遍历所有的城市级联下拉框
  $("select").each(function(){
    //查找select下的选中的option
    value=$(this).find("option:selected").html();
    // alert(value);
    arr.push(value);
  });

  // alert(arr);
  //赋值给隐藏域
  $("input[name='address']").val(arr);
});
//获取选中的收货地址
$(".user-addresslist").click(function(){
  //获取uid的值
  uid=$(this).attr("uid");
  // alert(uid);
  //赋值给隐藏域
  $("input[name='address_id']").val(uid);

  //ajax
  $.get("/chooseaddress",{address_id:uid},function(data){
    // alert(data);
    //把选中地址赋值给页面
    $("#address").html(data.address);
    $("#user").html(data.name);
    $("#phone").html(data.phone);
  },'json');
});
///提交
$("#ff").submit(function(){
  //获取address_id
  address_id=$("input[name='address_id']").val();
  if(address_id>0){
    return true;
  }else{
    alert("请选择收货地址");
    return false;
  }
  
});
</script>
</html>