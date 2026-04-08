import api from './api';

const getAll = async () => {
    const response = await api.get('/categories');
    return response.data;
};

export default { getAll };
