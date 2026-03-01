<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Website Tidak Dapat Diakses' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <script>tailwind.config = { theme: { extend: { fontFamily: { sans: ['"Plus Jakarta Sans"', 'sans-serif'] }, colors: { primary: { brand: '#007AFF' } } } } }</script>
</head>
<body class="bg-slate-950 font-sans min-h-screen flex items-center justify-center text-white">
    <div class="text-center px-6 max-w-lg">
        <div class="w-20 h-20 bg-slate-800 rounded-full flex items-center justify-center mx-auto mb-8">
            <svg class="w-10 h-10 text-primary-brand" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
        </div>
        <h1 class="text-2xl font-black mb-4">{{ $title ?? 'Website Tidak Dapat Diakses' }}</h1>
        <p class="text-slate-400 mb-10">{{ $message ?? '' }}</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            @if(!empty($whatsapp))
            <a href="https://wa.me/{{ $whatsapp }}" class="bg-[#25D366] text-white font-bold px-6 py-3 rounded text-sm hover:opacity-90 transition">WhatsApp</a>
            @endif
            @if(!empty($email))
            <a href="mailto:{{ $email }}" class="bg-primary-brand text-white font-bold px-6 py-3 rounded text-sm hover:opacity-90 transition">Email</a>
            @endif
            @if(!empty($phone))
            <a href="tel:{{ $phone }}" class="bg-slate-700 text-white font-bold px-6 py-3 rounded text-sm hover:opacity-90 transition">Telepon</a>
            @endif
        </div>
    </div>
</body>
</html>
