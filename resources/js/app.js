import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.data('themeSwitcher', () => ({
    dark: false,

    init() {
        const savedTheme = localStorage.getItem('theme');

        if (savedTheme === 'dark') {
            this.dark = true;
        } else if (savedTheme === 'light') {
            this.dark = false;
        } else {
            this.dark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        }

        this.applyTheme();
    },

    toggle() {
        this.dark = !this.dark;
        localStorage.setItem('theme', this.dark ? 'dark' : 'light');
        this.applyTheme();
    },

    applyTheme() {
        document.documentElement.classList.toggle('dark', this.dark);
    }
}));

Alpine.start();