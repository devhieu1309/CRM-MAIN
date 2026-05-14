<?php

namespace App\Http\Controllers;

use App\Enums\TaskStatus;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $authUser = auth()->user();
        $isAdmin = $authUser->hasRole('admin');

        $tasks = $this->scopedTasksQuery($authUser->id, $isAdmin);

        $counts = [
            'total' => (clone $tasks)->count(),
            'open' => (clone $tasks)->where('status', TaskStatus::OPEN)->count(),
            'in_progress' => (clone $tasks)->where('status', TaskStatus::IN_PROGRESS)->count(),
            'completed' => (clone $tasks)->where('status', TaskStatus::COMPLETED)->count(),
            'blocked' => (clone $tasks)->where('status', TaskStatus::BLOCKED)->count(),
            'closed_or_cancelled' => (clone $tasks)->whereIn('status', [
                TaskStatus::CLOSED,
                TaskStatus::CANCELLED,
            ])->count(),
        ];

        $recentTasks = (clone $tasks)
            ->with(['project', 'client', 'user'])
            ->latest('updated_at')
            ->limit(10)
            ->get();

        $totalUsers = $isAdmin ? User::query()->count() : null;

        return view('dashboard.index', [
            'isAdmin' => $isAdmin,
            'counts' => $counts,
            'recentTasks' => $recentTasks,
            'totalUsers' => $totalUsers,
        ]);
    }

    /**
     * Admin: toàn bộ task. User: task được gán (user_id) hoặc thuộc dự án do user là chủ sở hữu.
     */
    private function scopedTasksQuery(int $userId, bool $isAdmin): Builder
    {
        $query = Task::query();

        if (! $isAdmin) {
            $query->where(function (Builder $inner) use ($userId) {
                $inner->where('user_id', $userId)
                    ->orWhereHas('project', function (Builder $projectQuery) use ($userId) {
                        $projectQuery->where('user_id', $userId);
                    });
            });
        }

        return $query;
    }
}
