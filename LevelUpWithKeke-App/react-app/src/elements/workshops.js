import React, { useState, useEffect } from 'react';
import {
  Link,
} from 'react-router-dom'
import { showerScript } from '../utils/JQuery/show.js';

const Workshops = () => {
  const [workshops, setWorkshops] = useState([]);
  const [homepage, setHomepage] = useState([]);

  useEffect(() => {
    // Function to fetch products from the API
    showerScript();
    const fetchWorkshops = async () => {
      try {
        // Replace 'YOUR_API_ENDPOINT' with the actual API endpoint
        const version = await fetch('http://localhost:3000//json_manager/getVersions.php');
        const versionData = await version.json();        
        const response = await fetch(`/data/workshop_${versionData.performance}.json`);
        const data = await response.json();
        const homepageResponse = await fetch(`/data/homepage_${versionData.homepage}.json`);
        const homepageData = await homepageResponse.json();
        setWorkshops(data); // Update state with fetched Workshops
        setHomepage(homepageData); // Update state with fetched Workshops
      } catch (error) {
        console.error('Error fetching products:', error);
      }
    };

    fetchWorkshops(); // Call the function when the component mounts
  }, []); // Empty dependency array ensures the effect runs once on mount

  return (


    <div className="shower grider-3" id="workshops"> 
    
    {workshops.map((workshop) => (
                          

        <div className="workshop">
                            <div className="title justifier"><div className="padder"><h4 className="centralizer uppercaser">{workshop.title}</h4></div></div>
                            <div className="description"><div className="padder"><p>{workshop.description}</p></div></div>
                      </div>

                    ))}


{/*
                      {Workshops.map((page) => (
        <div key={page.id}>
          <h3>{page.title} - {page.description} - <Link to={`/service/${page.id}`}><span className="watch">see more</span></Link> </h3>
           Add more product details as needed 
        </div>
      ))}*/}


                </div>
  );
};


export default Workshops