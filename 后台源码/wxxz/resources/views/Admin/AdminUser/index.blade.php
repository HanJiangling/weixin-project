@extends("Admin.AdminPublic.adminpublic")
@section("admin")
<html>
 <head></head>
 <script type="text/javascript" src="/static/js/jquery-1.8.3.min.js"></script>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span><i class="icon-table"></i> 管理员列表</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
     <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info"> 
      <thead> 
       <tr role="row">
        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 155px;">ID</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 211px;">管理员名</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 98px;">操作</th>
       </tr> 
      </thead> 
      <tbody role="alert" aria-live="polite" aria-relevant="all">
      	@foreach($data as $row)
       <tr class="odd"> 
        <td class="sorting_1">{{$row->id}}</td> 
        <td class=" ">{{$row->name}}</td> 
        <td class=" ">
         <button class="btn btn-danger del">Ajax删除</button>
          <a href="/adminuser/{{$row->id}}/edit" class="btn btn-danger">修改</a>
          @if($role->uid==$row->id)
          超管无法分配角色
          @else
          <a href="/adminrole/{{$row->id}}" class="btn btn-success">分配角色</a>
          @endif
        </td> 
       </tr>
       @endforeach
      </tbody>
     </table>
     <div class="dataTables_paginate paging_full_numbers" id="pages">
     </div>
    </div> 
   </div> 
  </div>
 </body>
 <script type="text/javascript">
 // alert($);
 //获取删除的按钮
 $(".del").click(function(){
  //获取删除数据的id parents 获取祖先元素tr 
  id=$(this).parents("tr").find("td:first").html();
  //获取祖先元素 tr
  o=$(this).parents("tr");
  // alert(id);
  ss=confirm('你确定删除吗?');
  if(ss){
    //Ajax
    $.get("/adminuserssdel",{id:id},function(data){
      // alert(data);
      if(data.msg=="ok"){
        //干掉客户端带有数据的页面 移除方法
        o.remove();
      }
    },'json');

  }

 });
 </script>
</html>
@endsection
@section("title","后台--管理员列表")