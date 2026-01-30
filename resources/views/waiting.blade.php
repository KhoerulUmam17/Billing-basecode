@extends('layouts.notus-section')
@section('content')
@include('layouts.navbar-notus')
<main>
    <div class="relative pt-16 pb-32 flex content-center items-center justify-center min-h-screen-75">
        <div class="absolute top-0 w-full h-full bg-center bg-cover"
        style="background-image: url('https://i.postimg.cc/pTRwt6ys/bg.jpg');
      ">
            {{-- <img src="{{asset('img/bg.jpg')}}" fit="crop" alt=""> --}}
            <span id="blackOverlay" class="w-full h-full absolute opacity-75 bg-black"></span>
        </div>
        <div class="container relative mx-auto">
            <div class="items-center flex flex-wrap">
                <div class="w-full lg:w-8/12 px-4 ml-auto mr-auto text-center">
                    <div class="lg:pr-12">
                        <h1 class="text-white font-semibold text-5xl">
                            Akun Anda Belum Aktif
                        </h1>
                        <p class="mt-4 text-lg text-slate-200">
                            Segera konfirmasi ke pihak sekolah jika ada kendala, Terima Kasih.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="top-auto bottom-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden h-70-px"
            style="transform: translateZ(0px)">
            <svg class="absolute bottom-0 overflow-hidden" xmlns="http://www.w3.org/2000/svg"
                preserveAspectRatio="none" version="1.1" viewBox="0 0 2560 100" x="0" y="0">
                <polygon class="text-slate-200 fill-current" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
    </div>

</main>
<footer class="relative bg-slate-200 pt-8 pb-6">
    <div class="bottom-auto top-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden -mt-20 h-20"
        style="transform: translateZ(0px)">
        <svg class="absolute bottom-0 overflow-hidden" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none"
            version="1.1" viewBox="0 0 2560 100" x="0" y="0">
            <polygon class="text-slate-200 fill-current" points="2560 0 2560 100 0 100"></polygon>
        </svg>
    </div>
    <div class="container mx-auto px-4">

        <hr class="my-6 border-slate-300" />
        <div class="flex flex-wrap items-center md:justify-between justify-center">
            <div class="w-full md:w-4/12 px-4 mx-auto text-center">
                <div class="text-sm text-slate-500 font-semibold py-1 text-center md:text-left">
                    Copyright © <span id="get-current-year"></span> cloudku | Design UI By
                    <a href="https://www.creative-tim.com/product/notus-js" target="_blank"
                        class="text-slate-500 hover:text-slate-700 text-sm font-semibold py-1">
                        Notus Tailwind JS
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>
@endsection
