import React, { useState, useEffect } from 'react';
import { sideScript } from '../utils/JQuery/side.js';
import $ from 'jquery';
import {
  Link,
} from 'react-router-dom'
import { showerScript } from '../utils/JQuery/show.js';

const Galleries = () => {
  const [galleries, setGalleries] = useState([]);



  useEffect(() => {
    // Function to fetch products from the API

    showerScript();
    const fetchGalleries = async () => {
      try {
        // Replace 'YOUR_API_ENDPOINT' with the actual API endpoint
        const version = await fetch('http://localhost:3000//json_manager/getVersions.php');
        const versionData = await version.json();        
        const response = await fetch(`/data/gallery_${versionData.gallery}.json`);
        const data = await response.json();

        console.log(data);

        setGalleries(data); // Update state with fetched products
      } catch (error) {
        console.error('Error fetching products:', error);
      }

      sideScript();  
    };

    fetchGalleries(); // Call the function when the component mounts



  }, []); // Empty dependency array ensures the effect runs once on mount

  return (

                <section className="full-h shower" id="gallery">                           

                      <div className="full central-content">


                      <div className="content central-text">
                              <h2>Voyez par vous même</h2>

                              <div className="centralizer transitioner hiding flexible">


                              <div class="gallery">
                              {galleries.map((gallery) => (     
                                    <div className="gallery-item" >
                                      <img className="gallery-item-photo sider" data-side={`picture${gallery.id}`} src={gallery.link} />

                                    </div>
                                    
                             ))}

                            </div>
                             
                             {galleries.map((gallery) => (    
                             <div id={`picture${gallery.id}`} className="gallery-preview hidden side">
                                              <div className="closegallery clearsider">
                                                      <span className="material-symbols-outlined">close</span>
                                              </div>

                                          <img src={gallery.link}/>

                                          </div>
                             ))}






                              </div>
                      </div>



                      </div>
{/*
                      {Galleries.map((page) => (
        <div key={page.id}>
          <h3>{page.title} - {page.description} - <Link to={`/service/${page.id}`}><span className="watch">see more</span></Link> </h3>
           Add more product details as needed 
        </div>
      ))}*/}


                </section>
  );
};


export default Galleries