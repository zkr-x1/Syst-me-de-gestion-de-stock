import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';

const ProductForm = () => {
    const [product, setProduct] = useState({ name: '', price: '', quantity: '' });
    const navigate = useNavigate();

    const handleSubmit = async (e) => {
        e.preventDefault();
        // await productService.create(product);
        console.log('Produit enregistré : ', product);
        navigate('/products');
    };

    return (
        <div className="page-container">
            <h1>Ajouter un Produit</h1>
            <div className="form-card">
                <form onSubmit={handleSubmit}>
                    <div className="form-group">
                        <label>Nom du produit</label>
                        <input type="text" value={product.name} onChange={(e) => setProduct({...product, name: e.target.value})} required />
                    </div>
                    <div className="form-group">
                        <label>Prix (€)</label>
                        <input type="number" value={product.price} onChange={(e) => setProduct({...product, price: e.target.value})} required />
                    </div>
                    <div className="form-group">
                        <label>Quantité</label>
                        <input type="number" value={product.quantity} onChange={(e) => setProduct({...product, quantity: e.target.value})} required />
                    </div>
                    <button type="submit" className="btn-primary">Enregistrer</button>
                </form>
            </div>
        </div>
    );
};

export default ProductForm;
