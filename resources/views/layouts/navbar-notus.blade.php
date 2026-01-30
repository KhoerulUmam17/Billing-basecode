<nav class="top-0 absolute z-50 w-full flex flex-wrap items-center justify-between px-2 py-3 navbar-expand-lg">
    <div class="container px-4 mx-auto flex flex-wrap items-center justify-between">
        <div class="w-full relative flex justify-between lg:w-auto lg:static lg:block lg:justify-start">
            <a class="text-sm font-bold leading-relaxed inline-block mr-4 py-2 whitespace-nowrap uppercase text-white"
                href="/">Future CRM</a><button
                class="cursor-pointer text-xl leading-none px-3 py-1 border border-solid border-transparent rounded bg-transparent block lg:hidden outline-none focus:outline-none"
                type="button" onclick="toggleNavbar('example-collapse-navbar')">
                <i class="text-white fas fa-bars"></i>
            </button>
        </div>
        <div class="lg:flex flex-grow items-center bg-white lg:bg-opacity-0 lg:shadow-none hidden"
            id="example-collapse-navbar">
            <ul class="flex flex-col lg:flex-row list-none lg:ml-auto items-center">
                <li class="inline-block relative">
                    <a class="lg:text-white lg:hover:text-slate-200 text-slate-700 px-3 py-4 lg:py-2 flex items-center text-xs uppercase font-bold"
                        href="#menu" onclick="openDropdown(event,'demo-pages-dropdown')">
                        Menu Sistem
                    </a>
                    <div class="hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48"
                        id="demo-pages-dropdown">
                        <span
                            class="text-sm pt-2 pb-0 px-4 font-bold block w-full whitespace-nowrap bg-transparent text-slate-400">
                            Menu
                        </span>
                    </div>
                </li>
                {{-- <li class="flex items-center">
                    <a class="lg:text-white lg:hover:text-slate-200 text-slate-700 px-3 py-4 lg:py-2 flex items-center text-xs uppercase font-bold"
                        href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdemos.creative-tim.com%2Fnotus-js%2F"
                        target="_blank"><i
                            class="lg:text-slate-200 text-slate-400 fab fa-facebook text-lg leading-lg"></i><span
                            class="lg:hidden inline-block ml-2">Facebook</span></a>
                </li> --}}
                <li class="flex items-center">
                    @auth
                        <a href="#" wire:click.prevent="dashboard"
                            class="bg-white text-slate-700 active:bg-slate-50 text-xs font-bold uppercase px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none lg:mr-1 lg:mb-0 ml-3 mb-3 ease-linear transition-all duration-150"
                            type="button">
                            <div wire:loading wire:target="dashboard">
                                <!-- Loader icon here -->
                                <i class="fas fa-spinner fa-spin"></i> Loading...
                            </div>
                            <div wire:loading.remove wire:target="dashboard">
                                <!-- Original icon -->
                                <i class="fas fa-sign-in-alt"></i> Dashboard
                            </div>
                        </a>
                    @else
                        <a href="#" wire:click.prevent="login"
                            class="bg-white text-slate-700 active:bg-slate-50 text-xs font-bold uppercase px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none lg:mr-1 lg:mb-0 ml-3 mb-3 ease-linear transition-all duration-150"
                            type="button">
                            <div wire:loading wire:target="login">
                                <!-- Loader icon here -->
                                <i class="fas fa-spinner fa-spin"></i> Loading...
                            </div>
                            <div wire:loading.remove wire:target="login">
                                <!-- Original icon -->
                                <i class="fas fa-sign-in-alt"></i> Masuk
                            </div>
                        </a>
                    @endauth
                </li>
                
            </ul>
        </div>
    </div>
</nav>

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
