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
                            Sistem Monitoring Akademik Siswa SMPIT AL-ANWAR
                        </h1>
                        <p class="mt-4 text-lg text-slate-200">
                            Sebuah sistem atau media untuk melihat perkembangan siswa dalam sekolah dengan mudah.
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
    <section class="pb-20 bg-slate-200 -mt-24">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap">
                <div class="lg:pt-12 pt-6 w-full md:w-4/12 px-4 text-center">
                    <div
                        class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg">
                        <div class="px-4 py-5 flex-auto">
                            <div
                                class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full bg-red-400">
                                <i class="fas fa-chalkboard-teacher"></i>
                            </div>
                            <h6 class="text-xl font-semibold">Guru</h6>
                            <p class="mt-2 mb-4 text-slate-500">
                                Mempermudah guru untuk memonitoring perkembangan siswa di sekolah dalam segi akademik.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-4/12 px-4 text-center">
                    <div
                        class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg">
                        <div class="px-4 py-5 flex-auto">
                            <div
                                class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full bg-lightBlue-400">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                            <h6 class="text-xl font-semibold">Siswa</h6>
                            <p class="mt-2 mb-4 text-slate-500">
                                Dapat melihat dengan mudah perkembangan dirinya di sekolah sebagai evaluasi diri sendiri.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="pt-6 w-full md:w-4/12 px-4 text-center">
                    <div
                        class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg">
                        <div class="px-4 py-5 flex-auto">
                            <div
                                class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full bg-emerald-400">
                                <i class="fas fa-user-friends"></i>
                            </div>
                            <h6 class="text-xl font-semibold">Orang Tua</h6>
                            <p class="mt-2 mb-4 text-slate-500">
                                Dapat melihat dengan mudah perkembangan anaknya kapan saja.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <section class="pb-20 relative block bg-slate-800">
        <div class="bottom-auto top-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden -mt-20 h-20"
            style="transform: translateZ(0px)">
            <svg class="absolute bottom-0 overflow-hidden" xmlns="http://www.w3.org/2000/svg"
                preserveAspectRatio="none" version="1.1" viewBox="0 0 2560 100" x="0" y="0">
                <polygon class="text-slate-800 fill-current" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
        <div class="container mx-auto px-4 lg:pt-24 lg:pb-64">

        </div>
    </section>
    <section class="relative block py-24 lg:pt-0 bg-slate-800">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap justify-center lg:-mt-64 -mt-48">
                <div class="w-full lg:w-6/12 px-4">
                    <div
                        class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-slate-200">
                        <div class="flex-auto p-5 lg:p-10">
                            <h4 class="text-2xl font-semibold">Ada Kendala ?</h4>
                            <p class="leading-relaxed mt-1 mb-4 text-slate-500">
                                Sampaikan kendala yang kamu alami.
                            </p>
                            <div class="relative w-full mb-3 mt-8">
                                <label class="block uppercase text-slate-600 text-xs font-bold mb-2"
                                    for="full-name">Full Name</label><input type="text"
                                    class="border-0 px-3 py-3 placeholder-slate-300 text-slate-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                    placeholder="Full Name" />
                            </div>
                            <div class="relative w-full mb-3">
                                <label class="block uppercase text-slate-600 text-xs font-bold mb-2"
                                    for="email">Email</label><input type="email"
                                    class="border-0 px-3 py-3 placeholder-slate-300 text-slate-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                    placeholder="Email" />
                            </div>
                            <div class="relative w-full mb-3">
                                <label class="block uppercase text-slate-600 text-xs font-bold mb-2"
                                    for="message">Message</label><textarea rows="4" cols="80"
                                    class="border-0 px-3 py-3 placeholder-slate-300 text-slate-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full"
                                    placeholder="Type a message..."></textarea>
                            </div>
                            <div class="text-center mt-6">
                                <button
                                    class="bg-slate-800 text-white active:bg-slate-600 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                    type="button">
                                    Send Message
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
@section('js')
<script>
    /* Make dynamic date appear */
    (function() {
        if (document.getElementById("get-current-year")) {
            document.getElementById("get-current-year").innerHTML =
                new Date().getFullYear();
        }
    })();
    /* Function for opning navbar on mobile */
    function toggleNavbar(collapseID) {
        document.getElementById(collapseID).classList.toggle("hidden");
        document.getElementById(collapseID).classList.toggle("block");
    }
    /* Function for dropdowns */
    function openDropdown(event, dropdownID) {
        let element = event.target;
        while (element.nodeName !== "A") {
            element = element.parentNode;
        }
        Popper.createPopper(element, document.getElementById(dropdownID), {
            placement: "bottom-start"
        });
        document.getElementById(dropdownID).classList.toggle("hidden");
        document.getElementById(dropdownID).classList.toggle("block");
    }
</script>
@endsection
