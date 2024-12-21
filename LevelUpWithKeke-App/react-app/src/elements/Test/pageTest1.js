import React, { useState, useEffect } from 'react';
import {
  Link,
} from 'react-router-dom'

const PageTest1 = () => {
  const [services, setServices] = useState([]);
  const [homepage, setHomepage] = useState([]);

  useEffect(() => {
    // Function to fetch products from the API
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

                <section id="pageTest1" className="introduction-effect">



                <h1 class="central-content">Quelle est votre style ?</h1>

                <div id="banner-test"></div>
               <div class="central-text"> <button>Commencer le test</button></div>



            </section>
  );
};


export default PageTest1