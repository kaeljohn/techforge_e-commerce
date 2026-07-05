class ConfiguratorEngine {
    constructor(allComponents = [], initialBuild = {}) {
        this.allComponents = allComponents;
        this.currentBuild = {
            'Processor': initialBuild.Processor || null,
            'Video Card': initialBuild['Video Card'] || null,
            'Memory': initialBuild.Memory || null,
            'Primary Storage': initialBuild['Primary Storage'] || null,
            'Motherboard': initialBuild.Motherboard || null,
            'Power Supply': initialBuild['Power Supply'] || null,
            'Case': initialBuild.Case || null,
        };
        this.listeners = [];
    }

    subscribe(callback) {
        this.listeners.push(callback);
    }

    notify() {
        this.listeners.forEach(cb => cb(this.currentBuild));
    }

    getComponent(category) {
        return this.currentBuild[category];
    }

    setComponent(category, component) {
        this.currentBuild[category] = component;
        this.notify();
    }

    removeComponent(category) {
        this.currentBuild[category] = null;
        this.notify();
    }

    calculateTotal() {
        let total = 0;
        Object.values(this.currentBuild).forEach(c => {
            if (c && c.price) total += parseFloat(c.price);
        });
        return total;
    }

    getRequiredWattage() {
        const cpuTdp = this.currentBuild['Processor'] ? parseInt(this.currentBuild['Processor'].tdp || 0) : 0;
        const gpuTdp = this.currentBuild['Video Card'] ? parseInt(this.currentBuild['Video Card'].tdp || 0) : 0;
        return (cpuTdp + gpuTdp) * 1.2;
    }

    checkCompatibility(component, category) {
        let compatible = true;
        let reason = '';

        if (category === 'Processor' && this.currentBuild['Motherboard']) {
            if (component.socket !== this.currentBuild['Motherboard'].socket) {
                compatible = false; reason = 'Requires ' + this.currentBuild['Motherboard'].socket + ' Socket';
            }
        } else if (category === 'Motherboard') {
            if (this.currentBuild['Processor'] && component.socket !== this.currentBuild['Processor'].socket) {
                compatible = false; reason = 'Requires ' + this.currentBuild['Processor'].socket + ' CPU';
            }
            if (this.currentBuild['Memory'] && component.supported_ram_gen !== this.currentBuild['Memory'].generation) {
                compatible = false; reason = 'Requires ' + this.currentBuild['Memory'].generation + ' RAM';
            }
            if (this.currentBuild['Case'] && parseInt(component.form_factor) > parseInt(this.currentBuild['Case'].max_mobo_size)) {
                compatible = false; reason = 'Too large for current Case';
            }
        } else if (category === 'Memory' && this.currentBuild['Motherboard']) {
            if (component.generation !== this.currentBuild['Motherboard'].supported_ram_gen) {
                compatible = false; reason = 'Requires ' + this.currentBuild['Motherboard'].supported_ram_gen;
            }
        } else if (category === 'Case' && this.currentBuild['Motherboard']) {
            if (parseInt(component.max_mobo_size) < parseInt(this.currentBuild['Motherboard'].form_factor)) {
                compatible = false; reason = 'Does not fit motherboard';
            }
        } else if (category === 'Power Supply') {
            const requiredWattage = this.getRequiredWattage();
            if (parseInt(component.wattage) < requiredWattage) {
                compatible = false; reason = 'Requires at least ' + Math.ceil(requiredWattage) + 'W';
            }
        }

        return { compatible, reason };
    }

    getConflictsIfSelected(category, component) {
        let conflicts = [];
        
        if (category === 'Processor' && this.currentBuild['Motherboard']) {
            if (component.socket !== this.currentBuild['Motherboard'].socket) {
                conflicts.push('Motherboard');
                conflicts.push('Memory');
            }
        } else if (category === 'Motherboard') {
            if (this.currentBuild['Processor'] && component.socket !== this.currentBuild['Processor'].socket) {
                conflicts.push('Processor');
            }
            if (this.currentBuild['Memory'] && component.supported_ram_gen !== this.currentBuild['Memory'].generation) {
                conflicts.push('Memory');
            }
            if (this.currentBuild['Case'] && parseInt(component.form_factor) > parseInt(this.currentBuild['Case'].max_mobo_size)) {
                conflicts.push('Case');
            }
        }
        
        return conflicts;
    }

    getCartPayload() {
        return JSON.stringify(this.currentBuild);
    }
}
