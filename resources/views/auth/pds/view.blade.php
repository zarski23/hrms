<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-10 bg-gray-100">
    <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold mb-4">Submitted Data {{ $todayDate }}</h2>

        <ul class="list-disc pl-5">
            @foreach ($pds as $key => $value)
    <li>
        <strong>{{ ucfirst($key) }}:</strong> 
        {{ is_array($value) ? json_encode($value) : $value }}
    </li>
@endforeach

        </ul>


        <a href="{{ route('pds-register') }}" class="text-blue-500 mt-4 inline-block">Go Back</a>
    </div>

</body>
</html>

