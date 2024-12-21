import React, { useState, useEffect } from 'react';
import {
  Link,
} from 'react-router-dom'
import { showerScript } from '../utils/JQuery/show.js';

const Advices = () => {
  const [advices, setAdvices] = useState([]);
  const [homepage, setHomepage] = useState([]);

  useEffect(() => {
    // Function to fetch products from the API
    showerScript();
    const fetchAdvices = async () => {
      try {
        // Replace 'YOUR_API_ENDPOINT' with the actual API endpoint
        const version = await fetch('http://localhost:3000//json_manager/getVersions.php');
        const versionData = await version.json();        
        const response = await fetch(`/data/advice_${versionData.performance}.json`);
        const data = await response.json();
        const homepageResponse = await fetch(`/data/homepage_${versionData.homepage}.json`);
        const homepageData = await homepageResponse.json();
        setAdvices(data); // Update state with fetched Advices
        setHomepage(homepageData); // Update state with fetched Advices
      } catch (error) {
        console.error('Error fetching products:', error);
      }
    };

    fetchAdvices(); // Call the function when the component mounts
  }, []); // Empty dependency array ensures the effect runs once on mount

  return (


    <div className="shower flexible central-content" > 


      <div classname="column" id="advices">

        <div className="marger">

        {advices.map((advice) => (


                        <div className="advice">

                        <div className="image" style={{ backgroundImage: `url(https://127.0.0.1:8000${advice.image})` }}><div className="padder"><div className="tag justifier"><span>{advice.tag}</span></div></div></div>   
                        <div className="description">
                            <div className="padder">
                              <span class>{advice.date}</span>
                              <h4>{advice.title}</h4>
                              <p> {advice.description}</p>
                            </div>
                        </div>

                        </div>
                          

                        ))}

                        

      </div>
      </div>



      <div classname="column" id="advertising">


      <div className="marger">

        <div className="image" style={{ backgroundImage: `url(/media/image/photos/add1.png)` }}></div>
        <div className="image" style={{ backgroundImage: `url(/media/image/photos/add2.png)` }}></div>
        <div className="image" style={{ backgroundImage: `url(/media/image/photos/add3.png)` }}></div>

        </div>

      </div>
    {/*
    {advices.map((advice) => (
                          

                    ))}



                      {Advices.map((page) => (
        <div key={page.id}>
          <h3>{page.title} - {page.description} - <Link to={`/service/${page.id}`}><span className="watch">see more</span></Link> </h3>
           Add more product details as needed 
        </div>
      ))}*/}


  </div>
  );
};


export default Advices