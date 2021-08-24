import React, { Fragment, useState, useEffect } from 'react'
import { Link } from 'react-router-dom'
import Button from 'react-bootstrap/Button'

import ApiService from "../services/ApiService"
import TokenService from "../services/TokenService"

export default function TopbarLoginRegister(props) {
    const [isLoggedIn, setIsLoggedIn] = useState(props.isLoggedIn)
    const [username, setUsername] =  useState("")

    useEffect(() => {
        console.log('[TopbarLoginRegister.js] useEffect triggered')
        if (TokenService.hasToken()) {
            console.log('still has a token??')
            ApiService.getMe()
                .then(response => {
                    TokenService.setUserId(response.data.id)

                    if (response.data.firstName) {
                        setUsername(response.data.firstName + " " + response.data.lastName)
                    }
                })
                .catch(error => {
                    console.log(error)
                });
            setIsLoggedIn(true)
        } else {
            setIsLoggedIn(false)
        }
    }, [props.isLoggedIn])

    const createActionButtons = () => {
        if (!isLoggedIn) {
            return (
                <Fragment>
                    <Link to={"/register"}><Button variant={"primary"}>Register</Button></Link>
                    <Link to={"/login"}><Button variant={"outline-primary me-3"}>Login</Button></Link>
                </Fragment>
            )
        } else {
            return (
                <Fragment>
                    <Button variant={"outline-primary"} onClick={props.logout}>Logout</Button>
                    <Link to={"/user/edit"}><Button variant={"primary me-3"}>{ username }</Button></Link>
                </Fragment>
            )
        }
    }

    return (
        <Fragment>
            { createActionButtons() }
        </Fragment>
    )
}