import React, { useState, useEffect } from 'react';


const Theme = () => {

  /*----API ---*/

  const [userdata, setData] = useState([]);
  const [editableValue, setEditableValue] = useState('');
  
  /*
  useEffect(() => {
    const fetchData = async (e) => {

      try {
        const response = await fetch('https://127.0.0.1:8000/api/data/get/user/1/login');
        const result = await response.json();
        setData(result);
        setEditableValue(result);
      } catch (error) {
        console.error('Error fetching data:', error);
      }
    };

    fetchData();
  }, []); */


  /*-----API-----*/



  /*----------SAVE DATA -------------*/

  const [formData, setFormData] = useState({
    login: userdata.login,
  });

  const handleInputChange = (e) => {
    setEditableValue(e.target.value);
    const { name, value } = e.target;
    setFormData((prevData) => ({
      ...prevData,
      [name]: value,
    }));
  };

  const handleSubmit = async (e) => {
   e.preventDefault();

    try {
      const response = await fetch('https://127.0.0.1:8000/api/data/edit/styles/color/'+editableValue, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(formData),
      });


      /*
      const response2 = await fetch('https://127.0.0.1:8000/api/data/get/user/1/login');
      const result = await response2.json();
      setData(result);
      setEditableValue(result); 

      if (!response.ok && !response2.ok) {
        throw new Error('Data not saved');
      }*/

      // Optionally, handle success (e.g., show a success message)
      console.log('Data saved successfully');
    } catch (error) {
      console.error('Error saving data:', error);
    }
  };

  return (

      <form onSubmit={handleSubmit}>
              <h1>Couleur du site web:</h1>
      <label>
        Couleur du texte:
        <input
          type="text"
          name="color"
          onChange={handleInputChange}
        />
      </label>
      <br />
      
      <button type="submit">Submit</button>
    </form>

  );
}

export default Theme