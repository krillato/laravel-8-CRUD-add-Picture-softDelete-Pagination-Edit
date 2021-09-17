# laravel-8-CRUD-add-Picture-softDelete-Pagination-Edit

1. เข้า https://laravel.com/docs/8.x
2. เปิด cmd
3. composer create-project laravel/laravel example-app-name
4. cd example-app-name
5. php artisan serve

กรณีไม่สามารถ ลงได้ Problem 1
แก้โดย
พิมพ์ composer install --ignore-platform-reqs ลงใน cmd => project
หรือ composer update --ignore-platform-reqs

จากนั้นทำการเปิด
php artisan serve

หากเปิดไม่ได้
แก้โดย
1.php artisan queue:restart
2.php artisan key:generate
3.php artisan serve

เปิดบราว์เซอร์
http://127.0.0.1:8000/

เชื่อมต่อ database ผ่าน ไฟล์ .env
php artisan storage:link    

ส่วนเสริม  https://jetstream.laravel.com/2.x/installation.html
> composer require laravel/jetstream
> php artisan jetstream:install livewire   
> npm install && npm run dev

