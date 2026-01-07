import './bootstrap';
import * as bootstrap from 'bootstrap';

// Import SweetAlert2
import Swal from 'sweetalert2';
window.Swal = Swal;

// Import Leaflet
import L from 'leaflet';
import 'leaflet/dist/leaflet.css';

// Fix Leaflet marker icons
import icon from 'leaflet/dist/images/marker-icon.png';
import iconShadow from 'leaflet/dist/images/marker-shadow.png';
import iconRetina from 'leaflet/dist/images/marker-icon-2x.png';

import './auth-modals';

let DefaultIcon = L.icon({
    iconUrl: icon,
    shadowUrl: iconShadow,
    iconRetinaUrl: iconRetina,
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41]
});

L.Marker.prototype.options.icon = DefaultIcon;
window.L = L;

// ========================================
// DARK MODE
// ========================================

class DarkMode {
    constructor() {
        this.theme = localStorage.getItem('theme') || 'light';
        this.init();
    }

    init() {
        this.setTheme(this.theme);
        this.attachEventListeners();
    }

    setTheme(theme) {
        this.theme = theme;
        document.documentElement.setAttribute('data-theme', theme);
        localStorage.setItem('theme', theme);
        this.updateButton();
    }

    toggleTheme() {
        const newTheme = this.theme === 'light' ? 'dark' : 'light';
        this.setTheme(newTheme);
    }

    updateButton() {
        const btn = document.getElementById('darkModeToggle');
        if (!btn) return;

        const icon = btn.querySelector('i');
        const text = btn.querySelector('.toggle-text');
        
        if (this.theme === 'dark') {
            icon.className = 'fas fa-sun';
            if (text) text.textContent = 'Light';
        } else {
            icon.className = 'fas fa-moon';
            if (text) text.textContent = 'Dark';
        }
    }

    attachEventListeners() {
        const btn = document.getElementById('darkModeToggle');
        if (btn) {
            btn.addEventListener('click', () => this.toggleTheme());
        }
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    window.darkMode = new DarkMode();
});

// Initialize Bootstrap tooltips
document.addEventListener('DOMContentLoaded', function() {
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
});

// Leaflet Map Setup
window.initMap = function(elementId, camps, options = {}) {
    const mapElement = document.getElementById(elementId);
    
    if (!mapElement) {
        console.error('Map element not found:', elementId);
        return null;
    }

    const map = L.map(elementId).setView(
        options.center || [4.2105, 101.9758],
        options.zoom || 7
    );

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        maxZoom: 19
    }).addTo(map);

    if (camps && camps.length > 0) {
        camps.forEach(camp => {
            const marker = L.marker([camp.latitude, camp.longitude]);
            
            const popupContent = `
                <div class="camp-popup">
                    <h6 class="mb-2">${camp.name}</h6>
                    <p class="mb-1 small text-muted">${camp.state}</p>
                    ${camp.image ? `<img src="/storage/${camp.image}" alt="${camp.name}" class="img-fluid mb-2" style="max-height: 100px; width: 100%;">` : ''}
                    <a href="/camps/${camp.id}" class="btn btn-sm btn-primary mt-2">Lihat Detail</a>
                </div>
            `;
            
            marker.bindPopup(popupContent);
            marker.addTo(map);
        });

        if (camps.length > 1) {
            const bounds = L.latLngBounds(camps.map(c => [c.latitude, c.longitude]));
            map.fitBounds(bounds, { padding: [50, 50] });
        }
    }

    setTimeout(() => {
        map.invalidateSize();
    }, 100);

    return map;
};

// SweetAlert2 Helper Functions
window.showSuccess = function(title, text = '') {
    Swal.fire({
        icon: 'success',
        title: title,
        text: text,
        confirmButtonColor: '#2c5f2d',
        confirmButtonText: 'OK'
    });
};

window.showError = function(title, text = '') {
    Swal.fire({
        icon: 'error',
        title: title,
        text: text,
        confirmButtonColor: '#dc3545',
        confirmButtonText: 'OK'
    });
};

window.showConfirm = function(title, text, callback) {
    Swal.fire({
        title: title,
        text: text,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Pasti!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed && callback) {
            callback();
        }
    });
};