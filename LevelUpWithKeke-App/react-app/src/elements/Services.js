import React, { useState, useEffect } from 'react';
import { Link, useLocation } from 'react-router-dom'; // Added useLocation hook
import { showerScript } from '../utils/JQuery/show.js';

const Services = () => {
  const [services, setServices] = useState([]);
  const [homepageContent, setHomepageContent] = useState([]);
  const location = useLocation(); // Hook to get the current location

  useEffect(() => {
    // Initialize any scripts that rely on the DOM being loaded
    showerScript();

    // Function to fetch services and homepage data from the API
    const fetchData = async () => {
      try {
        // Fetch the version information
        const versionResponse = await fetch('http://localhost:3000/json_manager/getVersions.php');
        if (!versionResponse.ok) {
          throw new Error(`Failed to fetch version data: ${versionResponse.statusText}`);
        }
        const versionData = await versionResponse.json();

        // Fetch services data
        const servicesResponse = await fetch(`/data/performance_${versionData.performance}.json`);
        if (!servicesResponse.ok) {
          throw new Error(`Failed to fetch services data: ${servicesResponse.statusText}`);
        }
        const servicesData = await servicesResponse.json();

        // Fetch homepage data
        const homepageResponse = await fetch(`/data/homepage_${versionData.homepage}.json`);
        if (!homepageResponse.ok) {
          throw new Error(`Failed to fetch homepage data: ${homepageResponse.statusText}`);
        }
        const homepageData = await homepageResponse.json();

        // Update state with fetched data
        setServices(servicesData);
        setHomepageContent(homepageData);
      } catch (error) {
        console.error('Error fetching data:', error);
      }
    };

    // Call the fetchData function when the component mounts
    fetchData();
  }, []); // Empty dependency array ensures the effect runs once on mount

  return (
    <section className="full-h shower" id="services">
      <div className="full central-content">
        {location.pathname === '/' && (
          <h2>Les prestations à la carte</h2>
        )}
        <div className="content central-text">
          <div id="bigpoints" className="centralizer transitioner hiding mobileblock grider">
            {services.map((service) => (
              <div className="column" key={service.id}>
                <div className="image" style={{ backgroundImage: `url(${service.symbol})` }}></div>
                <h3>{service.name}</h3>
                <p>{service.description}</p>
                
                <p>
                  {service.price < 0
                    ? 'Sur devis'
                    : `${(service.totaltime / 60).toFixed(2)}H00 - ${service.price}€`}
                </p>
              </div>
            ))}
          </div>
        </div>

        <p className="transitioner hiding white-text">
          <button className="uppercaser">En savoir plus</button>
        </p>
      </div>
    </section>
  );
};

export default Services;
