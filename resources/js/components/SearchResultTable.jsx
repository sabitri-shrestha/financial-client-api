import React from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';

const SearchResultTable = ({ data }) => {
    return (
        <table className="table table-bordered">
            <tbody>
            {Object.entries(data).map(([key, value]) => {
                // Check if the value is binary and skip the row
                if (typeof value === 'boolean') {
                    return null;
                }
                if (typeof value === 'boolean') {
                    return null;
                }

                return (
                    <tr key={key}>
                        <td>{formatKey(key)}</td>
                        <td>{key === 'image' ? <img src={value} alt={key} /> : value}</td>
                    </tr>
                );
            })}
            </tbody>
        </table>
    );
};

// Helper function to format keys with spaces and capitalization
const formatKey = (key) => {
    return key
        .replace(/([A-Z])/g, ' $1') // Add space before capital letters
        .replace(/^./, (str) => str.toUpperCase()); // Capitalize the first letter
};

export default SearchResultTable;
