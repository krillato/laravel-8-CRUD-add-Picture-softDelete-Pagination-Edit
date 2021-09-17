<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

    public function index()
    {

        $services = Service::paginate(3);
        return view('admin.service.index', compact('services'));

    }

    public function edit($id)
    {
        $service = Service::find($id);
        return view('admin.service.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        //ตรวจสอบข้อมูล
        $request->validate(
            [
                'service_name' => 'required|max:255',
            ],
            [
                'service_name.required' => "กรุณาป้อนชื่อบริการ",
                'service_name.max' => "ตัวอักษรเกินขีดจำกัด",
            ]
        );
        //การเข้ารหัสรูปภาพ
        $service_image = $request->file('service_image');

        //อัพเดตภาพและชื่อ
        if ($service_image) {

            //Generate ชื่อภาพ
            $name_gen = hexdec(uniqid());
            //ดึงนามสกุลไฟล์ภาพ
            $img_ext = strtolower($service_image->getClientOriginalExtension());

            $img_name = $name_gen . '.' . $img_ext;

            //อัพโหลดและอัพเดตข้อมูล
            $upload_location = 'image/services/';
            $full_path = $upload_location . $img_name;

            //อัพเดตข้อมูล
            Service::find($id)->update([
                'service_name' => $request->service_name,
                'service_image' => $full_path,
            ]);

            //ลบภาพเก่าเอาภาพใหม่แทนที่
            $old_image =$request->old_image;
            unlink($old_image);
            $service_image->move($upload_location, $img_name);

            return redirect()->route('services')->with('success', "อัพเดตเรียบร้อยจ้า");

        }else {
            //อัพเดตชื่ออย่างเดียว
            Service::find($id)->update([
                'service_name' => $request->service_name,
                
            ]);
            return redirect()->route('services')->with('success', "อัพเดตชื่อเรียบร้อยจ้า");
        }

        //อัพเดตชื่ออย่างเดียว

    }

    public function store(Request $request)
    {
        //ตรวจสอบข้อมูล
        $request->validate([
            'service_name' => 'required|unique:services|max:255',
            'service_image' => 'required|mimes:jpg,jpeg,png',
        ],
            [
                'service_name.required' => "กรุณาป้อนชื่อบริการ",
                'service_name.max' => "ตัวอักษรเกินขีดจำกัด",
                'service_name.unique' => "บริการซ้ำกัน",
                'service_image.required' => "กรุณาใส่ภาพประกอบ",
            ]
        );

        //การเข้ารหัสรูปภาพ
        $service_image = $request->file('service_image');
        //Generate ชื่อภาพ
        $name_gen = hexdec(uniqid());
        //ดึงนามสกุลไฟล์ภาพ
        $img_ext = strtolower($service_image->getClientOriginalExtension());

        $img_name = $name_gen . '.' . $img_ext;

        //อัพโหลดและบันทึกข้อมูล
        $upload_location = 'image/services/';
        $full_path = $upload_location . $img_name;

        //upload
        Service::insert([
            'service_name' => $request->service_name,
            'service_image' => $full_path,
            'created_at' => Carbon::now(),
        ]);
        $service_image->move($upload_location, $img_name);
        return redirect()->back()->with('success', "บันทึกข้อมูลเรียบร้อยจ้า");

    }

    public function delete($id){
        
        //ลบภาพ
        $img = Service::find($id)->service_image;
        unlink($img);
        //ลบข้อมูล
        $delete = Service::find($id)->delete();
        return redirect()->back()->with('success',"ลบข้อมูลแล้ว");
    }

}
