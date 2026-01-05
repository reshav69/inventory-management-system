<?php

namespace App\Http\Controllers;

use App\Services\ReportService;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(){
        return view('reports.report-table');

    } 
    public function generate(Request $request, ReportService $reportService)
    {
        $validated= $request->validate([
            'report_type' => 'required|in:sales,inventory',
            'period' => 'in:today,week,month,year,all',
        ]);
        // dd($validated);
        $data = match ($validated['report_type']) {
            'sales' => $reportService->revenue($validated['period']),
        };

        dd($data);
        return view("reports.{$request->type}", compact('data'));
    }
}
