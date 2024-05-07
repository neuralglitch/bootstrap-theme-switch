import * as bootstrap from 'bootstrap';

document.addEventListener('DOMContentLoaded', function() {
    const htmlElement = document.documentElement
    const themeSelector = document.getElementById('themeSelector');
    const themeButton = document.getElementById('themeButton');
    const isSystemTheme = htmlElement.getAttribute('data-system-theme');
    const buttonColors = { 'light': 'dark', 'dark': 'light' };
    let currentTheme;

    if (isSystemTheme === '1' && isSystemAvailable()) {
        currentTheme = 'system';
    } else {
        currentTheme = htmlElement.getAttribute('data-bs-theme');
    }

    if (themeButton !== null) {
        localStorage.setItem('isButtonVariantDefined', isButtonVariantDefined());
        updateButton(currentTheme);
        themeButton.addEventListener('click', function () {
            const current = this.querySelector(".d-inline-block");
            const theme = current.dataset.next;
            setTheme(theme);
            updateButton(theme);
        });
    }

    if (themeSelector !== null) {
        updateSelect(currentTheme);
        themeSelector.addEventListener('change', function () {
            const theme = this.value;
            setTheme(theme);
            updateSelect(theme);
        });
    }

    function updateButton(theme) {
        if (localStorage.getItem('isButtonVariantDefined') === 'false') {
            let color;
            if (theme === 'system') {
                color = getSystemTheme();
            } else {
                color = theme;
            }
            Object.keys(buttonColors).forEach(function(key) {
                if (color === key) {
                    themeButton.classList.add('btn-outline-' + buttonColors[key]);
                    themeButton.classList.remove('btn-outline-' + key);
                } else {
                    themeButton.classList.remove('btn-outline-' + buttonColors[key]);
                    themeButton.classList.add('btn-outline-' + key);
                }
            });
        }
        const spans= themeButton.getElementsByTagName('span');
        for (let i = 0; i < spans.length; i++) {
            if (spans[i].dataset.mode === theme) {
                spans[i].classList.add('d-inline-block');
                spans[i].classList.remove('d-none');
            } else {
                spans[i].classList.remove('d-inline-block');
                spans[i].classList.add('d-none');
            }
        }
        bootstrap.Tooltip.getInstance("#themeButton").hide();
    }

    function updateSelect(theme) {
        for (let i = 0; i < themeSelector.options.length; i++) {
            if (themeSelector.options[i].value === theme) {
                themeSelector.options[i].selected = true;
                themeSelector.options[i].setAttribute('selected', true);
            } else {
                themeSelector.options[i].selected = false;
                themeSelector.options[i].removeAttribute('selected');
            }
        }
    }

    function setTheme(selectedTheme) {
        let theme, isSystemTheme;
        if (selectedTheme === 'system') {
            theme = getSystemTheme();
            isSystemTheme = '1';
        } else {
            theme = selectedTheme;
            isSystemTheme = '0';
        }

        htmlElement.setAttribute('data-bs-theme', theme);
        htmlElement.setAttribute('data-system-theme', isSystemTheme);

        fetch('/_bootstrap-theme-switch', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ theme: theme, isSystemTheme: isSystemTheme })
        })
            .then(response => response.text())
            .then(data => console.log(data))
            .catch(error => console.error('Error:', error));
    }

    function isSystemAvailable() {
        if (themeButton !== null) {
            const spans= themeButton.getElementsByTagName('span');
            return spans.length > 2;
        } else if (themeSelector !== null) {
            return themeSelector.options.length > 2;
        }
        return false;
    }

    function isButtonVariantDefined() {
        const classes = themeButton.classList;
        let hasBtnPrefix = false;
        for (let i = 0; i < classes.length; i++) {
            if (classes[i].startsWith('btn-')) {
                hasBtnPrefix = true;
                break;
            }
        }
        return hasBtnPrefix;
    }

    function getSystemTheme() {
        return window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'
    }
});