    @extends('app')

    @section('title', 'Home - Bedengan Camping Ground')

    @section('content')
            <section id="beranda" class="relative w-full h-screen overflow-hidden flex items-center justify-center text-center px-4">
                
                <div class="absolute inset-0 z-0">
                    <img src="https://images.unsplash.com/photo-1510797215324-95aa89f43c33?q=80&w=1935&auto=format&fit=crop" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-b from-bedengan-dark/80 via-bedengan-dark/40 to-bedengan-dark/95"></div>
                </div>

                <div class="relative z-10 max-w-4xl mx-auto mt-10">
                    <h1 class="font-serif text-5xl md:text-7xl font-bold text-white mb-6 leading-tight drop-shadow-lg">
                        Escape to Nature's <br>
                        <span class="text-bedengan-light">Paradise</span>
                    </h1>
                    
                    <p class="text-gray-200 text-lg md:text-xl font-light mb-10 max-w-2xl mx-auto">
                        Discover the serenity of Bedengan, nestled in the lush forests of East Java. Your perfect camping retreat awaits.
                    </p>
                    
                    <div class="flex flex-col md:flex-row gap-4 justify-center">
                        <a href="tiket.html" class="bg-bedengan-primary hover:bg-green-600 text-white px-8 py-3.5 rounded-full font-medium transition shadow-lg shadow-green-500/30 flex items-center justify-center gap-2">
                            Book Now <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                        <a href="#galeri" class="bg-white/10 backdrop-blur-sm border border-white/20 hover:bg-white/20 text-white px-8 py-3.5 rounded-full font-medium transition">
                            View Gallery
                        </a>
                    </div>
                </div>

                <div class="absolute bottom-8 animate-bounce text-white/50">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                </div>
            </section>

            <section id="tiket" class="py-24 bg-bedengan-surface">
                <div class="container mx-auto px-6">
                    <div class="text-center mb-16">
                        <h2 class="font-serif text-4xl md:text-5xl font-bold text-bedengan-dark mb-4">Ticket Options</h2>
                        <p class="text-gray-600">Enjoy an affordable vacation with premium facilities.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                        <div class="bg-white rounded-3xl p-8 shadow-xl hover:-translate-y-2 transition-transform duration-300 border border-gray-100">
                            <div class="flex items-center gap-4 mb-6">
                                <div class="w-12 h-12 bg-bedengan-surface rounded-full flex items-center justify-center text-bedengan-dark">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                </div>
                                <h3 class="font-serif text-2xl font-bold text-gray-800">Daily Visit</h3>
                            </div>
                            <div class="text-4xl font-bold text-bedengan-primary mb-6">IDR 10k<span class="text-sm text-gray-400 font-normal">/pax</span></div>
                            <ul class="space-y-3 mb-8 text-gray-600">
                                <li class="flex items-center gap-2"><svg class="w-5 h-5 text-bedengan-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Access to area</li>
                                <li class="flex items-center gap-2"><svg class="w-5 h-5 text-bedengan-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Free photo spots</li>
                                <li class="flex items-center gap-2"><svg class="w-5 h-5 text-bedengan-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Clean restrooms</li>
                            </ul>
                            <a href="tiket.html" class="block w-full text-center py-3 rounded-xl border border-bedengan-dark text-bedengan-dark font-semibold hover:bg-bedengan-dark hover:text-white transition">Select Ticket</a>
                        </div>

                        <div class="bg-bedengan-dark rounded-3xl p-8 shadow-2xl hover:-translate-y-2 transition-transform duration-300 relative overflow-hidden text-white">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-bedengan-primary blur-3xl opacity-20 -mr-10 -mt-10"></div>
                            <div class="flex items-center gap-4 mb-6 relative z-10">
                                <div class="w-12 h-12 bg-white/10 rounded-full flex items-center justify-center text-bedengan-light">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                                </div>
                                <h3 class="font-serif text-2xl font-bold">Camping Overnight</h3>
                            </div>
                            <div class="text-4xl font-bold text-bedengan-light mb-6 relative z-10">IDR 25k<span class="text-sm text-gray-400 font-normal">/pax</span></div>
                            <ul class="space-y-3 mb-8 text-gray-300 relative z-10">
                                <li class="flex items-center gap-2"><svg class="w-5 h-5 text-bedengan-light" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Includes entrance fee</li>
                                <li class="flex items-center gap-2"><svg class="w-5 h-5 text-bedengan-light" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> 1 Night stay</li>
                                <li class="flex items-center gap-2"><svg class="w-5 h-5 text-bedengan-light" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> 24-hour security</li>
                            </ul>
                            <a href="tiket.html" class="block w-full text-center py-3 rounded-xl bg-bedengan-primary text-white font-semibold hover:bg-green-600 transition shadow-lg shadow-green-900/50 relative z-10">Book Now</a>
                        </div>
                    </div>
                </div>
            </section>

            <section id="fasilitas" class="py-24 bg-white">
                <div class="container mx-auto px-6 text-center">
                    <h2 class="font-serif text-4xl font-bold text-bedengan-dark mb-4">Complete Facilities</h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-6 max-w-5xl mx-auto mt-12">
                        <div class="p-6 rounded-2xl bg-gray-50 border border-gray-100 hover:border-bedengan-primary hover:bg-white hover:shadow-lg transition group">
                            <div class="w-12 h-12 mx-auto bg-white rounded-full shadow-sm flex items-center justify-center text-bedengan-dark group-hover:bg-bedengan-primary group-hover:text-white transition mb-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"></path></svg>
                            </div>
                            <h4 class="font-semibold text-gray-800">Bonfire Area</h4>
                        </div>
                        <div class="p-6 rounded-2xl bg-gray-50 border border-gray-100 hover:border-bedengan-primary hover:bg-white hover:shadow-lg transition group">
                            <div class="w-12 h-12 mx-auto bg-white rounded-full shadow-sm flex items-center justify-center text-bedengan-dark group-hover:bg-bedengan-primary group-hover:text-white transition mb-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                            </div>
                            <h4 class="font-semibold text-gray-800">Clean Restrooms</h4>
                        </div>
                        <div class="p-6 rounded-2xl bg-gray-50 border border-gray-100 hover:border-bedengan-primary hover:bg-white hover:shadow-lg transition group">
                            <div class="w-12 h-12 mx-auto bg-white rounded-full shadow-sm flex items-center justify-center text-bedengan-dark group-hover:bg-bedengan-primary group-hover:text-white transition mb-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            </div>
                            <h4 class="font-semibold text-gray-800">Food Stalls</h4>
                        </div>
                        <div class="p-6 rounded-2xl bg-gray-50 border border-gray-100 hover:border-bedengan-primary hover:bg-white hover:shadow-lg transition group">
                            <div class="w-12 h-12 mx-auto bg-white rounded-full shadow-sm flex items-center justify-center text-bedengan-dark group-hover:bg-bedengan-primary group-hover:text-white transition mb-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                            <h4 class="font-semibold text-gray-800">Spacious Parking</h4>
                        </div>
                        <div class="p-6 rounded-2xl bg-gray-50 border border-gray-100 hover:border-bedengan-primary hover:bg-white hover:shadow-lg transition group">
                            <div class="w-12 h-12 mx-auto bg-white rounded-full shadow-sm flex items-center justify-center text-bedengan-dark group-hover:bg-bedengan-primary group-hover:text-white transition mb-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            </div>
                            <h4 class="font-semibold text-gray-800">Prayer Room</h4>
                        </div>
                        <div class="p-6 rounded-2xl bg-gray-50 border border-gray-100 hover:border-bedengan-primary hover:bg-white hover:shadow-lg transition group">
                            <div class="w-12 h-12 mx-auto bg-white rounded-full shadow-sm flex items-center justify-center text-bedengan-dark group-hover:bg-bedengan-primary group-hover:text-white transition mb-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <h4 class="font-semibold text-gray-800">Photo Spots</h4>
                        </div>
                    </div>
                </div>
            </section>
            <section id="lokasi" class="py-24 bg-bedengan-surface">
                <div class="container mx-auto px-6 text-center">
                    <h2 class="font-serif text-4xl font-bold text-bedengan-dark mb-6">Find Our Location</h2>
                    <p class="text-gray-600 mb-12 max-w-2xl mx-auto">Easily accessible from Malang city center. Enjoy the scenic drive to our camping ground.</p>

                    <div class="w-full h-[450px] bg-gray-200 rounded-3xl overflow-hidden shadow-xl border-4 border-white">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31612.305484074688!2d112.54625616638184!3d-7.943202728881958!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7883de82b88e3b%3A0xef56b8f39f00d6e0!2sBumi%20Perkemahan%20Bedengan%2C%20Selorejo!5e0!3m2!1sid!2sid!4v1764831482836!5m2!1sid!2sid"
                            width="100%"
                            height="100%"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            class="w-full h-full grayscale hover:grayscale-0 transition-all duration-700">
                        </iframe>
                    </div>
                </div>
            </section>

            <section id="galeri" class="py-24 bg-white">
                <div class="container mx-auto px-6 text-center">
                    <h2 class="font-serif text-4xl font-bold text-bedengan-dark mb-4">Gallery</h2>
                    <p class="text-gray-600 mb-16 max-w-xl mx-auto">Glimpses of unforgettable moments at Bedengan Camping Ground</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 auto-rows-[250px]">
                        
                        <div class="row-span-2 col-span-2 rounded-3xl overflow-hidden shadow-md group relative">
                            <img src="https://images.unsplash.com/photo-1523987355523-c7b5b0dd90a7?q=80&w=800&auto=format&fit=crop" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Gallery 1">
                            <div class="absolute bottom-4 left-4 bg-bedengan-primary/90 text-white text-xs font-bold px-3 py-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                Camping Vibes
                            </div>
                        </div>

                        <div class="rounded-3xl overflow-hidden shadow-md group relative">
                            <img src="https://images.unsplash.com/photo-1478131143081-80f7f84ca84d?q=80&w=800&auto=format&fit=crop" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Gallery 2">
                            <div class="absolute bottom-4 left-4 bg-bedengan-primary/90 text-white text-xs font-bold px-3 py-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                Bonfire Nights
                            </div>
                        </div>

                        <div class="rounded-3xl overflow-hidden shadow-md group relative">
                            <img src="https://images.unsplash.com/photo-1532339142463-fd0a8979791a?q=80&w=800&auto=format&fit=crop" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Gallery 3">
                            <div class="absolute bottom-4 left-4 bg-bedengan-primary/90 text-white text-xs font-bold px-3 py-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                Misty Mornings
                            </div>
                        </div>

                        <div class="col-span-2 rounded-3xl overflow-hidden shadow-md group relative">
                            <img src="https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?q=80&w=800&auto=format&fit=crop" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Gallery 4">
                            <div class="absolute bottom-4 left-4 bg-bedengan-primary/90 text-white text-xs font-bold px-3 py-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                Tent View
                            </div>
                        </div>
                        
                        <div class="col-span-2 rounded-3xl overflow-hidden shadow-md group relative">
                            <img src="https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?q=80&w=800&auto=format&fit=crop" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Gallery 4">
                            <div class="absolute bottom-4 left-4 bg-bedengan-primary/90 text-white text-xs font-bold px-3 py-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                Tent View
                            </div>
                        </div>

                        <div class="rounded-3xl overflow-hidden shadow-md group relative">
                            <img src="https://images.unsplash.com/photo-1510312305653-8ed496efae75?q=80&w=800&auto=format&fit=crop" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Gallery 5">
                            <div class="absolute bottom-4 left-4 bg-bedengan-primary/90 text-white text-xs font-bold px-3 py-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                Forest Trails
                            </div>
                        </div>

                        <div class="rounded-3xl overflow-hidden shadow-md group relative">
                            <img src="https://images.unsplash.com/photo-1537905569824-f89f14cceb68?q=80&w=800&auto=format&fit=crop" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Gallery 6">
                            <div class="absolute bottom-4 left-4 bg-bedengan-primary/90 text-white text-xs font-bold px-3 py-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                Relaxation
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    @endsection

    @push('scripts')
    <script>
        const navbar   = document.getElementById('navbar');
        const navMenu  = document.getElementById('nav-menu');
        const logoText = document.getElementById('nav-logo-text');
        const homeLink = document.getElementById('nav-link-home');
        const userBtn  = document.getElementById('nav-user-btn');

        function updateNavbar() {
            const isScrolled = window.scrollY > 50;
            const links = navMenu.querySelectorAll('.nav-link');

            if (!isScrolled) {
                // MODE TRANSPARENT (HANYA HOME DI POSISI ATAS)
                navbar.classList.remove('bg-white', 'shadow-md');
                navbar.classList.add('bg-transparent');

                logoText.classList.remove('text-bedengan-dark');
                logoText.classList.add('text-white');

                homeLink.classList.remove('bg-bedengan-primary/10', 'text-bedengan-primary');
                homeLink.classList.add('bg-white/20', 'text-white');

                userBtn.classList.remove('text-bedengan-dark');
                userBtn.classList.add('text-white');

                links.forEach(link => {
                    link.classList.remove('text-bedengan-dark');
                    link.classList.add('text-gray-200', 'hover:bg-white/10');
                }
                
            );
            } else {
                // KEMBALI KE MODE NORMAL (PUTIH + HIJAU)
                navbar.classList.remove('bg-transparent');
                navbar.classList.add('bg-white', 'shadow-md');

                logoText.classList.remove('text-white');
                logoText.classList.add('text-bedengan-dark');

                homeLink.classList.remove('bg-white/20', 'text-white');
                homeLink.classList.add('bg-bedengan-primary/10', 'text-bedengan-primary');
                
                userBtn.classList.remove('text-white');
                userBtn.classList.add('text-bedengan-dark');

                links.forEach(link => {
                    link.classList.remove('text-gray-200', 'hover:bg-white/10');
                    link.classList.add('text-bedengan-dark', 'hover:bg-bedengan-primary/10');
                });
            }
        }

        window.addEventListener('scroll', updateNavbar);
        window.addEventListener('load', updateNavbar);
    </script>
    @endpush
