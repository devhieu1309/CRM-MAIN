<?php

namespace Database\Factories;

use App\Enums\ProjectStatus;
use App\Models\Client;
use App\Models\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Model>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $titles = [
            'Triển khai CRM nội bộ',
            'Nâng cấp website giới thiệu công ty',
            'Phát triển hệ thống quản lý khách hàng',
            'Tích hợp cổng thanh toán trực tuyến',
            'Xây dựng trang landing page chiến dịch',
            'Tối ưu hiệu năng và bảo mật hệ thống',
            'Thiết kế lại giao diện quản trị',
            'Kết nối API với hệ thống bên thứ ba',
            'Xây dựng báo cáo KPI theo phòng ban',
            'Triển khai quy trình chăm sóc khách hàng',
            'Tự động hóa email marketing',
            'Phân quyền và quản trị người dùng',
            'Xây dựng module quản lý dự án',
            'Tối ưu SEO và nội dung website',
            'Chuẩn hóa dữ liệu khách hàng và hợp đồng',
            'Tích hợp chatbot hỗ trợ khách hàng',
            'Xây dựng hệ thống ticket hỗ trợ',
            'Cải tiến quy trình bán hàng (Sales Pipeline)',
            'Xây dựng dashboard tổng quan',
            'Tích hợp đăng nhập SSO',
        ];

        $descriptions = [
            'Mục tiêu là chuẩn hóa quy trình, giảm thao tác thủ công và tăng khả năng theo dõi hiệu quả công việc theo thời gian thực.',
            'Phạm vi bao gồm phân tích yêu cầu, thiết kế giao diện, triển khai chức năng, kiểm thử và bàn giao hướng dẫn sử dụng.',
            'Tập trung cải thiện trải nghiệm người dùng, tối ưu hiệu năng, tăng tính ổn định và đảm bảo khả năng mở rộng hệ thống.',
            'Tích hợp dữ liệu từ nhiều nguồn, đồng bộ trạng thái và xây dựng báo cáo trực quan phục vụ quản trị và ra quyết định.',
            'Xây dựng luồng xử lý rõ ràng, phân quyền theo vai trò và ghi nhận lịch sử thao tác để dễ dàng kiểm soát và truy vết.',
            'Tối ưu quy trình nhập liệu, hạn chế sai sót, nâng cao chất lượng dữ liệu và giảm thời gian xử lý nghiệp vụ.',
            'Thiết kế hệ thống thông báo, nhắc việc theo mốc thời gian và cập nhật trạng thái để đảm bảo tiến độ dự án.',
            'Chuẩn hóa biểu mẫu, quy ước đặt tên và cấu trúc dữ liệu nhằm phục vụ việc vận hành, bảo trì và phát triển lâu dài.',
            'Tạo các màn hình quản trị thân thiện, hỗ trợ tìm kiếm, lọc, phân trang và thao tác hàng loạt khi cần.',
            'Nâng cấp bảo mật, phân quyền truy cập, kiểm soát dữ liệu nhạy cảm và tăng cường nhật ký hệ thống.',
        ];

        return [
            'title' => fake()->randomElement($titles),
            'description' => fake()->randomElement($descriptions),
            'status' => ProjectStatus::OPEN,
            'deadline' => fake()->dateTimeThisMonth(),
            'client_id' => Client::inRandomOrder()->value('id'),
            'user_id' => User::inRandomOrder()->value('id')
        ];
    }
}
