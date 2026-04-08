import axios from 'axios';

// Configuration de l'URL de base pour communiquer avec Laravel
const api = axios.create({
    baseURL: 'http://localhost:8000/api', // Modifiez si votre serveur Laravel tourne sur un autre port
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
    }
});

// Cet intercepteur permet d'ajouter le Token de connexion à chaque requête automatiquement
api.interceptors.request.use(
    (config) => {
        const token = localStorage.getItem('token');
        if (token) {
            config.headers.Authorization = `Bearer ${token}`;
        }
        return config;
    },
    (error) => Promise.reject(error)
);

export default api;
