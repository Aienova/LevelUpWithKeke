import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import { showerScript } from '../utils/JQuery/show.js';

const Testimonials = () => {
  const [testimonials, setTestimonials] = useState([]);

  useEffect(() => {
    showerScript();

    // Function to fetch Testimonials from the API
    const fetchTestimonials = async () => {
      try {
        const version = await fetch('http://localhost:3000/json_manager/getVersions.php');
        const versionData = await version.json();
        const response = await fetch(`/data/testimonials_${versionData.performance}.json`);
        const data = await response.json();
        setTestimonials(data); // Update state with fetched Testimonials
      } catch (error) {
        console.error('Error fetching Testimonials:', error);
      }
    };

    fetchTestimonials(); // Call the function when the component mounts
  }, []); // Empty dependency array ensures the effect runs once on mount

  return (
    <section className="full-h shower" id="testimonials">
      <div className="full central-content">
        <h2 className="white-text">Elles m'ont fait confiance</h2>
        <div className="content central-text">

          <div id="before-after">
            {testimonials.map((testimonial) => {
              const hidden = testimonial.id > 1 ? "hidden" : "";
              return (

                
                <div
                  key={testimonial.id}
                  id={`before-after-${testimonial.id}`}
                  className={` before-after ${hidden}`}
                >
                  <h3>Photos de {testimonial.name}</h3>

                  <div class="padder organizer grider-2">
                  <div className="column">
                    <div className="image" style={{ backgroundImage: `url(${testimonial.beforePicture})` }}></div>
                    <h4>Avant</h4>
                  </div>

                  <div className="column">
                    <div className="image" style={{ backgroundImage: `url(${testimonial.afterPicture})` }}></div>
                    <h4>Après</h4>
                  </div>
                </div>
                </div>
              );
            })}
          </div>

                      <div id="notices">
              <div className="grider">
                {testimonials.map((testimonial) => (
                  <div key={testimonial.id} id={`notice-${testimonial.id}`} className="notice">
                    <div className="rate">
                      {[...Array(5)].map((_, i) => (
                        <span key={i} className="material-icons">
                          {testimonial.rate >= i + 1 ? 'star' : 'star_outline'}
                        </span>
                      ))}
                    </div>
                    <h4>{testimonial.name}</h4>
                    <p>{testimonial.comment}</p>
                  </div>
                ))}
              </div>
            </div>

          {/* Commented-out section, potentially for future use */}
          {/* <div id="bigpoints" className="centralizer transitioner hiding mobileblock grider">
            {testimonials.map((service) => (
              <div key={service.id} className="column">
                <div className="image" style={{ backgroundImage: `url(${service.symbol})` }}></div>
                <h3>{service.name}</h3>
                <p>{service.description}</p>
                <p>{service.totaltime / 60}H00 - {service.price}€</p>
              </div>
            ))}
          </div> */}
        </div>
      </div>
    </section>
  );
};

export default Testimonials;
