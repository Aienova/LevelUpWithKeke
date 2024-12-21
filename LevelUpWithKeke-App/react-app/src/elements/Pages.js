import React, { useState } from 'react';

const Pages = () => {

  const [pagedata] = useState([]);

  const [formData, setFormData] = useState({
    title: pagedata.title,
  });

  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setFormData((prevData) => ({
      ...prevData,
      [name]: value,
    }));
  };

  const handleSubmit = async (e) => {
   e.preventDefault();

    try {
      const response = await fetch('https://127.0.0.1:8000/api/data/create/page', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(formData),
      });


      if (!response.ok) {
        throw new Error('Data not saved');
      }

      // Optionally, handle success (e.g., show a success message)
      console.log('Data saved successfully');
    } catch (error) {
      console.error('Error saving data:', error);
    }
  };

  return (

      <form onSubmit={handleSubmit}>
              <h1>Créer une page:</h1>

      <label>
        Titre:
        <input
          type="text"
          name="title"
          onChange={handleInputChange}
        />
      </label>
      <br />
      
      <button type="submit">Submit</button>
    </form>

  );
}

export default Pages