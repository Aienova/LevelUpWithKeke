import React, { useState, useEffect } from 'react';
import { faqScript } from '../utils/JQuery/faq.js';
import { showerScript } from '../utils/JQuery/show.js';

const Faqs = () => {
  const [faqs, setFaqs] = useState([]);



  useEffect(() => {
    // Function to fetch products from the API

    showerScript();
    const fetchFaqs = async () => {
      try {
        // Replace 'YOUR_API_ENDPOINT' with the actual API endpoint
        const response = await fetch('https://127.0.0.1:8000/api/data/get/list/faq');
        const data = await response.json();

        console.log(data);

        setFaqs(data); // Update state with fetched products
      } catch (error) {
        console.error('Error fetching products:', error);
      }

      faqScript();  
    };

    fetchFaqs(); // Call the function when the component mounts



  }, []); // Empty dependency array ensures the effect runs once on mount

  return (

                <section className="full-h shower" id="faq">                           

                      <div className="full central-content">


                      <div className="content central-text">
                              <h2>Foires aux questions</h2>

                              <div className="centralizer transitioner hiding flexible">


                              <div class="faq">
                              {faqs.map((faq) => (     
                    <div class="accordion">
                    <div class="accordion-section">
                                                        <a href={`#accordion-${faq.id}`} className="accordion-section-title">
                                      <strong>
                                        {faq.question} <span className="plus">+</span><span className="minus">-</span>
                                      </strong>
                                    </a>

                                    <div 
                                      id={`accordion-${faq.id}`} 
                                      className="accordion-section-content" 
                                      style={{ display: 'none' }} 
                                      dangerouslySetInnerHTML={{ __html: faq.answer }} 
                                    />
                                
                  </div>
                  </div>
                                                      
                             ))}

                            </div>
                             







                              </div>
                      </div>



                      </div>
{/*
                      {Faqs.map((page) => (
        <div key={page.id}>
          <h3>{page.title} - {page.description} - <Link to={`/service/${page.id}`}><span className="watch">see more</span></Link> </h3>
           Add more product details as needed 
        </div>
      ))}*/}


                </section>
  );
};


export default Faqs