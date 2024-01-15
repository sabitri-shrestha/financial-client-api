import React, { useState } from 'react';
import { useForm } from 'react-hook-form';
import { Inertia } from '@inertiajs/inertia';
import { Container, Row, Col, Form, Button } from 'react-bootstrap';

const Register = ({errors}) => {
    const { handleSubmit, register } = useForm();
    const onSubmit = async (data) => {
        Inertia.post('/register', data);
    };

    return (
        <main className="form-signin w-100 m-auto">
            <form onSubmit={handleSubmit(onSubmit)}>
                <h1 className="h3 mb-3 fw-normal">Please register</h1>
                <div className="form-floating">
                    <input type="text" className="form-control" placeholder="name" {...register('name')}/>
                    <label htmlFor="floatingInput">Name</label>
                </div>
                <div className="form-floating">
                    <input type="email" className="form-control" placeholder="name@example.com" {...register('email')}/>
                    <label htmlFor="floatingInput">Email address</label>
                </div>
                <div className="form-floating">
                    <input type="password" className="form-control" placeholder="Password" {...register('password')}/>
                    <label htmlFor="floatingPassword">Password</label>
                </div>
                <div className="form-floating">
                    <input type="password" className="form-control" placeholder="Confirm Password" {...register('confirmPassword')}/>
                    <label htmlFor="floatingPassword">Confirm Password</label>
                </div>
                {Object.keys(errors).length > 0 && (
                    <div className="alert alert-danger">
                        <ul>
                            {Object.values(errors).map((error, index) => (
                                <li key={index}>{error}</li>
                            ))}
                        </ul>
                    </div>
                )}
                <button className="btn btn-primary w-100 py-2" type="submit">Register</button>
            </form>
        </main>
    );
};

export default Register;
