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
                        <div class="card-header">ตารางข้อมูลบริการ</div>
                      {{--  {{ $services }}  ข้อมูลที่ส่งมาจาก controller --}}
                        <table class="table table-striped table-hover table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">ลำดับ</th>
                                <th scope="col">ภาพประกอบ</th>
                                <th scope="col">ชื่อบริการ</th>
                                <th scope="col">ผู้เพิ่ม</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                              </tr>
                            </thead>
                            <tbody>
                                
                                @foreach ($services as $row)
                              <tr>
                                <th scope="row">{{$services->firstItem()+$loop->index}}</th>

                                <td>
                                    <img src="{{asset($row->service_image)}}" alt="" width="100px" height="100px">
                                </td>

                                <td>{{$row->service_name}}</td>{{-- ดึงจากตาราง user --}}
                                <td>
                                    @if ($row->created_at == NULL)
                                        ไม่มีข้อมูล
                                    @else 
                                        {{ Carbon\Carbon::parse($row->created_at)->diffForHumans() }}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{url('/service/edit/'.$row->id)}}" class="btn btn-primary">แก้ไข</a>
                                </td>
                                <td>
                                    <a href="{{url('/service/delete/'.$row->id)}}" class="btn btn-warning"
                                        onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่')"
                                        >ลบข้อมูล</a>
                                    
                                </td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                          {{ $services->links() }}
                    </div>
                    


                     
                   


                </div>  
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">แบบฟอร์มบริการ</div>
                        <div class="card-body">
                            <form action="{{route('addService')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="service_name">ชื่อบริการ</label>
                                    <input type="text" class="form-control" name="service_name" id="">
                                </div>
                                <div class="my-2">
                                     @error('service_name')
                                        <span class="text-danger my-2">{{ $message }}</span>
                                     @enderror
                                </div>


                                <div class="form-group">
                                    <label for="service_image">ภาพประกอบ</label>
                                    <input type="file" class="form-control" name="service_image" id="">
                                </div>
                                <div class="my-2">
                                     @error('service_image')
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
