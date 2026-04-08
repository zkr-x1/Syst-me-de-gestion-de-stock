import api from './api';

const getAll = async () => {
    const response = await api.get('/products');
    return response.data; // Assurez-vous que l'API renvoie les données directement ou adaptez (ex: response.data.data)
};

const getById = async (id) => {
    const response = await api.get(`/products/${id}`);
    return response.data;
};

const create = async (data) => {
    const response = await api.post('/products', data);
    return response.data;
};

const update = async (id, data) => {
    const response = await api.put(`/products/${id}`, data);
    return response.data;
};

const remove = async (id) => {
    const response = await api.delete(`/products/${id}`);
    return response.data;
};

export default { getAll, getById, create, update, remove };
