import React, { useState } from 'react';
import { useForm } from 'react-hook-form';
import { Inertia } from '@inertiajs/inertia';

const Login = () => {
    const { handleSubmit, register } = useForm();
    const [errors, setErrors] = useState({});

    const onSubmit = async (data) => {
        try {
            const response = await Inertia.post('/login', data);

            if (response.errors) {
                setErrors(response.errors);
            } else {
                Inertia.visit('/');
            }
        } catch (error) {
            setErrors({ unexpected: 'An unexpected error occurred. Please try again later.' });
        }
    };

    return (
        <main className="form-signin w-100 m-auto">
            <form onSubmit={handleSubmit(onSubmit)}>
                <h1 className="h3 mb-3 fw-normal">Please sign in</h1>

                <div className="form-floating">
                    <input
                        type="email"
                        className="form-control"
                        placeholder="name@example.com"
                        {...register('email')}
                    />
                    <label htmlFor="floatingInput">Email address</label>
                </div>
                <div className="form-floating">
                    <input
                        type="password"
                        className="form-control"
                        placeholder="Password"
                        {...register('password')}
                    />
                    <label htmlFor="floatingPassword">Password</label>
                </div>

                <div className="text-start my-3">
                    <p>
                        Don't have an account?{' '}
                        <a href="/register" className="fw-bold">
                            Register here
                        </a>
                    </p>
                </div>
                <button className="btn btn-primary w-100 py-2" type="submit">
                    Sign in
                </button>
            </form>
        </main>
    );
};

export default Login;
