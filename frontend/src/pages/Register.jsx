import React, { useState } from 'react';
import { useNavigate, Link } from 'react-router-dom';
import authService from '../services/authService';

const Register = () => {
    // J'ai ajouté le champ "role" avec la valeur par défaut "utilisateur"
    const [userData, setUserData] = useState({ name: '', email: '', password: '', password_confirmation: '', role: 'utilisateur' });
    const [error, setError] = useState(null);
    const navigate = useNavigate();

    const handleChange = (e) => {
        setUserData({...userData, [e.target.name]: e.target.value});
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        if(userData.password !== userData.password_confirmation) {
            return setError("Les mots de passe ne correspondent pas");
        }
        try {
            await authService.register(userData);
            navigate('/');
        } catch (err) {
            setError("Erreur lors de l'inscription (vérifiez que votre backend Laravel tourne correctement)");
        }
    };

    return (
        <div className="auth-container">
            <div className="auth-card">
                <h2>Inscription</h2>
                {error && <p className="error-message">{error}</p>}
                <form onSubmit={handleSubmit}>
                    <div className="form-group">
                        <label>Nom complet</label>
                        <input type="text" name="name" value={userData.name} onChange={handleChange} required />
                    </div>
                    <div className="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value={userData.email} onChange={handleChange} required />
                    </div>
                    
                    {/* Le sélecteur du type de compte ! */}
                    <div className="form-group">
                        <label>Type de compte</label>
                        <select name="role" value={userData.role} onChange={handleChange} style={{width: '100%', padding: '0.75rem', border: '1px solid #E5E7EB', borderRadius: '4px', fontSize: '1rem'}}>
                            <option value="utilisateur">Utilisateur standard</option>
                            <option value="admin">Administrateur</option>
                        </select>
                    </div>

                    <div className="form-group">
                        <label>Mot de passe</label>
                        <input type="password" name="password" value={userData.password} onChange={handleChange} required />
                    </div>
                    <div className="form-group">
                        <label>Confirmer le mot de passe</label>
                        <input type="password" name="password_confirmation" value={userData.password_confirmation} onChange={handleChange} required />
                    </div>
                    <button type="submit" className="btn-primary auth-btn">Créer un compte</button>
                </form>
                <p className="auth-switch">
                    Déjà un compte ? <Link to="/login">Se connecter</Link>
                </p>
            </div>
        </div>
    );
};

export default Register;
