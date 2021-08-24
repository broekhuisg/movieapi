import React, { useState, useEffect } from 'react'
import { useParams, Link } from 'react-router-dom'
import axios from '../../axios-api'
import ApiService from "../../services/ApiService"
import Row from 'react-bootstrap/Row'
import Col from 'react-bootstrap/Col'

export default function ShowDetail(props) {
    const { id } = useParams();
    const [userId, setUserId] = useState(null);
    const [show, setShow] = useState(null);

    useEffect(() => {
        if (props.location.state) {
            props.location.state.shows.map(show => {
                if (show?.id === parseInt(id)) {
                    setShow(show)
                }
            });
        } else {
            axios.get('/tvshows/' + id)
                .then(result => {
                    setShow(result.data)
                })
        }

        // setUserId(ApiService.getMe());
    }, [])

    function addToWatchList() {
        const data = {
            'media_id': id
        }
        axios.put('/users/' + userId + '/add-media', data)
            .then(response => {
                console.log(response)
            })
            .catch(error => {
                console.log(error)
            })
    }

    return (
        <React.Fragment>
            <Row>
                <Col xs={4}>
                    <img src="http://lorempixel.com/180/240" className={"rounded mr-2 img-fluid"} />
                </Col>
                <Col xs={8}>
                    <h2>{ show?.title }</h2>
                    <Link className="btn btn-primary mb-2" to={{ pathname: `/show/${show?.id}/edit`, state: { show: show } }}>
                        Edit
                    </Link><br />
                    <a className="btn btn-warning"
                       onClick={addToWatchList}>
                        Add to watchlist
                    </a>
                </Col>
            </Row>

            <Row>
                <Col xs={{ span: 8, offset: 4 }}>
                    <h5>Seasons</h5>
                    { 
                        show?.seasons.map(season => {
                            return (
                                <Link 
                                    key={season.id}
                                    to={{ pathname: `/show/${show.id}/season/${season.seasonNumber}`, state: { show: show } }}
                                    className={"btn btn-outline-primary btn-sm mr-2"}>
                                    { season.seasonNumber }
                                </Link>
                            )
                        })
                    }
                </Col>
            </Row>
        </React.Fragment>
    )
}