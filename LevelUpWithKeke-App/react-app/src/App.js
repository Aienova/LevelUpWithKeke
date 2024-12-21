import React, { useEffect, useState } from 'react';
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';
import Homepage from './elements/Homepage.js';
import Media from './elements/Media.jsx';
import Page from './elements/Page.js';
import Services from './elements/Services.js';
import Service from './elements/Service.js';
import Theme from './elements/Theme.js';
import Header from './Header';
import Footer from './Footer';
import DataUpdater from './DataUpdater.js';
import Banner from './elements/Banner.js';
import Booking from './elements/Booking.js';
import { menuScript } from './utils/JQuery/menu.js';
import { popupScript } from './utils/JQuery/popup.js';
import $ from 'jquery';
import Loader from './elements/Loader.js';
import './App.css';
import Popup from './elements/Popup.js';
import Test from './elements/Test.js';

function App() {
  const [cssContent, setCssContent] = useState('');
  

  useEffect(() => {
    const setScreenHeightVariable = () => {
      const screenHeight = window.innerHeight;
      document.documentElement.style.setProperty('--screen-height', `${screenHeight}px`);
    };

    const loadCuidCss = async () => {
      try {
        console.log('Initialize load Cuid CSS.');

        // Fetch the latest version from the server
        const response = await fetch('http://localhost:3000//style_manager/getVersions.php');

        console.log('Last version fetched.');

        if (!response.ok) {
          throw new Error('Failed to fetch version data');
        }

        const versionData = await response.json();
        const cssUrl = `/cuid-styles/custom_${versionData.graphics}.css`;

        console.log(cssUrl);

        // Fetch the CSS file
        const cssResponse = await fetch(cssUrl);

        if (!cssResponse.ok) {
          throw new Error('Failed to fetch CSS file');
        }

        // Get the text content of the CSS file
        const cssText = await cssResponse.text();

        console.log(cssText);

        // Update state with the CSS content
        setCssContent(cssText);
      } catch (error) {
        console.error('Error loading the CSS file:', error);
      }
    };

    loadCuidCss();
    setScreenHeightVariable();
    menuScript();
    popupScript();

    window.addEventListener('resize', setScreenHeightVariable);

    return () => {
      window.removeEventListener('resize', setScreenHeightVariable);
      $('.closed').off('click');
      $('.opened').off('click');
    };
  }, []); // Empty dependency array ensures this runs only once

  return (
    
    <Router>
              <style>{cssContent}</style>
      <div id="App">
        {/* Inject the CSS content into a <style> tag */}

        <Loader />
        <Popup />
        <Header />
        <main id="app-content">
          <Routes>
            <Route exact path="/" element={<Banner />} />
            <Route path="/page/:name" element={<Banner />} />
          </Routes>
          <div id="nothing-to-something" class="primary-color">
            <Routes>
              <Route exact path="/" element={<Homepage />} />
              <Route path="/media" element={<Media />} />
              <Route path="/test" element={<Test />} />
              <Route path="/page/:name" element={<Page />} />
              <Route path="/services" element={<Services />} />
              <Route path="/theme" element={<Theme />} />
              <Route exact path="/service/:id" element={<Service />} />
              <Route exact path="/dataupdater/:name" element={<DataUpdater />} />
            </Routes>
          </div>
        </main>
        <Footer />
      </div>
    </Router>
  );
}

export default App;
