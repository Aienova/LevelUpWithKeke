
import React, { useState, useEffect } from 'react';
import { submitPopup } from '../utils/JQuery/submitPopup.js';
import { calendar } from '../utils/JQuery/calendar.js';
import { showerScript } from '../utils/JQuery/show.js';
import $ from 'jquery';

const Contact = () => {

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
      <section className="full-h" id="contact">

        <div id="contact-form" class="flexible">


          <div id="pro-infos">
          
            <div className="container">
            <div id="pro-photo" className="uppercaser"></div>
            <h4 className="uppercaser">Ketsia Ngbilo</h4>

            <ul>
            <li>06 06 06 06 06</li>
            <li>levelupwithkeke@gmail.com</li>
            </ul>

            <h4 className="uppercaser">Suivez moi</h4>

            <a class="social" target="_blank" rel="noopener noreferrer" href="https://www.instagram.com/glowydent/"><img class="logo-mini invert" src="/media/image/icons/Instagram.png" alt="Instagram"/></a>
            <a class="social" target="_blank" rel="noopener noreferrer" href="https://www.linkedin.com/in/glowydent-professional-8279392bb/"><img class="logo-mini invert" src="/media/image/icons/Linkedin.png" alt="Linkedin"/></a>
            <a class="social" target="_blank" rel="noopener noreferrer" href="https://sofifa.com/league/31"><img class="logo-mini invert" src="/media/image/icons/TikTok.png" alt="TikTok"/></a>
            <a class="social" target="_blank" rel="noopener noreferrer" href="https://sofifa.com/league/31"><img class="logo-mini invert" src="/media/image/icons/Pinterest.png" alt="Pinterest"/></a>

            </div>


          </div>

          <div id="customer-infos">

            <form>

              <div  className="padder">

              <h4 className="uppercaser">Formualire de contact</h4>

                  <ul>        
                    <li><label>
                        Prénom
                          <input
                            type="text"
                            placeholder="Prénom"
                            name="firstname"
                            value={formData.firstname}
                            onChange={handleInputChange}
                        />
                    </label></li>

                    <li><label>
                        Nom
                          <input
                            type="text"
                            placeholder="Nom"
                            name="firstname"
                            value={formData.surname}
                            onChange={handleInputChange}
                        />
                    </label></li>

                    <li><label>
                        Email
                          <input
                            type="text"
                            placeholder="Email"
                            name="email"
                            value={formData.firstname}
                            onChange={handleInputChange}
                        />
                    </label></li>


                    <li><label>

                          <textarea
                            name="message"
                            value={formData.email}
                            onChange={handleInputChange}
                            >
                            Entrez votre message

                            </textarea>

                    </label></li>


                    </ul>

                    <p className="central-text">
                  <input
                    type="submit"
                    id="bookingSubmitFormButton"
                    name="booking"
                    value="ENVOYER"
                  />
                </p>
                </div>
            </form>


          </div>





        </div>


      </section>
    </React.Fragment>
  );
};

export default Contact;
