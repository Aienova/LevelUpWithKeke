
import React, { useState, useEffect } from 'react';
import { submitPopup } from '../utils/JQuery/submitPopup.js';
import { calendar } from '../utils/JQuery/calendar.js';
import { showerScript } from '../utils/JQuery/show.js';
import $ from 'jquery';

const Newsletter = () => {

  // Calculate today's date in the correct format
const today = new Date().toISOString().slice(0, 16);
  const [message, setMessage] = useState('');
  const [formData, setFormData] = useState({
    firstname: '',
    surname: '',
    location: '',
    email: '',
    telephone: '',
    bookingDate: '',
    performance1: false,
    performance2: false,
    performance3: false,
    performance4: false,
  });

  useEffect(() => {
    submitPopup();
    calendar();
    showerScript();
  
    // Cleanup function to remove event listeners if necessary
    return () => {
      $('#booking-form').off('submit');
    };
  }, []);

  const handleInputChange = (e) => {
    const { name, value, type, checked } = e.target;
    setFormData({
      ...formData,
      [name]: type === 'checkbox' ? checked : value,
    });
  };

  const submitForm = async (e) => {
    e.preventDefault(); // Prevent the default form submission

    console.log(formData);

    try {
      const response = await fetch('https://127.0.0.1:8000/api/data/submit/booking', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(formData),
      });

      if (response.ok) {
        const data = await response.json();
        setMessage("Votre réservation a bien été enregistrée");

      } else {
        console.error('Failed to submit booking');
        setMessage("Erreur lors de la réservation");
      }
    } catch (error) {
      console.error('Error submitting booking:', error);
    }
  };

  return (
    <React.Fragment>
      <section className="full-h spacer" id="newsletter">


        <div id="newsletter-form" classname="flexible">

          <div id="newsletter-infos" className="full-w">

            <form className="central-text">

              <div  className="padder">

              <h4 className="uppercaser">Envie de recevoir tout mes conseils pour level up ? 
              inscrivez-vous à la newsletter ! </h4>

                          <input
                            type="text"
                            placeholder="Prénom"
                            name="firstname"
                            value={formData.firstname}
                            onChange={handleInputChange}
                        />


                          <input
                            type="submit"
                            id="bookingSubmitFormButton"
                            name="booking"
                            value="Je m'inscris"
                          />

                </div>
            </form>


          </div>





        </div>


      </section>
    </React.Fragment>
  );
};

export default Newsletter;
