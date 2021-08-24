import React, { Fragment, useState, useEffect } from 'react'
import Container from 'react-bootstrap/Container'
import Row from 'react-bootstrap/Row'
import Col from 'react-bootstrap/Col'
import MediaService from "../../services/MediaService"

import Hero from "../../components/layout/Hero";
import Poster from "../../components/poster/Poster";

export default function Home(props) {
    const [heroData, setHeroData] = useState(null)
    const [theaterMovies, setTheaterMovies] = useState(null)

    useEffect(() => {
        MediaService.getFeaturedMovies()
            .then(result => {
                if (result.data['hydra:member'].length) {
                    setHeroData(result.data['hydra:member']);
                }
            })
            .catch(error => {
                console.log(error)
            });

        MediaService.getTheaterMovies()
            .then(result => {
                if (result.data['hydra:member'].length) {
                    setTheaterMovies(result.data['hydra:member']);
                }
            })
            .catch(error => {
                console.log(error)
            });
    }, [])

    return (
        <Fragment>
            <Hero heroData={heroData} />
            <Container>
                <Row>
                {
                    theaterMovies?.map((movie, index) => {
                        if (index < 6) {
                            return (
                                <Col md={2}>
                                    <Poster media={movie} header={true} />
                                </Col>
                            )
                        }
                    })
                }
                </Row>
            </Container>
        </Fragment>

    )
}