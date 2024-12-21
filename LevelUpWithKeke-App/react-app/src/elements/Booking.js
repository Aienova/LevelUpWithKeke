
import React, { useState, useEffect } from 'react';
import { submitPopup } from '../utils/JQuery/submitPopup';
import { calendar } from '../utils/JQuery/calendar';
import { showerScript } from '../utils/JQuery/show.js';
import $ from 'jquery';

const Booking = () => {

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
      <section className="full-h" id="bookings">
        <div className="full centralizer central-text">
          <h2>Réservation</h2>
          <div className="flexible mobileblock organizer">
            <form id="booking-form" onSubmit={submitForm}>
              <div id="booking-popup" className="popup">
                <div className="padder">
                  <div id="booking-message">{message}</div>
                </div>
              </div>
              <div className="padder">
                <h3>Veuillez remplir ce formulaire pour réserver votre séance</h3>
                <label>
                  Prénom
                  <input
                    type="text"
                    placeholder="Prénom"
                    name="firstname"
                    value={formData.firstname}
                    onChange={handleInputChange}
                  />
                </label>
                <label>
                  Nom
                  <input
                    type="text"
                    placeholder="Nom"
                    name="surname"
                    value={formData.surname}
                    onChange={handleInputChange}
                  />
                </label>
                <label>
                  Adresse
                  <input
                    type="text"
                    placeholder="Adresse proche de Reuilmalmaison"
                    name="location"
                    value={formData.location}
                    onChange={handleInputChange}
                  />
                </label>
                <label>
                  E-mail
                  <input
                    type="text"
                    placeholder="ex : xxxx@gmail.com"
                    name="email"
                    value={formData.email}
                    onChange={handleInputChange}
                  />
                </label>
                <label>
                  Téléphone
                  <input
                    type="text"
                    placeholder="téléphone"
                    name="telephone"
                    value={formData.telephone}
                    onChange={handleInputChange}
                  />
                </label>
                <label>
                  Date de réservation
                  <input
                    type="datetime-local"
                    id="bookingDate"
                    name="bookingDate"
                    value={formData.bookingDate || today}
                    onChange={handleInputChange}
                  />
                </label>
                <p>Que souhaitez-vous faire ?</p>
                <fieldset>
                  <legend>Choisissez vos prestations:</legend>
                  <div>
                    <input
                      type="checkbox"
                      id="blanchiment"
                      name="performance1"
                      checked={formData.performance1}
                      value="1"
                      onChange={handleInputChange}
                    />
                    <label htmlFor="blanchiment">Blanchiment dentaire</label>
                  </div>
                  <div>
                    <input
                      type="checkbox"
                      id="massage"
                      name="performance2"
                      checked={formData.performance2}
                      value="12"
                      onChange={handleInputChange}
                    />
                    <label htmlFor="massage">Massage</label>
                  </div>
                  <div>
                    <input
                      type="checkbox"
                      id="cils"
                      name="performance3"
                      checked={formData.performance3}
                      value="13"
                      onChange={handleInputChange}
                    />
                    <label htmlFor="cils">Cils</label>
                  </div>
                  <div>
                    <input
                      type="checkbox"
                      id="manicure"
                      name="performance4"
                      checked={formData.performance4}
                      value="14"
                      onChange={handleInputChange}
                    />
                    <label htmlFor="manicure">Manicure</label>
                  </div>
                </fieldset>
                <input type="hidden" name="booking" value="ok" />
                <p>
                  <input
                    type="submit"
                    id="bookingSubmitFormButton"
                    name="booking"
                    value="Réserver"
                  />
                </p>
              </div>
            </form>
            <div id="booking-info">
              <div id="calendar"></div>
              <div id="map">
                <img src="../media/image/photos/zoning.jpg" alt="Zoning" />
              </div>
            </div>
          </div>
        </div>
      </section>
    </React.Fragment>
  );
};

export default Booking;
