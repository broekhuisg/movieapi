import React, { useState, useEffect } from 'react'
import { Link } from 'react-router-dom'
import axios from '../../axios-api'

import Row from 'react-bootstrap/Row'
import Col from 'react-bootstrap/Col'

export default function ShowOverview(props) {
    const [shows, setShows] = useState(null);

    useEffect(() => {
        axios.get('/tvshows')
            .then(result => {
                setShows(result.data["hydra:member"])
                console.log(result.data["hydra:member"])
            })
    }, [])

    return (
        <Row>
            { shows?.map((show, index) => {
                return (
                    <Col xs="6" key={index}>
                        <Link to={{ pathname: `/show/${show.id}`, state: { shows: shows } }}>
                            <div>
                                { show.title } <small>({show.seasons.length} seasons)</small>
                            </div>
                        </Link>
                    </Col>
                )
            })}
        </Row>
    )
}