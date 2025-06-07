<!DOCTYPE html> 
<html lang="es"> 
<head> <meta charset="UTF-8"> 
<title>{{ $title ?? 'Encuestas' }}</title> 
@vite(['resources/css/app.css', 'resources/js/app.js']) 
@livewireStyles 
</head> 
<body class="bg-gray-100 text-gray-800"> 
<div class="min-h-screen"> 
{{ $slot }} 
</div>
@livewireScripts 
</body> 
</html>