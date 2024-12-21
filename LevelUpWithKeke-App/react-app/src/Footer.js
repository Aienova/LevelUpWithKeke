import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import $ from 'jquery';

const getImagePath = (imageName) => {
  return `/media/image/${imageName}`;
};

const Footer = () => {
  const [socials, setSocials] = useState([]); // Initialize state for Socials
  const [website, setWebsite] = useState([]); // Initialize state for Socials


  useEffect(() => {
    // Function to fetch products from the API
    const fetchSocials = async () => {
      try {
        // Replace 'YOUR_API_ENDPOINT' with the actual API endpoint
        const version = await fetch('http://localhost:3000//json_manager/getVersions.php'); //This API it's a PHP code return a jSon with the number latest version of json file data website_XXXX.json
        const versionData = await version.json();
        const response = await fetch('/data/socials_'+versionData.socials+'.json');
        const response2 = await fetch('/data/website_'+versionData.website+'.json');
        const data = await response.json();
        const data2 = await response2.json();

        console.log(data);

        setSocials(data); // Update state with fetched products
        setWebsite(data2); // Update state with fetched products


      } catch (error) {
        console.error('Error fetching products:', error);
      }
    };

    fetchSocials(); // Call the function when the component mounts
  }, []); // Empty dependency array ensures the effect runs once on mount

  return (
    <footer id="footer-menu" className="viewpopup-test">
      



      <div className="introduction-effect flexible mobileblock organizer">


                <div id="company-infos-footer" className="column flexible">

                <img id="logo-company-footer" className="logo-mini" src={getImagePath(`icons/up.png`)} />


                <div className="full padder">

                  <h3 id="trust-us">Trust the process find your confidence</h3>
                  
            {website && (
              <ul className="padder ">
                <li className="inliner"><Link to="mailto:contact@glowydent.fr">Ketsia Nglibo</Link></li>
                <li className="inliner"><Link to="mailto:contact@glowydent.fr">contact@glowydent.fr</Link></li>
                <li className="inliner"><Link to={`tel:${website.telephone}`}>{website.telephone}</Link></li>

                <li>
                  {socials.map((social) => (
                    <a
                      className="social"
                      target="_blank"
                      rel="noopener noreferrer"
                      href={social.link}
                      key={social.name} // Added key prop for list items
                    >
                      <img
                        className="logo-mini invert"
                        src={getImagePath(`icons/${social.name}.png`)}
                        alt={social.name}
                      />
                    </a>
                  ))}
                </li>
              </ul>
            )}
          </div>
          </div>
        <div className="column">
          <ul id="footer-menu" className="padder grider-2">
          <Link to="/"><li style={{ backgroundColor: "#FDDC4A" }} >Accueil</li></Link>
          <Link to="/page/qui-suis-je"><li style={{ backgroundColor: "#FFC3D8" }}>Qui suis-je ?</li></Link>
          <Link to="/page/mes-prestations"><li style={{ backgroundColor: "#F29848" }}>Les prestations</li></Link>
          <Link to="/page/mes-ateliers"><li style={{ backgroundColor: "#8460BE" }}>Les ateliers</li></Link>
          <Link to="/"><li style={{ backgroundColor: "#B0EB8E" }}>Recherche</li></Link>
          <Link to="/page/reservation"><li style={{ backgroundColor: "#91D0D6" }}>Contact</li></Link>
          <Link to="/page/mentions-l-egales"><li style={{ backgroundColor: "#FFC3D8" }}>Mentions légales</li></Link>
          <Link to="/page/politique"><li style={{ backgroundColor: "#F29848" }} >Confidentialité</li></Link>


          </ul>
        </div>
      </div>
      <p className="central-text white-text">
        Powered by <a href="https://aienova.com">
          <img className="logo-mini invert" src={getImagePath('icons/aienova.png')} alt="Aienova" />
        </a> Nothing to something
      </p>
    </footer>
  );
};

export default Footer;
