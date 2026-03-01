<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - NEXA TAX Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <script>tailwind.config = { theme: { extend: { fontFamily: { sans: ['"Plus Jakarta Sans"', 'sans-serif'] }, colors: { primary: { brand: '#007AFF' } } } } }</script>
</head>
<body class="bg-slate-950 font-sans min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md px-6">
        <div class="text-center mb-10">
            <div class="flex items-center justify-center gap-2 mb-4">
                <div class="w-12 h-12 bg-primary-brand flex items-center justify-center rounded-sm rotate-45">
                    <div class="w-6 h-6 border-2 border-white -rotate-45"></div>
                </div>
            </div>
            <h1 class="text-3xl font-black tracking-tighter text-white">NEXA <span class="text-primary-brand">TAX</span></h1>
            <p class="text-slate-500 text-xs tracking-widest mt-1 uppercase">Admin Panel</p>
        </div>

        <div class="bg-white rounded-lg shadow-2xl p-8">
            <h2 class="text-xl font-bold text-slate-900 mb-6">Sign In</h2>

            @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded mb-4 text-sm">
                {{ $errors->first() }}
            </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-4 py-3 border border-slate-200 rounded text-sm focus:outline-none focus:border-primary-brand focus:ring-1 focus:ring-primary-brand">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Password</label>
                    <input type="password" name="password" required
                        class="w-full px-4 py-3 border border-slate-200 rounded text-sm focus:outline-none focus:border-primary-brand focus:ring-1 focus:ring-primary-brand">
                </div>
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="mr-2">
                    <label for="remember" class="text-sm text-slate-600">Remember me</label>
                </div>
                <button type="submit" class="w-full bg-primary-brand text-white font-bold py-3 rounded text-sm hover:bg-blue-700 transition">
                    Sign In
                </button>
            </form>
        </div>
    </div>
</body>
</html>
