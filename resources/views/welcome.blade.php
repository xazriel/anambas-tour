<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Anambas Tourism Hub | Hidden Paradise</title>
    
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#005e97",
                        "primary-container": "#0077be",
                        "on-primary-container": "#f7f9ff",
                        "secondary": "#5d5f5f",
                        "tertiary": "#9e380d",
                        "tertiary-container": "#bf5025",
                        "surface": "#f9f9f9",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-low": "#f3f3f3",
                        "on-surface-variant": "#404751",
                        "outline-variant": "#c0c7d2",
                        "primary-fixed": "#cfe5ff",
                    },
                    fontFamily: {
                        headline: ["Plus Jakarta Sans"],
                        body: ["Inter"],
                    }
                }
            }
        }
    </script>

    <style>
        .glass-nav { backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); }
        .text-glow { text-shadow: 0 4px 12px rgba(0,0,0,0.2); }
        .ambient-shadow { box-shadow: 0 24px 48px -12px rgba(0, 94, 151, 0.08); }
    </style>
    @livewireStyles
</head>

<body class="bg-surface font-body text-on-surface">

    <nav class="fixed top-0 w-full z-50 bg-surface/70 glass-nav transition-all duration-300 border-b border-outline-variant/20">
        <div class="flex justify-between items-center px-8 py-4 max-w-7xl mx-auto font-headline tracking-tight">
            <div class="text-xl font-bold text-primary">Anambas Tourism Hub</div>
            <div class="hidden md:flex items-center space-x-8">
                <a class="text-primary border-b-2 border-primary pb-1 font-semibold" href="#">Home</a>
                <a class="text-on-surface-variant hover:text-primary transition-colors" href="#explore">Destinations</a>
                <a class="text-on-surface-variant hover:text-primary transition-colors" href="#">Culinary</a>
                <a class="text-on-surface-variant hover:text-primary transition-colors" href="#">Culture</a>
            </div>
            <div class="flex items-center space-x-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-primary font-medium px-4">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-on-surface font-medium px-4">Login</a>
                        <a href="{{ route('register') }}" class="bg-primary-container text-white px-6 py-2.5 rounded-xl font-semibold shadow-md hover:shadow-lg transition-all">Register</a>
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <main>
        <section class="relative h-[90vh] w-full flex items-center justify-center overflow-hidden">
            <div class="absolute inset-0 z-0">
                <img class="w-full h-full object-cover" src="https://images.unsplash.com/photo-1544918877-460635b6d13e?q=80&w=2070&auto=format&fit=crop" alt="Anambas Hero" />
                <div class="absolute inset-0 bg-gradient-to-b from-black/30 via-transparent to-surface"></div>
            </div>
            <div class="relative z-10 text-center px-6 max-w-4xl">
                <span class="text-tertiary font-bold tracking-[0.2em] uppercase mb-4 block text-sm">Hidden Jewel of Indonesia</span>
                <h1 class="text-5xl md:text-8xl font-headline font-extrabold text-white mb-8 tracking-tighter leading-none text-glow">
                    Experience the Hidden <br/><span class="text-primary-fixed">Paradise of Anambas</span>
                </h1>
                <a href="#explore" class="bg-gradient-to-r from-tertiary to-tertiary-container text-white px-10 py-5 rounded-full font-bold text-lg hover:scale-105 transition-transform duration-300 ambient-shadow inline-block">
                    Explore Now
                </a>
            </div>
        </section>

        <section id="explore" class="py-24 px-8 max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6">
                <div class="max-w-2xl">
                    <h2 class="text-4xl md:text-5xl font-headline font-bold text-on-surface mb-4">Pristine Archipelago</h2>
                    <p class="text-lg text-on-surface-variant leading-relaxed">Temukan destinasi pilihan di Kepulauan Anambas berdasarkan standar kualitas atraksi dan aksesibilitas.</p>
                </div>
                <div class="h-px flex-grow bg-outline-variant/30 mx-8 hidden md:block"></div>
            </div>

            @livewire('destination-list')
        </section>
    </main>

    <div class="fixed bottom-8 right-8 z-[100]">
        @livewire('chatbot')
    </div>

    <footer class="w-full py-16 bg-surface-container-low border-t border-outline-variant/30">
        <div class="max-w-7xl mx-auto px-8 flex flex-col md:flex-row justify-between items-center text-sm text-on-surface-variant">
            <div class="mb-8 md:mb-0 text-center md:text-left">
                <div class="font-headline font-bold text-primary text-xl mb-2">Anambas Tourism Hub</div>
                <p class="max-w-xs">Preserving the untouched beauty of the Anambas archipelago for future generations.</p>
            </div>
            <div class="flex gap-8 mb-8 md:mb-0 font-medium">
                <a href="#" class="hover:text-primary transition-colors">Privacy</a>
                <a href="#" class="hover:text-primary transition-colors">Terms</a>
                <a href="#" class="hover:text-primary transition-colors">Contact</a>
            </div>
            <p>© 2026 Anambas Hub. Built by KIEL.</p>
        </div>
    </footer>

    @livewireScripts
</body>
</html>