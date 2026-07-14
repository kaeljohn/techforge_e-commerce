<div id="global-notification" data-lenis-prevent class="fixed inset-0 bg-black/80 backdrop-blur-md z-[200] opacity-0 pointer-events-none transition-all duration-300 flex items-center justify-center p-4">
    <div id="notification-box" class="liquid-glass-heavy w-full max-w-md p-6 rounded-2xl border border-white/10 shadow-2xl flex flex-col transform scale-95 transition-transform duration-300 bg-[#050505]">
        
        <div class="flex items-center gap-3 mb-4">
            <div id="notification-icon" class="w-10 h-10 rounded-full bg-primary/20 text-primary flex items-center justify-center shrink-0">
                <i class="ph-fill ph-warning-circle text-xl"></i>
            </div>
            <h3 id="notification-title" class="text-xl font-bold text-white">Notification</h3>
        </div>
        
        <p id="notification-message" class="text-gray-400 text-sm mb-6 leading-relaxed">
            Message goes here.
        </p>
        
        <div class="flex items-center justify-end gap-3 mt-auto" id="notification-actions">
            <!-- Buttons injected by JS -->
        </div>
    </div>
</div>

<script>
    window.showNotification = function(title, message, type = 'alert', onConfirm = null) {
        const modal = document.getElementById('global-notification');
        const box = document.getElementById('notification-box');
        
        document.getElementById('notification-title').innerText = title;
        document.getElementById('notification-message').innerText = message;
        
        const actionsContainer = document.getElementById('notification-actions');
        actionsContainer.innerHTML = '';
        
        // Handle closing
        const close = () => {
            modal.classList.add('opacity-0', 'pointer-events-none');
            box.classList.add('scale-95');
        };

        if (type === 'confirm') {
            const cancelBtn = document.createElement('button');
            cancelBtn.className = "px-4 py-2 rounded-lg font-bold text-sm text-gray-400 hover:text-white hover:bg-white/5 transition-colors";
            cancelBtn.innerText = "Cancel";
            cancelBtn.onclick = close;
            
            const confirmBtn = document.createElement('button');
            confirmBtn.className = "px-4 py-2 rounded-lg font-bold text-sm bg-primary text-white hover:bg-primary-dark transition-colors shadow-lg shadow-primary/20";
            confirmBtn.innerText = "Proceed";
            confirmBtn.onclick = () => {
                close();
                if(onConfirm) onConfirm();
            };
            
            actionsContainer.appendChild(cancelBtn);
            actionsContainer.appendChild(confirmBtn);
        } else {
            const okBtn = document.createElement('button');
            okBtn.className = "px-4 py-2 rounded-lg font-bold text-sm bg-primary text-white hover:bg-primary-dark transition-colors shadow-lg shadow-primary/20";
            okBtn.innerText = "OK";
            okBtn.onclick = close;
            actionsContainer.appendChild(okBtn);
        }
        
        modal.classList.remove('opacity-0', 'pointer-events-none');
        box.classList.remove('scale-95');
    };
</script>
