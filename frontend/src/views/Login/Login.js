import React from 'react'
import Container from 'react-bootstrap/Container'
import Alert from 'react-bootstrap/Alert'
import Form from 'react-bootstrap/Form'
import Button from 'react-bootstrap/Button'
import Spinner from 'react-bootstrap/Spinner'

export default function Login(props) {
    function validateForm() {
        if (props.loginData.email.length > 0 && props.loginData.password.length > 0) {
            return true;
        }
        return false;
    }


    function alert() {
        if (props.status.success) {
            return (
                <Alert className="mt-3" variant="success">
                    Je bent ingelogd!
                </Alert>
            )
        }

        if (props.status.error) {
            return (
                <Alert className="mt-3" variant="danger">
                    { props.status.error.data.code === 401 ?
                        "Verkeerde credentials"
                        :
                        "Er is een onbekende fout"
                    }
                </Alert>
            )
        } else if (props.status.error === undefined) {
            return (
                <Alert className="mt-3" variant="danger">
                    "Er is een onbekende (server) fout opgetreden"
                </Alert>
            )
        }
        return null
    }

    return(
        <Container>
            <Form onSubmit={props.login}>
                <Form.Group size="lg" controlId="email">
                    <Form.Label>Email</Form.Label>
                    <Form.Control
                        autoFocus
                        type="email"
                        value={props.loginData.email}
                        onChange={(e) => props.loginData.setEmail(e.target.value)}
                    />
                </Form.Group>
                <Form.Group size="lg" controlId="password">
                    <Form.Label>Password</Form.Label>
                    <Form.Control
                        type="password"
                        value={props.loginData.password}
                        onChange={(e) => props.loginData.setPassword(e.target.value)}
                    />
                </Form.Group>
                <Button className={'mt-3'} type="submit" disabled={!validateForm()}>Login</Button>
            </Form>

            { props.loading ?
                <div className="text-center my-3">
                    <Spinner animation="border" role="status">
                        <span className="sr-only"></span>
                    </Spinner>
                </div>
                : null
            }

            { alert() }
        </Container>
    )
}