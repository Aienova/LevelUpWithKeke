import React, { useState, useEffect } from 'react';
import { useParams } from 'react-router-dom';

const DataUpdater = () => {
  const { name } = useParams();
  const [message, setMessage] = useState("");
  const data = { "test": "OK" };
  const jsonPath = `https://127.0.0.1:8000/api/data/get/${name}/1/all`;

  

  useEffect(() => {
    const updateJson = async () => {
      try {
        const response = await fetch('http://localhost/processData.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
          },
          body: JSON.stringify(data),
        });

        if (!response.ok) {
          throw new Error('Network response was not ok');
        }

        const result = await response.json();
        setMessage(result.message);
        console.log(result.message);
      } catch (error) {
        console.error('Error updating JSON file:', error);
        setMessage('Error updating JSON file');
      }
    };

    updateJson();
  }, [jsonPath, data]);

  return (
    <div>
      <h2>{message || 'Updating JSON...'}</h2>
    </div>
  );
};

export default DataUpdater;
