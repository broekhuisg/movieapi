import React, { useEffect, useState } from 'react'
import { useParams } from "react-router-dom";
import axios from '../../axios-api'

import Button from 'react-bootstrap/Button'
import Form from 'react-bootstrap/Form'
import Accordion from 'react-bootstrap/Accordion'
import Card from 'react-bootstrap/Card'

export default function ShowEdit(props) {
    const { id } = useParams();
    const [show, setShow] = useState(null);

    useEffect(() => {
        if (props.location.state.show) {
            setShow(props.location.state.show)
            console.log(show)
        } else {
            console.log('else props')
            axios.get('/tvshows/' + id)
                .then(result => {
                    setShow(result.data)
                    console.log(show)
                })
        }
    }, [])


    const save = (e) => {
        let formData = new FormData(document.forms.editshow);

        e.preventDefault();

        console.log(formData.get('title'));
    }

    return (
        <div>
            <Form id="editshow" method="POST" onSubmit={(e) => save(e)}>
                <Form.Label>Title</Form.Label>
                <Form.Control defaultValue={show?.title} type="text" disabled={false} name="title" />
                <Form.Label>Poster</Form.Label>
                <Form.Control defaultValue={show?.posterPath} type="text" disabled={false} name="posterPath" />

                <hr />

                <Accordion>
                    {
                        show?.seasons.map((season, index) => {
                            return (
                                <Card key={'index'+index}>
                                    <Card.Header>
                                        <Accordion.Toggle as={Button} variant="link" eventKey={index.toString()}>
                                            Season { season.seasonNumber }
                                        </Accordion.Toggle>
                                    </Card.Header>
                                    <Accordion.Collapse eventKey={index.toString()}>
                                        <Card.Body>
                                            {
                                                season.episodes.map((episode, _i) => {
                                                  return (
                                                      <div key={'index'+_i}>
                                                          { episode.title }
                                                      </div>
                                                  )
                                                })
                                            }
                                        </Card.Body>
                                    </Accordion.Collapse>
                                </Card>
                            )
                        })
                    }
                </Accordion>

                <hr />
                <Button type="submit">Save!</Button>
            </Form>
        </div>
    )
}