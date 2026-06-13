<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>كوبونات {{ $store->name }} | كوبوناتي</title>
    
    <!-- Google Fonts: Tajawal & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Tajawal:wght@400;500;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Load Tailwind CSS & JS via Laravel Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Tajawal', 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen relative overflow-x-hidden selection:bg-indigo-500 selection:text-white">

    <!-- Decorative background glows -->
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-indigo-500/10 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute top-1/4 right-10 w-96 h-96 bg-purple-500/5 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="max-w-4xl mx-auto px-4 py-8 sm:px-6 lg:px-8 relative z-10">
        
        <!-- Breadcrumb / Back Navigation -->
        <div class="mb-8">
            <a href="/stores" class="inline-flex items-center gap-2 text-slate-400 hover:text-white text-sm font-medium transition-colors group">
                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                العودة إلى جميع المتاجر
            </a>
        </div>

        <!-- Store Hero Header -->
        @php
            $colors = [
                'from-pink-500 to-rose-500',
                'from-purple-500 to-indigo-500',
                'from-blue-500 to-cyan-500',
                'from-emerald-500 to-teal-500',
                'from-amber-500 to-orange-500'
            ];
            $gradient = $colors[$store->id % count($colors)];
            $initials = mb_substr($store->name, 0, 2);
        @endphp

        <div class="bg-slate-900/50 backdrop-blur-md border border-slate-800/80 rounded-2xl p-6 sm:p-8 mb-10 flex flex-col sm:flex-row items-center justify-between gap-6">
            <div class="flex flex-col sm:flex-row items-center gap-5 text-center sm:text-right">
                @if($store->logo_url && filter_var($store->logo_url, FILTER_VALIDATE_URL))
                    <div class="h-20 w-20 rounded-2xl bg-slate-800 border border-slate-700/50 flex items-center justify-center p-3 overflow-hidden shadow-lg">
                        <img src="{{ $store->logo_url }}" alt="{{ $store->name }} Logo" class="max-h-full max-w-full object-contain">
                    </div>
                @else
                    <div class="h-20 w-20 rounded-2xl bg-gradient-to-br {{ $gradient }} flex items-center justify-center shadow-lg">
                        <span class="text-white text-2xl font-bold tracking-wider">{{ $initials }}</span>
                    </div>
                @endif
                <div>
                    <h1 class="text-3xl font-extrabold text-white mb-2">{{ $store->name }}</h1>
                    <div class="flex flex-wrap justify-center sm:justify-start items-center gap-3">
                        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-xs font-medium bg-indigo-500/10 text-indigo-400 border border-indigo-500/20">
                            {{ $store->coupons->count() }} كوبونات متاحة
                        </span>
                        <span class="w-1.5 h-1.5 rounded-full bg-slate-700"></span>
                        <span class="text-xs text-slate-400">تحديث فوري</span>
                    </div>
                </div>
            </div>

            @if($store->url)
                <a href="{{ $store->url }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 text-sm font-semibold text-white bg-slate-800 hover:bg-slate-700 border border-slate-700/60 py-2.5 px-5 rounded-xl transition-all shadow-md">
                    زيارة الموقع الرسمي
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                </a>
            @endif
        </div>

        <!-- Section Title -->
        <h2 class="text-xl font-bold text-slate-200 mb-6 flex items-center gap-2">
            <span class="w-2.5 h-2.5 rounded bg-indigo-500"></span>
            الكوبونات النشطة لخصم إضافي
        </h2>

        <!-- Coupons List -->
        <div class="space-y-6">
            @forelse($store->coupons as $coupon)
                @php
                    $isExpiredSoon = false;
                    if($coupon->expires_at) {
                        $expiry = \Carbon\Carbon::parse($coupon->expires_at);
                        $isExpiredSoon = $expiry->isFuture() && $expiry->diffInDays() <= 5;
                    }
                @endphp
                <div class="relative bg-slate-900/40 border border-slate-800 rounded-2xl overflow-hidden flex flex-col md:flex-row md:items-center justify-between gap-6 p-6 hover:border-indigo-500/30 hover:bg-slate-900/60 transition-all duration-300">
                    
                    <!-- Coupon Details Info -->
                    <div class="flex-1">
                        <div class="flex items-center gap-2.5 mb-3 flex-wrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-bold bg-emerald-500/10 text-emerald-400 border border-emerald-500/10">
                                خصم {{ $coupon->discount_value }}
                            </span>
                            @if($coupon->expires_at)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium {{ $isExpiredSoon ? 'bg-amber-500/10 text-amber-400 border border-amber-500/10' : 'bg-slate-800 text-slate-400' }}">
                                    تنتهي: {{ \Carbon\Carbon::parse($coupon->expires_at)->format('Y/m/d') }}
                                    @if($isExpiredSoon)
                                        (ينتهي قريباً)
                                    @endif
                                </span>
                            @endif
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2 leading-snug">{{ $coupon->title }}</h3>
                        <p class="text-xs text-slate-500 font-light">استخدم الكود عند الدفع لتطبيق الخصم مباشرة.</p>
                    </div>

                    <!-- Coupon Code Area (Styled like a modern ticket / badge) -->
                    <div class="flex items-center gap-3 bg-slate-950/60 p-3.5 rounded-xl border border-slate-800/80 md:w-80 justify-between self-stretch md:self-center">
                        <div class="flex flex-col ml-4">
                            <span class="text-[10px] text-slate-500 font-bold uppercase tracking-wider">كود الخصم</span>
                            <span class="text-lg font-mono font-bold text-white tracking-widest">{{ $coupon->code }}</span>
                        </div>
                        
                        <button onclick="copyCouponCode(this, '{{ $coupon->code }}')" class="inline-flex items-center justify-center gap-1.5 px-4 py-2 rounded-lg text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-500 transition-all shadow-md shadow-indigo-500/10 cursor-pointer min-w-[100px]">
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path>
                            </svg>
                            نسخ الكود
                        </button>
                    </div>
                </div>
            @empty
                <div class="py-16 text-center bg-slate-900/20 border border-slate-800/50 rounded-2xl">
                    <div class="w-16 h-16 bg-slate-900 border border-slate-800 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <p class="text-slate-400 text-lg">لا توجد كوبونات متاحة لهذا المتجر حالياً.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- JavaScript for Clipboard functionality -->
    <script>
        function copyCouponCode(button, code) {
            navigator.clipboard.writeText(code).then(() => {
                const originalContent = button.innerHTML;
                
                button.innerHTML = `
                    <svg class="w-4 h-4 ml-1.5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                    </svg>
                    تم النسخ!
                `;
                button.classList.remove('bg-indigo-600', 'hover:bg-indigo-500');
                button.classList.add('bg-emerald-500/10', 'text-emerald-400', 'border', 'border-emerald-500/20');
                
                setTimeout(() => {
                    button.innerHTML = originalContent;
                    button.classList.add('bg-indigo-600', 'hover:bg-indigo-500');
                    button.classList.remove('bg-emerald-500/10', 'text-emerald-400', 'border', 'border-emerald-500/20');
                }, 2000);
            }).catch(err => {
                console.error('Failed to copy text: ', err);
            });
        }
    </script>
</body>
</html>