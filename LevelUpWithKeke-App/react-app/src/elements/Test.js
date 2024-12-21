import React, { useState, useEffect } from 'react';
import { Link, useParams } from 'react-router-dom';
import Loader from './Loader';
import Booking from './Booking';
import $ from 'jquery';
import Faqs from './Faq';
import { Helmet } from 'react-helmet';
import Services from './Services';
import Contact from './Contact';
import Workshops from './workshops';
import Advices from './advices';
import Newsletter from './Newsletter';
import Lessons from './lessons';
import PageLoader from './PageLoader';
import PageTest1 from './Test/pageTest1.js';
import PageTest2 from './Test/pageTest2.js';

const Test = () => {
  const [Test, setTestData] = useState({});
  const [website, setWebsiteData] = useState({});
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);
  const { testid } = useParams();

  useEffect(() => {
    $(window).scrollTop(0);
    $(".hiding").removeClass("hiding"); // Fix class selector


    $("header").addClass("hidden"); // Fix class selector
    $("footer").addClass("hidden"); // Fix class selector
    $("#app-content").addClass("testing"); // Fix class selector

    const fetchData = async () => {
      setLoading(true);
      try {
        const version = await fetch('http://localhost:3000//json_manager/getVersions.php');
        const versionData = await version.json();
        const websiteResponse = await fetch(`/data/website_${versionData.website}.json`);
        const websiteData = await websiteResponse.json();

        setWebsiteData(websiteData);
      } catch (error) {
        setError(error.message);
      } finally {
        setLoading(false);
      }
    };

    fetchData();
  }, [testid]);

  if (loading) {
    return (
      <section id="the-page">
        <div className="container">
          <div className="padder">
            <PageLoader />
          </div>
        </div>
      </section>
    );
  }

  if (error) {
    return <div>Error: {error}</div>;
  }

  const renderContent = () => {


    if (testid === 1) {
      return (
        <section id="the-page" className="introduction-effect">
          <div className="container">
            <div className="padder">


              <h1 class="central-content">Quelle est votre style ?</h1>



            </div>
          </div>

        </section>
      );
    } 
    
    else {
      return (

        <div id="pagesTest">

            <img class="pastille" src="https://127.0.0.1:8000/cuid/media/image/09-11-2024/pastille_7190044703.png" />

            <PageTest1/>
            <PageTest2/>
        </div>



        
      );
    }
  };

  return (
    <>
      <Helmet>
        <title>Trouvez votre style</title>
        <meta name="description" content="Faîte un test de personnalité pour trouver votre style" />
      </Helmet>
      {renderContent()}
    </>
  );
};

export default Test;
