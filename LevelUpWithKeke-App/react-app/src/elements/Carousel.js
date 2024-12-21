import React from 'react';
import Slider from 'react-slick';
import "slick-carousel/slick/slick.css";
import "slick-carousel/slick/slick-theme.css";

const Carousel = () => {
  const settings = {
    dots: true,
    infinite: true,
    speed: 500,
    slidesToShow: 1,
    slidesToScroll: 1
  };

  return (

    <section id="carousel">
    <div>
      <h2 class="central-text"> Voyez par vous même</h2>
      <Slider {...settings}>


        <div>
            <div className="carousel-image"></div>
        </div>

        <div>
            <div className="carousel-image"></div>
        </div>

        <div>
            <div className="carousel-image"></div>
        </div>

        <div>
            <div className="carousel-image"></div>
        </div>

        <div>
            <div className="carousel-image"></div>
        </div>

        <div>
            <div className="carousel-image"></div>
        </div>


        
      </Slider>
    </div>
    </section>
  );
};

export default Carousel;