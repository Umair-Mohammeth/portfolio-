@echo off
echo Checking dependencies...

WHERE node >nul 2>nul
IF %ERRORLEVEL% NEQ 0 (
    echo Error: Node.js is not installed or not in PATH. Please install Node.js from https://nodejs.org/
    pause
    exit /b 1
)

WHERE npm >nul 2>nul
IF %ERRORLEVEL% NEQ 0 (
    echo Error: npm is not installed or not in PATH. Please install npm.
    pause
    exit /b 1
)

echo Dependencies found! Starting local WordPress Playground...
echo When ready, it will open at http://localhost:9400
echo You can log in using Username: admin and Password: password
echo.

call npx -y @wp-playground/cli@latest server --blueprint=blueprint.json
pause
