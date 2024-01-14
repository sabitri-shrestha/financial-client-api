import React, { useState, useEffect } from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';
import { Container, Form, Button, Dropdown } from 'react-bootstrap';
import CompanyQuoteTable from '@/components/SearchResultTable';
import Header from '@/components/Header';

const Index = () => {
    const [searchResults, setSearchResults] = useState([]);
    const [searchQuery, setSearchQuery] = useState('');
    const [selectedType, setSelectedType] = useState('profile'); // Default to profile
    const [errors, setErrors] = useState('');

    const handleSearch = async (e) => {
        e.preventDefault();

        try {
            const response = await fetch(`/financial-app/company-${selectedType}/${searchQuery}`);
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const data = await response.json();
            setSearchResults([data]);
        } catch (error) {
            setErrors('Error fetching data from the server');
        }
    };

    return (
        <main>
            <Header />
            <section className="py-5 text-center container">
                <div className="row py-lg-5">
                    <div className="col-lg-6 col-md-8 mx-auto">
                        <h1 className="fw-light">Search Company</h1>

                        <Form onSubmit={handleSearch}>
                            <div className="input-group mb-3">
                                <Dropdown>
                                    <Dropdown.Toggle variant="secondary" id="dropdown-basic">
                                        {selectedType}
                                    </Dropdown.Toggle>

                                    <Dropdown.Menu>
                                        <Dropdown.Item onClick={() => setSelectedType('profile')}>Profile</Dropdown.Item>
                                        <Dropdown.Item onClick={() => setSelectedType('quote')}>Quote</Dropdown.Item>
                                    </Dropdown.Menu>
                                </Dropdown>

                                <Form.Control
                                    type="text"
                                    placeholder={`Enter company symbol`}
                                    value={searchQuery}
                                    onChange={(e) => setSearchQuery(e.target.value)}
                                />
                                <Button variant="primary" type="submit">
                                    Search
                                </Button>
                            </div>
                        </Form>
                        {searchResults.length > 0 && (
                            <div>
                                <h2>Search Results</h2>
                                <CompanyQuoteTable data={searchResults[0][0]} />
                            </div>
                        )}
                    </div>
                </div>
            </section>
        </main>
    );
};

export default Index;
