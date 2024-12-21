import React from 'react';
import {

    Link,

  } from 'react-router-dom'

  import Menu from './elements/Menu.js'; // Importation du composant Header

  const getImagePath = (imageName) => {
    return `/media/image/${imageName}`;
  };
  

  
const Header = () => {
  return (
    <header>

    <section id="menu">

        <div className="flexible organizer">
        <Link to="/"><nav id="theCompany" className="organizer">
              <div className="padder">
                <div className="flexible">
                  <img className="logo" src={getImagePath('icons/logo.png')}/>        
                </div>
              </div>
            </nav></Link>

            <nav id="desktop-menu">

              <Menu />

            </nav>

            <nav id="mobile-menu">

            <div id="burger-menu" className="opened hidden">
                          
                    <div className="burger-menu">
                        <div className="bar">
                            <span className="bar-1"> </span>
                            <span className="bar-2"> </span>
                            <span className="bar-3"> </span>
                        </div>
                    </div>
            </div>

            


              </nav>

        </div>

        </section>

            <div className="menumobile">
              <div className="padder">        
              <Menu />
              </div>
            </div>


    </header>

  );
};

export default Header;