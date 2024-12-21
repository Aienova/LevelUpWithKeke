import React, { useState, useEffect } from 'react';
import {
  Link,
} from 'react-router-dom'
import { showerScript } from '../utils/JQuery/show.js';

const Prices = () => {
  const [services, setServices] = useState([]);
  const [homepage, setHomepage] = useState([]);

  useEffect(() => {
    // Function to fetch products from the API
    showerScript();
    const fetchServices = async () => {
      try {
        // Replace 'YOUR_API_ENDPOINT' with the actual API endpoint
        const version = await fetch('http://localhost:3000//json_manager/getVersions.php');
        const versionData = await version.json();        
        const response = await fetch(`/data/performance_${versionData.performance}.json`);
        const data = await response.json();
        const homepageResponse = await fetch(`/data/homepage_${versionData.homepage}.json`);
        const homepageData = await homepageResponse.json();
        setServices(data); // Update state with fetched services
        setHomepage(homepageData); // Update state with fetched services
      } catch (error) {
        console.error('Error fetching products:', error);
      }
    };

    fetchServices(); // Call the function when the component mounts
  }, []); // Empty dependency array ensures the effect runs once on mount

  return (

                <section className="full-h shower secondary-color" id="prices">                           

                      <div className="full central-content">


                      <div className="content central-text">
                              <h2>Nos prix</h2>

                              <div id="price-points" className="centralizer transitioner hiding flexible mobileblock">


                              {services.map((service) => (     
                                <nav className="bigpoint"><div className="circle"><div className="price">{service.price}€</div></div><strong>{service.name}</strong></nav>  ))}
                              </div>
                      </div>

                          <p className="transitioner hiding">{homepage.ourPrices}</p>

                      </div>
{/*
                      {Services.map((page) => (
        <div key={page.id}>
          <h3>{page.title} - {page.description} - <Link to={`/service/${page.id}`}><span className="watch">see more</span></Link> </h3>
           Add more product details as needed 
        </div>
      ))}*/}


                </section>
  );
};


export default Prices