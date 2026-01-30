<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __("home.title") }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: #0d0d1a; /* Darker background */
            color: #ffffff;
            overflow-x: hidden;
        }

        /* Gradient Text */
        .text-gradient-primary {
            background: linear-gradient(to right, #a855f7, #ec4899);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* SVG Lines Background */
        .lines-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            pointer-events: none;
            overflow: hidden; /* Ensure lines don't bleed out */
        }

        .path-flow {
            stroke-dasharray: 2500;
            stroke-dashoffset: 2500;
            animation: draw 3.5s ease-out forwards;
        }

        @keyframes draw { to { stroke-dashoffset: 0; } }

        /* Floating Animation for Phone */
        .float-animation {
            animation: floating 6s ease-in-out infinite;
        }

        @keyframes floating {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }

        /* Parallax & Smooth Animation for Laptop in Hero */
        .hero-laptop {
            transition: transform 0.7s cubic-bezier(.4,0,.2,1);
        }
        @keyframes smooth-parallax {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-18px) scale(1.04); }
        }
        .animate-smooth-parallax {
            animation: smooth-parallax 7s ease-in-out infinite;
        }

        /* Card Hover Effect */
        .feature-card {
            transition: all 0.3s ease-in-out;
            transform: translateY(0);
        }
        .feature-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            background-color: #1a1a2e;
        }
    </style>
</head>
<body class="relative">

    <div class="lines-background">
        <svg width="1440" height="3200" viewBox="0 0 1440 3200" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
            <path class="path-flow" d="M1100 0V350C1100 500 1000 550 500 550C50 550 0 600 0 750V1800C0 2000 100 2100 500 2100H1440" stroke="#7E22CE" stroke-width="20" />
            <path class="path-flow" style="animation-delay: 0.2s" d="M1135 0V350C1135 520 1035 580 535 580C85 580 35 630 35 780V1830C35 2030 135 2130 535 2130H1440" stroke="#D97706" stroke-width="20" />
            <path class="path-flow" style="animation-delay: 0.4s" d="M1170 0V350C1170 540 1070 610 570 610C120 610 70 660 70 810V1860C70 2060 170 2160 570 2160H1440" stroke="#A855F7" stroke-width="20" />
        </svg>
    </div>

    <div class="relative z-10">

        <nav class="fixed top-0 left-0 w-full z-50 bg-[#0d0d1a]/80 backdrop-blur-md">
            <div class="container mx-auto px-8 py-5 flex justify-between items-center">
                <div class="text-2xl font-bold tracking-tighter flex items-center gap-2">
                    <img src="{{ asset('img/illustrations/logosimpandata.png') }}" alt="Logo Simpan Data" class="h-8 w-8"> Simpan Data
                </div>
                <div class="hidden md:flex gap-10 text-base font-medium text-gray-400">
                    <a href="#" class="hover:text-white transition">{{ __("home.navbar_product") }}</a>
                    <a href="#" class="hover:text-white transition">{{ __("home.navbar_features") }}</a>
                    <a href="#" class="hover:text-white transition">{{ __("home.navbar_pricing") }}</a>
                    <a href="#" class="hover:text-white transition">{{ __("home.navbar_contact") }}</a>
                </div>
                <div class="flex items-center gap-4">
                    <a href="/login" class="text-base font-bold px-5 py-2 hover:text-gray-300 transition">{{ __("home.login") }}</a>
                    <a href="/register" class="bg-white text-black text-base font-bold px-6 py-2 rounded-full hover:bg-gray-200 transition">{{ __("home.register") }}</a>
                    <form method="GET" action="/set-locale" class="inline">
                        <div class="relative inline-block text-left" id="langDropdown">
                            <button type="button" aria-haspopup="listbox" aria-expanded="false" aria-label="Select language" class="bg-[#1a1a2e] text-white px-3 py-2 rounded-full font-bold border-2 border-purple-600 focus:outline-none flex items-center gap-2" id="langDropdownBtn">
                                <img src="{{ asset('img/flags/' . (app()->getLocale() == 'id' ? 'id' : 'gb') . '.svg') }}" alt="{{ app()->getLocale() == 'id' ? 'Indonesian flag' : 'UK flag' }}" class="h-4 w-4 inline-block align-middle">
                                <span>{{ app()->getLocale() == 'id' ? 'ID' : 'EN' }}</span>
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            <div id="langDropdownMenu" class="hidden absolute right-0 mt-2 w-28 rounded-md shadow-lg bg-[#1a1a2e] ring-1 ring-black ring-opacity-5 z-50">
                                <button type="submit" name="lang" value="id" class="w-full flex items-center gap-2 px-4 py-2 text-sm text-white hover:bg-purple-600 rounded-t-md focus:outline-none" aria-label="Bahasa Indonesia">
                                    <img src="{{ asset('img/flags/id.svg') }}" alt="Indonesian flag" class="h-4 w-4 inline-block align-middle">
                                    <span>ID</span>
                                </button>
                                <button type="submit" name="lang" value="en" class="w-full flex items-center gap-2 px-4 py-2 text-sm text-white hover:bg-purple-600 rounded-b-md focus:outline-none" aria-label="English">
                                    <img src="{{ asset('img/flags/gb.svg') }}" alt="UK flag" class="h-4 w-4 inline-block align-middle">
                                    <span>EN</span>
                                </button>
                            </div>
                        </div>
                    </form>
                    <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const btn = document.getElementById('langDropdownBtn');
                        const menu = document.getElementById('langDropdownMenu');
                        const dropdown = document.getElementById('langDropdown');
                        btn.addEventListener('click', function(e) {
                            e.preventDefault();
                            const expanded = btn.getAttribute('aria-expanded') === 'true';
                            btn.setAttribute('aria-expanded', !expanded);
                            menu.classList.toggle('hidden');
                        });
                        document.addEventListener('click', function(e) {
                            if (!dropdown.contains(e.target)) {
                                menu.classList.add('hidden');
                                btn.setAttribute('aria-expanded', false);
                            }
                        });
                    });
                    </script>
                </div>
            </div>
        </nav>

        <header class="container mx-auto px-8 pt-40 pb-20 md:pb-32 flex flex-col lg:flex-row items-center justify-between min-h-screen">
            <div class="lg:w-1/2 text-center lg:text-left mb-16 lg:mb-0">
                <h1 class="text-5xl md:text-6xl font-extrabold leading-tight mb-4">
                    @php
                        $hero = __("home.hero_title");
                        $pattern = '/(Secure Data & Billing Management|Data & Billing Management|Data & Manajemen Tagihan)/i';
                        $hero = preg_replace($pattern, '<span class="text-gradient-primary">$1</span>', $hero);
                    @endphp
                    {!! $hero !!}
                </h1>
                <p class="text-gray-300 text-lg md:text-xl mb-10 max-w-xl mx-auto lg:mx-0">
                    {{ __("home.hero_desc") }}
                </p>
                <div class="flex justify-center lg:justify-start gap-5">
                    <button class="bg-gradient-to-r from-purple-600 to-pink-500 text-white px-10 py-4 rounded-full font-bold text-lg shadow-lg hover:shadow-xl hover:scale-105 transition duration-300">
                        {{ __("home.explore_demo") }}
                    </button>
                    <button class="flex items-center gap-3 text-white font-bold text-lg opacity-80 hover:opacity-100 transition duration-300">
                        <i class="fas fa-play-circle text-2xl"></i> {{ __("home.watch_video") }}
                    </button>
                </div>
            </div>
            
            <div class="lg:w-1/2 relative flex justify-center items-center">
                <div class="relative w-full max-w-2xl px-4 hero-laptop flex justify-center animate-smooth-parallax">
                    <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-[110%] h-[110%] bg-gradient-to-r from-purple-500 to-orange-400 rounded-2xl blur-2xl opacity-30"></div>
                    <img src="{{ asset('img/illustrations/header1.jpg') }}" alt="Dashboard" class="relative rounded-xl border-[6px] border-[#1a1a2e] shadow-2xl w-[420px] h-[420px] object-cover mx-auto z-10 transition-transform duration-700 ease-[cubic-bezier(.4,0,.2,1)]" style="box-shadow:0 0 0 8px rgba(168,85,247,0.15);">
                </div>
            </div>
        </header>

        <section class="bg-[#1a1a2e] py-24">
            <div class="container mx-auto px-8 text-center">
                <h2 class="text-4xl md:text-5xl font-extrabold mb-16">{{ __("home.features_title") }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    <div class="feature-card bg-[#2a2a40] p-8 rounded-2xl flex flex-col items-center text-center">
                        <div class="w-20 h-20 bg-purple-600/20 text-purple-400 rounded-full flex items-center justify-center mb-6 text-3xl">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3 class="font-bold text-2xl mb-4">{{ __("home.feature_security") }}</h3>
                        <p class="text-gray-400">{{ __("home.feature_security_desc") }}</p>
                    </div>
                    <div class="feature-card bg-[#2a2a40] p-8 rounded-2xl flex flex-col items-center text-center">
                        <div class="w-20 h-20 bg-yellow-600/20 text-yellow-400 rounded-full flex items-center justify-center mb-6 text-3xl">
                            <i class="fas fa-lock"></i>
                        </div>
                        <h3 class="font-bold text-2xl mb-4">{{ __("home.feature_encryption") }}</h3>
                        <p class="text-gray-400">{{ __("home.feature_encryption_desc") }}</p>
                    </div>
                    <div class="feature-card bg-[#2a2a40] p-8 rounded-2xl flex flex-col items-center text-center">
                        <div class="w-20 h-20 bg-blue-600/20 text-blue-400 rounded-full flex items-center justify-center mb-6 text-3xl">
                            <i class="fas fa-cloud-upload-alt"></i>
                        </div>
                        <h3 class="font-bold text-2xl mb-4">{{ __("home.feature_cloud") }}</h3>
                        <p class="text-gray-400">{{ __("home.feature_cloud_desc") }}</p>
                    </div>
                    <div class="feature-card bg-[#2a2a40] p-8 rounded-2xl flex flex-col items-center text-center">
                        <div class="w-20 h-20 bg-green-600/20 text-green-400 rounded-full flex items-center justify-center mb-6 text-3xl">
                            <i class="fas fa-fingerprint"></i>
                        </div>
                        <h3 class="font-bold text-2xl mb-4">{{ __("home.feature_biometric") }}</h3>
                        <p class="text-gray-400">{{ __("home.feature_biometric_desc") }}</p>
                    </div>
                    <div class="feature-card bg-[#2a2a40] p-8 rounded-2xl flex flex-col items-center text-center">
                        <div class="w-20 h-20 bg-red-600/20 text-red-400 rounded-full flex items-center justify-center mb-6 text-3xl">
                            <i class="fas fa-history"></i>
                        </div>
                        <h3 class="font-bold text-2xl mb-4">{{ __("home.feature_version") }}</h3>
                        <p class="text-gray-400">{{ __("home.feature_version_desc") }}</p>
                    </div>
                    <div class="feature-card bg-[#2a2a40] p-8 rounded-2xl flex flex-col items-center text-center">
                        <div class="w-20 h-20 bg-indigo-600/20 text-indigo-400 rounded-full flex items-center justify-center mb-6 text-3xl">
                            <i class="fas fa-server"></i>
                        </div>
                        <h3 class="font-bold text-2xl mb-4">{{ __("home.feature_server") }}</h3>
                        <p class="text-gray-400">{{ __("home.feature_server_desc") }}</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-24 bg-[#0d0d1a]">
            <div class="container mx-auto px-8 text-center">
                <h2 class="text-4xl md:text-5xl font-extrabold mb-6">{{ __("home.sync_package_title") }}</h2>
                <p class="text-gray-400 text-xl mb-16 max-w-2xl mx-auto">
                    {{ __("home.sync_package_desc") }}
                </p>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 items-stretch">
                    <div class="bg-[#1a1a2e] p-8 md:p-10 rounded-3xl shadow-xl border border-gray-700 flex flex-col justify-between feature-card max-w-md mx-auto h-full min-h-[520px]">
                        <div class="flex flex-col h-full">
                            <h3 class="text-3xl font-bold mb-4">{{ __("home.basic") }}</h3>
                            <p class="text-gray-400 text-lg mb-6">{{ __("home.basic_desc") }}</p>
                            <div class="text-5xl font-extrabold mb-8 break-words">
                                {{ __("home.basic_price") }}
                            </div>
                            <ul class="text-left text-gray-300 space-y-4 mb-10">
                                <li class="flex items-center gap-3"><i class="fas fa-check-circle text-green-500"></i> {{ __("home.basic_list1") }}</li>
                                <li class="flex items-center gap-3"><i class="fas fa-check-circle text-green-500"></i> {{ __("home.basic_list2") }}</li>
                                <li class="flex items-center gap-3"><i class="fas fa-check-circle text-green-500"></i> {{ __("home.basic_list3") }}</li>
                                <li class="flex items-center gap-3"><i class="fas fa-check-circle text-green-500"></i> {{ __("home.basic_list4") }}</li>
                            </ul>
                        </div>
                        <div class="flex items-end">
                            <button class="bg-purple-600 text-white px-8 py-4 rounded-full font-bold text-lg hover:bg-purple-700 transition w-full">{{ __("home.basic_btn") }}</button>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-purple-800 to-indigo-800 p-8 md:p-10 rounded-3xl shadow-2xl border border-purple-600 flex flex-col justify-between feature-card max-w-md mx-auto h-full min-h-[520px]">
                        <div class="flex flex-col h-full">
                            <div class="text-right mb-4">
                                <span class="bg-white text-purple-800 text-xs font-bold px-4 py-2 rounded-full">RECOMMENDED</span>
                            </div>
                            <h3 class="text-3xl font-bold mb-4">{{ __("home.pro") }}</h3>
                            <p class="text-purple-200 text-lg mb-6">{{ __("home.pro_desc") }}</p>
                            <div class="text-6xl font-extrabold mb-8 break-words">
                                {{ __("home.pro_price") }}
                            </div>
                            <ul class="text-left text-purple-100 space-y-4 mb-10">
                                <li class="flex items-center gap-3"><i class="fas fa-check-circle text-yellow-300"></i> {{ __("home.pro_list1") }}</li>
                                <li class="flex items-center gap-3"><i class="fas fa-check-circle text-yellow-300"></i> {{ __("home.pro_list2") }}</li>
                                <li class="flex items-center gap-3"><i class="fas fa-check-circle text-yellow-300"></i> {{ __("home.pro_list3") }}</li>
                                <li class="flex items-center gap-3"><i class="fas fa-check-circle text-yellow-300"></i> {{ __("home.pro_list4") }}</li>
                                <li class="flex items-center gap-3"><i class="fas fa-check-circle text-yellow-300"></i> {{ __("home.pro_list5") }}</li>
                            </ul>
                        </div>
                        <div class="flex items-end">
                            <button class="bg-white text-purple-800 px-8 py-4 rounded-full font-bold text-lg hover:bg-gray-200 transition w-full">{{ __("home.pro_btn") }}</button>
                        </div>
                    </div>

                    <div class="bg-[#1a1a2e] p-8 md:p-10 rounded-3xl shadow-xl border border-gray-700 flex flex-col justify-between feature-card max-w-md mx-auto h-full min-h-[520px]">
                        <div class="flex flex-col h-full">
                            <h3 class="text-3xl font-bold mb-4">{{ __("home.enterprise") }}</h3>
                            <p class="text-gray-400 text-lg mb-6">{{ __("home.enterprise_desc") }}</p>
                            <div class="text-5xl font-extrabold mb-8 break-words">
                                {{ __("home.enterprise_price") }}
                            </div>
                            <ul class="text-left text-gray-300 space-y-4 mb-10">
                                <li class="flex items-center gap-3"><i class="fas fa-check-circle text-green-500"></i> {{ __("home.enterprise_list1") }}</li>
                                <li class="flex items-center gap-3"><i class="fas fa-check-circle text-green-500"></i> {{ __("home.enterprise_list2") }}</li>
                                <li class="flex items-center gap-3"><i class="fas fa-check-circle text-green-500"></i> {{ __("home.enterprise_list3") }}</li>
                                <li class="flex items-center gap-3"><i class="fas fa-check-circle text-green-500"></i> {{ __("home.enterprise_list4") }}</li>
                                <li class="flex items-center gap-3"><i class="fas fa-check-circle text-green-500"></i> {{ __("home.enterprise_list5") }}</li>
                            </ul>
                        </div>
                        <div class="flex items-end">
                            <button class="bg-white text-black px-8 py-4 rounded-full font-bold text-lg hover:bg-gray-200 transition w-full">{{ __("home.enterprise_btn") }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="container mx-auto px-8 py-48 flex flex-col md:flex-row items-center gap-16">
            <div class="flex-1 flex justify-center float-animation" style="animation-delay: 1s">
                <img src="{{ asset('img/illustrations/simpandata2.jpg') }}" alt="Mobile App" class="relative rounded-xl border-[6px] border-[#1a1a2e] shadow-2xl w-full">
            </div>

            <div class="flex-1 max-w-lg text-left">
                <h2 class="text-4xl md:text-5xl font-extrabold leading-tight mb-6">{{ __("home.data_tools_title") }}</h2>
                <p class="text-gray-400 text-lg leading-relaxed mb-10">
                    {{ __("home.data_tools_desc") }}
                </p>
                <div class="flex gap-4">
                    <button class="bg-white text-black px-8 py-3 rounded-full font-bold hover:bg-gray-200 transition">{{ __("home.subscribe") }}</button>
                    <button class="flex items-center gap-3 text-white font-bold opacity-60 hover:opacity-100 transition">{{ __("home.view_demo") }}</button>
                </div>
            </div>
        </section>
    </div>

    <footer class="bg-[#0d0d1a] pt-24 pb-12 border-t border-white/5 relative z-20 text-sm">
        <div class="container mx-auto px-8">
            <div class="grid grid-cols-2 md:grid-cols-6 gap-10 mb-20">
                <div>
                    <h4 class="font-bold text-white mb-6">Categories</h4>
                    <ul class="text-gray-400 space-y-4">
                        <li><a href="#" class="hover:text-white transition">User Interface</a></li>
                        <li><a href="#" class="hover:text-white transition">User Experience</a></li>
                        <li><a href="#" class="hover:text-white transition">Digital Media</a></li>
                        <li><a href="#" class="hover:text-white transition">Lifestyle</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-white mb-6">Product</h4>
                    <ul class="text-gray-400 space-y-4">
                        <li><a href="#" class="hover:text-white transition">Pricing</a></li>
                        <li><a href="#" class="hover:text-white transition">Overview</a></li>
                        <li><a href="#" class="hover:text-white transition">Browse <span class="bg-purple-500/20 text-purple-400 text-[10px] px-2 py-0.5 rounded ml-1 font-bold">BETA</span></a></li>
                        <li><a href="#" class="hover:text-white transition">Accessibility</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-white mb-6">Solutions</h4>
                    <ul class="text-gray-400 space-y-4">
                        <li><a href="#" class="hover:text-white transition">Brainstorming</a></li>
                        <li><a href="#" class="hover:text-white transition">Ideation</a></li>
                        <li><a href="#" class="hover:text-white transition">Wireframing</a></li>
                        <li><a href="#" class="hover:text-white transition">Research</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-white mb-6">Resources</h4>
                    <ul class="text-gray-400 space-y-4">
                        <li><a href="#" class="hover:text-white transition">Help Center</a></li>
                        <li><a href="#" class="hover:text-white transition">Blog</a></li>
                        <li><a href="#" class="hover:text-white transition">Tutorials</a></li>
                        <li><a href="#" class="hover:text-white transition">FAQs</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-white mb-6">Support</h4>
                    <ul class="text-gray-400 space-y-4">
                        <li><a href="#" class="hover:text-white transition">Contact Us</a></li>
                        <li><a href="#" class="hover:text-white transition">Developers</a></li>
                        <li><a href="#" class="hover:text-white transition">Documentation</a></li>
                        <li><a href="#" class="hover:text-white transition">Integrations</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-white mb-6">Company</h4>
                    <ul class="text-gray-400 space-y-4 mb-6">
                        <li><a href="#" class="hover:text-white transition">About</a></li>
                        <li><a href="#" class="hover:text-white transition">Press</a></li>
                        <li><a href="#" class="hover:text-white transition">Events</a></li>
                    </ul>
                    <a href="#" class="flex items-center gap-2 text-white font-bold group">
                        Request Demo 
                        <span class="group-hover:translate-x-1 transition-transform">→</span>
                    </a>
                </div>
            </div>

            <div class="flex flex-col md:flex-row justify-between items-center pt-8 border-t border-white/5 gap-8">
                <div class="flex flex-wrap items-center gap-6 text-gray-500">
                    <span>{{ __("home.footer_copyright") }}</span>
                    <a href="#" class="hover:text-white">{{ __("home.footer_terms") }}</a>
                    <a href="#" class="hover:text-white">{{ __("home.footer_privacy") }}</a>
                    <a href="#" class="hover:text-white">{{ __("home.footer_cookies") }}</a>
                </div>

                <div class="flex items-center gap-8">
                    <div class="flex gap-4 text-gray-400">
                        <a href="#" class="hover:text-white transition">
                            <i class="fab fa-youtube text-xl"></i>
                        </a>
                        <a href="#" class="hover:text-white transition">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="hover:text-white transition">
                            <i class="fab fa-facebook-f text-xl"></i>
                        </a>
                        <a href="#" class="hover:text-white transition">
                            <i class="fab fa-linkedin-in text-xl"></i>
                        </a>
                    </div>
                    <div class="flex gap-3">
                        <a href="#" class="hover:opacity-80 transition">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/3/3c/Download_on_the_App_Store_Badge.svg" class="h-9" alt="App Store">
                        </a>
                        <a href="#" class="hover:opacity-80 transition">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg" class="h-9" alt="Play Store">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Parallax Effect for Laptop
        document.addEventListener('scroll', function() {
            const laptop = document.querySelector('.hero-laptop');
            const scrollY = window.scrollY;
            laptop.style.transform = `translateY(${scrollY * 0.15}px)`; // Adjust 0.15 for more/less effect
        });

        // Floating Top Button
        const topBtn = document.createElement('button');
        topBtn.innerHTML = '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>';
        topBtn.setAttribute('id', 'topBtn');
        topBtn.setAttribute('aria-label', 'Scroll to top');
        topBtn.className = 'fixed top-1/2 right-8 -translate-y-1/2 z-50 bg-purple-600 text-white rounded-full p-4 shadow-lg hover:bg-purple-700 transition hidden';
        document.body.appendChild(topBtn);
        window.addEventListener('scroll', function() {
            if (window.scrollY > 300) {
                topBtn.classList.remove('hidden');
            } else {
                topBtn.classList.add('hidden');
            }
        });
        topBtn.addEventListener('click', function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    </script>
        <!-- Chatwoot Live Chat Widget -->
        <script>
            (function(d,t) {
                var BASE_URL="https://office-suite.cloudku.technology";
                var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
                g.src=BASE_URL+"/packs/js/sdk.js";
                g.async = true;
                s.parentNode.insertBefore(g,s);
                g.onload=function(){
                    window.chatwootSDK.run({ websiteToken: '58EqaLW37aJQDHX4Vmax4RoQ', baseUrl: BASE_URL })
                }
            })(document,"script");
        </script>
</body>
</html>