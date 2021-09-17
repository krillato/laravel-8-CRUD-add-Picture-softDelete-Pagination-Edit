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
                    <div class="card">
                        <div class="card-header">แบบฟอร์ม Edit data</div>
                        <div class="card-body">
                            <form action="{{url('/service/update/'.$service->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="service_name">ชื่อบริการ</label>
                                    <input type="text" class="form-control" name="service_name" id="" value="{{$service->service_name}}">
                                </div>
                                <div class="my-2">
                                     @error('service_name')
                                        <span class="text-danger my-2">{{ $message }}</span>
                                     @enderror
                                </div>

                                 
                                <div class="form-group">
                                    <label for="service_image">ภาพประกอบ</label>
                                    <input type="file" class="form-control" name="service_image" id="" value="{{$service->service_image}}">
                                </div>
                                <div class="my-2">
                                     @error('service_image')
                                        <span class="text-danger my-2">{{ $message }}</span>
                                     @enderror
                                </div>
                               
                                <br>
                                <input type="hidden" name="old_image" value="{{$service->service_image}}">
                                <div class="form-group">
                                    <img src="{{asset($service->service_image)}}" alt="" height="300px" width="300px">
                                </div><br><br>

                                <input type="submit" class="btn btn-success" value="update" id="">
                            </form>
                        </div>
                    </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</x-app-layout>
