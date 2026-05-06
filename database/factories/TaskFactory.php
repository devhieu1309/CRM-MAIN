<?php

namespace Database\Factories;

use App\Enums\TaskStatus;
use App\Models\Client;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $titles = [
            'Liên hệ khách hàng để xác nhận yêu cầu',
            'Cập nhật thông tin hợp đồng vào hệ thống',
            'Kiểm tra tiến độ triển khai dự án',
            'Chuẩn bị tài liệu hướng dẫn sử dụng',
            'Theo dõi trạng thái thanh toán của khách hàng',
            'Tổng hợp báo cáo công việc tuần',
            'Rà soát dữ liệu trước khi bàn giao',
            'Lên lịch họp với đội triển khai',
            'Phân loại danh sách khách hàng tiềm năng',
            'Gửi email nhắc việc theo lịch',
            'Kiểm thử chức năng mới trên môi trường staging',
            'Xác nhận phản hồi của khách hàng sau demo',
            'Cập nhật kế hoạch công việc theo ưu tiên',
            'Đồng bộ dữ liệu giữa các module',
            'Theo dõi và xử lý lỗi phát sinh',
        ];

        $descriptions = [
            'Thực hiện đầy đủ các bước theo quy trình, cập nhật kết quả và ghi nhận trạng thái xử lý để tiện theo dõi.',
            'Kiểm tra thông tin đầu vào, đảm bảo dữ liệu chính xác trước khi chuyển sang bước xử lý tiếp theo.',
            'Phối hợp với các bên liên quan để thống nhất yêu cầu, thời hạn và phương án triển khai.',
            'Ưu tiên các đầu việc quan trọng, bám sát tiến độ và báo cáo ngay khi có vướng mắc phát sinh.',
            'Hoàn thiện tài liệu liên quan, đảm bảo nội dung rõ ràng để phục vụ kiểm tra và bàn giao.',
            'Theo dõi kết quả thực hiện theo từng mốc thời gian, cập nhật hệ thống để đảm bảo thông tin luôn mới.',
            'Đánh giá mức độ hoàn thành công việc, đề xuất hướng xử lý và điều chỉnh kế hoạch khi cần.',
            'Rà soát các hạng mục liên quan, giảm sai sót và đảm bảo chất lượng đầu ra theo tiêu chuẩn dự án.',
            'Tăng cường trao đổi với khách hàng để làm rõ nhu cầu và nâng cao hiệu quả phối hợp thực hiện.',
            'Tập trung xử lý các nội dung tồn đọng, đảm bảo không ảnh hưởng đến tiến độ tổng thể của dự án.',
        ];

        return [
            'title' => fake()->randomElement($titles),
            'description' => fake()->randomElement($descriptions),
            'project_id' => Project::inRandomOrder()->value('id'),
            'user_id' => User::inRandomOrder()->value('id'),
            'client_id' => Client::inRandomOrder()->value('id'),
            'deadline' => fake()->dateTimeThisMonth(),
            'status' => TaskStatus::OPEN,
        ];
    }
}
