import React, { useState, useEffect } from 'react'
import axios from '../../../axios-api'
import Container from 'react-bootstrap/Container'
import Form from 'react-bootstrap/Form'
import Button from 'react-bootstrap/Button'
import ApiService from "../../../services/ApiService";

export default function UserEdit(props) {
    const [user, setUser] = useState(null);
    const [firstName, setFirstName] = useState("");
    const [lastName, setLastName] = useState("");
    const [address, setAddress] = useState("");

    useEffect(() => {
        ApiService.getMe()
            .then(response => {
                console.log(response.data)
                setUser(response.data)
                setFirstName(response.data.firstName)
                setLastName(response.data.lastName)
                setAddress(response.data.address)
            })
            .catch(error => {
                console.log(error)
            })
    }, [])

    const save = (e) => {
        e.preventDefault();

        let data = {...user};
        data.firstName = firstName;
        data.lastName = lastName;
        data.address = address;

        console.log(data);

        axios.put('/users/' + user.id, data)
            .then(response => {
                console.log(response)
            })
            .catch(error => {
                console.log(error)
            })
    }

    return (
        <Container>
            <Form onSubmit={(e) => save(e)}>
                <Form.Group size="lg" controlId="email">
                    <Form.Label>First name</Form.Label>
                    <Form.Control
                        autoFocus
                        type="text"
                        value={firstName}
                        onChange={(e) => setFirstName(e.target.value)}
                    />
                    <Form.Label>Last name</Form.Label>
                    <Form.Control
                        autoFocus
                        type="text"
                        value={lastName}
                        onChange={(e) => setLastName(e.target.value)}
                    />
                    <Form.Label>Address</Form.Label>
                    <Form.Control
                        autoFocus
                        type="text"
                        value={address}
                        onChange={(e) => setAddress(e.target.value)}
                    />
                </Form.Group>

                <Button className={'mt-3'} type="submit">Edit</Button>
            </Form>
        </Container>
    )
}