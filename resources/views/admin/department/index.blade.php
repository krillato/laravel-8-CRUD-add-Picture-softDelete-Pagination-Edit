<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hi, {{Auth::user()->name}}

            <b class="float-end">จำนวนผู้ที่ใช้ระบบอยู่   คน</b>


            
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    @if (session("success"))
                        <div class="alert alert-success"> {{session('success')}} </div>
                    @endif
                    <div class="card">
                        <div class="card-header">ตารางข้อมูลแผนก</div>
                      {{--  {{ $departments }}  ข้อมูลที่ส่งมาจาก controller --}}
                        <table class="table table-striped table-hover table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">ลำดับ</th>
                                <th scope="col">ชื่อแผนก</th>
                                <th scope="col">UserID</th>
                                <th scope="col">ผู้เพิ่ม</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                              </tr>
                            </thead>
                            <tbody>
                                
                                @foreach ($departments as $row)
                              <tr>
                                <th scope="row">{{$departments->firstItem()+$loop->index}}</th>
                                <td>{{$row->department_name}}</td>
                                <td>{{$row->user->name}}</td>{{-- ดึงจากตาราง user --}}
                                <td>
                                    @if ($row->created_at == NULL)
                                        ไม่มีข้อมูล
                                    @else 
                                        {{ Carbon\Carbon::parse($row->created_at)->diffForHumans() }}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{url('/department/edit/'.$row->id)}}" class="btn btn-primary">แก้ไข</a>
                                </td>
                                <td>
                                    <a href="{{url('/department/softdelete/'.$row->id)}}" class="btn btn-warning">ลบข้อมูล</a>
                                </td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                          {{ $departments->links() }}
                    </div>
                    


                     
                    @if (count($trashDepartment)>0)
                    <div class="card my-2">
                        <div class="card-header">ถังขยะ</div>
                        {{--  {{ $departments }}  ข้อมูลที่ส่งมาจาก controller --}}
                          <table class="table table-striped table-hover table-bordered">
                              <thead>
                                <tr>
                                  <th scope="col">ลำดับ</th>
                                  <th scope="col">ชื่อแผนก</th>
                                  <th scope="col">UserID</th>
                                  <th scope="col">ผู้เพิ่ม</th>
                                  <th scope="col">กู้คืนข้อมูล</th>
                                  <th scope="col">ลบถาวร</th>
                                </tr>
                              </thead>
                              <tbody>
                                  
                                  @foreach ($trashDepartment as $row)
                                <tr>
                                  <th scope="row">{{$trashDepartment->firstItem()+$loop->index}}</th>
                                  <td>{{$row->department_name}}</td>
                                  <td>{{$row->user->name}}</td>{{-- ดึงจากตาราง user --}}
                                  <td>
                                      @if ($row->created_at == NULL)
                                          ไม่มีข้อมูล
                                      @else 
                                          {{ Carbon\Carbon::parse($row->created_at)->diffForHumans() }}
                                      @endif
                                  </td>
                                  <td>
                                      <a href="{{url('/department/restore/'.$row->id)}}" class="btn btn-primary">กู้คืน</a>
                                  </td>
                                  <td>
                                      <a href="{{url('/department/delete/'.$row->id)}}" class="btn btn-danger">ลบถาวร</a>
                                  </td>
                                </tr>
                                @endforeach
                              </tbody>
                            </table>
                            {{ $trashDepartment->links() }}
                    </div>
                    @endif


                </div>  
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">แบบฟอร์ม</div>
                        <div class="card-body">
                            <form action="{{route('addDepartment')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="department_name">ชื่อแผนก</label>
                                    <input type="text" class="form-control" name="department_name" id="">
                                </div>
                                <div class="my-2">
                                     @error('department_name')
                                        <span class="text-danger my-2">{{ $message }}</span>
                                     @enderror
                                </div>
                               
                                <br>
                                <input type="submit" class="btn btn-success" value="บันทึก" id="">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
