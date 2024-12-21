import React, { useState, useEffect } from 'react';
import { BrowserRouter as Router, Route, Switch, useLocation, useParams } from 'react-router-dom';
import { sliderScript } from '../utils/JQuery/slider.js';
import $ from 'jquery';

const Banner = () => {
  const location = useLocation();
  const [data, setData] = useState({});
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);
  const { name } = useParams();
  const [title, setTitle] = useState("");
  const [homeData, setHomeData] = useState([]);

  // Handle default name value
  const pageName = name || "homepage";


  useEffect(() => {
    const fetchData = async () => {
      setLoading(true);
      setData({});



      try {

        const version = await fetch('http://localhost:3000//json_manager/getVersions.php'); //This API it's a PHP code return a jSon with the number latest version of json file data website_XXXX.json
        const versionData = await version.json();
        const homepage = await fetch('/data/homepage_'+versionData.homepage+'.json');

        if(pageName != "homepage"){
        const response = await fetch(`/data/page_${name}_${versionData[`page_${name}`]}.json`);
        if (!response.ok) {
          throw new Error('Network response was not ok');

        }

        const result = await response.json();
        setData(result);
        }



        const resultHomeData = await homepage.json();
        setHomeData(resultHomeData);

        setError(null);
      } catch (error) {
        setError(error.message);
      } finally {
        setLoading(false);
      }
    };

    

    fetchData();

    const intervalId = sliderScript();

    return () => {
      clearInterval(intervalId);
    };

  }, [name]);

  useEffect(() => {
    if (data.title) {
      setTitle(`<h1 class="white-text introduction-effect">${data.title}</h1>`);
    }
  }, [data]);



  const getImagePath = (imageName) => {
    return `/media/image/${imageName}`;
  };

  return (
    <>
      {location.pathname === '/' && (




        
        <div id="banner">

                  <style>

                  {`


              .slide1 {
                background-image: url("https://127.0.0.1:8000/cuid/media/image/08-31-2024/Rectangle_105_8376072856.png");
              }


              .slide2 {
                background-image: url("https://127.0.0.1:8000/cuid/media/image/09-01-2024/menu2_1340052711.jpg");
              }


              .slide3 {
                background-image: url("https://127.0.0.1:8000/cuid/media/image/09-01-2024/menu3_0289052711.jpg");
              }

              .slide0 {
                background-image: url("https://127.0.0.1:8000/cuid/media/image/08-31-2024/Rectangle_105_8376072856.png");
              }


              .slide1 h1::before{

              content: "Réservez votre relooking maintenant !";
              
              }


              .slide2 h1::before{

              content: "découvrez l'ateleir ''apprendre à marcher avec des talons'' ";

              }


              .slide3 h1::before{

              content: "Plaisir d'offrir : offrez un moment unique à une proche";

              }



            `}

                  </style>


          <div id="slide" className="slide1">
            <div className="bannerInfo padder">
              <h1 className="introduction-effect white-text slideTitle1"></h1>
              <div className="introduction-effect-up" id="bookingNow">
              <button className="uppercaser">Prendre rendez-vous</button>
            </div>
            </div>
          </div>

          <div id="bannerBottom" className="uppercaser">Découvrez votre style ! Faites dès maintenant notre test de style rapide et gratuit ici</div>

        </div>
      )}




      {location.pathname === '/page/apprendre-a-marcher-en-talons' && (
        <div id="simple-banner">
          <div id="bigtitle">
            <div className="padder">
              <div className="banner-title central-text" dangerouslySetInnerHTML={{ __html: title }}></div>
            </div>
          </div>
        </div>


      )}        

    </>
  );
};

export default Banner;
