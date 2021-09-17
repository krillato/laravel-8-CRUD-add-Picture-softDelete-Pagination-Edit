<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class DepartmentController extends Controller
{
    //
    public function index(){

        //เรียกใช้ ตาราง departments ไปจอยกับ ตาราง user โดยเอา user_id ในตาราง departments เทียบกับ id ใน ตาราง user
       // จากนั้นก็ดึง ทุกอย่างใน departments และดึงแค่ name ในตาราง user
      /*  $departments =DB::table('departments')
        ->join('users','departments.user_id','users.id')
        ->select('departments.*','users.name')->paginate(5); */
        
        //$departments = DB::table('departments')->paginate(3);
        $departments = Department::paginate(3); //ช้อมูล
        $trashDepartment= Department::onlyTrashed()->paginate(2); //ข้อมูลในถังขยะ
        /* $departments=Department::all(); */
        return view('admin.department.index',compact('departments','trashDepartment'));
    }

    public function store(Request $request){
        //ตรวจสอบข้อมูล
        $request->validate([
            'department_name'=>'required|unique:departments|max:255'
        ],
        [
            'department_name.required'=>"กรุณาป้อนชื่อแผนก",
            'department_name.max'=>"ตัวอักษรเกินขีดจำกัด",
            'department_name.unique'=>"แผนกซ้ำกัน",
        ]
    );
        //บันทึกข้อมูล

        $data = array();
        $data["department_name"] = $request->department_name;
        $data["user_id"] = Auth::user()->id ;
        $data["admin"] = Auth::user()->name ;

        //query builder
        DB::table('departments')->insert($data);
        return redirect()->back()->with('success',"บันทึกข้อมูลเรียบร้อยจ้า");

        /* $department->admin = Auth::user()->name ;
       $department = new Department;
       $department->department_name = $request->department_name ;
       $department->admin = Auth::user()->name ;
       $department->user_id = Auth::user()->id ; //ดึงไอดีผู้ใช้
       $department->save(); */
    }

    public function edit($id){
      $departments =  Department::find($id);
      return view('admin.department.edit', compact('departments'));
    }

    public function update(Request $request, $id){
        //debug dd($id, $request->department_name); // name="department_name" <= form input
        //กรองข้อมูล
        $request->validate([
            'department_name'=>'required|unique:departments|max:255'
        ],
        [
            'department_name.required'=>"กรุณาป้อนชื่อแผนก",
            'department_name.max'=>"ตัวอักษรเกินขีดจำกัด",
            'department_name.unique'=>"แผนกซ้ำกัน",
        ]
    );
    $update = Department::find($id)->update([
        'department_name' => $request->department_name,
        'user_id'=>Auth::user()->id,
    ]);

    return redirect()->route('department')->with('success',"UPDATEข้อมูลเรียบร้อยจ้า");
    }

    public function softdelete($id)
    {
        $delete = Department::find($id)->delete();
       return redirect()->back()->with('success',"DELETEข้อมูลเรียบร้อยจ้า");
    }

    public function restore($id){
        Department::withTrashed()->find($id)->restore();
        return redirect()->back()->with('success',"กู้คืนข้อมูลเรียบร้อยจ้า");
    }

    public function delete($id){
        $delete = Department::onlyTrashed()->find($id)->forceDelete();
        return redirect()->back()->with('success',"ลบข้อมูลถาวรแล้ว");
    }
}
