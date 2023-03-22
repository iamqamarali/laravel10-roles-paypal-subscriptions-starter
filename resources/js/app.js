
import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.axios.defaults.headers.common['csrf-token'] = document.head.querySelector('meta[name="csrf-token"]').content;
