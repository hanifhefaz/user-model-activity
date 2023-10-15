<?php

namespace Hanifhefaz\UserModelActivity;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserModelActivityController extends Controller
{

public function index()
{
    $logFiles = $this->getLogFiles();

    return view('UserModelActivity::user-activity.index', compact('logFiles'));
}

private function getLogFiles()
{
    $logDirectory = storage_path('logs');
    $files = [];

    if (is_dir($logDirectory)) {
        $logFiles = scandir($logDirectory);
        foreach ($logFiles as $file) {
            if ($file !== '.' && $file !== '..') {
                $files[] = $file;
            }
        }
    }

    return $files;
}

public function fetchLogContent(Request $request)
{
    $logFile = $request->input('logFile');
    $logPath = storage_path('logs/' . $logFile);

    if (file_exists($logPath)) {
        $logContent = file_get_contents($logPath);
        $perPage = 10; // Number of log entries per page
        $logEntries = explode("\n", $logContent);
        $currentPage = $request->input('page', 1);

        $pagination = new \Illuminate\Pagination\LengthAwarePaginator(
            array_slice($logEntries, ($currentPage - 1) * $perPage, $perPage),
            count($logEntries),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('UserModelActivity::user-activity.logcontent', compact('pagination'));
    } else {
        return 'Log file not found.';
    }
}


private function parseLogForActivities($logPath)
{
    $logContents = file_get_contents($logPath);
    $logLines = explode("\n", $logContents);

    $activities = [];
    foreach ($logLines as $logLine) {
        if (!empty($logLine)) {
            $activity = ['log' => $logLine];
            $activities[] = $activity;
        }
    }

    return $activities;
}

}
