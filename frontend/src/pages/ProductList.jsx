import React, { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import productService from '../services/productService';

const ProductList = () => {
    const [products, setProducts] = useState([]);
    
    useEffect(() => {
        loadProducts();
    }, []);

    const loadProducts = async () => {
        try {
            // Remplacez ce mock par l'appel API réel une fois connecté
            // const data = await productService.getAll();
            // setProducts(data);
            
            setProducts([
                { id: 1, name: 'Produit A', price: 50, quantity: 100 },
                { id: 2, name: 'Produit B', price: 30, quantity: 5 }
            ]);
        } catch(err) {
            console.error(err);
        }
    };

    const handleDelete = async (id) => {
        if(window.confirm("Supprimer ce produit ?")) {
            // await productService.remove(id);
            setProducts(products.filter(p => p.id !== id));
        }
    };

    return (
        <div className="page-container">
            <div className="page-header">
                <h1>Liste des Produits</h1>
                <Link to="/products/new" className="btn-primary">+ Ajouter</Link>
            </div>
            <table className="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prix</th>
                        <th>Quantité</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {products.map(p => (
                        <tr key={p.id}>
                            <td>{p.id}</td>
                            <td>{p.name}</td>
                            <td>{p.price} €</td>
                            <td>
                                <span className={p.quantity < 10 ? 'badge-danger' : 'badge-success'}>
                                    {p.quantity}
                                </span>
                            </td>
                            <td>
                                <button className="btn-edit">Modifier</button>
                                <button className="btn-delete" onClick={() => handleDelete(p.id)}>Supprimer</button>
                            </td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    );
};

export default ProductList;
