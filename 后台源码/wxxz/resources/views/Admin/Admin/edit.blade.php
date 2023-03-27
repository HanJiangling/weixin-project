@extends("Admin.AdminPublic.adminpublic")
@section("admin")
<html>
 <head></head>
 <script type="text/javascript" src="/static/js/jquery-1.8.3.min.js"></script>

 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span>管理员密码修改</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <form class="mws-form" action="/admins/{{$user->id}}" method="post">
    	@if ($errors->any())
		    <div class="mws-form-message error">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif
     <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">密码</label> 
       <div class="mws-form-item"> 
        <input type="text" name="password" class="large" value="{{$user->password}}"/> 
       </div> 
      </div>      
     </div> 
     <div class="mws-button-row">
         {{csrf_field()}}
        {{method_field("PUT")}}
      <input type="submit" value="修改" class="btn btn-danger" /> 
      <input type="reset" value="重置" class="btn "/>
     </div> 
    </form> 
   </div> 
  </div>
 </body>
 <script>
 </script>
</html>
@endsection
@section("title","后台--管理员密码修改")