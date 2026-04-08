import api from './api';

const login = async (credentials) => {
    const response = await api.post('/login', credentials);
    if (response.data.token) {
        localStorage.setItem('token', response.data.token);
        localStorage.setItem('user', JSON.stringify(response.data.user));
    }
    return response.data;
};

const register = async (userData) => {
    const response = await api.post('/register', userData);
    if (response.data.token) {
        localStorage.setItem('token', response.data.token);
        localStorage.setItem('user', JSON.stringify(response.data.user));
    }
    return response.data;
};

const logout = async () => {
    try {
        await api.post('/logout'); 
    } catch(e) {
        console.error('Erreur lors du logout côté serveur');
    }
    localStorage.removeItem('token');
    localStorage.removeItem('user');
};

const getCurrentUser = () => {
    return JSON.parse(localStorage.getItem('user'));
};

const isAuthenticated = () => {
    return !!localStorage.getItem('token');
};

export default { login, register, logout, getCurrentUser, isAuthenticated };
