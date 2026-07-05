<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechForge | Custom PC Configurator</title>
    
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: { DEFAULT: '#ff6b00', hover: '#e56000', glow: 'rgba(255, 107, 0, 0.5)' },
                        dark: { bg: '#050505', surface: '#121212' }
                    },
                    fontFamily: { sans: ['Inter', 'sans-serif'] }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #050505; color: #ffffff; }
        .liquid-glass {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
    </style>
</head>
<body class="antialiased min-h-screen flex flex-col items-center justify-center py-20 px-4">

    <!-- Ambient background -->
    <div class="fixed inset-0 z-[-1] overflow-hidden pointer-events-none">
        <div class="absolute top-[-20%] left-[-10%] w-[50vw] h-[50vw] bg-primary/20 blur-[120px] rounded-full"></div>
        <div class="absolute bottom-[-20%] right-[-10%] w-[40vw] h-[40vw] bg-red-600/10 blur-[100px] rounded-full"></div>
    </div>

    <div class="max-w-4xl w-full liquid-glass rounded-3xl p-8 shadow-2xl border-white/10">
        <h1 class="text-4xl font-black text-white mb-2 text-center">Build Your Ultimate PC</h1>
        <p class="text-gray-400 text-center mb-10 text-sm">Our intelligent configurator ensures 100% compatibility across all components.</p>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            
            <!-- CPU -->
            <div class="flex flex-col gap-2">
                <label class="text-xs font-bold text-gray-500 uppercase tracking-widest flex items-center gap-2"><i class="ph-bold ph-cpu text-primary"></i> Processor (CPU)</label>
                <select id="cpu-select" class="w-full bg-[#0a0a0a] border border-white/10 rounded-xl p-4 text-white font-medium focus:border-primary focus:outline-none transition-colors appearance-none">
                    <option value="">Select CPU...</option>
                </select>
                <div class="text-[10px] text-gray-500" id="cpu-info"></div>
            </div>

            <!-- Motherboard -->
            <div class="flex flex-col gap-2">
                <label class="text-xs font-bold text-gray-500 uppercase tracking-widest flex items-center gap-2"><i class="ph-bold ph-circuitry text-primary"></i> Motherboard</label>
                <select id="mobo-select" disabled class="w-full bg-[#0a0a0a] border border-white/10 rounded-xl p-4 text-white font-medium focus:border-primary focus:outline-none transition-colors appearance-none disabled:opacity-50 disabled:cursor-not-allowed">
                    <option value="">Select CPU First...</option>
                </select>
                <div class="text-[10px] text-gray-500" id="mobo-info"></div>
            </div>

            <!-- RAM -->
            <div class="flex flex-col gap-2">
                <label class="text-xs font-bold text-gray-500 uppercase tracking-widest flex items-center gap-2"><i class="ph-bold ph-memory text-primary"></i> Memory (RAM)</label>
                <select id="ram-select" disabled class="w-full bg-[#0a0a0a] border border-white/10 rounded-xl p-4 text-white font-medium focus:border-primary focus:outline-none transition-colors appearance-none disabled:opacity-50 disabled:cursor-not-allowed">
                    <option value="">Select Motherboard First...</option>
                </select>
                <div class="text-[10px] text-gray-500" id="ram-info"></div>
            </div>

            <!-- GPU -->
            <div class="flex flex-col gap-2">
                <label class="text-xs font-bold text-gray-500 uppercase tracking-widest flex items-center gap-2"><i class="ph-bold ph-graphics-card text-primary"></i> Graphics Card (GPU)</label>
                <select id="gpu-select" class="w-full bg-[#0a0a0a] border border-white/10 rounded-xl p-4 text-white font-medium focus:border-primary focus:outline-none transition-colors appearance-none">
                    <option value="">Select GPU...</option>
                </select>
                <div class="text-[10px] text-gray-500" id="gpu-info"></div>
            </div>

            <!-- Power Supply -->
            <div class="flex flex-col gap-2">
                <label class="text-xs font-bold text-gray-500 uppercase tracking-widest flex items-center gap-2"><i class="ph-bold ph-plug text-primary"></i> Power Supply (PSU)</label>
                <select id="psu-select" disabled class="w-full bg-[#0a0a0a] border border-white/10 rounded-xl p-4 text-white font-medium focus:border-primary focus:outline-none transition-colors appearance-none disabled:opacity-50 disabled:cursor-not-allowed">
                    <option value="">Select CPU and GPU First...</option>
                </select>
                <div class="text-[10px] text-gray-500" id="psu-info"></div>
            </div>

            <!-- Case -->
            <div class="flex flex-col gap-2">
                <label class="text-xs font-bold text-gray-500 uppercase tracking-widest flex items-center gap-2"><i class="ph-bold ph-computer-tower text-primary"></i> Case</label>
                <select id="case-select" disabled class="w-full bg-[#0a0a0a] border border-white/10 rounded-xl p-4 text-white font-medium focus:border-primary focus:outline-none transition-colors appearance-none disabled:opacity-50 disabled:cursor-not-allowed">
                    <option value="">Select Motherboard First...</option>
                </select>
                <div class="text-[10px] text-gray-500" id="case-info"></div>
            </div>

        </div>

        <div class="mt-12 border-t border-white/10 pt-8 flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-400 font-bold uppercase tracking-widest">Total Price</p>
                <p class="text-4xl font-black text-white" id="total-price">P0</p>
            </div>
            <button class="bg-primary hover:bg-primary-hover text-white px-8 py-4 rounded-xl font-bold uppercase tracking-widest transition-all shadow-[0_0_20px_rgba(255,107,0,0.3)] hover:shadow-[0_0_30px_rgba(255,107,0,0.5)]">
                Checkout Build
            </button>
        </div>
    </div>

    <script>
        // Data injected from Controller
        const cpus = @json($cpus);
        const motherboards = @json($motherboards);
        const rams = @json($rams);
        const gpus = @json($gpus);
        const powerSupplies = @json($powerSupplies);
        const cases = @json($cases);

        // State
        let selected = {
            cpu: null,
            mobo: null,
            ram: null,
            gpu: null,
            psu: null,
            case: null
        };

        // DOM Elements
        const selCpu = document.getElementById('cpu-select');
        const selMobo = document.getElementById('mobo-select');
        const selRam = document.getElementById('ram-select');
        const selGpu = document.getElementById('gpu-select');
        const selPsu = document.getElementById('psu-select');
        const selCase = document.getElementById('case-select');

        // Helper to format currency
        const formatPrice = (p) => 'P' + parseFloat(p).toLocaleString();

        // Initialize Independent Dropdowns (CPU and GPU)
        function initBaseDropdowns() {
            selCpu.innerHTML = '<option value="">Select CPU...</option>';
            cpus.forEach(c => {
                selCpu.innerHTML += `<option value="${c.id}">${c.name} - ${formatPrice(c.price)}</option>`;
            });

            selGpu.innerHTML = '<option value="">Select GPU...</option>';
            gpus.forEach(g => {
                selGpu.innerHTML += `<option value="${g.id}">${g.name} - ${formatPrice(g.price)}</option>`;
            });
        }

        // Logic 1: Filter Motherboards by CPU Socket
        function updateMotherboards() {
            if (!selected.cpu) {
                selMobo.innerHTML = '<option value="">Select CPU First...</option>';
                selMobo.disabled = true;
                selected.mobo = null;
                updateRam();
                updateCases();
                return;
            }

            selMobo.disabled = false;
            selMobo.innerHTML = '<option value="">Select Motherboard...</option>';
            
            const compatible = motherboards.filter(m => m.socket === selected.cpu.socket);
            if (compatible.length === 0) {
                selMobo.innerHTML = '<option value="">No compatible motherboards found</option>';
            } else {
                compatible.forEach(m => {
                    selMobo.innerHTML += `<option value="${m.id}">${m.name} - ${formatPrice(m.price)}</option>`;
                });
            }

            // Reset downstream
            selected.mobo = null;
            updateRam();
            updateCases();
        }

        // Logic 2: Filter RAM by Motherboard Supported Gen
        function updateRam() {
            if (!selected.mobo) {
                selRam.innerHTML = '<option value="">Select Motherboard First...</option>';
                selRam.disabled = true;
                selected.ram = null;
                return;
            }

            selRam.disabled = false;
            selRam.innerHTML = '<option value="">Select RAM...</option>';
            
            const compatible = rams.filter(r => r.generation === selected.mobo.supported_ram_gen);
            if (compatible.length === 0) {
                selRam.innerHTML = '<option value="">No compatible RAM found</option>';
            } else {
                compatible.forEach(r => {
                    selRam.innerHTML += `<option value="${r.id}">${r.name} - ${formatPrice(r.price)}</option>`;
                });
            }
        }

        // Logic 3: Filter Cases by Motherboard Form Factor
        function updateCases() {
            if (!selected.mobo) {
                selCase.innerHTML = '<option value="">Select Motherboard First...</option>';
                selCase.disabled = true;
                selected.case = null;
                return;
            }

            selCase.disabled = false;
            selCase.innerHTML = '<option value="">Select Case...</option>';
            
            // max_mobo_size >= form_factor
            const compatible = cases.filter(c => c.max_mobo_size >= selected.mobo.form_factor);
            if (compatible.length === 0) {
                selCase.innerHTML = '<option value="">No compatible cases found</option>';
            } else {
                compatible.forEach(c => {
                    selCase.innerHTML += `<option value="${c.id}">${c.name} - ${formatPrice(c.price)}</option>`;
                });
            }
        }

        // Logic 4: Filter PSU by CPU + GPU Wattage Buffer
        function updatePSUs() {
            if (!selected.cpu || !selected.gpu) {
                selPsu.innerHTML = '<option value="">Select CPU and GPU First...</option>';
                selPsu.disabled = true;
                selected.psu = null;
                return;
            }

            selPsu.disabled = false;
            selPsu.innerHTML = '<option value="">Select Power Supply...</option>';
            
            const totalTdp = parseInt(selected.cpu.tdp) + parseInt(selected.gpu.tdp);
            const recommendedWattage = totalTdp * 1.2; // 20% buffer

            const compatible = powerSupplies.filter(p => p.wattage >= recommendedWattage);
            if (compatible.length === 0) {
                selPsu.innerHTML = `<option value="">No PSU found for >${Math.ceil(recommendedWattage)}W</option>`;
            } else {
                compatible.forEach(p => {
                    selPsu.innerHTML += `<option value="${p.id}">${p.name} (${p.wattage}W) - ${formatPrice(p.price)}</option>`;
                });
            }
        }

        // Price Update
        function updateTotalPrice() {
            let total = 0;
            if (selected.cpu) total += parseFloat(selected.cpu.price);
            if (selected.mobo) total += parseFloat(selected.mobo.price);
            if (selected.ram) total += parseFloat(selected.ram.price);
            if (selected.gpu) total += parseFloat(selected.gpu.price);
            if (selected.psu) total += parseFloat(selected.psu.price);
            if (selected.case) total += parseFloat(selected.case.price);

            document.getElementById('total-price').innerText = formatPrice(total);
        }

        // Event Listeners
        selCpu.addEventListener('change', (e) => {
            selected.cpu = cpus.find(c => c.id == e.target.value) || null;
            document.getElementById('cpu-info').innerText = selected.cpu ? `Socket: ${selected.cpu.socket} | TDP: ${selected.cpu.tdp}W` : '';
            updateMotherboards();
            updatePSUs();
            updateTotalPrice();
        });

        selMobo.addEventListener('change', (e) => {
            selected.mobo = motherboards.find(m => m.id == e.target.value) || null;
            let ff = '';
            if (selected.mobo) {
                if(selected.mobo.form_factor == 4) ff = 'E-ATX';
                else if(selected.mobo.form_factor == 3) ff = 'ATX';
                else if(selected.mobo.form_factor == 2) ff = 'Micro-ATX';
                else ff = 'Mini-ITX';
            }
            document.getElementById('mobo-info').innerText = selected.mobo ? `Socket: ${selected.mobo.socket} | RAM: ${selected.mobo.supported_ram_gen} | Size: ${ff}` : '';
            updateRam();
            updateCases();
            updateTotalPrice();
        });

        selRam.addEventListener('change', (e) => {
            selected.ram = rams.find(r => r.id == e.target.value) || null;
            document.getElementById('ram-info').innerText = selected.ram ? `Gen: ${selected.ram.generation} | ${selected.ram.capacity}GB @ ${selected.ram.speed}MHz` : '';
            updateTotalPrice();
        });

        selGpu.addEventListener('change', (e) => {
            selected.gpu = gpus.find(g => g.id == e.target.value) || null;
            document.getElementById('gpu-info').innerText = selected.gpu ? `TDP: ${selected.gpu.tdp}W | Length: ${selected.gpu.length_mm}mm` : '';
            updatePSUs();
            updateTotalPrice();
        });

        selPsu.addEventListener('change', (e) => {
            selected.psu = powerSupplies.find(p => p.id == e.target.value) || null;
            document.getElementById('psu-info').innerText = selected.psu ? `Wattage: ${selected.psu.wattage}W | ${selected.psu.form_factor}` : '';
            updateTotalPrice();
        });

        selCase.addEventListener('change', (e) => {
            selected.case = cases.find(c => c.id == e.target.value) || null;
            document.getElementById('case-info').innerText = selected.case ? `Max Mobo: ${selected.case.max_mobo_size >= 3 ? 'ATX' : 'Micro-ATX'} | Max GPU: ${selected.case.max_gpu_length}mm` : '';
            updateTotalPrice();
        });

        // Bootstrap
        initBaseDropdowns();

    </script>
</body>
</html>
