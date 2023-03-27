@extends("Admin.AdminPublic.adminpublic")
@section("admin")
<form action="/adminorders/{{$orders->id}}" method="post">
<div class="mws-form-row">
	<label class="mws-form-label">订单状态</label>
	<div class="mws-form-item clearfix">
		<ul class="mws-form-list inline">
			<li><input  name="status" value="0" type="radio" @if($orders->status=="已下单未支付") checked @endif> <label>已下单未支付</label></li>
			<li><input  name="status" value="1" type="radio" @if($orders->status=="已支付") checked @endif> <label>已支付</label></li>
			<li><input  name="status" value="2" type="radio" @if($orders->status=="已发货") checked @endif> <label>已发货</label></li>
			<li><input  name="status" value="3" type="radio" @if($orders->status=="已收货") checked @endif> <label>已收货</label></li>
		</ul>
	</div>
</div>
{{csrf_field()}}
{{method_field("PUT")}}
<input type="submit" value="确认修改">
</form>
@endsection
@section("title","后台--订单状态修改")