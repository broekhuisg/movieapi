import React from 'react'
import Container from 'react-bootstrap/Container'
import Carousel from 'react-bootstrap/Carousel'

export default function Hero(props) {
    const carouselItems = props.heroData?.map((data, key) => {
        return (
            <Carousel.Item key={key}>
                <img src={data.heroPath} className="d-block w-100" />
                <Carousel.Caption>
                    <h3>{ data.title }</h3>
                </Carousel.Caption>
            </Carousel.Item>
        )
    });

    return (
        <Carousel>
            { carouselItems }
        </Carousel>
    )
}