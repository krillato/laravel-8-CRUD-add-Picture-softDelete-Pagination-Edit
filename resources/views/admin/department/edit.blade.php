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
                            <form action="{{url('/department/update/'.$departments->id)}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="department_name">ชื่อแผนก</label>
                                    <input type="text" class="form-control" name="department_name" id="" value="{{$departments->department_name}}">
                                </div>
                                <div class="my-2">
                                     @error('department_name')
                                        <span class="text-danger my-2">{{ $message }}</span>
                                     @enderror
                                </div>
                               
                                <br>
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
