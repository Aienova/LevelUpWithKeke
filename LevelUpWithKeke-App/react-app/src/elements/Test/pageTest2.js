import React, { useState, useEffect } from 'react';
import {
  Link,
} from 'react-router-dom'

const PageTest2 = () => {
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

                <section id="pageTest2" className="introduction-effect central-text">



                <h2 class="test-title">Quelle est votre style ?</h2>

                <h3>Quelle serait votre destination de vacances préférée ? </h3>

                <div className="central-content">
                <div className="choices-test grider-3">

                    <label for="choice1"  class="choice colored justifier"><h4>Choix</h4><input type="radio" id="choice1" name="choice"/></label>
                    <label for="choice2"  class="choice justifier"><h4>Choix</h4><input type="radio" id="choice2" name="choice"/></label>
                    <label for="choice3"  class="choice colored justifier"><h4>Choix</h4><input type="radio" id="choice3" name="choice"/></label>
                    <label for="choice4"  class="choice justifier"><h4>Choix</h4><input type="radio" id="choice4" name="choice"/></label>
                    <label for="choice5"  class="choice colored justifier"><h4>Choix</h4><input type="radio" id="choice5" name="choice"/></label>
                    <label for="choice6"  class="choice justifier"><h4>Choix</h4><input type="radio" id="choice5" name="choice"/></label>
                </div>


                </div>
               <div class="central-text"> <button>Commencer le test</button></div>



            </section>
  );
};


export default PageTest2