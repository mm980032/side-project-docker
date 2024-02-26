<?php

namespace App\Exceptions;

use App\Repositories\SystemErrorLogRepository;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function report(Throwable $e)
    {
        $e = $this->mapException($e);
        // 將錯誤訊息寫入資料庫
        $this->errorLog($e, request());
        parent::report($e);
    }

    private function errorLog(Throwable $e, $request): void
    {
        $errorMessage = substr($e->getMessage(), 0, 255); // 截取异常消息的前255个字符
        $payload = [
            'method'        => $request->method(),
            'ip'            => $request->ip(),
            'api'           => $request->path(),
            'request'       => $request->getContent(),
            'errorMessage'  => $errorMessage,
            'errorLine'     => $e->getLine()
        ];
        app(SystemErrorLogRepository::class)->errorLogRecoed($payload);
    }
}
