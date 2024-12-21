import React, { useState, useEffect } from 'react';
import { Link, useParams } from 'react-router-dom';
import Loader from './Loader';
import PageLoader from './PageLoader';
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

const Page = () => {
  const [page, setPageData] = useState({});
  const [website, setWebsiteData] = useState({});
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);
  const { name } = useParams();

  useEffect(() => {
    $(window).scrollTop(0);
    $(".hiding").removeClass("hiding"); // Fix class selector
    $("header").removeClass("hidden"); // Fix class selector
    $("footer").removeClass("hidden"); // Fix class selector

    const fetchData = async () => {
      setLoading(true);
      try {
        const version = await fetch('http://localhost:3000//json_manager/getVersions.php');
        const versionData = await version.json();
        const websiteResponse = await fetch(`/data/website_${versionData.website}.json`);
        const pageResponse = await fetch(`/data/page_${name}_${versionData[`page_${name}`]}.json`);
        const pageData = await pageResponse.json();
        const websiteData = await websiteResponse.json();
        setPageData(pageData);
        setWebsiteData(websiteData);
      } catch (error) {
        setError(error.message);
      } finally {
        setLoading(false);
      }
    };

    fetchData();
  }, [name]);

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
    if (name === "reservation") {
      return (
        <section id="the-page" className="introduction-effect">
          <div className="container">
            <div className="padder">
              <h1 class="central-content">Vous souhaitez prendre rendez-vous ou vous avez une question ? Contactez-moi ! </h1>
            <Contact />


            
            </div>
          </div>
          <div id="style-test" className="justifier central-text"><h2>Faîtes votre test de style , redécouvrez qui vous êtes </h2><Link to="/page/quel-est-votre-style"><button>Faire un test</button></Link></div>

        </section>
      );
    } else if (name === "faq") {
      return (
        <section id="the-page" className="introduction-effect">
          <div className="container">
            <div className="padder">
              <Faqs />
            </div>
          </div>
          <div id="style-test" className="justifier central-text"><h2>Faîtes votre test de style , redécouvrez qui vous êtes </h2><Link to="/page/quel-est-votre-style"><button>Faire un test</button></Link></div>

        </section>
      );

    } else if (name === "mes-ateliers") {
      return (
        <section id="the-page" className="introduction-effect">
          <div className="container">
            <div className="padder">
            <div id="page-content" dangerouslySetInnerHTML={{ __html: page.content }} />

            <h2>Les ateliers à venir</h2>

            <Workshops />

            <div className="spacer central-text uppercaser"><h3>Une question ? N’hésitez pas à me contacter içi</h3></div>

            </div>

            </div>
            <div id="style-test" className="justifier central-text"><h2>Faîtes votre test de style , redécouvrez qui vous êtes </h2><Link to="/page/quel-est-votre-style"><button>Faire un test</button></Link></div>

        </section>
      );

    } else if (name === "apprendre-a-marcher-en-talons") {
      return (
        <section id="the-page" className="introduction-effect">
          <div className="container">
            <div className="padder">
            <div id="page-content" dangerouslySetInnerHTML={{ __html: page.content }} />

            <h2>Les prochains cours de groupe</h2>

            <Lessons />


            </div>

            </div>
            <div id="style-test" className="justifier central-text"><h2>Faîtes votre test de style , redécouvrez qui vous êtes </h2><Link to="/page/quel-est-votre-style"><button>Faire un test</button></Link></div>

        </section>
      );

    }  else if (name === "mes-conseils-pour-level-up") {
      return (
        <section id="the-page" className="introduction-effect">
          <div className="container">
            <div className="padder">
            <h1>Mes conseils pour Level up</h1>

            <Advices />

            <Newsletter/>

            </div>

            </div>
            <div id="style-test" className="justifier central-text"><h2>Faîtes votre test de style , redécouvrez qui vous êtes </h2><Link to="/page/quel-est-votre-style"><button>Faire un test</button></Link></div>

        </section>
      );

    }
    
    
    else if (name === "mes-prestations") {
      return (
        <section id="the-page" className="introduction-effect">
          <div className="container">
            <div className="padder">
            <div id="page-content" dangerouslySetInnerHTML={{ __html: page.content }} />
              <Services />
            </div>
          </div>

          <div id="interest"><h2 className="uppercaser">Intéressée par plusieurs prestations ? Créons ensemble votre atelier personnalisé ! </h2></div>

          <p className="central-text central-content spacer">Quels sont vos besoins ?
                      Plusieurs séances pour booster votre confiance et mieux comprendre votre personnalité et votre style. 
                      Objectif : monter d’un niveau et exceller dans votre domaine en vous sentant à l'aise et en confiance.
                      Découvrez votre identité et faites-le en toute authenticité</p>

                      <Contact />
                      <div id="style-test" className="justifier central-text"><h2>Faîtes votre test de style , redécouvrez qui vous êtes </h2><Link to="/page/quel-est-votre-style"><button>Faire un test</button></Link></div>

        </section>

      );
    } 

    else if (name === "quel-est-votre-style") {
      return (
        <section id="the-page" className="introduction-effect">
          <div className="container">
            <div className="padder">
            <div id="page-test-content" dangerouslySetInnerHTML={{ __html: page.content }} />

            <div className="central-text"><button>Faire le test</button></div>

            </div>
          </div>

        </section>

      );
    } 
    
    
    else {
      return (
        <section id="the-page" className="introduction-effect">
          <div className="container">
            <div className="padder">
              <div id="page-content" class="central-content" dangerouslySetInnerHTML={{ __html: page.content }} />
            </div>
          </div>

          <div id="style-test" className="justifier central-text"><h2>Faîtes votre test de style , redécouvrez qui vous êtes </h2><Link to="/page/quel-est-votre-style"><button>Faire un test</button></Link></div>

        </section>

        
      );
    }
  };

  return (
    <>
      <Helmet>
        <title>{page.title || "Default Title"}</title>
        <meta name="description" content={page.description || "Default description"} />
      </Helmet>
      {renderContent()}
    </>
  );
};

export default Page;
