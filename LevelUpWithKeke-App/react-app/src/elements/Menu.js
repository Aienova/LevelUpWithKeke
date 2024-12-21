import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import $ from 'jquery';

const getImagePath = (imageName) => {
  return `/media/image/${imageName}`;
};

const Menu = () => {
  const [menus, setMenus] = useState([]);

  useEffect(() => {
    // Function to fetch menus from the API
    const fetchMenus = async () => {
      try {
        const version = await fetch('http://localhost:3000/json_manager/getVersions.php');
        const versionData = await version.json();
        const response = await fetch(`/data/menu_${versionData.menu}.json`);
        const data = await response.json();
        console.log(data);

        setMenus(data); // Update state with fetched menus
      } catch (error) {
        console.error('Error fetching menus:', error);
      }
    };

    // jQuery code to manipulate DOM elements
    setTimeout(() => {
      $("#loader").addClass("vanished");
    }, 2500);

    $('.menu').on('click', () => {
      $(".bar").removeClass('change');
      $(".menumobile").slideUp();
    });

    fetchMenus(); // Call the function when the component mounts
  }, []); // Empty dependency array ensures the effect runs once on mount

  return (
    <ul className="menu">
      <Link to="/"><li className="mainmenu-button hidden">Retour au menu principal</li></Link>

      {menus.map((menu) => (
        <Link className="centralizer" to={menu.url}><li id={`menu${menu.id}`} style={{ backgroundColor: menu.backgroundColor }}  className="mainmenu show-submenu" key={menu.id}>
          
          <object className="show-submenu-name" >{menu.title}</object>
          

          {menu.submenus && menu.submenus.length > 0 && (
            <div className="submenu hiddenformobile">
              <div className="padder">
                <ul>
                  {menu.submenus.map((submenu) => (
                    <Link className="centralizer" to={submenu.url}><li key={submenu.id}>
                      
                      <object >{submenu.title}</object>
                      
                    </li></Link>
                  ))}
                </ul>
              </div>
            </div>
          )}
        </li></Link>
      ))}





<Link to="/page/reservation"><li style={{ backgroundColor: `#fcdc49` }} className="mainmenu resabutton centralizer"><object>Contact</object></li></Link>
    </ul>
  );
};

export default Menu;
