<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Artisan;

class AdminBackupController extends Controller
{
    public function backup()
    {
        $dbHost = config('database.connections.mysql.host');
        $dbPort = config('database.connections.mysql.port');
        $dbName = config('database.connections.mysql.database');
        $dbUser = config('database.connections.mysql.username');
        $dbPass = config('database.connections.mysql.password');

        $backupPath = 'D:\Anafoodbackup\database_backup'; // مسیر دلخواه
        $fileName = $dbName . '_' . date('Y-m-d_H-i-s') . '.sql';
        $fullPath = $backupPath . DIRECTORY_SEPARATOR . $fileName;

        // مطمئن شو مسیر وجود داره
        if (!file_exists($backupPath)) {
            mkdir($backupPath, 0777, true);
        }

        $mysqldump = 'mysqldump'; // یا مسیر کامل: 'C:\xampp\mysql\bin\mysqldump.exe'

        // دستور گرفتن بک‌آپ با کدگذاری utf8mb4
        $command = "\"{$mysqldump}\" --user={$dbUser} --password=\"{$dbPass}\" --host={$dbHost} --port={$dbPort} --default-character-set=utf8mb4 {$dbName} > \"{$fullPath}\"";

        $result = null;
        $output = null;
        exec($command, $output, $result);

        if ($result === 0) {
            return back()->with('success', '✅ بک‌آپ با موفقیت گرفته شد و در مسیر مورد نظر ذخیره شد.');
        } else {
            return back()->with('error', '❌ عملیات بک‌آپ با خطا مواجه شد.');
        }
    }
}
