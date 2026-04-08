import React from 'react';
import authService from '../services/authService';

const Profile = () => {
    const user = authService.getCurrentUser() || { name: 'Admin', email: 'admin@test.com' };

    return (
        <div className="page-container">
            <h1>Profil Utilisateur</h1>
            <div className="form-card">
                <div className="profile-info">
                    <p><strong>Nom :</strong> {user.name}</p>
                    <p><strong>Email :</strong> {user.email}</p>
                </div>
            </div>
        </div>
    );
};

export default Profile;
