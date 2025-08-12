<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // ① 表示対象の年月を取得（クエリ or 現在）
        $current = $request->input('month')
            ? Carbon::createFromFormat('Y-m', $request->input('month'))
            : Carbon::now();

        $currentYear = $current->year;
        $currentMonth = $current->month;

        // ② 前月・翌月（ナビゲーション用）
        $prevMonth = $current->copy()->subMonth()->format('Y-m');
        $nextMonth = $current->copy()->addMonth()->format('Y-m');

        // ③ カテゴリー絞り込み
        $category = $request->input('category');

        $schedulesQuery = Schedule::whereYear('date', $currentYear)
            ->whereMonth('date', $currentMonth);

    if ($category) {
            $schedulesQuery->where('category', $category);
        }

        $schedules = $schedulesQuery->get();

        // ④ カレンダーデータ生成（週ごとに分ける）
        $firstDay = Carbon::create($currentYear, $currentMonth, 1)->startOfWeek(Carbon::MONDAY);
        $lastDay = Carbon::create($currentYear, $currentMonth, 1)->endOfMonth()->endOfWeek(Carbon::SUNDAY);

        $calendar = [];
        $week = [];

        for ($date = $firstDay->copy(); $date->lte($lastDay); $date->addDay()) {
            $daySchedules = $schedules->filter(fn($s) => $s->date->isSameDay($date));

            $week[] = [
                'date' => $date->copy(),
                'schedules' => $daySchedules,
            ];

            if ($date->dayOfWeek === Carbon::SUNDAY) {
                $calendar[] = $week;
                $week = [];
            }
        }

        // ⑤ カテゴリー一覧（固定）
        $categories = ['live', 'radio', 'tv', 'magazine', 'release', 'other'];

        return view('schedules.index', compact(
            'calendar', 'currentYear', 'currentMonth',
            'prevMonth', 'nextMonth', 'categories', 'category'
        ));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $defaultDate = $request->input('date'); // Y-m-d形式
        return view('schedules.create', ['defaultDate' => $defaultDate]);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // ✅ バリデーション
        $validated = $request->validate([
            'date' => ['required', 'date'],
            'category' => ['required', 'in:live,radio,tv,magazine,release,other'],
            'title' => ['required', 'string', 'max:255'],
            'detail' => ['required', 'string'],
        ]);

        // ✅ 保存
        Schedule::create($validated);

        // ✅ 投稿後に一覧ページ or カレンダーにリダイレクト
        return redirect()->route('schedules.index')->with('success', 'スケジュールを追加しました！');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $scheduleItem = Schedule::findOrFail($id);
            return view('schedules.show', compact('scheduleItem'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $scheduleItem = Schedule::findOrFail($id);

        Schedule::where('id', $id)->update([
            'date' => $request->schedule_date,
            'category' => $request->schedule_category,
            'title' => $request->schedule_title,
            'detail' => $request->schedule_detail,
        ]);

        return redirect()->route('schedules.show', ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Schedule::where('id', $id)->delete();
        return redirect()->route('schedules.index');
    }
}
