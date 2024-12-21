import React, { useState, useEffect } from 'react';
import {
  Link,
} from 'react-router-dom'
import { showerScript } from '../utils/JQuery/show.js';

const Lessons = () => {
  const [lessons, setLessons] = useState([]);
  const [homepage, setHomepage] = useState([]);

  useEffect(() => {
    // Function to fetch products from the API
    showerScript();
    const fetchLessons = async () => {
      try {
        // Replace 'YOUR_API_ENDPOINT' with the actual API endpoint
        const version = await fetch('http://localhost:3000//json_manager/getVersions.php');
        const versionData = await version.json();        
        const response = await fetch(`/data/lesson-event_${versionData.performance}.json`);
        const data = await response.json();
        const homepageResponse = await fetch(`/data/homepage_${versionData.homepage}.json`);
        const homepageData = await homepageResponse.json();
        setLessons(data); // Update state with fetched Lessons
        setHomepage(homepageData); // Update state with fetched Lessons
      } catch (error) {
        console.error('Error fetching products:', error);
      }
    };

    fetchLessons(); // Call the function when the component mounts
  }, []); // Empty dependency array ensures the effect runs once on mount

  return (


    <div className="shower grider-3" id="lesson-events"> 
    
    {lessons.map((lesson) => (
                          
                          <div className="lesson">
                                              <div className="title justifier"><div className="padder"><h4 className="centralizer uppercaser">{lesson.date}</h4></div></div>
                                              <div className="description"><div className="padder"><p>{lesson.hour} H {lesson.minute}</p></div></div>
                                        </div>
                  
                                      ))}
                  



                </div>
  );
};


export default Lessons