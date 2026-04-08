import React from 'react';
import { Link, useNavigate } from 'react-router-dom';
import authService from '../services/authService';

const Navbar = () => {
    const navigate = useNavigate();
    const isAuthenticated = authService.isAuthenticated();

    const handleLogout = async () => {
        await authService.logout();
        navigate('/login');
    };

    if (!isAuthenticated) return null; // Ne pas afficher la navbar sur login/register

    return (
        <nav className="navbar">
            <div className="navbar-brand">
                <Link to="/">📦 GestionStock</Link>
            </div>
            <ul className="navbar-links">
                <li><Link to="/">Dashboard</Link></li>
                <li><Link to="/products">Produits</Link></li>
                <li><Link to="/categories">Catégories</Link></li>
                <li><Link to="/profile">Profil</Link></li>
                <li><button onClick={handleLogout} className="btn-logout">Déconnexion</button></li>
            </ul>
        </nav>
    );
};

export default Navbar;
