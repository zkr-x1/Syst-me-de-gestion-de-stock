import React from 'react';

const Dashboard = () => {
    return (
        <div className="page-container">
            <h1>Tableau de Bord</h1>
            <div className="dashboard-grid">
                <div className="card">
                    <h3>Produits en Stock</h3>
                    <p className="card-value">120</p>
                </div>
                <div className="card">
                    <h3>Catégories Actives</h3>
                    <p className="card-value">8</p>
                </div>
                <div className="card warning">
                    <h3>Alertes Stock</h3>
                    <p className="card-value">3</p>
                </div>
            </div>
        </div>
    );
};

export default Dashboard;
