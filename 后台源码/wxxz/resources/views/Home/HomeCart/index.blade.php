<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>购物车页面</title>

    <link href="/static/Home/xiangmv/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" />
    <link href="/static/Home/xiangmv/basic/css/demo.css" rel="stylesheet" type="text/css" />
    <link href="/static/Home/xiangmv/css/cartstyle.css" rel="stylesheet" type="text/css" />
    <link href="/static/Home/xiangmv/css/optstyle.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="/static/Home/xiangmv/js/jquery.js"></script>

  </head>

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
          <div class="menu-hd"><a href="#" target="_top" class="h">商城首页</a></div>
        </div>
        <div class="topMessage my-shangcheng">
          <div class="menu-hd MyShangcheng"><a href="/homeperson" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
        </div>
        <div class="topMessage mini-cart">
          <div class="menu-hd"><a id="mc-menu-hd" href="/homecart" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h"></strong></a></div>
        </div>
        <div class="topMessage favorite">
          <div class="menu-hd"><a href="#" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
      </ul>
      </div>

      <!--悬浮搜索框-->

      <div class="nav white">
        <div class="logo"><img src="/static/Home/xiangmv/images/logo.png" /></div>
        <div class="logoBig">
          <li><img src="/static/Home/xiangmv/images/logobig.png" /></li>
        </div>

        <div class="search-bar pr">
          <a name="index_none_header_sysc" href="#"></a>
          <form>
            <input id="searchInput" name="index_none_header_sysc" type="text" placeholder="搜索" autocomplete="off">
            <input id="ai-topsearch" class="submit am-btn" value="搜索" index="1" type="submit">
          </form>
        </div>
      </div>

      <div class="clear"></div>
      <!--购物车 -->
      <div class="concent">
        <div id="cartTable">
          <div class="cart-table-th">
            <div class="wp">
              <div class="th th-chk">
                <div id="J_SelectAll1" class="select-all J_SelectAll">

                </div>
              </div>
              <div class="th th-item">
                <div class="td-inner">商品信息</div>
              </div>
              <div class="th th-price">
                <div class="td-inner">单价</div>
              </div>
              <div class="th th-amount">
                <div class="td-inner">数量</div>
              </div>
              <div class="th th-sum">
                <div class="td-inner">金额</div>
              </div>
              <div class="th th-op">
                <div class="td-inner">操作</div>
              </div>
            </div>
          </div>
          <div class="clear"></div>
          
          
          <tr class="item-list">
            <!-- 购物车遍历开始 -->
            @if(count($data1))
            @foreach($data1 as $row)
            <div class="bundle  bundle-last">
              <div class="clear"></div>
              <div class="bundle-main">                
                <ul class="item-content clearfix">
                  <li class="td td-chk">
                    <div class="cart-checkbox ">
                      <input class="check" id="J_CheckBox_170037950254" name="items" value="{{$row['id']}}" type="checkbox">
                      <label for="J_CheckBox_170037950254"></label>
                    </div>
                  </li>
                  <li class="td td-item">
                    <div class="item-pic">
                      <a href="#" target="_blank" data-title="美康粉黛醉美东方唇膏口红正品 持久保湿滋润防水不掉色护唇彩妆" class="J_MakePoint" data-point="tbcart.8.12">
                        <img src="{{$row['pic']}}"  width="100px" height="100px"class="itempic J_ItemImg"></a>
                    </div>
                    <div class="item-info">
                      <div class="item-basic-info">
                        <a href="#" target="_blank" title="美康粉黛醉美唇膏 持久保湿滋润防水不掉色" class="item-title J_MakePoint" data-point="tbcart.8.11">{{$row['name']}}</a>
                      </div>
                    </div>
                  </li>
                  <li class="td td-info">
                    <div class="item-props item-props-can">
                      <span class="sku-line">描述：描述{!!$row['descr']!!}</span>
                      <span class="sku-line">包装：裸装</span>
                      <i class="theme-login am-icon-sort-desc"></i>
                    </div>
                  </li>
                  <li class="td td-price">
                    <div class="item-price price-promo-promo">
                      <div class="price-content">
                        <div class="price-line">
                          <em class="J_Price price-now" tabindex="0">单价{{$row['price']}}</em>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="td td-amount">
                    <div class="amount-wrapper ">
                      <div class="item-amount ">
                        <div class="sl">
                          <a href="javascript:void(0)" class="btn btn-info updatee" name="{{$row['id']}}">-</a>
                          <input class="text_box" type="text" value="{{$row['num']}}" style="width:30px;" />
                          <a href="javascript:void(0)" class="btn btn-info update" name="{{$row['id']}}">+</a>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="td td-sum">
                    <div class="td-inner">
                      <em tabindex="0" class="J_ItemSum number">{{$row['price']*$row['num']}}</em>
                    </div>
                  </li>
                  <li class="td td-op">
                    <div class="td-inner">
                      <a title="移入收藏夹" class="btn-fav" href="#">
                  移入收藏夹</a>
                     <form action="/homecart/{{$row['id']}}" method="post">
                        {{csrf_field()}}
                        {{method_field("DELETE")}}
                        <button type="submit" class="delete">删除</button>
                  </form>
                    </div>
                  </li>
                </ul>
                          
                
                
                
              </div>
            </div>
          </tr>
          @endforeach
          @else
          购物车空空如也
          @endif
          <!-- 购物车遍历结束 -->
          <div class="clear"></div>
        </div>
        <div class="clear"></div>

        <div class="float-bar-wrapper">
          <div id="J_SelectAll2" class="select-all J_SelectAll">
            <div class="cart-checkbox">
              <input class="check-all check" id="J_SelectAllCbx2" name="select-all" value="true" type="checkbox">
              <label for="J_SelectAllCbx2"></label>
            </div>
            <span>全选</span>
          </div>
          <div class="operations">
            <a href="/alldelete" hidefocus="true" class="deleteAll">全部删除</a>
            <a href="/homeindex" hidefocus="true" class="J_BatchFav">继续购物</a>
          </div>
          <div class="float-bar-right">
            <div class="amount-sum">
              <span class="txt">已选商品</span>
              <em id="J_SelectedItemsCount">0</em><span class="txt">件</span>
              <div class="arrow-box">
                <span class="selected-items-arrow"></span>
                <span class="arrow"></span>
              </div>
            </div>
            <div class="price-sum">
              <span class="txt">合计:</span>
              <strong class="price">¥<em id="J_Total">0</em>元</strong>
            </div>
            <div class="">
              {{csrf_field()}}
                <input type="submit" name="accounts" value="结算" style="background-color:green;width:150px;height:100px;color:black">
            </div>
          </div>
        


        </div>
        <div class="footer">
          <div class="footer-hd">
            <p>
              <a href="#">恒望科技</a>
              <b>|</b>
              <a href="#">商城首页</a>
              <b>|</b>
              <a href="#">支付宝</a>
              <b>|</b>
              <a href="#">物流</a>
            </p>
          </div>
          <div class="footer-bd">
            <p>
              <a href="#">关于恒望</a>
              <a href="#">合作伙伴</a>
              <a href="#">联系我们</a>
              <a href="#">网站地图</a>
              <em>© 2015-2025 Hengwang.com 版权所有</em>
            </p>
          </div>
        </div>

      </div>

      <!--操作页面-->

      <div class="theme-popover-mask"></div>

      <div class="theme-popover">
        <div class="theme-span"></div>
        <div class="theme-poptit h-title">
          <a href="javascript:;" title="关闭" class="close">×</a>
        </div>
        <div class="theme-popbod dform">
          <form class="theme-signin" name="loginform" action="" method="post">

            <div class="theme-signin-left">

              <li class="theme-options">
                <div class="cart-title">颜色：</div>
                <ul>
                  <li class="sku-line selected">12#川南玛瑙<i></i></li>
                  <li class="sku-line">10#蜜橘色+17#樱花粉<i></i></li>
                </ul>
              </li>
              <li class="theme-options">
                <div class="cart-title">包装：</div>
                <ul>
                  <li class="sku-line selected">包装：裸装<i></i></li>
                  <li class="sku-line">两支手袋装（送彩带）<i></i></li>
                </ul>
              </li>
              <div class="theme-options">
                <div class="cart-title number">数量</div>
                <dd>
                  <input class="min am-btn am-btn-default" name="" type="button" value="-" />
                  <input class="text_box" name="" type="text" value="1" style="width:30px;" />
                  <input class="add am-btn am-btn-default" name="" type="button" value="+" />
                  <span  class="tb-hidden">库存<span class="stock">1000</span>件</span>
                </dd>

              </div>
              <div class="clear"></div>
              <div class="btn-op">
                <div class="btn am-btn am-btn-warning">确认</div>
                <div class="btn close am-btn am-btn-warning">取消</div>
              </div>

            </div>
            <div class="theme-signin-right">
              <div class="img-info">
                <img src="/static/Home/xiangmv/images/kouhong.jpg_80x80.jpg" />
              </div>
              <div class="text-info">
                <span class="J_Price price-now">¥39.00</span>
                <span id="Stock" class="tb-hidden">库存<span class="stock">1000</span>件</span>
              </div>
            </div>

          </form>
        </div>
      </div>
    <!--引导 -->
    <div class="navCir">
      <li><a href="home.html"><i class="am-icon-home "></i>首页</a></li>
      <li><a href="sort.html"><i class="am-icon-list"></i>分类</a></li>
      <li class="active"><a href="shopcart.html"><i class="am-icon-shopping-basket"></i>购物车</a></li>  
      <li><a href="person/index.html"><i class="am-icon-user"></i>我的</a></li>         
    </div>
  </body>
  <script type="text/javascript">
    // alert($);
    //减操作
    $(".updatee").click(function(){
      //获取id
      id=$(this).attr("name");
      o=$(this);
      // alert(id);
      //Ajax
      $.get("/cartupdatee",{id:id},function(data){
        // alert(data);
        //给客户端的数量赋值
        o.next("input").val(data.num);
        //给客户端的总计赋值
        o.parents("li").next("li").find("em").html(data.tot);
      },'json');
    });

    //ajax加操作
    $(".update").click(function(){
      oo=$(this);
      //获取id
      id=$(this).attr("name");
      // alert(id);
      //Ajax请求
      $.get("/cartupdate",{id:id},function(data){
        // alert(data);
        //给数量赋值
        oo.prev("input").val(data.num);
        //给总计赋值
        oo.parents("li").next("li").find("em").html(data.tot);
      },'json');
    });

    //判断下购物车数据有没有被选中
    arr=[];//存储选中数据的id
    $("input[name='items']").change(function(){
      //判断复选框是否被选中
      if($(this).attr("checked")){
        //获取选中数据的id
        id=$(this).val();
        // alert(id);
        //把id添加到数组里 arr
        arr.push(id);
      }else{
        //不选中的话  把指定不选中数据的id 从数组arr里做删除
        //获取没有选中数据的id
        id1=$(this).val();
        // alert(id1);
        // 首先可以给JS的数组对象定义一个函数，用于查找指定的元素在数组中的位置，即索引，代码为：

          Array.prototype.indexOf = function(val) {
          for (var i = 0; i < this.length; i++) {
          if (this[i] == val) return i;
          }
          return -1;
          }

          // 然后使用通过得到这个元素的索引，使用js数组自己固有的函数去删除这个元素
          Array.prototype.remove = function(val) {
            var index = this.indexOf(val);
                if (index > -1) {
                  this.splice(index, 1);
                }
            }

            arr.remove(id1);


      }
      // alert(arr);
      //ajax 把存储选中数据id的数组当做附加参数传递到服务端页面
      $.get("/homecarttot",{arr:arr},function(data){
        // alert(data.nums);
        //给页面赋值
        //赋值数量
        $("#J_SelectedItemsCount").html(data.nums);
        //总价格赋值
        $("#J_Total").html(data.sum);
      },'json');
    });

    //结算
    $("input[name='accounts']").click(function(){
      //判断购买的商品是否被勾选 is判断是否被选中
      if($("input[name='items']").is(":checked")){
        // alert("sss");
        //Ajax请求 把勾选的数据存储在session里
        $.get("/accounts",{arr:arr},function(data){
          // alert(data);
          //判断
          if(data){
            //跳转到结算页面
            //js跳转的方法那个？
            window.location="/homeorder/insert";
          }
        },'json');
        

      }else{
        alert("请至少选中一条数据");
      }
    });
  </script>
</html>