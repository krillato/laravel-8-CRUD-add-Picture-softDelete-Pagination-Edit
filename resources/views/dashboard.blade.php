<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hi, {{Auth::user()->name}}

            <b class="float-end">จำนวนผู้ที่ใช้ระบบอยู่ {{count($users)}}  คน</b>
            
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">login-time</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $row)
                      <tr>
                        <th scope="row">{{$row->id}}</th>
                        <td>{{$row->name}}</td>
                        <td>{{$row->email}}</td>
                        <td>{{Carbon\Carbon::parse($row->created_at)->diffForHumans()}}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
</x-app-layout>
