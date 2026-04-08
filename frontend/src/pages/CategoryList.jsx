import React, { useState } from 'react';

const CategoryList = () => {
    const [categories, setCategories] = useState([
        { id: 1, name: 'Électronique' },
        { id: 2, name: 'Vêtements' }
    ]);

    return (
        <div className="page-container">
            <div className="page-header">
                <h1>Catégories</h1>
                <button className="btn-primary">+ Ajouter Catégorie</button>
            </div>
            <ul className="list-group">
                {categories.map(c => (
                    <li key={c.id} className="list-item">
                        {c.name}
                        <button className="btn-edit sm">Éditer</button>
                    </li>
                ))}
            </ul>
        </div>
    );
};

export default CategoryList;
