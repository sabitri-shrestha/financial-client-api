import React from 'react';
import { Navbar, Container, Nav } from 'react-bootstrap';
import { InertiaLink, usePage } from '@inertiajs/inertia-react';
import { Inertia } from '@inertiajs/inertia';

const Header = () => {

    const { user } = usePage().props;

    const handleLogout = () => {
        Inertia.post('/logout');
    };

    return (
        <Navbar bg="light" expand="lg">
            <Container>
                <Navbar.Brand as={InertiaLink} href="/" className="fw-bold">
                    Financial App
                </Navbar.Brand>
                <Navbar.Toggle aria-controls="basic-navbar-nav" />
                <Navbar.Collapse id="basic-navbar-nav">
                    <Nav className="ml-auto">
                        {user ? (
                            <>
                                <Nav.Link href="#" className="fw-bold">
                                    {user.name}
                                </Nav.Link>
                                <Nav.Link href="#" onClick={handleLogout} className="fw-bold">
                                    Logout
                                </Nav.Link>
                            </>
                        ) : (
                            <Nav.Link as={InertiaLink} href="/login" className="fw-bold">
                                Login
                            </Nav.Link>
                        )}
                    </Nav>
                </Navbar.Collapse>
            </Container>
        </Navbar>
    );
};

export default Header;
