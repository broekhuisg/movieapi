import React, { Fragment, useState, useEffect } from 'react'
import Container from 'react-bootstrap/Container'
import ApiService from "../../services/ApiService";

import Hero from "../../components/layout/Hero";

export default function Home(props) {
    const [heroData, setHeroData] = useState(null)

    useEffect(() => {
        ApiService.getFeaturedMovies()
            .then(result => {
                if (result.data['hydra:member'].length) {
                    setHeroData(result.data['hydra:member']);
                }
            })
            .catch(error => {
                console.log(error)
            })
    }, [])

    return (
        <Fragment>
            <Hero heroData={heroData} />
            <Container>

            </Container>
        </Fragment>

    )
}