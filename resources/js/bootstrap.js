import '../css/app.css';

// Bootstrap CSS
import 'bootstrap/dist/css/bootstrap.min.css';

// Import bootstrap JS sebagai module
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap; // <-- WAJIB!!

console.log('Bootstrap injected:', window.bootstrap);
