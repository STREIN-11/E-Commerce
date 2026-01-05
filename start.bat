@echo off
echo Laravel Assessment - Starting Services
echo =======================================

echo Starting Laravel development server...
start "Laravel Server" cmd /k "php artisan serve"

timeout /t 2 /nobreak >nul

echo Starting Queue Worker...
start "Queue Worker" cmd /k "php artisan queue:work"

timeout /t 2 /nobreak >nul

echo Starting WebSocket Server...
start "WebSocket Server" cmd /k "php artisan reverb:start"

echo.
echo All services started!
echo =====================
echo - Laravel Server: http://localhost:8000
echo - Queue Worker: Processing background jobs
echo - WebSocket Server: Real-time features on port 8080
echo.
echo Press any key to exit...
pause >nul