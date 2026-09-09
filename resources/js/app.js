import './bootstrap';

document.documentElement.classList.toggle('dark', localStorage.getItem('docs-theme') === 'dark');

document.addEventListener('click', (event) => {
    const target = event.target.closest('[data-theme-toggle]');
    if (target) {
        const dark = !document.documentElement.classList.contains('dark');
        document.documentElement.classList.toggle('dark', dark);
        localStorage.setItem('docs-theme', dark ? 'dark' : 'light');
    }

    const mobile = event.target.closest('[data-mobile-toggle]');
    if (mobile) document.querySelector('[data-mobile-nav]')?.classList.toggle('hidden');

    const copy = event.target.closest('[data-copy-code]');
    if (copy) {
        const code = copy.parentElement?.querySelector('code')?.innerText ?? '';
        navigator.clipboard?.writeText(code);
        const old = copy.innerText;
        copy.innerText = 'Copied';
        setTimeout(() => copy.innerText = old, 1200);
    }
});
