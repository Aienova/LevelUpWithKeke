import React from 'react';
import { Link } from 'react-router-dom';

const Popup = () => {


  return (

              <div id="popup" class=" transitioner test-closed justifier">


                  <div class="popup transitioner leashed">


                    <div className="padder black-text">

                    <div  className="right-text"><span id="popup-closer" class="material-symbols-outlined clickable">cancel</span></div>

                    <h3>Envie de découvrir votre propre style ?</h3>

                    <h4 className="uppercaser">Effectuez ce test rapide et gratuit et découvrez quel est ton style ! </h4>

                    <Link to="/page/quel-est-votre-style"><button id="start-test">Je fais le test</button></Link><br></br>
                    <Link to="/"><span id="no-thanks">Non merci</span></Link>

                  </div>

                  </div>

          </div>

  );
};

export default Popup;