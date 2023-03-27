@extends("Admin.AdminPublic.adminpublic")
@section("admin")
<html>
 <head></head>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span>学员批量导入</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <form class="mws-form" action="/userss" method="post" enctype="multipart/form-data">
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
       <label class="mws-form-label">批量导入</label> 
       <div class="mws-form-item"> 
        <input type="file" class="large" name="pic"/> 
       </div> 
      </div>    
     </div> 
     <div class="mws-button-row"> 
     	{{csrf_field()}}
      <input type="submit" value="导入" class="btn btn-danger" /> 
      <input type="reset" value="重置" class="btn " /> 
     </div> 
    </form> 
   </div> 
  </div>
 </body>
</html>
@endsection
@section("title","后台--学员批量导入")