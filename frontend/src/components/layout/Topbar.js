import React, { useState, useEffect } from 'react'
import Container from 'react-bootstrap/Container'
import styles from './Topbar.module.scss'

import TokenService from "../../services/TokenService";
import ApiService from "../../services/ApiService";

import TopbarLoginRegister from "./../TopbarLoginRegister";
import TopbarNavMenu from "../TopbarNavMenu";

export default function Topbar(props) {
    const [user, setUser] = useState(null);

    useEffect(() => {
        console.log('[Topbar] useEffect fired')
        if (TokenService.hasToken()) {
            ApiService.getMe()
                .then(response => {
                    setUser(response.data)
                })
                .catch(error => {
                    console.log(error)
                });
        }
    }, [props.isLoggedIn])

    return (
        <div className={styles.Topbar + ' bg-secondary text-primary'}>
            <Container className={'d-flex flex-row-reverse py-2'}>
                <TopbarLoginRegister isLoggedIn={props.isLoggedIn} user={user} logout={props.logout} />
            </Container>
            <Container className={"py-3"}>
                <TopbarNavMenu />
            </Container>
        </div>
    )
}