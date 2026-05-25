# CRM Management System

Hệ thống CRM nội bộ được xây dựng bằng Laravel 12, hỗ trợ quản lý khách hàng, dự án, công việc và người dùng trong cùng một nền tảng. Trọng tâm phần tôi thực hiện trong dự án là backend, thiết kế dữ liệu và các luồng nghiệp vụ như phân quyền, giao việc, thông báo và quản lý tệp đính kèm.

## Mục tiêu dự án

- Xây dựng một ứng dụng CRM dạng web để quản lý dữ liệu khách hàng, dự án và công việc.
- Áp dụng mô hình phân quyền theo vai trò để tách biệt quyền của quản trị viên và người dùng thường.
- Tối ưu luồng làm việc khi giao dự án và giao task bằng notification và email.
- Rèn luyện kỹ năng phát triển backend web application với Laravel, Eloquent ORM và xử lý business flow thực tế.

## Phần tôi tập trung thực hiện

- Phân tích bài toán CRM và thiết kế luồng nghiệp vụ chính.
- Thiết kế cơ sở dữ liệu và xây dựng quan hệ giữa `User`, `Client`, `Project`, `Task`.
- Phát triển các module CRUD cho người dùng, khách hàng, dự án và công việc.
- Xây dựng xử lý backend cho phân quyền, notification, email và upload file đính kèm.
- Viết một số feature test cho các rule quan trọng của hệ thống.

## Tính năng nổi bật

- Đăng ký, đăng nhập, quên mật khẩu, xác thực email.
- Phân quyền theo vai trò với `admin` và `user`.
- Quản lý người dùng:
  - tạo mới, cập nhật, xóa mềm, khôi phục, xóa vĩnh viễn
  - gán vai trò cho người dùng
- Quản lý khách hàng với đầy đủ thông tin liên hệ và công ty.
- Quản lý dự án:
  - tạo dự án
  - gán người phụ trách
  - cập nhật trạng thái
  - xem chi tiết dự án và danh sách task liên quan
- Quản lý công việc:
  - tạo task theo dự án và khách hàng
  - gán người xử lý
  - cập nhật trạng thái và deadline
  - xem chi tiết task, người phụ trách, khách hàng, dự án liên quan
- Notification khi giao dự án hoặc giao task.
- Gửi email khi giao task.
- Upload, tải xuống và xóa tệp đính kèm cho dự án và công việc.
- Bắt buộc người dùng chấp nhận điều khoản trước khi tiếp tục sử dụng hệ thống.

## Business Flow

1. Quản trị viên tạo tài khoản và phân vai trò cho người dùng.
2. Hệ thống lưu thông tin khách hàng và doanh nghiệp.
3. Từ khách hàng, người dùng tạo dự án và gán người phụ trách.
4. Trong mỗi dự án, người dùng tạo các task cụ thể và giao cho thành viên phù hợp.
5. Khi một task được giao, hệ thống tạo notification và gửi email cho người nhận.

## Công nghệ sử dụng

### Backend

- PHP 8.2
- Laravel 12
- Laravel Sanctum
- Laravel Breeze
- Eloquent ORM
- Laravel Notifications
- Laravel Mail

### Frontend

- Blade Template Engine
- Tailwind CSS
- Alpine.js
- Vite

### Packages chính

- `spatie/laravel-permission` - phân quyền vai trò và quyền
- `spatie/laravel-medialibrary` - quản lý file đính kèm

### Testing

- Pest

## Cấu trúc dữ liệu chính

- `User`: thông tin tài khoản, vai trò, điều khoản sử dụng, địa chỉ, số điện thoại.
- `Client`: khách hàng và doanh nghiệp.
- `Project`: dự án gắn với khách hàng và người phụ trách.
- `Task`: công việc thuộc dự án, có người nhận xử lý, deadline và trạng thái.
- `Notification`: thông báo khi được giao dự án hoặc công việc.
- `Media`: tệp đính kèm cho project và task.

## Cài đặt và chạy dự án

### 1. Clone source code

```bash
git clone <your-repository-url>
cd CRM-MAIN
```

### 2. Cài dependency

```bash
composer install
npm install
```

### 3. Tạo file môi trường

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Cấu hình database trong `.env`

Cập nhật các biến:

- `DB_CONNECTION`
- `DB_HOST`
- `DB_PORT`
- `DB_DATABASE`
- `DB_USERNAME`
- `DB_PASSWORD`

### 5. Chạy migration và seed dữ liệu

```bash
php artisan migrate --seed
```

### 6. Chạy ứng dụng

```bash
composer dev
```

Sau khi chạy, ứng dụng sẽ khởi động:

- Laravel server
- Queue listener
- Vite development server

## Tài khoản demo

Sau khi seed dữ liệu, có thể dùng:

- Admin:
  - Email: `admin@gmail.com`
  - Password: `password`
- User:
  - Email: `user@gmail.com`
  - Password: `password`

## Kiểm thử

Chạy test bằng lệnh:

```bash
php artisan test
```

Các nhóm test hiện có bao gồm:

- xác thực người dùng
- truy cập dashboard
- quyền truy cập trang user
- điều khoản sử dụng
- quyền xóa dự án

## Hướng phát triển tiếp theo

- Hoàn thiện REST API cho mobile app hoặc frontend tách riêng.
- Bổ sung filter nâng cao, tìm kiếm và phân trang tối ưu hơn.
- Thêm biểu đồ thống kê trực quan cho dashboard.
- Tích hợp activity log để theo dõi lịch sử thao tác.
- Viết thêm test cho các luồng tạo và giao task, upload file và notification.