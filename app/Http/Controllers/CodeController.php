<?php

namespace App\Http\Controllers;

use App\Models\Code;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CodeController extends Controller
{
    private const BATCH_COUNT = 10000;

    /**
     * Generate and save provided number of unique codes.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $inputCount
     * @return \Illuminate\Http\Response
     */
    public function generate(int $inputCount)
    {
        $processedCount = 0;
        $remainderCount = $inputCount;
        $latestCount = 0;

        while ($processedCount < $inputCount) {
            $latestCount = self::BATCH_COUNT < $remainderCount ?
                self::BATCH_COUNT :
                $remainderCount;

            $transactionSuccess = self::performTransaction($latestCount);

            if ($transactionSuccess) {
                $processedCount += $latestCount;
                $remainderCount -= $latestCount;
            }
        }

        return response()->json([
            'status' => 'OK',
            'message' => "Saved $processedCount unique codes successfully"
        ], 200);
    }

    /**
     * Perform database transaction for provided records count.
     *
     * @param  int $count
     * @return bool
     */
    private function performTransaction(int $count): bool
    {
        DB::beginTransaction();

        try {
            $codes = Code::factory()
                ->count($count)
                ->make();

            $mapped = $codes->map->only('unique_code')->toArray();

            DB::table(Code::TABLE_NAME)->insert($mapped);
            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollback();

            return false;
        }
    }
}
