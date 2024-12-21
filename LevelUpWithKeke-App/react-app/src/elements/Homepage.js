import React, { useState, useEffect } from 'react';
import { Helmet } from 'react-helmet';
import Booking from './Booking';
import Gallery from './Gallery';
import Services from './Services';
import Prices from './Prices';
import Galleries from './Gallery';
import Loader from './Loader';
import { showerScript } from '../utils/JQuery/show.js';
import $ from 'jquery';
import Testimonials from './Testimonials.js';

const Dashboard = () => {

  /*----API ---*/

  const [homeData, setHomeData] = useState([]);
  const [websiteData, setWebsiteData] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {

    showerScript();

    $(window).scrollTop(0);


    const fetchData = async (e) => {

      try {

        const version = await fetch('http://localhost:3000//json_manager/getVersions.php'); //This API it's a PHP code return a jSon with the number latest version of json file data website_XXXX.json
        const versionData = await version.json();
        const website = await fetch('/data/website_'+versionData.website+'.json');
        const homepage = await fetch('/data/homepage_'+versionData.homepage+'.json');
        const result = await homepage.json();
        const result2 = await website.json();
        setHomeData(result);
        setWebsiteData(result2);
        
      } catch (error) {
        console.error('Error fetching data:', error);
      }
    };




    fetchData();
  }, []);


  

  /*-----API-----*/


  return (

    

    <React.Fragment>

<Helmet>
        <title>{homeData.title}</title>
        <meta name="description" content={homeData.description} />
      </Helmet>

      {/*
 <section id="dashboard-part">  

              <div className="container">
                <div className="padder">
                <form onSubmit={handleSubmit}>

                        <Helmet>
                  <title>Page d'accueil</title>
                  <meta name="description" content="Le dashboard" />
                  <link rel="canonical" href="https://www.example.com/my-page" />
                </Helmet>

                        <h1>Tableau de Bord:</h1>
                <h2>Bonjour {userdata.login}</h2>
                <label>
                  Login:
                  <input
                    type="text"
                    name="login"
                    value={editableValue.login}
                    onChange={handleInputChange}
                  />
                </label>
                <br />
                
                <button type="submit">Submit</button>
              </form>
              </div>
              </div>

    

    </section> */}

<section className="full-h secondary-color" id="aboutus">

<div className="padder shower">                      
<h2 className="transitioner hiding">Ketsia Nglibo<br></br>{homeData.aboutUsTitle}</h2>
                        <div className="flexible full">


                        <div className="content">

                        
                        <div className="content-text transitioner hiding">
                          
                          <div className="black-text flexible">

                            <div className="column"><h3>Qui suis-je ?</h3>{homeData.aboutUs}</div>
                            <div className="column"><h3>Ma vision</h3>Mon objectif est de faire comprendre au monde qu'il existe une diversité de féminités, chacune pouvant s'exprimer de différentes manières. Je souhaite ardemment que chaque femme puisse simplement exprimer sa propre féminité librement et briller à travers elle. Mon ambition est de créer un espace, aussi bien numérique que physique, où chaque femme se sente représentée et valorisée.</div>

                            
                            
                            </div>

                          <div className="marger-top central-text"><button class="blackflag">Prendre Rendez-vous</button></div>


                        </div>

                        </div>

                        <div className="portrait hiddenformobile" style={{ backgroundImage: `url(${homeData.aboutUsImage})` }}></div>
       
            </div>
            </div>
            </section>

            <Services />
            <Testimonials/>


            <section id="important-infos">

              <div class="padder organizer">

                <div class="flexible">

                  <object class="padder"><span class="material-symbols-outlined">person_pin_circle</span></object>
                  <object class="padder uppercaser">Je me déplace dans toute l'Île-de-France</object>

                </div>


                  <div class="flexible">

                  <object class="padder"><span class="material-symbols-outlined">credit_card</span></object>
                  <object class="padder uppercaser">Payez votre accompte avec paypal, lydia ou Revolut</object>

                  </div>


              </div>


            </section>

            
    </React.Fragment>

    
  );
  }



export default Dashboard