<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class CsvUploadController extends Controller {
    public function upload(Request $request) {
        // ファイルが送信されていない場合のエラーチェック
        Log::info('uploadCsvが呼ばれました');
        Log::info($request->all());

        if (!$request->hasFile('file')) {
            return response()->json(['error' => 'No file uploaded'], 400);
        }

        // ファイルのバリデーション
        $request->validate([
            'file' => 'required|mimes:csv,txt',
        ]);

        $file = $request->file('file');
        $path = $file->getRealPath();
        $data = array_map('str_getcsv', file($path));
    
        // ヘッダーとデータを分離
        $headers = array_map('trim', $data[0]);
        $rows = array_slice($data, 1);

        // CSVの各行を取得してデータベースに保存
        $employees = [];
        foreach ($rows as $row) {
            $row = array_map('trim', $row); // 空白除去
            $employees[] = array_combine($headers, $row); // headersからキーを取得して結合
        }

        // バルクインサートを実行
        DB::table('employees')->insert($employees);

        return response()->json(['message' => 'CSV uploaded and data saved']);
    }
}
